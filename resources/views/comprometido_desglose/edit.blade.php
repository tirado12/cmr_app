@extends('layouts.plantilla')
@section('title','Editar Comprometido Desglose')
@section('contenido')
<div class="flex flex-row mb-4">
    <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
    </svg>
    <h1 class="font-bold text-xl ml-2">Editar Prodim</h1>
</div>

<div class="mt-10 sm:mt-0 shadow-2xl bg-white rounded-lg">
      
    <div class="mt-5 md:mt-0 md:col-span-2">
      <form action="{{route('comprometidoDesglose.update', $comprometidoDesglose->id_desglose)}}" onsubmit="return validar()" method="POST" id="formulario" name="formulario">
        @csrf
        @method('PUT')
        <div class="shadow overflow-hidden sm:rounded-md">
          @foreach($prodimComprometido as $comprometido)
          <div class="relative p-6 flex-auto" id="anexos">
            <div class="grid grid-cols-6 gap-4 mb-2">
                <div class="col-span-3 ">
                    <label  id="label_cliente_id" for="cliente_id" class="block text-sm font-medium text-gray-700">Cliente </label>
                    <input type="text" name="cliente_id" id="cliente_id" class="mt-1 bg-gray-100 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ $comprometido->nombre}}" readonly>
                    <label id="error_cliente_id" name="error_cliente_id" class="hidden text-base font-normal text-red-500" >Seleccione una opción</label>
                </div>

                <div class="col-span-3 ">
                    <label  id="label_ejercicio" for="ejercicio" class="block text-sm font-medium text-gray-700">Ejercicio </label>
                    <input type="text" name="ejercicio" id="ejercicio" class="mt-1 bg-gray-100 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ $comprometido->ejercicio}}" readonly>
                    <label id="error_ejercicio" name="error_ejercicio" class="hidden text-base font-normal text-red-500" >Seleccione una opción</label>
                    
                </div>

                <div class="col-span-3 ">
                    <label  id="label_concepto" for="concepto" class="block text-sm font-medium text-gray-700">Concepto *</label>
                    <input type="text" name="concepto" id="concepto" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{$comprometidoDesglose->concepto}}" >
                    <label id="error_concepto" name="error_concepto" class="hidden text-base font-normal text-red-500" >Este dato es requerido</label>
                </div>

                <div class="col-span-3 ">
                    <label  id="label_monto" for="monto" class="block text-sm font-medium text-gray-700">Monto *</label>
                    <input type="text" name="monto" id="monto" minlength="4" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{$comprometidoDesglose->monto}}" >
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
      ejercicio= document.forms["formulario"]["ejercicio"].value;
      if(ejercicio == ""){
                 $('#error_ejercicio').removeClass('hidden');  
                 band= false;
      }else{
                $('#error_ejercicio').addClass('hidden'); 
      }
      concepto= document.forms["formulario"]["concepto"].value;
      if(concepto == ""){
                 $('#error_concepto').removeClass('hidden');  
                 band= false;
      }else{
                $('#error_concepto').addClass('hidden'); 
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