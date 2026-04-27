<?php

namespace App\Http\Services;

use App\Models\Brand;

class BrandService {

    public function getBrands($line_id)
    {
        return Brand::where('line_id', $line_id)->get();
    }

}