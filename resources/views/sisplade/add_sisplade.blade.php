@extends('layouts.plantilla')
@section('title','Sisplade')
@section('contenido')
<link rel="stylesheet" href="{{ asset('css/datatable.css') }}">
<link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/style_alert.css') }}">

<meta name="_token" content="{{ csrf_token() }}">

<!--Responsive Extension Datatables CSS-->
<link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css">
<!--CDNs select2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />


<div class="flex flex-row">
  <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
  </svg>
<h1 class="text-xl font-bold ml-2">Agregar Sisplade</h1>
</div>

<div class="text-white px-6 py-4 border-0 rounded relative mt-2 mb-4 bg-blue-900 ">
  <span class="text-xl inline-block mr-5 align-middle">
    <i class="fas fa-bell"></i>
  </span>
  <span class="inline-block align-middle mr-8">
    <b class="capitalize">Recuerde:</b> Asignar un nuevo fondo III a un cliente, si la lista aparece vacia.
    <a href="{{route('fuenteCliente.index')}}" class="ml-2 rounded bg-orange-800 shadow-md text-white text-sm font-semibold p-1" target="_blank">Agregar nuevo registro</a>
  </span>
  <button class="absolute bg-transparent text-2xl font-semibold leading-none right-0 top-0 mt-4 mr-6 outline-none focus:outline-none" onclick="closeAlert(event)">
    <span>×</span>
  </button>
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

<div class="mt-6 contenedor p-8 shadow-2xl bg-white rounded-lg">
    <div class="relative p-6 flex-auto">
      
        <div class="alert flex flex-row items-center justify-center bg-gray-100 p-2 mb-4 shadow">
          <div class="alert-content ml-4">
            <p class="font-bold sm:text-sm">Fuentes de financimiento de clientes</p>
          </div>
        </div>
      

    <div class="grid grid-cols-8 gap-4">

          <div class="col-span-4 ">
            <label  id="label_cliente_id" for="cliente_id" class="block text-sm font-medium text-gray-700">Cliente *</label>
            <select id="cliente_id" name="cliente_id"  class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">                
                <option value=""> Elija una opción </option>
                @foreach ($clientes as $item)
                <option value="{{$item->id_municipio}}"> {{$item->nombre}} </option>
                @endforeach
            </select>
            <label id="error_cliente_id" name="error_cliente_id" class="hidden text-base font-normal text-red-500" >Seleccione una opción</label>
          </div>

          <div class="col-span-4">
            <label id="label_ejercicio" for="label_ejercicio" class="block text-sm font-medium text-gray-700">Ejercicio *</label>
              <select id="ejercicio" name="ejercicio" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">                
                <option value=""> Elija un cliente </option>
              </select>
            <label id="error_ejercicio" name="error_ejercicio" class="hidden text-base font-normal text-red-500" >Por favor ingresar un año de ejercicio.</label>  <br>
            <label id="error_existe" name="error_existe" class="hidden text-base font-normal text-red-500" >Ya existe un registro en este ejercicio</label>
          </div>
        
          
      </div>
      
      <div class="alert flex flex-row items-center justify-center bg-gray-100 p-2 mt-4 mb-4 shadow hidden" id="titulo_sisplade">
        <div class="alert-content ml-4">
          <p class="font-bold sm:text-sm">Nuevo Sisplade</p>
        </div>
      </div>

  
      <div class="mt-5 md:mt-0 md:col-span-2 hidden" id="form_sisplade">
        <form id="formulario" name="formulario">
          <div class="shadow overflow-hidden sm:rounded-md">
            <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
              <fieldset class="grid grid-cols-8 gap-4 p-5">

                

                <div class="col-span-4">
                  <legend class="text-base font-medium text-gray-900 ">Estado</legend>
                      <div class="mt-4 space-y-4 ">
                        <div class="flex items-start mb-8 mt-6">
                          <div class="flex items-center h-5">
                            
                            <input id="capturado" name="capturado" type="checkbox" class="focus:ring-green-500 h-6 w-6 text-green-600 border-gray-300 rounded">
                          </div>
                          <div class="ml-3 text-sm">
                            <label for="capturado" class="font-medium text-gray-700">Capturado</label>
                          </div>
                        </div>

                        <div class="flex items-start mt-8">
                          <div class="flex items-center h-5">
                            <input id="validado" name="validado" type="checkbox" class="focus:ring-green-500 h-6 w-6 text-green-600 border-gray-300 rounded">
                            <input id="fuenteCliente_id" name="fuenteCliente_id" type="text" hidden>
                           </div>
                          <div class="ml-3 text-sm">
                            <label for="validado" class="font-medium text-gray-700">Validado</label>
                            
                          </div>
                        </div>
                      </div>
                </div>

                <div class="col-span-4">
                  <legend class="text-base font-medium text-gray-900 ">Registrado</legend>
                      <div class="mt-4 space-y-4">
                        <div class="flex items-center ">
                          
                          <div class="mr-3 text-sm">
                            <input id="fecha_capturado" name="fecha_capturado" type="date" class="focus:ring-gray-500 bg-gray-100 text-gray-600 border-gray-300 rounded w-full" disabled>
                            
                          </div>
                          <div class="flex items-center h-5">
                            <label for="fecha_capturado" class="font-medium text-gray-700">Fecha de captura</label>
                            
                          </div>
                        </div>

                        <div class="flex items-center ">
                          
                          <div class="mr-3 text-sm">
                            
                            <input id="fecha_validado" name="fecha_validado" type="date" class="focus:ring-gray-500 bg-gray-100 text-gray-600 border-gray-300 rounded w-full" disabled>
                          </div>
                          <div class="flex items-center h-5">
                            <label for="fecha_validado" class=" block font-medium text-gray-700">Fecha de validación</label>
                            
                          </div>
                          
                        </div>
                      </div>
                </div>

              </fieldset>
              
            </div>
            <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
              <a type="button" href="{{redirect()->getUrlGenerator()->previous()}}" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-gray-400 hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Regresar
              </a>
              <button type="buttom" id="guardar" name="guardar" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-orange-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-800">
                Guardar
              </button>
            </div>
          </div>
        </form>
      </div>

    </div>
    
</div>

<!-- agregar sisplade -->
<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.25/sl-1.3.3/datatables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{ asset('js/dataTables.responsive.min.js') }}"></script>

<script>
  function closeAlert(event){ //div de alerta - aviso azul
    let element = event.target;
    while(element.nodeName !== "BUTTON"){
      element = element.parentNode;
    }
    element.parentNode.parentNode.removeChild(element.parentNode);
  }
</script>

<script>

  //metodo ajax obtener el registro fuenteCliente exacto
  $(document).ready(function() {
    var fuente,ejercicio,cliente;
    
    //guardar registro sisplade
    $("#guardar").on('click', function () {
      var validado,capturado,fecha_capturado,fecha_validado;
      var fuentes_clientes_id= $("#fuenteCliente_id").val();
      if($('#capturado').prop("checked"))
      {
        capturado=1;
        fecha_capturado= $('#fecha_capturado').val();
      }
      else
      {
        capturado=0;
        fecha_capturado='';
      }
      
      if($('#validado').prop("checked"))
      {
        validado= 1;
        fecha_validado= $('#fecha_validado').val();
      }
      else
      {
        validado=0;
        fecha_validado ='';
      }
      
      
      var direccion= '{{ route("sisplade.store") }}';
      var token = '{{ csrf_token() }}';
      var data= {
        fuentes_clientes_id:fuentes_clientes_id,
        capturado:capturado,
        fecha_capturado:fecha_capturado, 
        validado:validado,
        fecha_validado:fecha_validado,
        _token:token,
        };
        
        $.ajax({
          type: 'POST',
          url: direccion,
          data: data,
          success: function(data){
              window.location = data.url;
          },
          cache: false
        });
    });

    //evento de los checkbox
    $('#capturado').on('click',function(){
            if($(this).prop("checked")) {
                
                $('#fecha_capturado').removeAttr('disabled');
                $('#fecha_capturado').removeClass('bg-gray-100');
            }else{
                $('#fecha_capturado').attr('disabled', true);
                $('#fecha_capturado').addClass('bg-gray-100');
            }
        });

        $('#validado').on('click',function(){
            if($(this).prop("checked")) {
                
                $('#fecha_validado').removeAttr('disabled');
                $('#fecha_validado').removeClass('bg-gray-100');
            }else{
                $('#fecha_validado').attr('disabled', true);
                $('#fecha_validado').addClass('bg-gray-100');
            }
        });

    //select ejercicio disponible por cliente
    $("#cliente_id").on('change', function () {

         cliente=$(this).val();
         $("#ejercicio").empty(); //valida si no se ha seleccionado una opc
         $("#fuente").empty();
         $("#ejercicio").append('<option value="">Elija un cliente</option>');
         $("#fuente").append('<option value="">Elija un cliente y ejercicio</option>');
         
          
         var link = '{{ url("/selectEjercicio")}}/'+cliente;
         $.ajax({
          url: link,
          dataType:'json',
          type:'get',
          success: function(data){
            console.log(data);
            // $.each(data,function(key, item) {
            //   $("#ejercicio").append('<option value='+item.ejercicio+'>'+item.ejercicio+'</option>');
            // });
          },
          cache: false
        });

    });
  
      //validar select ejercicio y cliente , consulta los ejercicios disponibles de ese cliente
      $("#ejercicio, #cliente_id").on('change', function () {
        
        if($("#cliente_id").val()== '' || $("#ejercicio").val()== ''){
          $('#titulo_sisplade').addClass('hidden');
          $('#form_sisplade').addClass('hidden'); //esconde formulario sisplade
        }else{
          $('#titulo_sisplade').removeClass('hidden'); //mostrar el formulario de sisplade
          $('#form_sisplade').removeClass('hidden');
        }
          ejercicio=$('#ejercicio').val();
          cliente=$('#cliente_id').val();
        
        if(cliente.length>0 && ejercicio.length>0){  
          var direccion = '{{ url("/obtClienteFuente")}}/'+ejercicio+','+cliente;
          consulta(direccion);
        }
        //ejercicio
      }); 

      function consulta(direccion){  //metodo para consulta fuente - cliente obtiene el registro exacto para relacionar y agregar segun las opc de los select
        $.ajax({
              url: direccion,
              dataType:'json',
              type:'get',
              success: function(data){
                //console.log(data);
                $.each(data,function(key, item) {
                  $('#fuenteCliente_id').val(item.id_fuente_financ_cliente);
                  //console.log('a '+ $('#fuenteCliente_id').val());
                  existe($('#fuenteCliente_id').val());
                });
                
              },
              cache: false
        });
       
      }

      function existe($id){ //valida si existe un registro con este mismo ejercicio
        $.ajax({
              url: '{{ url("/existeEnSisplade")}}/'+$id,
              dataType:'json',
              type:'get',
              success: function(data){
                //console.log(data);
                if(data== 1){
                  $('#error_existe').removeClass('hidden');
                  $('#guardar').attr("disabled", true);
                  $("#guardar").removeClass('bg-orange-800');
                  $("#guardar").addClass('bg-gray-700');
                }else{
                  $('#error_existe').addClass('hidden');
                  $('#guardar').removeAttr("disabled");
                  $("#guardar").removeClass('bg-gray-700');
                  $("#guardar").addClass('bg-orange-800');
                }
              },
              cache: false
            });
      }
  });
 
  //ejecucion del datatable
  $(document).ready(function() {
          var table = $('#example').DataTable({
            "autoWidth": true,
              "responsive" : true,
              columnDefs: [
            { responsivePriority: 1, targets: 4 },
            { responsivePriority: 1, targets: 1 },
            { responsivePriority: 10001, targets: 4 },
            { responsivePriority: 2, targets: -2 }
        ],
              language: {
                url: 'https://cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json'
              }
            }).columns.adjust().draw();
           
          

});
     
      
</script>

@endsection
