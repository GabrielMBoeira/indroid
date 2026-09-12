<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::query()->updateOrCreate(
            ['email' => 'gabrielmboeira@gmail.com'],
            [
                'name' => 'Administrador',
                'phone' => '(48) 99999.0001',
                'password' => 'password',
                'status' => 'active',
                'is_admin' => true,
            ]
        );

        User::query()->updateOrCreate(
            ['email' => 'demo@indroid.com.br'],
            [
                'name' => 'Demo',
                'phone' => '(48) 99999.0002',
                'password' => 'password',
                'status' => 'active',
                'is_admin' => false,
            ]
        );

        User::query()->updateOrCreate(
            ['email' => 'pendente@indroid.com.br'],
            [
                'name' => 'Pendente',
                'phone' => '(48) 99999.0003',
                'password' => 'password',
                'status' => 'pending',
                'is_admin' => false,
            ]
        );
    }
}
