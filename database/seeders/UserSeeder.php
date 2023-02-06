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
                'nip'=>'001',
                'name'=>'Admin',
                'email'=>'admin@admin.com',
                'password'=>bcrypt('123123'),
                'type'=>1,
            ],
            [
                'nip'=>'002',
                'name'=>'Pelajar',
                'email'=>'pelajar@pelajar.com',
                'password'=>bcrypt('123123'),
                'type'=>0,
            ],
            [
                'nip'=>'003',
                'name'=>'Guru',
                'email'=>'guru@guru.com',
                'password'=>bcrypt('123123'),
                'type'=>2,
            ],
        ];

        foreach ($users as $key =>$user){
            User::create($user);
        }
    }
}
