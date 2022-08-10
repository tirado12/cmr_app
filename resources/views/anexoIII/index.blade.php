@extends('layouts.plantilla')
@section('title','Anexos Fondo III')
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
  <h1 class="text-xl font-bold ml-2">Anexos del fondo III</h1>
</div>

<!-- inicio data table -->
<div class="mt-6 contenedor p-8 shadow-2xl bg-white rounded-lg">

    <table id="example" class="table table-striped bg-white" style="width:100%;">
      <thead>
          <tr>
              <th>Municipio</th>
              <th>Ejercicio</th>
              <th>Acta integración</th>
              <th>Acta priorización</th>
              <th>Adendum</th>
              <th>Prodim</th>
              <th>Gastos indirectos</th>
              <th class="flex justify-center">Acción</th>
          </tr>
      </thead>
      <tbody> 
        @foreach ($anexos as $item)
          <tr>
              <td>
                <div class="text-sm leading-5 font-medium text-gray-900 flex justify-center">
                  {{ $item->nombre }}
                </div>
              </td>
              <td>
                <div class="text-sm leading-5 font-medium text-gray-900 flex justify-center">
                  {{ $item->ejercicio }}
                </div>
              </td>
             <td>
                <div class="text-sm leading-5 font-medium text-gray-900 flex justify-center">
                    {{ ($item->acta_integracion_consejo == null) ? '-' : $item->acta_integracion_consejo }}
                </div>
             </td>
              <td>
                <div class="text-sm leading-5 font-medium text-gray-900 flex justify-center">
                    {{ ($item->acta_priorizacion == null) ? '-' : $item->acta_priorizacion }}
                </div>                
              </td>
              <td>
                <div class="text-sm leading-5 font-medium text-gray-900 flex justify-center">
                    {{ ($item->adendum_priorizacion == null) ? '-' : $item->adendum_priorizacion }}
                </div>
              </td>
              <td>
                <div class="text-sm leading-5 font-medium text-gray-900 flex justify-center">
                    @if(($item->prodim == 1) )
                     <span class=" inline-flex text-xs leading-6 font-semibold rounded-full bg-green-200 text-green-800 ">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </span>
                    @else
                     <span class=" inline-flex text-xs leading-6 font-semibold rounded-full bg-red-200 text-red-800 ">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </span>
                    @endif
                </div>
              </td>
              <td>
                <div class="text-sm leading-5 font-medium text-gray-900 flex justify-center">
                    
                    @if(($item->gastos_indirectos == 1))
                    <span class=" inline-flex text-xs leading-6 font-semibold rounded-full bg-green-200 text-green-800 ">
                       <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                           <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                       </svg>
                   </span>
                   @else
                    <span class=" inline-flex text-xs leading-6 font-semibold rounded-full bg-red-200 text-red-800 ">
                       <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                           <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                       </svg>
                   </span>
                   @endif
                
                </div>
              </td>
              <td>
                <div class="flex justify-center">
                
                  <div>
                  <a type="button"  href="{{ route('anexos.edit', $item->id_anexos_fondo3) }}" class="bg-white text-sm text-blue-500 font-normal text-ms p-2 rounded rounded-lg">Editar</a> 
                  <!--<button class="bg-transparent text-blue-500 active:bg-transparent font-normal  text-sm p-2  rounded outline-none focus:outline-none  ease-linear transition-all duration-150" type="button" onclick="">
                    Detalles
                  </button> -->
                  
                  </div>
                 @endforeach 
                  
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

<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>  
<script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/dataTables.responsive.min.js') }}"></script>
  <!--Alerta de error-->
  @if(session('actualizar')=='error')
  <script>
    Swal.fire({
      icon: 'error',
      title: '¡Oops... !',
      html: 'No es posible actualizar la fuente de financiamiento,<br> verifique que no existan Gastos Indirectos y PRODIMDF relacionados.'
    });
  </script>
  @endif

  <!--Alerta de error-->
  @if(session('actualizar')=='prodim')
  <script>
    Swal.fire({
      icon: 'error',
      title: '¡Oops... !',
      html: 'No es posible actualizar la fuente de financiamiento,<br> verifique que no existan registros relacionados con PRODIMDF.'
    });
  </script>
  @endif

  <!--Alerta de error-->
  @if(session('actualizar')=='gastos')
  <script>
    Swal.fire({
      icon: 'error',
      title: '¡Oops... !',
      html: 'No es posible actualizar la fuente de financiamiento,<br> verifique que no existan resgistros relacionados con Gastos Indirectos.'
    });
  </script>
  @endif

<script>
    //ejecucion del datatable
    res = '{{ request()->filled('r') }}'
    //console.log(res)
    var busqueda= '{{ request()->r }}';
    //console.log(busqueda);
  $(document).ready(function() {
      $('#example').DataTable({
          "oSearch": {"sSearch": busqueda},
          "autoWidth" : true,
          "responsive" : true,
          language: {
            url: 'https://cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json'
          }
        }
      )
      .columns.adjust();
  });
  </script>

@endsection