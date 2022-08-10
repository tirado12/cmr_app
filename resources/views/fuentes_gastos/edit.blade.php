@extends('layouts.plantilla')
@section('title','Editar Fuentes Gastos Indirectos')
@section('contenido')

<div class="flex flex-row mb-4">
<svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
</svg>
<h1 class="font-bold text-xl ml-2">Editar fuente gastos indirectos</h1>
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
        <form action="{{ route('gastosIndirectosFuentes.update', $gastoIndirecto->id_fuentes_gastos_indirectos)  }}" method="POST" id="formulario" name="formulario" onsubmit="return validar();">
          @csrf
          @method('PUT')
          <div class="shadow overflow-hidden sm:rounded-md">
            <div class="px-4 py-5 bg-white sm:p-6"> 
              <div class="grid grid-cols-6 gap-6">
                
                <div class="col-span-6 sm:col-span-3">
                  <label for="first_name" class="block text-sm font-medium text-gray-700">Municipio *</label>
                  <input type="text" name="municipio" id="municipio" autocomplete="given-name" class="mt-1 focus:ring-gray-500 focus:border-gray-500 bg-gray-100 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ $gastoIndirecto->nombre }}" disabled>
                  <input type="text" class="hidden" id="gasto_indirecto" name="gastos_indirecto" value="{{$gastoIndirecto->fuente_cliente_id}}">
                </div>
  
                <div class="col-span-6 sm:col-span-3">
                  <label id="label_ejercicio" for="ejercicio" class="block text-sm font-medium text-gray-700">Ejercicio *</label>
                  <input type="number" name="ejercicio" id="ejercicio" class="mt-1 focus:ring-gray-500 focus:border-gray-500 bg-gray-100 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md myDIV" value="{{ $gastoIndirecto->ejercicio}}" disabled>
                  <label id="error_ejercicio" name="error_ejercicio" class="hidden text-base font-normal text-red-500" >Introduzca un monto proyectado</label>
                </div>
                
                  
                <div class="col-span-6 sm:col-span-3">
                    <label id="label_gasto_indirecto" for="gasto_indirecto" class="block text-sm font-medium text-gray-700">Gasto Indirecto *</label>
                    <input type="text" name="indirectos_id" id="indirectos_id" class="mt-1 focus:ring-gray-500 focus:border-gray-500 bg-gray-100 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md myDIV" value="{{$indirectos->find($gastoIndirecto->indirectos_id)->nombre}}" disabled>
                    <label id="error_gasto_indirecto" name="error_gasto_indirecto" class="hidden text-base font-normal text-red-500" >Introduzca un gasto</label>
                </div>

                <div class="col-span-3">
                  <label id="label_monto_gastos" for="monto_gastos" class="block text-sm font-medium text-gray-700">Monto total gastos indirectos*</label>
                  <div class="relative ">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                      <span class="text-gray-500 sm:text-sm">
                        $
                      </span>
                    </div>
                    <input type="text" name="monto_gastos" id="monto_gastos" class="pl-7 mt-1 focus:ring-indigo-500 focus:border-indigo-500 bg-gray-100 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" placeholder="0.00" readonly value="{{$gastoIndirecto->monto_prodim}}">
                  </div>
                </div>

                <div class="col-span-3">
                  <label id="label_monto_disponible" for="monto_disponible" class="block text-sm font-medium text-gray-700">Monto disponible*</label>
                  <div class="relative ">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                      <span class="text-gray-500 sm:text-sm">
                        $
                      </span>
                    </div>
                    <input type="text" name="monto_disponible" id="monto_disponible" class="pl-7 mt-1 focus:ring-indigo-500 focus:border-indigo-500 bg-gray-100 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" placeholder="0.00" readonly>
                  </div>
                </div>

                <div class="col-span-3">
                  <label id="label_monto" for="monto" class="block text-sm font-medium text-gray-700">Monto*</label>
                  <div class="relative ">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                      <span class="text-gray-500 sm:text-sm">
                        $
                      </span>
                    </div>
                    <input type="text" name="monto" id="monto" class="pl-7 mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" placeholder="0.00" value="{{$gastoIndirecto->monto}}">
                  </div>
                  <label id="error_monto" name="error_monto" class="hidden text-base font-normal text-red-500" >Por favor ingresar un monto</label>  
                  <label id="error_monto_disponible" class="hidden block text-md text-red-500">La cantidad ingresada supera el monto disponible</label>
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
function moneda(valor){//formato montos
      return valor.toString().replace(/\D/g, "").replace(/([0-9])([0-9]{2})$/, '$1.$2').replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ",");
    }

  window.onload = function(){
    $('#monto').val(moneda(parseFloat($('#monto').val()).toFixed(2)));
    $('#monto_gastos').val(moneda(parseFloat($('#monto_gastos').val()).toFixed(2)));
    

    consultarSumaComprometido( $('#gasto_indirecto').val());
    
  }

  function consultarSumaComprometido(fuenteCliente){
             if(fuenteCliente != ''){var link = '{{ url("/montoGastosComprometido")}}/'+fuenteCliente; //consulta ajax
             //console.log(link)
               $.ajax({
                        url: link,
                        dataType:'json',
                        type:'get',
                        success: function(data){
                            //console.log(data)
                            sumaComprometido = parseFloat(data).toFixed(2);
                            montoTotalProdim = parseFloat($('#monto_gastos').val().replace(",","")).toFixed(2);
                            montoDisponible = montoTotalProdim - sumaComprometido;
                            $('#monto_disponible').val(moneda(parseFloat(montoDisponible).toFixed(2)));
                        },
                        cache: false
              });}
    }

    function validar(){
      band = true;
                monto = document.forms['formulario']['monto'].value;
                if(monto == ''){
                  $('#error_monto').removeClass('hidden');
                  band = false;
                }else{
                    montoNuevo = parseFloat(monto.replace(",","")).toFixed(2);
                    montoRegistrado = "{{$gastoIndirecto->monto}}";
                    monto_disponible = document.forms["formulario"]["monto_disponible"].value;
                    monto_disponible = parseFloat(monto_disponible.replace(",","")).toFixed(2);
                        
                    diferencia = parseFloat(montoNuevo)-parseFloat(montoRegistrado);
                    
                    if(diferencia>monto_disponible){
                      band = false;
                      $('#error_monto_disponible').removeClass('hidden');
                    }else{
                       $('#error_monto_disponible').addClass('hidden');
                    }
                  $('#error_monto').addClass('hidden');
              }
      return band;
    }

//validacion de campos del formulario
$(document).ready(function() {


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
//======================================================================================
  // $("#formulario").validate({ //validacion con el btn guardar
  //           onfocusout: false,
  //           onclick: false,
  //           rules: {
  //             monto: { required: true, minlength: 2 },
  //             gasto_indirecto: { required: true},
            
  //           },
  //           errorPlacement: function(error, element) {
  //             if(error != null){
  //             $('#error_'+element.attr('id')).fadeIn();
  //             }else{
  //               $('#error_'+element.attr('id')).fadeOut();
  //             }
            
  //           },
  //         }); 

});
//======================================================================================
// const formato = new Intl.NumberFormat('es-MX', { //dar formato a la cantidad 
//     minimumFractionDigits: 2,
//     maximumFractionDigits: 2,
//   });
//======================================================================================
 // $("#monto").val(formato.format('{{ $gastoIndirecto->monto}}').replace(/\D00(?=\D*$)/, ''));  
//======================================================================================
$("#monto").on({
            "focus": function(event) {
                $(event.target).select(); //formato al escribir el monto
            },
            "keyup": function(event) {
                $(event.target).val(function(index, value) {
                    return value.replace(/\D/g, "")
                        .replace(/([0-9])([0-9]{2})$/, '$1.$2')
                        .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ",");
                });
            }
        });

//======================================================================================
      //validar selected del cliente
function validarSelect() {
    var valor = document.getElementById("gasto_indirecto").value;
    if(valor != ''){
      $('#error_gasto_indirecto').fadeOut();
      $("#label_gasto_indirecto").removeClass('text-red-500');
      $("#label_gasto_indirecto").addClass('text-gray-700');
    }else{
      $('#error_gasto_indirecto').fadeIn();
      $("#label_gasto_indirecto").addClass('text-red-500');
      $("#label_gasto_indirecto").removeClass('text-gray-700');
    }
}
  </script>
  
  
  
@endsection