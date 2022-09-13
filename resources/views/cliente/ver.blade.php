@extends('layouts.plantilla')
@section('title','Municipio')
@section('contenido')
    <link rel="stylesheet" href="{{ asset('css/datatable.css') }}">
    <link rel="stylesheet"
        href="{{ asset('css/jquery.dataTables.min.css') }}">

    <!--Responsive Extension Datatables CSS-->
    <link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css"
        rel="stylesheet">
    <link rel="stylesheet"
        href="https://cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css">
<div class="flex flex-row items-center ">
    <img class="block ml-8 h-24 w-auto rounded-full shadow-2xl" src="{{asset('image/logo.png')}}" alt="cmr">
    <div class="ml-4 grid grid-col-1">
        <p class="block font-bold text-xl">El Barrio de la Soledad</p>
        <p class="text-gray-600">Istmo de tehuantepec</p>
    </div>
</div>


    <div class="grid grid-rows-1 grid-flow-col gap-4">

        <div class="mt-6 col-span-3 shadow-xl bg-white rounded-lg">
            <div class="border-b p-4">
                <label for="first_name" class="text-base font-medium font-bold">Información General</label>
            </div>
            <div class="p-4 grid grid-cols-8 gap-8">

                <div class="col-span-4">
                    <label for="first_name" class="block text-base font-medium text-gray-500">Dirección: </label>
                    <label for="first_name" class="text-base font-medium">Calle jardines #23 col. centro</label>
                </div>
                <div class="col-span-4">
                    <label for="first_name" class="block text-base font-medium text-gray-500">RFC: </label>
                    <label for="first_name" class="text-base font-medium">BLS23534XXXXXXXX</label>
                </div>
                <div class="col-span-4">
                    <label for="first_name" class="block text-base font-medium text-gray-500">Correo: </label>
                    <label for="first_name" class="text-base font-medium">barrio.soledad@gmail.com</label>
                </div>
                <div class="col-span-4">
                    <label for="first_name" class="block text-base font-medium text-gray-500">Presidente: </label>
                    <label for="first_name" class="text-base font-medium">Juan Garcia Quiroz</label>
                </div>
                <div class="col-span-4">
                    <label for="first_name" class="block text-base font-medium text-gray-500">Usuario: </label>
                    <label for="first_name" class="text-base font-medium">Barrio2020</label>
                </div>
                <div class="col-span-4">
                    <label for="first_name" class="block text-base font-medium text-gray-500">Periodo en curso: </label>
                    <label for="first_name" class="text-base font-medium">2020 - 2021</label>
                </div>                 
            </div>
            <div class=" p-4 border-t border-solid border-blueGray-200 rounded-b">
        
            
                <div class="text-right">
                <button class="text-white bg-gray-500 rounded font-bold uppercase px-6 py-3 text-sm outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="button" >
                  Regresar
                </button>
                <button type="submit" class="bg-blue-700 text-white active:bg-blu-700 font-bold uppercase text-sm px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150">
                  Editar
                </button>
                </div>
              </div>
            
        </div>
    
    </div>

    <!-- inicio modal -->
<div class="hidden overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center" id="modal-id">
    <div class="relative w-auto my-6 mx-auto max-w-3xl">
      <!--content-->
      <div class="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none">
        <!--header-->
        <div class="flex items-start justify-between p-5 border-b border-solid border-blueGray-200 rounded-t">
          <h4 class="text-xl font-semibold">
            Agregar nuevo integrante del cabildo
          </h4>
          
          <button class="p-1 ml-auto bg-transparent border-0 text-black opacity-5 float-right text-3xl leading-none font-semibold outline-none focus:outline-none" onclick="toggleModal('modal-id')">
            <span class="bg-transparent text-black opacity-5 h-6 w-6 text-2xl block outline-none focus:outline-none">
              
            </span>
          </button>
        </div>
        <!--body-->
        <form action="{{ route('cabildo.store') }}" method="POST" id="formulario" name="formulario">
          @csrf
          @method('POST')
        <div class="relative p-6 flex-auto">
            <div class="grid grid-cols-8 gap-8">
              <div class="col-span-8 sm:col-span-6 ">
                <label id="label_nombre" for="first_name" class="block text-sm font-medium text-gray-700">Nombre completo *</label>
                <input type="text" name="nombre" id="nombre" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required maxlength="200">
                <label id="error_nombre" name="error_nombre" class="hidden text-base font-normal text-red-500" >Ingresa un nombre</label>
              </div>
              <div class="col-span-8 sm:col-span-2">
                <label id="label_rfc" for="rfc" class="block text-sm font-medium text-gray-700">RFC *</label>
                <input type="text" name="rfc" id="rfc" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required maxlength="13" minlength="13">
                <label id="error_rfc" name="error_rfc" class="hidden text-base font-normal text-red-500" >Ingresa al menos un RFC genérico (XXXX000000XXX)</label>
              </div>
              <div class="col-span-8 sm:col-span-6">
                <label id="label_cargo" for="cargo" class="block text-sm font-medium text-gray-700">Cargo *</label>
                <input type="text" name="cargo" id="cargo" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                <label id="error_cargo" name="error_cargo" class="hidden text-base font-normal text-red-500" >Ingresa un cargo</label>
              </div>
              <div class="col-span-8 sm:col-span-2">
                  <label id="label_telefono" for="telefono" class="block text-sm font-medium text-gray-700">Teléfono *</label>
                  <input type="tel" name="telefono" id="telefono" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required maxlength="10" minlength="10">
                  <label id="error_telefono" name="error_telefono" class="hidden text-base font-normal text-red-500" >Ingresar un teléfono</label>
                </div>
              
              <div class="col-span-8 sm:col-span-4">
                  <label id="label_correo" for="correo" class="block text-sm font-medium text-gray-700">Correo electrónico *</label>
                  <input type="email" name="correo" id="correo" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                  <label id="error_correo" name="error_correo" class="hidden text-base font-normal text-red-500" >Ingresar un correo electrónico</label>
                </div>
              <div class="col-span-8 sm:col-span-4" >
                <label id="label_municipio" for="municipio" class="block text-sm font-medium text-gray-700">Municipio *</label>
                <select id="cliente" name="cliente" onchange="validarCliente()" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option value="{{$cliente->id_cliente}}">{{$cliente->nombre_municipio}}</option>
                </select>
                <label id="error_municipio" name="error_municipio" class="hidden text-base font-normal text-red-500" >Seleccione una opción</label>
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
          <button type="submit" class="bg-green-500 text-white active:bg-green-600 font-bold uppercase text-sm px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" >
            Guardar
          </button>
          </div>
        </div>
        </form>
      </div>
    </div>
  </div>
  

<div class="hidden opacity-25 fixed inset-0 z-40 bg-black" id="modal-id-backdrop"></div>
    
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.responsive.min.js') }}"></script>
    <script src="https://unpkg.com/@popperjs/core@2.9.1/dist/umd/popper.min.js" charset="utf-8"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.22/b-1.6.4/b-flash-1.6.4/b-html5-1.6.4/b-print-1.6.4/datatables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.22/b-1.6.4/b-flash-1.6.4/b-html5-1.6.4/b-print-1.6.4/datatables.min.js">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>  
    <script>
        $(document).ready(function() {
            $(document).on('change', '#cliente_id', function(event) {
                $("#btn_acceder").prop("href", location.origin+"/cliente/ejercicio/"+{{$cliente->id_cliente}}+","+$("#cliente_id option:selected").val());
            });

            $("a").bind("click", function(e){
                
                console.log(location.origin);
                
            });
            $('#example').DataTable({
                    "autoWidth": true,
                    "responsive": true,
                    "bFilter": false,
                    "bPaginate": false,
                    "bInfo": false,
                    columnDefs: [{
                            responsivePriority: 1,
                            targets: 3
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

<script type="text/javascript">
    function toggleModal(modalID){
      document.getElementById(modalID).classList.toggle("hidden");
      document.getElementById(modalID + "-backdrop").classList.toggle("hidden");
    }
  
  //validacion de campos del modal
  $(document).ready(function() {
     $("#modal-id input").keyup(function() {
    //console.log($(this).attr('id'));
        var monto = $(this).val();
        
        if(monto != ''){
        $('#error_'+$(this).attr('id')).fadeOut();
        $("#label_"+$(this).attr('id')).removeClass('text-red-500');
        $("#label_"+$(this).attr('id')).addClass('text-gray-700');
        //$('#guardar').removeAttr("disabled");
        }
        else{
        //$("#guardar").attr("disabled", true);
        $('#error_'+$(this).attr('id')).fadeIn();
        $("#label_"+$(this).attr('id')).addClass('text-red-500');
        $("#label_"+$(this).attr('id')).removeClass('text-gray-700');
        }
      
      });
  });
  
  //Validacion de select municipio
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
  
  
  //validacion del formulario con el btn guardar
  $().ready(function() {
    $("#formulario").validate({
      onfocusout: false,
      onclick: false,
          rules: {
        nombre: { required: true},
              rfc: { required: true, minlength: 5},
        cargo: { required: true},
        telefono: { required: true},
        correo: { required: true},
        municipio: { required: true}
          },
      errorPlacement: function(error, element) {
          console.log(element.attr('id'));
        if(error != null){
        $('#error_'+element.attr('id')).fadeIn();
        }else{
        $('#error_'+element.attr('id')).fadeOut();
        }
       // console.log(element.attr('id'));
      },
      }); 
    

@endsection