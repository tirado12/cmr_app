@extends('layouts.plantilla')
@section('title','Editar Anexos')
@section('contenido')
<div class="flex flex-row mb-4">
    <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
    </svg>
    <h1 class="font-bold text-xl ml-2">Editar Anexos Fondo III</h1>
</div>

<div class="mt-10 sm:mt-0 shadow-2xl bg-white rounded-lg">
      
    <div class="mt-5 md:mt-0 md:col-span-2">
      <form action="{{ route('anexos.update', $anexos) }}" method="POST" id="formulario" name="formulario">
        @csrf
        @method('PUT')
        <div class="shadow overflow-hidden sm:rounded-md">
          <div class="px-4 py-5 bg-white sm:p-6">
            <div class="grid grid-cols-6 gap-6">
              <div class="col-span-6 sm:col-span-3">
                <label id="label_municipio" for="municipio" class="block text-sm font-medium text-gray-700">Municipio *</label>
                <input type="text" name="municipio" id="municipio"  class="mt-1 focus:ring-indigo-500 block bg-gray-100 w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ $anexos->nombre }}" disabled>
                
              </div>

              <div class="col-span-6 sm:col-span-3">
                <label id="label_rfc" for="tipo_rfc" class="block text-sm font-medium text-gray-700">Ejercicio:</label>
                <input type="text" id="tipo_rfc" name="tipo_rfc" class="mt-1 w-full block bg-gray-100 shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ $anexos->ejercicio }}" disabled>
                
              </div>
              
              <div class="col-span-6 sm:col-span-3">
                <label id="label_acta_integracion_consejo" for="acta_integracion_consejo" class="block text-sm font-medium text-gray-700">Acta de integración *</label>
                <input type="date" name="acta_integracion_consejo" id="acta_integracion_consejo" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ $anexos->acta_integracion_consejo }}" >
                
              </div>

              <div class="col-span-6 sm:col-span-3">
                  <label id="label_acta_priorizacion" for="acta_priorizacion" class="block text-sm font-medium text-gray-700">Acta de priorización *</label>
                  <input type="date" name="acta_priorizacion" id="acta_priorizacion" placeholder="Nombre" maxlength="40" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ $anexos->acta_priorizacion }}">
                  
              </div>
              <div class="col-span-6 sm:col-span-3">
                  <label id="label_adendum_priorizacion" for="adendum_priorizacion" class="block text-sm font-medium text-gray-700">Adendum *</label>
                  <input type="date" name="adendum_priorizacion" id="adendum_priorizacion" placeholder="Conocido S/N" maxlength="70" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ $anexos->adendum_priorizacion }}">
                  
              </div>

              <div class="col-span-6 sm:col-span-3 flex justify-center gap-12">
                <label class="inline-flex items-center mt-3">
                    <input type="checkbox" id="prodim" name="prodim" class="ml-2 shadow-sm sm:text-sm border-gray-300 rounded h-6 w-6" {{ ($anexos->prodim==1) ? 'checked' : '' }}><span class="ml-2 text-gray-700">Prodim</span>
                </label>
                <label class="inline-flex items-center mt-3">
                    <input type="checkbox" id="gastos_indirectos" name="gastos_indirectos" class="ml-2 shadow-sm sm:text-sm border-gray-300 rounded h-6 w-6" {{ ($anexos->gastos_indirectos==1) ? 'checked' : '' }}><span class="ml-2 text-gray-700">Gastos indirectos</span>
                </label>
              </div>

              
            </div>
          </div>
          
          <div class="px-4 py-3 bg-gray-100 sm:px-6">
            <span class="block text-xs">Porfavor verifique que todos los campos marcados con ( * ) esten rellenados</span>
            <div class="text-right">
              <a type="button" href="{{redirect()->getUrlGenerator()->previous()}}" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-gray-500 hover:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
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

@endsection