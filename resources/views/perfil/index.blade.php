@extends('layouts.plantilla')
@section('title','Perfil')
@section('contenido')

           
   


<div class="mt-4 shadow-2xl bg-white rounded-lg p-4 ">
    <div class="flex   md:h-80 sm:h-120 rounded-lg ">
        <div class="flex items-center justify-center">
            <div class="grid grid-cols-2 sm:grid-cols-1 md:grid-cols-2">

                <div class="grid grid-cols-1 justify-items-center">
                    <img src="https://pbs.twimg.com/profile_images/1254779846615420930/7I4kP65u_400x400.jpg" class="block w-40 h-40 rounded-full mt-4 border-2 border-blue-900 shadow-2xl" alt="">
                    <div class="grid grid-cols-2">
                        <button class="mt-1 p-1 rounded text-blue-700">Editar</button>
                        <button class="mt-1 p-1 rounded text-red-700">Eliminar</button>
                    </div>
                    <label for="" class="block text-lg font-semibold">Roberto Lopez Sosa</label>
                    <label for="" class="text-lg ">Impuestos</label>
                </div>

                <div>
                    <div class="grid grid-cols-2 gap-6 p-4 w-full ">
                        <div>
                            <label for="" class="block">Nombre</label>
                            <input type="text" class="border-blue-800 rounded w-full">
                        </div>
                        <div>
                            <label for="" class="block">Email</label>
                            <input type="text" class="border-blue-800 rounded w-full">
                        </div>
                        <div>
                            <label for="" class="block">Area</label>
                            <input type="text" class="border-blue-800 rounded w-full">
                        </div>
                        <div>
                            <label for="" class="block">Contraseña</label>
                            <input type="text" class="border-blue-800 rounded w-full">
                        </div>
                    </div>
                    <div class="text-right mt-6">
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
@endsection