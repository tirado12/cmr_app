@extends('layouts.plantilla')
@section('title', 'Editar ')
@section('contenido')
    <link rel="stylesheet" href="{{ asset('css/style_alert.css') }}">

    <div class="flex flex-row mb-4">
        <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
        </svg>
        <h1 class="font-bold text-xl ml-2">Editar cliente</h1>
    </div>


    @if ($errors->any())
        <div class="alert flex flex-row items-center bg-yellow-200 p-2 rounded-lg border-b-2 border-yellow-300 mb-4 shadow">
            <div
                class="alert-icon flex items-center bg-yellow-100 border-2 border-yellow-500 justify-center h-10 w-10 flex-shrink-0 rounded-full">
                <span class="text-yellow-500">
                    <svg fill="currentColor" viewBox="0 0 20 20" class="h-5 w-5">
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
            <form action="{{ route('clientes.update', $cliente) }}" method="POST" accept-charset="UTF-8"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="shadow overflow-hidden sm:rounded-md">

                    <div class="px-4 py-5 bg-white sm:p-6 flex-auto">
                        <div class="grid grid-cols-8">
                            <div class="col-span-4 mx-4">
                                <label for="first_name" class="text-base font-bold text-gray-700">Nombre de usuario:
                                </label>
                                <input type="text" name="user" id="user" autocomplete="given-name"
                                    class=" mt-1 focus:ring-blue-800 focus:border-blue-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                    value="{{ $cliente->user }}">
                            </div>
                            <div class="col-span-4 mx-4">
                                <label for="email_address" class=" text-base font-bold text-gray-700">E-mail: </label>
                                <input type="text" name="email" id="email" autocomplete="email"
                                    class="mt-1 focus:ring-blue-800 focus:border-blue-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                    value="{{ $cliente->email }}">
                            </div>
                            <div class="col-span-4 mt-7 mx-4">
                                <label for="email_address" class=" text-base font-bold text-gray-700">Contraseña: </label>
                                <input type="text" name="password" id="password" autocomplete="email"
                                    class="mt-1 focus:ring-blue-800 focus:border-blue-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                    value="">
                            </div>
                            <div class="col-span-4 mt-7 mx-4">
                                <label for="municipio_address" class="text-base font-bold text-gray-700">Municipio: </label>
                                <select id="municipio_id" name="municipio_id"
                                    class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-800 focus:border-blue-800 sm:text-sm">
                                    @foreach ($municipios as $municipio)
                                        <option value="{{ $municipio->id_municipio }}"
                                            {{ $municipio->id_municipio == $cliente->municipio_id ? 'selected' : '' }}>
                                            {{ $municipio->nombre }}</option>

                                    @endforeach
                                </select>


                            </div>

                            <div class="col-span-4 mt-7 mx-4">
                                <label for="email_address" class=" text-base font-bold text-gray-700">Logo: </label>

                                <div class="col-span-4">
                                    <div class="custom-input-file text-blue-500">
                                        <input type="file" id="file" name="file" class="input-file"
                                            accept="image/png, image/jpeg" value="">
                                        Examinar archivos
                                    </div>
                                    <input type="text" name="logo_text" id="logo_text" autocomplete="email"
                                        class="hidden focus:ring-blue-800 focus:border-blue-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                        value="{{ $cliente->logo }}">
                                    <img id="preViewImg" src="{{ $cliente->logo }}" alt="your image"
                                        class="h-32" />
                                </div>

                            </div>
                            <div class="col-span-4 mt-7 mx-4">
                                <label for="periodo_address" class=" text-base font-bold text-gray-700">Periodo: * </label>
                                <div class="grid grid-cols-8">
                                    <div class="col-span-4 mr-3">
                                        <label for="periodo_address" class=" text-xs font-medium text-gray-700">Año inicial:
                                        </label>
                                        <input type="number" min="2015" max="2030" name="anio_inicio" id="anio_inicio"
                                            autocomplete="direccion"
                                            class=" focus:ring-blue-800 focus:border-blue-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                            value="{{ $cliente->anio_inicio }}">
                                    </div>
                                    <div class=" col-span-4 ml-3">
                                        <label for="periodo_address" class=" text-xs font-medium text-gray-700">Año final:
                                        </label>
                                        <input type="number" min="2015" max="2030" name="anio_fin" id="anio_fin"
                                            autocomplete="direccion"
                                            class="focus:ring-blue-800 focus:border-blue-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                            value="{{ $cliente->anio_fin }}">
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
                <button type="submit"
                    class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-orange-800 hover:bg-orange-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
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
        $(document).ready(function() {

            var anio = (new Date).getFullYear();
            $('#anio_inicio').attr("min", anio - 2);
            $('#anio_inicio').attr("max", anio + 1);
            $('#anio_fin').attr("min", anio);
            $('#anio_fin').attr("max", anio + 3);

            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#preViewImg').attr('src', e.target.result);
                        $('#preViewImg').removeClass('hidden');
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }

            $("#file").click(function() {
                if ($('#logo_text').val() != "") {
                    $('#preViewImg').attr('src', $("#logo_text").val());
                } else {
                    $('#preViewImg').addClass('hidden');
                }
            });

            if ($('#logo_text').val() == "") {
                $('#preViewImg').addClass('hidden');
            }


            $(document).on('change', '#file', function() {
                console.log("hola");
                readURL(this);
            });
        });
    </script>
@endsection
