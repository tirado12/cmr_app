<?php

namespace App\Http\Controllers;

use App\Models\Contratista;
use Illuminate\Http\Request;

class ContratistaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contratistas = Contratista::all();
        return view('contratistas.index', compact('contratistas'));
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
            'rfc' => 'required',
            'razon_social' => 'required',
            'representante_legal' => 'required',
            'domicilio' => 'required',
            
            'correo' => 'required',
            'numero_padron_contratista' => 'required' 
        ]);
        //return $request;
         
        Contratista::create([
            'rfc' => $request->rfc,
            'razon_social' => $request->razon_social,
            'representante_legal' => $request->representante_legal,
            'domicilio' => $request->domicilio,
            'telefono' => $request->telefono,
            'correo' => $request->correo,
            'numero_padron_contratista' => $request->numero_padron_contratista,
            ]);
            return redirect()->route('contratistas.index');
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
    public function edit(Contratista $contratista)
    {
        return view('contratistas.edit',compact('contratista'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contratista $contratista)
    {
        $request->validate([
            'rfc' => 'required',
            'razon_social' => 'required',
            'representante_legal' => 'required',
            'domicilio' => 'required',
            'correo' => 'required',
            'numero_padron_contratista' => 'required'
        ]);
        $contratista->update($request->all());
        return redirect()->route('contratistas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contratista $contratista)
    {
        $contratista->delete();
        return redirect()->route('contratistas.index')->with('eliminar','ok');
    }
}
