@extends('layouts.plantilla')
@section('title','Sisplade')
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
  <h1 class="text-xl font-bold ml-2">Lista Sisplade</h1>
</div>

<div class="flex flex-col mt-6">
    <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
        <a href="{{route('sisplade.create')}}"><button class="bg-orange-800 mb-4 text-white active:bg-orange-800 font-bold uppercase text-sm px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="button" >
        Agregar
        </button></a>
    </div>
</div>

<!-- fin tabla tailwind, inicio data table -->
<div class="mt-6 contenedor p-8 shadow-2xl bg-white rounded-lg">

    <table id="example" class="table table-striped bg-white" style="width:100%;">
      <thead>
          <tr>
              <th>Municipio</th>
              <th>Ejercicio</th>
              <th>F. Financiamiento</th>
              <th>Capturado</th>
              <th>Fecha de Captura</th>
              <th>Validación</th>
              <th>Fecha de Validación</th>
              <th class="flex justify-center">Acción</th>
              
          </tr>
      </thead>
      <tbody> 
      @foreach ($sisplade as $item)
          
          <tr>
              <td>
                <div class="text-sm leading-5 font-medium text-gray-900 flex justify-center">
                  {{$clientes->find($item->fuentesCliente->cliente_id)->nombre}}
                </div>
              </td>
              <td>
                <div class="text-sm leading-5 font-medium text-gray-900 flex justify-center">
                  {{$fuentesCliente->find($item->fuentesCliente->id_fuente_financ_cliente)->ejercicio}}
                </div>
              </td>
             <td>
                <div class="text-sm leading-5 font-medium text-gray-900 myDIV flex justify-center">
                 {{$fuentes->find($item->fuentesCliente->fuente_financiamiento_id)->nombre_corto}}
                </div>
              </td>
              <td>
                <div class="text-sm leading-5 font-medium text-gray-900 flex justify-center" id="capturado">
                    <span id="ver_prodim" class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ ($item->capturado == 1 ? " bg-green-100 text-green-800" : "bg-yellow-100 text-yellow-800" ) }}">{{ ($item->capturado == 1 ? "Capturado" : "Sin Capturar" ) }}</span>
                </div>
              </td>
              <td>
                <div class="text-sm leading-5 font-medium text-gray-900 flex justify-center">
                    {{($item->fecha_capturado == '') ? '-' : $item->fecha_capturado}}
                </div>
              </td>
              <td>
                <div class="text-sm leading-5 font-medium text-gray-900 flex justify-center" id="validacion">
                    <span id="ver_prodim" class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ ($item->validado == 1 ? " bg-green-100 text-green-800" : "bg-yellow-100 text-yellow-800" ) }}">{{ ($item->validado == 1 ? "Validado" : "Sin Validar" ) }}</span>
                </div>
              </td>
              <td>
                <div class="text-sm leading-5 font-medium text-gray-900 flex justify-center">
                   {{($item->fecha_validado == '') ? '-' : $item->fecha_validado}}
                </div>
              </td>
              <td>
                <div class="flex justify-center">
                <form action="{{ route('sisplade.destroy', $item->id_sisplade) }}" method="POST" class="form-eliminar" >
                  <div>
                  <a type="button"  href="{{ route('sisplade.edit', $item->id_sisplade) }}" class="bg-white text-sm text-blue-500 font-normal text-ms p-2 rounded rounded-lg">Editar</a> 
                  
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




<div class="hidden opacity-25 fixed inset-0 z-40 bg-black" id="modal-backdrop"></div>
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.22/b-1.6.4/b-flash-1.6.4/b-html5-1.6.4/b-print-1.6.4/datatables.min.js"></script>
    

    <!--Alerta de confirmacion-->
@if(session('eliminar')=='ok')
<script>
  Swal.fire(
    '¡Eliminado!',
    'El registro ha sido eliminado.',
    'success'
  )
</script>
@endif

<script>
  $(".form-eliminar").submit(function(e){ //propiedades del mensaje de advertencia eliminar
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
                { width: 90, targets: 0 }
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