@extends('layouts.plantilla')
@section('title','Editar ')
@section('contenido')
@inject('service', 'App\Http\Controllers\ObraController')
<link rel="stylesheet" href="{{ asset('css/style_alert.css') }}">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<div class="flex flex-row mb-4">
    <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
    </svg>
    <h1 class="font-bold text-xl ml-2">Modificar expediente tecnico de obra</h1>
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

<div class="mt-10 sm:mt-0 shadow-2xl bg-white rounded-lg container">
    <div class="mt-6 contenedor p-8 shadow-2xl bg-white rounded-lg">

        <div class="bg-gray-200 mt-5">
            <h2 class="font-bold text-lg text-center">Datos generales de la obra</h2>
        </div>
        
        <div class="mt-5 grid sm:grid-cols-9 gap-4">
            <div class="col-span-9">
                <p class="font-bold">{{ $obj_obra->get('obra')->nombre_obra }}</p>
            </div>
            <div class="sm:col-span-9">
                <p class="text-sm font-semibold">Nombre corto: <br><span class="ml-5 text-base font-bold mostrar_datos">{{ $obj_obra->get('obra')->nombre_corto_obra}}</span></p>
            </div>
            <div class="sm:col-span-3">
                <p class="text-sm font-semibold">Localidad <br><span class="ml-5 text-base font-bold">{{ $obj_obra->get('obra')->nombre_localidad }}</span></p>
            </div>
            <div class="sm:col-span-2">
                <p class="text-sm font-semibold">Municipio <br><span class="ml-5 text-base font-bold">{{ $obj_obra->get('obra')->nombre_municipio }}</span></p>
            </div>
            <div class="sm:col-span-2">
                <p class="text-sm font-semibold">Distrito <br><span class="ml-5 text-base font-bold">{{ $obj_obra->get('obra')->nombre_distrito }}</span></p>
            </div>
            <div class="sm:col-span-2">
                <p class="text-sm font-semibold">Estado <br><span class="ml-5 text-base font-bold">{{ $obj_obra->get('obra')->nombre_estado }}</span></p>
            </div>
        </div>

        <div class="bg-gray-200 mt-5">
            <h2 class="font-bold text-lg text-center">Modificar expediente técnico de obra</h2>
        </div>

        <div>
            
        </div>
        
        <form action="{{ route('update_expediente') }}" method="POST" accept-charset="UTF-8" enctype="multipart/form-data" id="formulario">
            @csrf
            @method('POST')
            <div class="relative mt-6 flex-auto">
                <div id="div_fuente_financiamiento">
                    <div class=" mt-5">
                        <h2 class="font-bold text-lg text-center">Parte social</h2>
                        <hr>
                    </div>
                    
                    <div class="grid sm:grid-cols-8 gap-x-4 gap-y-2 mt-5">
                        <div class="sm:col-span-4">
                            <div class="grid grid-cols-8">
                                <div class="col-span-5">
                                    <p class="dos-lineas line-height-1 text-center font-bold">
                                        Documento
                                    </p>
                                </div>
                                <div class="col-span-3">
                                    <p class="dos-lineas line-height-1 text-center font-bold">
                                        Integrado
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="sm:col-span-4">
                            <div class="grid grid-cols-8">
                                <div class="col-span-5">
                                    <p class="dos-lineas line-height-1 text-center font-bold">
                                        Documento
                                    </p>
                                </div>
                                <div class="col-span-3">
                                    <p class="dos-lineas line-height-1 text-center font-bold">
                                        Integrado
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="hidden">
                            <input type="text" name="id_obra" class="mt-1 focus:ring-blue-800 focus:border-blue-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ $obj_obra->get('obra')->id_obra }}">
                            <input type="text" name="modalidad_ejecucion" class="mt-1 focus:ring-blue-800 focus:border-blue-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{$obj_obra->get('obra')->modalidad_ejecucion }}">
                            <input type="text" id="total_documentos" name="total_documentos" class="mt-1 focus:ring-blue-800 focus:border-blue-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            <input type="text" id="total_si" name="total_si" class="mt-1 focus:ring-blue-800 focus:border-blue-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            <input type="text" id="total_na" name="total_na" class="mt-1 focus:ring-blue-800 focus:border-blue-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>
                        
                        <div class="border sm:col-span-4">
                            <div class="grid grid-cols-8 h-full flex items-center p-2">
                                <div class="col-span-5 ">
                                    <p class="dos-lineas line-height-1">
                                        Acta de integración del Consejo de Desarrollo Municipal.
                                    </p>
                                </div>
                                <div class="col-span-1">
                                    <div class="flex justify-center">
                                        <input class="display-block parte_social" type="radio" name="acta_integracion_consejo" value='1' {{$obj_obra->get('social')->acta_integracion_consejo == 1? 'checked': ''}} >
                                    </div>
                                    <p  class="text-sm font-medium text-gray-700 text-center"> Si</p>
                                </div>
                                <div class="col-span-1">
                                    <div class="flex justify-center">
                                        <input class="display-block parte_social" type="radio" name="acta_integracion_consejo" value='2' {{$obj_obra->get('social')->acta_integracion_consejo != 1? 'checked': ''}} >
                                    </div>
                                    <p  class="text-sm font-medium text-gray-700 text-center"> No</p>
                                </div>
                                <div class="col-span-1">
                                    <div class="flex justify-center">
                                        <input class="display-block parte_social" type="radio" name="acta_integracion_consejo" value='3' {{$obj_obra->get('social')->acta_integracion_consejo == 3? 'checked': ''}} >
                                    </div>
                                    <p  class="text-sm font-medium text-gray-700 text-center"> N/A</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="border sm:col-span-4">
                            <div class="grid grid-cols-8 h-full flex items-center p-2">
                                <div class="col-span-5 ">
                                    <p class="dos-lineas line-height-1">
                                        Acta de selección de obras.
                                    </p>
                                </div>
                                <div class="col-span-1">
                                    <div class="flex justify-center">
                                        <input class="display-block parte_social" type="radio" value='1' name="acta_seleccion_obras" {{$obj_obra->get('social')->acta_seleccion_obras == 1? 'checked': ''}} >
                                    </div>
                                    <p  class="text-sm font-medium text-gray-700 text-center"> Si</p>
                                </div>
                                <div class="col-span-1">
                                    <div class="flex justify-center">
                                        <input class="display-block parte_social" type="radio" value='2' name="acta_seleccion_obras" {{$obj_obra->get('social')->acta_seleccion_obras != 1? 'checked': ''}} >
                                    </div>
                                    <p  class="text-sm font-medium text-gray-700 text-center"> No</p>
                                </div>
                                <div class="col-span-1">
                                    <div class="flex justify-center">
                                        <input class="display-block parte_social" type="radio" value='3' name="acta_seleccion_obras" {{$obj_obra->get('social')->acta_seleccion_obras == 3? 'checked': ''}} >
                                    </div>
                                    <p  class="text-sm font-medium text-gray-700 text-center"> N/A</p>
                                </div>
                            </div>
                        </div>

                        <div class="border sm:col-span-4">
                            <div class="grid grid-cols-8 h-full flex items-center p-2">
                                <div class="col-span-5 ">
                                    <p class="dos-lineas line-height-1">
                                        Acta de priorización de obras, acciones sociales básicas e inversión.
                                    </p>
                                </div>
                                <div class="col-span-1">
                                    <div class="flex justify-center">
                                        <input class="display-block parte_social" type="radio" value='1' name="acta_priorizacion_obras" {{$obj_obra->get('social')->acta_priorizacion_obras == 1? 'checked': ''}} >
                                    </div>
                                    <p class="text-sm font-medium text-gray-700 text-center"> Si</p>
                                </div>
                                <div class="col-span-1">
                                    <div class="flex justify-center">
                                        <input class="display-block parte_social" type="radio" value='2' name="acta_priorizacion_obras" {{$obj_obra->get('social')->acta_priorizacion_obras != 1? 'checked': ''}} >
                                    </div>
                                    <p class="text-sm font-medium text-gray-700 text-center"> No</p>
                                </div>
                                <div class="col-span-1">
                                    <div class="flex justify-center">
                                        <input class="display-block parte_social" type="radio" value='3' name="acta_priorizacion_obras" {{$obj_obra->get('social')->acta_priorizacion_obras == 3? 'checked': ''}} >
                                    </div>
                                    <p  class="text-sm font-medium text-gray-700 text-center"> N/A</p>
                                </div>
                            </div>
                        </div>

                        <div class="border sm:col-span-4">
                            <div class="grid grid-cols-8 h-full flex items-center p-2">
                                <div class="col-span-5 ">
                                    <p class="dos-lineas line-height-1">
                                        Acta de integración del comité de obras.
                                    </p>
                                </div>
                                <div class="col-span-1">
                                    <div class="flex justify-center">
                                        <input class="display-block  parte_social" type="radio" value='1'  name="acta_integracion_comite" {{$obj_obra->get('social')->acta_integracion_comite == 1? 'checked': ''}} >
                                    </div>
                                    <p  class="text-sm font-medium text-gray-700 text-center"> Si</p>
                                </div>
                                <div class="col-span-1">
                                    <div class="flex justify-center">
                                        <input class="display-block parte_social" type="radio" value='2'  name="acta_integracion_comite" {{$obj_obra->get('social')->acta_integracion_comite != 1? 'checked': ''}} >
                                    </div>
                                    <p  class="text-sm font-medium text-gray-700 text-center"> No</p>
                                </div>
                                <div class="col-span-1">
                                    <div class="flex justify-center">
                                        <input class="display-block parte_social" type="radio" value='3'  name="acta_integracion_comite" {{$obj_obra->get('social')->acta_integracion_comite == 3? 'checked': ''}} >
                                    </div>
                                    <p  class="text-sm font-medium text-gray-700 text-center"> N/A</p>
                                </div>
                            </div>
                        </div>

                        <div class="border sm:col-span-4">
                            <div class="grid grid-cols-8 h-full flex items-center p-2">
                                <div class="col-span-5 ">
                                    <p class="dos-lineas line-height-1">
                                        Convenio de concertación.
                                    </p>
                                </div>
                                <div class="col-span-1">
                                    <div class="flex justify-center">
                                        <input class="display-block parte_social" type="radio" value='1'  name="convenio_concertacion" {{$obj_obra->get('social')->convenio_concertacion == 1? 'checked': ''}} >
                                    </div>
                                    <p  class="text-sm font-medium text-gray-700 text-center"> Si</p>
                                </div>
                                <div class="col-span-1">
                                    <div class="flex justify-center">
                                        <input class="display-block parte_social" type="radio" value='2'  name="convenio_concertacion" {{$obj_obra->get('social')->convenio_concertacion != 1? 'checked': ''}} >
                                    </div>
                                    <p  class="text-sm font-medium text-gray-700 text-center"> No</p>
                                </div>
                                <div class="col-span-1">
                                    <div class="flex justify-center">
                                        <input class="display-block parte_social" type="radio" value='3'  name="convenio_concertacion" {{$obj_obra->get('social')->convenio_concertacion == 3? 'checked': ''}} >
                                    </div>
                                    <p  class="text-sm font-medium text-gray-700 text-center"> N/A</p>
                                </div>
                            </div>
                        </div>

                        <div class="border sm:col-span-4">
                            <div class="grid grid-cols-8 h-full flex items-center p-2">
                                <div class="col-span-5 ">
                                    <p class="dos-lineas line-height-1">
                                        {{$obj_obra->get('obra')->modalidad_ejecucion == 2?'Acta de excepción a la licitación pública.': 'Acta de acuerdo de cabildo para ejecutar la obra por Administracion Directa.'}}
                                    </p>
                                </div>
                                <div class="col-span-1">
                                    <div class="flex justify-center">
                                        <input class="display-block parte_social" type="radio" value='1'  name="acta_excep_licitacion" {{$obj_obra->get('social')->acta_excep_licitacion == 1? 'checked': ''}} >
                                    </div>
                                    <p  class="text-sm font-medium text-gray-700 text-center"> Si</p>
                                </div>
                                <div class="col-span-1">
                                    <div class="flex justify-center">
                                        <input class="display-block parte_social" type="radio" value='2'  name="acta_excep_licitacion" {{$obj_obra->get('social')->acta_excep_licitacion != 1? 'checked': ''}} >
                                    </div>
                                    <p  class="text-sm font-medium text-gray-700 text-center"> No</p>
                                </div>
                                <div class="col-span-1">
                                    <div class="flex justify-center">
                                        <input class="display-block parte_social" type="radio" value='3'  name="acta_excep_licitacion" {{$obj_obra->get('social')->acta_excep_licitacion == 3? 'checked': ''}} >
                                    </div>
                                    <p  class="text-sm font-medium text-gray-700 text-center"> N/A</p>
                                </div>
                            </div>
                        </div>

                        <div class="border sm:col-span-4">
                            <div class="grid grid-cols-8 h-full flex items-center p-2">
                                <div class="col-span-5 ">
                                    <p class="dos-lineas line-height-1">
                                        Convenio celebrado con instancias Estatales y Federales para Mezcla de recursos, transferencias de recursos.
                                    </p>
                                </div>
                                <div class="col-span-1">
                                    <div class="flex justify-center">
                                        <input class="display-block parte_social" type="radio" value='1'  name="convenio_mezcla" {{$obj_obra->get('social')->convenio_mezcla == 1? 'checked': ''}} >
                                    </div>
                                    <p  class="text-sm font-medium text-gray-700 text-center"> Si</p>
                                </div>
                                <div class="col-span-1">
                                    <div class="flex justify-center">
                                        <input class="display-block parte_social" type="radio" value='2'  name="convenio_mezcla" {{$obj_obra->get('social')->convenio_mezcla != 1? 'checked': ''}} >
                                    </div>
                                    <p  class="text-sm font-medium text-gray-700 text-center"> No</p>
                                </div>
                                <div class="col-span-1">
                                    <div class="flex justify-center">
                                        <input class="display-block parte_social" type="radio" value='3'  name="convenio_mezcla" {{$obj_obra->get('social')->convenio_mezcla == 3? 'checked': ''}} >
                                    </div>
                                    <p  class="text-sm font-medium text-gray-700 text-center"> N/A</p>
                                </div>
                            </div>
                        </div>

                        <div class="border sm:col-span-4">
                            <div class="grid grid-cols-8 h-full flex items-center p-2">
                                <div class="col-span-5 ">
                                    <p class="dos-lineas line-height-1">
                                        Acta de aprobacion y autorizacion de obras, acciones sociales e inversiones.
                                    </p>
                                </div>
                                <div class="col-span-1">
                                    <div class="flex justify-center">
                                        <input class="display-block parte_social" type="radio" value='1'  name="acta_aprobacion_obra" {{$obj_obra->get('social')->acta_aprobacion_obra == 1? 'checked': ''}} >
                                    </div>
                                    <p  class="text-sm font-medium text-gray-700 text-center"> Si</p>
                                </div>
                                <div class="col-span-1">
                                    <div class="flex justify-center">
                                        <input class="display-block parte_social" type="radio" value='2'  name="acta_aprobacion_obra" {{$obj_obra->get('social')->acta_aprobacion_obra != 1? 'checked': ''}} >
                                    </div>
                                    <p  class="text-sm font-medium text-gray-700 text-center"> No</p>
                                </div>
                                <div class="col-span-1">
                                    <div class="flex justify-center">
                                        <input class="display-block parte_social" type="radio" value='3'  name="acta_aprobacion_obra" {{$obj_obra->get('social')->acta_aprobacion_obra == 3? 'checked': ''}} >
                                    </div>
                                    <p  class="text-sm font-medium text-gray-700 text-center"> N/A</p>
                                </div>
                            </div>
                        </div>
                        
                        
                        @if($obj_obra->get('obra')->modalidad_ejecucion == 2 && $obj_obra->get('contrato')->modalidad_asignacion == 3)
                            <div class="border sm:col-span-4">
                                <div class="grid grid-cols-8 h-full flex items-center p-2">
                                    <div class="col-span-5 ">
                                        <p class="dos-lineas line-height-1">
                                            Acta para adjudicar la obra de manera directa.
                                        </p>
                                    </div>
                                    <div class="col-span-1">
                                        <div class="flex justify-center">
                                            <input class="display-block parte_social" type="radio"  name="acta_ejecutar_adjudicacion" {{$obj_obra->get('social')->acta_ejecutar_adjudicacion == 1? 'checked': ''}} >
                                        </div>
                                        <p  class="text-sm font-medium text-gray-700 text-center"> Si</p>
                                    </div>
                                    <div class="col-span-1">
                                        <div class="flex justify-center">
                                            <input class="display-block parte_social" type="radio"  name="acta_ejecutar_adjudicacion" {{$obj_obra->get('social')->acta_ejecutar_adjudicacion != 1? 'checked': ''}} >
                                        </div>
                                        <p  class="text-sm font-medium text-gray-700 text-center"> No</p>
                                    </div>
                                    <div class="col-span-1">
                                        <div class="flex justify-center">
                                            <input class="display-block parte_social" type="radio"  name="acta_ejecutar_adjudicacion" {{$obj_obra->get('social')->acta_ejecutar_adjudicacion == 1? 'checked': ''}} >
                                        </div>
                                        <p  class="text-sm font-medium text-gray-700 text-center"> N/A</p>
                                    </div>
                                </div>
                            </div>
                        @endif
                        
                    </div>
                </div>

                <div id="modalidad_ejecucion" style="display: none;">
                    <div class=" bg-gray-100 mt-5">
                        <h2 class="font-bold text-lg text-center">Parte técnica</h2>
                    </div>
                    <div>
                        <h2 class="font-semibold text-lg text-center">Proyecto ejecutivo</h2>
                        <hr>
                    </div>
                    <div class="grid sm:grid-cols-8 gap-x-4 gap-y-2 mt-5">
                        <div class="sm:col-span-4">
                            <div class="grid grid-cols-8">
                                <div class="col-span-5">
                                    <p class="dos-lineas line-height-1 text-center font-bold">
                                        Documento
                                    </p>
                                </div>
                                <div class="col-span-3">
                                    <p class="dos-lineas line-height-1 text-center font-bold">
                                        Integrado
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="sm:col-span-4">
                            <div class="grid grid-cols-8">
                                <div class="col-span-5">
                                    <p class="dos-lineas line-height-1 text-center font-bold">
                                        Documento
                                    </p>
                                </div>
                                <div class="col-span-3">
                                    <p class="dos-lineas line-height-1 text-center font-bold">
                                        Integrado
                                    </p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="border sm:col-span-4">
                            <div class="grid grid-cols-8 h-full flex items-center p-2">
                                <div class="col-span-5 ">
                                    <p class="dos-lineas line-height-1">
                                        Estudio de factibilidad técnica, económica y ecológica de la realización de la obra.
                                    </p>
                                </div>
                                <div class="col-span-1">
                                    <div class="flex justify-center">
                                        <input class="display-block parte_social" type="radio" name="estudio_factibilidad" value='1' {{$obj_obra->get('social')->estudio_factibilidad == 1? 'checked': ''}} >
                                    </div>
                                    <p  class="text-sm font-medium text-gray-700 text-center"> Si</p>
                                </div>
                                <div class="col-span-1">
                                    <div class="flex justify-center">
                                        <input class="display-block parte_social" type="radio" name="estudio_factibilidad" value='2' {{$obj_obra->get('social')->estudio_factibilidad != 1? 'checked': ''}} >
                                    </div>
                                    <p  class="text-sm font-medium text-gray-700 text-center"> No</p>
                                </div>
                                <div class="col-span-1">
                                    <div class="flex justify-center">
                                        <input class="display-block parte_social" type="radio" name="estudio_factibilidad" value='3' {{$obj_obra->get('social')->estudio_factibilidad == 3? 'checked': ''}} >
                                    </div>
                                    <p  class="text-sm font-medium text-gray-700 text-center"> N/A</p>
                                </div>
                            </div>
                        </div>

                        <div class="border sm:col-span-4">
                            <div class="grid grid-cols-8 h-full flex items-center p-2">
                                <div class="col-span-5 ">
                                    <p class="dos-lineas line-height-1">
                                        Oficio de notificación de aprobación y autorización de obras, acciones sociales básicas e inversiones.
                                    </p>
                                </div>
                                <div class="col-span-1">
                                    <div class="flex justify-center">
                                        <input class="display-block parte_social" type="radio" name="oficio_aprobacion_obra" value='1' {{$obj_obra->get('social')->oficio_aprobacion_obra == 1? 'checked': ''}} >
                                    </div>
                                    <p  class="text-sm font-medium text-gray-700 text-center"> Si</p>
                                </div>
                                <div class="col-span-1">
                                    <div class="flex justify-center">
                                        <input class="display-block parte_social" type="radio" name="oficio_aprobacion_obra" value='2' {{$obj_obra->get('social')->oficio_aprobacion_obra != 1? 'checked': ''}} >
                                    </div>
                                    <p  class="text-sm font-medium text-gray-700 text-center"> No</p>
                                </div>
                                <div class="col-span-1">
                                    <div class="flex justify-center">
                                        <input class="display-block parte_social" type="radio" name="oficio_aprobacion_obra" value='3' {{$obj_obra->get('social')->oficio_aprobacion_obra == 3? 'checked': ''}} >
                                    </div>
                                    <p  class="text-sm font-medium text-gray-700 text-center"> N/A</p>
                                </div>
                            </div>
                        </div>

                        <div class="border sm:col-span-4">
                            <div class="grid grid-cols-8 h-full flex items-center p-2">
                                <div class="col-span-5 ">
                                    <p class="dos-lineas line-height-1">
                                        Anexos del oficio de notificación, de aprobación y autorización de obras, acciones sociales básicas e inversiones.
                                    </p>
                                </div>
                                <div class="col-span-1">
                                    <div class="flex justify-center">
                                        <input class="display-block parte_social" type="radio" name="anexos_oficio_notificacion" value='1' {{$obj_obra->get('social')->anexos_oficio_notificacion == 1? 'checked': ''}} >
                                    </div>
                                    <p  class="text-sm font-medium text-gray-700 text-center"> Si</p>
                                </div>
                                <div class="col-span-1">
                                    <div class="flex justify-center">
                                        <input class="display-block parte_social" type="radio" name="anexos_oficio_notificacion" value='2' {{$obj_obra->get('social')->anexos_oficio_notificacion != 1? 'checked': ''}} >
                                    </div>
                                    <p  class="text-sm font-medium text-gray-700 text-center"> No</p>
                                </div>
                                <div class="col-span-1">
                                    <div class="flex justify-center">
                                        <input class="display-block parte_social" type="radio" name="anexos_oficio_notificacion" value='3' {{$obj_obra->get('social')->anexos_oficio_notificacion == 3? 'checked': ''}} >
                                    </div>
                                    <p  class="text-sm font-medium text-gray-700 text-center"> N/A</p>
                                </div>
                            </div>
                        </div>


                        <div class="border sm:col-span-4">
                            <div class="grid grid-cols-8 h-full flex items-center p-2">
                                <div class="col-span-5 ">
                                    <p class="dos-lineas line-height-1">
                                        Cédula de información básica.
                                    </p>
                                </div>
                                <div class="col-span-1">
                                    <div class="flex justify-center">
                                        <input class="display-block parte_social" type="radio" name="cedula_informacion_basica" value='1' {{$obj_obra->get('social')->cedula_informacion_basica == 1? 'checked': ''}} >
                                    </div>
                                    <p  class="text-sm font-medium text-gray-700 text-center"> Si</p>
                                </div>
                                <div class="col-span-1">
                                    <div class="flex justify-center">
                                        <input class="display-block parte_social" type="radio" name="cedula_informacion_basica" value='2' {{$obj_obra->get('social')->cedula_informacion_basica != 1? 'checked': ''}} >
                                    </div>
                                    <p  class="text-sm font-medium text-gray-700 text-center"> No</p>
                                </div>
                                <div class="col-span-1">
                                    <div class="flex justify-center">
                                        <input class="display-block parte_social" type="radio" name="cedula_informacion_basica" value='3' {{$obj_obra->get('social')->cedula_informacion_basica == 3? 'checked': ''}} >
                                    </div>
                                    <p  class="text-sm font-medium text-gray-700 text-center"> N/A</p>
                                </div>
                            </div>
                        </div>

                        <div class="border sm:col-span-4">
                            <div class="grid grid-cols-8 h-full flex items-center p-2">
                                <div class="col-span-5 ">
                                    <p class="dos-lineas line-height-1">
                                        Generalidades de la inversión.
                                    </p>
                                </div>
                                <div class="col-span-1">
                                    <div class="flex justify-center">
                                        <input class="display-block parte_social" type="radio" name="generalidades_inversion" value='1' {{$obj_obra->get('social')->generalidades_inversion == 1? 'checked': ''}} >
                                    </div>
                                    <p  class="text-sm font-medium text-gray-700 text-center"> Si</p>
                                </div>
                                <div class="col-span-1">
                                    <div class="flex justify-center">
                                        <input class="display-block parte_social" type="radio" name="generalidades_inversion" value='2' {{$obj_obra->get('social')->generalidades_inversion != 1? 'checked': ''}} >
                                    </div>
                                    <p  class="text-sm font-medium text-gray-700 text-center"> No</p>
                                </div>
                                <div class="col-span-1">
                                    <div class="flex justify-center">
                                        <input class="display-block parte_social" type="radio" name="generalidades_inversion" value='3' {{$obj_obra->get('social')->generalidades_inversion == 3? 'checked': ''}} >
                                    </div>
                                    <p  class="text-sm font-medium text-gray-700 text-center"> N/A</p>
                                </div>
                            </div>
                        </div>

                        <div class="border sm:col-span-4">
                            <div class="grid grid-cols-8 h-full flex items-center p-2">
                                <div class="col-span-5 ">
                                    <p class="dos-lineas line-height-1">
                                        Documentos que acrediten la tenencia de la tierra.
                                    </p>
                                </div>
                                <div class="col-span-1">
                                    <div class="flex justify-center">
                                        <input class="display-block parte_social" type="radio" name="tenencia_tierra" value='1' {{$obj_obra->get('social')->tenencia_tierra == 1? 'checked': ''}} >
                                    </div>
                                    <p  class="text-sm font-medium text-gray-700 text-center"> Si</p>
                                </div>
                                <div class="col-span-1">
                                    <div class="flex justify-center">
                                        <input class="display-block parte_social" type="radio" name="tenencia_tierra" value='2' {{$obj_obra->get('social')->tenencia_tierra != 1? 'checked': ''}}>
                                    </div>
                                    <p  class="text-sm font-medium text-gray-700 text-center"> No</p>
                                </div>
                                <div class="col-span-1">
                                    <div class="flex justify-center">
                                        <input class="display-block parte_social" type="radio" name="tenencia_tierra" value='3' {{$obj_obra->get('social')->tenencia_tierra == 3? 'checked': ''}} >
                                    </div>
                                    <p  class="text-sm font-medium text-gray-700 text-center"> N/A</p>
                                </div>
                            </div>
                        </div>

                        <div class="border sm:col-span-4">
                            <div class="grid grid-cols-8 h-full flex items-center p-2">
                                <div class="col-span-5 ">
                                    <p class="dos-lineas line-height-1">
                                        Dictamen de impacto ambiental.
                                    </p>
                                </div>
                                <div class="col-span-1">
                                    <div class="flex justify-center">
                                        <input class="display-block parte_social" type="radio" name="dictamen_impacto_ambiental" value='1' {{$obj_obra->get('social')->dictamen_impacto_ambiental == 1? 'checked': ''}} >
                                    </div>
                                    <p  class="text-sm font-medium text-gray-700 text-center"> Si</p>
                                </div>
                                <div class="col-span-1">
                                    <div class="flex justify-center">
                                        <input class="display-block parte_social" type="radio" name="dictamen_impacto_ambiental" value='2' {{$obj_obra->get('social')->dictamen_impacto_ambiental != 1? 'checked': ''}} >
                                    </div>
                                    <p  class="text-sm font-medium text-gray-700 text-center"> No</p>
                                </div>
                                <div class="col-span-1">
                                    <div class="flex justify-center">
                                        <input class="display-block parte_social" type="radio" name="dictamen_impacto_ambiental" value='3' {{$obj_obra->get('social')->dictamen_impacto_ambiental == 3? 'checked': ''}} >
                                    </div>
                                    <p  class="text-sm font-medium text-gray-700 text-center"> N/A</p>
                                </div>
                            </div>
                        </div>

                        <div class="border sm:col-span-4">
                            <div class="grid grid-cols-8 h-full flex items-center p-2">
                                <div class="col-span-5 ">
                                    <p class="dos-lineas line-height-1">
                                        Presupuesto de obra programada.
                                    </p>
                                </div>
                                <div class="col-span-1">
                                    <div class="flex justify-center">
                                        <input class="display-block parte_social" type="radio" name="presupuesto_obra" value='1' {{$obj_obra->get('social')->presupuesto_obra == 1? 'checked': ''}} >
                                    </div>
                                    <p  class="text-sm font-medium text-gray-700 text-center"> Si</p>
                                </div>
                                <div class="col-span-1">
                                    <div class="flex justify-center">
                                        <input class="display-block parte_social" type="radio" name="presupuesto_obra" value='2' {{$obj_obra->get('social')->presupuesto_obra != 1? 'checked': ''}} >
                                    </div>
                                    <p  class="text-sm font-medium text-gray-700 text-center"> No</p>
                                </div>
                                <div class="col-span-1">
                                    <div class="flex justify-center">
                                        <input class="display-block parte_social" type="radio" name="presupuesto_obra" value='3' {{$obj_obra->get('social')->presupuesto_obra == 3? 'checked': ''}} >
                                    </div>
                                    <p  class="text-sm font-medium text-gray-700 text-center"> N/A</p>
                                </div>
                            </div>
                        </div>

                        <div class="border sm:col-span-4">
                            <div class="grid grid-cols-8 h-full flex items-center p-2">
                                <div class="col-span-5 ">
                                    <p class="dos-lineas line-height-1">
                                        Catálogo de conceptos.
                                    </p>
                                </div>
                                <div class="col-span-1">
                                    <div class="flex justify-center">
                                        <input class="display-block parte_social" type="radio" name="catalogo_conceptos_social" value='1' {{$obj_obra->get('social')->catalogo_conceptos == 1? 'checked': ''}} >
                                    </div>
                                    <p  class="text-sm font-medium text-gray-700 text-center"> Si</p>
                                </div>
                                <div class="col-span-1">
                                    <div class="flex justify-center">
                                        <input class="display-block parte_social" type="radio" name="catalogo_conceptos_social" value='2' {{$obj_obra->get('social')->catalogo_conceptos != 1? 'checked': ''}} >
                                    </div>
                                    <p  class="text-sm font-medium text-gray-700 text-center"> No</p>
                                </div>
                                <div class="col-span-1">
                                    <div class="flex justify-center">
                                        <input class="display-block parte_social" type="radio" name="catalogo_conceptos_social" value='3' {{$obj_obra->get('social')->catalogo_conceptos == 3? 'checked': ''}} >
                                    </div>
                                    <p  class="text-sm font-medium text-gray-700 text-center"> N/A</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="border sm:col-span-4">
                            <div class="grid grid-cols-8 h-full flex items-center p-2">
                                <div class="col-span-5 ">
                                    <p class="dos-lineas line-height-1">
                                        Explosión de insumos programada.
                                    </p>
                                </div>
                                <div class="col-span-1">
                                    <div class="flex justify-center">
                                        <input class="display-block parte_social" type="radio" name="explosion_insumos" value='1' {{$obj_obra->get('social')->explosion_insumos == 1? 'checked': ''}} >
                                    </div>
                                    <p  class="text-sm font-medium text-gray-700 text-center"> Si</p>
                                </div>
                                <div class="col-span-1">
                                    <div class="flex justify-center">
                                        <input class="display-block parte_social" type="radio" name="explosion_insumos" value='2' {{$obj_obra->get('social')->explosion_insumos != 1? 'checked': ''}} >
                                    </div>
                                    <p  class="text-sm font-medium text-gray-700 text-center"> No</p>
                                </div>
                                <div class="col-span-1">
                                    <div class="flex justify-center">
                                        <input class="display-block parte_social" type="radio" name="explosion_insumos" value='3' {{$obj_obra->get('social')->explosion_insumos == 3? 'checked': ''}} >
                                    </div>
                                    <p  class="text-sm font-medium text-gray-700 text-center"> N/A</p>
                                </div>
                            </div>
                        </div>

                        <div class="border sm:col-span-4">
                            <div class="grid grid-cols-8 h-full flex items-center p-2">
                                <div class="col-span-5 ">
                                    <p class="dos-lineas line-height-1">
                                        Generadores de obra programada.
                                    </p>
                                </div>
                                <div class="col-span-1">
                                    <div class="flex justify-center">
                                        <input class="display-block parte_social" type="radio" name="generadores_obra" value='1' {{$obj_obra->get('social')->generadores_obra == 1? 'checked': ''}} >
                                    </div>
                                    <p  class="text-sm font-medium text-gray-700 text-center"> Si</p>
                                </div>
                                <div class="col-span-1">
                                    <div class="flex justify-center">
                                        <input class="display-block parte_social" type="radio" name="generadores_obra" value='2' {{$obj_obra->get('social')->generadores_obra != 1? 'checked': ''}} >
                                    </div>
                                    <p  class="text-sm font-medium text-gray-700 text-center"> No</p>
                                </div>
                                <div class="col-span-1">
                                    <div class="flex justify-center">
                                        <input class="display-block parte_social" type="radio" name="generadores_obra" value='3' {{$obj_obra->get('social')->generadores_obra == 3? 'checked': ''}} >
                                    </div>
                                    <p  class="text-sm font-medium text-gray-700 text-center"> N/A</p>
                                </div>
                            </div>
                        </div>

                        <div class="border sm:col-span-4">
                            <div class="grid grid-cols-8 h-full flex items-center p-2">
                                <div class="col-span-5 ">
                                    <p class="dos-lineas line-height-1">
                                        Planos del proyecto.
                                    </p>
                                </div>
                                <div class="col-span-1">
                                    <div class="flex justify-center">
                                        <input class="display-block parte_social" type="radio" name="planos_proyecto" value='1' {{$obj_obra->get('social')->planos_proyecto == 1? 'checked': ''}} >
                                    </div>
                                    <p  class="text-sm font-medium text-gray-700 text-center"> Si</p>
                                </div>
                                <div class="col-span-1">
                                    <div class="flex justify-center">
                                        <input class="display-block parte_social" type="radio" name="planos_proyecto" value='2' {{$obj_obra->get('social')->planos_proyecto != 1? 'checked': ''}} >
                                    </div>
                                    <p  class="text-sm font-medium text-gray-700 text-center"> No</p>
                                </div>
                                <div class="col-span-1">
                                    <div class="flex justify-center">
                                        <input class="display-block parte_social" type="radio" name="planos_proyecto" value='3' {{$obj_obra->get('social')->planos_proyecto == 3? 'checked': ''}} >
                                    </div>
                                    <p  class="text-sm font-medium text-gray-700 text-center"> N/A</p>
                                </div>
                            </div>
                        </div>

                        <div class="border sm:col-span-4">
                            <div class="grid grid-cols-8 h-full flex items-center p-2">
                                <div class="col-span-5 ">
                                    <p class="dos-lineas line-height-1">
                                        Especificaciones generales y particulares de construcción.
                                    </p>
                                </div>
                                <div class="col-span-1">
                                    <div class="flex justify-center">
                                        <input class="display-block parte_social" type="radio" name="especificaciones_generales_particulares" value='1' {{$obj_obra->get('social')->especificaciones_generales_particulares == 1? 'checked': ''}} >
                                    </div>
                                    <p  class="text-sm font-medium text-gray-700 text-center"> Si</p>
                                </div>
                                <div class="col-span-1">
                                    <div class="flex justify-center">
                                        <input class="display-block parte_social" type="radio" name="especificaciones_generales_particulares" value='2' {{$obj_obra->get('social')->especificaciones_generales_particulares != 1? 'checked': ''}} >
                                    </div>
                                    <p  class="text-sm font-medium text-gray-700 text-center"> No</p>
                                </div>
                                <div class="col-span-1">
                                    <div class="flex justify-center">
                                        <input class="display-block parte_social" type="radio" name="especificaciones_generales_particulares" value='3' {{$obj_obra->get('social')->especificaciones_generales_particulares == 3? 'checked': ''}} >
                                    </div>
                                    <p  class="text-sm font-medium text-gray-700 text-center"> N/A</p>
                                </div>
                            </div>
                        </div>

                        <div class="border sm:col-span-4">
                            <div class="grid grid-cols-8 h-full flex items-center p-2">
                                <div class="col-span-5 ">
                                    <p class="dos-lineas line-height-1">
                                        Licencia del Director Responsable de Obra.
                                    </p>
                                </div>
                                <div class="col-span-1">
                                    <div class="flex justify-center">
                                        <input class="display-block parte_social" type="radio" name="dro" value='1' {{$obj_obra->get('social')->dro == 1? 'checked': ''}} >
                                    </div>
                                    <p  class="text-sm font-medium text-gray-700 text-center"> Si</p>
                                </div>
                                <div class="col-span-1">
                                    <div class="flex justify-center">
                                        <input class="display-block parte_social" type="radio" name="dro" value='2' {{$obj_obra->get('social')->dro != 1? 'checked': ''}}  >
                                    </div>
                                    <p  class="text-sm font-medium text-gray-700 text-center"> No</p>
                                </div>
                                <div class="col-span-1">
                                    <div class="flex justify-center">
                                        <input class="display-block parte_social" type="radio" name="dro" value='3' {{$obj_obra->get('social')->dro == 3? 'checked': ''}} >
                                    </div>
                                    <p  class="text-sm font-medium text-gray-700 text-center"> N/A</p>
                                </div>
                            </div>
                        </div>

                        <div class="border sm:col-span-4">
                            <div class="grid grid-cols-8 h-full flex items-center p-2">
                                <div class="col-span-5 ">
                                    <p class="dos-lineas line-height-1">
                                        Programa de obra e inversión.
                                    </p>
                                </div>
                                <div class="col-span-1">
                                    <div class="flex justify-center">
                                        <input class="display-block parte_social" type="radio" name="programa_obra_inversion" value='1' {{$obj_obra->get('social')->programa_obra_inversion == 1? 'checked': ''}} >
                                    </div>
                                    <p  class="text-sm font-medium text-gray-700 text-center"> Si</p>
                                </div>
                                <div class="col-span-1">
                                    <div class="flex justify-center">
                                        <input class="display-block parte_social" type="radio" name="programa_obra_inversion" value='2' {{$obj_obra->get('social')->programa_obra_inversion != 1? 'checked': ''}} >
                                    </div>
                                    <p  class="text-sm font-medium text-gray-700 text-center"> No</p>
                                </div>
                                <div class="col-span-1">
                                    <div class="flex justify-center">
                                        <input class="display-block parte_social" type="radio" name="programa_obra_inversion" value='3' {{$obj_obra->get('social')->programa_obra_inversion == 3? 'checked': ''}} >
                                    </div>
                                    <p  class="text-sm font-medium text-gray-700 text-center"> N/A</p>
                                </div>
                            </div>
                        </div>

                        <div class="border sm:col-span-4">
                            <div class="grid grid-cols-8 h-full flex items-center p-2">
                                <div class="col-span-5 ">
                                    <p class="dos-lineas line-height-1">
                                        Croquis de macro localización
                                    </p>
                                </div>
                                <div class="col-span-1">
                                    <div class="flex justify-center">
                                        <input class="display-block parte_social" type="radio" name="croquis_macro" value='1' {{$obj_obra->get('social')->croquis_macro == 1? 'checked': ''}} >
                                    </div>
                                    <p  class="text-sm font-medium text-gray-700 text-center"> Si</p>
                                </div>
                                <div class="col-span-1">
                                    <div class="flex justify-center">
                                        <input class="display-block parte_social" type="radio" name="croquis_macro" value='2' {{$obj_obra->get('social')->croquis_macro != 1? 'checked': ''}} >
                                    </div>
                                    <p  class="text-sm font-medium text-gray-700 text-center"> No</p>
                                </div>
                                <div class="col-span-1">
                                    <div class="flex justify-center">
                                        <input class="display-block parte_social" type="radio" name="croquis_macro" value='3' {{$obj_obra->get('social')->croquis_macro == 3? 'checked': ''}} >
                                    </div>
                                    <p  class="text-sm font-medium text-gray-700 text-center"> N/A</p>
                                </div>
                            </div>
                        </div>

                        <div class="border sm:col-span-4">
                            <div class="grid grid-cols-8 h-full flex items-center p-2">
                                <div class="col-span-5 ">
                                    <p class="dos-lineas line-height-1">
                                        Croquis de micro localización.
                                    </p>
                                </div>
                                <div class="col-span-1">
                                    <div class="flex justify-center">
                                        <input class="display-block parte_social" type="radio" name="croquis_micro" value='1' {{$obj_obra->get('social')->croquis_micro == 1? 'checked': ''}} >
                                    </div>
                                    <p  class="text-sm font-medium text-gray-700 text-center"> Si</p>
                                </div>
                                <div class="col-span-1">
                                    <div class="flex justify-center">
                                        <input class="display-block parte_social" type="radio" name="croquis_micro" value='2' {{$obj_obra->get('social')->croquis_micro != 1? 'checked': ''}} >
                                    </div>
                                    <p  class="text-sm font-medium text-gray-700 text-center"> No</p>
                                </div>
                                <div class="col-span-1">
                                    <div class="flex justify-center">
                                        <input class="display-block parte_social" type="radio" name="croquis_micro" value='3' {{$obj_obra->get('social')->croquis_micro == 3? 'checked': ''}} >
                                    </div>
                                    <p  class="text-sm font-medium text-gray-700 text-center"> N/A</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>

                @if ($obj_obra->get('obra')->modalidad_ejecucion == 2)
                    <div id="datos_generales" style="display: none;">
                        <div class=" bg-gray-100 mt-5">
                            <h2 class="font-bold text-lg text-center">Parte técnica</h2>
                        </div>
                        <div>
                            <h2 class="font-semibold text-lg text-center">Proceso de contratación</h2>
                            <hr>
                        </div>
                        <div class="grid sm:grid-cols-8 gap-x-4 gap-y-2 mt-5">
                            <div class="sm:col-span-4">
                                <div class="grid grid-cols-8">
                                    <div class="col-span-5">
                                        <p class="dos-lineas line-height-1 text-center font-bold">
                                            Documento
                                        </p>
                                    </div>
                                    <div class="col-span-3">
                                        <p class="dos-lineas line-height-1 text-center font-bold">
                                            Integrado
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="sm:col-span-4">
                                <div class="grid grid-cols-8">
                                    <div class="col-span-5">
                                        <p class="dos-lineas line-height-1 text-center font-bold">
                                            Documento
                                        </p>
                                    </div>
                                    <div class="col-span-3">
                                        <p class="dos-lineas line-height-1 text-center font-bold">
                                            Integrado
                                        </p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="border sm:col-span-4">
                                <div class="grid grid-cols-8 h-full flex items-center p-2">
                                    <div class="col-span-5 ">
                                        <p class="dos-lineas line-height-1">
                                            Inscripción al padrón de contratista.
                                        </p>
                                    </div>
                                    <div class="col-span-1">
                                        <div class="flex justify-center">
                                            <input class="display-block parte_social" type="radio" name="padron_contratistas" value='1' {{$obj_obra->get('contrato')->padron_contratistas == 1? 'checked': ''}} >
                                        </div>
                                        <p  class="text-sm font-medium text-gray-700 text-center"> Si</p>
                                    </div>
                                    <div class="col-span-1">
                                        <div class="flex justify-center">
                                            <input class="display-block parte_social" type="radio" name="padron_contratistas" value='2' {{$obj_obra->get('contrato')->padron_contratistas != 1? 'checked': ''}} >
                                        </div>
                                        <p  class="text-sm font-medium text-gray-700 text-center"> No</p>
                                    </div>
                                    <div class="col-span-1">
                                        <div class="flex justify-center">
                                            <input class="display-block parte_social" type="radio" name="padron_contratistas" value='3' {{$obj_obra->get('contrato')->padron_contratistas == 3? 'checked': ''}} >
                                        </div>
                                        <p  class="text-sm font-medium text-gray-700 text-center"> N/A</p>
                                    </div>
                                </div>
                            </div>

                            <div class="border sm:col-span-4">
                                <div class="grid grid-cols-8 h-full flex items-center p-2">
                                    <div class="col-span-5 ">
                                        <p class="dos-lineas line-height-1">
                                            Invitaciones (con acuses de recepción).
                                        </p>
                                    </div>
                                    <div class="col-span-1">
                                        <div class="flex justify-center">
                                            <input class="display-block parte_social" type="radio" name="invitacion_acuse_recepcion" value='1' {{$obj_obra->get('contrato')->invitacion_acuse_recepcion == 1? 'checked': ''}} >
                                        </div>
                                        <p  class="text-sm font-medium text-gray-700 text-center"> Si</p>
                                    </div>
                                    <div class="col-span-1">
                                        <div class="flex justify-center">
                                            <input class="display-block parte_social" type="radio" name="invitacion_acuse_recepcion" value='2' {{$obj_obra->get('contrato')->invitacion_acuse_recepcion != 1? 'checked': ''}} >
                                        </div>
                                        <p  class="text-sm font-medium text-gray-700 text-center"> No</p>
                                    </div>
                                    <div class="col-span-1">
                                        <div class="flex justify-center">
                                            <input class="display-block parte_social" type="radio" name="invitacion_acuse_recepcion" value='3' {{$obj_obra->get('contrato')->invitacion_acuse_recepcion == 3? 'checked': ''}} >
                                        </div>
                                        <p  class="text-sm font-medium text-gray-700 text-center"> N/A</p>
                                    </div>
                                </div>
                            </div>

                            <div class="border sm:col-span-4">
                                <div class="grid grid-cols-8 h-full flex items-center p-2">
                                    <div class="col-span-5 ">
                                        <p class="dos-lineas line-height-1">
                                            Oficio de aceptación de la invitación (con acuses de recepción).
                                        </p>
                                    </div>
                                    <div class="col-span-1">
                                        <div class="flex justify-center">
                                            <input class="display-block parte_social" type="radio" name="aceptacion_invitacion" value='1' {{$obj_obra->get('contrato')->aceptacion_invitacion == 1? 'checked': ''}} >
                                        </div>
                                        <p  class="text-sm font-medium text-gray-700 text-center"> Si</p>
                                    </div>
                                    <div class="col-span-1">
                                        <div class="flex justify-center">
                                            <input class="display-block parte_social" type="radio" name="aceptacion_invitacion" value='2' {{$obj_obra->get('contrato')->aceptacion_invitacion != 1? 'checked': ''}} >
                                        </div>
                                        <p  class="text-sm font-medium text-gray-700 text-center"> No</p>
                                    </div>
                                    <div class="col-span-1">
                                        <div class="flex justify-center">
                                            <input class="display-block parte_social" type="radio" name="aceptacion_invitacion" value='3' {{$obj_obra->get('contrato')->aceptacion_invitacion == 3? 'checked': ''}} >
                                        </div>
                                        <p  class="text-sm font-medium text-gray-700 text-center"> N/A</p>
                                    </div>
                                </div>
                            </div>


                            @if ($obj_obra->get('contrato')->modalidad_asignacion != 3)

                                <div class="border sm:col-span-4">
                                    <div class="grid grid-cols-8 h-full flex items-center p-2">
                                        <div class="col-span-5 ">
                                            <p class="dos-lineas line-height-1">
                                                Bases de licitacion (con anexos).
                                            </p>
                                        </div>
                                        <div class="col-span-1">
                                            <div class="flex justify-center">
                                                <input class="display-block parte_social" type="radio" name="bases_licitacion" value='1' {{$obj_obra->get('licitacion')->bases_licitacion == 1? 'checked': ''}} >
                                            </div>
                                            <p  class="text-sm font-medium text-gray-700 text-center"> Si</p>
                                        </div>
                                        <div class="col-span-1">
                                            <div class="flex justify-center">
                                                <input class="display-block parte_social" type="radio" name="bases_licitacion" value='2' {{$obj_obra->get('licitacion')->bases_licitacion != 1? 'checked': ''}} >
                                            </div>
                                            <p  class="text-sm font-medium text-gray-700 text-center"> No</p>
                                        </div>
                                        <div class="col-span-1">
                                            <div class="flex justify-center">
                                                <input class="display-block parte_social" type="radio" name="babas_licitacion" value='3' {{$obj_obra->get('licitacion')->bases_licitacion == 3? 'checked': ''}} >
                                            </div>
                                            <p  class="text-sm font-medium text-gray-700 text-center"> N/A</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="border sm:col-span-4">
                                    <div class="grid grid-cols-8 h-full flex items-center p-2">
                                        <div class="col-span-5 ">
                                            <p class="dos-lineas line-height-1">
                                                Constancia de visita o de conocer el sitio donde se ejecutará la obra.
                                            </p>
                                        </div>
                                        <div class="col-span-1">
                                            <div class="flex justify-center">
                                                <input class="display-block parte_social" type="radio" name="constancia_visita" value='1' {{$obj_obra->get('licitacion')->constancia_visita == 1? 'checked': ''}} >
                                            </div>
                                            <p  class="text-sm font-medium text-gray-700 text-center"> Si</p>
                                        </div>
                                        <div class="col-span-1">
                                            <div class="flex justify-center">
                                                <input class="display-block parte_social" type="radio" name="constancia_visita" value='2' {{$obj_obra->get('licitacion')->constancia_visita != 1? 'checked': ''}} >
                                            </div>
                                            <p  class="text-sm font-medium text-gray-700 text-center"> No</p>
                                        </div>
                                        <div class="col-span-1">
                                            <div class="flex justify-center">
                                                <input class="display-block parte_social" type="radio" name="constancia_visita" value='3' {{$obj_obra->get('licitacion')->constancia_visita == 3? 'checked': ''}} >
                                            </div>
                                            <p  class="text-sm font-medium text-gray-700 text-center"> N/A</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="border sm:col-span-4">
                                    <div class="grid grid-cols-8 h-full flex items-center p-2">
                                        <div class="col-span-5 ">
                                            <p class="dos-lineas line-height-1">
                                                Acta de la junta de aclaraciones.
                                            </p>
                                        </div>
                                        <div class="col-span-1">
                                            <div class="flex justify-center">
                                                <input class="display-block parte_social" type="radio" name="acta_junta_aclaraciones" value='1' {{$obj_obra->get('licitacion')->acta_junta_aclaraciones == 1? 'checked': ''}} >
                                            </div>
                                            <p  class="text-sm font-medium text-gray-700 text-center"> Si</p>
                                        </div>
                                        <div class="col-span-1">
                                            <div class="flex justify-center">
                                                <input class="display-block parte_social" type="radio" name="acta_junta_aclaraciones" value='2' {{$obj_obra->get('licitacion')->acta_junta_aclaraciones != 1? 'checked': ''}} >
                                            </div>
                                            <p  class="text-sm font-medium text-gray-700 text-center"> No</p>
                                        </div>
                                        <div class="col-span-1">
                                            <div class="flex justify-center">
                                                <input class="display-block parte_social" type="radio" name="acta_junta_aclaraciones" value='3' {{$obj_obra->get('licitacion')->acta_junta_aclaraciones == 3? 'checked': ''}} >
                                            </div>
                                            <p  class="text-sm font-medium text-gray-700 text-center"> N/A</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="border sm:col-span-4">
                                    <div class="grid grid-cols-8 h-full flex items-center p-2">
                                        <div class="col-span-5 ">
                                            <p class="dos-lineas line-height-1">
                                                Acta de apertura técnica.
                                            </p>
                                        </div>
                                        <div class="col-span-1">
                                            <div class="flex justify-center">
                                                <input class="display-block parte_social" type="radio" name="acta_apertura_tecnica" value='1' {{$obj_obra->get('licitacion')->acta_apertura_tecnica == 1? 'checked': ''}} >
                                            </div>
                                            <p  class="text-sm font-medium text-gray-700 text-center"> Si</p>
                                        </div>
                                        <div class="col-span-1">
                                            <div class="flex justify-center">
                                                <input class="display-block parte_social" type="radio" name="acta_apertura_tecnica" value='2' {{$obj_obra->get('licitacion')->acta_apertura_tecnica != 1? 'checked': ''}} >
                                            </div>
                                            <p  class="text-sm font-medium text-gray-700 text-center"> No</p>
                                        </div>
                                        <div class="col-span-1">
                                            <div class="flex justify-center">
                                                <input class="display-block parte_social" type="radio" name="acta_apertura_tecnica" value='3' {{$obj_obra->get('licitacion')->acta_apertura_tecnica == 3? 'checked': ''}} >
                                            </div>
                                            <p  class="text-sm font-medium text-gray-700 text-center"> N/A</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="border sm:col-span-4">
                                    <div class="grid grid-cols-8 h-full flex items-center p-2">
                                        <div class="col-span-5 ">
                                            <p class="dos-lineas line-height-1">
                                                Dictamen técnico y análisis detallado.
                                            </p>
                                        </div>
                                        <div class="col-span-1">
                                            <div class="flex justify-center">
                                                <input class="display-block parte_social" type="radio" name="dictamen_tecnico" value='1' {{$obj_obra->get('licitacion')->dictamen_tecnico == 1? 'checked': ''}} >
                                            </div>
                                            <p  class="text-sm font-medium text-gray-700 text-center"> Si</p>
                                        </div>
                                        <div class="col-span-1">
                                            <div class="flex justify-center">
                                                <input class="display-block parte_social" type="radio" name="dictamen_tecnico" value='2' {{$obj_obra->get('licitacion')->dictamen_tecnico != 1? 'checked': ''}} >
                                            </div>
                                            <p  class="text-sm font-medium text-gray-700 text-center"> No</p>
                                        </div>
                                        <div class="col-span-1">
                                            <div class="flex justify-center">
                                                <input class="display-block parte_social" type="radio" name="dictamen_tecnico" value='3' {{$obj_obra->get('licitacion')->dictamen_tecnico == 3? 'checked': ''}} >
                                            </div>
                                            <p  class="text-sm font-medium text-gray-700 text-center"> N/A</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="border sm:col-span-4">
                                    <div class="grid grid-cols-8 h-full flex items-center p-2">
                                        <div class="col-span-5 ">
                                            <p class="dos-lineas line-height-1">
                                                Acta de apertura económica.
                                            </p>
                                        </div>
                                        <div class="col-span-1">
                                            <div class="flex justify-center">
                                                <input class="display-block parte_social" type="radio" name="acta_apertura_economica" value='1' {{$obj_obra->get('licitacion')->acta_apertura_economica == 1? 'checked': ''}} >
                                            </div>
                                            <p  class="text-sm font-medium text-gray-700 text-center"> Si</p>
                                        </div>
                                        <div class="col-span-1">
                                            <div class="flex justify-center">
                                                <input class="display-block parte_social" type="radio" name="acta_apertura_economica" value='2' {{$obj_obra->get('licitacion')->acta_apertura_economica != 1? 'checked': ''}} >
                                            </div>
                                            <p  class="text-sm font-medium text-gray-700 text-center"> No</p>
                                        </div>
                                        <div class="col-span-1">
                                            <div class="flex justify-center">
                                                <input class="display-block parte_social" type="radio" name="acta_apertura_economica" value='3' {{$obj_obra->get('licitacion')->acta_apertura_economica == 3? 'checked': ''}} >
                                            </div>
                                            <p  class="text-sm font-medium text-gray-700 text-center"> N/A</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="border sm:col-span-4">
                                    <div class="grid grid-cols-8 h-full flex items-center p-2">
                                        <div class="col-span-5 ">
                                            <p class="dos-lineas line-height-1">
                                                Dictamen económico y análisis detallado
                                            </p>
                                        </div>
                                        <div class="col-span-1">
                                            <div class="flex justify-center">
                                                <input class="display-block parte_social" type="radio" name="dictamen_economico" value='1' {{$obj_obra->get('licitacion')->dictamen_economico == 1? 'checked': ''}} >
                                            </div>
                                            <p  class="text-sm font-medium text-gray-700 text-center"> Si</p>
                                        </div>
                                        <div class="col-span-1">
                                            <div class="flex justify-center">
                                                <input class="display-block parte_social" type="radio" name="dictamen_economico" value='2' {{$obj_obra->get('licitacion')->dictamen_economico != 1? 'checked': ''}} >
                                            </div>
                                            <p  class="text-sm font-medium text-gray-700 text-center"> No</p>
                                        </div>
                                        <div class="col-span-1">
                                            <div class="flex justify-center">
                                                <input class="display-block parte_social" type="radio" name="dictamen_economico" value='3' {{$obj_obra->get('licitacion')->dictamen_economico == 3? 'checked': ''}} >
                                            </div>
                                            <p  class="text-sm font-medium text-gray-700 text-center"> N/A</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="border sm:col-span-4">
                                    <div class="grid grid-cols-8 h-full flex items-center p-2">
                                        <div class="col-span-5 ">
                                            <p class="dos-lineas line-height-1">
                                                Dictamen
                                            </p>
                                        </div>
                                        <div class="col-span-1">
                                            <div class="flex justify-center">
                                                <input class="display-block parte_social" type="radio" name="dictamen" value='1' {{$obj_obra->get('licitacion')->dictamen == 1? 'checked': ''}} >
                                            </div>
                                            <p  class="text-sm font-medium text-gray-700 text-center"> Si</p>
                                        </div>
                                        <div class="col-span-1">
                                            <div class="flex justify-center">
                                                <input class="display-block parte_social" type="radio" name="dictamen" value='2' {{$obj_obra->get('licitacion')->dictamen != 1? 'checked': ''}} >
                                            </div>
                                            <p  class="text-sm font-medium text-gray-700 text-center"> No</p>
                                        </div>
                                        <div class="col-span-1">
                                            <div class="flex justify-center">
                                                <input class="display-block parte_social" type="radio" name="dictamen" value='3' {{$obj_obra->get('licitacion')->dictamen == 3? 'checked': ''}} >
                                            </div>
                                            <p  class="text-sm font-medium text-gray-700 text-center"> N/A</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="border sm:col-span-4">
                                    <div class="grid grid-cols-8 h-full flex items-center p-2">
                                        <div class="col-span-5 ">
                                            <p class="dos-lineas line-height-1">
                                                Acta de fallo
                                            </p>
                                        </div>
                                        <div class="col-span-1">
                                            <div class="flex justify-center">
                                                <input class="display-block parte_social" type="radio" name="acta_fallo" value='1' {{$obj_obra->get('licitacion')->acta_fallo == 1? 'checked': ''}} >
                                            </div>
                                            <p  class="text-sm font-medium text-gray-700 text-center"> Si</p>
                                        </div>
                                        <div class="col-span-1">
                                            <div class="flex justify-center">
                                                <input class="display-block parte_social" type="radio" name="acta_fallo" value='2' {{$obj_obra->get('licitacion')->acta_fallo != 1? 'checked': ''}} >
                                            </div>
                                            <p  class="text-sm font-medium text-gray-700 text-center"> No</p>
                                        </div>
                                        <div class="col-span-1">
                                            <div class="flex justify-center">
                                                <input class="display-block parte_social" type="radio" name="acta_fallo" value='3' {{$obj_obra->get('licitacion')->acta_fallo == 3? 'checked': ''}} >
                                            </div>
                                            <p  class="text-sm font-medium text-gray-700 text-center"> N/A</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="border sm:col-span-4">
                                    <div class="grid grid-cols-8 h-full flex items-center p-2">
                                        <div class="col-span-5 ">
                                            <p class="dos-lineas line-height-1">
                                                Propuesta económica de los licitantes.
                                            </p>
                                        </div>
                                        <div class="col-span-1">
                                            <div class="flex justify-center">
                                                <input class="display-block parte_social" type="radio" name="propuesta_licitantes_economica" value='1' {{$obj_obra->get('licitacion')->propuesta_licitantes_economica == 1? 'checked': ''}} >
                                            </div>
                                            <p  class="text-sm font-medium text-gray-700 text-center"> Si</p>
                                        </div>
                                        <div class="col-span-1">
                                            <div class="flex justify-center">
                                                <input class="display-block parte_social" type="radio" name="propuesta_licitantes_economica" value='2' {{$obj_obra->get('licitacion')->propuesta_licitantes_economica != 1? 'checked': ''}} >
                                            </div>
                                            <p  class="text-sm font-medium text-gray-700 text-center"> No</p>
                                        </div>
                                        <div class="col-span-1">
                                            <div class="flex justify-center">
                                                <input class="display-block parte_social" type="radio" name="propuesta_licitantes_economica" value='3' {{$obj_obra->get('licitacion')->propuesta_licitantes_economica == 3? 'checked': ''}} >
                                            </div>
                                            <p  class="text-sm font-medium text-gray-700 text-center"> N/A</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="border sm:col-span-4">
                                    <div class="grid grid-cols-8 h-full flex items-center p-2">
                                        <div class="col-span-5 ">
                                            <p class="dos-lineas line-height-1">
                                                Propuesta técnica de los licitantes.
                                            </p>
                                        </div>
                                        <div class="col-span-1">
                                            <div class="flex justify-center">
                                                <input class="display-block parte_social" type="radio" name="propuesta_licitantes_tecnica" value='1' {{$obj_obra->get('licitacion')->propuesta_licitantes_tecnica == 1? 'checked': ''}} >
                                            </div>
                                            <p  class="text-sm font-medium text-gray-700 text-center"> Si</p>
                                        </div>
                                        <div class="col-span-1">
                                            <div class="flex justify-center">
                                                <input class="display-block parte_social" type="radio" name="propuesta_licitantes_tecnica" value='2' {{$obj_obra->get('licitacion')->propuesta_licitantes_tecnica != 1? 'checked': ''}} >
                                            </div>
                                            <p  class="text-sm font-medium text-gray-700 text-center"> No</p>
                                        </div>
                                        <div class="col-span-1">
                                            <div class="flex justify-center">
                                                <input class="display-block parte_social" type="radio" name="propuesta_licitantes_tecnica" value='3' {{$obj_obra->get('licitacion')->propuesta_licitantes_tecnica == 3? 'checked': ''}} >
                                            </div>
                                            <p  class="text-sm font-medium text-gray-700 text-center"> N/A</p>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <div class="border sm:col-span-4">
                                <div class="grid grid-cols-8 h-full flex items-center p-2">
                                    <div class="col-span-5 ">
                                        <p class="dos-lineas line-height-1">
                                            Contrato                                                         
                                                @if ($obj_obra->get('contrato')->contrato_tipo == 1) <span class="font-bold">(Precios unitarios)</span> @endif
                                                @if ($obj_obra->get('contrato')->contrato_tipo == 2) (Precios Alzados) @endif.
                                        </p>
                                    </div>
                                    <div class="col-span-1">
                                        <div class="flex justify-center">
                                            <input class="display-block parte_social" type="radio" name="contrato" value='1' {{$obj_obra->get('contrato')->contrato == 1? 'checked': ''}} >
                                        </div>
                                        <p  class="text-sm font-medium text-gray-700 text-center"> Si</p>
                                    </div>
                                    <div class="col-span-1">
                                        <div class="flex justify-center">
                                            <input class="display-block parte_social" type="radio" name="contrato" value='2' {{$obj_obra->get('contrato')->contrato != 1? 'checked': ''}} >
                                        </div>
                                        <p  class="text-sm font-medium text-gray-700 text-center"> No</p>
                                    </div>
                                    <div class="col-span-1">
                                        <div class="flex justify-center">
                                            <input class="display-block parte_social" type="radio" name="contrato" value='3' {{$obj_obra->get('contrato')->contrato == 3? 'checked': ''}} >
                                        </div>
                                        <p  class="text-sm font-medium text-gray-700 text-center"> N/A</p>
                                    </div>
                                </div>
                            </div>

                            <div class="border sm:col-span-4">
                                <div class="grid grid-cols-8 h-full flex items-center p-2">
                                    <div class="col-span-5 ">
                                        <p class="dos-lineas line-height-1">
                                            Oficio justificatorio para convenio modificatorio.
                                        </p>
                                    </div>
                                    <div class="col-span-1">
                                        <div class="flex justify-center">
                                            <input class="display-block parte_social" type="radio" name="oficio_justificativo_convenio_modificatorio" value='1' {{$obj_obra->get('contrato')->oficio_justificativo_convenio_modificatorio == 1? 'checked': ''}} >
                                        </div>
                                        <p  class="text-sm font-medium text-gray-700 text-center"> Si</p>
                                    </div>
                                    <div class="col-span-1">
                                        <div class="flex justify-center">
                                            <input class="display-block parte_social" type="radio" name="oficio_justificativo_convenio_modificatorio" value='2' {{$obj_obra->get('contrato')->oficio_justificativo_convenio_modificatorio != 1? 'checked': ''}} >
                                        </div>
                                        <p  class="text-sm font-medium text-gray-700 text-center"> No</p>
                                    </div>
                                    <div class="col-span-1">
                                        <div class="flex justify-center">
                                            <input class="display-block parte_social" type="radio" name="oficio_justificativo_convenio_modificatorio" value='3' {{$obj_obra->get('contrato')->oficio_justificativo_convenio_modificatorio == 3? 'checked': ''}} >
                                        </div>
                                        <p  class="text-sm font-medium text-gray-700 text-center"> N/A</p>
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
                                        <input type="text" name="numero_convenios" class="hidden" value="{{ count($convenios) }}">
                                        @foreach ($convenios as $key => $convenio)
                                            <div class="border sm:col-span-4">
                                                <div class="grid grid-cols-8 h-full flex items-center p-2">
                                                    <div class="col-span-5 ">
                                                        <input type="text" name="convenio_id_{{$key + 1}}" class="hidden" value="{{ $convenio->id_convenio_modificatorio }}">
                                                        <p class="dos-lineas line-height-1">
                                                            {{$convenio->tipo}}
                                                        </p>
                                                    </div>
                                                    <div class="col-span-1">
                                                        <div class="flex justify-center">
                                                            <input class="display-block parte_social" type="radio" name="convenio_{{$key + 1}}" value='1' {{$convenio->agregado_expediente == 1? 'checked': ''}} >
                                                        </div>
                                                        <p  class="text-sm font-medium text-gray-700 text-center"> Si</p>
                                                    </div>
                                                    <div class="col-span-1">
                                                        <div class="flex justify-center">
                                                            <input class="display-block parte_social" type="radio" name="convenio_{{$key + 1}}" value='2' {{$convenio->agregado_expediente != 1? 'checked': ''}} >
                                                        </div>
                                                        <p  class="text-sm font-medium text-gray-700 text-center"> No</p>
                                                    </div>
                                                    <div class="col-span-1">
                                                        <div class="flex justify-center">
                                                            <input class="display-block parte_social" type="radio" name="convenio_{{$key + 1}}" value='3' {{$convenio->agregado_expediente == 3? 'checked': ''}} >
                                                        </div>
                                                        <p  class="text-sm font-medium text-gray-700 text-center"> N/A</p>
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

                                    <div class="border sm:col-span-4">
                                        <div class="grid grid-cols-8 h-full flex items-center p-2">
                                            <div class="col-span-5 ">
                                                <p class="dos-lineas line-height-1">
                                                    Catálogo de conceptos.
                                                </p>
                                            </div>
                                            <div class="col-span-1">
                                                <div class="flex justify-center">
                                                    <input class="display-block parte_social" type="radio" name="catalogo_conceptos" value='1' {{$obj_obra->get('contrato')->catalogo_conceptos == 1? 'checked': ''}} >
                                                </div>
                                                <p  class="text-sm font-medium text-gray-700 text-center"> Si</p>
                                            </div>
                                            <div class="col-span-1">
                                                <div class="flex justify-center">
                                                    <input class="display-block parte_social" type="radio" name="catalogo_conceptos" value='2' {{$obj_obra->get('contrato')->catalogo_conceptos != 1? 'checked': ''}} >
                                                </div>
                                                <p  class="text-sm font-medium text-gray-700 text-center"> No</p>
                                            </div>
                                            <div class="col-span-1">
                                                <div class="flex justify-center">
                                                    <input class="display-block parte_social" type="radio" name="catalogo_conceptos" value='3' {{$obj_obra->get('contrato')->catalogo_conceptos == 3? 'checked': ''}} >
                                                </div>
                                                <p  class="text-sm font-medium text-gray-700 text-center"> N/A</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="border sm:col-span-4">
                                        <div class="grid grid-cols-8 h-full flex items-center p-2">
                                            <div class="col-span-5 ">
                                                <p class="dos-lineas line-height-1">
                                                    Análisis de precios unitarios.
                                                </p>
                                            </div>
                                            <div class="col-span-1">
                                                <div class="flex justify-center">
                                                    <input class="display-block parte_social" type="radio" name="analisis_p_u" value='1' {{$obj_obra->get('contrato')->analisis_p_u == 1? 'checked': ''}} >
                                                </div>
                                                <p  class="text-sm font-medium text-gray-700 text-center"> Si</p>
                                            </div>
                                            <div class="col-span-1">
                                                <div class="flex justify-center">
                                                    <input class="display-block parte_social" type="radio" name="analisis_p_u" value='2' {{$obj_obra->get('contrato')->analisis_p_u != 1? 'checked': ''}} >
                                                </div>
                                                <p  class="text-sm font-medium text-gray-700 text-center"> No</p>
                                            </div>
                                            <div class="col-span-1">
                                                <div class="flex justify-center">
                                                    <input class="display-block parte_social" type="radio" name="analisis_p_u" value='3' {{$obj_obra->get('contrato')->analisis_p_u == 3? 'checked': ''}} >
                                                </div>
                                                <p  class="text-sm font-medium text-gray-700 text-center"> N/A</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="border sm:col-span-4">
                                        <div class="grid grid-cols-8 h-full flex items-center p-2">
                                            <div class="col-span-5 ">
                                                <p class="dos-lineas line-height-1">
                                                    Calendario de la ejecución de los trabajos.
                                                </p>
                                            </div>
                                            <div class="col-span-1">
                                                <div class="flex justify-center">
                                                    <input class="display-block parte_social" type="radio" name="montos_mensuales_ejecutados" value='1' {{$obj_obra->get('contrato')->montos_mensuales_ejecutados == 1? 'checked': ''}} >
                                                </div>
                                                <p  class="text-sm font-medium text-gray-700 text-center"> Si</p>
                                            </div>
                                            <div class="col-span-1">
                                                <div class="flex justify-center">
                                                    <input class="display-block parte_social" type="radio" name="montos_mensuales_ejecutados" value='2' {{$obj_obra->get('contrato')->montos_mensuales_ejecutados != 1? 'checked': ''}} >
                                                </div>
                                                <p  class="text-sm font-medium text-gray-700 text-center"> No</p>
                                            </div>
                                            <div class="col-span-1">
                                                <div class="flex justify-center">
                                                    <input class="display-block parte_social" type="radio" name="montos_mensuales_ejecutados" value='3' {{$obj_obra->get('contrato')->montos_mensuales_ejecutados == 3? 'checked': ''}} >
                                                </div>
                                                <p  class="text-sm font-medium text-gray-700 text-center"> N/A</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                                                    
                            
                        </div>
                    </div>
                @endif

                <div id="actas_parte_social" style="display: none;">
                    <div class=" bg-gray-100 mt-5">
                        <h2 class="font-bold text-lg text-center">Parte técnica</h2>
                    </div>
                    <div>
                        <h2 class="font-semibold text-lg text-center">Documentación comprobatoria</h2>
                        <hr>
                    </div>
                    <div class="grid grid-cols-8 gap-x-4 gap-y-2 mt-10">
                        @if ($obj_obra->get('obra')->modalidad_ejecucion == 2)
                            <div class="border sm:col-span-4">
                                <div class="grid grid-cols-8 h-full flex items-center p-2">
                                    <div class="col-span-5 ">
                                        <p class="dos-lineas line-height-1">
                                            Asignacion mediante oficio del Superintendente de obra.
                                        </p>
                                    </div>
                                    <div class="col-span-1">
                                        <div class="flex justify-center">
                                            <input class="display-block parte_social" type="radio" name="oficio_superintendente" value='1' {{$obj_obra->get('contrato')->oficio_superintendente == 1? 'checked': ''}} >
                                        </div>
                                        <p  class="text-sm font-medium text-gray-700 text-center"> Si</p>
                                    </div>
                                    <div class="col-span-1">
                                        <div class="flex justify-center">
                                            <input class="display-block parte_social" type="radio" name="oficio_superintendente" value='2' {{$obj_obra->get('contrato')->oficio_superintendente != 1? 'checked': ''}} >
                                        </div>
                                        <p  class="text-sm font-medium text-gray-700 text-center"> No</p>
                                    </div>
                                    <div class="col-span-1">
                                        <div class="flex justify-center">
                                            <input class="display-block parte_social" type="radio" name="oficio_superintendente" value='3' {{$obj_obra->get('contrato')->oficio_superintendente == 3? 'checked': ''}} >
                                        </div>
                                        <p  class="text-sm font-medium text-gray-700 text-center"> N/A</p>
                                    </div>
                                </div>
                            </div>

                            <div class="border sm:col-span-4">
                                <div class="grid grid-cols-8 h-full flex items-center p-2">
                                    <div class="col-span-5 ">
                                        <p class="dos-lineas line-height-1">
                                            Asignacion mediante oficio del residente de obra.
                                        </p>
                                    </div>
                                    <div class="col-span-1">
                                        <div class="flex justify-center">
                                            <input class="display-block parte_social" type="radio" name="oficio_residente_obra" value='1' {{$obj_obra->get('contrato')->oficio_residente_obra == 1? 'checked': ''}} >
                                        </div>
                                        <p  class="text-sm font-medium text-gray-700 text-center"> Si</p>
                                    </div>
                                    <div class="col-span-1">
                                        <div class="flex justify-center">
                                            <input class="display-block parte_social" type="radio" name="oficio_residente_obra" value='2' {{$obj_obra->get('contrato')->oficio_residente_obra != 1? 'checked': ''}} >
                                        </div>
                                        <p  class="text-sm font-medium text-gray-700 text-center"> No</p>
                                    </div>
                                    <div class="col-span-1">
                                        <div class="flex justify-center">
                                            <input class="display-block parte_social" type="radio" name="oficio_residente_obra" value='3' {{$obj_obra->get('contrato')->oficio_residente_obra == 3? 'checked': ''}} >
                                        </div>
                                        <p  class="text-sm font-medium text-gray-700 text-center"> N/A</p>
                                    </div>
                                </div>
                            </div>

                            <div class="border sm:col-span-4">
                                <div class="grid grid-cols-8 h-full flex items-center p-2">
                                    <div class="col-span-5 ">
                                        <p class="dos-lineas line-height-1">
                                            Oficio emitido por la ejecutora dirigido al contratista por la disposición del inmueble.
                                        </p>
                                    </div>
                                    <div class="col-span-1">
                                        <div class="flex justify-center">
                                            <input class="display-block parte_social" type="radio" name="oficio_disposicion_inmueble" value='1' {{$obj_obra->get('contrato')->oficio_disposicion_inmueble == 1? 'checked': ''}} >
                                        </div>
                                        <p  class="text-sm font-medium text-gray-700 text-center"> Si</p>
                                    </div>
                                    <div class="col-span-1">
                                        <div class="flex justify-center">
                                            <input class="display-block parte_social" type="radio" name="oficio_disposicion_inmueble" value='2' {{$obj_obra->get('contrato')->oficio_disposicion_inmueble != 1? 'checked': ''}} >
                                        </div>
                                        <p  class="text-sm font-medium text-gray-700 text-center"> No</p>
                                    </div>
                                    <div class="col-span-1">
                                        <div class="flex justify-center">
                                            <input class="display-block parte_social" type="radio" name="oficio_disposicion_inmueble" value='3' {{$obj_obra->get('contrato')->oficio_disposicion_inmueble == 3? 'checked': ''}} >
                                        </div>
                                        <p  class="text-sm font-medium text-gray-700 text-center"> N/A</p>
                                    </div>
                                </div>
                            </div>

                            <div class="border sm:col-span-4">
                                <div class="grid grid-cols-8 h-full flex items-center p-2">
                                    <div class="col-span-5 ">
                                        <p class="dos-lineas line-height-1">
                                            Notificacion de inicio de obra.
                                        </p>
                                    </div>
                                    <div class="col-span-1">
                                        <div class="flex justify-center">
                                            <input class="display-block parte_social" type="radio" name="oficio_inicio_obra" value='1' {{$obj_obra->get('contrato')->oficio_inicio_obra == 1? 'checked': ''}} >
                                        </div>
                                        <p  class="text-sm font-medium text-gray-700 text-center"> Si</p>
                                    </div>
                                    <div class="col-span-1">
                                        <div class="flex justify-center">
                                            <input class="display-block parte_social" type="radio" name="oficio_inicio_obra" value='2' {{$obj_obra->get('contrato')->oficio_inicio_obra != 1? 'checked': ''}} >
                                        </div>
                                        <p  class="text-sm font-medium text-gray-700 text-center"> No</p>
                                    </div>
                                    <div class="col-span-1">
                                        <div class="flex justify-center">
                                            <input class="display-block parte_social" type="radio" name="oficio_inicio_obra" value='3' {{$obj_obra->get('contrato')->oficio_inicio_obra == 3? 'checked': ''}} >
                                        </div>
                                        <p  class="text-sm font-medium text-gray-700 text-center"> N/A</p>
                                    </div>
                                </div>
                            </div>

                            <div class="border sm:col-span-4">
                                <div class="grid grid-cols-8 gap-y-4 h-full flex items-center p-2">
                                    <div class="col-span-5 ">
                                        <p class="dos-lineas line-height-1">
                                            Factura de anticipo
                                            <br>
                                            Importe: <span class="font-bold">{{ $service->formatNumber($obj_obra->get('obra')->anticipo_porcentaje * 0.01 * $obj_obra->get('obra')->monto_contratado) }}</span>
                                        </p>
                                    </div>
                                    <div class="col-span-1">
                                        <div class="flex justify-center">
                                            <input class="display-block parte_social" type="radio" name="exp_factura_anticipo" value='1' {{$obj_obra->get('contrato')->exp_factura_anticipo == 1? 'checked': ''}} >
                                        </div>
                                        <p  class="text-sm font-medium text-gray-700 text-center"> Si</p>
                                    </div>
                                    <div class="col-span-1">
                                        <div class="flex justify-center">
                                            <input class="display-block parte_social" type="radio" name="exp_factura_anticipo" value='2' {{$obj_obra->get('contrato')->exp_factura_anticipo != 1? 'checked': ''}} >
                                        </div>
                                        <p  class="text-sm font-medium text-gray-700 text-center"> No</p>
                                    </div>
                                    <div class="col-span-1">
                                        <div class="flex justify-center">
                                            <input class="display-block parte_social" type="radio" name="exp_factura_anticipo" value='3' {{$obj_obra->get('contrato')->exp_factura_anticipo == 3? 'checked': ''}} >
                                        </div>
                                        <p  class="text-sm font-medium text-gray-700 text-center"> N/A</p>
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
                                        <input type="text" name="numero_estimaciones" class="hidden" value="{{ count($estimaciones) }}">
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

                                                                    <div class="border sm:col-span-8">
                                                                        <div class="grid grid-cols-8 h-full flex items-center p-2">
                                                                            <div class="col-span-5 ">
                                                                                <input type="text" name="estimacion_id_{{$key + 1}}" class="hidden" value="{{ $estimacion->id_estimacion }}">
                                                                                <p class="dos-lineas line-height-1">
                                                                                    Factura de la estimación.
                                                                                </p>
                                                                            </div>
                                                                            <div class="col-span-1">
                                                                                <div class="flex justify-center">
                                                                                    <input class="display-block  parte_social" type="radio" name='factura_estimacion_{{$key + 1}}' value='1' {{$estimacion->factura_estimacion == 1? 'checked': ''}} >
                                                                                </div>
                                                                                <p  class="text-sm font-medium text-gray-700 text-center"> Si</p>
                                                                            </div>
                                                                            <div class="col-span-1">
                                                                                <div class="flex justify-center">
                                                                                    <input class="display-block parte_social" type="radio" name='factura_estimacion_{{$key + 1}}' value='2' {{$estimacion->factura_estimacion != 1? 'checked': ''}} >
                                                                                </div>
                                                                                <p  class="text-sm font-medium text-gray-700 text-center"> No</p>
                                                                            </div>
                                                                            <div class="col-span-1">
                                                                                <div class="flex justify-center">
                                                                                    <input class="display-block parte_social" type="radio" name='factura_estimacion_{{$key + 1}}' value='3' {{$estimacion->factura_estimacion == 3? 'checked': ''}} >
                                                                                </div>
                                                                                <p  class="text-sm font-medium text-gray-700 text-center"> N/A</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="border sm:col-span-8">
                                                                        <div class="grid grid-cols-8 h-full flex items-center p-2">
                                                                            <div class="col-span-5 ">
                                                                                <p class="dos-lineas line-height-1">
                                                                                    Presupuesto de la estimación.
                                                                                </p>
                                                                            </div>
                                                                            <div class="col-span-1">
                                                                                <div class="flex justify-center">
                                                                                    <input class="display-block parte_social" type="radio" name='presupuesto_estimacion_{{$key + 1}}' value='1' {{$estimacion->presupuesto_estimacion == 1? 'checked': ''}} >
                                                                                </div>
                                                                                <p  class="text-sm font-medium text-gray-700 text-center"> Si</p>
                                                                            </div>
                                                                            <div class="col-span-1">
                                                                                <div class="flex justify-center">
                                                                                    <input class="display-block parte_social" type="radio" name='presupuesto_estimacion_{{$key + 1}}' value='2' {{$estimacion->presupuesto_estimacion != 1? 'checked': ''}} >
                                                                                </div>
                                                                                <p  class="text-sm font-medium text-gray-700 text-center"> No</p>
                                                                            </div>
                                                                            <div class="col-span-1">
                                                                                <div class="flex justify-center">
                                                                                    <input class="display-block parte_social" type="radio" name='presupuesto_estimacion_{{$key + 1}}' value='3' {{$estimacion->presupuesto_estimacion == 3? 'checked': ''}} >
                                                                                </div>
                                                                                <p  class="text-sm font-medium text-gray-700 text-center"> N/A</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="border sm:col-span-8">
                                                                        <div class="grid grid-cols-8 h-full flex items-center p-2">
                                                                            <div class="col-span-5 ">
                                                                                <p class="dos-lineas line-height-1">
                                                                                    Carátula de estimación.
                                                                                </p>
                                                                            </div>
                                                                            <div class="col-span-1">
                                                                                <div class="flex justify-center">
                                                                                    <input class="display-block parte_social" type="radio" name='caratula_estimacion_{{$key + 1}}' value='1' {{$estimacion->caratula_estimacion == 1? 'checked': ''}} >
                                                                                </div>
                                                                                <p  class="text-sm font-medium text-gray-700 text-center"> Si</p>
                                                                            </div>
                                                                            <div class="col-span-1">
                                                                                <div class="flex justify-center">
                                                                                    <input class="display-block parte_social" type="radio" name='caratula_estimacion_{{$key + 1}}' value='2' {{$estimacion->caratula_estimacion != 1? 'checked': ''}} >
                                                                                </div>
                                                                                <p  class="text-sm font-medium text-gray-700 text-center"> No</p>
                                                                            </div>
                                                                            <div class="col-span-1">
                                                                                <div class="flex justify-center">
                                                                                    <input class="display-block parte_social" type="radio" name='caratula_estimacion_{{$key + 1}}' value='3' {{$estimacion->caratula_estimacion == 3? 'checked': ''}} >
                                                                                </div>
                                                                                <p  class="text-sm font-medium text-gray-700 text-center"> N/A</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="border sm:col-span-8">
                                                                        <div class="grid grid-cols-8 h-full flex items-center p-2">
                                                                            <div class="col-span-5 ">
                                                                                <p class="dos-lineas line-height-1">
                                                                                    Cuerpo de estimación.
                                                                                </p>
                                                                            </div>
                                                                            <div class="col-span-1">
                                                                                <div class="flex justify-center">
                                                                                    <input class="display-block parte_social" type="radio" name='cuerpo_estimacion_{{$key + 1}}' value='1' {{$estimacion->cuerpo_estimacion == 1? 'checked': ''}} >
                                                                                </div>
                                                                                <p  class="text-sm font-medium text-gray-700 text-center"> Si</p>
                                                                            </div>
                                                                            <div class="col-span-1">
                                                                                <div class="flex justify-center">
                                                                                    <input class="display-block parte_social" type="radio" name='cuerpo_estimacion_{{$key + 1}}' value='2' {{$estimacion->cuerpo_estimacion != 1? 'checked': ''}} >
                                                                                </div>
                                                                                <p  class="text-sm font-medium text-gray-700 text-center"> No</p>
                                                                            </div>
                                                                            <div class="col-span-1">
                                                                                <div class="flex justify-center">
                                                                                    <input class="display-block parte_social" type="radio" name='cuerpo_estimacion_{{$key + 1}}' value='3' {{$estimacion->cuerpo_estimacion == 3? 'checked': ''}} >
                                                                                </div>
                                                                                <p  class="text-sm font-medium text-gray-700 text-center"> N/A</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="border sm:col-span-8">
                                                                        <div class="grid grid-cols-8 h-full flex items-center p-2">
                                                                            <div class="col-span-5 ">
                                                                                <p class="dos-lineas line-height-1">
                                                                                    Resumen de estimación.
                                                                                </p>
                                                                            </div>
                                                                            <div class="col-span-1">
                                                                                <div class="flex justify-center">
                                                                                    <input class="display-block parte_social" type="radio" name='resumen_estimacion_{{$key + 1}}' value='1' {{$estimacion->resumen_estimacion == 1? 'checked': ''}} >
                                                                                </div>
                                                                                <p  class="text-sm font-medium text-gray-700 text-center"> Si</p>
                                                                            </div>
                                                                            <div class="col-span-1">
                                                                                <div class="flex justify-center">
                                                                                    <input class="display-block parte_social" type="radio" name='resumen_estimacion_{{$key + 1}}' value='2' {{$estimacion->resumen_estimacion != 1? 'checked': ''}} >
                                                                                </div>
                                                                                <p  class="text-sm font-medium text-gray-700 text-center"> No</p>
                                                                            </div>
                                                                            <div class="col-span-1">
                                                                                <div class="flex justify-center">
                                                                                    <input class="display-block parte_social" type="radio" name='resumen_estimacion_{{$key + 1}}' value='3' {{$estimacion->resumen_estimacion == 3? 'checked': ''}} >
                                                                                </div>
                                                                                <p  class="text-sm font-medium text-gray-700 text-center"> N/A</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="border sm:col-span-8">
                                                                        <div class="grid grid-cols-8 h-full flex items-center p-2">
                                                                            <div class="col-span-5 ">
                                                                                <p class="dos-lineas line-height-1">
                                                                                    Estado de cuenta de estimación.
                                                                                </p>
                                                                            </div>
                                                                            <div class="col-span-1">
                                                                                <div class="flex justify-center">
                                                                                    <input class="display-block parte_social" type="radio" name='estado_cuenta_estimacion_{{$key + 1}}' value='1' {{$estimacion->estado_cuenta_estimacion == 1? 'checked': ''}} >
                                                                                </div>
                                                                                <p  class="text-sm font-medium text-gray-700 text-center"> Si</p>
                                                                            </div>
                                                                            <div class="col-span-1">
                                                                                <div class="flex justify-center">
                                                                                    <input class="display-block parte_social" type="radio" name='estado_cuenta_estimacion_{{$key + 1}}' value='2' {{$estimacion->estado_cuenta_estimacion != 1? 'checked': ''}} >
                                                                                </div>
                                                                                <p  class="text-sm font-medium text-gray-700 text-center"> No</p>
                                                                            </div>
                                                                            <div class="col-span-1">
                                                                                <div class="flex justify-center">
                                                                                    <input class="display-block parte_social" type="radio" name='estado_cuenta_estimacion_{{$key + 1}}' value='3' {{$estimacion->estado_cuenta_estimacion == 3? 'checked': ''}} >
                                                                                </div>
                                                                                <p  class="text-sm font-medium text-gray-700 text-center"> N/A</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="border sm:col-span-8">
                                                                        <div class="grid grid-cols-8 h-full flex items-center p-2">
                                                                            <div class="col-span-5 ">
                                                                                <p class="dos-lineas line-height-1">
                                                                                    Número generadores de estimación.
                                                                                </p>
                                                                            </div>
                                                                            <div class="col-span-1">
                                                                                <div class="flex justify-center">
                                                                                    <input class="display-block parte_social" type="radio" name='numero_generadores_estimacion_{{$key + 1}}' value='1' {{$estimacion->numero_generadores_estimacion == 1? 'checked': ''}} >
                                                                                </div>
                                                                                <p  class="text-sm font-medium text-gray-700 text-center"> Si</p>
                                                                            </div>
                                                                            <div class="col-span-1">
                                                                                <div class="flex justify-center">
                                                                                    <input class="display-block parte_social" type="radio" name='numero_generadores_estimacion_{{$key + 1}}' value='2' {{$estimacion->numero_generadores_estimacion != 1? 'checked': ''}} >
                                                                                </div>
                                                                                <p  class="text-sm font-medium text-gray-700 text-center"> No</p>
                                                                            </div>
                                                                            <div class="col-span-1">
                                                                                <div class="flex justify-center">
                                                                                    <input class="display-block parte_social" type="radio" name='numero_generadores_estimacion_{{$key + 1}}' value='3' {{$estimacion->numero_generadores_estimacion == 3? 'checked': ''}} >
                                                                                </div>
                                                                                <p  class="text-sm font-medium text-gray-700 text-center"> N/A</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="border sm:col-span-8">
                                                                        <div class="grid grid-cols-8 h-full flex items-center p-2">
                                                                            <div class="col-span-5 ">
                                                                                <p class="dos-lineas line-height-1">
                                                                                    Corquis de localización de estimación.
                                                                                </p>
                                                                            </div>
                                                                            <div class="col-span-1">
                                                                                <div class="flex justify-center">
                                                                                    <input class="display-block parte_social" type="radio" name='croquis_ilustrativo_estimacion_{{$key + 1}}' value='1' {{$estimacion->croquis_ilustrativo_estimacion == 1? 'checked': ''}} >
                                                                                </div>
                                                                                <p  class="text-sm font-medium text-gray-700 text-center"> Si</p>
                                                                            </div>
                                                                            <div class="col-span-1">
                                                                                <div class="flex justify-center">
                                                                                    <input class="display-block parte_social" type="radio" name='croquis_ilustrativo_estimacion_{{$key + 1}}' value='2' {{$estimacion->croquis_ilustrativo_estimacion != 1? 'checked': ''}} >
                                                                                </div>
                                                                                <p  class="text-sm font-medium text-gray-700 text-center"> No</p>
                                                                            </div>
                                                                            <div class="col-span-1">
                                                                                <div class="flex justify-center">
                                                                                    <input class="display-block parte_social" type="radio" name='croquis_ilustrativo_estimacion_{{$key + 1}}' value='3' {{$estimacion->croquis_ilustrativo_estimacion == 3? 'checked': ''}} >
                                                                                </div>
                                                                                <p  class="text-sm font-medium text-gray-700 text-center"> N/A</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="border sm:col-span-8">
                                                                        <div class="grid grid-cols-8 h-full flex items-center p-2">
                                                                            <div class="col-span-5 ">
                                                                                <p class="dos-lineas line-height-1">
                                                                                    Soporte fotográfico de estimación.
                                                                                </p>
                                                                            </div>
                                                                            <div class="col-span-1">
                                                                                <div class="flex justify-center">
                                                                                    <input class="display-block parte_social" type="radio" name='reporte_fotografico_estimacion_{{$key + 1}}' value='1' {{$estimacion->reporte_fotografico_estimacion == 1? 'checked': ''}} >
                                                                                </div>
                                                                                <p  class="text-sm font-medium text-gray-700 text-center"> Si</p>
                                                                            </div>
                                                                            <div class="col-span-1">
                                                                                <div class="flex justify-center">
                                                                                    <input class="display-block parte_social" type="radio" name='reporte_fotografico_estimacion_{{$key + 1}}' value='2' {{$estimacion->reporte_fotografico_estimacion != 1? 'checked': ''}} >
                                                                                </div>
                                                                                <p  class="text-sm font-medium text-gray-700 text-center"> No</p>
                                                                            </div>
                                                                            <div class="col-span-1">
                                                                                <div class="flex justify-center">
                                                                                    <input class="display-block parte_social" type="radio" name='reporte_fotografico_estimacion_{{$key + 1}}' value='3' {{$estimacion->reporte_fotografico_estimacion == 3? 'checked': ''}} >
                                                                                </div>
                                                                                <p  class="text-sm font-medium text-gray-700 text-center"> N/A</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="border sm:col-span-8">
                                                                        <div class="grid grid-cols-8 h-full flex items-center p-2">
                                                                            <div class="col-span-5 ">
                                                                                <p class="dos-lineas line-height-1">
                                                                                    Notas de bitácora.
                                                                                </p>
                                                                            </div>
                                                                            <div class="col-span-1">
                                                                                <div class="flex justify-center">
                                                                                    <input class="display-block parte_social" type="radio" name='notas_bitacora_{{$key + 1}}' value='1' {{$estimacion->notas_bitacora == 1? 'checked': ''}} >
                                                                                </div>
                                                                                <p  class="text-sm font-medium text-gray-700 text-center"> Si</p>
                                                                            </div>
                                                                            <div class="col-span-1">
                                                                                <div class="flex justify-center">
                                                                                    <input class="display-block parte_social" type="radio" name='notas_bitacora_{{$key + 1}}' value='2' {{$estimacion->notas_bitacora != 1? 'checked': ''}} >
                                                                                </div>
                                                                                <p  class="text-sm font-medium text-gray-700 text-center"> No</p>
                                                                            </div>
                                                                            <div class="col-span-1">
                                                                                <div class="flex justify-center">
                                                                                    <input class="display-block parte_social" type="radio" name='notas_bitacora_{{$key + 1}}' value='3' {{$estimacion->notas_bitacora == 3? 'checked': ''}} >
                                                                                </div>
                                                                                <p  class="text-sm font-medium text-gray-700 text-center"> N/A</p>
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
                                    <div class="border sm:col-span-4">
                                        <div class="grid grid-cols-8 gap-y-4 h-full flex items-center p-2">
                                            <div class="col-span-5 ">
                                                <p class="dos-lineas line-height-1">
                                                    Fianza de anticipo
                                                </p>
                                            </div>
                                            <div class="col-span-1">
                                                <div class="flex justify-center">
                                                    <input class="display-block parte_social" type="radio" name="exp_fianza_anticipo" value='1' {{$obj_obra->get('contrato')->exp_fianza_anticipo == 1? 'checked': ''}} >
                                                </div>
                                                <p  class="text-sm font-medium text-gray-700 text-center"> Si</p>
                                            </div>
                                            <div class="col-span-1">
                                                <div class="flex justify-center">
                                                    <input class="display-block parte_social" type="radio" name="exp_fianza_anticipo" value='2' {{$obj_obra->get('contrato')->exp_fianza_anticipo != 1? 'checked': ''}} >
                                                </div>
                                                <p  class="text-sm font-medium text-gray-700 text-center"> No</p>
                                            </div>
                                            <div class="col-span-1">
                                                <div class="flex justify-center">
                                                    <input class="display-block parte_social" type="radio" name="exp_fianza_anticipo" value='3' {{$obj_obra->get('contrato')->exp_fianza_anticipo == 3? 'checked': ''}} >
                                                </div>
                                                <p  class="text-sm font-medium text-gray-700 text-center"> N/A</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="border sm:col-span-4">
                                        <div class="grid grid-cols-8 gap-y-4 h-full flex items-center p-2">
                                            <div class="col-span-5 ">
                                                <p class="dos-lineas line-height-1">
                                                    Fianza de cumplimiento
                                                </p>
                                            </div>
                                            <div class="col-span-1">
                                                <div class="flex justify-center">
                                                    <input class="display-block parte_social" type="radio" name="exp_fianza_cumplimiento" value='1' {{$obj_obra->get('contrato')->exp_fianza_cumplimiento == 1? 'checked': ''}} >
                                                </div>
                                                <p  class="text-sm font-medium text-gray-700 text-center"> Si</p>
                                            </div>
                                            <div class="col-span-1">
                                                <div class="flex justify-center">
                                                    <input class="display-block parte_social" type="radio" name="exp_fianza_cumplimiento" value='2' {{$obj_obra->get('contrato')->exp_fianza_cumplimiento != 1? 'checked': ''}} >
                                                </div>
                                                <p  class="text-sm font-medium text-gray-700 text-center"> No</p>
                                            </div>
                                            <div class="col-span-1">
                                                <div class="flex justify-center">
                                                    <input class="display-block parte_social" type="radio" name="exp_fianza_cumplimiento" value='3' {{$obj_obra->get('contrato')->exp_fianza_cumplimiento == 3? 'checked': ''}} >
                                                </div>
                                                <p  class="text-sm font-medium text-gray-700 text-center"> N/A</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="border sm:col-span-4">
                                        <div class="grid grid-cols-8 gap-y-4 h-full flex items-center p-2">
                                            <div class="col-span-5 ">
                                                <p class="dos-lineas line-height-1">
                                                    Fianza de vicios ocultos
                                                </p>
                                            </div>
                                            <div class="col-span-1">
                                                <div class="flex justify-center">
                                                    <input class="display-block parte_social" type="radio" name="exp_fianza_v_o" value='1' {{$obj_obra->get('contrato')->exp_fianza_v_o == 1? 'checked': ''}} >
                                                </div>
                                                <p  class="text-sm font-medium text-gray-700 text-center"> Si</p>
                                            </div>
                                            <div class="col-span-1">
                                                <div class="flex justify-center">
                                                    <input class="display-block parte_social" type="radio" name="exp_fianza_v_o" value='2' {{$obj_obra->get('contrato')->exp_fianza_v_o != 1? 'checked': ''}} >
                                                </div>
                                                <p  class="text-sm font-medium text-gray-700 text-center"> No</p>
                                            </div>
                                            <div class="col-span-1">
                                                <div class="flex justify-center">
                                                    <input class="display-block parte_social" type="radio" name="exp_fianza_v_o" value='3' {{$obj_obra->get('contrato')->exp_fianza_v_o == 3? 'checked': ''}} >
                                                </div>
                                                <p  class="text-sm font-medium text-gray-700 text-center"> N/A</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                        @else

                            <div class="border sm:col-span-4">
                                <div class="grid grid-cols-8 h-full flex items-center p-2">
                                    <div class="col-span-5 ">
                                        <p class="dos-lineas line-height-1">
                                            Inventario de la maquinaria y equipo de construcción con que cuenta el municipio.
                                        </p>
                                    </div>
                                    <div class="col-span-1">
                                        <div class="flex justify-center">
                                            <input class="display-block parte_social" type="radio" name="inventario_maquinaria_construccion" value='1' {{$obj_obra->get('admin')->inventario_maquinaria_construccion == 1? 'checked': ''}} >
                                        </div>
                                        <p  class="text-sm font-medium text-gray-700 text-center"> Si</p>
                                    </div>
                                    <div class="col-span-1">
                                        <div class="flex justify-center">
                                            <input class="display-block parte_social" type="radio" name="inventario_maquinaria_construccion" value='2' {{$obj_obra->get('admin')->inventario_maquinaria_construccion != 1? 'checked': ''}} >
                                        </div>
                                        <p  class="text-sm font-medium text-gray-700 text-center"> No</p>
                                    </div>
                                    <div class="col-span-1">
                                        <div class="flex justify-center">
                                            <input class="display-block parte_social" type="radio" name="inventario_maquinaria_construccion" value='3' {{$obj_obra->get('admin')->inventario_maquinaria_construccion == 3? 'checked': ''}} >
                                        </div>
                                        <p  class="text-sm font-medium text-gray-700 text-center"> N/A</p>
                                    </div>
                                </div>
                            </div>

                            <div class="border sm:col-span-4">
                                <div class="grid grid-cols-8 h-full flex items-center p-2">
                                    <div class="col-span-5 ">
                                        <p class="dos-lineas line-height-1">
                                            Relacion de la plantilla del personal tecnico y administrativo relacionado con la obra
                                        </p>
                                    </div>
                                    <div class="col-span-1">
                                        <div class="flex justify-center">
                                            <input class="display-block parte_social" type="radio" name="plantilla_personal" value='1' {{$obj_obra->get('admin')->plantilla_personal == 1? 'checked': ''}} >
                                        </div>
                                        <p  class="text-sm font-medium text-gray-700 text-center"> Si</p>
                                    </div>
                                    <div class="col-span-1">
                                        <div class="flex justify-center">
                                            <input class="display-block parte_social" type="radio" name="plantilla_personal" value='2' {{$obj_obra->get('admin')->plantilla_personal != 1? 'checked': ''}} >
                                        </div>
                                        <p  class="text-sm font-medium text-gray-700 text-center"> No</p>
                                    </div>
                                    <div class="col-span-1">
                                        <div class="flex justify-center">
                                            <input class="display-block parte_social" type="radio" name="plantilla_personal" value='3' {{$obj_obra->get('admin')->plantilla_personal == 3? 'checked': ''}} >
                                        </div>
                                        <p  class="text-sm font-medium text-gray-700 text-center"> N/A</p>
                                    </div>
                                </div>
                            </div>

                            <div class="border sm:col-span-4">
                                <div class="grid grid-cols-8 h-full flex items-center p-2">
                                    <div class="col-span-5 ">
                                        <p class="dos-lineas line-height-1">
                                            Identificacion oficial de los trabajadores que aparecen en las listas de raya.
                                        </p>
                                    </div>
                                    <div class="col-span-1">
                                        <div class="flex justify-center">
                                            <input class="display-block parte_social" type="radio" name="indentificacion_oficial_trabajadores" value='1' {{$obj_obra->get('admin')->indentificacion_oficial_trabajadores == 1? 'checked': ''}} >
                                        </div>
                                        <p  class="text-sm font-medium text-gray-700 text-center"> Si</p>
                                    </div>
                                    <div class="col-span-1">
                                        <div class="flex justify-center">
                                            <input class="display-block parte_social" type="radio" name="indentificacion_oficial_trabajadores" value='2' {{$obj_obra->get('admin')->indentificacion_oficial_trabajadores != 1? 'checked': ''}} >
                                        </div>
                                        <p  class="text-sm font-medium text-gray-700 text-center"> No</p>
                                    </div>
                                    <div class="col-span-1">
                                        <div class="flex justify-center">
                                            <input class="display-block parte_social" type="radio" name="indentificacion_oficial_trabajadores" value='3' {{$obj_obra->get('admin')->indentificacion_oficial_trabajadores == 3? 'checked': ''}} >
                                        </div>
                                        <p  class="text-sm font-medium text-gray-700 text-center"> N/A</p>
                                    </div>
                                </div>
                            </div>

                            <div class="border sm:col-span-4">
                                <div class="grid grid-cols-8 h-full flex items-center p-2">
                                    <div class="col-span-5 ">
                                        <p class="dos-lineas line-height-1">
                                            Reporte fotográfico.
                                        </p>
                                    </div>
                                    <div class="col-span-1">
                                        <div class="flex justify-center">
                                            <input class="display-block parte_social" type="radio" name="reporte_fotografico" value='1' {{$obj_obra->get('admin')->reporte_fotografico == 1? 'checked': ''}} >
                                        </div>
                                        <p  class="text-sm font-medium text-gray-700 text-center"> Si</p>
                                    </div>
                                    <div class="col-span-1">
                                        <div class="flex justify-center">
                                            <input class="display-block parte_social" type="radio" name="reporte_fotografico" value='2' {{$obj_obra->get('admin')->reporte_fotografico != 1? 'checked': ''}} >
                                        </div>
                                        <p  class="text-sm font-medium text-gray-700 text-center"> No</p>
                                    </div>
                                    <div class="col-span-1">
                                        <div class="flex justify-center">
                                            <input class="display-block parte_social" type="radio" name="reporte_fotografico" value='3' {{$obj_obra->get('admin')->reporte_fotografico == 3? 'checked': ''}} >
                                        </div>
                                        <p  class="text-sm font-medium text-gray-700 text-center"> N/A</p>
                                    </div>
                                </div>
                            </div>

                            <div class="border sm:col-span-4">
                                <div class="grid grid-cols-8 h-full flex items-center p-2">
                                    <div class="col-span-5 ">
                                        <p class="dos-lineas line-height-1">
                                            Notas de bitácora.
                                        </p>
                                    </div>
                                    <div class="col-span-1">
                                        <div class="flex justify-center">
                                            <input class="display-block parte_social" type="radio" name="notas_bitacora" value='1' {{$obj_obra->get('admin')->notas_bitacora == 1? 'checked': ''}} >
                                        </div>
                                        <p  class="text-sm font-medium text-gray-700 text-center"> Si</p>
                                    </div>
                                    <div class="col-span-1">
                                        <div class="flex justify-center">
                                            <input class="display-block parte_social" type="radio" name="notas_bitacora" value='2' {{$obj_obra->get('admin')->notas_bitacora != 1? 'checked': ''}} >
                                        </div>
                                        <p  class="text-sm font-medium text-gray-700 text-center"> No</p>
                                    </div>
                                    <div class="col-span-1">
                                        <div class="flex justify-center">
                                            <input class="display-block parte_social" type="radio" name="notas_bitacora" value='3' {{$obj_obra->get('admin')->notas_bitacora == 3? 'checked': ''}} >
                                        </div>
                                        <p  class="text-sm font-medium text-gray-700 text-center"> N/A</p>
                                    </div>
                                </div>
                            </div>
                    
                            <div class="border sm:col-span-4">
                                <div class="grid grid-cols-8 h-full flex items-center p-2">
                                    <div class="col-span-5 ">
                                        <p class="dos-lineas line-height-1">
                                            Acta de entrega recepción.
                                        </p>
                                    </div>
                                    <div class="col-span-1">
                                        <div class="flex justify-center">
                                            <input class="display-block parte_social" type="radio" name="acta_entrega_municipio" value='1' {{$obj_obra->get('admin')->acta_entrega_municipio == 1? 'checked': ''}} >
                                        </div>
                                        <p  class="text-sm font-medium text-gray-700 text-center"> Si</p>
                                    </div>
                                    <div class="col-span-1">
                                        <div class="flex justify-center">
                                            <input class="display-block parte_social" type="radio" name="acta_entrega_municipio" value='2' {{$obj_obra->get('admin')->acta_entrega_municipio != 1? 'checked': ''}} >
                                        </div>
                                        <p  class="text-sm font-medium text-gray-700 text-center"> No</p>
                                    </div>
                                    <div class="col-span-1">
                                        <div class="flex justify-center">
                                            <input class="display-block parte_social" type="radio" name="acta_entrega_municipio" value='3' {{$obj_obra->get('admin')->acta_entrega_municipio == 3? 'checked': ''}} >
                                        </div>
                                        <p  class="text-sm font-medium text-gray-700 text-center"> N/A</p>
                                    </div>
                                </div>
                            </div>

                            <div class="border sm:col-span-4">
                                <div class="grid grid-cols-8 h-full flex items-center p-2">
                                    <div class="col-span-5 ">
                                        <p class="dos-lineas line-height-1">
                                            Cédula detallada de facturación total de la obra.
                                        </p>
                                    </div>
                                    <div class="col-span-1">
                                        <div class="flex justify-center">
                                            <input class="display-block parte_social" type="radio" name="cedula_detallada_facturacion" value='1' {{$obj_obra->get('admin')->cedula_detallada_facturacion == 1? 'checked': ''}} >
                                        </div>
                                        <p  class="text-sm font-medium text-gray-700 text-center"> Si</p>
                                    </div>
                                    <div class="col-span-1">
                                        <div class="flex justify-center">
                                            <input class="display-block parte_social" type="radio" name="cedula_detallada_facturacion" value='2' {{$obj_obra->get('admin')->cedula_detallada_facturacion != 1? 'checked': ''}} >
                                        </div>
                                        <p  class="text-sm font-medium text-gray-700 text-center"> No</p>
                                    </div>
                                    <div class="col-span-1">
                                        <div class="flex justify-center">
                                            <input class="display-block parte_social" type="radio" name="cedula_detallada_facturacion" value='3' {{$obj_obra->get('admin')->cedula_detallada_facturacion == 3? 'checked': ''}} >
                                        </div>
                                        <p  class="text-sm font-medium text-gray-700 text-center"> N/A</p>
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
                                        <input type="text" name="numero_listas" class="hidden" value="{{ count($listas_raya) }}">
                                        @foreach ($listas_raya as $key => $lista)
                                            <div class="border sm:col-span-4">
                                                <div class="grid grid-cols-8 h-full flex items-center p-2">
                                                    <input type="text" name="lista_id_{{$key + 1}}" class="hidden" value="{{ $lista->id_lista_raya }}">
                                                    <div class="col-span-5 ">
                                                        <p class="dos-lineas line-height-1">
                                                            Lista de raya {{$lista->numero_lista_raya}}<br> Del {{date('d-m-Y', strtotime($lista->fecha_inicio))}} al {{date('d-m-Y', strtotime($lista->fecha_fin))}}
                                                        </p>
                                                    </div>
                                                    <div class="col-span-1">
                                                        <div class="flex justify-center">
                                                            <input class="display-block parte_social" type="radio" name="lista_raya_{{$key + 1}}" value='1' {{$lista->agregado_expediente == 1? 'checked': ''}} >
                                                        </div>
                                                        <p  class="text-sm font-medium text-gray-700 text-center"> Si</p>
                                                    </div>
                                                    <div class="col-span-1">
                                                        <div class="flex justify-center">
                                                            <input class="display-block parte_social" type="radio" name="lista_raya_{{$key + 1}}" value='2' {{$lista->agregado_expediente != 1? 'checked': ''}} >
                                                        </div>
                                                        <p  class="text-sm font-medium text-gray-700 text-center"> No</p>
                                                    </div>
                                                    <div class="col-span-1">
                                                        <div class="flex justify-center">
                                                            <input class="display-block parte_social" type="radio" name="lista_raya_{{$key + 1}}" value='3' {{$lista->agregado_expediente == 3? 'checked': ''}} >
                                                        </div>
                                                        <p  class="text-sm font-medium text-gray-700 text-center"> N/A</p>
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
                                        <input type="text" name="numero_facturas" class="hidden" value="{{ count($facturas) }}">
                                        @foreach ($facturas as $key => $factura)
                                            <div class="border sm:col-span-4">
                                                <div class="grid grid-cols-8 h-full flex items-center p-2">
                                                    <input type="text" name="factura_id_{{$key + 1}}" class="hidden" value="{{ $factura->id_factura }}">
                                                    <div class="col-span-5 ">
                                                        <p class="dos-lineas line-height-1">
                                                            Factura  {{$factura->folio_fiscal}}
                                                        </p>
                                                    </div>
                                                    <div class="col-span-1">
                                                        <div class="flex justify-center">
                                                            <input class="display-block parte_social" type="radio" name="factura_{{$key + 1}}" value='1' {{$factura->agregado_expediente == 1? 'checked': ''}} >
                                                        </div>
                                                        <p  class="text-sm font-medium text-gray-700 text-center"> Si</p>
                                                    </div>
                                                    <div class="col-span-1">
                                                        <div class="flex justify-center">
                                                            <input class="display-block parte_social" type="radio" name="factura_{{$key + 1}}" value='2' {{$factura->agregado_expediente != 1? 'checked': ''}} >
                                                        </div>
                                                        <p  class="text-sm font-medium text-gray-700 text-center"> No</p>
                                                    </div>
                                                    <div class="col-span-1">
                                                        <div class="flex justify-center">
                                                            <input class="display-block parte_social" type="radio" name="factura_{{$key + 1}}" value='3' {{$factura->agregado_expediente == 3? 'checked': ''}} >
                                                        </div>
                                                        <p  class="text-sm font-medium text-gray-700 text-center"> N/A</p>
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
                                        <input type="text" name="numero_contratos" class="hidden" value="{{ count($contratos_arrendamiento) }}">
                                        @foreach ($contratos_arrendamiento as $key => $contrato)
                                            <div class="border sm:col-span-4">
                                                <div class="grid grid-cols-8 h-full flex items-center p-2">
                                                    <input type="text" name="contrato_id_{{$key + 1}}" class="hidden" value="{{ $contrato->id_contrato_arrendamiento }}">
                                                    <div class="col-span-5 ">
                                                        <p class="dos-lineas line-height-1">
                                                            Contrato {{$contrato->numero_contrato}}
                                                        </p>
                                                    </div>
                                                    <div class="col-span-1">
                                                        <div class="flex justify-center">
                                                            <input class="display-block parte_social" type="radio" name="contrato_arrendamiento_{{$key + 1}}" value='1' {{$contrato->agregado_expediente == 1? 'checked': ''}} >
                                                        </div>
                                                        <p  class="text-sm font-medium text-gray-700 text-center"> Si</p>
                                                    </div>
                                                    <div class="col-span-1">
                                                        <div class="flex justify-center">
                                                            <input class="display-block parte_social" type="radio" name="contrato_arrendamiento_{{$key + 1}}" value='2' {{$contrato->agregado_expediente != 1? 'checked': ''}} >
                                                        </div>
                                                        <p  class="text-sm font-medium text-gray-700 text-center"> No</p>
                                                    </div>
                                                    <div class="col-span-1">
                                                        <div class="flex justify-center">
                                                            <input class="display-block parte_social" type="radio" name="contrato_arrendamiento_{{$key + 1}}" value='3' {{$contrato->agregado_expediente == 3? 'checked': ''}} >
                                                        </div>
                                                        <p  class="text-sm font-medium text-gray-700 text-center"> N/A</p>
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
                @if ($obj_obra->get('obra')->modalidad_ejecucion == 2)
                    <div id="terminacion" style="display: none;">
                        <div class=" bg-gray-100 mt-5">
                            <h2 class="font-bold text-lg text-center">Parte técnica</h2>
                        </div>
                        <div>
                            <h2 class="font-semibold text-lg text-center">Terminación de los trabajos</h2>
                            <hr>
                        </div>
                        <div class="grid grid-cols-8 gap-8 mt-10">
                            <div class="border sm:col-span-4">
                                <div class="grid grid-cols-8 h-full flex items-center p-2">
                                    <div class="col-span-5 ">
                                        <p class="dos-lineas line-height-1">
                                            Presupuesto definitivo.
                                        </p>
                                    </div>
                                    <div class="col-span-1">
                                        <div class="flex justify-center">
                                            <input class="display-block parte_social" type="radio" name="presupuesto_definitivo" value='1' {{$obj_obra->get('contrato')->presupuesto_definitivo == 1? 'checked': ''}} >
                                        </div>
                                        <p  class="text-sm font-medium text-gray-700 text-center"> Si</p>
                                    </div>
                                    <div class="col-span-1">
                                        <div class="flex justify-center">
                                            <input class="display-block parte_social" type="radio" name="presupuesto_definitivo" value='2' {{$obj_obra->get('contrato')->presupuesto_definitivo != 1? 'checked': ''}} >
                                        </div>
                                        <p  class="text-sm font-medium text-gray-700 text-center"> No</p>
                                    </div>
                                    <div class="col-span-1">
                                        <div class="flex justify-center">
                                            <input class="display-block parte_social" type="radio" name="presupuesto_definitivo" value='3' {{$obj_obra->get('contrato')->presupuesto_definitivo == 3? 'checked': ''}} >
                                        </div>
                                        <p  class="text-sm font-medium text-gray-700 text-center"> N/A</p>
                                    </div>
                                </div>
                            </div>

                            <div class="border sm:col-span-4">
                                <div class="grid grid-cols-8 h-full flex items-center p-2">
                                    <div class="col-span-5 ">
                                        <p class="dos-lineas line-height-1">
                                            Actas de entrega de recepción fisica de los trabajos del contratista al municipio.
                                        </p>
                                    </div>
                                    <div class="col-span-1">
                                        <div class="flex justify-center">
                                            <input class="display-block parte_social" type="radio" name="acta_entrega_contratista" value='1' {{$obj_obra->get('contrato')->acta_entrega_contratista == 1? 'checked': ''}} >
                                        </div>
                                        <p  class="text-sm font-medium text-gray-700 text-center"> Si</p>
                                    </div>
                                    <div class="col-span-1">
                                        <div class="flex justify-center">
                                            <input class="display-block parte_social" type="radio" name="acta_entrega_contratista" value='2' {{$obj_obra->get('contrato')->acta_entrega_contratista != 1? 'checked': ''}} >
                                        </div>
                                        <p  class="text-sm font-medium text-gray-700 text-center"> No</p>
                                    </div>
                                    <div class="col-span-1">
                                        <div class="flex justify-center">
                                            <input class="display-block parte_social" type="radio" name="acta_entrega_contratista" value='3' {{$obj_obra->get('contrato')->acta_entrega_contratista == 3? 'checked': ''}} >
                                        </div>
                                        <p  class="text-sm font-medium text-gray-700 text-center"> N/A</p>
                                    </div>
                                </div>
                            </div>

                            <div class="border sm:col-span-4">
                                <div class="grid grid-cols-8 h-full flex items-center p-2">
                                    <div class="col-span-5 ">
                                        <p class="dos-lineas line-height-1">
                                            Actas de entrega de recepción fisica de los trabajos del municipio a los beneficiarios.
                                        </p>
                                    </div>
                                    <div class="col-span-1">
                                        <div class="flex justify-center">
                                            <input class="display-block parte_social" type="radio" name="acta_entrega_municipio" value='1' {{$obj_obra->get('contrato')->acta_entrega_municipio == 1? 'checked': ''}} >
                                        </div>
                                        <p  class="text-sm font-medium text-gray-700 text-center"> Si</p>
                                    </div>
                                    <div class="col-span-1">
                                        <div class="flex justify-center">
                                            <input class="display-block parte_social" type="radio" name="acta_entrega_municipio" value='2' {{$obj_obra->get('contrato')->acta_entrega_municipio != 1? 'checked': ''}} >
                                        </div>
                                        <p  class="text-sm font-medium text-gray-700 text-center"> No</p>
                                    </div>
                                    <div class="col-span-1">
                                        <div class="flex justify-center">
                                            <input class="display-block parte_social" type="radio" name="acta_entrega_municipio" value='3' {{$obj_obra->get('contrato')->acta_entrega_municipio == 3? 'checked': ''}} >
                                        </div>
                                        <p  class="text-sm font-medium text-gray-700 text-center"> N/A</p>
                                    </div>
                                </div>
                            </div>

                            <div class="border sm:col-span-4">
                                <div class="grid grid-cols-8 h-full flex items-center p-2">
                                    <div class="col-span-5 ">
                                        <p class="dos-lineas line-height-1">
                                            Acta de extinción de derechos y obligaciones.
                                        </p>
                                    </div>
                                    <div class="col-span-1">
                                        <div class="flex justify-center">
                                            <input class="display-block parte_social" type="radio" name="acta_extincion" value='1' {{$obj_obra->get('contrato')->acta_extincion == 1? 'checked': ''}} >
                                        </div>
                                        <p  class="text-sm font-medium text-gray-700 text-center"> Si</p>
                                    </div>
                                    <div class="col-span-1">
                                        <div class="flex justify-center">
                                            <input class="display-block parte_social" type="radio" name="acta_extincion" value='2' {{$obj_obra->get('contrato')->acta_extincion != 1? 'checked': ''}} >
                                        </div>
                                        <p  class="text-sm font-medium text-gray-700 text-center"> No</p>
                                    </div>
                                    <div class="col-span-1">
                                        <div class="flex justify-center">
                                            <input class="display-block parte_social" type="radio" name="acta_extincion" value='3' {{$obj_obra->get('contrato')->acta_extincion == 3? 'checked': ''}} >
                                        </div>
                                        <p  class="text-sm font-medium text-gray-700 text-center"> N/A</p>
                                    </div>
                                </div>
                            </div>

                            <div class="border sm:col-span-4">
                                <div class="grid grid-cols-8 h-full flex items-center p-2">
                                    <div class="col-span-5 ">
                                        <p class="dos-lineas line-height-1">
                                            Aviso de terminación de la obra por parte del contratista.
                                        </p>
                                    </div>
                                    <div class="col-span-1">
                                        <div class="flex justify-center">
                                            <input class="display-block parte_social" type="radio" name="aviso_terminacion_obra" value='1' {{$obj_obra->get('contrato')->aviso_terminacion_obra == 1? 'checked': ''}} >
                                        </div>
                                        <p  class="text-sm font-medium text-gray-700 text-center"> Si</p>
                                    </div>
                                    <div class="col-span-1">
                                        <div class="flex justify-center">
                                            <input class="display-block parte_social" type="radio" name="aviso_terminacion_obra" value='2' {{$obj_obra->get('contrato')->aviso_terminacion_obra != 1? 'checked': ''}} >
                                        </div>
                                        <p  class="text-sm font-medium text-gray-700 text-center"> No</p>
                                    </div>
                                    <div class="col-span-1">
                                        <div class="flex justify-center">
                                            <input class="display-block parte_social" type="radio" name="aviso_terminacion_obra" value='3' {{$obj_obra->get('contrato')->aviso_terminacion_obra == 3? 'checked': ''}} >
                                        </div>
                                        <p  class="text-sm font-medium text-gray-700 text-center"> N/A</p>
                                    </div>
                                </div>
                            </div>

                            <div class="border sm:col-span-4">
                                <div class="grid grid-cols-8 h-full flex items-center p-2">
                                    <div class="col-span-5 ">
                                        <p class="dos-lineas line-height-1">
                                            Sabana de finiquito.
                                        </p>
                                    </div>
                                    <div class="col-span-1">
                                        <div class="flex justify-center">
                                            <input class="display-block parte_social" type="radio" name="saba_finiquito" value='1' {{$obj_obra->get('contrato')->saba_finiquito == 1? 'checked': ''}} >
                                        </div>
                                        <p  class="text-sm font-medium text-gray-700 text-center"> Si</p>
                                    </div>
                                    <div class="col-span-1">
                                        <div class="flex justify-center">
                                            <input class="display-block parte_social" type="radio" name="saba_finiquito" value='2' {{$obj_obra->get('contrato')->saba_finiquito != 1? 'checked': ''}} >
                                        </div>
                                        <p  class="text-sm font-medium text-gray-700 text-center"> No</p>
                                    </div>
                                    <div class="col-span-1">
                                        <div class="flex justify-center">
                                            <input class="display-block parte_social" type="radio" name="saba_finiquito" value='3' {{$obj_obra->get('contrato')->saba_finiquito == 3? 'checked': ''}} >
                                        </div>
                                        <p  class="text-sm font-medium text-gray-700 text-center"> N/A</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="mt-5">
                    <label  id="label_observaciones" class="block font-bold">Observaciones:</label>
                    <textarea maxlength="1000" name="observaciones" id="observaciones" class="mt-1 focus:ring-blue-800 focus:border-blue-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="">{{ $observaciones?$observaciones->observacion:'' }}</textarea>
                </div>
                
            </div>
            <!--footer-->
            <div class="mt-10 p-4 border-t border-solid border-blueGray-200 rounded-b">
                <label  id="error" class="hidden block text-sm font-bold text-red-500">Especifique la factura de anticipo y los números fianzas.</label>
                <span class="block text-xs">Verifique los campos obligatorios marcados con un ( * )</span>
                <div class="text-right">
                    <a type="button" href="{{redirect()->getUrlGenerator()->previous()}}" class="text-red-500 background-transparent font-bold uppercase px-6 py-2 text-sm outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150">
                        Cancelar
                    </a>
                    <button id="regresar" type="button" class="hidden bg-green-500 text-white active:bg-green-600 font-bold uppercase text-sm px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" onclick="mostrar()">
                        Regresar
                    </button>
                    <button id="ocultar_elemento" type="button" class="bg-green-500 text-white active:bg-green-600 font-bold uppercase text-sm px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" onclick="ocultar()">
                        Siguiente
                    </button>
                    <button id="guardar_btn" type="submit" class="hidden bg-green-500 text-white active:bg-green-600 font-bold uppercase text-sm px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150">
                        Guardar
                    </button>
                </div>
            </div>
        </form>


    </div>
</div>
<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script> 
<script>
    var divs = [];

    if({{$obj_obra->get('obra')->modalidad_ejecucion}} == 2){
        var divs = ["#div_fuente_financiamiento", "#modalidad_ejecucion", "#datos_generales",  "#actas_parte_social", '#terminacion'];
    }
    else{
        var divs = ["#div_fuente_financiamiento", "#modalidad_ejecucion", "#actas_parte_social"];
    }
    var primera_seccion = ["nombre_obra", "nombre_corto", "nombre_localidad", "tipo_localidad", "situacion", "oficio_notificacion", "fecha_oficio_notificacion", "fecha_inicio", "fecha_fin"];
    var segunda_seccion = ["contrato", "fecha_contrato", "anticipo_porcentaje"];
    var tercera_seccion = ["monto_contratado"];
    posicion = 0;
    fila = 0;
    i = 0;
    
    modalidad = 2;
    fondo_III = false;

    function ocultar() {
        
        //if(!error){
            $(divs[posicion]).stop(true).slideUp("slow");
            $(divs[posicion + 1]).stop(true).slideDown("slow");
            posicion = posicion + 1;

            if(posicion == (divs.length -1)){
                $("#guardar_btn").removeClass("hidden");
                $("#ocultar_elemento").addClass("hidden");
            }

            if(posicion > 0){
                $("#regresar").removeClass("hidden");
            }else
                $("#regresar").addClass("hidden");
        //}
    }

    function mostrar() {
        if(posicion > 0){
            $(divs[posicion]).stop(true).slideUp("slow");
            $(divs[posicion-1]).stop(true).slideDown("slow");
            posicion = posicion - 1;
            if(posicion == 0)
                $("#regresar").removeClass("hidden");
            $("#guardar_btn").addClass("hidden");
            $("#ocultar_elemento").removeClass("hidden");
        }
    }

    function seleccionar(value, object, val){

    }

    total = 0;


    
    $(document).ready(function() {

        
        $(".parte_social").change(function() {
            valor = $(this).val();
            if(valor == 1){

            }
            
        }); 

        $("#guardar_btn").click(function () {
            
            parte_social = 0;
            total_parte_social = 0;
            na_parte_social = 0;

            $(".parte_social").each(function(index) {
                total_parte_social ++;
                if($(this).is(':checked') && $(this).val() == 1) {
                    parte_social = parte_social + 1;
                }
                if($(this).is(':checked') && $(this).val() == 3) {
                    na_parte_social = na_parte_social + 1;
                }
            });
            $("#total_documentos").val(total_parte_social);
            $("#total_si").val(parte_social);
            $("#total_na").val(na_parte_social);

        });

    });
</script>
@endsection