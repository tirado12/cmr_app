<?php

namespace App\Http\Controllers;

use App\Models\AnexosFondoIII;
use App\Models\FuentesCliente;
use App\Models\GastosIndirectosFuentes;
use App\Models\Prodim;
use App\Models\ProdimComprometido;
use Illuminate\Http\Request;

use function Symfony\Component\VarDumper\Dumper\esc;

class AnexosFondoIIIController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $anexos = AnexosFondoIII::join('fuentes_clientes','id_fuente_financ_cliente','fuente_financiamiento_cliente_id')
        ->join('clientes','id_cliente','cliente_id')
        ->join('municipios','id_municipio','municipio_id')
        ->select('anexos_fondo3.*','municipios.nombre','fuentes_clientes.ejercicio')
        ->get();

        //return $anexos;
        return view('anexoIII.index',compact('anexos'));
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
    public function edit(AnexosFondoIII $anexo)
    {
        $anexos = AnexosFondoIII::join('fuentes_clientes','id_fuente_financ_cliente','fuente_financiamiento_cliente_id')
        ->join('clientes','id_cliente','cliente_id')
        ->join('municipios','id_municipio','municipio_id')
        ->select('anexos_fondo3.*','municipios.nombre','fuentes_clientes.ejercicio')
        ->where('id_anexos_fondo3', $anexo->id_anexos_fondo3)
        ->first();
        //return $anexos;
       return view('anexoIII.edit', compact('anexos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AnexosFondoIII $anexo)
    {

        $prodim= Prodim::where('fuente_id',$anexo->fuente_financiamiento_cliente_id)->first();
        
        
        
        
        $anexo->acta_integracion_consejo = $request->acta_integracion_consejo;
        $anexo->acta_priorizacion = $request->acta_priorizacion;
        $anexo->adendum_priorizacion = $request->adendum_priorizacion;
        $error='';
        
        if($request['prodim'] == null){ //check vacio
            if($prodim != null){// tiene prodim
                $comprometidoProdim = ProdimComprometido::where('prodim_id',$prodim->id_prodim)->exists();
                if($comprometidoProdim != null){ //tiene prodim comprometido
                    $error = 'prodim';
                }else{
                    $anexo->prodim = false;
                    $anexo->porcentaje_prodim = null;
                    $prodim->monto_prodim = 0;
                    $prodim->delete();
                }
            }
        }else{ //check seleccionado
            if($prodim == null){ //si no tiene prodim
                $prodim = Prodim::create([ 
                    'fuente_id' => $anexo->fuente_financiamiento_cliente_id
                ]);
             }
             $comprometidoProdim = ProdimComprometido::where('prodim_id',$prodim->id_prodim)->exists();
             $anexo->prodim = true;
             if($comprometidoProdim == null){
                 $fuenteCliente = FuentesCliente::find($anexo->fuente_financiamiento_cliente_id); //obtenemos fuentecliente relacionado
                 $anexo->porcentaje_prodim = $request->porcentaje_prodim; //nuevo porcentaje
                 $anexo->monto_prodim = str_replace(",", '', $fuenteCliente->monto_proyectado) * ($request->porcentaje_prodim * 0.01); //recalculamos el porcentaje
             }
        }
        $gastoFuente= GastosIndirectosFuentes::where('fuente_cliente_id',$anexo->fuente_financiamiento_cliente_id)->exists();
        if($request['gastos_indirectos'] == null){ //check vacio
            if($gastoFuente != null){
                $error = 'gastos';
            }else{
                $anexo->gastos_indirectos = false; //borra registro de prodim y lo quita de anexos
                $anexo->porcentaje_gastos = null;
                $anexo->monto_gastos = 0;
            }
        }else{// check seleccionado
            $anexo->gastos_indirectos = true;
            if($gastoFuente == null){
                $fuenteCliente = FuentesCliente::find($anexo->fuente_financiamiento_cliente_id); //obtenemos fuentecliente relacionado
                $anexo->porcentaje_gastos = $request->porcentaje_gastos;
                $anexo->monto_gastos = str_replace(",", '', $fuenteCliente->monto_proyectado) * ($request->porcentaje_gastos * 0.01);
            }else{
                $error = 'gastos';
            }
            
            
        }

        if($gastoFuente != null && $comprometidoProdim != null){
            $error = 'error';
        }

        $anexo->update();
        return redirect()->route('anexos.index')->with('actualizar',$error);
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
    
}
