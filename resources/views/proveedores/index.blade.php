@extends('layouts.plantilla')
@section('title','Proveedores')
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
<h1 class="text-xl font-bold ml-2">Lista de Proveedores</h1>
</div>

<div class="flex flex-col mt-6">
    <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
    <button class="bg-orange-800 mb-4 text-white active:bg-orange-800 font-bold uppercase text-sm px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="button" onclick="toggleModal('modal-id')">
    Agregar
    </button>
        <!-- div de tabla -->
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
<!-- fin tabla tailwind, inicio data table -->
<div class="contenedor p-8 shadow-2xl bg-white rounded-lg">

<table id="example" class="table table-striped bg-white" style="width:100%;">
  <thead>
      <tr>
          <th>RFC</th>
          <th>Tipo de contribuyente</th>
          <th>Razón social</th>
          <th>Municipio</th>
          <th class="flex justify-center">Acción</th>
          
      </tr>
  </thead>
  <tbody> 
    @foreach($proveedores as $proveedor)
      <tr>
          
          <td>
            <div class="flex items-center">
              <div>
                  <div class="text-sm leading-5 font-medium text-gray-900">{{$proveedor->rfc}}</div>
                  
              </div>
          </div>
          </td>
          
          <td>
            <div class="text-sm leading-5 font-medium text-gray-900">
                {{($proveedor->tipo_rfc ) ? 'Persona Moral' : 'Persona Física'}}
            </div>
            
          </td>
          <td>
            <div class="text-sm leading-5 font-medium text-gray-900">
                {{$proveedor->razon_social}}
            </div>
            
          </td>
          <td>
            <div class="text-sm leading-5 font-medium text-gray-900 flex justify-center">
               {{$nombre_municipio= $municipios->find($proveedor->municipio_id)->nombre}}
            </div>
          </td>
          <td>
            <div class="flex justify-center">
            <form action="{{ route('proveedor.destroy', $proveedor->id_proveedor) }}" method="POST" class="form-eliminar" >
              <div>
              <a type="button"  href="{{ route('proveedor.edit', $proveedor->id_proveedor)}}" class="bg-white text-blue-500 p-2 rounded rounded-lg">Editar</a>
              <button class="bg-transparent text-blue-500 active:bg-transparent font-normal  text-sm p-2  rounded outline-none focus:outline-none  ease-linear transition-all duration-150"  type="button" onclick="toggleModal1('modal-proveedor', {{ $proveedor }}, '{{$nombre_municipio}}')">
                Detalles
              </button>
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
  <!--<tfoot>
      <tr>
        <th>Usuario</th>
        <th>Rol</th>
        <th></th>
      </tr>
  </tfoot>-->
</table>
</div>

<!-- inicio modal -->
<div class="hidden overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center" id="modal-id">
  <div class="relative w-auto my-6 mx-auto max-w-3xl">
    <!--content-->
    <div class="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none">
      <!--header-->
      <div class="flex items-start justify-between p-5 border-b border-solid border-blueGray-200 rounded-t">
        <h4 class="text-xl font-semibold">
          Agregar Nuevo Proveedor
        </h4>
        <button class="p-1 ml-auto bg-transparent border-0 text-black opacity-5 float-right text-3xl leading-none font-semibold outline-none focus:outline-none" onclick="toggleModal('modal-id')">
          <span class="bg-transparent text-black opacity-5 h-6 w-6 text-2xl block outline-none focus:outline-none">
            
          </span>
        </button>
      </div>
      <!--body-->
      <form action="{{ route('proveedor.store') }}" method="POST" id="formulario" name="formulario">
        @csrf
        @method('POST')
      <div class="relative p-6 flex-auto">
        
          <div class="grid grid-cols-8 gap-8">
            <div class="col-span-8 ">
              <label id="label_rfc" for="rfc" class="block text-sm font-medium text-gray-700">RFC *</label>
              <input type="text" name="rfc" id="rfc" minlength="12" maxlength="13" placeholder="BDS140512XXXX" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required value="{{ old('rfc') }}">
              <label id="error_rfc" name="error_rfc" class="hidden text-base font-normal text-red-500" >Introduzca al menos un RFC generico con 12 caracteres</label>
              
            </div>

            <div class="col-span-6 sm:col-span-3">
              <label id="label_tipo_rfc" for="tipo_rfc" class="block text-sm font-medium text-gray-700">Tipo de contribuyente:</label>
              <input type="text" id="tipo_rfc" name="tipo_rfc" class="mt-1 w-full block bg-gray-100 shadow-sm sm:text-sm border-gray-300 rounded-md" readonly value="{{ old('tipo_rfc') }}">
              
            </div>

            <div class="col-span-8" id="div_representante_legal">
              <label id="labe_representante_legal" for="representante_legal" class="block text-sm font-medium text-gray-700">Representante legal </label>
              <input type="text" name="representante_legal" id="representante_legal" placeholder="Nombre" maxlength="40" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ old('representante_legal') }}">
              <label id="error_representante_legal" name="error_representante_legal" class="hidden text-base font-normal text-red-500" >Por favor ingresar un representante legal</label>
            </div>

            <div class="col-span-8">
              <label id="label_razon_social" for="razon_social" class="block text-sm font-medium text-gray-700">Razón social *</label>
              <input type="text" name="razon_social" id="razon_social" maxlength="70" placeholder="Materiales para construcción S.A. de C.V." class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required value="{{ old('razon_social') }}">
              <label id="error_razon_social" name="error_razon_social" class="hidden text-base font-normal text-red-500" >Introduzca una razon social</label>
            </div>

            <div class="col-span-8">
              <label for="country" class="block text-sm font-medium text-gray-700">Municipio *</label>
              <select id="municipio_id" name="municipio_id" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-800 focus:border-blue-800 sm:text-sm">
                @foreach($municipios as $municipio)
                  <option value="{{ $municipio->id_municipio}}" {{ ($municipio->id_municipio == old('municipio_id')) ? 'selected' : '' }}>{{ $municipio->nombre }}</option>
                @endforeach
              </select>
            </div>
           
          </div>
          <label id="error_existe" name="error_existe" class="hidden text-base font-normal text-red-500" >Ya existe un registro con este RFC y este municipio asociado.</label>
      </div>
      <!--footer-->
      <div class=" p-4 border-t border-solid border-blueGray-200 rounded-b">
        
        <span class="block text-xs">Verifique los campos obligatorios marcados con un ( * )</span>
        <div class="text-right">
        <button class="text-red-500 background-transparent font-bold uppercase px-6 py-2 text-sm outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="button" onclick="toggleModal('modal-id')">
          Cancelar
        </button>
        <button type="submit" id="guardar" class="bg-green-500 text-white active:bg-green-600 font-bold uppercase text-sm px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" >
          Guardar
        </button>
        </div>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- inicio modal -->
<div class="hidden overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center" id="modal-proveedor">
  <div class="relative w-auto my-6 mx-auto max-w-3xl">
    <!--content-->
    <div class="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none">
      <!--header-->
      <div class="flex items-start justify-between p-5 border-b border-solid border-blueGray-200 rounded-t">
        <h4 class="text-xl font-semibold">
          Datos del proveedor
        </h4>
        <button class="p-1 ml-auto bg-transparent border-0 text-red-500 float-right text-3xl leading-none font-semibold outline-none focus:outline-none" onclick="toggleModal1('modal-proveedor') ">
          <span class="bg-transparent text-red-500 h-6 w-6 text-2xl block outline-none focus:outline-none">
            ×
          </span>
        </button>
      </div>
      <!--body-->

      <div class="relative p-6 flex-auto">
          <div class="grid grid-cols-8 ">
            <div class="grid col-span-4 gap-4">
              
              <div class="col-span-8 ">
                <label for="detalles_rfc" class="text-base font-medium text-gray-700">RFC: </label>
                <label id="detalles_rfc" class="text-base font-bold text-gray-900"></label>
              </div>
              <div class="col-span-8 ">
                <label for="detalles_tipo_contribuyente" class="text-base font-medium text-gray-700">Tipo de contribuyente: </label>
                <label id="detalles_tipo_contribuyente" class="text-base font-bold text-gray-900"></label>
              </div>
              <div class="col-span-8" >
                <label id="label_detalles_razon" for="detalles_razon_social" class=" text-base font-medium text-gray-700">Razon social: </label>
                <label id="detalles_razon_social" class="text-base font-bold text-gray-900"></label>
              </div>
              <div class="col-span-8" id="div_representante">
                <label for="detalles_representante_legal" class=" text-base font-medium text-gray-700">Representante legal: </label>
                <label id="detalles_representante_legal" class="text-base font-bold text-gray-900"></label>
              </div>
              
              <div class="col-span-8">
                <label for="detalles_municipio" class="text-base font-medium text-gray-700">Municipio: </label>
                <label id="detalles_municipio" class="text-base font-bold text-gray-900"></label>
              </div>
              
            </div>

          </div>
      </div>
      <!--footer-->
    </div>
  </div>
</div>

<div class="hidden opacity-25 fixed inset-0 z-40 bg-black" id="modal-id-backdrop"></div>
<div class="hidden opacity-25 fixed inset-0 z-40 bg-black" id="modal-proveedor-backdrop"></div>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>  
<!--Alerta de confirmacion-->
@if(session('eliminar')=='ok')
  <script>
    Swal.fire(
      '¡Eliminado!',
      'El proveedor ha sido eliminado.',
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
      html: 'Este proveedor tiene relación con otro registro.<br> No es posible eliminarlo.'
      
    });
  </script>
@endif

<script>
  $(".form-eliminar").submit(function(e){ //propiedades del mensaje de advertencia eliminar
    e.preventDefault();
    Swal.fire({
      customClass: {
        title: 'swal_title_modificado',
        cancelButton: 'swal_button_cancel_modificado'
      },
        title: '¿Seguro que desea eliminar este proveedor?',
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
</script>
<script type="text/javascript">
  function toggleModal(modalID){ //mostrar o ocultar modal
    document.getElementById(modalID).classList.toggle("hidden");
    document.getElementById(modalID + "-backdrop").classList.toggle("hidden");
  }
//=======================================================
  function toggleModal1(modalID, proveedor, nombre_municipio){ //mostrar y ocultar modal detalles
    if(proveedor != null){
      $('#detalles_rfc').text(proveedor.rfc);
      if(proveedor.tipo_rfc == 1){
      $('#detalles_tipo_contribuyente').text("Persona Moral");
      $('#div_representante').removeClass('hidden');
      $('#label_detalles_razon').text('Razón social:');
    }else{
      $('#detalles_tipo_contribuyente').text("Persona Física");
      $('#div_representante').addClass('hidden');
      $('#label_detalles_razon').text('Nombre:');
    }
    $('#detalles_razon_social').text(proveedor.razon_social);
    $('#detalles_representante_legal').text(proveedor.representante_legal);
    $('#detalles_municipio').text(nombre_municipio);
    }
    document.getElementById(modalID).classList.toggle("hidden");
    document.getElementById(modalID + "-backdrop").classList.toggle("hidden");
  }
//=======================================================
//validacion de campos del modal
$(document).ready(function() {
  $('#municipio_id, #rfc').on('change keyup', function(){ 
      rfc = $('#rfc').val();
      municipio_id = $('#municipio_id').val();
      if(rfc.length >= 12){
        var link = '{{ url("/proveedorRfc")}}/'+rfc+','+municipio_id;
        $.ajax({
              url: link,
              dataType:'json',
              type:'get',
              success: function(data){
                console.log(data);
                if(data.length>0){
                  $('#error_existe').removeClass('hidden');
                  $('#guardar').attr("disabled", true);
                  $("#guardar").removeClass('bg-green-500');
                  $("#guardar").addClass('bg-gray-700');
                }else{
                  $('#error_existe').addClass('hidden');
                  $('#guardar').removeAttr("disabled");
                  $("#guardar").removeClass('bg-gray-700');
                  $("#guardar").addClass('bg-green-500');
                }
              },
              cache: false
            });
      }
    });
  //=======================================================
   $("#modal-id input").keyup(function() {
    if($(this).attr('id') == 'rfc'){ //valida rfc - tipo
          rfc = $('#rfc').val();
          if(rfc.length == 12){ // > 12
              $("#tipo_rfc").empty();
              $('#tipo_rfc').val('Persona Moral');
              $('#div_representante_legal').removeClass('hidden');
              $('#representante_legal').attr('required',true);
              $('#razon_social').attr("placeholder",'Materiales para construcción S.A. de C.V.');
              $('#label_razon_social').empty();
              $('#label_razon_social').text('Razón social *');
              $('#error_razon_social').empty();
              $('#error_razon_social').text('Por favor ingresar una razón social');
              
            }else if(rfc.length == 13){
              $("#tipo_rfc").empty();
              $('#tipo_rfc').val('Persona Física');
              $('#div_representante_legal').addClass('hidden');
              $('#representante_legal').removeAttr('required');
              $('#razon_social').attr("placeholder",'Juan N.');
              $('#label_razon_social').empty();
              $('#label_razon_social').text('Nombre *');
              $('#error_razon_social').empty();
              $('#error_razon_social').text('Por favor ingresar un nombre');
            }
    }

    if($(this).attr('id') == 'rfc'){ //letras y numeros rfc
          rfc= $(this).val();
          rfc= rfc.replace(/[^a-zA-Z0-9]/g, ""); //caracteres especiales
          rfc = rfc.trim(); // espacios en blanco
          $('#rfc').val(rfc);  
    }
    
      var cadena = $(this).val(); //campos vacios
      if(cadena != ''){
      $('#error_'+$(this).attr('id')).fadeOut();
      $("#label_"+$(this).attr('id')).removeClass('text-red-500');
      $("#label_"+$(this).attr('id')).addClass('text-gray-700');
      }
      else{
      $('#error_'+$(this).attr('id')).fadeIn();
      $("#label_"+$(this).attr('id')).addClass('text-red-500');
      $("#label_"+$(this).attr('id')).removeClass('text-gray-700');
      }
    
    });
});
//=======================================================
//validacion del formulario con el btn guardar
$().ready(function() {
  $("#formulario").validate({
    onfocusout: false,
    onclick: false,
		rules: {
      rfc: { required: true, minlength: 12, maxlength: 13},
			razon_social: { required: true},
		},
    errorPlacement: function(error, element) {
      if(error != null){
      $('#error_'+element.attr('id')).fadeIn();
      }else{
        $('#error_'+element.attr('id')).fadeOut();
      }
     
    },
	}); 
});
</script>

<script type="text/javascript" src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.22/b-1.6.4/b-flash-1.6.4/b-html5-1.6.4/b-print-1.6.4/datatables.min.js"></script>

<script>
  //DATATABLE
  $(document).ready(function() {
    $('#example').DataTable({
        "autoWidth" : true,
        "responsive" : true,
        language: {
    url: 'https://cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json'
}
        
    }).columns.adjust();
});
</script>




@endsection