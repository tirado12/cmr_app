@extends('layouts.plantilla')
@section('title','Municipio')
@section('contenido')
@inject('service', 'App\Http\Controllers\ObraController')
    <link rel="stylesheet"
        href="{{ asset('css/datatable.css') }}">
    <link rel="stylesheet"
        href="{{ asset('css/jquery.dataTables.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/styles_select2.css') }}">
        <link rel="stylesheet" href="{{ asset('css/styles_personalizados_general.css') }}">
        
    <!--Responsive Extension Datatables CSS-->
    <link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css"
        rel="stylesheet">
    <link rel="stylesheet"
        href="https://cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <div class="flex flex-row items-center ">
        <img class="block h-24 w-24 rounded-full shadow-2xl" src="{{$cliente->logo}}" alt="cmr">
        <div class="ml-4 grid grid-col-1">
            <p class="block font-black text-xl">{{$cliente->id_municipio}} - {{$cliente->nombre_municipio}}</p>
            <p class="text-gray-600">{{$cliente->id_distrito}} {{$cliente->nombre_distrito}} - {{$cliente->id_region}} {{$cliente->nombre_region}}</p>
            <p class="text-gray-600"></p>
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
    @if($fuentes_cliente->where('fuente_financiamiento_id', 2)->first() != null && $fuentes_cliente->where('fuente_financiamiento_id', 2)->first()->prodim)
      <div class="mt-4">
        <div class="w-full ">
            <div x-data={show:false}>
                <div class="bg-transparent relative" id="headingOne">
                    <button @click="show=!show" type="button" style="width:100%;">
                        <div class="border-b px-4 py-3">
                            <div class="flex justify-between items-center">
                              <h1 for="first_name" class="text-xl font-bold">PRODIMDF</h1>
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
                      <div class="col-span-8 mb-5">
                        <h2 for="first_name" class="text-lg font-bold text-center">Programa de Desarrollo Institucional Municipal y de las<br> Demarcaciones Territoriales del Distrito Federal (PRODIMDF)</h2>
                        <p class="text-center font-semibold mt-2">Monto asignado: <span class="font-bold">{{$service->formatNumber($fuentes_cliente->where('fuente_financiamiento_id', 2)->first()->monto_prodim)}}</span></p>
                      </div>
                      <div class="col-span-8">
                          <p for="first_name" class="block text-normal font-base text-gray-500 text-center">Comprometido</p>
                          <div class="flex justify-center">
                            <button type="button" href="" class="font-semibold text-sm text-blue-500 underline px-3" onclick="toggleModal('modal-comprometido')">Agregar comprometido</button>
                          </div>
                            
                      </div>
                      <div class="col-span-8 overflow-auto">
                        <table id="example1" class="table-simple table-striped bg-white table-modificada" style="width:100%;">
                          <thead>
                              <tr>
                                  <th class="text-center py-2">Clave</th>
                                  <th class="text-center">Nombre</th>
                                  <th class="text-center">Fecha comprometido</th>
                                  <th class="text-center">Monto comprometido</th>
                                  <th class="text-center">Acciones</th>
                              </tr>
                          </thead>
                          <tbody>
                              @foreach($comprometido_prodim as $comprometido)
                                <tr>
                                    <td>
                                        <div class="text-center">
                                            {{$comprometido->clave}}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="">
                                            {{$comprometido->nombre}}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-center">
                                            {{$service->formatDate($comprometido->fecha_comprometido)}}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-right">
                                            {{$service->formatNumber($comprometido->monto)}}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="">
                                          <button type="button" href="" class="btn_detalles bg-white text-sm text-blue-500 font-normal text-ms p-2 rounded rounded-lg" onclick="mostrarTabla('tr-desglose-{{$comprometido->id_comprometido}}')">Detalles</button>
                                            <!--<a type="button"
                                                href="{{ route('cabildo.edit', 1) }}"
                                                class="bg-white text-sm text-blue-500 font-normal text-ms p-2 rounded rounded-lg">Editar</a>-->
                                        </div>
                                    </td>
                                    
                                </tr>
                                <tr id="tr-desglose-{{$comprometido->id_comprometido}}-titulo" class="hidden">
                                  <td valign="top" colspan="5" class="dataTables_empty td-titulo">
                                    <div class="font-semibold text-center mt-2 ">
                                      Desglose del comprometido de PRODIM
                                      <div class="flex justify-center">
                                        
                                        <button type="button" href="" class="font-semibold text-sm text-blue-500 underline px-3" onclick="toggleModal_compPro('modal-concepto', {{$comprometido}}, '{{$service->formatNumber($comprometido->monto - ($comprometido->total_desglose->first()?$comprometido->total_desglose->first()->total:0))}}')">Agregar concepto</button>
                                      </div>
                                    </div>
                                  </td>  
                                </tr>
                                <tr id="tr-desglose-{{$comprometido->id_comprometido}}" class="hidden odd">
                                  
                                  <td valign="top" colspan="5" class="dataTables_empty">
                                    @if(count($comprometido->desglose) > 0)
                                        <table class="table-simple-second table-striped bg-white table-modificada  mb-5" style="width:100%;">
                                          <thead>
                                              <tr>
                                                  <th class="text-center py-2">Concepto</th>
                                                  <th class="text-center">Monto</th>
                                              </tr>
                                          </thead>
                                          <tbody>
                                              @foreach($comprometido->desglose as $desglose)  
                                                <tr>
                                                  <td>
                                                      <div class="">
                                                          {{$desglose->concepto}}
                                                      </div>
                                                  </td>
                                                  <td>
                                                      <div class="text-center">
                                                          {{$service->formatNumber($desglose->monto_desglose)}}
                                                      </div>
                                                  </td>
                                                </tr>
                                              @endforeach
                                          </tbody>
                                        </table>
                                    @endif
                                  </td>
                                </tr>
                              @endforeach
                              @if(count($comprometido_prodim) == 0)
                                  <tr>
                                    <td valign="top" colspan="5" class="dataTables_empty">
                                      <div class="font-semibold text-center m-2 ">
                                        Ningún dato disponible en esta tabla
                                      </div>
                                    </td>  
                                  </tr>
                              @endif
                          </tbody>
                        </table>
                      </div>
                      @if($fuentes_cliente->where('fuente_financiamiento_id', 2)->first()->monto_prodim == $total_prodim)
                        <div class="col-span-8">
                            <div class="p-4 grid grid-cols-8">
                              @if($prodim->convenio == 2)
                                <div class="col-span-8">
                                  <div class="font-semibold text-center mt-2 ">
                                    <div class="flex justify-center">
                                      <button type="button" href="" class="font-semibold text-sm text-blue-500 underline px-3" onclick="toggleModal('modal-proceso')">Actualizar proceso</button>
                                    </div>
                                  </div>
                                </div>
                              @endif
                                <div class="col-span-2">
                                    <p for="first_name" class="block text-base font-bold text-gray-700 text-center">Presentado</p>
                                    <div class="mt-2">
                                        @switch($prodim->presentado)
                                          @case(1)
                                              <div class="flex justify-center max-h-8">
                                                  <img src="{{ asset('image/Bien.svg') }}" alt="Workflow" >
                                              </div>
                                              <div>
                                                  <p class="block text-base font-semibold text-gray-500 text-center">{{$service->formatDate($prodim->fecha_presentado)}}</p>
                                              </div>
                                          @break
                                          @default
                                            <div class="flex justify-center max-h-8">
                                                <img src="{{ asset('image/Mal.svg') }}" alt="Workflow">
                                            </div>
                                        @endswitch
                                    </div>
                                </div>
                                <div class="col-span-2">
                                    <p for="first_name" class="block text-base font-bold text-gray-700 text-center">Revisado</p>
                                    <div class="mt-2">
                                        @switch($prodim->revisado)
                                          @case(1)
                                              <div class="flex justify-center max-h-8">
                                                  <img src="{{ asset('image/Bien.svg') }}" alt="Workflow" >
                                              </div>
                                              <div>
                                                  <p class="block text-base font-semibold text-gray-500 text-center">{{$service->formatDate($prodim->fecha_revisado)}}</p>
                                              </div>
                                          @break
                                          @default
                                            <div class="flex justify-center max-h-8">
                                                <img src="{{ asset('image/Mal.svg') }}" alt="Workflow">
                                            </div>
                                        @endswitch
                                    </div>
                                </div>
                                <div class="col-span-2">
                                    <p for="first_name" class="block text-base font-bold text-gray-700 text-center">Aprovado</p>
                                    <div class="mt-2">
                                        @switch($prodim->aprovado)
                                          @case(1)
                                              <div class="flex justify-center max-h-8">
                                                  <img src="{{ asset('image/Bien.svg') }}" alt="Workflow" >
                                              </div>
                                              <div>
                                                  <p class="block text-base font-semibold text-gray-500 text-center">{{$service->formatDate($prodim->fecha_aprovado)}}</p>
                                              </div>
                                          @break
                                          @default
                                            <div class="flex justify-center max-h-8">
                                                <img src="{{ asset('image/Mal.svg') }}" alt="Workflow">
                                            </div>
                                        @endswitch
                                    </div>
                                </div>
                                <div class="col-span-2">
                                    <p for="first_name" class="block text-base font-bold text-gray-700 text-center">Firma de convenio</p>
                                    <div class="mt-2">
                                        @switch($prodim->convenio)
                                          @case(1)
                                              <div class="flex justify-center max-h-8">
                                                  <img src="{{ asset('image/Bien.svg') }}" alt="Workflow" >
                                              </div>
                                              <div>
                                                  <p class="block text-base font-semibold text-gray-500 text-center">{{$service->formatDate($prodim->fecha_convenio)}}</p>
                                              </div>
                                          @break
                                          @default
                                            <div class="flex justify-center max-h-8">
                                                <img src="{{ asset('image/Mal.svg') }}" alt="Workflow">
                                            </div>
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
    @endif

    @if($fuentes_cliente->where('fuente_financiamiento_id', 2)->first() != null && $fuentes_cliente->where('fuente_financiamiento_id', 2)->first()->gastos_indirectos)    
      <div>
        <div class="w-full ">
            <div x-data={show:false}>
                <div class="bg-transparent relative" id="headingOne">
                    <button @click="show=!show" type="button" style="width:100%;">
                        <div class="border-b px-4 py-3">
                            <div class="flex justify-between items-center">
                              <h1 for="first_name" class="text-xl font-bold">Gastos Indirectos</h1>
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
                      <div class="col-span-8 mb-5">
                        <p class="text-center font-semibold mt-2">Monto asignado: <span class="font-bold">{{$service->formatNumber($fuentes_cliente->where('fuente_financiamiento_id', 2)->first()->monto_gastos)}}</span></p>
                      </div>
                      <div class="col-span-8">
                          <p for="first_name" class="block text-normal font-base text-gray-500 text-center">Comprometido</p>
                          <div class="flex justify-center">
                            <button type="button" href="" class="font-semibold text-sm text-blue-500 underline px-3" onclick="toggleModal('modal-gi')">Agregar comprometido</button>
                          </div>
                      </div>
                      <div class="col-span-8 overflow-auto">
                        <table id="example1" class="table-simple table-striped bg-white table-modificada" style="width:100%;">
                          <thead>
                              <tr>
                                  <th class="text-center py-2">Clave</th>
                                  <th class="text-center">Nombre</th>
                                  <th class="text-center">Monto comprometido</th>
                              </tr>
                          </thead>
                          <tbody>
                              @foreach($comprometido_gi as $comprometido)
                                <tr>
                                    <td >
                                        <div class="text-center">
                                            {{$comprometido->clave}}
                                        </div>
                                    </td>
                                    <td class="p-2-i">
                                        <div class="">
                                            {{$comprometido->nombre}}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-right">
                                            {{$service->formatNumber($comprometido->monto)}}
                                        </div>
                                    </td>
                                    
                                </tr>
                              @endforeach
                              @if(count($comprometido_gi) == 0)
                                  <tr>
                                    <td valign="top" colspan="5" class="dataTables_empty">
                                      <div class="font-semibold text-center m-2 ">
                                        Ningún dato disponible en esta tabla
                                      </div>
                                    </td>  
                                  </tr>
                              @endif
                          </tbody>
                        </table>
                      </div>
                    </div>
                </div>
            </div>
        </div>
      </div>
    @endif
    @if($fuente_f3)
    <div>
      <div class="w-full ">
          <div x-data={show:false}>
              <div class="bg-transparent relative" id="headingOne">
                  <button @click="show=!show" type="button" style="width:100%;">
                      <div class="border-b px-4 py-3">
                          <div class="flex justify-between items-center">
                            <h1 for="first_name" class="text-xl font-bold">Plataformas Digitales</h1>
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
                    <div class="col-span-8 mb-5">
                      <h2 for="first_name" class="text-lg font-bold text-center">Sistema de Información para la Planeación del Desarrollo de Oaxaca (SISPLADE)</h2>
                      <div class="flex justify-center">
                        <button type="button" href="" class="font-semibold text-sm text-blue-500 underline px-3" onclick="toggleModal('modal-sisplade')">Modificar estatus</button>
                      </div>
                    </div>
                    <div class="col-span-4">
                        <p for="first_name" class="block text-normal font-bold text-gray-900 text-center">Capturado</p>
                        <div class="mt-2">
                          @switch($sisplade->capturado)
                            @case(1)
                                <div class="flex justify-center max-h-8">
                                    <img src="{{ asset('image/Bien.svg') }}" alt="Workflow" >
                                </div>
                                <div>
                                    <p class="block text-base font-semibold text-gray-900 text-center">{{$service->formatDate($sisplade->fecha_capturado)}}</p>
                                </div>
                            @break
                            @default
                              <div class="flex justify-center max-h-8">
                                  <img src="{{ asset('image/Mal.svg') }}" alt="Workflow">
                              </div>
                          @endswitch
                        </div>
                    </div>
                    <div class="col-span-4">
                        <p for="first_name" class="block text-normal font-bold text-gray-900 text-center">Validado</p>
                        <div class="mt-2">
                          @switch($sisplade->validado)
                            @case(1)
                                <div class="flex justify-center max-h-8">
                                    <img src="{{ asset('image/Bien.svg') }}" alt="Workflow" >
                                </div>
                                <div>
                                    <p class="block text-base font-semibold text-gray-900 text-center">{{$service->formatDate($sisplade->fecha_validado)}}</p>
                                </div>
                            @break
                            @default
                              <div class="flex justify-center max-h-8">
                                  <img src="{{ asset('image/Mal.svg') }}" alt="Workflow">
                              </div>
                          @endswitch
                        </div>
                    </div>

                    <div class="col-span-8 mb-10">
                      <h2 for="first_name" class="text-lg font-bold text-center">Matriz de Inversión para el Desarrollo Social (MIDS)<br>y Sistema de Recursos Federales Transferidos (SRFT)</h2>
                      <div class="flex justify-center">
                        <button type="button" href="" class="font-semibold text-sm text-blue-500 underline px-3" onclick="toggleModal('modal-sisplade')">Modificar estatus</button>
                      </div>
                    </div>
                    <div class="col-span-8">
                      <div class="grid grid-cols-10">
                        <div class="col-span-4 border">
                          <p for="first_name" class="block text-base font-bold text-gray-900 text-center p-1">Nombre de la obra</p>
                        </div>
                        <div class="col-span-2 border">
                          <p for="first_name" class="block text-base font-bold text-gray-900 text-center p-1">MIDS</p>
                        </div>
                        <div class="col-span-2 border">
                          <p for="first_name" class="block text-base font-bold text-gray-900 text-center p-1">RFT</p>
                        </div>
                        <div class="col-span-2 border">
                          <p for="first_name" class="block text-base font-bold text-gray-900 text-center p-1">Acciones</p>
                        </div>
                          @foreach($obras_pt as $obra) 
                            <div class="col-span-4 flex justify-center items-center leading-none border p-2">
                              <p for="first_name" class="block text-base font-semibold text-gray-900 text-center">{{$obra->nombre_corto}}</p>
                            </div>
                            <div class="col-span-2 border p-2">
                              <div class="flex justify-center items-center">
                                <p class="block text-base font-semibold text-gray-900 text-center leading-none">
                                  @if($obra->planeado == 1)
                                    En proceso <br>de planeación.
                                  @else
                                    @if($obra->firmado == 1)
                                      En proceso <br>de firma.
                                    @else
                                      @if($obra->validado == 1)
                                        En proceso <br>de validacion.
                                      @else
                                        <div class="flex justify-center max-h-8">
                                          <img src="{{ asset('image/Bien.svg') }}" alt="Workflow" >
                                        </div>
                                      @endif
                                    @endif
                                  @endif
                                </p>

                                @if(strftime("%m") > 1 && strftime("%Y") == ($anio + 1))
                                    <div class="flex justify-center max-h-8">
                                        <img src="{{ asset('image/Bien.svg') }}" alt="Workflow" >
                                    </div>
                                @endif

                                
                              </div>
                            </div>
                            <div class="col-span-2 border p-2">
                              <div class="flex justify-center items-center">
                                <p class="block text-base font-semibold text-gray-900 text-center leading-none">
                                    @if(strftime("%m") == 1 && strftime("%Y") == $cliente->anio_inicio )
                                        Primer trimestre <br>En proceso
                                    @endif
                                    @if(strftime("%m") > 1 && strftime("%m") <= 3 && strftime("%Y") == $anio)
                                        Primer trimestre <br>En proceso
                                    @endif
                                    @if(strftime("%m") == 4 && strftime("%d") > 0 && strftime("%d") < 20 && strftime("%Y") == $anio)
                                        Capturando<br>Primer trimestre
                                    @endif
                                    @if(strftime("%m") == 4 && strftime("%d") > 19 && strftime("%d") < 31 && strftime("%Y") == $anio)
                                        Registrando<br>Primer trimestre
                                    @endif
                                    @if(strftime("%m") > 4 && strftime("%m") < 7 && strftime("%Y") == $anio)
                                        Segundo trimestre <br>En proceso
                                    @endif
                                    @if(strftime("%m") == 7 && strftime("%d") > 0 && strftime("%d") < 20 && strftime("%Y") == $anio)
                                        Capturando<br>Segundo trimestre
                                    @endif
                                    @if(strftime("%m") == 7 && strftime("%d") > 19 && strftime("%d") < 31 && strftime("%Y") == $anio)
                                        Registrando<br>Segundo trimestre
                                    @endif
                                    @if(strftime("%m") > 6 && strftime("%m") < 10 && strftime("%Y") == $anio)
                                        Tercer trimestre <br>En proceso
                                    @endif
                                    @if(strftime("%m") == 10 && strftime("%d") > 0 && strftime("%d") < 20 && strftime("%Y") == $anio)
                                        Capturando<br>Tercer trimestre
                                    @endif
                                    @if(strftime("%m") == 10 && strftime("%d") > 19 && strftime("%d") < 31 && strftime("%Y") == $anio)
                                        Registrando<br>Tercer trimestre
                                    @endif
                                    @if(strftime("%m") > 11 && strftime("%m") < 13 && strftime("%Y") == $anio )
                                        Cuarto trimestre <br>En proceso
                                    @endif
                                    @if(strftime("%m") == 1 && strftime("%d") > 0 && strftime("%d") < 20 && strftime("%Y") == ($anio + 1))
                                        Capturando<br>Cuarto trimestre
                                    @endif
                                    @if(strftime("%m") == 1 && strftime("%d") > 19 && strftime("%d") < 31 && strftime("%Y") == ($anio + 1))
                                        Registrando<br>Cuarto trimestre
                                    @endif
                                  </p>

                                  @if(strftime("%m") > 1 && strftime("%Y") == ($anio + 1))
                                      <div class="flex justify-center max-h-8">
                                          <img src="{{ asset('image/Bien.svg') }}" alt="Workflow" >
                                      </div>
                                  @endif

                                
                              </div>
                            </div>
                            <div class="col-span-2 flex justify-center items-center leading-none border p-2">
                              <button type="button" href="" class="btn_detalles text-sm text-blue-500 font-normal text-ms p-2 rounded rounded-lg" onclick="mostrarRM('{{'obra_id_'.$obra->id_obra}}')">Detalles</button>
                            </div>
                            <div id="{{'obra_id_'.$obra->id_obra}}" class="hidden col-span-10 border p-5">
                              
                              <div class="mt-5">
                                <p for="first_name" class="block text-base font-bold text-gray-900 text-center">Matriz de Inversión para el Desarrollo Social</p>
                                <div class="flex justify-center">
                                  <button type="button" href="" class="font-semibold text-sm text-blue-500 underline px-3 text-center" onclick="toggleModalMids('modal-mids', {{$obra->mids}})">Modificar proceso</button>
                                </div>
                                  <div class="grid grid-cols-6 mt-2">
                                    <div class="col-span-2">
                                      <p for="first_name" class="block text-base font-semibold text-gray-900 text-center">Planeación</p>
                                      <div class="mt-2">
                                        @switch($obra->mids->planeado)
                                          @case(1)
                                              <div class="flex justify-center max-h-8">
                                                  <img src="{{ asset('image/Bien.svg') }}" alt="Workflow" >
                                              </div>
                                              <div>
                                                  <p class="block text-base font-semibold text-gray-900 text-center">{{$service->formatDate($obra->mids->fecha_planeado)}}</p>
                                              </div>
                                          @break
                                          @default
                                            <div class="flex justify-center max-h-8">
                                                <img src="{{ asset('image/Mal.svg') }}" alt="Workflow">
                                            </div>
                                        @endswitch
                                      </div>
                                    </div>
                                    <div class="col-span-2">
                                      <p for="first_name" class="block text-base font-semibold text-gray-900 text-center">Proceso de firma</p>
                                      <div class="mt-2">
                                        @switch($obra->mids->firmado)
                                          @case(1)
                                              <div class="flex justify-center max-h-8">
                                                  <img src="{{ asset('image/Bien.svg') }}" alt="Workflow" >
                                              </div>
                                              <div>
                                                  <p class="block text-base font-semibold text-gray-900 text-center">{{$service->formatDate($obra->mids->fecha_firmado)}}</p>
                                              </div>
                                          @break
                                          @default
                                            <div class="flex justify-center max-h-8">
                                                <img src="{{ asset('image/Mal.svg') }}" alt="Workflow">
                                            </div>
                                        @endswitch
                                      </div>
                                    </div>
                                    <div class="col-span-2">
                                      <p for="first_name" class="block text-base font-semibold text-gray-900 text-center">Revisión</p>
                                      <div class="mt-2">
                                        @switch($obra->mids->validado)
                                          @case(1)
                                              <div class="flex justify-center max-h-8">
                                                  <img src="{{ asset('image/Bien.svg') }}" alt="Workflow" >
                                              </div>
                                              <div>
                                                  <p class="block text-base font-semibold text-gray-900 text-center">{{$service->formatDate($obra->mids->fecha_validado)}}</p>
                                              </div>
                                          @break
                                          @default
                                            <div class="flex justify-center max-h-8">
                                                <img src="{{ asset('image/Mal.svg') }}" alt="Workflow">
                                            </div>
                                        @endswitch
                                      </div>
                                    </div>
                                    
                                  </div>
                              </div>
                              <div class=" mt-10">
                                  <p for="first_name" class="block text-base font-bold text-gray-900 text-center">Sistema de Recursos Federales Transferidos</p>
                                  <div class="flex justify-center">
                                    <button type="button" href="" class="font-semibold text-sm text-blue-500 underline px-3" onclick="toggleModalRFT('modal-rft', {{$obra->rft}})">Modificar proceso</button>
                                  </div>
                                  <p for="first_name" class="block text-base font-semibold text-gray-900 text-center mt-2">Avance por trimestre</p>
                                  <div class="grid grid-cols-8 mt-2">
                                    
                                    <div class="col-span-2">
                                      <div class="flex justify-center items-center">
                                          <meter min="0" max="100" low="25" high="75" optimum="100" value="{{$obra->rft->primer_trimestre}}" class="barra-porcentaje">
                                      </div>
                                      <p for="first_name" class="block text-base font-bold text-gray-900 text-center">Primero</p>
                                    </div>
                                    <div class="col-span-2">
                                      <div class="flex justify-center items-center">
                                        <meter min="0" max="100" low="25" high="75" optimum="100" value="{{$obra->rft->segundo_trimestre}}" class="barra-porcentaje">
                                      </div>
                                      <p for="first_name" class="block text-base font-bold text-gray-900 text-center">Segundo</p>
                                    </div>
                                    <div class="col-span-2">
                                      <div class="flex justify-center items-center">
                                        <meter min="0" max="100" low="25" high="75" optimum="100" value="{{$obra->rft->tercer_trimestre}}" class="barra-porcentaje">
                                      </div>
                                      <p for="first_name" class="block text-base font-bold text-gray-900 text-center">Tercero</p>
                                    </div>
                                    <div class="col-span-2">
                                      <div class="flex justify-center items-center">
                                        <meter min="0" max="100" low="25" high="75" optimum="100" value="{{$obra->rft->cuarto_trimestre}}" class="barra-porcentaje">
                                      </div>
                                      <p for="first_name" class="block text-base font-bold text-gray-900 text-center">Cuarto</p>
                                    </div>
                                    
                                  </div>
                              </div>
                            </div>
                          @endforeach
                        
                      </div>
                      
                    </div>
                  </div>
              </div>
          </div>
      </div>
    </div>
    @endif

    <div class="border-b p-4 ">
        <div class="flex justify-between items-center">
            <h1 for="first_name" class="text-xl font-bold">Fuentes de financiamiento</h1>
            <div>
              @if($fuentes_cliente->first() != '')
                <a type="button" href="{{ route('create_obra', [$cliente->id_cliente, $anio]) }}" class="bg-transparent text-sm text-blue-500 font-semibold text-base p-2 rounded rounded-lg underline">Agregar obra</a>
              @endif
              <button type="button" href=""
                      class="bg-transparent text-sm text-blue-500 font-semibold text-base p-2 rounded rounded-lg underline" onclick="toggleModal('modal')">Agregar fuente</button>
            </div>
            
        </div>
    </div>

    <div class="">
        @if($fuentes_cliente->first() == '')
          <div class="flex justify-center mt-10">
            <label class="block text-base font-semibold text-gray-700">El municipio no tiene ninguna fuente de financiamiento agregada.</label>
          </div>
        @endif
        @foreach ($fuentes_cliente as $fuente_cliente)
                <div class="mt-6 shadow-xl bg-white rounded-lg pb-10">
                    <div class="border-b p-4 flex justify-between items-center">
                        <span class="inline-block text-xl font-medium font-semibold">{{$fuente_cliente->nombre_corto}}</span>
                        <button type="button"
                          href=""
                          class="text-base text-white bg-blue-500 p-2 rounded-lg px-6" onclick="toggleModal_1('modal-edit', {{$fuente_cliente}}, '{{$service->formatNumber($fuente_cliente->monto_proyectado)}}', '{{$service->formatNumber($fuente_cliente->monto_comprometido)}}')">{{$fuente_cliente->fuente_financiamiento_id == 2?'Editar':'Detalles'}}</button>
                        
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
                            <table id="example1" class="table table-striped bg-white" style="width:100%;">
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
                                                      href="{{ route('obra.ver', $obra_fuente->obra_id) }}"
                                                      class="bg-white text-sm text-blue-500 font-normal text-ms p-2 rounded rounded-lg">Detalles</a>
                                                  <!--<a type="button"
                                                      href="{{ route('cabildo.edit', 1) }}"
                                                      class="bg-white text-sm text-blue-500 font-normal text-ms p-2 rounded rounded-lg">Editar</a>-->
                                              </div>
                                          </td>
                                          
                                      </tr>
                                  @endforeach
                                </tbody>
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
                  <input type="text" name="monto_comprometido" id="monto_comprometido" class="hidden border-none block text-base font-medium text-gray-700 py-3 px-2" value="0.00">
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
                    <input type="date" name="acta_integracion_consejo" id="acta_integracion_consejo" min="{{$anio}}-02-01" max="{{$anio}}-12-31" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" >
                    <label id="error_acta_integracion_consejo" name="error_acta_integracion_consejo" class="hidden text-base font-normal text-red-500" >Ingrese una fecha valida</label>  
                </div>
                <div class="col-span-5 fondoIII">
                    <label id="label_acta_priorizacion" for="acta_priorizacion" class="block text-sm font-bold text-gray-700">Acta priorización *</label>
                    <input type="date" name="acta_priorizacion" id="acta_priorizacion" min="{{$anio}}-02-01" max="{{$anio}}-12-31" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    <label id="error_acta_priorizacion" name="error_acta_priorizacion" class="hidden text-base font-normal text-red-500" >Ingrese una fecha valida</label>  
                </div>
                <div class="col-span-5 fondoIII">
                    <label for="adendum_priorizacion" class="block text-sm font-bold text-gray-700">Adendum priorización</label>
                    <input type="date" name="adendum_priorizacion" id="adendum_priorizacion" min="{{$anio}}-02-01" max="{{$anio}}-12-31" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" >
                    <label id="error_adendum_priorizacion" name="error_adendum_priorizacion" class="hidden text-base font-normal text-red-500" >Ingrese una fecha valida</label>  
                </div>
              <div class="col-span-5 lg:col-span-5 fondoIII">
                  <div>
                    <label for="cbox2" class="text-sm font-medium text-gray-700"><input type="checkbox" id="prodim" name="prodim" > PRODIMDF</label><br>
                    <div id="div_prodim" class="hidden mt-5 mb-5">
                      <label  class="text-sm font-bold text-gray-700">Porcentaje PRODIM</label>
                      <input type="text" name="porcentaje_prodim" id="porcentaje_prodim" step="any" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="0.00">
                      <label id="label_porcentaje_p_tex" class="block text-sm font-bold text-gray-700" >Monto del porcentaje de PRODIM:<br>$ 0.00</label>  
                      <label id="error_porcentaje_prodim" name="error_porcentaje_prodim" class="block hidden text-base font-normal text-red-500" >Ingrese un porcentaje valido, máximo 2.</label>  
                    </div>
                    <label for="cbox2" class="text-sm font-medium text-gray-700"><input type="checkbox" id="gastos_indirectos" name="gastos_indirectos" > Gastos indirectos</label>
                    <div id="div_gastos_indirectos" class="hidden mt-5 mb-5">
                      <label  class="text-sm font-bold text-gray-700">Porcentaje Gastos Indirectos</label>
                      <input type="text" name="porcentaje_gastos" id="porcentaje_gastos"  min="0" max="3" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="0.00">
                      <label id="label_porcentaje_gi_tex" class="block text-sm font-bold" >Monto del porcentaje de Gastos Indirectos:<br>$ 0.00</label> 
                      <label id="error_porcentaje_gastos" name="error_porcentaje_gastos" class="block mb-5 hidden text-base font-normal text-red-500" >Ingrese un porcentaje valido, máximo 3.</label>  
                    </div>
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
          <button class="p-1 ml-auto bg-transparent border-0 text-black float-right text-3xl leading-none font-semibold outline-none focus:outline-none" onclick="toggleModal('modal-edit')">
            <span class="bg-transparent text-red-500 h-6 w-6 text-2xl block outline-none focus:outline-none">
              X
            </span>
          </button>

          
        </div>
        <!--body-->
        <form action="{{ route('update_fuente') }}" method="POST" id="formulario-edit" name="formulario-edit">
            @csrf
            @method('POST')
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
                <label for="label_monto_comprometido_edit" class="block text-sm font-bold text-gray-700">Monto comprometido</label>
                <label id="label_monto_comprometido_edit" for="monto-comprometido" class="block text-base font-medium text-gray-700 py-3 px-2">$ 0.00</label>
              </div>
                <div class="col-span-8 sm:col-span-5">
                  <label for="label_monto_proyectado_edit" class="block text-sm font-bold text-gray-700">Monto proyectado *</label>
                  <label id="label_monto_proyectado_edit" class="block text-base font-medium text-gray-700 py-3 px-2">$ 0.00</label>
              </div>
              
              <div class="col-span-5">
                <label for="fuente_financiamiento_id" class="block text-sm font-bold text-gray-700">Fuente de financiamiento *</label>
                <label id="fuente_financiamiento_edit" for="fuente_financiemiento_id_edit" class="block text-base font-medium text-gray-700 py-3 px-2">$0.00</label>
              </div>
  
              <div class="col-span-5 fondo_3">
                  <label id="label_acta_integracion_consejo" for="acta_integracion_consejo" class="block text-sm font-bold text-gray-700">Acta integracion *</label>
                  <input type="date" name="acta_integracion_consejo_edit" id="acta_integracion_consejo_edit"  min="{{$anio}}-02-01" max="{{$anio}}-12-31" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" >
                  <label id="error_acta_integracion_consejo" name="error_acta_integracion_consejo" class="hidden text-base font-normal text-red-500" >Por favor ingresar una Fecha</label>  
              </div>
              <div class="col-span-5 fondo_3">
                  <label id="label_acta_priorizacion" for="acta_priorizacion" class="block text-sm font-bold text-gray-700">Acta priorización *</label>
                  <input type="date" name="acta_priorizacion_edit" id="acta_priorizacion_edit"  min="{{$anio}}-02-01" max="{{$anio}}-12-31" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" >
                  <label id="error_acta_priorizacion_edit" name="error_acta_priorizacion_edit" class="hidden text-base font-normal text-red-500" >Por favor ingresar una Fecha</label>  
              </div>
              <div class="col-span-5 fondo_3">
                  <label for="adendum_priorizacion" class="block text-sm font-bold text-gray-700">Adendum priorización *</label>
                  <input type="date" name="adendum_priorizacion_edit" id="adendum_priorizacion_edit"  min="{{$anio}}-02-01" max="{{$anio}}-12-31" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" >
                  <label id="error_adendum_priorizacion_edit" name="error_adendum_priorizacion_edit" class="hidden text-base font-normal text-red-500" >Por favor ingresar una Fecha</label>  
              </div>
            <div class="col-span-5 lg:col-span-5 fondo_3">
                <div id="div_prodim_edit" class="mb-5">
                  <label id="label_prodim" class="block text-sm font-bold text-gray-700" ></label>  
                </div>
                <div id="div_gastos_edit" class="mt-5 mb-5">
                  <label id="label_gastos" class="block text-sm font-bold text-gray-700" ></label>  
                </div>
            </div>
          </div>
          
        </div>
        <!--footer-->
        <div id="div_button_edit" class=" p-4 border-t border-solid border-blueGray-200 rounded-b">
          
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

  <!-- inicio modal -->
  @if($prodim != null)
    <div class="hidden overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center" id="modal-comprometido">
      <div class="relative w-auto my-6 mx-auto max-w-3xl">
        <!--content-->
        <div class="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none">
          <!--header-->
          <div class="flex items-start justify-between p-5 border-b border-solid border-blueGray-200 rounded-t">
            <h4 class="text-xl font-semibold">
              Agregar nuevo concepto al PRODIM
            </h4>
            <button class="p-1 ml-auto bg-transparent border-0 text-black opacity-5 float-right text-3xl leading-none font-semibold outline-none focus:outline-none" onclick="toggleModal('modal-comprometido')">
              <span class="bg-transparent text-black opacity-5 h-6 w-6 text-2xl block outline-none focus:outline-none"> </span>
            </button>
          </div>
          <!--body-->
          <form action="{{ route('store_prodim') }}" method="POST" id="formulario_prodim" name="formulario_prodim">
            @csrf
            @method('POST')
            <div class="relative p-6 flex-auto">
                <div class="grid grid-cols-10 gap-4">
                  <div class="col-span-5 sm:col-span-5 ">
                    <label  id="label_cliente_id" for="cliente_id" class="block text-sm font-bold text-gray-700">Municipio</label>
                    <label id="cliente_id" class="block text-base font-medium text-gray-700 py-3 px-2">{{$cliente->nombre_municipio}}</label>
                    <input type="text" name="cliente_id" class="hidden border-none block text-base font-medium text-gray-700 py-3 px-2" value="{{$cliente->id_cliente}}">
                    <input type="text" name="prodim_id" id="prodim_id" class="hidden border-none block text-base font-medium text-gray-700 py-3 px-2" value="{{$prodim->id_prodim}}">
                  </div>
                  <div class="col-span-3 sm:col-span-2">
                    <label id="label_ejercicio" for="label_ejercicio" class="block text-sm font-bold text-gray-700">Ejercicio</label>
                    <label class="block text-base font-medium text-gray-700 py-3 px-2">{{$anio}}</label>
                    <input type="text" name="ejercicio" id="ejercicio" class="hidden border-none block text-base font-medium text-gray-700 py-3 px-2" value="{{$anio}}">
                  </div>
                  <div class="col-span-10 sm:col-span-3">
                    <label for="label_monto_asignado_prodim" class="block text-sm font-bold text-gray-700">Monto asignado</label>
                    <label id="label_monto_asignado_prodim" for="label_monto_asignado_prodim" class="block text-base font-medium text-gray-700 py-3 px-2">{{$service->formatNumber($fuentes_cliente->where('fuente_financiamiento_id', 2)->first()->monto_prodim)}}</label>
                  </div>
                  <div class="col-span-10 select2_modificado">
                    <label for="fuente_financiamiento_id" class="block text-sm font-bold text-gray-700">Programa*</label>
                    <select class="js-example-basic-single mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" name="programa_id">
                      @foreach($catalogo_prodim as $concepto)
                          <option value="{{ $concepto->id_prodim_catalogo }}" class="whitespace-normal w-full bg-green-500 overflow-hidden"><p class="w-full">{{ $concepto->nombre }}</p> </option>
                      @endforeach
                    </select>
                  </div>
                  <div class="col-span-10 sm:col-span-5">
                    <label id="label_fecha_asignacion" for="fecha_asignacion" class="block text-sm font-bold text-gray-700">Fecha asignación*</label>
                    <input type="date" name="fecha_asignacion" id="fecha_asignacion" min="{{$anio}}-02-01" max="{{$anio}}-12-31" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" >
                    <label id="error_fecha_asignacion" name="error_fecha_asignacion" class="hidden text-base font-normal text-red-500" >Ingrese una fecha valida</label>  
                  </div>
                  <div class="col-span-10 sm:col-span-5">
                    <label id="label_monto_prodim" for="label_monto_prodim" class="block text-sm font-bold text-gray-700">Monto*</label>
                    <div class="relative ">
                      <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <span class="text-gray-700 text-base">
                          $
                        </span>
                      </div>
                      <input type="text" name="monto_prodim" id="monto_prodim" maxlength="20" class="pl-7  mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" placeholder="0.00">
                    </div>
                      <label id="error_monto_prodim_superior" name="error_monto_prodim" class="hidden block text-base font-normal text-red-500" >El monto es mayor que el monto restante del PRODIM {{$service->formatNumber($fuentes_cliente->where('fuente_financiamiento_id', 2)->first()->monto_prodim - $total_prodim?$total_prodim:0 )}}.</label>
                      <label id="error_monto_prodim" name="error_monto_prodim" class="hidden block text-base font-normal text-red-500" >Ingrese una cantidad valida</label>
                  </div>
              </div>
              
            </div>
          <!--footer-->
          <div class=" p-4 border-t border-solid border-blueGray-200 rounded-b">
            
            <span class="block text-xs">Verifique los campos obligatorios marcados con un ( * ) </span>
            <div class="text-right">
            <button class="text-red-500 background-transparent font-bold uppercase px-6 py-2 text-sm outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="button" onclick="toggleModal('modal-comprometido')">
              Cancelar
            </button>
            <button type="submit" id="guardar_comp_prodim" class="bg-green-500 text-white active:bg-green-600 font-bold uppercase text-sm px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" >
              Guardar
            </button>
            </div>
          </div>
          </form>
        </div>
      </div>
    </div>

    <div class="hidden overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center" id="modal-concepto">
      <div class="relative w-auto my-6 mx-auto max-w-3xl">
        <!--content-->
        <div class="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none">
          <!--header-->
          <div class="flex items-start justify-between p-5 border-b border-solid border-blueGray-200 rounded-t">
            <h4 class="text-xl font-semibold">
              Agregar nuevo concepto al PRODIM
            </h4>
            <button class="p-1 ml-auto bg-transparent border-0 text-black opacity-5 float-right text-3xl leading-none font-semibold outline-none focus:outline-none" onclick="toggleModal('modal-concepto')">
              <span class="bg-transparent text-black opacity-5 h-6 w-6 text-2xl block outline-none focus:outline-none"> </span>
            </button>
          </div>
          <!--body-->
          <form action="{{ route('store_concepto') }}" method="POST" id="formulario_concepto" name="formulario_concepto">
            @csrf
            @method('POST')
            <div class="relative p-6 flex-auto">
                <div class="grid grid-cols-10 gap-4">
                  <div class="col-span-5 sm:col-span-10 ">
                    <label  id="label_programa_prodim" for="programa_prodim" class="block text-sm font-bold text-gray-700">Programa:</label>
                    <label id="programa_prodim" class="block text-base font-medium text-gray-700 py-3 px-2"></label>
                    <input type="text" name="cliente_id" class="hidden border-none block text-base font-medium text-gray-700 py-3 px-2" value="{{$cliente->id_cliente}}">
                    <input type="text" name="ejercicio" id="ejercicio" class="hidden border-none block text-base font-medium text-gray-700 py-3 px-2" value="{{$anio}}">
                    <input type="text" name="comprometido_id" id="comprometido_id" class="hidden border-none block text-base font-medium text-gray-700 py-3 px-2" value="">
                  </div>
                  <div class="col-span-10 sm:col-span-3">
                    <label for="label_monto_asignado_conc" class="block text-sm font-bold text-gray-700">Monto correspondiente</label>
                    <label id="label_monto_asignado_conc" for="label_monto_asignado_conc" class="block text-base font-medium text-gray-700 py-3 px-2"></label>
                  </div>
                  <div class="col-span-10 sm:col-span-3">
                    <label for="label_monto_restante_conc" class="block text-sm font-bold text-gray-700">Monto restante</label>
                    <label id="label_monto_restante_conc" for="label_monto_restante_conc" class="block text-base font-medium text-gray-700 py-3 px-2"></label>
                  </div>
                  <div class="col-span-10 sm:col-span-4">
                    <label id="label_monto_concepto" for="label_monto_concepto" class="block text-sm font-bold text-gray-700">Monto*</label>
                    <div class="relative ">
                      <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <span class="text-gray-700 text-base">
                          $
                        </span>
                      </div>
                      <input type="text" name="monto_concepto" id="monto_concepto" maxlength="20" class="pl-7  mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" placeholder="0.00">
                    </div>
                      <label id="error_monto_concepto_superior" name="error_monto_concepto" class="hidden text-base font-normal text-red-500" >El monto es mayor que el monto restante del programa <span id="total_restante_programa"></span>.</label>
                      <label id="error_monto_concepto" name="error_monto_concepto" class="hidden text-base font-normal text-red-500" >Ingrese una cantidad valida</label>
                  </div>
                  <div class="col-span-10 select2_modificado">
                    <label for="label_concepto_prodim" id="label_concepto_prodim" class="block text-sm font-bold text-gray-700">Concepto:*</label>
                    <input type="text" name="concepto_prodim" id="concepto_prodim" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="">
                    <label id="error_concepto_prodim" name="error_concepto_prodim" class="hidden text-base font-normal text-red-500" >Ingrese un concepto valido</label>
                  </div>
              </div>
              
            </div>
          <!--footer-->
          <div class=" p-4 border-t border-solid border-blueGray-200 rounded-b">
            
            <span class="block text-xs">Verifique los campos obligatorios marcados con un ( * ) </span>
            <div class="text-right">
            <button class="text-red-500 background-transparent font-bold uppercase px-6 py-2 text-sm outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="button" onclick="toggleModal('modal-concepto')">
              Cancelar
            </button>
            <button type="submit" id="guardar_concepto" class="bg-green-500 text-white active:bg-green-600 font-bold uppercase text-sm px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" >
              Guardar
            </button>
            </div>
          </div>
          </form>
        </div>
      </div>
    </div>

    <div class="hidden overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center" id="modal-proceso">
      <div class="relative w-auto my-6 mx-auto max-w-3xl">
        <!--content-->
        <div class="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none">
          <!--header-->
          <div class="flex items-start justify-between p-5 border-b border-solid border-blueGray-200 rounded-t">
            <h4 class="text-xl font-semibold">
              Actualizar proceso del PRODIM
            </h4>
            <button class="p-1 ml-auto bg-transparent border-0 text-black opacity-5 float-right text-3xl leading-none font-semibold outline-none focus:outline-none" onclick="toggleModal('modal-proceso')">
              <span class="bg-transparent text-black opacity-5 h-6 w-6 text-2xl block outline-none focus:outline-none"> </span>
            </button>
          </div>
          <!--body-->
          <form action="{{ route('update_prodim') }}" method="POST" id="formulario_proceso" name="formulario_proceso">
            @csrf
            @method('POST')
            <div class="relative p-6 flex-auto">
                <div class="grid grid-cols-10 gap-4">
                  <div class="hidden">
                    <input type="text" name="cliente_id" class="hidden border-none block text-base font-medium text-gray-700 py-3 px-2" value="{{$cliente->id_cliente}}">
                    <input type="text" name="ejercicio" id="ejercicio" class="hidden border-none block text-base font-medium text-gray-700 py-3 px-2" value="{{$anio}}">
                    <input type="text" name="prodim_id" id="prodim_id" class="hidden border-none block text-base font-medium text-gray-700 py-3 px-2" value="{{$prodim->id_prodim}}">
                  </div>
                    @if($prodim->presentado == 1)
                        <div class="col-span-5">
                            <label class="block text-sm font-semibold text-gray-700">Fecha de presentación*</label>
                            <div id="label_fecha_presentado" class="mt-1 py-2 px-3">
                                <label class="text-base font-bold text-gay-500" >{{$service->formatDate($prodim->fecha_presentado)}}</label>
                            </div>
                        </div>
                    @else
                        <div  id="div_presentado" class="col-span-5">
                            <label class="block text-sm font-semibold text-gray-700">Fecha de presentación*</label>
                            <input type="date" name="fecha_presentado" id="fecha_presentado" min="{{$anio}}-02-01" max="{{$anio}}-12-31" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" >
                            <label id="error_fecha_presentado" class="hidden text-base font-normal text-red-500" >Ingrese una fecha valida</label>    
                        </div>
                    @endif
                    @if($prodim->revisado == 1)
                        <div class="col-span-5">
                            <label class="block text-sm font-semibold text-gray-700">Fecha de revisión*</label>
                            <div id="label_fecha_revisado" class="mt-1 py-2 px-3">
                                <label class="text-base font-bold text-gay-500" >{{$service->formatDate($prodim->fecha_revisado)}}</label>
                            </div>
                        </div>
                    @else
                        <div  id="div_revisado" class="{{$prodim->presentado == 1?'':'hidden'}} col-span-5">
                            <label id="label_fecha_revisado" class="block text-sm font-semibold text-gray-700">Fecha de revisión*</label>
                            <input type="date" name="fecha_revisado" id="fecha_revisado" min="{{$prodim->fecha_presentado?$prodim->fecha_presentado:$anio.'-02-01'}}" max="{{$anio}}-12-31" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" >
                            <label id="error_fecha_revisado" class="hidden text-base font-normal text-red-500" >Ingrese una fecha valida</label>    
                        </div>
                    @endif
                    @if($prodim->aprovado == 1)
                        <div class="col-span-5">
                            <label class="block text-sm font-semibold text-gray-700">Fecha de aprovación*</label>
                            <div id="label_fecha_aprovado" class="mt-1 py-2 px-3">
                                <label class="text-base font-bold text-gay-500" >{{$service->formatDate($prodim->fecha_aprovado)}}</label>
                            </div>
                        </div>
                    @else
                        <div  id="div_aprovado" class="{{$prodim->revisado == 1?'':'hidden'}} col-span-5">
                            <label id="label_fecha_aprovado" class="block text-sm font-semibold text-gray-700">Fecha de aprovación * </label>
                            <input type="date" name="fecha_aprovado" id="fecha_aprovado" min="{{$prodim->fecha_revisado?$prodim->fecha_revisado:$anio.'-02-01'}}" max="{{$anio}}-12-31" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" >
                            <label id="error_fecha_aprovado" class="hidden text-base font-normal text-red-500" >Ingrese una fecha valida</label>    
                        </div>
                    @endif

                    @if($prodim->convenio == 1)
                        <div class="col-span-5">
                            <label class="block text-sm font-semibold text-gray-700">Firma de convenio*</label>
                            <div id="label_fecha_convenio" class="mt-1 py-2 px-3">
                                <label class="text-base font-bold text-gay-500" >{{$service->formatDate($prodim->fecha_convenio)}}</label>
                            </div>
                        </div>
                    @else
                        <div  id="div_convenio" class="{{$prodim->aprovado == 1?'':'hidden'}} col-span-5">
                            <label id="label_fecha_convenio" class="block text-sm font-semibold text-gray-700">Firma de convenio*</label>
                            <input type="date" name="fecha_convenio" id="fecha_convenio" min="{{$prodim->fecha_aprovado?$prodim->fecha_aprovado:$anio.'-02-01'}}" max="{{$anio}}-12-31" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" >
                            <label id="error_fecha_convenio" class="hidden text-base font-normal text-red-500" >Ingrese una fecha valida</label>    
                        </div>
                    @endif
              </div>
              
            </div>
          <!--footer-->
          <div class=" p-4 border-t border-solid border-blueGray-200 rounded-b">
            
            <span class="block text-xs">Verifique los campos obligatorios marcados con un ( * ) </span>
            <div class="text-right">
            <button class="text-red-500 background-transparent font-bold uppercase px-6 py-2 text-sm outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="button" onclick="toggleModal('modal-proceso')">
              Cancelar
            </button>
            <button type="submit" id="guardar_proceso" class="bg-green-500 text-white active:bg-green-600 font-bold uppercase text-sm px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" >
              Guardar
            </button>
            </div>
          </div>
          </form>
        </div>
      </div>
    </div>
  @endif

  @if($fuentes_cliente->where('fuente_financiamiento_id', 2)->first() != null && $fuentes_cliente->where('fuente_financiamiento_id', 2)->first()->gastos_indirectos)
    <div class="hidden overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center" id="modal-gi">
      <div class="relative w-auto my-6 mx-auto max-w-3xl">
        <!--content-->
        <div class="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none">
          <!--header-->
          <div class="flex items-start justify-between p-5 border-b border-solid border-blueGray-200 rounded-t">
            <h4 class="text-xl font-semibold">
              Agregar nuevo concepto a Gastos Indirectos
            </h4>
            <button class="p-1 ml-auto bg-transparent border-0 text-black opacity-5 float-right text-3xl leading-none font-semibold outline-none focus:outline-none" onclick="toggleModal('modal-gi')">
              <span class="bg-transparent text-black opacity-5 h-6 w-6 text-2xl block outline-none focus:outline-none"> </span>
            </button>
          </div>
          <!--body-->
          <form action="{{ route('store_gi') }}" method="POST" id="formulario_gi" name="formulario_gi">
            @csrf
            @method('POST')
            <div class="relative p-6 flex-auto">
                <div class="grid grid-cols-10 gap-4">
                  <div class="col-span-5 sm:col-span-5 ">
                    <label  id="label_cliente_id" for="cliente_id" class="block text-sm font-bold text-gray-700">Municipio</label>
                    <label id="cliente_id" class="block text-base font-medium text-gray-700 py-3 px-2">{{$cliente->nombre_municipio}}</label>
                    <input type="text" name="cliente_id" class="hidden border-none block text-base font-medium text-gray-700 py-3 px-2" value="{{$cliente->id_cliente}}">
                    <input type="text" name="fuente_id" id="fuente_id" class="hidden border-none block text-base font-medium text-gray-700 py-3 px-2" value="{{$fuentes_cliente->where('fuente_financiamiento_id', 2)->first()->id_fuente_financ_cliente}}">
                  </div>
                  <div class="col-span-3 sm:col-span-2">
                    <label id="label_ejercicio" for="label_ejercicio" class="block text-sm font-bold text-gray-700">Ejercicio</label>
                    <label class="block text-base font-medium text-gray-700 py-3 px-2">{{$anio}}</label>
                    <input type="text" name="ejercicio" id="ejercicio" class="hidden border-none block text-base font-medium text-gray-700 py-3 px-2" value="{{$anio}}">
                  </div>
                  <div class="col-span-10 sm:col-span-3">
                    <label for="label_monto_asignado_gi" class="block text-sm font-bold text-gray-700">Monto asignado</label>
                    <label id="label_monto_asignado_gi" for="label_monto_asignado_gi" class="block text-base font-medium text-gray-700 py-3 px-2">{{$service->formatNumber($fuentes_cliente->where('fuente_financiamiento_id', 2)->first()->monto_gastos)}}</label>
                  </div>
                  <div class="col-span-10 select2_modificado">
                    <label for="gi_catalogo_id" class="block text-sm font-bold text-gray-700">Programa*</label>
                    <select class="js-example-basic-single mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" name="gi_catalogo_id">
                      @foreach($catalogo_gi as $concepto)
                          <option value="{{ $concepto->id_indirectos }}" class="whitespace-normal w-full bg-green-500 overflow-hidden"><p class="w-full">{{ $concepto->nombre }}</p> </option>
                      @endforeach
                    </select>
                  </div>
                  <div class="col-span-10 sm:col-span-5">
                    <label id="label_fecha_asignacion_gi" for="fecha_asignacion" class="block text-sm font-bold text-gray-700">Fecha asignación*</label>
                    <input type="date" name="fecha_asignacion_gi" id="fecha_asignacion_gi" min="{{$anio}}-02-01" max="{{$anio}}-12-31" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" >
                    <label id="error_fecha_asignacion_gi" name="error_fecha_asignacion_gi" class="hidden text-base font-normal text-red-500" >Ingrese una fecha valida</label>  
                  </div>
                  <div class="col-span-10 sm:col-span-5">
                    <label id="label_monto_gi" class="block text-sm font-bold text-gray-700">Monto*</label>
                    <div class="relative ">
                      <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <span class="text-gray-700 text-base">
                          $
                        </span>
                      </div>
                      <input type="text" name="monto_gi" id="monto_gi" maxlength="20" class="pl-7  mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" placeholder="0.00">
                    </div>
                      <label id="error_monto_gi_superior" name="error_monto_gi_superior" class="hidden block text-base font-normal text-red-500" >El monto es mayor que el total restante de Gastos Indirectos {{$service->formatNumber($fuentes_cliente->where('fuente_financiamiento_id', 2)->first()->monto_gastos -$total_gi )}}.</label>
                      <label id="error_monto_gi" name="error_monto_gi" class="hidden block text-base font-normal text-red-500" >Ingrese una cantidad valida</label>
                  </div>
              </div>
              
            </div>
          <!--footer-->
          <div class=" p-4 border-t border-solid border-blueGray-200 rounded-b">
            
            <span class="block text-xs">Verifique los campos obligatorios marcados con un ( * ) </span>
            <div class="text-right">
            <button class="text-red-500 background-transparent font-bold uppercase px-6 py-2 text-sm outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="button" onclick="toggleModal('modal-gi')">
              Cancelar
            </button>
            <button type="submit" id="guardar_comp_gi" class="bg-green-500 text-white active:bg-green-600 font-bold uppercase text-sm px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" >
              Guardar
            </button>
            </div>
          </div>
          </form>
        </div>
      </div>
    </div>
  @endif
  @if($fuente_f3)
    <div class="hidden overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center" id="modal-sisplade">
      <div class="relative w-auto my-6 mx-auto max-w-3xl">
        <!--content-->
        <div class="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none">
          <!--header-->
          <div class="flex items-start justify-between p-5 border-b border-solid border-blueGray-200 rounded-t">
            <h4 class="text-xl font-semibold">
              Modificar proceso SISPLADE
            </h4>
            <button class="p-1 ml-auto bg-transparent border-0 text-black opacity-5 float-right text-3xl leading-none font-semibold outline-none focus:outline-none" onclick="toggleModal('modal-sisplade')">
              <span class="bg-transparent text-black opacity-5 h-6 w-6 text-2xl block outline-none focus:outline-none"> </span>
            </button>
          </div>
          <!--body-->
          <form action="{{ route('update_sisplade') }}" method="POST" id="formulario_sisplade" name="formulario_sisplade">
            @csrf
            @method('POST')
            <div class="relative p-6 flex-auto">
                <div class="grid grid-cols-10 gap-4">
                  <div class="col-span-5 sm:col-span-10 ">
                    <input type="text" name="cliente_id" class="hidden border-none block text-base font-medium text-gray-700 py-3 px-2" value="{{$cliente->id_cliente}}">
                    <input type="text" name="ejercicio" class="hidden border-none block text-base font-medium text-gray-700 py-3 px-2" value="{{$anio}}">
                    <input type="text" name="sisplade_id" id="sisplade_id" class="hidden border-none block text-base font-medium text-gray-700 py-3 px-2" value="{{$sisplade->id_sisplade}}">
                  </div>
                  <div class="col-span-10 sm:col-span-5">
                    <label id="label_fecha_capturado" for="fecha_capturado" class="block text-sm font-bold text-gray-700">Fecha de captura*</label>
                    <input type="date" name="fecha_capturado" id="fecha_capturado" min="{{$fuente_f3->acta_priorizacion}}" max="{{$anio}}-12-31" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{$sisplade->fecha_capturado}}">
                    <label id="error_fecha_capturado" name="error_fecha_capturado" class="hidden text-base font-normal text-red-500" >Ingrese una fecha valida</label>  
                  </div>
                  <div class="col-span-10 sm:col-span-5">
                    <label id="label_fecha_validacion" for="fecha_validacion" class="block text-sm font-bold text-gray-700">Fecha de validación</label>
                    <input type="date" name="fecha_validacion" id="fecha_validacion" min="{{$sisplade->capturado==2?$fuente_f3->acta_priorizacion:$sisplade->fecha_capturado}}" max="{{$anio}}-12-31" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{$sisplade->fecha_validado}}">
                    <label id="error_fecha_validacion" name="error_fecha_validacion" class="hidden text-base font-normal text-red-500" >Ingrese una fecha valida</label>  
                  </div>
              </div>
              
            </div>
          <!--footer-->
          <div class=" p-4 border-t border-solid border-blueGray-200 rounded-b">
            
            <span class="block text-xs">Verifique los campos obligatorios marcados con un ( * ) </span>
            <div class="text-right">
            <button class="text-red-500 background-transparent font-bold uppercase px-6 py-2 text-sm outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="button" onclick="toggleModal('modal-sisplade')">
              Cancelar
            </button>
            <button type="submit" id="guardar_sisplade" class="bg-green-500 text-white active:bg-green-600 font-bold uppercase text-sm px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" >
              Guardar
            </button>
            </div>
          </div>
          </form>
        </div>
      </div>
    </div>

    <div class="hidden overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center" id="modal-mids">
      <div class="relative w-auto my-6 mx-auto max-w-3xl">
        <!--content-->
        <div class="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none">
          <!--header-->
          <div class="flex items-start justify-between p-5 border-b border-solid border-blueGray-200 rounded-t">
            <h4 class="text-xl font-semibold">
              Modificar proceso MIDS
            </h4>
            <button class="p-1 ml-auto bg-transparent border-0 text-black opacity-5 float-right text-3xl leading-none font-semibold outline-none focus:outline-none" onclick="toggleModal('modal-mids')">
              <span class="bg-transparent text-black opacity-5 h-6 w-6 text-2xl block outline-none focus:outline-none"> </span>
            </button>
          </div>
          <!--body-->
          <form action="{{ route('update_mids') }}" method="POST" id="formulario_mids" name="formulario_mids">
            @csrf
            @method('POST')
            <div class="relative p-6 flex-auto">
                <div class="grid grid-cols-10 gap-4">
                  <div class="col-span-5 sm:col-span-10 ">
                    <input type="text" name="cliente_id" class="hidden border-none block text-base font-medium text-gray-700 py-3 px-2" value="{{$cliente->id_cliente}}">
                    <input type="text" name="ejercicio" class="hidden border-none block text-base font-medium text-gray-700 py-3 px-2" value="{{$anio}}">
                    <input type="text" name="mids_id" id="mids_id" class="hidden border-none block text-base font-medium text-gray-700 py-3 px-2" value="">
                  </div>
                  <div class="col-span-10 sm:col-span-5">
                    <label id="label_fecha_planeacion" for="fecha_planeacion" class="block text-sm font-bold text-gray-700">Fecha de captura*</label>
                    <input type="date" name="fecha_planeacion" id="fecha_planeacion" min="{{$fuente_f3->acta_priorizacion}}" max="{{$anio}}-12-31" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{$sisplade->fecha_capturado}}">
                    <label id="error_fecha_planeacion" name="error_fecha_planeacion" class="hidden text-base font-normal text-red-500" >Ingrese una fecha valida</label>  
                  </div>
                  <div id="div_fecha_firma" class="col-span-10 sm:col-span-5">
                    <label id="label_fecha_firma" for="fecha_firma" class="block text-sm font-bold text-gray-700">Fecha de firma*</label>
                    <input type="date" name="fecha_firma" id="fecha_firma" min="{{$fuente_f3->acta_priorizacion}}" max="{{$anio}}-12-31" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{$sisplade->fecha_capturado}}">
                    <label id="error_fecha_firma" name="error_fecha_firma" class="hidden text-base font-normal text-red-500" >Ingrese una fecha valida</label>  
                  </div>
                  <div id="div_fecha_revision" class="col-span-10 sm:col-span-5">
                    <label id="label_fecha_revision" for="fecha_revision" class="block text-sm font-bold text-gray-700">Fecha de revisión*</label>
                    <input type="date" name="fecha_revision" id="fecha_revision" min="{{$fuente_f3->acta_priorizacion}}" max="{{$anio}}-12-31" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{$sisplade->fecha_capturado}}">
                    <label id="error_fecha_revision" name="error_fecha_revision " class="hidden text-base font-normal text-red-500" >Ingrese una fecha valida</label>  
                  </div>
                  
              </div>
              
            </div>
          <!--footer-->
          <div class=" p-4 border-t border-solid border-blueGray-200 rounded-b">
            
            <span class="block text-xs">Verifique los campos obligatorios marcados con un ( * ) </span>
            <div class="text-right">
            <button class="text-red-500 background-transparent font-bold uppercase px-6 py-2 text-sm outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="button" onclick="toggleModal('modal-mids')">
              Cancelar
            </button>
            <button type="submit" id="guardar_sisplade" class="bg-green-500 text-white active:bg-green-600 font-bold uppercase text-sm px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" >
              Guardar
            </button>
            </div>
          </div>
          </form>
        </div>
      </div>
    </div>
    
    <div class="hidden overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center" id="modal-rft">
      <div class="relative w-auto my-6 mx-auto max-w-3xl">
        <!--content-->
        <div class="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none">
          <!--header-->
          <div class="flex items-start justify-between p-5 border-b border-solid border-blueGray-200 rounded-t">
            <h4 class="text-xl font-semibold">
              Modificar proceso RFT
            </h4>
            <button class="p-1 ml-auto bg-transparent border-0 text-black opacity-5 float-right text-3xl leading-none font-semibold outline-none focus:outline-none" onclick="toggleModal('modal-rft')">
              <span class="bg-transparent text-black opacity-5 h-6 w-6 text-2xl block outline-none focus:outline-none"> </span>
            </button>
          </div>
          <!--body-->
          <form action="{{ route('update_sisplade') }}" method="POST" id="formulario_rft" name="formulario_rft">
            @csrf
            @method('POST')
            <div class="relative p-6 flex-auto">
                <div class="grid grid-cols-10 gap-4">
                  <div class="col-span-5 sm:col-span-10 ">
                    <input type="text" name="cliente_id" class="hidden border-none block text-base font-medium text-gray-700 py-3 px-2" value="{{$cliente->id_cliente}}">
                    <input type="text" name="ejercicio" class="hidden border-none block text-base font-medium text-gray-700 py-3 px-2" value="{{$anio}}">
                    <input type="text" name="rft_id" id="rft_id" class="hidden border-none block text-base font-medium text-gray-700 py-3 px-2" value="">
                    <label class="block text-sm font-bold text-gray-700">Avance por trimestre</label>
                  </div>
                  @if(strftime("%m") == 4 && strftime("%d") > 19 && strftime("%d") < 31 && strftime("%Y") == $anio)
                    <div class="col-span-10 sm:col-span-5">
                      <label id="label_primer_trimestre" for="primer_trimestre" class="block text-sm font-bold text-gray-700">Primero*</label>
                      <input type="text" name="primer_trimestre" id="primer_trimestre" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{$sisplade->fecha_capturado}}">
                      <label id="error_primer_trimestre" name="error_primer_trimestre" class="hidden text-base font-normal text-red-500" >Ingrese un porcentaje valido</label>  
                    </div>
                  @endif
                  @if(strftime("%m") == 7 && strftime("%d") > 19 && strftime("%d") < 31 && strftime("%Y") == $anio)
                    <div class="col-span-10 sm:col-span-5">
                      <label id="label_segundo_trimestre" for="segundo_trimestre" class="block text-sm font-bold text-gray-700">Segundo*</label>
                      <input type="text" name="segundo_trimestre" id="segundo_trimestre" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{$sisplade->fecha_capturado}}">
                      <label id="error_segundo_trimestre" name="error_segundo_trimestre" class="hidden text-base font-normal text-red-500" >Ingrese un porcentaje valido</label>  
                    </div>
                  @endif
                  @if(strftime("%m") == 10 && strftime("%d") > 19 && strftime("%d") < 31 && strftime("%Y") == $anio)
                    <div class="col-span-10 sm:col-span-5">
                      <label id="label_tercer_trimestre" for="tercer_trimestre" class="block text-sm font-bold text-gray-700">Tercero*</label>
                      <input type="text" name="tercer_trimestre" id="tercer_trimestre" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{$sisplade->fecha_capturado}}">
                      <label id="error_tercer_trimestre" name="error_tercer_trimestre" class="hidden text-base font-normal text-red-500" >Ingrese un porcentaje valido</label>  
                    </div>
                  @endif
                  @if(strftime("%m") == 1 && strftime("%d") > 19 && strftime("%d") < 31 && strftime("%Y") == ($anio + 1))
                    <div class="col-span-10 sm:col-span-5">
                      <label id="label_cuarto_trimestre" for="cuarto_trimestre" class="block text-sm font-bold text-gray-700">Cuarto*</label>
                      <input type="text" name="cuarto_trimestre" id="cuarto_trimestre" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{$sisplade->fecha_capturado}}">
                      <label id="error_cuarto_trimestre" name="cuarto_trimestre" class="hidden text-base font-normal text-red-500" >Ingrese un porcentaje valido</label>  
                    </div>
                  @endif
                  
              </div>
              
            </div>
          <!--footer-->
          <div class=" p-4 border-t border-solid border-blueGray-200 rounded-b">
            
            <span class="block text-xs">Verifique los campos obligatorios marcados con un ( * ) </span>
            <div class="text-right">
            <button class="text-red-500 background-transparent font-bold uppercase px-6 py-2 text-sm outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="button" onclick="toggleModal('modal-rft')">
              Cancelar
            </button>
            <button type="submit" id="guardar_sisplade" class="bg-green-500 text-white active:bg-green-600 font-bold uppercase text-sm px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" >
              Guardar
            </button>
            </div>
          </div>
          </form>
        </div>
      </div>
    </div>
  @endif

  

  


  <div class="hidden opacity-25 fixed inset-0 z-40 bg-black" id="modal-backdrop"></div>
  <div class="hidden opacity-25 fixed inset-0 z-40 bg-black" id="modal-edit-backdrop"></div>
  <div class="hidden opacity-25 fixed inset-0 z-40 bg-black" id="modal-comprometido-backdrop"></div>
  <div class="hidden opacity-25 fixed inset-0 z-40 bg-black" id="modal-concepto-backdrop"></div>
  <div class="hidden opacity-25 fixed inset-0 z-40 bg-black" id="modal-proceso-backdrop"></div>
  <div class="hidden opacity-25 fixed inset-0 z-40 bg-black" id="modal-gi-backdrop"></div>
  <div class="hidden opacity-25 fixed inset-0 z-40 bg-black" id="modal-sisplade-backdrop"></div>
  <div class="hidden opacity-25 fixed inset-0 z-40 bg-black" id="modal-rft-backdrop"></div>
  <div class="hidden opacity-25 fixed inset-0 z-40 bg-black" id="modal-mids-backdrop"></div>
    
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
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            

            $('.table').DataTable({
                    "autoWidth": true,
                    "responsive": true,
                    "bFilter": false,
                    "bPaginate": false,
                    "bInfo": false,
                    columnDefs: [{
                            responsivePriority: 1,
                            targets: 0
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
                            responsivePriority: 1,
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

    


    function toggleModal(modalID){
      document.getElementById(modalID).classList.toggle("hidden");
      document.getElementById(modalID + "-backdrop").classList.toggle("hidden");
    }

    function toggleModalMids(modalID, mids){
      $("#fecha_planeacion").val(mids.fecha_planeado);
      $("#fecha_planeacion").change();
      $("#fecha_firma").val(mids.fecha_planeado?mids.fecha_firmado:'');
      $("#fecha_revision").val(mids.fecha_firmado?mids.fecha_validado:'');
      mids.fecha_planeado? $("#div_fecha_firma").removeClass('hidden'): $("#div_fecha_firma").addClass('hidden');
      mids.fecha_firmado? $("#div_fecha_revision").removeClass('hidden'): $("#div_fecha_revision").addClass('hidden');
    
      $("#mids_id").val(mids.id_mids);
      document.getElementById(modalID).classList.toggle("hidden");
      document.getElementById(modalID + "-backdrop").classList.toggle("hidden");
      
    }

    function toggleModalRFT(modalID, rft){
      $("#primer_trimestre").val(rft.primer_trimestre);
      $("#segundo_trimestre").val(rft.primer_trimestre?rft.segundo_trimestre:'');
      $("#tercer_trimestre").val(rft.segundo_trimestre?rft.tercer_trimestre:'');
      $("#cuarto_trimestre").val(rft.tercer_trimestre?rft.cuarto_trimestre:'');
      rft.primer_trimestre? $("#div_segundo_trimestre").removeClass('hidden'): $("#div_segundo_trimestre").addClass('hidden');
      rft.segundo_trimestre? $("#div_tercer_trimestre").removeClass('hidden'): $("#div_tercer_trimestre").addClass('hidden');
      rft.tercer_trimestre? $("#div_cuarto_trimestre").removeClass('hidden'): $("#div_cuarto_trimestre").addClass('hidden');
      $("#rft_id").val(rft.id_rft);

      document.getElementById(modalID).classList.toggle("hidden");
      document.getElementById(modalID + "-backdrop").classList.toggle("hidden");
      
    }

    function mostrarTabla(modalID){
      document.getElementById(modalID).classList.toggle("hidden");
      document.getElementById(modalID + '-titulo').classList.toggle("hidden");
    }

    //Modal agregar nuevo concepto al programa
    function toggleModal_compPro(modalID, comprometido, total_desglose){
      
      $("#programa_prodim").html(comprometido.nombre);
      total_prodim = parseFloat(comprometido.monto).toFixed(2); 
      console.log(comprometido.id_comprometido)     
      $("#comprometido_id").val(comprometido.id_comprometido);
      $("#label_monto_asignado_conc").html("$ "+("" + total_prodim).replace(/\D/g, "").replace(/([0-9])([0-9]{2})$/, '$1.$2').replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ","));      
      $("#label_monto_restante_conc").html("$ " + total_desglose.replaceAll("$", ""))
      $("#total_restante_programa").html("$ " + total_desglose.replaceAll("$", ""))
      document.getElementById(modalID).classList.toggle("hidden");
      document.getElementById(modalID + '-backdrop').classList.toggle("hidden");
    }

    function toggleModal_1(modalID, fuente, mp, mc){
      $("#label_monto_proyectado_edit").html("$ " + mp.replaceAll("$",""));
      $("#fuente_financiamiento_edit").html(fuente.nombre_corto);
      $("#fuente_id_edit").val(fuente.id_fuente_financ_cliente);
      $("#acta_integracion_consejo_edit").val(fuente.acta_integracion_consejo);
      $("#acta_integracion_consejo_edit").attr("max", fuente.acta_priorizacion);
      $("#acta_priorizacion_edit").val(fuente.acta_priorizacion);
      $("#acta_priorizacion_edit").attr("min", fuente.acta_integracion_consejo);
      $("#adendum_priorizacion_edit").val(fuente.adendum_priorizacion);
      $("#adendum_priorizacion_edit").attr("min", fuente.acta_priorizacion);
      $("#label_monto_comprometido_edit").html("$ "+ mc.replaceAll("$",""));      
      $("#div_prodim_edit").removeClass("hidden");
      $("#div_prodim_edit").addClass(fuente.prodim == 1?'':'hidden');
      $("#div_gastos_edit").removeClass("hidden");
      $("#div_gastos_edit").addClass(fuente.gastos_indirectos == 1?'':'hidden');
      porcentaje_prodim = parseFloat(fuente.porcentaje_prodim).toFixed(2);
      porcentaje_gastos = parseFloat(fuente.porcentaje_gastos).toFixed(2);
      total_prodim = parseFloat(fuente.monto_proyectado * (fuente.porcentaje_prodim * 0.01)).toFixed(2);
      total_gastos = parseFloat(fuente.monto_proyectado * (fuente.porcentaje_gastos * 0.01)).toFixed(2);
      $("#label_prodim").html("PRODIM<br><span class='ml-5'>Porcentaje: "+porcentaje_prodim+" %</span> <br> <span class='ml-5'>Monto: $ "+("" + total_prodim).replace(/\D/g, "").replace(/([0-9])([0-9]{2})$/, '$1.$2').replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ",")+"</span>");
      $("#label_gastos").html("Gastos Indirectos<br><span class='ml-5'>Porcentaje: "+porcentaje_gastos+" %</span> <br> <span class='ml-5'>Monto: $ "+("" + total_gastos).replace(/\D/g, "").replace(/([0-9])([0-9]{2})$/, '$1.$2').replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ",")+"</span>");
      $("#div_button_edit").removeClass("hidden");
      $("#div_button_edit").addClass(fuente.fuente_financiamiento_id == 2?'block':'hidden');
      


      if(fuente.id_fuente_financiamiento == 2)
        $(".fondo_3").removeClass("hidden");
      else
        $(".fondo_3").addClass("hidden");
      document.getElementById(modalID).classList.toggle("hidden");
      document.getElementById(modalID + "-backdrop").classList.toggle("hidden");
      
    }

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

    function modificarPorcentajes(edit) {
        porcentaje_prodim_num = ($("#monto_proyectado" + edit).val()).replaceAll(",", "") * ($("#porcentaje_prodim" + edit).val() * 0.01);
        porcentaje_prodim = parseFloat(porcentaje_prodim_num).toFixed(2);
        $("#label_porcentaje_p_tex" + edit).html("Monto del porcentaje de PRODIM:<br> $ " + ("" + porcentaje_prodim).replace(/\D/g, "").replace(/([0-9])([0-9]{2})$/, '$1.$2').replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ","));

        porcentaje_gastos_num = ($("#monto_proyectado" + edit).val()).replaceAll(",", "") * ($("#porcentaje_gastos" + edit).val() * 0.01);
        porcentaje_gastos = parseFloat(porcentaje_gastos_num).toFixed(2);
        $("#label_porcentaje_gi_tex" + edit).html("Monto del porcentaje de PRODIM:<br> $ " + ("" + porcentaje_gastos).replace(/\D/g, "").replace(/([0-9])([0-9]{2})$/, '$1.$2').replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ","));
        
        total_porcentajes = porcentaje_prodim_num + porcentaje_gastos_num;
        total_porcentajes = parseFloat(total_porcentajes).toFixed(2);
        
        $("#monto_comprometido" + edit).val(total_porcentajes);
        $("#label_mc" + edit).html("$ " + ("" + total_porcentajes).replace(/\D/g, "").replace(/([0-9])([0-9]{2})$/, '$1.$2').replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ","))
    }

    function mostrarRM(id_div_obra){
      oculto = $("#"+id_div_obra).hasClass("hidden");
      
      oculto? $("#"+id_div_obra).removeClass("hidden"): $("#"+id_div_obra).addClass("hidden");;
    }
  
  
  //validacion de campos del modal
  $(document).ready(function() {
    $('.js-example-basic-single').select2();
    $('#fuente_financiamiento_id').on('change', function() {
      if($(this).val() == 2){
        $(".fondoIII").removeClass("hidden");
      }else{
        $(".fondoIII").addClass("hidden");
      }
    });

    $("#prodim, #prodim_edit, #gastos_indirectos, #gastos_indirectos_edit").change(function() {
        if($(this).is(":checked")){
            $("#div_" + $(this).attr('id')).removeClass('hidden');
        }else{
            $("#div_" + $(this).attr('id')).addClass('hidden');
        }
    });

    $('#porcentaje_prodim, #porcentaje_prodim_edit').on({
        "keydown": function(event) {
            if(event.keyCode > 8 && event.keyCode < 96 || event.keyCode > 105){                
                return false;
            }
            if(event.keyCode >= 96 && event.keyCode <= 105){
                var_ejemplo = $(this).val();
                var_ejemplo = var_ejemplo.replaceAll('.','');
                caracteres = var_ejemplo.charAt(2);
                ultima = var_ejemplo.charAt(2);
                penultima = var_ejemplo.charAt(1);


                $(this).val(penultima + "." +  ultima);
            }
            

        },
        "keyup": function(event) {
            valor = $(this).val();
            if(valor > 2)
                $(this).val("2.00");

            if(event.keyCode == 8){
                var_ejemplo = $(this).val();
                var_ejemplo = var_ejemplo.replaceAll('.','');
                
                $(this).val("0." + var_ejemplo);
            }
            id = $(this).attr('id');
            text = id.search("edit") > -1?"_edit":"";
            modificarPorcentajes(text);
        }
    });

    $('#porcentaje_gastos, #gastos_indirectos_edit').on({
        "keydown": function(event) {
            if(event.keyCode > 8 && event.keyCode < 96 || event.keyCode > 105){                
                return false;
            }
            if(event.keyCode >= 96 && event.keyCode <= 105){
                var_ejemplo = $(this).val();
                var_ejemplo = var_ejemplo.replaceAll('.','');
                caracteres = var_ejemplo.charAt(2);
                ultima = var_ejemplo.charAt(2);
                penultima = var_ejemplo.charAt(1);
                
                $(this).val(penultima + "." +  ultima);
            }
            

        },
        "keyup": function(event) {
            valor = $(this).val();
            if(valor > 3)
                $(this).val("3.00");

            if(event.keyCode == 8){
                var_ejemplo = $(this).val();
                var_ejemplo = var_ejemplo.replaceAll('.','');
                
                $(this).val("0." + var_ejemplo);
            }
            id = $(this).attr('id');
            text = id.search("edit") > -1?"_edit":"";
            modificarPorcentajes(text);
            
        }
    });

    $('#acta_integracion_consejo').change(function() {
      $("#acta_priorizacion").attr("min", $(this).val());
    });

    $('#acta_priorizacion').change(function() {
      $("#acta_integracion_consejo").attr("max", $(this).val());
      fecha = new Date($(this).val());
      fecha.setDate(fecha.getDate() + 1);
      if($(this).val() != '{{$anio}}-12-31') {
        fecha.setDate(fecha.getDate() + 1);
      }
      const mes = fecha.getMonth() + 1; // Ya que los meses los cuenta desde el 0
      const dia = fecha.getDate();
      fecha = fecha.getFullYear()+'-'+(mes< 10?'0':'')+mes+'-'+(dia < 10 ? '0' : '')+dia;
      console.log(fecha);
      $("#adendum_priorizacion").attr("min", fecha);
    });

    $('#acta_integracion_consejo_edit').change(function() {
      $("#acta_priorizacion_edit").attr("min", $(this).val());
    });

    $('#acta_priorizacion_edit').change(function() {
      $("#acta_integracion_consejo_edit").attr("max", $(this).val());
      fecha = new Date($(this).val());
      fecha.setDate(fecha.getDate() + 1);
      if($(this).val() != '{{$anio}}-12-31') {
        fecha.setDate(fecha.getDate() + 1);
      }
      const mes = fecha.getMonth() + 1; // Ya que los meses los cuenta desde el 0
      const dia = fecha.getDate();
      fecha = fecha.getFullYear()+'-'+(mes< 10?'0':'')+mes+'-'+(dia < 10 ? '0' : '')+dia;
      $("#adendum_priorizacion_edit").attr("min", fecha);
    });

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

            modificarPorcentajes("");
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

    $("#formulario input").on({
        "change":function(event) {
            
            if($(this).attr('type')== "date"){
                fecha = new Date($(this).val());
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
            if(monto == "0.00")
                monto = "";
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

    $("#guardar").click(function () {
      value = true;
        if($("#prodim").is(":checked") && $("#porcentaje_prodim").val() == '0.00'){
          console.log($("#porcentaje_prodim").val());
          $("#error_porcentaje_prodim").removeClass("hidden");
          value = false;
        }else{
          console.log($("#porcentaje_prodim").val() == '0.00');
          $("#error_porcentaje_prodim").addClass("hidden");
        }

        if($("#gastos_indirectos").is(":checked") && $("#porcentaje_gastos").val() == 0.00){
          $("#error_porcentaje_gastos").removeClass("hidden");
          value = false;
        }else{
          $("#error_porcentaje_gastos").addClass("hidden");
        }
        
        if(!value){
          $("#formulario input").change();
          $("#formulario input").keyup();
        }
        return value;
    });

    //Acciones para agregar prodim modificado

    $("#monto_prodim").on({
          
          "focus": function(event) {
              $(event.target).select();
          },
          "keydown": function(event){
              monto_asignado = $("#label_monto_asignado_prodim").html().replaceAll("$", "").replaceAll(",","");
              monto_capturado = $(this).val().replaceAll(",", "");
              
          },
          "keyup": function(event) {            
            $(event.target).val(function(index, value) {
                return value.replace(/\D/g, "")
                    .replace(/([0-9])([0-9]{2})$/, '$1.$2')
                    .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ",");
            });

            monto_asignado = parseFloat($("#label_monto_asignado_prodim").html().replaceAll("$", "").replaceAll(",","") - {{$total_prodim?$total_prodim:0 }});
            monto_capturado = $(this).val().length == 0?0:parseFloat($(this).val().replaceAll(",", ""));
            
            if(monto_capturado > monto_asignado){
              $("#error_monto_prodim_superior").removeClass('hidden');
            }else{
              $("#error_monto_prodim_superior").addClass('hidden');
            }

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

    $("#guardar_comp_prodim").click(function () {
        monto_asignado = parseFloat($("#label_monto_asignado_prodim").html().replaceAll("$", "").replaceAll(",","") - {{$total_prodim?$total_prodim:0 }});
        monto_capturado = $("#monto_prodim").val().length == 0?0:parseFloat($("#monto_prodim").val().replaceAll(",", ""));
        
        
        if(monto_capturado > monto_asignado){
            $("#error_monto_prodim_superior").removeClass('hidden');
            $("#error_monto_prodim").removeClass('hidden');
            $("#fecha_asignacion").change();
            $("#monto_prodim").keyup();
            return false;
        }else{
            $("#error_monto_prodim_superior").addClass('hidden');
            $("#error_monto_prodim").addClass('hidden');
            return true;
        }
    });

    $("#formulario_prodim").validate({
      onfocusout: false,
      onclick: false,
      rules: {
        fecha_asignacion: { required: true, },
        monto_prodim: { required: true},        
      },
      errorPlacement: function(error, element) {
        if(error != null){
            $('#error_'+element.attr('id')).fadeIn();
            $("#label_"+element.attr('id')).addClass('text-red-500');
            $("#label_"+element.attr('id')).removeClass('text-gray-700');
        }else{
            $('#error_'+element.attr('id')).fadeOut();
            $("#label_"+element.attr('id')).removeClass('text-red-500');
            $("#label_"+element.attr('id')).addClass('text-gray-700');
        }
       // console.log(element.attr('id'));
      },
    });
            $("#fecha_asignacion").on({
                "change":function(event) {
                    fecha = new Date($(this).val());
                        if(fecha != "Invalid Date"){
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

      $("#monto_concepto").on({
          
          "focus": function(event) {
              $(event.target).select();
          },
          "keyup": function(event) {            
            $(event.target).val(function(index, value) {
                return value.replace(/\D/g, "")
                    .replace(/([0-9])([0-9]{2})$/, '$1.$2')
                    .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ",");
            });

            monto_asignado = parseFloat($("#label_monto_restante_conc").html().replaceAll("$ ", "").replaceAll(",",""));
            monto_capturado = parseFloat($(this).val().replaceAll(",", ""));
            
            if(monto_capturado > monto_asignado){
              $("#error_monto_concepto_superior").removeClass('hidden');
            }else{
              $("#error_monto_concepto_superior").addClass('hidden');
            }
          },
          
      });

      $("#formulario_concepto input").on({
        "keyup": function(event){
          console.log("#label_"+$(this).attr('id'));
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
        }
      });

    $("#guardar_concepto").click(function () {
        monto_asignado = parseFloat($("#label_monto_restante_conc").html().replaceAll("$ ", "").replaceAll(",",""));
        monto_capturado = parseFloat($("#monto_concepto").val().replaceAll(",", ""));
        
            
        if(monto_capturado > monto_asignado){
            $("#error_monto_concepto_superior").removeClass('hidden');
            $("#error_monto_concepto").removeClass('hidden');
            $("#fecha_asignacion").change();
            $("#fecha_asignacion").keyUp();
            return false;
        }else{
            $("#error_monto_concepto_superior").addClass('hidden');
            $("#error_monto_concepto").addClass('hidden');
            return true;
        }
    });

    $("#formulario_concepto").validate({
      onfocusout: false,
      onclick: false,
      rules: {
        monto_concepto: { required: true, },
        concepto_prodim: { required: true},        
      },
      errorPlacement: function(error, element) {
        if(error != null){
            $('#error_'+element.attr('id')).fadeIn();
            $("#label_"+element.attr('id')).addClass('text-red-500');
            $("#label_"+element.attr('id')).removeClass('text-gray-700');
        }else{
            $('#error_'+element.attr('id')).fadeOut();
            $("#label_"+element.attr('id')).removeClass('text-red-500');
            $("#label_"+element.attr('id')).addClass('text-gray-700');
        }
       // console.log(element.attr('id'));
      },
    });

    //validaciones fecha del proceso de prodim

    $("#formulario_proceso input").on({
        'change': function(event){
          fecha = new Date($(this).val());
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
    })

    $("#fecha_presentado").on({
        'change': function(event){
          fecha = new Date($(this).val());
          if(fecha != "Invalid Date"){
              $("#fecha_revisado").attr('min', $(this).val());
              $("#div_revisado").removeClass('hidden');
          }else{
              $("#div_revisado").addClass('hidden');
              $("#fecha_revisado").val("");
              $("#div_aprovado").addClass('hidden');
              $("#fecha_aprovado").val("");
              $("#div_convenio").addClass('hidden');
              $("#fecha_convenio").val("");
              $(this).attr('max', "{{$anio.'-12-31'}}");
          }
        }
    });
    $("#fecha_revisado").on({
        'change': function(event){
          fecha = new Date($(this).val());
          if(fecha != "Invalid Date"){
              $("#fecha_aprovado").attr('min', $(this).val());
              $("#fecha_presentado").attr('max', $(this).val());
              $("#div_aprovado").removeClass('hidden');
          }else{
            $("#div_aprovado").addClass('hidden');
              $("#fecha_aprovado").val("");
              $("#div_convenio").addClass('hidden');
              $("#fecha_convenio").val("");
              $(this).attr('max', "{{$anio.'-12-31'}}");
          }
        }
    });

    $("#fecha_aprovado").on({
        'change': function(event){
          fecha = new Date($(this).val());
          if(fecha != "Invalid Date"){
              $("#fecha_convenio").attr('min', $(this).val());
              $("#fecha_revisado").attr('max', $(this).val());
              $("#div_convenio").removeClass('hidden');
              
          }else{
              $("#div_convenio").addClass('hidden');
              $("#fecha_convenio").val("");
              $(this).attr('max', "{{$anio.'-12-31'}}");

          }
        }
    });
    $("#fecha_convenio").on({
        'change': function(event){
          fecha = new Date($(this).val());
          if(fecha != "Invalid Date"){
              $("#fecha_aprovado").attr('max', $(this).val());
          }
        }
    });

    //Validaciones de fecha de Gastos Indirectos
    $("#monto_gi").on({
          
          "focus": function(event) {
              $(event.target).select();
          },
          "keyup": function(event) {            
            $(event.target).val(function(index, value) {
                return value.replace(/\D/g, "")
                    .replace(/([0-9])([0-9]{2})$/, '$1.$2')
                    .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ",");
            });

            monto_asignado = parseFloat($("#label_monto_asignado_gi").html().replaceAll("$", "").replaceAll(",","") - {{$total_gi?$total_gi:0}});
            monto_capturado = $(this).val().length == 0?0:parseFloat($(this).val().replaceAll(",", ""));
            
            
            if(monto_capturado > monto_asignado){
              $("#error_monto_gi_superior").removeClass('hidden');
            }else{
              $("#error_monto_gi_superior").addClass('hidden');
            }

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

    $("#guardar_comp_gi").click(function () {
        monto_asignado = parseFloat($("#label_monto_asignado_gi").html().replaceAll("$", "").replaceAll(",","") -{{$total_gi?$total_gi:0}});
        monto_capturado = $("#monto_gi").val().length == 0?0:parseFloat($("#monto_gi").val().replaceAll(",", ""));
        
        if(monto_capturado > monto_asignado){
            
            $("#error_monto_gi_superior").removeClass('hidden');
            $("#error_monto_gi").removeClass('hidden');
            $("#fecha_asignacion_gi").change();
            $("#monto_gi").keyup();
            return false;
        }else{
            $("#error_monto_gi_superior").addClass('hidden');
            $("#error_monto_gi").addClass('hidden');
            return true;
        }
    });

    $("#formulario_gi").validate({
      onfocusout: false,
      onclick: false,
      rules: {
        fecha_asignacion_gi: { required: true, },
        monto_gi: { required: true},  
      },
      errorPlacement: function(error, element) {
        if(error != null){
            $('#error_'+element.attr('id')).fadeIn();
            $("#label_"+element.attr('id')).addClass('text-red-500');
            $("#label_"+element.attr('id')).removeClass('text-gray-700');
        }else{
            $('#error_'+element.attr('id')).fadeOut();
            $("#label_"+element.attr('id')).removeClass('text-red-500');
            $("#label_"+element.attr('id')).addClass('text-gray-700');
        }
       // console.log(element.attr('id'));
      },
    });
    
    $("#fecha_asignacion_gi").on({
        "change":function(event) {
            fecha = new Date($(this).val());
            if(fecha != "Invalid Date"){
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

    //validacion SISPLADE
    $("#fecha_capturado").on({
        "change":function(event) {
            fecha = new Date($(this).val());
            if(fecha != "Invalid Date"){
                $("#fecha_validacion").attr('min', $(this).val());
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
    $("#fecha_validacion").on({
        "change":function(event) {
            fecha = new Date($(this).val());
            if(fecha != "Invalid Date"){
                $("#fecha_capturado").attr('max', $(this).val());
                
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
    $("#formulario_sisplade").validate({
      onfocusout: false,
      onclick: false,
      rules: {
        fecha_capturado: { required: true},
      },
      errorPlacement: function(error, element) {
        if(error != null){
            $('#error_'+element.attr('id')).fadeIn();
            $("#label_"+element.attr('id')).addClass('text-red-500');
            $("#label_"+element.attr('id')).removeClass('text-gray-700');
        }else{
            $('#error_'+element.attr('id')).fadeOut();
            $("#label_"+element.attr('id')).removeClass('text-red-500');
            $("#label_"+element.attr('id')).addClass('text-gray-700');
        }
       // console.log(element.attr('id'));
      },
    });

    //validación MIDS

    $("#fecha_planeacion").on({
        'change': function(event){
          fecha = new Date($(this).val());
          if(fecha != "Invalid Date"){
              $("#fecha_firma").attr('min', $(this).val());
              $("#div_fecha_firma").removeClass("hidden");
              
          }else{
            $("#fecha_firma").val("");
            $("#fecha_revision").val("");
            $("#div_fecha_firma").addClass("hidden");
            $("#div_fecha_revision").addClass("hidden");
          }
        }
    });

    $("#fecha_firma").on({
        'change': function(event){
          fecha = new Date($(this).val());
          if(fecha != "Invalid Date"){
              $("#fecha_planeacion").attr('max', $(this).val());
              $("#fecha_revision").attr('min', $(this).val());
              $("#div_fecha_revision").removeClass("hidden");
          }else{
            $("#fecha_firma").val("");
            $("#fecha_revision").val("");
            $("#div_fecha_revision").addClass("hidden");
          }
        }
    });
    $("#fecha_revision").on({
        'change': function(event){
          fecha = new Date($(this).val());
          if(fecha != "Invalid Date"){
              $("#fecha_firma").attr('max', $(this).val());
          }
        }
    });

    $("#formulario_mids").validate({
      onfocusout: false,
      onclick: false,
      rules: {
        fecha_planeacion: { required: true},
      },
      errorPlacement: function(error, element) {
        console.log(element.val());
        if(error != null){
            $('#error_'+element.attr('id')).fadeIn();
            $("#label_"+element.attr('id')).addClass('text-red-500');
            $("#label_"+element.attr('id')).removeClass('text-gray-700');
        }else{
            $('#error_'+element.attr('id')).fadeOut();
            $("#label_"+element.attr('id')).removeClass('text-red-500');
            $("#label_"+element.attr('id')).addClass('text-gray-700');
        }
       // console.log(element.attr('id'));
      },
    });

    $('#primer_trimestre').on({
        "keydown": function(event) {
          console.log(event.keyCode);
            if(event.keyCode > 8 && event.keyCode < 96 || event.keyCode > 105){                
                return false;
            }

        },
        "keyup": function(event) {
            valor = $(this).val();
            if(valor > 100)
                $(this).val("100");

            if(valor == "")
              $(this).val("0");
            
        }
    });
    $('#segundo_trimestre').on({
        "keydown": function(event) {
          console.log(event.keyCode);
            if(event.keyCode > 8 && event.keyCode < 96 || event.keyCode > 105){                
                return false;
            }

        },
        "keyup": function(event) {
            valor = $(this).val();
            valor_primer = $("#primer_trimestre").val();
            if(valor < valor_primer)
                $(this).val(valor_primer);

            if(valor > 100)
                $(this).val("100");

            if(valor == "")
              $(this).val(valor_primer);
            
        }
    });

    $('#tercer_trimestre').on({
        "keydown": function(event) {
          console.log(event.keyCode);
            if(event.keyCode > 8 && event.keyCode < 96 || event.keyCode > 105){                
                return false;
            }

        },
        "keyup": function(event) {
            valor = $(this).val();
            valor_primer = $("#segundo_trimestre").val();
            if(valor < valor_primer)
                $(this).val(valor_primer);

            if(valor > 100)
                $(this).val("100");

            if(valor == "")
              $(this).val(valor_primer);
            
        }
    });

    $('#cuarto_trimestre').on({
        "keydown": function(event) {
          console.log(event.keyCode);
            if(event.keyCode > 8 && event.keyCode < 96 || event.keyCode > 105){                
                return false;
            }

        },
        "keyup": function(event) {
            valor = $(this).val();
            valor_primer = $("#tercer_trimestre").val();
            if(valor < valor_primer)
                $(this).val(valor_primer);

            if(valor > 100)
                $(this).val("100");

            if(valor == "")
              $(this).val(valor_primer);
            
        }
    });
  });
  
  //Validación 
  

  </script>

@endsection
