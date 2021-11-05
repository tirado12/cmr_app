<?php

namespace App\Http\Controllers;

use App\Models\GastosIndirectos;
use App\Models\GastosIndirectosFuentes;
use Illuminate\Http\Request;

class GastosIndirectosController extends Controller
{
    //
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gastosIndirectos =GastosIndirectos::all();
        return view('gastos_indirectos.index', compact('gastosIndirectos'));
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
        $valido= $request->validate([
            'clave' => 'required|unique:gastos_indirectos,clave',
            'nombre' => 'required',            
        ]);
        GastosIndirectos::create([
            'clave' => $request->clave,
            'nombre' => $request->nombre  
        ]);

        if($valido==false){
            return redirect()->route('gastosIndirectos.index')->withInput();
        }else{
            return redirect()->route('gastosIndirectos.index');
        }
        
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
    public function edit(GastosIndirectos $gastosIndirecto)
    {
        return view('gastos_indirectos.edit',compact('gastosIndirecto'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GastosIndirectos $gastosIndirecto)
    {
        $request->validate([
            'clave' => 'required',
            'nombre' => 'required',
        ]);
        $gastosIndirecto->update($request->all());
        return redirect()->route('gastosIndirectos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(GastosIndirectos $gastosIndirecto)
    {
        $existeEnFuentesGastos= GastosIndirectosFuentes::where('indirectos_id',$gastosIndirecto->id_indirectos)->exists();
        if($existeEnFuentesGastos == null){ //si no hay existe
            $gastosIndirecto->delete();
             return redirect()->route('gastosIndirectos.index')->with('eliminar','ok');
        }else{
             return redirect()->route('gastosIndirectos.index')->with('eliminar','error');
        }
    }
}
