@extends('layouts.plantilla')
@section('title','Editar ')
@section('contenido')
<link rel="stylesheet" href="{{ asset('css/style_alert.css') }}">

<div class="flex flex-row mb-4">
<svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
</svg>
<h1 class="font-bold text-xl ml-2">Editar cliente</h1>
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



<div class="mt-10 sm:mt-0 shadow-2xl bg-white rounded-lg">

      <div class="mt-5 md:mt-0 md:col-span-2">
        <form action="{{ route('clientes.update', $cliente) }}" method="POST" accept-charset="UTF-8" enctype="multipart/form-data">
          @csrf
          @method('PUT')

          <div class="shadow overflow-hidden sm:rounded-md">

            <div class="px-4 py-5 bg-white sm:p-6 flex-auto">
            <div class="grid grid-cols-8">
                <div class="col-span-4 mx-4">
                  <label for="first_name" class="text-base font-bold text-gray-700">Nombre de usuario: </label>
                  <input type="text" name="user" id="user" autocomplete="given-name" class=" mt-1 focus:ring-blue-800 focus:border-blue-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ $cliente->user }}">
                </div>
                <div class="col-span-4 mx-4">
                  <label for="email_address" class=" text-base font-bold text-gray-700">E-mail: </label>
                  <input type="text" name="email" id="email" autocomplete="email" class="mt-1 focus:ring-blue-800 focus:border-blue-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ $cliente -> email }}">
                </div>
                <div class="col-span-4 mt-7 mx-4">
                  <label for="email_address" class=" text-base font-bold text-gray-700">Contraseña: </label>
                  <input type="password" name="password" id="password" class="mt-1 focus:ring-blue-800 focus:border-blue-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="">
                  <label class="text-base font-bold text-gray-500"><input type="checkbox" onclick="myPassword()" class="focus:ring-blue-800 focus:border-blue-800 shadow-sm sm:text-sm border-gray-300 rounded"> Ver contraseña </label>
                </div>
                <div class="col-span-4 mt-7 mx-4">
                  <label for="municipio_address" class="text-base font-bold text-gray-700">Municipio: </label>
                  <select id="municipio_id" name="municipio_id" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-800 focus:border-blue-800 sm:text-sm" >
                    @foreach($municipios as $municipio)
                      <option value="{{ $municipio->id_municipio }}" {{ ($municipio->id_municipio == $cliente->municipio_id) ? 'selected' : '' }}> {{ $municipio->nombre }}</option>

                    @endforeach
                  </select>


                </div>

                <div class="col-span-4 mt-7 mx-4">
                  <label for="email_address" class=" text-base font-bold text-gray-700">Logo: </label>

                  <div class="col-span-4">
                    <div class="custom-input-file text-blue-500">
                      <input type="file" id="file" name="file" class="input-file" accept="image/png, image/jpeg" value="">
                      Examinar archivos
                    </div>
                    <input type="text" name="logo_text" id="logo_text" autocomplete="email" class="hidden focus:ring-blue-800 focus:border-blue-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ $cliente -> logo }}">
                    <img id="preViewImg" src="{{asset($cliente->logo)}}" alt="your image" class="h-32 border border-blue-900 rounded"/>
                  </div>

                </div>
                <div class="col-span-4 mt-7 mx-4">
                  <label for="periodo_address" class=" text-base font-bold text-gray-700">Periodo: * </label>
                  <div class="grid grid-cols-8">
                    <div class="col-span-4 mr-3">
                      <label for="periodo_address" class=" text-xs font-medium text-gray-700">Año inicial: </label>
                      <input type="date"  name="anio_inicio" id="anio_inicio" autocomplete="direccion" class=" focus:ring-blue-800 focus:border-blue-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ $cliente ->anio_inicio }}">
                    </div>
                    <div class=" col-span-4 ml-3">
                      <label for="periodo_address" class=" text-xs font-medium text-gray-700">Año final: </label>
                      <input type="date"  name="anio_fin" id="anio_fin" autocomplete="direccion" class="focus:ring-blue-800 focus:border-blue-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ $cliente ->anio_fin }}">
                    </div>
                  </div>
                </div>



</div>

                <input type="hidden" name="_token" value="{{ csrf_token() }}">



            </div>
          </div>

            </div>
            <div class="px-4 py-3 bg-gray-100 sm:px-6">
              <span class="block text-xs">Por favor verifique que todos los campos marcados con ( * ) no estén vacios.</span>
              <div class="text-right">
                <a type="button" href="{{route('clientes.index')}}" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-gray-500 hover:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                  Regresar
                </a>
              <button type="submit" class="ml-4 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-orange-800 hover:bg-orange-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Guardar
              </button>

              </div>
            </div>
          </div>
        </form>
      </div>

  </div>
  <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>

  <script>

function myPassword() {
  var x = document.getElementById("password");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}

  $(document).ready(function() {

    var anio = (new Date).getFullYear();
     
     fechaIniMin = (anio-2)+"-01-01";
     fechaIniMax = (anio+1)+"-12-31";
     fechaFinMin = (anio)+"-01-01";
     fechaFinMax = (anio+3)+"-12-31";
     
     //console.log(fechaIniMax)
     $('#anio_inicio').attr("min", fechaIniMin);
     $('#anio_inicio').attr("max", fechaIniMax);
     $('#anio_fin').attr("min", fechaFinMin);
     $('#anio_fin').attr("max", fechaFinMax);

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
      if($('#logo_text').val() != ""){
        // $('#preViewImg').attr('src', '' );
        // $('#preViewImg').attr('src', '{{asset($cliente->logo)}}' );
      }
      else{
        $('#preViewImg').addClass('hidden');
      }
    });

    if($('#logo_text').val() == ""){
      $('#preViewImg').addClass('hidden');
      }
      

$(document).on('change','#file',function(){
  console.log("hola");
    readURL(this);
});
});
</script>
@endsection
