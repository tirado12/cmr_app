<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\FuentesCliente;
use App\Models\GastosIndirectos;
use App\Models\GastosIndirectosFuentes;
use App\Models\Municipio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class GastosIndirectosFuentesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {     
        
        $gastosIndirectos =GastosIndirectosFuentes::join('fuentes_clientes','fuente_cliente_id','id_fuente_financ_cliente')
        ->join('gastos_indirectos','indirectos_id','id_indirectos')
        ->join('fuentes_financiamientos','fuente_financiamiento_id','id_fuente_financiamiento')
        ->join('clientes','cliente_id','id_cliente')
        ->join('municipios','municipio_id','id_municipio')
        ->select('fuentes_gastos_indirectos.*','fuentes_clientes.ejercicio','gastos_indirectos.nombre as nombre_indirectos','clientes.anio_inicio','clientes.anio_fin','municipios.nombre','fuentes_financiamientos.nombre_corto')
        ->get();

        $fuenteCliente= FuentesCliente::join('clientes','id_cliente','cliente_id')
        ->join('municipios','id_municipio','municipio_id')
        ->join('fuentes_financiamientos','id_fuente_financiamiento','fuente_financiamiento_id')
        ->where('id_fuente_financiamiento',2)
        ->select('clientes.id_cliente','municipios.nombre','ejercicio','fuentes_financiamientos.nombre_corto')
        ->get();   

        $gastos = GastosIndirectos::all();        
      
        //return $fuenteCliente;
        return view('fuentes_gastos.index',compact('gastosIndirectos','fuenteCliente'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $fuenteCliente= FuentesCliente::join('clientes','cliente_id','id_cliente')
        ->join('municipios', 'clientes.municipio_id','municipios.id_municipio')
        ->where('fuente_financiamiento_id', 2)
        ->select('cliente_id','nombre','municipio_id')
        ->get(); //tabla fuenteClientes segun existentes           
        $clientes = $fuenteCliente->unique('municipio_id');
       // return $fuenteCliente;
        $indirectos = GastosIndirectos::all();

         //return $fuenteCliente;
         return view('fuentes_gastos.add_fuentes_gastos',compact('clientes','indirectos'));
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
            'gasto_indirecto' => 'required',
            'fuenteCliente_id' => 'required',
            'monto' => 'required',
        ]);
        GastosIndirectosFuentes::create([
            'indirectos_id' => $request->gasto_indirecto,
            'fuente_cliente_id' => $request->fuenteCliente_id,
            'monto' => str_replace(",", '',$request->monto)
        ]);
        return redirect()->route('gastosIndirectosFuentes.index');
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
    public function edit($id)
    {
        $gastoIndirecto = GastosIndirectosFuentes::join('fuentes_clientes','fuente_cliente_id','id_fuente_financ_cliente')
        ->join('gastos_indirectos','indirectos_id','id_indirectos')
        ->join('fuentes_financiamientos','fuente_financiamiento_id','id_fuente_financiamiento')
        ->join('anexos_fondo3','id_fuente_financ_cliente','fuente_financiamiento_cliente_id')
        ->join('clientes','cliente_id','id_cliente')
        ->join('municipios','municipio_id','id_municipio')
        ->select('fuentes_gastos_indirectos.*','anexos_fondo3.*','fuentes_clientes.ejercicio','gastos_indirectos.nombre as nombre_indirectos','clientes.anio_inicio','clientes.anio_fin','municipios.nombre','fuentes_financiamientos.nombre_corto')
        ->where('id_fuentes_gastos_indirectos', $id)
        ->first();
        //return $gastoIndirecto;
        $indirectos = GastosIndirectos::all();
        //return $gastoIndirecto;
       return view('fuentes_gastos.edit',compact('gastoIndirecto','indirectos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $gasto= GastosIndirectosFuentes::find($id);
        $request->validate([
            //'indirectos_id' => 'required',
            'monto' => 'required',
        ]);
        $request['monto'] = str_replace(",", '', $request['monto']);
        $gasto->update($request->all());
        return redirect()->route('gastosIndirectosFuentes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $gasto= GastosIndirectosFuentes::find($id);
        $gasto->delete();
        return redirect()->route('gastosIndirectosFuentes.index')->with('eliminar','ok');
    }
    //=========================================================
    public function existeRegistro($fuenteCliente, $gastoIndirecto){
        $existeGasto = GastosIndirectosFuentes::where('fuente_cliente_id', $fuenteCliente)
        ->where('indirectos_id', $gastoIndirecto)
        ->exists();
        if($existeGasto == null)
        return 0;
        else
        return 1;
    }
    public function obtenerEjercicios($municipio){
        $consulta= FuentesCliente::join('clientes','cliente_id','id_cliente')
        ->join('anexos_fondo3','id_fuente_financ_cliente','fuente_financiamiento_cliente_id')
        ->join('municipios', 'clientes.municipio_id','municipios.id_municipio')
        ->where('fuente_financiamiento_id', 2)
        ->where('anexos_fondo3.gastos_indirectos',1)
        ->where('municipio_id',$municipio)
        ->select('cliente_id','nombre','ejercicio','id_fuente_financ_cliente','anexos_fondo3.*')
        ->get(); //tabla fuenteClientes segun existentes  
        return $consulta;
    }

    public function montoGastosComprometido($fuente_cliente){
        return GastosIndirectosFuentes::where('fuente_cliente_id',$fuente_cliente)->sum('monto');
    }
    // ================= Funciones API ====================== //
    public function getDesgloseGI($cliente_id, $anio){

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

        return $fuente_gi;
    }
}
