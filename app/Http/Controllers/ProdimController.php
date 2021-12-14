<?php

namespace App\Http\Controllers;

use App\Models\AnexosFondoIII;
use App\Models\Cliente;
use App\Models\FuentesCliente;
use App\Models\Prodim;
use App\Models\ProdimComprometido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File; 

class ProdimController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //consulta para agregar
        $fuenteCliente= FuentesCliente::join('clientes','cliente_id','id_cliente') //lista de clientes
        ->join('municipios', 'clientes.municipio_id','municipios.id_municipio')
        ->where('fuente_financiamiento_id', 2)
        ->select('cliente_id','nombre','municipio_id')
        ->get(); //tabla fuenteClientes segun existentes           
        $clientes = $fuenteCliente->unique('municipio_id');
        //return $fuenteCliente;

        //consulta para tabla
        $listaProdim = Prodim::join('fuentes_clientes','fuente_id','id_fuente_financ_cliente')
        ->join('clientes','cliente_id','id_cliente')
        ->join('municipios','municipio_id','id_municipio')
        ->join('anexos_fondo3','id_fuente_financ_cliente','fuente_financiamiento_cliente_id')
        ->where('fuente_financiamiento_id', 2)
        ->select('prodim.*','ejercicio','nombre','anexos_fondo3.*')
        ->get();
        //return $listaProdim;
        return view('prodim.index', compact('clientes','listaProdim'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return $fuenteCliente = FuentesCliente::join('anexos_fondo3', 'id_fuente_financ_cliente', 'fuente_financiamiento_cliente_id')->where('id_fuente_financ_cliente', 2)->first();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //obtenemos el campo file definido en el formulario
        if (!empty($request->file('acuse_prodim'))) {
            $file = $request->file('acuse_prodim');
            //Move Uploaded File
            $destinationPath = './uploads';
            $file->move($destinationPath, $file->getClientOriginalName());
            $archivo = $file->getClientOriginalName();
            $destinationPath = url("/uploads/$archivo");
            $request['acuse'] = $destinationPath;
            
        }
        
       $request->validate([
        'firma_electronica' => 'nullable',
        'acuse' => 'required',
        'revisado' => 'nullable',
        'fuenteCliente_id' => 'required|unique:prodim,fuente_id',
      ],
      [ 'fuenteCliente_id.unique' => 'Ya existe un registro con este cliente y ejercicio.']);


      $request->firma_electronica == null ? $request->firma_electronica = false : $request->firma_electronica = true;
      $request->revisado == null ? $request->revisado = false : $request->revisado = true;
      $request->validado == null ? $request->validado = false : $request->validado = true;
      $request->convenio == null ? $request->convenio = false : $request->convenio = true;

      $prodim = Prodim::create([
          'firma_electronica' => $request->firma_electronica,
          'revisado' => $request->revisado,
          'fecha_revisado' => $request->fecha_revisado,
          'validado' => $request->validado,
          'fecha_validado' => $request->fecha_validado,
          'convenio' => $request->convenio, 
          'fecha_convenio' => $request->fecha_convenio,
          'acuse_prodim' => $request->acuse,
          'fuente_id' => $request->fuenteCliente_id
      ]);

      $fuenteCliente = FuentesCliente::where('id_fuente_financ_cliente', $prodim->fuente_id)->first();
      $anexos = AnexosFondoIII::where('fuente_financiamiento_cliente_id', $prodim->fuente_id)->first();

      $anexos->porcentaje_prodim= $request->porcentaje_prodim;
      $anexos->monto_prodim = str_replace(",", '', $fuenteCliente->monto_proyectado) * ($request->porcentaje_prodim * 0.01);
      $anexos->prodim = true;
      $anexos->update();

      return redirect()->route('prodim.index');
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
    public function edit(Prodim $prodim)
    {
        $listaProdim = Prodim::join('fuentes_clientes','fuente_id','id_fuente_financ_cliente')
        ->join('clientes','cliente_id','id_cliente')
        ->join('municipios','municipio_id','id_municipio')
        ->join('anexos_fondo3','id_fuente_financ_cliente','fuente_financiamiento_cliente_id')
        ->where('id_prodim', $prodim->id_prodim)
        ->select('prodim.*','ejercicio','nombre','anio_inicio','anio_fin','anexos_fondo3.*')
        ->get();
      // return $listaProdim;
       return view('prodim.edit',compact('listaProdim','prodim'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Prodim $prodim)
    {
        if (!empty($request->file('acuse_prodim'))) {
            $file = $request->file('acuse_prodim');
            //Move Uploaded File
            $destinationPath = './uploads';
            $file->move($destinationPath, $file->getClientOriginalName());
            $archivo = $file->getClientOriginalName();
            $destinationPath = url("/uploads/$archivo");
            $request['acuse'] = $destinationPath;
            
        }else{
            $request['acuse'] = $prodim->acuse_prodim;
        }
    
        $request->validate([
            'firma_electronica' => 'nullable',
            'revisado' => 'nullable',
            'fecha_revisado' => 'nullable',
            'validado' => 'nullable',
            'fecha_validado' => 'nullable',
            'convenio' => 'nullable',
            'fecha_convenio' => 'nullable',
            'acuse' => 'required',
          ]);

          $request->firma_electronica == null ? $request['firma_electronica'] = false : $request['firma_electronica'] = true;
          $request->revisado == null ? $request['revisado'] = false : $request['revisado'] = true;
          $request->validado == null ? $request['validado'] = false : $request['validado'] = true;
          $request->convenio == null ? $request['convenio'] = false : $request['convenio'] = true;

          $fuenteCliente = FuentesCliente::where('id_fuente_financ_cliente', $prodim->fuente_id)->first();
          $anexos = AnexosFondoIII::where('fuente_financiamiento_cliente_id', $prodim->fuente_id)->first();
          
          $anexos->porcentaje_prodim= $request->porcentaje_prodim;
          $anexos->monto_prodim = str_replace(",", '', $fuenteCliente->monto_proyectado) * ($request->porcentaje_prodim * 0.01);
          $anexos->update();
        //   if($request->firma_electronica == null){
        //     $request['firma_electronica'] = false;
        //   }else{
        //     $request['firma_electronica'] = true;
        //   }
        //   if($request->revisado == null){
        //       $request['revisado'] = false;
        //   }else{
        //     $request['revisado'] = true;
        //   }
        //   if($request->validado == null){
        //       $request['validado'] = false;
        //   }else{
        //     $request['validado']= true;
        //   }
        //   if($request->convenio == null){
        //       $request['convenio'] =false;
        //   }else{
        //     $request['convenio'] =true;
        //   }
          $prodim->update($request->all());
          return redirect()->route('prodim.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Prodim $prodim)
    {
        $existeProdimComprometido = ProdimComprometido::where('prodim_id', $prodim->id_prodim)->exists();
        if($existeProdimComprometido == null ){
            // if(File::exists('./uploads/OP. REG. C.P. YESENIA.pdf')) { // establecer subruta
            //     File::delete('./uploads/OP. REG. C.P. YESENIA.pdf');
            // }
            $anexos = AnexosFondoIII::where('fuente_financiamiento_cliente_id', $prodim->fuente_id)->first();
            $anexos->prodim = false;
            $anexos->porcentaje_prodim = 0;
            $anexos->monto_prodim = 0;
            $anexos->update();
            $prodim->delete();
            return redirect()->route('prodim.index')->with('eliminar','ok');
        }else{
            return redirect()->route('prodim.index')->with('eliminar','error');
        }
    }
    //=========================================Funciones Ajax==================================================
   
    public function getEjerciciosCliente($id_municipio){
        return FuentesCliente::join('clientes','cliente_id','id_cliente')
        ->join('municipios', 'id_municipio', 'municipio_id')
        ->where('fuente_financiamiento_id', 2)
        ->where('id_municipio', $id_municipio)
        ->orderBy('ejercicio')
        ->select('id_fuente_financ_cliente','ejercicio')
        ->get();
    }
    // ================================ Funciones API ========================================= //
    public function getDesgloseProdim($cliente_id, $anio){

        $fuente_prodim = DB::table('fuentes_clientes')
            ->orWhere(function($query) use($cliente_id, $anio) {
                $query->where('cliente_id', $cliente_id)
                    ->where('ejercicio',$anio)
                    ->where('fuente_financiamiento_id',2);
            })
            ->join('prodim', 'prodim.fuente_id', '=', 'id_fuente_financ_cliente')
            ->select('firma_electronica','revisado','validado','convenio','id_prodim')
            ->get();
        $prodim_id = $fuente_prodim->first()->id_prodim;
        $fuente_comprometido = DB::table('prodim_comprometido')
            ->orWhere(function($query) use($prodim_id) {
                $query->where('prodim_id', $prodim_id);
            })
            ->join('prodim_catalogo', 'prodim_catalogo.id_prodim_catalogo', '=', 'prodim_catalogo_id')
            ->select('nombre','monto')
            ->get();
        $fuente_desglose = DB::table('prodim_comprometido')
            ->orWhere(function($query) use($prodim_id) {
                $query->where('prodim_id', $prodim_id);
            })
            ->join('prodim_catalogo', 'prodim_catalogo.id_prodim_catalogo', '=', 'prodim_catalogo_id')
            ->join('comprometido_desglose', 'comprometido_desglose.comprometido_id', '=', 'id_comprometido')
            ->select('nombre','concepto','comprometido_desglose.monto')
            ->get();
        
        $fuente_gi = DB::table('fuentes_clientes')
            ->orWhere(function($query) use($cliente_id, $anio) {
                $query->where('cliente_id', $cliente_id)
                    ->where('ejercicio',$anio)
                    ->where('fuente_financiamiento_id',2);
            })
            ->join('fuentes_gastos_indirectos', 'fuentes_gastos_indirectos.fuente_cliente_id', '=', 'id_fuente_financ_cliente')
            ->join('gastos_indirectos','gastos_indirectos.id_indirectos','=','indirectos_id')
            ->select('nombre','monto')
            ->get();


        $resources = array(
                'prodim' => $fuente_prodim,
                'comprometido' => $fuente_comprometido,
                'desglose' => $fuente_desglose,
                'gastos' => $fuente_gi
                );
                return [$resources];
    }
}
