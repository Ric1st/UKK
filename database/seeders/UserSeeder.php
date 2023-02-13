<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'username'=>'Admin',
                'password'=>bcrypt('123123'),
                'nama'=>'admin',
                'type'=>1,
            ],
            [
                'username'=>'123123',
                'password'=>bcrypt('123123'),
                'nama'=>'Adi',
                'type'=>2,
            ]
        ];

        foreach ($users as $key =>$user){
            User::create($user);
        }
    }
}
