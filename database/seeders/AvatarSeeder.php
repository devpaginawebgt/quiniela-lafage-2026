<?php

namespace Database\Seeders;

use App\Models\Avatar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AvatarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $avatars = [
            [
                'name'       => 'default',
                'url'        => '/images/avatars/avatar.png',
                'is_default' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => 'male',
                'url'        => '/images/avatars/avatar-m.png',
                'is_default' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => 'female',
                'url'        => '/images/avatars/avatar-f.png',
                'is_default' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        Avatar::insert($avatars);
    }
}
