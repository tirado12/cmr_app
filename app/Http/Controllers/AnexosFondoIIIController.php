<?php

namespace App\Http\Controllers;

use App\Models\AnexosFondoIII;
use Illuminate\Http\Request;

class AnexosFondoIIIController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $anexos = AnexosFondoIII::join('fuentes_clientes','id_fuente_financ_cliente','fuente_financiamiento_cliente_id')
        ->join('clientes','id_cliente','cliente_id')
        ->join('municipios','id_municipio','municipio_id')
        ->select('anexos_fondo3.*','municipios.nombre','fuentes_clientes.ejercicio')
        ->get();

        //return $anexos;
        return view('anexoIII.index',compact('anexos'));
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
    public function edit(AnexosFondoIII $anexo)
    {
        $anexos = AnexosFondoIII::join('fuentes_clientes','id_fuente_financ_cliente','fuente_financiamiento_cliente_id')
        ->join('clientes','id_cliente','cliente_id')
        ->join('municipios','id_municipio','municipio_id')
        ->select('anexos_fondo3.*','municipios.nombre','fuentes_clientes.ejercicio')
        ->where('id_anexos_fondo3', $anexo->id_anexos_fondo3)
        ->first();
        //return $anexos;
       return view('anexoIII.edit', compact('anexos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AnexosFondoIII $anexo)
    {
       if($request['prodim']==null){
            $request['prodim']=false;
       }else{
            $request['prodim']=true;
       }
       if($request['gastos_indirectos']==null){
        $request['gastos_indirectos']=false;
   }else{
        $request['gastos_indirectos']=true;
   }
        $anexo->update($request->all());
       return redirect()->route('anexos.index');
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
