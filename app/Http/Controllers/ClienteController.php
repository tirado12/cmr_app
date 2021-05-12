<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\User;
use CreateEstadoTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class ClienteController extends Controller
{
    //

    public function getCliente($id){
        $cliente = Cliente::where('id_cliente', $id)->join('municipios', 'municipios.id_municipio', '=', 'clientes.municipio_id')->join('distritos',  'distrito_id','=', 'distritos.id_distrito')->select('id_cliente', 'rfc', 'direccion', 'distritos.nombre as nombre_distrito', 'municipios.nombre as nombre_municipio', 'anio_inicio', 'anio_fin', 'logo')->get();
        return $cliente;
    }

    public function getUsuario($user, $password){
        $user = User::where('name',$user)->first();
        if($user != null) {
            $password_dc = Crypt::decrypt($user->password);
            $correcta = strcmp($password_dc, $password) == 0;
            if($correcta == null) {
                return null;
            }else {
                $cliente = Cliente::where('user_id', $user->id)->join('users', 'users.id', '=', 'clientes.user_id')->select('id_cliente', 'remember_token')->get();
                return $cliente;
            }
            
        }else {
            return null;
        }
    }
    public function getUsuarioToken($token){
        $user = User::where('remember_token',$token)->first();
        if($user != null) {0;
            $cliente = Cliente::where('user_id', $user->id)->join('users', 'users.id', '=', 'clientes.user_id')->select('id_cliente', 'remember_token')->get();
            return $cliente;
        }else {
            return null;
        }
    }

}
