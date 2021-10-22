<?php

namespace App\Http\Controllers;

use App\Models\Contratista;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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
        $rfc = $request->rfc;
        
        $tipo_rfc="";
        if(strlen($rfc)<=12 ){
            $tipo_rfc=true; //persona moral
        }else{
            $tipo_rfc=false; //persona fisica
            
        }

        if($request->representante_legal != ''){
            $request->validate([
                'rfc' => 'required|unique:contratistas,rfc',
                'razon_social' => 'required',
                'representante_legal' => 'required',
                'domicilio' => 'required',
                'numero_padron_contratista' => 'required' 
            ]);
        }else{
            $request->validate([
                'rfc' => 'required',
                'razon_social' => 'required',
                'domicilio' => 'required',
                'numero_padron_contratista' => 'required' 
            ]);
        }
        
         
        Contratista::create([
            'rfc' => $request->rfc,
            'tipo_rfc' => $tipo_rfc,
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
        $rfc = $request->rfc;
        $tipo_rfc="";
        if(strlen($rfc)<=12 ){
            $tipo_rfc=true; //persona moral
        }else{
            $tipo_rfc=false; //persona fisica
            $request['representante_legal']='';
        }
        
        if($request->representante_legal != ''){
            $request->validate([
                'rfc' => ['required',Rule::unique('contratistas')->ignore($contratista)],
                'razon_social' => 'required',
                'representante_legal' => 'required',
                'domicilio' => 'required',
                'numero_padron_contratista' => 'required' 
            ]);
        }else{
            $request->validate([
                'rfc' => ['required',Rule::unique('contratistas')->ignore($contratista)],
                'razon_social' => 'required',
                'domicilio' => 'required',
                'numero_padron_contratista' => 'required' 
            ]);
        }

        $contratista->rfc = $request->rfc;
        $contratista->tipo_rfc = $tipo_rfc;
        $contratista->razon_social = $request->razon_social;
        $contratista->representante_legal = $request->representante_legal;
        $contratista->domicilio = $request->domicilio;
        $contratista->telefono = $request->telefono;
        $contratista->correo = $request->correo;
        $contratista->numero_padron_contratista = $request->numero_padron_contratista;
        $contratista->save();

        //$contratista->update($request->all());
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

     //==============================Validacion ajax=================================

     public function existeRfc($rfc){
        $existe = Contratista::where('rfc',$rfc)->exists();
        if($existe == null)
        return 0;
        else
        return $existe;
    }
}
