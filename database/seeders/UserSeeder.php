<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
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
        User::create([
            'name' => 'Andy',
            'email' => 'antrick10@gmail.com',
            'password' => bcrypt('123456')
        ])->assignRole('Administrador');
        User::create([
            'name' => 'carlos',
            'email' => 'carlos10@gmail.com',
            'password' => bcrypt('123456')
        ])->assignRole('Administrador');
        User::create([
            'name' => 'roberto',
            'email' => 'roberto10@gmail.com',
            'password' => bcrypt('123456')
        ])->assignRole('Administrador');
        User::create([
            'name' => 'camila',
            'email' => 'camila10@gmail.com',
            'password' => bcrypt('123456')
        ])->assignRole('Administrador');
        User::create([
            'name' => 'ruben',
            'email' => 'ruben10@gmail.com',
            'password' => bcrypt('123456')
        ])->assignRole('Administrador');
        User::create([
            'name' => 'sofia',
            'email' => 'sofia10@gmail.com',
            'password' => bcrypt('123456')
        ])->assignRole('Administrador');
        User::create([
            'name' => 'maria',
            'email' => 'maria10@gmail.com',
            'password' => bcrypt('123456')
        ])->assignRole('Administrador');
        User::create([
            'name' => 'pedro',
            'email' => 'pedro10@gmail.com',
            'password' => bcrypt('123456')
        ])->assignRole('Administrador');
        User::create([
            'name' => 'antonio',
            'email' => 'antonio10@gmail.com',
            'password' => bcrypt('123456')
        ])->assignRole('Administrador');
        User::create([
            'name' => 'lupe',
            'email' => 'lupe10@gmail.com',
            'password' => bcrypt('123456')
        ])->assignRole('Administrador');
        User::create([
            'name' => 'david',
            'email' => 'david10@gmail.com',
            'password' => bcrypt('123456')
        ])->assignRole('Administrador');
        User::create([
            'name' => 'online',
            'email' => 'online10@gmail.com',
            'password' => bcrypt('123456')
        ])->assignRole('Administrador');
        User::create([
            'name' => 'marcelo',
            'email' => 'marcelo10@gmail.com',
            'password' => bcrypt('123456')
        ])->assignRole('Administrador');
        User::create([
            'name' => 'noe',
            'email' => 'noe10@gmail.com',
            'password' => bcrypt('123456')
        ])->assignRole('Administrador');
        User::create([
            'name' => 'erika',
            'email' => 'erika10@gmail.com',
            'password' => bcrypt('123456')
        ])->assignRole('Administrador');
        User::create([
            'name' => 'miriam',
            'email' => 'miriam10@gmail.com',
            'password' => bcrypt('123456')
        ])->assignRole('Administrador');
        User::create([
            'name' => 'julio',
            'email' => 'julio10@gmail.com',
            'password' => bcrypt('123456')
        ])->assignRole('Administrador');
    }
}
