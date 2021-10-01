@extends('layouts.plantilla')
@section('title','Inicio')
@section('contenido')
<link rel="stylesheet"
        href="{{ asset('css/datatable.css') }}">
    <link rel="stylesheet"
        href="{{ asset('css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('css/style_alert.css') }}">
    <!--Responsive Extension Datatables CSS-->
    <link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css"
        rel="stylesheet">
    <link rel="stylesheet"
        href="https://cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css">
<h2 class="text-3xl font-black mb-4 text-center">
    @if(Auth::user()->sexo == 1)
        Bienvenida
    @else
        Bienvenido
    @endif {{Auth::user()->name}}</h2>

    
        
<div class="mt-8">
</div>


<!-- fin tabla tailwind, inicio data table -->

<div class="mt-6 contenedor px-8 py-2 shadow-2xl bg-white rounded-lg text-sm">
    <div class="border-b p-4">
        <h2 class="text-xl font-bold">Listado de clientes</h2>
    </div>
    <table id="example"
        class="table table-striped bg-white"
        style="width:100%;">
        <thead>
            <tr>
                <th>Cliente</th>
                <th>Distrito</th>
                <th>RFC</th>
                <th>Periodo</th>
                <th class="flex justify-center">Acción</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($clientes as $key => $cliente)
                <tr>
                    <td>
                        <div class="text-sm leading-5 font-medium text-gray-900">
                            {{ $cliente->nombre_municipio }}
                        </div>
                    </div>
                </td>
                
                <td>
                    <div class="text-sm leading-5 font-medium text-gray-900">
                        {{$cliente->nombre_distrito}}
                    </div>
                
                </td>                
                <td>
                    <div class="text-sm leading-5 font-medium text-gray-900">
                        {{$cliente->rfc}}
                    </div>
                
                </td>
                <td>
                    <div class="text-sm leading-5 font-medium text-gray-900">
                        {{ $cliente->anio_inicio }}@if ($cliente->anio_fin != null) - {{ $cliente->anio_fin }}@endif
                    </div>
                
                </td>            
                <td>
                    <div class="flex justify-center">
                        <form action="{{ route('clientes.destroy', $cliente->id_cliente) }}"
                            method="POST"
                            class="form-eliminar">
                            <div>
                                <a type="button"  href="{{ route('cliente.ver', $cliente->id_cliente)}}" class="bg-white text-sm text-blue-500 font-normal text-ms p-2 rounded rounded-lg">Ver</a>
                                <!--@csrf
                                                          @method('DELETE')
                                                      <button type="submit" class="bg-white text-red-500 p-2 rounded rounded-lg">Eliminar</button>
                                                          </div>-->
                
                        </form>
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
    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                    "autoWidth": true,
                    "responsive": true,
                    columnDefs: [{
                            responsivePriority: 1,
                            targets: 4
                        },
                        {
                            responsivePriority: 1,
                            targets: 1
                        },
                        {
                            responsivePriority: 10001,
                            targets: 4
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
@endsection