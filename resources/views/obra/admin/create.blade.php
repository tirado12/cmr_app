@extends('layouts.plantilla')
@section('title','Nueva obra')
@section('contenido')
<div class="flex flex-row">
    <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
    </svg>
    <h1 class="text-xl font-bold ml-2">Crear nueva obra</h1>
</div>

<div class="mt-6 contenedor p-8 shadow-2xl bg-white rounded-lg">
    <div class="text-white px-6 py-4 border-0 rounded relative mb-4 bg-blue-900">
      <span class="text-xl inline-block mr-5 align-middle">
        <i class="fas fa-bell"></i>
      </span>
      <span class="inline-block align-middle mr-8">
        <b class="capitalize">Nota:</b> <br> Debe agregar un cliente por periodo antes 
        <a href="{{route('clientes.index')}}" class="ml-2 rounded bg-orange-800 shadow-md text-white text-sm font-semibold p-1" target="_blank">Agregar nuevo cliente</a>
         asi como al menos un cliente con fondo III disponible
      </span>
      <button class="absolute bg-transparent text-2xl font-semibold leading-none right-0 top-0 mt-4 mr-6 outline-none focus:outline-none" onclick="closeAlert(event)">
        <span>×</span>
      </button>
    </div>

  <div class="relative p-6 flex-auto">
      <div class="alert flex flex-row items-center justify-center bg-gray-100 p-2 mb-4 shadow">
          <div class="alert-content ml-4">
            <p class="font-bold sm:text-sm">Nueva Obra</p>
          </div>
        </div>
  </div>
  <form id="formulario" name="formulario" action="" method="POST" onsubmit="return validar();">
    @csrf
    @method('POST')

  <div class="grid grid-cols-8 gap-4">

    <div class="col-span-4">
        <label id="label_num_obra" for="num_obra" class="block text-sm font-medium text-gray-700">Numero de obra*</label>
        <input type="text" name="num_obra" id="num_obra" class="mt-1 focus:ring-gray-500 focus:border-gray-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" placeholder="Num. de obra" >
    </div>

    <div class="col-span-4">
        <label id="label_nombre_obra" for="nombre_obra" class="block text-sm font-medium text-gray-700">Nombre de obra*</label>
        <input type="text" name="nombre_obra" id="nombre_obra" class="mt-1 focus:ring-gray-500 focus:border-gray-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" placeholder="Num. de obra" >
    </div>

    <div class="col-span-4">
        <label id="label_nombre_corto_obra" for="nombre_corto_obra" class="block text-sm font-medium text-gray-700">Nombre corto de obra*</label>
        <input type="text" name="nombre_corto_obra" id="nombre_corto_obra" class="mt-1 focus:ring-gray-500 focus:border-gray-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" placeholder="Num. de obra" >
    </div>

    <div class="col-span-4">
        <label id="label_nombre_archivo" for="nombre_archivo" class="block text-sm font-medium text-gray-700">Nombre de archivo*</label>
        <input type="text" name="nombre_archivo" id="nombre_archivo" class="mt-1 focus:ring-gray-500 focus:border-gray-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" placeholder="Num. de obra" >
    </div>

    <div class="col-span-4">
        <label id="label_numero_contrato" for="numero_contrato" class="block text-sm font-medium text-gray-700">Numero de contrato*</label>
        <input type="text" name="numero_contrato" id="numero_contrato" class="mt-1 focus:ring-gray-500 focus:border-gray-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" placeholder="Num. de obra" >
    </div>

    <div class="col-span-4">
        <label id="label_oficio_notificacion" for="oficion_notificacion" class="block text-sm font-medium text-gray-700">Oficio notificación*</label>
        <input type="text" name="oficion_notificacion" id="oficion_notificacion" class="mt-1 focus:ring-gray-500 focus:border-gray-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" placeholder="Num. de obra" >
    </div>

    <div class="col-span-4">
        <label id="label_monto_contratado" for="monto_contratado" class="block text-sm font-medium text-gray-700">Monto Contratado*</label>
        <div class="relative ">
          <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
            <span class="text-gray-500 sm:text-sm">
              $
            </span>
          </div>
          <input type="text" name="monto_contratado" id="monto_contratado" class="pl-7 mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" placeholder="0.00" readonly>
        </div>
    </div>

    <div class="col-span-4">
        <label id="label_monto_modificado" for="monto_modificado" class="block text-sm font-medium text-gray-700">Monto Modificado*</label>
        <div class="relative ">
          <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
            <span class="text-gray-500 sm:text-sm">
              $
            </span>
          </div>
          <input type="text" name="monto_modificado" id="monto_modificado" class="pl-7 mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" placeholder="0.00" readonly>
        </div>
    </div>

    <div class="col-span-4 ">
      <label  id="label_cliente_id" for="cliente_id" class="block text-sm font-medium text-gray-700">Cliente *</label>
      <select id="cliente_id" name="cliente_id"  class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">                
          <option value=""> Elija una opción </option>
          
      </select>
      <label id="error_cliente_id" name="error_cliente_id" class="hidden text-base font-normal text-red-500" >Seleccione una opción</label>
    </div>

    <div class="col-span-4">
      <label id="label_ejercicio" for="label_ejercicio" class="block text-sm font-medium text-gray-700">Ejercicio *</label>
        <select id="ejercicio" name="ejercicio" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">                
          <option value=""> Elija un cliente </option>
        </select>
      <label id="error_ejercicio" name="error_ejercicio" class="hidden text-base font-normal text-red-500" >Por favor ingresar un año de ejercicio</label>  
    </div>

    <div class="col-span-4 ">
      <label id="label_gasto_indirecto" for="gasto_indirecto" class="block text-sm font-medium text-gray-700">Gasto indirecto *</label>
        <select id="gasto_indirecto" name="gasto_indirecto" onchange="validarSelect()" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">                
          <option value=""> Elija una opción </option>
          
        </select>
      <label id="error_gasto_indirecto" name="error_gasto_indirecto" class="hidden text-base font-normal text-red-500" >Por favor ingresar un gasto indirecto al registro</label>  
    </div>

   

   

    <div class="col-span-4">
      <label id="label_monto" for="monto" class="block text-sm font-medium text-gray-700">Monto*</label>
      <div class="relative ">
        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
          <span class="text-gray-500 sm:text-sm">
            $
          </span>
        </div>
        <input type="text" name="monto" id="monto" class="pl-7 mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" placeholder="0.00" >
      </div>
      <label id="error_monto" name="error_monto" class="hidden text-base font-normal text-red-500" >Por favor ingresar un monto</label>  
      <label id="error_monto_disponible" class="hidden block text-md text-red-500">La cantidad ingresada supera el monto disponible</label>
      <input id="fuenteCliente_id" name="fuenteCliente_id" type="text" hidden>
    </div>

    
  
</div>

<label id="error_existe" name="error_existe" class="hidden text-base font-normal text-red-500" >Ya existe un registro con este cliente, ejercicio y gasto indirecto asignado.</label>
<label id="error_monto_ceros" class="hidden block text-md text-red-500">No queda monto disponible para comprometer</label>  
<div class="px-4 py-3 bg-gray-50 text-right sm:px-6 mt-4">
  <a type="button" href="{{redirect()->getUrlGenerator()->previous()}}" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-gray-500 hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
    Regresar
  </a>
  <button type="submit" id="guardar" name="guardar" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-orange-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-800">
    Guardar
  </button>
</div>
</form>
</div>

@endsection