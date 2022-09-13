@extends('layouts.plantilla')
@section('title','Lista Obras')
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
    <h1 class="text-xl font-bold ml-2">Lista de Obras</h1>
</div>

<div class="flex flex-col mt-6">
    <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
      <a type="button"  href="{{ route('obra.create')}}" class="bg-orange-800 mb-4 text-white active:bg-orange-800 font-bold uppercase text-sm px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150">Agregar</a>
        <!-- div de tabla -->
    </div>
</div>

  <div class="mt-6 contenedor p-8 shadow-2xl bg-white rounded-lg">
    <table id="example" class="table table-striped bg-white" style="width:100%;">
        <thead>
            <tr>
                <th>Municipio</th>
                <th>Nombre</th>
                <th>Monto</th>
                <th>Fondo</th>
                <th>Modalida de ejecución</th>
                <th class="flex justify-center">Acción</th>
            </tr>
        </thead>
        <tbody>
            
            @foreach($obras as $key => $obra)
                
                <tr>
                    <td>
                      <div class="text-sm leading-5 font-medium text-gray-900">
                      {{$obra->municipio}}
                      </div>
                    </td>
                    <td>
                      <div class="text-sm leading-5 font-medium text-gray-900">
                        {{$obra -> nombre_corto}}
                      </div>

                    </td>
                    <td>
                      <div class="text-sm leading-5 font-medium text-gray-900 myDIV">
                        
                      {{ ($obra -> monto_contratado) }}</p>
                      </div>

                    </td>
                    <td>
                      <div class="text-sm leading-5 font-medium text-gray-900">
                      <p>
                      {{$obra->nombre_fuente}}
                      </p>
                      </div>
                    </td>
                    <td>
                      <div class="text-sm leading-5 font-medium text-gray-900">
                      @if($obra -> obra_contrato_id == null){{"Administración directa"}}@endif
                        @if($obra -> obra_contrato_id != null){{"Contrato"}}@endif
                      </div>
                    </td>

                    <td>
                      <div class="flex justify-center">
                      <form action="{{ route('obra.destroy', $obra->id_obra) }}" method="POST" class="form-eliminar" >
                        <div>
                        <a type="button"  href="{{ route('obra.edit', $obra->id_obra)}}" class="bg-white text-sm text-blue-500 font-normal text-ms p-2 rounded rounded-lg">Editar</a>
                        <a type="button"  href="{{ route('obra.show', $obra->id_obra)}}" class="bg-white text-sm text-blue-500 font-normal text-ms p-2 rounded rounded-lg">Detalles</a>
                        
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
<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/dataTables.responsive.min.js') }}"></script>
<style>
    .currSign:before {
        content: '$';
    }
</style>
<script>
    function moneda(valor){//formato montos
        return valor.toString().replace(/\D/g, "").replace(/([0-9])([0-9]{2})$/, '$1.$2').replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ",");
      }
    //Formato de cantidades
      let x = document.querySelectorAll(".myDIV");
      for (let i = 0, len = x.length; i < len; i++) {
          // let num = Number(x[i].innerHTML)
          //           .toLocaleString('es-MX');
          let num = moneda(parseFloat(x[i].innerHTML).toFixed(2));
          x[i].innerHTML = num;
          x[i].classList.add("currSign"); 
      }
</script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.22/b-1.6.4/b-flash-1.6.4/b-html5-1.6.4/b-print-1.6.4/datatables.min.js"></script>
<script>
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
</script>
@endsection