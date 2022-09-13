@extends('layouts.plantilla')
@section('title','Editar ')
@section('contenido')
@inject('service', 'App\Http\Controllers\ObraController')

<link rel="stylesheet" href="{{ asset('css/datatable.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles_personalizados.css') }}">
    <style>
        .select2.select2-container{
            width: 100%!important;
        }
    </style>
    
    <!--Responsive Extension Datatables CSS-->
    <link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" rel="stylesheet" type="text/css" />

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<div class="flex flex-row mb-4">
    <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
    </svg>
    <h1 class="font-bold text-xl ml-2">Proceso de pago</h1>
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
    <div class="mt-6 p-8 shadow-2xl bg-white rounded-lg">

        <div class="bg-gray-200 mt-5">
            <h2 class="font-bold text-lg text-center">Datos generales de la obra</h2>
        </div>
        
        <div class="mt-5 grid grid-cols-10 gap-4">
            <div class="col-span-10">
                <p class="font-bold">{{ $obra->nombre_obra }}</p>
            </div>
            <div class="col-span-10">
                <p class="text-sm font-semibold text-center">Nombre corto:</p>
                <p class="text-base font-bold mostrar_datos text-center">{{ $obra->nombre_corto_obra}}</p>
            </div>
            <div class="col-span-10 sm:col-span-3">
                <p class="text-sm font-semibold text-center sm:text-left">Localidad:</p>
                <p class="text-base font-bold mostrar_datos text-center">{{ $obra->nombre_localidad }}</p>
            </div>
            <div class="col-span-10 sm:col-span-3">
                <p class="text-sm font-semibold text-center sm:text-left">Municipio:</p>
                <p class="text-base font-bold mostrar_datos text-center">{{ $obra->nombre_municipio }}</p>
            </div>
            <div class="col-span-5 sm:col-span-2">
                <p class="text-sm font-semibold text-center sm:text-left">Municipio:</p>
                <p class="text-base font-bold mostrar_datos text-center">{{ $obra->nombre_distrito }}</p>
            </div>
            <div class="col-span-5 sm:col-span-2">
                <p class="text-sm font-semibold text-center sm:text-left">Estado:</p>
                <p class="text-base font-bold mostrar_datos text-center">{{ $obra->nombre_estado }}</p>
            </div>
        </div>

        <div class="bg-gray-200 mt-5">
            <h2 class="font-bold text-lg text-center">Detalles del contrato de arrendamiento</h2>
        </div>

        <div class="mt-5 grid grid-cols-8 gap-4">
            <div class="col-span-8 sm:col-span-2">
                <p class="text-sm font-semibold text-center sm:text-left">Número de contrato:</p>
                <p class="text-base font-bold mostrar_datos text-center">{{$contrato->numero_contrato}}</p>
            </div>
            <div class="col-span-8 sm:col-span-2">
                <p class="text-sm font-semibold text-center sm:text-left">Fecha de contrato:</p>
                <p class="text-base font-bold mostrar_datos text-center">{{$service->formatDate($contrato->fecha_contrato)}}</p>
            </div>
            <div class="col-span-8 sm:col-span-2">
                <p class="text-sm font-semibold text-center sm:text-left">Monto contratado:</p>
                <p class="text-base font-bold mostrar_datos text-center">{{$service->formatNumber($contrato->monto_contratado)}}</p>
            </div>
            <div class="col-span-8 sm:col-span-2">
                <p class="text-sm font-semibold text-center sm:text-left">Monto contratado:</p>
                <p class="text-base font-bold mostrar_datos text-center">{{$contrato->rfc}} - {{$contrato->razon_social}}</p>
            </div>
            <div class="col-span-8 sm:col-span-4 ">
                <p class="text-sm font-semibold text-center">Periodo del contrato</p>
                <div class="grid grid-cols-4 gap-4">
                    
                    <div class="col-span-4 sm:col-span-2">
                        <p class="text-base font-bold mostrar_datos text-center">{{$service->formatDate($contrato->fecha_inicio)}}</p>
                        <p class="text-sm font-semibold text-center">Fecha inicial </p>
                    </div>
                    <div class="col-span-4 sm:col-span-2">
                        <p class="text-base font-bold mostrar_datos text-center">{{$service->formatDate($contrato->fecha_fin)}}</p>
                        <p class="text-sm font-semibold text-center">Fecha final </p>
                    </div>
                    
                </div>
            </div>
        </div>

        <div class="bg-gray-200 mt-5">
            <h2 class="font-bold text-lg text-center">Facturas del contrato</h2>
        </div>

        <div class="">
            @if($total_admin < $contrato->monto_contratado)
                <div class="flex justify-center">
                    <button type="button" href="" class="text-sm text-blue-500 underline background-transparent font-semibold outline-none focus:outline-none ease-linear transition-all duration-150 text-center" onclick="toggleModal('modal-agregar-factura')">Agregar nueva factura</button>
                </div>
            @endif
            @if($facturas != null)
                <div class="mt-5">
                    <table id="example" class="table table_estimacion table-striped bg-white" style="width:100%;">
                        <thead>
                            <tr>
                                <th class="text-center">Núm.</th>
                                <th class="text-center">Folio fiscal</th>
                                <th class="text-center">Fecha de factura</th>
                                <th class="text-center">Monto facturado</th>
                                <th class="text-center">Proveedor</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            @foreach($facturas as $key => $factura)
                                <tr>
                                    <td>
                                        <div class="text-sm leading-5 font-medium text-gray-900 text-center">
                                            {{ $key + 1 }}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-sm leading-5 font-medium text-gray-900 text-center">
                                            {{ $factura->folio_fiscal}}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-sm leading-5 font-medium text-gray-900 text-right">
                                            {{ $service->formatDate($factura->fecha) }}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-sm leading-5 font-medium text-gray-900 text-right">
                                            {{ $service->formatNumber($factura->total) }}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-sm leading-5 font-medium text-gray-900 text-center">
                                            {{ $factura->razon_social}}
                                        </div>
                                    </td>
                                    
                                    <td>
                                        @if($total_admin < $contrato->monto_contratado)
                                            @if($key == count($facturas) - 1)
                                                <div class="text-sm leading-5 font-medium text-gray-900 flex justify-center">
                                                    <button type="button" href="" class="bg-white text-sm text-blue-500 font-normal text-ms p-2 rounded rounded-lg" onclick="toggleModal_EditFactura('modal-edit-factura', {{$factura}})">Editar</button>
                                                </div>
                                            @endif
                                        @endif
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- inicio modal agregar factura  -->
<div class="hidden overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center" id="modal-agregar-factura">
    <div class="relative w-auto my-6 mx-auto max-w-3xl">
    <!--content-->
    <div class="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none">
        <!--header-->
        <div class="flex items-start justify-between p-5 border-b border-solid border-blueGray-200 rounded-t">
        <h4 class="text-xl font-semibold">
            Agregar nueva factura
        </h4>
        <button class="p-1 ml-auto bg-transparent border-0 text-black opacity-5 float-right text-3xl leading-none font-semibold outline-none focus:outline-none" onclick="toggleModal('modal-agregar-factura')">
            <span class="bg-transparent text-black opacity-5 h-6 w-6 text-2xl block outline-none focus:outline-none">
            
            </span>
        </button>
        </div>
        <!--body-->
        <form action="{{ route('store_factura') }}" method="POST" id="formulario_factura" name="formulario_factura">
        @csrf
        @method('POST')
        <div class="relative p-6 flex-auto">
            <div class="grid grid-cols-10 gap-4">
                <input type="text" name="id_obra_admin_factura" id="id_obra_admin_factura" maxlength="40" class="hidden mt-1 focus:ring-blue-800 focus:border-blue-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ $contrato->obra_administracion_id }}">
                <input type="text" name="id_obra_factura" id="id_obra_factura" maxlength="40" class="hidden mt-1 focus:ring-blue-800 focus:border-blue-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ $obra->id_obra }}">
                <input type="text" name="id_contrato_factura" id="id_contrato_factura" maxlength="40" class="hidden mt-1 focus:ring-blue-800 focus:border-blue-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ $contrato->id_contrato_arrendamiento }}">
                <div class="col-span-10 sm:col-span-5">
                    <label  id="label_folio_fiscal_factura" class="block text-sm font-bold text-gray-700">Folio fiscal:</label>
                    <input type="text" name="folio_fiscal_factura" id="folio_fiscal_factura" maxlength="36" class="mt-1 focus:ring-blue-800 focus:border-blue-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ old('oficio_notificacion') }}">
                    <label id="error_folio_fiscal_factura" name="error_folio_fiscal_factura" class="hidden text-base font-normal text-red-500" >Ingrese un folio de factura valido.</label>
                </div>
                <div class="col-span-10 sm:col-span-5">
                    <label  id="label_fecha_factura" class="block text-sm font-bold text-gray-700">Fecha:</label>
                    <input type="date" name="fecha_factura" id="fecha_factura" min="{{$contrato->fecha_inicio}}" max="{{$contrato->fecha_fin}}" class="mt-1 focus:ring-blue-800 focus:border-blue-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ old('fecha_oficio_notificacion') }}">
                    <label id="error_fecha_factura" class="hidden text-base font-normal text-red-500" >Ingrese una fecha de factura valida.</label>
                </div>
                <div class="col-span-10 sm:col-span-5">
                    <label for="tipo" class="block text-sm font-bold text-gray-700">Monto*</label>
                    <div class="relative ">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <span class="text-gray-700 text-base">
                            $
                            </span>
                        </div>
                        <input type="text" name="total_factura" id="total_factura" maxlength="20" class="pl-7  mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" placeholder="0.00">
                    </div>
                    <label id="error_monto_admin_mayor_fac" class="hidden text-base font-normal text-red-500" >El monto es mayor que el restante de la obra: {{$service->formatNumber($contrato->monto_contratado - $total_admin)}}</label>
                    <label id="error_total_factura" class="hidden text-base font-normal text-red-500" >Ingrese un monto total de factura valido.</label>
                </div>
                <div class="col-span-10">
                    <label  id="label_concepto_factura" class="block text-sm font-bold text-gray-700">Concepto:</label>
                    
                    <textarea maxlength ="300" name="concepto_factura" id="concepto_factura" class="mt-1 focus:ring-blue-800 focus:border-blue-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ old('fecha_oficio_notificacion') }}"></textarea>
                    <label id="error_concepto_factura" class="hidden text-base font-normal text-red-500" >Ingrese concepto referente a la factura valido.</label>
                </div>
                <div class="col-span-10">
                    <label  for="proveedor" class="block text-sm font-bold text-gray-700">Proveedor*</label>
                    <select class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" name="proveedor_id" id="proveedor_id" >
                        <option value="{{$contrato->id_proveedor}}">{{$contrato->rfc}} - {{$contrato->razon_social}}</option>
                    </select>
                    <label id="error_proveedor_id" class="hidden text-base font-normal text-red-500" >Seleccione un proveedor.</label>
                </div>
        </div>
        
        </div>
        <!--footer-->
        <div class=" p-4 border-t border-solid border-blueGray-200 rounded-b">
        
        <span class="block text-xs">Verifique los campos obligatorios marcados con un ( * ) </span>
        <div class="text-right">
        
            <button class="text-red-500 background-transparent font-bold uppercase px-6 py-2 text-sm outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="button" onclick="toggleModal('modal-agregar-factura')">
            Cancelar
        </button>
        <button type="submit" id="guardar_factura" class="bg-green-500 text-white active:bg-green-600 font-bold uppercase text-sm px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" >
            Guardar
        </button>
        </div>
        </div>
        </form>
    </div>
    </div>
</div>

<!-- inicio modal editar factura  -->
<div class="hidden overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center" id="modal-edit-factura">
    <div class="relative w-auto my-6 mx-auto max-w-3xl">
    <!--content-->
    <div class="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none">
        <!--header-->
        <div class="flex items-start justify-between p-5 border-b border-solid border-blueGray-200 rounded-t">
        <h4 class="text-xl font-semibold">
            Editar factura
        </h4>
        <button class="p-1 ml-auto bg-transparent border-0 text-black opacity-5 float-right text-3xl leading-none font-semibold outline-none focus:outline-none" onclick="toggleModal('modal-edit-factura')">
            <span class="bg-transparent text-black opacity-5 h-6 w-6 text-2xl block outline-none focus:outline-none">
            
            </span>
        </button>
        </div>
        <!--body-->
        <form action="{{ route('update_factura') }}" method="POST" id="formulario_factura_edit" name="formulario_factura_edit">
        @csrf
        @method('POST')
        <div class="relative p-6 flex-auto">
            <div class="grid grid-cols-10 gap-4">
                <input type="text" name="id_factura" id="id_factura" maxlength="40" class="hidden mt-1 focus:ring-blue-800 focus:border-blue-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="">
                <input type="text" name="id_obra_factura_edit" id="id_obra_factura_edit" maxlength="40" class="hidden mt-1 focus:ring-blue-800 focus:border-blue-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ $obra->id_obra }}">
                <input type="text" name="id_contrato_factura_edit" id="id_contrato_factura_edit" maxlength="40" class="hidden mt-1 focus:ring-blue-800 focus:border-blue-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ $contrato->id_contrato_arrendamiento }}">
                <div class="col-span-10 sm:col-span-5">
                    <label  id="label_folio_fiscal_factura_edit" class="block text-sm font-bold text-gray-700">Folio fiscal:</label>
                    <input type="text" name="folio_fiscal_factura_edit" id="folio_fiscal_factura_edit" maxlength="36" class="mt-1 focus:ring-blue-800 focus:border-blue-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ old('oficio_notificacion') }}">
                    <label id="error_folio_fiscal_factura_edit" name="error_folio_fiscal_factura_edit" class="hidden text-base font-normal text-red-500" >Ingrese un folio de factura valido.</label>
                </div>
                <div class="col-span-5">
                    <label  id="label_fecha_factura_edit" class="block text-sm font-bold text-gray-700">Fecha:</label>
                    <input type="date" name="fecha_factura_edit" id="fecha_factura_edit" min="{{$contrato->fecha_inicio}}" max="{{$contrato->fecha_fin}}" class="mt-1 focus:ring-blue-800 focus:border-blue-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ old('fecha_oficio_notificacion') }}">
                    <label id="error_fecha_factura_edit" class="hidden text-base font-normal text-red-500" >Ingrese una fecha de factura valida.</label>
                </div>
                <div class="col-span-5 sm:col-span-5">
                    <label for="tipo" class="block text-sm font-bold text-gray-700">Monto*</label>
                    <div class="relative ">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <span class="text-gray-700 text-base">
                            $
                            </span>
                        </div>
                        <input type="text" name="total_factura_edit" id="total_factura_edit" maxlength="20" class="pl-7  mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" placeholder="0.00">
                    </div>
                    <label id="error_monto_admin_mayor_fac_edit" class="hidden text-base font-normal text-red-500" >El monto es mayor que el restante de la obra: {{$service->formatNumber($contrato->monto_contratado - $total_admin)}}</label>
                    <label id="error_total_factura_edit" class="hidden text-base font-normal text-red-500" >Ingrese un monto total de factura valido.</label>
                </div>
                <div class="col-span-10">
                    <label  id="label_concepto_factura_edit" class="block text-sm font-bold text-gray-700">Concepto:</label>
                    
                    <textarea maxlength ="300" name="concepto_factura_edit" id="concepto_factura_edit" class="mt-1 focus:ring-blue-800 focus:border-blue-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ old('fecha_oficio_notificacion') }}"></textarea>
                    <label id="error_concepto_factura_edit" class="hidden text-base font-normal text-red-500" >Ingrese concepto referente a la factura valido.</label>
                </div>
                <div class="col-span-10">
                    <label  for="proveedor" class="block text-sm font-bold text-gray-700">Proveedor*</label>
                    <select class="js-example-basic-single-1 mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" name="proveedor_id_edit" id="proveedor_id_edit">
                        <option value="{{$contrato->id_proveedor}}">{{$contrato->rfc}} - {{$contrato->razon_social}}</option>
                    </select>
                    <label id="error_proveedor_id_edit" class="hidden text-base font-normal text-red-500" >Seleccione un proveedor.</label>
                </div>
        </div>
        
        </div>
        <!--footer-->
        <div class=" p-4 border-t border-solid border-blueGray-200 rounded-b">
        
        <span class="block text-xs">Verifique los campos obligatorios marcados con un ( * ) </span>
        <div class="text-right">
        
            <button class="text-red-500 background-transparent font-bold uppercase px-6 py-2 text-sm outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="button" onclick="toggleModal('modal-edit-factura')">
            Cancelar
        </button>
        <button type="submit" id="guardar_factura_edit" class="bg-green-500 text-white active:bg-green-600 font-bold uppercase text-sm px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" >
            Guardar
        </button>
        </div>
        </div>
        </form>
    </div>
    </div>
</div>

<div class="hidden opacity-25 fixed inset-0 z-40 bg-black" id="modal-agregar-factura-backdrop"></div>
<div class="hidden opacity-25 fixed inset-0 z-40 bg-black" id="modal-edit-factura-backdrop"></div>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.responsive.min.js') }}"></script>
    <script src="https://unpkg.com/@popperjs/core@2.9.1/dist/umd/popper.min.js" charset="utf-8"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.22/b-1.6.4/b-flash-1.6.4/b-html5-1.6.4/b-print-1.6.4/datatables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.22/b-1.6.4/b-flash-1.6.4/b-html5-1.6.4/b-print-1.6.4/datatables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>  
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!--Alerta de confirmacion-->
@if(session('eliminar')=='ok')
<script>
  Swal.fire(
    '¡Agregada!',
    'La factura de arredamiento fue agregada correctamente.',
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
    html: 'La factura de arrendamiento no se puede guardar, revisa los datos.'
    
  });
</script>
@endif

<script>
    
    function toggleModal(modalID){
        document.getElementById(modalID).classList.toggle("hidden");
        document.getElementById(modalID + "-backdrop").classList.toggle("hidden");
    }

    function toggleModal_EditFactura(modalID, factura){
            console.log(factura);
            total = parseFloat(factura.total).toFixed(2);
            $("#id_factura").val(factura.id_factura);
            $("#folio_fiscal_factura_edit").val(factura.folio_fiscal);
            $("#fecha_factura_edit").val(factura.fecha);
            $("#total_factura_edit").val(("" + total).replace(/\D/g, "").replace(/([0-9])([0-9]{2})$/, '$1.$2').replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ","));
            $("#concepto_factura_edit").val(factura.concepto);
            $("#proveedor_id_edit option[value="+factura.proveedor_id+"]").attr("selected",true);
            $('.js-example-basic-single-1').select2();
            document.getElementById(modalID).classList.toggle("hidden");
            document.getElementById(modalID + "-backdrop").classList.toggle("hidden");


        }
    $(document).ready(function(){
        $('#example').DataTable({
                "autoWidth": true,
                "responsive": true,
                "bFilter": false,
                "bPaginate": false,
                "bInfo": false,
                columnDefs: [{
                        responsivePriority: 1,
                        targets: 3
                    },
                    {
                        responsivePriority: 1,
                        targets: 0
                    },
                    {
                        responsivePriority: 10001,
                        targets: 0
                    },
                    {
                        responsivePriority: 2,
                        targets: -2
                    }
                ],                
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json'
                }
            })
            .columns.adjust();

        $('.js-example-basic-single').select2();
            $("#total_factura").on({
                "keyup": function(event) {
                    $(event.target).val(function(index, value) {
                        return value.replace(/\D/g, "")
                            .replace(/([0-9])([0-9]{2})$/, '$1.$2')
                            .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ",");
                    });

                    total_capturado =  parseFloat($(this).val().replaceAll(",", ''));
                    
                    total = {{$total_admin == ''?0:$total_admin}};
                    total_obra = {{$contrato->monto_contratado}};
                        
                    total = total_capturado + total;
                    if(total > total_obra){
                        $("#error_monto_admin_mayor_fac").removeClass("hidden");
                    }else{
                        $("#error_monto_admin_mayor_fac").addClass("hidden");
                    }
                }
            });


            $("#formulario_factura").validate({
                onfocusout: false,
                onclick: false,
                rules: {
                    folio_fiscal_factura: { required: true},
                    fecha_factura: { required: true},
                    total_factura: { required:true },
                    proveedor_id: { required: true },
                },
                errorPlacement: function(error, element) {
                    
                    if(error != null){
                        $('#error_'+element.attr('id')).removeClass('hidden');
                    }else{
                        $('#error_'+element.attr('id')).addClass('hidden');
                    }
                // console.log(element.attr('id'));
                },
            }); 

            $("#guardar_factura").click(function () {
                total_capturado =  parseFloat($("#total_factura").val().replaceAll(",", ''));
                    
                total = {{$total_admin == ''?0:$total_admin}};
                total_obra = {{$contrato->monto_contratado}};
                        
                total = total_capturado + total;
                concepto = $("#concepto_factura").val().length;
                
                if(total > total_obra){
                    $("#formulario_factura input, #formulario_factura textarea").change();
                    $("#formulario_factura input, #formulario_factura textarea").keyup();
                    return false;
                }else{

                    valido = true;
                    if(concepto < 10){
                        $("#formulario_factura input, #formulario_factura textarea").change();
                        $("#formulario_factura input, #formulario_factura textarea").keyup();
                        valido = false;
                    }
                    return valido;
                }
                    
            });

            $("#formulario_factura input, #formulario_factura textarea").on({
                "change":function(event) {
                    fecha = new Date($(this).val());
                    console.log($(this).attr('type'));
                    if($(this).attr('type')== "date"){
                        console.log("hola");
                        if(fecha != "Invalid Date"){
                            console.log(fecha);
                            $('#error_'+$(this).attr('id')).addClass('hidden');
                            $("#label_"+$(this).attr('id')).removeClass('text-red-500');
                            $("#label_"+$(this).attr('id')).addClass('text-gray-700');
                        }else{
                            $('#error_'+$(this).attr('id')).removeClass('hidden');
                            $("#label_"+$(this).attr('id')).addClass('text-red-500');
                            $("#label_"+$(this).attr('id')).removeClass('text-gray-700');
                        }
                    }
                },
                "keyup": function(event) {
                    
                    fecha = $(this).val();
                    if(fecha != ''){
                        console.log(fecha);
                        $('#error_'+$(this).attr('id')).addClass('hidden');
                        $("#label_"+$(this).attr('id')).removeClass('text-red-500');
                        $("#label_"+$(this).attr('id')).addClass('text-gray-700');
                    }else{
                        console.log("fecha");
                        $('#error_'+$(this).attr('id')).removeClass('hidden');
                        $("#label_"+$(this).attr('id')).addClass('text-red-500');
                        $("#label_"+$(this).attr('id')).removeClass('text-gray-700');
                    }
                },
            });

            //Modal editar factura
            $("#total_factura_edit").on({
                "keyup": function(event) {
                    $(event.target).val(function(index, value) {
                        return value.replace(/\D/g, "")
                            .replace(/([0-9])([0-9]{2})$/, '$1.$2')
                            .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ",");
                    });

                    total_capturado =  parseFloat($(this).val().replaceAll(",", ''));
                    
                    total = {{$total_admin == ''?0:$total_admin}};
                    total_obra = {{$contrato->monto_contratado}};
                        
                    total = total_capturado + total;
                    if(total > total_obra){
                        $("#error_monto_admin_mayor_fac_edit").removeClass("hidden");
                    }else{
                        $("#error_monto_admin_mayor_fac_edit").addClass("hidden");
                    }
                }
            });


            $("#formulario_factura_edit").validate({
                onfocusout: false,
                onclick: false,
                rules: {
                    folio_fiscal_factura_edit: { required: true},
                    fecha_factura_edit: { required: true},
                    total_factura_edit: { required:true },
                    proveedor_id_edit: { required: true },
                },
                errorPlacement: function(error, element) {
                    
                    if(error != null){
                        $('#error_'+element.attr('id')).removeClass('hidden');
                    }else{
                        $('#error_'+element.attr('id')).addClass('hidden');
                    }
                // console.log(element.attr('id'));
                },
            }); 

            $("#guardar_factura_edit").click(function () {
                total_capturado =  parseFloat($("#total_factura_edit").val().replaceAll(",", ''));
                    console.log("hola");
                total = {{$total_admin == ''?0:$total_admin}};
                total_obra = {{$contrato->monto_contratado}};
                        
                total = total_capturado + total;
                concepto = $("#concepto_factura_edit").val().length;
                
                if(total > total_obra){
                    $("#formulario_factura_edit input, #formulario_factura_edit textarea").change();
                    $("#formulario_factura_edit input, #formulario_factura_edit textarea").keyup();
                    return false;
                }else{

                    valido = true;
                    if(concepto < 10){
                        $("#formulario_factura_edit input, #formulario_factura_edit textarea").change();
                        $("#formulario_factura_edit input, #formulario_factura_edit textarea").keyup();
                        $("#error_concepto_factura_edit").removeClass("hidden");
                        valido = false;
                    }
                    return valido;
                }
                    
            });

            $("#formulario_factura_edit input, #formulario_factura_edit textarea").on({
                "change":function(event) {
                    fecha = new Date($(this).val());
                    if($(this).attr('type')== "date"){
                        if(fecha != "Invalid Date"){
                            $('#error_'+$(this).attr('id')).addClass('hidden');
                            $("#label_"+$(this).attr('id')).removeClass('text-red-500');
                            $("#label_"+$(this).attr('id')).addClass('text-gray-700');
                        }else{
                            $('#error_'+$(this).attr('id')).removeClass('hidden');
                            $("#label_"+$(this).attr('id')).addClass('text-red-500');
                            $("#label_"+$(this).attr('id')).removeClass('text-gray-700');
                        }
                    }
                },
                "keyup": function(event) {
                    
                    fecha = $(this).val();
                    if(fecha != ''){
                        console.log(fecha);
                        $('#error_'+$(this).attr('id')).addClass('hidden');
                        $("#label_"+$(this).attr('id')).removeClass('text-red-500');
                        $("#label_"+$(this).attr('id')).addClass('text-gray-700');
                    }else{
                        console.log("fecha");
                        $('#error_'+$(this).attr('id')).removeClass('hidden');
                        $("#label_"+$(this).attr('id')).addClass('text-red-500');
                        $("#label_"+$(this).attr('id')).removeClass('text-gray-700');
                    }
                },
            });
    });
</script>

@endsection