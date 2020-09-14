<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'name'           => 'Test Admin',
            'email'          => 'test@test.com',
            'password'       => Hash::make('password'),
            'remember_token' => Str::random(10)
        ]);
    }
}
