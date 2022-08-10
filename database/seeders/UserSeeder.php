<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;
use App\Models\Cliente;

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
            'name' => 'Juan',
            'lastname' => 'Sanchez',
            'email' => 'jose@gmail.com',
            'password' => bcrypt('12345678'),
            'area' => 'Dirección General',
            'img' => '/image/anonimo.jpg',
            'remember_token' => Str::random(100)
        ])->assignRole('Administrador');

        User::create([
            'name' => 'Andy',
            'lastname' => 'Mota Moreno',
            'email' => 'antrick10@gmail.com',
            'password' => bcrypt('12345678'),
            'area' => 'Infraestructura',
            'img' => '/image/anonimo.jpg',
            'remember_token' => Str::random(100)
        ])->assignRole('Administrador');
        User::create([
            'name' => 'Carlos',
            'lastname' => 'Rodriguez',
            'email' => 'carlos10@gmail.com',
            'password' => bcrypt('12345678'),
            'area' => 'Gubernamental',
            'img' => '/image/anonimo.jpg',
            'remember_token' => Str::random(100)
        ])->assignRole('Usuario');
        
        // Cliente::create([
        //     'user' => 'oaxaca',
        //     'email' => 'oaxaca@gmail.com',
        //     'password' => bcrypt('12345678'),
        //     'anio_inicio' => '2021-01-01',
        //     'anio_fin' => '2022-12-31',
        //     'logo' => 'http://127.0.0.1:8000/uploads/img-1.png',
        //     'municipio_id' => '67'
        // ]);
        // Cliente::create([
        //     'user' => 'barrio',
        //     'email' => 'barrio@gmail.com',
        //     'password' => bcrypt('12345678'),
        //     'anio_inicio' => '2021-01-01',
        //     'anio_fin' => '2022-12-31',
        //     'logo' => 'http://127.0.0.1:8000/uploads/img-1.png',
        //     'municipio_id' => '10'
        // ]);
        // Cliente::create([
        //     'user' => 'oaxaca1',
        //     'email' => 'oaxaca1@gmail.com',
        //     'password' => bcrypt('12345678'),
        //     'anio_inicio' => '2023-01-01',
        //     'anio_fin' => '2024-12-31',
        //     'logo' => 'http://127.0.0.1:8000/uploads/img-1.png',
        //     'municipio_id' => '67'
        // ]);
        // Cliente::create([
        //     'user' => 'abejones',
        //     'email' => 'abejones@gmail.com',
        //     'password' => bcrypt('12345678'),
        //     'anio_inicio' => '2021-01-01',
        //     'anio_fin' => '2022-12-31',
        //     'logo' => 'http://127.0.0.1:8000/uploads/img-1.png',
        //     'municipio_id' => '1'
        // ]);
       /* $cliente= new Cliente();
        $cliente ->anio_inicio = 2020;
        $cliente ->anio_fin = 2022;
        $cliente ->logo = "modifica_el_logo";
        $cliente ->id_onesignal = 1;
        $cliente ->user_id = 1;
        $cliente ->municipio_id = 10;
        $cliente->save();*/
    }
}
