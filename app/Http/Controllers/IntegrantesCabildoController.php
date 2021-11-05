<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\IntegrantesCabildo;
use App\Models\Municipio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class IntegrantesCabildoController extends Controller
{
    //
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $integrantes = IntegrantesCabildo::join('clientes','clientes.id_cliente','=','cliente_id')
        ->select('integrantes_cabildo.*','clientes.id_cliente','clientes.anio_inicio','clientes.anio_fin','clientes.municipio_id')
        ->get();
        //return $integrantes;
        $result = Cliente::join('municipios','id_municipio','municipio_id')->select('id_cliente','nombre','municipio_id')->get();
        $clientes =  $result->unique('municipio_id');
        //return $clientes;
    
        
       return view('cabildo.index',compact('integrantes','clientes'));
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
        //return $request;
        $request->validate([
            'nombre' => 'required',
            'cargo' => 'required',
            'rfc' => 'required|unique:integrantes_cabildo,rfc',
            'cliente' => 'required'
        ]);
        IntegrantesCabildo::create([
            'nombre' => $request->nombre,
            'cargo' => $request->cargo,
            'telefono' => $request->telefono,
            'correo' => $request->correo,
            'rfc' => $request->rfc,
            'cliente_id' => $request->cliente
        ]);
        return redirect()->route('cabildo.index');
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
    public function edit(IntegrantesCabildo $integrante)
    {
       $municipioCliente = IntegrantesCabildo::join('clientes','clientes.id_cliente','=','cliente_id')
        ->select('clientes.municipio_id','clientes.anio_inicio','clientes.anio_fin')
        ->where('id_integrante', $integrante->id_integrante)
        ->first();
        
        //$municipioCliente= Municipio::find(Cliente::find($integrante->cliente_id)->municipio_id);

        //$clientes = Municipio::join('clientes','municipio_id','id_municipio')->select('id_cliente','nombre','municipio_id')->get();
        $result = Cliente::join('municipios','id_municipio','municipio_id')->select('id_cliente','nombre','municipio_id')->get();
        $clientes =  $result->unique('municipio_id');
        //return $clientes;
        //$disponibles = IntegrantesCabildo::join('clientes','id_cliente','cliente_id')
        //->where('id_integrante', $integrante->id_integrante)
        //->select('id_integrante','id_cliente','anio_inicio','anio_fin','municipio_id')
        //->first();
        //return $municipioCliente;
       return view('cabildo.edit',compact('integrante','clientes','municipioCliente'));
        
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, IntegrantesCabildo $integrante)
    {
        $request->validate([
            'nombre' => 'required',
            'cargo' => 'required',
            'rfc' => ['required',Rule::unique('integrantes_cabildo')->ignore($integrante)],
            'cliente_id' => 'required'
        ]);
        $integrante->update($request->all());
        return redirect()->route('cabildo.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(IntegrantesCabildo $integrante)
    {
        $integrante->delete();
        return redirect()->route('cabildo.index')->with('eliminar','ok');
    }

    //===============================================================

    // public function existeRfc($rfc){
    //     $existe = IntegrantesCabildo::where('rfc',$rfc)->exists();
    //     if ($existe == null)
    //     return 0;
    //     else
    //     return $existe;
    // }


    public function ejerciciosCabildo($municipio){
        $result= Cliente::join('municipios', 'id_municipio','municipio_id')->select('id_cliente','municipio_id','anio_inicio','anio_fin')
        //->join('integrantes_cabildo','id_cliente','cliente_id')}
        ->where('id_municipio',$municipio)
        ->get();
        return $result;
    }
}
