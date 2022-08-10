@extends('layouts.plantilla')
@section('title','Perfil')
@section('contenido')

<div class="mt-4  shadow-2xl bg-white rounded-lg flex h-auto">
  <form action="{{ route('perfil.update',$user->id) }}" method="POST" accept-charset="UTF-8" enctype="multipart/form-data" class="flex w-full h-auto" id="formulario" name="formulario" onsubmit="return validar();">
    @csrf
    @method('PUT')
      <div class="py-8 flex-initial w-2/5 h-auto bg-gradient-to-r from-blue-900 via-blue-900 to-blue-800 rounded-l-lg flex justify-center">
          <div class="relative ">
            <div class="group">
                <div class="flex justify-center" id="imagen">
                  <div class=" rounded-full border-2 border-yellow-600 ">
                    <img src="{{ asset($user->img) }}" id="img_profile" class=" h-40 w-40 rounded-full transform transition duration-500 group-hover:scale-125" alt="">
                  </div>
                </div>
                <div class="w-full ">
                  <div class="image-upload w-full absolute flex bottom-1/8 justify-center" id="btn_editar_imagen">
                    <label for="img">
                      <div class="border-transparent rounded-full w-min p-2 cursor-pointer bg-transparent transition duration-500 group-hover:bg-yellow-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class=" h-4 w-4 text-transparent  transition duration-500 group-hover:text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                        </svg>
                      </div>
                    </label>
                    <input id="img" name="img" accept="image/png, image/jpeg" type="file" style="display: none;"/>
                  </div>
                </div>
              </div>
            <div class="mt-10 flex justify-center">
              <h3 class="text-lg font-bold text-white">{{$user->name}}</h3>
            </div>
            <div class="flex justify-center">
              <h3 class="text-lg font-bold text-white">{{$user->lastname}}</h3>
            </div>
            <div class="mt-2 flex justify-center">
              <h3 class="text-md  text-white">{{$user->area}}</h3>
            </div>
            <div class=" flex justify-center">
              <h3 class="text-md  text-white">{{$user->email}}</h3>
            </div>
            <div class="mt-8 flex justify-center ">
              <div class="border border-transparent transition duration-500 hover:border-white rounded">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white hover:shadow" id="editar" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
              </div>
            </div>
          </div>
        </div>
    <div class="flex-initial w-full wy-8 ">
      <div class="p-4">
        <div class="border-b-2 ">
          <h1 class="text-xl font-bold ">Información General</h1>
        </div>
        <div class="flex mt-8 space-x-4">
          <div class="flex-initial w-1/2">
            <h1 class="font-bold">Nombre *</h1>
            <input id="name" name="name" type="text" class="bg-gray-100 border-gray-300 hover:border-blue-900 focus:border-blue-800 rounded w-full" value="{{$user->name}}" readonly>
            <label id="error_name" name="error_name" class="hidden text-base font-normal text-red-500" >Ingrese su nombre</label>
          </div>
          <div class="flex-initial w-1/2">
            <h1 class="font-bold">Apellidos *</h1>
            <input id="lastname" name="lastname" type="text" class="bg-gray-100 border-gray-300 hover:border-blue-900 focus:border-blue-800 rounded w-full" value="{{$user->lastname}}" readonly>
            <label id="error_lastname" name="error_lastname" class="hidden text-base font-normal text-red-500" >Ingrese sus apellidos</label>
          </div>
          <div class="flex-initial w-1/2">
            <h1 class="font-bold">E-mail *</h1>
            <input id="email" name="email" type="text" class="bg-gray-100 border-gray-300 hover:border-blue-900 focus:border-blue-800 rounded w-full" value="{{$user->email}}" readonly>
            <label id="error_email" name="error_email" class="hidden text-base font-normal text-red-500" >Ingrese su correo electronico</label>
          </div>
        </div>
        <div class="flex mt-4 space-x-4">
          <div class="flex-initial w-1/2">
            <h1 class="font-bold">Area *</h1>
            <select id="area" name="area"  class="mt-1 block w-full bg-gray-100 py-2 px-3 border border-gray-300 hover:border-blue-900 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" disabled>                
              <option value="Infraestructura" {{($user->area == 'Infraestructura') ? 'selected' : ''}}> Infraestructura </option>
              <option value="Gubernamental" {{($user->area == 'Gubernamental') ? 'selected' : ''}}> Gubernamental </option>
              <option value="Dirección General" {{($user->area == 'Dirección General') ? 'selected' : ''}}> Dirección General </option>
            </select>
            <label id="error_area" name="error_area" class="hidden text-base font-normal text-red-500" >Seleccione una area</label>
          </div>
          <div class="flex-initial w-1/2">
            <h1 class="font-bold">Contraseña</h1>
            <input type="password" id="password" name="password" class="bg-gray-100 border-gray-300 hover:border-blue-900 focus:border-blue-800 rounded w-full" readonly>
            <label class="text-base font-bold text-gray-500"><input type="checkbox" onclick="myPassword()" class="focus:ring-blue-800 focus:border-blue-800 shadow-sm sm:text-sm border-gray-300 rounded"> Ver contraseña </label>
          </div>
        </div>
      </div>
    
      <div class="text-right p-4 mt-20">
        <a type="button" href="{{redirect()->getUrlGenerator()->previous()}}" class="inline-flex justify-center py-3 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-gray-500 hover:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
          Regresar
        </a>
        <button type="submit" id="guardar" class="bg-green-500 text-white active:bg-green-600 font-bold uppercase text-sm px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" >
          Guardar
        </button>
      </div>
    </div>
  </form>
</div>
<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script>
  $(document).ready(function() {
    $('#editar').on('click',function(){
        $('#name').attr('readonly', false);
        $('#name').removeClass('bg-gray-100');
        $('#lastname').attr('readonly', false);
        $('#lastname').removeClass('bg-gray-100');
        $('#email').attr('readonly', false);
        $('#email').removeClass('bg-gray-100');
        $('#area').attr('disabled', false);
        $('#area').removeClass('bg-gray-100');
        $('#password').attr('readonly', false);
        $('#password').removeClass('bg-gray-100');
    });  
  });

function validar(){
  band = true;
 
    let arreglo = document.querySelectorAll('form input');
    arreglo.forEach(function(e){
      if(e.hasAttribute('readonly')){
        band = false;
      }
    });

    name= document.forms["formulario"]["name"].value;
    if(name == ""){
       $('#error_name').removeClass('hidden');  
       band= false;
    }else{
      $('#error_name').addClass('hidden'); 
    }
    lastname= document.forms["formulario"]["lastname"].value;
    if(lastname == ""){
       $('#error_lastname').removeClass('hidden');  
       band= false;
    }else{
      $('#error_lastname').addClass('hidden'); 
    }
    email= document.forms["formulario"]["email"].value;
    if(email == ""){
       $('#error_email').removeClass('hidden');  
       band= false;
    }else{
      $('#error_email').addClass('hidden'); 
    }
    area= document.forms["formulario"]["area"].value;
    if(area == ""){
       $('#error_area').removeClass('hidden');  
       band= false;
    }else{
      $('#error_area').addClass('hidden'); 
    }
    
    return band;
}

  function myPassword() {
    var x = document.getElementById("password");
    if (x.type === "password") {
      x.type = "text";
    } else {
      x.type = "password";
    }
  }

  img.onchange = evt => {
    const elemento = document.getElementById("img");
  const [file] = img.files
  if (file) {
    console.log(elemento)
    img_profile.src = URL.createObjectURL(file)
  }
}
</script>
@endsection