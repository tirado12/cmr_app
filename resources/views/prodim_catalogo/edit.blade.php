@extends('layouts.plantilla')
@section('title','Cabildo')
@section('contenido')
<div class="flex flex-row mb-4">
    <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
    </svg>
    <h1 class="text-xl font-bold ml-2">Editar Prodim</h1>
</div>

<div class="mt-20 sm:mt-0 shadow-2xl bg-white rounded-lg">
      
    <div class="mt-5 md:mt-0 md:col-span-2">
      <form action="{{ route('prodimCatalogo.update', $prodimCatalogo) }}" method="POST" id="formulario" name="formulario">
        @csrf
        @method('PUT')
        <div class="shadow overflow-hidden sm:rounded-md">
          <div class="px-4 py-5 bg-white sm:p-6"> 
            <div class="grid grid-cols-6 gap-6">
              <div class="col-span-6 sm:col-span-3">
                <label for="clave" class="block text-sm font-medium text-gray-700">Clave *</label>
                <input type="text" name="clave" id="clave" maxlength="20" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ $prodimCatalogo->clave }}">
                <label id="error_clave" name="error_clave" class="hidden text-base font-normal text-red-500" >Introduzca una clave</label>
              </div>

              <div class="col-span-6 sm:col-span-3">
                <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre *</label>
                <input type="text" name="nombre" id="nombre" maxlength="80" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ $prodimCatalogo->nombre }}">
                <label id="error_nombre" name="error_nombre" class="hidden text-base font-normal text-red-500" >Introduzca un nombre</label>
              </div>         
              
            </div>
          </div>
          <div class="px-4 py-3 bg-gray-100 sm:px-6">
            <span class="block text-xs">Porfavor verifique que todos los campos marcados con ( * ) esten rellenados</span>
            <div class="text-right">
              <a type="button" href="{{ route('prodimCatalogo.index') }}" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-gray-500 hover:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
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
  
     $("#formulario input").keyup(function() { //validacion del formulario para lanzar mensajes
    
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