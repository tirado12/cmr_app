@extends('layouts.plantilla')
@section('title','Editar Fuente financiamiento')
@section('contenido')
@inject('service', 'App\Http\Controllers\ObraController')

<div class="flex flex-row mb-4">
<svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
</svg>
<h1 class="font-bold text-xl ml-2">Editar Fuente financiamiento</h1>
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
        <form action="{{ route('fuenteCliente.update', $fuenteCliente) }}" method="POST" id="formulario" name="formulario">
          @csrf
          @method('PUT')
          <div class="shadow overflow-hidden sm:rounded-md">
            <div class="px-4 py-5 bg-white sm:p-6"> 
              <div class="grid grid-cols-10 gap-6">

                <div class="col-span-7 lg:col-span-4">
                  <label for="first_name" class="block text-sm font-medium text-gray-700">Municipio</label>
                  <label id="label_municipio" for="monto_comprometido" class="block text-base font-medium text-gray-700 py-3 px-2">{{ $cliente[0]->nombre }}</label>
                </div>

                <div class="col-span-3 lg:col-span-2">
                  <label for="ejercicio" class="block text-sm font-medium text-gray-700">Ejercicio</label>
                  <label id="label_ejercicio" for="monto_comprometido" class="block text-base font-medium text-gray-700 py-3 px-2">{{ $fuenteCliente->ejercicio }}</label>
                </div>
  
                <div class="col-span-10 lg:col-span-2">
                  <label id="label_monto_proyectado" for="monto_proyectado" class="block text-sm font-medium text-gray-700">Monto proyectado *</label>
                  <div class="relative ">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                      <span class="text-gray-700 text-base">
                        $
                      </span>
                    </div>
                    <input type="text" name="monto_proyectado" id="monto_proyectado" class="pl-7 mt-1 text-base focus:ring-indigo-500 focus:border-indigo-500 block text-gray-700 w-full shadow-sm border-gray-300 rounded-md myDIV" value="{{$service->formatNumber($fuenteCliente->monto_proyectado)}}" onclick="">
                  </div>
                  <label id="error_monto_proyectado" name="error_monto_proyectado" class="hidden text-base font-normal text-red-500" >Introduzca un monto proyectado</label>
                </div>
                
                <div class="col-span-10 lg:col-span-2">
                    <label id="label_monto_comprometido" for="monto_comprometido" class="block text-sm font-medium text-gray-700">Monto comprometido *</label>
                    <div class="relative ">
                      <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <span class="text-gray-700 text-base">
                          $
                        </span>
                      </div>
                      <input type="text" name="monto_comprometido" id="monto_comprometido" class="pl-7 mt-1 text-base focus:ring-indigo-500 focus:border-indigo-500 block text-gray-700 w-full border-none myDIV" disabled value="{{$service->formatNumber($fuenteCliente->monto_comprometido)}}" onclick="">
                    </div>
                </div>
                
                @if($fuenteCliente->fuente_financiamiento_id == 2)
                <div class="col-span-10 lg:col-span-2">
                    <label id="label_acta_integracion_consejo" for="acta_integracion_consejo" class="block text-sm font-medium text-gray-700">Acta de integracion de consejo *</label>
                    <input type="date" name="acta_integracion_consejo" id="acta_integracion_consejo" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ $fuenteCliente->acta_integracion_consejo }}">
                    <label id="error_acta_integracion_consejo" name="error_acta_integracion_consejo" class="hidden text-base font-normal text-red-500" >Introduzca una fecha</label>
                </div>
                
                <div class="col-span-10 lg:col-span-2">
                    <label id="label_acta_priorizacion" for="acta_priorizacion" class="block text-sm font-medium text-gray-700">Acta priorización *</label>
                    <input type="date" name="acta_priorizacion" id="acta_priorizacion" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ $fuenteCliente->acta_priorizacion }}">
                    <label id="error_acta_priorizacion" name="error_acta_priorizacion" class="hidden text-base font-normal text-red-500" >Introduzca una fecha</label>
                </div>

                <div class="col-span-10 lg:col-span-2">
                    <label id="label_adendum_priorizacion" for="adendum_priorizacion" class="block text-sm font-medium text-gray-700">Adendum priorización *</label>
                    <input type="date" name="adendum_priorizacion" id="adendum_priorizacion" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ $fuenteCliente->adendum_priorizacion }}">
                    <label id="error_adendum_priorizacion" name="error_adendum_priorizacion" class="hidden text-base font-normal text-red-500" >Introduzca una fecha</label>
                </div>
                @endif

                <div class="col-span-10 lg:col-span-2">
                    <label id="label_fuente_financiamiento_id" for="fuente_financiamiento_id" class="block text-sm font-medium text-gray-700">Fuente de financiamiento *</label>
                    <select id="fuente_financiamiento_id" name="fuente_financiamiento_id" class="clickable mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" >                
                      @role('Administrador')
                        @foreach($fuentes as $fuente)
                          <option value="{{ $fuente->id_fuente_financiamiento }}" {{ ($fuente->id_fuente_financiamiento == $fuenteCliente->fuente_financiamiento_id) ? 'selected' : '' }}> {{ $fuente->nombre_corto }} </option>
                        @endforeach
                      @endrole
                      @role('Usuario')
                        <option value="{{ $fuenteCliente->fuente_financiamiento_id }}" selected> {{ $fuentes->where('id_fuente_financiamiento', $fuenteCliente->fuente_financiamiento_id )->first()->nombre_corto}}</option>
                      @endrole
                    </select>
                    <label id="error_fuente_financiamiento_id" name="error_fuente_financiamiento_id" class="hidden text-base font-normal text-red-500" >Se requiere una opción</label>
                </div>

                <div class="col-span-10 lg:col-span-2">
                  @if($fuenteCliente->fuente_financiamiento_id == 2)
                    <div>
                      <label for="cbox2" class="text-sm font-medium text-gray-700"><input type="checkbox" id="prodim" name="prodim" {{ ($fuenteCliente->prodim == 1) ? 'checked' : '' }}> PRODIMDF</label><br>
                      <label for="cbox2" class="text-sm font-medium text-gray-700"><input type="checkbox" id="gastos_indirectos" name="gastos_indirectos" {{ ($fuenteCliente->gastos_indirectos == 1) ? 'checked' : '' }}> Gastos indirectos</label>
                    </div>
                  @endif
                    
                </div>
                <div class="col-span-10">
                  <label id="error_monto" name="error_monto" class="hidden w-full text-base font-normal text-red-500" >El monto proyectado debe ser mayor o igual al comprometido</label>
                </div>

              </div>

            </div>
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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>    
  <script>
    
//colocar opcion registrada en los selected
    $(document).ready(function(){
      $("#monto_proyectado").on({
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
      $("#monto_comprometido").on({
          "focus": function(event) {
              $(event.target).select();
          },
          "keyup": function(event) {
            $(event.target).val(function(index, value) {
                return value.replace(/\D/g, "")
                    .replace(/([0-9])([0-9]{2})$/, '$1.$2')
                    .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ",");
            });
          }
      });

      $('#monto_proyectado').keyup();

      $('#monto_comprometido').keyup();

      var statusProdim =  '{{ $fuenteCliente->prodim }}';
      var statusGastos =  '{{ $fuenteCliente->gastos_indirectos }}';
      $("#prodim option").each(function(){
        if($(this).val() == statusProdim){
        	   $(this).attr("selected",true);
        }
    	});
      $("#gastos_indirectos option").each(function(){
        
        if($(this).val() == statusGastos){
        	   $(this).attr("selected",true);
        }else if (statusGastos != '1' && statusGastos != '3' && statusGastos != '2'){
          $("#gastos_indirectos option[value='0']").attr("selected", true);
        }
    	});      
    });

//validacion de campos del formulario
$(document).ready(function() {
   $("#formulario input").keyup(function() {
  //console.log($(this).attr('id'));
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

//validacion de los selected
    $('.clickable').click(function() {
      var valor = $(this).val();
      
      if(valor != 0){
      $('#error_'+$(this).attr('id')).fadeOut();
      $("#label_"+$(this).attr('id')).removeClass('text-red-500');
      $("#label_"+$(this).attr('id')).addClass('text-gray-700');
      //$('#guardar').removeAttr("disabled");
      }else{
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
      municipio: { required: true},
			monto_proyectado: { required: true},
      monto_comprometido: { required: true},
      ejercicio: { required: true},
      acta_integracion_consejo: { required: true},
      acta_priorizacion: { required: true},
      adendum_priorizacion: { required: true},
      fuente_financiamiento_id: { required: true},
      /*prodim: { required: true},
      gastos_indirectos: { required: true},*/
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
  $("#enviar_datos").click(function () {
      var $m_p = $("#monto_proyectado").val().replaceAll(",", "");
      var $m_c = $("#label_comprometido").text().replaceAll(",","").replaceAll("$", "");
      
      
      if($m_p < $m_c){
        $("#error_monto").removeClass("hidden");
        return false;
      }else{
        $("#error_monto").addClass("hidden");
        return true;
      }

        
        
    });
});
  </script>
  
  
  
@endsection