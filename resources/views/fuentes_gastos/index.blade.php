@extends('layouts.plantilla')
@section('title','Fuentes Gastos Indirectos')
@section('contenido')
<link rel="stylesheet" href="{{ asset('css/datatable.css') }}">
<link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/style_alert.css') }}">
<!--Responsive Extension Datatables CSS-->
<link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css">

<div class="flex flex-row">
    <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
    </svg>
  <h1 class="text-xl font-bold ml-2">Gastos Indirectos</h1>
</div>

<div class="flex flex-col mt-6">
    <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
      <button class="bg-orange-800 mb-4 text-white active:bg-orange-800 font-bold uppercase text-sm px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="button" onclick="toggleModal('modal-id')">
      Agregar
      </button> 
        <!-- div de tabla -->
    </div>
</div>

<div class="mt-6 contenedor p-8 shadow-2xl bg-white rounded-lg">
  <table id="example" class="table table-striped bg-white" style="width:100%;">
    <thead>
        <tr>
            <th>Municipio</th>
            <th>Ejercicio</th>
            <th>Fuente Financiamiento</th>
            <th>Gasto</th>
            <th>Monto</th>
            <th class="flex justify-center">Acción</th>
        </tr>
    </thead>
    <tbody> 
    @foreach ($gastosIndirectos as $item)
        <tr>
            <td>
              <div class="text-sm leading-5 font-medium text-gray-900">
                {{$item->nombre}}
              </div>
            
            </td>
            <td>
              <div class="text-sm leading-5 font-medium text-gray-900 myDIV">
              {{$item->ejercicio}}
              {{-- {{ $item->anio_inicio}}{{ ( $item->anio_inicio == $item->anio_fin ) ? '' : ' - '.$item->anio_fin }} --}}
              </div>
            </td>
            <td>
              <div class="text-sm leading-5 font-medium text-gray-900 myDIV">
                {{$item->nombre_corto}}
              </div>
            </td>
            <td>
              <div class="text-sm leading-5 font-medium text-gray-900">
                  {{$item->nombre_indirectos}}
              </div>
            </td>
            <td>
              <div class="text-sm leading-5 font-medium text-gray-900">
                  {{$item->monto}}
              </div>
            </td>
            <td>
              <div class="flex justify-center">
              <form action="{{ route('gastosIndirectosFuentes.destroy', $item->id_fuentes_gastos_indirectos) }}" method="POST" class="form-eliminar" >
                <div>
                <a type="button"  href="{{route('gastosIndirectosFuentes.edit', $item->id_fuentes_gastos_indirectos) }}" class="bg-white text-sm text-blue-500 font-normal text-ms p-2 rounded rounded-lg">Editar</a> 
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-white text-red-500 p-2 rounded rounded-lg">Eliminar</button>
                </div>
                
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

<!-- inicio modal -->
<div class="hidden overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center" id="modal-id">
  <div class="relative w-auto my-6 mx-auto max-w-3xl">
    <!--content-->
    <div class="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none">
      <!--header-->
      <div class="flex items-start justify-between p-5 border-b border-solid border-blueGray-200 rounded-t">
        <h4 class="text-xl font-semibold">
          Fuentes - gastos indirectos
        </h4>
        <button class="p-1 ml-auto bg-transparent border-0 text-red-500 float-right text-3xl leading-none font-semibold outline-none focus:outline-none" onclick="toggleModal('modal-id')">
          <span class="bg-transparent text-red-500 h-6 w-6 text-2xl block outline-none focus:outline-none">
            ×
          </span>
        </button>
      </div>
      <!--body-->
      
      <div class="relative p-6 flex-auto">
        
          <div class="grid grid-cols-8 gap-8">
            <div class="col-span-8 ">
              <label for="first_name" class="text-base font-medium text-gray-700">Municipio: </label>
              <input type="text" name="monto_proyectado" id="monto_proyectado" class=" mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" placeholder="">
            </div>
            <div class="col-span-8">
              <label for="ver_monto_proyectado" class=" text-base font-medium text-gray-700">Monto proyectado: </label>
              <label id="ver_monto_proyectado" class="text-base font-bold text-gray-900 myDIV"></label>
            </div>
            <div class="col-span-8">
              <label for="ver_monto_comprometido" class=" text-base font-medium text-gray-700">Monto comprometido: </label>
              <label id="ver_monto_comprometido" class="text-base font-bold text-gray-900 myDIV"></label>
            </div>
            <div class="col-span-8">
              <label for="ver_acta_integracion_consejo" class="text-base font-medium text-gray-700">Acta de integración: </label>
              <label id="ver_acta_integracion_consejo" class="text-base font-bold text-gray-900"></label>
            </div>

            <div class="col-span-8">
              <label for="ver_acta_priorizacion" class="text-base font-medium text-gray-700">Acta priorización: </label>
              <label id="ver_acta_priorizacion" class="text-base font-bold text-gray-900"></label>
            </div>
            <div class="col-span-8">
                <label for="ver_adendum_priorizacion" class="text-base font-medium text-gray-700">Adendum priorización: </label>
                <label id="ver_adendum_priorizacion" class="text-base font-bold text-gray-900"></label>
              </div>
            <div class="col-span-8">
                <label for="ver_ejercicio" class="text-base font-medium text-gray-700">Ejercicio: </label>
                <label id="ver_ejercicio" class="text-base font-bold text-gray-900"></label>
              </div>
            <div class="col-span-8">
                <label for="fuente_financiamiento" class="text-base font-medium text-gray-700">Fuente de financiamiento: </label>
                <label id="ver_fuente_financiamiento" class="text-base font-bold text-gray-900"></label>
              </div>
              <div class="col-span-8">
                <label for="prodim" class="text-base font-medium text-gray-700">Prodim: </label>
                <span id="ver_prodim" class=" "></span>
              </div>
              <div class="col-span-8">
                <label for="gastos_indirectos" class="text-base font-medium text-gray-700">Gastos indirectos: </label>
                <span id="ver_gastos_indirectos" class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full ">Pendiente</span>
              </div>
             
          </div>
        
      </div>
      <!--footer-->
    </div>
  </div>
</div>

<div class="hidden opacity-25 fixed inset-0 z-40 bg-black" id="modal-backdrop"></div>
<script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/dataTables.responsive.min.js') }}"></script>
<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.22/b-1.6.4/b-flash-1.6.4/b-html5-1.6.4/b-print-1.6.4/datatables.min.js"></script>

@if(session('eliminar')=='ok')
  <script>
    //ejecucion del modal de aviso eliminar
    Swal.fire(
      '¡Eliminado!',
      'El registro ha sido eliminado.',
      'success'
    )
  </script>
@endif

<script>
function toggleModal(modal, fuente){
    document.getElementById(modal).classList.toggle("hidden");
    document.getElementById(modal + "-backdrop").classList.toggle("hidden");    
}

  //Mensaje de advertencia
$(".form-eliminar").submit(function(e){
    e.preventDefault();
    Swal.fire({
      customClass: {
      title: 'swal_title_modificado',
      cancelButton: 'swal_button_cancel_modificado'
      },
      title: '¿Seguro que desea eliminar este registro?',
      text: "¡Aviso, esta acción es irreversible!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#10b981',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Borrar',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      if (result.isConfirmed) {
        this.submit();
      }
    })
});
 /* */
</script>

<script>
  //ejecucion del datatable
$(document).ready(function() {
    $('#example').DataTable({
        "autoWidth" : true,
        "responsive" : true,
        columnDefs: [
            { responsivePriority: 1, targets: 4 },
            { responsivePriority: 1, targets: 1 },
            { responsivePriority: 10001, targets: 4 },
            { responsivePriority: 2, targets: -2 }
        ],
        language: {
          url: 'https://cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json'
        }
      }
    )
    .columns.adjust();
});
</script>
@endsection