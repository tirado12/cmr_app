<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\FuentesCliente;
use App\Models\AnexosFondoIII;
use App\Models\FuentesFinanciamiento;
use App\Models\GastosIndirectosFuentes;
use App\Models\Municipio;
use App\Models\ObrasFuentes;
use App\Models\Prodim;
use App\Models\ProdimComprometido;
use App\Models\Sisplade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;




class FuenteClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$fuenteClientes = FuentesCliente::with('clientes','fuente')->get(); //tabla fuenteClientes segun existentes 
        $fuenteClientes= FuentesCliente::join('clientes','id_cliente','cliente_id')
        ->join('fuentes_financiamientos','id_fuente_financiamiento','fuente_financiamiento_id')
        ->leftjoin('anexos_fondo3','id_fuente_financ_cliente','fuente_financiamiento_cliente_id')
        ->leftjoin('prodim','fuente_id','id_fuente_financ_cliente')
        ->get();
        //return $fuenteClientes;
        $fuentes = FuentesFinanciamiento::all(); //todas las fuentes de financiamiento
        //$municipios = Municipio::all(); //todos los municipios
        $listaClientes = Cliente::join('municipios', 'id_municipio', '=', 'municipio_id') //clientes existentes con sus municipios
        ->select('clientes.id_cliente', 'municipios.nombre','municipios.id_municipio','clientes.anio_inicio','clientes.anio_fin')
        ->get();
        $cliente= $listaClientes->unique('id_municipio');
        //return $fuenteClientes;
        return view('fuentes_clientes.index', compact('fuenteClientes', 'cliente', 'fuentes','listaClientes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        //return FuentesCliente::with('anexosFondo')->get();
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
            //'monto_comprometido' => 'required',
            'ejercicio' => 'required',
            'cliente_id' =>'required',
            'fuente_financiamiento_id'=> 'required'
        ]);
        if(str_replace(",", '',$request->monto_comprometido) == null){
            $request->monto_comprometido = 0;
        }
        $fuenteCliente = FuentesCliente::create([
            'monto_proyectado' => str_replace(",", '', $request->monto_proyectado),
            'monto_comprometido' => str_replace(",", '',$request->monto_comprometido),
            'ejercicio' => $request->ejercicio,
            'cliente_id' => $request->cliente_id,
            'fuente_financiamiento_id' => $request->fuente_financiamiento_id
        ]);
        if($request->fuente_financiamiento_id == 2){
            if($request->prodim == null){
                $request->prodim = false;
                $request->porcentaje_prodim = null;
                $request->monto_prodim = null;
            }else{
                $request->prodim = true;
            }
            if($request->gastos_indirectos == null){
                $request->gastos_indirectos = false;
                $request->porcentaje_gastos = null;
                $request->monto_gastos = null;
            }else{
                $request->gastos_indirectos = true;
            }

            if($request->prodim != null){ //agregar a tabla prodim
                Prodim::create([
                    'fuente_id' => $fuenteCliente->id_fuente_financ_cliente
                ]);
            }

            AnexosFondoIII::create([
                'acta_integracion_consejo' => $request->acta_integracion,
                'acta_priorizacion' => $request->acta_priorizacion,
                'adendum_priorizacion' => $request->adendum,
                'prodim' => $request->prodim,
                'porcentaje_prodim' => $request->porcentaje_prodim,
                'monto_prodim' => str_replace(",", '',$request->monto_prodim),
                'gastos_indirectos' => $request->gastos_indirectos,
                'porcentaje_gastos' => $request->porcentaje_gastos,
                'monto_gastos' => str_replace(",", '',$request->monto_gastos),
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
        ->select('clientes.id_cliente', 'municipios.nombre','clientes.anio_inicio','clientes.anio_fin')
        ->get();
        
        $fuenteAnexos =FuentesCliente::leftjoin('anexos_fondo3','id_fuente_financ_cliente','fuente_financiamiento_cliente_id')
        ->leftjoin('prodim','fuente_id','id_fuente_financ_cliente')
        ->where("fuente_financiamiento_cliente_id", $fuenteCliente->id_fuente_financ_cliente)
        ->first();
        //return $fuenteAnexos;
        //$anexos_fondo3 = AnexosFondoIII::where("fuente_financiamiento_cliente_id", $fuenteCliente->id_fuente_financ_cliente)->first();
        
        return view('fuentes_clientes.edit',compact('fuenteCliente','cliente','fuentes','fuenteAnexos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FuentesCliente $fuenteCliente)
    {
        $request->validate([
            'monto_proyectado' => 'required',
            'fuente_financiamiento_id' => 'required',
        ]);
        $fuenteCliente->ejercicio = $request->ejercicio;
        $fuenteCliente->monto_proyectado = str_replace(",", '',$request->monto_proyectado);
        $aviso = '';
        
        if($request->fuente_financiamiento_id == 2){ //es fondo III el que llega
         $fuenteCliente->fuente_financiamiento_id = $request->fuente_financiamiento_id;
         $existeAnexos = AnexosFondoIII::where('fuente_financiamiento_cliente_id', $fuenteCliente->id_fuente_financ_cliente)->first();
            if($existeAnexos == null){ //si no hay un registro anexos
                if($request->prodim == null){ 
                    $request->prodim = false;
                    $request->porcentaje_prodim = null;
                }else{
                    $request->prodim = true;
                }
                if($request->gastos_indirectos == null){
                    $request->gastos_indirectos = false;
                    $request->porcentaje_gastos = null;
                }else{
                    $request->gastos_indirectos = true;
                }
                $anexosNuevo= AnexosFondoIII::create([
                        'acta_integracion_consejo' => $request->acta_integracion,
                        'acta_priorizacion' => $request->acta_priorizacion,
                        'adendum_priorizacion' => $request->adendum_priorizacion,
                        'prodim' => $request->prodim,
                        'porcentaje_prodim' => $request->porcentaje_prodim,
                        'monto_prodim' => str_replace(",", '',$request->monto_prodim),
                        'gastos_indirectos' => $request->gastos_indirectos,
                        'porcentaje_gastos' => $request->porcentaje_gastos,
                        'monto_gastos' => str_replace(",", '',$request->monto_gastos),
                        'fuente_financiamiento_cliente_id' => $fuenteCliente->id_fuente_financ_cliente,
                ]);
                if($request->prodim != null){ //si el check prodim esta seleccionado
                    Prodim::create([ 
                        'fuente_id' => $fuenteCliente->id_fuente_financ_cliente
                    ]);
                } 
            }else{ //si existe un registro anexos
                $existeAnexos->acta_integracion_consejo = $request->acta_integracion;
                $existeAnexos->acta_priorizacion = $request->acta_priorizacion;
                $existeAnexos->adendum_priorizacion = $request->adendum_priorizacion;
                $prodim = Prodim::where("fuente_id", $fuenteCliente->id_fuente_financ_cliente)->first(); //busca prodim del obj
                if($request->prodim == null){  //check prodim vacio - quitar prodim
                    if($prodim != null){// tiene prodim
                        $prodimComprometido= ProdimComprometido::where('prodim_id',$prodim->id_prodim)->first(); //busca prodim comprometido
                        if($prodimComprometido != null){ //tiene prodim comprometido
                            $aviso = 'errorProdim'; //manda msj de error
                        }else{                          //no tiene comprometido 
                            $existeAnexos->prodim = false; //borra registro de prodim y lo quita de anexos
                            $existeAnexos->porcentaje_prodim = null;
                            $existeAnexos->monto_prodim = null;
                            $prodim->delete();
                        }
                    }
                }else{ //check seleccionado
                    
                    if($prodim == null){ //si no tiene prodim
                        Prodim::create([ 
                            'fuente_id' => $fuenteCliente->id_fuente_financ_cliente
                        ]);
                     }
                     $existeAnexos->prodim = true; //agrega prodim a anexos
                     $existeAnexos->porcentaje_prodim = $request->porcentaje_prodim;
                     $existeAnexos->monto_prodim = str_replace(",", '',$request->monto_prodim);
                }

                $existeGastosFuente = GastosIndirectosFuentes::where('fuente_cliente_id', $fuenteCliente->id_fuente_financ_cliente)->first(); 
                if($request->gastos_indirectos == null){  //check gastos vacio 
                    if($existeGastosFuente != null){
                        $aviso = 'errorProdim'; 
                    }else{
                        $existeAnexos->gastos_indirectos = false; //borra registro de prodim y lo quita de anexos
                        $existeAnexos->porcentaje_gastos = null;
                        $existeAnexos->monto_gastos = null;
                    }
                }else{ //check seleccionado
                    $existeAnexos->gastos_indirectos = true; 
                    $existeAnexos->porcentaje_gastos = $request->porcentaje_gastos;
                    $existeAnexos->monto_gastos = str_replace(",", '',$request->monto_gastos);
                }

                $existeAnexos->update();
            }

         
        }else{ //cambio de fuente dif al III
            $bandera = true; //confirmamos si alguna de las 
            $prodim = Prodim::where("fuente_id", $fuenteCliente->id_fuente_financ_cliente)->first();
            $existeGastosFuente = GastosIndirectosFuentes::where('fuente_cliente_id', $fuenteCliente->id_fuente_financ_cliente)->first();
                if($request->prodim == null || $request->gastos_indirectos == null){ //si los check estan vacios
                    if($existeGastosFuente != null){ //si hay un registro en gastos indirectos
                        $bandera = false;
                    }
                    if($prodim != null ){  //tiene prodim - verifica
                        $prodimComprometido= ProdimComprometido::where('prodim_id',$prodim->id_prodim)->first();
                        if($prodimComprometido != null ){ //si tiene comprometido
                            $bandera = false;
                        }
                    }
                }    
                if($bandera == true){
                    $anexos_fondo3 = AnexosFondoIII::where("fuente_financiamiento_cliente_id", $fuenteCliente->id_fuente_financ_cliente)->first();
                    $fuenteCliente->fuente_financiamiento_id = $request->fuente_financiamiento_id;
                    $prodim->delete();
                    $anexos_fondo3->delete();
                }else{
                    $aviso = 'errorProdim';
                }            
                
        }

        $fuenteCliente->update();

        if(auth()->user()->getRoleNames()[0] == 'Administrador')
            return redirect()->route('fuenteCliente.index')->with('eliminar',$aviso);
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
        $existeGastosFuente = GastosIndirectosFuentes::where('fuente_cliente_id', $fuenteCliente->id_fuente_financ_cliente)->exists();
        $existeSisplade = Sisplade::where('fuentes_clientes_id',$fuenteCliente->id_fuente_financ_cliente)->exists();
        $existeProdim = Prodim::where('fuente_id', $fuenteCliente->id_fuente_financ_cliente)->exists();
        $existeObrasFuentes = ObrasFuentes::where('fuente_financiamiento_cliente_id', $fuenteCliente->id_fuente_financ_cliente)->exists();
        if($existeGastosFuente == null && $existeSisplade==null && $existeProdim==null && $existeObrasFuentes==null){
            $fuenteCliente->delete();
            return redirect()->route('fuenteCliente.index')->with('eliminar','ok');
        }else{
            return redirect()->route('fuenteCliente.index')->with('eliminar','error');
        }
        
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

    //======================================================================


    public function getEjercicioDisponible($cliente_id, $ejercicio, $fuente){
        $existe = FuentesCliente::where('cliente_id',$cliente_id)
        ->where('ejercicio',$ejercicio)
        ->where('fuente_financiamiento_id',$fuente)
        ->get();
        return $existe;
        if($existe == 1)
        return $existe;
        else
        return 0;
    }

}
