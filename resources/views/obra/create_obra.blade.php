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
    <h1 class="font-bold text-xl ml-2">Crear obra</h1>
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
        
        <form action="{{ route('store_obra') }}" method="POST" accept-charset="UTF-8" enctype="multipart/form-data" id="formulario">
            @csrf
            @method('POST')
            <div class="relative p-6 flex-auto">
                <div id="div_fuente_financiamiento">
                    <h2 class="font-bold text-xl text-center">Fuente de financiamiento</h2>
                    <hr>
                    <div class="grid grid-cols-8 gap-6 mt-10">
                        <div class="col-span-10 md:col-span-4">
                            <label  id="label_cliente_id" for="cliente_id" class="block text-sm font-bold text-gray-700">Municipio</label>
                            <label id="cliente_nombre" class="block text-base font-medium text-gray-700 py-3 px-2">{{$cliente->nombre}}</label>
                            <input type="text" name="cliente_id" id="cliente_id" class="hidden border-none block text-base font-medium text-gray-700 py-3 px-2" value="{{$cliente->id_cliente}}">
                        </div>
                        <div class="col-span-5 md:col-span-2">
                            <label id="label_ejercicio" for="label_ejercicio" class="block text-sm font-bold text-gray-700">Ejercicio</label>
                            <label class="block text-base font-medium text-gray-700 py-3 px-2">{{$anio}}</label>
                            <input type="text" name="ejercicio" id="ejercicio" class="hidden border-none block text-base font-medium text-gray-700 py-3 px-2" value="{{$anio}}">
                        </div>
                        <div class="col-span-10 md:col-span-2">
                            <label for="monto_contratado" class="block text-sm font-bold text-gray-700">Monto de la obra *</label>
                            <div class="relative ">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                  <span class="text-gray-700 text-base">
                                    $
                                  </span>
                                </div>
                                <input type="text" name="monto_contratado" id="monto_contratado" minlenght="4" maxlength="20" class="pl-7  mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" placeholder="0.00">
                                <input type="text" name="numero_fuentes" id="numero_fuentes" minlenght="4" maxlength="20" class="hidden pl-7  mt-1 " value="0">
                            </div>
                            <label id="error_monto_contratado" class="hidden text-base font-normal text-red-500 label_error" >Ingrese un monto de obra valido</label>
                        </div>
                        <div class="col-span-4 obra_fIII add_fIII">
                            <label  for="fuente_financiamiento" class="block text-sm font-bold text-gray-700">Fuente de financiamiento*</label>
                            <select class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" name="fuente_financiamiento" id="fuente_financiamiento" onchange="hola({{$fuentes_cliente}})">
                                @foreach ($fuentes_cliente as $key => $fuente)
                                    <option value="{{$fuente->id_fuente_financ_cliente}}">{{$fuente->nombre_corto}}</option>
                                @endforeach
                            </select>
                            <label  id="error_fuente_f" class="hidden block text-sm font-bold text-red-500">Fuente de financiamiento ya seleccionada.</label>
                        </div>
                        <div id="div_ff" class="{{($fuentes_cliente[0]->sobrante_fondo == 0) ? 'hidden': '' }} col-span-10 md:col-span-4 obra_fIII add_fIII">
                            <label for="monto_contratado" class="block text-sm font-bold text-gray-700">Monto comprometido de la fuente de financiamiento*</label>
                            <div class="relative ">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                  <span class="text-gray-700 text-base">
                                    $
                                  </span>
                                </div>
                                <input type="text" name="monto_fuente" id="monto_fuente" maxlength="20" class="pl-7  mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" placeholder="0.00">
                            </div>
                            <label id="error_monto_fuente" class="hidden block text-sm font-bold text-red-500 label_error" >Agregue un monto valido</label>
                        </div>
                        <div class="col-span-8 obra_fIII add_fIII">
                            <label  id="saldo_fuente" class="block text-sm font-bold {{($fuentes_cliente[0]->sobrante_fondo == 0) ? 'text_red_500': 'text-gray-700' }}">El monto restanter de este fondo es: {{$service->formatNumber($fuentes_cliente[0]->sobrante_fondo)}}</label>
                            <label  id="fuente_existente" class="hidden block text-sm font-bold text-red-500 label_error">La fuente de financiamiento ya tiene un monto asignado</label>
                            <label  id="monto_mayor" class="hidden block text-sm font-bold text-red-500 label_error">El monto es mayor del disponible en la fuente de financiamiento</label>
                            <label  id="monto_mayor_contratado" class="hidden block text-sm font-bold text-red-500 label_error">El monto a registrar da un valor mayor que el total de la obra</label>
                            <label  id="error_fuente" class="hidden block text-sm font-bold text-red-500 label_error">Se debe asociar por lo menos una fuente de financiamiento</label>
                            <label  id="monto_diferente" class="hidden block text-sm font-bold text-red-500 label_error">El monto comprometido es diferente al total de la obra</label>
                        </div>
                        <div id="btn_ff" class="{{($fuentes_cliente[0]->sobrante_fondo == 0) ? 'hidden': '' }} col-span-10 md:col-span-8 flex justify-center obra_fIII add_fIII">
                            <button id="addRow" type="button" class="text-base text-white bg-blue-500 p-2 rounded-lg px-6" onclick="addrow({{$fuentes_cliente}})">
                                Agregar
                            </button>
                        </div>
                        <div class="col-span-8 info-table hidden obra_fIII">
                            <label id="label_tc" class="block text-sm font-bold text-gray-700">Monto total comprometido: $<span id="total_comprometido">0.00</span></label>
                        </div>
                        <div class="col-span-8 info-table hidden">
                            <div class="">
                                <table id="example" class="table table-striped bg-white" style="width:100%;">
                                    <thead>
                                        <tr>
                                            <th>Fondo</th>
                                            <th>Monto</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody id="example_body">
                                        
                                    </tbody>
                                </table>
                            </div>
                            
                        </div>
                    </div>
                </div>

                <div id="modalidad_ejecucion">
                    <h2 class="font-bold text-xl text-center">Modalidad de ejecución</h2>
                    <hr>
                    <div class="grid grid-cols-8 gap-6 mt-10">
                        <div class="col-span-8 md:col-span-8">
                            <div class="form-group pb-4">
                                <div class="grid grid-cols-8">
                                    <div class="col-span-4 flex justify-center">
                                        <div>
                                            <input type="radio" value="2" checked id="modalidad_ejecucion" name="modalidad_ejecucion">
                                            <label for="contrato" class="text-base font-medium text-gray-700"> Contrato</label>
                                        </div>
                                    </div>
                                    <div class="col-span-4 flex justify-center">
                                        <div>
                                            <input type="radio" value="1" id="administracion" name="modalidad_ejecucion">
                                            <label for="administracion" class="text-base font-medium text-gray-700">Administración Directa</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-8 md:col-span-4 solo_contrato">
                            <label  id="label_cliente_id" for="cliente_id" class="block text-sm font-bold text-gray-700">Modalidad de asignación:</label>
                            <div class="form-group">
                                <input type="radio" value="1" checked id="modalidad_asignacion" name="modalidad_asignacion">
                                <label for="contrato" class="text-base font-medium text-gray-700"> Licitación publica</label>
                                <br>
                                <input type="radio" value="2" id="administracion" name="modalidad_asignacion">
                                <label for="administracion" class="text-base font-medium text-gray-700">Invitación restringida a cuando menos tres contratistas</label>
                                <br>
                                <input type="radio" value="3" id="administracion" name="modalidad_asignacion">
                                <label for="administracion" class="text-base font-medium text-gray-700">Adjudicación directa</label>
                            </div>
                        </div>
                        <div class="col-span-10 md:col-span-2 solo_contrato">
                            <label for="contrato" class="block text-sm font-bold text-gray-700">Tipo de contrato</label>
                            <div class="form-group">
                                <input type="radio" value="1" checked id="tipo_contrato" name="tipo_contrato">
                                <label for="contrato" class="text-base font-medium text-gray-700"> Precios unitarios</label>
                                <br>
                                <input type="radio" value="2" id="administracion" name="tipo_contrato">
                                <label for="administracion" class="text-base font-medium text-gray-700">Precios alzados</label>
                            </div>
                        </div>
                        <div class="col-span-8 md:col-span-2 solo_contrato">
                            <label  id="label_cliente_id" for="cliente_id" class="block text-sm font-bold text-gray-700">Monto contratado:</label>
                            <label id="label_monto_contratado" class="block text-base font-medium text-gray-700 py-3 px-2">$ 0.00</label>
                        </div>
                        <div class="col-span-10 md:col-span-4 solo_contrato">
                            <label for="contrato" class="block text-sm font-bold text-gray-700 text-center" >Contrato</label>
                            <div class="grid grid-cols-4 gap-4">
                                <div class="col-span-2">
                                    <input type="text" name="contrato" id="contrato" maxlength="40" class="mt-1 focus:ring-blue-800 focus:border-blue-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ old('oficio_notificacion') }}">
                                    <label for="contrato" class="block text-sm font-semibold text-gray-700 text-center">Número*</label>
                                    <label id="error_contrato" class="hidden text-base font-normal text-red-500" >Ingrese un número de contrato valido</label>
                                </div>
                                <div class="col-span-2">
                                    <input type="date" name="fecha_contrato" id="fecha_contrato" min="{{$anio}}-01-01" max="{{$anio}}-12-31" class="mt-1 focus:ring-blue-800 focus:border-blue-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ old('fecha_oficio_notificacion') }}">
                                    <label for="fecha_contrato" class="block text-sm font-semibold text-gray-700 text-center">Fecha*</label>
                                    <label id="error_fecha_contrato" class="hidden text-base font-normal text-red-500" >Ingrese una fecha de contrato valida</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-8 md:col-span-2 solo_contrato">
                            <label for="anticipo_porcentaje" class="block text-sm font-bold text-gray-700" >Porcentaje de anticipo*</label>
                            <div class="relative ">
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                  <span class="text-gray-700 text-base">
                                    %
                                  </span>
                                </div>
                                <input type="text" name="anticipo_porcentaje" id="anticipo_porcentaje" minlength="1" maxlength="5" class="pr-7  mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" placeholder="0">
                            </div>
                            <label id="error_anticipo_porcentaje" class="hidden text-base font-normal text-red-500" >Ingrese un porcentaje de anticipo valido</label>
                        </div>
                        <div class="col-span-8 md:col-span-2 solo_contrato">
                            <label  for="label_monto_anticipo" class="block text-sm font-bold text-gray-700">Monto anticipo:</label>
                            <input type="text" name="monto_anticipo" id="monto_anticipo" minlength="1" maxlength="5" class="hidden pr-7  mt-1 focus:ring-indigo-500 block w-full rounded-md border-none" placeholder="0">
                            <label id="label_monto_anticipo" class="block text-base font-medium text-gray-700 py-3 px-2">$ 0.00</label>
                        </div>
                        <div class="col-span-8 solo_contrato">
                            <label  for="contratista" class="block text-sm font-bold text-gray-700">Contratista*</label>
                            <select class="js-example-basic-single mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" name="contratista_id">
                                @foreach ($contratistas as $contratista)
                                    <option value="{{$contratista->id_contratista}}">{{$contratista->rfc}} - {{$contratista->razon_social}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                
                <div id="datos_generales" style="display: none;">
                    <h2 class="font-bold text-xl text-center">Datos generales de la obra</h2>
                    <hr>
                    <div class="grid grid-cols-8 gap-8 mt-10">
                        <div class="col-span-10 md:col-span-4">
                            <label  id="label_cliente_id" for="cliente_id" class="block text-sm font-bold text-gray-700">Municipio</label>
                            <label id="cliente_nombre" class="block text-base font-medium text-gray-700 py-3 px-2">{{$cliente->nombre}}</label>
                            <input type="text" name="cliente_id" id="cliente_id" class="hidden border-none block text-base font-medium text-gray-700 py-3 px-2" value="{{$cliente->id_cliente}}">
                        </div>
                        <div class="col-span-5 md:col-span-2">
                            <label id="label_ejercicio" for="label_ejercicio" class="block text-sm font-bold text-gray-700">Ejercicio</label>
                            <label class="block text-base font-medium text-gray-700 py-3 px-2">{{$anio}}</label>
                            <input type="text" name="ejercicio" id="ejercicio" class="hidden border-none block text-base font-medium text-gray-700 py-3 px-2" value="{{$anio}}">
                        </div>
                        <div class="col-span-5 md:col-span-2">
                            <label for="first_name" class="block text-sm  font-bold text-gray-700">Núm. de obra</label>
                            <label id="numero_obra" name="numero_obra" class="block text-base font-medium text-gray-700 py-3 px-2 ">{{str_pad($obras_count + 1,3,"0",STR_PAD_LEFT)}}</label>
                        </div>
                        <div class="col-span-10 md:col-span-5">
                            <label for="first_name" class="block text-sm font-bold text-gray-700">Nombre de la obra *</label>
                            <input type="text" name="nombre_obra" id="nombre_obra" maxlength="500" class="mt-1 focus:ring-blue-800 focus:border-blue-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required value="{{ old('nombre_obra') }}">
                            <label id="error_nombre_obra" name="error_nombre_obra" class="hidden text-base font-normal text-red-500" >Ingrese un nombre de obra correcto</label>  
                        </div>
                        <div class="col-span-10 md:col-span-3">
                            <label for="email_address" class="block text-sm font-bold text-gray-700">Nombre corto de la obra*</label>
                            <input type="text" maxlength="100" name="nombre_corto" id="nombre_corto" class="mt-1 focus:ring-blue-800 focus:border-blue-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ old('nombre_corto') }}">
                            <label id="error_nombre_corto" name="error_nombre_obra" class="hidden text-base font-normal text-red-500" >Ingrese un nombre corto de obra correcto</label>  
                        </div>
                        <div class="col-span-10 md:col-span-4">
                            <label class="block text-sm font-bold text-gray-700 text-center">Localidad</label>
                            <div class="grid grid-cols-4 gap-4">
                                <div class="col-span-2">
                                    <input type="text" name="nombre_localidad" id="nombre_localidad" maxlength="100" class="mt-1 focus:ring-blue-800 focus:border-blue-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ old('oficio_notificacion') }}">
                                    <label for="nombre_localidad" class="block text-sm font-semibold text-gray-700 text-center">Nombre*</label>
                                    <label id="error_nombre_localidad" class="hidden text-base font-normal text-red-500" >Ingrese un nombre de localidad correcto</label>  
                                </div>
                                <div class="col-span-2">
                                    <select id="tipo_localidad" name="tipo_localidad" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">                
                                        <option value="Zona rural">Poblado rural</option>
                                        <option value="Zona urbana">Zona urbana</option>
                                        <option value="Zona urbana">Colonia popular</option>
                                        <option value="Zona urbana">Zona indigena</option>
    
                                      </select>
                                    <label for="tipo_localidad" class="block text-sm font-semibold text-gray-700 text-center">Tipo*</label>
                                    <label id="error_nombre_corto" name="error_nombre_obra" class="hidden text-base font-normal text-red-500" >Ingrese un tipo de localidad correcto</label>  
                                </div>
                            </div>
                        </div>
                        <!--<div class="col-span-10 md:col-span-2">
                            <label for="modalidad_ejecucion" class="block text-sm font-bold text-gray-700">Modalidad de ejecución</label>
                            <div class="form-group">
                                
                                <input type="radio" value="1" checked id="contrato" name="modalidad_ejecucion">
                                <label for="contrato" class="text-base font-medium text-gray-700">Contrato</label>
                                <br>
                                <input type="radio" value="2" id="administracion" name="modalidad_ejecucion">
                                <label for="administracion" class="text-base font-medium text-gray-700">Administración Directa</label>
                            </div>
                        </div>-->
                        <!--<div class="col-span-10 md:col-span-2">
                            <label for="numero_contrato" class="block text-sm font-bold text-gray-700">Número de contrato*</label>
                            <input type="text" name="numero_contrato" id="numero_contrato" class="mt-1 focus:ring-blue-800 focus:border-blue-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ old('oficio_notificacion') }}">
                        </div>-->
                        
                        <div class="col-span-10 md:col-span-4">
                            <label for="situcion" class="block text-sm font-bold text-gray-700">Situación*</label>
                            <select id="situacion" name="situacion" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">                
                                <option value="Inicio">Inicio</option>
                                <option value="Inicio-Termino">Inicio/Termino</option>
                                <option value="Continuación">Continuación</option>
                                <option value="Termino">Termino</option>
                            </select>
                            <label id="error_situacion" class="hidden text-base font-normal text-red-500" >Ingrese una situación valida</label>
                        </div>
                        <div class="col-span-10 md:col-span-4">
                            <label for="oficio_notificacion" class="block text-sm font-bold text-gray-700 text-center">Oficio de notificación</label>
                            <div class="grid grid-cols-4 gap-4">
                                <div class="col-span-2">
                                    <input type="text" name="oficio_notificacion" id="oficio_notificacion" maxlength="40" class="mt-1 focus:ring-blue-800 focus:border-blue-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ old('oficio_notificacion') }}">
                                    <label for="oficio_notificacion" class="block text-sm font-semibold text-gray-700 text-center">Número*</label>
                                    <label id="error_oficio_notificacion" class="hidden text-base font-normal text-red-500" >Ingrese un número de oficio de notificación valido</label>
                                </div>
                                <div class="col-span-2">
                                    <input type="date" name="fecha_oficio_notificacion" id="fecha_oficio_notificacion" class="mt-1 focus:ring-blue-800 focus:border-blue-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ old('fecha_oficio_notificacion') }}">
                                    <label for="fecha_oficio_notificacion" class="block text-sm font-semibold text-gray-700 text-center">Fecha*</label>
                                    <label id="error_fecha_oficio_notificacion" class="hidden text-base font-normal text-red-500" >Ingrese una fecha de oficio de notificación valida</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-10 md:col-span-4">
                            <label for="ejecucion" class="block text-sm font-bold text-gray-700 text-center">Periodo de ejecución</label>
                            <div class="grid grid-cols-4 gap-4">
                                <div class="col-span-2">
                                    <input type="date" name="fecha_inicio" id="fecha_inicio" max="{{$anio}}-12-31" class="mt-1 focus:ring-blue-800 focus:border-blue-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ old('fecha_oficio_notificacion') }}">
                                    <label for="fecha_inicio" class="block text-sm font-semibold text-gray-700 text-center">Fecha de inicio*</label>
                                    <label id="error_fecha_inicio" class="hidden text-base font-normal text-red-500" >Ingrese una fecha de inicio valida</label>
                                </div>
                                <div class="col-span-2">
                                    <input type="date" name="fecha_fin" id="fecha_fin" min="{{$anio}}-01-01" max="{{$anio}}-12-31" class="mt-1 focus:ring-blue-800 focus:border-blue-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ old('fecha_oficio_notificacion') }}">
                                    <label for="fecha_fin" class="block text-sm font-semibold text-gray-700 text-center">Fecha de fin*</label>
                                    <label id="error_fecha_fin" class="hidden text-base font-normal text-red-500" >Ingrese una fecha final valida</label>
                                </div>
                            </div>
                        </div>
                        <!--<div class="col-span-2">
                            <label for="monto_contratado" class="block text-sm font-bold text-gray-700">Fuente de financiamiento*</label>
                            <input type="text" name="monto_contratado" id="monto_contratado" class="mt-1 focus:ring-blue-800 focus:border-blue-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ old('fecha_oficio_notificacion') }}">
                        </div>-->
                    </div>
                </div>

                <div id="actas_parte_social" style="display: none;">
                    <h2 class="font-bold text-xl text-center">Información de actas parte social</h2>
                    <hr>
                    <div class="grid grid-cols-8 gap-8 mt-10">
                        <div class="col-span-3">
                            <label  for="label_oficio_notificacion" class="block text-sm font-bold text-gray-700">Oficio de notificación</label>
                            <label id="label_oficio_notificacion" class="block text-base font-medium text-gray-700">Número: </label>
                            <label id="label_fecha_notificacion" class="block text-base font-medium text-gray-700">Fecha:</label>
                        </div>
                        
                            <div class="col-span-3">
                                @if($actas_preliminares != '')
                                    <label  class="block text-sm font-bold text-gray-700">Acta de integración del CDSM</label>
                                    <label  class="block text-base font-medium text-gray-700">{{$actas_preliminares->acta_integracion_consejo}} </label>
                                @endif
                            </div>
                            <div class="col-span-2">
                                @if($actas_preliminares != '')
                                    <label  for="cliente_id" class="block text-sm font-bold text-gray-700">Acta de priorización</label>
                                    <label  class="block text-base font-medium text-gray-700">{{$actas_preliminares->acta_integracion_consejo}} </label>
                                @endif
                            </div>
                        <div class="col-span-4 " id="div_acta_seleccion">
                            <label for="acta_seleccion" class="block text-sm font-bold text-gray-700">Acta de selección de obras*</label>
                            <input type="date" name="acta_seleccion" id="acta_seleccion" min="{{$anio}}-01-01" class="mt-1 focus:ring-blue-800 focus:border-blue-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ old('oficio_notificacion') }}">
                            <label id="error_acta_seleccion" class="hidden text-base font-normal text-red-500" >Ingrese una fecha valida</label>
                        </div>
                        <div class="col-span-4">
                            <label for="acta_integracion" class="block text-sm font-bold text-gray-700">Acta de integración del comité de obras*</label>
                            <input type="date" name="acta_integracion" id="acta_integracion" min="{{$anio}}-01-01" class="mt-1 focus:ring-blue-800 focus:border-blue-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ old('oficio_notificacion') }}">
                            <label id="error_acta_integracion" class="hidden text-base font-normal text-red-500" >Ingrese una fecha valida</label>
                        </div>
                        <div class="col-span-4">
                            <label for="convenio_concertacion" class="block text-sm font-bold text-gray-700">Convenio de concertación*</label>
                            <input type="date" name="convenio_concertacion" id="convenio_concertacion" min="{{$anio}}-01-01" class="mt-1 focus:ring-blue-800 focus:border-blue-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ old('oficio_notificacion') }}">
                            <label id="error_convenio_concertacion" class="hidden text-base font-normal text-red-500" >Ingrese una fecha valida</label>
                        </div>
                        <div class="col-span-4">
                            <label for="convenio_instancias" class="block text-sm font-bold text-gray-700">Convenio con instancias:</label>
                            <input type="date" name="convenio_instancias" id="convenio_instancias" min="{{$anio}}-01-01" class="text-black mt-1 focus:ring-blue-800 focus:border-blue-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ old('oficio_notificacion') }}">
                            <label id="error_convenio_instancias" class="hidden text-base font-normal text-red-500" >Ingrese una fecha valida</label>
                    </div>
                </div>
                
            </div>
            <!--footer-->
            <div class="mt-10 p-4 border-t border-solid border-blueGray-200 rounded-b">

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
    var divs = ["#div_fuente_financiamiento", "#modalidad_ejecucion", "#datos_generales",  "#actas_parte_social"];
    var primera_seccion = ["nombre_obra", "nombre_corto", "nombre_localidad", "tipo_localidad", "situacion", "oficio_notificacion", "fecha_oficio_notificacion", "fecha_inicio", "fecha_fin"];
    var segunda_seccion = ["contrato", "fecha_contrato", "anticipo_porcentaje"];
    var tercera_seccion = ["monto_contratado"];
    posicion = 0;
    fila = 0;
    i = 0;
    modalidad = 2;
    fondo_III = false;
    function hola(fuentes){
        seleccionado = $("#fuente_financiamiento option:selected").index();
        if(fuentes[seleccionado].sobrante_fondo > 0){
                    $("#saldo_fuente").removeClass("text-red-500");
                    $("#saldo_fuente").addClass("text-gray-700");
                    $("#div_ff").removeClass("hidden");
                    $("#btn_ff").removeClass("hidden");
                }else{
                    $("#saldo_fuente").removeClass("text-gray-700");
                    $("#saldo_fuente").addClass("text-red-500");
                    $("#div_ff").addClass("hidden");
                    $("#btn_ff").addClass("hidden");
                }
        valor = (""+ parseFloat(Math.round( fuentes[seleccionado].sobrante_fondo * 100) / 100).toFixed(2)).replace(/\D/g, "").replace(/([0-9])([0-9]{2})$/, '$1.$2').replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ",")
        $("#saldo_fuente").html("El monto restanter de este fondo es: $" + valor);
        $("#error_fuente_f").addClass("hidden");
        var texto = $("#fuente_financiamiento option:selected").text();
        //$("#error_fuente_f").removeClass("hidden");
        $("#example tr").find('td:eq(0)').each(function () {
            
            //obtenemos el codigo de la celda
            codigo = $(this).find("label").html();

              //comparamos para ver si el código es igual a la busqueda
              if(codigo==texto){

                   //aqui ya que tenemos el td que contiene el codigo utilizaremos parent para obtener el tr.
                   trDelResultado=$(this).parent();

                   //ya que tenemos el tr seleccionado ahora podemos navegar a las otras celdas con find
                   nombre=trDelResultado.find("td:eq(1)").html();
                   edad=trDelResultado.find("td:eq(2)").html();

                   //mostramos el resultado en el div
                   //$("#mostrarResultado").html("El nombre es: "+nombre+", la edad es: "+edad)

                   $("#fuente_existente").removeClass("hidden");

              }else{
                $(".label_error").addClass("hidden");
              }

       })
    };

    function ocultar() {
        error = false;
        
        
        
        if(posicion == 0) {
            total_obra = $("#monto_contratado").val().replaceAll(",", "");
            if(fila == 0){
                error = true;
                $("#error_fuente").removeClass("hidden");
            }
            
            for(var i=0; i<tercera_seccion.length; i++){
                value = $("#"+tercera_seccion[i]).val();
                if(value == ""){
                    $("#error_"+tercera_seccion[i]).removeClass("hidden");
                    error = true;
                }else{
                    $("#error_"+tercera_seccion[i]).addClass("hidden");
                }
            }

            if(total_obra != total){
                error = true;
                $("#monto_diferente").removeClass("hidden");
            }

            $("#example tr").find('td:eq(0)').each(function () {
                codigo = $(this).find("label").html();
                if(codigo == "Fondo III"){
                    $('#fecha_contrato').attr("min", '{{$actas_preliminares == ''?'':$actas_preliminares->acta_priorizacion}}');
                    fondo_III = true;
                    $("#div_acta_seleccion").removeClass("hidden");
                }else{
                    fondo_III = false;
                    $("#regresar").removeClass("hidden");
                    $('#fecha_contrato').attr("min", '{{$anio}}-01-01');
                    $("#div_acta_seleccion").addClass("hidden");
                }

            })
            $("#numero_fuentes").val(fila);
            

        }
        console.log(fondo_III);
        if(posicion == 1 && modalidad == 2) {
            for(var i=0; i<segunda_seccion.length; i++){
                value = $("#"+segunda_seccion[i]).val();
                console.log(segunda_seccion[i]+"--"+value+"--");
                if(value == ""){
                    $("#error_"+segunda_seccion[i]).removeClass("hidden");
                    error = true;
                }else{
                    $("#error_"+segunda_seccion[i]).addClass("hidden");
                }
            }

            $("#example tr").find('td:eq(0)').each(function () {
                codigo = $(this).find("label").html();
                $('#fecha_oficio_notificacion').attr("max", $("#fecha_contrato").val());
                $('#fecha_inicio').attr("min", $('#fecha_contrato').val());
                $('#fecha_fin').attr("min", $('#fecha_contrato').val());
                if(codigo == "Fondo III"){
                    $('#fecha_oficio_notificacion').attr("min", '{{$actas_preliminares == ''?'':$actas_preliminares->acta_priorizacion}}');
                }else{
                    $('#fecha_oficio_notificacion').attr("min", '{{$anio}}-01-01');
                }

            })
        }

        if(posicion == 1 && modalidad == 1) {
            $("#example tr").find('td:eq(0)').each(function () {
                codigo = $(this).find("label").html();
                $('#fecha_oficio_notificacion').attr("max", '{{$anio}}-12-31');
                if(codigo == "Fondo III"){
                    $('#fecha_inicio').attr("min", '{{$actas_preliminares == ''?'':$actas_preliminares->acta_priorizacion}}');
                    $('#fecha_fin').attr("min", '{{$actas_preliminares == ''?'':$actas_preliminares->acta_priorizacion}}');
                    $('#fecha_oficio_notificacion').attr("min", '{{$actas_preliminares == ''?'':$actas_preliminares->acta_priorizacion}}');
                }else{
                    $('#fecha_oficio_notificacion').attr("min", '{{$anio}}-01-01');
                    $('#fecha_inicio').attr("min", '{{$anio}}-01-01');
                    $('#fecha_fin').attr("min", '{{$anio}}-01-01');
                }

            })
        }
        if(posicion == 2) {
            for(var i=0; i<primera_seccion.length; i++){
                value = $("#"+primera_seccion[i]).val();
                console.log(value);
                if(value == ""){
                    $("#error_"+primera_seccion[i]).removeClass("hidden");
                    error = true;
                }else{
                    $("#error_"+primera_seccion[i]).addClass("hidden");
                }
            }

            $("#example tr").find('td:eq(0)').each(function () {
                codigo = $(this).find("input").val();
                if(codigo == "Fondo III"){
                    $('#acta_seleccion').attr("max", '{{$actas_preliminares == ''?'':$actas_preliminares->acta_priorizacion}}');
                    $('#acta_integracion').attr("max", '{{$actas_preliminares == ''?'':$actas_preliminares->acta_priorizacion}}');
                    $('#convenio_concertacion').attr("max", '{{$actas_preliminares == ''?'':$actas_preliminares->acta_priorizacion}}');
                    $('#convenio_instancias').attr("max", '{{$actas_preliminares == ''?'':$actas_preliminares->acta_priorizacion}}');
                }else{
                    $('#acta_seleccion').attr("max", '{{$anio}}-01-01');
                    $('#acta_integracion').attr("max", '{{$anio}}-01-01');
                    $('#convenio_concertacion').attr("max", '{{$anio}}-01-01');
                    $('#convenio_instancias').attr("max", '{{$anio}}-01-01');
                }

            })
        }
        
        
        if(!error){
            $(divs[posicion]).stop(true).slideUp("slow");
            $(divs[posicion + 1]).stop(true).slideDown("slow");
            posicion = posicion + 1;
            if(posicion == 3){
                $("#guardar_btn").removeClass("hidden");
                $("#ocultar_elemento").addClass("hidden");
            }
            
        }
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

    total = 0;

    function delete_row(id, valor){
        $("#fuente_table_"+id).remove();
        fila--;
        total = total - valor;
        console.log(total);
        total_str = (""+ total).replace(/([0-9])([0-9]{2})$/, '$1.$2').replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ",")
        $("#total_comprometido").text(total_str);
        $("#monto_mayor").addClass("hidden");
        if(fila == 0){
            $(".info-table").addClass("hidden");
        }
        $(".add_fIII").removeClass("hidden");

        
    }

    function addrow(fuentes){
        valor_registrado = $("#monto_fuente").val().replaceAll(",", "");
        total_obra = $("#monto_contratado").val().replaceAll(",", "");
        if(valor_registrado != ""){
            var table = document.getElementById("example_body");
            var row = table.insertRow(fila);
            row.setAttribute("id","fuente_table_"+fila);
            var texto = $("#fuente_financiamiento option:selected").text();
            seleccionado = $("#fuente_financiamiento option:selected").index();
            valor = fuentes[seleccionado].sobrante_fondo;
            encontradoResultado=false;
    
            //realizamos el recorrido solo por las celdas que contienen el código, que es la primera
            $("#example tr").find('td:eq(0)').each(function () {
                
                    //obtenemos el codigo de la celda
                    codigo = $(this).find("label").html();

                    //comparamos para ver si el código es igual a la busqueda
                    if(codigo==texto){
    
                        encontradoResultado=true;
    
                }
    
            })
            
            if(encontradoResultado == true){
                $("#error_fuente_f").removeClass("hidden");
            }else{
                if(valor_registrado > valor){
                    $("#monto_mayor").removeClass("hidden");
                }else{
                    total = total + parseFloat(valor_registrado);
                    

                    if(total_obra == total){
                        $(".add_fIII").addClass("hidden");
                    }
                    console.log(total_obra + "---" + total);
                    if(total > total_obra){
                        total = total - parseFloat(valor_registrado);
                        $("#monto_mayor_contratado").removeClass("hidden");
                    }else{
                        console.log(total);
                        if(total >= 1) {
                            monto_fuente = (""+ $("#monto_fuente").val()).replace(/([0-9])([0-9]{2})$/, '$1.$2').replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ",")
                            row.innerHTML = "<td><input type='text' name='fuente_financiamiento_"+fila+"' id='fuente_financiamiento_"+fila+"' class='hidden border-none block text-base font-medium text-gray-700' readonly value='"+$("#fuente_financiamiento option:selected").val()+"'>"+
                                                "<label class='border-none block text-base font-medium text-gray-700' >"+$("#fuente_financiamiento option:selected").text()+"</td>"+
                                            "<td><input type='text' name='monto_fuente_"+fila+"' id='monto_fuente_"+fila+"' class='border-none block text-base font-medium text-gray-700' readonly value='$ "+monto_fuente+"'></td>"+
                                            "<td><button type='button' class='bg-white text-sm text-red-500 font-normal text-ms p-2 rounded rounded-lg' onclick='delete_row("+fila+","+valor_registrado+")'>Eliminar</button></td>";
                            $("#monto_fuente").val("");
                            $(".info-table ").removeClass("hidden");
                            fila++;                
                            total_str = (""+ total).replace(/([0-9])([0-9]{2})$/, '$1.$2').replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ",")
                            $("#total_comprometido").text(total_str);
                            $("#error_monto_fuente").addClass("hidden");
                        }else{
                            $("#error_monto_fuente").removeClass("hidden");
                        }
                        
                    }
                }
            }
        }else{
            $("#error_monto_fuente").removeClass("hidden");
        }
        

    }
    $(document).ready(function() {
        $(".obra_fIII").addClass("hidden");
        
        $("#monto_proyectado").on({
          
          "focus": function(event) {
              $(event.target).select();
          },
          "keyup": function(event) {
            $(event.target).val(function(index, value) {
                return value.replace(/\D/g, "")
                    .replace(/([0-9])([0-9]{2})$/, '$1.$2')
                    .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ",");
            });
          },
          
        });
        $("#monto_fuente").on({
          
          "focus": function(event) {
              $(event.target).select();
          },
          "keyup": function(event) {
            $("#monto_mayor").addClass("hidden");
            $("#monto_mayor_contratado").addClass("hidden");
            $(event.target).val(function(index, value) {
                return value.replace(/\D/g, "")
                    .replace(/([0-9])([0-9]{2})$/, '$1.$2')
                    .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ",");
            });
            $("#label_error").addClass("hidden");
          },
          
        });

        $("#contrato").on({
            "keydown": function(event) {
                capturado = $(this).val();
                
                if(capturado.length > 40 || event.keyCode == 32){
                    return false;
                }
            },
        });

        $("#nombre_obra").on({
            "keydown": function(event) {
                capturado = $(this).val();
                if(capturado.length > 500){
                    return false;
                }
            },
        });

        $("#nombre_corto").on({
            "keydown": function(event) {
                capturado = $(this).val();
                if(capturado.length > 100){
                    return false;
                }
            },
        });

        $("#oficio_notificacion").on({
            "keydown": function(event) {
                capturado = $(this).val();
                console.log(event.keyCode);
                if(capturado.length > 40  || event.keyCode == 32){
                    return false;
                }
            },
        });

        $("#nombre_localidad").on({
            "keydown": function(event) {
                capturado = $(this).val();
                if(capturado.length > 100){
                    return false;
                }
            },
        });

        $('.js-example-basic-single').select2();
        $("#modalidad_ejecucion").hide();
        const formato = new Intl.NumberFormat('es-MX', {
            maximumFractionDigits: 2
        });
        $("#monto_contratado").on({
            "focus": function(event) {
                $(event.target).select();
            },
            "keyup": function(event) {
                $(event.target).val(function(index, value) {
                    return value.replace(/\D/g, "")
                        .replace(/([0-9])([0-9]{2})$/, '$1.$2')
                        .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ",");
                });
                $("#label_monto_contratado").html("$ "+$(this).val());
                $(".label_error").addClass("hidden");

                for(var x = 0; x < fila; x++){
                    delete_row(x,0);
                    total = 0;
                    $("#total_comprometido").text("0.00");
                    
                }

                valor_contratado = $(this).val().replaceAll(",", "");

                if(valor_contratado > 0)
                    $(".obra_fIII").removeClass("hidden");
                else
                    $(".obra_fIII").addClass("hidden");
                
                valor = $("#anticipo_porcentaje").val();
                if(valor != "") {
                    valor = valor * 0.01;
                    monto = $("#monto_contratado").val().replaceAll(",", "");
                    monto_valor = monto * valor;
                    monto_valor = parseFloat(monto_valor).toFixed(2)

                    $("#label_monto_anticipo").html("$ "+  (""+ monto_valor).replace(/\D/g, "").replace(/([0-9])([0-9]{2})$/, '$1.$2').replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ","));
                    $("#monto_anticipo").val((""+ monto_valor).replace(/\D/g, "").replace(/([0-9])([0-9]{2})$/, '$1.$2').replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ","));
                }
            }
        });

        function round(num, decimales = 2) {
            var signo = (num >= 0 ? 1 : -1);
            num = num * signo;
            if (decimales === 0) //con 0 decimales
                return signo * Math.round(num);
            // round(x * 10 ^ decimales)
            num = num.toString().split('e');
            num = Math.round(+(num[0] + 'e' + (num[1] ? (+num[1] + decimales) : decimales)));
            // x * 10 ^ (-decimales)
            num = num.toString().split('e');
            return signo * (num[0] + 'e' + (num[1] ? (+num[1] - decimales) : -decimales));
        }
        
        $("#anticipo_porcentaje").on({
            "keyup": function(event) {
                /*$(event.target).val(function(index, value) {
                    return value.replace(/\D/g, "")
                        .replace(/([0-9])([0-9]{2})$/, '$1.$2')
                        .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ",");
                });*/
                $(event.target).val(function(index, value) {
                    if(value > 50)
                        return "50.00";
                    else
                        return value;
                });

                valor = $(this).val() * 0.01;
                monto = $("#monto_contratado").val().replaceAll(",", "");
                monto_valor = monto * valor;
                monto_valor = parseFloat(monto_valor).toFixed(2)

                $("#label_monto_anticipo").html("$ "+  (""+ monto_valor).replace(/\D/g, "").replace(/([0-9])([0-9]{2})$/, '$1.$2').replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ","));
                $("#monto_anticipo").val((""+ monto_valor).replace(/\D/g, "").replace(/([0-9])([0-9]{2})$/, '$1.$2').replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ","));

                

                
                
            }
        });

        $("input[name='modalidad_ejecucion']").change(function() {
            modalidad = $("input[name='modalidad_ejecucion']:checked").val();
            if(modalidad == 1){
                $(".solo_contrato").addClass("hidden");
            }else{
                $(".solo_contrato").removeClass("hidden");
            }
        }); 

        $('#fecha_inicio').change(function() {
            fecha = new Date($(this).val());
            fecha.setDate(fecha.getDate() + 1);
            if($(this).val() != '{{$anio}}-12-31') {
                fecha.setDate(fecha.getDate() + 1);
            }
            const mes = fecha.getMonth() + 1; // Ya que los meses los cuenta desde el 0
            const dia = fecha.getDate();
            fecha = fecha.getFullYear()+'-'+(mes< 10?'0':'')+mes+'-'+(dia < 10 ? '0' : '')+dia;
            $("#fecha_fin").attr("min", fecha);
        });

        $('#fecha_fin').change(function() {
            fecha = new Date($(this).val());
            
            const mes = fecha.getMonth() + 1; // Ya que los meses los cuenta desde el 0
            const dia = fecha.getDate();
            fecha = fecha.getFullYear()+'-'+(mes< 10?'0':'')+mes+'-'+(dia < 10 ? '0' : '')+dia;
            $("#fecha_inicio").attr("max", fecha);
        });

        $('#fecha_oficio_notificacion').change(function() {
            if(modalidad == 1){
                fecha = new Date($(this).val());
                const mes = fecha.getMonth() + 1; // Ya que los meses los cuenta desde el 0
                const dia = fecha.getDate() + 2;
                fecha = fecha.getFullYear()+'-'+(mes< 10?'0':'')+mes+'-'+(dia < 10 ? '0' : '')+dia;
                $("#fecha_inicio").attr("min", fecha);
            }
        });

        $('#oficio_notificacion').bind('input', function() { 
            $("#label_oficio_notificacion").html("Número: "+$(this).val());
            
        });
        $('#fecha_oficio_notificacion').bind('input', function() {
            $("#label_fecha_notificacion").html("Fecha: "+$(this).val());
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

        

        function mostrar() {
            var x = $("#datos_generales");
            x.stop(true, true).slideDown("slow");
        }

        if ($('#logo_text').val() == "") {
            $('#preViewImg').addClass('hidden');
        }

        $(document).on('change', '#file', function() {
            readURL(this);
        });

        $("#formulario").validate({
            onfocusout: false,
            onclick: false,
            rules: {
                acta_integracion: { required: true},
                convenio_concertacion: { required: true},
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

        $("#guardar_btn").click(function () {
            console.log("hola mundo");
            fecha_seleccion = $("#acta_seleccion").val();
            if(fondo_III && fecha_seleccion == ''){
                $("#error_acta_seleccion").removeClass("hidden");
                return false;
            }else{
                $("#error_acta_seleccion").addClass("hidden");
                return true;
            }
        });

        
        
    });
</script>
@endsection