
@extends('layouts.plantilla')
@section('title','Fuentes de financiamiento')
@section('contenido')
        <link rel="stylesheet" href="{{ asset('css/datatable.css') }}">
        <link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/style_alert.css') }}">
        <!--Responsive Extension Datatables CSS-->
        <link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css">
        
<div class="flex flex-row">
  <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
  </svg>
<h1 class="text-xl font-bold ml-2">Lista de Fuentes de financiamiento</h1>
</div>
@php
  $aux = 1;
@endphp

<div class="flex flex-col mt-6">
  <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
  <button class="bg-orange-800 mb-4 text-white active:bg-orange-800 font-bold uppercase text-sm px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="button" onclick="toggleMod('modal', {{$fuenteClientes}})">
  Agregar
  </button>
  
      <!-- div de tabla -->
  </div>
</div>
<!-- fin tabla tailwind, inicio data table -->
<div class="mt-6 contenedor p-8 shadow-2xl bg-white rounded-lg">

<table id="example" class="table table-striped bg-white" style="width:100%;">
  <thead>
      <tr>
          <th>Municipio</th>
          <th>Monto proyectado</th>
          <th>Monto comprometido</th>
          <th>Ejercicio</th>
          <th>Fuente de financiamiento</th>
          <th class="flex justify-center">Acción</th>
          
      </tr>
  </thead>
  <tbody> 
  @foreach($fuenteClientes as $key => $index)
      <tr>
          <td>
            <div class="text-sm leading-5 font-medium text-gray-900">
              {{  $cliente->find($index->cliente_id)->nombre }}
            </div>
          
          </td>
         <td>
            <div class="text-sm leading-5 font-medium text-gray-900 myDIV">
              {{ $index->monto_proyectado}}
            </div>
            
          </td>
          <td>
            <div class="text-sm leading-5 font-medium text-gray-900 myDIV">
              {{$index->monto_comprometido}}
            </div>
            
          </td>
          <td>
            <div class="text-sm leading-5 font-medium text-gray-900">
                {{$index->ejercicio}}
            </div>
            
          </td>
          <td>
            <div class="text-sm leading-5 font-medium text-gray-900">
                {{$fuentes->find($index->fuente_financiamiento_id)->nombre_corto}}
            </div>
            
          </td>
          <td>
            <div class="flex justify-center">
            <form action="{{ route('fuenteCliente.destroy', $index->id_fuente_financ_cliente) }}" method="POST" class="form-eliminar" >
              <div>
              <a type="button"  href="{{ route('fuenteCliente.edit', $index->id_fuente_financ_cliente)}}" class="bg-white text-sm text-blue-500 font-normal text-ms p-2 rounded rounded-lg">Editar</a> 
              <button class="bg-transparent text-blue-500 active:bg-transparent font-normal  text-sm p-2  rounded outline-none focus:outline-none  ease-linear transition-all duration-150" type="button" onclick="toggleModal('modal-id', {{$index}}, {{$cliente}}, '{{ $fuentes->find($index->fuente_financiamiento_id)->nombre_corto }}', {{$key}})">
                Detalles
              </button>
              @csrf
              @method('DELETE')
              <button type="submit" class="bg-white text-red-500 p-2 rounded rounded-lg">Eliminar</button>
              </div>
              
              </form>
            </div>
          </td>
      </tr>
      @endforeach
  </tbody>
  <!--<tfoot>
      <tr>
        <th>Usuario</th>
        <th>Rol</th>
        <th></th>
      </tr>
  </tfoot>-->
</table>

</div>

<!-- inicio modal -->
<div class="hidden overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center" id="modal-id">
  <div class="relative w-auto my-6 mx-auto max-w-3xl">
    <!--content-->
    <div class="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none">
      <!--header-->
      <div class="flex items-start justify-between p-5 border-b border-solid border-blueGray-200 rounded-t">
        <h4 class="text-xl font-semibold">
          Fuente de financiamiento
        </h4>
        <button class="p-1 ml-auto bg-transparent border-0 text-red-500 float-right text-3xl leading-none font-semibold outline-none focus:outline-none" onclick="toggleModal_1('modal-id')">
          <span class="bg-transparent text-red-500 h-6 w-6 text-2xl block outline-none focus:outline-none">
            ×
          </span>
        </button>
      </div>
      <!--body-->
      
      <div class="relative p-6 flex-auto">
        
          <div class="grid grid-cols-8 gap-8">
            <div class="col-span-8 ">
              <label for="first_name" class="text-base font-medium text-gray-700">Municipio: </label>
              <label id="nombre_municipio" class="text-base font-bold text-gray-900"></label>
            </div>
            <div class="col-span-8">
              <label for="ver_monto_proyectado" class=" text-base font-medium text-gray-700">Monto proyectado: </label>
              <label id="ver_monto_proyectado" class="text-base font-bold text-gray-900 myDIV"></label>
            </div>
            <div class="col-span-8">
              <label for="ver_monto_comprometido" class=" text-base font-medium text-gray-700">Monto comprometido: </label>
              <label id="ver_monto_comprometido" class="text-base font-bold text-gray-900 myDIV"></label>
            </div>
           
            <div class="col-span-8">
                <label for="ver_ejercicio" class="text-base font-medium text-gray-700">Ejercicio: </label>
                <label id="ver_ejercicio" class="text-base font-bold text-gray-900"></label>
              </div>
            <div class="col-span-8">
                <label for="fuente_financiamiento" class="text-base font-medium text-gray-700">Fuente de financiamiento: </label>
                <label id="ver_fuente_financiamiento" class="text-base font-bold text-gray-900"></label>
              </div>
              <div class="col-span-8">
                <label for="prodim" class="text-base font-medium text-gray-700">Prodim: </label>
                <span id="ver_prodim" class=" "></span>
              </div>
              <div class="col-span-8">
                <label for="gastos_indirectos" class="text-base font-medium text-gray-700">Gastos indirectos: </label>
                <span id="ver_gastos_indirectos" class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full ">Pendiente</span>
              </div>
             
          </div>
        
      </div>
      <!--footer-->
    </div>
  </div>
</div>

<!-- inicio modal -->
<div class="hidden overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center" id="modal">
  <div class="relative w-auto my-6 mx-auto max-w-3xl">
    <!--content-->
    <div class="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none">
      <!--header-->
      <div class="flex items-start justify-between p-5 border-b border-solid border-blueGray-200 rounded-t">
        <h4 class="text-xl font-semibold">
          Agregar Nueva Fuente
        </h4>
        <button class="p-1 ml-auto bg-transparent border-0 text-black opacity-5 float-right text-3xl leading-none font-semibold outline-none focus:outline-none" onclick="toggleMod('modal')">
          <span class="bg-transparent text-black opacity-5 h-6 w-6 text-2xl block outline-none focus:outline-none">
            
          </span>
        </button>
      </div>
      <!--body-->
      <form action="{{ route('fuenteCliente.store') }}" method="POST" id="formulario" name="formulario">
        @csrf
        @method('POST')
      <div class="relative p-6 flex-auto">
          <div class="grid grid-cols-8 gap-4">
            <div class="col-span-4 ">
              <label  id="label_cliente_id" for="cliente_id" class="block text-sm font-medium text-gray-700">Cliente *</label>
              <select id="cliente_id" name="cliente_id" onchange="validarCliente()" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">                
                <option value=""> Elija una opción </option>
                @foreach($cliente as $index)
                <option value="{{ $index->id_cliente }}"> {{ $index->nombre }} </option>
                @endforeach
              </select>
              <label id="error_cliente_id" name="error_cliente_id" class="hidden text-base font-normal text-red-500" >Seleccione una opción</label>
            </div>
            <div class="col-span-4">
              <label id="label_ejercicio" for="label_ejercicio" class="block text-sm font-medium text-gray-700">Ejercicio *</label>
              <input type="number" name="ejercicio" id="ejercicio" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" placeholder="(2020)">
              <label id="error_ejercicio" name="error_ejercicio" class="hidden text-base font-normal text-red-500" >Porfavor ingresar un año de ejercicio</label>  
          </div>
            <div class="col-span-4">
              <label id="label_monto_proyectado" for="label_monto_proyectado" class="block text-sm font-medium text-gray-700">Monto proyectado *</label>
              <div class="relative ">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                  <span class="text-gray-500 sm:text-sm">
                    $
                  </span>
                </div>
                <input type="number" name="monto_proyectado" id="monto_proyectado" class="pl-7  mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="" placeholder="0.0">
              </div>
                <label id="error_monto_proyectado" name="error_monto_proyectado" class="hidden text-base font-normal text-red-500" >Porfavor ingresar una cantidad</label>
            </div>
            <div class="col-span-4">
              <label id="label_monto_comprometido" for="label_monto_comprometido" class="block text-sm font-medium text-gray-700">Monto comprometido *</label>
              <div class="relative ">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                  <span class="text-gray-500 sm:text-sm">
                    $
                  </span>
                </div>
                <input type="number" name="monto_comprometido" id="monto_comprometido" class="pl-7 mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="" placeholder="0.0" >
              </div>
              <label id="error_monto_comprometido" name="error_monto_comprometido" class="hidden text-base font-normal text-red-500" >Porfavor ingresar una cantidad</label>  
              <label id="error_monto_menor" name="error_monto_menor" class="hidden text-base font-normal text-red-500" >El monto comprometido no puede ser mayor que el proyectado</label>  
            </div>
            
            <div class="col-span-4">
              <label for="fuente_financiamiento_id" class="block text-sm font-medium text-gray-700">Fuente de financiamiento *</label>
              <select id="fuente_financiamiento_id" name="fuente_financiamiento_id" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">                
                <option value="0" selected> Elija una opción </option>
                @foreach($fuentes as $fuente)
                <option value="{{ $fuente->id_fuente_financiamiento }}"> {{ $fuente->nombre_corto }} </option>
                @endforeach
              </select>
          </div>

         <div class="col-span-4 p-2">
              <div class="grid grid-cols-2">
                <div class="grid-col">
                   <p>Prodim:</p>
                   <input type="radio" id="prodim" name="prodim" value="1">
                   <label for="prodim">Si</label><br>
                   <input type="radio" id="prodim" name="prodim" value="2">
                   <label for="prodim">No</label><br>
                </div>
                <div class="grid-col">
                  <p>Gastos Indirectos:</p>
                  <input type="radio" id="gastos_indirectos" name="gastos_indirectos" value="1">
                  <label for="gastos_indirectos">Si</label><br>
                  <input type="radio" id="gastos_indirectos" name="gastos_indirectos" value="2">
                  <label for="gastos_indirectos">No</label><br>
               </div>
              </div>
          </div> 

          
        </div>
        
      </div>
      <!--footer-->
      <div class=" p-4 border-t border-solid border-blueGray-200 rounded-b">
        
        <span class="block text-xs">Verifique los campos obligatorios marcados con un ( * ) </span>
        <div class="text-right">
        <button class="text-red-500 background-transparent font-bold uppercase px-6 py-2 text-sm outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="button" onclick="toggleMod('modal')">
          Cancelar
        </button>
        <button type="submit" id="guardar" class="bg-green-500 text-white active:bg-green-600 font-bold uppercase text-sm px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" >
          Guardar
        </button>
        </div>
      </div>
      </form>
    </div>
  </div>
</div>


<div class="hidden opacity-25 fixed inset-0 z-40 bg-black" id="modal-backdrop"></div>
<div class="hidden opacity-25 fixed inset-0 z-40 bg-black" id="modal-id-backdrop"></div>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>  
<script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/dataTables.responsive.min.js') }}"></script>

@if(session('eliminar')=='ok')
  <script>
    //ejecucion del modal de aviso eliminar
    Swal.fire(
      '¡Eliminado!',
      'El usuario ha sido eliminado.',
      'success'
    )
  </script>
@endif
<style>
  .currSign:before {
      content: '$';
  }
</style>
<script>
  //Formato de cantidades
    let x = document.querySelectorAll(".myDIV");
    for (let i = 0, len = x.length; i < len; i++) {
        let num = Number(x[i].innerHTML)
                  .toLocaleString('es-MX');
        x[i].innerHTML = num;
        x[i].classList.add("currSign"); 
    }
</script>
<script>
  //Mensaje de advertencia
$(".form-eliminar").submit(function(e){
    e.preventDefault();
    Swal.fire({
      customClass: {
      title: 'swal_title_modificado',
      cancelButton: 'swal_button_cancel_modificado'
      },
      title: '¿Seguro que desea eliminar este usuario?',
      text: "¡Aviso, esta acción es irreversible!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#10b981',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Borrar',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      if (result.isConfirmed) {
        this.submit();
      }
    })
});
 /* */
</script>


<script type="text/javascript">
function toggleMod(modal, fuente){
    document.getElementById(modal).classList.toggle("hidden");
    document.getElementById(modal + "-backdrop").classList.toggle("hidden");    
}

//validar selected del cliente
function validarCliente() {
  var valor = document.getElementById("cliente_id").value;
  if(valor != ''){
    $('#error_cliente_id').fadeOut();
    $("#label_cliente_id").removeClass('text-red-500');
    $("#label_cliente_id").addClass('text-gray-700');
  }else{
    $('#error_cliente_id').fadeIn();
    $("#label_cliente_id").addClass('text-red-500');
    $("#label_cliente_id").removeClass('text-gray-700');
  }
}

//validacion de campos del modal
$(document).ready(function() {
   $("#modal input").keyup(function() {
  //console.log($(this).attr('id'));

  if($(this).attr('id') == 'monto_proyectado' || $(this).attr('id') == 'monto_comprometido'){
      var proyectado = parseInt($('#monto_proyectado').val());
      var comprometido = parseInt($('#monto_comprometido').val());
      
    if(proyectado < comprometido){
      $('#error_monto_menor').fadeIn();
      $('#guardar').attr("disabled", true);
      $("#guardar").removeClass('bg-green-500');
      $("#guardar").addClass('bg-gray-700');

    }else{
      $('#error_monto_menor').fadeOut();
      $('#guardar').removeAttr("disabled");
      $("#guardar").removeClass('bg-gray-700');
      $("#guardar").addClass('bg-green-500');
      
    }

  } 

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

//validacion del formulario con el btn guardar
$().ready(function($) {
 

  $('#formulario').validate({
    onfocusout: false,
    onclick: false,
    rules: {
      cliente_id: { required: true },
      ejercicio: { required: true },
      monto_proyectado: { required: true },
      monto_comprometido: { required: true},
      fuente_financiamiento_id: { required: true },
      prodim: { required: true },
      gastos_indirectos: { required: true }
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


//Codigo de Modal detalles
$(".btn-AddDate").on("click",function() {
  alert("Modal Mostrada");
  document.getElementById('modal-id').classList.toggle("hidden");
  document.getElementById('modal-id' + "-backdrop").classList.toggle("hidden");
    
});
  function toggleModal(modalID, index, cliente, fuente, key){
      cliente.forEach(function(municipio) {
        if(index.cliente_id == municipio.id_cliente){
        //console.log( municipio.id_cliente + " " +  municipio.nombre);
        $('#nombre_municipio').html(municipio.nombre); 
        }
        });
        
    $('#ver_monto_proyectado').html(index.monto_proyectado); 
    $('#ver_monto_comprometido').html(index.monto_comprometido); 
    $('#ver_acta_integracion_consejo').html(index.acta_integracion_consejo); 
    $('#ver_acta_priorizacion').html(index.acta_priorizacion); 
    $('#ver_adendum_priorizacion').html(index.adendum_priorizacion);
    $('#ver_ejercicio').html(index.ejercicio);
    $('#ver_fuente_financiamiento').html(fuente);
    
    styleValue('#ver_prodim', index.prodim);
    styleValue('#ver_gastos_indirectos', index.gastos_indirectos);
    
    document.getElementById(modalID).classList.toggle("hidden");
    document.getElementById(modalID + "-backdrop").classList.toggle("hidden");
  }
  function styleValue(id,valor){ //funcion para determinar status de prodim y gastos indirectos
    if(valor == 1){
      $(id).html('Terminado');
      $(id).removeClass();
      $(id).addClass('px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800');
      console.log(valor);
    }else if(valor == 2){
      $(id).html('Pendiente');
      $(id).removeClass();
      $(id).addClass('px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800');
      
    }else if(valor == 3){
      $(id).html('No Aplica');
      $(id).removeClass();
      $(id).addClass('px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800');
     
    }
  }

  function toggleModal_1(modalID){
    document.getElementById(modalID).classList.toggle("hidden");
    document.getElementById(modalID + "-backdrop").classList.toggle("hidden");
  }
</script>
<style>
  
</style>

<script type="text/javascript" src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.22/b-1.6.4/b-flash-1.6.4/b-html5-1.6.4/b-print-1.6.4/datatables.min.js"></script>



<script>
  //ejecucion del datatable
$(document).ready(function() {
    $('#example').DataTable({
        "autoWidth" : true,
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
      }
    )
    .columns.adjust();
});
</script>

@endsection