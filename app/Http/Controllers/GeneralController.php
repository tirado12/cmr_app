<?php

namespace App\Http\Controllers;
use App\Models\Cliente;
use App\Models\Municipio;
use App\Models\FuentesCliente;
use App\Models\ObrasFuentes;
use App\Models\FuentesFinanciamiento;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

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
            ->join('fuentes_clientes', 'fuentes_clientes.cliente_id', '=', 'id_cliente')
            ->join('obras_fuentes', 'obras_fuentes.fuente_financiamiento_cliente_id', '=', 'fuentes_clientes.id_fuente_financ_cliente')
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
                DB::raw('count(distinct obra_id) as obras_count'),
            )
            ->groupBy('id_municipio', 'nombre_municipio', 'anio_inicio', 'anio_fin', 'id_cliente','rfc', 'nombre_distrito')
            ->get();
        
        $obras_anio = Cliente::join('municipios', 'municipios.id_municipio', '=', 'municipio_id')
            ->join('fuentes_clientes', 'fuentes_clientes.cliente_id', '=', 'id_cliente')
            ->join('obras_fuentes', 'obras_fuentes.fuente_financiamiento_cliente_id', '=', 'fuentes_clientes.id_fuente_financ_cliente')
            ->where('anio_fin','>=', $anio)
            ->select(
                'id_municipio',
                'ejercicio',
                DB::raw('count(distinct obra_id) as obras_count'),
            )
            ->groupBy('id_municipio', 'nombre', 'anio_inicio', 'anio_fin', 'id_cliente', 'ejercicio')
            ->get();

        
        return view('dashboard', compact('clientes', 'obras_anio'));
    }

    function ejercicio($id, $anio){
        $fuentes_cliente = FuentesCliente::with('obrasFuente', 'obras')
        ->where("cliente_id",$id)
        ->where('ejercicio',$anio)
        ->join('fuentes_financiamientos', 'fuentes_financiamientos.id_fuente_financiamiento', '=', 'fuentes_clientes.fuente_financiamiento_id')
        ->join('anexos_fondo3', 'anexos_fondo3.fuente_financiamiento_cliente_id', '=', 'id_fuente_financ_cliente', 'left outer')
        ->get();


        $fuentes = FuentesFinanciamiento::join('fuentes_clientes', 'fuentes_clientes.fuente_financiamiento_id', '=', 'id_fuente_financiamiento', 'left outer')
        ->where('id_fuente_financ_cliente','=', null)
        ->get();

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



        return view('ejercicio.ejercicio', compact('fuentes_cliente', 'obras', 'cliente', 'anio', 'fuentes'));
    }

}
