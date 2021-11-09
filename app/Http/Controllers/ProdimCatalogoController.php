<?php

namespace App\Http\Controllers;

use App\Models\ProdimCatalogo;
use App\Models\ProdimComprometido;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProdimCatalogoController extends Controller
{
    //
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $catalogo = ProdimCatalogo::all();
        return view('prodim_catalogo.index', compact('catalogo'));
        return "Prodim catalogo";
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
            'clave' => 'required|unique:prodim_catalogo,clave',
            'nombre' => 'required',
        ]);
        ProdimCatalogo::create([
            'clave' => $request->clave,
            'nombre' => $request->nombre,
        ]);
        return redirect()->route('prodimCatalogo.index');
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
    public function edit(ProdimCatalogo $prodimCatalogo)
    {
       return view('prodim_catalogo.edit', compact('prodimCatalogo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProdimCatalogo $prodimCatalogo)
    {
        $request->validate([
            'clave' => ['required',Rule::unique('prodim_catalogo')->ignore($prodimCatalogo)],
            'nombre' => 'required',
        ]);
        $prodimCatalogo->update($request->all());
        return redirect()->route('prodimCatalogo.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProdimCatalogo $prodimCatalogo)
    {
        $existeEnProdimComprometido = ProdimComprometido::where('prodim_catalogo_id', $prodimCatalogo->id_prodim_catalogo)->exists();
        if($existeEnProdimComprometido == null){ //si no hay existe
            $prodimCatalogo->delete();   
            return redirect()->route('prodimCatalogo.index')->with('eliminar','ok');
        }else{
            return redirect()->route('prodimCatalogo.index')->with('eliminar','error');
        }
    }
}
