<?php

namespace App\Http\Controllers;

use App\Models\FuentesCliente;
use App\Models\Prodim;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProdimController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fuenteCliente= FuentesCliente::join('clientes','cliente_id','id_cliente')
        ->join('municipios', 'clientes.municipio_id','municipios.id_municipio')
        ->where('fuente_financiamiento_id', 2)
        ->select('cliente_id','nombre','municipio_id')
        ->get(); //tabla fuenteClientes segun existentes           
        $clientes = $fuenteCliente->unique('municipio_id');

        $consulta= FuentesCliente::join('clientes','cliente_id','id_cliente')
        ->join('municipios', 'clientes.municipio_id','municipios.id_municipio')
        ->where('fuente_financiamiento_id', 2)
        ->where('municipio_id',10)
        ->select('cliente_id','nombre','ejercicio','id_fuente_financ_cliente')
        ->get(); //tabla fuenteClientes segun existentes  

        //return $clientes;
        return view('prodim.index', compact('clientes'));
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
      return $request;
      $request->validate([
        'firma_electronica' => 'required',
        'revisado' => 'required',
        'fuenteCliente_id' => 'required',
      ]);
      Prodim::create([
          'firma_electronica' => $request->firma_electronica,
          'revisado' => $request->revisado,
          'fecha_revisado' => $request->fecha_revisado,
          'validado' => $request->validado,
          'fecha_validado' => $request->fecha_validado,
          'convenio' => $request->convenio, //modificar porque recibe checkslists
      ]);
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
    // ================================ Funciones API ========================================= //
    public function getDesgloseProdim($cliente_id, $anio){

        $fuente_prodim = DB::table('fuentes_clientes')
            ->orWhere(function($query) use($cliente_id, $anio) {
                $query->where('cliente_id', $cliente_id)
                    ->where('ejercicio',$anio)
                    ->where('fuente_financiamiento_id',2);
            })
            ->join('prodim', 'prodim.fuente_id', '=', 'id_fuente_financ_cliente')
            ->select('firma_electronica','revisado','validado','convenio','id_prodim')
            ->get();
        $prodim_id = $fuente_prodim->first()->id_prodim;
        $fuente_comprometido = DB::table('prodim_comprometido')
            ->orWhere(function($query) use($prodim_id) {
                $query->where('prodim_id', $prodim_id);
            })
            ->join('prodim_catalogo', 'prodim_catalogo.id_prodim_catalogo', '=', 'prodim_catalogo_id')
            ->select('nombre','monto')
            ->get();
        $fuente_desglose = DB::table('prodim_comprometido')
            ->orWhere(function($query) use($prodim_id) {
                $query->where('prodim_id', $prodim_id);
            })
            ->join('prodim_catalogo', 'prodim_catalogo.id_prodim_catalogo', '=', 'prodim_catalogo_id')
            ->join('comprometido_desglose', 'comprometido_desglose.comprometido_id', '=', 'id_comprometido')
            ->select('nombre','concepto','comprometido_desglose.monto')
            ->get();
        
        $fuente_gi = DB::table('fuentes_clientes')
            ->orWhere(function($query) use($cliente_id, $anio) {
                $query->where('cliente_id', $cliente_id)
                    ->where('ejercicio',$anio)
                    ->where('fuente_financiamiento_id',2);
            })
            ->join('fuentes_gastos_indirectos', 'fuentes_gastos_indirectos.fuente_cliente_id', '=', 'id_fuente_financ_cliente')
            ->join('gastos_indirectos','gastos_indirectos.id_indirectos','=','indirectos_id')
            ->select('nombre','monto')
            ->get();


        $resources = array(
                'prodim' => $fuente_prodim,
                'comprometido' => $fuente_comprometido,
                'desglose' => $fuente_desglose,
                'gastos' => $fuente_gi
                );
                return [$resources];
    }
}
