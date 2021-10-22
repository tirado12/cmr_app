@extends('layouts.plantilla')
@section('title','Editar ')
@section('contenido')

<div class="flex flex-row mb-4">
<svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
</svg>
<h1 class="font-bold text-xl ml-2">Editar municipio</h1>
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
        <form action="{{ route('municipio.update', $municipio) }}" method="POST" id="formulario" name="formulario">
          @csrf
          @method('PUT')
          <div class="shadow overflow-hidden sm:rounded-md">
            <div class="px-4 py-5 bg-white sm:p-6"> 
              <div class="grid grid-cols-6 gap-6">
                <div class="col-span-6 sm:col-span-3">
                  <label id="label_nombre" for="nombre" class="block text-sm font-medium text-gray-700">Nombre *</label>
                  <input type="text" name="nombre" id="nombre" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ $municipio->nombre }}" >
                  <label id="error_nombre" name="error_nombre" class="hidden text-base font-normal text-red-500" >Introduzca un nombre</label>
                </div>
                    
                <div class="col-span-6 sm:col-span-3">
                  <label id="label_rfc" for="rfc" class="block text-sm font-medium text-gray-700">RFC *</label>
                  <input type="text" name="rfc" id="rfc" autocomplete="rfc" maxlength="13" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ $municipio ->rfc }}">
                  <label id="error_rfc" name="error_rfc" class="hidden text-base font-normal text-red-500" >Introduzca al menos un RFC generico de 13 caracteres</label>
                </div>
                <div class="col-span-6 sm:col-span-3">
                  <label id="label_direccio" for="direccion" class="block text-sm font-medium text-gray-700">Dirección *</label>
                  <input type="text" name="direccion" id="direccion" autocomplete="direccion" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ $municipio ->direccion }}">
                  <label id="erro_direccion" name="erro_direccion" class="hidden text-base font-normal text-red-500" >Introduzca una dirección</label>
                </div>
                
                  
                <div class="col-span-6 sm:col-span-3">
                  <label id="label_distrito_id" for="distrito_id" class="block text-sm font-medium text-gray-700">Distrito *</label>
                  <select id="distrito_id" name="distrito_id" onchange="validarDistrito()" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" >
                    <option value="">Elija una opción</option>
                    @foreach($distrito as $distrito)
                      <option value="{{ $distrito->id_distrito }}" {{ ($distrito->id_distrito == $municipio->distrito_id) ? 'selected' : '' }}> {{ $distrito->nombre }}</option>
                    @endforeach
                  </select>
                  <label id="error_distrito_id" name="error_distrito_id" class="hidden text-base font-normal text-red-500" >Elija un distrito</label>
                </div>

                
              </div>
            </div>
            <div class="px-4 py-3 bg-gray-100 sm:px-6">
              <span class="block text-xs">Por favor verifique que todos los campos marcados con ( * ) no estén vacios.</span>
              <div class="text-right">
                <a type="button" href="{{route('municipio.index')}}" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-gray-500 hover:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                  Regresar
                </a>
              <button type="submit" class="ml-4 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-orange-800 hover:bg-orange-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
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
//Validacion de select distrito
function validarDistrito() {
  var valor = document.getElementById("distrito_id").value;
  if(valor != ''){
    $('#error_distrito_id').fadeOut();
    $("#label_distrito_id").removeClass('text-red-500');
    $("#label_distrito_id").addClass('text-gray-700');
  }else{
    $('#error_distrito_id').fadeIn();
    $("#label_distrito_id").addClass('text-red-500');
    $("#label_distrito_id").removeClass('text-gray-700');
  }
}

//validacion de campos del formulario
$(document).ready(function() {
   $("#formulario input").keyup(function() {
  //console.log($(this).attr('id'));
      var cadena = $(this).val();
      
      if(cadena != ''){
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
    
//validacion del formulario con el btn guardar
$().ready(function() {
  $("#formulario").validate({
    onfocusout: false,
    onclick: false,
		rules: {
      nombre: { required: true},
			rfc: { required: true, minlength: 13},
      
      distrito_id: { required: true},
		},
    errorPlacement: function(error, element) {
      if(error != null){
      $('#error_'+element.attr('id')).fadeIn();
      }else{
        $('#error_'+element.attr('id')).fadeOut();
      }
     // console.log(element.attr('id'));
    },
	}); 
});
  </script>
  
@endsection