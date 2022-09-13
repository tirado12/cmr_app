<?php

namespace App\Http\Controllers;


use App\Models\ContratosArrendamiento;
use App\Models\Factura;
use App\Models\Municipio;
use App\Models\Proveedor;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProveedorController extends Controller
{
    //
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $proveedores = Proveedor::all();
        $result= Municipio::join('clientes','id_municipio','municipio_id')->select('id_municipio','nombre')->get();
        $municipios =  $result->unique('id_municipio');
        //return $municipios;
        return view('proveedores.index',compact('proveedores','municipios'));
        
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
        $rfc = $request->rfc;
        $tipo_rfc="";
        if(strlen($rfc)<=12 ){
            $tipo_rfc=true; //persona moral
        }else{
            $tipo_rfc=false; //persona fisica
            $request['representante_legal']=null;
        }

        $valido= $request->validate([ //faltan columnas de representante legal aqui y bd
            //'rfc' => 'required|unique:proveedores,rfc',
            'rfc' => 'required',
            'representante_legal' => 'nullable',
            'razon_social' => 'required',
            'municipio_id' => 'required'
        ]);
        Proveedor::create([
            'rfc' => $request->rfc,
            'razon_social'=>$request->razon_social,
            'representante_legal' => $request->representante_legal,
            'tipo_rfc'=>$tipo_rfc,
            'municipio_id' => $request->municipio_id
        ]);
        if($valido==false){
            return redirect()->route('proveedor.index')->withInput();
        }else{
            return redirect()->route('proveedor.index');
        }
        
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($proveedor)
    {
        //
    }
     /**
     * Show the form for editing the specified resource.
     *
     * @param  User  $users
     * @return \Illuminate\Http\Response
     */
    public function edit(Proveedor $proveedor)
    {
        //return $proveedor;
        $result= Municipio::join('clientes','id_municipio','municipio_id')->select('id_municipio','nombre')->get();
        $municipios =  $result->unique('id_municipio');
        return view('proveedores.edit',compact('proveedor','municipios'));
       //return $proveedor;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Proveedor $proveedor)
    {
        $rfc = $request->rfc;
        $tipo_rfc="";
        if(strlen($rfc)<=12 ){
            $tipo_rfc=true; //persona moral
        }else{
            $tipo_rfc=false; //persona fisica
            $request['representante_legal']=null;
        }

        //return $request;
        $request->validate([
            //'rfc' => ['required',Rule::unique('proveedores')->ignore($proveedor)],
            'rfc' => 'required',
            'representante_legal' => 'nullable',
            'razon_social' => 'required',
            'municipio_id' => 'required'
        ]);

        $proveedor->rfc = $request->rfc;
        $proveedor->razon_social = $request->razon_social;
        $proveedor->tipo_rfc = $tipo_rfc;
        $proveedor->representante_legal = $request->representante_legal;
        $proveedor->municipio_id = $request->municipio_id;
        $proveedor->save();

        //$proveedor->update($request->all());
        return redirect()->route('proveedor.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Proveedor $proveedor)
    {
        $existeEnContrato = ContratosArrendamiento::where('proveedor_id',$proveedor->id_proveedor)->exists();
        $existeEnFacturas = Factura::where('proveedor_id',$proveedor->id_proveedor)->exists();
        if($existeEnContrato == null && $existeEnFacturas == null){ //si no hay existe
            $proveedor->delete();
            return redirect()->route('proveedor.index')->with('eliminar','ok');
        }else{
            return redirect()->route('proveedor.index')->with('eliminar','error');
        }
    }

    //==============================Validacion ajax=================================
    public function existeRfcProveedor($rfc,$municipio){
        $existe = Proveedor::where('rfc',$rfc)->where('municipio_id',$municipio)->select('id_proveedor','municipio_id')->get();
        return $existe;
        // if($existe == null)
        // return 0;
        // else
        // return $existe;
    }
}
