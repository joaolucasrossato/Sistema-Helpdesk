<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
    ['email' => 'admin@helpdesk.com'],
    ['name' => 'Admin', 'password' => bcrypt('password')]
);

        $this->call([
            CategorySeeder::class,
            TicketSeeder::class,
        ]);
    }
}
