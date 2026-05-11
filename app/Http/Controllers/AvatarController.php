<?php

namespace App\Http\Controllers;

use App\Http\Resources\Avatar\AvatarResource;
use App\Models\Avatar;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class AvatarController extends Controller
{
    use ApiResponse;

    public function index(Request $request)
    {   
        $avatars = Avatar::all();

        $avatars = AvatarResource::collection($avatars);

        return $this->successResponse($avatars);
    }
}
