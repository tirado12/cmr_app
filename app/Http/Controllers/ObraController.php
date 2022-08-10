<?php

namespace App\Http\Controllers;

use App\Custom\Ejemplo as CustomNotification;
use App\Models\Obra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ObraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $obras = Obra::join('obras_fuentes','id_obra','obra_id')->join('fuentes_clientes','id_fuente_financ_cliente','fuente_financiamiento_cliente_id')
        ->join('clientes','id_cliente','cliente_id')->join('municipios','id_municipio','municipio_id')->join('fuentes_financiamientos','id_fuente_financiamiento','fuente_financiamiento_id')
        ->select('obras.*',
        'fuentes_clientes.*',
        'fuentes_financiamientos.nombre_corto as nombre_fuente',
        'municipios.nombre as municipio'
        )
        ->get();
        //return $obras;
        return view('obra.admin.index', compact('obras'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('obra.admin.create');
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
    // =================== Funciones API ==================== //
    
    public function getObrasCliente($cliente_id, $anio){

        $obras = DB::table('fuentes_clientes')
            ->orWhere(function($query) use($cliente_id, $anio) {
                $query->where('cliente_id', $cliente_id)
                    ->where('ejercicio',$anio);
                    
            })
            ->join('obras_fuentes', 'obras_fuentes.fuente_financiamiento_cliente_id', '=', 'fuentes_clientes.id_fuente_financ_cliente')
            ->join('obras', 'obras.id_obra', '=', 'obras_fuentes.obra_id')
            ->orderBy('numero_obra')
            ->select('obras.nombre_corto as nombre_obra', 'nombre_archivo' ,'obras.monto_contratado','obras.monto_modificado', DB::raw('round((obras.avance_tecnico + obras.avance_economico + obras.avance_fisico) / 3, 0) AS avance_tecnico'), 'acta_integracion_consejo', 'acta_priorizacion', 'adendum_priorizacion', 'obras.modalidad_ejecucion', 'obras.id_obra')
            ->distinct()
            ->get();
        $desglose = DB::table('fuentes_clientes')
            ->orWhere(function($query) use($cliente_id, $anio) {
                $query->where('cliente_id', $cliente_id)
                    ->where('ejercicio',$anio);
                    
            })
            ->join('obras_fuentes', 'obras_fuentes.fuente_financiamiento_cliente_id', '=', 'fuentes_clientes.id_fuente_financ_cliente')
            ->join('obras', 'obras.id_obra', '=', 'obras_fuentes.obra_id')
            ->join('desglose_pagos_obra', 'desglose_pagos_obra.obras_id', '=', 'obras.id_obra')
            ->select('id_obra', DB::raw('count(desglose_pagos_obra.obras_id) as pagos_count'))
            ->where('desglose_pagos_obra.nombre', 'like', 'Estimacion%')
            ->groupBy('id_obra')
            ->get();
        
        
        $resources = array(
                'desglose' => $desglose,
                'obras' => $obras,
        );
            return [$resources];
            
    }

    public function sendMessage($mensaje, $id, $titulo){
        
        $response = new CustomNotification();
        $response1 =  $response->sendMessage($mensaje, $id, $titulo);
        $return["allresponses"] = $response1;
        $return = json_encode($return);
        
        $data = json_decode($response1, true);
        print_r($data);
        $id = $data['id'];
        print_r($id);

        print("\n\nJSON received:\n");
        print($return);
        print("\n");
    }
    public function getProdim($cliente_id, $anio){
        $prodim = DB::table('fuentes_clientes')
        ->orWhere(function($query) use($cliente_id, $anio) {
            $query->where('cliente_id', $cliente_id)
                ->where('ejercicio',$anio)
                ->where('fuente_financiamiento_id',2);
        })
        ->select('prodim','gastos_indirectos')
        ->get();

        $obras = DB::table('fuentes_clientes')
            ->orWhere(function($query) use($cliente_id, $anio) {
                $query->where('cliente_id', $cliente_id)
                    ->where('ejercicio',$anio);
            })
            ->join('obras_fuentes', 'obras_fuentes.fuente_financiamiento_cliente_id', '=', 'fuentes_clientes.id_fuente_financ_cliente')
            ->join('obras', 'obras.id_obra', '=', 'obras_fuentes.obra_id')
            ->orderBy('id_obra')
            ->select('id_obra', 'nombre_corto')
            ->distinct()
            ->get();

        $resources = array(
            'prodim' => $prodim,
            'obras' => $obras,
        );
        return [$resources];
        
    }    
}
