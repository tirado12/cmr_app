@extends('layouts.plantilla')
@section('title','Editar Usuario')
@section('contenido')

<div class="flex flex-row mb-4">
<svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
</svg>
<h1 class="font-bold text-xl ml-2">Editar Usuario</h1>
</div>

<div class="alert flex flex-row items-center bg-blue-200 p-2 rounded-lg border-b-2 border-blue-300 mb-4 shadow">
  <div class="alert-icon flex items-center bg-blue-100 border-2 border-blue-500 justify-center h-10 w-10 flex-shrink-0 rounded-full">
    <span class="text-blue-500">
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
    <div class="alert-title font-semibold text-lg text-blue-800">
      Recuerda
    </div>
    <div class="alert-description text-sm text-blue-600">
      <strong>NO</strong> compartir sus datos de acceso, previene la filtración de datos sensibles.
    </div>
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

<div class="mt-10 sm:mt-0 shadow-2xl bg-white rounded-lg">
      
      <div class="mt-5 md:mt-0 md:col-span-2">
        <form action="{{ route('admin.users.update', $user) }}" method="POST" id="formulario" name="formulario">
          @csrf
          @method('PUT')
          <div class="shadow overflow-hidden sm:rounded-md">
            <div class="px-4 py-5 bg-white sm:p-6"> 
              <div class="grid grid-cols-6 gap-6">
                <div class="col-span-6 sm:col-span-3">
                  <label for="first_name" class="block text-sm font-medium text-gray-700">Nombre *</label>
                  <input type="text" name="name" id="name" autocomplete="given-name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ $user->name }}">
                  <label id="error_name" name="error_name" class="hidden text-base font-normal text-red-500" >Porfavor ingrese su nombre</label>
                </div>

                <div class="col-span-6 sm:col-span-3">
                  <label for="lasname" class="block text-sm font-medium text-gray-700">Apellidos *</label>
                  <input type="text" name="lastname" id="lastname" autocomplete="apellido" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ $user->lastname }}">
                  <label id="error_lastname" name="error_lastname" class="hidden text-base font-normal text-red-500" >Porfavor ingrese sus apellidos</label>
                </div>
  
                <div class="col-span-6 sm:col-span-3">
                  <label for="email_address" class="block text-sm font-medium text-gray-700">Correo *</label>
                  <input type="text" name="email" id="email" autocomplete="email" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ $user->email }}">
                  <label id="error_email" name="error_email" class="hidden text-base font-normal text-red-500" >Porfavor ingrese un correo</label>
                </div>

                <div class="col-span-6 sm:col-span-3">
                  <label for="area" class="block text-sm font-medium text-gray-700">Area *</label>
                  <select id="area" name="area"  class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">                
                    <option value="Infraestructura" {{($user->area == 'Infraestructura') ? 'selected' : ''}}> Infraestructura </option>
                    <option value="Gubernamental" {{($user->area == 'Gubernamental') ? 'selected' : ''}}> Gubernamental </option>
                    <option value="Dirección General" {{($user->area == 'Dirección General') ? 'selected' : ''}}> Dirección General </option>
                  </select>
                  <label id="error_area" name="error_area" class="hidden text-base font-normal text-red-500" >Porfavor elija un rol</label>
                </div>
                
                  
                <div class="col-span-6 sm:col-span-3">
                  <label for="country" class="block text-sm font-medium text-gray-700">Lista de roles *</label>
                  <select id="roles" name="roles" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                     
                    @foreach($roles as $rol)
                      <option value="{{ $rol->id }}" {{($user->getRoleNames()[0] == $rol->name) ? 'selected' : ''}}> {{ $rol->name }}</option>
                    @endforeach
                  </select>
                  <label id="error_roles" name="error_roles" class="hidden text-base font-normal text-red-500" >Porfavor elija un rol</label>
                </div>
                
                <div class="col-span-6 sm:col-span-3">
                  <label for="password" class="block text-sm font-medium text-gray-700">Contraseña </label>
                  <input type="password" name="password" id="password" autocomplete="password" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                  <label class="text-base font-bold text-gray-500"><input type="checkbox" onclick="myPassword()" class="focus:ring-blue-800 focus:border-blue-800 shadow-sm sm:text-sm border-gray-300 rounded"> Ver contraseña </label>                  
                </div>
                
              </div>
            </div>
            <div class="px-4 py-3 bg-gray-100 sm:px-6">
              <span class="block text-xs">Porfavor verifique que todos los campos marcados con ( * ) esten rellenados</span>
              <div class="text-right">
                <a type="button" href="{{route('admin.users.index')}}" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-gray-500 hover:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                  Regresar
                </a>
              <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-orange-800 hover:bg-orange-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Guardar
              </button>
              
              </div>
            </div>
          </div>
        </form>
      </div>
    
  </div>
  
  <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>  
  <script type="text/javascript" charset="utf8" src="{{ asset('js/validacion.js') }}"></script>

  <script>
  
  //validacion del formulario con el btn guardar
  $().ready(function() {
    $("#formulario").validate({
      onfocusout: false,
      onclick: false,
      rules: {
        name: { required: true },
        email: { required: true, email: true},
        roles: { required: true},
        
        
      },
      errorPlacement: function(error, element) {
        if(error != null){
        $('#error_'+element.attr('id')).fadeIn();
        }else{
        $('#error_'+element.attr('id')).fadeOut();
        }
       // console.log(element.attr('id'));
      },
    }); 
    
  });

  </script>
@endsection