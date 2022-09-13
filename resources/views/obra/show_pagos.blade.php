@extends('layouts.plantilla')
@section('title','Editar ')
@section('contenido')
@inject('service', 'App\Http\Controllers\ObraController')

<link rel="stylesheet" href="{{ asset('css/datatable.css') }}">
        <link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/style_alert.css') }}">
        <!--Responsive Extension Datatables CSS-->
        <link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css">

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
        
        <div class="mt-5 grid grid-cols-9 gap-4">
            <div class="col-span-9">
                <p class="font-bold">{{ $obra->nombre_obra }}</p>
            </div>
            <div class="col-span-9">
                <p class="text-sm font-semibold">Nombre corto: <br><span class="ml-5 text-base font-bold mostrar_datos">{{ $obra->nombre_corto_obra}}</span></p>
            </div>
            <div class="col-span-9 sm:col-span-3">
                <p class="text-sm font-semibold">Localidad <br><span class="ml-5 text-base font-bold">{{ $obra->nombre_localidad }}</span></p>
            </div>
            <div class="col-span-9 sm:col-span-2">
                <p class="text-sm font-semibold">Municipio <br><span class="ml-5 text-base font-bold">{{ $obra->nombre_municipio }}</span></p>
            </div>
            <div class="col-span-9 sm:col-span-2">
                <p class="text-sm font-semibold">Distrito <br><span class="ml-5 text-base font-bold">{{ $obra->nombre_distrito }}</span></p>
            </div>
            <div class="col-span-9 sm:col-span-2">
                <p class="text-sm font-semibold">Estado <br><span class="ml-5 text-base font-bold">{{ $obra->nombre_estado }}</span></p>
            </div>
        </div>

        <div class="bg-gray-200 mt-5">
            <h2 class="font-bold text-lg text-center">Detalles del proceso de pago {{$pagos_obra->nombre == 'Anticipo'?'del': 'de la'}} {{$pagos_obra->nombre}}</h2>
        </div>
        @if($pagos_obra->fecha_recepcion == null || $pagos_obra->fecha_validacion == null || $pagos_obra->fecha_pago == null)
            <div class="mt-2 flex justify-center">
                <button type="button" href="" class="text-sm text-blue-500 background-transparent font-semibold outline-none focus:outline-none transition-all duration-150 text-center" onclick="toggleModal_fechas('modal-update-fechas')">Actualizar fechas</button>
            </div>
        @endif

        <div class="mt-5 grid grid-cols-9 gap-4">
            <div class="col-span-9 sm:col-span-3">
                <p class="text-sm font-semibold">Fecha de recepción de documentos: </p>
                    <p class="ml-5 text-base font-bold mostrar_datos">{{ $pagos_obra->fecha_recepcion == null?'Sin registro previo': $service->formatDate($pagos_obra->fecha_recepcion)}} </p>
            </div>
            <div class="col-span-9 sm:col-span-3">
                <p class="text-sm font-semibold">Fecha de validación de documentos: </p>
                
                    @if( $pagos_obra->fecha_recepcion!= null)
                        <p class="ml-5 text-base font-bold mostrar_datos text-blue-500">
                            {{ $pagos_obra->fecha_validacion == null?'En proceso': $service->formatDate($pagos_obra->fecha_validacion)}} 
                        </p>
                    @else
                        <p class="ml-5 text-base font-bold mostrar_datos text-red-500">
                            Sin recepción de documentos
                        </p>
                    @endif 

                    
                </p>
            </div>
            <div class="col-span-9 sm:col-span-3">
                <p class="text-sm font-semibold">Fecha de pago {{$pagos_obra->nombre == 'Anticipo'?'del': 'de la'}} {{$pagos_obra->nombre}}: </p>
                <p class="ml-5 text-base font-bold mostrar_datos">
                    @if( $pagos_obra->fecha_recepcion != null)
                        @if( $pagos_obra->fecha_validacion != null)
                            @if($pagos_obra->fecha_pago == null)
                                <p class="ml-5 text-base font-bold mostrar_datos text-blue-500">
                                    En proceso
                                </p>
                            @else
                                <p class="ml-5 text-base font-bold mostrar_datos text-gray-900">
                                    {{$service->formatDate($pagos_obra->fecha_pago)}}
                                </p>
                            @endif
                        @else
                            @if( $pagos_obra->fecha_pago != null)
                                <p class="ml-5 text-base font-bold mostrar_datos text-red-500">
                                    {{$service->formatDate($pagos_obra->fecha_pago)}}
                                </p>
                            @else
                                <p class="ml-5 text-base font-bold mostrar_datos text-red-500">
                                    En proceso de validación.
                                </p>
                            @endif
                            
                        @endif 
                    @else
                        @if( $pagos_obra->fecha_pago != null)
                            <p class="ml-5 text-base font-bold mostrar_datos text-red-500">
                                {{$service->formatDate($pagos_obra->fecha_pago)}}
                            </p>
                        @else
                            <p class="ml-5 text-base font-bold mostrar_datos text-red-500">
                                Sin recepción de documentos
                            </p>
                        @endif
                    @endif
                </p>
            </div>
            <div class="mt-2 col-span-9">
                <p class="text-base font-bold text-center">Observaciones realizadas para la validación</p>

            </div>
            <div class="col-span-9">
                @if($pagos_obra != null)
                    <div class="">
                        <table id="example" class="table table_estimacion table-striped bg-white" style="width:100%;">
                            <thead>
                                <tr>
                                    <th class="text-center"><p  class="text-sm leading-5 font-bold text-gray-900 text-center line-height-1">Núm.</p></th>
                                    <th class="text-center"><p  class="text-sm leading-5 font-bold text-gray-900 text-center line-height-1">Fecha de observación</p></th>
                                    <th class="text-center"><p  class="text-sm leading-5 font-bold text-gray-900 text-center line-height-1">Fecha de solventación</p></th>
                                    <th class="text-center"><p  class="text-sm leading-5 font-bold text-gray-900 text-center line-height-1">Acciones</p></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($pagos_obra->fecha_recepcion != null)
                                    @foreach($observaciones as $key => $observacion)
                                        <tr>
                                            <td>
                                                <div class="text-sm leading-5 font-medium text-center">
                                                    <p class="text-base font-bold mostrar_datos text-gray-700">
                                                        {{$key + 1}}
                                                    </p>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="text-sm leading-5 font-medium text-center">
                                                    @if( $pagos_obra->fecha_recepcion != null)
                                                        @if($observacion->fecha_observaciones == null)
                                                            <p class="text-base font-bold mostrar_datos text-blue-500">
                                                                En proceso
                                                            </p>
                                                        @else
                                                            <p class="text-base font-bold mostrar_datos text-gray-900">
                                                                {{$service->formatDate($observacion->fecha_observaciones)}}
                                                            </p>
                                                        @endif
                                                    @else
                                                        <p class="text-base font-bold mostrar_datos text-red-500">
                                                            Sin recepción de documentos
                                                        </p>
                                                    @endif 
                                                </div>
                                            </td>
                                            <td>
                                                <div class="text-sm leading-5 font-medium text-center">
                                                    @if( $pagos_obra->fecha_recepcion != null)
                                                        @if( $observacion->fecha_observaciones != null)
                                                            @if($observacion->fecha_solventacion == null)
                                                                <p class="text-base font-bold mostrar_datos text-blue-500">
                                                                    En proceso
                                                                </p>
                                                            @else
                                                                <p class="text-base font-bold mostrar_datos text-gray-900">
                                                                    {{$service->formatDate($observacion->fecha_solventacion)}}
                                                                </p>
                                                            @endif
                                                        @else
                                                            <p class="text-base font-bold mostrar_datos text-red-500">
                                                                En proceso de revisión.
                                                            </p>
                                                        @endif 
                                                    @else
                                                        <p class="text-base font-bold mostrar_datos text-red-500">
                                                            Sin recepción de documentos
                                                        </p>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                @if(count($observaciones) - 1 == $key && $observacion->fecha_solventacion == null && $pagos_obra->fecha_recepcion != null)
                                                    <div class="flex justify-center">
                                                        <button type="button" href="" class="text-sm text-blue-500 background-transparent font-semibold outline-none focus:outline-none transition-all duration-150 text-center" onclick="toggleModal('modal', {{$observacion}}, '{{count($observaciones) > 1?$observaciones[$key - 1]->fecha_solventacion:$pagos_obra->fecha_recepcion}}','{{$service->formatDate($observacion->fecha_observaciones)}}', '{{$service->formatDate($observacion->fecha_solventacion)}}')">Actualizar</button>
                                                    </div>
                                                @endif
                                            </td>
                                        </tr>
                                                
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                @endif

            </div>
        </div>
        @if($estimacion != null)
            <div class="bg-gray-200 mt-5">
                <h2 class="font-bold text-lg text-center">Detalles de la estimación</h2>
            </div>

            <div class="mt-5 grid grid-cols-8 gap-4">
                <div class="{{$obra->anticipo_monto == 0?$estimacion->numero_estimacion == 1? 'col-span-1':'col-span-2':'col-span-2'}}">
                    <p class="text-sm font-semibold ">Número de estimación: </p>
                    <p class="ml-5 text-base font-bold mostrar_datos mt-2">{{$estimacion->numero_estimacion}}</p>
                </div>
                <div class="{{$obra->anticipo_monto == 0?$estimacion->numero_estimacion == 1? 'col-span-1':'col-span-2':'col-span-2'}}">
                    <p class="text-sm font-semibold text-center">¿Es finiquito? </p>
                    <div class="div-estado-proceso mt-2">
                        @if($estimacion->finiquito)
                            <div class="flex justify-center">
                                <img src="{{ asset('image/Bien.svg') }}" alt="Workflow">
                            </div>
                        @else
                            <div class="flex justify-center">
                                <img src="{{ asset('image/Mal.svg') }}" alt="Workflow">
                            </div>
                        @endif
                    </div>
                </div>
                @if($pagos_obra->fecha_pago != null)
                    <div class="col-span-2">
                        <p class="text-sm font-semibold">Folio de la factura: </p>
                        <p class="ml-5 text-base font-bold mostrar_datos">{{$estimacion->folio_factura}}</p>
                    </div>
                    @if($obra->anticipo_monto == 0 && $estimacion->numero_estimacion == 1)
                        <div class="col-span-2">
                            <p class="text-sm font-semibold ">Folio de fianza de cumplimiento: </p>
                            <p class="ml-5 text-base font-bold mostrar_datos mt-2">{{$obra_contrato->factura_anticipo}}</p>
                        </div>
                    @endif
                    @if($estimacion->finiquito == 1)
                        <div class="col-span-2">
                            <p class="text-sm font-semibold ">Folio de : </p>
                            <p class="ml-5 text-base font-bold mostrar_datos mt-2">{{$obra_contrato->factura_anticipo}}</p>
                        </div>
                    @endif
                    <div class="col-span-2">
                        <p class="text-sm font-semibold">Fecha de la estimación: </p>
                        <p class="ml-5 text-base font-bold mostrar_datos">{{$service->formatDate($estimacion->fecha_estimacion)}}</p>
                    </div>
                    <div class="col-span-2">
                        <p class="text-sm font-semibold ">Total de la estimación: </p>
                        <p class="ml-5 text-base font-bold mostrar_datos">{{$service->formatNumber($estimacion->total_estimacion)}}</p>
                    </div>
                    <div class="col-span-2">
                        <p class="text-sm font-semibold">Neto pagado: </p>
                        <p class="ml-5 text-base font-bold mostrar_datos">{{$service->formatNumber($estimacion->total_estimacion - $estimacion->supervicion_obra - $estimacion->mano_obra - $estimacion->cinco_millar - $estimacion->dos_millar - $estimacion->amortizacion_anticipo)}}</p>
                    </div>
                    
                @endif
                <div class="col-span-4">
                    <p class="text-base font-bold text-center">Periodo de la estimación</p>
                    <div class="grid grid-cols-4 gap-4">
                        
                        <div class="col-span-2">
                            <p class="text-base font-bold mostrar_datos text-center">{{$service->formatDate($estimacion->fecha_inicio)}}</p>
                            <p class="text-sm font-semibold text-center">Fecha inicial </p>
                        </div>
                        <div class="col-span-2">
                            <p class="text-base font-bold mostrar_datos text-center">{{$service->formatDate($estimacion->fecha_final)}}</p>
                            <p class="text-sm font-semibold text-center">Fecha final </p>
                        </div>
                        
                    </div>
                </div>
                @if($pagos_obra->fecha_pago != null)
                    <div class="col-span-8 border">
                        <p class="text-base font-bold text-center mt-2 mb-3">Retenciones y amortizaciones de la estimación </p>
                        <div class="grid grid-cols-9 gap-4 m-1">
                            
                            <div class="col-span-3">
                                <p class="text-base font-bold text-center">{{$service->formatNumber($estimacion->supervicion_obra)}}</p>
                                <p class="text-sm font-semibold text-center">Supervición de obra </p>
                            </div>
                            <div class="col-span-3">
                                
                                <p class="text-base font-bold text-center">{{$service->formatNumber($estimacion->mano_obra)}}</p>
                                <p class="text-sm font-semibold text-center">Mano de obra</p>
                            </div>
                            <div class="col-span-3">
                                <p class="text-base font-bold text-center">{{$service->formatNumber($estimacion->cinco_millar)}}</p>
                                <p class="text-sm font-semibold text-center">Cinco al millar</p>
                            </div>
                            <div class="col-span-3">
                                <p class="text-base font-bold text-center">{{$service->formatNumber($estimacion->dos_millar)}}</p>
                                <p class="text-sm font-semibold text-center">Dos al millar</p>
                            </div>
                            @if($obra->anticipo_monto > 0)
                                <div class="col-span-3">
                                    <p class="text-base font-bold text-center">{{$service->formatNumber($estimacion->amortizacion_anticipo)}}</p>
                                    <p class="text-sm font-semibold text-center">Amortización del anticipo</p>
                                </div>
                            @endif
                        </div>
                        
                    </div>
                    
                @endif
            </div>
        @endif
        @if($pagos_obra->nombre == 'Anticipo' && $pagos_obra->fecha_pago != null)
            <div class="bg-gray-200 mt-5">
                <h2 class="font-bold text-lg text-center">Detalles del anticipo</h2>
            </div>
            <div class="mt-5 grid grid-cols-8 gap-4">
                <div class="col-span-2">
                    <p class="text-sm font-semibold ">Monto anticipo: </p>
                    <p class="ml-5 text-base font-bold mostrar_datos mt-2">{{$service->formatNumber($obra->anticipo_monto)}}</p>
                </div>
                <div class="col-span-2">
                    <p class="text-sm font-semibold ">Folio de factura de anticipo: </p>
                    <p class="ml-5 text-base font-bold mostrar_datos mt-2">{{$obra_contrato->factura_anticipo}}</p>
                </div>
                <div class="col-span-2">
                    <p class="text-sm font-semibold ">Folio de fianza de anticipo: </p>
                    <p class="ml-5 text-base font-bold mostrar_datos mt-2">{{$obra_contrato->factura_anticipo}}</p>
                </div>
                <div class="col-span-2">
                    <p class="text-sm font-semibold ">Folio de fianza de cumplimiento: </p>
                    <p class="ml-5 text-base font-bold mostrar_datos mt-2">{{$obra_contrato->factura_anticipo}}</p>
                </div>
            </div>
        @endif
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
            Modificar proceso de validación del pago
          </h4>
          <button class="p-1 ml-auto bg-transparent border-0 text-black opacity-5 float-right text-3xl leading-none font-semibold outline-none focus:outline-none" onclick="toggleModal('modal')">
            <span class="bg-transparent text-black opacity-5 h-6 w-6 text-2xl block outline-none focus:outline-none">
              
            </span>
          </button>
        </div>
        <!--body-->
        <form action="{{ route('update_observacion') }}" method="POST" id="formulario_update_obs" name="formulario_update_obs">
          @csrf
          @method('POST')
        <div class="relative p-6 flex-auto">
            <div class="grid grid-cols-10 gap-4">
                <input type="text" name="id_observacion" id="id_observacion" maxlength="40" class="hidden mt-1 focus:ring-blue-800 focus:border-blue-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="">
                <div id="validado" class="col-span-10 text-center">
                    <input type="checkbox" id="validado" name="validado" >
                    <label for="validado" class="text-base font-semibold text-gray-700"> La documentación ha sido validada</label>
                </div> 
                <div id="div-obs-solv" class="col-span-10">
                    <div class="grid grid-cols-10 gab-4">
                        <div  id="div_observacion" class=" col-span-5">
                            <label for="fecha_observacion" class="block text-sm font-semibold text-gray-700">Fecha de observación*</label>
                            <div id="label_fecha_observacion" class="mt-1 py-2 px-3">
                                <label class="text-base font-bold text-gay-500" ></label>
                            </div>
                            <input type="date" name="fecha_observacion" id="fecha_observacion" min="" max="{{$obra->ejercicio + 1}}-03-31" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" >
                            <label id="error_fecha_observacion" class="hidden text-base font-normal text-red-500" >Ingrese una fecha valida</label>
                        </div>
                        <div id="div_solventacion" class="hidden col-span-5">
                            <label for="fecha_convenio" class="block text-sm font-semibold text-gray-700">Fecha de solventación*</label>
                            <div id="label_fecha_solventacion" class="mt-1 py-2 px-3">
                                <label class="text-base font-bold text-gay-500" ></label>
                            </div>
                            <input type="date" name="fecha_solventacion" id="fecha_solventacion" min="" max="{{$obra->ejercicio + 1}}-03-31" class="hidden mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" >
                            <label id="error_fecha_solventacion" class="hidden text-base font-normal text-red-500" >Ingrese una fecha valida</label>
                        </div>
                    </div>
                    
                </div>
                <div id="div_validacion" class="hidden col-span-5">
                    <label for="fecha_validacion" class="block text-sm font-semibold text-gray-700">Fecha de validación*</label>
                    <input type="date" name="fecha_validacion" id="fecha_validacion" min="" max="{{$obra->ejercicio + 1}}-03-31" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" >
                    <label id="error_fecha_validacion" class="hidden text-base font-normal text-red-500" >Ingrese una fecha valida</label>
                </div>
          </div>
          
        </div>
        <!--footer-->
        <div id="div_acciones" class=" p-4 border-t border-solid border-blueGray-200 rounded-b">
          
          <span class="block text-xs">Verifique los campos obligatorios marcados con un ( * ) </span>
          <div class="text-right">
          <button class="text-red-500 background-transparent font-bold uppercase px-6 py-2 text-sm outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="button" onclick="toggleModal_fechas('modal')">
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

<div class="hidden overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center" id="modal-update-fechas">
    <div class="relative w-auto my-6 mx-auto max-w-3xl">
      <!--content-->
      <div class="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none">
        <!--header-->
        <div class="flex items-start justify-between p-5 border-b border-solid border-blueGray-200 rounded-t">
            <h4 class="text-lg font-semibold">
                Modificar fechas del proceso de pago {{$pagos_obra->nombre == 'Anticipo'?'del': 'de la'}} {{$pagos_obra->nombre}}
            </h4>
            <button class="p-1 ml-auto bg-transparent border-0 text-black opacity-5 float-right text-3xl leading-none font-semibold outline-none focus:outline-none" onclick="toggleModal_fechas('modal-update-fechas')">
                <span class="bg-transparent text-black opacity-5 h-6 w-6 text-2xl block outline-none focus:outline-none">
                
                </span>
            </button>
        </div>
        <!--body-->
        <form action="{{ route('update_pagos') }}" method="POST" id="formulario_upt_pago" name="formulario_upt_pago">
          @csrf
          @method('POST')
        <div class="relative p-6 flex-auto">
            <div class="grid grid-cols-10 gap-4">
                <input type="text" name="id_pago" id="id_pago" maxlength="40" class="hidden mt-1 focus:ring-blue-800 focus:border-blue-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{$pagos_obra->id_desglose_pagos}}">
                <input type="text" name="id_obra" id="id_obra" maxlength="40" class="hidden mt-1 focus:ring-blue-800 focus:border-blue-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{$obra->id_obra}}">
                @if($pagos_obra->fecha_validacion == null && $pagos_obra->fecha_pago == null)
                    <div id="validado" class="col-span-10 text-center">
                        <input type="checkbox" id="pagado" name="pagado" >
                        <label for="pagado" class="text-base font-semibold text-red-500"> {{$pagos_obra->nombre == 'Anticipo'?'El': 'La'}} {{$pagos_obra->nombre}} ha sido {{$pagos_obra->nombre == 'Anticipo'?'pagado': 'pagada'}} sin validación de documentos.</label>
                    </div> 
                @endif

                @if($pagos_obra->fecha_recepcion != null)
                    <div class="col-span-5">
                        <label class="block text-sm font-semibold text-gray-700">Fecha de recepción de documentos*</label>
                        <div id="label_fecha_recepcion" class="mt-1 py-2 px-3">
                            <label class="text-base font-bold text-gay-500" >{{$service->formatDate($pagos_obra->fecha_recepcion)}}</label>
                        </div>
                    </div>
                @else
                    <div  id="div_recepcion" class="col-span-5">
                        <label class="block text-sm font-semibold text-gray-700">Fecha de recepción de documentos*</label>
                        <input type="date" name="fecha_recepcion" id="fecha_recepcion" min="{{$obra->fecha_inicio_programada}}" max="{{$obra->ejercicio + 1}}-03-31" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" >
                        <label id="error_fecha_recepcion" class="hidden text-base font-normal text-red-500" >Ingrese una fecha valida</label>    
                    </div>
                @endif

                @if($pagos_obra->fecha_validacion != null)
                    <div class="col-span-5">
                        <label for="fecha_validacion" class="block text-sm font-semibold text-gray-700">Fecha de validación de documentos*</label>
                        <div id="label_fecha_validacion" class="mt-1 py-2 px-3">
                            <label class="text-base font-bold text-gay-500" >{{$service->formatDate($pagos_obra->fecha_validacion)}}</label>
                        </div>
                    </div>
                @else
                    <div  id="div_validacion_edit" class="{{$pagos_obra->fecha_recepcion == null?'hidden':''}} col-span-5">
                        <label for="fecha_pago" class="block text-sm font-semibold text-gray-700">Fecha de pago {{$pagos_obra->nombre == 'Anticipo'?'del': 'de la'}} {{$pagos_obra->nombre}}*</label>
                        <input type="date" name="fecha_validacion_edit" id="fecha_validacion_edit" min="{{$pagos_obra->fecha_recepcion}}" max="{{$obra->ejercicio + 1}}-03-31" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" >
                        <label id="error_fecha_validacion_edit" class="hidden text-base font-normal text-red-500" >Ingrese una fecha valida</label>    
                    </div>
                @endif

                @if($pagos_obra->fecha_pago != null)
                    <div class="col-span-5">
                        <label for="fecha_validacion" class="block text-sm font-semibold text-gray-700">Fecha de validación de documentos*</label>
                        <div id="label_fecha_pago" class="mt-1 py-2 px-3">
                            <label class="text-base font-bold text-gay-500" >{{$service->formatDate($pagos_obra->fecha_pago)}}</label>
                        </div>
                    </div>
                @else
                    <div  class="{{$pagos_obra->fecha_validacion == null?'hidden':''}} col-span-10 sm:col-span-5 div_pago">
                        <label for="fecha_pago" class="block text-sm font-semibold text-gray-700">Fecha de pago {{$pagos_obra->nombre == 'Anticipo'?'del': 'de la'}} {{$pagos_obra->nombre}}*</label>
                        <input type="date" name="fecha_pago" id="fecha_pago" min="{{$pagos_obra->fecha_recepcion}}" max="{{$obra->ejercicio + 1}}-03-31" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" >
                        <label id="error_fecha_pago" class="hidden text-base font-normal text-red-500" >Ingrese una fecha valida</label>    
                    </div>

                    @if($estimacion != null)
                        <div class="{{$pagos_obra->fecha_validacion == null?'hidden':''}} col-span-10 sm:col-span-5 div_pago">
                            <label id="label_monto_modificado" for="label_monto_modificado" class="block text-sm font-bold text-gray-700">Total de la estimación*</label>
                            <div class="relative ">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-700 text-base">
                                $
                                </span>
                            </div>
                            <input type="text" name="total_estimacion" id="total_estimacion" maxlength="20" class="pl-7  mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" placeholder="0.00">
                            </div>
                            <label id="monto_iva" name="monto_iva" class="text-base font-semibold text-gray-700" ></label><br>
                            <label id="error_total_estimacion" name="error_total_estimacion" class="hidden text-base font-normal text-red-500" >El monto de la estimación es mayor al monto restante de la obra.</label>
                            <label id="error_total_estimacion_1" name="error_total_estimacion_1" class="hidden text-base font-normal text-red-500" >Ingrese un monto de la estimación valido.</label>
                        </div>
                        <div class="{{$pagos_obra->fecha_validacion == null?'hidden':''}} col-span-10 div_pago">
                            <div class="mb-5 text-center">
                                <label id="error_retenciones" name="error_retenciones" class="hidden text-base font-normal text-red-500 text-center font-bold" >El total de rentenciones es mayor que el monto de la estimación.</label>
                            </div>
                            <label for="ejecucion" class="block text-sm font-bold text-gray-700 text-center">Retenciones</label>
                            <div class="grid grid-cols-4 gap-4">
                                <div class="col-span-4 sm:col-span-2">
                                    <div class="relative ">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <span class="text-gray-700 text-base">
                                            $
                                            </span>
                                        </div>
                                        <input type="text" name="supervicion_obra" id="supervicion_obra" maxlength="20" class="pl-7  mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" placeholder="0.00">
                                    </div>
                                    <label for="supervicion_obra" class="block text-sm font-semibold text-gray-700 text-center">Supervición de obra</label>
                                    <label id="error_supervicion_obra" name="error_supervicion_obra" class="hidden text-base font-normal text-red-500" >El total de la retención es mayor que el monto de la estimación.</label>
                                    <label id="error_supervicion_obra_1" name="error_supervicion_obra_1" class="hidden text-base font-normal text-red-500" >Ingrese un monto de supervisión de obra valido.</label>
                                </div>
                                <div class="col-span-4 sm:col-span-2">
                                    
                                    <div class="relative ">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <span class="text-gray-700 text-base">
                                            $
                                            </span>
                                        </div>
                                        <input type="text" name="mano_obra" id="mano_obra" maxlength="20" class="pl-7  mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" placeholder="0.00">
                                    </div>
                                    <label for="mano_obra" class="block text-sm font-semibold text-gray-700 text-center">Mano de obra</label>
                                    <label id="error_mano_obra" name="error_mano_obra" class="hidden text-base font-normal text-red-500" >El total de la retención es mayor que el monto de la estimación.</label>
                                    <label id="error_mano_obra_1" name="error_mano_obra_1" class="hidden text-base font-normal text-red-500" >Ingrese un monto de mano de obra valido.</label>
                                </div>
                                <div class="col-span-4 sm:col-span-2">
                                    <div class="relative ">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <span class="text-gray-700 text-base">
                                            $
                                            </span>
                                        </div>
                                        <input type="text" name="cinco_millar" id="cinco_millar" maxlength="20" class="pl-7  mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" placeholder="0.00">
                                    </div>
                                    <label for="cinco_millar" class="block text-sm font-semibold text-gray-700 text-center">Cinco al millar</label>
                                    <label id="error_cinco_millar" name="error_cinco_millar" class="hidden text-base font-normal text-red-500" >El monto a modificar es mayor que el ejercicido</label>
                                    <label id="error_cinco_millar_1" name="error_cinco_millar_1" class="hidden text-base font-normal text-red-500" >Ingrese un monto de cinco al millar valido.</label>
                                </div>
                                <div class="col-span-4 sm:col-span-2">                            
                                    <div class="relative ">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <span class="text-gray-700 text-base">
                                            $
                                            </span>
                                        </div>
                                        <input type="text" name="dos_millar" id="dos_millar" maxlength="20" class="pl-7  mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" placeholder="0.00">
                                    </div>
                                    <label for="dos_millar" class="block text-sm font-semibold text-gray-700 text-center">Dos al millar</label>
                                    <label id="error_dos_millar" name="error_dos_millar" class="hidden text-base font-normal text-red-500" >El monto a modificar es mayor que el ejercicido</label>
                                    <label id="error_dos_millar_1" name="error_dos_millar_1" class="hidden text-base font-normal text-red-500" >Ingrese un monto de dos al millar valido.</label>
                                </div>
                            </div>
                        </div>

                        @if($obra->anticipo_monto > 0)
                            <div class="{{$pagos_obra->fecha_validacion == null?'hidden':''}} col-span-10 sm:col-span-5 div_pago">  
                                <label id="label_monto_modificado" for="label_monto_modificado" class="block text-sm font-bold text-gray-700">Amortización del anticipo*</label>
                                <div class="relative ">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <span class="text-gray-700 text-base">
                                        $
                                        </span>
                                    </div>
                                    <input type="text" name="amortizacion_anticipo" id="amortizacion_anticipo" maxlength="20" class="pl-7  mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" placeholder="0.00">
                                </div>
                                <label id="error_amortizacion_anticipo" name="error_amortizacion_anticipo" class="hidden text-base font-normal text-red-500" >El monto a modificar es mayor que el ejercicido</label>
                                <label id="error_amortizacion_anticipo_so" name="error_amortizacion_anticipo_so" class="hidden text-base font-normal text-red-500" >El monto excede el restante por amortizar {{$service->formatNumber( $obra->anticipo_monto-$total_pagado->total_anticipo)}}.</label>
                                <label id="error_amortizacion_anticipo_1" name="error_amortizacion_anticipo_1" class="hidden text-base font-normal text-red-500" >Ingrese un monto de amortización de anticipo valido.</label>
                            </div>
                        @endif
                        @if($obra->anticipo_monto == 0 && $estimacion->numero_estimacion == 1)
                            <div class="{{$pagos_obra->fecha_validacion == null?'hidden':''}} col-span-10 sm:col-span-5 div_pago">
                                <label  id="label_folio_fianza_cumplimiento" class="block text-sm font-bold text-gray-700">Folio de fianza de cumplimiento:</label>
                                <input type="text" name="folio_fianza_cumplimiento" id="folio_fianza_cumplimiento" maxlength="36" class="mt-1 focus:ring-blue-800 focus:border-blue-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ old('oficio_notificacion') }}">
                                <label id="error_folio_fianza_cumplimiento" name="error_folio_fianza_cumplimiento" class="hidden text-base font-normal text-red-500" >Ingrese un folio de fianza valido.</label>
                            </div>
                        @endif
                        <div class="{{$pagos_obra->fecha_validacion == null?'hidden':''}} col-span-10 sm:col-span-5 div_pago">
                            <label  id="label_folio_factura" for="cliente_id" class="block text-sm font-bold text-gray-700">Folio de factura de la estimación:</label>
                            <input type="text" name="folio_factura" id="folio_factura" maxlength="36" class="mt-1 focus:ring-blue-800 focus:border-blue-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ old('oficio_notificacion') }}">
                            <label id="error_folio_factura" name="error_folio_factura" class="hidden text-base font-normal text-red-500" >Ingrese un folio de factura valido.</label>
                        </div>

                        <div class="{{$pagos_obra->fecha_validacion == null?'hidden':''}} col-span-10 div_pago">
                            <label for="ejecucion" class="block text-sm font-bold text-gray-700 text-center">Neto a pagar</label>
                            <label id="label_monto_neto" class="block text-base font-medium text-gray-700 py-3 px-2 text-center">$ 0.00</label>
                            <div id="div_error_guardar" class="hidden mx-10 text-center">
                                <label  class="text-base font-normal text-red-500 text-center font-bold" >El neto a pagar no puede ser menos a cero.</label>
                            </div>
                        </div>
                    @endif
                    @if($pagos_obra->nombre == 'Anticipo')
                        <div class="{{$pagos_obra->fecha_validacion == null?'hidden':''}} col-span-10 sm:col-span-5 div_pago">
                            <label  id="label_folio_factura_anticipo" class="block text-sm font-bold text-gray-700">Folio de factura del anticipo:</label>
                            <input type="text" name="folio_factura_anticipo" id="folio_factura_anticipo" maxlength="36" class="mt-1 focus:ring-blue-800 focus:border-blue-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ old('oficio_notificacion') }}">
                            <label id="error_folio_factura_anticipo" name="error_folio_factura_anticipo" class="hidden text-base font-normal text-red-500" >Ingrese un folio de factura valido.</label>
                        </div>
                        <div class="{{$pagos_obra->fecha_validacion == null?'hidden':''}} col-span-10 sm:col-span-5 div_pago">
                            <label  id="label_folio_fianza_anticipo" for="cliente_id" class="block text-sm font-bold text-gray-700">Folio de fianza del anticipo:</label>
                            <input type="text" name="folio_fianza_anticipo" id="folio_fianza_anticipo" maxlength="36" class="mt-1 focus:ring-blue-800 focus:border-blue-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ old('oficio_notificacion') }}">
                            <label id="error_folio_fianza_anticipo" name="error_folio_fianza_anticipo" class="hidden text-base font-normal text-red-500" >Ingrese un folio de fianza valido.</label>
                        </div>
                        <div class="{{$pagos_obra->fecha_validacion == null?'hidden':''}} col-span-10 sm:col-span-5 div_pago">
                            <label  id="label_folio_fianza_cumplimiento" class="block text-sm font-bold text-gray-700">Folio de fianza de cumplimiento:</label>
                            <input type="text" name="folio_fianza_cumplimiento" id="folio_fianza_cumplimiento" maxlength="36" class="mt-1 focus:ring-blue-800 focus:border-blue-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ old('oficio_notificacion') }}">
                            <label id="error_folio_fianza_cumplimiento" name="error_folio_fianza_cumplimiento" class="hidden text-base font-normal text-red-500" >Ingrese un folio de fianza valido.</label>
                        </div>
                    @endif
                @endif
                  
          </div>
          
        </div>
        <!--footer-->
        <div id="div_acciones" class=" p-4 border-t border-solid border-blueGray-200 rounded-b">
          
          <span class="block text-xs">Verifique los campos obligatorios marcados con un ( * ) </span>
          <div class="text-right">
          <button class="text-red-500 background-transparent font-bold uppercase px-6 py-2 text-sm outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="button" onclick="toggleModal_fechas('modal-update-fechas')">
            Cancelar
          </button>
          <button type="submit" id="guardar_pago" class="bg-green-500 text-white active:bg-green-600 font-bold uppercase text-sm px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" >
            Guardar
          </button>
          </div>
        </div>
        </form>
      </div>
    </div>
</div>


<div class="hidden opacity-25 fixed inset-0 z-40 bg-black" id="modal-backdrop"></div>
<div class="hidden opacity-25 fixed inset-0 z-40 bg-black" id="modal-update-fechas-backdrop"></div>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('js/dataTables.responsive.min.js') }}"></script>
  <script src="https://unpkg.com/@popperjs/core@2.9.1/dist/umd/popper.min.js" charset="utf-8"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script> 

<script>

    function toggleModal(modalID, observaciones, fecha_incial, fecha_observacion, fecha_solventacion){
        document.getElementById(modalID).classList.toggle("hidden");
        document.getElementById(modalID + "-backdrop").classList.toggle("hidden");
    
        $("#id_observacion").val(observaciones.id_observaciones_desglose);
        console.log(fecha_incial);
        if(observaciones.fecha_observaciones != null){
            
            $("#fecha_observacion").addClass("hidden");
            $("#label_fecha_observacion").removeClass("hidden");
            $("#label_fecha_observacion label").html(fecha_observacion);
            $("#div_solventacion").removeClass("hidden");
            $("#fecha_solventacion").removeClass("hidden");
        }else{
            $("#fecha_observacion, #fecha_validacion").attr("min",fecha_incial);
            $("#fecha_observacion").removeClass("hidden");
            $("#label_fecha_observacion").addClass("hidden");
        }

        if(observaciones.fecha_solventacion != null){
            
            $("#fecha_solventacion").addClass("hidden");
            $("#label_fecha_solventacion").removeClass("hidden");
            $("#label_fecha_solventacion label").html(fecha_solventacion);
            $("#validado").addClass("hidden");
        }else{
            $("#fecha_solventacion, #fecha_validacion").attr('min',observaciones.fecha_observaciones);
            $("#fecha_solventacion").removeClass("hidden");
            $("#label_fecha_solventacion").addClass("hidden");
        }

    }
    function toggleModal_fechas(modalID){
        document.getElementById(modalID).classList.toggle("hidden");
        document.getElementById(modalID + "-backdrop").classList.toggle("hidden");


    }

    $(document).ready(function() {

        // Comprobar cuando cambia un checkbox
        $('input[type=checkbox]').on('change', function() {
            if($(this).prop("id") == "validado"){
                if ($(this).is(':checked') ) {
                    $("#div-obs-solv").addClass("hidden");
                    $("#div_validacion").removeClass("hidden");
                } else {
                    $("#div-obs-solv").removeClass("hidden");
                    $("#div_validacion").addClass("hidden");
                }
            }
            if($(this).prop("id") == "pagado"){
                
                if ($(this).is(':checked') ) {
                    console.log("Check")
                    $(".div_pago").removeClass("hidden");
                } else {
                    console.log("no check")
                    $(".div_pago").addClass("hidden");
                }
            }
        });
        $("#fecha_recepcion").change(function() {
            console.log("hola "+$(this).val());
            if($(this).val()!=''){
                console.log("hola mundo");
                $("#fecha_validacion_edit").attr("min", $(this).val());
                $("#div_validacion_edit").removeClass("hidden");
            }else{
                $("#div_validacion_edit").addClass("hidden");
            }
        });
        $("#fecha_validacion_edit").change(function() {
            console.log($(this).val())
            if($(this).val()!=''){
                $("#fecha_pago").attr("min", $(this).val());
                $(".div_pago").removeClass("hidden");
            }else{
                $(".div_pago").addClass("hidden");
            }
        });


        console.log("{{count($observaciones)}}");
                $('.table_estimacion').DataTable({
                    "autoWidth": true,
                    "responsive": true,
                    "bFilter": false,
                    "bPaginate": false,
                    "bInfo": false,
                    columnDefs: [{
                            responsivePriority: 1,
                            targets: 2
                        },
                        {
                            responsivePriority: 1,
                            targets: 1
                        },
                        {
                            responsivePriority: 10001,
                            targets: 2
                        },
                        {
                            responsivePriority: 2,
                            targets: -2
                        }
                    ],
                    order: [[ 0 , 'asc' ]],
                    language: {
                        url: 'https://cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json'
                    }
                })
                .columns.adjust();
        $("#guardar").click(function () {  
            fecha_pago = '{{$pagos_obra->fecha_recepcion}}';
            estado = false;
            
            if($("#fecha_observacion").val() == '' && $("#fecha_observacion").hasClass("hidden") && $("#div_validacion").hasClass("hidden") || $("#div_observacion").hasClass("hidden")){
                estado = true;
            }else{
                if($("#fecha_observacion").val() != ''){  
                    estado = true;
                }else{
                    estado = false;
                    $("#error_fecha_observacion").removeClass("hidden");
                }
            }
            if($("#fecha_solventacion").val() == '' && $("#fecha_solventacion").hasClass("hidden") && $("#div_validacion").hasClass("hidden") || $("#div_solventacion").hasClass("hidden")){
                    estado = true;
            }else{
                if($("#fecha_solventacion").val() != ''){  
                    estado = true;
                }else{
                    estado = false;
                    $("#error_fecha_solventacion").removeClass("hidden");
                }
                estado = false;
                
            }
            if(!$("#fecha_validacion").hasClass("hidden") && $("#fecha_validacion").val() != '' || $("#div_validacion").hasClass("hidden")){
                estado = true;
            }else{
                estado = false;
                $("#error_fecha_validacion").removeClass("hidden");
            }
            return estado;      
            /*monto = $("#label_monto_neto").html();

            if(monto.indexOf('-') > -1){
                console.log("ejemplo");
                $("#div_error_guardar").removeClass("hidden");
                return false;
            }else {
                $("#div_error_guardar").addClass("hidden");
                return true;
            }*/
        });

        $("#guardar_pago").click(function () {
            var sin_error = true;

            if($("#fecha_validacion_edit").length == 0 || $("#fecha_pago").val() != ''){
                if($("#fecha_pago").length > 0 && $("#fecha_pago").val() == '' && !$("#fecha_pago").hasClass("hidden")){
                    $("#error_fecha_pago").removeClass("hidden");
                    sin_error = false;
                }else
                    $("#error_fecha_pago").addClass("hidden");

                if($("#total_estimacion").length > 0 && $("#total_estimacion").val() == ''){
                    $("#error_total_estimacion_1").removeClass("hidden");
                    sin_error = false;
                }else
                    $("#error_total_estimacion_1").addClass("hidden");

                if($("#supervicion_obra").length > 0 && $("#supervicion_obra").val() == ''){
                    $("#error_supervicion_obra_1").removeClass("hidden");
                    sin_error = false;
                }else
                    $("#error_supervicion_obra_1").addClass("hidden");

                if($("#mano_obra").length > 0 && $("#mano_obra").val() == ''){
                    $("#error_mano_obra_1").removeClass("hidden");
                    sin_error = false;
                }else
                    $("#error_mano_obra_1").addClass("hidden");

                if($("#cinco_millar").length > 0 && $("#cinco_millar").val() == ''){
                    $("#error_cinco_millar_1").removeClass("hidden");
                    sin_error = false;
                }else
                    $("#error_cinco_millar_1").addClass("hidden");

                if($("#dos_millar").length > 0 && $("#dos_millar").val() == ''){
                    $("#error_dos_millar_1").removeClass("hidden");
                    sin_error = false;
                }else
                    $("#error_dos_millar_1").addClass("hidden");

                if($("#amortizacion_anticipo").length > 0 && $("#amortizacion_anticipo").val() == ''){
                    $("#error_amortizacion_anticipo_1").removeClass("hidden");
                    sin_error = false;
                }else{
                    if($("#amortizacion_anticipo").length > 0) {
                        monto_amortizacion = $("#amortizacion_anticipo").val();
                        monto_amortizacion = monto_amortizacion.replaceAll(",", "");
                        falta_amortizar = {{$obra->anticipo_monto - $total_pagado->total_anticipo }};
                        if(monto_amortizacion > falta_amortizar ){
                            $("#error_amortizacion_anticipo_so").removeClass("hidden");
                            sin_error = false;
                        }else{
                            $("#error_amortizacion_anticipo_so").addClass("hidden");
                        }
                    }
                    $("#error_amortizacion_anticipo_1").addClass("hidden");
                }

                if($("#folio_factura").length > 0 && $("#folio_factura").val() == ''){
                    $("#error_folio_factura").removeClass("hidden");
                    sin_error = false;
                } else
                    $("#error_folio_factura").addClass("hidden");

                if($("#folio_factura_anticipo").length > 0 && $("#folio_factura_anticipo").val() == ''){
                    console.log("hola");
                    $("#error_folio_factura_anticipo").removeClass("hidden");
                    sin_error = false;
                } else
                    $("#error_folio_factura_anticipo").addClass("hidden");

                if($("#folio_fianza_anticipo").length > 0 && $("#folio_fianza_anticipo").val() == ''){
                    $("#error_folio_fianza_anticipo").removeClass("hidden");
                    sin_error = false;
                } else
                    $("#error_folio_fianza_anticipo").addClass("hidden");
                
                if($("#folio_fianza_cumplimiento").length > 0 && $("#folio_fianza_cumplimiento").val() == ''){
                    $("#error_folio_fianza_cumplimiento").removeClass("hidden");
                    sin_error = false;
                } else
                    $("#error_folio_fianza_cumplimiento").addClass("hidden");

                if($("#error_total_estimacion").length > 0 && !$("#error_total_estimacion").hasClass("hidden"))
                    sin_error = false;
            }  
            
            if($("#pagado").is(":checked")){
                if($("#fecha_pago").val() == ''){
                    $("#error_fecha_pago").removeClass("hidden");
                    sin_error = false;
                }
                else{
                    $("#error_fecha_pago").addClass("hidden");
                }
            }
            if($("#label_monto_neto").length > 0){
                monto = $("#label_monto_neto").html();

                if(monto.indexOf('-') > -1){
                    $("#div_error_guardar").removeClass("hidden");
                    sin_error = false;
                }else {
                    $("#div_error_guardar").addClass("hidden");
                }
            }

            return sin_error;

            
        });

        //metodos para modificar la estimacion
        $("#total_estimacion").on({
            "focus": function(event) {
                $(event.target).select();
            },
            "keyup": function(event) {
                $(event.target).val(function(index, value) {
                    return value.replace(/\D/g, "")
                        .replace(/([0-9])([0-9]{2})$/, '$1.$2')
                        .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ",");
                });

                monto_estimacion = $(this).val();
                monto_est = monto_estimacion.replaceAll(",", "");
                console.log()
                monto_restante = {{$obra->monto_modificado?$obra->monto_modificado:$obra->monto_contratado}} - {{$total_pagado->total_estimaciones?$total_pagado->total_estimaciones:0}};
                monto_sin_iva = monto_est / 1.16;
                monto_sin_iva = parseFloat(monto_sin_iva).toFixed(2);

                $("#monto_iva").html("Monto sin iva: "+("" + monto_sin_iva).replace(/\D/g, "").replace(/([0-9])([0-9]{2})$/, '$1.$2').replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ","))
                

                if (monto_est > monto_restante){
                    $("#error_total_estimacion").removeClass("hidden");
                    $("#error_total_estimacion").html("El monto de la estimación es mayor al monto restante: $ "+("" + monto_restante).replace(/\D/g, "").replace(/([0-9])([0-9]{2})$/, '$1.$2').replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ","))
                    $("#label_monto_neto").html("$ 0.00");
                }else{
                    $("#error_total_estimacion").addClass("hidden");

                    monto_supervicion = $("#supervicion_obra").val();
                    monto_supervicion = monto_supervicion.replaceAll(",", "");

                    monto_mano = $("#mano_obra").val();
                    monto_mano = monto_mano.replaceAll(",", "");

                    monto_dos = $("#dos_millar").val();
                    monto_dos = monto_dos.replaceAll(",", "");

                    monto_cinco = $("#cinco_millar").val();
                    monto_cinco = monto_cinco.replaceAll(",", "");

                    monto_amortizacion = $("#amortizacion_anticipo").val();
                    monto_amortizacion = monto_amortizacion.replaceAll(",", "");

                    monto_total = monto_est - monto_supervicion - monto_mano - monto_dos - monto_cinco - monto_amortizacion;
                    monto_total = parseFloat(monto_total).toFixed(2);

                    if(monto_total < 0 ){
                        $("#error_retenciones").removeClass("hidden");
                        $("#label_monto_neto").html("$ -"+("" + monto_total).replace(/\D/g, "").replace(/([0-9])([0-9]{2})$/, '$1.$2').replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ","));
                        $("#label_monto_neto").removeClass("text-gray-700");
                        $("#label_monto_neto").addClass("text-red-500");
                    }else {
                        $("#error_retenciones").addClass("hidden");
                        $("#label_monto_neto").html("$ "+("" + monto_total).replace(/\D/g, "").replace(/([0-9])([0-9]{2})$/, '$1.$2').replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ","));
                        $("#label_monto_neto").addClass("text-gray-700");
                        $("#label_monto_neto").removeClass("text-red-500");
                         
                    }
                }

                if(monto_estimacion.length == 0) {
                    $("#label_monto_neto").html("$ 0.00");
                }
            }
        });

        $("#supervicion_obra, #mano_obra, #dos_millar, #cinco_millar, #amortizacion_anticipo").on({
            "focus": function(event) {
                $(event.target).select();
            },
            "keyup": function(event) {
                $(event.target).val(function(index, value) {
                    return value.replace(/\D/g, "")
                        .replace(/([0-9])([0-9]{2})$/, '$1.$2')
                        .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ",");
                });
                monto_supervicion = $("#supervicion_obra").val();
                monto_supervicion = monto_supervicion.replaceAll(",", "");

                monto_mano = $("#mano_obra").val();
                monto_mano = monto_mano.replaceAll(",", "");

                monto_dos = $("#dos_millar").val();
                monto_dos = monto_dos.replaceAll(",", "");

                monto_cinco = $("#cinco_millar").val();
                monto_cinco = monto_cinco.replaceAll(",", "");

                monto_amortizacion = $("#amortizacion_anticipo").val();
                monto_amortizacion = monto_amortizacion.replaceAll(",", "");

                monto_estimacion = $("#total_estimacion").val();
                monto_est = monto_estimacion.replaceAll(",", "");
                monto_total = monto_est - monto_supervicion - monto_mano - monto_dos - monto_cinco - monto_amortizacion;
                monto_total = parseFloat(monto_total).toFixed(2);
                if(monto_total < 0 ){
                    $("#error_retenciones").removeClass("hidden");
                    $("#label_monto_neto").html("$ -"+("" + monto_total).replace(/\D/g, "").replace(/([0-9])([0-9]{2})$/, '$1.$2').replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ","));
                    $("#label_monto_neto").removeClass("text-gray-700");
                    $("#label_monto_neto").addClass("text-red-500");
                }else {
                    $("#error_retenciones").addClass("hidden");
                    $("#label_monto_neto").html("$ "+("" + monto_total).replace(/\D/g, "").replace(/([0-9])([0-9]{2})$/, '$1.$2').replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ","));
                    $("#label_monto_neto").addClass("text-gray-700");
                    $("#label_monto_neto").removeClass("text-red-500");
                    $("#div_error_guardar").addClass("hidden");
                }
            }
        });

        $("#supervicion_obra, #mano_obra, #dos_millar, #cinco_millar").on({
            "focus": function(event) {
                $(event.target).select();
            },
            "keyup": function(event) {
                $(event.target).val(function(index, value) {
                    return value.replace(/\D/g, "")
                        .replace(/([0-9])([0-9]{2})$/, '$1.$2')
                        .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ",");
                });
                monto_supervicion = $("#supervicion_obra").val();
                monto_supervicion = monto_supervicion.replaceAll(",", "");

                monto_mano = $("#mano_obra").val();
                monto_mano = monto_mano.replaceAll(",", "");

                monto_dos = $("#dos_millar").val();
                monto_dos = monto_dos.replaceAll(",", "");

                monto_cinco = $("#cinco_millar").val();
                monto_cinco = monto_cinco.replaceAll(",", "");

                monto_amortizacion = $("#amortizacion_anticipo").val();
                monto_amortizacion = monto_amortizacion.replaceAll(",", "");

                monto_estimacion = $("#total_estimacion").val();
                monto_est = monto_estimacion.replaceAll(",", "");

                monto_total = monto_est - monto_supervicion - monto_mano - monto_dos - monto_cinco - monto_amortizacion;
                monto_total = parseFloat(monto_total).toFixed(2);
                if(monto_total < 0 ){
                    $("#error_retenciones").removeClass("hidden");
                    $("#label_monto_neto").html("$ -"+("" + monto_total).replace(/\D/g, "").replace(/([0-9])([0-9]{2})$/, '$1.$2').replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ","));
                    $("#label_monto_neto").removeClass("text-gray-700");
                    $("#label_monto_neto").addClass("text-red-500");
                }else {
                    $("#error_retenciones").addClass("hidden");
                    $("#label_monto_neto").html("$ "+("" + monto_total).replace(/\D/g, "").replace(/([0-9])([0-9]{2})$/, '$1.$2').replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ","));
                    $("#label_monto_neto").addClass("text-gray-700");
                    $("#label_monto_neto").removeClass("text-red-500");
                    $("#div_error_guardar").addClass("hidden");
                }
            }
        });

        $("#amortizacion_anticipo").on({
            "focus": function(event) {
                $(event.target).select();
            },
            "keyup": function(event) {
                

                monto_amortizacion = $("#amortizacion_anticipo").val();
                monto_amortizacion = monto_amortizacion.replaceAll(",", "");
                falta_amortizar = {{$obra->anticipo_monto - $total_pagado->total_anticipo }};

                
                if(monto_amortizacion > falta_amortizar ){
                    $("#error_amortizacion_anticipo_so").removeClass("hidden");
                }else{
                    $("#error_amortizacion_anticipo_so").addClass("hidden");
                }
            }
        });
    
            
    });
</script>


@endsection