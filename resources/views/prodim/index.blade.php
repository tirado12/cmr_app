@extends('layouts.plantilla')
@section('title','Prodim')
@section('contenido')
<link rel="stylesheet" href="{{ asset('css/datatable.css') }}">
<link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/style_alert.css') }}">

<div class="flex flex-row">
    <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
    </svg>
  <h1 class="text-xl font-bold ml-2">Lista Prodim</h1>
</div>

<div class="flex flex-col mt-6">
    <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
    <button class="bg-orange-800 mb-4 text-white active:bg-orange-800 font-bold uppercase text-sm px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="button" onclick="toggleModal('modal-id')">
    Agregar
    </button>
        <!-- div de tabla -->
    </div>
</div>

<!-- fin tabla tailwind, inicio data table -->
<div class="contenedor p-8 shadow-2xl bg-white rounded-lg">

    <table id="example" class="table table-striped bg-white" style="width:100%;">
      <thead>
          <tr>
              <th>Firma electronica</th>
              <th>Revisado</th>
              <th>Fecha revisión</th>
              <th>Validado</th>          
              <th>Fecha validado</th>
              <th class="flex justify-center">Acción</th>
          </tr>
      </thead>
      <tbody> 
          <tr>
              
              <td>
                <div class="flex items-center">
                  <div>
                      <div class="text-sm leading-5 font-medium text-gray-900"></div>
                      <div class="text-sm leading-5 text-gray-500"></div>
                  </div>
              </div>
              </td>
              <td>
                <div class="text-sm leading-5 font-medium text-gray-900 flex justify-center">
                
                </div>
                
              </td>
              <td>
                <div class="text-sm leading-5 font-medium text-gray-900 flex justify-center">
                
                </div>
                
              </td>
              <td>
                <div class="text-sm leading-5 font-medium text-gray-900">
                    
                </div>
              </td>
              <td>
                <div class="text-sm leading-5 font-medium text-gray-900 flex justify-center">
                   
                </div>
              </td>
    
              <td>
                <div class="flex justify-center">
                <form action="" method="POST" class="form-eliminar" >
                  <div>
                  <a type="button"  href="" class="bg-white text-blue-500 p-2 rounded rounded-lg">Editar</a>
                  <button class="bg-transparent text-blue-500 active:bg-transparent font-normal  text-sm p-2  rounded outline-none focus:outline-none  ease-linear transition-all duration-150"  type="button" onclick="toggleModal1('modal-contratista')">
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
          
      </tbody>
     
    </table>
    </div>

    <!-- inicio modal -->
<div class="hidden overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center" id="modal-id">
    <div class="relative w-auto my-6 mx-auto max-w-3xl">
      <!--content-->
      <div class="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none">
        <!--header-->
        <div class="flex items-start justify-between p-5 border-b border-solid border-blueGray-200 rounded-t">
          <h4 class="text-xl font-semibold">
            Agregar Nuevo Prodim
          </h4>
          <button class="p-1 ml-auto bg-transparent border-0 text-black opacity-5 float-right text-3xl leading-none font-semibold outline-none focus:outline-none" onclick="toggleModal('modal-id')">
            <span class="bg-transparent text-black opacity-5 h-6 w-6 text-2xl block outline-none focus:outline-none">
              
            </span>
          </button>
        </div>
        <!--body-->
        <form action="{{ route('prodim.store') }}" method="POST" id="formulario" name="formulario">
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
                                <input type="checkbox" name="validado" id="validado" class="ml-2 shadow-sm sm:text-sm border-gray-300 rounded h-6 w-6">
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
                        <input type="date" name="fecha_revisado" id="fecha_revisado" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" >
                        <label id="error_fecha_revisado" class="hidden block text-md text-red-500">Se require de una fecha</label>
                      </div>
                    
                      <div class="col-span-2 p-2">
                        <label id="label_fecha_validado" for="fecha_validado" class="block text-sm font-medium text-gray-700">Fecha validado *</label>
                        <input type="date" name="fecha_validado" id="fecha_validado" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" >
                        <label id="error_fecha_validado" class="hidden block text-md text-red-500">Se require de una fecha</label>
                      </div>
        
                      <div class="col-span-2 p-2">
                        <label id="label_fecha_convenio" for="fecha_convenio" class="block text-sm font-medium text-gray-700">Fecha convenio *</label>
                        <input type="date" name="fecha_convenio" id="fecha_convenio" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" >
                        
                      </div>
        
                    </div>
                 </div>
              

              
        </div>
        <!--footer-->
        <div class=" p-4 border-t border-solid border-blueGray-200 rounded-b">
          
          <span class="block text-xs">Verifique los campos obligatorios marcados con un ( * )</span>
          <div class="text-right">
          <button class="text-red-500 background-transparent font-bold uppercase px-6 py-2 text-sm outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="button" onclick="toggleModal('modal-id')">
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
  <div class="hidden opacity-25 fixed inset-0 z-40 bg-black" id="modal-id-backdrop"></div>


    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.22/b-1.6.4/b-flash-1.6.4/b-html5-1.6.4/b-print-1.6.4/datatables.min.js"></script>

    <script type="text/javascript">
        function toggleModal(modal){
            document.getElementById(modal).classList.toggle("hidden");
            document.getElementById(modal + "-backdrop").classList.toggle("hidden");    
        }

        $(document).ready(function(){
            $("#cliente_id").on('change', function () { //consulta ejercicios por cliente
                cliente=$(this).val();
                $("#ejercicio").empty(); //valida si no se ha seleccionado una opc
                $("#ejercicio").append('<option value="">Elija un cliente</option>');
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
            });

            $("#ejercicio").on('change', function () {
                $('#fuenteCliente_id').val($('#ejercicio').val());
            }); 

        });
    </script>
    <script>
        $(document).ready(function() { //llamada al datatable
          $('#example').DataTable({
              "autoWidth" : true,
              "responsive" : true,
              language: {
                url: 'https://cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json'
              }
          }).columns.adjust();
      });
      </script>
@endsection