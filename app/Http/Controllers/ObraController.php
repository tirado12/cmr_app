<?php

namespace App\Http\Controllers;

use App\Custom\Ejemplo as CustomNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\ObraModalidadEjecucion;
use App\Models\Obra;
use App\Models\Fuentes;
use App\Models\ObrasFuentes;
use App\Models\ObrasContrato;
use App\Models\Cliente;
use App\Models\FuentesCliente;
use App\Models\Contratista;
use App\Models\ParteSocialTecnica;
use App\Models\LicitacionInvitacion;
use App\Models\Municipio;
use NumberFormatter;

class ObraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $obras_contrato = ObraModalidadEjecucion::join('obras', 'obras.id_obra', '=', 'obra_id')
        ->join('obras_contrato', 'obras_contrato.id_obra_contrato', '=', 'obra_contrato_id')
        ->select('obras.nombre_corto as nombre','numero_obra','modalidad_ejecucion','monto_contratado','id_obra','obra_contrato_id')
        ->orderBy('numero_obra')
        ->get();
        $obras_admin = ObraModalidadEjecucion::join('obras', 'obras.id_obra', '=', 'obra_id')
        ->join('obras_administracion', 'obras_administracion.id_obra_administracion', '=', 'obra_administracion_id')
        ->select('obras.nombre_corto as nombre','numero_obra','modalidad_ejecucion','monto_contratado','id_obra','obra_contrato_id')
        ->orderBy('numero_obra')->get();

        $obra_1 = Obra::join('obras_fuentes', 'obras_fuentes.obra_id', '=', 'id_obra')
        ->join('fuentes_clientes', 'fuentes_clientes.id_fuente_financ_cliente', '=', 'fuente_financiamiento_cliente_id')
        ->join('fuentes_financiamientos', 'fuentes_financiamientos.id_fuente_financiamiento', '=', 'fuente_financiamiento_id')
        ->join('clientes', 'clientes.id_cliente', '=', 'cliente_id')
        ->join('municipios', 'municipios.id_municipio', '=', 'municipio_id')
        ->select('id_obra','fuentes_financiamientos.nombre_corto as nombre', 'municipios.nombre as nombre_municipio')
        ->get();

        

        $obras = $obras_admin->concat($obras_contrato)->sortBy('numero_obra');
        
        return view('obra.index',compact('obras', 'obra_1'));
    }

    static function formatNumber($numero){
        $a = new \NumberFormatter("mx-MX", 2);
        return $a->format($numero);
    }

    static function letterNumber($numero){
        $formatterES = new NumberFormatter("es", NumberFormatter::SPELLOUT);
        return $formatterES->format($numero);
    }

    static function formatDate($fecha){
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        $fecha_modificar = strtotime($fecha);
        $n_mes = date("n", $fecha_modificar);
        $n_dia = date("d", $fecha_modificar);
        $n_anio = date("Y", $fecha_modificar);
        $mes = $meses[$n_mes-1];
        return $n_dia." de ".$mes." de ".$n_anio;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $municipios = Municipio::all();
        
        return view('obra.create',compact('municipios'));
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

        $obra = DB::table('obras')
        ->orWhere(function($query) use($id) {
            $query->where('id_obra', $id);
                
        })
        ->join('obras_fuentes', 'obras_fuentes.obra_id', '=', 'id_obra')
        ->join('fuentes_clientes', 'fuentes_clientes.id_fuente_financ_cliente', '=', 'fuente_financiamiento_cliente_id')
        ->join('fuentes_financiamientos', 'fuentes_financiamientos.id_fuente_financiamiento', '=', 'fuente_financiamiento_id')
        ->join('clientes', 'clientes.id_cliente', '=', 'cliente_id')
        ->join('municipios', 'municipios.id_municipio', '=', 'municipio_id')
        ->join('distritos', 'distritos.id_distrito', '=', 'distrito_id')
        ->select('nombre_localidad','municipios.nombre as nombre_municipio', 'distritos.nombre as nombre_distrito', 'oficio_notificacion', 'monto_contratado', 'monto_modificado', 'fuentes_financiamientos.nombre_corto as nombre_fuente', 'nombre_obra', 'fecha_inicio_programada', 'fecha_final_programada', 'id_obra', 'anticipo_porcentaje')
        ->first();

        $obra_contrato = DB::table('obra_modalidad_ejecucion')
        ->orWhere(function($query) use($id) {
            $query->where('obra_id', $id);
                
        })
        ->join('obras_contrato', 'obras_contrato.id_obra_contrato', '=', 'obra_contrato_id')
        ->join('contratistas', 'contratistas.id_contratista', '=', 'contratista_id')
        ->first();
        $obra_admin = DB::table('obra_modalidad_ejecucion')
        ->orWhere(function($query) use($id) {
            $query->where('obra_id', $id);
                
        })
        ->join('obras_administracion', 'obras_administracion.id_obra_administracion', '=', 'obra_administracion_id')
        ->first();
        $obra_social = DB::table('obra_modalidad_ejecucion')
        ->orWhere(function($query) use($id) {
            $query->where('obra_id', $id);
                
        })
        ->join('parte_social_tecnica', 'parte_social_tecnica.id_parte_social_tecnica', '=', 'parte_social_tecnica_id')
        ->first();

        $obra_licitacion = null;

        if($obra_contrato != null){
            $obra_licitacion = DB::table('licitacion_invitacion')->where('obra_contrato_id',$obra_contrato->obra_contrato_id)->first();
        }

        $convenios = null;
        
        if($obra_contrato != null) {
            $convenios = DB::table('convenios_modificatorios')
            ->where('obra_contrato_id',$obra_contrato->obra_contrato_id)->get();
        }
        $estimaciones = null;
        
        if($obra_contrato != null) {
            $estimaciones = DB::table('desglose_pagos_obra')
            ->where('obra_contrato_id',$obra_contrato->obra_contrato_id)
            ->join('estimaciones', 'estimaciones.desglose_pagos_id', '=', 'desglose_pagos_obra.id_desglose_pagos')
            ->get();
        }


        $obj_obra = collect(
            ['obra' => $obra,
            'contrato' => $obra_contrato,
            'admin' => $obra_admin,
            'social' => $obra_social,
            'licitacion'=>$obra_licitacion,
            'estimaciones'=>$estimaciones]
        );
        //return $obj_obra;
        
        
        return view('obra.show',compact('obj_obra', 'convenios', 'estimaciones'));
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

