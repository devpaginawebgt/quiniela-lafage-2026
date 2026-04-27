<?php

namespace App\Http\Services;

use App\Models\Line;

class LineService {

    public function getLines()
    {
        return Line::all();
    }

    public function getLine(string|int $line_id)
    {   
        return Line::find($line_id);
    }

}