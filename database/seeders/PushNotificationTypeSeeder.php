<?php

namespace Database\Seeders;

use App\Models\PushNotificationType;
use Illuminate\Database\Seeder;

class PushNotificationTypeSeeder extends Seeder
{
    public function run(): void
    {
        $types = [
            ['name' => 'Administrador', 'slug' => PushNotificationType::ADMIN],
        ];

        foreach ($types as $type) {
            PushNotificationType::updateOrCreate(['slug' => $type['slug']], $type);
        }
    }
}
