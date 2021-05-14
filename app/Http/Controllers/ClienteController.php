<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class ClienteController extends Controller
{
    public function index()
    {
        
         $clientes=DB::table('clientes')
                       ->join('municipios', 'municipios.id_municipio', '=', 'clientes.municipio_id')
                       ->join('users',  'users.id','=', 'clientes.user_id')
                       ->select('clientes.*','municipios.nombre','users.name')
                       ->get();
        //return view('clientes.index',compact('clientes'));
        return $clientes;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  User  $users
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
       
    }

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

    public function getUser(Request $request){
        $cliente = Cliente::where('user',$request->user)->first();
        if($cliente != null) {
            $password_dc = $request->password;
            $correcta = strcmp($password_dc, $request->password) == 0;
            if($correcta == null) {
                return null;
            }else {
                return $cliente->remember_token;
            }
        }else{
            return null;
        }
        
    }

}
