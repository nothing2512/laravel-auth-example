<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        User::query()->create([
            'name' => "Super Admin",
            'email' => "super@admin.id",
            'email_verified_at' => now(),
            'password' => 'superadmin',
            'remember_token' => Str::random(10),
        ]);
    }
}
