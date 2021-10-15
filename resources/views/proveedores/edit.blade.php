@extends('layouts.plantilla')
@section('title','Editar Proveedor')
@section('contenido')

<div class="flex flex-row mb-4">
<svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
</svg>
<h1 class="font-bold text-xl ml-2">Editar Proveedor</h1>
</div>

<div class="alert flex flex-row items-center bg-blue-200 p-2 rounded-lg border-b-2 border-blue-300 mb-4 shadow">
  <div class="alert-icon flex items-center bg-blue-100 border-2 border-blue-500 justify-center h-10 w-10 flex-shrink-0 rounded-full">
    <span class="text-blue-500">
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
    <div class="alert-title font-semibold text-lg text-blue-800">
      Recuerda
    </div>
    <div class="alert-description text-sm text-blue-600">
      <strong>NO</strong> compartir detalles o capturas del sistema, previene la filtración de datos sensibles.
    </div>
  </div>
</div>

<div class="mt-10 sm:mt-0 shadow-2xl bg-white rounded-lg">
      
      <div class="mt-5 md:mt-0 md:col-span-2">
        <form action="{{ route('proveedor.update', $proveedor) }}" method="POST" id="formulario" name="formulario">
          @csrf
          @method('PUT')
          <div class="shadow overflow-hidden sm:rounded-md">
            <div class="px-4 py-5 bg-white sm:p-6">
              <div class="grid grid-cols-6 gap-6">
                <div class="col-span-6 sm:col-span-3">
                  <label id="label_rfc" for="rfc" class="block text-sm font-medium text-gray-700">RFC *</label>
                  <input type="text" name="rfc" id="rfc" maxlength="13" placeholder="BDS140512XXXX" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ $proveedor->rfc }}" required>
                  <label id="error_rfc" name="error_rfc" class="hidden text-base font-normal text-red-500" >Introduzca al menos un RFC generico con 5 caracteres</label>
                </div>

                <div class="col-span-8">
                  <label id="label_representante_legal" for="representante_legal" class="block text-sm font-medium text-gray-700">Representante legal </label>
                  <input type="text" name="representante_legal" id="representante_legal" placeholder="Nombre" maxlength="40" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" >
                  <label id="error_representante_legal" name="error_representante_legal" class="hidden text-base font-normal text-red-500" >Porfavor ingresar un representante legal</label>
                </div>
  
                <div class="col-span-6 sm:col-span-3">
                  <label id="label_rfc" for="tipo_rfc" class="block text-sm font-medium text-gray-700">Tipo de contribuyente:</label>
                  <input type="text" id="tipo_rfc" name="tipo_rfc" class="mt-1 w-full block bg-gray-100 shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{( $proveedor->tipo_rfc ) ? 'Persona Moral' : 'Persona Física'}}" disabled>
                  
                </div>

                <div class="col-span-6 sm:col-span-3">
                  <label id="label_razon_social" for="razon_social" class="block text-sm font-medium text-gray-700">Razón social *</label>
                  <input type="text" name="razon_social" id="razon_social" placeholder="Materiales para construcción S.A. de C.V." maxlength="70" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ $proveedor->razon_social }}" required>
                  <label id="error_razon_social" name="error_razon_social" class="hidden text-base font-normal text-red-500" >Introduzca una razon social</label>
                </div>

                
              </div>
            </div>
            <div class="px-4 py-3 bg-gray-100 sm:px-6">
              <span class="block text-xs">Porfavor verifique que todos los campos marcados con ( * ) esten rellenados</span>
              <div class="text-right">
                <a type="button" href="{{redirect()->getUrlGenerator()->previous()}}" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-gray-500 hover:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                  Regresar
                </a>
              <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-orange-800 hover:bg-orange-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
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
   //validacion de campos del form
  $(document).ready(function() {


   $("#formulario input").keyup(function() {// validacion de rfc y representante legal

    if($('#rfc').val().length <= 12){
      $("#tipo_rfc").empty();
        $('#tipo_rfc').val('Persona Moral');
        $('#label_representante_legal').removeClass('hidden');
        $('#representante_legal').removeClass('hidden');
     }else{
      $("#tipo_rfc").empty();
        $('#tipo_rfc').val('Persona Física');
        $('#label_representante_legal').addClass('hidden');
        $('#representante_legal').addClass('hidden');
     }
    
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
        rfc: { required: true, minlength: 5, maxlength: 13},
        razon_social: { required: true} 
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