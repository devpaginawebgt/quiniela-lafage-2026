<?php

namespace App\Http\Controllers\Auth;

use App\Models\Avatar;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Services\CodigoService;
use App\Http\Services\CompanyService;
use App\Http\Services\LegalDocumentService;
use App\Http\Services\LineService;
use App\Http\Services\UserService;
use App\Models\LegalDocument;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class RegisteredUserController extends Controller
{
    public function __construct(
        private readonly LineService $lineService,
        private readonly CompanyService $companyService,
        private readonly LegalDocumentService $legalDocumentService,
        private readonly UserService $userService,
        private readonly CodigoService $codigoService,
    ) {}

    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create(Request $request)
    {
        $country = $this->userService->getGuestCountry();

        $lines = $this->lineService->getLines();

        $companies = $this->companyService->getCompaniesByCountry($country->id);

        $terms = $this->legalDocumentService->getByType(LegalDocument::TYPE_TERMS);

        return view('modulos.register', compact('country', 'lines', 'companies', 'terms'));
    }    

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(RegisterRequest $request)
    {
        $data = $request->validated();

        $codigo = null;

        if ((int)$data['user_type_id'] === 1) {
            $result = $this->codigoService->validate($data['code']);

            if (!$result['success']) {
                throw ValidationException::withMessages(['codigo' => $result['message']]);
            }

            $codigo = $result['codigo'];

            $data['codigo_id'] = $codigo->id;

            $data['line_id'] = 7;
        }

        $data['puntos'] = 0;

        $data['password'] = Hash::make($data['password']);

        $data['completed_info'] = true;

        $data['completed_info_at'] = now();

        $data['avatar_id'] = Avatar::where('is_default', true)->value('id');

        $user = User::create($data);

        $user->assignRole('participant');

        if ((int)$data['user_type_id'] === 1 && !empty($codigo)) {
            $this->codigoService->markAsUsed($codigo);
        }

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::home());
        
    }
}