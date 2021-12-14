@extends('layouts.plantilla')
@section('title','Editar Prodim')
@section('contenido')
<div class="flex flex-row mb-4">
    <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
    </svg>
    <h1 class="font-bold text-xl ml-2">Editar PRODIMDF</h1>
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
      <form action="{{ route('prodim.update', $prodim) }}" accept-charset="UTF-8" enctype="multipart/form-data" onsubmit="return validar()" method="POST" id="formulario" name="formulario">
        @csrf
        @method('PUT')
        <div class="shadow overflow-hidden sm:rounded-md">
          @foreach($listaProdim as $prodim)
          <div class=" p-6 flex-auto" id="anexos">
            <div class="grid grid-cols-6 gap-4 mb-2">
                <div class="col-span-3 ">
                    <label  id="label_cliente_id" for="cliente_id" class="block text-sm font-medium text-gray-700">Cliente </label>
                    <input type="text" name="cliente_id" id="cliente_id" class="mt-1 bg-gray-100 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ $prodim->nombre}}" readonly>
                    <label id="error_cliente_id" name="error_cliente_id" class="hidden text-base font-normal text-red-500" >Seleccione una opción</label>
                </div>

                <div class="col-span-3 ">
                    <label  id="label_ejercicio" for="ejercicio" class="block text-sm font-medium text-gray-700">Ejercicio </label>
                    <input type="text" name="ejercicio" id="ejercicio" class="mt-1 bg-gray-100 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ $prodim->ejercicio}}" readonly>
                    <label id="error_ejercicio" name="error_ejercicio" class="hidden text-base font-normal text-red-500" >Seleccione una opción</label>
                    <input id="fuenteCliente_id" name="fuenteCliente_id" type="text" hidden>
                </div>

                <div class="col-span-2">
                    <label  id="label_acuse" for="acuse" class="block text-sm font-medium text-gray-700">Porcentaje *</label>
                        <div class="relative ">
                          <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <span class="text-gray-500 sm:text-sm">
                              %
                            </span>
                          </div>
                          <input type="text" name="porcentaje_prodim" id="porcentaje_prodim" maxlength="3" class="pl-7 mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" placeholder="0" value="{{$prodim->porcentaje_prodim}}">
                      </div>
                    <label id="error_porcentaje_prodim" name="error_porcentaje_prodim" class="hidden text-base font-normal text-red-500" >Este dato es requerido (MAX  %2)</label>
                </div>
                {{-- <div class="col-span-3"></div> --}}

                <div class="col-span-2 p-4">
                  <div class="flex flex-row p-2">
                      <label id="label_firma_electronica" for="firma_electronica" class="ml-6 text-sm font-medium text-gray-700 ">Presentado </label>
                      <input type="checkbox" name="firma_electronica" id="firma_electronica" class="ml-2 shadow-sm sm:text-sm border-gray-300 rounded h-6 w-6" {{ ($prodim->firma_electronica)? 'checked' : ''}}>
                  </div>
              </div>

                <div class="col-span-2 ">
                    <label  id="label_acuse_prodim" for="acuse_prodim" class="block text-sm font-medium text-gray-700">Acuse *</label>
                    
                    <div class="grid grid-cols-2 " >
                    <label for="acuse_prodim" class="text-blue-800 font-xs hover:text-blue-800 cursor-pointer hover:underline border border-blue-800 p-1 rounded-md ">Examinar archivos...</label>
                    <input type="file" name="acuse_prodim" id="acuse_prodim" accept=".pdf" onchange='uploadFile(this)' class="hidden focus:ring-indigo-500 focus:border-indigo-500 w-full shadow-sm sm:text-sm border-gray-300">              
                    <a type="button" onclick='window.open("{{$prodim->acuse_prodim}}","_blank", "width=900, height=800");' class="cursor-pointer bg-green-300 border rounded h-8 w-8 ml-2">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7  " fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                      </svg>
                    </a>
                  </div>
                    <span id="file-name" class="block file-box mt-2 text-sm text-green-600"></span>
                    <label id="error_acuse" name="error_acuse" class="hidden block text-base font-normal text-red-500" >Este archivo es requerido</label>
                    
                </div>

               
            </div>

            <div class="flex flex-nowrap w-full p-2" >

                <div class="flex flex-col justify-center w-full">
                    <div class="flex flex-row  p-2">
                        <label id="label_revisado" for="revisado" class="ml-6 text-sm font-medium text-gray-700 ">Revisado </label>
                        <input type="checkbox" name="revisado" id="revisado" class="ml-2 shadow-sm sm:text-sm border-gray-300 rounded h-6 w-6" {{ ($prodim->revisado == 1)? 'checked' : ''}}>
                    </div>
                </div>

                <div class="flex flex-col justify-center w-full">
                    <div class="flex flex-row  p-2">
                        <label id="label_validado" for="validado" class="ml-6 text-sm font-medium text-gray-700 ">Aprobado</label>
                        <input type="checkbox" name="validado" id="validado" class="ml-2 shadow-sm sm:text-sm border-gray-300 rounded h-6 w-6" {{ ($prodim->validado == 1)? 'checked' : ''}} >
                    </div>
                </div>

                <div class="flex flex-col justify-center w-full">
                    <div class="flex flex-row  p-2">
                        <label id="label_convenio" for="convenio" class="ml-6 text-sm font-medium text-gray-700 ">Convenio</label>
                        <input type="checkbox" name="convenio" id="convenio" class="ml-2 shadow-sm sm:text-sm border-gray-300 rounded h-6 w-6" {{ ($prodim->convenio == 1)? 'checked' : ''}} >
                    </div>
                </div>
            </div>
         
            <div class="grid grid-cols-6 gap-4">
              <div class="col-span-2 p-2">
                <label id="label_fecha_revisado" for="fecha_revisado" class="block text-sm font-medium text-gray-700">Fecha revisado *</label>
                <input type="date" name="fecha_revisado" id="fecha_revisado" min="{{$prodim->ejercicio}}-01-01" max="{{$prodim->ejercicio}}-12-31" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ $prodim->fecha_revisado}}" {{($prodim->revisado == 1)? '' : 'disabled'}}>
                <label id="error_fecha_revisado" class="hidden block text-md text-red-500">Se require de una fecha</label>
              </div>
            
              <div class="col-span-2 p-2">
                <label id="label_fecha_validado" for="fecha_validado" class="block text-sm font-medium text-gray-700">Fecha validado *</label>
                <input type="date" name="fecha_validado" id="fecha_validado" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ $prodim->fecha_validado }}" {{($prodim->validado == 1)? '' : 'disabled'}}>
                <label id="error_fecha_validado" class="hidden block text-md text-red-500">Se require de una fecha</label>
              </div>

              <div class="col-span-2 p-2">
                <label id="label_fecha_convenio" for="fecha_convenio" class="block text-sm font-medium text-gray-700">Fecha convenio *</label>
                <input type="date" name="fecha_convenio" id="fecha_convenio" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ $prodim->fecha_convenio }}" {{($prodim->covenio == 1)? '' : 'disabled'}}>
                <label id="error_fecha_convenio" class="hidden block text-md text-red-500">Se require de una fecha</label>
              </div>

            </div>
         </div>
         @endforeach
          <div class="px-4 py-3 bg-gray-100 sm:px-6">
            <span class="block text-xs">Porfavor verifique que todos los campos marcados con ( * ) esten rellenados</span>
            <div class="text-right">
              <a type="button" href="{{redirect()->getUrlGenerator()->previous()}}" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-gray-500 hover:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Regresar
              </a>
              <button type="submit" id="enviar_datos" class="ml-4 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-orange-800 hover:bg-orange-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
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
  window.onload = function(){
    if($('#revisado').prop("checked")){
      $('#fecha_revisado').removeClass("bg-gray-100");
      //$('#fecha_revisado').prop("required",true);
      $('#validado').removeAttr('disabled');
      $('#fecha_validado').attr('min', $('#fecha_revisado').val());
      $('#fecha_validado').attr('max', $('#ejercicio').val()+'-12-31');
    }else{
      $('#fecha_revisado').addClass("bg-gray-100");
      $('#validado').prop('disabled',true);
    }
    
    porcentaje = $('#porcentaje_prodim').val();
    $('#porcentaje_prodim').val(parseFloat(porcentaje).toFixed(2));

    if($('#validado').prop("checked")){
      $('#fecha_validado').removeClass("bg-gray-100");
      //$('#fecha_validado').prop("required",true);
      $('#convenio').removeAttr('disabled');
    }else{
      $('#fecha_validado').addClass("bg-gray-100");
      
      $('#convenio').prop('disabled',true);
    }

    if($('#convenio').prop('checked')){
      $('#fecha_convenio').removeClass("bg-gray-100");
      
      //$('#fecha_convenio').prop("required",true);
    }else{
      $('#fecha_convenio').addClass("bg-gray-100");
    }
  }

  function uploadFile(target) {
    document.getElementById("file-name").innerHTML = target.files[0].name;
    
    }
  
//===================================================
  $(document).ready(function(){ //eventos
      $('#revisado').on('click',function(){
        if($(this).prop("checked")){ //checklist revisado
          $('#fecha_revisado').removeClass("bg-gray-100");
          $('#fecha_revisado').prop("disabled",false);
          //$('#fecha_revisado').prop("required",true);
          $('#validado').removeAttr('disabled');
        }else{
          $('#fecha_revisado').addClass("bg-gray-100");
          $('#fecha_revisado').prop("disabled",true);
          //$('#fecha_revisado').prop("required",false);
          $('#fecha_revisado').val("");
          $('#validado').prop('disabled',true);
        }
      });

      $('#fecha_revisado').on('change',function(){ //cambia fecha revisado
        $('#fecha_validado').attr('min', $('#fecha_revisado').val());
      });

      $('#validado').on('click',function(){ //checklist validado
        if($(this).prop("checked")){
          $('#fecha_validado').removeClass("bg-gray-100");
          $('#fecha_validado').prop("disabled",false);
          //$('#fecha_validado').prop("required",true);
          $('#convenio').removeAttr('disabled');
        }else{
          $('#fecha_validado').addClass("bg-gray-100");
          $('#fecha_validado').prop("disabled",true);
          //$('#fecha_validado').prop("required",false);
          $('#fecha_validado').val("");
          $('#convenio').prop('disabled',true);
        }
      });

      $('#convenio').on('click',function(){ //checklist convenio
        if($(this).prop("checked")){
          $('#fecha_convenio').removeClass("bg-gray-100");
          $('#fecha_convenio').prop("disabled",false);
          $('#fecha_convenio').attr('min', $('#ejercicio').val()+'-01-01');
          //$('#fecha_convenio').prop("required",true);
        }else{
          $('#fecha_convenio').addClass("bg-gray-100");
          $('#fecha_convenio').prop("disabled",true);
          //$('#fecha_convenio').prop("required",false);
          $('#fecha_convenio').val("");
        }
      });

      $('#porcentaje_prodim').on('keyup',function(event){
              $(event.target).val(function(index, value) { //formato montos
                    return value.replace(/\D/g, "")
                        .replace(/[^\d]/,'')
                        .replace(/\B(?=(\d{2})+(?!\d)?)/g, ".");
                });
            });
  });

  //===================================================

  function validar(){ //validacion del formulario
    band = true;
        // acuse= document.forms["formulario"]["acuse_prodim"].value;
        //   if(acuse == ""){
        //      $('#error_acuse_prodim').removeClass('hidden');  
        //      band= false;
        //   }else{
        //      $('#error_acuse_prodim').addClass('hidden'); 
        //   }
        revisado = document.getElementById("revisado").checked;
        fecha_revisado = document.forms["formulario"]["fecha_revisado"].value;
        if(revisado){
          if(fecha_revisado == ''){
            $('#error_fecha_revisado').removeClass('hidden');
            band= false;
          }else{
            $('#error_fecha_revisado').addClass('hidden');
          }
        }else{
          $('#error_fecha_revisado').addClass('hidden');
        }
        validado = document.getElementById("validado").checked;
        fecha_validado = document.forms["formulario"]["fecha_validado"].value;
        if(validado){
          if(fecha_validado == ''){
            $('#error_fecha_validado').removeClass('hidden');
            band= false;
          }else{
            $('#error_fecha_validado').addClass('hidden');
          }
        }else{
          $('#error_fecha_validado').addClass('hidden');
        }
        convenio = document.getElementById("convenio").checked;
        fecha_convenio = document.forms["formulario"]["fecha_convenio"].value;
        if(convenio){
          if(fecha_convenio == ''){
            $('#error_fecha_convenio').removeClass('hidden');
            band= false;
          }else{
            $('#error_fecha_convenio').addClass('hidden');
          }
        }else{
          $('#error_fecha_convenio').addClass('hidden');
        }
    return band;
  }
</script>
@endsection