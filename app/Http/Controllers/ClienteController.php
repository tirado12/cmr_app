<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\FuentesCliente;
use App\Models\Municipio;
use App\Models\User;
use App\Models\Registro;
use Facade\FlareClient\Http\Client;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientes = Cliente::with('municipio')->get();
        
        $municipios = Municipio::all();
        //return $clientes;
        return view('cliente.index', compact('clientes', 'municipios'));
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
        //validacion de fechas (periodo)   
        $existefecha = Cliente::where(function ($q) use ($request) {
            $q->where('anio_inicio', '>=', $request->anio_inicio) //fecha ini es mayor igual a inicio que ingresa
                ->where('anio_inicio', '<=', $request->anio_fin)//fecha ini es menor igual a fin que ingresa
                ->where('municipio_id', $request->municipio_id); 
        })
        ->orWhere(function ($q) use ($request) {
            $q->where('anio_fin', '>=', $request->anio_inicio) //fecha fin es mayor igual a inicio que ingresa
                ->where('anio_fin', '<=', $request->anio_fin)//fecha fin es menor igual a fin que ingresa
                ->where('municipio_id', $request->municipio_id); 
        })
        ->orWhere(function ($q) use ($request) {
            $q->where('anio_inicio', '<', $request->anio_inicio) //fecha ini es menor que inicio que ingresa
                ->where('anio_fin', '>', $request->anio_fin)//fecha fin es mayor que fin que ingresa
                ->where('municipio_id', $request->municipio_id); 
        })
        ->get();
        
        $error = '';
        $valido= '';
        if(count($existefecha) == 0){
            $cliente = new Cliente;
            $cliente->user = $request->user;
            $cliente->email = $request->email;
            $cliente->anio_inicio = $request->anio_inicio;
            $cliente->anio_fin = $request->anio_fin;
            $cliente->municipio_id = $request->municipio_id;
            $cliente->password = bcrypt($request->password);
            $valido= $request->validate([
             'user' => 'required',
             'email' => 'required',
             'anio_inicio' => 'required',
             'anio_fin' => 'required',
             'municipio_id' => 'required',
             'password' => ['required', 'min:8', 'regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/', 'confirmed']
             ]);
             $cliente->save();
             $file = new Filesystem();
            if( $file->isDirectory(public_path("municipios\\").$request->municipio_id.'\\'.$cliente->id_cliente) ){

            }else{
                $file->makeDirectory(public_path("municipios\\").$request->municipio_id.'\\'.$cliente->id_cliente,0777, true); //creamos las carpetas con ruta dinamica
            }
            if (!empty($request->file('file'))) {
                $file = $request->file('file');
                //Move Uploaded File
                $destinationPath = public_path("municipios\\").$request->municipio_id.'\\'.$cliente->id_cliente;
                $file->move($destinationPath, $file->getClientOriginalName());
                $destinationPath = "municipios\\".$request->municipio_id.'\\'.$cliente->id_cliente.'\\'. $file->getClientOriginalName();
                $logo = $destinationPath;
            }
            $cliente->logo = $logo;           
            $cliente->url= '\\'.$request->municipio_id.'\\'.$cliente->id_cliente;
            $cliente->update();
        }else{
            $error = 'repeat';
        }
       
        if($valido==false || $error == 'repeat'){
            return redirect()->route('clientes.index')->withInput()->with('error', $error);
        }else{
            return redirect()->route('clientes.index')->with('error', $error);
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //return view('cliente.ver');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  User  $users
     * @return \Illuminate\Http\Response
     */
    public function edit(Cliente $cliente)
    {
        $municipios = Municipio::all();
        return view('cliente.edit', compact('cliente', 'municipios'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cliente $cliente)
    {
        
        // $anioIni = Cliente::where('id_cliente', '!=', $cliente->id_cliente)->where('municipio_id',$request->municipio_id)->whereYear('anio_inicio',$request->anio_inicio)->first();
        // $anioFin = Cliente::where('id_cliente', '!=', $cliente->id_cliente)->where('municipio_id',$request->municipio_id)->whereYear('anio_fin',$request->anio_fin)->first();
        // $finInicio = Cliente::where('id_cliente', '!=', $cliente->id_cliente)->where('municipio_id',$request->municipio_id)->whereYear('anio_inicio',$request->anio_fin)->first();
        // $inicioFin = Cliente::where('id_cliente', '!=', $cliente->id_cliente)->where('municipio_id',$request->municipio_id)->whereYear('anio_fin', $request->anio_inicio)->first();
        $existefecha = Cliente::where(function ($q) use ($request) {
            $q->where('anio_inicio', '>=', $request->anio_inicio) //fecha ini es mayor igual a inicio que ingresa
                ->where('anio_inicio', '<=', $request->anio_fin)//fecha ini es menor igual a fin que ingresa
                ->where('municipio_id', $request->municipio_id); 
        })
        ->orWhere(function ($q) use ($request) {
            $q->where('anio_fin', '>=', $request->anio_inicio) //fecha fin es mayor igual a inicio que ingresa
                ->where('anio_fin', '<=', $request->anio_fin)//fecha fin es menor igual a fin que ingresa
                ->where('municipio_id', $request->municipio_id); 
        })
        ->orWhere(function ($q) use ($request) {
            $q->where('anio_inicio', '<', $request->anio_inicio) //fecha ini es menor que inicio que ingresa
                ->where('anio_fin', '>', $request->anio_fin)//fecha fin es mayor que fin que ingresa
                ->where('municipio_id', $request->municipio_id); 
        })
        ->get();

        $error='';
        if(count($existefecha) == 0){
            if (empty($request['password'])) {
                $request['password'] = $cliente->password;
            } else {
                $request['password'] = bcrypt($request['password']);
            }
            $request->validate([
                'user' => 'required',
                'email' => 'required|email',
                'anio_inicio' => 'required',
                'anio_fin' => 'required',
                
                'municipio_id' => 'required',
                'password' => 'required',
            ]);

            $cliente->user = $request['user'];
            $cliente->email = $request['email'];
            $cliente->anio_inicio = $request['anio_inicio'];
            $cliente->anio_fin = $request['anio_fin'];
            $cliente->municipio_id = $request['municipio_id'];
            $cliente->password = $request['password'];

            if (!empty($request->file('file'))) {
                $file = $request->file('file');
                //Move Uploaded File
                File::delete(public_path($cliente->logo));
                $destinationPath = public_path("municipios\\").$request->municipio_id.'\\'.$cliente->id_cliente;
                $file->move($destinationPath, $file->getClientOriginalName());
                $destinationPath = "municipios\\".$request->municipio_id.'\\'.$cliente->id_cliente.'\\'. $file->getClientOriginalName();
                $logo = $destinationPath;
            }else{
                $logo = $cliente->logo;
            }
            $cliente->logo = $logo;
            $cliente->update();

        }else{
            $error = 'repeat';
        }
       
        if($error == 'repeat'){
            return redirect()->route('clientes.index')->with('error', $error);
        }else{
            return redirect()->route('clientes.index');
        }

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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function userCliente(Request $request)
    {
        $cliente = Cliente::where('user', $request->user)->count();  
        return $cliente;
    }

    public function emailCliente(Request $request)
    {
        $cliente = Cliente::where('email', $request->email)->count();  
        return $cliente;
    }

    //============================= funciones ajax ============================

    public function clienteXejercicio($id_municipio){
        $disponibles = Cliente::where('municipio_id',$id_municipio)->select('id_cliente','anio_inicio','anio_fin','municipio_id')->get();
        return $disponibles;
    }


    // ============================= Funciones API ============================= //

    public function getCliente($id)
    {
        $cliente = Cliente::find($id)
            ->join('municipios', 'municipios.id_municipio', '=', 'clientes.municipio_id')
            ->join('distritos', 'distrito_id', '=', 'distritos.id_distrito')
            ->select('id_cliente', 'rfc', 'direccion', 'distritos.nombre as nombre_distrito', 'municipios.nombre as nombre_municipio', 'municipios.id_municipio as clave', 'anio_inicio', 'anio_fin', 'logo')
            ->get();
        return $cliente;
    }

    public function getUsuario($user, $password, $id_OneSignal)
    {
        $user = strtolower($user);
        $user = Cliente::where('user', $user)->first();

        if ($user != null) {
            //$password_dc = Crypt::decrypt($user->password);
            //$correcta = strcmp($password_dc, $password) == 0;
            if (Hash::check($password, $user->password)) {
                if ($password == null) {
                    return null;
                } else {

                    $cliente = Cliente::find($user->id_cliente)
                        ->select('id_cliente', 'remember_token')->get();
                    return $cliente;
                    $cliente_up = Cliente::find($cliente->id_cliente);
                    $cliente_up->id_onesignal = $id_OneSignal;
                    $cliente_up->save();
                    return $cliente;
                }
            }
        } else {
            return null;
        }
    }
    public function getUsuarioToken($token)
    {
        $user = Cliente::where('remember_token', $token)->first();
        if ($user != null) {
            $cliente = Cliente::find($user->id_cliente)->select('id_cliente', 'remember_token')->get();
            return $cliente;
        } else {
            return null;
        }
    }

    function ver($id){
        
        $cliente = Cliente::where('id_cliente', $id)
        ->join('municipios', 'municipios.id_municipio', '=', 'municipio_id')
        ->join('distritos', 'distritos.id_distrito', '=', 'distrito_id')
        ->join('regiones', 'regiones.id_region', '=', 'region_id')
        ->select('municipios.nombre as nombre_municipio', 'distritos.nombre as nombre_distrito', 'regiones.nombre as nombre_region', 'logo', 'rfc', 'direccion', 'email', 'anio_inicio', 'anio_fin', 'id_municipio', 'id_distrito', 'id_region', 'id_cliente')
        ->first();

        $cabildo = IntegrantesCabildo::where('cliente_id', $id)->get();

        

        //return $cabildo;
        
        return view('cliente.ver', compact('cliente', 'cabildo'));
    }

}
