<?php

namespace App\Http\Services;

use App\Models\Codigo;


class CodigoService {

    public function validate(int|string $code, string|int $country_id): array
    {
        $db_code = Codigo::where('codigo', $code)->first();

        if (empty($db_code)) {
            return ['success' => false, 'message' => 'Este código de invitación no existe.', 'code' => 404];
        }

        if ((int)$db_code->country_id !== (int)$country_id) {
            return ['success' => false, 'message' => 'Este código de invitación no pertenece a este país.', 'code' => 422];
        }

        if ((int)$db_code->estado === 1) {
            return ['success' => false, 'message' => 'Este código de invitación ya ha sido utilizado.', 'code' => 406];
        }

        return ['success' => true, 'codigo' => $db_code];
    }

    public function markAsUsed(Codigo $codigo): void
    {
        $codigo->update(['estado' => 1]);
    }

}