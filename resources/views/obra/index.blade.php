
@extends('layouts.plantilla')
@section('title','Clientes')
@inject('service', 'App\Http\Controllers\ObraController')
@inject('fuentes', 'App\Http\Controllers\ObraController')
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
      <h1 class="text-xl font-bold ml-2">Lista de clientes</h1>
    </div>

    <div class="flex flex-col mt-6">
        <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
          <a type="button"  href="{{ route('obra.create')}}" class="bg-orange-800 mb-4 text-white active:bg-orange-800 font-bold uppercase text-sm px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150">Agregar</a>
            <!-- div de tabla -->
        </div>
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
                  @php
                    $obra_aux = $obra_1;
                  @endphp
                  <tr>
                      <td>
                        <div class="text-sm leading-5 font-medium text-gray-900">
                        {{$obra_1->find($obra->id_obra)->nombre_municipio}}
                        </div>
                      </td>
                      <td>
                        <div class="text-sm leading-5 font-medium text-gray-900">
                          {{$obra -> nombre}}
                        </div>

                      </td>
                      <td>
                        <div class="text-sm leading-5 font-medium text-gray-900 text-right">
                          
                        {{ $service->formatNumber($obra -> monto_contratado) }}</p>
                        </div>

                      </td>
                      <td>
                        <div class="text-sm leading-5 font-medium text-gray-900">
                        <p>
                        {{$obra_1->groupBy('id_obra')->get("$obra->id_obra")->implode('nombre', ' - ')}}
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

<!-- inicio modal -->
<div class="hidden overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center" id="modal-id">
  <div class="relative w-auto my-6 mx-auto max-w-3xl">
    <!--content-->
    <div class="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none">
      <!--header-->
      <div class="flex items-start justify-between p-5 border-b border-solid border-blueGray-200 rounded-t">
        <h4 class="text-xl font-semibold">
          Municipio
        </h4>
        <button class="p-1 ml-auto bg-transparent border-0 text-red-500 float-right text-3xl leading-none font-semibold outline-none focus:outline-none" onclick="toggleModal_1('modal-id')">
          <span class="bg-transparent text-red-500 h-6 w-6 text-2xl block outline-none focus:outline-none">
            ×
          </span>
        </button>
      </div>
      <!--body-->

      <div class="relative p-6 flex-auto">
          <div class="grid grid-cols-8 gap-8">
            <div class="col-span-8 ">
              <label for="first_name" class="text-base font-medium text-gray-700">Nombre: </label>
              <label id="nombre_municipio" class="text-base font-bold text-gray-900"></label>
            </div>
            <div class="col-span-8">
              <label for="rfc_address" class=" text-base font-medium text-gray-700">RFC: </label>
              <label id="rfc_municipio" class="text-base font-bold text-gray-900"></label>
            </div>
            <div class="col-span-8">
              <label for="domicilio_address" class=" text-base font-medium text-gray-700">Domicilio: </label>
              <label id="direccion_municipio" class="text-base font-bold text-gray-900"></label>
            </div>
          </div>

      </div>
      <!--footer-->
    </div>
  </div>
</div>

<!-- inicio modal -->
<div class="hidden overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center" id="modal-cliente">
  <div class="relative w-auto my-6 mx-auto max-w-3xl">
    <!--content-->
    <div class="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none">
      <!--header-->
      <div class="flex items-start justify-between p-5 border-b border-solid border-blueGray-200 rounded-t">
        <h4 class="text-xl font-semibold">
          Datos del cliente
        </h4>
        <button class="p-1 ml-auto bg-transparent border-0 text-red-500 float-right text-3xl leading-none font-semibold outline-none focus:outline-none" onclick="toggleModal_1('modal-cliente')">
          <span class="bg-transparent text-red-500 h-6 w-6 text-2xl block outline-none focus:outline-none">
            ×
          </span>
        </button>
      </div>
      <!--body-->

      <div class="relative p-6 flex-auto">


          <div class="grid grid-cols-8 ">


            <div class="grid col-span-4 gap-4">
              <div class="col-span-8 ">
                <label for="first_name" class="text-base font-medium text-gray-700">Nombre de usuario: </label>
                <label id="nombre_cliente" class="text-base font-bold text-gray-900"></label>
              </div>
              <div class="col-span-8">
                <label for="email_address" class=" text-base font-medium text-gray-700">E-mail: </label>
                <label id="email_cliente" class="text-base font-bold text-gray-900"></label>
              </div>
              <div class="col-span-8">
                <label for="periodo_address" class=" text-base font-medium text-gray-700">Periodo: </label>
                <label id="periodo_cliente" class="text-base font-bold text-gray-900"></label>
              </div>
              <div class="col-span-8">
                <label for="municipio_address" class="text-base font-medium text-gray-700">Municipio: </label>
                <label id="municipio_cliente" class="text-base font-bold text-gray-900"></label>

              </div>
            </div>
            <div class="col-span-4">
              <div class="col-span-4">
                <label for="logo_address" class="text-base font-medium text-gray-700">Logo: </label>
                  <div class="flex-shrink-0 flex items-center">
                      <img id="logo_cliente" class="block  h-20 w-auto" src="" alt="Workflow">
                  </div>

              </div>

            </div>



          </div>

      </div>
      <!--footer-->
    </div>
  </div>
</div>



<!-- inicio modal -->
<div class="hidden overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center" id="modal-add">
  <div class="relative w-auto my-6 mx-auto max-w-3xl">
    <!--content-->
    <div class="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none">
      <!--header-->
      <div class="flex items-start justify-between p-5 border-b border-solid border-blueGray-200 rounded-t">
        <h4 class="text-xl font-semibold">
          Agregar nuevo cliente
        </h4>
        <button class="p-1 ml-auto bg-transparent border-0 text-black opacity-5 float-right text-3xl leading-none font-semibold outline-none focus:outline-none" onclick="toggleModal_1('modal-add')">
          <span class="bg-transparent text-black opacity-5 h-6 w-6 text-2xl block outline-none focus:outline-none">

          </span>
        </button>
      </div>
      <!--body-->
      <form action="{{ route('obra.store', $obra->id) }}" method="POST" accept-charset="UTF-8" enctype="multipart/form-data" id="form-ajax">
        @csrf
        @method('POST')
      <div class="relative p-6 flex-auto">
      
          
          
          <div class="grid grid-cols-8 gap-4">
            <div class="col-span-8 ">
              <label id="label_user" for="first_name" class="block text-base font-bold text-gray-700" >Nombre de usuario *</label>
              <input type="text" onKeyUp="this.value=this.value.toLowerCase();" name="user" id="user" autocomplete="given-name" class="mt-1 focus:ring-blue-800 focus:border-blue-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required value="{{ old('user') }}">
              <label id="usuario_existe" class="hidden text-base font-normal text-red-500" >Nombre de usuario no disponible</label>
              <label id="usuario_libre" class="hidden text-base font-normal text-green-500" >Nombre de usuario disponible</label>
            </div>
            <div class="col-span-8">
              <label id="label_email" for="email_address" class="block text-base font-bold text-gray-700">E-mail *</label>
              <input type="text" name="email" id="email" autocomplete="email" class="mt-1 focus:ring-blue-800 focus:border-blue-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ old('email') }}">
              <label id="email_existe" class="hidden text-base font-normal text-red-500" >Correo electrónico registrado con anterioridad</label>

            </div>
            <div class="col-span-8">
              <label for="password" class="block text-base font-bold text-gray-700">Contraseña *</label>
              <input type="password" name="password" id="password"  class="mt-1 focus:ring-blue-800 focus:border-blue-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ old('password') }}">
              <p class=" text-xs font-medium text-gray-700 leading-5">Utiliza entre ocho y doce caracteres con una combinación de letras minúsculas, mayúsculas, números y símbolos $@_!%*?&.</p>
            </div>

            <div id="div_confirmacion" class="hidden col-span-8">
              <label for="password_confirmation" class="block text-base font-bold text-gray-700">Confirmar contraseña *</label>
              <input type="password" name="password_confirmation" id="password_confirmation"  class="mt-1 focus:ring-blue-800 focus:border-blue-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ old('password') }}">
              <label id="no_coinciden" class="hidden text-base font-normal text-red-500" >Las contraseñas no coinciden.</label>
            </div>

            <div class="col-span-8">
              <label for="country" class="block text-base font-bold text-gray-700">Municipio *</label>
              <select id="municipio_id" name="municipio_id" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-800 focus:border-blue-800 sm:text-sm">
                
              </select>
            </div>
            <div class="col-span-8">
                  <label for="periodo_address" class=" text-base font-bold text-gray-700">Periodo: * </label>
                  <div class="grid grid-cols-8">
                    <div class="col-span-4 mr-3">
                      <label for="periodo_address" class=" text-xs font-medium text-gray-700">Año inicial: </label>
                      <input type="number" min="2015" max="2030" name="anio_inicio" id="anio_inicio" autocomplete="direccion" class=" focus:ring-blue-800 focus:border-blue-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ old('anio_inicio')}}">
                    </div>
                    <div class=" col-span-4 ml-3">
                      <label for="periodo_address" class=" text-xs font-medium text-gray-700">Año final: </label>
                      <input type="number" min="2015" max="2030" name="anio_fin" id="anio_fin" autocomplete="direccion" class="focus:ring-blue-800 focus:border-blue-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ old('anio_fin') }}">
                    </div>
                  </div>
                </div>
            <div class="col-span-8">
                  <label for="email_address" class=" text-base font-bold text-gray-700">Logo: *</label>

                  <div class="col-span-4">
                    <div class="custom-input-file text-blue-500">
                      <input type="file" id="file" name="file" class="input-file" accept="image/png, image/jpeg" value="">
                      Examinar archivos
                    </div>
                    <img id="preViewImg" src="" alt="your image" class="hidden h-32"/>
                  </div>

                </div>
          </div>
          <div class="flex flex-wrap">
  <div class="w-full text-center">
    <button class="bg-pink-500 text-white active:bg-white font-bold uppercase text-sm px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="button" onclick="openPopover(event,'popover-id')">
      top pink
    </button>
    <div class="hidden bg-white border mb-3 block z-50 font-normal leading-normal text-sm max-w-xs text-left no-underline break-words rounded-lg border-blueGray-100" id="popover-id">
      <div>
        <div class="bg-white text-black opacity-75 font-semibold p-3 mb-0 border-b border-solid border-blueGray-100 uppercase rounded-t-lg">
          Estructura de contraseña
        </div>
        <div class="text-black p-3">
          Utiliza entre ocho y doce caracteres con una combinación de letras minúsculas, mayúsculas, números y símbolos $@_!%*?&.
        </div>
      </div>
    </div>
  </div>
</div>


      </div>
      <!--footer-->
      <div class=" p-4 border-t border-solid border-blueGray-200 rounded-b">

        <span class="block text-xs">Verifique los campos obligatorios marcados con un ( * )</span>
        <div class="text-right">
        <button class="text-red-500 background-transparent font-bold uppercase px-6 py-2 text-sm outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="button" onclick="toggleModal_1('modal-add')">
          Cancelar
        </button>
        <button type="submit" class="bg-green-500 text-white active:bg-green-600 font-bold uppercase text-sm px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150">
          Guardar
        </button>
        </div>
      </div>
      </form>
    </div>
  </div>
</div>


<div class="hidden opacity-25 fixed inset-0 z-40 bg-black" id="modal-id-backdrop"></div>
<div class="hidden opacity-25 fixed inset-0 z-40 bg-black" id="modal-cliente-backdrop"></div>
<div class="hidden opacity-25 fixed inset-0 z-40 bg-black" id="modal-add-backdrop"></div>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('js/dataTables.responsive.min.js') }}"></script>
  <script src="https://unpkg.com/@popperjs/core@2.9.1/dist/umd/popper.min.js" charset="utf-8"></script>
<script>
  function openPopover(event,popoverID){
    let element = event.target;
    while(element.nodeName !== "BUTTON"){
      element = element.parentNode;
    }
    var popper = Popper.createPopper(element, document.getElementById(popoverID), {
      placement: 'top'
    });
    document.getElementById(popoverID).classList.toggle("hidden");
  }
</script>


@if(session('eliminar')=='ok')
  <script>
    Swal.fire(
      '¡Eliminado!',
      'El usuario ha sido eliminado.',
      'success'
    )
  </script>
@endif

<script>
  $(".form-eliminar").submit(function(e){
    e.preventDefault();
    Swal.fire({
      customClass: {
        title: 'swal_title_modificado',
        cancelButton: 'swal_button_cancel_modificado'
      },
      title: '¿Seguro que desea eliminar este usuario?',
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


<script type="text/javascript">
  $(".btn-AddDate").on("click",function() {
  alert("Modal Mostrada");
  document.getElementById('modal-id').classList.toggle("hidden");
    document.getElementById('modal-id' + "-backdrop").classList.toggle("hidden");

});
  function toggleModal(modalID, cliente){
    $('#nombre_cliente').html(cliente.user);
    $('#email_cliente').html(cliente.email);
    if(cliente.anio_fin != null){
      var periodo = "";
      periodo = periodo + cliente.anio_fin + "-" ;
      $('#periodo_cliente').html(cliente.anio_inicio + "-" + cliente.anio_fin);
    }else{
      $('#periodo_cliente').html(cliente.anio_inicio);
    }

    $('#municipio_cliente').html(cliente.municipio.nombre +' - '+ cliente.municipio.id_municipio);
    $('#logo_cliente').attr("src",cliente.logo);
    document.getElementById(modalID).classList.toggle("hidden");
    document.getElementById(modalID + "-backdrop").classList.toggle("hidden");
  }
  function toggleModal_municipio(modalID, municipio){
    console.log(municipio);
    $('#nombre_municipio').html( municipio.nombre +' - '+ municipio.id_municipio );
    $('#rfc_municipio').html(municipio.rfc);
    $('#direccion_municipio').html(municipio.direccion);

    document.getElementById(modalID).classList.toggle("hidden");
    document.getElementById(modalID + "-backdrop").classList.toggle("hidden");
  }

  function toggleModal_1(modalID){
    document.getElementById(modalID).classList.toggle("hidden");
    document.getElementById(modalID + "-backdrop").classList.toggle("hidden");
  }
</script>
<style>

</style>

<script type="text/javascript" src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.22/b-1.6.4/b-flash-1.6.4/b-html5-1.6.4/b-print-1.6.4/datatables.min.js"></script>



<script>
  $(document).ready(function() {
    var anio = (new Date).getFullYear();
    $('#anio_inicio').attr("min", anio -2);
    $('#anio_inicio').attr("max", anio +1);
    $('#anio_fin').attr("min", anio);
    $('#anio_fin').attr("max", anio +3);

    function readURL(input) {
      if (input.files && input.files[0]) {
          var reader = new FileReader();
          reader.onload = function (e) {
              $('#preViewImg').attr('src', e.target.result);
              $('#preViewImg').removeClass('hidden');
          }

          reader.readAsDataURL(input.files[0]);
      }
    }

    $("#file").click(function(){
        $('#preViewImg').addClass('hidden');
    });


    $(document).on('change','#file',function(){
        readURL(this);
    });

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

    $("#password").on('keyup', function(){
      var password = $(this).val();
      $('#password_confirmation').val("");
      var re = /^(?=.*\d)(?=.*[$@_!%*?&]|[^ ])(?=.*[A-Z])(?=.*[a-z])\S{8,12}$/;
      var OK = re.exec(password);
      var out = document.querySelector('#out');
      if (!OK) {
        $('#div_confirmacion').addClass('hidden');
      } else {
        $('#div_confirmacion').removeClass('hidden');
      }
    }).keyup();

    $("#password_confirmation").on('keyup', function(){
      var password_1 = $(this).val();
      var password_2 = $('#password').val();
      if(password_1 == password_2){
        $('#no_coinciden').addClass('hidden');
      }else{
        $('#no_coinciden').removeClass('hidden');
      }
    }).keyup();
    

    $("#user").on('keyup', function(){
      var user = $(this).val();
      if(user.length > 0){
      $.ajax({
          url:'http://127.0.0.1:8000/userCliente',
          data:{'user':user},
          type:'get',
          success: function (response) {
            if(response == 0){
              $('#usuario_existe').addClass('hidden');
              $('#usuario_libre').removeClass('hidden');
              $("#label_user").removeClass('text-red-500');
              $("#label_user").addClass('text-gray-500');
            }
            else{
              $('#usuario_existe').removeClass('hidden');
              $('#usuario_libre').addClass('hidden');
              $("#label_user").addClass('text-red-500');
              $("#label_user").removeClass('text-gray-500');
            }
          },
          statusCode: {
             404: function() {
                alert('web not found');
             }
          },
          error:function(x,xs,xt){
              //nos dara el error si es que hay alguno
              window.open(JSON.stringify(x));
              //alert('error: ' + JSON.stringify(x) +"\n error string: "+ xs + "\n error throwed: " + xt);
          }
       });}
    }).keyup();

    $("#email").on('keyup', function(){
      var email = $(this).val();
      if(email.length > 0){
      $.ajax({
          url:'http://127.0.0.1:8000/emailCliente',
          data:{'email':email},
          type:'get',
          success: function (response) {
            if(response == 0){
              $('#email_existe').addClass('hidden');
              $("#label_email").removeClass('text-red-500');
              $("#label_email").addClass('text-gray-500');
            }
            else{
              $('#email_existe').removeClass('hidden');
              $("#label_email").addClass('text-red-500');
              $("#label_email").removeClass('text-gray-500');
            }
          },
          statusCode: {
             404: function() {
                alert('web not found');
             }
          },
          error:function(x,xs,xt){
              //nos dara el error si es que hay alguno
              window.open(JSON.stringify(x));
              //alert('error: ' + JSON.stringify(x) +"\n error string: "+ xs + "\n error throwed: " + xt);
          }
       });}
    }).keyup();
});
</script>




@endsection
