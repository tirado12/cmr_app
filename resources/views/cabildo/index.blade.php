@extends('layouts.plantilla')
@section('title','Cabildo')
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
<h1 class="text-xl font-bold ml-2">Lista de Cabildo</h1>
</div>

<div class="flex flex-col mt-6">
    <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
    <button class="bg-orange-800 mb-4 text-white active:bg-orange-800 font-bold uppercase text-sm px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="button" onclick="toggleModal('modal-id')">
    Agregar
    </button>
        <!-- div de tabla -->
    </div>
</div>

<!-- fin tabla tailwind, inicio data table -->
<div class="contenedor p-8 shadow-2xl bg-white rounded-lg">

<table id="example" class="table table-striped bg-white" style="width:100%;">
  <thead>
      <tr>
          
          <th>Nombre</th>
          <th>Cargo</th>
          <th>Telefono</th>
          <th>Correo</th>
          <th>Municipio</th>
          <th class="flex justify-center">Acción</th>
          
      </tr>
  </thead>
  <tbody> 
    @foreach($integrantes as $integrante)
      <tr>
          
          <td>
            <div class="flex items-center">
              <div>
                  <div class="text-sm leading-5 font-medium text-gray-900">{{$integrante->nombre}}</div>
                  <div class="text-sm leading-5 text-gray-500">{{$integrante->rfc}}</div>
              </div>
          </div>
          </td>
          <td>
            <div class="text-sm leading-5 font-medium text-gray-900">
            {{ $integrante->cargo }}
            </div>
            
          </td>
          <td>
            <div class="text-sm leading-5 font-medium text-gray-900">
            {{ $integrante->telefono }}
            </div>
            
          </td>
          <td>
            <div class="text-sm leading-5 font-medium text-gray-900">
            {{ $integrante->correo }}
            </div>
            
          </td>
          <td>
            <div class="text-sm leading-5 font-medium text-gray-900">
            {{ $clientes->find($integrante->cliente_id)->nombre}}
            </div>
            
          </td>
          <td>
            <div class="flex justify-center">
            <form action="{{ route('cabildo.destroy', $integrante->id_integrante) }}" method="POST" class="form-eliminar" >
              <div>
              <a type="button"  href="{{ route('cabildo.edit', $integrante)}}" class="bg-white text-blue-500 p-2 rounded rounded-lg">Editar</a>
              
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
            Agregar Nuevo Integrante del Cabildo
          </h4>
          <button class="p-1 ml-auto bg-transparent border-0 text-black opacity-5 float-right text-3xl leading-none font-semibold outline-none focus:outline-none" onclick="toggleModal('modal-id')">
            <span class="bg-transparent text-black opacity-5 h-6 w-6 text-2xl block outline-none focus:outline-none">
              
            </span>
          </button>
        </div>
        <!--body-->
        <form action="{{ route('cabildo.store') }}" method="POST" id="formulario" name="formulario">
          @csrf
          @method('POST')
        <div class="relative p-6 flex-auto">
            <div class="grid grid-cols-8 gap-8">
              <div class="col-span-8 ">
                <label id="label_nombre" for="first_name" class="block text-sm font-medium text-gray-700">Nombre *</label>
                <input type="text" name="nombre" id="nombre" placeholder="Nombre" maxlength="50" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required >
                <label id="error_nombre" name="error_nombre" class="hidden text-base font-normal text-red-500" >Porfavor ingresa un nombre</label>
              </div>
              <div class="col-span-8">
                <label id="label_rfc" for="rfc" class="block text-sm font-medium text-gray-700">RFC *</label>
                <input type="text" name="rfc" id="rfc" placeholder="BDS140512XXXX" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" maxlength="13" required>
                <label id="error_rfc" name="error_rfc" class="hidden text-base font-normal text-red-500" >Porfavor ingresa al menos un RFC generico con 5 caracteres</label>
              </div>
              <div class="col-span-8">
                <label id="label_cargo" for="cargo" class="block text-sm font-medium text-gray-700">Cargo *</label>
                <input type="text" name="cargo" id="cargo" placeholder="Presidente" maxlength="70" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                <label id="error_cargo" name="error_cargo" class="hidden text-base font-normal text-red-500" >Porfavor ingresa un cargo</label>
              </div>
              <div class="col-span-8">
                  <label id="eti_telefono" for="telefono" class="block text-sm font-medium text-gray-700">Telefono</label>
                  <input type="tel" name="telefono" id="telefono" placeholder="9519999999" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" maxlength="13" required>   
              </div>
              
              <div class="col-span-8">
                  <label id="label_correo" for="correo" class="block text-sm font-medium text-gray-700">Correo </label>
                  <input type="email" name="correo" id="correo" placeholder="usuario@ejemplo.com" maxlength="30" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                  <label id="error_correo" name="error_correo" class="hidden text-base font-normal text-red-500" >Porfavor ingresar un correo valido</label>
                </div>
              <div class="col-span-8" >
                <label id="label_cliente" for="cliente" class="block text-sm font-medium text-gray-700">Cliente *</label>
                <select id="cliente" name="cliente" onchange="validarCliente()" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option value="">Elija una opción</option>
                    @foreach($clientes as $cliente)
                    <option value="{{ $cliente->id_cliente }}">{{ $cliente->nombre }}</option>
                     @endforeach
                </select>
                <label id="error_municipio" name="error_municipio" class="hidden text-base font-normal text-red-500" >Seleccione una opción</label>
          </div>
            </div>
          
        </div>
        <!--footer-->
        <div class=" p-4 border-t border-solid border-blueGray-200 rounded-b">
          
          <span class="block text-xs">Verifique los campos obligatorios marcados con un ( * )</span>
          <div class="text-right">
          <button class="text-red-500 background-transparent font-bold uppercase px-6 py-2 text-sm outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="button" onclick="toggleModal('modal-id')">
            Cancelar
          </button>
          <button type="submit" class="bg-green-500 text-white active:bg-green-600 font-bold uppercase text-sm px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" >
            Guardar
          </button>
          </div>
        </div>
        </form>
      </div>
    </div>
  </div>
  

<div class="hidden opacity-25 fixed inset-0 z-40 bg-black" id="modal-id-backdrop"></div>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>  
<!--Alerta de confirmacion-->
@if(session('eliminar')=='ok')
  <script>
    Swal.fire( //metodo para llamar el mensaje despues de eliminar dato
      '¡Eliminado!',
      'El integrante de cabildo ha sido eliminado.',
      'success'
    )
  </script>
@endif

<script>
  $(".form-eliminar").submit(function(e){ //propiedades mensaje de confirmacion de eliminar 
    e.preventDefault();
    Swal.fire({
      customClass: {
  title: 'swal_title_modificado',
  cancelButton: 'swal_button_cancel_modificado'
},
  title: '¿Seguro que desea eliminar este integrante?',
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


<script type="text/javascript">
  function toggleModal(modalID){ //mostrar y ocultar modal
    document.getElementById(modalID).classList.toggle("hidden");
    document.getElementById(modalID + "-backdrop").classList.toggle("hidden");
  }

//validacion de campos del modal
$(document).ready(function() {
   $("#modal-id input").keyup(function() {
  
      var monto = $(this).val();
      
      if(monto != ''){
      $('#error_'+$(this).attr('id')).fadeOut();
      $("#label_"+$(this).attr('id')).removeClass('text-red-500');
      $("#label_"+$(this).attr('id')).addClass('text-gray-700');
      //$('#guardar').removeAttr("disabled");
      }
      else{
      //$("#guardar").attr("disabled", true);
      $('#error_'+$(this).attr('id')).fadeIn();
      $("#label_"+$(this).attr('id')).addClass('text-red-500');
      $("#label_"+$(this).attr('id')).removeClass('text-gray-700');
      }
    
    });

    $("input[name='telefono']").keyup(function() { //dar formato al input telefono
    $(this).val($(this).val().replace(/^(\d{3})(\d{3})(\d+)$/, "($1)$2-$3"));
      });
});

//Validacion de select municipio
function validarCliente() {
  var valor = document.getElementById("cliente").value;
  if(valor != ''){
    $('#error_cliente').fadeOut();
    $("#label_cliente").removeClass('text-red-500');
    $("#label_cliente").addClass('text-gray-700');
  }else{
    $('#error_cliente').fadeIn();
    $("#label_cliente").addClass('text-red-500');
    $("#label_cliente").removeClass('text-gray-700');
  }
}


//validacion del formulario con el btn guardar
$().ready(function() {
  $("#formulario").validate({
    onfocusout: false,
    onclick: false,
		rules: {
      nombre: { required: true},
			rfc: { required: true, minlength: 5, maxLength: 13},
      cargo: { required: true},
      
      correo: { email: true},
      municipio: { required: true}
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
<style>
  
</style>

<script type="text/javascript" src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.22/b-1.6.4/b-flash-1.6.4/b-html5-1.6.4/b-print-1.6.4/datatables.min.js"></script>



<script>
  
  $(document).ready(function() { //llamar datatable
    
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