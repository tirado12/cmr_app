@extends('layouts.plantilla')
@section('title','Clientes')
@section('contenido')
<h1>clientes</h1>
<link rel="stylesheet" href="{{ asset('css/datatable.css') }}">
<link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
<!--Responsive Extension Datatables CSS-->
<link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet">
<!--Button Extension Datatables CSS-->
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css">

<div class="contenedor">

  <table id="example" class="table table-striped" style="width:100%;">
    <thead>
        <tr>
            <th>Municipio</th>
            <th>Administración</th>
            <th></th>
            
        </tr>
    </thead>
    <tbody>
        <tr>
            
            <td>
              <div class="flex items-center">
                <div class="ml-4">
                    <div class="text-sm leading-5 font-medium text-gray-900">{{$roles[$index]->name}}</div>
                    <div class="text-sm leading-5 text-gray-500">{{$roles[$index]->email}}</div>
                </div>
            </div>
            </td>
            <td>{{ $roles[$index]->roles[0]->name }}</td>
            <td>
              <div class="flex justify-center">
              
                <a type="button"  href="#" class="bg-blue-500 text-white p-2 rounded hover:text-white">Editar</a>
                
                   
                <button type="submit" class="bg-red-500 text-white p-2 rounded hover:text-white">Eliminar</button>
                
              </div>
            </td>
        </tr>
        
    </tbody>
    <tfoot>
        <tr>
          <th>Municipio</th>
          <th>Administracion</th>
          <th></th>
        </tr>
    </tfoot>
  </table>
  </div>


  <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>  
  <script type="text/javascript" src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.22/b-1.6.4/b-flash-1.6.4/b-html5-1.6.4/b-print-1.6.4/datatables.min.js"></script>









<script>
  $(document).ready(function() {
    
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