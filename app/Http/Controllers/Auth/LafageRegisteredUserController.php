<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LafageRegisterRequest;
use App\Http\Services\LegalDocumentService;
use App\Http\Services\LineService;
use App\Http\Services\UserService;
use App\Models\Avatar;
use App\Models\LegalDocument;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LafageRegisteredUserController extends Controller
{
    public function __construct(
        private readonly LineService $lineService,
        private readonly LegalDocumentService $legalDocumentService,
        private readonly UserService $userService,
    ) {}

    public function create()
    {
        $country = $this->userService->getGuestCountry();

        $lines = $this->lineService->getLines();

        $terms = $this->legalDocumentService->getByType(LegalDocument::TYPE_TERMS);

        return view('modulos.register-lafage', compact('country', 'lines', 'terms'));
    }

    public function store(LafageRegisterRequest $request)
    {
        $data = $request->validated();

        $data['user_type_id']      = 3;
        $data['puntos']            = 0;
        $data['password']          = Hash::make($data['password']);
        $data['completed_info']    = true;
        $data['completed_info_at'] = now();
        $data['avatar_id']         = Avatar::where('is_default', true)->value('id');

        $user = User::create($data);

        $user->assignRole('participant');

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::home());
    }
}
