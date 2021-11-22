<?php

namespace App\Http\Controllers;

use App\Models\ComprometidoDesglose;
use App\Models\ProdimComprometido;
use Illuminate\Http\Request;

class ComprometidoDesgloseController extends Controller
{
    //
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $comprometidoDesglose = ComprometidoDesglose::all();
         $prodimComprometido= ProdimComprometido::join('prodim','prodim_id','id_prodim')
        ->join('fuentes_clientes','fuente_id','id_fuente_financ_cliente')
        ->join('clientes','cliente_id','id_cliente')
        ->join('municipios','municipio_id','id_municipio')
        ->get();
        return view('comprometido_desglose.index',compact('prodimComprometido','comprometidoDesglose'));
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
          'comprometido_id' => 'required|unique:comprometido_desglose,comprometido_id',
          'concepto' => 'required',
          'monto' => 'required'
      ],
      ['comprometido_id.unique' => 'Ya existe un registro similar de desglose similar']);
      $request->monto = str_replace(",", '',$request->monto);
      ComprometidoDesglose::create([
          'comprometido_id' => $request->comprometido_id,
          'concepto' => $request->concepto,
          'monto' => $request->monto
      ]);
      return redirect()->route('comprometidoDesglose.index');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return ProdimComprometido::join('prodim','prodim_id','id_prodim')
        ->join('fuentes_clientes','fuente_id','id_fuente_financ_cliente')
        ->join('clientes','cliente_id','id_cliente')
        ->join('municipios','municipio_id','id_municipio')
        ->where('cliente_id',2)
        ->get();
    }
     /**
     * Show the form for editing the specified resource.
     *
     * @param  User  $users
     * @return \Illuminate\Http\Response
     */
    public function edit(ComprometidoDesglose $comprometidoDesglose)
    {
        $prodimComprometido= ProdimComprometido::join('prodim','prodim_id','id_prodim')
        ->join('fuentes_clientes','fuente_id','id_fuente_financ_cliente')
        ->join('clientes','cliente_id','id_cliente')
        ->join('municipios','municipio_id','id_municipio')
        ->where('id_comprometido', $comprometidoDesglose->comprometido_id)
        ->get();
        return view('comprometido_desglose.edit',compact('prodimComprometido','comprometidoDesglose'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ComprometidoDesglose $comprometidoDesglose)
    {
        $request->validate([
            'concepto' => 'required',
            'monto' => 'required'
        ]);
        $request['monto'] = str_replace(",", '',$request->monto);
        $comprometidoDesglose->update($request->all());
        return redirect()->route('comprometidoDesglose.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ComprometidoDesglose $comprometidoDesglose)
    {
        $comprometidoDesglose->delete();
        return redirect()->route('comprometidoDesglose.index')->with('eliminar','ok');
    }

    function ejerciciosProdimComprometido($cliente){
        return ProdimComprometido::join('prodim','prodim_id','id_prodim')
        ->join('fuentes_clientes','fuente_id','id_fuente_financ_cliente')
        ->join('clientes','cliente_id','id_cliente')
        ->join('municipios','municipio_id','id_municipio')
        ->where('cliente_id', $cliente)
        ->select('id_comprometido','ejercicio')
        ->get();
    }
}
