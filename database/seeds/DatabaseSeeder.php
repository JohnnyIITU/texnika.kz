<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'email' => 'admin@texnika.kz',
            'role' => env('ADMIN_LOGIN'),
            'password' => crypt(env('ADMIN_PASSWORD'), time())
        ]);
    }
}
