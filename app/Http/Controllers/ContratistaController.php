<?php

namespace App\Http\Controllers;

use App\Models\Contratista;
use App\Models\Municipio;
use App\Models\ObrasContrato;
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
        $municipios= Municipio::select('id_municipio','nombre')->get();
        return view('contratistas.index', compact('contratistas','municipios'));
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
        $valido= $request->validate([
                //'rfc' => 'required|unique:contratistas,rfc',
                'rfc' => 'required',
                'razon_social' => 'required',
                'representante_legal' => 'nullable',
                'domicilio' => 'required',
                'numero_padron_contratista' => 'required',
                'municipio_id' => 'required'
            ]);
       
        Contratista::create([
            'rfc' => $request->rfc,
            'tipo_rfc' => $tipo_rfc,
            'razon_social' => $request->razon_social,
            'representante_legal' => $request->representante_legal,
            'domicilio' => $request->domicilio,
            'telefono' => $request->telefono,
            'correo' => $request->correo,
            'numero_padron_contratista' => $request->numero_padron_contratista,
            'municipio_id' => $request->municipio_id
            ]);

            if($valido==false){
                return redirect()->route('contratistas.index')->withInput();
            }else{
                return redirect()->route('contratistas.index');
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
    public function edit(Contratista $contratista)
    {
            $municipios= Municipio::select('id_municipio','nombre')->get();
            return view('contratistas.edit',compact('contratista','municipios'));
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
        
        
            $request->validate([
                //'rfc' => ['required',Rule::unique('contratistas')->ignore($contratista)],
                'rfc' => 'required',
                'razon_social' => 'required',
                'representante_legal' => 'nullable',
                'domicilio' => 'required',
                'numero_padron_contratista' => 'required' 
            ]);
        

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
        $existeEnObras= ObrasContrato::where('contratista_id',$contratista->id_contratista)->exists(); //consulta si registro relacionado
        if($existeEnObras == null){ //si no hay existe
            $contratista->delete();
            return redirect()->route('contratistas.index')->with('eliminar','ok');
        }else{
            return redirect()->route('contratistas.index')->with('eliminar','error');
        }
    }

     //==============================Validacion ajax=================================

     public function existeRfc($rfc,$municipio){
        $existe = Contratista::where('rfc',$rfc)->where('municipio_id', $municipio)->select('id_contratista','municipio_id')->get();
        return $existe;
        // if($existe == null)
        // return 0;
        // else
        // return $existe;
    }
}
