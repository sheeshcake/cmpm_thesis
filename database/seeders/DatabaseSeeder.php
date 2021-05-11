<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\User;

use Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            [
                "f_name" => "Admin",
                "l_name" => "Admin",
                "username" => "admin",
                "password" => Hash::make("admin"),
                "role" => "admin",
                "email" => "admin@gmail.com"
            ],
            [
                "f_name" => "expediter",
                "l_name" => "expediter",
                "username" => "expediter",
                "password" => Hash::make("expediter"),
                "role" => "expediter",
                "email" => "expediter@gmail.com"
            ],
            [
                "f_name" => "projectmanager",
                "l_name" => "projectmanager",
                "username" => "projectmanager",
                "password" => Hash::make("projectmanager"),
                "role" => "projectmanager",
                "email" => "projectmanager@gmail.com"
            ],
            [
                "f_name" => "civilengineer",
                "l_name" => "civilengineer",
                "username" => "civilengineer",
                "password" => Hash::make("civilengineer"),
                "role" => "civilengineer",
                "email" => "civilengineer@gmail.com"
            ],
            [
                "f_name" => "foreman",
                "l_name" => "foreman",
                "username" => "foreman",
                "password" => Hash::make("foreman"),
                "role" => "foreman",
                "email" => "foreman@gmail.com"
            ],
        ]);
    }
}
