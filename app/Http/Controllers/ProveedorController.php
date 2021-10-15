<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use Illuminate\Http\Request;

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
        return view('proveedores.index',compact('proveedores'));
        //return $proveedores;
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
        }

        $request->validate([
            'rfc' => 'required',
            'razon_social' => 'required'
        ]);
        Proveedor::create([
            'rfc' => $request->rfc,
            'razon_social'=>$request->razon_social,
            'tipo_rfc'=>$tipo_rfc
        ]);
        return redirect()->route('proveedor.index');
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
       return view('proveedores.edit',compact('proveedor'));
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
        }

        //return $request;
        $request->validate([
            'rfc' => 'required',
            'razon_social' => 'required'
        ]);

        $proveedor->rfc = $request->rfc;
        $proveedor->razon_social = $request->razon_social;
        $proveedor->tipo_rfc = $tipo_rfc;
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
        $proveedor->delete();
        return redirect()->route('proveedor.index')->with('eliminar','ok');
    }
}
