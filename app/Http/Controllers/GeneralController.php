<?php

namespace App\Http\Controllers;
use App\Models\Cliente;
use App\Models\Municipio;
use App\Models\FuentesCliente;
use App\Models\ObrasFuentes;
use App\Models\Obra;
use App\Models\FuentesFinanciamiento;
use App\Models\ParteSocialTecnica;
use App\Models\ObrasContrato;
use App\Models\ObraModalidadEjecucion;
use App\Models\LicitacionInvitacion;
use App\Models\ObrasAdministracion;
use App\Models\Contratista;
use App\Models\Estimaciones;
use App\Models\ConveniosModificatorio;
use App\Models\ContratoListaRaya;
use App\Models\ContratosArrendamiento;
use App\Models\Factura;
use App\Models\DesglosePagosObra;
use App\Models\ObservacionesDesglose;
use App\Models\Proveedor;
use App\Models\ContratoFactura;
use App\Models\ObraObservaciones;
use App\Models\AnexosFondoIII;
use App\Models\Prodim;
use App\Models\ProdimCatalogo;
use App\Models\ProdimComprometido;
use App\Models\ComprometidoDesglose;
use App\Models\GastosIndirectosFuentes;
use App\Models\GastosIndirectos;
use App\Models\Sisplade;
use App\Models\Rft;
use App\Models\Mids;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class GeneralController extends Controller
{
    //
    public function inicio()
    {
        $anio = (int)strftime("%Y");
        $mes = (int)strftime("%m");

        if($mes < 6)
            $anio = $anio - 1;

        $clientes = Cliente::join('municipios', 'municipios.id_municipio', '=', 'municipio_id')
            ->join('distritos', 'distritos.id_distrito', '=', 'distrito_id')
            ->where('anio_fin','>=', $anio)
            ->select(
                'municipios.nombre as nombre_municipio',
                'distritos.nombre as nombre_distrito',
                'id_municipio',
                'anio_inicio',
                'anio_fin',
                'id_cliente',
                'rfc',
            )
            ->groupBy('id_municipio', 'nombre_municipio', 'anio_inicio', 'anio_fin', 'id_cliente','rfc', 'nombre_distrito')
            ->get();
     
        return view('dashboard', compact('clientes'));
    }

    function ejercicio($id, $anio){
        
        $fuentes_cliente = FuentesCliente::with('obrasFuente', 'obras')
        ->where("cliente_id",$id)
        ->where('ejercicio',$anio)
        ->join('fuentes_financiamientos', 'fuentes_financiamientos.id_fuente_financiamiento', '=', 'fuentes_clientes.fuente_financiamiento_id')
        ->join('anexos_fondo3', 'anexos_fondo3.fuente_financiamiento_cliente_id', '=', 'id_fuente_financ_cliente', 'left outer')
        ->get();

        $fuentes = FuentesFinanciamiento::whereNotIn('id_fuente_financiamiento', function($query) use($id, $anio) {
            $query->select('fuente_financiamiento_id')
            ->from('fuentes_clientes')
            ->where('cliente_id', $id)
            ->where('ejercicio', $anio);
        })->get();

        $obras = ObrasFuentes::where("cliente_id",$id)
        ->where('ejercicio',$anio)
        ->join('fuentes_clientes', 'fuentes_clientes.id_fuente_financ_cliente', '=', 'fuente_financiamiento_cliente_id')
        ->join('obras', 'obras.id_obra', '=', 'obra_id')
        ->select('nombre_corto', 'monto', 'modalidad_ejecucion', 'avance_fisico', 'avance_tecnico', 'avance_economico', 'id_obra', 'fuente_financiamiento_id')
        ->get();

        $cliente = Cliente::where('id_cliente', $id)
        ->join('municipios', 'municipios.id_municipio', '=', 'municipio_id')
        ->join('distritos', 'distritos.id_distrito', '=', 'distrito_id')
        ->join('regiones', 'regiones.id_region', '=', 'region_id')
        ->select('municipios.nombre as nombre_municipio', 'distritos.nombre as nombre_distrito', 'regiones.nombre as nombre_region', 'logo', 'rfc', 'direccion', 'email', 'anio_inicio', 'anio_fin', 'id_municipio', 'id_distrito', 'id_region', 'id_cliente')
        ->first();
        
        $comprometido_prodim = null;
        $catalogo_prodim = null;
        $total_prodim = 0;
        $total_desglose = null;
        $prodim = null;

        $fuente_f3 = FuentesCliente::where("cliente_id",$id)
        ->where('ejercicio',$anio)
        ->join('fuentes_financiamientos', 'fuentes_financiamientos.id_fuente_financiamiento', '=', 'fuentes_clientes.fuente_financiamiento_id')
        ->join('anexos_fondo3', 'anexos_fondo3.fuente_financiamiento_cliente_id', '=', 'id_fuente_financ_cliente', 'left outer')
        ->where('fuente_financiamiento_id', 2)
        ->first();
    
        
        if($fuente_f3 != null && $fuentes_cliente->where('fuente_financiamiento_id', 2)->first()->prodim == 1){
            $prodim = Prodim::where('fuente_id', $fuentes_cliente->where('fuente_financiamiento_id', 2)->first()->id_fuente_financ_cliente)->first();
            
            $comprometido_prodim = ProdimComprometido::where('prodim_id', $prodim->id_prodim)
            ->join('prodim_catalogo', 'prodim_catalogo.id_prodim_catalogo', '=', 'prodim_catalogo_id')
            ->with('desglose', 'total_desglose')
            ->get();

            $prodim_id = $prodim->id_prodim;

            $catalogo_prodim = ProdimCatalogo::whereNotIn('id_prodim_catalogo', function($query) use($prodim_id) {
                $query->select('prodim_catalogo_id')
                ->from('prodim_comprometido')
                ->where('prodim_id', $prodim_id);
            })->select('id_prodim_catalogo', 'nombre')
            ->get();
            

            $total_prodim = ProdimComprometido::where('prodim_id', $prodim->id_prodim)
            ->join('prodim_catalogo', 'prodim_catalogo.id_prodim_catalogo', '=', 'prodim_catalogo_id')
            ->select(DB::raw('sum(prodim_comprometido.monto) as total_prodim'))
            ->first()
            ->total_prodim;
            
        }
        $comprometido_gi = [];
        $catalogo_gi = null;
        $total_gi = 0;
        
        
        
        
        if($fuente_f3 != null && $fuentes_cliente->where('fuente_financiamiento_id', 2)->first()->gastos_indirectos == 1){
             
            $id_fuente = $fuente_f3->id_fuente_financ_cliente;
            
            $comprometido_gi = GastosIndirectosFuentes::where('fuente_cliente_id', $id_fuente)
            ->join('gastos_indirectos', 'gastos_indirectos.id_indirectos', '=', 'indirectos_id')
            ->get();

            
            $catalogo_gi = GastosIndirectos::whereNotIn('id_indirectos', function($query) use($id_fuente) {
                $query->select('indirectos_id')
                ->from('fuentes_gastos_indirectos')
                ->where('fuente_cliente_id', $id_fuente);
            })->select('id_indirectos', 'nombre')
            ->get();
            

            $total_gi = GastosIndirectosFuentes::where('fuente_cliente_id', $id_fuente)
            ->select(DB::raw('sum(monto) as total_gastos'))
            ->first()
            ->total_gastos;
            
        }

        $obras_pt = Obra::with('rft', 'mids')
        ->join('obras_fuentes', 'obras_fuentes.obra_id', '=', 'id_obra')
        ->join('fuentes_clientes', 'fuentes_clientes.id_fuente_financ_cliente', '=', 'fuente_financiamiento_cliente_id')
        ->where("cliente_id",$id)
        ->where('ejercicio',$anio)
        ->select('nombre_corto', 'nombre_obra', 'id_obra')
        ->get();

        $sisplade = null;

        if($fuente_f3 != null){
            $sisplade = Sisplade::where('fuentes_clientes_id', $fuente_f3->id_fuente_financ_cliente)->first();
        }

        


        return view('ejercicio.ejercicio', 
        compact(
            'fuentes_cliente',
            'obras', 
            'cliente', 
            'anio', 
            'fuentes', 
            'comprometido_prodim', 
            'catalogo_prodim', 
            'total_prodim', 
            'total_desglose', 
            'prodim',
            'comprometido_gi',
            'catalogo_gi',
            'total_gi',
            'sisplade',
            'fuente_f3',
            'obras_pt'
        ));
    }

    public function create_obra($id, $anio)
    {

        $obras_count = ObrasFuentes::where("cliente_id",$id)
        ->where('ejercicio',$anio)
        ->join('fuentes_clientes', 'fuentes_clientes.id_fuente_financ_cliente', '=', 'fuente_financiamiento_cliente_id')
        ->join('obras', 'obras.id_obra', '=', 'obra_id')
        ->select(DB::raw('count(distinct obra_id) as obras_count'))
        ->first();

        $cliente = Cliente::find($id)
        ->join('municipios','municipios.id_municipio','=','municipio_id')
        ->first();

        $fuentes_cliente = FuentesCliente::where("cliente_id",$id)
        ->where('ejercicio',$anio)
        ->join('fuentes_financiamientos', 'fuentes_financiamientos.id_fuente_financiamiento', '=', 'fuentes_clientes.fuente_financiamiento_id')
        ->select('id_fuente_financ_cliente', 'nombre_corto', DB::raw('(monto_proyectado - monto_comprometido) as sobrante_fondo'))
        ->get();

        $actas_preliminares = FuentesCliente::where("cliente_id",$id)
        ->where('ejercicio',$anio)
        ->join('fuentes_financiamientos', 'fuentes_financiamientos.id_fuente_financiamiento', '=', 'fuentes_clientes.fuente_financiamiento_id')
        ->join('anexos_fondo3', 'anexos_fondo3.fuente_financiamiento_cliente_id', '=', 'id_fuente_financ_cliente')
        ->first();
        

        $contratistas = Contratista::all();

        //return $fuentes_cliente;

        $obras_count = $obras_count->obras_count;
        
        $municipios = Municipio::all();
        return view('obra.create_obra',compact('municipios', 'obras_count', 'cliente', 'anio', 'actas_preliminares', 'contratistas', 'fuentes_cliente', 'anio'));
    }

    public function update_expediente(Request $request)
    {

        $obra_relaciones = ObraModalidadEjecucion::where('obra_id', $request->id_obra)->first();
        
        $parte_social = ParteSocialTecnica::find($obra_relaciones->parte_social_tecnica_id);
        
        $parte_social->acta_integracion_consejo = $request->acta_integracion_consejo;
        $parte_social->acta_seleccion_obras = $request->acta_seleccion_obras;
        $parte_social->acta_priorizacion_obras = $request->acta_priorizacion_obras;
        $parte_social->convenio_mezcla = $request->convenio_mezcla;
        $parte_social->acta_integracion_comite = $request->acta_integracion_comite;
        $parte_social->convenio_concertacion = $request->convenio_concertacion;
        $parte_social->acta_aprobacion_obra = $request->acta_aprobacion_obra;
        $parte_social->acta_excep_licitacion = $request->acta_excep_licitacion;
        $parte_social->estudio_factibilidad = $request->estudio_factibilidad;
        $parte_social->oficio_aprobacion_obra = $request->oficio_aprobacion_obra;
        $parte_social->anexos_oficio_notificacion = $request->anexos_oficio_notificacion;
        $parte_social->cedula_informacion_basica = $request->cedula_informacion_basica;
        $parte_social->generalidades_inversion = $request->generalidades_inversion;
        $parte_social->tenencia_tierra = $request->tenencia_tierra;
        $parte_social->dictamen_impacto_ambiental = $request->dictamen_impacto_ambiental;
        $parte_social->presupuesto_obra = $request->presupuesto_obra;
        $parte_social->catalogo_conceptos = $request->catalogo_conceptos_social;
        $parte_social->explosion_insumos = $request->explosion_insumos;
        $parte_social->generadores_obra = $request->generadores_obra;
        $parte_social->planos_proyecto = $request->planos_proyecto;
        $parte_social->especificaciones_generales_particulares = $request->especificaciones_generales_particulares;
        $parte_social->dro = $request->dro;
        $parte_social->programa_obra_inversion = $request->programa_obra_inversion;
        $parte_social->croquis_macro = $request->croquis_macro;
        $parte_social->croquis_micro = $request->croquis_micro;
        $parte_social->acta_ejecutar_adjudicacion = 3;

        if($request->acta_ejecutar_adjudicacion != '')
            $parte_social->acta_ejecutar_adjudicacion = $request->acta_ejecutar_adjudicacion;
        
        $numero_total = ($request->total_documentos / 3) - $request->total_na;
        $total_avance = round($request->total_si * 100 / $numero_total, 2) ;
        
        
        
        if($obra_relaciones->obra_contrato_id != null){
            $obra_contrato = ObrasContrato::find($obra_relaciones->obra_contrato_id);
            $obra_contrato->contrato = $request->contrato;
            $obra_contrato->oficio_justificativo_convenio_modificatorio = $request->oficio_justificativo_convenio_modificatorio;
            $obra_contrato->analisis_p_u = $request->analisis_p_u;
            $obra_contrato->catalogo_conceptos = $request->catalogo_conceptos;
            $obra_contrato->montos_mensuales_ejecutados = $request->montos_mensuales_ejecutados;
            $obra_contrato->calendario_trabajos_ejecutados = $request->calendario_trabajos_ejecutados;
            $obra_contrato->oficio_superintendente = $request->oficio_superintendente;
            $obra_contrato->oficio_residente_obra = $request->oficio_residente_obra;
            $obra_contrato->oficio_disposicion_inmueble = $request->oficio_disposicion_inmueble;
            $obra_contrato->oficio_inicio_obra = $request->oficio_inicio_obra;
            $obra_contrato->exp_factura_anticipo = $request->exp_factura_anticipo;
            $obra_contrato->exp_fianza_anticipo = $request->exp_fianza_anticipo;
            $obra_contrato->exp_fianza_cumplimiento = $request->exp_fianza_cumplimiento;
            $obra_contrato->exp_fianza_v_o = $request->exp_fianza_v_o;
            $obra_contrato->presupuesto_definitivo = $request->presupuesto_definitivo;
            $obra_contrato->aviso_terminacion_obra = $request->aviso_terminacion_obra;
            $obra_contrato->acta_entrega_contratista = $request->acta_entrega_contratista;
            $obra_contrato->acta_entrega_municipio = $request->acta_entrega_municipio;
            $obra_contrato->saba_finiquito = $request->saba_finiquito;
            $obra_contrato->acta_extincion = $request->acta_extincion;
            $obra_contrato->padron_contratistas = $request->padron_contratistas;
            $obra_contrato->invitacion_acuse_recepcion = $request->invitacion_acuse_recepcion;
            $obra_contrato->aceptacion_invitacion = $request->aceptacion_invitacion;
            $obra_contrato->factura_anticipo = $request->factura_anticipo;
            $obra_contrato->fianza_anticipo = $request->fianza_anticipo;
            $obra_contrato->fianza_cumplimiento = $request->fianza_cumplimiento;
            $obra_contrato->fianza_v_o = $request->fianza_v_o;

            $obra_contrato->calendario_trabajos_ejecutados = 2;      

            $obra_contrato->update();

            if($request->bases_licitacion != null){
                $licitacion = LicitacionInvitacion::where('obra_contrato_id', $obra_contrato->id_obra_contrato)->first();
                
                $licitacion->bases_licitacion = $request->bases_licitacion;
                $licitacion->constancia_visita = $request->constancia_visita;
                $licitacion->acta_junta_aclaraciones = $request->acta_junta_aclaraciones;
                $licitacion->acta_apertura_tecnica = $request->acta_apertura_tecnica;
                $licitacion->dictamen_tecnico = $request->dictamen_tecnico;
                $licitacion->acta_apertura_economica = $request->acta_apertura_economica;
                $licitacion->dictamen_economico = $request->dictamen_economico;
                $licitacion->dictamen = $request->dictamen;
                $licitacion->acta_fallo = $request->acta_fallo;
                $licitacion->propuesta_licitantes_economica = $request->propuesta_licitantes_economica;
                $licitacion->propuesta_licitantes_tecnica = $request->propuesta_licitantes_tecnica;

                $licitacion->update();
            }

            for($i = 1; $i <= $request->numero_estimaciones; $i++){
                $id_estimacion = "estimacion_id_$i";
                $factura_estimacion = "factura_estimacion_$i";
                $caratula_estimacion = "caratula_estimacion_$i";
                $presupuesto_estimacion = "presupuesto_estimacion_$i";
                $cuerpo_estimacion = "cuerpo_estimacion_$i";
                $numero_generadores_estimacion = "numero_generadores_estimacion_$i";
                $resumen_estimacion = "resumen_estimacion_$i";
                $estado_cuenta_estimacion = "estado_cuenta_estimacion_$i";
                $croquis_ilustrativo_estimacion = "croquis_ilustrativo_estimacion_$i";
                $reporte_fotografico_estimacion = "reporte_fotografico_estimacion_$i";
                $notas_bitacora = "notas_bitacora_$i";
                
                $estimacion = Estimaciones::find($request->$id_estimacion);
                $estimacion->factura_estimacion = $request->$factura_estimacion;
                $estimacion->caratula_estimacion = $request->$caratula_estimacion;
                $estimacion->presupuesto_estimacion = $request->$presupuesto_estimacion;
                $estimacion->cuerpo_estimacion = $request->$cuerpo_estimacion;
                $estimacion->numero_generadores_estimacion = $request->$numero_generadores_estimacion;
                $estimacion->resumen_estimacion = $request->$resumen_estimacion;
                $estimacion->estado_cuenta_estimacion = $request->$estado_cuenta_estimacion;
                $estimacion->croquis_ilustrativo_estimacion = $request->$croquis_ilustrativo_estimacion;
                $estimacion->reporte_fotografico_estimacion = $request->$reporte_fotografico_estimacion;
                $estimacion->notas_bitacora = $request->$notas_bitacora;
                

                $estimacion->update();
            }

            for($i = 1; $i <= $request->numero_convenios; $i++){
                $id_convenio = "convenio_id_$i";
                $integrado = "convenio_$i";

                $convenio = ConveniosModificatorio::find($request->$id_convenio);
                $convenio->agregado_expediente = $request->$integrado;

                $convenio->update();
            }
        }

        if($obra_relaciones->obra_administracion_id != null){
            $obra_admin = ObrasAdministracion::find($obra_relaciones->obra_administracion_id);

            $obra_admin->inventario_maquinaria_construccion = $request->inventario_maquinaria_construccion;
            $obra_admin->plantilla_personal = $request->plantilla_personal;
            $obra_admin->indentificacion_oficial_trabajadores = $request->indentificacion_oficial_trabajadores;
            $obra_admin->reporte_fotografico = $request->reporte_fotografico;
            $obra_admin->notas_bitacora = $request->notas_bitacora;
            $obra_admin->acta_entrega_municipio = $request->acta_entrega_municipio;
            $obra_admin->cedula_detallada_facturacion = $request->cedula_detallada_facturacion;

            $obra_admin->update();

            for($i = 1; $i <= $request->numero_listas; $i++){
                $id_lista = "lista_id_$i";
                $integrado = "lista_raya_$i";
                
                $lista = ContratoListaRaya::find($request->$id_lista);
                $lista->agregado_expediente = $request->$integrado;

                $lista->update();
            }

            for($i = 1; $i <= $request->numero_facturas; $i++){
                $id_factura = "factura_id_$i";
                $integrado = "factura_$i";
                
                $factura = Factura::find($request->$id_factura);
                $factura->agregado_expediente = $request->$integrado;

                $factura->update();
            }

            for($i = 1; $i <= $request->numero_contratos; $i++){
                $id_contrato = "contrato_id_$i";
                $integrado = "contrato_arrendamiento_$i";
                
                $contrato = ContratosArrendamiento::find($request->$id_contrato);
                $contrato->agregado_expediente = $request->$integrado;
                
                $contrato->update();
            }
        }

        $obra = Obra::find($obra_relaciones->obra_id);
        $obra->avance_tecnico = $total_avance;
        $obra->update();


        $parte_social->update();

        $observaciones = ObraObservaciones::where('obra_id',$obra_relaciones->obra_id)->first();
        if($observaciones == null){
            ObraObservaciones::create([
                'obra_id' => $obra_relaciones->obra_id,
                'observacion' => $request->observaciones,
            ]);
        }
        else{
            $observaciones->observacion = $request->observaciones;
            $observaciones->update();
        }
        return redirect()->route('obra.ver', ['id' => $request->id_obra]);
    }

    public function edit_expediente($id)
    {

        $obra = Obra::where('id_obra', $id)
        ->join('obras_fuentes', 'obras_fuentes.obra_id', '=', 'id_obra')
        ->join('fuentes_clientes', 'fuentes_clientes.id_fuente_financ_cliente', '=', 'fuente_financiamiento_cliente_id')
        ->join('fuentes_financiamientos', 'fuentes_financiamientos.id_fuente_financiamiento', '=', 'fuente_financiamiento_id')
        ->join('clientes', 'clientes.id_cliente', '=', 'cliente_id')
        ->join('municipios', 'municipios.id_municipio', '=', 'municipio_id')
        ->join('distritos', 'distritos.id_distrito', '=', 'distrito_id')
        ->join('regiones', 'regiones.id_region', '=', 'region_id')
        ->join('estados', 'estados.id_estado', '=', 'estado_id')
        ->select('id_obra','nombre_localidad','municipios.nombre as nombre_municipio', 'distritos.nombre as nombre_distrito', 'regiones.nombre as nombre_region', 'estados.nombre as nombre_estado', 'oficio_notificacion', 'monto_contratado', 'monto_modificado', 'nombre_obra', 'fecha_inicio_programada', 'fecha_final_programada', 'id_obra', 'anticipo_porcentaje', 'modalidad_ejecucion', 'obras.nombre_corto as nombre_corto_obra', 'ejercicio')
        ->first();

        $observaciones = ObraObservaciones::where('obra_id', $obra->id_obra)->first();

        $fuentes_financiamiento = ObrasFuentes::where('obra_id', $id)
        ->join('fuentes_clientes', 'fuentes_clientes.id_fuente_financ_cliente', '=', 'fuente_financiamiento_cliente_id')
        ->join('fuentes_financiamientos', 'fuentes_financiamientos.id_fuente_financiamiento', '=', 'fuente_financiamiento_id')
        ->select('nombre_corto', 'monto')
        ->get();

        $acta_priorizacion = ObrasFuentes::where('obra_id', $id)
        ->join('fuentes_clientes', 'fuentes_clientes.id_fuente_financ_cliente', '=', 'fuente_financiamiento_cliente_id')
        ->join('fuentes_financiamientos', 'fuentes_financiamientos.id_fuente_financiamiento', '=', 'fuente_financiamiento_id')
        ->join('anexos_fondo3', 'anexos_fondo3.fuente_financiamiento_cliente_id', '=', 'id_fuente_financ_cliente')
        ->select('acta_priorizacion')
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
            $convenios = ConveniosModificatorio::where('obra_contrato_id',$obra_contrato->obra_contrato_id)->get();
        }

        

        
        $estimaciones = null;
        
        if($obra_contrato != null) {
            $estimaciones = DB::table('desglose_pagos_obra')
            ->where('obra_contrato_id',$obra_contrato->obra_contrato_id)
            ->join('estimaciones', 'estimaciones.desglose_pagos_id', '=', 'desglose_pagos_obra.id_desglose_pagos')
            ->get();
        }
        
        

        $facturas = null;
        
        if($obra_admin != null) {
            $facturas = DB::table('facturas')
            ->where('obra_administracion_id',$obra_admin->id_obra_administracion)
            ->join('contrato_facturas', 'contrato_facturas.factura_id', '=', 'id_factura', 'left outer')
            ->where('contrato_arrendamiento_id','=', null)
            ->get();
        }


        $listas_raya = null;
        
        if($obra_admin != null) {
            $listas_raya = DB::table('contrato_lista_raya')
            ->where('obra_administracion_id',$obra_admin->id_obra_administracion)
            ->select('id_lista_raya','fecha_inicio','fecha_fin','total','numero_lista_raya','isr','mano_obra','agregado_expediente','obra_administracion_id')
            ->orderBy('numero_lista_raya')
            ->get();
        }

        $contratos_arrendamiento = null;
        
        if($obra_admin != null) {
            $contratos_arrendamiento = DB::table('contratos_arrendamientos')
            ->where('obra_administracion_id',$obra_admin->id_obra_administracion)
            ->join('proveedores', 'proveedores.id_proveedor','=','proveedor_id')
            ->get();
        }

        $obj_obra = collect(
            ['obra' => $obra,
            'contrato' => $obra_contrato,
            'admin' => $obra_admin,
            'social' => $obra_social,
            'licitacion'=>$obra_licitacion,
            ]
        );
        
        
        
        return view('obra.edit_expediente',compact('obj_obra', 'convenios', 'estimaciones', 'fuentes_financiamiento', 'acta_priorizacion', 'facturas', 'listas_raya', 'contratos_arrendamiento', 'observaciones'));
    }
    

    public function update_obra(Request $request)
    {
        $request->validate([
            "obra_id" => 'required',
        ]);
        
        $obra = Obra::find($request->obra_id);
        $obra->nombre_corto = $request->nombre_corto?$request->nombre_corto:$obra->nombre_corto;
        $obra->fecha_inicio_programada = $request->fecha_inicio?$request->fecha_inicio:$obra->fecha_inicio_programada;
        $obra->fecha_final_programada = $request->fecha_fin?$request->fecha_fin:$obra->fecha_final_programada;
        $obra->avance_fisico = $request->avance_fisico?$request->avance_fisico:$obra->avance_fisico;
        
        $obra->update();
        return redirect()->route('obra.ver', ['id' => $request->obra_id]);
    }

    public function ver($id)
    {
        
        $obra = Obra::where('id_obra', $id)
        ->join('obras_fuentes', 'obras_fuentes.obra_id', '=', 'id_obra')
        ->join('fuentes_clientes', 'fuentes_clientes.id_fuente_financ_cliente', '=', 'fuente_financiamiento_cliente_id')
        ->join('fuentes_financiamientos', 'fuentes_financiamientos.id_fuente_financiamiento', '=', 'fuente_financiamiento_id')
        ->join('clientes', 'clientes.id_cliente', '=', 'cliente_id')
        ->join('municipios', 'municipios.id_municipio', '=', 'municipio_id')
        ->join('distritos', 'distritos.id_distrito', '=', 'distrito_id')
        ->join('regiones', 'regiones.id_region', '=', 'region_id')
        ->join('estados', 'estados.id_estado', '=', 'estado_id')
        ->select('id_obra', 'numero_obra', 'nombre_localidad','municipios.nombre as nombre_municipio', 'distritos.nombre as nombre_distrito', 'regiones.nombre as nombre_region', 'estados.nombre as nombre_estado', 'oficio_notificacion', 'monto_contratado', 'monto_modificado', 'nombre_obra', 'fecha_inicio_programada', 'fecha_final_programada', 'fecha_final_real', 'id_obra', 'anticipo_porcentaje', 'modalidad_ejecucion', 'obras.nombre_corto as nombre_corto_obra', 'ejercicio', 'anticipo_monto', 'id_municipio', 'avance_fisico', 'avance_economico', 'avance_tecnico')
        ->first();

        $observaciones = ObraObservaciones::where('obra_id', $obra->id_obra)->first();

        $fuentes_financiamiento = ObrasFuentes::where('obra_id', $id)
        ->join('fuentes_clientes', 'fuentes_clientes.id_fuente_financ_cliente', '=', 'fuente_financiamiento_cliente_id')
        ->join('fuentes_financiamientos', 'fuentes_financiamientos.id_fuente_financiamiento', '=', 'fuente_financiamiento_id')
        ->select('nombre_corto', 'monto')
        ->get();

        $acta_priorizacion = ObrasFuentes::where('obra_id', $id)
        ->join('fuentes_clientes', 'fuentes_clientes.id_fuente_financ_cliente', '=', 'fuente_financiamiento_cliente_id')
        ->join('fuentes_financiamientos', 'fuentes_financiamientos.id_fuente_financiamiento', '=', 'fuente_financiamiento_id')
        ->join('anexos_fondo3', 'anexos_fondo3.fuente_financiamiento_cliente_id', '=', 'id_fuente_financ_cliente')
        ->select('acta_priorizacion')
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
            $convenios = ConveniosModificatorio::where('obra_contrato_id',$obra_contrato->obra_contrato_id)
            ->select("id_convenio_modificatorio", "numero_convenio_modificatorio","fecha_convenio","tipo","monto_modificado","fecha_fin_modificada","agregado_expediente","obra_contrato_id")
            ->orderBy("id_convenio_modificatorio")
            ->get();
        }
        //return $convenios;

        $estimaciones = null;
        
        if($obra_contrato != null) {
            $estimaciones = DesglosePagosObra::where('obra_contrato_id',$obra_contrato->obra_contrato_id)
            ->join('estimaciones', 'estimaciones.desglose_pagos_id', '=', 'desglose_pagos_obra.id_desglose_pagos')
            ->get();
        }

        $pagos_obra = null;
        
        if($obra_contrato != null) {
            $pagos_obra = DesglosePagosObra::where('obra_contrato_id',$obra_contrato->obra_contrato_id)
            ->get();
        }
        
        
        $total_pagado = null;
        
        if($obra_contrato != null) {
            $total_pagado = DesglosePagosObra::where('obra_contrato_id',$obra_contrato->obra_contrato_id)
            ->join('estimaciones', 'estimaciones.desglose_pagos_id', '=', 'desglose_pagos_obra.id_desglose_pagos')
            ->select(
                DB::raw('sum(total_estimacion ) as total_estimaciones'),
                DB::raw('sum(total_estimacion - amortizacion_anticipo) as total_obra'),
                DB::raw('sum(amortizacion_anticipo) as total_anticipo'),
            )
            ->first();

        }

        $total_admin = null;
        
        if($obra_admin != null) {
            $total_lista = ContratoListaRaya::where('obra_administracion_id',$obra_admin->id_obra_administracion)
            ->select(
                DB::raw('sum(total) as total_listas'),
            )
            ->first();

            $total_factura = Factura::where('obra_administracion_id',$obra_admin->id_obra_administracion)
            ->leftJoin('contrato_facturas', 'contrato_facturas.factura_id', '=', 'id_factura')
            ->where("contrato_arrendamiento_id", null)
            ->select(
                DB::raw('sum(total) as total_facturas'),
            )
            ->first();

            $total_contrato= ContratosArrendamiento::where('obra_administracion_id',$obra_admin->id_obra_administracion)
            ->select(
                DB::raw('sum(monto_contratado) as total_contratos'),
            )
            ->first();

            $total_admin = $total_lista->total_listas + $total_factura->total_facturas + $total_contrato->total_contratos;

        }
       

        $facturas = null;
        
        if($obra_admin != null) {
            $facturas = Factura::where('obra_administracion_id',$obra_admin->id_obra_administracion)
            ->join('proveedores', 'proveedores.id_proveedor','=','proveedor_id')
            ->leftJoin('contrato_facturas', 'contrato_facturas.factura_id', '=', 'id_factura')
            ->where("contrato_arrendamiento_id", null)
            ->orderBy('id_factura', 'asc')
            ->get();
        }


        $listas_raya = null;
        
        if($obra_admin != null) {
            $listas_raya = ContratoListaRaya::where('obra_administracion_id',$obra_admin->id_obra_administracion)
            ->select('fecha_inicio','fecha_fin','total','numero_lista_raya','isr','mano_obra','agregado_expediente','obra_administracion_id', 'id_lista_raya')
            ->orderBy('numero_lista_raya')
            ->get();
        }

        $contratos_arrendamiento = null;
        
        if($obra_admin != null) {
            $contratos_arrendamiento = DB::table('contratos_arrendamientos')
            ->where('obra_administracion_id',$obra_admin->id_obra_administracion)
            ->join('proveedores', 'proveedores.id_proveedor','=','proveedor_id')
            ->orderBy('id_contrato_arrendamiento', 'asc')
            ->get();
        }     
        
        $proveedores = null;
        
        if($obra_admin != null) {
            $proveedores = Proveedor::where('municipio_id', $obra->id_municipio)
            ->select('id_proveedor', 'razon_social', 'rfc')
            ->get();
        }        


        $obj_obra = collect(
            ['obra' => $obra,
            'contrato' => $obra_contrato,
            'admin' => $obra_admin,
            'social' => $obra_social,
            'licitacion'=>$obra_licitacion,
            ]
        );
        
        return view('obra.ver',compact('obj_obra', 'convenios', 'estimaciones', 'fuentes_financiamiento', 'acta_priorizacion', 'facturas', 'listas_raya', 'contratos_arrendamiento', 'total_pagado', 'pagos_obra', 'total_admin', 'proveedores', 'observaciones'));
    }

    public function store_obra(Request $request)
    {

        
        

        $request->validate([
            "monto_contratado" => 'required',
            "numero_fuentes" => 'required',
            "fuente_financiamiento" => 'required',
            "modalidad_ejecucion" => 'required',
            "modalidad_asignacion" => 'required',
            "tipo_contrato" => 'required',
            "contratista_id" => 'required',
            "nombre_obra" => 'required',
            "nombre_corto" => 'required',
            "nombre_localidad" => 'required',
            "tipo_localidad" => 'required',
            "situacion" => 'required',
            "oficio_notificacion" => 'required',
            "fecha_oficio_notificacion" => 'required',
            "fecha_inicio" => 'required',
            "fecha_fin" => 'required',
            "acta_integracion" => 'required',
            "convenio_concertacion" => 'required',
        ]);

        
                $obras_count = ObrasFuentes::where("cliente_id",$request->cliente_id)
                    ->where('ejercicio',$request->ejercicio)
                    ->join('fuentes_clientes', 'fuentes_clientes.id_fuente_financ_cliente', '=', 'fuente_financiamiento_cliente_id')
                    ->join('obras', 'obras.id_obra', '=', 'obra_id')
                    ->select(DB::raw('count(distinct obra_id) as obras_count'))
                    ->first();

                $obra = Obra::create([
                    "numero_obra" => $obras_count->obras_count + 1,
                    "nombre_obra" => $request->nombre_obra,
                    "nombre_corto" => $request->nombre_corto,
                    //"nombre_archivo" => "",
                    "oficio_notificacion" => $request->oficio_notificacion,
                    "fecha_oficio_notificacion" => $request->fecha_oficio_notificacion,
                    "monto_contratado" => str_replace(",", '', $request->monto_contratado),
                    //"monto_modificado" => $request->,
                    "fecha_inicio_programada" => $request->fecha_inicio,
                    "fecha_final_programada" => $request->fecha_fin,
                    "fecha_inicio_real" => $request->fecha_inicio,
                    "fecha_final_real" => $request->fecha_fin,
                    //"fecha_actualizacion" => $request->,
                    "modalidad_ejecucion" => $request->modalidad_ejecucion,
                    "situacion" => $request->situacion,
                    "avance_fisico" => 0.00,
                    "avance_tecnico" => 0.00,
                    "avance_economico" => 0.00,
                    "anticipo_porcentaje" => $request->anticipo_porcentaje,
                    "anticipo_monto" => $request->monto_anticipo!=''?str_replace(",", '', $request->monto_anticipo):0,
                    "acta_seleccion_obras" => $request->acta_seleccion,
                    "convenio_colaboracion_instancias" => $request->convenio_instancias,
                    "acta_intregracion_comite" => $request->acta_integracion,
                    "convenio_concertacion" => $request->convenio_concertacion,
                    "nombre_localidad" => $request->nombre_localidad,
                    "tipo_localidad" => $request->tipo_localidad,
                ]);

                

                
                $parte_social = ParteSocialTecnica::create([]);

                if($request->modalidad_ejecucion == 2){
                    $obra_contrato = ObrasContrato::create([
                        "numero_contrato" => $request->contrato,
                        "fecha_contrato" => $request->fecha_contrato,
                        "contrato_tipo" => $request->tipo_contrato,
                        "modalidad_asignacion" => $request->modalidad_asignacion,
                        "contratista_id" => $request->contratista_id,
                    ]);
                    $obra_modalidad = ObraModalidadEjecucion::create([
                        'obra_id' => $obra->id_obra,
                        'parte_social_tecnica_id' => $parte_social->id_parte_social_tecnica,
                        'obra_contrato_id' => $obra_contrato->id_obra_contrato,
                    ]);
                    if($request->modalidad_asignacion == 1 || $request->modalidad_asignacion == 2){
                        $licitacion = LicitacionInvitacion::create([
                            'obra_contrato_id' => $obra_contrato->id_obra_contrato,
                        ]);
                    }

                    if($request->monto_anticipo > 0){
                        $pagoAnticipo = DesglosePagosObra::create([
                            "obra_contrato_id" => $obra_contrato->id_obra_contrato,
                            "nombre" => "Anticipo",
                        ]);

                        $observacionesAnticipo = ObservacionesDesglose::create([
                            'desglose_pagos_id' => $pagoAnticipo->id_desglose_pagos,
                        ]);
                    }
                }

                if($request->modalidad_ejecucion == 1){
                    $obra_admin = ObrasAdministracion::create([]);
                    $obra_modalidad = ObraModalidadEjecucion::create([
                        'obra_id' => $obra->id_obra,
                        'parte_social_tecnica_id' => $parte_social->id_parte_social_tecnica,
                        'obra_administracion_id' => $obra_admin->id_obra_administracion,
                    ]);
                }
                $fuente_mids = false;
                $fuente_rft = false;
                $id_fuente = "";
                
                for($i = 0; $i < $request->numero_fuentes; $i++){
                    $id_fuente = "fuente_financiamiento_$i";
                    $monto_comprometido = "monto_fuente_$i";
                    
                    $monto_comprometido = str_replace(",", '', $request->$monto_comprometido);
                    $monto_comprometido = str_replace("$ ", '', $monto_comprometido);
                    $fuente_cliente = ObrasFuentes::create([
                        "fuente_financiamiento_cliente_id" => $request->$id_fuente,
                        "obra_id" => $obra->id_obra,
                        "monto" => $monto_comprometido,
                    ]);
                    $fuente_cliente_update = FuentesCliente::find($request->$id_fuente);
                    $fuente_cliente_update->monto_comprometido = $fuente_cliente_update->monto_comprometido + $monto_comprometido;
                    $fuente_cliente_update->update();
                    if($fuente_cliente_update->fuente_financiamiento_id == 2){
                        $fuente_mids = true;
                    }

                    if($fuente_cliente_update->fuente_financiamiento_id == 3 || $fuente_cliente_update->fuente_financiamiento_id == 2){
                        $fuente_rft = true;
                    }
                }

                
                
                if($fuente_rft){
                    $rft = Rft::create([
                        'obra_id' => $obra->id_obra,
                    ]);
                }

                if($fuente_mids){
                    $mids = Mids::create([
                        'obra_id' => $obra->id_obra
                    ]);
                }
            

        return redirect()->route('cliente.ejercicio', ['id' => $request->cliente_id, 'anio' => $request->ejercicio]);
    }

    public function store_convenio_modificatorio (Request $request){
        
        
        $request->validate([
            "numero_convenio_modificatorio" => 'required',
            "fecha_convenio" => 'required',
            "tipo" => 'required',
        ]);

        $obra_relaciones = ObraModalidadEjecucion::where('obra_id', $request->id_obra)->first();
        $obra = Obra::find($request->id_obra);

        $convenio = ConveniosModificatorio::create([
            'numero_convenio_modificatorio' => $request->numero_convenio_modificatorio,
            'fecha_convenio' => $request->fecha_convenio,
            'tipo' => $request->tipo,
            'monto_modificado' => $request->monto_modificado?str_replace(",", '', $request->monto_modificado):0,
            'fecha_fin_modificada' => $request->fecha_fin_modificada,
            'agregado_expediente' => 2,
            'obra_contrato_id' => $obra_relaciones->obra_contrato_id,

        ]);

        if($request->monto_modificado != ''){
            $obra->monto_modificado = str_replace(",", '', $request->monto_modificado);
        }
        if($request->fecha_fin_modificada != '') {
            $obra->fecha_final_real = $request->fecha_fin_modificada;
        }

        $obra->update();

        return redirect()->route('obra.ver', ['id' => $request->id_obra]);

    }

    public function update_convenio_modificatorio (Request $request){
        
        
        $request->validate([
            "numero_convenio_modificatorio_edit" => 'required',
            "fecha_convenio_edit" => 'required',
            "tipo_edit" => 'required',
        ]);
        

        $convenio = ConveniosModificatorio::find($request->id_convenio_modificatorio);
        $convenio->fecha_convenio =  $request->fecha_convenio_edit;
        $convenio->tipo = $request->tipo_edit;
        $convenio->monto_modificado = $request->monto_modificado_edit?str_replace(",", '', $request->monto_modificado_edit):0;
        $convenio->fecha_fin_modificada = $request->fecha_fin_modificada_edit;
        $convenio->numero_convenio_modificatorio = $request->numero_convenio_modificatorio_edit;

        $obra_relaciones = ObraModalidadEjecucion::where('obra_contrato_id', $convenio->obra_contrato_id)->first();
        $obra = Obra::find($obra_relaciones->obra_id);

        if($request->monto_modificado_edit != ''){
            $obra->monto_modificado = str_replace(",", '', $request->monto_modificado_edit);
        }
        if($request->fecha_fin_modificada_edit != '') {
            $obra->fecha_final_real = $request->fecha_fin_modificada_edit;
        }

        $convenio->update();

        $obra->update();

        return redirect()->route('obra.ver', ['id' => $obra_relaciones->obra_id]);

    }

    public function store_estimacion (Request $request){

        
        $request->validate([
            //"total_estimacion" => 'required',
            "fecha_inicio_estimacion" => 'required',
            "fecha_fin_estimacion" => 'required',
            "fecha_recepcion" => 'required',
        ]);

        $pago = DesglosePagosObra::create([
            "obra_contrato_id" => $request->id_obra_contrato,
            "fecha_recepcion" => $request->fecha_recepcion,
            "nombre" => "Estimación $request->numero_estimacion",
        ]);
        

        $estimacion = Estimaciones::create([
            "numero_estimacion" => $request->numero_estimacion,
            "total_estimacion" => null,
            "supervicion_obra" => null,
            "mano_obra" => null,
            "cinco_millar" => null,
            "dos_millar" => null,
            "amortizacion_anticipo" => null,
            "fecha_inicio" => $request->fecha_inicio_estimacion,
            "fecha_final" => $request->fecha_fin_estimacion,
            "folio_factura" => null,
            "finiquito" => $request->finiquito,
            "desglose_pagos_id" => $pago->id_desglose_pagos,
        ]);

        $observacionesAnticipo = ObservacionesDesglose::create([
            'desglose_pagos_id' => $pago->id_desglose_pagos,
        ]);

        $obra_relaciones = ObraModalidadEjecucion::where('obra_contrato_id', $request->id_obra_contrato)->first();

        return redirect()->route('obra.ver', ['id' => $obra_relaciones->obra_id]);

    }

    public function update_estimacion (Request $request){

        $request->validate([
            //"total_estimacion" => 'required',
            "fecha_inicio_estimacion_edit" => 'required',
            "fecha_fin_estimacion_edit" => 'required',
            "fecha_recepcion_edit" => 'required',
            "finiquito_edit" => 'required',
        ]);

        $estimacion = Estimaciones::find($request->id_estimacion_edit);
        $estimacion->finiquito = $request->finiquito_edit;
        $estimacion->fecha_inicio = $request->fecha_inicio_estimacion_edit;
        $estimacion->fecha_final = $request->fecha_fin_estimacion_edit;
        $estimacion->update();

        $pago = DesglosePagosObra::find($estimacion->desglose_pagos_id);
        $pago->fecha_recepcion = $request->fecha_recepcion_edit;
        $pago->update();

        $obra_relaciones = ObraModalidadEjecucion::where('obra_contrato_id', $pago->obra_contrato_id)->first();

        return redirect()->route('obra.ver', ['id' => $obra_relaciones->obra_id]);

    }

    public function show_pagos ($id){
    
        $pagos_obra = DesglosePagosObra::find($id);

        $obra_relaciones = ObraModalidadEjecucion::where('obra_contrato_id', $pagos_obra->obra_contrato_id)->first();
        

        $obra = Obra::where('id_obra', $obra_relaciones->obra_id)
        ->join('obras_fuentes', 'obras_fuentes.obra_id', '=', 'id_obra')
        ->join('fuentes_clientes', 'fuentes_clientes.id_fuente_financ_cliente', '=', 'fuente_financiamiento_cliente_id')
        ->join('fuentes_financiamientos', 'fuentes_financiamientos.id_fuente_financiamiento', '=', 'fuente_financiamiento_id')
        ->join('clientes', 'clientes.id_cliente', '=', 'cliente_id')
        ->join('municipios', 'municipios.id_municipio', '=', 'municipio_id')
        ->join('distritos', 'distritos.id_distrito', '=', 'distrito_id')
        ->join('regiones', 'regiones.id_region', '=', 'region_id')
        ->join('estados', 'estados.id_estado', '=', 'estado_id')
        ->select('id_obra','avance_fisico','nombre_localidad','municipios.nombre as nombre_municipio', 'distritos.nombre as nombre_distrito', 'regiones.nombre as nombre_region', 'estados.nombre as nombre_estado', 'oficio_notificacion', 'monto_contratado', 'monto_modificado', 'nombre_obra', 'fecha_inicio_programada', 'fecha_final_programada', 'id_obra', 'anticipo_porcentaje', 'anticipo_monto', 'modalidad_ejecucion', 'obras.nombre_corto as nombre_corto_obra', 'ejercicio')
        ->first();
        
        $obra_contrato = ObrasContrato::where('id_obra_contrato',$pagos_obra->obra_contrato_id)
        ->select('fianza_anticipo', 'factura_anticipo', 'fianza_cumplimiento', 'id_obra_contrato')
        ->first();
        
        $observaciones = ObservacionesDesglose::join('desglose_pagos_obra', 'desglose_pagos_obra.id_desglose_pagos', '=', 'desglose_pagos_id')
        ->where('desglose_pagos_id', $pagos_obra->id_desglose_pagos)
        ->orderBy('id_observaciones_desglose')
        ->get();

        $estimacion = Estimaciones::join('desglose_pagos_obra', 'desglose_pagos_obra.id_desglose_pagos', '=', 'desglose_pagos_id')
        ->where('desglose_pagos_id', $pagos_obra->id_desglose_pagos)
        ->first();


        $total_pagado = DesglosePagosObra::where('obra_contrato_id',$obra_relaciones->obra_contrato_id)
        ->join('estimaciones', 'estimaciones.desglose_pagos_id', '=', 'desglose_pagos_obra.id_desglose_pagos')
        ->select(
            DB::raw('sum(total_estimacion ) as total_estimaciones'),
            DB::raw('sum(total_estimacion - amortizacion_anticipo) as total_obra'),
            DB::raw('sum(amortizacion_anticipo) as total_anticipo'),
        )
        ->first();
        //return $total_pagado;
        //return $obra;
        //return $estimacion;
        
        return view('obra.show_pagos',compact('obra', 'observaciones', 'estimacion', 'pagos_obra', 'total_pagado', 'obra_contrato'));

    }
    

    public function update_observaciones(Request $request){
        $observacion = ObservacionesDesglose::find($request->id_observacion);
        $pagos_desglose = DesglosePagosObra::find($observacion->desglose_pagos_id);
        if($request->validado == ''){
            $observacion->fecha_observaciones = $request->fecha_observacion?$request->fecha_observacion:$observacion->fecha_observaciones;
            $observacion->fecha_solventacion = $request->fecha_solventacion?$request->fecha_solventacion:$observacion->fecha_solventacion;
            $observacion->update();

            if($observacion->fecha_solventacion != null){
                $observacionesAnticipo = ObservacionesDesglose::create([
                    'desglose_pagos_id' => $observacion->desglose_pagos_id,
                ]);
            }
        }else{
            $pagos_desglose->fecha_validacion = $request->fecha_validacion;
            $pagos_desglose->update();

            $observacion->fecha_observaciones = $observacion->fecha_observacion?$observacion->fecha_observacion:$request->fecha_validacion;
            $observacion->fecha_solventacion = $observacion->fecha_validacion?$observacion->fecha_validacion:$request->fecha_validacion;
            $observacion->update();
        }

        return redirect()->route('show_pagos', ['id' => $pagos_desglose->id_desglose_pagos]);
    }

    public function update_pagos (Request $request){
        
        $pagos_desglose = DesglosePagosObra::find($request->id_pago);
        $pagos_desglose->fecha_recepcion = $pagos_desglose->fecha_recepcion == null?$request->fecha_recepcion:$pagos_desglose->fecha_recepcion;
        $pagos_desglose->fecha_validacion = $pagos_desglose->fecha_validacion == null?$request->fecha_validacion_edit:$pagos_desglose->fecha_validacion;
        $pagos_desglose->fecha_pago = $pagos_desglose->fecha_pago == null?$request->fecha_pago:$pagos_desglose->fecha_pago;
        $pagos_desglose->update();



        $observacion = ObservacionesDesglose::where('desglose_pagos_id', $pagos_desglose->id_desglose_pagos)
        ->orderBy('id_observaciones_desglose', 'desc')
        ->limit(1)
        ->first();

        $observacion->fecha_observaciones = $observacion->fecha_observaciones == null?$request->fecha_validacion_edit:$observacion->fecha_observaciones;
        $observacion->fecha_solventacion = $observacion->fecha_solventacion == null? $request->fecha_validacion_edit:$observacion->fecha_solventacion;
        $observacion->update();


        

        $obra = Obra::find($request->id_obra);

        $monto_obra = $obra->monto_modificado != null?$obra->monto_modificado:$obra->monto_contratado;
        

        if($request->total_estimacion != ''){
            $estimacion = Estimaciones::where('desglose_pagos_id',$pagos_desglose->id_desglose_pagos)->first();
            $estimacion->total_estimacion = str_replace(",", '', $request->total_estimacion);
            $estimacion->supervicion_obra = str_replace(",", '', $request->supervicion_obra);
            $estimacion->mano_obra = str_replace(",", '', $request->mano_obra);
            $estimacion->cinco_millar = str_replace(",", '', $request->cinco_millar);
            $estimacion->dos_millar = str_replace(",", '', $request->dos_millar);
            $estimacion->amortizacion_anticipo = str_replace(",", '', $request->amortizacion_anticipo);
            $estimacion->folio_factura = $request->folio_factura;
            $estimacion->update();

            $total_pagado = DesglosePagosObra::where('obra_contrato_id',$pagos_desglose->obra_contrato_id)
            ->join('estimaciones', 'estimaciones.desglose_pagos_id', '=', 'desglose_pagos_obra.id_desglose_pagos')
            ->select(
                DB::raw('sum(total_estimacion) as total_estimaciones'),
            )
            ->first();

            $total_pagado = $total_pagado->total_estimaciones;

            $porcentaje_economico = ($total_pagado * 100)/$monto_obra;
            $obra->avance_economico = $porcentaje_economico;
            $obra->update();

        }

        if($request->folio_factura_anticipo != ''){
            $obra_contrato = ObrasContrato::find( $pagos_desglose->obra_contrato_id);
            $obra_contrato->factura_anticipo = $request->folio_factura_anticipo;
            $obra_contrato->fianza_anticipo = $request->folio_fianza_anticipo;
            $obra_contrato->fianza_cumplimiento = $request->folio_fianza_cumplimiento;
            $obra_contrato->update();
        }
        
        return redirect()->route('show_pagos', ['id' => $pagos_desglose->id_desglose_pagos]);
        //rturn $request;
    }

    public function store_lista (Request $request)
    {
        
        $request->validate([
            "id_obra_admin_lista" => 'required',
            "id_obra_lista" => 'required',
            "numero_lista_raya" => 'required',
            "total_lista_raya" => 'required',
            "fecha_inicio_lista" => 'required',
            "fecha_fin_lista" => 'required',
            "isr_lista" => 'required',
            "mano_obra_lista" => 'required',
        ]);

        

        $lista = ContratoListaRaya::create([
            "obra_administracion_id" => $request->id_obra_lista,
            "fecha_inicio" => $request->fecha_inicio_lista,
            "fecha_fin" => $request->fecha_fin_lista,
            "total" => str_replace(",", '', $request->total_lista_raya),
            "numero_lista_raya" => $request->numero_lista_raya,
            "isr" => $request->isr_lista,
            "mano_obra" => $request->mano_obra_lista,
            "obra_administracion_id" => $request->id_obra_admin_lista,
        ]);

        $total_lista = ContratoListaRaya::where('obra_administracion_id',$request->id_obra_admin_lista)
        ->select(
            DB::raw('sum(total) as total'),
        )
        ->first();

        $total_facturas = Factura::where('obra_administracion_id',$request->id_obra_admin_lista)
        ->leftJoin('contrato_facturas', 'contrato_facturas.factura_id', '=', 'id_factura')
        ->where("contrato_arrendamiento_id", null)
        ->select(
            DB::raw('sum(total) as total'),
        )
        ->first();

        $total_contrato= ContratosArrendamiento::where('obra_administracion_id',$request->id_obra_admin_lista)
        ->select(
            DB::raw('sum(monto_contratado) as total'),
        )
        ->first();

        $total_ejercido = $total_lista->total + $total_facturas->total + $total_contrato->total;
        
        $obra = Obra::find($request->id_obra_lista);
        
        $porcentaje_economico = ($total_ejercido * 100)/$obra->monto_contratado;
        $obra->avance_economico = $porcentaje_economico;
        $obra->update();
        
        
        return redirect()->route('obra.ver', ['id' => $request->id_obra_lista]);
        //return $request;
    }

    public function update_lista (Request $request)
    {
        
        $request->validate([
            "id_lista" => 'required',
            "id_obra_lista_edit" => 'required',
            "numero_lista_raya_edit" => 'required',
            "total_lista_raya_edit" => 'required',
            "fecha_inicio_lista_edit" => 'required',
            "fecha_fin_lista_edit" => 'required',
            "isr_lista_edit" => 'required',
            "mano_obra_lista_edit" => 'required',
        ]);

        $lista = ContratoListaRaya::find($request->id_lista);
        $lista->total = str_replace(",", '', $request->total_lista_raya_edit);
        $lista->fecha_inicio = $request->fecha_inicio_lista_edit;
        $lista->fecha_fin = $request->fecha_fin_lista_edit;
        $lista->isr = str_replace(",", '', $request->isr_lista_edit);
        $lista->mano_obra = str_replace(",", '', $request->mano_obra_lista_edit);

        $lista->update();

        $total_lista = ContratoListaRaya::where('obra_administracion_id',$lista->obra_administracion_id)
        ->select(
            DB::raw('sum(total) as total'),
        )
        ->first();

        $total_facturas = Factura::where('obra_administracion_id',$lista->obra_administracion_id)
        ->leftJoin('contrato_facturas', 'contrato_facturas.factura_id', '=', 'id_factura')
        ->where("contrato_arrendamiento_id", null)
        ->select(
            DB::raw('sum(total) as total'),
        )
        ->first();

        $total_contrato= ContratosArrendamiento::where('obra_administracion_id',$lista->obra_administracion_id)
        ->select(
            DB::raw('sum(monto_contratado) as total'),
        )
        ->first();

        $total_ejercido = $total_lista->total + $total_facturas->total + $total_contrato->total;
        
        $obra = Obra::find($request->id_obra_lista_edit);
        
        $porcentaje_economico = ($total_ejercido * 100)/$obra->monto_contratado;
        $obra->avance_economico = $porcentaje_economico;
        $obra->update();
        

        
        
        return redirect()->route('obra.ver', ['id' => $request->id_obra_lista_edit]);
        //return $request;
    }

    public function store_factura (Request $request)
    {
        
        $request->validate([
            "id_obra_admin_factura" => 'required',
            "id_obra_factura" => 'required',
            "folio_fiscal_factura" => 'required',
            "fecha_factura" => 'required',
            "total_factura" => 'required',
            "concepto_factura" => 'required',
            "proveedor_id" => 'required',
        ]);
        $estado = 'ok';
        

        try{
        
                DB::beginTransaction();

                $factura = Factura::create([
                    "folio_fiscal" => $request->folio_fiscal_factura,
                    "concepto" => $request->concepto_factura,
                    "fecha" => $request->fecha_factura,
                    "total" => str_replace(",", '', $request->total_factura),
                    "proveedor_id" => $request->proveedor_id,
                    "obra_administracion_id" => $request->id_obra_admin_factura,
                ]);


                if($request->id_contrato_factura != ''){
                    //Cuando la factura tiene relacion con contrato factura
                    $contrato = ContratoFactura::create([
                        "factura_id" => $factura->id_factura,
                        "contrato_arrendamiento_id" => $request->id_contrato_factura,
                    ]);

                    $suma = ContratoFactura::where('contrato_arrendamiento_id', $request->id_contrato_factura)
                    ->join('facturas', 'facturas.id_factura', '=', 'factura_id')
                    ->select(
                        DB::raw('sum(total) as total'),
                    )
                    ->first()->total;

                    $contrato_arr = ContratosArrendamiento::find($request->id_contrato_factura)->monto_contratado;

                    if($suma > $contrato_arr){
                        $estado = 'error';
                    }else{
                        $estado = 'ok';
                        DB::commit();
                    }
                    
                }else{

                    $total_lista = ContratoListaRaya::where('obra_administracion_id',$request->id_obra_admin_factura)
                    ->select(
                        DB::raw('sum(total) as total'),
                    )
                    ->first();
                    

                    $total_facturas = Factura::where('obra_administracion_id',$request->id_obra_admin_factura)
                    ->leftJoin('contrato_facturas', 'contrato_facturas.factura_id', '=', 'id_factura')
                    ->where("contrato_arrendamiento_id", null)
                    ->select(
                        DB::raw('sum(total) as total'),
                    )
                    ->first();

                    $total_contrato= ContratosArrendamiento::where('obra_administracion_id',$request->id_obra_admin_factura)
                    ->select(
                        DB::raw('sum(monto_contratado) as total'),
                    )
                    ->first();

                    $total_ejercido = $total_lista->total + $total_facturas->total + $total_contrato->total;
                    
                    $obra = Obra::find($request->id_obra_factura);
                    
                    $porcentaje_economico = ($total_ejercido * 100)/$obra->monto_contratado;
                    $obra->avance_economico = $porcentaje_economico;
                    $obra->update();

                    if($porcentaje_economico > 100){
                        $estado = 'error';
                    }else{
                        $estado = 'ok';
                        DB::commit();
                    }
                }
                
        }
        catch (\Exception $e) {
            DB::rollback();
            $estado = "error";
        }


        if($request->id_contrato_factura != ''){
            return redirect()->route('show_contrato', ['id' => $request->id_contrato_factura, 'id_obra' => $request->id_obra_factura])->with('eliminar', $estado);
            
        }else{
            return redirect()->route('obra.ver', ['id' => $request->id_obra_factura])->with('eliminar',$estado);
        }
        
    }

    public function update_factura (Request $request)
    {

        $request->validate([
            "id_factura" => 'required',
            "id_obra_factura_edit" => 'required',
            "folio_fiscal_factura_edit" => 'required',
            "fecha_factura_edit" => 'required',
            "total_factura_edit" => 'required',
            "concepto_factura_edit" => 'required',
            "proveedor_id_edit" => 'required',
        ]);
        

        $factura = Factura::where('id_factura', $request->id_factura)->first();
        $factura->folio_fiscal = $request->folio_fiscal_factura_edit;
        $factura->concepto = $request->concepto_factura_edit;
        $factura->fecha = $request->fecha_factura_edit;
        $factura->total = str_replace(",", '', $request->total_factura_edit);
        $factura->proveedor_id = $request->proveedor_id_edit;
        $factura->update();

        $total_lista = ContratoListaRaya::where('obra_administracion_id',$factura->obra_administracion_id)
        ->select(
            DB::raw('sum(total) as total'),
        )
        ->first();

        $total_facturas = Factura::where('obra_administracion_id',$factura->obra_administracion_id)
        ->leftJoin('contrato_facturas', 'contrato_facturas.factura_id', '=', 'id_factura')
        ->where("contrato_arrendamiento_id", null)
        ->select(
            DB::raw('sum(total) as total'),
        )
        ->first();

        $total_contrato= ContratosArrendamiento::where('obra_administracion_id',$factura->obra_administracion_id)
        ->select(
            DB::raw('sum(monto_contratado) as total'),
        )
        ->first();

        $total_ejercido = $total_lista->total + $total_facturas->total + $total_contrato->total;
        
        $obra = Obra::find($request->id_obra_factura_edit);
        
        $porcentaje_economico = ($total_ejercido * 100)/$obra->monto_contratado;
        $obra->avance_economico = $porcentaje_economico;
        $obra->update();

        if($request->id_contrato_factura_edit != ''){
            return redirect()->route('show_contrato', ['id' => $request->id_contrato_factura_edit, 'id_obra' => $request->id_obra_factura_edit]);
        }else{
            return redirect()->route('obra.ver', ['id' => $request->id_obra_factura_edit]);
        }
        //return $request;
    }

    public function store_contrato (Request $request)
    {
    
        $request->validate([
            "id_obra_admin_contrato" => 'required',
            "id_obra_contrato" => 'required',
            "numero_contrato" => 'required',
            "fecha_contrato" => 'required',
            "total_contrato" => 'required',
            "proveedor_id_contrato" => 'required',
            "fecha_inicio_contrato" => 'required',
            "fecha_fin_contrato" => 'required',
        ]);

        try{
        
            DB::transaction(function() use($request){
    
                $contrato = ContratosArrendamiento::create([
                    "numero_contrato" => $request->numero_contrato,
                    "fecha_inicio" => $request->fecha_inicio_contrato,
                    "fecha_fin" => $request->fecha_fin_contrato,
                    "fecha_contrato" => $request->fecha_contrato,
                    "monto_contratado" => str_replace(",", '', $request->total_contrato),
                    "obra_administracion_id" => $request->id_obra_admin_contrato,
                    "proveedor_id" => $request->proveedor_id_contrato,
                ]);

                $total_lista = ContratoListaRaya::where('obra_administracion_id',$request->id_obra_admin_contrato)
                ->select(
                    DB::raw('sum(total) as total'),
                )
                ->first();

                $total_facturas = Factura::where('obra_administracion_id',$request->id_obra_admin_contrato)
                ->leftJoin('contrato_facturas', 'contrato_facturas.factura_id', '=', 'id_factura')
                ->where("contrato_arrendamiento_id", null)
                ->select(
                    DB::raw('sum(total) as total'),
                )
                ->first();

                $total_contrato= ContratosArrendamiento::where('obra_administracion_id',$request->id_obra_admin_contrato)
                ->select(
                    DB::raw('sum(monto_contratado) as total'),
                )
                ->first();

                $total_ejercido = $total_lista->total + $total_facturas->total + $total_contrato->total;
                
                $obra = Obra::find($request->id_obra_contrato);
                
                $porcentaje_economico = ($total_ejercido * 100)/$obra->monto_contratado;
                $obra->avance_economico = $porcentaje_economico;
                $obra->update();
                
            });
        }
        catch (\Exception $e) {
            DB::rollback();
        }
        
        return redirect()->route('obra.ver', ['id' => $request->id_obra_contrato]);
        //return $request;
    }

    public function show_contrato ($id, $obra_id)
    {

        $obra = Obra::where('id_obra', $obra_id)
        ->join('obras_fuentes', 'obras_fuentes.obra_id', '=', 'id_obra')
        ->join('fuentes_clientes', 'fuentes_clientes.id_fuente_financ_cliente', '=', 'fuente_financiamiento_cliente_id')
        ->join('fuentes_financiamientos', 'fuentes_financiamientos.id_fuente_financiamiento', '=', 'fuente_financiamiento_id')
        ->join('clientes', 'clientes.id_cliente', '=', 'cliente_id')
        ->join('municipios', 'municipios.id_municipio', '=', 'municipio_id')
        ->join('distritos', 'distritos.id_distrito', '=', 'distrito_id')
        ->join('regiones', 'regiones.id_region', '=', 'region_id')
        ->join('estados', 'estados.id_estado', '=', 'estado_id')
        ->select('id_obra','avance_fisico','nombre_localidad','municipios.nombre as nombre_municipio', 'distritos.nombre as nombre_distrito', 'regiones.nombre as nombre_region', 'estados.nombre as nombre_estado', 'oficio_notificacion', 'monto_contratado', 'monto_modificado', 'nombre_obra', 'fecha_inicio_programada', 'fecha_final_programada', 'id_obra', 'anticipo_porcentaje', 'anticipo_monto', 'modalidad_ejecucion', 'obras.nombre_corto as nombre_corto_obra', 'ejercicio', 'municipio_id', 'fecha_final_real')
        ->first();

        $contrato = ContratosArrendamiento::where('id_contrato_arrendamiento',$id)
        ->join('proveedores', 'proveedores.id_proveedor', '=', 'proveedor_id')
        ->first();
        

        $facturas = ContratoFactura::where('contrato_arrendamiento_id', $id)
        ->join("facturas", "facturas.id_factura", "=", "factura_id")
        ->join("proveedores", 'proveedores.id_proveedor', '=', 'proveedor_id')
        ->get();

        $total_admin = ContratoFactura::where('contrato_arrendamiento_id', $id)
        ->join("facturas", "facturas.id_factura", "=", "factura_id")
        ->select(
            DB::raw('sum(total) as total'),
        )
        ->first()->total;

        
        return view('obra.show_contrato',compact('obra', 'contrato', 'facturas', 'total_admin'));

    }

    public function update_fuente(Request $request)
    {
        $request->validate([
            'acta_integracion_consejo_edit' => 'required',
            'acta_priorizacion_edit' => 'required',
        ]);
        $fuenteCliente = FuentesCliente::find($request->fuente_id_edit);        

        if($fuenteCliente->fuente_financiamiento_id == 2){
            $anexos_fondo3 = AnexosFondoIII::where("fuente_financiamiento_cliente_id", $request->fuente_id_edit)->first();
            $anexos_fondo3->acta_integracion_consejo = $request->acta_integracion_consejo_edit;
            $anexos_fondo3->acta_priorizacion = $request->acta_priorizacion_edit;
            $anexos_fondo3->adendum_priorizacion = $request->adendum_priorizacion_edit;
            $anexos_fondo3->update();
        }        

        return redirect()->route('cliente.ejercicio', ['id' => $fuenteCliente->cliente_id, 'anio' => $fuenteCliente->ejercicio]);
    }

    public function store_prodim(Request $request)
    {
        

        $request->validate([
            'cliente_id' => 'required',
            'prodim_id' => 'required',
            'ejercicio' => 'required',
            'programa_id' => 'required',
            'fecha_asignacion' => 'required',
            'monto_prodim' => 'required',
        ]);

        $prodim_comprometido = ProdimComprometido::create([
            'prodim_id' => $request->prodim_id,
            'fecha_comprometido'=> $request->fecha_asignacion,
            'monto'=>str_replace(",", '', $request->monto_prodim),
            'prodim_catalogo_id' => $request->programa_id,
        ]);
        return redirect()->route('cliente.ejercicio', ['id' => $request->cliente_id, 'anio' => $request->ejercicio]);
    }

    public function store_concepto(Request $request)
    {


        $request->validate([
            'cliente_id' => 'required',
            'comprometido_id' => 'required',
            'ejercicio' => 'required',
            'monto_concepto' => 'required',
            'concepto_prodim' => 'required',
        ]);

        $comprometido = ComprometidoDesglose::create([
            'comprometido_id' =>$request->comprometido_id ,
            'concepto'=>$request->concepto_prodim,
            'monto_desglose' => str_replace(",", '', $request->monto_concepto),
        ]);
        
        return redirect()->route('cliente.ejercicio', ['id' => $request->cliente_id, 'anio' => $request->ejercicio]);
    }

    public function update_prodim(Request $request)
    {
        $prodim = Prodim::find($request->prodim_id);
        $prodim->presentado = $request->fecha_presentado?1:$prodim->presentado;
        $prodim->fecha_presentado = $request->fecha_presentado?$request->fecha_presentado:$prodim->fecha_presentado;

        $prodim->revisado = $request->fecha_revisado?1:$prodim->revisado;
        $prodim->fecha_revisado = $request->fecha_revisado?$request->fecha_revisado:$prodim->fecha_revisado;

        $prodim->aprovado = $request->fecha_aprovado?1:$prodim->aprovado;
        $prodim->fecha_aprovado = $request->fecha_aprovado?$request->fecha_aprovado:$prodim->fecha_aprovado;

        $prodim->convenio = $request->fecha_convenio?1:$prodim->convenio;
        $prodim->fecha_convenio = $request->fecha_convenio?$request->fecha_convenio:$prodim->fecha_convenio;
        $prodim->update();
    
        
        return redirect()->route('cliente.ejercicio', ['id' => $request->cliente_id, 'anio' => $request->ejercicio]);
    }

    public function store_gi(Request $request)
    {        
        $request->validate([
            'cliente_id' => 'required',
            'fuente_id' => 'required',
            'ejercicio' => 'required',
            'gi_catalogo_id' => 'required',
            'fecha_asignacion_gi' => 'required',
            'monto_gi' => 'required',
        ]);

        $gastos_indirecto = GastosIndirectosFuentes::create([
            'indirectos_id' =>$request->gi_catalogo_id,
            'fuente_cliente_id'=>$request->fuente_id,
            'monto' => str_replace(",", '', $request->monto_gi),
        ]);
        
        return redirect()->route('cliente.ejercicio', ['id' => $request->cliente_id, 'anio' => $request->ejercicio]);
    }

    public function update_sisplade(Request $request)
    {   

        $request->validate([
            'cliente_id' => 'required',
            'sisplade_id' => 'required',
            'ejercicio' => 'required',
        ]);

        $sisplade = Sisplade::find($request->sisplade_id);
        $sisplade->capturado = $request->fecha_capturado?1:2;
        $sisplade->fecha_capturado = $request->fecha_capturado;
        $sisplade->validado = $request->fecha_validacion?1:2;
        $sisplade->fecha_validado = $request->fecha_validacion;

        $sisplade->update();
        
        return redirect()->route('cliente.ejercicio', ['id' => $request->cliente_id, 'anio' => $request->ejercicio]);
    }

    public function update_mids(Request $request)
    {   

        $request->validate([
            'fecha_planeacion' => 'required',
        ]);


        $mids = Mids::find($request->mids_id);
        $mids->fecha_planeado = $request->fecha_planeacion;
        $mids->firmado = $request->fecha_firma?1:2;
        $mids->fecha_firmado = $request->fecha_firma;
        $mids->validado = $request->fecha_revision?1:2;
        $mids->fecha_validado = $request->fecha_revision;


        $mids->update();
        
        return redirect()->route('cliente.ejercicio', ['id' => $request->cliente_id, 'anio' => $request->ejercicio]);
    }

    public function imprimir($id){
        $obra = Obra::where('id_obra', $id)
        ->join('obras_fuentes', 'obras_fuentes.obra_id', '=', 'id_obra')
        ->join('fuentes_clientes', 'fuentes_clientes.id_fuente_financ_cliente', '=', 'fuente_financiamiento_cliente_id')
        ->join('fuentes_financiamientos', 'fuentes_financiamientos.id_fuente_financiamiento', '=', 'fuente_financiamiento_id')
        ->join('clientes', 'clientes.id_cliente', '=', 'cliente_id')
        ->join('municipios', 'municipios.id_municipio', '=', 'municipio_id')
        ->join('distritos', 'distritos.id_distrito', '=', 'distrito_id')
        ->join('regiones', 'regiones.id_region', '=', 'region_id')
        ->join('estados', 'estados.id_estado', '=', 'estado_id')
        ->select('id_obra', 'numero_obra', 'nombre_localidad','municipios.nombre as nombre_municipio', 'distritos.nombre as nombre_distrito', 'regiones.nombre as nombre_region', 'estados.nombre as nombre_estado', 'oficio_notificacion', 'monto_contratado', 'monto_modificado', 'nombre_obra', 'fecha_inicio_programada', 'fecha_final_programada', 'fecha_final_real', 'id_obra', 'anticipo_porcentaje', 'modalidad_ejecucion', 'obras.nombre_corto as nombre_corto_obra', 'ejercicio', 'anticipo_monto', 'id_municipio', 'avance_fisico', 'avance_economico', 'avance_tecnico')
        ->first();

        $observaciones = ObraObservaciones::where('obra_id', $obra->id_obra)->first();
        if($observaciones != null){
            $observaciones->observacion = explode ( "\r\n", $observaciones->observacion );
        }
        

        $fuentes_financiamiento = ObrasFuentes::where('obra_id', $id)
        ->join('fuentes_clientes', 'fuentes_clientes.id_fuente_financ_cliente', '=', 'fuente_financiamiento_cliente_id')
        ->join('fuentes_financiamientos', 'fuentes_financiamientos.id_fuente_financiamiento', '=', 'fuente_financiamiento_id')
        ->select('nombre_corto', 'monto')
        ->get();

        $acta_priorizacion = ObrasFuentes::where('obra_id', $id)
        ->join('fuentes_clientes', 'fuentes_clientes.id_fuente_financ_cliente', '=', 'fuente_financiamiento_cliente_id')
        ->join('fuentes_financiamientos', 'fuentes_financiamientos.id_fuente_financiamiento', '=', 'fuente_financiamiento_id')
        ->join('anexos_fondo3', 'anexos_fondo3.fuente_financiamiento_cliente_id', '=', 'id_fuente_financ_cliente')
        ->select('acta_priorizacion')
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
            $convenios = ConveniosModificatorio::where('obra_contrato_id',$obra_contrato->obra_contrato_id)
            ->select("id_convenio_modificatorio", "numero_convenio_modificatorio","fecha_convenio","tipo","monto_modificado","fecha_fin_modificada","agregado_expediente","obra_contrato_id")
            ->orderBy("id_convenio_modificatorio")
            ->get();
        }
        //return $convenios;

        $estimaciones = null;
        
        if($obra_contrato != null) {
            $estimaciones = DesglosePagosObra::where('obra_contrato_id',$obra_contrato->obra_contrato_id)
            ->join('estimaciones', 'estimaciones.desglose_pagos_id', '=', 'desglose_pagos_obra.id_desglose_pagos')
            ->get();
        }
        

        $pagos_obra = null;
        
        if($obra_contrato != null) {
            $pagos_obra = DesglosePagosObra::where('obra_contrato_id',$obra_contrato->obra_contrato_id)
            ->get();
        }
        
        
        $total_pagado = null;
        
        if($obra_contrato != null) {
            $total_pagado = DesglosePagosObra::where('obra_contrato_id',$obra_contrato->obra_contrato_id)
            ->join('estimaciones', 'estimaciones.desglose_pagos_id', '=', 'desglose_pagos_obra.id_desglose_pagos')
            ->select(
                DB::raw('sum(total_estimacion ) as total_estimaciones'),
                DB::raw('sum(total_estimacion - amortizacion_anticipo) as total_obra'),
                DB::raw('sum(amortizacion_anticipo) as total_anticipo'),
            )
            ->first();

        }

        $total_admin = null;
        
        if($obra_admin != null) {
            $total_lista = ContratoListaRaya::where('obra_administracion_id',$obra_admin->id_obra_administracion)
            ->select(
                DB::raw('sum(total) as total_listas'),
            )
            ->first();

            $total_factura = Factura::where('obra_administracion_id',$obra_admin->id_obra_administracion)
            ->leftJoin('contrato_facturas', 'contrato_facturas.factura_id', '=', 'id_factura')
            ->where("contrato_arrendamiento_id", null)
            ->select(
                DB::raw('sum(total) as total_facturas'),
            )
            ->first();

            $total_contrato= ContratosArrendamiento::where('obra_administracion_id',$obra_admin->id_obra_administracion)
            ->select(
                DB::raw('sum(monto_contratado) as total_contratos'),
            )
            ->first();

            $total_admin = $total_lista->total_listas + $total_factura->total_facturas + $total_contrato->total_contratos;

        }
       

        $facturas = null;
        
        if($obra_admin != null) {
            $facturas = Factura::where('obra_administracion_id',$obra_admin->id_obra_administracion)
            ->join('proveedores', 'proveedores.id_proveedor','=','proveedor_id')
            ->leftJoin('contrato_facturas', 'contrato_facturas.factura_id', '=', 'id_factura')
            ->where("contrato_arrendamiento_id", null)
            ->orderBy('id_factura', 'asc')
            ->get();
        }


        $listas_raya = null;
        
        if($obra_admin != null) {
            $listas_raya = ContratoListaRaya::where('obra_administracion_id',$obra_admin->id_obra_administracion)
            ->select('fecha_inicio','fecha_fin','total','numero_lista_raya','isr','mano_obra','agregado_expediente','obra_administracion_id', 'id_lista_raya')
            ->orderBy('numero_lista_raya')
            ->get();
        }

        $contratos_arrendamiento = null;
        
        if($obra_admin != null) {
            $contratos_arrendamiento = DB::table('contratos_arrendamientos')
            ->where('obra_administracion_id',$obra_admin->id_obra_administracion)
            ->join('proveedores', 'proveedores.id_proveedor','=','proveedor_id')
            ->orderBy('id_contrato_arrendamiento', 'asc')
            ->get();
        }     
        
        $proveedores = null;
        
        if($obra_admin != null) {
            $proveedores = Proveedor::where('municipio_id', $obra->id_municipio)
            ->select('id_proveedor', 'razon_social', 'rfc')
            ->get();
        }
        $total_anticipo = $obra->anticipo_porcentaje * 0.01 * $obra->monto_contratado ;

        $a = new \NumberFormatter("mx-MX", 2);
        $total_anticipo = $a->format($total_anticipo);



        $obj_obra = collect(
            ['obra' => $obra,
            'contrato' => $obra_contrato,
            'admin' => $obra_admin,
            'social' => $obra_social,
            'licitacion'=>$obra_licitacion,
            ]
        );
        
        return view('pdf.ejemplo',compact('obj_obra', 'convenios', 'estimaciones', 'fuentes_financiamiento', 'acta_priorizacion', 'facturas', 'listas_raya', 'contratos_arrendamiento', 'total_pagado', 'pagos_obra', 'total_admin', 'proveedores', 'observaciones', 'total_anticipo'));
        $pdf = Pdf::loadView('pdf.ejemplo', compact('obj_obra', 'convenios', 'estimaciones', 'fuentes_financiamiento', 'acta_priorizacion', 'facturas', 'listas_raya', 'contratos_arrendamiento', 'total_pagado', 'pagos_obra', 'total_admin', 'proveedores', 'observaciones', 'total_anticipo'));
        return $pdf->download('ejemplo.pdf');
   }

}
