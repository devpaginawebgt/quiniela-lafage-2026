<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'codigo_id'        =>  1,
                'nombres'          =>  'Dennis',
                'apellidos'        =>  'PWG',
                'image'            =>  null,
                'numero_documento' =>  '1234567891111',
                'email'            =>  'dev@paginawebguatemala.com',                
                'pais_id'          =>  1,
                'user_type_id'     =>  1,
                'line_id'          =>  1,
                'colegiado'        =>  null,
                'status_user'      =>  1,
                'password'         =>  Hash::make('FScomunica2'),
                'accepted_terms_version' => '0.1.0',
                'created_at'       =>  (Carbon::now())->toDateTimeString(),
            ],
            [
                'codigo_id'        =>  2,
                'nombres'          =>  'Dwight',
                'apellidos'        =>  'PWG',
                'image'            =>  null,
                'numero_documento' =>  '1234567891112',
                'email'            =>  'app@paginawebguatemala.com',
                'pais_id'          =>  1,
                'user_type_id'     =>  1,
                'line_id'          =>  1,
                'colegiado'        =>  null,
                'status_user'      =>  1,
                'password'         =>  Hash::make('FScomunica2'),
                'accepted_terms_version' => '0.1.0',
                'created_at'       =>  (Carbon::now())->toDateTimeString(),
            ],
            [
                'codigo_id'        =>  3,
                'nombres'          =>  'Revisor',
                'apellidos'        =>  'Google',
                'image'            =>  null,
                'numero_documento' =>  '1234567891113',
                'email'            =>  'revisor@gmail.com',
                'pais_id'          =>  1,
                'user_type_id'     =>  2,
                'line_id'          =>  1,
                'colegiado'        => '86334',
                'status_user'      =>  1,
                'password'         =>  Hash::make('FScomunica2'),
                'accepted_terms_version' => '0.1.0',
                'created_at'       =>  (Carbon::now())->toDateTimeString(),
            ],
            [
                'codigo_id'        =>  4,
                'nombres'          =>  'Revisor',
                'apellidos'        =>  'IOS',
                'image'            =>  null,
                'numero_documento' =>  '1234567891114',
                'email'            =>  'revisorios@gmail.com    ',
                // 'codigo_id'        =>  14,
                // 'telefono'         =>  '83323462',
                // 'direccion'        =>  'Ciudad de Guatemala',
                'pais_id'          =>  1,
                'user_type_id'     =>  2,
                'line_id'          =>  1,
                'colegiado'        => '86335',
                'status_user'      =>  1,
                'password'         =>  Hash::make('FScomunica2'),
                'accepted_terms_version' => '0.1.0',
                'created_at'       =>  (Carbon::now())->toDateTimeString(),
            ],
        ];

        DB::table('users')->insert($users);

        User::whereIn('id', [1, 2])->each(fn (User $user) => $user->assignRole('admin'));
        User::whereIn('id', [3, 4])->each(fn (User $user) => $user->assignRole('participant'));

        // Datos de prueba: 300 dependientes y 300 doctores con países aleatorios.
        User::factory()->count(300)->dependiente()->create();
        User::factory()->count(300)->doctor()->create();
    }
}
