<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            'name' => 'Moktadirul Raju',
            'email' => 'moktadirulraju@gmail.com',
            'password' => Hash::make('123456')
        ]);

        User::insert([
            'name' => 'Md Raju',
            'email' => 'raju@gmail.com',
            'password' => Hash::make('123456')
        ]);
    }
}
