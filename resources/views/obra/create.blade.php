@extends('layouts.plantilla')
@section('title','Editar ')
@section('contenido')
<link rel="stylesheet" href="{{ asset('css/style_alert.css') }}">

<div class="flex flex-row mb-4">
    <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
    </svg>
    <h1 class="font-bold text-xl ml-2">Crear obra</h1>
</div>

<div class="mt-10 sm:mt-0 shadow-2xl bg-white rounded-lg">
    <div class="mt-6 contenedor p-8 shadow-2xl bg-white rounded-lg">
        <h2 class="font-bold text-xl text-center">Agregar nueva obra</h2>
        <hr>
        <form action="{{ route('obra.store') }}" method="POST" accept-charset="UTF-8" enctype="multipart/form-data" id="form-ajax">
            @csrf
            @method('POST')
            <div class="relative p-6 flex-auto">
                <div class="grid grid-cols-9 gap-4">
                    <div class="col-span-9 ">
                        <label id="nombre_obra" for="first_name" class="block text-base font-bold text-gray-700">Nombre largo de la obra *</label>
                        <input type="text" name="nombre_obra" id="nombre_obra" autocomplete="nombre_obra" class="mt-1 focus:ring-blue-800 focus:border-blue-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required value="{{ old('nombre_obra') }}">
                    </div>
                    <div class="col-span-7">
                        <label id="nombre_corto" for="email_address" class="block text-base font-bold text-gray-700">Nombre corto de la obra*</label>
                        <input type="text" name="nombre_corto" id="nombre_corto" autocomplete="nombre_corto" class="mt-1 focus:ring-blue-800 focus:border-blue-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ old('nombre_corto') }}">
                    </div>
                    <div class="col-span-2 ">
                        <label id="numero_obra" for="first_name" class="block text-base font-bold text-gray-700">Número de obra *</label>
                        <input type="text" name="numero_obra" id="numero_obra" autocomplete="numero_obra" class="mt-1 focus:ring-blue-800 focus:border-blue-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required value="{{ old('nombre_obra') }}">
                    </div>
                    <div class="col-span-3">
                        <label for="oficio_notificacion" class="block text-base font-bold text-gray-700">Número de oficio de notificación *</label>
                        <input type="text" name="oficio_notificacion" id="oficio_notificacion" class="mt-1 focus:ring-blue-800 focus:border-blue-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ old('oficio_notificacion') }}">
                    </div>
                    <div class="col-span-3">
                        <label for="fecha_oficio_notificacion" class="block text-base font-bold text-gray-700">Fecha oficio de notificación *</label>
                        <input type="date" name="fecha_oficio_notificacion" id="fecha_oficio_notificacion" class="mt-1 focus:ring-blue-800 focus:border-blue-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ old('fecha_oficio_notificacion') }}">
                    </div>
                    <div class="col-span-3">
                        <label for="monto_contratado" class="block text-base font-bold text-gray-700">Monto de la obra *</label>
                        <input type="text" name="monto_contratado" id="monto_contratado" class="mt-1 focus:ring-blue-800 focus:border-blue-800 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ old('fecha_oficio_notificacion') }}">
                    </div>

                    <div class="col-span-">
                        <label for="country" class="block text-base font-bold text-gray-700">Municipio *</label>
                        <select id="municipio_id" name="municipio_id" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-800 focus:border-blue-800 sm:text-sm">
                            @foreach($municipios as $municipio)
                            <option value="{{ $municipio->id_municipio}}" {{ ($municipio->id_municipio == old('municipio_id')) ? 'selected' : '' }}>{{ $municipio->nombre }}</option>
                            @endforeach
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
                            <img id="preViewImg" src="" alt="your image" class="hidden h-32" />
                        </div>

                    </div>
                </div>
                <div class="flex flex-wrap">
                    <div class="w-full text-center"> <button class="bg-pink-500 text-white active:bg-white font-bold uppercase text-sm px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="button" onclick="openPopover(event,'popover-id')">
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
<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script>
    $(document).ready(function() {
        const formato = new Intl.NumberFormat('es-MX', {
            maximumFractionDigits: 2
        });
        $("#monto_contratado").on({
            "focus": function(event) {
                $(event.target).select();
            },
            "keyup": function(event) {
                $(event.target).val(function(index, value) {
                    return value.replace(/\D/g, "")
                        .replace(/([0-9])([0-9]{2})$/, '$1.$2')
                        .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ",");
                });
            }
        });

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
            readURL(this);
        });
    });
</script>
@endsection