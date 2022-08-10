@extends('layouts.plantilla')
@section('title','Dashboard')
@section('contenido')
        
        <link rel="stylesheet" href="{{ asset('css/datatable.css') }}">
        <link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/style_alert.css') }}">
        <!--Responsive Extension Datatables CSS-->
        <link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css">

<h3 class="text-gray-700 text-3xl font-bold mb-4">Dashboard</h3>
        
<div class="mt-8">
</div>

<div class="flex items-center justify-center h-80 rounded-lg ">
    <div class="flex items-center justify-center">
    <div class="grid grid-cols-1 sm:gap-6 md:gap-6 lg:gap-2 xl:gap-8 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-4 xl:grid-cols-4">
        
        <!-- 1 card -->
        <div class=" bg-white py-6 px-6 rounded-3xl w-56 my-4 shadow-xl border">
            <div class="-mb-4 -mt-12 text-white flex items-center  rounded-full h-16 w-16 flex justify-center shadow-xl bg-pink-500 left-4 -top-6">
                <!-- svg  -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                </svg>
            </div>
            <div class="mt-8">
                <p class="text-xl font-semibold my-2">Clientes</p>
                <div class="flex space-x-2 text-gray-400 text-sm">
                    <!-- svg  -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                     <p>Marketing Team</p> 
                </div>
                <div class="flex space-x-2 text-gray-400 text-sm my-3">
                    <!-- svg  -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                     <p>1 Weeks Left</p> 
                </div>
                <div class="border-t-2"></div>
                <div class="flex justify-between">
                    <div class="my-2">
                        <p class="font-semibold text-base mb-2">Team Member</p>
                        <div class="flex space-x-2">
                            <img src="https://images.pexels.com/photos/614810/pexels-photo-614810.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500" 
                            class="w-6 h-6 rounded-full"/>
                             <img src="https://upload.wikimedia.org/wikipedia/commons/e/ec/Woman_7.jpg" 
                            class="w-6 h-6 rounded-full"/>
                             <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRxSqK0tVELGWDYAiUY1oRrfnGJCKSKv95OGUtm9eKG9HQLn769YDujQi1QFat32xl-BiY&usqp=CAU" 
                            class="w-6 h-6 rounded-full"/>
                        </div>
                    </div>
                     <div class="my-2">
                        <p class="font-semibold text-base mb-2">Progress</p>
                        <div class="text-base text-gray-400 font-semibold">
                            <p>34%</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- 2 card -->
        <div class=" bg-white py-6 px-6 rounded-3xl w-56 my-4 shadow-xl border">
            <div class="-mb-4 -mt-12 text-white flex items-center  rounded-full h-16 w-16 flex justify-center shadow-xl bg-pink-500 left-4 -top-6">
                <!-- svg  -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                </svg>
            </div>
            <div class="mt-8">
                <p class="text-xl font-semibold my-2">Clientes</p>
                <div class="flex space-x-2 text-gray-400 text-sm">
                    <!-- svg  -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                     <p>Marketing Team</p> 
                </div>
                <div class="flex space-x-2 text-gray-400 text-sm my-3">
                    <!-- svg  -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                     <p>1 Weeks Left</p> 
                </div>
                <div class="border-t-2"></div>
                <div class="flex justify-between">
                    <div class="my-2">
                        <p class="font-semibold text-base mb-2">Team Member</p>
                        <div class="flex space-x-2">
                            <img src="https://images.pexels.com/photos/614810/pexels-photo-614810.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500" 
                            class="w-6 h-6 rounded-full"/>
                             <img src="https://upload.wikimedia.org/wikipedia/commons/e/ec/Woman_7.jpg" 
                            class="w-6 h-6 rounded-full"/>
                             <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRxSqK0tVELGWDYAiUY1oRrfnGJCKSKv95OGUtm9eKG9HQLn769YDujQi1QFat32xl-BiY&usqp=CAU" 
                            class="w-6 h-6 rounded-full"/>
                        </div>
                    </div>
                     <div class="my-2">
                        <p class="font-semibold text-base mb-2">Progress</p>
                        <div class="text-base text-gray-400 font-semibold">
                            <p>34%</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- 3 card -->
        <div class=" bg-white py-6 px-6 rounded-3xl w-56 my-4 shadow-xl border">
            <div class="-mb-4 -mt-12 text-white flex items-center  rounded-full h-16 w-16 flex justify-center shadow-xl bg-pink-500 left-4 -top-6">
                <!-- svg  -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                </svg>
            </div>
            <div class="mt-8">
                <p class="text-xl font-semibold my-2">Clientes</p>
                <div class="flex space-x-2 text-gray-400 text-sm">
                    <!-- svg  -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                     <p>Marketing Team</p> 
                </div>
                <div class="flex space-x-2 text-gray-400 text-sm my-3">
                    <!-- svg  -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                     <p>1 Weeks Left</p> 
                </div>
                <div class="border-t-2"></div>
                <div class="flex justify-between">
                    <div class="my-2">
                        <p class="font-semibold text-base mb-2">Team Member</p>
                        <div class="flex space-x-2">
                            <img src="https://images.pexels.com/photos/614810/pexels-photo-614810.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500" 
                            class="w-6 h-6 rounded-full"/>
                             <img src="https://upload.wikimedia.org/wikipedia/commons/e/ec/Woman_7.jpg" 
                            class="w-6 h-6 rounded-full"/>
                             <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRxSqK0tVELGWDYAiUY1oRrfnGJCKSKv95OGUtm9eKG9HQLn769YDujQi1QFat32xl-BiY&usqp=CAU" 
                            class="w-6 h-6 rounded-full"/>
                        </div>
                    </div>
                     <div class="my-2">
                        <p class="font-semibold text-base mb-2">Progress</p>
                        <div class="text-base text-gray-400 font-semibold">
                            <p>34%</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- 4 card -->
        <div class=" bg-white py-6 px-6 rounded-3xl w-56 my-4 shadow-xl border">
            <div class="-mb-4 -mt-12 text-white flex items-center  rounded-full h-16 w-16 flex justify-center shadow-xl bg-pink-500 left-4 -top-6">
                <!-- svg  -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                </svg>
            </div>
            <div class="mt-8">
                <p class="text-xl font-semibold my-2">Clientes</p>
                <div class="flex space-x-2 text-gray-400 text-sm">
                    <!-- svg  -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                     <p>Marketing Team</p> 
                </div>
                <div class="flex space-x-2 text-gray-400 text-sm my-3">
                    <!-- svg  -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                     <p>1 Weeks Left</p> 
                </div>
                <div class="border-t-2"></div>
                <div class="flex justify-between">
                    <div class="my-2">
                        <p class="font-semibold text-base mb-2">Team Member</p>
                        <div class="flex space-x-2">
                            <img src="https://images.pexels.com/photos/614810/pexels-photo-614810.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500" 
                            class="w-6 h-6 rounded-full"/>
                             <img src="https://upload.wikimedia.org/wikipedia/commons/e/ec/Woman_7.jpg" 
                            class="w-6 h-6 rounded-full"/>
                             <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRxSqK0tVELGWDYAiUY1oRrfnGJCKSKv95OGUtm9eKG9HQLn769YDujQi1QFat32xl-BiY&usqp=CAU" 
                            class="w-6 h-6 rounded-full"/>
                        </div>
                    </div>
                     <div class="my-2">
                        <p class="font-semibold text-base mb-2">Progress</p>
                        <div class="text-base text-gray-400 font-semibold">
                            <p>34%</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    </div>
</div>


<div class="mt-6 contenedor p-8 shadow-2xl bg-white rounded-lg">
    <div class="flex flex-row justify-center bg-gray-100 rounded p-2">
        <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
        </svg>
        <h1 class="text-xl font-bold ml-2">Lista de clientes</h1>
      </div>
    <table id="example" class="table table-striped bg-white" style="width:100%;">
        <thead>
            <tr>
                <th>Municipio</th>
                <th>RFC</th>
                <th>Direccion</th>
                <th>E-mail</th>            
                <th class="flex justify-center">Acción</th>
            </tr>
        </thead>
        <tbody>
                <tr>
                    <td>
                      <div class="text-sm leading-5 font-medium text-gray-900">
                       El barrio de la soledad
                      </div>
                    </td>
                    <td>
                      <div class="text-sm leading-5 font-medium text-gray-900">
                       BDS02394902XXXX
                      </div>

                    </td>
                    <td>
                      <div class="text-sm leading-5 font-medium text-gray-900">
                       Centro s/n
                      </div>
                    </td>
                    <td>
                        <div class="text-sm leading-5 font-medium text-gray-900">
                            barriodelasoledad@gmail.com
                        </div>
                    </td>
                    <td>
                      <div class="flex justify-center">
                      <form action="" method="POST" class="form-eliminar" >
                        <div>
                        <a type="button"  href="" class="bg-white text-sm text-blue-500 font-normal text-ms p-2 rounded rounded-lg">Ver Detalles</a>
                        
                        <!--@csrf
                        @method('DELETE')
                        <button type="submit" class="bg-white text-red-500 p-2 rounded rounded-lg">Eliminar</button>
                        </div>-->

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

<div class="mt-8">
</div>



<div class="mt-8">
</div>
<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/dataTables.responsive.min.js') }}"></script>
<script src="https://unpkg.com/@popperjs/core@2.9.1/dist/umd/popper.min.js" charset="utf-8"></script>

<script type="text/javascript" src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.22/b-1.6.4/b-flash-1.6.4/b-html5-1.6.4/b-print-1.6.4/datatables.min.js"></script>


<script>
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