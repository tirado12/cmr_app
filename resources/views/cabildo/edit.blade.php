@extends('layouts.plantilla')
@section('title','Editar Personal del Cabildo')
@section('contenido')

<div class="flex flex-row mb-4">
<svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
</svg>
<h1 class="font-bold text-xl ml-2">Editar Integrante de Cabildo</h1>
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
        <form action="{{ route('cabildo.update', $integrante) }}" method="POST" id="formulario" name="formulario">
          @csrf
          @method('PUT')
          <div class="shadow overflow-hidden sm:rounded-md">
            <div class="px-4 py-5 bg-white sm:p-6"> 
              <div class="grid grid-cols-6 gap-6">
                <div class="col-span-6 sm:col-span-3">
                  <label for="first_name" class="block text-sm font-medium text-gray-700">Nombre *</label>
                  <input type="text" name="nombre" id="nombre" placeholder="Nombre" maxlength="50" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ $integrante->nombre }}">
                  <label id="error_nombre" name="error_nombre" class="hidden text-base font-normal text-red-500" >Introduzca un nombre</label>
                </div>
  
                <div class="col-span-6 sm:col-span-3">
                  <label for="cargo" class="block text-sm font-medium text-gray-700">Cargo *</label>
                  <input type="text" name="cargo" id="cargo" autocomplete="email" maxlength="70" placeholder="Presidente" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ $integrante->cargo }}">
                  <label id="error_cargo" name="error_cargo" class="hidden text-base font-normal text-red-500" >Introduzca un cargo</label>
                </div>

                <div class="col-span-6 sm:col-span-3">
                    <label for="eti_telefono" class="block text-sm font-medium text-gray-700">Telefono</label>
                    <input type="tel" name="telefono" id="telefono" placeholder="9519999999" maxlength="13" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ $integrante->telefono }}">
                    
                </div>

                <div class="col-span-6 sm:col-span-3">
                    <label for="Correo" class="block text-sm font-medium text-gray-700">Correo </label>
                    <input type="email" name="correo" id="correo" maxlength="30" autocomplete="email" placeholder="usuario@ejemplo.com" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ $integrante->correo }}">
                    <label id="error_correo" name="error_correo" class="hidden text-base font-normal text-red-500" >Introduzca un correo valido</label>
                </div>

                  <div class="col-span-6 sm:col-span-3">
                    <label for="rfc" class="block text-sm font-medium text-gray-700">RFC *</label>
                    <input type="text" name="rfc" id="rfc" placeholder="BDS140512XXXX" maxlength="12" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ $integrante->rfc }}">
                    <label id="error_rfc" name="error_rfc" class="hidden text-base font-normal text-red-500" >Introduzca al menos un RFC generico de 5 caracteres</label>
                    <label id="error_existe" name="error_existe" class="hidden text-base font-normal text-red-500" >Ya existe un registro con este RFC</label>
                  </div>
                
                  <div class="col-span-6 sm:col-span-3">
                    <label for="ejercicio_actual" class="block text-sm font-medium text-gray-700">Ejercicio Actual </label>
                    <input type="text" name="ejercicio_actual" id="ejercicio_actual" placeholder="" maxlength="12" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 bg-gray-100 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ $municipioCliente->anio_inicio.' - '. $municipioCliente->anio_fin }}" disabled>
                  </div>

                <div class="col-span-6 sm:col-span-3">
                  <label for="municipio" class="block text-sm font-medium text-gray-700">Cliente </label>
                  <select id="municipio" name="municipio" onchange="validarMunicipio()" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option value="">Elija una opción</option>
                    @foreach($clientes as $cliente)
                    <option value="{{ $cliente->municipio_id }}" {{ ($cliente->municipio_id == $municipioCliente->municipio_id) ? 'selected' : '' }}> {{ $cliente->nombre }}</option>
                    @endforeach
                  </select>
                  <label id="error_municipio" name="error_municipio" class="hidden text-base font-normal text-red-500" >Elija un municipio</label>
                </div>
                
                <div class="col-span-6 sm:col-span-3">
                  <label id="label_ejercicio" for="ejercicio" class="block text-sm font-medium text-gray-700">Ejercicio </label>
                  <select id="ejercicio" name="ejercicio"  class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" >
                      <option value="" >Elija una cliente</option>
                      
                  </select>
                <label id="error_cliente" name="error_cliente" class="hidden text-base font-normal text-red-500" >Seleccione una opción</label>
                <input type="text" id="cliente_id" name="cliente_id" class="hidden" value="{{ $integrante->cliente_id}}">
                </div>
                
                
              </div>
            </div>
            <div class="px-4 py-3 bg-gray-100 sm:px-6">
              <span class="block text-xs">Porfavor verifique que todos los campos marcados con ( * ) esten rellenados</span>
              <div class="text-right">
                <a type="button" href="{{redirect()->getUrlGenerator()->previous()}}" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-gray-500 hover:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
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
//Validacion de select municipio
function validarMunicipio() { //validacion para elegir una opcion
  var valor = document.getElementById("municipio").value;
  if(valor != ''){
    $('#error_municipio').fadeOut();
    $("#label_municipio").removeClass('text-red-500');
    $("#label_municipio").addClass('text-gray-700');
  }else{
    $('#error_municipio').fadeIn();
    $("#label_municipio").addClass('text-red-500');
    $("#label_municipio").removeClass('text-gray-700');
  }
}

//validacion de campos del formulario
$(document).ready(function() {

  window.onload = function(){ //al terminar de cargar la pagina se rellena el select ejercicio con el municipio seleccionado
  var municipio = $('#municipio').val();
  var link = '{{ url("/clienteEjercicio")}}/'+municipio;
  obtenerEjercicios(link);
  }

  $('#municipio').on('keyup change', function(){ //ejercicio select
      municipio = $('#municipio').val();
      $("#ejercicio").empty(); //valida si no se ha seleccionado una opc
      $("#ejercicio").append('<option value="">Elija un ejercicio</option>');
      if(municipio.length!=0){
      
         link = '{{ url("/clienteEjercicio")}}/'+municipio;
        obtenerEjercicios(link);
      }else{
        $("#ejercicio").empty(); //valida si no se ha seleccionado una opc
      $("#ejercicio").append('<option value="">Elija un cliente</option>');
      }

    });
//===================================================
    function obtenerEjercicios(link){ //funcion ajax 
      $.ajax({
              url: link,
              dataType:'json',
              type:'get',
              success: function(data){
                $.each(data,function(key, item) { //llenado del select ejercicio
                console.log(item.id_cliente);
                $("#ejercicio").append('<option value='+item.id_cliente+'>'+item.anio_inicio+' - '+item.anio_fin+'</option>');
                });
              },
              cache: false
            });
    }
//========================================
$('#ejercicio').on('change', function(){
  
  $('#cliente_id').val($('#ejercicio').val());
});
//===========================================
   $("#formulario input").keyup(function() {
  
      var monto = $(this).val();
      
      if(monto != ''){
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
//=======================================
    $("input[name='telefono']").keyup(function() { //validacion de telefono
      if($(this).val()>10){
          telefono = $(this).val();
          telefono= telefono.slice(0,10);
          $(this).val(telefono.replace(/^(\d{3})(\d{3})(\d+)$/, "($1)$2-$3"));
        }
        else{
          $(this).val($(this).val().replace(/^(\d{3})(\d{3})(\d+)$/, "($1)$2-$3"));
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
			cargo: { required: true},
      rfc: { required: true, minlength: 5, maxlength: 13},
      municipio: { required: true},
      
		},
    errorPlacement: function(error, element) {
      if(error != null){
      $('#error_'+element.attr('id')).fadeIn();
      }else{
        $('#error_'+element.attr('id')).fadeOut();
      }
     
    },
	}); 
});
  </script>
  
@endsection