@extends('layouts.plantilla')
@section('title','Editar Contratista')
@section('contenido')

<div class="flex flex-row mb-4">
<svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
</svg>
<h1 class="font-bold text-xl ml-2">Editar Contratista</h1>
</div>


<div class="mt-10 sm:mt-0 shadow-2xl bg-white rounded-lg">
      
      <div class="mt-5 md:mt-0 md:col-span-2">
        <form action="{{ route('contratistas.update', $contratista) }}" method="POST" id="formulario" name="formulario">
          @csrf
          @method('PUT')
          <div class="shadow overflow-hidden sm:rounded-md">
            <div class="px-4 py-5 bg-white sm:p-6">
              <div class="grid grid-cols-6 gap-6">
                <div class="col-span-6 sm:col-span-3">
                  <label id="label_rfc" for="rfc" class="block text-sm font-medium text-gray-700">RFC *</label>
                  <input type="text" name="rfc" id="rfc" placeholder="BDS140512XXXX" maxlength = "13" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ $contratista->rfc }}">
                  <label id="error_rfc" name="error_rfc" class="hidden text-base font-normal text-red-500" >Se requiere al menos un RFC generico de 12 caracteres</label>
                </div>

                <div class="col-span-6 sm:col-span-3">
                  <label id="label_rfc" for="tipo_rfc" class="block text-sm font-medium text-gray-700">Tipo de contribuyente:</label>
                  <input type="text" id="tipo_rfc" name="tipo_rfc" class="mt-1 w-full block bg-gray-100 shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{( $contratista->tipo_rfc ) ? 'Persona Moral' : 'Persona Física'}}" disabled>
                  
                </div>
                
                <div class="col-span-6 sm:col-span-3">
                  <label id="label_razon_social" for="razon_social" class="block text-sm font-medium text-gray-700">Razón social *</label>
                  <input type="text" name="razon_social" id="razon_social" placeholder="Materiales para construcción S.A. de C.V." maxlength="70" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ $contratista->razon_social }}">
                  <label id="error_razon_social" name="error_razon_social" class="hidden text-base font-normal text-red-500" >Se requiere una razón social</label>
                </div>

                <div class="col-span-6 sm:col-span-3">
                    <label id="label_representante_legal" for="representante_legal" class="block text-sm font-medium text-gray-700">Representante legal *</label>
                    <input type="text" name="representante_legal" id="representante_legal" placeholder="Nombre" maxlength="40" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ $contratista->representante_legal }}">
                    <label id="error_representante_legal" name="error_representante_legal" class="hidden text-base font-normal text-red-500" >Se requiere un representante legal</label>
                </div>
                <div class="col-span-6 sm:col-span-3">
                    <label id="label_domicilio" for="domicilio" class="block text-sm font-medium text-gray-700">Domicilio *</label>
                    <input type="text" name="domicilio" id="domicilio" placeholder="Conocido S/N" maxlength="70" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ $contratista->domicilio }}">
                    <label id="error_domicilio" name="error_domicilio" class="hidden text-base font-normal text-red-500" >Se requiere un domicilio</label>
                  </div>
                <div class="col-span-6 sm:col-span-3">
                    <label id="etiqueta_telefono" for="telefono" class="block text-sm font-medium text-gray-700">Telefono</label>
                    <input type="tel" name="telefono" id="telefono" placeholder="9519999999" maxlength = "13" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ $contratista->telefono }}">
                    
                  </div>
                <div class="col-span-6 sm:col-span-3">
                    <label id="label_correo" for="correo" class="block text-sm font-medium text-gray-700">Correo *</label>
                    <input type="text" name="correo" id="correo" placeholder="usuario@ejemplo.com" maxlength="30" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ $contratista->correo }}">
                    <label id="error_correo" name="error_correo" class="hidden text-base font-normal text-red-500" >Se requiere un correo</label>
                  </div>
                <div class="col-span-6 sm:col-span-3">
                    <label id="label_numero_padron_contratista" for="numero_padron_contratista" class="block text-sm font-medium text-gray-700">Numero de padron *</label>
                    <input type="text" name="numero_padron_contratista" id="numero_padron_contratista" placeholder="100" maxlength = "15" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ $contratista->numero_padron_contratista }}">
                    <label id="error_numero_padron_contratista" name="error_numero_padron_contratista" class="hidden text-base font-normal text-red-500" >Se requiere un numero de padron</label>
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
  
  //validacion de campos del modal
  $(document).ready(function() {
   $("#formulario input").keyup(function() {

    if($('#rfc').val().length <= 12){ //mensajes y validacion rfc y representante legal
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

    $("input[name='telefono']").keyup(function() { //validacion de telefono
    $(this).val($(this).val().replace(/^(\d{3})(\d{3})(\d+)$/, "($1)$2-$3"));
      });
  });

//validacion del formulario con el btn guardar
  $().ready(function() {
    $("#formulario").validate({
      onfocusout: false,
      onclick: false,
      rules: {
        rfc: { required: true, minlength: 12, maxlength: 13},
        razon_social: { required: true},
        representante_legal: { required: true},
        domicilio: { required: true},
        
        correo: { required: true, email: true},
        numero_padron_contratista: { required: true},
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