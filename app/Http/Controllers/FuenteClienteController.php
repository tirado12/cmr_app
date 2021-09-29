<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\FuentesCliente;
use App\Models\FuentesFinanciamiento;
use App\Models\Municipio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FuenteClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fuenteClientes = FuentesCliente::with('clientes','fuente')->get(); //tabla fuenteClientes segun existentes 
        
        $fuentes = FuentesFinanciamiento::all(); //todas las fuentes de financiamiento
        //$municipios = Municipio::all(); //todos los municipios
        $cliente = Cliente::join('municipios', 'id_municipio', '=', 'municipio_id') //clientes existentes con sus municipios
        ->select('clientes.id_cliente', 'municipios.nombre')
        ->get();
        //return $fuenteClientes;
        return view('fuentes_clientes.index', compact('fuenteClientes', 'cliente', 'fuentes'));
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
        //return $request;
        $request->validate([
            'monto_proyectado' => 'required',
            'monto_comprometido' => 'required',
            'ejercicio' => 'required',
            'cliente_id' =>'required',
            'fuente_financiamiento_id'=> 'required'
        ]);
        FuentesCliente::create([
            'monto_proyectado' => $request->monto_proyectado,
            'monto_comprometido' => $request->monto_comprometido,
            'acta_integracion_consejo' => $request->acta_integracion_consejo,
            'acta_priorizacion' => $request->acta_priorizacion,
            'adendum_priorizacion' => $request->adendum_priorizacion,
            'prodim' => $request->prodim,
            'gastos_indirectos' => $request->gastos_indirectos,
            'ejercicio' => $request->ejercicio,
            'cliente_id' => $request->cliente_id,
            'fuente_financiamiento_id' => $request->fuente_financiamiento_id
        ]);
        return redirect()->route('fuenteCliente.index');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('fuentes_clientes.vista');
    }
     /**
     * Show the form for editing the specified resource.
     *
     * @param  User  $users
     * @return \Illuminate\Http\Response
     */
    public function edit(FuentesCliente $fuenteCliente)
    {
        $fuentes = FuentesFinanciamiento::all();

        $cliente = Cliente::join('municipios', 'id_municipio', '=', 'municipio_id')->where('id_cliente',$fuenteCliente->cliente_id)
        ->select('clientes.id_cliente', 'municipios.nombre')
        ->get();
        //return $fuentes;
       return view('fuentes_clientes.edit',compact('fuenteCliente','cliente','fuentes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,FuentesCliente $fuenteCliente)
    {
        $request->validate([
            'monto_proyectado' => 'required',
            'monto_comprometido' => 'required',
            'acta_integracion_consejo' => 'required',
            'acta_priorizacion' => 'required',
            'adendum_priorizacion' => 'required',
            'prodim' => 'required',
            'gastos_indirectos' => 'required',
            'fuente_financiamiento_id' => 'required'
        ]);
        //return $request;
        $fuenteCliente->update($request->all());
        //return $fuenteCliente;
       return redirect()->route('fuenteCliente.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(FuentesCliente $fuenteCliente)
    {
        $fuenteCliente->delete();
        return redirect()->route('fuenteCliente.index')->with('eliminar','ok');
    }
    // ======================= Funciones API ========================= //
    public function getFuentesCliente($cliente_id, $anio){
        $users = DB::table('fuentes_clientes')->join('fuentes_financiamientos', 'fuente_financiamiento_id', '=', 'fuentes_financiamientos.id_fuente_financiamiento')->select('id_fuente_financ_cliente', 'monto_proyectado', 'monto_comprometido', 'nombre_corto', )
            ->orWhere(function($query) use($cliente_id, $anio) {
                $query
                ->where('cliente_id', $cliente_id)
                    ->where('ejercicio',$anio);
            })
            ->get();
        return $users;
    }

}
