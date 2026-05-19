<?php

namespace Database\Seeders;

use App\Models\Codigo;
use Illuminate\Database\Seeder;

class CodigoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Codigo::factory(4)->state(['estado' => 1])->create();

        $codigos = [
            '47298ABK',
            '81532JRT',
            '26947MPL',
            '59103WQX',
            '73846FNG',
            '18472CYV',
            '60291HZD',
            '94358BTM',
            '35714RKP',
            '12869LWS',
        ];

        foreach($codigos as $codigo) {
            Codigo::create([
                'codigo' => $codigo,
                'estado' => 0,
            ]);
        }
    }
}
