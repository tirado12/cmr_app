<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\FuentesCliente;
use App\Models\AnexosFondoIII;
use App\Models\FuentesFinanciamiento;
use App\Models\Municipio;
use App\Models\Prodim;
use App\Models\Sisplade;
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
        
        
        $request->validate([
            'monto_proyectado' => 'required',
            'monto_comprometido' => 'required',
            'ejercicio' => 'required',
            'cliente_id' =>'required',
            'fuente_financiamiento_id'=> 'required'
        ]);
        $fuenteCliente = FuentesCliente::create([
            'monto_proyectado' => str_replace(",", '', $request->monto_proyectado),
            'monto_comprometido' => $request->monto_comprometido,
            'ejercicio' => $request->ejercicio,
            'cliente_id' => $request->cliente_id,
            'fuente_financiamiento_id' => $request->fuente_financiamiento_id
        ]);
        if($request->fuente_financiamiento_id == 2){
            $request->prodim = $request->prodim == null? false:true;
            $request->gastos_indirectos = $request->gastos_indirectos == null? false:true;

            $monto_prodim = str_replace(",", '', $request->monto_proyectado) * ($request->porcentaje_prodim * 0.01);
            $monto_gastos = str_replace(",", '', $request->monto_proyectado) * ($request->porcentaje_gastos * 0.01);

            if($request->prodim != null){ //agregar a tabla prodim
                Prodim::create([
                    'fuente_id' => $fuenteCliente->id_fuente_financ_cliente
                ]);

                Sisplade::create([
                    'fuentes_clientes_id' => $fuenteCliente->id_fuente_financ_cliente
                ]);
            }
            

            AnexosFondoIII::create([
                'acta_integracion_consejo' => $request->acta_integracion_consejo,
                'acta_priorizacion' => $request->acta_priorizacion,
                'adendum_priorizacion' => $request->adendum_priorizacion,
                'prodim' => $request->prodim,
                'gastos_indirectos' => $request->gastos_indirectos,
                'porcentaje_prodim' => $request->porcentaje_prodim,
                'monto_prodim' => round($monto_prodim,2),
                'porcentaje_gastos' => $request->porcentaje_gastos,
                'monto_gastos' => round($monto_gastos,2),
                'fuente_financiamiento_cliente_id' => $fuenteCliente->id_fuente_financ_cliente,
            ]);
        }

        if(auth()->user()->getRoleNames()[0] == 'Administrador')
            return redirect()->route('fuenteCliente.index');
        else
            return redirect()->route('cliente.ejercicio', ['id' => $request->cliente_id, 'anio' => $request->ejercicio]);
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
        
        $cliente = Cliente::join('municipios', 'id_municipio', '=', 'municipio_id')
        ->where('id_cliente',$fuenteCliente->cliente_id)
        ->select('clientes.id_cliente', 'municipios.nombre')
        ->get();

        //return $fuenteCliente;
       return view('fuentes_clientes.edit',compact('fuenteCliente','cliente','fuentes'));
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

        $request->validate([
            'monto_proyectado_edit' => 'required',
            'monto_comprometido_edit' => 'required',
            'acta_integracion_consejo_edit' => 'required',
            'acta_priorizacion_edit' => 'required',
            'fuente_financiamiento_id_edit' => 'required'
        ]);
        $fuenteCliente = FuentesCliente::find($request->fuente_id_edit);
        $fuenteCliente->monto_proyectado = str_replace(",", '', $request->monto_proyectado_edit);
        if($request->fuente_financiamiento_id_edit == 2){
            $anexos_fondo3 = AnexosFondoIII::where("fuente_financiamiento_cliente_id", $request->fuente_id_edit)->first();
            $anexos_fondo3->acta_integracion_consejo = $request->acta_integracion_consejo_edit;
            $anexos_fondo3->acta_priorizacion = $request->acta_priorizacion_edit;
            $anexos_fondo3->adendum_priorizacion = $request->adendum_priorizacion_edit;
            
            if($request->prodim_edit == null){
                $anexos_fondo3->prodim = false;
            }else{
                $anexos_fondo3->prodim = true;
            }
            if($request->gastos_indirectos_edit == null){
                $anexos_fondo3->gastos_indirectos = false;
            }else{
                $anexos_fondo3->gastos_indirectos = true;
            }
            
            $anexos_fondo3->update();
        }
        
        
        //return $request;
        $fuenteCliente->update();
        //return $fuenteCliente;

        if(auth()->user()->getRoleNames()[0] == 'Administrador')
            return redirect()->route('fuenteCliente.index');
        else
            return redirect()->route('cliente.ejercicio', ['id' => $fuenteCliente->cliente_id, 'anio' => $fuenteCliente->ejercicio]);
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
