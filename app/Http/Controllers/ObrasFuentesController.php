<?php

namespace App\Http\Controllers;

use App\Models\FuentesCliente;
use App\Models\Obra;
use App\Models\ObrasFuentes;
use Illuminate\Http\Request;

class ObrasFuentesController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $obrasFuentes = ObrasFuentes::join('fuentes_clientes','fuente_financiamiento_cliente_id','id_fuente_financ_cliente')
        ->join('clientes','cliente_id','id_cliente')
        ->join('municipios','municipio_id','id_municipio')
        ->join('obras','id_obra','obra_id')
        ->select('obras_fuentes.*','municipios.nombre','ejercicio','nombre_corto')
        ->get();
        $clientesDisponibles= FuentesCliente::join('clientes','cliente_id','id_cliente')
        ->join('municipios','municipio_id','id_municipio')
        ->where('fuente_financiamiento_id',2)
        ->select('id_municipio','nombre')
        ->get();
        //return $obrasFuentes;
        $obras= Obra::select('id_obra','nombre_corto')->get();
        return view('obras_fuentes.index',compact('obrasFuentes','clientesDisponibles','obras'));
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
            'fuenteCliente_id' => 'required',
            'id_obra' => 'required',
            'monto' => 'required',
        ]);
        ObrasFuentes::create([
            'fuente_financiamiento_cliente_id' => $request->fuenteCliente_id,
            'obra_id' => $request->id_obra,
            'monto' => $request->monto
        ]);
        return redirect()->route('obrasFuentes.index');
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
    public function edit()
    {
       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        
    }
}
