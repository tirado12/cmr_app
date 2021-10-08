<?php

namespace App\Http\Controllers;

use App\Models\IntegrantesCabildo;
use App\Models\Municipio;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\In;

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
        ->select('integrantes_cabildo.*','clientes.municipio_id')
        ->get();
        
        $municipios = Municipio::all();
        
       return view('cabildo.index',compact('integrantes','municipios'));
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
        $request->validate([
            'nombre' => 'required',
            'cargo' => 'required',
            
            'correo' => 'required',
            'rfc' => 'required',
            'municipio' => 'required'
        ]);
        IntegrantesCabildo::create([
            'nombre' => $request->nombre,
            'cargo' => $request->cargo,
            'telefono' => $request->telefono,
            'correo' => $request->correo,
            'rfc' => $request->rfc,
            'municipio_id' => $request->municipio
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
        ->select('clientes.municipio_id')
        ->where('id_integrante', $integrante->id_integrante)
        ->first();

        //return $municipioCliente;
        $municipios = Municipio::all();
       return view('cabildo.edit',compact('integrante','municipios','municipioCliente'));
        
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
            
            'correo' => 'required',
            'rfc' => 'required',
            'municipio' => 'required'
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
}
