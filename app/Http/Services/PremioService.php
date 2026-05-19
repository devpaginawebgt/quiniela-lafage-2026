<?php

namespace App\Http\Services;

use App\Models\Premio;
use Illuminate\Database\Eloquent\Builder;

class PremioService {

    public function getPremios(int|string $line_id, int|string $user_type_id)
    {
        return Premio::where('user_type_id', $user_type_id)
            ->when(in_array((int)$user_type_id, [ 2 ]), function($query) use($line_id) {
                $query->where('line_id', $line_id);
            })
            ->get();
    }

}