@extends('layouts.plantilla')
@section('title','Contratistas')
@section('contenido')
<link rel="stylesheet" href="{{ asset('css/datatable.css') }}">
<link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/style_alert.css') }}">

<div class="flex flex-row">
    <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
    </svg>
  <h1 class="text-xl font-bold ml-2">Comprometido desglose</h1>
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

<!-- fin tabla tailwind, inicio data table -->
<div class="contenedor p-8 shadow-2xl bg-white rounded-lg">
  <table id="example" class="table table-striped bg-white" style="width:100%;">
    <thead>
        <tr>
            <th>Contratista</th>
            <th>Telefono</th>
            <th>Correo</th>
            <th>Tipo de contribuyente</th>          
            <th>Municipio</th>
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
    <!--<tfoot>
        <tr>
          <th>Usuario</th>
          <th>Rol</th>
          <th></th>
        </tr>
    </tfoot>-->
  </table>
</div>
<!-- librerias -->
<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.22/b-1.6.4/b-flash-1.6.4/b-html5-1.6.4/b-print-1.6.4/datatables.min.js"></script>
<!-- librerias -->
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