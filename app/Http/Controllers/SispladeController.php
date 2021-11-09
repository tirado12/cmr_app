<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\FuentesCliente;
use App\Models\Sisplade;
use App\Models\FuentesFinanciamiento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;

class SispladeController extends Controller
{
    //
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       //$sisplade= Sisplade::join('fuentes_clientes','id_fuente_financ_cliente','fuentes_clientes_id')->get();
       $sisplade = Sisplade::with('fuentesCliente')->get();
       $fuentesCliente = FuentesCliente::with('clientes')->get();
       $clientes = Cliente::join('municipios', 'id_municipio', '=', 'municipio_id') //clientes existentes con sus municipios
       ->select('clientes.id_cliente', 'municipios.nombre')
       ->get();
       $fuentes = FuentesFinanciamiento::all(); //todas las fuentes de financiamiento
       //return $clientes->find($fuentesCliente[1]->cliente_id)->nombre;
        
        //return $clientes;
        return view('sisplade.index',compact('fuentes','sisplade','fuentesCliente','clientes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {       
       $clientesDisponibles = FuentesCliente::join('clientes','cliente_id','id_cliente')
       ->join('municipios', 'clientes.municipio_id','municipios.id_municipio')
       ->where('fuente_financiamiento_id', 2)
       ->select('cliente_id','nombre','id_municipio')
       ->get(); //tabla fuenteClientes segun existentes 

       $clientes = $clientesDisponibles->unique('id_municipio');
       
      // $fuentes = FuentesFinanciamiento::all(); //todas las fuentes de financiamiento
       //$cli = Cliente::has('municipio')->get();
       //return $clientes->find($fuenteClientes[0]->cliente_id)->nombre;
        //return $clientes;
        return view('sisplade.add_sisplade',compact('clientes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->capturado == 'on'){
            $capturado = 1;
        }else{
             $capturado = 0;
             $request['fecha_capturado']=null;
        }
        if($request->validado == 'on'){
              $validado = 1;
         }else{
              $validado = 0;
              $request['fecha_validacion']=null;
         }
         $request->merge([
             'capturado' => $capturado,
             'validado' => $validado
         ]);
        $request->validate([
            'fuenteCliente_id' => 'required',
            'capturado' => 'nullable',
            'fecha_capturado' => 'nullable',
            'validado' =>'nullable',
            'fecha_validado'=> 'nullable'
        ]);
        Sisplade::create([
            'fuentes_clientes_id' => $request->fuenteCliente_id,
            'capturado' => $request->capturado,
            'fecha_capturado' => $request->fecha_capturado,
            'validado' => $request->validado,
            'fecha_validado'=> $request->fecha_validado
            ]);
            //return response()->json(['url'=>url('/sisplade')]);
            return redirect()->route('sisplade.index');
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
    public function edit(Sisplade $sisplade)
    {
        $fuentesClientes = FuentesCliente::whereHas('sisplade',  function(Builder $query) use($sisplade){
          $query->where('id_fuente_financ_cliente', $sisplade->fuentes_clientes_id);
        })
        ->get();
        $clientes = Cliente::join('municipios', 'id_municipio', '=', 'municipio_id') //clientes existentes con sus municipios
       ->select('clientes.id_cliente', 'municipios.nombre')
       ->get();
        $fuentes=FuentesFinanciamiento::all();
       //return $sisplade;
       return view('sisplade.edit', compact('fuentesClientes','clientes','fuentes','sisplade'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sisplade $sisplade)
    {   
       if($request->capturado == 'on'){
            $capturado = 1;
       }else{
            $capturado = 0;
            $request['fecha_capturado']=null;
       }
       if($request->validado == 'on'){
             $validado = 1;
        }else{
             $validado = 0;
             $request['fecha_validacion']=null;
        }
        $request->merge([
            'capturado' => $capturado,
            'validado' => $validado
        ]);
       $sisplade->update($request->all());
       return redirect()->route('sisplade.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sisplade $sisplade)
    {
        $sisplade->delete();
        return redirect()->route('sisplade.index')->with('eliminar','ok');
    }

    //========== funciones para select dinamico =================
    public function obtenerFuenteCliente($ejercicio,$cliente){
        //obtenemos las fuentes de financiamiento de las relacion Fuentesclientes existentes, a su vez filtramos segun el cliente elegido
        $fuenteCli = FuentesCliente::join('fuentes_financiamientos','id_fuente_financiamiento','fuente_financiamiento_id')
        ->where('cliente_id', $cliente)
        ->where('ejercicio', $ejercicio)
        ->where('fuente_financiamiento_id', 2)
        ->select('id_fuente_financ_cliente','nombre_corto')
        ->get();        
        return response()->json($fuenteCli);
        //return $fuenteCli;
    }

    public function selectEjercicio($cliente){ //obtiene los ejercicios disponibles del cliente seleccionado
        // $fuenteClie = FuentesCliente::whereHas('clientes', function(Builder $query) use($cliente) { 
        //     $query->where('cliente_id', $cliente)->where('fuente_financiamiento_id', 2);
        // })
        // ->select('ejercicio','cliente_id')
        // ->get();  
        $fuenteClie = FuentesCliente::join('clientes','cliente_id','id_cliente')
        ->join('municipios', 'clientes.municipio_id','municipios.id_municipio')
        ->where('fuente_financiamiento_id', 2)
        ->where('municipio_id',$cliente)
        ->select('cliente_id','ejercicio')
        ->get(); //tabla fuenteClientes segun existentes  
        return $fuenteClie;
    }

    public function existeEjercicio($cliente){
        $existe = Sisplade::where('fuentes_clientes_id', $cliente)->exists();
        if ($existe == null)
        return 0;
        else
        return $existe;
    }

    /*public function fuentesClientes($ejercicio,$cliente,$fuente){
        $fuenteClie = FuentesCliente::whereHas('clientes', function(Builder $query) use($ejercicio,$cliente,$fuente) { 
            $query->where('cliente_id', $cliente)->where('ejercicio', $ejercicio)->where('fuente_financiamiento_id', $fuente);
        })
        ->get();  
        return $fuenteClie;
    }*/

}
