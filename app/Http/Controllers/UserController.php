<?php

namespace App\Http\Controllers;

use App\Http\Resources\Line\LineRankingResource;
use App\Http\Resources\User\UserRankingResource;
use App\Http\Resources\User\UserRankResource;
use App\Http\Resources\User\UserResource;
use App\Http\Services\BrandService;
use App\Http\Services\LineService;
use App\Http\Services\PremioService;
use App\Http\Services\TermsService;
use App\Http\Services\UserService;
use App\Models\Brand;
use App\Models\BrandPosition;
use App\Models\Country;
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
        private readonly TermsService $termsService,
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

        $user = $this->userService->getUserPredictionsCount($user);

        $user = new UserRankResource($user);

        return $this->successResponse($user);

    }

    public function getUserRank(Request $request)
    {
        $user = $request->user();

        $user = $this->userService->getUserRank($user);

        $user = $this->userService->getUserPredictionsCount($user);

        $user = new UserRankResource($user);

        return $this->successResponse($user);

    }

    public function getRanking(Request $request)
    {
        $user = $request->user();

        $line_id = (int) $user->line_id;

        $line = $this->lineService->getLine($line_id);

        $line->participantes = $this->userService->getRanking($line_id);

        $line = new LineRankingResource($line);

        return $this->successResponse($line);
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

        $brands = Brand::all();

        $premios = $this->premioService->getPremios($user->line_id);

        // $users = $this->userService->getRanking($line->id);

        return view('modulos.ranking', compact('line', 'brands', 'premios'));
    }



    /**
     * Devuelve los datos paginados del ranking vía JSON.
     */
    public function getRankingData(Request $request)
    {
        $user = Auth::user();
        $line_id = (int) $user->line_id;
        $perPage = (int) $request->query('perPage', 100);

        $result = $this->userService->getRankingWeb($line_id, $perPage);

        return $this->successResponse([
            'has_more' => $result->hasMorePages(),
            'current_page' => $result->currentPage(),
            'next_page' => $result->hasMorePages() ? $result->currentPage() + 1 : null,
            'users' => UserRankingResource::collection($result->items()),
        ]);
    }

    public function perfil()
    {
        $user = Auth::user();

        $terms = $this->termsService->getTerms();

        return view('modulos.perfil', [
            'user' => $user,
            'terms' => $terms,
        ]);
    }

    public function verParticipantes()
    {

        $participantes = $this->userService->getUsers();

        return view('modulos.participantes', [
            'participantes' => $participantes
        ]);

    }
}
