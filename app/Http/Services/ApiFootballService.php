<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Http;

class ApiFootballService
{

    public function getTeams() 
    {

        $response = Http::withHeaders([
            'x-apisports-key' => env('API_FOOTBALL_API_KEY') ?? '',
        ])
        ->get('https://v3.football.api-sports.io/teams?league=1&season=2022');

        if (! $response->ok()) {

            return [
                'error' => true,
                'message' =>  'No se pudo obtener la información de la API Football.'
            ];

        }

        $data = $response->json('response');

        dd($data);

    }
    
}
