<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;

class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
               'name'=>'Anto',
               'email'=>'ra@gmail.com',
               'type'=>0,
               'password'=> bcrypt('12345678'),
            ],
            [
               'name'=>'Ucok',
               'email'=>'sd@gmail.com',
               'type'=> 1,
               'password'=> bcrypt('12345678'),
            ],
            [
               'name'=>'Kudut',
               'email'=>'smp@gmail.com',
               'type'=>2,
               'password'=> bcrypt('12345678'),
            ],
            [
               'name'=>'Azlan',
               'email'=>'yys@gmail.com',
               'type'=>3,
               'password'=> bcrypt('12345678'),
            ],
        ];
    
        foreach ($users as $key => $user) {
            User::create($user);
        }
    }
}
