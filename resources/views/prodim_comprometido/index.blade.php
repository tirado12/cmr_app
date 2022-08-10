@extends('layouts.plantilla')
@section('title','Prodim comprometido')
@section('contenido')
<link rel="stylesheet" href="{{ asset('css/datatable.css') }}">
<link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/style_alert.css') }}">
<!--Responsive Extension Datatables CSS-->
<link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css">

<div class="flex flex-row">
    <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
    </svg>
  <h1 class="text-xl font-bold ml-2">Prodim comprometido</h1>
</div>

<div class="flex flex-col mt-6">
  <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
  <button class="bg-orange-800 mb-4 text-white active:bg-orange-800 font-bold uppercase text-sm px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="button" onclick="toggleModal('modal-add')">
  Agregar
  </button>
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

@if (session('existe')=='error')
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
            
                <li>Ya existe un registro con el mismo cliente, ejercicio y catalogo.</li>
            
        </ul>
    </div>
  </div>
</div>
@endif

<!-- fin tabla tailwind, inicio data table -->
<div class="contenedor p-8 shadow-2xl bg-white rounded-lg">
    <table id="example" class="table table-striped bg-white" style="width:100%;">
        <thead>
          <tr>
              <th>Cliente</th>
              <th>Ejercicio</th>
              <th>Nombre</th>
              <th>Fecha comprometido</th>
              <th>Monto</th>
              <th class="flex justify-center">Acción</th>
          </tr>
        </thead>
        <tbody> 
          @foreach($prodimComprometidos as $index)
          <tr>
              <td>
                <div class="flex items-center">
                  <div>
                      <div class="text-sm leading-5 font-medium text-gray-900">
                        {{$prodims->find($index->prodim_id)->nombre}}
                      </div>
                      
                  </div>
              </div>
              </td>
              <td>
                <div class="flex items-center">
                  <div>
                      <div class="text-sm leading-5 font-medium text-gray-900">
                        {{$prodims->find($index->prodim_id)->ejercicio}}
                      </div>
                      
                  </div>
              </div>
              </td>
              <td>
                <div class="flex items-center">
                  <div>
                      <div class="text-sm leading-5 font-medium text-gray-900">
                        {{$prodimCatalogo->find($index->prodim_catalogo_id)->nombre}}
                      </div>
                      
                  </div>
              </div>
              </td>
              <td>
                <div class="text-sm leading-5 font-medium text-gray-900 flex justify-center">
                  {{$index->fecha_comprometido}}
                </div>
              </td>
              <td>
                <div class="text-sm leading-5 font-medium text-gray-900 flex justify-center myDIV">
                  {{$index->monto}}
                </div>
              </td>
          
              <td>
                <div class="flex justify-center">
                <form action="{{ route('prodimComprometido.destroy', $index->id_comprometido) }}" method="POST" class="form-eliminar" >
                  <div>
                  <a type="button"  href="{{ route('prodimComprometido.edit', $index->id_comprometido) }}" class="bg-white text-blue-500 p-2 rounded rounded-lg">Editar</a>
                  {{-- <button class="bg-transparent text-blue-500 active:bg-transparent font-normal p-2  rounded outline-none focus:outline-none  ease-linear transition-all duration-150"  type="button" onclick="toggleDetalles('modal-detalles', {{$index}})">
                    Detalles
                  </button> --}}
                  @csrf
                  @method('DELETE')
                    <button type="submit" class="bg-white text-red-500 p-2 rounded rounded-lg">Eliminar</button>
                  </div>
                  
                  </form>
                </div>
              </td>   
          </tr>
          @endforeach
        </tbody>
    </table>
</div>

    <!-- inicio modal -->
    <div class="hidden overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center" id="modal-add">
      <div class="relative w-auto my-6 mx-auto max-w-3xl">
        <!--content-->
        <div class="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none">
          <!--header-->
          <div class="flex items-start justify-between p-5 border-b border-solid border-blueGray-200 rounded-t">
            <h4 class="text-xl font-semibold">
              Agregar Nuevo Prodim Comprometido
            </h4>
            <button class="p-1 ml-auto bg-transparent border-0 text-black opacity-5 float-right text-3xl leading-none font-semibold outline-none focus:outline-none" onclick="toggleModal('modal-add')">
              <span class="bg-transparent text-black opacity-5 h-6 w-6 text-2xl block outline-none focus:outline-none">
                
              </span>
            </button>
          </div>
          <!--body-->
          <form action="{{ route('prodimComprometido.store') }}" method="POST" onsubmit="return validar()" id="formulario" name="formulario">
            @csrf
            @method('POST')
          <div class="relative p-6 flex-auto">
                  <div class="relative p-6 flex-auto" id="anexos">
                      <div class="grid grid-cols-6 gap-4 mb-2">
                          <div class="col-span-3 ">
                              <label  id="label_cliente_id" for="cliente_id" class="block text-sm font-medium text-gray-700">Clientes con prodim *</label>
                              <select id="cliente_id" name="cliente_id" onchange="" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">                
                                  <option value=""> Elija una opción </option>
                                  @foreach ($prodims->unique('cliente_id') as $cliente)
                                      <option value="{{ $cliente->cliente_id }}"> {{ $cliente->nombre }} </option>
                                  @endforeach
                              </select>
                              <label id="error_cliente_id" name="error_cliente_id" class="hidden text-base font-normal text-red-500" >Seleccione una opción</label>
                          </div>
  
                          <div class="col-span-3 ">
                              <label  id="label_ejercicio" for="ejercicio" class="block text-sm font-medium text-gray-700">Ejercicio *</label>
                              <select id="ejercicio" name="ejercicio" onchange="" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">                
                                <option value=""> Elija un cliente </option>
                                {{-- @foreach ($prodims->where('cliente_id',1)->unique('fuente_id') as $cliente)
                                      <option value="{{ $cliente->cliente_id }}"> {{ $cliente->ejercicio }} </option>
                                  @endforeach --}}
                              </select>
                              <label id="error_ejercicio" name="error_ejercicio" class="hidden text-base font-normal text-red-500" >Seleccione una opción</label>
                              <input id="prodim_id" name="prodim_id" type="text" hidden>
                          </div>
  
                          <div class="col-span-3 ">
                            <label  id="label_prodim_catalogo_id" for="prodim_catalogo_id" class="block text-sm font-medium text-gray-700">Catalogo *</label>
                            <select id="prodim_catalogo_id" name="prodim_catalogo_id" onchange="" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">                
                                <option value=""> Elija una opción </option>
                                @foreach ($prodimCatalogo as $index)
                                    <option value="{{ $index->id_prodim_catalogo }}"> {{ $index->nombre }} </option>
                                @endforeach
                            </select>
                            <label id="error_prodim_catalogo_id" name="error_prodim_catalogo_id" class="hidden text-base font-normal text-red-500" >Seleccione una opción</label>
                        </div>
  
                        <div class="col-span-3 ">
                          <label id="label_fecha_comprometido" for="fecha_comprometido" class="block text-sm font-medium text-gray-700">Fecha comprometido *</label>
                          <input type="date" name="fecha_comprometido" id="fecha_comprometido" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                          <label id="error_fecha_comprometido" class="hidden block text-md text-red-500">Se require de una fecha</label>
                        </div>

                        <div class="col-span-3 ">
                          <label id="label_monto_prodim" for="monto_prodim" class="block text-sm font-medium text-gray-700">Monto total PRODIMDF </label>
                          <div class="relative ">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                              <span class="text-gray-500 sm:text-sm">
                                $
                              </span>
                            </div>
                            <input type="text" name="monto_prodim" id="monto_prodim" class="pl-7 mt-1 focus:ring-indigo-500 focus:border-indigo-500 block bg-gray-100 w-full shadow-sm sm:text-sm border-gray-300 rounded-md" placeholder="0.00" readonly >
                          </div>
                          {{-- <input type="text" name="monto_prodim" id="monto_prodim" class="mt-1 bg-gray-100 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" readonly placeholder="0.00"> --}}
                          {{-- <label id="error_monto_prodim" class="hidden block text-md text-red-500">Monto disponible</label> --}}
                        </div>

                        <div class="col-span-3 ">
                          <label id="label_monto_disponible" for="monto_disponible" class="block text-sm font-medium text-gray-700">Monto disponible </label>
                          <div class="relative ">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                              <span class="text-gray-500 sm:text-sm">
                                $
                              </span>
                            </div>
                            <input type="text" name="monto_disponible" id="monto_disponible" class="pl-7 mt-1 focus:ring-indigo-500 focus:border-indigo-500 block bg-gray-100 w-full shadow-sm sm:text-sm border-gray-300 rounded-md" placeholder="0.00" readonly >
                          </div>
                          {{-- <input type="text" name="monto_prodim" id="monto_prodim" class="mt-1 bg-gray-100 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" readonly placeholder="0.00"> --}}
                          <label id="error_monto_disponible" class="hidden block text-md text-red-500">La cantidad ingresada supera el monto disponible</label>
                        </div>
                        
                        <div class="col-span-6 ">
                          <label id="label_monto" for="monto" class="block text-sm font-medium text-gray-700">Monto *</label>
                          <div class="relative ">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                              <span class="text-gray-500 sm:text-sm">
                                $
                              </span>
                            </div>
                            <input type="text" name="monto" id="monto" class="pl-7 mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" placeholder="0.00" >
                          </div>
                          {{-- <input type="text" name="monto" id="monto" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"> --}}
                          <label id="error_monto" class="hidden block text-md text-red-500">Se require de un monto</label>
                        </div>
                        
                    </div>
                    <label id="error_monto_ceros" class="hidden block text-md text-red-500">No queda monto disponible para comprometer</label>
                  </div>
                
          </div>
          <!--footer-->
          <div class=" p-4 border-t border-solid border-blueGray-200 rounded-b">
            
            <span class="block text-xs">Verifique los campos obligatorios marcados con un ( * )</span>
            <div class="text-right">
            <button class="text-red-500 background-transparent font-bold uppercase px-6 py-2 text-sm outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="button" onclick="toggleModal('modal-add')">
              Cancelar
            </button>
            <button type="submit" id="guardar" name="guardar" class="bg-green-500 text-white active:bg-green-600 font-bold uppercase text-sm px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" >
              Guardar
            </button>
            </div>
          </div>
          </form>
        </div>
      </div>
    </div>

<div class="hidden opacity-25 fixed inset-0 z-40 bg-black" id="modal-add-backdrop"></div>

<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/dataTables.responsive.min.js') }}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.22/b-1.6.4/b-flash-1.6.4/b-html5-1.6.4/b-print-1.6.4/datatables.min.js"></script>
@if(session('eliminar')=='ok')
<script>
  //ejecucion del modal de aviso eliminar
  Swal.fire(
    '¡Eliminado!',
    'El usuario ha sido eliminado.',
    'success'
  )
</script>
@endif
<!--Alerta de error-->
@if(session('eliminar')=='error')
<script>
  Swal.fire({
    icon: 'error',
    title: '¡Oops... !',
    html: 'Este registro tiene relación con otro.<br> No es posible eliminarlo.'
  });
</script>
@endif

<script>
  //Mensaje de advertencia
$(".form-eliminar").submit(function(e){
    e.preventDefault();
    Swal.fire({
      customClass: {
      title: 'swal_title_modificado',
      cancelButton: 'swal_button_cancel_modificado'
      },
      title: '¿Seguro que desea eliminar este PRODIMDF comprometido?',
      text: "¡Aviso, esta acción es irreversible!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#10b981',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Borrar',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      if (result.isConfirmed) {
        this.submit();
      }
    })
});
 /* */
</script>

<style>
  .currSign:before {
      content: '$';
  }
</style>
<script>
  function moneda(valor){//formato montos
      return valor.toString().replace(/\D/g, "").replace(/([0-9])([0-9]{2})$/, '$1.$2').replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ",");
    }
  //Formato de cantidades
    let x = document.querySelectorAll(".myDIV");
    
    for (let i = 0, len = x.length; i < len; i++) {
        //let num = Number(x[i].innerHTML).toLocaleString('es-MX');
        let num = moneda(parseFloat(x[i].innerHTML).toFixed(2));
        x[i].innerHTML = num;
        x[i].classList.add("currSign"); 
    }
</script>
<script>
  

     $(document).ready(function(){
       disponibles="";
        $("#cliente_id").on('change', function () { //consulta ejercicios por cliente
                  cliente=$(this).val();
                  $("#ejercicio").empty(); //valida si no se ha seleccionado una opc
                  $("#ejercicio").append('<option value="">Elija un cliente</option>');
                  if(cliente != ""){
                    var link = '{{ url("/ejerciciosclientesProdim")}}/'+cliente; //consulta ajax
                    $.ajax({
                        url: link,
                        dataType:'json',
                        type:'get',
                        success: function(data){
                            //console.log(data)
                            disponibles = data;
                            $.each(data,function(key, item) {
                                $("#ejercicio").append('<option value='+item.id_prodim+'>'+item.ejercicio+'</option>');
                                
                            });
                        },
                        cache: false
                    });
                  }
        });

        $("#monto").on({
            "focus": function(event) {
                $(event.target).select();
            },
            "keyup": function(event) {
                $(event.target).val(function(index, value) { //formato montos
                  //
                    return value.replace(/\D/g, "")
                        .replace(/([0-9])([0-9]{2})$/, '$1.$2')
                        .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ",");
                }); 
                // monto_disponible = parseFloat($('#monto_disponible').val()).toFixed(2);
                // monto = parseFloat($(this).val()).toFixed(2);
                // if(monto > monto_disponible){

                // }
            }
        });

      $('#ejercicio').on('change',function(){
          $.each(disponibles,function(key, item) { //colocar el monto 
            //console.log(item)
              if($('#ejercicio option:selected').val() == item.id_prodim){
                //console.log(item.monto_prodim)
                $('#monto_prodim').val(moneda(parseFloat(item.monto_prodim).toFixed(2)));
              }
          });
          $('#prodim_id').val($(this).val());
          consultarSumaComprometido($(this).val());
          
          $('#fecha_comprometido').val('');
          $('#fecha_comprometido').prop('min',$('#ejercicio option:selected').text()+'-01-01');
          $('#fecha_comprometido').prop('max',$('#ejercicio option:selected').text()+'-12-31');
      });

      $('#example').DataTable({ //datatable
        "autoWidth" : true,
        "responsive" : true,
        language: {
          url: 'https://cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json'
        }
      }).columns.adjust();
    });

    function consultarSumaComprometido(prodim){
             if(prodim != ''){var link = '{{ url("/montoTotalCliente")}}/'+prodim; //consulta ajax
               $.ajax({
                        url: link,
                        dataType:'json',
                        type:'get',
                        success: function(data){
                            //console.log(data)
                            sumaComprometido = parseFloat(data).toFixed(2);
                            montoTotalProdim = parseFloat($('#monto_prodim').val().replace(",","")).toFixed(2);
                            montoDisponible = montoTotalProdim - sumaComprometido;
                            
                            $('#monto_disponible').val(moneda(parseFloat(montoDisponible).toFixed(2)));
                            // $.each(data,function(key, item) {
                            // $("#ejercicio").append('<option value='+item.id_prodim+'>'+item.ejercicio+'</option>');
                                
                            // });
                        },
                        cache: false
              });}
    }

    function toggleModal(modal){
            document.getElementById(modal).classList.toggle("hidden");
            document.getElementById(modal + "-backdrop").classList.toggle("hidden");    
    }

    function validar(){
      band = true;
      cliente= document.forms["formulario"]["cliente_id"].value;
      if(cliente == ""){
                 $('#error_cliente_id').removeClass('hidden');  
                 band= false;
      }else{
                $('#error_cliente_id').addClass('hidden'); 
      }
      ejercicio= document.forms["formulario"]["ejercicio"].value;
      if(ejercicio == ""){
                 $('#error_ejercicio').removeClass('hidden');  
                 band= false;
      }else{
                $('#error_ejercicio').addClass('hidden'); 
      }
      catalogo= document.forms["formulario"]["prodim_catalogo_id"].value;
      if(catalogo == ""){
                 $('#error_prodim_catalogo_id').removeClass('hidden');  
                 band= false;
      }else{
                $('#error_prodim_catalogo_id').addClass('hidden'); 
      }
      fecha_comprometido= document.forms["formulario"]["fecha_comprometido"].value;
      if(fecha_comprometido == ""){
                 $('#error_fecha_comprometido').removeClass('hidden');  
                 band= false;
      }else{
                $('#error_fecha_comprometido').addClass('hidden'); 
      }
      monto= document.forms["formulario"]["monto"].value;
      
      if(monto == ""){
                 $('#error_monto').removeClass('hidden');  
                 band= false;
      }else{
                monto = parseFloat(monto.replace(",","")).toFixed(2);
                monto_disponible = document.forms["formulario"]["monto_disponible"].value;
                monto_disponible = parseFloat(monto_disponible.replace(",","")).toFixed(2);
                 //console.log(parseFloat(monto))
                // console.log(monto_disponible)
                if(parseFloat(monto_disponible) == 0){
                  band = false;
                  $('#error_monto_ceros').removeClass('hidden');
                }
                
                if(parseFloat(monto)>parseFloat(monto_disponible)){
                  band = false;
                  $('#error_monto_disponible').removeClass('hidden');
                }else{
                  $('#error_monto_disponible').addClass('hidden');
                }
            $('#error_monto').addClass('hidden'); 
                
      }

      return band;
    }
</script>
@endsection