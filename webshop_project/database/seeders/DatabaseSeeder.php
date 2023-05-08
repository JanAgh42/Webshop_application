<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $admin = new Admin();

        $admin->id = Str::uuid();
        $admin->email = 'test@gmail.com';
        $admin->password = Hash::make("password"); // password

        $admin->save();
    }
}
