<?php

namespace App\Http\Services;

use App\Models\Premio;
use Illuminate\Database\Eloquent\Builder;

class PremioService {

    public function getPremios($line_id)
    {
        return Premio::where('line_id', $line_id)->get();
    }

}