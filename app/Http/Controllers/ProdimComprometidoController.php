<?php

namespace App\Http\Controllers;

use App\Models\ComprometidoDesglose;
use App\Models\Prodim;
use App\Models\ProdimCatalogo;
use App\Models\ProdimComprometido;
use Illuminate\Http\Request;

class ProdimComprometidoController extends Controller
{
    //
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $prodimComprometidos= ProdimComprometido::all();
        $prodimCatalogo = ProdimCatalogo::all();
        
        $prodims= Prodim::join('fuentes_clientes','fuente_id','id_fuente_financ_cliente')
        ->join('clientes','id_cliente','cliente_id')
        ->join('municipios','id_municipio','municipio_id')
        ->select('id_prodim','id_municipio','cliente_id','nombre','ejercicio')
        ->get();
        
        return view('prodim_comprometido.index', compact('prodimComprometidos','prodims','prodimCatalogo'));
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
        $valido=$request->validate([ 
            'prodim_catalogo_id' => 'required',
            'prodim_id' => 'required|unique:prodim_comprometido,prodim_id',
            'fecha_comprometido' => 'required',
            'monto' => 'required'
        ],
        [ 'prodim_id.unique' => 'Ya existe un registro prodim con este cliente y ejercicio.']);
        $request->monto = str_replace(",", '',$request->monto);
        ProdimComprometido::create([
            'prodim_catalogo_id' => $request->prodim_catalogo_id,
            'prodim_id' => $request->prodim_id,
            'fecha_comprometido' => $request->fecha_comprometido,
            'monto' => $request->monto
        ]);

        if($valido==false){
            return redirect()->route('prodimComprometido.index')->withInput();
        }else{
            return redirect()->route('prodimComprometido.index');
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
        
    }
     /**
     * Show the form for editing the specified resource.
     *
     * @param  User  $users
     * @return \Illuminate\Http\Response
     */
    public function edit(ProdimComprometido $prodimComprometido)
    {
        $prodimCatalogo = ProdimCatalogo::all();
        $prodim = Prodim::join('fuentes_clientes','fuente_id','id_fuente_financ_cliente')
        ->join('clientes','id_cliente','cliente_id')
        ->join('municipios','id_municipio','municipio_id')
        ->where('id_prodim',$prodimComprometido->prodim_id)
        ->select('id_prodim','ejercicio','nombre')
        ->get();
        return view('prodim_comprometido.edit', compact('prodimComprometido','prodimCatalogo','prodim'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProdimComprometido $prodimComprometido)
    {
        $valido=$request->validate([ 
            'prodim_catalogo_id' => 'required',
            'prodim_id' => 'required',
            'fecha_comprometido' => 'required',
            'monto' => 'required'
        ]);
        $request['monto'] = str_replace(",", '',$request->monto);
        $prodimComprometido->update($request->all());
        return redirect()->route('prodimComprometido.index');
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProdimComprometido $prodimComprometido)
    {
        $existeComprometido =ComprometidoDesglose::where('comprometido_id', $prodimComprometido->id_comprometido)->exists();
        if($existeComprometido == null){ //si no hay existe
            $prodimComprometido->delete();   
            return redirect()->route('prodimComprometido.index')->with('eliminar','ok');
        }else{
            return redirect()->route('prodimComprometido.index')->with('eliminar','error');
        }
    }

//=================================================================

    function ejerciciosClientesProdim($cliente){
       return $ejercicios= Prodim::join('fuentes_clientes','fuente_id','id_fuente_financ_cliente')
        ->join('clientes','id_cliente','cliente_id')
        ->where('id_cliente',$cliente)
        ->select('prodim.*','ejercicio')
        ->get();
        
    }
}
