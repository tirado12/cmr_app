@extends('layouts.plantilla')
@section('title','Editar Fuente financiamiento')
@section('contenido')


<div class="flex flex-row mb-4">
<svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
</svg>
<h1 class="font-bold text-xl ml-2">Editar Fuente financiamiento</h1>
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
      
      <div class="mt-5 md:mt-0 md:col-span-2">
        <form action="{{ route('fuenteCliente.update', $fuenteCliente) }}" onsubmit="return validarForm();" method="POST" id="formulario" name="formulario">
          @csrf
          @method('PUT')
          <div class="shadow overflow-hidden sm:rounded-md">
            <div class="px-4 py-5 bg-white sm:p-6"> 
              <div class="grid grid-cols-10 gap-6">

                <div class="col-span-7 lg:col-span-3">
                  <label for="first_name" class="block text-sm font-medium text-gray-700">Cliente</label>
                  <label id="label_cliente" class="block text-base bg-gray-100 font-medium text-gray-700 py-3 px-2 border rounded-md">{{ $cliente[0]->nombre }}</label>
                </div>

                <div class="col-span-4 lg:col-span-3">
                  <label for="periodo" class="block text-sm font-medium text-gray-700">Periodo</label>
                  <label id="label_periodo" class="block text-base bg-gray-100 font-medium text-gray-700 py-3 px-2 border rounded-md">{{ $cliente[0]->anio_inicio.' - '.$cliente[0]->anio_fin }}</label>
                </div>

                <div class="col-span-4 lg:col-span-3">
                  <label for="ejercicio" class="block text-sm font-medium text-gray-700">Ejercicio</label>
                  @role('Administrador')
                  <input type="number" name="ejercicio" id="ejercicio" class="mt-1 text-base focus:ring-indigo-500 block text-gray-700 w-full shadow-sm border-gray-300 rounded-md" value="{{ $fuenteCliente->ejercicio }}" required>
                  <label id="error_ejercicio" name="error_ejercicio" class="hidden text-base font-normal text-red-500" >Introduzca un ejercicio valido</label>
                  @endrole
                  @role('Usuario')
                  <input type="number" name="ejercicio" id="ejercicio" class="mt-1 text-base bg-gray-100 focus:ring-indigo-500 block text-gray-700 w-full shadow-sm border-gray-300 rounded-md" value="{{ $fuenteCliente->ejercicio }}" readonly>
                  @endrole
                </div>
  
                <div class="col-span-10 lg:col-span-3">
                  <label id="label_monto_proyectado" for="monto_proyectado" class="block text-sm font-medium text-gray-700">Monto proyectado *</label>
                  <div class="relative ">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                      <span class="text-gray-700 text-base">
                        $
                      </span>
                    </div>
                    <input type="text" name="monto_proyectado" id="monto_proyectado" class="pl-7 mt-1 text-base focus:ring-indigo-500 block text-gray-700 w-full shadow-sm border-gray-300 rounded-md myDIV" value="{{($fuenteCliente->monto_proyectado)}}" onclick="" >
                  </div>
                  <label id="error_monto_proyectado" name="error_monto_proyectado" class="hidden text-base font-normal text-red-500" >Introduzca un monto proyectado</label>
                  
                </div>
                
                <div class="col-span-10 lg:col-span-3">
                    <label id="label_monto_comprometido" for="monto_comprometido" class="block text-sm font-medium text-gray-700">Monto comprometido *</label>
                    <div class="relative ">
                      <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <span class="text-gray-700 text-base">
                          $
                        </span>
                      </div>
                      <input type="text" name="monto_comprometido" id="monto_comprometido" class="pl-7 mt-1 text-base bg-gray-100 border-gray-300 border rounded-md block text-gray-700 w-full  myDIV"  value="{{($fuenteCliente->monto_comprometido)}}" onclick="" readonly>
                    </div>
                </div>
                
                {{-- @if($fuenteCliente->fuente_financiamiento_id == 2) --}}
               

                <!--<div class="col-span-10 lg:col-span-2">
                    <label id="label_acta_integracion_consejo" for="acta_integracion_consejo" class="block text-sm font-medium text-gray-700">Acta de integracion de consejo *</label>
                    <input type="date" name="acta_integracion_consejo" id="acta_integracion_consejo" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ $fuenteCliente->acta_integracion_consejo }}">
                    <label id="error_acta_integracion_consejo" name="error_acta_integracion_consejo" class="hidden text-base font-normal text-red-500" >Introduzca una fecha</label>
                </div>
                
                <div class="col-span-10 lg:col-span-2">
                    <label id="label_acta_priorizacion" for="acta_priorizacion" class="block text-sm font-medium text-gray-700">Acta priorización *</label>
                    <input type="date" name="acta_priorizacion" id="acta_priorizacion" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ $fuenteCliente->acta_priorizacion }}">
                    <label id="error_acta_priorizacion" name="error_acta_priorizacion" class="hidden text-base font-normal text-red-500" >Introduzca una fecha</label>
                </div>

                <div class="col-span-10 lg:col-span-2">
                    <label id="label_adendum_priorizacion" for="adendum_priorizacion" class="block text-sm font-medium text-gray-700">Adendum priorización *</label>
                    <input type="date" name="adendum_priorizacion" id="adendum_priorizacion" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ $fuenteCliente->adendum_priorizacion }}">
                    <label id="error_adendum_priorizacion" name="error_adendum_priorizacion" class="hidden text-base font-normal text-red-500" >Introduzca una fecha</label>
                </div> -->
                {{-- @endif --}}

                <div class="col-span-10 lg:col-span-3">
                    <label id="label_fuente_financiamiento_id" for="fuente_financiamiento_id" class="block text-sm font-medium text-gray-700">Fuente de financiamiento *</label>
                    <select id="fuente_financiamiento_id" name="fuente_financiamiento_id" onchange="validarFuente()" class="clickable mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" >                
                      @role('Administrador')
                        @foreach($fuentes as $fuente)
                          <option value="{{ $fuente->id_fuente_financiamiento }}" {{ ($fuente->id_fuente_financiamiento == $fuenteCliente->fuente_financiamiento_id) ? 'selected' : '' }} > {{ $fuente->nombre_corto }} </option>
                        @endforeach
                      @endrole
                      @role('Usuario')
                        <option value="{{ $fuenteCliente->fuente_financiamiento_id }}" selected> {{ $fuentes->where('id_fuente_financiamiento', $fuenteCliente->fuente_financiamiento_id )->first()->nombre_corto}}</option>
                      @endrole
                    </select>
                    <label id="error_fuente_financiamiento_id" name="error_fuente_financiamiento_id" class="hidden text-base font-normal text-red-500" >Se requiere una opción</label>
                </div>

                <!--<div class="col-span-10 lg:col-span-2">
                  {{-- @if($fuenteCliente->fuente_financiamiento_id == 2) --}}
                    <div>
                      <label for="cbox2" class="text-sm font-medium text-gray-700"><input type="checkbox" id="prodim" name="prodim" {{ ($fuenteCliente->prodim == 1) ? 'checked' : '' }}> PRODIMDF</label><br>
                      <label for="cbox2" class="text-sm font-medium text-gray-700"><input type="checkbox" id="gastos_indirectos" name="gastos_indirectos" {{ ($fuenteCliente->gastos_indirectos == 1) ? 'checked' : '' }}> Gastos indirectos</label>
                    </div>
                  {{-- @endif --}}
                    
                </div>-->
                <div class="col-span-10">
                  <label id="error_monto" name="error_monto" class="hidden w-full text-base font-normal text-red-500" >El monto proyectado debe ser mayor o igual al comprometido</label>
                </div>

              </div>
              @if($fuenteCliente->fuente_financiamiento_id == 2)
              <div class="hidden relative p-6 flex-auto" id="anexos">
                <div class=" alert flex flex-row items-center justify-center bg-gray-100 p-2 mt-4 mb-4 shadow " id="titulo_anexo">
                  <div class="alert-content ml-4">
                  <p class="font-bold sm:text-sm">Anexos</p>
                  </div>
                </div>
                
                <div class="flex flex-col-2 justify-center mb-2" >
                  <div class="flex flex-row  p-2">
                      <label id="label_ejercicio" for="label_ejercicio" class="ml-6 text-sm font-medium text-gray-700 ">Prodim </label>
                      <input type="checkbox" name="prodim" id="prodim" class="ml-2 shadow-sm sm:text-sm border-gray-300 rounded h-6 w-6" {{ ($fuenteAnexos->prodim == 1) ? 'checked' : '' }}>
                  </div>
                  <div class="flex flex-row  p-2">
                    <label id="label_gastos_indirectos" for="label_gastos_indirectos" class="ml-6 text-sm font-medium text-gray-700 ">Gastos indirectos</label>
                    <input type="checkbox" name="gastos_indirectos" id="gastos_indirectos" class="ml-2 shadow-sm sm:text-sm border-gray-300 rounded h-6 w-6" {{ ($fuenteAnexos->gastos_indirectos == 1) ? 'checked' : '' }}>
                  </div>
                </div>

                <div class=" grid grid-cols-6 gap-4 mb-4" id="div_porcentajes">
                  <div class="col-span-3">
                    <div class="" id="div_porcentaje_prodim">
                      <label id="label_porcentaje_prodim" for="porcentaje_prodim" class="block text-sm font-medium text-gray-700">Porcentaje prodim *</label>
                      <div class="relative ">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                          <span class="text-gray-500 sm:text-sm">
                            % 
                          </span>
                        </div>
                        <input type="text" name="porcentaje_prodim" id="porcentaje_prodim" maxlength="3"  class="pl-7 mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" placeholder="0" value="{{$fuenteAnexos->porcentaje_prodim}}">
                      </div>
                      <label id="error_porcentaje_prodim" class="hidden block text-md text-red-500">Se require de un porcentaje (max %2)</label>
                      <label for="" id="proyectado_prodim" class="hidden block text-md"></label>
                    </div>
                  </div>
                  
                  <div class="col-span-3">
                    <div class="" id="div_porcentaje_gastos">
                      <label id="label_porcentaje_gastos" for="porcentaje_gastos" class="block text-sm font-medium text-gray-700">Porcentaje gastos indirectos *</label>
                      <div class="relative ">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                          <span class="text-gray-500 sm:text-sm">
                            %
                          </span>
                        </div>
                        <input type="text" name="porcentaje_gastos" id="porcentaje_gastos" maxlength="3" class="pl-7 mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" placeholder="0" value="{{$fuenteAnexos->porcentaje_gastos}}">
                      </div>
                      <label id="error_porcentaje_gastos" class="hidden block text-md text-red-500">Se require de un porcentaje (max %3)</label>
                      <label for="" id="proyectado_gastos" class="hidden block text-md"></label>
                    </div>
                  </div>

                  <div class="col-span-3">
                    <div class="hidden" id="div_monto_prodim">
                    <label id="label_monto_prodim" for="monto_prodim" class="block text-sm font-medium text-gray-700">Monto PRODIMDF *</label>
                    <div class="relative ">
                      <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <span class="text-gray-500 sm:text-sm">
                          $
                        </span>
                      </div>
                      <input type="text" name="monto_prodim" id="monto_prodim" class="pl-7 mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" placeholder="0.00">
                    </div>
                    <label id="error_monto_prodim" name="error_monto_prodim" class="hidden text-base font-normal text-red-500" >Por favor ingresar una cantidad</label>
                    </div>
                  </div>
    
                  <div class="col-span-3">
                    <div class="hidden" id="div_monto_gastos">
                    <label id="label_monto_gastos" for="monto_gastos" class="block text-sm font-medium text-gray-700">Monto Gastos Indirectos *</label>
                    <div class="relative ">
                      <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <span class="text-gray-500 sm:text-sm">
                          $
                        </span>
                      </div>
                      <input type="text" name="monto_gastos" id="monto_gastos" class="pl-7 mt-1 focus:ring-indigo-500 focus:border-indigo-500 block  w-full shadow-sm sm:text-sm border-gray-300 rounded-md" placeholder="0.00">
                    </div>
                    <label id="error_monto_comprometido" name="error_monto_comprometido" class="hidden text-base font-normal text-red-500" >Por favor ingresar una cantidad</label>
                    </div>
                  </div>
    
                </div>
             
                <div class="grid grid-cols-6 gap-4">
    
                  <div class="col-span-2">
                    <label id="label_ejercicio" for="acta_integracion" class="block text-sm font-medium text-gray-700">Acta integración *</label>
                    <input type="date" name="acta_integracion" id="acta_integracion" minlength="4" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ $fuenteAnexos->acta_integracion_consejo }}">
                    <label id="error_acta_integracion" class="hidden block text-md text-red-500">Se require de una fecha</label>
                  </div>
                
                  <div class="col-span-2">
                    <label id="label_acta_priorizacion" for="acta_priorizacion" class="block text-sm font-medium text-gray-700">Acta priorización *</label>
                    <input type="date" name="acta_priorizacion" id="acta_priorizacion" minlength="4" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ $fuenteAnexos->acta_priorizacion }}">
                    <label id="error_acta_priorizacion" class="hidden block text-md text-red-500">Se require de una fecha</label>
                  </div>
    
                  <div class="col-span-2">
                    <label id="label_adendum" for="adendum" class="block text-sm font-medium text-gray-700">Adendum priorización </label>
                    <input type="date" name="adendum" id="adendum" minlength="4" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ $fuenteAnexos->adendum_priorizacion }}" >
                    
                  </div>
    
                </div>
             </div>
             @else 
             <div class="hidden relative p-6 flex-auto" id="anexos">
              <div class=" alert flex flex-row items-center justify-center bg-gray-100 p-2 mt-4 mb-4 shadow " id="titulo_anexo">
                <div class="alert-content ml-4">
                <p class="font-bold sm:text-sm">Anexos</p>
                </div>
              </div>
            
              <div class="flex flex-col-2 justify-center " >
                <div class="flex flex-row  p-2">
                    <label id="label_prodim" for="prodim" class="ml-6 text-sm font-medium text-gray-700 ">PRODIMDF </label>
                    <input type="checkbox" name="prodim" id="prodim" class="ml-2 shadow-sm sm:text-sm border-gray-300 rounded h-6 w-6" >
                </div>
                <div class="flex flex-row  p-2">
                  <label id="label_gastos_indirectos" for="label_gastos_indirectos" class="ml-6 text-sm font-medium text-gray-700 ">Gastos indirectos</label>
                  <input type="checkbox" name="gastos_indirectos" id="gastos_indirectos" class="ml-2 shadow-sm sm:text-sm border-gray-300 rounded h-6 w-6" >
                </div>
              </div>

              <div class=" grid grid-cols-6 gap-4 mb-4" id="div_porcentajes">
                <div class="col-span-3">
                  <div class="hidden" id="div_porcentaje_prodim">
                    <label id="label_porcentaje_prodim" for="porcentaje_prodim" class="block text-sm font-medium text-gray-700">Porcentaje PRODIMDF *</label>
                    <div class="relative ">
                      <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <span class="text-gray-500 sm:text-sm">
                          % 
                        </span>
                      </div>
                      <input type="text" name="porcentaje_prodim" id="porcentaje_prodim" maxlength="3" class="pl-7 mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" placeholder="0" >
                    </div>
                    <label id="error_porcentaje_prodim" class="hidden block text-md text-red-500">Se require de un porcentaje (max %2)</label>
                    <label for="" id="proyectado_prodim" class="hidden block text-md"></label>
                  </div>
                </div>
                
                <div class="col-span-3">
                  <div class="hidden" id="div_porcentaje_gastos">
                    <label id="label_porcentaje_gastos" for="porcentaje_gastos" class="block text-sm font-medium text-gray-700">Porcentaje gastos indirectos *</label>
                    <div class="relative ">
                      <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <span class="text-gray-500 sm:text-sm">
                          %
                        </span>
                      </div>
                      <input type="text" name="porcentaje_gastos" id="porcentaje_gastos" maxlength="3" class="pl-7 mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" placeholder="0">
                    </div>
                    <label id="error_porcentaje_gastos" class="hidden block text-md text-red-500">Se require de un porcentaje (max %3)</label>
                    <label for="" id="proyectado_gastos" class="hidden block text-md"></label>
                  </div>
                </div>
  
              </div>
           
              <div class="grid grid-cols-6 gap-4">
  
                <div class="col-span-2">
                  <label id="label_ejercicio" for="acta_integracion" class="block text-sm font-medium text-gray-700">Acta integración *</label>
                  <input type="date" name="acta_integracion" id="acta_integracion" minlength="4" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" >
                  <label id="error_acta_integracion" class="hidden block text-md text-red-500">Se require de una fecha</label>
                </div>
              
                <div class="col-span-2">
                  <label id="label_acta_priorizacion" for="acta_priorizacion" class="block text-sm font-medium text-gray-700">Acta priorización *</label>
                  <input type="date" name="acta_priorizacion" id="acta_priorizacion" minlength="4" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" >
                  <label id="error_acta_priorizacion" class="hidden block text-md text-red-500">Se require de una fecha</label>
                </div>
  
                <div class="col-span-2">
                  <label id="label_adendum" for="adendum" class="block text-sm font-medium text-gray-700">Adendum priorización </label>
                  <input type="date" name="adendum" id="adendum" minlength="4" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"  >
                  
                </div>
  
              </div>
           </div>

             @endif

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
            <div class="px-4 py-3 bg-gray-100 sm:px-6">
              <span class="block text-xs">Porfavor verifique que todos los campos marcados con ( * ) esten rellenados</span>
              <div class="text-right">
                <a type="button" href="{{redirect()->getUrlGenerator()->previous()}}" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-gray-500 hover:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                  Regresar
                </a>
                <button type="submit" id="enviar_datos" class="ml-4 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-orange-800 hover:bg-orange-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                  Guardar
                </button>
              
              </div>
            </div>
          </div>
        </form>
      </div>
      
</div>

  <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>    
  <script>
    
    window.onload =function(){
    if($('#fuente_financiamiento_id').val() == '2'){
      $('#titulo_anexo').removeClass('hidden');
      $('#anexos').removeClass('hidden');
      valor_comprometido= $("#monto_comprometido").val();
      $("#monto_comprometido").val(moneda(parseFloat(valor_comprometido).toFixed(2)));
      valor_proyectado = $("#monto_proyectado").val();
      $("#monto_proyectado").val(moneda(parseFloat(valor_proyectado).toFixed(2)));

      if(document.getElementById('prodim').checked == true){ //check seleccionado
        $('#div_porcentaje_prodim').removeClass('hidden');
        $('#proyectado_prodim').removeClass('hidden');
        monto_proyectado = $('#monto_proyectado').val();
        monto_proyectado = parseFloat(monto_proyectado.replaceAll(',',''));
        porcentaje_prodim = parseFloat($('#porcentaje_prodim').val());
        resultado = parseFloat(monto_proyectado * (porcentaje_prodim/100)).toFixed(2);
        $('#proyectado_prodim').text('monto correspondiente al '+porcentaje_prodim+ '%: $'+resultado);
      }else{
        $('#div_porcentaje_prodim').addClass('hidden');
      }

      if(document.getElementById('gastos_indirectos').checked == true){ //check seleccionado
        $('#div_porcentaje_gastos').removeClass('hidden');
        monto_proyectado = $('#monto_proyectado').val();
      monto_proyectado = parseFloat(monto_proyectado.replaceAll(',',''));
      porcentaje_gastos = parseFloat($('#porcentaje_gastos').val());
      resul = parseFloat(monto_proyectado * (porcentaje_gastos/100)).toFixed(2);
        $('#proyectado_gastos').removeClass('hidden');
        $('#proyectado_gastos').text('monto correspondiente al '+porcentaje_gastos+ '%: $'+resul);
      }else{
        $('#div_porcentaje_gastos').addClass('hidden');
      }

      $('#titulo_anexo').removeClass('hidden');
      $('#anexos').removeClass('hidden');
      $('#acta_integracion').attr('required',true);
      $('#acta_priorizacion').attr('required',true);


    }else{
      $('#titulo_anexo').addClass('hidden');
      $('#anexos').addClass('hidden');
      valor_comprometido= $("#monto_comprometido").val();
      $("#monto_comprometido").val(parseFloat(valor_comprometido).toFixed(2));
      valor_proyectado = $("#monto_proyectado").val();
      $("#monto_proyectado").val(parseFloat(valor_proyectado).toFixed(2));
      $('#titulo_anexo').addClass('hidden');
    $('#anexos').addClass('hidden');
    $('#acta_integracion').removeAttr('required');
    $('#acta_priorizacion').removeAttr('required');
    }
    //=================================================
    montoComprometido = $('#monto_comprometido').val();
    monto_comprometido = parseFloat(montoComprometido.replaceAll(',',''));
 $('#porcentaje_prodim, #monto_proyectado, #porcentaje_gastos').on('keyup',function(e){
  setTimeout(function() {
    $('#proyectado_prodim').text('');
    $('#anterior_comprometido').val(montoComprometido); //monto comprometido actual

    if($('#porcentaje_prodim').val()!='' && $('#monto_proyectado').val()!=''){
      monto_proyectado = $('#monto_proyectado').val();
      monto_proyectado = parseFloat(monto_proyectado.replaceAll(',',''));
      
      porcentaje_prodim = parseFloat($('#porcentaje_prodim').val());
      resultado = parseFloat(monto_proyectado * (porcentaje_prodim/100)).toFixed(2);
        $('#proyectado_prodim').removeClass('hidden');
        $('#proyectado_prodim').text('monto correspondiente al '+porcentaje_prodim+ '%: $'+resultado);
        // resultado = parseFloat(resultado);
        //   nuevoComprometido = resultado+monto_comprometido;
        //   nuevoComprometido = parseFloat(nuevoComprometido).toFixed(2);
        //   $('#monto_comprometido').val(nuevoComprometido)
      
    }else{
         $('#proyectado_prodim').addClass('hidden');
         $('#monto_comprometido').val(montoComprometido);
    }

    if($('#porcentaje_gastos').val()!='' && $('#monto_proyectado').val()!='' ){
      monto_proyectado = $('#monto_proyectado').val();
      monto_proyectado = parseFloat(monto_proyectado.replaceAll(',',''));
      porcentaje_gastos = parseFloat($('#porcentaje_gastos').val());
      resul = parseFloat(monto_proyectado * (porcentaje_gastos/100)).toFixed(2);
        $('#proyectado_gastos').removeClass('hidden');
        $('#comprometido_prodim').removeClass('hidden');
        $('#proyectado_gastos').text('monto correspondiente al '+porcentaje_gastos+ '%: $'+resul);
        // resultado = parseFloat(resultado);
        //   nuevoComprometido = resultado+monto_comprometido;
        //   nuevoComprometido = parseFloat(nuevoComprometido).toFixed(2);
        //   $('#monto_comprometido').val(nuevoComprometido)
      
    }else{
         $('#proyectado_gastos').addClass('hidden');
         //$('#monto_comprometido').val(montoComprometido);
    }


  },1);
 });
    //=================================================
    periodo = $('#label_periodo').text();
    anioMin=periodo.substring(0,4);
    anioMax=periodo.substring(7,11);
    $('#ejercicio').attr('min',anioMin);
    $('#ejercicio').attr('max',anioMax);
    //=================================================
    function moneda(valor){
      return valor.replace(/\D/g, "").replace(/([0-9])([0-9]{2})$/, '$1.$2').replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ",");
    }
    //=================================================
    var anio = $('#ejercicio').val();
    //console.log(anio)
   var fechaMin = anio+'-01'+'-01';
   var fechaMax = anio+'-12'+'-31';
   $('#acta_integracion').attr('min',fechaMin);
  $('#acta_integracion').attr('max',fechaMax);
  $('#acta_priorizacion').attr('min',fechaMin);
  $('#acta_priorizacion').attr('max',fechaMax);
  $('#adendum').attr('min',fechaMin);
  $('#adendum').attr('max',fechaMax);
//=================================================
  // var proyectado = parseFloat($('#monto_proyectado').val());
  // var comprometido = parseFloat($('#monto_comprometido').val());
  // //console.log(proyectado)
  // if(proyectado<comprometido)
  //   $('#error_monto_mayor').removeClass('hidden');
  // else
  //   $('#error_monto_mayor').addClass('hidden');
  }

  function validarForm(){ //validacion del formulario
 band = true;
  
  fuente= document.forms["formulario"]["fuente_financiamiento_id"].value;
  ejercicio= document.forms["formulario"]["ejercicio"].value;
  monto_proyectado = document.forms["formulario"]["monto_proyectado"].value;
  
  if(fuente == ""){
    $('#error_fuente_financiamiento_id').removeClass('hidden');  
    band= false;
  }else{
    $('#error_fuente_financiamiento_id').addClass('hidden');
  }

  if(ejercicio == ""){
    $('#error_ejercicio').removeClass('hidden');  
    band= false;
  }else{
    $('#error_ejercicio').addClass('hidden');
  }

  if(monto_proyectado == ""){
    $('#error_monto_proyectado').removeClass('hidden');  
    band= false;
  }else{
    $('#error_monto_proyectado').addClass('hidden');
  }

  if(fuente == 2){
    prodim = document.getElementById("prodim").checked;
    if(prodim == true){
      porcentaje_prodim= document.forms["formulario"]["porcentaje_prodim"].value;
      if(porcentaje_prodim == "" || porcentaje_prodim < 0.1 || porcentaje_prodim > 2){
        $('#error_porcentaje_prodim').removeClass('hidden');  
        band = false;
      }else{
        $('#error_porcentaje_prodim').addClass('hidden');
      }
    }
    gastos_indirectos = document.getElementById("gastos_indirectos").checked;
    if(gastos_indirectos == true){
      porcentaje_gastos= document.forms["formulario"]["porcentaje_gastos"].value;
      if(porcentaje_gastos == "" || porcentaje_gastos < 0.1 || porcentaje_gastos > 3){
        $('#error_porcentaje_gastos').removeClass('hidden');  
        band = false;
      }else{
        $('#error_porcentaje_gastos').addClass('hidden');
      }
    }
  }

  acta_integracion= document.forms["formulario"]["acta_integracion"].value;
  acta_priorizacion= document.forms["formulario"]["acta_priorizacion"].value;
  if(acta_integracion = ""){
    $('#error_acta_integracion').removeClass('hidden');  
        band = false;
      }else{
        $('#error_acta_integracion').addClass('hidden');
      }
  if(acta_priorizacion = ""){
    $('#error_acta_priorizacion').removeClass('hidden');  
        band = false;
      }else{
        $('#error_acta_priorizacion').addClass('hidden');
      }
    
  return band;
  
}
$("input").keyup(function() {
  $("#porcentaje_prodim, #porcentaje_gastos").on({ //validacion de solo numeros
            "focus": function(event) {
                $(event.target).select();
            },
            "keyup": function(event) {
                $(event.target).val(function(index, value) { //formato montos
                    return value.replace(/\D/g, "")
                        .replace(/[^\d]/,'')
                        .replace(/\B(?=(\d{2})+(?!\d)?)/g, ".");
                });
            }
        });  
});
    
//colocar opcion registrada en los selected
    $(document).ready(function(){
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
      $("#monto_comprometido").on({
          "focus": function(event) {
              $(event.target).select();
          },
          "keyup": function(event) {
            $(event.target).val(function(index, value) {
                return value.replace(/\D/g, "")
                    .replace(/([0-9])([0-9]{2})$/, '$1.$2')
                    .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ",");
            });
          }
      });

      $('#monto_proyectado').on('keyup', function(){
        var proyectado = parseFloat($('#monto_proyectado').val());
        var comprometido = parseFloat($('#monto_comprometido').val());
        //console.log(proyectado)
        if(proyectado<comprometido)
          $('#error_monto_mayor').removeClass('hidden');
        else
          $('#error_monto_mayor').addClass('hidden');
      });

      $('#acta_integracion').on('change', function(){
      fechaMin = $('#acta_integracion').val();
      var anio = $('#ejercicio').val();
      var fechaMax = anio+'-12'+'-31';
      //$('#acta_priorizacion').val('');
      //$('#adendum').val('');
      $('#acta_priorizacion').attr('min',fechaMin);
      $('#acta_priorizacion').attr('max',fechaMax);
  });

      $('#prodim').on('change', function(){
    //console.log($(this).val())
    if(this.checked == true){
      //$('#div_porcentajes').removeClass('hidden');
      $('#div_porcentaje_prodim').removeClass('hidden');
      $('#porcentaje_prodim').prop('required',true);
    }else{
      //$('#div_porcentajes').addClass('hidden');
      $('#div_porcentaje_prodim').addClass('hidden');
      $('#porcentaje_prodim').prop('required',false);
    }
  });

  $('#gastos_indirectos').on('change', function(){
    if(this.checked == true){
      //$('#div_porcentajes').removeClass('hidden');
      $('#div_porcentaje_gastos').removeClass('hidden');
      $('#porcentaje_gastos').prop('required',true);
    }else{
      //$('#div_porcentajes').addClass('hidden');
      $('#div_porcentaje_gastos').addClass('hidden');
      $('#porcentaje_gastos').prop('required',false);
    }
  });

     // $('#monto_comprometido').keyup();
      var statusProdim =  '{{ $fuenteCliente->prodim }}';
      var statusGastos =  '{{ $fuenteCliente->gastos_indirectos }}';
      $("#prodim option").each(function(){
        if($(this).val() == statusProdim){
        	   $(this).attr("selected",true);
        }
    	});
      $("#gastos_indirectos option").each(function(){
        
        if($(this).val() == statusGastos){
        	   $(this).attr("selected",true);
        }else if (statusGastos != '1' && statusGastos != '3' && statusGastos != '2'){
          $("#gastos_indirectos option[value='0']").attr("selected", true);
        }
    	});      
    });

//validacion de campos del formulario
$(document).ready(function() {
  //fuente_financiamiento_id
  $('#fuente_financiamiento_id, #ejercicio').on('keyup change', function(){
    cliente = '{{ $fuenteCliente->cliente_id }}';
    fuente= $('#fuente_financiamiento_id').val();
    ejercicio= $('#ejercicio').val();
    fuenteCli = '{{ $fuenteCliente->id_fuente_financ_cliente}}';
    var link = '{{ url("/ejercicioDisponible")}}/'+cliente+','+ejercicio+','+fuente;
    if(cliente.length > 0 && fuente.length > 0 && ejercicio.length >= 3){
      
        $.ajax({
              url: link,
              dataType:'json',
              type:'get',
              success: function(data){
                //console.log(data);
                $.each(data,function(key, item) {
                  //console.log(item.cliente_id);
                  if(item.cliente_id != null && item.id_fuente_financ_cliente != fuenteCli){
                  
                  $('#error_existe').removeClass('hidden');
                  $('#enviar_datos').attr("disabled", true);
                  $("#enviar_datos").removeClass('bg-orange-800');
                  $("#enviar_datos").addClass('bg-gray-700');
                }else{
                  $('#error_existe').addClass('hidden');
                  $('#enviar_datos').removeAttr("disabled");
                  $("#enviar_datos").removeClass('bg-gray-700');
                  $("#enviar_datos").addClass('bg-orange-800');
                }
                });
               
              },
              cache: false
            });
    }
  });
//===================================================
  $('#fuente_financiamiento_id').on('change',function(){
    if($('#fuente_financiamiento_id').val() == '2'){
      $('#titulo_anexo').removeClass('hidden');
      $('#anexos').removeClass('hidden');
      
    }else{
      $('#titulo_anexo').addClass('hidden');
      $('#anexos').addClass('hidden');
    }
  });
   //==============================================
   $("#formulario input").keyup(function() {
  //console.log($(this).attr('id'));
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

//validacion de los selected
    $('.clickable').click(function() {
      var valor = $(this).val();
      
      if(valor != 0){
      $('#error_'+$(this).attr('id')).fadeOut();
      $("#label_"+$(this).attr('id')).removeClass('text-red-500');
      $("#label_"+$(this).attr('id')).addClass('text-gray-700');
      //$('#guardar').removeAttr("disabled");
      }else{
      //$("#guardar").attr("disabled", true);
      $('#error_'+$(this).attr('id')).fadeIn();
      $("#label_"+$(this).attr('id')).addClass('text-red-500');
      $("#label_"+$(this).attr('id')).removeClass('text-gray-700');
      }
  });
});

//validacion del formulario con el btn guardar
// $().ready(function() {
//   $("#formulario").validate({
//     onfocusout: false,
//     onclick: false,
// 		rules: {
//       municipio: { required: true},
// 			monto_proyectado: { required: true},
//       monto_comprometido: { required: true},
//       ejercicio: { required: true},
     
      
      
//       fuente_financiamiento_id: { required: true},
//       /*prodim: { required: true},
//       gastos_indirectos: { required: true},*/
// 		},
//     errorPlacement: function(error, element) {
//       if(error != null){
//       $('#error_'+element.attr('id')).fadeIn();
//       }else{
//         $('#error_'+element.attr('id')).fadeOut();
//       }
//      // console.log(element.attr('id'));
//     },
// 	});
  // $("#enviar_datos").click(function () {
  //     var $m_p = $("#monto_proyectado").val().replaceAll(",", "");
  //     var $m_c = $("#label_comprometido").text().replaceAll(",","").replaceAll("$", "");
      
  //     if($m_p < $m_c){
  //       $("#error_monto").removeClass("hidden");
  //       return false;
  //     }else{
  //       $("#error_monto").addClass("hidden");
  //       return true;
  //     }
  //   });
//});
  </script>
  
  <script>
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

    function validar(){
        proyectado= $('#monto_proyectado').val().replace(/[&\/\\#,+()$~%'":*?<>{}]/g, '');
        proyectado = parseFloat(proyectado) || 0;
        comprometido= $('#monto_comprometido').val().replace(/[&\/\\#,+()$~%'":*?<>{}]/g, '');
        comprometido = parseFloat(comprometido) || 0;
        if(proyectado < comprometido){ //validacion entre monto proyectado y comprometido
                $("#error_monto").removeClass("hidden");
                return false;
        }else{ 
                return true;
          }
      }
  </script>
  
@endsection