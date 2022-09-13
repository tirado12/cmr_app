@extends('layouts.plantilla')
@inject('service', 'App\Http\Controllers\ObraController')
@section('title', 'Editar ')
@section('contenido')

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
    <script lenguage="javascript">
        function estado_tabs(){
            console.log("hola");
            $(".tab_content").hide(); //Hide all content
            $("ul.tabs li:first").addClass("active").show(); //Activate first tab
            $(".tab_content:first").show(); //Show first tab content
            
            console.log("fin");
        }
    </script>

<div class="flex flex-row mb-4">
    <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
    </svg>
    <h1 class="font-bold text-xl ml-2">Mostrar Obra</h1>
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
    <div class="mt-6 contenedor p-8 shadow-2xl bg-white rounded-lg">
        
        <div class="bg-gray-200 mt-5">
            <h2 class="font-bold text-lg text-center">Datos generales de la obra</h2>
        </div>
        
        <div class="mt-5 grid grid-cols-9 gap-4">
            <div class="col-span-9">
                <p class="font-bold">{{ $obj_obra->get('obra')->nombre_obra }}</p>
            </div>
            <div class="col-span-2">
                <label for="first_name" class="block text-sm  font-bold text-gray-700">Núm. de obra</label>
                <label id="numero_obra" name="numero_obra" class="block text-base font-bold text-gray-700 py-3 px-5 ">{{str_pad($obj_obra->get('obra')->numero_obra,3,"0",STR_PAD_LEFT)}}</label>
            </div>
            <div class="col-span-7">
                <p class="text-sm font-semibold">Nombre corto: <br><span class="ml-5 text-base font-bold mostrar_datos">{{ $obj_obra->get('obra')->nombre_corto_obra}}</span></p>
                <form action="{{ route('update_obra') }}" method="POST" accept-charset="UTF-8" enctype="multipart/form-data" id="formulario_nc" class="hidden ml-5">
                    @csrf
                    @method('POST')
                    <div class="relative flex-auto">
                        <div id="datos_generales">
                            <div class="grid grid-cols-8">
                                <div class="col-span-8">
                                    <input type="text" maxlength="100" name="nombre_corto" id="nombre_corto" autocomplete="nombre_corto" class="mt-1 focus:ring-blue-800 focus:border-blue-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ $obj_obra->get('obra')->nombre_corto_obra}}">
                                    <label id="error_nombre_corto" name="error_nombre_obra" class="hidden text-base font-normal text-red-500" >Ingrese un nombre corto de obra correcto</label>  
                                    <input type="number" name="obra_id" class="hidden mt-1 focus:ring-blue-800 focus:border-blue-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ $obj_obra->get('obra')->id_obra}}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--footer-->
                    <div class="rounded-b">
                        <div class="text-left">
                            <button type="button" class="text-red-500 background-transparent font-semibold  text-sm outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" onclick="ocultar_edicion()">
                                Cancelar
                            </button>
                            <button id="guardar_btn" type="submit" class="bg-transparent text-green-500  font-semibold text-sm rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150">
                                Guardar
                            </button>
                        </div>
                    </div>
                </form>
                <div class="mostrar_datos col-span-9 flex justify-left ml-5">
                    <button type="button" class="text-sm text-blue-500 underline background-transparent font-semibold outline-none focus:outline-none ease-linear transition-all duration-150" onclick="mostrar_edicion()">
                        Editar nombre corto
                    </button>
                    
                </div>
            </div>
            <div class="col-span-9 sm:col-span-3">
                <p class="text-sm font-semibold">Localidad <br><span class="ml-5 text-base font-bold">{{ $obj_obra->get('obra')->nombre_localidad }}</span></p>
            </div>
            <div class="col-span-9 sm:col-span-2">
                <p class="text-sm font-semibold">Municipio <br><span class="ml-5 text-base font-bold">{{ $obj_obra->get('obra')->nombre_municipio }}</span></p>
            </div>
            <div class="col-span-9 sm:col-span-2">
                <p class="text-sm font-semibold">Distrito <br><span class="ml-5 text-base font-bold">{{ $obj_obra->get('obra')->nombre_distrito }}</span></p>
            </div>
            <div class="col-span-9 sm:col-span-2">
                <p class="text-sm font-semibold">Estado <br><span class="ml-5 text-base font-bold">{{ $obj_obra->get('obra')->nombre_estado }}</span></p>
            </div>
            <!--<div class="sm:col-span-3">
                <p class="text-sm font-semibold">Región <br><span class="ml-5 text-base font-bold">{{ $obj_obra->get('obra')->nombre_region }}</span></p>
            </div>
            -->
            <div class="col-span-9 sm:col-span-3">
                <p class="text-sm"> <span class="font-semibold">Oficio de notificación</span><br>
                    <span class="ml-5">Número: <span class="text-base font-bold">{{ $obj_obra->get('obra')->oficio_notificacion }}</span></span><br>
                    <span class="ml-5">Fecha: <span class="text-base font-bold">{{ date('d-m-Y', strtotime($obj_obra->get('obra')->fecha_oficio_notificacion)) }}</span></span>
                </p>
            </div>

            <div class="col-span-9 sm:col-span-3">
                <p class="text-sm font-semibold">Monto de la obra<br><span class="ml-5 text-base font-bold">{{ $service->formatNumber($obj_obra->get('obra')->monto_contratado) }}</span></p>
                @if($obj_obra->get('obra')->modalidad_ejecucion == 1)
                    <p class="text-sm font-semibold">Monto ejercicido<br><span class="ml-5 text-base font-bold">{{ $service->formatNumber($total_admin) }}</span></p>
                @endif
                @if($obj_obra->get('obra')->monto_modificado != null)
                    <p class="text-sm font-semibold">Monto modificado: <br><span class="ml-5 text-base font-bold">{{ $service->formatNumber($obj_obra->get('obra')->monto_modificado) }}</span></p>
                @endif
            </div>
            
            <div class="col-span-9 sm:col-span-3">
                <p class="text-sm font-semibold">Fuente de financiamiento </p>
                <table id="example1" class="ml-5 table table-striped bg-white" style="width:100%;">
                    <tbody>
                        @foreach ($fuentes_financiamiento as $fuente)
                            <tr>
                                <td>
                                    <div class="">
                                        <span class="font-semibold">{{ $fuente->nombre_corto }} &nbsp;&nbsp;&nbsp;</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="">
                                        <span class="font-bold">{{ $service->formatNumber($fuente->monto) }}</span><br>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-span-9 sm:col-span-3">
                <p class="text-sm font-semibold">Periodo de ejecución<br class="ocultar_periodo">
                    <span class="ml-5 text-sm font-normal ocultar_periodo">Fecha de inicio: <br><span class="ml-5 text-base font-bold ocultar_periodo">{{ date('d-m-Y', strtotime($obj_obra->get('obra')->fecha_inicio_programada)) }}</span></span>  <br>
                    <span class="ml-5 text-sm font-normal ocultar_periodo">Fecha de termino: <br><span class="ml-5 text-base font-bold ocultar_periodo">{{ date('d-m-Y', strtotime($obj_obra->get('obra')->fecha_final_programada)) }}</span></span> <br>

                    @if($obj_obra->get('obra')->modalidad_ejecucion == 2 && $obj_obra->get('obra')->fecha_final_programada != $obj_obra->get('obra')->fecha_final_real)
                        <span class="ml-5 text-sm font-normal ocultar_periodo">Fecha de termino modificada: <br><span class="ml-5 text-base font-bold ocultar_periodo">{{ date('d-m-Y', strtotime($obj_obra->get('obra')->fecha_final_real)) }}</span></span> 
                    @endif
                </p>
                
                
                @if($obj_obra->get('obra')->modalidad_ejecucion == 1)
                    <form action="{{ route('update_obra') }}" method="POST" accept-charset="UTF-8" enctype="multipart/form-data" id="formulario_periodo" class="hidden ml-5">
                        @csrf
                        @method('POST')
                        <div class="relative flex-auto">
                            <div id="datos_generales">
                                <div class="grid grid-cols-8">
                                    <div class="col-span-8">
                                        <div class="col-span-8">
                                            <label for="fecha_inicio" class="block text-sm font-normal text-gray-700">Fecha de inicio*</label>
                                            @if($acta_priorizacion == null)
                                                <input type="date" name="fecha_inicio" id="fecha_inicio" min="{{$obj_obra->get('obra')->ejercicio}}-01-01" max="{{$obj_obra->get('obra')->ejercicio}}-12-31" class="focus:ring-blue-800 focus:border-blue-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ $obj_obra->get('obra')->fecha_inicio_programada }}">
                                            @else
                                                <input type="date" name="fecha_inicio" id="fecha_inicio" min="{{$acta_priorizacion->acta_priorizacion}}" max="{{$obj_obra->get('obra')->ejercicio}}-12-31" class="focus:ring-blue-800 focus:border-blue-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ $obj_obra->get('obra')->fecha_inicio_programada }}">
                                            @endif
                                            <label id="error_fecha_inicio" class="hidden text-base font-normal text-red-500" >Ingrese una fecha de inicio valida</label>
                                        </div>
                                        <div class="col-span-8">
                                            <label for="fecha_fin" class="block text-sm font-normal text-gray-700">Fecha de fin*</label>
                                            @if($acta_priorizacion == null)
                                                <input type="date" name="fecha_fin" id="fecha_fin" min="{{$obj_obra->get('obra')->ejercicio}}-01-01" max="{{$obj_obra->get('obra')->ejercicio}}-12-31" class="focus:ring-blue-800 focus:border-blue-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ $obj_obra->get('obra')->fecha_final_programada }}">
                                            @else
                                                <input type="date" name="fecha_fin" id="fecha_fin" min="{{$acta_priorizacion->acta_priorizacion}}" max="{{$obj_obra->get('obra')->ejercicio}}-12-31" class="focus:ring-blue-800 focus:border-blue-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ $obj_obra->get('obra')->fecha_final_programada }}">
                                            @endif
                                            <label id="error_fecha_fin" class="hidden text-base font-normal text-red-500" >Ingrese una fecha final valida</label>
                                        </div>
                                        <input type="number" name="obra_id" class="hidden mt-1 focus:ring-blue-800 focus:border-blue-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ $obj_obra->get('obra')->id_obra}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--footer-->
                        <div class="rounded-b">
                            <div class="text-left">
                                <button type="button" class="text-red-500 background-transparent font-semibold  text-sm outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" onclick="ocultar_periodo()">
                                    Cancelar
                                </button>
                                <button id="guardar_btn_periodo" type="submit" class="bg-transparent text-green-500  font-semibold text-sm rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150">
                                    Guardar
                                </button>
                            </div>
                        </div>
                    </form>
                    <div class="col-span-9 flex justify-left ocultar_periodo">
                        <button type="button" class="ml-5 text-sm text-blue-500 underline background-transparent font-semibold outline-none focus:outline-none ease-linear transition-all duration-150" onclick="mostrar_periodo()">
                            Editar periodo de ejecución
                        </button>
                    </div>
                @endif
            </div>
            @if($obj_obra->get('obra')->modalidad_ejecucion == 2)
                <div class="col-span-9 sm:col-span-3">
                    <p class="text-sm font-semibold"> Contrato<br>
                        <span class="ml-5">Número: <span class="text-base font-bold">{{ $obj_obra->get('contrato')->numero_contrato }}</span></span><br>
                        <span class="ml-5">Fecha: <span class="text-base font-bold">{{ date('d-m-Y', strtotime($obj_obra->get('contrato')->fecha_contrato)) }}</span></span>
                    </p>
                </div>
            @endif
            
            @if ($obj_obra->get('obra')->modalidad_ejecucion == 2)
                <div class="col-span-9 sm:col-span-3">        
                    <p class="text-sm font-semibold">Contratista<br><span class="ml-5 text-base font-bold">{{ $obj_obra->get('contrato')->razon_social }}</span></p>
                </div>
            @endif
            <div class="col-span-9 sm:col-span-3">
                <p class="text-sm font-semibold">Modalidad de ejecución<br>
                    @if ($obj_obra->get('obra')->modalidad_ejecucion == 2)
                        <span class="ml-5 text-base font-bold">Contrato</span><br>
                    @else
                        <span class="ml-5 text-base font-bold">Administración directa</span>
                    @endif
                    
                </p>
            </div>
            
            @if($obj_obra->get('obra')->modalidad_ejecucion == 2)
                <div class="col-span-9 sm:col-span-3 flex items-center">
                    <p class="text-sm font-semibold">Modalidad de contratación<br>
                        <span class="ml-5 text-base font-bold">
                            @switch($obj_obra->get('contrato')->modalidad_asignacion)
                                @case(3)
                                    Adjudicación directa
                                @break
                                @case(2)
                                    Invitación a cuando menos tres contratistas
                                @break
                                @default
                                    Licitación pública
                            @endswitch
                        </span>
                    </p>
                </div>
            @endif
            @if($obj_obra->get('obra')->anticipo_monto > 0)
                <div class="col-span-9 sm:col-span-3 flex items-center">
                    <div>
                        <p class="text-sm font-semibold">Monto de anticipo:<br>
                            <span class="ml-5 text-base font-bold">
                                {{$service->formatNumber($obj_obra->get('obra')->anticipo_monto)}}
                            </span>
                        </p>
    
                        <p class="text-sm font-semibold">Total amortizado:<br>
                            <span class="ml-5 text-base font-bold">
                                {{$service->formatNumber($total_pagado->total_anticipo)}}
                            </span>
                        </p>
                    </div>
                    
                </div>
            @endif

            <div class="col-span-9">
                <div class="grid grid-cols-9 gap-4">
                    <div class="col-span-9 sm:col-span-3">
                        <p class="text-sm font-semibold text-center  sm:text-left">Avance fisico:</p>
                        <p class="text-base font-bold modificar_af text-center">{{$obj_obra->get('obra')->avance_fisico}}</p>
                        <form action="{{ route('update_obra') }}" method="POST" accept-charset="UTF-8" enctype="multipart/form-data" id="formulario_af" class="hidden ml-5">
                            @csrf
                            @method('POST')
                            <div class="relative flex-auto">
                                <div>
                                    <div class="grid grid-cols-8">
                                        <div class="col-span-8">
                                            <input type="number" min="0" max="100" name="avance_fisico" id="avance_fisico" class="mt-1 focus:ring-blue-800 focus:border-blue-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ $obj_obra->get('obra')->avance_fisico}}">
                                            <label id="error_avance_fisico" name="error_avance_fisico" class="hidden text-base font-normal text-red-500" >Ingrese avance fisico valido.</label>  
                                            <input type="number" name="obra_id" class="hidden mt-1 focus:ring-blue-800 focus:border-blue-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ $obj_obra->get('obra')->id_obra}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--footer-->
                            <div class="rounded-b">
                                <div class="text-left">
                                    <button type="button" class="text-red-500 background-transparent font-semibold  text-sm outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" onclick="ocultar_af()">
                                        Cancelar
                                    </button>
                                    <button id="guardar_btn_af" type="submit" class="bg-transparent text-green-500  font-semibold text-sm rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150">
                                        Guardar
                                    </button>
                                </div>
                            </div>
                        </form>
                        <div class="modificar_af col-span-9 text-center">
                            <button type="button" class="text-sm text-blue-500 underline background-transparent font-semibold outline-none focus:outline-none ease-linear transition-all duration-150" onclick="modificar_af()">
                                Editar avance fisico
                            </button>
                            
                        </div>
                    </div>
                    <div class="col-span-9 sm:col-span-3">
                        <p class="text-sm font-semibold text-center sm:text-left">Avance técnico:</p>
                        <p class="text-base font-bold text-center">{{number_format($obj_obra->get('obra')->avance_tecnico,0,'.','')}}</p>
                    </div>
                    <div class="col-span-9 sm:col-span-3">
                        <p class="text-sm font-semibold text-center sm:text-left">Avance economico:</p>
                        <p class="text-base font-bold text-center">{{number_format($obj_obra->get('obra')->avance_economico,0,'.','')}}</p>
                    </div>
                </div>
            </div>
            
        </div>
        <div class="mt-10">
            <div id="div-tabs-1" class="relative">
                <!--<div id="flecha-scroll-left">

                </div>
                <div id="flecha-scroll-right">

                </div>-->
                <div id="div-tabs" class="overflow-y-hidden overflow-x-visible relative">
                    
                    <ul class="tabs">
                        <li><a href="#tab1">Expediente técnico</a></li>
                        @if($obj_obra->get('obra')->modalidad_ejecucion == 2)
                            <li><a href="#tab2">Desglode de pagos</a></li>
                            <li><a href="#tab3">Estimaciones</a></li>
                            <li><a href="#tab4">Convenios modificatorios</a></li>
                        @endif
                        @if($obj_obra->get('obra')->modalidad_ejecucion == 1)
                            <li><a href="#tab2">Listas de raya</a></li>
                            <li><a href="#tab3">Contratos arrendamiento</a></li>
                            <li><a href="#tab4">Facturas</a></li>
                        @endif
                    </ul>
                    
                </div>
            </div>
            
            
           
            <div class="tab_container">
                <div class="tab_content" id="tab1">
                    <p class="font-bold text-lg text-center">Integración del expediente técnico</p>
                    <div class="flex justify-center">
                        <a type="button" href="{{ route('edit_expediente', [$obj_obra->get('obra')->id_obra]) }}" class="text-sm text-blue-500 underline background-transparent font-semibold outline-none focus:outline-none ease-linear transition-all duration-150 text-center">Modificar expediente técnico</a>
                    </div>
                    <div>
                        <!--PARTE SOCIAL DE LA INTEGRACION DEL EXPEDIENTE TECNICO-->
                        <div class="mt-4">
                            <div class="w-full ">
                                <div x-data={show:false}>
                                    <div class="bg-transparent relative" id="headingOne">
                                        <button @click="show=!show" type="button" style="width:100%;">
                                            <div>
                                                <div class="bg-gray-200">
                                                    <h2 class="font-bold text-base text-center">Parte social</h2>
                                                </div>
                                                <div class="icon-acordeon mr-3 flex justify-center">
                                                    <div x-show="!show" class="flex down-simbolo">
                                                        <img src="{{ asset('image/down.svg') }}" alt="Workflow">
                                                    </div>
                                                    <div x-show="show" class="flex up-simbolo">
                                                        <img src="{{ asset('image/up.svg') }}" alt="Workflow">
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </button>
                                    </div>
                                    <div x-show="show" class="border mb-2 p-2">
                                        <div class="grid sm:grid-cols-8 gap-x-4 gap-y-2">
                                            <div class="border sm:col-span-4 p-2">
                                                <div class="flex items-center h-full">
                                                    <div class="col-nombre">
                                                        <p class="dos-lineas text-base">
                                                            Acta de integración del Consejo de Desarrollo Municipal
                                                        </p>
                                                    </div>
                                                    <div class="col-estado ml-2">
                                                        <div class="flex justify-center my-2">
                                                            @switch($obj_obra->get('social')->acta_integracion_consejo)
                                                            @case(1)
                                                            <img src="{{ asset('image/Bien.svg') }}" alt="Workflow">
                                                            @break
                                                            @case(3)
                                                            <img src="{{ asset('image/NA.svg') }}" alt="Workflow">
                                                            @break
                                                            @default
                                                            <img src="{{ asset('image/Mal.svg') }}" alt="Workflow">
                                                            @endswitch
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="border sm:col-span-4  p-2">
                                                <div class="flex items-center h-full">
                                                    <div class="col-nombre">
                                                        <p class="dos-lineas">Acta de selección de obras</p>
                                                    </div>
                                                    <div class="col-estado pl-2">
                                                        <div class="flex justify-center my-2">
                                                            @switch($obj_obra->get('social')->acta_seleccion_obras)
                                                            @case(1)
                                                            <img src="{{ asset('image/Bien.svg') }}" alt="Workflow">
                                                            @break
                                                            @case(3)
                                                            <img src="{{ asset('image/NA.svg') }}" alt="Workflow">
                                                            @break
                                                            @default
                                                            <img src="{{ asset('image/Mal.svg') }}" alt="Workflow">
                                                            @endswitch
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="border sm:col-span-4  p-2">
                                                <div class="flex items-center h-full">
                                                    <div class="col-nombre">
                                                        <p class="dos-lineas">Acta de priorización de obras, acciones sociales básicas e inversión.</p>
                                                    </div>
                                                    <div class="col-estado pl-2">
                                                        <div class="flex justify-center my-2">
                                                            @switch($obj_obra->get('social')->acta_priorizacion_obras)
                                                            @case(1)
                                                            <img src="{{ asset('image/Bien.svg') }}" alt="Workflow">
                                                            @break
                                                            @case(3)
                                                            <img src="{{ asset('image/NA.svg') }}" alt="Workflow">
                                                            @break
                                                            @default
                                                            <img src="{{ asset('image/Mal.svg') }}" alt="Workflow">
                                                            @endswitch
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="border sm:col-span-4  p-2">
                                                <div class="flex items-center h-full">
                                                    <div class="col-nombre">
                                                        <p class="dos-lineas">Acta de integración del comité de obras.</p>
                                                    </div>
                                                    <div class="col-estado pl-2">
                                                        <div class="flex justify-center my-2">
                                                            @switch($obj_obra->get('social')->acta_integracion_comite)
                                                            @case(1)
                                                            <img src="{{ asset('image/Bien.svg') }}" alt="Workflow">
                                                            @break
                                                            @case(3)
                                                            <img src="{{ asset('image/NA.svg') }}" alt="Workflow">
                                                            @break
                                                            @default
                                                            <img src="{{ asset('image/Mal.svg') }}" alt="Workflow">
                                                            @endswitch
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="border sm:col-span-4 p-2">
                                                <div class="flex items-center h-full">
                                                    <div class="col-nombre">
                                                        <p class="dos-lineas">Convenio de concertación.</p>
                                                    </div>
                                                    <div class="col-estado pl-2">
                                                        <div class="flex justify-center my-2">
                                                            @switch($obj_obra->get('social')->convenio_concertacion)
                                                            @case(1)
                                                            <img src="{{ asset('image/Bien.svg') }}" alt="Workflow">
                                                            @break
                                                            @case(3)
                                                            <img src="{{ asset('image/NA.svg') }}" alt="Workflow">
                                                            @break
                                                            @default
                                                            <img src="{{ asset('image/Mal.svg') }}" alt="Workflow">
                                                            @endswitch
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="border sm:col-span-4  p-2">
                                                <div class="flex items-center h-full">
                                                    <div class="col-nombre">
                                                        <p class="dos-lineas">
                                                            {{$obj_obra->get('obra')->modalidad_ejecucion == 2?'Acta de excepción a la licitación pública.': 'Acta de acuerdo de cabildo para ejecutar la obra por Administracion Directa.'}}
                                                        </p>
                                                    </div>
                                                    <div class="col-estado pl-2">
                                                        <div class="flex justify-center">
                                                            @switch($obj_obra->get('social')->acta_excep_licitacion)
                                                            @case(1)
                                                            <img src="{{ asset('image/Bien.svg') }}" alt="Workflow">
                                                            @break
                                                            @case(3)
                                                            <img src="{{ asset('image/NA.svg') }}" alt="Workflow">
                                                            @break
                                                            @default
                                                            <img src="{{ asset('image/Mal.svg') }}" alt="Workflow">
                                                            @endswitch
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="border sm:col-span-4  p-2">
                                                <div class="flex items-center h-full">
                                                    <div class="col-nombre">
                                                        <p class="dos-lineas">
                                                            Convenio celebrado con instancias Estatales y Federales para Mezcla de recursos, transferencias de recursos.
                                                        </p>
                                                    </div>
                                                    <div class="col-estado pl-2">
                                                        <div class="flex justify-center my-2">
                                                            @switch($obj_obra->get('social')->convenio_mezcla)
                                                            @case(1)
                                                            <img src="{{ asset('image/Bien.svg') }}" alt="Workflow">
                                                            @break
                                                            @case(3)
                                                            <img src="{{ asset('image/NA.svg') }}" alt="Workflow">
                                                            @break
                                                            @default
                                                            <img src="{{ asset('image/Mal.svg') }}" alt="Workflow">
                                                            @endswitch
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="border sm:col-span-4  p-2">
                                                <div class="flex items-center h-full">
                                                    <div class="col-nombre">
                                                        <p class="dos-lineas">
                                                            Acta de aprobacion y autorizacion de obras, acciones sociales e inversiones.
                                                        </p>
                                                    </div>
                                                    <div class="col-estado pl-2">
                                                        <div class="flex justify-center my-2">
                                                            @switch($obj_obra->get('social')->acta_aprobacion_obra)
                                                            @case(1)
                                                            <img src="{{ asset('image/Bien.svg') }}" alt="Workflow">
                                                            @break
                                                            @case(3)
                                                            <img src="{{ asset('image/NA.svg') }}" alt="Workflow">
                                                            @break
                                                            @default
                                                            <img src="{{ asset('image/Mal.svg') }}" alt="Workflow">
                                                            @endswitch
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @if($obj_obra->get('obra')->modalidad_ejecucion == 2 && $obj_obra->get('contrato')->modalidad_asignacion == 3)
                                                <div class="border sm:col-span-4  p-2">
                                                    <div class="flex items-center h-full">
                                                        <div class="col-nombre">
                                                            <p class="dos-lineas">Acta para adjudicar la obra de manera directa.</p>
                                                        </div>
                                                        <div class="col-estado pl-2">
                                                            <div class="flex justify-center my-2">
                                                                @switch($obj_obra->get('social')->acta_ejecutar_adjudicacion)
                                                                @case(1)
                                                                <img src="{{ asset('image/Bien.svg') }}" alt="Workflow">
                                                                @break
                                                                @case(3)
                                                                <img src="{{ asset('image/NA.svg') }}" alt="Workflow">
                                                                @break
                                                                @default
                                                                <img src="{{ asset('image/Mal.svg') }}" alt="Workflow">
                                                                @endswitch
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--FIN DE LA PARTE SOCIAL-->
                        <div class="bg-gray-200 mt-4">
                            <h2 class="font-bold text-base text-center">Parte técnica</h2>
                        </div>
                        <!--PROYECTO EJECUTIVO PARTE TÉCNICA-->
                        <div class=" mt-3">
                            <div class="w-full ">
                                <div x-data={show:false}>
                                    <div class="bg-transparent relative" id="headingOne">
                                        <button @click="show=!show" type="button" style="width:100%;">
                                            <div>
                                                <div class="bg-gray-200">
                                                    <h2 class="font-semibold text-base text-center">Proyecto ejecutivo</h2>
                                                </div>
                                                <div class="icon-acordeon mr-3 flex justify-center">
                                                    <div x-show="!show" class="flex down-simbolo">
                                                        <img src="{{ asset('image/down.svg') }}" alt="Workflow">
                                                    </div>
                                                    <div x-show="show" class="flex up-simbolo">
                                                        <img src="{{ asset('image/up.svg') }}" alt="Workflow">
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </button>
                                    </div>
                                    <div x-show="show" class="border mb-2 p-2">
                                        <div class="grid sm:grid-cols-8 gap-x-4 gap-y-1">
                                            <div class="border sm:col-span-4 p-2">
                                                <div class="flex items-center h-full">
                                                    <div class="col-nombre">
                                                        <p class="dos-lineas">
                                                            Estudio de factibilidad técnica, económica y ecológica de la realización de la obra.
                                                        </p>
                                                    </div>
                                                    <div class="col-estado ml-2">
                                                        <div class="flex justify-center my-2">
                                                            @switch($obj_obra->get('social')->estudio_factibilidad)
                                                            @case(1)
                                                            <img src="{{ asset('image/Bien.svg') }}" alt="Workflow">
                                                            @break
                                                            @case(3)
                                                            <img src="{{ asset('image/NA.svg') }}" alt="Workflow">
                                                            @break
                                                            @default
                                                            <img src="{{ asset('image/Mal.svg') }}" alt="Workflow">
                                                            @endswitch
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="border sm:col-span-4  p-2">
                                                <div class="flex items-center h-full">
                                                    <div class="col-nombre">
                                                        <p class="dos-lineas">
                                                            Oficio de notificación de aprobación y autorización de obras, acciones sociales básicas e inversiones.
                                                        </p>
                                                    </div>
                                                    <div class="col-estado pl-2">
                                                        <div class="flex justify-center my-2">
                                                            @switch($obj_obra->get('social')->oficio_aprobacion_obra)
                                                            @case(1)
                                                            <img src="{{ asset('image/Bien.svg') }}" alt="Workflow">
                                                            @break
                                                            @case(3)
                                                            <img src="{{ asset('image/NA.svg') }}" alt="Workflow">
                                                            @break
                                                            @default
                                                            <img src="{{ asset('image/Mal.svg') }}" alt="Workflow">
                                                            @endswitch
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="border sm:col-span-4  p-2">
                                                <div class="flex items-center h-full">
                                                    <div class="col-nombre">
                                                        <p class="dos-lineas">
                                                            Anexos del oficio de notificación, de aprobación y autorización de obras, acciones sociales básicas e inversiones.
                                                        </p>
                                                    </div>
                                                    <div class="col-estado pl-2">
                                                        <div class="flex justify-center my-2">
                                                            @switch($obj_obra->get('social')->anexos_oficio_notificacion)
                                                            @case(1)
                                                            <img src="{{ asset('image/Bien.svg') }}" alt="Workflow">
                                                            @break
                                                            @case(3)
                                                            <img src="{{ asset('image/NA.svg') }}" alt="Workflow">
                                                            @break
                                                            @default
                                                            <img src="{{ asset('image/Mal.svg') }}" alt="Workflow">
                                                            @endswitch
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="border sm:col-span-4  p-2">
                                                <div class="flex items-center h-full">
                                                    <div class="col-nombre">
                                                        <p class="dos-lineas">
                                                            Cédula de información básica.
                                                        </p>
                                                    </div>
                                                    <div class="col-estado pl-2">
                                                        <div class="flex justify-center my-2">
                                                            @switch($obj_obra->get('social')->cedula_informacion_basica)
                                                            @case(1)
                                                            <img src="{{ asset('image/Bien.svg') }}" alt="Workflow">
                                                            @break
                                                            @case(3)
                                                            <img src="{{ asset('image/NA.svg') }}" alt="Workflow">
                                                            @break
                                                            @default
                                                            <img src="{{ asset('image/Mal.svg') }}" alt="Workflow">
                                                            @endswitch
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="border sm:col-span-4 p-2">
                                                <div class="flex items-center h-full">
                                                    <div class="col-nombre">
                                                        <p class="dos-lineas">
                                                            Generalidades de la inversión.
                                                        </p>
                                                    </div>
                                                    <div class="col-estado pl-2">
                                                        <div class="flex justify-center my-2">
                                                            @switch($obj_obra->get('social')->generalidades_inversion)
                                                            @case(1)
                                                            <img src="{{ asset('image/Bien.svg') }}" alt="Workflow">
                                                            @break
                                                            @case(3)
                                                            <img src="{{ asset('image/NA.svg') }}" alt="Workflow">
                                                            @break
                                                            @default
                                                            <img src="{{ asset('image/Mal.svg') }}" alt="Workflow">
                                                            @endswitch
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="border sm:col-span-4  p-2">
                                                <div class="flex items-center h-full">
                                                    <div class="col-nombre">
                                                        <p class="dos-lineas">
                                                            Documentos que acrediten la tenencia de la tierra.
                                                        </p>
                                                    </div>
                                                    <div class="col-estado pl-2">
                                                        <div class="flex justify-center">
                                                            @switch($obj_obra->get('social')->tenencia_tierra)
                                                            @case(1)
                                                            <img src="{{ asset('image/Bien.svg') }}" alt="Workflow">
                                                            @break
                                                            @case(3)
                                                            <img src="{{ asset('image/NA.svg') }}" alt="Workflow">
                                                            @break
                                                            @default
                                                            <img src="{{ asset('image/Mal.svg') }}" alt="Workflow">
                                                            @endswitch
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="border sm:col-span-4  p-2">
                                                <div class="flex items-center h-full">
                                                    <div class="col-nombre">
                                                        <p class="dos-lineas">
                                                            Dictamen de impacto ambiental.
                                                        </p>
                                                    </div>
                                                    <div class="col-estado pl-2">
                                                        <div class="flex justify-center my-2">
                                                            @switch($obj_obra->get('social')->dictamen_impacto_ambiental)
                                                            @case(1)
                                                            <img src="{{ asset('image/Bien.svg') }}" alt="Workflow">
                                                            @break
                                                            @case(3)
                                                            <img src="{{ asset('image/NA.svg') }}" alt="Workflow">
                                                            @break
                                                            @default
                                                            <img src="{{ asset('image/Mal.svg') }}" alt="Workflow">
                                                            @endswitch
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="border sm:col-span-4  p-2">
                                                <div class="flex items-center h-full">
                                                    <div class="col-nombre">
                                                        <p class="dos-lineas">
                                                            Presupuesto de obra programada.
                                                        </p>
                                                    </div>
                                                    <div class="col-estado pl-2">
                                                        <div class="flex justify-center my-2">
                                                            @switch($obj_obra->get('social')->presupuesto_obra)
                                                            @case(1)
                                                            <img src="{{ asset('image/Bien.svg') }}" alt="Workflow">
                                                            @break
                                                            @case(3)
                                                            <img src="{{ asset('image/NA.svg') }}" alt="Workflow">
                                                            @break
                                                            @default
                                                            <img src="{{ asset('image/Mal.svg') }}" alt="Workflow">
                                                            @endswitch
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="border sm:col-span-4  p-2">
                                                <div class="flex items-center h-full">
                                                    <div class="col-nombre">
                                                        <p class="dos-lineas">
                                                            Catálogo de conceptos.
                                                        </p>
                                                    </div>
                                                    <div class="col-estado pl-2">
                                                        <div class="flex justify-center my-2">
                                                            @switch($obj_obra->get('social')->catalogo_conceptos)
                                                            @case(1)
                                                            <img src="{{ asset('image/Bien.svg') }}" alt="Workflow">
                                                            @break
                                                            @case(3)
                                                            <img src="{{ asset('image/NA.svg') }}" alt="Workflow">
                                                            @break
                                                            @default
                                                            <img src="{{ asset('image/Mal.svg') }}" alt="Workflow">
                                                            @endswitch
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="border sm:col-span-4  p-2">
                                                <div class="flex items-center h-full">
                                                    <div class="col-nombre">
                                                        <p class="dos-lineas">
                                                            Explosión de insumos programada.
                                                        </p>
                                                    </div>
                                                    <div class="col-estado pl-2">
                                                        <div class="flex justify-center my-2">
                                                            @switch($obj_obra->get('social')->explosion_insumos)
                                                            @case(1)
                                                            <img src="{{ asset('image/Bien.svg') }}" alt="Workflow">
                                                            @break
                                                            @case(3)
                                                            <img src="{{ asset('image/NA.svg') }}" alt="Workflow">
                                                            @break
                                                            @default
                                                            <img src="{{ asset('image/Mal.svg') }}" alt="Workflow">
                                                            @endswitch
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="border sm:col-span-4  p-2">
                                                <div class="flex items-center h-full">
                                                    <div class="col-nombre">
                                                        <p class="dos-lineas">
                                                            Generadores de obra programada.
                                                        </p>
                                                    </div>
                                                    <div class="col-estado pl-2">
                                                        <div class="flex justify-center my-2">
                                                            @switch($obj_obra->get('social')->generadores_obra)
                                                            @case(1)
                                                            <img src="{{ asset('image/Bien.svg') }}" alt="Workflow">
                                                            @break
                                                            @case(3)
                                                            <img src="{{ asset('image/NA.svg') }}" alt="Workflow">
                                                            @break
                                                            @default
                                                            <img src="{{ asset('image/Mal.svg') }}" alt="Workflow">
                                                            @endswitch
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="border sm:col-span-4  p-2">
                                                <div class="flex items-center h-full">
                                                    <div class="col-nombre">
                                                        <p class="dos-lineas">
                                                            Planos del proyecto.
                                                        </p>
                                                    </div>
                                                    <div class="col-estado pl-2">
                                                        <div class="flex justify-center my-2">
                                                            @switch($obj_obra->get('social')->planos_proyecto)
                                                            @case(1)
                                                            <img src="{{ asset('image/Bien.svg') }}" alt="Workflow">
                                                            @break
                                                            @case(3)
                                                            <img src="{{ asset('image/NA.svg') }}" alt="Workflow">
                                                            @break
                                                            @default
                                                            <img src="{{ asset('image/Mal.svg') }}" alt="Workflow">
                                                            @endswitch
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="border sm:col-span-4  p-2">
                                                <div class="flex items-center h-full">
                                                    <div class="col-nombre">
                                                        <p class="dos-lineas">
                                                            Especificaciones generales y particulares de construcción.
                                                        </p>
                                                    </div>
                                                    <div class="col-estado pl-2">
                                                        <div class="flex justify-center my-2">
                                                            @switch($obj_obra->get('social')->especificaciones_generales_particulares)
                                                            @case(1)
                                                            <img src="{{ asset('image/Bien.svg') }}" alt="Workflow">
                                                            @break
                                                            @case(3)
                                                            <img src="{{ asset('image/NA.svg') }}" alt="Workflow">
                                                            @break
                                                            @default
                                                            <img src="{{ asset('image/Mal.svg') }}" alt="Workflow">
                                                            @endswitch
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="border sm:col-span-4  p-2">
                                                <div class="flex items-center h-full">
                                                    <div class="col-nombre">
                                                        <p class="dos-lineas">
                                                            Licencia del Director Responsable de Obra.
                                                        </p>
                                                    </div>
                                                    <div class="col-estado pl-2">
                                                        <div class="flex justify-center my-2">
                                                            @switch($obj_obra->get('social')->dro)
                                                            @case(1)
                                                            <img src="{{ asset('image/Bien.svg') }}" alt="Workflow">
                                                            @break
                                                            @case(3)
                                                            <img src="{{ asset('image/NA.svg') }}" alt="Workflow">
                                                            @break
                                                            @default
                                                            <img src="{{ asset('image/Mal.svg') }}" alt="Workflow">
                                                            @endswitch
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="border sm:col-span-4  p-2">
                                                <div class="flex items-center h-full">
                                                    <div class="col-nombre">
                                                        <p class="dos-lineas">
                                                            Programa de obra e inversión.
                                                        </p>
                                                    </div>
                                                    <div class="col-estado pl-2">
                                                        <div class="flex justify-center my-2">
                                                            @switch($obj_obra->get('social')->programa_obra_inversion)
                                                            @case(1)
                                                            <img src="{{ asset('image/Bien.svg') }}" alt="Workflow">
                                                            @break
                                                            @case(3)
                                                            <img src="{{ asset('image/NA.svg') }}" alt="Workflow">
                                                            @break
                                                            @default
                                                            <img src="{{ asset('image/Mal.svg') }}" alt="Workflow">
                                                            @endswitch
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="border sm:col-span-4  p-2">
                                                <div class="flex items-center h-full">
                                                    <div class="col-nombre">
                                                        <p class="dos-lineas">
                                                            Croquis de micro localización.
                                                        </p>
                                                    </div>
                                                    <div class="col-estado pl-2">
                                                        <div class="flex justify-center my-2">
                                                            @switch($obj_obra->get('social')->croquis_macro)
                                                            @case(1)
                                                            <img src="{{ asset('image/Bien.svg') }}" alt="Workflow">
                                                            @break
                                                            @case(3)
                                                            <img src="{{ asset('image/NA.svg') }}" alt="Workflow">
                                                            @break
                                                            @default
                                                            <img src="{{ asset('image/Mal.svg') }}" alt="Workflow">
                                                            @endswitch
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="border sm:col-span-4  p-2">
                                                <div class="flex items-center h-full">
                                                    <div class="col-nombre">
                                                        <p class="dos-lineas">
                                                            Croquis de macro localización
                                                        </p>
                                                    </div>
                                                    <div class="col-estado pl-2">
                                                        <div class="flex justify-center my-2">
                                                            @switch($obj_obra->get('social')->croquis_micro)
                                                            @case(1)
                                                            <img src="{{ asset('image/Bien.svg') }}" alt="Workflow">
                                                            @break
                                                            @case(3)
                                                            <img src="{{ asset('image/NA.svg') }}" alt="Workflow">
                                                            @break
                                                            @default
                                                            <img src="{{ asset('image/Mal.svg') }}" alt="Workflow">
                                                            @endswitch
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--FIN DEL PROYECTO EJECUTIVO PARTE TÉCNICA-->

                        <!--INICIO DEL PROCESO DE CONTRATACIÓN-->
                        @if ($obj_obra->get('obra')->modalidad_ejecucion == 2)
                            <div class=" mt-3">
                                <div class="w-full ">
                                    <div x-data={show:false}>
                                        <div class="bg-transparent relative" id="headingOne">
                                            <button @click="show=!show" type="button" style="width:100%;">
                                                <div>
                                                    <div class="bg-gray-200">
                                                        <h2 class="font-semibold text-base text-center">Proceso de contratación</h2>
                                                    </div>
                                                    <div class="icon-acordeon mr-3 flex justify-center">
                                                        <div x-show="!show" class="flex down-simbolo">
                                                            <img src="{{ asset('image/down.svg') }}" alt="Workflow">
                                                        </div>
                                                        <div x-show="show" class="flex up-simbolo">
                                                            <img src="{{ asset('image/up.svg') }}" alt="Workflow">
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                            </button>
                                        </div>
                                        <div x-show="show" class="border mb-2 p-2">
                                            <div class="grid sm:grid-cols-8 gap-x-4 gap-y-1 mt-3">
                                                
                                                    <div class="border sm:col-span-4 p-2">
                                                        <div class="flex items-center h-full">
                                                            <div class="col-nombre">
                                                                <p class="dos-lineas"> 
                                                                    Inscripción al padrón de contratista.
                                                                </p>
                                                            </div>
                                                            <div class="col-estado ml-2">
                                                                <div class="flex justify-center my-2">
                                                                    @switch($obj_obra->get('contrato')->padron_contratistas)
                                                                    @case(1)
                                                                    <img src="{{ asset('image/Bien.svg') }}" alt="Workflow">
                                                                    @break
                                                                    @case(3)
                                                                    <img src="{{ asset('image/NA.svg') }}" alt="Workflow">
                                                                    @break
                                                                    @default
                                                                    <img src="{{ asset('image/Mal.svg') }}" alt="Workflow">
                                                                    @endswitch
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="border sm:col-span-4  p-2">
                                                        <div class="flex items-center h-full">
                                                            <div class="col-nombre">
                                                                <p  class="dos-lineas">
                                                                    Invitaciones (con acuses de recepción)
                                                                </p>
                                                            </div>
                                                            <div class="col-estado pl-2">
                                                                <div class="flex justify-center my-2">
                                                                    @switch($obj_obra->get('contrato')->invitacion_acuse_recepcion)
                                                                    @case(1)
                                                                    <img src="{{ asset('image/Bien.svg') }}" alt="Workflow">
                                                                    @break
                                                                    @case(3)
                                                                    <img src="{{ asset('image/NA.svg') }}" alt="Workflow">
                                                                    @break
                                                                    @default
                                                                    <img src="{{ asset('image/Mal.svg') }}" alt="Workflow">
                                                                    @endswitch
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="border sm:col-span-4  p-2">
                                                        <div class="flex items-center h-full">
                                                            <div class="col-nombre">
                                                                <p  class="dos-lineas">
                                                                    Oficio de aceptación de la invitación (con acuses de recepción)
                                                                </p>
                                                            </div>
                                                            <div class="col-estado pl-2">
                                                                <div class="flex justify-center my-2">
                                                                    @switch($obj_obra->get('contrato')->aceptacion_invitacion)
                                                                    @case(1)
                                                                    <img src="{{ asset('image/Bien.svg') }}" alt="Workflow">
                                                                    @break
                                                                    @case(3)
                                                                    <img src="{{ asset('image/NA.svg') }}" alt="Workflow">
                                                                    @break
                                                                    @default
                                                                    <img src="{{ asset('image/Mal.svg') }}" alt="Workflow">
                                                                    @endswitch
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                @if ($obj_obra->get('contrato')->modalidad_asignacion != 3)
                                                    
                                                    <div class="border sm:col-span-4  p-2">
                                                        <div class="flex items-center h-full">
                                                            <div class="col-nombre">
                                                                <p class="dos-lineas">
                                                                    Bases de licitacion (con anexos).
                                                                </p>
                                                            </div>
                                                            <div class="col-estado pl-2">
                                                                <div class="flex justify-center my-2">
                                                                    @switch($obj_obra->get('licitacion')->bases_licitacion)
                                                                    @case(1)
                                                                    <img src="{{ asset('image/Bien.svg') }}" alt="Workflow">
                                                                    @break
                                                                    @case(3)
                                                                    <img src="{{ asset('image/NA.svg') }}" alt="Workflow">
                                                                    @break
                                                                    @default
                                                                    <img src="{{ asset('image/Mal.svg') }}" alt="Workflow">
                                                                    @endswitch
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="border sm:col-span-4 p-2">
                                                        <div class="flex items-center h-full">
                                                            <div class="col-nombre">
                                                                <p class="dos-lineas">
                                                                    Constancia de visita o de conocer el sitio donde se ejecutará la obra.
                                                                </p>
                                                            </div>
                                                            <div class="col-estado pl-2">
                                                                <div class="flex justify-center my-2">
                                                                    @switch($obj_obra->get('licitacion')->constancia_visita)
                                                                    @case(1)
                                                                    <img src="{{ asset('image/Bien.svg') }}" alt="Workflow">
                                                                    @break
                                                                    @case(3)
                                                                    <img src="{{ asset('image/NA.svg') }}" alt="Workflow">
                                                                    @break
                                                                    @default
                                                                    <img src="{{ asset('image/Mal.svg') }}" alt="Workflow">
                                                                    @endswitch
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="border sm:col-span-4  p-2">
                                                        <div class="flex items-center h-full">
                                                            <div class="col-nombre">
                                                                <p class="dos-lineas">
                                                                    Acta de la junta de aclaraciones.
                                                                </p>
                                                            </div>
                                                            <div class="col-estado pl-2">
                                                                <div class="flex justify-center">
                                                                    @switch($obj_obra->get('licitacion')->acta_junta_aclaraciones)
                                                                    @case(1)
                                                                    <img src="{{ asset('image/Bien.svg') }}" alt="Workflow">
                                                                    @break
                                                                    @case(3)
                                                                    <img src="{{ asset('image/NA.svg') }}" alt="Workflow">
                                                                    @break
                                                                    @default
                                                                    <img src="{{ asset('image/Mal.svg') }}" alt="Workflow">
                                                                    @endswitch
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="border sm:col-span-4  p-2">
                                                        <div class="flex items-center h-full">
                                                            <div class="col-nombre">
                                                                <p class="dos-lineas">
                                                                    Acta de apertura técnica.
                                                                </p>
                                                            </div>
                                                            <div class="col-estado pl-2">
                                                                <div class="flex justify-center my-2">
                                                                    @switch($obj_obra->get('licitacion')->acta_apertura_tecnica)
                                                                    @case(1)
                                                                    <img src="{{ asset('image/Bien.svg') }}" alt="Workflow">
                                                                    @break
                                                                    @case(3)
                                                                    <img src="{{ asset('image/NA.svg') }}" alt="Workflow">
                                                                    @break
                                                                    @default
                                                                    <img src="{{ asset('image/Mal.svg') }}" alt="Workflow">
                                                                    @endswitch
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="border sm:col-span-4  p-2">
                                                        <div class="flex items-center h-full">
                                                            <div class="col-nombre">
                                                                <p class="dos-lineas">
                                                                    Dictamen técnico y análisis detallado.
                                                                </p>
                                                            </div>
                                                            <div class="col-estado pl-2">
                                                                <div class="flex justify-center my-2">
                                                                    @switch($obj_obra->get('licitacion')->dictamen_tecnico)
                                                                    @case(1)
                                                                    <img src="{{ asset('image/Bien.svg') }}" alt="Workflow">
                                                                    @break
                                                                    @case(3)
                                                                    <img src="{{ asset('image/NA.svg') }}" alt="Workflow">
                                                                    @break
                                                                    @default
                                                                    <img src="{{ asset('image/Mal.svg') }}" alt="Workflow">
                                                                    @endswitch
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="border sm:col-span-4  p-2">
                                                        <div class="flex items-center h-full">
                                                            <div class="col-nombre">
                                                                <p class="dos-lineas">
                                                                    Acta de apertura económica.
                                                                </p>
                                                            </div>
                                                            <div class="col-estado pl-2">
                                                                <div class="flex justify-center my-2">
                                                                    @switch($obj_obra->get('licitacion')->acta_apertura_economica)
                                                                    @case(1)
                                                                    <img src="{{ asset('image/Bien.svg') }}" alt="Workflow">
                                                                    @break
                                                                    @case(3)
                                                                    <img src="{{ asset('image/NA.svg') }}" alt="Workflow">
                                                                    @break
                                                                    @default
                                                                    <img src="{{ asset('image/Mal.svg') }}" alt="Workflow">
                                                                    @endswitch
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="border sm:col-span-4  p-2">
                                                        <div class="flex items-center h-full">
                                                            <div class="col-nombre">
                                                                <p class="dos-lineas">
                                                                    Dictamen económico y análisis detallado
                                                                </p>
                                                            </div>
                                                            <div class="col-estado pl-2">
                                                                <div class="flex justify-center my-2">
                                                                    @switch($obj_obra->get('licitacion')->dictamen_economico)
                                                                    @case(1)
                                                                    <img src="{{ asset('image/Bien.svg') }}" alt="Workflow">
                                                                    @break
                                                                    @case(3)
                                                                    <img src="{{ asset('image/NA.svg') }}" alt="Workflow">
                                                                    @break
                                                                    @default
                                                                    <img src="{{ asset('image/Mal.svg') }}" alt="Workflow">
                                                                    @endswitch
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="border sm:col-span-4  p-2">
                                                        <div class="flex items-center h-full">
                                                            <div class="col-nombre">
                                                                <p class="dos-lineas">
                                                                    Dictamen
                                                                </p>
                                                            </div>
                                                            <div class="col-estado pl-2">
                                                                <div class="flex justify-center my-2">
                                                                    @switch($obj_obra->get('licitacion')->dictamen)
                                                                    @case(1)
                                                                    <img src="{{ asset('image/Bien.svg') }}" alt="Workflow">
                                                                    @break
                                                                    @case(3)
                                                                    <img src="{{ asset('image/NA.svg') }}" alt="Workflow">
                                                                    @break
                                                                    @default
                                                                    <img src="{{ asset('image/Mal.svg') }}" alt="Workflow">
                                                                    @endswitch
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="border sm:col-span-4  p-2">
                                                        <div class="flex items-center h-full">
                                                            <div class="col-nombre">
                                                                <p class="dos-lineas">
                                                                    Acta de fallo
                                                                </p>
                                                            </div>
                                                            <div class="col-estado pl-2">
                                                                <div class="flex justify-center my-2">
                                                                    @switch($obj_obra->get('licitacion')->acta_fallo)
                                                                    @case(1)
                                                                    <img src="{{ asset('image/Bien.svg') }}" alt="Workflow">
                                                                    @break
                                                                    @case(3)
                                                                    <img src="{{ asset('image/NA.svg') }}" alt="Workflow">
                                                                    @break
                                                                    @default
                                                                    <img src="{{ asset('image/Mal.svg') }}" alt="Workflow">
                                                                    @endswitch
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="border sm:col-span-4  p-2">
                                                        <div class="flex items-center h-full">
                                                            <div class="col-nombre">
                                                                <p class="dos-lineas">
                                                                    Propuesta económica de los licitantes.
                                                                </p>
                                                            </div>
                                                            <div class="col-estado pl-2">
                                                                <div class="flex justify-center my-2">
                                                                    @switch($obj_obra->get('licitacion')->propuesta_licitantes_economica)
                                                                    @case(1)
                                                                    <img src="{{ asset('image/Bien.svg') }}" alt="Workflow">
                                                                    @break
                                                                    @case(3)
                                                                    <img src="{{ asset('image/NA.svg') }}" alt="Workflow">
                                                                    @break
                                                                    @default
                                                                    <img src="{{ asset('image/Mal.svg') }}" alt="Workflow">
                                                                    @endswitch
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="border sm:col-span-4  p-2">
                                                        <div class="flex items-center h-full">
                                                            <div class="col-nombre">
                                                                <p class="dos-lineas">
                                                                    Propuesta técnica de los licitantes.
                                                                </p>
                                                            </div>
                                                            <div class="col-estado pl-2">
                                                                <div class="flex justify-center my-2">
                                                                    @switch($obj_obra->get('licitacion')->propuesta_licitantes_tecnica)
                                                                    @case(1)
                                                                    <img src="{{ asset('image/Bien.svg') }}" alt="Workflow">
                                                                    @break
                                                                    @case(3)
                                                                    <img src="{{ asset('image/NA.svg') }}" alt="Workflow">
                                                                    @break
                                                                    @default
                                                                    <img src="{{ asset('image/Mal.svg') }}" alt="Workflow">
                                                                    @endswitch
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif

                                                    <div class="border sm:col-span-4  p-2">
                                                        <div class="flex items-center h-full">
                                                            <div class="col-nombre">
                                                                <p class="dos-lineas">
                                                                    Contrato                                                         
                                                                    @if ($obj_obra->get('contrato')->contrato_tipo == 1) <span class="font-bold">(Precios unitarios)</span> @endif
                                                                    @if ($obj_obra->get('contrato')->contrato_tipo == 2) (Precios Alzados) @endif.
                                                                </p>
                                                            </div>
                                                            <div class="col-estado pl-2">
                                                                <div class="flex justify-center my-2">
                                                                    @switch($obj_obra->get('contrato')->contrato)
                                                                    @case(1)
                                                                    <img src="{{ asset('image/Bien.svg') }}" alt="Workflow">
                                                                    @break
                                                                    @case(3)
                                                                    <img src="{{ asset('image/NA.svg') }}" alt="Workflow">
                                                                    @break
                                                                    @default
                                                                    <img src="{{ asset('image/Mal.svg') }}" alt="Workflow">
                                                                    @endswitch
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="border sm:col-span-4  p-2">
                                                        <div class="flex items-center h-full">
                                                            <div class="col-nombre">
                                                                <p class="dos-lineas">
                                                                    Oficio justificatorio para convenio modificatorio.
                                                                </p>
                                                            </div>
                                                            <div class="col-estado pl-2">
                                                                <div class="flex justify-center my-2">
                                                                    @switch($obj_obra->get('contrato')->oficio_justificativo_convenio_modificatorio)
                                                                    @case(1)
                                                                    <img src="{{ asset('image/Bien.svg') }}" alt="Workflow">
                                                                    @break
                                                                    @case(3)
                                                                    <img src="{{ asset('image/NA.svg') }}" alt="Workflow">
                                                                    @break
                                                                    @default
                                                                    <img src="{{ asset('image/Mal.svg') }}" alt="Workflow">
                                                                    @endswitch
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                @if($convenios->first() != null)
                                                    <div class="border sm:col-span-8  p-2 mt-4">
                                                        <div class="flex items-center justify-center mb-3">
                                                            <div>
                                                                <p class="font-bold dos-lineas">
                                                                    Convenios modificatorios
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="grid sm:grid-cols-8 gap-x-4 gap-y-1">
                                                            @foreach ($convenios as  $convenio)
                                                                <div class="border sm:col-span-4 p-2 mt-1">
                                                                    <div class="flex items-center  h-full">
                                                                        <div class="col-nombre">
                                                                            <p>
                                                                                Convenio modificatorio
                                                                                @switch($convenio->tipo)
                                                                                    @case(1)
                                                                                        al monto del contrato
                                                                                    @break
                                                                                    @case(2)
                                                                                        al plazo del contrato
                                                                                    @break
                                                                                    @default
                                                                                        al monto y plazo del contrato
                                                                                @endswitch
                                                                            </p>
                                                                        </div>
                                                                        <div class="col-estado pl-2">
                                                                            <div class="flex justify-center my-2">
                                                                                @switch($convenio->agregado_expediente)
                                                                                @case(1)
                                                                                <img src="{{ asset('image/Bien.svg') }}" alt="Workflow">
                                                                                @break
                                                                                @case(3)
                                                                                <img src="{{ asset('image/NA.svg') }}" alt="Workflow">
                                                                                @break
                                                                                @default
                                                                                <img src="{{ asset('image/Mal.svg') }}" alt="Workflow">
                                                                                @endswitch
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                @endif   
                                                    <div class="border sm:col-span-8 p-2 mt-4">
                                                        <div class="flex items-center justify-center mb-3">
                                                            <div>
                                                                <p class="font-bold dos-lineas">
                                                                    Anexos del contrato
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="grid sm:grid-cols-8 gap-x-4 gap-y-1">
                                                            <div class="border sm:col-span-4 p-2 mt-1">
                                                                <div class="flex items-center  h-full">
                                                                    <div class="col-nombre">
                                                                        <p>
                                                                            Catálogo de conceptos.
                                                                        </p>
                                                                    </div>
                                                                    <div class="col-estado pl-2">
                                                                        <div class="flex justify-center my-2">
                                                                            @switch($obj_obra->get('contrato')->catalogo_conceptos)
                                                                            @case(1)
                                                                            <img src="{{ asset('image/Bien.svg') }}" alt="Workflow">
                                                                            @break
                                                                            @case(3)
                                                                            <img src="{{ asset('image/NA.svg') }}" alt="Workflow">
                                                                            @break
                                                                            @default
                                                                            <img src="{{ asset('image/Mal.svg') }}" alt="Workflow">
                                                                            @endswitch
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="border sm:col-span-4 p-2 mt-1">
                                                                <div class="flex items-center  h-full">
                                                                    <div class="col-nombre">
                                                                        <p class="dos-lineas">
                                                                            Análisis de precios unitarios.
                                                                        </p>
                                                                    </div>
                                                                    <div class="col-estado pl-2">
                                                                        <div class="flex justify-center my-2">
                                                                            @switch($obj_obra->get('contrato')->analisis_p_u)
                                                                            @case(1)
                                                                            <img src="{{ asset('image/Bien.svg') }}" alt="Workflow">
                                                                            @break
                                                                            @case(3)
                                                                            <img src="{{ asset('image/NA.svg') }}" alt="Workflow">
                                                                            @break
                                                                            @default
                                                                            <img src="{{ asset('image/Mal.svg') }}" alt="Workflow">
                                                                            @endswitch
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="border sm:col-span-4 p-2 mt-1">
                                                                <div class="flex items-center  h-full">
                                                                    <div class="col-nombre">
                                                                        <p class="dos-lineas">
                                                                            Calendario de la ejecución de los trabajos.
                                                                        </p>
                                                                    </div>
                                                                    <div class="col-estado pl-2">
                                                                        <div class="flex justify-center my-2">
                                                                            @switch($obj_obra->get('contrato')->montos_mensuales_ejecutados)
                                                                            @case(1)
                                                                            <img src="{{ asset('image/Bien.svg') }}" alt="Workflow">
                                                                            @break
                                                                            @case(3)
                                                                            <img src="{{ asset('image/NA.svg') }}" alt="Workflow">
                                                                            @break
                                                                            @default
                                                                            <img src="{{ asset('image/Mal.svg') }}" alt="Workflow">
                                                                            @endswitch
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>                                      
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <!--FIN DEL PROCESO DE CONTRATACIÓN-->

                        <!--INICIO DE DOCUMENTACIÓN COMPROBATORIA-->
                        <div class=" mt-3">
                            <div class="w-full ">
                                <div x-data={show:false}>
                                    <div class="bg-transparent relative" id="headingOne">
                                        <button @click="show=!show" type="button" style="width:100%;">
                                            <div>
                                                <div class="bg-gray-200">
                                                    <h2 class="font-semibold text-base text-center">Documentación comprobatoria</h2>
                                                </div>
                                                <div class="icon-acordeon mr-3 flex justify-center">
                                                    <div x-show="!show" class="flex down-simbolo">
                                                        <img src="{{ asset('image/down.svg') }}" alt="Workflow">
                                                    </div>
                                                    <div x-show="show" class="flex up-simbolo">
                                                        <img src="{{ asset('image/up.svg') }}" alt="Workflow">
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </button>
                                    </div>
                                    <div x-show="show" class="border mb-2 p-2">
                                        <div class="grid sm:grid-cols-8 gap-x-4 gap-y-1 mt-3">
                                            @if ($obj_obra->get('obra')->modalidad_ejecucion == 2)
                                                <div class="border sm:col-span-4 p-2">
                                                    <div class="flex items-center h-full">
                                                        <div class="col-nombre">
                                                            <p  class="dos-lineas">
                                                                Asignacion mediante oficio del Superintendente de obra.
                                                            </p>
                                                        </div>
                                                        <div class="col-estado ml-2">
                                                            <div class="flex justify-center my-2">
                                                                @switch($obj_obra->get('contrato')->oficio_superintendente)
                                                                @case(1)
                                                                <img src="{{ asset('image/Bien.svg') }}" alt="Workflow">
                                                                @break
                                                                @case(3)
                                                                <img src="{{ asset('image/NA.svg') }}" alt="Workflow">
                                                                @break
                                                                @default
                                                                <img src="{{ asset('image/Mal.svg') }}" alt="Workflow">
                                                                @endswitch
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="border sm:col-span-4  p-2">
                                                    <div class="flex items-center h-full">
                                                        <div class="col-nombre">
                                                            <p class="dos-lineas">
                                                                Asignacion mediante oficio del residente de obra.
                                                            </p>
                                                        </div>
                                                        <div class="col-estado pl-2">
                                                            <div class="flex justify-center my-2">
                                                                @switch($obj_obra->get('contrato')->oficio_residente_obra)
                                                                @case(1)
                                                                <img src="{{ asset('image/Bien.svg') }}" alt="Workflow">
                                                                @break
                                                                @case(3)
                                                                <img src="{{ asset('image/NA.svg') }}" alt="Workflow">
                                                                @break
                                                                @default
                                                                <img src="{{ asset('image/Mal.svg') }}" alt="Workflow">
                                                                @endswitch
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="border sm:col-span-4  p-2">
                                                    <div class="flex items-center h-full">
                                                        <div class="col-nombre">
                                                            <p class="dos-lineas">
                                                                Oficio emitido por la ejecutora dirigido al contratista por la disposición del inmueble.
                                                            </p>
                                                        </div>
                                                        <div class="col-estado pl-2">
                                                            <div class="flex justify-center my-2">
                                                                @switch($obj_obra->get('contrato')->oficio_disposicion_inmueble)
                                                                @case(1)
                                                                <img src="{{ asset('image/Bien.svg') }}" alt="Workflow">
                                                                @break
                                                                @case(3)
                                                                <img src="{{ asset('image/NA.svg') }}" alt="Workflow">
                                                                @break
                                                                @default
                                                                <img src="{{ asset('image/Mal.svg') }}" alt="Workflow">
                                                                @endswitch
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="border sm:col-span-4  p-2">
                                                    <div class="flex items-center h-full">
                                                        <div class="col-nombre">
                                                            <p class="dos-lineas">
                                                                Notificacion de inicio de obra.
                                                            </p>
                                                        </div>
                                                        <div class="col-estado pl-2">
                                                            <div class="flex justify-center my-2">
                                                                @switch($obj_obra->get('contrato')->oficio_inicio_obra)
                                                                @case(1)
                                                                <img src="{{ asset('image/Bien.svg') }}" alt="Workflow">
                                                                @break
                                                                @case(3)
                                                                <img src="{{ asset('image/NA.svg') }}" alt="Workflow">
                                                                @break
                                                                @default
                                                                <img src="{{ asset('image/Mal.svg') }}" alt="Workflow">
                                                                @endswitch
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="border sm:col-span-4  p-2">
                                                    <div class="flex items-center h-full">
                                                        <div class="col-nombre">
                                                            <p class="dos-lineas">
                                                                Factura de anticipo: <span class="font-bold">{{ $obj_obra->get('contrato')->factura_anticipo }}</span>
                                                                <br>
                                                                Importe: <span class="font-bold">{{ $service->formatNumber($obj_obra->get('obra')->anticipo_porcentaje * 0.01 * $obj_obra->get('obra')->monto_contratado) }}</span>
                                                            </p>
                                                        </div>
                                                        <div class="col-estado pl-2">
                                                            <div class="flex justify-center my-2">
                                                                @switch($obj_obra->get('contrato')->exp_factura_anticipo)
                                                                @case(1)
                                                                <img src="{{ asset('image/Bien.svg') }}" alt="Workflow">
                                                                @break
                                                                @case(3)
                                                                <img src="{{ asset('image/NA.svg') }}" alt="Workflow">
                                                                @break
                                                                @default
                                                                <img src="{{ asset('image/Mal.svg') }}" alt="Workflow">
                                                                @endswitch
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                @if($estimaciones->first() != null)
                                                    <div class="border sm:col-span-8 p-2 mt-4">
                                                        <div class="flex items-center justify-center mb-3">
                                                            <div>
                                                                <p class="font-bold">
                                                                    Estimaciones
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="grid sm:grid-cols-8 gap-x-4 gap-y-1">
                                                            @foreach ($estimaciones as $key => $estimacion)
                                                                <div class="sm:col-span-4 mt-1">
                                                                    <div>
                                                                        <div class="w-full ">
                                                                            <div x-data={show:false}>
                                                                                <div class="bg-transparent relative">
                                                                                    <button @click="show=!show" type="button" style="width:100%;">
                                                                                        <div class="border p-2">
                                                                                            <div>
                                                                                                <p class="font-bold text-base text-center">
                                                                                                    {{ $estimacion->nombre }}
                                                                                                    @if ($estimacion->finiquito == 1)
                                                                                                        y finiquito
                                                                                                    @endif
                                                                                                </p>
                                                                                            </div>
                                                                                            <div class="icon-acordeon-1 mr-3 flex justify-center">
                                                                                                <div x-show="!show" class="flex down-simbolo">
                                                                                                    <img src="{{ asset('image/down.svg') }}" alt="Workflow">
                                                                                                </div>
                                                                                                <div x-show="show" class="flex up-simbolo">
                                                                                                    <img src="{{ asset('image/up.svg') }}" alt="Workflow">
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        
                                                                                    </button>
                                                                                </div>
                                                                                <div x-show="show" class="border-l-1 border-r-1 border-b-1 mb-2 p-2">
                                                                                    <div class="grid sm:grid-cols-8 gap-x-4 gap-y-1 mt-3">
                                                                                        
                                                                                            <div class="border sm:col-span-8 p-2">
                                                                                                <div class="flex items-center h-full">
                                                                                                    <div class="col-nombre">
                                                                                                        <p class="dos-lineas">
                                                                                                            Factura de la estimación.
                                                                                                        </p>
                                                                                                    </div>
                                                                                                    <div class="col-estado ml-2">
                                                                                                        <div class="flex justify-center my-2">
                                                                                                            @switch($estimacion->factura_estimacion)
                                                                                                            @case(1)
                                                                                                            <img src="{{ asset('image/Bien.svg') }}" alt="Workflow">
                                                                                                            @break
                                                                                                            @case(3)
                                                                                                            <img src="{{ asset('image/NA.svg') }}" alt="Workflow">
                                                                                                            @break
                                                                                                            @default
                                                                                                            <img src="{{ asset('image/Mal.svg') }}" alt="Workflow">
                                                                                                            @endswitch
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            
                                                                                            <div class="border sm:col-span-8 p-2">
                                                                                                <div class="flex items-center h-full">
                                                                                                    <div class="col-nombre">
                                                                                                        <p class="dos-lineas">
                                                                                                            Presupuesto de la estimación.
                                                                                                        </p>
                                                                                                    </div>
                                                                                                    <div class="col-estado ml-2">
                                                                                                        <div class="flex justify-center my-2">
                                                                                                            @switch($estimacion->presupuesto_estimacion)
                                                                                                            @case(1)
                                                                                                            <img src="{{ asset('image/Bien.svg') }}" alt="Workflow">
                                                                                                            @break
                                                                                                            @case(3)
                                                                                                            <img src="{{ asset('image/NA.svg') }}" alt="Workflow">
                                                                                                            @break
                                                                                                            @default
                                                                                                            <img src="{{ asset('image/Mal.svg') }}" alt="Workflow">
                                                                                                            @endswitch
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            
                                                                                            <div class="border sm:col-span-8 p-2">
                                                                                                <div class="flex items-center h-full">
                                                                                                    <div class="col-nombre">
                                                                                                        <p class="dos-lineas">
                                                                                                            Carátula de estimación.
                                                                                                        </p>
                                                                                                    </div>
                                                                                                    <div class="col-estado ml-2">
                                                                                                        <div class="flex justify-center my-2">
                                                                                                            @switch($estimacion->caratula_estimacion)
                                                                                                            @case(1)
                                                                                                            <img src="{{ asset('image/Bien.svg') }}" alt="Workflow">
                                                                                                            @break
                                                                                                            @case(3)
                                                                                                            <img src="{{ asset('image/NA.svg') }}" alt="Workflow">
                                                                                                            @break
                                                                                                            @default
                                                                                                            <img src="{{ asset('image/Mal.svg') }}" alt="Workflow">
                                                                                                            @endswitch
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>

                                                                                            <div class="border sm:col-span-8 p-2">
                                                                                                <div class="flex items-center h-full">
                                                                                                    <div class="col-nombre">
                                                                                                        <p class="dos-lineas">
                                                                                                            Cuerpo de estimación.
                                                                                                        </p>
                                                                                                    </div>
                                                                                                    <div class="col-estado ml-2">
                                                                                                        <div class="flex justify-center my-2">
                                                                                                            @switch($estimacion -> cuerpo_estimacion)
                                                                                                            @case(1)
                                                                                                            <img src="{{ asset('image/Bien.svg') }}" alt="Workflow">
                                                                                                            @break
                                                                                                            @case(3)
                                                                                                            <img src="{{ asset('image/NA.svg') }}" alt="Workflow">
                                                                                                            @break
                                                                                                            @default
                                                                                                            <img src="{{ asset('image/Mal.svg') }}" alt="Workflow">
                                                                                                            @endswitch
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>

                                                                                            <div class="border sm:col-span-8 p-2">
                                                                                                <div class="flex items-center h-full">
                                                                                                    <div class="col-nombre">
                                                                                                        <p class="dos-lineas">
                                                                                                            Resumen de estimación.
                                                                                                        </p>
                                                                                                    </div>
                                                                                                    <div class="col-estado ml-2">
                                                                                                        <div class="flex justify-center my-2">
                                                                                                            @switch($estimacion -> resumen_estimacion)
                                                                                                            @case(1)
                                                                                                            <img src="{{ asset('image/Bien.svg') }}" alt="Workflow">
                                                                                                            @break
                                                                                                            @case(3)
                                                                                                            <img src="{{ asset('image/NA.svg') }}" alt="Workflow">
                                                                                                            @break
                                                                                                            @default
                                                                                                            <img src="{{ asset('image/Mal.svg') }}" alt="Workflow">
                                                                                                            @endswitch
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>

                                                                                            <div class="border sm:col-span-8 p-2">
                                                                                                <div class="flex items-center h-full">
                                                                                                    <div class="col-nombre">
                                                                                                        <p class="dos-lineas">
                                                                                                            Estado de cuenta de estimación.
                                                                                                        </p>
                                                                                                    </div>
                                                                                                    <div class="col-estado ml-2">
                                                                                                        <div class="flex justify-center my-2">
                                                                                                            @switch($estimacion->estado_cuenta_estimacion)
                                                                                                            @case(1)
                                                                                                            <img src="{{ asset('image/Bien.svg') }}" alt="Workflow">
                                                                                                            @break
                                                                                                            @case(3)
                                                                                                            <img src="{{ asset('image/NA.svg') }}" alt="Workflow">
                                                                                                            @break
                                                                                                            @default
                                                                                                            <img src="{{ asset('image/Mal.svg') }}" alt="Workflow">
                                                                                                            @endswitch
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>

                                                                                            <div class="border sm:col-span-8 p-2">
                                                                                                <div class="flex items-center h-full">
                                                                                                    <div class="col-nombre">
                                                                                                        <p class="dos-lineas">
                                                                                                            Número generadores de estimación.
                                                                                                        </p>
                                                                                                    </div>
                                                                                                    <div class="col-estado ml-2">
                                                                                                        <div class="flex justify-center my-2">
                                                                                                            @switch($estimacion->numero_generadores_estimacion)
                                                                                                            @case(1)
                                                                                                            <img src="{{ asset('image/Bien.svg') }}" alt="Workflow">
                                                                                                            @break
                                                                                                            @case(3)
                                                                                                            <img src="{{ asset('image/NA.svg') }}" alt="Workflow">
                                                                                                            @break
                                                                                                            @default
                                                                                                            <img src="{{ asset('image/Mal.svg') }}" alt="Workflow">
                                                                                                            @endswitch
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>

                                                                                            <div class="border sm:col-span-8 p-2">
                                                                                                <div class="flex items-center h-full">
                                                                                                    <div class="col-nombre">
                                                                                                        <p class="dos-lineas">
                                                                                                            Corquis de localización de estimación.
                                                                                                        </p>
                                                                                                    </div>
                                                                                                    <div class="col-estado ml-2">
                                                                                                        <div class="flex justify-center my-2">
                                                                                                            @switch($estimacion->croquis_ilustrativo_estimacion)
                                                                                                            @case(1)
                                                                                                            <img src="{{ asset('image/Bien.svg') }}" alt="Workflow">
                                                                                                            @break
                                                                                                            @case(3)
                                                                                                            <img src="{{ asset('image/NA.svg') }}" alt="Workflow">
                                                                                                            @break
                                                                                                            @default
                                                                                                            <img src="{{ asset('image/Mal.svg') }}" alt="Workflow">
                                                                                                            @endswitch
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>

                                                                                            <div class="border sm:col-span-8 p-2">
                                                                                                <div class="flex items-center h-full">
                                                                                                    <div class="col-nombre">
                                                                                                        <p class="dos-lineas">
                                                                                                            Soporte fotográfico de estimación.
                                                                                                        </p>
                                                                                                    </div>
                                                                                                    <div class="col-estado ml-2">
                                                                                                        <div class="flex justify-center my-2">
                                                                                                            @switch($estimacion->reporte_fotografico_estimacion)
                                                                                                            @case(1)
                                                                                                            <img src="{{ asset('image/Bien.svg') }}" alt="Workflow">
                                                                                                            @break
                                                                                                            @case(3)
                                                                                                            <img src="{{ asset('image/NA.svg') }}" alt="Workflow">
                                                                                                            @break
                                                                                                            @default
                                                                                                            <img src="{{ asset('image/Mal.svg') }}" alt="Workflow">
                                                                                                            @endswitch
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>

                                                                                            <div class="border sm:col-span-8 p-2">
                                                                                                <div class="flex items-center h-full">
                                                                                                    <div class="col-nombre">
                                                                                                        <p class="dos-lineas">
                                                                                                            Notas de bitácora.
                                                                                                        </p>
                                                                                                    </div>
                                                                                                    <div class="col-estado ml-2">
                                                                                                        <div class="flex justify-center my-2">
                                                                                                            @switch($estimacion->notas_bitacora)
                                                                                                            @case(1)
                                                                                                            <img src="{{ asset('image/Bien.svg') }}" alt="Workflow">
                                                                                                            @break
                                                                                                            @case(3)
                                                                                                            <img src="{{ asset('image/NA.svg') }}" alt="Workflow">
                                                                                                            @break
                                                                                                            @default
                                                                                                            <img src="{{ asset('image/Mal.svg') }}" alt="Workflow">
                                                                                                            @endswitch
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                @endif

                                                <div class="border sm:col-span-8 p-2 mt-4">
                                                    <div class="flex items-center justify-center mb-3">
                                                        <div>
                                                            <p class="font-bold">
                                                                Garantías
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="grid sm:grid-cols-8 gap-x-4 gap-y-1">
                                                        <div class="border sm:col-span-4 p-2 mt-1">
                                                            <div class="flex items-center  h-full">
                                                                <div class="col-nombre">
                                                                    <p class="dos-lineas">
                                                                        Fianza de anticipo: <span class="font-bold">{{ $obj_obra->get('contrato')->fianza_anticipo }}</span>
                                                                    </p>
                                                                </div>
                                                                <div class="col-estado pl-2">
                                                                    <div class="flex justify-center my-2">
                                                                        @switch($obj_obra->get('contrato')->exp_fianza_anticipo)
                                                                        @case(1)
                                                                        <img src="{{ asset('image/Bien.svg') }}" alt="Workflow">
                                                                        @break
                                                                        @case(3)
                                                                        <img src="{{ asset('image/NA.svg') }}" alt="Workflow">
                                                                        @break
                                                                        @default
                                                                        <img src="{{ asset('image/Mal.svg') }}" alt="Workflow">
                                                                        @endswitch
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="border sm:col-span-4 p-2 mt-1">
                                                            <div class="flex items-center  h-full">
                                                                <div class="col-nombre">
                                                                    <p class="dos-lineas">
                                                                        Fianza de cumplimiento: <span class="font-bold">{{ $obj_obra->get('contrato')->fianza_cumplimiento }}</span>
                                                                    </p>
                                                                </div>
                                                                <div class="col-estado pl-2">
                                                                    <div class="flex justify-center my-2">
                                                                        @switch($obj_obra->get('contrato')->exp_fianza_cumplimiento)
                                                                        @case(1)
                                                                        <img src="{{ asset('image/Bien.svg') }}" alt="Workflow">
                                                                        @break
                                                                        @case(3)
                                                                        <img src="{{ asset('image/NA.svg') }}" alt="Workflow">
                                                                        @break
                                                                        @default
                                                                        <img src="{{ asset('image/Mal.svg') }}" alt="Workflow">
                                                                        @endswitch
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="border sm:col-span-4 p-2 mt-1">
                                                            <div class="flex items-center  h-full">
                                                                <div class="col-nombre">
                                                                    <p class="dos-lineas">
                                                                        Fianza de vicios ocultos: <span class="font-bold">{{ $obj_obra->get('contrato')->fianza_v_o }}</span>
                                                                    </p>
                                                                </div>
                                                                <div class="col-estado pl-2">
                                                                    <div class="flex justify-center my-2">
                                                                        @switch($obj_obra->get('contrato')->exp_fianza_v_o)
                                                                        @case(1)
                                                                        <img src="{{ asset('image/Bien.svg') }}" alt="Workflow">
                                                                        @break
                                                                        @case(3)
                                                                        <img src="{{ asset('image/NA.svg') }}" alt="Workflow">
                                                                        @break
                                                                        @default
                                                                        <img src="{{ asset('image/Mal.svg') }}" alt="Workflow">
                                                                        @endswitch
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> 
                                            @else
                                                <div class="border sm:col-span-4 p-2">
                                                    <div class="flex items-center h-full">
                                                        <div class="col-nombre">
                                                            <p  class="dos-lineas">
                                                                Inventario de la maquinaria y equipo de construcción con que cuenta el municipio.
                                                            </p>
                                                        </div>
                                                        <div class="col-estado ml-2">
                                                            <div class="flex justify-center my-2">
                                                                @switch($obj_obra->get('admin')->inventario_maquinaria_construccion)
                                                                @case(1)
                                                                <img src="{{ asset('image/Bien.svg') }}" alt="Workflow">
                                                                @break
                                                                @case(3)
                                                                <img src="{{ asset('image/NA.svg') }}" alt="Workflow">
                                                                @break
                                                                @default
                                                                <img src="{{ asset('image/Mal.svg') }}" alt="Workflow">
                                                                @endswitch
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="border sm:col-span-4 p-2">
                                                    <div class="flex items-center h-full">
                                                        <div class="col-nombre">
                                                            <p  class="dos-lineas">
                                                                Relacion de la plantilla del personal tecnico y administrativo relacionado con la obra
                                                            </p>
                                                        </div>
                                                        <div class="col-estado ml-2">
                                                            <div class="flex justify-center my-2">
                                                                @switch($obj_obra->get('admin')->plantilla_personal)
                                                                @case(1)
                                                                <img src="{{ asset('image/Bien.svg') }}" alt="Workflow">
                                                                @break
                                                                @case(3)
                                                                <img src="{{ asset('image/NA.svg') }}" alt="Workflow">
                                                                @break
                                                                @default
                                                                <img src="{{ asset('image/Mal.svg') }}" alt="Workflow">
                                                                @endswitch
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="border sm:col-span-4 p-2">
                                                    <div class="flex items-center h-full">
                                                        <div class="col-nombre">
                                                            <p  class="dos-lineas">
                                                                Identificacion oficial de los trabajadores que aparecen en las listas de raya
                                                            </p>
                                                        </div>
                                                        <div class="col-estado ml-2">
                                                            <div class="flex justify-center my-2">
                                                                @switch($obj_obra->get('admin')->indentificacion_oficial_trabajadores)
                                                                @case(1)
                                                                <img src="{{ asset('image/Bien.svg') }}" alt="Workflow">
                                                                @break
                                                                @case(3)
                                                                <img src="{{ asset('image/NA.svg') }}" alt="Workflow">
                                                                @break
                                                                @default
                                                                <img src="{{ asset('image/Mal.svg') }}" alt="Workflow">
                                                                @endswitch
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="border sm:col-span-4 p-2">
                                                    <div class="flex items-center h-full">
                                                        <div class="col-nombre">
                                                            <p  class="dos-lineas">
                                                                Reporte fotográfico.
                                                            </p>
                                                        </div>
                                                        <div class="col-estado ml-2">
                                                            <div class="flex justify-center my-2">
                                                                @switch($obj_obra->get('admin')->reporte_fotografico)
                                                                @case(1)
                                                                <img src="{{ asset('image/Bien.svg') }}" alt="Workflow">
                                                                @break
                                                                @case(3)
                                                                <img src="{{ asset('image/NA.svg') }}" alt="Workflow">
                                                                @break
                                                                @default
                                                                <img src="{{ asset('image/Mal.svg') }}" alt="Workflow">
                                                                @endswitch
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="border sm:col-span-4 p-2">
                                                    <div class="flex items-center h-full">
                                                        <div class="col-nombre">
                                                            <p  class="dos-lineas">
                                                                Notas de bitácora.
                                                            </p>
                                                        </div>
                                                        <div class="col-estado ml-2">
                                                            <div class="flex justify-center my-2">
                                                                @switch($obj_obra->get('admin')->notas_bitacora)
                                                                @case(1)
                                                                <img src="{{ asset('image/Bien.svg') }}" alt="Workflow">
                                                                @break
                                                                @case(3)
                                                                <img src="{{ asset('image/NA.svg') }}" alt="Workflow">
                                                                @break
                                                                @default
                                                                <img src="{{ asset('image/Mal.svg') }}" alt="Workflow">
                                                                @endswitch
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="border sm:col-span-4 p-2">
                                                    <div class="flex items-center h-full">
                                                        <div class="col-nombre">
                                                            <p  class="dos-lineas">
                                                                Acta de entrega recepción.
                                                            </p>
                                                        </div>
                                                        <div class="col-estado ml-2">
                                                            <div class="flex justify-center my-2">
                                                                @switch($obj_obra->get('admin')->acta_entrega_municipio)
                                                                @case(1)
                                                                <img src="{{ asset('image/Bien.svg') }}" alt="Workflow">
                                                                @break
                                                                @case(3)
                                                                <img src="{{ asset('image/NA.svg') }}" alt="Workflow">
                                                                @break
                                                                @default
                                                                <img src="{{ asset('image/Mal.svg') }}" alt="Workflow">
                                                                @endswitch
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="border sm:col-span-4 p-2">
                                                    <div class="flex items-center h-full">
                                                        <div class="col-nombre">
                                                            <p  class="dos-lineas">
                                                                Cédula detallada de facturación total de la obra.
                                                            </p>
                                                        </div>
                                                        <div class="col-estado ml-2">
                                                            <div class="flex justify-center my-2">
                                                                @switch($obj_obra->get('admin')->cedula_detallada_facturacion)
                                                                @case(1)
                                                                <img src="{{ asset('image/Bien.svg') }}" alt="Workflow">
                                                                @break
                                                                @case(3)
                                                                <img src="{{ asset('image/NA.svg') }}" alt="Workflow">
                                                                @break
                                                                @default
                                                                <img src="{{ asset('image/Mal.svg') }}" alt="Workflow">
                                                                @endswitch
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                @if($listas_raya->first() != null)
                                                    <div class="border sm:col-span-8  p-2 mt-4">
                                                        <div class="flex items-center justify-center mb-3">
                                                            <div>
                                                                <p class="font-bold dos-lineas">
                                                                    Listas de raya
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="grid sm:grid-cols-8 gap-x-4 gap-y-1">
                                                            @foreach ($listas_raya as $key => $lista)
                                                                <div class="border sm:col-span-4 p-2 mt-1">
                                                                    <div class="flex items-center  h-full">
                                                                        <div class="col-nombre">
                                                                            <p class="dos-lineas">
                                                                               Lista de raya {{$lista->numero_lista_raya}}<br> Del {{date('d-m-Y', strtotime($lista->fecha_inicio))}} al {{date('d-m-Y', strtotime($lista->fecha_fin))}}
                                                                            </p>
                                                                        </div>
                                                                        <div class="col-estado pl-2">
                                                                            <div class="flex justify-center my-2">
                                                                                @switch($lista->agregado_expediente)
                                                                                @case(1)
                                                                                <img src="{{ asset('image/Bien.svg') }}" alt="Workflow">
                                                                                @break
                                                                                @case(3)
                                                                                <img src="{{ asset('image/NA.svg') }}" alt="Workflow">
                                                                                @break
                                                                                @default
                                                                                <img src="{{ asset('image/Mal.svg') }}" alt="Workflow">
                                                                                @endswitch
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                @endif 

                                                @if($facturas->first() != null)
                                                    <div class="border sm:col-span-8  p-2 mt-4">
                                                        <div class="flex items-center justify-center mb-3">
                                                            <div>
                                                                <p class="font-bold dos-lineas">
                                                                    Facturas
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="grid sm:grid-cols-8 gap-x-4 gap-y-1">
                                                            @foreach ($facturas as $key => $factura)
                                                                <div class="border sm:col-span-4 p-2 mt-1">
                                                                    <div class="flex items-center  h-full">
                                                                        <div class="col-nombre">
                                                                            <p>
                                                                               Factura  {{$factura->folio_fiscal}}
                                                                            </p>
                                                                        </div>
                                                                        <div class="col-estado pl-2">
                                                                            <div class="flex justify-center my-2">
                                                                                @switch($factura->agregado_expediente)
                                                                                @case(1)
                                                                                <img src="{{ asset('image/Bien.svg') }}" alt="Workflow">
                                                                                @break
                                                                                @case(3)
                                                                                <img src="{{ asset('image/NA.svg') }}" alt="Workflow">
                                                                                @break
                                                                                @default
                                                                                <img src="{{ asset('image/Mal.svg') }}" alt="Workflow">
                                                                                @endswitch
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                @endif 

                                                @if($contratos_arrendamiento->first() != null)
                                                
                                                    <div class="border sm:col-span-8  p-2 mt-4">
                                                        <div class="flex items-center justify-center mb-3">
                                                            <div>
                                                                <p class="font-bold dos-lineas">
                                                                    Contratos de arrendamiento
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="grid sm:grid-cols-8 gap-x-4 gap-y-1">
                                                            @foreach ($contratos_arrendamiento as $contrato)
                                                                <div class="border sm:col-span-4 p-2 mt-1">
                                                                    <div class="flex items-center  h-full">
                                                                        <div class="col-nombre">
                                                                            <p>
                                                                               Contrato {{$contrato->numero_contrato}}
                                                                            </p>
                                                                        </div>
                                                                        <div class="col-estado pl-2">
                                                                            <div class="flex justify-center my-2">
                                                                                @switch($contrato->agregado_expediente)
                                                                                @case(1)
                                                                                <img src="{{ asset('image/Bien.svg') }}" alt="Workflow">
                                                                                @break
                                                                                @case(3)
                                                                                <img src="{{ asset('image/NA.svg') }}" alt="Workflow">
                                                                                @break
                                                                                @default
                                                                                <img src="{{ asset('image/Mal.svg') }}" alt="Workflow">
                                                                                @endswitch
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                @endif 
                                            @endif
                                                 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--FIN DE DOCUMENTACIÓN COMPROBATORIA-->

                        <!--INICIO DE TERMINACIÓN DE LOS TRABAJOS-->
                        @if ($obj_obra->get('obra')->modalidad_ejecucion == 2)
                            <div class=" mt-3">
                                <div class="w-full ">
                                    <div x-data={show:false}>
                                        <div class="bg-transparent relative" id="headingOne">
                                            <button @click="show=!show" type="button" style="width:100%;">
                                                <div>
                                                    <div class="bg-gray-200">
                                                        <h2 class="font-semibold text-base text-center">Terminación de los trabajos</h2>
                                                    </div>
                                                    <div class="icon-acordeon mr-3 flex justify-center">
                                                        <div x-show="!show" class="flex down-simbolo">
                                                            <img src="{{ asset('image/down.svg') }}" alt="Workflow">
                                                        </div>
                                                        <div x-show="show" class="flex up-simbolo">
                                                            <img src="{{ asset('image/up.svg') }}" alt="Workflow">
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                            </button>
                                        </div>
                                        <div x-show="show" class="border mb-2 p-2">
                                            <div class="grid sm:grid-cols-8 gap-x-4 gap-y-1 mt-3">
                                                
                                                    <div class="border sm:col-span-4 p-2">
                                                        <div class="flex items-center h-full">
                                                            <div class="col-nombre">
                                                                <p class="dos-lineas">
                                                                    Presupuesto definitivo.
                                                                </p>
                                                            </div>
                                                            <div class="col-estado ml-2">
                                                                <div class="flex justify-center my-2">
                                                                    @switch($obj_obra->get('contrato')->presupuesto_definitivo)
                                                                    @case(1)
                                                                    <img src="{{ asset('image/Bien.svg') }}" alt="Workflow">
                                                                    @break
                                                                    @case(3)
                                                                    <img src="{{ asset('image/NA.svg') }}" alt="Workflow">
                                                                    @break
                                                                    @default
                                                                    <img src="{{ asset('image/Mal.svg') }}" alt="Workflow">
                                                                    @endswitch
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="border sm:col-span-4  p-2">
                                                        <div class="flex items-center h-full">
                                                            <div class="col-nombre">
                                                                <p class="dos-lineas">
                                                                    Actas de entrega de recepción fisica de los trabajos del contratista al municipio.
                                                                </p>
                                                            </div>
                                                            <div class="col-estado pl-2">
                                                                <div class="flex justify-center my-2">
                                                                    @switch($obj_obra->get('contrato')->acta_entrega_contratista)
                                                                    @case(1)
                                                                    <img src="{{ asset('image/Bien.svg') }}" alt="Workflow">
                                                                    @break
                                                                    @case(3)
                                                                    <img src="{{ asset('image/NA.svg') }}" alt="Workflow">
                                                                    @break
                                                                    @default
                                                                    <img src="{{ asset('image/Mal.svg') }}" alt="Workflow">
                                                                    @endswitch
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="border sm:col-span-4  p-2">
                                                        <div class="flex items-center h-full">
                                                            <div class="col-nombre">
                                                                <p class="dos-lineas">
                                                                    Actas de entrega de recepción fisica de los trabajos del municipio a los beneficiarios.
                                                                </p>
                                                            </div>
                                                            <div class="col-estado pl-2">
                                                                <div class="flex justify-center my-2">
                                                                    @switch($obj_obra->get('contrato')->acta_entrega_municipio)
                                                                    @case(1)
                                                                    <img src="{{ asset('image/Bien.svg') }}" alt="Workflow">
                                                                    @break
                                                                    @case(3)
                                                                    <img src="{{ asset('image/NA.svg') }}" alt="Workflow">
                                                                    @break
                                                                    @default
                                                                    <img src="{{ asset('image/Mal.svg') }}" alt="Workflow">
                                                                    @endswitch
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="border sm:col-span-4  p-2">
                                                        <div class="flex items-center h-full">
                                                            <div class="col-nombre">
                                                                <p class="dos-lineas">
                                                                    Acta de extinción de derechos y obligaciones.
                                                                </p>
                                                            </div>
                                                            <div class="col-estado pl-2">
                                                                <div class="flex justify-center my-2">
                                                                    @switch($obj_obra->get('contrato')->acta_extincion)
                                                                    @case(1)
                                                                    <img src="{{ asset('image/Bien.svg') }}" alt="Workflow">
                                                                    @break
                                                                    @case(3)
                                                                    <img src="{{ asset('image/NA.svg') }}" alt="Workflow">
                                                                    @break
                                                                    @default
                                                                    <img src="{{ asset('image/Mal.svg') }}" alt="Workflow">
                                                                    @endswitch
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="border sm:col-span-4  p-2">
                                                        <div class="flex items-center h-full">
                                                            <div class="col-nombre">
                                                                <p class="dos-lineas">
                                                                    Aviso de terminación de la obra por parte del contratista.
                                                                </p>
                                                            </div>
                                                            <div class="col-estado pl-2">
                                                                <div class="flex justify-center my-2">
                                                                    @switch($obj_obra->get('contrato')->aviso_terminacion_obra)
                                                                    @case(1)
                                                                    <img src="{{ asset('image/Bien.svg') }}" alt="Workflow">
                                                                    @break
                                                                    @case(3)
                                                                    <img src="{{ asset('image/NA.svg') }}" alt="Workflow">
                                                                    @break
                                                                    @default
                                                                    <img src="{{ asset('image/Mal.svg') }}" alt="Workflow">
                                                                    @endswitch
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="border sm:col-span-4  p-2">
                                                        <div class="flex items-center h-full">
                                                            <div class="col-nombre">
                                                                <p class="dos-lineas">
                                                                    Sabana de finiquito.
                                                                </p>
                                                            </div>
                                                            <div class="col-estado pl-2">
                                                                <div class="flex justify-center my-2">
                                                                    @switch($obj_obra->get('contrato')->saba_finiquito)
                                                                    @case(1)
                                                                    <img src="{{ asset('image/Bien.svg') }}" alt="Workflow">
                                                                    @break
                                                                    @case(3)
                                                                    <img src="{{ asset('image/NA.svg') }}" alt="Workflow">
                                                                    @break
                                                                    @default
                                                                    <img src="{{ asset('image/Mal.svg') }}" alt="Workflow">
                                                                    @endswitch
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> 
    
                                                    
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <!--FIN  DE TERMINACIÓN DE LOS TRABAJOS-->
                        <h2 class="font-semibold text-base text-center mt-3 bg-gray-200">Observaciones</h2>      
                        @if($observaciones != null)          
                            <div id="div_observaciones" class="text-sm font-semibold border p-2"></div>        
                        @else
                            <p class="text-sm font-semibold border p-2">Sin observaciones</p>
                        @endif
                        
                    </div>
                </div>
                @if($obj_obra->get('obra')->modalidad_ejecucion == 1)
                    <div class="tab_content" id="tab2">
                        <div class="">
                            <p class="font-bold text-lg text-center">Listas de raya de la obra</p>
                            @if($total_admin<$obj_obra->get('obra')->monto_contratado)
                                <div class="flex justify-center">
                                    <button type="button" href="" class="text-sm text-blue-500 underline background-transparent font-semibold outline-none focus:outline-none ease-linear transition-all duration-150 text-center" onclick="toggleModal('modal-lista-raya')">Agregar nueva lista de raya</button>
                                </div>
                            @endif
                            @if($listas_raya != null)
                                <div class="mt-5">
                                    <table id="example" class="table table_estimacion table-striped bg-white" style="width:100%;">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Núm.</th>
                                                <th class="text-center">Total</th>
                                                <th class="text-center">Periodo</th>
                                                <th class="text-center">ISR</th>
                                                <th class="text-center">Mano de obra</th>
                                                <th class="text-center">Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                            @foreach($listas_raya as $key => $lista)
                                                <tr>
                                                    <td>
                                                        <div class="text-sm leading-5 font-medium text-gray-900 text-center">
                                                            {{ $lista->numero_lista_raya}}
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="text-sm leading-5 font-medium text-gray-900 text-right">
                                                            {{ $service->formatNumber($lista->total) }}
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="text-sm leading-5 font-medium text-gray-900 text-right">
                                                        Del <b>{{ $service->formatDate($lista->fecha_inicio) }}</b><br>
                                                        Al <b>{{ $service->formatDate($lista->fecha_fin) }}</b>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="text-sm leading-5 font-medium text-gray-900 text-right">
                                                            {{ $service->formatNumber($lista->isr) }}
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="text-sm leading-5 font-medium text-gray-900 text-right">
                                                            {{ $service->formatNumber($lista->mano_obra) }}
                                                        </div>
                                                    </td>
                                                    
                                                    <td>
                                                        @if($key == count($listas_raya) - 1)
                                                            <div class="text-sm leading-5 font-medium text-gray-900 flex justify-center">
                                                                <button type="button" href="" class="bg-white text-sm text-blue-500 font-normal text-ms p-2 rounded rounded-lg" onclick="toggleModal_EditLista('modal-lista-raya-edit', {{$lista}}, '{{str_pad($lista->numero_lista_raya,3,'0',STR_PAD_LEFT)}}')">Editar</button>
                                                            </div>
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
                    <div class="tab_content" id="tab3">
                        <div class="">
                            <p class="font-bold text-lg text-center">Listas de contratos de arrendamiento</p>
                            @if($total_admin<$obj_obra->get('obra')->monto_contratado)
                                <div class="flex justify-center">
                                    <button type="button" href="" class="text-sm text-blue-500 underline background-transparent font-semibold outline-none focus:outline-none ease-linear transition-all duration-150 text-center" onclick="toggleModal('modal-agregar-contrato')">Agregar nuevo contrato de arrendamiento</button>
                                </div>
                            @endif
                            @if($contratos_arrendamiento != null)
                                <div class="mt-5">
                                    <table id="example" class="table table_estimacion table-striped bg-white" style="width:100%;">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Núm.</th>
                                                <th class="text-center">Núm. contrato</th>
                                                <th class="text-center">Fecha de contrato</th>
                                                <th class="text-center">Monto contratado</th>
                                                <th class="text-center">Periodo</th>
                                                <th class="text-center">Proveedor</th>
                                                <th class="text-center">Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                            @foreach($contratos_arrendamiento as $key => $contrato)
                                                <tr>
                                                    <td>
                                                        <div class="text-sm leading-5 font-medium text-gray-900 text-center">
                                                            {{ $key + 1 }}
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="text-sm leading-5 font-medium text-gray-900 text-center">
                                                            {{ $contrato->numero_contrato}}
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="text-sm leading-5 font-medium text-gray-900 text-right">
                                                            {{ $service->formatDate($contrato->fecha_contrato) }}
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="text-sm leading-5 font-medium text-gray-900 text-right">
                                                            {{ $service->formatNumber($contrato->monto_contratado) }}
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="text-sm leading-5 font-medium text-gray-900 text-right">
                                                        Del <b>{{ $service->formatDate($contrato->fecha_inicio) }}</b><br>
                                                        Al <b>{{ $service->formatDate($contrato->fecha_fin) }}</b>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="text-sm leading-5 font-medium text-gray-900 text-center">
                                                            {{ $contrato->razon_social}}
                                                        </div>
                                                    </td>
                                                    
                                                    <td>
                                                        
                                                            <div class="text-sm leading-5 font-medium text-gray-900 flex justify-center">
                                                                <a type="button" href="{{ route('show_contrato', ['id' => $contrato->id_contrato_arrendamiento, 'id_obra' => $obj_obra->get('obra')->id_obra]) }}" class="bg-white text-sm text-blue-500 font-normal text-ms p-2 rounded rounded-lg">Detalles</a>
                                                            </div>
                                                        
                                                    </td>

                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="tab_content" id="tab4">
                        <div class="">
                            <p class="font-bold text-lg text-center">Listas de facturas</p>
                            @if($total_admin<$obj_obra->get('obra')->monto_contratado)
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
                                                        @if($key == count($facturas) - 1)
                                                            <div class="text-sm leading-5 font-medium text-gray-900 flex justify-center">
                                                                <button type="button" href="" class="bg-white text-sm text-blue-500 font-normal text-ms p-2 rounded rounded-lg" onclick="toggleModal_EditFactura('modal-edit-factura', {{$factura}})">Editar</button>
                                                            </div>
                                                        @endif
                                                    </td>

                                                </tr>
                                                @if($key == count($facturas) - 1)
                                                    <script languaje="javascript">
                                                        setTimeout(estado_tabs,500);
                                                    </script>
                                                @endif
                                            @endforeach
                                            @if(count($facturas) == 0)
                                                <script languaje="javascript">
                                                    setTimeout(estado_tabs,500);
                                                </script>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>
                        
                    </div>
                @endif

                @if($obj_obra->get('obra')->modalidad_ejecucion == 2)
                    <div class="tab_content" id="tab2">

                        <div class="">
                            <p class="font-bold text-lg text-center">Pagos de la obra</p>
                            
                            @if($pagos_obra != null)
                                <div class="mt-5">
                                    <table id="example" class="table table_estimacion table-striped bg-white" style="width:100%;">
                                        <thead>
                                            <tr>
                                                <th class="text-center"><p  class="text-sm leading-5 font-bold text-gray-900 text-center line-height-1">Núm.</p></th>
                                                <th class="text-center"><p  class="text-sm leading-5 font-bold text-gray-900 text-center line-height-1"> Nombrel <br>de proceso</p></th>
                                                <th class="text-center"><p  class="text-sm leading-5 font-bold text-gray-900 text-center line-height-1">Recepcion <br>de documentos</p></th>
                                                <th class="text-center"><p  class="text-sm leading-5 font-bold text-gray-900 text-center line-height-1">Validación <br>de documentos</p></th>
                                                <th class="text-center"><p  class="text-sm leading-5 font-bold text-gray-900 text-center line-height-1">Pago <br>realizado</p></th>
                                                <th class="text-center"><p  class="text-sm leading-5 font-bold text-gray-900 text-center line-height-1">Acciones</p>
                                                
                                                
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                            
                                            @foreach($pagos_obra as $key => $pago)
                                                <tr>
                                                    <td>
                                                        <div class="text-sm leading-5 font-medium text-gray-900 text-center">
                                                            {{ $key + 1}}
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="text-sm leading-5 font-medium text-gray-900 text-center">
                                                            {{ $pago->nombre }}
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="text-sm leading-5 font-medium text-gray-900 text-center">
                                                            <div class="div-estado-proceso">
                                                                @if($pago->fecha_recepcion != null)
                                                                    <div class="flex justify-center">
                                                                        <img src="{{ asset('image/Bien.svg') }}" alt="Workflow">
                                                                    </div>
                                                                    <p class="font-bold">{{ $service->formatDate($pago->fecha_recepcion) }}</p>
                                                                @else
                                                                    <div class="flex justify-center">
                                                                        <img src="{{ asset('image/Mal.svg') }}" alt="Workflow">
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="text-sm leading-5 font-medium text-gray-900 text-center">
                                                            <div class="div-estado-proceso">
                                                                @if($pago->fecha_validacion != null)
                                                                    <div class="flex justify-center items-center">
                                                                        <img src="{{ asset('image/Bien.svg') }}" alt="Workflow">
                                                                    </div>
                                                                    <p class="font-bold">{{ $service->formatDate($pago->fecha_validacion) }}</p>
                                                                @else
                                                                    <div class="flex justify-center items-center">
                                                                        <img src="{{ asset('image/Mal.svg') }}" alt="Workflow">
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="text-sm leading-5 font-medium text-gray-900 text-center">
                                                            <div class="div-estado-proceso">
                                                                @if($pago->fecha_pago != null)
                                                                    <div class="flex justify-center">
                                                                        <img src="{{ asset('image/Bien.svg') }}" alt="Workflow">
                                                                    </div>
                                                                    <p class="font-bold">{{ $service->formatDate($pago->fecha_pago) }}</p>
                                                                @else
                                                                    <div class="flex justify-center">
                                                                        <img src="{{ asset('image/Mal.svg') }}" alt="Workflow">
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </td>
                                                
                                                    
                                                    <td>
                                                        <div class="text-sm leading-5 font-medium text-gray-900 flex">
                                                            
                                                            <a type="button" href="{{ route('show_pagos', $pago->id_desglose_pagos) }}" class="bg-white text-sm text-blue-500 font-normal text-ms p-2 rounded rounded-lg">Detalles</a>
                                                            
                                                        </div>
                                                    </td>

                                                </tr>
                                                
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="tab_content" id="tab3">

                        <div class="">
                            <p class="font-bold text-lg text-center">Estimaciones de la obra</p>
                            @if($obj_obra->get('obra')->monto_modificado==null?$total_pagado->total_estimacion<$obj_obra->get('obra')->monto_contratado:$total_pagado->total_estimacion<$obj_obra->get('obra')->monto_modificado)
                                <div class="flex justify-center">
                                    <button type="button" href="" class="text-sm text-blue-500 underline background-transparent font-semibold outline-none focus:outline-none ease-linear transition-all duration-150 text-center" onclick="toggleModal('modal-agregar-estimacion')">Agregar nueva estimacion</button>
                                </div>
                            @endif
                            @if($estimaciones!= null)
                                <div class="mt-5">
                                    <table id="example" class="table table_estimacion table-striped bg-white" style="width:100%;">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Núm.</th>
                                                <th class="text-center">Total</th>
                                                <th class="text-center">Retenciones</th>
                                                <th class="text-center">Amortización <br>del anticipo</th>
                                                <th class="text-center">Neto <br>pagado</th>
                                                <th class="text-center">Periodo</th>
                                                <th class="text-center">Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                            @foreach($estimaciones as $key => $estimacion)
                                                <tr>
                                                    <td>
                                                        <div class="text-sm leading-5 font-medium text-gray-900 text-center">
                                                            {{ $estimacion->numero_estimacion}}
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="text-sm leading-5 font-medium text-gray-900 text-right">
                                                            {{ $service->formatNumber($estimacion->total_estimacion) }}
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="text-sm leading-5 font-medium text-gray-900 text-right">
                                                            {{ $service->formatNumber($estimacion->supervicion_obra + $estimacion->mano_obra + $estimacion->cinco_millar + $estimacion->dos_millar) }}
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="text-sm leading-5 font-medium text-gray-900 text-right">
                                                            {{ $service->formatNumber($estimacion->amortizacion_anticipo) }}
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="text-sm leading-5 font-medium text-gray-900 text-right">
                                                            <b>{{ $service->formatNumber($estimacion->total_estimacion - ($estimacion->supervicion_obra + $estimacion->mano_obra + $estimacion->cinco_millar + $estimacion->dos_millar + $estimacion->amortizacion_anticipo)) }}</b>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="text-sm leading-5 font-medium text-gray-900 text-right">
                                                        Del <b>{{ $service->formatDate($estimacion->fecha_inicio) }}</b><br>
                                                        Al <b>{{ $service->formatDate($estimacion->fecha_final) }}</b>
                                                        </div>
                                                    </td>
                                                    
                                                    <td>
                                                        @if($estimacion->total_estimacion == null)
                                                            <div class="text-sm leading-5 font-medium text-gray-900 flex justify-center">
                                                                <button type="button" href="" class="bg-white text-sm text-blue-500 font-normal text-ms p-2 rounded rounded-lg" onclick="toggleModal_2('modal-agregar-estimacion-edit', {{$estimacion}})">Editar</button>
                                                            </div>
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
                    <div class="tab_content" id="tab4">
                        <div class="">
                            <p class="font-bold text-lg text-center">Convenios modificatorios de la obra</p>
                            <div class="flex justify-center">
                                <button type="button" href="" class="text-sm text-blue-500 underline background-transparent font-semibold outline-none focus:outline-none ease-linear transition-all duration-150 text-center" onclick="toggleModal('modal')">Agregar nuevo convenio modificatorio</button>
                            </div>
                            @if($convenios!= null)
                                <div class="mt-5">
                                    <table id="example" class="table table1 table-striped bg-white" style="width:100%;">
                                        <thead>
                                            <tr>
                                                <th>Núm.</th>
                                                <th>Núm. Convenio</th>
                                                <th>Fecha</th>
                                                <th>Tipo</th>
                                                <th>Dato Modificado</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @if(count($convenios) == 0)
                                                <script languaje="javascript">
                                                    setTimeout(estado_tabs,500);
                                                </script>
                                            @endif
                                            
                                            @foreach($convenios as $key => $convenio)
                                                <tr>
                                                    <td>
                                                        <div class="text-sm leading-5 font-medium text-gray-900 text-center">
                                                            {{ $key +1 }}
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="text-sm leading-5 font-medium text-gray-900">
                                                            {{ $convenio->numero_convenio_modificatorio }}
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="text-sm leading-5 font-medium text-gray-900">
                                                            {{ $service->formatDate($convenio->fecha_convenio) }}
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="text-sm leading-5 font-medium text-gray-900">
                                                            {{$convenio->tipo}}
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="text-sm leading-5 font-medium text-gray-900">
                                                            <p>
                                                                @switch($convenio->tipo)
                                                                    @case("Convenio modificatorio al monto del contrato")
                                                                        Monto modificado: <br><b>{{ $service->formatNumber($convenio->monto_modificado) }}</b>
                                                                    @break
                                                                    @case("Convenio modificatorio a la fecha del contrato")
                                                                        Fecha modificada: <br><b>{{ $service->formatDate($convenio->fecha_fin_modificada) }}</b>
                                                                    @break

                                                                    @case("Convenio modificatorio a las metas del contrato")
                                                                        Se ha modificado las metas iniciales del contrato.
                                                                    @break

                                                                    @case("Convenio modificatorio al monto y fecha de contrato")
                                                                        Monto modificado: <br><b>{{ $service->formatNumber($convenio->monto_modificado) }}</b>
                                                                    @break

                                                                    @case("Convenio modificatorio al monto y metas de contrato")
                                                                        Monto modificado: <br><b>{{ $service->formatNumber($convenio->monto_modificado) }}</b>
                                                                    @break

                                                                    @case("Convenio modificatorio a la fecha y metas de contrato")
                                                                        Fecha modificada: <br><b>{{ $service->formatDate($convenio->fecha_fin_modificada) }}</b>
                                                                    @break

                                                                    
                                                                    @default
                                                                        Monto modificado: <br><b>{{ $service->formatNumber($convenio->monto_modificado) }}</b><br>
                                                                        Fecha modificada: <br><b>{{ $service->formatDate($convenio->fecha_fin_modificada) }}</b>
                                                                @endswitch
                                                            </p>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="text-sm leading-5 font-medium text-gray-900 flex">
                                                            @if($key == count($convenios) - 1)
                                                                <button type="button" href="" class="bg-white text-sm text-blue-500 font-normal text-ms p-2 rounded rounded-lg" onclick="toggleModal_1('modal-edit', {{$convenio}})">Editar</button>
                                                            @endif
                                                        </div>
                                                    </td>
                                                </tr>
                                                @if($key == count($convenios) - 1)
                                                    
                                                    <script languaje="javascript">
                                                        setTimeout(estado_tabs,500);
                                                    </script>
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif
                
            </div>
        </div>
    </div>
</div>

@if($obj_obra->get('obra')->modalidad_ejecucion == 2)
    <!-- inicio modal -->
    <div class="hidden overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center" id="modal">
        <div class="relative w-auto my-6 mx-auto max-w-3xl">
        <!--content-->
        <div class="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none">
            <!--header-->
            <div class="flex items-start justify-between p-5 border-b border-solid border-blueGray-200 rounded-t">
            <h4 class="text-xl font-semibold">
                Agregar nuevo convenio modificatorio
            </h4>
            <button class="p-1 ml-auto bg-transparent border-0 text-black opacity-5 float-right text-3xl leading-none font-semibold outline-none focus:outline-none" onclick="toggleModal('modal')">
                <span class="bg-transparent text-black opacity-5 h-6 w-6 text-2xl block outline-none focus:outline-none">
                
                </span>
            </button>
            </div>
            <!--body-->
            <form action="{{ route('create_convenio') }}" method="POST" id="formulario_convenio" name="formulario_convenio">
            @csrf
            @method('POST')
            <div class="relative p-6 flex-auto">
                <div class="grid grid-cols-10 gap-4">
                    <input type="text" name="id_obra" id="id_obra" maxlength="40" class="hidden mt-1 focus:ring-blue-800 focus:border-blue-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ $obj_obra->get('obra')->id_obra }}">
                    <div class="col-span-5 sm:col-span-5 ">
                        <label for="contrato" class="block text-sm font-semibold text-gray-700">Número de convenio*</label>
                        <input type="text" name="numero_convenio_modificatorio" id="numero_convenio_modificatorio" maxlength="40" class="mt-1 focus:ring-blue-800 focus:border-blue-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ old('oficio_notificacion') }}">
                        <label id="error_numero_convenio_modificatorio" class="hidden text-base font-normal text-red-500" >Ingrese un número de convenio valido</label>
                    </div>
                    <div class="col-span-3 sm:col-span-5">
                        <label for="tipo" class="block text-sm font-semibold text-gray-700">Fuente de financiamiento *</label>
                        <select id="tipo" name="tipo" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">                
                            <option value="Convenio modificatorio al monto del contrato">Al monto del contrato</option>
                            <option value="Convenio modificatorio a la fecha del contrato">A la fecha del contrato</option>
                            <option value="Convenio modificatorio a las metas del contrato">A las metas del contrato</option>
                            <option value="Convenio modificatorio al monto y fecha de contrato">Al monto y fecha de contrato</option>
                            <option value="Convenio modificatorio al monto y metas de contrato">Al monto y metas de contrato</option>
                            <option value="Convenio modificatorio a la fecha y metas de contrato">A la fecha y metas de contrato</option>
                            <option value="Convenio modificatorio al monto, metas y fecha de contrato">Al monto, metas y fecha de contrato</option>
                        </select>
                    </div>
                    <div class="col-span-5">
                        <label for="fecha_convenio" class="block text-sm font-semibold text-gray-700">Fecha del convenio*</label>
                        <input type="date" name="fecha_convenio" id="fecha_convenio" min="{{$obj_obra->get('obra')->fecha_inicio_programada}}" max="{{$obj_obra->get('obra')->fecha_final_real}}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" >
                        <label id="error_fecha_convenio" class="hidden text-base font-normal text-red-500" >Ingrese un número de contrato valido</label>
                    </div>
                    <div id="mod_fecha_fin" class="hidden col-span-5">
                        <label for="fecha_fin_modificada" class="block text-sm font-semibold text-gray-700">Fecha final modificada*</label>
                        <input type="date" name="fecha_fin_modificada" id="fecha_fin_modificada" min="{{$obj_obra->get('obra')->fecha_inicio_programada}}" max="{{$obj_obra->get('obra')->ejercicio +1}}-03-31" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" >
                        <label id="error_fecha_fin" name="error_fecha_fin" class="hidden text-base font-normal text-red-500" >Seleccione una fecha valida</label>
                    </div>
                    <div id="monto_modificado_div" class="col-span-8 sm:col-span-5">
                        <label id="label_monto_modificado" for="label_monto_modificado" class="block text-sm font-bold text-gray-700">Monto modificado*</label>
                        <div class="relative ">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <span class="text-gray-700 text-base">
                            $
                            </span>
                        </div>
                        <input type="text" name="monto_modificado" id="monto_modificado" maxlength="20" class="pl-7  mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" placeholder="0.00">
                        </div>
                        <label id="error_monto" name="error_monto" class="hidden text-base font-normal text-red-500" >El monto a modificar es mayor que el ejercicido</label>
                    </div>
            </div>
            
            </div>
            <!--footer-->
            <div class=" p-4 border-t border-solid border-blueGray-200 rounded-b">
            
            <span class="block text-xs">Verifique los campos obligatorios marcados con un ( * ) </span>
            <div class="text-right">
            <button class="text-red-500 background-transparent font-bold uppercase px-6 py-2 text-sm outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="button" onclick="toggleModal('modal')">
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

    <div class="hidden overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center" id="modal-edit">
        <div class="relative w-auto my-6 mx-auto max-w-3xl">
        <!--content-->
        <div class="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none">
            <!--header-->
            <div class="flex items-start justify-between p-5 border-b border-solid border-blueGray-200 rounded-t">
            <h4 class="text-xl font-semibold">
                Editar convenio modificatorio
            </h4>
            <button class="p-1 ml-auto bg-transparent border-0 text-black opacity-5 float-right text-3xl leading-none font-semibold outline-none focus:outline-none" onclick="toggleModal('modal-edit')">
                <span class="bg-transparent text-black opacity-5 h-6 w-6 text-2xl block outline-none focus:outline-none">
                
                </span>
            </button>
            </div>
            <!--body-->
            <form action="{{ route('update_convenio') }}" method="POST" id="formulario_convenio_edit" name="formulario_convenio_edit">
            @csrf
            @method('POST')
            <div class="relative p-6 flex-auto">
                <div class="grid grid-cols-10 gap-4">
                    <input type="text" name="id_convenio_modificatorio" id="id_convenio_modificatorio" maxlength="40" class="hidden mt-1 focus:ring-blue-800 focus:border-blue-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="">
                    <div class="col-span-5 sm:col-span-5 ">
                        <label for="numero_convenio_modificatorio_edit" class="block text-sm font-semibold text-gray-700">Número de convenio*</label>
                        <input type="text" name="numero_convenio_modificatorio_edit" id="numero_convenio_modificatorio_edit" maxlength="40" class="mt-1 focus:ring-blue-800 focus:border-blue-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ old('oficio_notificacion') }}">
                        <label id="error_numero_convenio_modificatorio" class="hidden text-base font-normal text-red-500" >Ingrese un número de convenio valido</label>
                    </div>
                    <div class="col-span-3 sm:col-span-5">
                        <label for="tipo_edit" class="block text-sm font-semibold text-gray-700">Fuente de financiamiento *</label>
                        <select id="tipo_edit" name="tipo_edit" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">                
                            <option value="Convenio modificatorio al monto del contrato">Al monto del contrato</option>
                            <option value="Convenio modificatorio a la fecha del contrato">A la fecha del contrato</option>
                            <option value="Convenio modificatorio a las metas del contrato">A las metas del contrato</option>
                            <option value="Convenio modificatorio al monto y fecha de contrato">Al monto y fecha de contrato</option>
                            <option value="Convenio modificatorio al monto y metas de contrato">Al monto y metas de contrato</option>
                            <option value="Convenio modificatorio a la fecha y metas de contrato">A la fecha y metas de contrato</option>
                            <option value="Convenio modificatorio al monto, metas y fecha de contrato">Al monto, metas y fecha de contrato</option>
                        </select>
                    </div>
                    <div class="col-span-5">
                        <label for="fecha_convenio_edit" class="block text-sm font-semibold text-gray-700">Fecha del convenio*</label>
                        <input type="date" name="fecha_convenio_edit" id="fecha_convenio_edit" min="{{$obj_obra->get('obra')->fecha_inicio_programada}}" max="{{$obj_obra->get('obra')->fecha_final_real}}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" >
                        <label id="error_fecha_convenio_edit" class="hidden text-base font-normal text-red-500" >Ingrese un número de contrato valido</label>
                    </div>
                    <div id="mod_fecha_fin_edit" class="col-span-5">
                        <label for="fecha_fin_modificada_edit" class="block text-sm font-semibold text-gray-700">Fecha final modificada*</label>
                        <input type="date" name="fecha_fin_modificada_edit" id="fecha_fin_modificada_edit" min="{{$obj_obra->get('obra')->fecha_inicio_programada}}" max="{{$obj_obra->get('obra')->ejercicio +1}}-03-31" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" >
                        <label id="error_fecha_fin_edit" name="error_fecha_fin_edit" class="hidden text-base font-normal text-red-500" >Seleccione una fecha valida</label>
                    </div>
                    <div id="monto_modificado_edit_div" class="col-span-8 sm:col-span-5">
                        <label for="label_monto_modificado_edit" class="block text-sm font-bold text-gray-700">Monto modificado*</label>
                        <div class="relative ">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <span class="text-gray-700 text-base">
                            $
                            </span>
                        </div>
                        <input type="text" name="monto_modificado_edit" id="monto_modificado_edit" maxlength="20" class="pl-7  mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" placeholder="0.00">
                        </div>
                        <label id="error_monto_edit" name="error_monto_edit" class="hidden text-base font-normal text-red-500" >El monto a modificar es mayor que el ejercicido {{$service->formatNumber($total_pagado->total_obra + $obj_obra->get('obra')->anticipo_monto)}}</label>
                    </div>
            </div>
            
            </div>
            <!--footer-->
            <div class=" p-4 border-t border-solid border-blueGray-200 rounded-b">
            
            <span class="block text-xs">Verifique los campos obligatorios marcados con un ( * ) </span>
            <div class="text-right">
            <button class="text-red-500 background-transparent font-bold uppercase px-6 py-2 text-sm outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="button" onclick="toggleModal('modal-edit')">
                Cancelar
            </button>
            <button type="submit" id="btn-edit" class="bg-green-500 text-white active:bg-green-600 font-bold uppercase text-sm px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" >
                Guardar
            </button>
            </div>
            </div>
            </form>
        </div>
        </div>
    </div>

    <div class="hidden overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center" id="modal-agregar-estimacion">
        <div class="relative w-auto my-6 mx-auto max-w-3xl">
        <!--content-->
        <div class="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none">
            <!--header-->
            <div class="flex items-start justify-between p-5 border-b border-solid border-blueGray-200 rounded-t">
            <h4 class="text-xl font-semibold">
                Agregar nueva estimación
            </h4>
            <button class="p-1 ml-auto bg-transparent border-0 text-black opacity-5 float-right text-3xl leading-none font-semibold outline-none focus:outline-none" onclick="toggleModal('modal-agregar-estimacion')">
                <span class="bg-transparent text-black opacity-5 h-6 w-6 text-2xl block outline-none focus:outline-none">
                
                </span>
            </button>
            </div>
            <!--body-->
            <form action="{{ route('create_estimacion') }}" method="POST" id="formulario_create_estimacion" name="formulario_create_estimacion">
            @csrf
            @method('POST')
            <div class="relative p-6 flex-auto">
                <div class="grid grid-cols-9 gap-4">
                    <input type="text" name="id_obra_contrato" class="hidden mt-1 focus:ring-blue-800 focus:border-blue-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ $obj_obra->get('contrato')->obra_contrato_id }}">
                    <div class="col-span-2 sm:col-span-3 ">
                        <label for="contrato" class="block text-sm font-bold text-gray-700">Número de estimación*</label>
                        <div class="mt-1 py-2 px-3">
                            <label id="label_numero_estimacion" class="text-base">{{count($estimaciones) + 1}}</label>
                        </div>  
                        <input type="text" name="numero_estimacion" id="numero_estimacion" class="hidden mt-1 focus:ring-blue-800 focus:border-blue-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{count($estimaciones) + 1}}">
                        <label id="error_numero_estimacion" class="hidden text-base font-normal text-red-500" >Ingrese un número de estimación valido</label>
                    </div>
                    <div class="col-span-3 sm:col-span-3 ">
                        <label for="contrato" class="block text-sm font-bold text-gray-700 text-center">¿Es finiquito?</label>
                        <div class="mt-1 py-2">
                            <div class="col-span-8 md:col-span-8">
                                <div class="form-group">
                                    <div class="grid grid-cols-8">
                                        <div class="col-span-4 flex justify-center">
                                            <div>
                                                <input type="radio" value="0" checked id="n_finiquito" name="finiquito">
                                                <label for="n_finiquito" class="text-base font-medium text-gray-700"> No</label>
                                            </div>
                                        </div>
                                        <div class="col-span-4 flex justify-center">
                                            <div>
                                                <input type="radio" value="1" id="s_finiquito" name="finiquito">
                                                <label for="s_finiquito" class="text-base font-medium text-gray-700">Si</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>  
                    </div>

                    <div class="col-span-4">
                        <label for="fecha_recepcion" class="block text-sm font-bold text-gray-700">Fecha de recepción de documentos*</label>
                        <input type="date" name="fecha_recepcion" id="fecha_recepcion" min="{{$obj_obra->get('obra')->fecha_inicio_programada}}" max="{{$obj_obra->get('obra')->fecha_final_real}}" class="mt-1 focus:ring-blue-800 focus:border-blue-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ old('fecha_oficio_notificacion') }}">
                        <label id="error_fecha_recepcion" class="hidden text-base font-normal text-red-500" >Ingrese una fecha de recepción de documentos valida</label>
                    </div>
                    
                    
                    <!--<div class="col-span-8 sm:col-span-5">
                        <label id="label_monto_modificado" for="label_monto_modificado" class="block text-sm font-bold text-gray-700">Total de la estimación*</label>
                        <div class="relative ">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <span class="text-gray-700 text-base">
                            $
                            </span>
                        </div>
                        <input type="text" name="total_estimacion" id="total_estimacion" maxlength="20" class="pl-7  mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" placeholder="0.00">
                        </div>
                        <label id="error_total_estimacion" name="error_total_estimacion" class="hidden text-base font-normal text-red-500" >El monto de la estimación es mayor al monto restante de la obra.</label>
                    </div>-->
                    <div class="col-span-10">
                        <label for="ejecucion" class="block text-sm font-bold text-gray-700 text-center">Periodo de la estimación</label>
                        <div class="grid grid-cols-4 gap-4">
                            <div class="col-span-2">
                                <input type="date" name="fecha_inicio_estimacion" id="fecha_inicio_estimacion" min="{{$obj_obra->get('obra')->fecha_inicio_programada}}" max="{{$obj_obra->get('obra')->fecha_final_real}}" class="mt-1 focus:ring-blue-800 focus:border-blue-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ old('fecha_oficio_notificacion') }}">
                                <label for="fecha_inicio_estimacion" class="block text-sm font-semibold text-gray-700 text-center">Fecha de inicio*</label>
                                <label id="error_fecha_inicio_estimacion" class="hidden text-base font-normal text-red-500" >Ingrese una fecha de inicio valida</label>
                            </div>
                            <div class="col-span-2">
                                <input type="date" name="fecha_fin_estimacion" id="fecha_fin_estimacion" min="{{$obj_obra->get('obra')->fecha_inicio_programada}}" max="{{$obj_obra->get('obra')->fecha_final_real}}"  class="mt-1 focus:ring-blue-800 focus:border-blue-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ old('fecha_oficio_notificacion') }}">
                                <label for="fecha_fin_estimacion" class="block text-sm font-semibold text-gray-700 text-center">Fecha de fin*</label>
                                <label id="error_fecha_fin_estimacion" class="hidden text-base font-normal text-red-500" >Ingrese una fecha final valida</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-5">

                    </div>
                    
                    

                    <!--<div class="col-span-10">
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
                            </div>
                        </div>
                    </div>

                    <div class="col-span-4 sm:col-span-5">  
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
                    </div>
                    <div class="col-span-8 md:col-span-5">
                        <label  id="label_folio_factura" for="cliente_id" class="block text-sm font-bold text-gray-700">Folio de factura:</label>
                        <input type="text" name="folio_factura" id="folio_factura" maxlength="36" class="mt-1 focus:ring-blue-800 focus:border-blue-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ old('oficio_notificacion') }}">
                        <label id="error_folio_factura" name="error_folio_factura" class="hidden text-base font-normal text-red-500" >Ingrese un folio de factura valido.</label>
                    </div>

                    <div class="col-span-10">
                        <label for="ejecucion" class="block text-sm font-bold text-gray-700 text-center">Neto a pagar</label>
                        <label id="label_monto_neto" class="block text-base font-medium text-gray-700 py-3 px-2 text-center">$ 0.00</label>
                        <div id="div_error_guardar" class="hidden mx-10 text-center">
                            <label  class="text-base font-normal text-red-500 text-center font-bold" >El neto a pagar no puede ser menos a cero.</label>
                        </div>
                    </div>-->
                    
            </div>
            
            </div>
            <!--footer-->
            <div class=" p-4 border-t border-solid border-blueGray-200 rounded-b">
            
            <span class="block text-xs">Verifique los campos obligatorios marcados con un ( * ) </span>
            <div class="text-right">
            <button class="text-red-500 background-transparent font-bold uppercase px-6 py-2 text-sm outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="button" onclick="toggleModal('modal-agregar-estimacion')">
                Cancelar
            </button>
            <button type="submit" id="btn-create-estimacion" class="bg-green-500 text-white active:bg-green-600 font-bold uppercase text-sm px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" >
                Guardar
            </button>
            </div>
            </div>
            </form>
        </div>
        </div>
    </div>

    <div class="hidden overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center" id="modal-agregar-estimacion-edit">
        <div class="relative w-auto my-6 mx-auto max-w-3xl">
        <!--content-->
        <div class="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none">
            <!--header-->
            <div class="flex items-start justify-between p-5 border-b border-solid border-blueGray-200 rounded-t">
            <h4 class="text-xl font-semibold">
                Agregar nueva estimación
            </h4>
            <button class="p-1 ml-auto bg-transparent border-0 text-black opacity-5 float-right text-3xl leading-none font-semibold outline-none focus:outline-none" onclick="toggleModal('modal-agregar-estimacion-edit')">
                <span class="bg-transparent text-black opacity-5 h-6 w-6 text-2xl block outline-none focus:outline-none">
                
                </span>
            </button>
            </div>
            <!--body-->
            <form action="{{ route('update_estimacion') }}" method="POST" id="formulario_create_estimacion_edit" name="formulario_create_estimacion_edit">
            @csrf
            @method('POST')
            <div class="relative p-6 flex-auto">
                <div class="grid grid-cols-9 gap-4">
                    <input type="text" name="id_estimacion_edit" id="id_estimacion_edit" class="hidden mt-1 focus:ring-blue-800 focus:border-blue-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="">
                    <div class="col-span-2 sm:col-span-2 ">
                        <label for="contrato" class="block text-sm font-bold text-gray-700">Número de estimación*</label>
                        <div class="mt-1 py-2 px-3">
                            <label id="label_numero_estimacion_edit" class="text-base">{{count($estimaciones) + 1}}</label>
                        </div>  
                        <input type="text" name="numero_estimacion_edit" id="numero_estimacion_edit" class="hidden mt-1 focus:ring-blue-800 focus:border-blue-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{count($estimaciones) + 1}}">
                        <label id="error_numero_estimacion_edit" class="hidden text-base font-normal text-red-500" >Ingrese un número de estimación valido</label>
                    </div>
                    <div class="col-span-3 sm:col-span-3 ">
                        <label for="contrato" class="block text-sm font-bold text-gray-700 text-center">¿Es finiquito?</label>
                        <div class="mt-1 py-2">
                            <div class="col-span-8 md:col-span-8">
                                <div class="form-group">
                                    <div class="grid grid-cols-8">
                                        <div class="col-span-4 flex justify-center">
                                            <div>
                                                <input type="radio" value="0" id="n_finiquito_edit" name="finiquito_edit">
                                                <label for="n_finiquito_edit" class="text-base font-medium text-gray-700"> No</label>
                                            </div>
                                        </div>
                                        <div class="col-span-4 flex justify-center">
                                            <div>
                                                <input type="radio" value="1" id="s_finiquito_edit" name="finiquito_edit">
                                                <label for="s_finiquito_edit" class="text-base font-medium text-gray-700">Si</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>  
                    </div>

                    <div class="col-span-4">
                        <label for="fecha_recepcion" class="block text-sm font-bold text-gray-700">Fecha de recepción de documentos*</label>
                        <input type="date" name="fecha_recepcion_edit" id="fecha_recepcion_edit" min="{{$obj_obra->get('obra')->fecha_inicio_programada}}" max="{{$obj_obra->get('obra')->ejercicio+1}}-03-31" class="mt-1 focus:ring-blue-800 focus:border-blue-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ old('fecha_oficio_notificacion') }}">
                        <label id="error_fecha_recepcion_edit" class="hidden text-base font-normal text-red-500" >Ingrese una fecha de recepción de documentos valida</label>
                    </div>
                    
                    
                    <!--<div class="col-span-8 sm:col-span-5">
                        <label id="label_monto_modificado" for="label_monto_modificado" class="block text-sm font-bold text-gray-700">Total de la estimación*</label>
                        <div class="relative ">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <span class="text-gray-700 text-base">
                            $
                            </span>
                        </div>
                        <input type="text" name="total_estimacion" id="total_estimacion" maxlength="20" class="pl-7  mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" placeholder="0.00">
                        </div>
                        <label id="error_total_estimacion" name="error_total_estimacion" class="hidden text-base font-normal text-red-500" >El monto de la estimación es mayor al monto restante de la obra.</label>
                    </div>-->
                    <div class="col-span-9">
                        <label for="ejecucion" class="block text-sm font-bold text-gray-700 text-center">Periodo de la estimación</label>
                        <div class="grid grid-cols-4 gap-4">
                            <div class="col-span-2">
                                <input type="date" name="fecha_inicio_estimacion_edit" id="fecha_inicio_estimacion_edit" min="{{$obj_obra->get('obra')->fecha_inicio_programada}}" max="{{$obj_obra->get('obra')->ejercicio+1}}-03-31" class="mt-1 focus:ring-blue-800 focus:border-blue-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ old('fecha_oficio_notificacion') }}">
                                <label for="fecha_inicio_estimacion_edit" class="block text-sm font-semibold text-gray-700 text-center">Fecha de inicio*</label>
                                <label id="error_fecha_inicio_estimacion_edit" class="hidden text-base font-normal text-red-500" >Ingrese una fecha de inicio valida</label>
                            </div>
                            <div class="col-span-2">
                                <input type="date" name="fecha_fin_estimacion_edit" id="fecha_fin_estimacion_edit" min="{{$obj_obra->get('obra')->fecha_inicio_programada}}" max="{{$obj_obra->get('obra')->ejercicio+1}}-03-31"  class="mt-1 focus:ring-blue-800 focus:border-blue-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ old('fecha_oficio_notificacion') }}">
                                <label for="fecha_fin_estimacion_edit" class="block text-sm font-semibold text-gray-700 text-center">Fecha de fin*</label>
                                <label id="error_fecha_fin_estimacion_edit" class="hidden text-base font-normal text-red-500" >Ingrese una fecha final valida</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-5">

                    </div>
                    
                    

                    <!--<div class="col-span-10">
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
                            </div>
                        </div>
                    </div>

                    <div class="col-span-4 sm:col-span-5">  
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
                    </div>
                    <div class="col-span-8 md:col-span-5">
                        <label  id="label_folio_factura" for="cliente_id" class="block text-sm font-bold text-gray-700">Folio de factura:</label>
                        <input type="text" name="folio_factura" id="folio_factura" maxlength="36" class="mt-1 focus:ring-blue-800 focus:border-blue-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ old('oficio_notificacion') }}">
                        <label id="error_folio_factura" name="error_folio_factura" class="hidden text-base font-normal text-red-500" >Ingrese un folio de factura valido.</label>
                    </div>

                    <div class="col-span-10">
                        <label for="ejecucion" class="block text-sm font-bold text-gray-700 text-center">Neto a pagar</label>
                        <label id="label_monto_neto" class="block text-base font-medium text-gray-700 py-3 px-2 text-center">$ 0.00</label>
                        <div id="div_error_guardar" class="hidden mx-10 text-center">
                            <label  class="text-base font-normal text-red-500 text-center font-bold" >El neto a pagar no puede ser menos a cero.</label>
                        </div>
                    </div>-->
                    
            </div>
            
            </div>
            <!--footer-->
            <div class=" p-4 border-t border-solid border-blueGray-200 rounded-b">
            
            <span class="block text-xs">Verifique los campos obligatorios marcados con un ( * ) </span>
            <div class="text-right">
            <button class="text-red-500 background-transparent font-bold uppercase px-6 py-2 text-sm outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="button" onclick="toggleModal('modal-agregar-estimacion-edit')">
                Cancelar
            </button>
            <button type="submit" id="btn-create-estimacion" class="bg-green-500 text-white active:bg-green-600 font-bold uppercase text-sm px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" >
                Guardar
            </button>
            </div>
            </div>
            </form>
        </div>
        </div>
    </div>

    <div class="hidden overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center" id="modal-update-pago">
        <div class="relative w-auto my-6 mx-auto max-w-3xl">
        <!--content-->
        <div class="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none">
            <!--header-->
            <div class="flex items-start justify-between p-5 border-b border-solid border-blueGray-200 rounded-t">
                <h4 class="text-xl font-semibold">
                    Actualizar proceso de pago de
                    <label id="nombre_pago"></label>
                </h4>
            <button class="p-1 ml-auto bg-transparent border-0 text-black opacity-5 float-right text-3xl leading-none font-semibold outline-none focus:outline-none" onclick="toggleModal('modal-update_pago')">
                <span class="bg-transparent text-black opacity-5 h-6 w-6 text-2xl block outline-none focus:outline-none">
                
                </span>
            </button>
            </div>
            <!--body-->
            <form action="{{ route('create_estimacion') }}" method="POST" id="formulario_update_pago" name="formulario_update_pago">
            @csrf
            @method('POST')
            <div class="relative p-6 flex-auto">
                <div class="grid grid-cols-10 gap-4">
                    <input type="text" name="id_pago_desglose" class="hidden mt-1 focus:ring-blue-800 focus:border-blue-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="">
                    <div class="col-span-5">
                        <label for="fecha_recepcion" class="block text-sm font-semibold text-gray-700 text-center">Fecha de recepción de documentos*</label>
                        <input type="date" name="fecha_recepcion" id="fecha_recepcion" min="{{$obj_obra->get('obra')->fecha_inicio_programada}}" max="{{$obj_obra->get('obra')->fecha_final_real}}" class="mt-1 focus:ring-blue-800 focus:border-blue-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ old('fecha_oficio_notificacion') }}">
                        <label id="error_fecha_recepcion" class="hidden text-base font-normal text-red-500" >Ingrese una fecha valida</label>
                    </div>
                    <div class="col-span-5">
                        <label for="fecha_recepcion" class="block text-sm font-semibold text-gray-700 text-center">Fecha de observaciones de documentos*</label>
                        <input type="date" name="fecha_recepcion" id="fecha_recepcion" min="{{$obj_obra->get('obra')->fecha_inicio_programada}}" max="{{$obj_obra->get('obra')->fecha_final_real}}" class="mt-1 focus:ring-blue-800 focus:border-blue-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ old('fecha_oficio_notificacion') }}">
                        <label id="error_fecha_recepcion" class="hidden text-base font-normal text-red-500" >Ingrese una fecha valida</label>
                    </div>
                    <div class="col-span-5">
                        <label for="fecha_recepcion" class="block text-sm font-semibold text-gray-700 text-center">Fecha de solventación de observaciones*</label>
                        <input type="date" name="fecha_recepcion" id="fecha_recepcion" min="{{$obj_obra->get('obra')->fecha_inicio_programada}}" max="{{$obj_obra->get('obra')->fecha_final_real}}" class="mt-1 focus:ring-blue-800 focus:border-blue-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ old('fecha_oficio_notificacion') }}">
                        <label id="error_fecha_recepcion" class="hidden text-base font-normal text-red-500" >Ingrese una fecha valida</label>
                    </div>
                    <div class="col-span-5">
                        <label for="fecha_recepcion" class="block text-sm font-semibold text-gray-700 text-center">Fecha de validación de documentos*</label>
                        <input type="date" name="fecha_recepcion" id="fecha_recepcion" min="{{$obj_obra->get('obra')->fecha_inicio_programada}}" max="{{$obj_obra->get('obra')->fecha_final_real}}" class="mt-1 focus:ring-blue-800 focus:border-blue-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ old('fecha_oficio_notificacion') }}">
                        <label id="error_fecha_recepcion" class="hidden text-base font-normal text-red-500" >Ingrese una fecha valida</label>
                    </div>

                    <div class="col-span-5">
                        <label for="fecha_recepcion" class="block text-sm font-semibold text-gray-700 text-center">Fecha de documentos*</label>
                        <input type="date" name="fecha_recepcion" id="fecha_recepcion" min="{{$obj_obra->get('obra')->fecha_inicio_programada}}" max="{{$obj_obra->get('obra')->fecha_final_real}}" class="mt-1 focus:ring-blue-800 focus:border-blue-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ old('fecha_oficio_notificacion') }}">
                        <label id="error_fecha_recepcion" class="hidden text-base font-normal text-red-500" >Ingrese una fecha valida</label>
                    </div>
                    <div class="col-span-10">
                        <label for="ejecucion" class="block text-sm font-bold text-gray-700 text-center">Periodo de la estimación</label>
                        <div class="grid grid-cols-4 gap-4">
                            <div class="col-span-2">
                                <input type="date" name="fecha_inicio_estimacion" id="fecha_inicio_estimacion" min="{{$obj_obra->get('obra')->fecha_inicio_programada}}" max="{{$obj_obra->get('obra')->fecha_final_real}}" class="mt-1 focus:ring-blue-800 focus:border-blue-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ old('fecha_oficio_notificacion') }}">
                                <label for="fecha_inicio_estimacion" class="block text-sm font-semibold text-gray-700 text-center">Fecha de inicio*</label>
                                <label id="error_fecha_inicio_estimacion" class="hidden text-base font-normal text-red-500" >Ingrese una fecha de inicio valida</label>
                            </div>
                            <div class="col-span-2">
                                <input type="date" name="fecha_fin_estimacion" id="fecha_fin_estimacion" min="{{$obj_obra->get('obra')->fecha_inicio_programada}}" max="{{$obj_obra->get('obra')->fecha_final_real}}"  class="mt-1 focus:ring-blue-800 focus:border-blue-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ old('fecha_oficio_notificacion') }}">
                                <label for="fecha_fin_estimacion" class="block text-sm font-semibold text-gray-700 text-center">Fecha de fin*</label>
                                <label id="error_fecha_fin_estimacion" class="hidden text-base font-normal text-red-500" >Ingrese una fecha final valida</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-5">

                    </div>
                    <div class="col-span-5">
                        
                        <input type="date" name="fecha_recepcion" id="fecha_recepcion" min="{{$obj_obra->get('obra')->fecha_inicio_programada}}" max="{{$obj_obra->get('obra')->fecha_final_real}}" class="mt-1 focus:ring-blue-800 focus:border-blue-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ old('fecha_oficio_notificacion') }}">
                        <label for="fecha_recepcion" class="block text-sm font-semibold text-gray-700 text-right">Fecha de recepción de documentos*</label>
                        <label id="error_fecha_recepcion" class="hidden text-base font-normal text-red-500" >Ingrese una fecha de inicio valida</label>
                    </div>
                    

                    <!--<div class="col-span-10">
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
                            </div>
                        </div>
                    </div>

                    <div class="col-span-4 sm:col-span-5">  
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
                    </div>
                    <div class="col-span-8 md:col-span-5">
                        <label  id="label_folio_factura" for="cliente_id" class="block text-sm font-bold text-gray-700">Folio de factura:</label>
                        <input type="text" name="folio_factura" id="folio_factura" maxlength="36" class="mt-1 focus:ring-blue-800 focus:border-blue-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ old('oficio_notificacion') }}">
                        <label id="error_folio_factura" name="error_folio_factura" class="hidden text-base font-normal text-red-500" >Ingrese un folio de factura valido.</label>
                    </div>

                    <div class="col-span-10">
                        <label for="ejecucion" class="block text-sm font-bold text-gray-700 text-center">Neto a pagar</label>
                        <label id="label_monto_neto" class="block text-base font-medium text-gray-700 py-3 px-2 text-center">$ 0.00</label>
                        <div id="div_error_guardar" class="hidden mx-10 text-center">
                            <label  class="text-base font-normal text-red-500 text-center font-bold" >El neto a pagar no puede ser menos a cero.</label>
                        </div>
                    </div>-->
                    
            </div>
            
            </div>
            <!--footer-->
            <div class=" p-4 border-t border-solid border-blueGray-200 rounded-b">
            
            <span class="block text-xs">Verifique los campos obligatorios marcados con un ( * ) </span>
            <div class="text-right">
            <button class="text-red-500 background-transparent font-bold uppercase px-6 py-2 text-sm outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="button" onclick="toggleModal('modal-agregar-estimacion')">
                Cancelar
            </button>
            <button type="submit" id="btn-create-estimacion" class="bg-green-500 text-white active:bg-green-600 font-bold uppercase text-sm px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" >
                Guardar
            </button>
            </div>
            </div>
            </form>
        </div>
        </div>
    </div>

    <div class="hidden overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center" id="modal-proceso-validacion">
        <div class="relative w-auto my-6 mx-auto max-w-3xl">
        <!--content-->
        <div class="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none">
            <!--header-->
            <div class="flex items-start justify-between p-5 border-b border-solid border-blueGray-200 rounded-t">
                <h4 class="text-xl font-semibold">
                    Proceso de validación
                </h4>
            <button class="p-1 ml-auto bg-transparent border-0 text-black opacity-5 float-right text-3xl leading-none font-semibold outline-none focus:outline-none" onclick="toggleModal('modal-proceso-validacion')">
                <span class="bg-transparent text-black opacity-5 h-6 w-6 text-2xl block outline-none focus:outline-none">
                
                </span>
            </button>
            </div>
            <!--body-->
            <table id="example" class="table table_estimacion table-striped bg-white" style="width:100%;">
                <thead>
                    <tr>
                        <th class="text-center"><p  class="text-sm leading-5 font-bold text-gray-900 text-center line-height-1">Observaciones</p></th>
                        <th class="text-center"><p  class="text-sm leading-5 font-bold text-gray-900 text-center line-height-1">Solventación</p></th>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    
                        <tr>
                            <td>
                                <div class="text-sm leading-5 font-medium text-gray-900 text-center">
                                </div>
                            </td>
                            <td>
                                <div class="text-sm leading-5 font-medium text-gray-900 text-center">
                                </div>
                            </td>
                            

                        </tr>
                        
                </tbody>
            </table>
            <form action="{{ route('create_estimacion') }}" method="POST" id="formulario_update_pago" name="formulario_update_pago">
            @csrf
            @method('POST')
            <div class="relative p-6 flex-auto">
                <div class="grid grid-cols-10 gap-4">
                    <input type="text" name="id_pago_desglose" class="hidden mt-1 focus:ring-blue-800 focus:border-blue-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="">
                    <div class="col-span-5">
                        <label for="fecha_recepcion" class="block text-sm font-semibold text-gray-700 text-center">Fecha de recepción de documentos*</label>
                        <input type="date" name="fecha_recepcion" id="fecha_recepcion" min="{{$obj_obra->get('obra')->fecha_inicio_programada}}" max="{{$obj_obra->get('obra')->fecha_final_real}}" class="mt-1 focus:ring-blue-800 focus:border-blue-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ old('fecha_oficio_notificacion') }}">
                        <label id="error_fecha_recepcion" class="hidden text-base font-normal text-red-500" >Ingrese una fecha valida</label>
                    </div>
                    <div class="col-span-5">
                        <label for="fecha_recepcion" class="block text-sm font-semibold text-gray-700 text-center">Fecha de observaciones de documentos*</label>
                        <input type="date" name="fecha_recepcion" id="fecha_recepcion" min="{{$obj_obra->get('obra')->fecha_inicio_programada}}" max="{{$obj_obra->get('obra')->fecha_final_real}}" class="mt-1 focus:ring-blue-800 focus:border-blue-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ old('fecha_oficio_notificacion') }}">
                        <label id="error_fecha_recepcion" class="hidden text-base font-normal text-red-500" >Ingrese una fecha valida</label>
                    </div>
                    <div class="col-span-5">
                        <label for="fecha_recepcion" class="block text-sm font-semibold text-gray-700 text-center">Fecha de solventación de observaciones*</label>
                        <input type="date" name="fecha_recepcion" id="fecha_recepcion" min="{{$obj_obra->get('obra')->fecha_inicio_programada}}" max="{{$obj_obra->get('obra')->fecha_final_real}}" class="mt-1 focus:ring-blue-800 focus:border-blue-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ old('fecha_oficio_notificacion') }}">
                        <label id="error_fecha_recepcion" class="hidden text-base font-normal text-red-500" >Ingrese una fecha valida</label>
                    </div>
                    <div class="col-span-5">
                        <label for="fecha_recepcion" class="block text-sm font-semibold text-gray-700 text-center">Fecha de validación de documentos*</label>
                        <input type="date" name="fecha_recepcion" id="fecha_recepcion" min="{{$obj_obra->get('obra')->fecha_inicio_programada}}" max="{{$obj_obra->get('obra')->fecha_final_real}}" class="mt-1 focus:ring-blue-800 focus:border-blue-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ old('fecha_oficio_notificacion') }}">
                        <label id="error_fecha_recepcion" class="hidden text-base font-normal text-red-500" >Ingrese una fecha valida</label>
                    </div>

                    <div class="col-span-5">
                        <label for="fecha_recepcion" class="block text-sm font-semibold text-gray-700 text-center">Fecha de documentos*</label>
                        <input type="date" name="fecha_recepcion" id="fecha_recepcion" min="{{$obj_obra->get('obra')->fecha_inicio_programada}}" max="{{$obj_obra->get('obra')->fecha_final_real}}" class="mt-1 focus:ring-blue-800 focus:border-blue-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ old('fecha_oficio_notificacion') }}">
                        <label id="error_fecha_recepcion" class="hidden text-base font-normal text-red-500" >Ingrese una fecha valida</label>
                    </div>
                    <div class="col-span-10">
                        <label for="ejecucion" class="block text-sm font-bold text-gray-700 text-center">Periodo de la estimación 1</label>
                        <div class="grid grid-cols-4 gap-4">
                            <div class="col-span-2">
                                <input type="date" name="fecha_inicio_estimacion" id="fecha_inicio_estimacion" min="{{$obj_obra->get('obra')->fecha_inicio_programada}}" max="{{$obj_obra->get('obra')->fecha_final_real}}" class="mt-1 focus:ring-blue-800 focus:border-blue-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ old('fecha_oficio_notificacion') }}">
                                <label for="fecha_inicio_estimacion" class="block text-sm font-semibold text-gray-700 text-center">Fecha de inicio*</label>
                                <label id="error_fecha_inicio_estimacion" class="hidden text-base font-normal text-red-500" >Ingrese una fecha de inicio valida</label>
                            </div>
                            <div class="col-span-2">
                                <input type="date" name="fecha_fin_estimacion" id="fecha_fin_estimacion" min="{{$obj_obra->get('obra')->fecha_inicio_programada}}" max="{{$obj_obra->get('obra')->fecha_final_real}}"  class="mt-1 focus:ring-blue-800 focus:border-blue-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ old('fecha_oficio_notificacion') }}">
                                <label for="fecha_fin_estimacion" class="block text-sm font-semibold text-gray-700 text-center">Fecha de fin*</label>
                                <label id="error_fecha_fin_estimacion" class="hidden text-base font-normal text-red-500" >Ingrese una fecha final valida</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-5">

                    </div>
                    <div class="col-span-5">
                        
                        <input type="date" name="fecha_recepcion" id="fecha_recepcion" min="{{$obj_obra->get('obra')->fecha_inicio_programada}}" max="{{$obj_obra->get('obra')->fecha_final_real}}" class="mt-1 focus:ring-blue-800 focus:border-blue-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ old('fecha_oficio_notificacion') }}">
                        <label for="fecha_recepcion" class="block text-sm font-semibold text-gray-700 text-right">Fecha de recepción de documentos*</label>
                        <label id="error_fecha_recepcion" class="hidden text-base font-normal text-red-500" >Ingrese una fecha de inicio valida</label>
                    </div>
                    

                    <!--<div class="col-span-10">
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
                            </div>
                        </div>
                    </div>

                    <div class="col-span-4 sm:col-span-5">  
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
                    </div>
                    <div class="col-span-8 md:col-span-5">
                        <label  id="label_folio_factura" for="cliente_id" class="block text-sm font-bold text-gray-700">Folio de factura:</label>
                        <input type="text" name="folio_factura" id="folio_factura" maxlength="36" class="mt-1 focus:ring-blue-800 focus:border-blue-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ old('oficio_notificacion') }}">
                        <label id="error_folio_factura" name="error_folio_factura" class="hidden text-base font-normal text-red-500" >Ingrese un folio de factura valido.</label>
                    </div>

                    <div class="col-span-10">
                        <label for="ejecucion" class="block text-sm font-bold text-gray-700 text-center">Neto a pagar</label>
                        <label id="label_monto_neto" class="block text-base font-medium text-gray-700 py-3 px-2 text-center">$ 0.00</label>
                        <div id="div_error_guardar" class="hidden mx-10 text-center">
                            <label  class="text-base font-normal text-red-500 text-center font-bold" >El neto a pagar no puede ser menos a cero.</label>
                        </div>
                    </div>-->
                    
            </div>
            
            </div>
            <!--footer-->
            <div class=" p-4 border-t border-solid border-blueGray-200 rounded-b">
            
            <span class="block text-xs">Verifique los campos obligatorios marcados con un ( * ) </span>
            <div class="text-right">
            <button class="text-red-500 background-transparent font-bold uppercase px-6 py-2 text-sm outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="button" onclick="toggleModal('modal-agregar-estimacion')">
                Cancelar
            </button>
            <button type="submit" id="btn-create-estimacion" class="bg-green-500 text-white active:bg-green-600 font-bold uppercase text-sm px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" >
                Guardar
            </button>
            </div>
            </div>
            </form>
        </div>
        </div>
    </div>


    <div class="hidden opacity-25 fixed inset-0 z-40 bg-black" id="modal-backdrop"></div>
    <div class="hidden opacity-25 fixed inset-0 z-40 bg-black" id="modal-edit-backdrop"></div>
    <div class="hidden opacity-25 fixed inset-0 z-40 bg-black" id="modal-agregar-estimacion-backdrop"></div>
    <div class="hidden opacity-25 fixed inset-0 z-40 bg-black" id="modal-agregar-estimacion-edit-backdrop"></div>
@endif

@if($obj_obra->get('obra')->modalidad_ejecucion == 1)
    <!-- inicio modal agregar lista de raya -->
    <div class="hidden overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center" id="modal-lista-raya">
        <div class="relative w-auto my-6 mx-auto max-w-3xl">
        <!--content-->
        <div class="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none">
            <!--header-->
            <div class="flex items-start justify-between p-5 border-b border-solid border-blueGray-200 rounded-t">
            <h4 class="text-xl font-semibold">
                Agregar nueva lista de raya
            </h4>
            <button class="p-1 ml-auto bg-transparent border-0 text-black opacity-5 float-right text-3xl leading-none font-semibold outline-none focus:outline-none" onclick="toggleModal('modal-lista-raya')">
                <span class="bg-transparent text-black opacity-5 h-6 w-6 text-2xl block outline-none focus:outline-none">
                
                </span>
            </button>
            </div>
            <!--body-->
            <form action="{{ route('store_lista') }}" method="POST" id="formulario_lista" name="formulario_lista">
            @csrf
            @method('POST')
            <div class="relative p-6 flex-auto">
                <div class="grid grid-cols-10 gap-4">
                    <input type="text" name="id_obra_admin_lista" id="id_obra_admin_lista" maxlength="40" class="hidden mt-1 focus:ring-blue-800 focus:border-blue-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ $obj_obra->get('admin')->obra_administracion_id }}">
                    <input type="text" name="id_obra_lista" id="id_obra_lista" maxlength="40" class="hidden mt-1 focus:ring-blue-800 focus:border-blue-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ $obj_obra->get('obra')->id_obra }}">
                    <div class="col-span-5 sm:col-span-5 ">
                        <label for="contrato" class="block text-sm font-bold text-gray-700">Número de lista de raya*</label>
                        <div class="mt-1 py-2 px-3">
                            <label id="label_numero_lista_raya" class="text-base">{{str_pad(count($listas_raya) + 1,3,"0",STR_PAD_LEFT)}}</label>
                        </div>  
                        <input type="text" name="numero_lista_raya" id="numero_lista_raya" class="hidden mt-1 focus:ring-blue-800 focus:border-blue-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{count($listas_raya) + 1}}">
                        <label id="error_numero_lista_raya" class="hidden text-base font-normal text-red-500" >Ingrese un número de estimación valido</label>
                    </div>
                    <div class="col-span-5 sm:col-span-5">
                        <label for="tipo" class="block text-sm font-bold text-gray-700">Total*</label>
                        <div class="relative ">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-700 text-base">
                                $
                                </span>
                            </div>
                            <input type="text" name="total_lista_raya" id="total_lista_raya" maxlength="20" class="pl-7  mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required placeholder="0.00">
                        </div>
                        <label id="error_monto_admin_mayor" class="hidden text-base font-normal text-red-500" >El monto es mayor que el restante de la obra</label>
                        <label id="error_total_lista_raya" class="hidden text-base font-normal text-red-500" >Ingrese un monto total de lista de raya valido</label>
                    </div>
                    
                    <div class="col-span-10">
                        <label for="periodo_lista_raya" class="block text-sm font-bold text-gray-700 text-center">Periodo de la lista de raya</label>
                        <div class="grid grid-cols-4 gap-4">
                            <div class="col-span-2">
                                <input type="date" name="fecha_inicio_lista" id="fecha_inicio_lista" min="{{$obj_obra->get('obra')->fecha_inicio_programada}}" max="{{$obj_obra->get('obra')->fecha_final_real}}" class="mt-1 focus:ring-blue-800 focus:border-blue-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ old('fecha_oficio_notificacion') }}">
                                <label for="fecha_inicio_lista" class="block text-sm font-semibold text-gray-700 text-center">Fecha de inicio*</label>
                                <label id="error_fecha_inicio_lista" class="hidden text-base font-normal text-red-500" >Ingrese una fecha de inicio valida</label>
                            </div>
                            <div class="col-span-2">
                                <input type="date" name="fecha_fin_lista" id="fecha_fin_lista" min="{{$obj_obra->get('obra')->fecha_inicio_programada}}" max="{{$obj_obra->get('obra')->fecha_final_real}}"  class="mt-1 focus:ring-blue-800 focus:border-blue-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ old('fecha_oficio_notificacion') }}">
                                <label for="fecha_fin_lista" class="block text-sm font-semibold text-gray-700 text-center">Fecha de fin*</label>
                                <label id="error_fecha_fin_lista" class="hidden text-base font-normal text-red-500" >Ingrese una fecha final valida</label>
                            </div>
                        </div>
                    </div>

                    <div class="col-span-10">
                        <div class="mb-5 text-center">
                            <label id="error_retenciones_lista" name="error_retenciones_lista" class="hidden text-base font-normal text-red-500 text-center font-bold" >El total de rentenciones es mayor que el monto de la estimación.</label>
                        </div>
                        <label for="periodo_lista_raya" class="block text-sm font-bold text-gray-700 text-center">Retenciones</label>
                        <div class="grid grid-cols-4 gap-4">
                            <div class="col-span-2">
                                <div class="relative ">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <span class="text-gray-700 text-base">
                                        $
                                        </span>
                                    </div>
                                    <input type="text" name="isr_lista" id="isr_lista" maxlength="20" class="pl-7  mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" placeholder="0.00">
                                </div>
                                <label for="isr_lista" class="block text-sm font-semibold text-gray-700 text-center">I.S.R.*</label>
                                <label id="error_isr_lista" class="hidden text-base font-normal text-red-500" >Ingrese una cantidad de ISR valida</label>
                            </div>
                            <div class="col-span-2">
                                <div class="relative ">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <span class="text-gray-700 text-base">
                                        $
                                        </span>
                                    </div>
                                    <input type="text" name="mano_obra_lista" id="mano_obra_lista" maxlength="20" class="pl-7  mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" placeholder="0.00">
                                </div>
                                <label for="mano_obra_lista" class="block text-sm font-semibold text-gray-700 text-center">3% de mano de obra *</label>
                                <label id="error_mano_obra_lista" class="hidden text-base font-normal text-red-500" >Ingrese un monto de mano de obra valido</label>
                            </div>
                        </div>
                    </div>

                    <div class="col-span-10 div_pago">
                        <label for="ejecucion" class="block text-sm font-bold text-gray-700 text-center">Neto pagado</label>
                        <label id="label_monto_neto_lista" class="block text-base font-medium text-gray-700 py-3 px-2 text-center">$ 0.00</label>
                        <div id="div_error_guardar_lista" class="hidden mx-10 text-center">
                            <label  class="text-base font-normal text-red-500 text-center font-bold" >El neto a pagar no puede ser menor a cero.</label>
                        </div>
                    </div>
            </div>
            
            </div>
            <!--footer-->
            <div class=" p-4 border-t border-solid border-blueGray-200 rounded-b">
            
            <span class="block text-xs">Verifique los campos obligatorios marcados con un ( * ) </span>
            <div class="text-right">
            <button class="text-red-500 background-transparent font-bold uppercase px-6 py-2 text-sm outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="button" onclick="toggleModal('modal-lista-raya')">
                Cancelar
            </button>
            <button type="submit" id="guardar_lista" class="bg-green-500 text-white active:bg-green-600 font-bold uppercase text-sm px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" >
                Guardar
            </button>
            </div>
            </div>
            </form>
        </div>
        </div>
    </div>
    <!-- inicio modal editar lista de raya -->
    <div class="hidden overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center" id="modal-lista-raya-edit">
        <div class="relative w-auto my-6 mx-auto max-w-3xl">
        <!--content-->
        <div class="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none">
            <!--header-->
            <div class="flex items-start justify-between p-5 border-b border-solid border-blueGray-200 rounded-t">
            <h4 class="text-xl font-semibold">
                Editar lista de raya
            </h4>
            <button class="p-1 ml-auto bg-transparent border-0 text-black opacity-5 float-right text-3xl leading-none font-semibold outline-none focus:outline-none" onclick="toggleModal('modal-lista-raya-edit')">
                <span class="bg-transparent text-black opacity-5 h-6 w-6 text-2xl block outline-none focus:outline-none">
                
                </span>
            </button>
            </div>
            <!--body-->
            <form action="{{ route('update_lista') }}" method="POST" id="formulario_lista_edit" name="formulario_lista_edit">
            @csrf
            @method('POST')
            <div class="relative p-6 flex-auto">
                <div class="grid grid-cols-10 gap-4">
                    <input type="text" name="id_lista" id="id_lista" maxlength="40" class="hidden mt-1 focus:ring-blue-800 focus:border-blue-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="">
                    <input type="text" name="id_obra_lista_edit" id="id_obra_lista_edit" maxlength="40" class="hidden mt-1 focus:ring-blue-800 focus:border-blue-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ $obj_obra->get('obra')->id_obra }}">
                    <div class="col-span-5 sm:col-span-5 ">
                        <label for="contrato" class="block text-sm font-bold text-gray-700">Número de lista de raya*</label>
                        <div class="mt-1 py-2 px-3">
                            <label id="label_numero_lista_raya_edit" class="text-base">{{str_pad(count($listas_raya) + 1,3,"0",STR_PAD_LEFT)}}</label>
                        </div>  
                        <input type="text" name="numero_lista_raya_edit" id="numero_lista_raya_edit" class="hidden mt-1 focus:ring-blue-800 focus:border-blue-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{count($listas_raya) + 1}}">
                        <label id="error_numero_lista_raya_edit" class="hidden text-base font-normal text-red-500" >Ingrese un número de estimación valido</label>
                    </div>
                    <div class="col-span-5 sm:col-span-5">
                        <label for="tipo" class="block text-sm font-bold text-gray-700">Total*</label>
                        <div class="relative ">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-700 text-base">
                                $
                                </span>
                            </div>
                            <input type="text" name="total_lista_raya_edit" id="total_lista_raya_edit" maxlength="20" class="pl-7  mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" placeholder="0.00">
                        </div>
                        <label id="error_monto_admin_mayor_edit" class="hidden text-base font-normal text-red-500" >El monto es mayor que el restante de la obra</label>
                        <label id="error_total_lista_raya_edit" class="hidden text-base font-normal text-red-500" >Ingrese un total de lista de raya valido.</label>
                    </div>
                    
                    <div class="col-span-10">
                        <label for="periodo_lista_raya_edit" class="block text-sm font-bold text-gray-700 text-center">Periodo de la lista de raya</label>
                        <div class="grid grid-cols-4 gap-4">
                            <div class="col-span-2">
                                <input type="date" name="fecha_inicio_lista_edit" id="fecha_inicio_lista_edit" min="{{$obj_obra->get('obra')->fecha_inicio_programada}}" max="{{$obj_obra->get('obra')->fecha_final_real}}" class="mt-1 focus:ring-blue-800 focus:border-blue-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ old('fecha_oficio_notificacion') }}">
                                <label for="fecha_inicio_lista_edit" class="block text-sm font-semibold text-gray-700 text-center">Fecha de inicio*</label>
                                <label id="error_fecha_inicio_lista_edit" class="hidden text-base font-normal text-red-500" >Ingrese una fecha de inicio valida</label>
                            </div>
                            <div class="col-span-2">
                                <input type="date" name="fecha_fin_lista_edit" id="fecha_fin_lista_edit" min="{{$obj_obra->get('obra')->fecha_inicio_programada}}" max="{{$obj_obra->get('obra')->fecha_final_real}}"  class="mt-1 focus:ring-blue-800 focus:border-blue-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ old('fecha_oficio_notificacion') }}">
                                <label for="fecha_fin_lista_edit" class="block text-sm font-semibold text-gray-700 text-center">Fecha de fin*</label>
                                <label id="error_fecha_fin_lista_edit" class="hidden text-base font-normal text-red-500" >Ingrese una fecha final valida</label>
                            </div>
                        </div>
                    </div>

                    <div class="col-span-10">
                        <div class="mb-5 text-center">
                            <label id="error_retenciones_lista_edit" name="error_retenciones_lista" class="hidden text-base font-normal text-red-500 text-center font-bold" >El total de rentenciones es mayor que el monto de la estimación.</label>
                        </div>
                        <label for="periodo_lista_raya_edit" class="block text-sm font-bold text-gray-700 text-center">Retenciones</label>
                        <div class="grid grid-cols-4 gap-4">
                            <div class="col-span-2">
                                <div class="relative ">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <span class="text-gray-700 text-base">
                                        $
                                        </span>
                                    </div>
                                    <input type="text" name="isr_lista_edit" id="isr_lista_edit" maxlength="20" class="pl-7  mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" placeholder="0.00">
                                </div>
                                <label for="isr_lista_edit" class="block text-sm font-semibold text-gray-700 text-center">I.S.R.*</label>
                                <label id="error_isr_lista_edit" class="hidden text-base font-normal text-red-500" >Ingrese una cantidad de ISR valida</label>
                            </div>
                            <div class="col-span-2">
                                <div class="relative ">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <span class="text-gray-700 text-base">
                                        $
                                        </span>
                                    </div>
                                    <input type="text" name="mano_obra_lista_edit" id="mano_obra_lista_edit" maxlength="20" class="pl-7  mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" placeholder="0.00">
                                </div>
                                <label for="mano_obra_lista_edit" class="block text-sm font-semibold text-gray-700 text-center">3% de mano de obra *</label>
                                <label id="error_mano_obra_lista_edit" class="hidden text-base font-normal text-red-500" >Ingrese un monto de mano de obra valido</label>
                            </div>
                        </div>
                    </div>

                    <div class="col-span-10 div_pago">
                        <label for="ejecucion" class="block text-sm font-bold text-gray-700 text-center">Neto pagado</label>
                        <label id="label_monto_neto_lista_edit" class="block text-base font-medium text-gray-700 py-3 px-2 text-center">$ 0.00</label>
                        <div id="div_error_guardar_lista_edit" class="hidden mx-10 text-center">
                            <label  class="text-base font-normal text-red-500 text-center font-bold" >El neto a pagar no puede ser menor a cero.</label>
                        </div>
                    </div>
            </div>
            
            </div>
            <!--footer-->
            <div class=" p-4 border-t border-solid border-blueGray-200 rounded-b">
            
            <span class="block text-xs">Verifique los campos obligatorios marcados con un ( * ) </span>
            <div class="text-right">
            <button class="text-red-500 background-transparent font-bold uppercase px-6 py-2 text-sm outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="button" onclick="toggleModal('modal-lista-raya-edit')">
                Cancelar
            </button>
            <button type="submit" id="guardar_lista_edit" class="bg-green-500 text-white active:bg-green-600 font-bold uppercase text-sm px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" >
                Guardar
            </button>
            </div>
            </div>
            </form>
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
                    <input type="text" name="id_obra_admin_factura" id="id_obra_admin_factura" maxlength="40" class="hidden mt-1 focus:ring-blue-800 focus:border-blue-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ $obj_obra->get('admin')->obra_administracion_id }}">
                    <input type="text" name="id_obra_factura" id="id_obra_factura" maxlength="40" class="hidden mt-1 focus:ring-blue-800 focus:border-blue-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ $obj_obra->get('obra')->id_obra }}">
                    <div class="col-span-10 sm:col-span-5">
                        <label  id="label_folio_fiscal_factura" class="block text-sm font-bold text-gray-700">Folio fiscal:</label>
                        <input type="text" name="folio_fiscal_factura" id="folio_fiscal_factura" maxlength="36" class="mt-1 focus:ring-blue-800 focus:border-blue-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ old('oficio_notificacion') }}">
                        <label id="error_folio_fiscal_factura" name="error_folio_fiscal_factura" class="hidden text-base font-normal text-red-500" >Ingrese un folio de factura valido.</label>
                    </div>
                    <div class="col-span-5">
                        <label  id="label_fecha_factura" class="block text-sm font-bold text-gray-700">Fecha:</label>
                        <input type="date" name="fecha_factura" id="fecha_factura" min="{{$obj_obra->get('obra')->fecha_inicio_programada}}" max="{{$obj_obra->get('obra')->fecha_final_real}}" class="mt-1 focus:ring-blue-800 focus:border-blue-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ old('fecha_oficio_notificacion') }}">
                        <label id="error_fecha_factura" class="hidden text-base font-normal text-red-500" >Ingrese una fecha de factura valida.</label>
                    </div>
                    <div class="col-span-5 sm:col-span-5">
                        <label for="tipo" class="block text-sm font-bold text-gray-700">Monto*</label>
                        <div class="relative ">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-700 text-base">
                                $
                                </span>
                            </div>
                            <input type="text" name="total_factura" id="total_factura" maxlength="20" class="pl-7  mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" placeholder="0.00">
                        </div>
                        <label id="error_monto_admin_mayor_fac" class="hidden text-base font-normal text-red-500" >El monto es mayor que el restante de la obra: {{$service->formatNumber($obj_obra->get('obra')->monto_contratado - $total_admin)}}</label>
                        <label id="error_total_factura" class="hidden text-base font-normal text-red-500" >Ingrese un monto total de factura valido.</label>
                    </div>
                    <div class="col-span-10">
                        <label  id="label_concepto_factura" class="block text-sm font-bold text-gray-700">Concepto:</label>
                        
                        <textarea maxlength ="300" name="concepto_factura" id="concepto_factura" class="mt-1 focus:ring-blue-800 focus:border-blue-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ old('fecha_oficio_notificacion') }}"></textarea>
                        <label id="error_concepto_factura" class="hidden text-base font-normal text-red-500" >Ingrese concepto referente a la factura valido.</label>
                    </div>
                    <div class="col-span-10">
                        <label  for="proveedor" class="block text-sm font-bold text-gray-700">Contratista*</label>
                        <select class="js-example-basic-single mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" name="proveedor_id">
                            @foreach ($proveedores as $proveedor)
                                <option value="{{$proveedor->id_proveedor}}">{{$proveedor->rfc}} - {{$proveedor->razon_social}}</option>
                            @endforeach
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
                    <input type="text" name="id_obra_factura_edit" id="id_obra_factura_edit" maxlength="40" class="hidden mt-1 focus:ring-blue-800 focus:border-blue-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ $obj_obra->get('obra')->id_obra }}">
                    <div class="col-span-10 sm:col-span-5">
                        <label  id="label_folio_fiscal_factura_edit" class="block text-sm font-bold text-gray-700">Folio fiscal:</label>
                        <input type="text" name="folio_fiscal_factura_edit" id="folio_fiscal_factura_edit" maxlength="36" class="mt-1 focus:ring-blue-800 focus:border-blue-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ old('oficio_notificacion') }}">
                        <label id="error_folio_fiscal_factura_edit" name="error_folio_fiscal_factura_edit" class="hidden text-base font-normal text-red-500" >Ingrese un folio de factura valido.</label>
                    </div>
                    <div class="col-span-5">
                        <label  id="label_fecha_factura_edit" class="block text-sm font-bold text-gray-700">Fecha:</label>
                        <input type="date" name="fecha_factura_edit" id="fecha_factura_edit" min="{{$obj_obra->get('obra')->fecha_inicio_programada}}" max="{{$obj_obra->get('obra')->fecha_final_real}}" class="mt-1 focus:ring-blue-800 focus:border-blue-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ old('fecha_oficio_notificacion') }}">
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
                        <label id="error_monto_admin_mayor_fac_edit" class="hidden text-base font-normal text-red-500" >El monto es mayor que el restante de la obra: {{$service->formatNumber($obj_obra->get('obra')->monto_contratado - $total_admin)}}</label>
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
                            @foreach ($proveedores as $proveedor)
                                <option value="{{$proveedor->id_proveedor}}">{{$proveedor->rfc}} - {{$proveedor->razon_social}}</option>
                            @endforeach
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
    <!-- inicio modal agregar factura  -->
    <div class="hidden overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center" id="modal-agregar-contrato">
        <div class="relative w-auto my-6 mx-auto max-w-3xl">
        <!--content-->
        <div class="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none">
            <!--header-->
            <div class="flex items-start justify-between p-5 border-b border-solid border-blueGray-200 rounded-t">
            <h4 class="text-xl font-semibold">
                Agregar nuevo contrato de arrendamiento
            </h4>
            <button class="p-1 ml-auto bg-transparent border-0 text-black opacity-5 float-right text-3xl leading-none font-semibold outline-none focus:outline-none" onclick="toggleModal('modal-agregar-contrato')">
                <span class="bg-transparent text-black opacity-5 h-6 w-6 text-2xl block outline-none focus:outline-none">
                
                </span>
            </button>
            </div>
            <!--body-->
            <form action="{{ route('store_contrato') }}" method="POST" id="formulario_contrato" name="formulario_contrato">
            @csrf
            @method('POST')
            <div class="relative p-6 flex-auto">
                <div class="grid grid-cols-10 gap-4">
                    <input type="text" name="id_obra_admin_contrato" id="id_obra_admin_contrato" maxlength="40" class="hidden mt-1 focus:ring-blue-800 focus:border-blue-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ $obj_obra->get('admin')->obra_administracion_id }}">
                    <input type="text" name="id_obra_contrato" id="id_obra_contrato" maxlength="40" class="hidden mt-1 focus:ring-blue-800 focus:border-blue-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ $obj_obra->get('obra')->id_obra }}">
                    <div class="col-span-10 sm:col-span-5">
                        <label  id="label_numero_contrato" class="block text-sm font-bold text-gray-700">Número de contrato:*</label>
                        <input type="text" name="numero_contrato" id="numero_contrato" maxlength="36" class="mt-1 focus:ring-blue-800 focus:border-blue-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ old('oficio_notificacion') }}">
                        <label id="error_numero_contrato" name="error_numero_factura" class="hidden text-base font-normal text-red-500" >Ingrese un folio de factura valido.</label>
                    </div>
                    <div class="col-span-5">
                        <label  id="label_fecha_contrato" class="block text-sm font-bold text-gray-700">Fecha de contrato:*</label>
                        <input type="date" name="fecha_contrato" id="fecha_contrato" min="{{$obj_obra->get('obra')->fecha_inicio_programada}}" max="{{$obj_obra->get('obra')->fecha_final_real}}" class="mt-1 focus:ring-blue-800 focus:border-blue-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ old('fecha_oficio_notificacion') }}">
                        <label id="error_fecha_contrato" class="hidden text-base font-normal text-red-500" >Ingrese una fecha de factura valida.</label>
                    </div>
                    <div class="col-span-5 sm:col-span-5">
                        <label for="tipo" class="block text-sm font-bold text-gray-700">Monto:*</label>
                        <div class="relative ">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-700 text-base">
                                $
                                </span>
                            </div>
                            <input type="text" name="total_contrato" id="total_contrato" maxlength="20" class="pl-7  mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" placeholder="0.00">
                        </div>
                        <label id="error_monto_admin_mayor_contrato" class="hidden text-base font-normal text-red-500" >El monto es mayor que el restante de la obra: {{$service->formatNumber($obj_obra->get('obra')->monto_contratado - $total_admin)}}</label>
                        <label id="error_total_contrato" class="hidden text-base font-normal text-red-500" >Ingrese un monto total de factura valido.</label>
                    </div>
                    <div class="col-span-10">
                        <label  for="proveedor" class="block text-sm font-bold text-gray-700">Proveedor:*</label>
                        <select class="js-example-basic-single mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" name="proveedor_id_contrato" id="proveedor_id_contrato">
                            @foreach ($proveedores as $proveedor)
                                <option value="{{$proveedor->id_proveedor}}">{{$proveedor->rfc}} - {{$proveedor->razon_social}}</option>
                            @endforeach
                        </select>
                        <label id="error_proveedor_id_contrato" class="hidden text-base font-normal text-red-500" >Seleccione un proveedor.</label>
                    </div>
                    <div class="col-span-10">
                        <label for="periodo_contrato" class="block text-sm font-bold text-gray-700 text-center">Periodo de contrato de arrendamiento</label>
                        <div class="grid grid-cols-4 gap-4">
                            <div class="col-span-2">
                                <input type="date" name="fecha_inicio_contrato" id="fecha_inicio_contrato" min="{{$obj_obra->get('obra')->fecha_inicio_programada}}" max="{{$obj_obra->get('obra')->fecha_final_real}}" class="mt-1 focus:ring-blue-800 focus:border-blue-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ old('fecha_oficio_notificacion') }}">
                                <label for="fecha_inicio_contrato" class="block text-sm font-semibold text-gray-700 text-center">Fecha de inicio*</label>
                                <label id="error_fecha_inicio_contrato" class="hidden text-base font-normal text-red-500" >Ingrese una fecha de inicio valida</label>
                            </div>
                            <div class="col-span-2">
                                <input type="date" name="fecha_fin_contrato" id="fecha_fin_contrato" min="{{$obj_obra->get('obra')->fecha_inicio_programada}}" max="{{$obj_obra->get('obra')->fecha_final_real}}"  class="mt-1 focus:ring-blue-800 focus:border-blue-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ old('fecha_oficio_notificacion') }}">
                                <label for="fecha_fin_contrato" class="block text-sm font-semibold text-gray-700 text-center">Fecha de fin*</label>
                                <label id="error_fecha_fin_contrato" class="hidden text-base font-normal text-red-500" >Ingrese una fecha final valida</label>
                            </div>
                        </div>
                    </div>
            </div>
            
            </div>
            <!--footer-->
            <div class=" p-4 border-t border-solid border-blueGray-200 rounded-b">
            
            <span class="block text-xs">Verifique los campos obligatorios marcados con un ( * ) </span>
            <div class="text-right">
                <button class="text-red-500 background-transparent font-bold uppercase px-6 py-2 text-sm outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="button" onclick="toggleModal('modal-agregar-contrato')">
                    Cancelar
                </button>
                <button type="submit" id="guardar_contrato" class="bg-green-500 text-white active:bg-green-600 font-bold uppercase text-sm px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" >
                    Guardar
                </button>
            </div>
            </div>
            </form>
        </div>
        </div>
    </div>

    <div class="hidden opacity-25 fixed inset-0 z-40 bg-black" id="modal-lista-raya-backdrop"></div>
    <div class="hidden opacity-25 fixed inset-0 z-40 bg-black" id="modal-lista-raya-edit-backdrop"></div>
    <div class="hidden opacity-25 fixed inset-0 z-40 bg-black" id="modal-agregar-factura-backdrop"></div>
    <div class="hidden opacity-25 fixed inset-0 z-40 bg-black" id="modal-edit-factura-backdrop"></div>
    <div class="hidden opacity-25 fixed inset-0 z-40 bg-black" id="modal-agregar-contrato-backdrop"></div>
@endif

    
    
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.responsive.min.js') }}"></script>
    <script src="https://unpkg.com/@popperjs/core@2.9.1/dist/umd/popper.min.js" charset="utf-8"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.22/b-1.6.4/b-flash-1.6.4/b-html5-1.6.4/b-print-1.6.4/datatables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.22/b-1.6.4/b-flash-1.6.4/b-html5-1.6.4/b-print-1.6.4/datatables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>  
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>


        $(document).ready(function() {
            

            $('.table1').DataTable({
                "autoWidth": true,
                "responsive": true,
                "bFilter": false,
                "bPaginate": false,
                "bInfo": false,
                columnDefs: [{
                        responsivePriority: 1,
                        targets: 1
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
                order: [[ 0 , 'desc' ]],
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json'
                }
            })
            .columns.adjust();

            $('.table_estimacion').DataTable({
                "autoWidth": true,
                "responsive": true,
                "bFilter": false,
                "bPaginate": false,
                "bInfo": false,
                columnDefs: [{
                        responsivePriority: 1,
                        targets: 1
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
                order: [[ 0 , 'asc' ]],
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json'
                }
            })
            .columns.adjust();

            $("#contrato").on({
                "keydown": function(event) {
                    capturado = $(this).val();
                    
                    if(capturado.length > 40 || event.keyCode == 32){
                        return false;
                    }
                },
            });

            $("#avance_fisico").on({
                "keydown": function(event) { 
                    var totalx = $(this).val() + event.key;
                    if(event.keyCode != 8){
                        return (totalx < 101);
                    }else{
                        return true;
                    }
                    
                }
            });

            $("#formulario_periodo").validate({
                onfocusout: false,
                onclick: false,
                rules: {
                    fecha_inicio: { required: true},
                    fecha_fin: { required: true},
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

            $("#formulario_af").validate({
                onfocusout: false,
                onclick: false,
                rules: {
                    avance_fisico: { required: true},
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
            
            observaciones_datos = "{{str_replace("\r\n","  --  ", $observaciones?$observaciones->observacion:'\r\n')}}";
            
            observaciones_texto = "<p> * " + observaciones_datos.replaceAll("  --  ", '</p><p> * ') + "</p>";
            console.log(observaciones_texto);
            $('#div_observaciones').html(observaciones_texto);
        
        });
    </script>
@if($obj_obra->get('obra')->modalidad_ejecucion == 1)
    <script>
        function mostrar_edicion(){
            $(".mostrar_datos").addClass("hidden");
            $("#formulario_nc").removeClass("hidden");
        }
        
        function ocultar_edicion(){
            $(".mostrar_datos").removeClass("hidden");
            $("#formulario_nc").addClass("hidden");
        }

        function mostrar_periodo(){
            $(".ocultar_periodo").addClass("hidden");
            $("#formulario_periodo").removeClass("hidden");
        }

        function ocultar_periodo(){
            $(".ocultar_periodo").removeClass("hidden");
            $("#formulario_periodo").addClass("hidden");
        }

        function modificar_af(){

            console.log("hola mundo");
            $(".modificar_af").addClass("hidden");
            $("#formulario_af").removeClass("hidden");
        }
        function ocultar_af(){
            $(".modificar_af").removeClass("hidden");
            $("#formulario_af").addClass("hidden");
        }

        function toggleModal(modalID){
            console.log(modalID)
            document.getElementById(modalID).classList.toggle("hidden");
            document.getElementById(modalID + "-backdrop").classList.toggle("hidden");
        }

        function toggleModal_EditLista(modalID, lista, numero){
            console.log(lista);
            total = parseFloat(lista.total).toFixed(2);
            $("#label_numero_lista_raya_edit").html(numero);
            $("#numero_lista_raya_edit").val(lista.numero_lista_raya);
            $("#total_lista_raya_edit").val(("" + total).replace(/\D/g, "").replace(/([0-9])([0-9]{2})$/, '$1.$2').replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ","));
            $("#fecha_inicio_lista_edit").val(lista.fecha_inicio);
            $("#fecha_fin_lista_edit").val(lista.fecha_fin);
            total_isr = parseFloat(lista.isr).toFixed(2);
            $("#isr_lista_edit").val(("" + total_isr).replace(/\D/g, "").replace(/([0-9])([0-9]{2})$/, '$1.$2').replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ","));
            total_mano = parseFloat(lista.mano_obra).toFixed(2);
            $("#mano_obra_lista_edit").val(("" + total_mano).replace(/\D/g, "").replace(/([0-9])([0-9]{2})$/, '$1.$2').replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ","));
            total_neto = lista.total - lista.isr - lista.mano_obra;
            total_neto = parseFloat(total_neto).toFixed(2);
            $("#label_monto_neto_lista_edit").html("$ "+("" + total_neto).replace(/\D/g, "").replace(/([0-9])([0-9]{2})$/, '$1.$2').replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ","));
            $("#id_lista").val(lista.id_lista_raya);
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

        function modificar_neto(){
            total_lista = $("#total_lista_raya").val().replaceAll(",", '');
            total_isr = $("#isr_lista").val().replaceAll(",", '');
            total_3por = $("#mano_obra_lista").val().replaceAll(",", '');

            total = total_lista - total_isr - total_3por;
            total = parseFloat(total).toFixed(2);
            $("#label_monto_neto_lista").html(total);

            if(total < 0 ){
                $("#error_retenciones_lista").removeClass("hidden");
                $("#label_monto_neto_lista").html("$ -"+("" + total).replace(/\D/g, "").replace(/([0-9])([0-9]{2})$/, '$1.$2').replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ","));
                $("#label_monto_neto_lista").removeClass("text-gray-700");
                $("#label_monto_neto_lista").addClass("text-red-500");
                return false;
            }else {
                $("#error_retenciones_lista").addClass("hidden");
                $("#label_monto_neto_lista").html("$ "+("" + total).replace(/\D/g, "").replace(/([0-9])([0-9]{2})$/, '$1.$2').replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ","));
                $("#label_monto_neto_lista").addClass("text-gray-700");
                $("#label_monto_neto_lista").removeClass("text-red-500");   
                return true;         
            }
        }

        function modificar_neto_edit(){
            total_lista = $("#total_lista_raya_edit").val().replaceAll(",", '');
            total_isr = $("#isr_lista_edit").val().replaceAll(",", '');
            total_3por = $("#mano_obra_lista_edit").val().replaceAll(",", '');

            total = total_lista - total_isr - total_3por;
            total = parseFloat(total).toFixed(2);
            $("#label_monto_neto_lista_edit").html(total);

            if(total < 0 ){
                $("#error_retenciones_lista_edit").removeClass("hidden");
                $("#label_monto_neto_lista_edit").html("$ -"+("" + total).replace(/\D/g, "").replace(/([0-9])([0-9]{2})$/, '$1.$2').replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ","));
                $("#label_monto_neto_lista_edit").removeClass("text-gray-700");
                $("#label_monto_neto_lista_edit").addClass("text-red-500");
                return false;
            }else {
                $("#error_retenciones_lista_edit").addClass("hidden");
                $("#label_monto_neto_lista_edit").html("$ "+("" + total).replace(/\D/g, "").replace(/([0-9])([0-9]{2})$/, '$1.$2').replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ","));
                $("#label_monto_neto_lista_edit").addClass("text-gray-700");
                $("#label_monto_neto_lista_edit").removeClass("text-red-500");   
                return true;         
            }
        }

        $(document).ready(function() {

            $("ul.tabs li").click(function() {
                $("ul.tabs li").removeClass("active"); //Remove any "active" class
                $(this).addClass("active"); //Add "active" class to selected tab
                $(".tab_content").hide(); //Hide all tab content

                var activeTab = $(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
                $(activeTab).fadeIn(); //Fade in the active ID content
                return false;
            });

            $('#fecha_inicio_lista').change(function() {
                fecha = new Date($(this).val());
                if(fecha != "Invalid Date"){
                    $("#fecha_fin_lista").attr("min", $(this).val());
                }
            });

            $('#fecha_fin_lista').change(function() {
                fecha = new Date($(this).val());
                if(fecha != "Invalid Date"){
                    $("#fecha_inicio_lista").attr("max", $(this).val());
                }
            });

            $("#total_lista_raya").on({
                "keyup": function(event) {
                    $(event.target).val(function(index, value) {
                        return value.replace(/\D/g, "")
                            .replace(/([0-9])([0-9]{2})$/, '$1.$2')
                            .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ",");
                    });

                    total_capturado =  parseFloat($(this).val().replaceAll(",", ''));
                    
                    total = {{$total_admin==''?0:$total_admin}};
                    total_obra = {{$obj_obra->get('obra')->monto_contratado}};
                        
                    total = total_capturado + total;
                    if(total > total_obra){
                        $("#error_monto_admin_mayor").removeClass("hidden");
                    }else{
                        $("#error_monto_admin_mayor").addClass("hidden");
                    }

                    modificar_neto();
                }
            });

            $("#isr_lista, #mano_obra_lista").on({
                "keyup": function(event) {
                    $(event.target).val(function(index, value) {
                        return value.replace(/\D/g, "")
                            .replace(/([0-9])([0-9]{2})$/, '$1.$2')
                            .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ",");
                    });

                    modificar_neto();
                }
            });

            $("#guardar_lista").click(function () {

                
                total_capturado =  parseFloat($("#total_lista_raya").val().replaceAll(",", ''));
                    
                total = {{$total_admin}};
                total_obra = {{$obj_obra->get('obra')->monto_contratado}};
                        
                total = total_capturado + total;
                if(total > total_obra){
                    return false;
                }else{
                    estado = modificar_neto();
                    if(estado)
                        $("#div_error_guardar_lista").addClass("hidden");
                    else
                        $("#div_error_guardar_lista").removeClass("hidden"); 
                    return estado;
                }
                    
            });

            $("#formulario_lista").validate({
                onfocusout: false,
                onclick: false,
                rules: {
                    total_lista_raya: { required: true },
                    fecha_inicio_lista: { required: true },
                    fecha_fin_lista: { required:true },
                    isr_lista: { required:true },
                    mano_obra_lista: { required: true },
                },
                errorPlacement: function(error, element) {
                    console.log("1"+element.attr('id'));
                    if(error != null){
                    $('#error_'+element.attr('id')).fadeIn();
                    }else{
                    $('#error_'+element.attr('id')).fadeOut();
                    }
                // console.log(element.attr('id'));
                },
            }); 

            $("#formulario_lista input").on({
                "change":function(event) {
                    fecha = new Date($(this).val());
                    if($(this).attr('type')== "date"){
                        if(fecha != "Invalid Date"){
                            console.log(fecha);
                            $('#error_'+$(this).attr('id')).fadeOut();
                            $("#label_"+$(this).attr('id')).removeClass('text-red-500');
                            $("#label_"+$(this).attr('id')).addClass('text-gray-700');
                        }else{
                            $('#error_'+$(this).attr('id')).fadeIn();
                            $("#label_"+$(this).attr('id')).addClass('text-red-500');
                            $("#label_"+$(this).attr('id')).removeClass('text-gray-700');
                        }
                    }
                },
                "keyup": function(event) {
                    
                    fecha = $(this).val();
                    
                    if(fecha != ''){
                        console.log(fecha);
                        $('#error_'+$(this).attr('id')).fadeOut();
                        $("#label_"+$(this).attr('id')).removeClass('text-red-500');
                        $("#label_"+$(this).attr('id')).addClass('text-gray-700');
                    }else{
                        console.log("fecha");
                        $('#error_'+$(this).attr('id')).fadeIn();
                        $("#label_"+$(this).attr('id')).addClass('text-red-500');
                        $("#label_"+$(this).attr('id')).removeClass('text-gray-700');
                    }
                },
            });

            
            //Modal editar lista de raya

            $('#fecha_inicio_lista_edit').change(function() {
                fecha = new Date($(this).val());
                if(fecha != "Invalid Date"){
                    $("#fecha_fin_lista_edit").attr("min", $(this).val());
                }
            });

            $('#fecha_fin_lista_edit').change(function() {
                fecha = new Date($(this).val());
                if(fecha != "Invalid Date"){
                    $("#fecha_inicio_lista_edit").attr("max", $(this).val());
                }
            });

            $("#total_lista_raya_edit").on({
                "keyup": function(event) {
                    $(event.target).val(function(index, value) {
                        return value.replace(/\D/g, "")
                            .replace(/([0-9])([0-9]{2})$/, '$1.$2')
                            .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ",");
                    });
                    console.log("hola mundo");
                    total_capturado =  parseFloat($(this).val().replaceAll(",", ''));
                    
                    total = {{$total_admin}};
                    total_obra = {{$obj_obra->get('obra')->monto_contratado}};
                        
                    total = total_capturado + total;
                    if(total > total_obra){
                        $("#error_monto_admin_mayor_edit").removeClass("hidden");
                    }else{
                        $("#error_monto_admin_mayor_edit").addClass("hidden");
                    }

                    modificar_neto_edit();
                }
            });

            $("#isr_lista_edit, #mano_obra_lista_edit").on({
                "keyup": function(event) {
                    $(event.target).val(function(index, value) {
                        return value.replace(/\D/g, "")
                            .replace(/([0-9])([0-9]{2})$/, '$1.$2')
                            .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ",");
                    });

                    modificar_neto_edit();
                }
            });

            $("#guardar_lista_edit").click(function () {

                total_capturado =  parseFloat($("#total_lista_raya_edit").val().replaceAll(",", ''));
                    
                total = {{$total_admin}};
                total_obra = {{$obj_obra->get('obra')->monto_contratado}};
                        
                total = total_capturado + total;
                if(total > total_obra){
                    return false;
                }else{
                    estado = modificar_neto_edit();
                    if(estado)
                        $("#div_error_guardar_lista_edit").addClass("hidden");
                    else
                        $("#div_error_guardar_lista_edit").removeClass("hidden"); 
                    return estado;
                }
                    
            });

            

            $("#formulario_lista_edit").validate({
                onfocusout: false,
                onclick: false,
                rules: {
                    total_lista_raya_edit: { required: true},
                    fecha_inicio_lista_edit: { required: true},
                    fecha_fin_lista_edit: { required:true },
                    isr_lista_edit: { required:true },
                    mano_obra_lista_edit: { required: true },
                },
                errorPlacement: function(error, element) {
                    console.log(element.attr('id'));
                    if(error != null){
                    $('#error_'+element.attr('id')).fadeIn();
                    }else{
                    $('#error_'+element.attr('id')).fadeOut();
                    }
                // console.log(element.attr('id'));
                },
            }); 

            $("#formulario_lista_edit input").on({
                "change":function(event) {
                    fecha = new Date($(this).val());
                    if($(this).attr('type') == "date"){
                        if(fecha != "Invalid Date"){
                            console.log(fecha);
                            $('#error_'+$(this).attr('id')).fadeOut();
                            $("#label_"+$(this).attr('id')).removeClass('text-red-500');
                            $("#label_"+$(this).attr('id')).addClass('text-gray-700');
                        }else{
                            $('#error_'+$(this).attr('id')).fadeIn();
                            $("#label_"+$(this).attr('id')).addClass('text-red-500');
                            $("#label_"+$(this).attr('id')).removeClass('text-gray-700');
                        }
                    }
                },
                "keyup": function(event) {
                    
                    fecha = $(this).val();
                    
                    if(fecha != ''){
                        console.log(fecha);
                        $('#error_'+$(this).attr('id')).fadeOut();
                        $("#label_"+$(this).attr('id')).removeClass('text-red-500');
                        $("#label_"+$(this).attr('id')).addClass('text-gray-700');
                    }else{
                        console.log("fecha");
                        $('#error_'+$(this).attr('id')).fadeIn();
                        $("#label_"+$(this).attr('id')).addClass('text-red-500');
                        $("#label_"+$(this).attr('id')).removeClass('text-gray-700');
                    }
                },
            });

            

            //Modal crear factura
            $('.js-example-basic-single').select2();
            $("#total_factura").on({
                "keyup": function(event) {
                    $(event.target).val(function(index, value) {
                        return value.replace(/\D/g, "")
                            .replace(/([0-9])([0-9]{2})$/, '$1.$2')
                            .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ",");
                    });

                    total_capturado =  parseFloat($(this).val().replaceAll(",", ''));
                    
                    total = {{$total_admin}};
                    total_obra = {{$obj_obra->get('obra')->monto_contratado}};
                        
                    total = total_capturado + total;
                    if(total > total_obra){
                        $("#error_monto_admin_mayor_fac").removeClass("hidden");
                    }else{
                        $("#error_monto_admin_mayor_fac").addClass("hidden");
                    }

                    modificar_neto();
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
                    
                total = {{$total_admin}};
                total_obra = {{$obj_obra->get('obra')->monto_contratado}};
                        
                total = total_capturado + total;
                concepto = $("#concepto_factura").val().length;
                
                if(total > total_obra){
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
                    
                    total = {{$total_admin}};
                    total_obra = {{$obj_obra->get('obra')->monto_contratado}};
                        
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
                    
                total = {{$total_admin}};
                total_obra = {{$obj_obra->get('obra')->monto_contratado}};
                        
                total = total_capturado + total;
                concepto = $("#concepto_factura_edit").val().length;
                
                if(total > total_obra){
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
            
            //Modal editar contrato arrendamiento
            $("#total_contrato").on({
                "keyup": function(event) {
                    $(event.target).val(function(index, value) {
                        return value.replace(/\D/g, "")
                            .replace(/([0-9])([0-9]{2})$/, '$1.$2')
                            .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ",");
                    });

                    total_capturado =  parseFloat($(this).val().replaceAll(",", ''));
                    
                    total = {{$total_admin}};
                    total_obra = {{$obj_obra->get('obra')->monto_contratado}};
                        
                    total = total_capturado + total;
                    if(total > total_obra){
                        $("#error_monto_admin_mayor_contrato").removeClass("hidden");
                    }else{
                        $("#error_monto_admin_mayor_contrato").addClass("hidden");
                    }
                }
            });


            $("#formulario_contrato").validate({
                onfocusout: false,
                onclick: false,
                rules: {
                    folio_fiscal_contrato: { required: true},
                    fecha_contrato: { required: true},
                    total_contrato: { required:true },
                    proveedor_id_contrato: { required: true },
                    fecha_inicio_contrato: { required: true },
                    fecha_fin_contrato: { required: true },
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

            $("#guardar_contrato").click(function () {
                total_capturado =  parseFloat($("#total_contrato").val().replaceAll(",", ''));
                    
                total = {{$total_admin}};
                total_obra = {{$obj_obra->get('obra')->monto_contratado}};
                        
                total = total_capturado + total;
                
                if(total > total_obra){
                    return false;
                }else{

                    valido = true;
                    return valido;
                }
                    
            });

            $("#formulario_contrato input").on({
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
                    
                    monto = $(this).val();
                    if(monto != ''){
                        $('#error_'+$(this).attr('id')).addClass('hidden');
                        $("#label_"+$(this).attr('id')).removeClass('text-red-500');
                        $("#label_"+$(this).attr('id')).addClass('text-gray-700');
                    }else{
                        $('#error_'+$(this).attr('id')).removeClass('hidden');
                        $("#label_"+$(this).attr('id')).addClass('text-red-500');
                        $("#label_"+$(this).attr('id')).removeClass('text-gray-700');
                    }
                },
            });

            $('#fecha_inicio_contrato').change(function() {
                fecha = new Date($(this).val());
                if(fecha != "Invalid Date"){
                    $("#fecha_fin_contrato").attr("min", $(this).val());
                }
            });

            $('#fecha_fin_contrato').change(function() {
                fecha = new Date($(this).val());
                if(fecha != "Invalid Date"){
                    $("#fecha_inicio_contrato").attr("max", $(this).val());
                }
            });
            $("#numero_contrato").on({
            "keydown": function(event) {
                capturado = $(this).val();
                
                if(capturado.length > 40 || event.keyCode == 32){
                    return false;
                }
            },
        });
            
        });

    </script>
@endif
@if($obj_obra->get('obra')->modalidad_ejecucion == 2)
    <script>
        

        function toggleModal(modalID){
        document.getElementById(modalID).classList.toggle("hidden");
        document.getElementById(modalID + "-backdrop").classList.toggle("hidden");
        }

        function toggleModal_1(modalID, convenio){
            console.log(convenio);
            $("#numero_convenio_modificatorio_edit").val(convenio.numero_convenio_modificatorio);
            $.each($("#tipo_edit option"),function(i,v){
                value = v.value;
                $("#tipo_edit option[value='"+value+"']").remove();
            })

            $('#tipo_edit').prepend("<option value='"+convenio.tipo+"' >"+convenio.tipo+"</option>");
            $("#fecha_convenio_edit").val(convenio.fecha_convenio);
            $("#id_convenio_modificatorio").val(convenio.id_convenio_modificatorio);
            monto_valor = parseFloat(convenio.monto_modificado).toFixed(2);
            $("#monto_modificado_edit").val((""+ monto_valor).replace(/\D/g, "").replace(/([0-9])([0-9]{2})$/, '$1.$2').replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ","));
            $("#fecha_fin_modificada_edit").val(convenio.fecha_fin_modificada);
            switch (convenio.tipo) {
                case "Convenio modificatorio al monto del contrato":
                    $('#monto_modificado_edit_div').removeClass("hidden");
                    $('#mod_fecha_fin_edit').addClass("hidden");
                    $("#fecha_fin_modificada_edit").val("");
                break;
                case "Convenio modificatorio a la fecha del contrato":
                    $('#mod_fecha_fin_edit').removeClass("hidden");
                    $('#monto_modificado_edit_div').addClass("hidden");
                    $("#fecha_fin_modificada_edit").val(convenio.fecha_fin_modificada);
                break;
                case "Convenio modificatorio a las metas del contrato":
                    $('#mod_fecha_fin_edit').addClass("hidden");
                    $('#monto_modificado_edit_div').addClass("hidden");
                    $("#fecha_fin_modificada_edit").val("");
                break;
                case "Convenio modificatorio al monto y fecha de contrato":
                    $('#mod_fecha_fin_edit').removeClass("hidden");
                    $('#monto_modificado_edit_div').removeClass("hidden");
                    $("#fecha_fin_modificada_edit").val(convenio.fecha_fin_modificada);
                break;
                case "Convenio modificatorio al monto y metas de contrato":
                    $('#mod_fecha_fin_edit').addClass("hidden");
                    $('#monto_modificado_edit_div').removeClass("hidden");
                    $("#fecha_fin_modificada_edit").val("");
                break;
                case "Convenio modificatorio a la fecha y metas de contrato":
                    $('#mod_fecha_fin_edit').removeClass("hidden");
                    $('#monto_modificado_edit_div').addClass("hidden");
                    $("#fecha_fin_modificada_edit").val(convenio.fecha_fin_modificada);
                break;
                default:
                    $('#mod_fecha_fin_edit').removeClass("hidden");
                    $('#monto_modificado_edit_div').removeClass("hidden");
                    $("#fecha_fin_modificada_edit").val(convenio.fecha_fin_modificada);
                break;
            }

        document.getElementById(modalID).classList.toggle("hidden");
        document.getElementById(modalID + "-backdrop").classList.toggle("hidden");
        }

        function toggleModal_2(modalID, estimacion){
            console.log(estimacion.fecha_recepcion);
            console.log(estimacion);

            $("#label_numero_estimacion_edit").html(estimacion.numero_estimacion);
            $("#numero_estimacion_edit").val(estimacion.numero_estimacion);
            if(estimacion.finiquito == 0)
                $("#n_finiquito_edit").prop("checked", true);
            else
                $("#s_finiquito_edit").prop("checked", true);
            $("#id_estimacion_edit").val(estimacion.id_estimacion)
            $("#fecha_recepcion_edit").val(estimacion.fecha_recepcion);
            $("#fecha_inicio_estimacion_edit").val(estimacion.fecha_inicio);
            $('#fecha_inicio_estimacion_edit').change();
            $("#fecha_fin_estimacion_edit").val(estimacion.fecha_final);
            $('#fecha_fin_estimacion_edit').change();

        document.getElementById(modalID).classList.toggle("hidden");
        document.getElementById(modalID + "-backdrop").classList.toggle("hidden");
        }

        window.onload = function(){
            
        }

        desplazamiento_x = 100;
        desplazamiento_y = 100;
        total = 0;


        $(document).ready(function() {

            /*$("#flecha-scroll-left").click(function(){
                tamanio = $("#div-tabs").width();
                console.log( tamanio )
                console.log( $("#div-tabs").scrollLeft() )
                if($("#div-tabs").scrollLeft() < $("#div-tabs").width() + 40){
                    $("#div-tabs").animate({scrollLeft: $("#div-tabs").offset().left + desplazamiento_x}, 800);
                    desplazamiento_x = desplazamiento_x + 100;
                    desplazamiento_y = desplazamiento_y - 100;
                }
                
                total = $("#div-tabs").scrollLeft() + $("#div-tabs").outerWidth();
            }); 

            $("#flecha-scroll-right").click(function(){
                console.log($("#div-tabs").outerWidth());
                if($("#div-tabs").scrollLeft() > 0){
                    $("#div-tabs").animate({scrollLeft: $("#div-tabs").offset().left - desplazamiento_y}, 800);
                    desplazamiento_y = desplazamiento_y + 100;
                    desplazamiento_x = desplazamiento_x - 100;
                }
            });*/ 

            //On Click Event
            $("ul.tabs li").click(function() {
                

                $("ul.tabs li").removeClass("active"); //Remove any "active" class
                $(this).addClass("active"); //Add "active" class to selected tab
                $(".tab_content").hide(); //Hide all tab content

                var activeTab = $(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
                $(activeTab).fadeIn(); //Fade in the active ID content
                return false;
            });

            $(document).on('change', '#tipo', function(event) {
                switch ($("#tipo option:selected").val()) {
                    case "Convenio modificatorio al monto del contrato":
                        $('#monto_modificado_div').removeClass("hidden");
                        $('#mod_fecha_fin').addClass("hidden");
                    break;
                    case "Convenio modificatorio a la fecha del contrato":
                        $('#mod_fecha_fin').removeClass("hidden");
                        $('#monto_modificado_div').addClass("hidden");
                    break;
                    case "Convenio modificatorio a las metas del contrato":
                        $('#mod_fecha_fin').addClass("hidden");
                        $('#monto_modificado_div').addClass("hidden");
                    break;
                    case "Convenio modificatorio al monto y fecha de contrato":
                        $('#mod_fecha_fin').removeClass("hidden");
                        $('#monto_modificado_div').removeClass("hidden");
                    break;
                    case "Convenio modificatorio al monto y metas de contrato":
                        $('#mod_fecha_fin').addClass("hidden");
                        $('#monto_modificado_div').removeClass("hidden");
                    break;
                    case "Convenio modificatorio a la fecha y metas de contrato":
                        $('#mod_fecha_fin').removeClass("hidden");
                        $('#monto_modificado_div').addClass("hidden");
                    break;
                    default:
                        $('#mod_fecha_fin').removeClass("hidden");
                        $('#monto_modificado_div').removeClass("hidden");
                    break;
                }
            });

            $(document).on('change', '#tipo_edit', function(event) {
                switch ($("#tipo_edit option:selected").val()) {
                    case "Convenio modificatorio al monto del contrato":
                        $('#monto_modificado_edit_div').removeClass("hidden");
                        $('#mod_fecha_fin_edit').addClass("hidden");
                    break;
                    case "Convenio modificatorio a la fecha del contrato":
                        $('#mod_fecha_fin_edit').removeClass("hidden");
                        $('#monto_modificado_edit_div').addClass("hidden");
                    break;
                    case "Convenio modificatorio a las metas del contrato":
                        $('#mod_fecha_fin_edit').addClass("hidden");
                        $('#monto_modificado_edit_div').addClass("hidden");
                    break;
                    case "Convenio modificatorio al monto y fecha de contrato":
                        $('#mod_fecha_fin_edit').removeClass("hidden");
                        $('#monto_modificado_edit_div').removeClass("hidden");
                    break;
                    case "Convenio modificatorio al monto y metas de contrato":
                        $('#mod_fecha_fin_edit').addClass("hidden");
                        $('#monto_modificado_edit_div').removeClass("hidden");
                    break;
                    case "Convenio modificatorio a la fecha y metas de contrato":
                        $('#mod_fecha_fin_edit').removeClass("hidden");
                        $('#monto_modificado_edit_div').addClass("hidden");
                    break;
                    default:
                        $('#mod_fecha_fin_edit').removeClass("hidden");
                        $('#monto_modificado_edit_div').removeClass("hidden");
                    break;
                }
            });

        

            var anio = (new Date).getFullYear();
            $('#anio_inicio').attr("min", anio - 2);
            $('#anio_inicio').attr("max", anio + 1);
            $('#anio_fin').attr("min", anio);
            $('#anio_fin').attr("max", anio + 3);

            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#preViewImg').attr('src', e.target.result);
                        $('#preViewImg').removeClass('hidden');
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }

            $("#file").click(function() {
                if ($('#logo_text').val() != "") {
                    $('#preViewImg').attr('src', $("#logo_text").val());
                } else {
                    $('#preViewImg').addClass('hidden');
                }
            });

            if ($('#logo_text').val() == "") {
                $('#preViewImg').addClass('hidden');
            }

            $(document).on('change', '#file', function() {
                readURL(this);
            });

            $('#fecha_inicio').change(function() {
                fecha = new Date($(this).val());
                if(fecha != "Invalid Date"){
                    fecha.setDate(fecha.getDate() + 1);
                    if($(this).val() != '{{$obj_obra->get('obra')->ejercicio}}-12-31') {
                        fecha.setDate(fecha.getDate() + 1);
                    }
                    const mes = fecha.getMonth() + 1; // Ya que los meses los cuenta desde el 0
                    const dia = fecha.getDate();
                    fecha = fecha.getFullYear()+'-'+(mes< 10?'0':'')+mes+'-'+(dia < 10 ? '0' : '')+dia;
                    $("#fecha_fin").attr("min", fecha);
                }
            });

            $('#fecha_fin').change(function() {
                fecha = new Date($(this).val());
                
                if(fecha != "Invalid Date"){
                    const mes = fecha.getMonth() + 1; // Ya que los meses los cuenta desde el 0
                    const dia = fecha.getDate();
                    fecha = fecha.getFullYear()+'-'+(mes< 10?'0':'')+mes+'-'+(dia < 10 ? '0' : '')+dia;
                    $("#fecha_inicio").attr("max", fecha);
                }
            });

            $("#formulario_nc").validate({
                onfocusout: false,
                onclick: false,
                rules: {
                    nombre_corto: { required: true},
                    min: 10,
                    max: 100,
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
            

            $("#formulario_convenio").validate({
                onfocusout: false,
                onclick: false,
                rules: {
                    numero_convenio_modificatorio: { required: true},
                    fecha_convenio: { required: true},
                    
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

            $("#guardar").click(function () {
                monto_modificado = $("#monto_modificado").val().replace(",", '');
                monto_ejercido = {{$total_pagado->total_obra}} + {{$obj_obra->get('obra')->anticipo_monto}};
                console.log(monto_ejercido);
                if(monto_modificado < monto_ejercido && !$("#monto_modificado_div").hasClass("hidden")){
                    $("#error_monto").removeClass("hidden");
                    return false;
                }else{
                    $("#error_monto").addClass("hidden");
                    if($("#fecha_fin_modificada").val() == '' && !$("#mod_fecha_fin").hasClass("hidden")){
                        $("#error_fecha_fin").removeClass("hidden");
                        return false;
                    }else{
                        $("#error_fecha_fin").addClass("hidden");
                        return true;
                    }
                }
                
            });

            $("#btn-edit").click(function () {
                monto_modificado = $("#monto_modificado_edit").val().replace(",", '');
                monto_ejercido = {{$total_pagado->total_obra}} + {{$obj_obra->get('obra')->anticipo_monto}};
                if(monto_modificado < monto_ejercido && !$("#monto_modificado_edit_div").hasClass("hidden")){
                    $("#error_monto_edit").removeClass("hidden");
                    return false;
                }else{
                    $("#error_monto_edit").addClass("hidden");
                    if($("#fecha_fin_modificada_edit").val() == '' && !$("#mod_fecha_fin_edit").hasClass("hidden")){
                        $("#error_fecha_fin_edit").removeClass("hidden");
                        return false;
                    }else{
                        $("#error_fecha_fin_edit").addClass("hidden");
                        return true;
                    }
                }
                
            });

            $("#monto_modificado").on({
                "keyup": function(event) {
                    $(event.target).val(function(index, value) {
                        return value.replace(/\D/g, "")
                            .replace(/([0-9])([0-9]{2})$/, '$1.$2')
                            .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ",");
                    });
                    
                }
            });

            

            $("#monto_modificado_edit").on({
                "keyup": function(event) {
                    $(event.target).val(function(index, value) {
                        return value.replace(/\D/g, "")
                            .replace(/([0-9])([0-9]{2})$/, '$1.$2')
                            .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ",");
                    });
                    
                }
            });

            $("#numero_convenio_modificatorio, #folio_factura").on({
                "keydown": function(event) {
                    capturado = $(this).val();
                    console.log(event.keyCode);
                    if(capturado.length > 40  || event.keyCode == 32){
                        return false;
                    }
                },
            });

            $("#numero_convenio_modificatorio_edit").on({
                "keydown": function(event) {
                    console.log("hola");
                    capturado = $(this).val();
                    console.log(event.keyCode);
                    if(capturado.length > 40  || event.keyCode == 32){
                        return false;
                    }
                },
            });

            //Métodos utilizados en las estimaciones

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
                    monto_restante = {{$obj_obra->get('obra')->monto_modificado?$obj_obra->get('obra')->monto_modificado:$obj_obra->get('obra')->monto_contratado}} - {{$total_pagado->total_estimaciones?$total_pagado->total_estimaciones:0}};
                    

                    if (monto_est > monto_restante){
                        $("#error_total_estimacion").removeClass("hidden");
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

            $('#fecha_inicio_estimacion').change(function() {
                fecha = new Date($(this).val());
                fecha.setDate(fecha.getDate() + 30);
                fecha_final = new Date('{{$obj_obra->get('obra')->fecha_final_real}}');
                fecha_final.setDate(fecha_final.getDate() + 1);

                if(fecha_final < fecha){
                    fecha = fecha_final;
                }
                
                const mes = fecha.getMonth() + 1; // Ya que los meses los cuenta desde el 0
                const dia = fecha.getDate();
                fecha_text = fecha.getFullYear()+'-'+(mes< 10?'0':'')+mes+'-'+(dia < 10 ? '0' : '')+dia;
                $("#fecha_fin_estimacion").attr("min", $(this).val());
                $("#fecha_fin_estimacion").attr("max", fecha_text);
                
                $("#fecha_recepcion").attr("min", fecha_text);;

                fecha.setDate(fecha.getDate() + 6);

                const mes_1 = fecha.getMonth() + 1; // Ya que los meses los cuenta desde el 0
                const dia_1 = fecha.getDate();
                fecha_text = fecha.getFullYear()+'-'+(mes_1< 10?'0':'')+mes_1+'-'+(dia_1 < 10 ? '0' : '')+dia_1;
                
                $("#fecha_recepcion").attr("max", fecha_text);;
            });

            $('#fecha_fin_estimacion').change(function() {

                fecha = new Date($(this).val());
                fecha.setDate(fecha.getDate() - 30);
                fecha_inicio = new Date('{{$obj_obra->get('obra')->fecha_inicio_programada}}');
                fecha_inicio.setDate(fecha_inicio.getDate() + 1);

                
                if(fecha_inicio > fecha){
                    fecha = fecha_inicio;
                }
                
                const mes = fecha.getMonth() + 1; // Ya que los meses los cuenta desde el 0
                const dia = fecha.getDate();
                fecha_text = fecha.getFullYear()+'-'+(mes< 10?'0':'')+mes+'-'+(dia < 10 ? '0' : '')+dia;
                $("#fecha_inicio_estimacion").attr("min", fecha_text);
                $("#fecha_inicio_estimacion").attr("max", $(this).val());

                $("#fecha_recepcion").attr("min", $(this).val());;
                fecha = new Date($(this).val());
                console.log(fecha);
                fecha.setDate(fecha.getDate() + 6);
                console.log(fecha);

                const mes_1 = fecha.getMonth() + 1; // Ya que los meses los cuenta desde el 0
                const dia_1 = fecha.getDate();
                fecha_text = fecha.getFullYear()+'-'+(mes_1< 10?'0':'')+mes_1+'-'+(dia_1 < 10 ? '0' : '')+dia_1;
                
                $("#fecha_recepcion").attr("max", fecha_text);;

            });

            
            $('#fecha_inicio_estimacion_edit').change(function() {
                fecha = new Date($(this).val());
                fecha.setDate(fecha.getDate() + 30);
                fecha_final = new Date('{{$obj_obra->get('obra')->fecha_final_real}}');
                fecha_final.setDate(fecha_final.getDate() + 1);

                if(fecha_final < fecha){
                    fecha = fecha_final;
                }
                
                const mes = fecha.getMonth() + 1; // Ya que los meses los cuenta desde el 0
                const dia = fecha.getDate();
                fecha_text = fecha.getFullYear()+'-'+(mes< 10?'0':'')+mes+'-'+(dia < 10 ? '0' : '')+dia;
                $("#fecha_fin_estimacion_edit").attr("min", $(this).val());
                $("#fecha_fin_estimacion_edit").attr("max", fecha_text);
                
                $("#fecha_recepcion_edit").attr("min", fecha_text);;

                fecha.setDate(fecha.getDate() + 6);

                const mes_1 = fecha.getMonth() + 1; // Ya que los meses los cuenta desde el 0
                const dia_1 = fecha.getDate();
                fecha_text = fecha.getFullYear()+'-'+(mes_1< 10?'0':'')+mes_1+'-'+(dia_1 < 10 ? '0' : '')+dia_1;
                
                $("#fecha_recepcion_edit").attr("max", fecha_text);;
            });

            $('#fecha_fin_estimacion_edit').change(function() {

                fecha = new Date($(this).val());
                fecha.setDate(fecha.getDate() - 30);
                fecha_inicio = new Date('{{$obj_obra->get('obra')->fecha_inicio_programada}}');
                fecha_inicio.setDate(fecha_inicio.getDate() + 1);

                
                if(fecha_inicio > fecha){
                    fecha = fecha_inicio;
                }
                
                const mes = fecha.getMonth() + 1; // Ya que los meses los cuenta desde el 0
                const dia = fecha.getDate();
                fecha_text = fecha.getFullYear()+'-'+(mes< 10?'0':'')+mes+'-'+(dia < 10 ? '0' : '')+dia;
                $("#fecha_inicio_estimacion_edit").attr("min", fecha_text);
                $("#fecha_inicio_estimacion_edit").attr("max", $(this).val());

                $("#fecha_recepcion_edit").attr("min", $(this).val());;
                fecha = new Date($(this).val());
                console.log(fecha);
                fecha.setDate(fecha.getDate() + 6);
                console.log(fecha);

                const mes_1 = fecha.getMonth() + 1; // Ya que los meses los cuenta desde el 0
                const dia_1 = fecha.getDate();
                fecha_text = fecha.getFullYear()+'-'+(mes_1< 10?'0':'')+mes_1+'-'+(dia_1 < 10 ? '0' : '')+dia_1;
                
                $("#fecha_recepcion_edit").val($(this).val());
                $("#fecha_recepcion_edit").attr('min', $(this).val());
            });

            $("#formulario_create_estimacion").validate({
                onfocusout: false,
                onclick: false,
                rules: {
                    //total_estimacion: { required: true},
                    fecha_inicio_estimacion: { required: true},
                    fecha_fin_estimacion: { required: true},
                    folio_factura: { required: true},
                    fecha_recepcion: { required: true},
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

            $("#formulario_create_estimacion_edit").validate({
                onfocusout: false,
                onclick: false,
                rules: {
                    //total_estimacion: { required: true},
                    fecha_inicio_estimacion_edit: { required: true},
                    fecha_fin_estimacion_edit: { required: true},
                    folio_factura_edit: { required: true},
                    fecha_recepcion_edit: { required: true},
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

            $("#btn-create-estimacion").click(function () {  
                return true;          
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
            
            
        });

        
    </script>
@endif





@endsection



