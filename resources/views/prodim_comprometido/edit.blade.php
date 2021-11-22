@extends('layouts.plantilla')
@section('title','Editar Prodim comprometido')
@section('contenido')
<div class="flex flex-row mb-4">
    <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
    </svg>
    <h1 class="font-bold text-xl ml-2">Editar Prodim Comprometido</h1>
</div>

@if ($errors->any())
        <div class="alert flex flex-row items-center bg-yellow-200 p-2 rounded-lg border-b-2 border-yellow-300 mb-4 shadow">
          <div class="alert-icon flex items-center bg-yellow-100 border-2 border-yellow-500 justify-center h-10 w-10 flex-shrink-0 rounded-full">
            <span class="text-yellow-500">
              <svg fill="currentColor"
                viewBox="0 0 20 20"
                class="h-5 w-5">
                <path fill-rule="evenodd"
                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                    clip-rule="evenodd"></path>
              </svg>
            </span>
          </div>
          <div class="alert-content ml-4">
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
          </div>
        </div>
  @endif

  <div class="mt-10 sm:mt-0 shadow-2xl bg-white rounded-lg">
      
    <div class="mt-5 md:mt-0 md:col-span-2">
      <form action="{{ route('prodimComprometido.update', $prodimComprometido) }}" onsubmit="return validar()" method="POST" id="formulario" name="formulario">
        @csrf
        @method('PUT')
        <div class="shadow overflow-hidden sm:rounded-md">
          @foreach($prodim as $index)
          <div class="relative p-6 flex-auto" id="anexos">
            <div class="grid grid-cols-6 gap-4 mb-2">
                <div class="col-span-3 ">
                    <label  id="label_cliente_id" for="cliente_id" class="block text-sm font-medium text-gray-700">Cliente </label>
                    <input type="text" name="cliente_id" id="cliente_id" class="mt-1 bg-gray-100 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{$index->nombre}}" readonly>
                    <label id="error_cliente_id" name="error_cliente_id" class="hidden text-base font-normal text-red-500" >Seleccione una opción</label>
                </div>

                <div class="col-span-3 ">
                    <label  id="label_ejercicio" for="ejercicio" class="block text-sm font-medium text-gray-700">Ejercicio </label>
                    <input type="text" name="ejercicio" id="ejercicio" class="mt-1 bg-gray-100 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{$index->ejercicio}}" readonly>
                    <label id="error_ejercicio" name="error_ejercicio" class="hidden text-base font-normal text-red-500" >Seleccione una opción</label>
                    <input id="prodim_id" name="prodim_id" type="text"  value="{{ $prodimComprometido->prodim_id }}" hidden>
                </div>

                <div class="col-span-3 ">
                    
                    <label  id="label_prodim_catalogo_id" for="prodim_catalogo_id" class="block text-sm font-medium text-gray-700">Catalogo *</label>
                    <select id="prodim_catalogo_id" name="prodim_catalogo_id" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-800 focus:border-blue-800 sm:text-sm" >
                        @foreach($prodimCatalogo as $catalogo)
                          <option value="{{ $catalogo->id_prodim_catalogo }}" {{($catalogo->id_prodim_catalogo == $prodimComprometido->prodim_catalogo_id) ? 'selected' : ''}}> {{ $catalogo->nombre }}</option>
    
                        @endforeach
                      </select>
                    
                    <label id="error_prodim_catalogo_id" name="error_prodim_catalogo_id" class="hidden text-base font-normal text-red-500" >Este dato es requerido</label>
                </div>

                <div class="col-span-3 ">
                    <label id="label_fecha_comprometido" for="fecha_comprometido" class="block text-sm font-medium text-gray-700">Fecha comprometido *</label>
                    <input type="date" name="fecha_comprometido" id="fecha_comprometido" min="{{$index->ejercicio}}-01-01" max="{{$index->ejercicio}}-12-31" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{$prodimComprometido->fecha_comprometido}}">
                    <label id="error_fecha_comprometido" class="hidden block text-md text-red-500">Se require de una fecha</label>
                </div>

                <div class="col-span-3 ">
                    <label  id="label_monto" for="monto" class="block text-sm font-medium text-gray-700">Monto *</label>
                    <input type="text" name="monto" id="monto" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{$prodimComprometido->monto}}">
                    <label id="error_monto" name="error_monto" class="hidden text-base font-normal text-red-500" >Este dato es requerido</label>
                </div>
                
            </div>
         </div>
         @endforeach
          <div class="px-4 py-3 bg-gray-100 sm:px-6">
            <span class="block text-xs">Porfavor verifique que todos los campos marcados con ( * ) esten rellenados</span>
            <div class="text-right">
              <a type="button" href="{{redirect()->getUrlGenerator()->previous()}}" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-gray-500 hover:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Regresar
              </a>
              <button type="submit" id="enviar_datos" class="ml-4 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-orange-800 hover:bg-orange-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Guardar
              </button>
            
            </div>
          </div>
        </div>
      </form>
    </div>
    
</div>
<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script>
    window.onload =function(){
        $("#monto").val(moneda($("#monto").val()));
    }

    function moneda(valor){
      return valor.replace(/\D/g, "").replace(/([0-9])([0-9]{2})$/, '$1.$2').replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ",");
    }

    function validar(){
        band = true;
            catalogo= document.forms["formulario"]["prodim_catalogo_id"].value;
            if(catalogo == ""){
                        $('#error_prodim_catalogo_id').removeClass('hidden');  
                        band= false;
            }else{
                        $('#error_prodim_catalogo_id').addClass('hidden'); 
            }
            fecha_comprometido= document.forms["formulario"]["fecha_comprometido"].value;
            if(fecha_comprometido == ""){
                        $('#error_fecha_comprometido').removeClass('hidden');  
                        band= false;
            }else{
                        $('#error_fecha_comprometido').addClass('hidden'); 
            }
            monto= document.forms["formulario"]["monto"].value;
            if(monto == ""){
                        $('#error_monto').removeClass('hidden');  
                        band= false;
            }else{
                        $('#error_monto').addClass('hidden'); 
      }
        return band;
    }

    $(document).ready(function(){
      $("#monto").on({
          "focus": function(event) {
              $(event.target).select();
          },
          "keyup": function(event) {
            $(event.target).val(function(index, value) {
                return value.replace(/\D/g, "")
                    .replace(/([0-9])([0-9]{2})$/, '$1.$2')
                    .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ",");
            });
          },
          
      });
    });
</script>
@endsection