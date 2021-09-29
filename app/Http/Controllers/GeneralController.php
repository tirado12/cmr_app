<?php

namespace App\Http\Controllers;
use App\Models\Cliente;
use App\Models\Municipio;
use App\Models\FuentesCliente;
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
        $fuentes = FuentesCliente::where("cliente_id",$id)
        ->where('ejercicio',$anio)
        ->join('fuentes_financiamientos', 'fuentes_financiamientos.id_fuente_financiamiento', '=', 'fuentes_clientes.fuente_financiamiento_id')
        ->get();
        return $fuentes;
        
    }

}
