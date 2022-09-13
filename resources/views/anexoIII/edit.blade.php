@extends('layouts.plantilla')
@section('title','Editar Anexos')
@section('contenido')

<div class="flex flex-row mb-4">
    <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
    </svg>
    <h1 class="font-bold text-xl ml-2">Editar Anexos Fondo III</h1>
</div>

<div class="mt-10 sm:mt-0 shadow-2xl bg-white rounded-lg">
      
    <div class="mt-5 md:mt-0 md:col-span-2">
      <form action="{{ route('anexos.update', $anexos) }}" method="POST" id="formulario" name="formulario" onsubmit="return validar();">
        @csrf
        @method('PUT')
        <div class="shadow overflow-hidden sm:rounded-md">
          <div class="px-4 py-5 bg-white sm:p-6">
            <div class="grid grid-cols-6 gap-6">
              <div class="col-span-6 sm:col-span-3">
                <label id="label_municipio" for="municipio" class="block text-sm font-medium text-gray-700">Municipio *</label>
                <input type="text" name="municipio" id="municipio"  class="mt-1 focus:ring-indigo-500 block bg-gray-100 w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ $anexos->nombre }}" disabled>
              </div>

              <div class="col-span-6 sm:col-span-3">
                <label id="label_rfc" for="ejercicio" class="block text-sm font-medium text-gray-700">Ejercicio:</label>
                <input type="text" id="ejercicio" name="ejercicio" class="mt-1 w-full block bg-gray-100 shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ $anexos->ejercicio }}" disabled>
              </div>
              
              <div class="col-span-6 sm:col-span-3">
                <label id="label_acta_integracion_consejo" for="acta_integracion_consejo" class="block text-sm font-medium text-gray-700">Acta de integración *</label>
                <input type="date" name="acta_integracion_consejo" id="acta_integracion_consejo" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ $anexos->acta_integracion_consejo }}" required>
                <label id="error_acta_integracion_consejo" class="hidden block text-md text-red-500">Se require de una fecha</label>
              </div>

              <div class="col-span-6 sm:col-span-3">
                  <label id="label_acta_priorizacion" for="acta_priorizacion" class="block text-sm font-medium text-gray-700">Acta de priorización *</label>
                  <input type="date" name="acta_priorizacion" id="acta_priorizacion" placeholder="Nombre" maxlength="40" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ $anexos->acta_priorizacion }}" required>
                  <label id="error_acta_priorizacion" class="hidden block text-md text-red-500">Se require de una fecha</label>
              </div>
              <div class="col-span-6 sm:col-span-3">
                  <label id="label_adendum_priorizacion" for="adendum_priorizacion" class="block text-sm font-medium text-gray-700">Adendum *</label>
                  <input type="date" name="adendum_priorizacion" id="adendum_priorizacion" placeholder="Conocido S/N" maxlength="70" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ $anexos->adendum_priorizacion }}" >
                  
              </div>

              <div class="col-span-6 sm:col-span-3 flex justify-center gap-12">

                <div class="flex flex-col">
                  <div class="col-span-6 flex justify-center mb-2">
                    <label class="col-span-3 inline-flex items-center mt-3">
                        <input type="checkbox" id="prodim" name="prodim" class="ml-2 shadow-sm sm:text-sm border-gray-300 rounded h-6 w-6" {{ ($anexos->prodim==1) ? 'checked' : '' }}><span class="ml-2 text-gray-700">Prodim</span>
                    </label>

                    <label class="col-span-6 inline-flex items-center mt-3">
                        <input type="checkbox" id="gastos_indirectos" name="gastos_indirectos" class="ml-2 shadow-sm sm:text-sm border-gray-300 rounded h-6 w-6" {{ ($anexos->gastos_indirectos==1) ? 'checked' : '' }}><span class="ml-2 text-gray-700">Gastos indirectos</span>
                    </label>
                  </div>

                  <div class="flex flex-row">
                    <div class="p-1">
                      <div class="hidden" id="div_porcentaje_prodim">
                        <label id="label_porcentaje_prodim" for="porcentaje_prodim" class="block text-sm font-medium text-gray-700">Porcentaje PRODIMDF *</label>
                        <div class="relative ">
                          <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <span class="text-gray-500 sm:text-sm">
                              % 
                            </span>
                          </div>
                          <input type="text" name="porcentaje_prodim" id="porcentaje_prodim" maxlength="3" class="pl-7 mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" placeholder="0" value="{{$anexos->porcentaje_prodim}}">
                        </div>
                        <label id="error_porcentaje_prodim" class="hidden block text-md text-red-500">Se require de un porcentaje (max %2)</label>
                        <label for="" id="proyectado_prodim" class="hidden block text-md"></label>
                      </div>
                    </div>

                    <div class="p-1">
                      <div class="hidden" id="div_porcentaje_gastos">
                        <label id="label_porcentaje_gastos" for="porcentaje_gastos" class="block text-sm font-medium text-gray-700">Porcentaje gastos indirectos *</label>
                        <div class="relative ">
                          <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <span class="text-gray-500 sm:text-sm">
                              %
                            </span>
                          </div>
                          <input type="text" name="porcentaje_gastos" id="porcentaje_gastos" maxlength="3" class="pl-7 mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" placeholder="0" value="{{$anexos->porcentaje_gastos}}">
                        </div>
                        <label id="error_porcentaje_gastos" class="hidden block text-md text-red-500">Se require de un porcentaje (max %3)</label>
                        <label for="" id="proyectado_gastos" class="hidden block text-md"></label>
                      </div>
                    </div>

                  </div>

                </div>
                

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
window.onload = function(){
  var anio= $('#ejercicio').val();
  fechaMin = anio+'-01'+'-01';
  fechaMax = anio+'-12'+'-31';
  $('#acta_integracion_consejo').attr('min',fechaMin);
  $('#acta_integracion_consejo').attr('max',fechaMax);
  $('#acta_priorizacion').attr('min',fechaMin);
  $('#acta_priorizacion').attr('max',fechaMax);
  $('#adendum_priorizacion').attr('min',fechaMin);
  $('#adendum_priorizacion').attr('max',fechaMax);
  prodim = document.getElementById('prodim').checked;
  gastos_indirectos = document.getElementById('gastos_indirectos').checked;

  if(prodim == true){
    $('#div_porcentaje_prodim').removeClass('hidden');
  }
  if(gastos_indirectos == true){
    $('#div_porcentaje_gastos').removeClass('hidden');
  }

}

function validar(){
    band = true;
    $acta_integracion = document.forms['formulario']['acta_integracion_consejo'].value;
    if($acta_integracion == ""){
      $('#error_acta_integracion_consejo').removeClass('hidden');
      band = false;
    }else{
      $('#error_acta_integracion_consejo').addClass('hidden');
    }
    $acta_priorizacion = document.forms['formulario']['acta_priorizacion'].value;
    if($acta_priorizacion == ""){
      $('#error_acta_priorizacion').removeClass('hidden');
    }else{
      $('#error_acta_priorizacion').addClass('hidden');
    }

    prodim = document.getElementById("prodim").checked;
    
    if(prodim == true){
      porcentaje_prodim= document.forms["formulario"]["porcentaje_prodim"].value;
      
      if(porcentaje_prodim == "" || porcentaje_prodim < 0.1 || porcentaje_prodim > 2){
        $('#error_porcentaje_prodim').removeClass('hidden');  
        band = false;
      }else{
        $('#error_porcentaje_prodim').addClass('hidden');
      }
     
    }

     gastos_indirectos = document.getElementById("gastos_indirectos").checked;
    
     if(gastos_indirectos == true){
       porcentaje_gastos= document.forms["formulario"]["porcentaje_gastos"].value;
      
      if(porcentaje_gastos == "" || parseFloat(porcentaje_prodim) == 0 || parseFloat(porcentaje_gastos) < 0.1 || parseFloat(porcentaje_gastos) > 3){
         $('#error_porcentaje_gastos').removeClass('hidden');  
         band = false;
       }else{
           $('#error_porcentaje_gastos').addClass('hidden');
       }
     }
    return band;
}


  $().ready(function() {
    $('#prodim').on('change', function(){
    //console.log($(this).val())
    if(this.checked == true){
      //$('#div_porcentajes').removeClass('hidden');
      $('#div_porcentaje_prodim').removeClass('hidden');
      //$('#porcentaje_prodim').prop('required',true);
    }else{
      //$('#div_porcentajes').addClass('hidden');
      $('#div_porcentaje_prodim').addClass('hidden');
      //$('#porcentaje_prodim').prop('required',false);
    }
  });
  $('#gastos_indirectos').on('change', function(){
    if(this.checked == true){
      //$('#div_porcentajes').removeClass('hidden');
      $('#div_porcentaje_gastos').removeClass('hidden');
      //$('#porcentaje_gastos').prop('required',true);
    }else{
      //$('#div_porcentajes').addClass('hidden');
      $('#div_porcentaje_gastos').addClass('hidden');
      //$('#porcentaje_gastos').prop('required',false);
    }
  });


    $("input").keyup(function() {
        $("#porcentaje_prodim, #porcentaje_gastos").on({ //validacion de solo numeros
            "focus": function(event) {
                $(event.target).select();
            },
            "keyup": function(event) {
                $(event.target).val(function(index, value) { //formato montos
                    return value.replace(/\D/g, "")
                        .replace(/[^\d]/,'')
                        .replace(/\B(?=(\d{2})+(?!\d)?)/g, ".");
                });
            }
        });  
    });

      // $("#formulario").validate({
      //   onfocusout: false,
      //   onclick: false,
      //   rules: {
      //     acta_integracion_consejo: { required: true},
      //     acta_priorizacion: { required: true},
      //   },
      //   errorPlacement: function(error, element) {
      //     if(error != null){
      //       $('#error_'+element.attr('id')).fadeIn();
      //     }else{
      //       $('#error_'+element.attr('id')).fadeOut();
      //     }
        
      //   },
      // }); 
  });
</script>
@endsection