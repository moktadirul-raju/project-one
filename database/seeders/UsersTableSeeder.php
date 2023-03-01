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
            'name' => 'User One',
            'email' => 'userone@mail.com',
            'mobile' => '01236598874',
            'password' => Hash::make('123456')
        ]);

        User::insert([
            'name' => 'User Two',
            'email' => 'usertwo@mail.com',
            'mobile' => '01236598875',
            'password' => Hash::make('123456')
        ]);
    }
}
