<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create a new user
        $user = User::create([
            'name' => 'Juliush',
            'email' => 'juliush@gmail.com',
            'password' => Hash::make('12345678') // Hashing the password
        ]);

        // Generate a token for the user
        $token = $user->createToken('myapptoken')->plainTextToken;

        // Output the token to the console (optional)
        $this->command->info("User created with email: {$user->email}");
        $this->command->info("Token: {$token}");
    }
}
