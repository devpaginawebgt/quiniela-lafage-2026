<?php

namespace App\Http\Services;

use App\Models\Country;
use App\Models\EquipoPartido;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class UserService {

    public function getGuestCountry()
    {
        $cached = session('guest_country');
        
        if ($cached instanceof Country) {
            return $cached;
        }

        $ip = request()->ip();
        // $ip = '45.164.150.249'; // GT
        // $ip = '190.181.222.119'; // HN
        // $ip = '190.62.80.251'; // SV
        // $ip = '152.231.33.166'; // NI
        // $ip = '190.172.133.244'; // AR

        $country_code = 'GT';

        try {
            $response = Http::timeout(3)->get("http://api.ipinfo.io/lite/{$ip}", [
                'token' => config('services.geolocation.key'),
            ]);

            if ($response->ok() && !empty($response->json('country_code'))) {
                $country_code = $response->json('country_code');
            }
        } catch (\Exception $e) {
            // fallback silencioso, $country_code ya es 'GT'
        }

        $country = Country::where('country_code', $country_code)->first()
            ?? Country::where('country_code', 'GT')->first();

        session(['guest_country' => $country]);

        return $country;
    }

    public function getUsers()
    {
        $participantes = User::where('status_user', 1)->get();

        return $participantes;
    }

    public function getUser(int $userId)
    {
        return User::find($userId);
    }

    private function rankingQuery(int|string $line_id, int|string $user_type_id, array $columns = ['id', 'nombres', 'apellidos', 'avatar_id', 'pais_id', 'numero_documento', 'email', 'puntos', 'created_at', 'deleted_at']): Builder
    {
        return User::select($columns)
            ->selectRaw('RANK() OVER (ORDER BY puntos DESC, created_at ASC, nombres ASC) as posicion')
            ->when(in_array((int)$user_type_id, [ 2 ]), function($query) use($line_id) {
                $query->where('line_id', $line_id);
            })
            ->where('user_type_id', $user_type_id)
            ->where('completed_info', true)
            ->where('status_user', 1)
            ->has('predictions');
    }

    public function getRanking(int|string $line_id, int|string $user_type_id)
    {
        return $this->rankingQuery($line_id, $user_type_id)
            ->with(['country', 'avatar'])
            ->limit(100)
            ->get();
    }

    public function getRankingWeb(int|string $line_id, int|string $user_type_id, $perPage = 100)
    {
        return User::query()
            ->fromSub($this->rankingQuery($line_id, $user_type_id), 'users')
            ->where('posicion', '<=', 100)
            ->with(['country', 'avatar'])
            ->simplePaginate($perPage);
    }

    public function getUserRank(User $user)
    {
        if (empty($user->line_id)) {
            $user->posicion = null;
            return $user;
        }

        $rank = DB::query()
            ->fromSub($this->rankingQuery($user->line_id, $user->user_type_id, ['id']), 'ranking')
            ->where('id', $user->id)
            ->value('posicion');

        $user->posicion = $rank;

        return $user;
    }

    public function getUserPredictionsCount(User $user)
    {
        $partidos_existentes = EquipoPartido::whereHas('partido')->count();

        $predicciones_realizadas = $user->predictions->count();

        $predicciones_pendientes = $partidos_existentes - $predicciones_realizadas;

        $partidos = [
            'total_partidos' => $partidos_existentes,
            'predicciones' => $predicciones_realizadas,
            'predicciones_pendientes' => $predicciones_pendientes
        ];

        $user->partidos = (object) $partidos;

        return $user;
    }

    // public function updateGlobalPoints()
    // {
    //     User::where('puntos_trivias', '>', 0)
    //         ->orWhere('puntos_predicciones', '>', 0)
    //         ->chunkById(500, function ($users) {
    //             foreach ($users as $user) {
    //                 $user->puntos = $user->puntos_predicciones + $user->puntos_trivias;
    //                 $user->save();
    //             }
    //         });
    // }

}