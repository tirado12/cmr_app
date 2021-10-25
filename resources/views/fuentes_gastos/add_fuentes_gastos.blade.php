@extends('layouts.plantilla')
@section('title','Fuentes Gastos Indirectos')
@section('contenido')

        <link rel="stylesheet" href="{{ asset('css/datatable.css') }}">
        <link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
        <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
        

<div class="flex flex-row">
    <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
    </svg>
  <h1 class="text-xl font-bold ml-2">Agregar Gasto indirecto a cliente</h1>
</div>

<div class="mt-6 contenedor p-8 shadow-2xl bg-white rounded-lg">
      <div class="text-white px-6 py-4 border-0 rounded relative mb-4 bg-blue-900">
        <span class="text-xl inline-block mr-5 align-middle">
          <i class="fas fa-bell"></i>
        </span>
        <span class="inline-block align-middle mr-8">
          <b class="capitalize">Nota:</b> <br> Debe agregar un cliente por ejercicio antes 
          <a href="{{route('clientes.index')}}" class="ml-2 rounded bg-orange-800 shadow-md text-white text-sm font-semibold p-1" target="_blank">Agregar nuevo cliente</a>
        </span>
        <button class="absolute bg-transparent text-2xl font-semibold leading-none right-0 top-0 mt-4 mr-6 outline-none focus:outline-none" onclick="closeAlert(event)">
          <span>×</span>
        </button>
      </div>

    <div class="relative p-6 flex-auto">
        <div class="alert flex flex-row items-center justify-center bg-gray-100 p-2 mb-4 shadow">
            <div class="alert-content ml-4">
              <p class="font-bold sm:text-sm">Gastos indirectos - fuentes</p>
            </div>
          </div>
    </div>
    <form id="formulario" name="formulario" action="{{ route('gastosIndirectosFuentes.store') }}" method="POST">
      @csrf
      @method('POST')

    <div class="grid grid-cols-8 gap-4">
      <div class="col-span-4 ">
        <label  id="label_cliente_id" for="cliente_id" class="block text-sm font-medium text-gray-700">Cliente *</label>
        <select id="cliente_id" name="cliente_id"  class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">                
            <option value=""> Elija una opción </option>
            @foreach ($clientes as $item)
            <option value="{{$item->cliente_id}}"> {{$item->nombre}} </option>
            @endforeach
        </select>
        <label id="error_cliente_id" name="error_cliente_id" class="hidden text-base font-normal text-red-500" >Seleccione una opción</label>
      </div>

      <div class="col-span-4">
        <label id="label_ejercicio" for="label_ejercicio" class="block text-sm font-medium text-gray-700">Ejercicio *</label>
          <select id="ejercicio" name="ejercicio" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">                
            <option value=""> Elija un cliente </option>
          </select>
        <label id="error_ejercicio" name="error_ejercicio" class="hidden text-base font-normal text-red-500" >Por favor ingresar un año de ejercicio</label>  
      </div>

      <div class="col-span-4 mb-4">
        <label id="label_gasto_indirecto" for="gasto_indirecto" class="block text-sm font-medium text-gray-700">Gasto indirecto *</label>
          <select id="gasto_indirecto" name="gasto_indirecto" onchange="validarSelect()" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">                
            <option value=""> Elija una opción </option>
            @foreach ($indirectos as $gasto)
            <option value="{{$gasto->id_indirectos}}"> {{$gasto->nombre}} </option>
            @endforeach
          </select>
        <label id="error_gasto_indirecto" name="error_gasto_indirecto" class="hidden text-base font-normal text-red-500" >Por favor ingresar un gasto indirecto al registro</label>  
      </div>

      <div class="col-span-4 mb-4">
        <label id="label_monto" for="monto" class="block text-sm font-medium text-gray-700">Monto *</label>
        <label class="relative flex w-full flex-wrap items-stretch mb-3 text-gray-500">
          <span class="z-10 h-full leading-snug font-normal absolute text-center text-blueGray-300 absolute bg-transparent rounded text-base items-center justify-center w-8 pl-3 py-3">
            <i class="fas fa-dollar-sign"></i>
          </span>
        <input type="text" name="monto" id="monto" class="mt-1 pl-8 focus:ring-gray-500 focus:border-gray-500 bg-gray-100 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" placeholder="(Primero completar las opciones)" disabled>
        </label>
        <label id="error_monto" name="error_monto" class="hidden text-base font-normal text-red-500" >Por favor ingresar un monto</label>  
        <input id="fuenteCliente_id" name="fuenteCliente_id" type="text" hidden>
      </div>
    
    
  </div>
  <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
    <a type="button" href="{{redirect()->getUrlGenerator()->previous()}}" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-gray-400 hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
      Regresar
    </a>
    <button type="submit" id="guardar" name="guardar" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-800">
      Guardar
    </button>
  </div>
</form>
</div>

<script>

function closeAlert(event){ //div de alerta - aviso dentro del modal agregar
    let element = event.target;
    while(element.nodeName !== "BUTTON"){
      element = element.parentNode;
    }
    element.parentNode.parentNode.removeChild(element.parentNode);
  }
$(document).ready(function() {

  //select muestra ejercicios disponibles por cliente
  $("#cliente_id").on('change', function () {

  cliente=$(this).val();
  $("#ejercicio").empty(); //valida si no se ha seleccionado una opc
  $("#ejercicio").append('<option value="">Elija un cliente</option>');

  var link = '{{ url("/selectEjercicio")}}/'+cliente; //consulta ajax
    $.ajax({
    url: link,
    dataType:'json',
    type:'get',
      success: function(data){
        $.each(data,function(key, item) {
          $("#ejercicio").append('<option value='+item.ejercicio+'>'+item.ejercicio+'</option>');
        });
      },
    cache: false
    });

  });


  $("#monto").on({
            "focus": function(event) {
                $(event.target).select();
            },
            "keyup": function(event) {
                $(event.target).val(function(index, value) { //formato montos
                    return value.replace(/\D/g, "")
                        .replace(/([0-9])([0-9]{2})$/, '$1.$2')
                        .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ",");
                });
            }
        });

 //validar select ejercicio y cliente , consulta los ejercicios disponibles de ese cliente
 $("#ejercicio, #cliente_id").on('change', function () {
        
         if($("#cliente_id").val()== '' || $("#ejercicio").val()== ''){
          $('#monto').attr('disabled', true);
          $('#monto').attr('placeholder','Primero completar las opciones');
          $('#monto').val('');
          $('#monto').addClass('bg-gray-100');
          $('#monto').removeClass('bg-white');
          $('#guardar').attr('disabled', true);
          $('#guardar').removeClass('bg-orange-800');
          $('#guardar').addClass('bg-gray-700');
          
          }else{
          $('#monto').removeAttr('disabled'); //habilitar input y boton
          $('#monto').removeAttr('placeholder');
          $('#monto').attr('placeholder','0.00')
          
          $('#monto').removeClass('bg-gray-100');
          $('#monto').addClass('bg-white');
          $('#guardar').removeAttr('disabled');
          $('#guardar').removeClass('bg-gray-700');
          $('#guardar').addClass('bg-orange-800');

          }
          ejercicio=$('#ejercicio').val();
          cliente=$('#cliente_id').val();
        
        if(cliente.length>0 && ejercicio.length>0){  
          var direccion = '{{ url("/obtClienteFuente")}}/'+ejercicio+','+cliente;
          consulta(direccion);
        }
        //ejercicio
      });

      function consulta(direccion){  //metodo para consulta fuente - cliente obtiene el registro exacto para relacionar y agregar
        $.ajax({
              url: direccion,
              dataType:'json',
              type:'get',
              success: function(data){
                //console.log(data);
                $.each(data,function(key, item) {
                  $('#fuenteCliente_id').val(item.id_fuente_financ_cliente);
                  //console.log('a '+ $('#fuenteCliente_id').val());
                });
                
              },
              cache: false
        });
      }  

      //validacion del formulario con el btn guardar
        $().ready(function() {
          $("#formulario").validate({
            onfocusout: false,
            onclick: false,
            rules: {
              monto: { required: true, minlength: 2 },
              gasto_indirecto: { required: true},
            
            },
            errorPlacement: function(error, element) {
              if(error != null){
              $('#error_'+element.attr('id')).fadeIn();
              }else{
                $('#error_'+element.attr('id')).fadeOut();
              }
            
            },
          }); 


      //validacion de input 
      $("input").keyup(function() {
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
    });

});

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