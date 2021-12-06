@extends('layouts.plantilla')
@section('title','Perfil')
@section('contenido')

<div class="mt-4 shadow-2xl bg-white rounded-lg p-8 ">
    <div class="flex md:h-80 sm:h-120 rounded-lg ">
        <div class="flex items-center justify-center w-full">
            <div class="grid grid-cols-3 sm:grid-cols-1 md:grid-cols-3 lg:w-full">
            
                <div class="grid justify-items-center rounded-md  bg-gray-100">
                    <img src="{{ $user->img }}" id="img_profile" class="block h-40 rounded-full mt-8 border-2 border-blue-900 shadow-2xl" alt="">
                    <div class="grid grid-cols-1 justify-items-center">11                        
                        
                          {{-- <div class="custom-input-file text-blue-500">
                            <input type="file" id="file" name="file" class="input-file" accept="image/png, image/jpeg" value="" hidden>
                            Examinar archivos
                          </div> --}}
                          
                          <input type="text" name="logo_text" id="logo_text" autocomplete="email" class="hidden focus:ring-blue-800 focus:border-blue-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="">
                          
                          <div class="image-upload lg:-mt-12 sm:-mt-6 md:-mt-12">
                            <label for="imgInp">
                              <div class="border rounded-full bg-yellow-600 ">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                              </div>
                            </label>
                            <input id="imgInp" name="imgInp" type="file" style="display: none;"/>
                          </div>
                        
                    </div>
                    <div class="grid grid-cols-1 justify-items-center -mt-6">
                        <label for="">Nombre:</label>
                        <label for="" class="-mt-4 text-lg font-semibold">{{ $user->name }}</label>
                        <label for="">Area:</label>
                        <label for="" class="-mt-4 text-lg font-semibold">{{$user->area}}</label>
                    </div>
                </div>

                <div class="col-span-2 rounded-md">
                  <div class="ml-6">
                    <label for="" class="font-bold">Editar Datos:</label>
                  </div>
                    <div class="grid grid-cols-2 gap-6 p-6 w-full ">
                        <div class="w-full">
                            <label for="" class="block">Nombre</label>
                            <input type="text" class="bg-gray-100 border-gray-200 hover:border-blue-800 focus:border-blue-800 rounded w-full" value="{{$user->name}}">
                        </div>
                        <div>
                            <label for="" class="block">Email</label>
                            <input type="text" class="bg-gray-100 hover:bg-white border-gray-200 hover:border-blue-800 focus:border-blue-800 rounded w-full" value="{{$user->email}}">
                        </div>
                        <div>
                            <label for="" class="block">Area</label>
                            <input type="text" class="bg-gray-100 border-gray-200 hover:border-blue-800 focus:border-blue-800 rounded w-full" value="{{$user->area}}">
                        </div>
                        <div>
                            <label for="" class="block">Contraseña</label>
                            <input type="password" id="password" class="bg-gray-100 border-gray-200 hover:border-blue-800 focus:border-blue-800 rounded w-full">
                            <label class="text-base font-bold text-gray-500"><input type="checkbox" onclick="myPassword()" class="focus:ring-blue-800 focus:border-blue-800 shadow-sm sm:text-sm border-gray-300 rounded"> Ver contraseña </label>
                        </div>
                    </div>
                    
                    <div class="text-right mt-6 p-4">
                        <button class="text-red-500 background-transparent font-bold uppercase px-6 py-2 text-sm outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="button" onclick="">
                          Cancelar
                        </button>
                        <button type="submit" id="guardar" class="bg-green-500 text-white active:bg-green-600 font-bold uppercase text-sm px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" >
                          Guardar
                        </button>
                      </div>
                </div>

            </div>
        </div>
        
    </div>

</div>

<script>
  function myPassword() {
    var x = document.getElementById("password");
    if (x.type === "password") {
      x.type = "text";
    } else {
      x.type = "password";
    }
  }

  imgInp.onchange = evt => {
    const elemento = document.getElementById("imgInp");
  const [file] = imgInp.files
  if (file) {
    console.log(elemento)
    img_profile.src = URL.createObjectURL(file)
  }
}
</script>
@endsection