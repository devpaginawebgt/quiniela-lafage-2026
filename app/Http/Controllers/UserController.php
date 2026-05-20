<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\UpdateUserAvatarRequest;
use App\Http\Requests\Auth\UpdateUserRequest;
use App\Http\Resources\Line\LineRankingResource;
use App\Http\Resources\User\UserRankingResource;
use App\Http\Resources\User\UserRankResource;
use App\Http\Resources\User\UserResource;
use App\Http\Services\BrandService;
use App\Http\Services\CompanyService;
use App\Http\Services\LegalDocumentService;
use App\Http\Services\LineService;
use App\Http\Services\PremioService;
use App\Http\Services\UserService;
use App\Models\Avatar;
use App\Models\Brand;
use App\Models\BrandPosition;
use App\Models\Country;
use App\Models\LegalDocument;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    use ApiResponse;

    public function __construct(
        private readonly UserService $userService,
        private readonly LineService $lineService,
        private readonly PremioService $premioService,
        private readonly LegalDocumentService $legalDocumentService,
        private readonly CompanyService $companyService,
    ) {}

    // API responses

    public function getUsers()
    {

        $participantes = $this->userService->getUsers();

        $participantes = UserResource::collection($participantes);

        return $this->successResponse($participantes);

    }
    
    public function getUser(Request $request)
    {
        $user = $request->user();
        
        $user = $this->userService->getUserRank($user);        

        $user = new UserRankResource($user);

        return $this->successResponse($user);

    }

    public function update(UpdateUserRequest $request)
    {
        $user = $request->user();

        $data = $request->validated();

        $data['completed_info'] = true;

        $data['completed_info_at'] = now();

        $user->update($data);

        $user->refresh();
        
        $user = $this->userService->getUserRank($user);

        $user = new UserRankResource($user);

        return $this->successResponse($user);
    }

    public function updateAvatar(UpdateUserAvatarRequest $request)
    {
        $user = $request->user();

        $data = $request->validated();

        if ((int) $data['avatar_id'] !== (int) $user->avatar_id) {
            $user->update($data);

            $user->refresh();
        }

        $user = $this->userService->getUserRank($user);

        return $this->successResponse(new UserRankResource($user));
    }

    public function getUserRank(Request $request)
    {
        $user = $request->user();

        $user = $this->userService->getUserRank($user);    

        $user = new UserRankResource($user);

        return $this->successResponse($user);

    }

    public function getRanking(Request $request)
    {
        $user = request()->user();

        if (!$user->completed_info) {
            return $this->errorResponse("Por favor, completa tu información en la sección 'Perfil' para acceder al ranking", 403, [], 'PROFILE_INCOMPLETE');
        }

        $user = $request->user();

        $line_id = (int) $user->line_id;

        $line = $this->lineService->getLine($line_id);

        $line->participantes = $this->userService->getRanking($line_id, (int)$user->user_type_id);

        if ((int)$user->user_type_id === 1) {
            $line->name = 'Ranking Dependientes';
        } elseif ((int)$user->user_type_id === 3) {
            $line->name = 'Ranking Colaboradores';
        }

        $line = new LineRankingResource($line);

        return $this->successResponse($line);
    }

    public function delete(Request $request)
    {
        $user = request()->user();

        $user->tokens()->delete();

        $user->delete();

        return $this->successResponse(['message' => 'Usuario eliminado correctamente.']);
    }

    // public function getRanking(Request $request)
    // {
    //     $user = $request->user();
    //     $id_pais = (int) $user->pais_id;
    //     $perPage = (int) $request->query('perPage', 100);

    //     $result = $this->userService->getRanking($id_pais, $perPage);

    //     $items = collect($result->items());

    //     if ($result->currentPage() === 1) {
    //         $items = $this->userService->setUserBrands($items, $id_pais);
    //     }

    //     return $this->successResponse([
    //         'has_more' => $result->hasMorePages(),
    //         'current_page' => $result->currentPage(),
    //         'next_page' => $result->hasMorePages() ? $result->currentPage() + 1 : null,
    //         'users' => UserRankingResource::collection($items),
    //     ]);
    // }

    // Funciones para la web

    public function indexWeb()
    {
        $user = Auth::user();

        $line = $user->line;

        if ((int)$user->user_type_id === 1) {
            $line->name = 'Ranking Dependientes';
        } elseif ((int)$user->user_type_id === 3) {
            $line->name = 'Ranking Colaboradores';
        }

        $brands = Brand::all();

        $premios = empty($line) ? [] : $this->premioService->getPremios($user->line_id, (int) $user->user_type_id);

        $userRank = $this->userService->getUserRank($user);
        $userRank->loadMissing(['country', 'avatar']);

        return view('modulos.ranking', compact('line', 'brands', 'premios', 'userRank'));
    }



    /**
     * Devuelve los datos paginados del ranking vía JSON.
     */
    public function getRankingData(Request $request)
    {
        $user = Auth::user();
        $line_id = (int) $user->line_id;
        $perPage = (int) $request->query('perPage', 100);

        $result = $this->userService->getRankingWeb($line_id, (int)$user->user_type_id, $perPage);

        return $this->successResponse([
            'has_more'     => $result->hasMorePages(),
            'current_page' => $result->currentPage(),
            'next_page'    => $result->hasMorePages() ? $result->currentPage() + 1 : null,
            'users'        => UserRankingResource::collection($result->items()),
        ]);
    }

    public function perfil()
    {
        $user = Auth::user();

        $user->loadMissing('avatar');

        $terms   = $this->legalDocumentService->getByType(LegalDocument::TYPE_TERMS);
        $privacy = $this->legalDocumentService->getByType(LegalDocument::TYPE_PRIVACY);
        $avatars = Avatar::orderBy('id')->get();

        return view('modulos.perfil', [
            'user'    => $user,
            'terms'   => $terms,
            'privacy' => $privacy,
            'avatars' => $avatars,
        ]);
    }

    public function updateAvatarWeb(UpdateUserAvatarRequest $request)
    {
        /** @var \App\Models\User $user */
        $user = $request->user();

        $data = $request->validated();

        if ((int) $data['avatar_id'] !== (int) $user->avatar_id) {
            $user->update($data);
            $user->refresh();
        }

        $user->loadMissing('avatar');

        return $this->successResponse([
            'avatar' => [
                'id'   => $user->avatar?->id,
                'name' => $user->avatar?->name,
                'url'  => $user->avatar ? asset($user->avatar->url) : null,
            ],
        ]);
    }

    public function completarPerfil()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        if ($user->completed_info) {
            return redirect()->route('web.proximos-partidos');
        }

        $user->loadMissing('country');

        $lines     = (int) $user->user_type_id === 2 ? $this->lineService->getLines() : collect();
        $companies = (int) $user->user_type_id === 1 ? $this->companyService->getCompaniesByCountry($user->pais_id) : collect();

        return view('modulos.completar-perfil', compact('user', 'lines', 'companies'));
    }

    public function completarPerfilStore(UpdateUserRequest $request)
    {
        $user = $request->user();

        $data = $request->validated();

        $data['completed_info']    = true;
        $data['completed_info_at'] = now();

        $user->update($data);

        return redirect()->route('web.proximos-partidos');
    }

    public function verParticipantes()
    {

        $participantes = $this->userService->getUsers();

        return view('modulos.participantes', [
            'participantes' => $participantes
        ]);

    }

    public function deleteWeb(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $user->tokens()->delete();

        $user->delete();

        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return $this->successResponse(['message' => 'Usuario eliminado correctamente.']);
    }
}
