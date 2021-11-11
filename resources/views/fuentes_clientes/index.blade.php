
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
<h1 class="text-xl font-bold ml-2">Lista de Fuentes de financiamiento - Clientes</h1>
</div>


<div class="flex flex-col mt-6">
  <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
  <button class="bg-orange-800 mb-4 text-white active:bg-orange-800 font-bold uppercase text-sm px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="button" onclick="toggleMod('modal')">
    Agregar
  </button>
  
      <!-- div de tabla -->
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
<!-- inicio data table -->
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
              {{ $nombre_cliente= $listaClientes->find($index->cliente_id)->nombre }}
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
            <div class="grid text-sm leading-5 font-medium text-gray-900 justify-items-center">
                {{$fuentes->find($index->fuente_financiamiento_id)->nombre_corto}}
            </div>
            
          </td>
          <td>
            <div class="flex justify-center">
              
            <form action="{{ route('fuenteCliente.destroy', $index->id_fuente_financ_cliente) }}" method="POST" class="form-eliminar" >
              <div>
              <a type="button"  href="{{ route('fuenteCliente.edit', $index->id_fuente_financ_cliente)}}" class="bg-white text-sm p-1 text-blue-500 font-normal text-ms rounded rounded-lg">Editar</a> 
              <!--<button class="bg-transparent text-blue-500 active:bg-transparent font-normal  text-sm p-2  rounded outline-none focus:outline-none  ease-linear transition-all duration-150" type="button" onclick="toggleModal('modal-id', {{$index}}, {{$cliente}}, '{{ $fuentes->find($index->fuente_financiamiento_id)->nombre_corto }}', {{$key}})">
                Detalles
              </button> -->
              @if($index->fuente_financiamiento_id == 2)
              
              <button class="bg-transparent text-blue-500 active:bg-transparent font-normal  text-sm p-2  rounded outline-none focus:outline-none  ease-linear transition-all duration-150" type="button" onclick="toggleModal('modal-id', {{$index}}, {{$cliente}}, '{{ $fuentes->find($index->fuente_financiamiento_id)->nombre_corto }}', {{$key}})">
                Detalles
              </button>
              @endif
              @csrf
              @method('DELETE')
                <button type="submit" class="bg-white p-1 text-sm text-red-500 rounded rounded-lg">Eliminar</button>
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
<div class="hidden overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center" id="modal-id">
  <div class="relative w-auto my-6 mx-auto max-w-3xl">
    <!--content-->
    <div class="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none">
      <!--header-->
      <div class="flex items-start justify-between p-5 border-b border-solid border-blueGray-200 rounded-t">
        <h4 class="text-xl font-semibold">
          Fuente de financiamiento - Clientes
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
                <span id="ver_gastos_indirectos" class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full "></span>
              </div>
              <div class="col-span-8">
                <label for="ver_acta_integracion_consejo" class="text-base font-medium text-gray-700">Acta de integración: </label>
                <span id="ver_acta_integracion_consejo" class=" "></span>
              </div>
              <div class="col-span-8">
                <label for="ver_acta_priorizacion" class="text-base font-medium text-gray-700">Acta de priorización: </label>
                <span id="ver_acta_priorizacion" class=" "></span>
              </div>
              <div class="col-span-8">
                <label for="ver_adendum_priorizacion" class="text-base font-medium text-gray-700">Adendum priorización: </label>
                <span id="ver_adendum_priorizacion" class=" "></span>
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
      <form action="{{ route('fuenteCliente.store') }}" onsubmit="return validar()" method="POST" id="formulario" name="formulario">
        @csrf
        @method('POST')
      <div class="relative p-6 flex-auto">
        
        <div class="text-white px-6 py-4 border-0 rounded relative mb-4 bg-blue-900">
            <span class="text-xl inline-block mr-5 align-middle">
              <i class="fas fa-bell"></i>
            </span>
            <span class="inline-block align-middle mr-8">
              <b class="capitalize">Nota:</b> <br> Debe agregar un cliente por periodo antes 
              <a href="{{route('clientes.index')}}" class="ml-2 rounded bg-orange-800 shadow-md text-white text-sm font-semibold p-1" target="_blank">Agregar nuevo cliente</a>
            </span>
            <button class="absolute bg-transparent text-2xl font-semibold leading-none right-0 top-0 mt-4 mr-6 outline-none focus:outline-none" onclick="closeAlert(event)">
              <span>×</span>
            </button>
        </div>

          <div class="grid grid-cols-8 gap-4">
            <div class="col-span-4 ">
              <label  id="label_municipio" for="municipio" class="block text-sm font-medium text-gray-700">Cliente *</label>
              <select id="municipio" name="municipio" onchange="validarCliente()" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">                
                <option value=""> Elija una opción </option>
                @foreach($cliente as $index)
                <option value="{{ $index->id_municipio }}"> {{ $index->nombre }} </option>
                @endforeach
              </select>
              <label id="error_municipio" name="error_municipio" class="hidden text-base font-normal text-red-500" >Seleccione una opción</label>
            </div>
            <div class="col-span-4 ">
              <label  id="label_periodo" for="periodo" class="block text-sm font-medium text-gray-700">Periodo *</label>
              <select id="periodo" name="periodo"  class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">                
                <option value=""> Elija un cliente primero</option>
                
              </select>
              <label id="error_periodo" name="error_periodo" class="hidden text-base font-normal text-red-500" >Seleccione una opción</label>
            </div>

            <div class="col-span-4 mb-4">
              <label for="fuente_financiamiento_id" id="label_fuente_financiamiento_id" class="block text-sm font-medium text-gray-700">Fuente de financiamiento *</label>
              <select id="fuente_financiamiento_id" name="fuente_financiamiento_id" onchange="validarFuente()" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">                
                <option value="" selected> Elija una opción </option>
                @foreach($fuentes as $fuente)
                <option value="{{ $fuente->id_fuente_financiamiento }}"> {{ $fuente->nombre_corto }} </option>
                @endforeach
              </select>
              <input type="text" id="cliente_id" name="cliente_id" class="hidden">
              <label id="error_fuente_financiamiento_id" name="error_fuente_financiamiento_id" class="hidden text-base font-normal text-red-500" >Por favor elija una opción</label>  
            </div> 

            <div class="col-span-4">
              <label id="label_ejercicio" for="label_ejercicio" class="block text-sm font-medium text-gray-700">Ejercicio *</label>
              <input type="number" name="ejercicio" id="ejercicio" minlength="4" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" placeholder="(2020)">
              <label id="error_ejercicio" name="error_ejercicio" class="hidden text-base font-normal text-red-500" >Ingresa un año de ejercicio dentro del periodo</label>  
            </div>
            <div class="col-span-4">
              <label id="label_monto_proyectado" for="label_monto_proyectado" class="block text-sm font-medium text-gray-700">Monto proyectado *</label>
              <div class="relative ">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                  <span class="text-gray-500 sm:text-sm">
                    $
                  </span>
                </div>
                <input type="text" name="monto_proyectado" id="monto_proyectado" class="pl-7  mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="" placeholder="0.0">
              </div>
                <label id="error_monto_proyectado" name="error_monto_proyectado" class="hidden text-base font-normal text-red-500" >Por favor ingresar una cantidad.</label><br>
                <label id="error_monto_menor" name="error_monto_menor" class="hidden text-base font-normal text-red-500" >El monto comprometido no puede ser mayor que el proyectado.</label>
            </div>
            <div class="col-span-4">
              <label id="label_monto_comprometido" for="label_monto_comprometido" class="block text-sm font-medium text-gray-700">Monto comprometido *</label>
              <div class="relative ">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                  <span class="text-gray-500 sm:text-sm">
                    $
                  </span>
                </div>
                <input type="text" name="monto_comprometido" id="monto_comprometido" class="pl-7 mt-1 focus:ring-indigo-500 focus:border-indigo-500 block bg-gray-100 w-full shadow-sm sm:text-sm border-gray-300 rounded-md" placeholder="0.0" readonly>
              </div>
              <label id="error_monto_comprometido" name="error_monto_comprometido" class="hidden text-base font-normal text-red-500" >Por favor ingresar una cantidad</label>  
                
            </div>
            
         </div>
         <div class="hidden relative p-6 flex-auto" id="anexos">
            <div class=" alert flex flex-row items-center justify-center bg-gray-100 p-2 mt-4 mb-4 shadow " id="titulo_anexo">
              <div class="alert-content ml-4">
              <p class="font-bold sm:text-sm">Anexos</p>
              </div>
            </div>
          
            <div class="flex flex-col-2 justify-center mb-2" >
              <div class="flex flex-row  p-2">
                  <label id="label_ejercicio" for="label_ejercicio" class="ml-6 text-sm font-medium text-gray-700 ">Prodim </label>
                  <input type="checkbox" name="prodim" id="prodim" class="ml-2 shadow-sm sm:text-sm border-gray-300 rounded h-6 w-6">
              </div>
              <div class="flex flex-row  p-2">
                <label id="label_gastos_indirectos" for="label_gastos_indirectos" class="ml-6 text-sm font-medium text-gray-700 ">Gastos indirectos</label>
                <input type="checkbox" name="gastos_indirectos" id="gastos_indirectos" class="ml-2 shadow-sm sm:text-sm border-gray-300 rounded h-6 w-6">
              </div>
            </div>
         
            <div class="grid grid-cols-6 gap-4">
              <div class="col-span-2">
                <label id="label_acta_integracion" for="acta_integracion" class="block text-sm font-medium text-gray-700">Acta integración *</label>
                <input type="date" name="acta_integracion" id="acta_integracion" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" >
                <label id="error_acta_integracion" class="hidden block text-md text-red-500">Se require de una fecha</label>
              </div>
            
              <div class="col-span-2">
                <label id="label_acta_priorizacion" for="acta_priorizacion" class="block text-sm font-medium text-gray-700">Acta priorización *</label>
                <input type="date" name="acta_priorizacion" id="acta_priorizacion" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" >
                <label id="error_acta_priorizacion" class="hidden block text-md text-red-500">Se require de una fecha</label>
              </div>

              <div class="col-span-2">
                <label id="label_adendum" for="adendum" class="block text-sm font-medium text-gray-700">Adendum priorización </label>
                <input type="date" name="adendum" id="adendum" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" >
                
              </div>

            </div>
         </div>

        <div id="error_existe" class="hidden alert flex flex-row items-center bg-red-200 p-2 rounded-lg border-b-2 border-red-300 mb-4 shadow">
           <div class="alert-icon flex items-center bg-red-100 border-2 border-red-500 justify-center h-10 w-10 flex-shrink-0 rounded-full">
            <span class="text-red-500">
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
            <div class="alert-title font-semibold text-lg text-red-800">
              Aviso
            </div>
            <div class="alert-description text-sm text-red-600">
              <strong>YA</strong> existe un registro con el mismo cliente, fuente y ejercicio.
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
        <button type="submit" id="guardar" class="bg-gray-400 text-white font-bold uppercase text-sm px-6 py-3 rounded shadow outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" disabled>
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
<!--Alerta de error-->
@if(session('eliminar')=='error')
  <script>
    Swal.fire({
      icon: 'error',
      title: '¡Oops... !',
      html: 'Este registro tiene relación con otro.<br> No es posible eliminarlo.'
    });
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
  function closeAlert(event){ //div de alerta - aviso dentro del modal agregar
    let element = event.target;
    while(element.nodeName !== "BUTTON"){
      element = element.parentNode;
    }
    element.parentNode.parentNode.removeChild(element.parentNode);
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
//================================================
//validar selected del cliente
function validarFuente() {
  var valor = document.getElementById("fuente_financiamiento_id").value;
  if(valor != ''){
    $('#error_fuente_financiamiento_id').fadeOut();
    $("#label_fuente_financiamiento_id").removeClass('text-red-500');
    $("#label_fuente_financiamiento_id").addClass('text-gray-700');
  }else{
    $('#error_fuente_financiamiento_id').fadeIn();
    $("#label_fuente_financiamiento_id").addClass('text-red-500');
    $("#label_fuente_financiamiento_id").removeClass('text-gray-700');
  }

  if($('#fuente_financiamiento_id').val() == '2'){
    $('#titulo_anexo').removeClass('hidden');
    $('#anexos').removeClass('hidden');
    $('#acta_integracion').attr('required',true);
    $('#acta_priorizacion').attr('required',true);
  }else{
    $('#titulo_anexo').addClass('hidden');
    $('#anexos').addClass('hidden');
    $('#acta_integracion').removeAttr('required');
    $('#acta_priorizacion').removeAttr('required');
  }
}
//================================================
//validar selected del fuente
function validarCliente() {
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
//================================================
//validacion de campos del modal
$(document).ready(function() {
  //$('#ejercicio').attr('maxlength','4');
//================================================
var myArray;
$('#municipio').on('keyup change', function(){ //ejercicio select
      municipio = $('#municipio').val();
      if(municipio.length!=0){
      $("#periodo").empty(); //valida si no se ha seleccionado una opc
      //$("#ejercicio").append('<option value="">Elija un ejercicio</option>');
        var link = '{{ url("/clienteEjercicio")}}/'+municipio;
        $.ajax({
              url: link,
              dataType:'json',
              type:'get',
              success: function(data){
                //console.log(data)
                myArray= data;
                $.each(data,function(key, item) { //llenado del select ejercicio
                  if(key == 0){
                  $("#periodo").append('<option value='+item.id_cliente+' selected>'+item.anio_inicio+' - '+item.anio_fin+'</option>');
                  $('#cliente_id').val(item.id_cliente);
                  $('#ejercicio').attr({ min: item.anio_inicio, max: item.anio_fin});
                  }else{
                  $("#periodo").append('<option value='+item.id_cliente+'>'+item.anio_inicio+' - '+item.anio_fin+'</option>');
                  }
                });
                
              },
              cache: false
            });
      }else{
        $("#periodo").empty(); //valida si no se ha seleccionado una opc
        $("#periodo").append('<option value="">Elija un cliente</option>');
      }

  });
//====================================================
  $('#periodo').on('change', function(){ //evento del select periodo
  $('#cliente_id').val($('#periodo').val());

  for(index in myArray){
    if(parseInt(myArray[index].id_cliente) == parseInt($('#cliente_id').val())){
      //console.log('hola')
      $('#ejercicio').attr({ min: myArray[index].anio_inicio, max: myArray[index].anio_fin}); //si el periodo cambia, tambien el rango de ejercicio
    }
  }
  
});
//====================================================
  $('#fuente_financiamiento_id, #ejercicio').on('keyup change',function(){
   $('#ejercicio').val($('#ejercicio').val().slice(0,4));//copia de array de caracteres
    var anio = $('#ejercicio').val();
    var fechaMin = anio+'-01'+'-01';
    var fechaMax = anio+'-12'+'-31';
    $('#acta_integracion').attr('min',fechaMin);
    $('#acta_integracion').attr('max',fechaMax);
    // $('#acta_priorizacion').attr('min',fechaMin);
    // $('#acta_priorizacion').attr('max',fechaMax);
    // $('#adendum').attr('min',fechaMin);
    // $('#adendum').attr('max',fechaMax);
    cliente = $('#cliente_id').val();
    fuente= $('#fuente_financiamiento_id').val();
    ejercicio= $('#ejercicio').val();
    
    var link = '{{ url("/ejercicioDisponible")}}/'+cliente+','+ejercicio+','+fuente;
    if(cliente.length > 0 && fuente.length > 0 && ejercicio.length >= 3){
        $.ajax({
              url: link,
              dataType:'json',
              type:'get',
              success: function(data){
                //console.log(data);
                if(data.length != 0){
                  $('#error_existe').removeClass('hidden');
                  $('#guardar').attr("disabled", true);
                  $("#guardar").removeClass('bg-green-500');
                  $("#guardar").addClass('bg-gray-700');
                }else{
                  $('#error_existe').addClass('hidden');
                  $('#guardar').removeAttr("disabled");
                  $("#guardar").removeClass('bg-gray-700');
                  $("#guardar").addClass('bg-green-500');
                }
              },
              cache: false
            });
    }
    
  });
  $('#acta_integracion').on('change', function(){
      fechaMin = $('#acta_integracion').val();
      var anio = $('#ejercicio').val();
      var fechaMax = anio+'-12'+'-31';
      $('#acta_priorizacion').val('');
      $('#adendum').val('');
      $('#acta_priorizacion').attr('min',fechaMin);
      $('#acta_priorizacion').attr('max',fechaMax);
  });
  $('#acta_priorizacion').on('change', function(){
      fechaMin = $('#acta_priorizacion').val();
      var anio = $('#ejercicio').val();
      var fechaMax = anio+'-12'+'-31';
      $('#adendum').val('');
      $('#adendum').attr('min',fechaMin);
      $('#adendum').attr('max',fechaMax);
  });
//================================================
   $("#modal input").keyup(function() {
    $("#ejercicio").on({ //validacion de solo numeros
            "focus": function(event) {
                $(event.target).select();
            },
            "keyup": function(event) {
                $(event.target).val(function(index, value) { //formato montos
                    return value.replace(/\D/g, "")
                        .replace(/[^\d]/,'');
                        //.replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ",");
                });
            }
        });
//================================================
        var proyectado;
        var comprometido;
        $("#monto_proyectado").on({
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
//editar adm el ejercicio
      $("#monto_proyectado").on('keyup', function(){ //validar montos
                //obtener el monto para eliminar formato y pasar a float
                proyectado= $('#monto_proyectado').val().replace(/[&\/\\#,+()$~%'":*?<>{}]/g, '');
                proyectado = parseFloat(proyectado) || 0;
                
                comprometido= $('#monto_comprometido').val().replace(/[&\/\\#,+()$~%'":*?<>{}]/g, '');
                comprometido = parseFloat(comprometido) || 0;
                
                if(proyectado < comprometido){ //validacion entre monto proyectado y comprometido
                  $('#error_monto_menor').removeClass('hidden');                  
                }else{
                  $('#error_monto_menor').addClass('hidden');
                 
                }
      });
//================================================
        //validacion de campo vacio
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
//================================================
//validacion del formulario con el btn guardar
$().ready(function($) {
  $('#formulario').validate({
    onfocusout: false,
    onclick: false,
    rules: {
      cliente_id: { required: true },
      ejercicio: { required: true },
      monto_proyectado: { required: true },
      //monto_comprometido: { required: true},
      fuente_financiamiento_id: { required: true },
    },
    errorPlacement: function(error, element) {
      if(error != null){
      $('#error_'+element.attr('id')).fadeIn();
      }else{
        $('#error_'+element.attr('id')).fadeOut();
      }
     
    },
  });
//================================================
});

//Codigo de Modal detalles
$(".btn-AddDate").on("click",function() {
  document.getElementById('modal-id').classList.toggle("hidden");
  document.getElementById('modal-id' + "-backdrop").classList.toggle("hidden");
    
});
function moneda(valor){//formato montos
      return valor.toString().replace(/\D/g, "").replace(/([0-9])([0-9]{2})$/, '$1.$2').replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ",");
    }

  function toggleModal(modalID, index, cliente, fuente, key){ //modal detalles 
      
        for(item in cliente){
          if(index.cliente_id == cliente[item].id_cliente){
            // console.log(cliente[index].nombre)
            $('#nombre_municipio').html(cliente[item].nombre); 
          }
        }
        
    $('#ver_monto_proyectado').html(moneda(index.monto_proyectado)); 
    $('#ver_monto_comprometido').html(moneda(index.monto_comprometido)); 
    if(index.acta_integracion_consejo == null)
    { }
    else
    {$('#ver_acta_integracion_consejo').html(index.acta_integracion_consejo);} 
    if(index.acta_priorizacion == null)
    {$('#ver_acta_priorizacion').html('-');} 
    else
    {$('#ver_acta_priorizacion').html(index.acta_priorizacion);}
    if(index.adendum_priorizacion == null)
    {$('#ver_adendum_priorizacion').html('-');}
    else
    {$('#ver_adendum_priorizacion').html(index.adendum_priorizacion); }
    $('#ver_ejercicio').html(index.ejercicio);
    $('#ver_fuente_financiamiento').html(fuente);
    
    styleValue('#ver_prodim', index.prodim);
    styleValue('#ver_gastos_indirectos', index.gastos_indirectos);
    
    document.getElementById(modalID).classList.toggle("hidden");
    document.getElementById(modalID + "-backdrop").classList.toggle("hidden");
  }
  function styleValue(id,valor){ //funcion para determinar status de prodim y gastos indirectos
    if(valor == 1){
      html='<span class=" inline-flex text-xs leading-6 font-semibold rounded-full bg-green-200 text-green-800 ">\
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">\
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />\
                        </svg>\
                    </span>';
      $(id).html(html);
      $(id).removeClass();
      //$(id).addClass('px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800');
     // console.log(valor);
    }else if(valor == 0){
      html='<span class=" inline-flex text-xs leading-6 font-semibold rounded-full bg-red-200 text-red-800 ">\
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">\
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />\
                        </svg>\
                    </span>';
      $(id).html(html);
      $(id).removeClass();
      //$(id).addClass('px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800');
      
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
  function validar(){
      proyectado= $('#monto_proyectado').val().replace(/[&\/\\#,+()$~%'":*?<>{}]/g, '');
      proyectado = parseFloat(proyectado) || 0;
              
      comprometido= $('#monto_comprometido').val().replace(/[&\/\\#,+()$~%'":*?<>{}]/g, '');
      comprometido = parseFloat(comprometido) || 0;
      if(proyectado < comprometido){ //validacion entre monto proyectado y comprometido
              $('#error_monto_menor').removeClass('hidden');
              return false;
      }else{ 
              return true;
        }
    }
</script>

<script>
  //ejecucion del datatable  
$(document).ready(function() {
    $('#example').DataTable({
        "oSearch": {"sSearch": "" },
        "autoWidth" : true,
        "responsive" : true,
        "columnDefs": [
          { "width": "10%", "targets": 0 }
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