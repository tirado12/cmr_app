@extends('layouts.plantilla')
@section('title','Municipio')
@section('contenido')
@inject('service', 'App\Http\Controllers\ObraController')
    <link rel="stylesheet"
        href="{{ asset('css/datatable.css') }}">
    <link rel="stylesheet"
        href="{{ asset('css/jquery.dataTables.min.css') }}">

    <!--Responsive Extension Datatables CSS-->
    <link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css"
        rel="stylesheet">
    <link rel="stylesheet"
        href="https://cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css">
    <div class="flex flex-row items-center ">
        <img class="block h-24 w-24 rounded-full shadow-2xl" src="{{$cliente->logo}}" alt="cmr">
        <div class="ml-4 grid grid-col-1">
            <p class="block font-black text-xl">{{$cliente->id_municipio}} - {{$cliente->nombre_municipio}}</p>
            <p class="text-gray-600">{{$cliente->id_distrito}} {{$cliente->nombre_distrito}} - {{$cliente->id_region}} {{$cliente->nombre_region}}</p>
            <p class="text-gray-600"></p>
        </div>
    </div>
    <div class="border-b p-4 mt-4">
        <div class="flex justify-between items-center">
            <h1 for="first_name" class="text-xl font-bold">Fuentes de financiamiento</h1>
            
            <button type="button"
                href=""
                class="text-base text-white bg-green-500 p-2 rounded-lg px-6" onclick="toggleModal('modal')">Agregar</button>
            
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

    <div class="">
        @foreach ($fuentes_cliente as $fuente_cliente)
                <div class="mt-6 shadow-xl bg-white rounded-lg pb-10">
                    <div class="border-b p-4 flex justify-between items-center">
                        <span class="inline-block text-xl font-medium font-semibold">{{$fuente_cliente->nombre_corto}}</span>
                        
                        <button type="button"
                          href=""
                          class="text-base text-white bg-blue-500 p-2 rounded-lg px-6" onclick="toggleModal_1('modal-edit', {{$fuente_cliente}}, '{{$service->formatNumber($fuente_cliente->monto_proyectado)}}', '{{$service->formatNumber($fuente_cliente->monto_comprometido)}}')">Editar</button>
                        
                    </div>
                    
                    <div class="px-4 pt-4">
                        <p for="first_name" class="block text-normal font-base text-gray-500">Nombre completo: <span class="text-black text-base font-semibold">{{$fuente_cliente->nombre_largo}}</span></p>
                    </div>
                    <div class="p-4 grid grid-cols-6 ">
                        <div class="col-span-6 sm:col-span-2 mt-3 sm:mt-0">
                            <p for="first_name" class="block text-normal font-base text-gray-500">Monto recibido: <span class="text-black text-base font-semibold">{{$service->formatNumber($fuente_cliente->monto_proyectado)}}</span></p>
                        </div>
                        <div class="col-span-8 sm:col-span-2 mt-3 sm:mt-0">
                            <p for="first_name" class="block text-normal font-base text-gray-500">Monto comprometido: <span class="text-black text-base font-semibold">{{$service->formatNumber($fuente_cliente->monto_comprometido)}}</span></p>
                        </div>
                        <div class="col-span-8 sm:col-span-2 mt-3 sm:mt-0">
                            <p for="first_name" class="block text-normal font-base text-gray-500">Monto pendiente: <span class="text-black text-base font-semibold">{{$service->formatNumber($fuente_cliente->monto_proyectado - $fuente_cliente->monto_comprometido)}}</span></p>
                        </div>
                    </div>
                    
                    <div class="p-4 ">
                        <div class="">
                            <table id="example" class="table table-striped bg-white" style="width:100%;">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Monto</th>
                                        <th>Modalidad de ejecución</th>
                                        <th>Porcentaje de avance</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                            <tbody>
                                @foreach ($fuente_cliente->obrasFuente as $obra_fuente)
                                    <tr>
                                        <td>
                                            <div class="text-base leading-5 font-medium text-gray-900">
                                                {{ $obras->where('id_obra', $obra_fuente->obra_id)->first()->nombre_corto }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="text-base leading-5 font-medium text-gray-900 text-right">
                                                {{ $service->formatNumber($obras->where('fuente_financiamiento_id', $fuente_cliente->fuente_financiamiento_id)->where('id_obra', $obra_fuente->obra_id)->first()->monto)}}
                                                
                                            </div>
                                        </td>
                                        <td>
                                            <div class="text-base leading-5 font-medium text-gray-900">
                                                @if ($obras->where('id_obra', $obra_fuente->obra_id)->first()->modalidad_ejecucion == 1)
                                                    Administración Directa
                                                @else
                                                    Contrato
                                                @endif                                                
                                            </div>
                                        </td>
                                        <td>
                                            <div class="text-base leading-5 font-medium text-gray-900 text-right">
                                                {{ round(($obras->where('id_obra', $obra_fuente->obra_id)->first()->avance_fisico + $obras->where('id_obra', $obra_fuente->obra_id)->first()->avance_tecnico + $obras->where('id_obra', $obra_fuente->obra_id)->first()->avance_economico) / 3) }} %
                                                
                                            </div>
                                        </td>
                                        <td>
                                            <div class="text-base leading-5 font-medium text-gray-900">
                                              <a type="button"
                                                    href="{{ route('obra.show', 1) }}"
                                                    class="bg-white text-sm text-blue-500 font-normal text-ms p-2 rounded rounded-lg">Detalles</a>
                                                <a type="button"
                                                    href="{{ route('cabildo.edit', 1) }}"
                                                    class="bg-white text-sm text-blue-500 font-normal text-ms p-2 rounded rounded-lg">Editar</a>
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
                        
                    </div>

                </div>
            
        @endforeach
    </div>

    <!-- inicio modal -->
  <!-- inicio modal -->
  <div class="hidden overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center" id="modal">
    <div class="relative w-auto my-6 mx-auto max-w-3xl">
      <!--content-->
      <div class="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none">
        <!--header-->
        <div class="flex items-start justify-between p-5 border-b border-solid border-blueGray-200 rounded-t">
          <h4 class="text-xl font-semibold">
            Agregar nueva fuente
          </h4>
          <button class="p-1 ml-auto bg-transparent border-0 text-black opacity-5 float-right text-3xl leading-none font-semibold outline-none focus:outline-none" onclick="toggleModal('modal')">
            <span class="bg-transparent text-black opacity-5 h-6 w-6 text-2xl block outline-none focus:outline-none">
              
            </span>
          </button>
        </div>
        <!--body-->
        <form action="{{ route('fuenteCliente.store') }}" method="POST" id="formulario" name="formulario">
          @csrf
          @method('POST')
        <div class="relative p-6 flex-auto">
            <div class="grid grid-cols-10 gap-4">
              <div class="col-span-5 sm:col-span-5 ">
                <label  id="label_cliente_id" for="cliente_id" class="block text-sm font-bold text-gray-700">Municipio</label>
                <label id="cliente_id" class="block text-base font-medium text-gray-700 py-3 px-2">{{$cliente->nombre_municipio}}</label>
                <input type="text" name="cliente_id" id="cliente_id" class="hidden border-none block text-base font-medium text-gray-700 py-3 px-2" value="{{$cliente->id_cliente}}">
              </div>
              <div class="col-span-3 sm:col-span-2">
                <label id="label_ejercicio" for="label_ejercicio" class="block text-sm font-bold text-gray-700">Ejercicio</label>
                <label class="block text-base font-medium text-gray-700 py-3 px-2">{{$anio}}</label>
                <input type="text" name="ejercicio" id="ejercicio" class="hidden border-none block text-base font-medium text-gray-700 py-3 px-2" value="{{$anio}}">
              </div>
              <div class="col-span-8 sm:col-span-3">
                <label id="label_monto_comprometido" for="label_monto_comprometido" class="block text-sm font-bold text-gray-700">Monto comprometido</label>
                <label id="label_mc" for="monto_comprometido" class="block text-base font-medium text-gray-700 py-3 px-2">$0.00</label>
                <input type="text" name="monto_comprometido" id="moonto_comprometido" class="hidden border-none block text-base font-medium text-gray-700 py-3 px-2" value="0.00">
              </div>
              <div class="col-span-8 sm:col-span-5">
                <label id="label_monto_proyectado" for="label_monto_proyectado" class="block text-sm font-bold text-gray-700">Monto proyectado *</label>
                <div class="relative ">
                  <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <span class="text-gray-700 text-base">
                      $
                    </span>
                  </div>
                  <input type="text" name="monto_proyectado" id="monto_proyectado" maxlength="20" class="pl-7  mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" placeholder="0.00">
                </div>
                  <label id="error_monto_proyectado" name="error_monto_proyectado" class="hidden text-base font-normal text-red-500" >Ingrese una cantidad valida</label>
              </div>
              
              <div class="col-span-5">
                <label for="fuente_financiamiento_id" class="block text-sm font-bold text-gray-700">Fuente de financiamiento *</label>
                <select id="fuente_financiamiento_id" name="fuente_financiamiento_id" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">                
                  @foreach($fuentes as $fuente)
                  <option value="{{ $fuente->id_fuente_financiamiento }}"> {{ $fuente->nombre_corto }} </option>
                  @endforeach
                </select>
            </div>
  
              <div class="col-span-5 fondoIII">
                  <label id="label_acta_integracion_consejo" for="acta_integracion_consejo" class="block text-sm font-bold text-gray-700">Acta integracion *</label>
                  <input type="date" name="acta_integracion_consejo" id="acta_integracion_consejo" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" >
                  <label id="error_acta_integracion_consejo" name="error_acta_integracion_consejo" class="hidden text-base font-normal text-red-500" >Ingrese una fecha valida</label>  
              </div>
              <div class="col-span-5 fondoIII">
                  <label id="label_acta_priorizacion" for="acta_priorizacion" class="block text-sm font-bold text-gray-700">Acta priorización *</label>
                  <input type="date" name="acta_priorizacion" id="acta_priorizacion" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" >
                  <label id="error_acta_priorizacion" name="error_acta_priorizacion" class="hidden text-base font-normal text-red-500" >Ingrese una fecha valida</label>  
              </div>
              <div class="col-span-5 fondoIII">
                  <label for="adendum_priorizacion" class="block text-sm font-bold text-gray-700">Adendum priorización</label>
                  <input type="date" name="adendum_priorizacion" id="adendum_priorizacion" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" >
                  <label id="error_adendum_priorizacion" name="error_adendum_priorizacion" class="hidden text-base font-normal text-red-500" >Ingrese una fecha valida</label>  
              </div>
            <div class="col-span-5 lg:col-span-2 fondoIII">
                <div>
                  <label for="cbox2" class="text-sm font-medium text-gray-700"><input type="checkbox" id="prodim" name="prodim" > PRODIMDF</label><br>
                  <label for="cbox2" class="text-sm font-medium text-gray-700"><input type="checkbox" id="gastos_indirectos" name="gastos_indirectos" > Gastos indirectos</label>
                </div>
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

  <!-- inicio modal edit -->
  <div class="hidden overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center" id="modal-edit">
    <div class="relative w-auto my-6 mx-auto max-w-3xl">
      <!--content-->
      <div class="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none">
        <!--header-->
        <div class="flex items-start justify-between p-5 border-b border-solid border-blueGray-200 rounded-t">
          <h4 class="text-xl font-semibold">
            Modificar fuente de financiamiento
          </h4>
          <button class="p-1 ml-auto bg-transparent border-0 text-black opacity-5 float-right text-3xl leading-none font-semibold outline-none focus:outline-none" onclick="toggleModal('modal-edit')">
            <span class="bg-transparent text-black opacity-5 h-6 w-6 text-2xl block outline-none focus:outline-none">
              
            </span>
          </button>
        </div>
        <!--body-->
        <form action="{{ route('fuenteCliente.store') }}" method="POST" id="formulario-edit" name="formulario-edit">
          @csrf
          @method('PUT')
        <div class="relative p-6 flex-auto">
            <div class="grid grid-cols-10 gap-4">
              <div class="col-span-5 sm:col-span-5 ">
                <label  id="label_cliente_id" for="cliente_id_edit" class="block text-sm font-bold text-gray-700">Municipio</label>
                <label class="block text-base font-medium text-gray-700 py-3 px-2">{{$cliente->nombre_municipio}}</label>
                <input type="text" name="fuente_id_edit" id="fuente_id_edit" class="hidden border-none block text-base font-medium text-gray-700 py-3 px-2" value="{{$cliente->id_cliente}}">
              </div>
              <div class="col-span-3 sm:col-span-2">
                <label id="label_ejercicio_edit" for="label_ejercicio" class="block text-sm font-bold text-gray-700">Ejercicio</label>
                <label class="block text-base font-medium text-gray-700 py-3 px-2">{{$anio}}</label>
                <input type="text" name="ejercicio_edit" id="ejercicio_edit" class="hidden border-none block text-base font-medium text-gray-700 py-3 px-2" value="{{$anio}}">
              </div>
              <div class="col-span-8 sm:col-span-3">
                <label for="label_monto_c" class="block text-sm font-bold text-gray-700">Monto comprometido</label>
                <label id="label_monto_c" for="monto-comprometido" class="block text-base font-medium text-gray-700 py-3 px-2">$0.00</label>
                <input type="text" name="monto_comprometido_edit" id="monto_comprometido_edit" class="hidden border-none block text-base font-medium text-gray-700 py-3 px-2" value="">
              </div>
                <div class="col-span-8 sm:col-span-5">
                  <label for="monto_proyectado_edit" class="block text-sm font-medium text-gray-700">Monto proyectado *</label>
                  <div class="relative ">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                      <span class="text-gray-700 text-base">
                        $
                      </span>
                    </div>
                    <input type="text" name="monto_proyectado_edit" id="monto_proyectado_edit" maxlength="20" class="pl-7  mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm text-base border-gray-300 rounded-md" placeholder="0.00">
                  </div>
                  <label id="error_monto_proyectado_edit" name="error_monto_proyectado_edit" class="hidden text-base font-normal text-red-500" >Por favor ingresar una cantidad</label>
                  <label id="error_monto" name="error_monto" class="hidden w-full text-base font-normal text-red-500" >El monto proyectado debe ser mayor o igual al comprometido</label>
              </div>
              
              <div class="col-span-5">
                <label for="fuente_financiamiento_id" class="block text-sm font-medium text-gray-700">Fuente de financiamiento *</label>
                <label id="fuente_financiamiento_edit" for="fuente_financiemiento_id_edit" class="block text-base font-medium text-gray-700 py-3 px-2">$0.00</label>
                <input type="text" name="fuente_financiamiento_id_edit" id="fuente_financiamiento_id_edit" class="hidden border-none block text-base font-medium text-gray-700 py-3 px-2" value="">
              </div>
  
              <div class="col-span-5 fondo_3">
                  <label id="label_acta_integracion_consejo" for="acta_integracion_consejo" class="block text-sm font-medium text-gray-700">Acta integracion *</label>
                  <input type="date" name="acta_integracion_consejo_edit" id="acta_integracion_consejo_edit" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" >
                  <label id="error_acta_integracion_consejo" name="error_acta_integracion_consejo" class="hidden text-base font-normal text-red-500" >Por favor ingresar una Fecha</label>  
              </div>
              <div class="col-span-5 fondo_3">
                  <label id="label_acta_priorizacion" for="acta_priorizacion" class="block text-sm font-medium text-gray-700">Acta priorización *</label>
                  <input type="date" name="acta_priorizacion_edit" id="acta_priorizacion_edit" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" >
                  <label id="error_acta_priorizacion_edit" name="error_acta_priorizacion_edit" class="hidden text-base font-normal text-red-500" >Por favor ingresar una Fecha</label>  
              </div>
              <div class="col-span-5 fondo_3">
                  <label for="adendum_priorizacion" class="block text-sm font-medium text-gray-700">Adendum priorización *</label>
                  <input type="date" name="adendum_priorizacion_edit" id="adendum_priorizacion_edit" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" >
                  <label id="error_adendum_priorizacion_edit" name="error_adendum_priorizacion_edit" class="hidden text-base font-normal text-red-500" >Por favor ingresar una Fecha</label>  
              </div>
            <div class="col-span-5 lg:col-span-2 fondo_3">
                <div>
                  <label for="prodim_edit" class="text-sm font-medium text-gray-700"><input type="checkbox" id="prodim_edit" name="prodim_edit" > PRODIMDF</label><br>
                  <label for="gastos_indirectos_edit" class="text-sm font-medium text-gray-700"><input type="checkbox" id="gastos_indirectos_edit" name="gastos_indirectos_edit" > Gastos indirectos</label>
                </div>
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
          <button type="submit" id="update" class="bg-green-500 text-white active:bg-green-600 font-bold uppercase text-sm px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" >
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
    
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script type="text/javascript"
        charset="utf8"
        src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.responsive.min.js') }}"></script>
    <script src="https://unpkg.com/@popperjs/core@2.9.1/dist/umd/popper.min.js"
        charset="utf-8"></script>
        <script type="text/javascript"
        src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.22/b-1.6.4/b-flash-1.6.4/b-html5-1.6.4/b-print-1.6.4/datatables.min.js">
    </script>
    <script type="text/javascript"
        src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.22/b-1.6.4/b-flash-1.6.4/b-html5-1.6.4/b-print-1.6.4/datatables.min.js">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>  
    <script>
        $(document).ready(function() {
            

            $('table').DataTable({
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
        });
    </script>



<script type="text/javascript">

    $('#fuente_financiamiento_id').on('change', function() {
      if($(this).val() == 2){
        $(".fondoIII").removeClass("hidden");
      }else{
        $(".fondoIII").addClass("hidden");
      }
    });
    function toggleModal(modalID){
      document.getElementById(modalID).classList.toggle("hidden");
      document.getElementById(modalID + "-backdrop").classList.toggle("hidden");
    }

    function toggleModal_1(modalID, fuente, mp, mc){
      console.log(fuente);
      $("#monto_proyectado_edit").val(mp.replaceAll("$", ""));
      $("#fuente_financiamiento_edit").html(fuente.nombre_corto);
      $("#fuente_financiamiento_id_edit").val(fuente.id_fuente_financiamiento);
      $("#acta_integracion_consejo_edit").val(fuente.acta_integracion_consejo);
      $("#acta_priorizacion_edit").val(fuente.acta_priorizacion);
      $("#adendum_priorizacion_edit").val(fuente.adendum_priorizacion);
      $("#fuente_id_edit").val(fuente.id_fuente_financ_cliente);
      $("#label_monto_c").html("$  "+ mc.replaceAll("$",""));
      $("#monto_comprometido_edit").val(fuente.monto_comprometido );
      $("#formulario-edit").attr("action", jQuery(location).attr('origin')+"/fuenteCliente/"+fuente.id_fuente_financ_cliente);
      
      if(fuente.prodim == 1) 
        $("#prodim_edit").prop("checked", true);
      else
        $("#prodim_edit").prop("checked", false);

      if(fuente.gastos_indirectos == 1) 
        $("#gastos_indirectos_edit").prop("checked", true);
      else
        $("#gastos_indirectos_edit").prop("checked", false);


      if(fuente.id_fuente_financiamiento == 2)
        $(".fondo_3").removeClass("hidden");
      else
        $(".fondo_3").addClass("hidden");
      document.getElementById(modalID).classList.toggle("hidden");
      document.getElementById(modalID + "-backdrop").classList.toggle("hidden");
      
    }
  
  //validacion de campos del modal
  $(document).ready(function() {
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

      $("#monto_proyectado_edit").on({
          
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


      if($('#fuente_financiamiento_id').val() == 2){
        $(".fondoIII").removeClass("hidden");
      }else{
        $(".fondoIII").addClass("hidden");
      }

     $("#modal-id input").keyup(function() {
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
  });
  
  //Validacion de select municipio
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
  
  
  //validacion del formulario con el btn guardar
  $().ready(function() {
    $("#formulario").validate({
      onfocusout: false,
      onclick: false,
      rules: {
        monto_proyectado: { required: true},
        acta_integracion_consejo: { required: true},
        acta_priorizacion: { required: true},
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
    

    $("#formulario-edit").validate({
      onfocusout: false,
      onclick: false,
      rules: {
        monto_proyectado_edit: { required: true, },
        acta_integracion_consejo_edit: { required: true},
        acta_priorizacion_edit: { required: true},
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

    $("#update").click(function () {
      var $m_p = $("#monto_proyectado_edit").val().replaceAll(",", "");
      var $m_c = $("#label_monto_c").text().replaceAll(",","").replaceAll("$  ", "");
      
      if($m_p < $m_c){
        $("#error_monto").removeClass("hidden");
        return false;
      }else{
        $("#error_monto").addClass("hidden");
        return true;
      }
    });
    
  });
  </script>

@endsection