@extends('layouts.plantilla')
@section('title','Editar gastos indirectos')
@section('contenido')

<div class="flex flex-row mb-4">
    <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
    </svg>
    <h1 class="text-xl font-bold ml-2">Editar Gastos Indirectos</h1>
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

<div class="mt-20 sm:mt-0 shadow-2xl bg-white rounded-lg">
      
    <div class="mt-5 md:mt-0 md:col-span-2">
      <form action="{{ route('gastosIndirectos.update', $gastosIndirecto) }}" method="POST" id="formulario" name="formulario">
        @csrf
        @method('PUT')
        <div class="shadow overflow-hidden sm:rounded-md">
          <div class="px-4 py-5 bg-white sm:p-6"> 
            <div class="grid grid-cols-6 gap-6">
              <div class="col-span-6 sm:col-span-3">
                <label for="clave" class="block text-sm font-medium text-gray-700">Clave *</label>
                <input type="number" name="clave" id="clave" placeholder="100" maxlength="20" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ $gastosIndirecto->clave }}">
                <label id="error_clave" name="error_clave" class="hidden text-base font-normal text-red-500" >Introduzca una clave</label>
              </div>

              <div class="col-span-6 sm:col-span-3">
                <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre *</label>
                <input type="text" name="nombre" id="nombre" placeholder="Nombre" maxlength="40" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ $gastosIndirecto->nombre }}">
                <label id="error_nombre" name="error_nombre" class="hidden text-base font-normal text-red-500" >Introduzca un nombre</label>
              </div>         
              
            </div>
          </div>
          <div class="px-4 py-3 bg-gray-100 sm:px-6">
            <span class="block text-xs">Porfavor verifique que todos los campos marcados con ( * ) esten rellenados</span>
            <div class="text-right">
              <a type="button" href="{{ route('gastosIndirectos.index') }}" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-gray-500 hover:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Regresar
              </a>
              <button type="submit" class="ml-4 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-orange-800 hover:bg-orange-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500">
                Guardar
              </button>
            
            </div>
          </div>
        </div>
      </form>
    </div>
  
</div>

<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>    

<script>

//validacion de campos del formulario
$(document).ready(function() {
    $("#formulario").validate({
    onfocusout: false,
    onclick: false,
		rules: {
            clave: { required: true},
            nombre: { required: true}
		},
    errorPlacement: function(error, element) {
      if(error != null){
      $('#error_'+element.attr('id')).fadeIn();
      }else{
        $('#error_'+element.attr('id')).fadeOut();
      }
     
    },
	}); 

   $("#formulario input").keyup(function() { //validacion para lanzar mensajes
  
      var dato = $(this).val();
      
      if(dato != ''){
      $('#error_'+$(this).attr('id')).fadeOut();
      $("#label_"+$(this).attr('id')).removeClass('text-red-500');
      $("#label_"+$(this).attr('id')).addClass('text-gray-700');
      //$('#guardar').removeAttr("disabled");
      }
      else{
      //$("#guardar").attr("disabled", true);
      $('#error_'+$(this).attr('id')).fadeIn();
      $("#label_"+$(this).attr('id')).addClass('text-red-500');
      $("#label_"+$(this).attr('id')).removeClass('text-gray-700');
      }
    
    });
  });

</script>
@endsection