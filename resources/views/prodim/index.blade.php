@extends('layouts.plantilla')
@section('title','Prodim')
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
  <h1 class="text-xl font-bold ml-2">Lista Prodim</h1>
</div>

<div class="flex flex-col mt-6">
    <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
    <button class="bg-orange-800 mb-4 text-white active:bg-orange-800 font-bold uppercase text-sm px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="button" onclick="toggleModal('modal-add')">
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

<!-- fin tabla tailwind, inicio data table -->
<div class="contenedor p-8 shadow-2xl bg-white rounded-lg">
  <table id="example" class="table table-striped bg-white" style="width:100%;">
      <thead>
        <tr>
            <th>Cliente</th>
            <th>Acuse</th>
            <th>Ejercicio</th>
            <th>Firma electronica</th>
            <th>Revisado</th>
            <th>Validado</th>          
            <th>Convenio</th>
            <th class="flex justify-center">Acción</th>
        </tr>
      </thead>
      <tbody> 
        @foreach( $listaProdim as $index)
        <tr>
            <td>
              <div class="flex items-center">
                <div>
                    <div class="text-sm leading-5 font-medium text-gray-900">
                      {{$index->nombre}}
                    </div>
                    
                </div>
            </div>
            </td>
            <td>
              <div class="text-sm leading-5 font-medium text-gray-900 flex justify-center">
                {{$index->acuse_prodim}}
              </div>
            </td>
            <td>
              <div class="text-sm leading-5 font-medium text-gray-900 flex justify-center">
                {{$index->ejercicio}}
              </div>
            </td>
            <td>
              <div class="text-sm leading-5 font-medium text-gray-900 flex justify-center">
                  @if(($index->firma_electronica == 1) )
                  <span class=" inline-flex text-xs leading-6 font-semibold rounded-full bg-green-200 text-green-800 ">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </span>
                @else
                  <span class=" inline-flex text-xs leading-6 font-semibold rounded-full bg-red-200 text-red-800 ">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </span>
                @endif
              </div>
            </td>
            <td>
              <div class="text-sm leading-5 font-medium text-gray-900 flex justify-center">
                    @if(($index->revisado == 1) )
                    <span class=" inline-flex text-xs leading-6 font-semibold rounded-full bg-green-200 text-green-800 ">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                      </svg>
                    </span>
                    @else
                      <span class=" inline-flex text-xs leading-6 font-semibold rounded-full bg-red-200 text-red-800 ">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </span>
                    @endif
              </div>
            </td>
            <td>
              <div class="text-sm leading-5 font-medium text-gray-900 flex justify-center">
                @if(($index->validado == 1) )
                    <span class=" inline-flex text-xs leading-6 font-semibold rounded-full bg-green-200 text-green-800 ">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                      </svg>
                    </span>
                    @else
                      <span class=" inline-flex text-xs leading-6 font-semibold rounded-full bg-red-200 text-red-800 ">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </span>
                    @endif
              </div>
            </td>
            <td>
              <div class="text-sm leading-5 font-medium text-gray-900 flex justify-center">
                @if(($index->convenio == 1) )
                    <span class=" inline-flex text-xs leading-6 font-semibold rounded-full bg-green-200 text-green-800 ">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                      </svg>
                    </span>
                    @else
                      <span class=" inline-flex text-xs leading-6 font-semibold rounded-full bg-red-200 text-red-800 ">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </span>
                    @endif
              </div>
            </td>
            <td>
              <div class="flex justify-center">
              <form action="{{ route('prodim.destroy', $index->id_prodim) }}" method="POST" class="form-eliminar" >
                <div>
                <a type="button"  href="{{ route('prodim.edit', $index->id_prodim) }}" class="bg-white text-blue-500 p-2 rounded rounded-lg">Editar</a>
                <button class="bg-transparent text-blue-500 active:bg-transparent font-normal p-2 rounded outline-none focus:outline-none  ease-linear transition-all duration-150"  type="button" onclick="toggleDetalles('modal-detalles', {{$index}})">
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
  </table>
    </div>

    <!-- inicio modal -->
<div class="hidden overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center" id="modal-detalles">
  <div class="relative w-auto my-6 mx-auto max-w-3xl">
    <!--content-->
    <div class="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none">
      <!--header-->
      <div class="flex items-start justify-between p-5 border-b border-solid border-blueGray-200 rounded-t">
        <h4 class="text-xl font-semibold">
          Detalles Prodim
        </h4>
        <button class="p-1 ml-auto bg-transparent border-0 text-red-500 float-right text-3xl leading-none font-semibold outline-none focus:outline-none" onclick="toggleDetalles('modal-detalles')">
          <span class="bg-transparent text-red-500 h-6 w-6 text-2xl block outline-none focus:outline-none">
            ×
          </span>
        </button>
      </div>
      <!--body-->
      
      <div class="relative p-6 flex-auto">
        
          <div class="grid grid-cols-8 gap-8">
            <div class="col-span-8 ">
              <label for="detalles_cliente" class="text-base font-medium text-gray-700">Cliente: </label>
              <label id="detalles_cliente" class="text-base font-bold text-gray-900"></label>
            </div>
            <div class="col-span-8">
              <label for="detalles_acuse" class=" text-base font-medium text-gray-700">Acuse: </label>
              <label id="detalles_acuse" class="text-base font-bold text-gray-900 "></label>
            </div>
            <div class="col-span-8">
              <label for="detalles_ejercicio" class=" text-base font-medium text-gray-700">Ejercicio: </label>
              <label id="detalles_ejercicio" class="text-base font-bold text-gray-900 "></label>
            </div>
           
            <div class="col-span-8">
                <label for="detalles_firma_electronica" class="text-base font-medium text-gray-700">Firma electronica: </label>
                <label id="detalles_firma_electronica" class="text-base font-bold text-gray-900"></label>
              </div>
            <div class="col-span-8">
                <label for="detalles_revisado" class="text-base font-medium text-gray-700">Revisado: </label>
                <label id="detalles_revisado" class="text-base font-bold text-gray-900"></label>
              </div>
              <div class="col-span-8">
                <label for="detalles_fecha_revisado" class="text-base font-medium text-gray-700">Fecha Revisado: </label>
                <label id="detalles_fecha_revisado" class="text-base font-bold text-gray-900"></label>
              </div>
              <div class="col-span-8">
                <label for="detalles_validado" class="text-base font-medium text-gray-700">Validado: </label>
                <label id="detalles_validado" class="text-base font-bold text-gray-900"></label>
              </div>
              <div class="col-span-8">
                <label for="detalles_fecha_validado" class="text-base font-medium text-gray-700">Fecha validado: </label>
                <label id="detalles_fecha_validado" class="text-base font-bold text-gray-900"></label>
              </div>
              <div class="col-span-8">
                <label for="detalles_convenio" class="text-base font-medium text-gray-700">Convenio: </label>
                <label id="detalles_convenio" class="text-base font-bold text-gray-900"></label>
              </div>
              <div class="col-span-8">
                <label for="detalles_fecha_convenio" class="text-base font-medium text-gray-700">Fecha convenio: </label>
                <label id="detalles_fecha_convenio" class="text-base font-bold text-gray-900"></label>
              </div>             
          </div>
        
      </div>
      <!--footer-->
    </div>
  </div>
</div>

    <!-- inicio modal -->
<div class="hidden overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center" id="modal-add">
    <div class="relative w-auto my-6 mx-auto max-w-3xl">
      <!--content-->
      <div class="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none">
        <!--header-->
        <div class="flex items-start justify-between p-5 border-b border-solid border-blueGray-200 rounded-t">
          <h4 class="text-xl font-semibold">
            Agregar Nuevo Prodim
          </h4>
          <button class="p-1 ml-auto bg-transparent border-0 text-black opacity-5 float-right text-3xl leading-none font-semibold outline-none focus:outline-none" onclick="toggleModal('modal-add')">
            <span class="bg-transparent text-black opacity-5 h-6 w-6 text-2xl block outline-none focus:outline-none">
              
            </span>
          </button>
        </div>
        <!--body-->
        <form action="{{ route('prodim.store') }}" method="POST" onsubmit="return validar()" id="formulario" name="formulario">
          @csrf
          @method('POST')
        <div class="relative p-6 flex-auto">
                <div class="relative p-6 flex-auto" id="anexos">
                    <div class="grid grid-cols-6 gap-4 mb-2">
                        <div class="col-span-3 ">
                            <label  id="label_cliente_id" for="cliente_id" class="block text-sm font-medium text-gray-700">Cliente *</label>
                            <select id="cliente_id" name="cliente_id" onchange="" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">                
                                <option value=""> Elija una opción </option>
                                @foreach ($clientes as $cliente)
                                    <option value="{{ $cliente->municipio_id }}"> {{ $cliente->nombre }} </option>
                                @endforeach
                            </select>
                            <label id="error_cliente_id" name="error_cliente_id" class="hidden text-base font-normal text-red-500" >Seleccione una opción</label>
                        </div>

                        <div class="col-span-3 ">
                            <label  id="label_ejercicio" for="ejercicio" class="block text-sm font-medium text-gray-700">Ejercicio *</label>
                            <select id="ejercicio" name="ejercicio" onchange="" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">                
                              <option value=""> Elija un cliente </option>
                              
                            </select>
                            <label id="error_ejercicio" name="error_ejercicio" class="hidden text-base font-normal text-red-500" >Seleccione una opción</label>
                            <input id="fuenteCliente_id" name="fuenteCliente_id" type="text" hidden>
                        </div>

                        <div class="col-span-3 ">
                            <label  id="label_acuse" for="acuse" class="block text-sm font-medium text-gray-700">Acuse *</label>
                            <input type="text" name="acuse" id="acuse" minlength="4" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" >
                            <label id="error_acuse" name="error_acuse" class="hidden text-base font-normal text-red-500" >Este dato es requerido</label>
                        </div>

                        <div class="col-span-3 p-4">
                            <div class="flex flex-row p-2 justify-center">
                                <label id="label_firma_electronica" for="firma_electronica" class="ml-6 text-sm font-medium text-gray-700 ">Firma electronica </label>
                                <input type="checkbox" name="firma_electronica" id="firma_electronica" class="ml-2 shadow-sm sm:text-sm border-gray-300 rounded h-6 w-6">
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-nowrap w-full p-2" >

                        <div class="flex flex-col justify-center w-full">
                            <div class="flex flex-row  p-2 ">
                                <label id="label_revisado" for="revisado" class="ml-6 text-sm font-medium text-gray-700 ">Revisado </label>
                                <input type="checkbox" name="revisado" id="revisado" class="ml-2 shadow-sm sm:text-sm border-gray-300 rounded h-6 w-6">
                            </div>
                        </div>

                        <div class="flex flex-col justify-center w-full">
                            <div class="flex flex-row  p-2">
                                <label id="label_validado" for="validado" class="ml-6 text-sm font-medium text-gray-700 ">Validado</label>
                                <input type="checkbox" name="validado" id="validado" class="ml-2 shadow-sm sm:text-sm border-gray-300 rounded h-6 w-6" disabled>
                            </div>
                        </div>

                        <div class="flex flex-col justify-center w-full">
                            <div class="flex flex-row  p-2">
                                <label id="label_convenio" for="convenio" class="ml-6 text-sm font-medium text-gray-700 ">Convenio</label>
                                <input type="checkbox" name="convenio" id="convenio" class="ml-2 shadow-sm sm:text-sm border-gray-300 rounded h-6 w-6">
                            </div>
                        </div>
                    </div>
                 
                    <div class="grid grid-cols-6 gap-4">
                      <div class="col-span-2 p-2">
                        <label id="label_fecha_revisado" for="fecha_revisado" class="block text-sm font-medium text-gray-700">Fecha revisado *</label>
                        <input type="date" name="fecha_revisado" id="fecha_revisado" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" disabled>
                        <label id="error_fecha_revisado" class="hidden block text-md text-red-500">Se require de una fecha</label>
                      </div>
                    
                      <div class="col-span-2 p-2">
                        <label id="label_fecha_validado" for="fecha_validado" class="block text-sm font-medium text-gray-700">Fecha validado *</label>
                        <input type="date" name="fecha_validado" id="fecha_validado" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" disabled>
                        <label id="error_fecha_validado" class="hidden block text-md text-red-500">Se require de una fecha</label>
                      </div>
        
                      <div class="col-span-2 p-2">
                        <label id="label_fecha_convenio" for="fecha_convenio" class="block text-sm font-medium text-gray-700">Fecha convenio *</label>
                        <input type="date" name="fecha_convenio" id="fecha_convenio" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" disabled>
                        <label id="error_fecha_convenio" class="hidden block text-md text-red-500">Se require de una fecha</label>
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
  <div class="hidden opacity-25 fixed inset-0 z-40 bg-black" id="modal-detalles-backdrop"></div>

  <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('js/dataTables.responsive.min.js') }}"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.22/b-1.6.4/b-flash-1.6.4/b-html5-1.6.4/b-print-1.6.4/datatables.min.js"></script>

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

    <script type="text/javascript">
    
        function toggleModal(modal){
            document.getElementById(modal).classList.toggle("hidden");
            document.getElementById(modal + "-backdrop").classList.toggle("hidden");    
        }
//===================================================
      function toggleDetalles(modalID, prodim){
        
          if(prodim != null){
            $('#detalles_cliente').text(prodim.nombre);
            $('#detalles_acuse').text(prodim.acuse_prodim);
            $('#detalles_ejercicio').text(prodim.ejercicio);
            if(prodim.firma_electronica == 1){
            $('#detalles_firma_electronica').html('<span class=" inline-flex text-xs leading-6 font-semibold rounded-full bg-green-200 text-green-800 ">\
                          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">\
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />\
                          </svg>\
            </span>'); //status
            }else{
              $('#detalles_firma_electronica').html('<span class=" inline-flex text-xs leading-6 font-semibold rounded-full bg-red-200 text-red-800 ">\
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">\
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />\
                            </svg>\
                        </span>'); //status
            }
            if(prodim.revisado == 1){
            $('#detalles_revisado').html('<span class=" inline-flex text-xs leading-6 font-semibold rounded-full bg-green-200 text-green-800 ">\
                          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">\
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />\
                          </svg>\
            </span>'); //status
            }else{
              $('#detalles_revisado').html('<span class=" inline-flex text-xs leading-6 font-semibold rounded-full bg-red-200 text-red-800 ">\
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">\
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />\
                            </svg>\
                        </span>'); //status
            }
            if(prodim.fecha_revisado != null)
            $('#detalles_fecha_revisado').text(prodim.fecha_revisado);
            else
            $('#detalles_fecha_revisado').text('-');
            if(prodim.validado == 1){
            $('#detalles_validado').html('<span class=" inline-flex text-xs leading-6 font-semibold rounded-full bg-green-200 text-green-800 ">\
                          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">\
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />\
                          </svg>\
            </span>'); //status
            }else{
              $('#detalles_validado').html('<span class=" inline-flex text-xs leading-6 font-semibold rounded-full bg-red-200 text-red-800 ">\
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">\
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />\
                            </svg>\
                        </span>'); //status
            }
            
            if(prodim.fecha_validado != null)
              $('#detalles_fecha_validado').text(prodim.fecha_validado);
            else
              $('#detalles_fecha_validado').text('-');
            if(prodim.convenio == 1){
            $('#detalles_convenio').html('<span class=" inline-flex text-xs leading-6 font-semibold rounded-full bg-green-200 text-green-800 ">\
                          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">\
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />\
                          </svg>\
            </span>'); //status
            }else{
              $('#detalles_convenio').html('<span class=" inline-flex text-xs leading-6 font-semibold rounded-full bg-red-200 text-red-800 ">\
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">\
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />\
                            </svg>\
                        </span>'); //status
            }
            if(prodim.fecha_convenio != null)
            $('#detalles_fecha_convenio').text(prodim.fecha_convenio);
            else
            $('#detalles_fecha_convenio').text('-');
        }
          document.getElementById(modalID).classList.toggle("hidden");
          document.getElementById(modalID + "-backdrop").classList.toggle("hidden");
      }
        
//===================================================
        $(document).ready(function(){
          $('#example').DataTable({ //datatable
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
      }).columns.adjust();

            $("#cliente_id").on('change', function () { //consulta ejercicios por cliente
                cliente=$(this).val();
                $("#ejercicio").empty(); //valida si no se ha seleccionado una opc
                $("#ejercicio").append('<option value="">Elija un cliente</option>');
                if(cliente != ""){
                  var link = '{{ url("/obtenerEjerciciosPorCliente")}}/'+cliente; //consulta ajax
                  $.ajax({
                      url: link,
                      dataType:'json',
                      type:'get',
                      success: function(data){
                          //console.log(data)
                          $.each(data,function(key, item) {
                              $("#ejercicio").append('<option value='+item.id_fuente_financ_cliente+'>'+item.ejercicio+'</option>');
                          });
                      },
                      cache: false
                  });
                }

            });
//===================================================
            $("#ejercicio").on('change', function () { //limitacion de los calendarios
                $('#fuenteCliente_id').val($('#ejercicio').val());
              
                $('#fecha_revisado').val('');
                $('#fecha_validado').val('');
                $('#fecha_revisado').attr('min',$('#ejercicio option:selected').text()+'-01-01');
                $('#fecha_revisado').attr('max',$('#ejercicio option:selected').text()+'-12-31');
            }); 

            $('#fecha_revisado').on('change', function(){
              $('#fecha_validado').val('');
              $('#fecha_validado').attr('min', $('#fecha_revisado').val());
              $('#fecha_validado').attr('max',$('#ejercicio option:selected').text()+'-12-31');
            });

            $('#fecha_validado').on('change', function(){
              $('#fecha_convenio').attr('min', $('#fecha_revisado').val());
              $('#fecha_convenio').attr('max',$('#ejercicio option:selected').text()+'-12-31');
            });

            $("input[type='checkbox']").on('click', function(){
              if($(this).prop("checked")) {
                //$('#fecha_'+$(this).attr('id')).prop('required',true);
                $('#fecha_'+$(this).attr('id')).prop('disabled',false);
              }else{
                //$('#fecha_'+$(this).attr('id')).prop('required',false);
                $('#fecha_'+$(this).attr('id')).prop("disabled",true);
              }
            });

            $("#revisado").on('click', function(){
              if($(this).prop("checked")) {
                $('#validado').prop('disabled',false)
              }else{
                $('#validado').prop('disabled',true)
              }
            });
        });
//===================================================
        function validar(){ //validacion del formulario
            band =true;
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
              acuse= document.forms["formulario"]["acuse"].value;
              if(acuse == ""){
                 $('#error_acuse').removeClass('hidden');  
                 band= false;
              }else{
                $('#error_acuse').addClass('hidden'); 
              }
              revisado = document.getElementById("revisado").checked;
              fecha_revisado = document.forms["formulario"]["fecha_revisado"].value;
              if(revisado){
                if(fecha_revisado == ''){
                  $('#error_fecha_revisado').removeClass('hidden');
                  band= false;
                }else{
                  $('#error_fecha_revisado').addClass('hidden');
                }
              }else{
                $('#error_fecha_revisado').addClass('hidden');
              }
              validado = document.getElementById("validado").checked;
              fecha_validado = document.forms["formulario"]["fecha_validado"].value;
              if(validado){
                if(fecha_validado == ''){
                  $('#error_fecha_validado').removeClass('hidden');
                  band= false;
                }else{
                  $('#error_fecha_validado').addClass('hidden');
                }
              }else{
                $('#error_fecha_validado').addClass('hidden');
              }
              convenio = document.getElementById("convenio").checked;
              fecha_convenio = document.forms["formulario"]["fecha_convenio"].value;
              if(convenio){
                if(fecha_convenio == ''){
                  $('#error_fecha_convenio').removeClass('hidden');
                  band= false;
                }else{
                  $('#error_fecha_convenio').addClass('hidden');
                }
              }else{
                $('#error_fecha_convenio').addClass('hidden');
              }
          return band;
        }
    </script>
    
   
@endsection