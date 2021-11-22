@extends('layouts.plantilla')
@section('title','Comprometido Desglose')
@section('contenido')
<link rel="stylesheet" href="{{ asset('css/datatable.css') }}">
<link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/style_alert.css') }}">

<div class="flex flex-row">
    <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
    </svg>
  <h1 class="text-xl font-bold ml-2">Comprometido desglose</h1>
</div>

<div class="flex flex-col mt-6">
  <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
    <button class="bg-orange-800 mb-4 text-white active:bg-orange-800 font-bold uppercase text-sm px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="button" onclick="toggleModal('modal-add')">
      Agregar
    </button>
  </div>
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

<!-- fin tabla tailwind, inicio data table -->
<div class="contenedor p-8 shadow-2xl bg-white rounded-lg">
  <table id="example" class="table table-striped bg-white" style="width:100%;">
    <thead>
        <tr>
            <th>Cliente</th>
            <th>Ejercicio</th>
            <th>Concepto</th>
            <th>Monto</th>          
            
            <th class="flex justify-center">Acción</th>
        </tr>
    </thead>
    <tbody> 
      @foreach($comprometidoDesglose as $index)
        <tr>
            
            <td>
              <div class="flex items-center">
                <div>
                    <div class="text-sm leading-5 font-medium text-gray-900">
                      {{$prodimComprometido->find($index->comprometido_id)->nombre}}
                    </div>
                </div>
            </div>
            </td>
            <td>
              <div class="text-sm leading-5 font-medium text-gray-900 flex justify-center">
                  {{$prodimComprometido->find($index->comprometido_id)->ejercicio}}
              </div>
            </td>
            <td>
              <div class="text-sm leading-5 font-medium text-gray-900 flex justify-center">
                  {{$index->concepto}}
              </div>
            </td>
            <td>
              <div class="text-sm leading-5 font-medium text-gray-900 myDIV">
                  {{$index->monto}}
              </div>
            </td>
            
  
            <td>
              <div class="flex justify-center">
              <form action="{{route('comprometidoDesglose.destroy', $index->id_desglose)}}" method="POST" class="form-eliminar" >
                <div>
                <a type="button"  href="{{route('comprometidoDesglose.edit', $index->id_desglose)}}" class="bg-white text-blue-500 p-2 rounded rounded-lg">Editar</a>
                {{-- <button class="bg-transparent text-blue-500 active:bg-transparent font-normal  text-sm p-2  rounded outline-none focus:outline-none  ease-linear transition-all duration-150"  type="button" onclick="toggleModal1('modal-contratista')">
                  Detalles
                </button> --}}
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
  </table>
</div>

<!-- inicio modal -->
<div class="hidden overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center" id="modal-add">
  <div class="relative w-auto my-6 mx-auto max-w-3xl">
    <!--content-->
    <div class="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none">
      <!--header-->
      <div class="flex items-start justify-between p-5 border-b border-solid border-blueGray-200 rounded-t">
        <h4 class="text-xl font-semibold">
          Agregar Nuevo Comprometido Desglose
        </h4>
        <button class="p-1 ml-auto bg-transparent border-0 text-black opacity-5 float-right text-3xl leading-none font-semibold outline-none focus:outline-none" onclick="toggleModal('modal-add')">
          <span class="bg-transparent text-black opacity-5 h-6 w-6 text-2xl block outline-none focus:outline-none">
            
          </span>
        </button>
      </div>
      <!--body-->
      <form action="{{ route('comprometidoDesglose.store') }}" method="POST" onsubmit="return validar()" id="formulario" name="formulario">
        @csrf
        @method('POST')
      <div class="relative p-6 flex-auto">
              <div class="relative p-6 flex-auto" id="anexos">
                  <div class="grid grid-cols-6 gap-4 mb-2">
                      <div class="col-span-3 ">
                          <label  id="label_cliente_id" for="cliente_id" class="block text-sm font-medium text-gray-700">Clientes con prodim *</label>
                          <select id="cliente_id" name="cliente_id" onchange="" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">                
                              <option value=""> Elija una opción </option>
                              @foreach ($prodimComprometido->unique('cliente_id') as $dato)
                                  <option value="{{ $dato->cliente_id }}"> {{ $dato->nombre }} </option>
                              @endforeach
                          </select>
                          <label id="error_cliente_id" name="error_cliente_id" class="hidden text-base font-normal text-red-500" >Seleccione una opción</label>
                      </div>

                      <div class="col-span-3 ">
                          <label  id="label_ejercicio" for="ejercicio" class="block text-sm font-medium text-gray-700">Ejercicio *</label>
                          <select id="ejercicio" name="ejercicio" onchange="" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">                
                            <option value=""> Elija un cliente </option>
                            {{-- @foreach ($comprometido->where('cliente_id',2) as $dato)
                                  <option value="{{ $dato->cliente_id }}"> {{ $dato->ejercicio }} </option>
                              @endforeach --}}
                          </select>
                          <label id="error_ejercicio" name="error_ejercicio" class="hidden text-base font-normal text-red-500" >Seleccione una opción</label>
                          <input id="comprometido_id" name="comprometido_id" type="text" hidden>
                      </div>

                    <div class="col-span-3 ">
                      <label id="label_concepto" for="concepto" class="block text-sm font-medium text-gray-700">Concepto *</label>
                      <input type="text" name="concepto" id="concepto" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                      <label id="error_concepto" class="hidden block text-md text-red-500">Se require de una fecha</label>
                    </div>

                    <div class="col-span-3 ">
                      <label id="label_monto" for="monto" class="block text-sm font-medium text-gray-700">Monto *</label>
                      <input type="text" name="monto" id="monto" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                      <label id="error_monto" class="hidden block text-md text-red-500">Se require de un monto</label>
                    </div>
                </div>

              </div>
            
      </div>
      <!--footer-->
      <div class=" p-4 border-t border-solid border-blueGray-200 rounded-b">
        
        <span class="block text-xs">Verifique los campos obligatorios marcados con un ( * )</span>
        <div class="text-right">
        <button class="text-red-500 background-transparent font-bold uppercase px-6 py-2 text-sm outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="button" onclick="toggleModal('modal-add')">
          Cancelar
        </button>
        <button type="submit" id="guardar" name="guardar" class="bg-green-500 text-white active:bg-green-600 font-bold uppercase text-sm px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" >
          Guardar
        </button>
        </div>
      </div>
      </form>
    </div>
  </div>
</div>

<div class="hidden opacity-25 fixed inset-0 z-40 bg-black" id="modal-add-backdrop"></div>


<!-- librerias -->
<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.22/b-1.6.4/b-flash-1.6.4/b-html5-1.6.4/b-print-1.6.4/datatables.min.js"></script>
<!-- librerias -->

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
function validar(){
  band = true;
      cliente= document.forms["formulario"]["cliente_id"].value;
      if(cliente == ""){
                 $('#error_cliente_id').removeClass('hidden');  
                 band= false;
      }else{
                $('#error_cliente_id').addClass('hidden'); 
      }
      ejercicio= document.forms["formulario"]["ejercicio"].value;
      if(ejercicio == ""){
                 $('#error_ejercicio').removeClass('hidden');  
                 band= false;
      }else{
                $('#error_ejercicio').addClass('hidden'); 
      }
      concepto= document.forms["formulario"]["concepto"].value;
      if(concepto == ""){
                 $('#error_concepto').removeClass('hidden');  
                 band= false;
      }else{
                $('#error_concepto').addClass('hidden'); 
      }
      monto= document.forms["formulario"]["monto"].value;
      if(monto == ""){
                 $('#error_monto').removeClass('hidden');  
                 band= false;
      }else{
                $('#error_monto').addClass('hidden'); 
      }
  return band;
}

function toggleModal(modal){
            document.getElementById(modal).classList.toggle("hidden");
            document.getElementById(modal + "-backdrop").classList.toggle("hidden");    
    }

  $(document).ready(function() { //llamada al datatable
    $("#monto").on({
            "focus": function(event) {
                $(event.target).select();
            },
            "keyup": function(event) {
                $(event.target).val(function(index, value) { //formato montos
                  //
                    return value.replace(/\D/g, "")
                        .replace(/([0-9])([0-9]{2})$/, '$1.$2')
                        .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ",");
                }); 
                
            }
        });

    $("#cliente_id").on('change', function () { //consulta ejercicios por cliente
                  cliente=$(this).val();
                  $("#ejercicio").empty(); //valida si no se ha seleccionado una opc
                  $("#ejercicio").append('<option value="">Elija un cliente</option>');
                  if(cliente != ""){
                    var link = '{{ url("/ejerciciosProdimComprometido")}}/'+cliente; //consulta ajax
                    $.ajax({
                        url: link,
                        dataType:'json',
                        type:'get',
                        success: function(data){
                            //console.log(data)
                            $.each(data,function(key, item) {
                                $("#ejercicio").append('<option value='+item.id_comprometido+'>'+item.ejercicio+'</option>');
                            });
                        },
                        cache: false
                    });
                  }
        });

        $('#ejercicio').on('change',function(){
          $('#comprometido_id').val($(this).val());
          
      });

    $('#example').DataTable({
        "autoWidth" : true,
        "responsive" : true,
        language: {
          url: 'https://cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json'
        }
    }).columns.adjust();
});
</script>
@endsection