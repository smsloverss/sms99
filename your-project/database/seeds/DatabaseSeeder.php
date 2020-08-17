<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = new \App\User;

        $user->name = 'admin';
        $user->email = 'admin@admin.com';
        $user->password = Hash::make('admin');
        $user->save();
    }
}
