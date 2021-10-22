@extends('layouts.plantilla')
@section('title','Contratistas')
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
<h1 class="text-xl font-bold ml-2">Lista de Contratistas</h1>
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
          <th>Contratista</th>
          <th>Telefono</th>
          <th>Correo</th>
          <th>Tipo de contribuyente</th>
          <th>Representante legal</th>
          <th class="flex justify-center">Acción</th>
      </tr>
  </thead>
  <tbody> 
    @foreach($contratistas as $contratista)
      <tr>
          
          <td>
            <div class="flex items-center">
              <div>
                  <div class="text-sm leading-5 font-medium text-gray-900">{{$contratista->razon_social}}</div>
                  <div class="text-sm leading-5 text-gray-500">{{$contratista->rfc}}</div>
              </div>
          </div>
          </td>
          <td>
            <div class="text-sm leading-5 font-medium text-gray-900 flex justify-center">
            {{ ($contratista->telefono == null ) ? '-' : $contratista->telefono }}
            </div>
            
          </td>
          <td>
            <div class="text-sm leading-5 font-medium text-gray-900 flex justify-center">
            {{ ($contratista->correo == null) ? '-' :  $contratista->correo}}
            </div>
            
          </td>
          <td>
            <div class="text-sm leading-5 font-medium text-gray-900">
                {{($contratista->tipo_rfc ) ? 'Persona Moral' : 'Persona Física'}}
            </div>
          </td>
          <td>
            <div class="text-sm leading-5 font-medium text-gray-900 flex justify-center">
                {{($contratista->representante_legal == null) ? '-' : $contratista->representante_legal}}
            </div>
            
          </td>

          <td>
            <div class="flex justify-center">
            <form action="{{ route('contratistas.destroy', $contratista->id_contratista) }}" method="POST" class="form-eliminar" >
              <div>
              <a type="button"  href="{{ route('contratistas.edit', $contratista->id_contratista)}}" class="bg-white text-blue-500 p-2 rounded rounded-lg">Editar</a>
              
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
          Agregar Nuevo Contratista
        </h4>
        <button class="p-1 ml-auto bg-transparent border-0 text-black opacity-5 float-right text-3xl leading-none font-semibold outline-none focus:outline-none" onclick="toggleModal('modal-id')">
          <span class="bg-transparent text-black opacity-5 h-6 w-6 text-2xl block outline-none focus:outline-none">
            
          </span>
        </button>
      </div>
      <!--body-->
      <form action="{{ route('contratistas.store') }}" method="POST" id="formulario" name="formulario">
        @csrf
        @method('POST')
      <div class="relative p-6 flex-auto">
          <div class="grid grid-cols-8 gap-8">
            <div class="col-span-8 ">
              <label id="label_rfc" for="first_name" class="block text-sm font-medium text-gray-700">RFC *</label>
              <input type="text" name="rfc" id="rfc" placeholder="BDS140512XXXX" minlength="12" maxlength="13" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
              <label id="error_rfc" name="error_rfc" class="hidden text-base font-normal text-red-500" >Porfavor ingresar al menos un RFC generico con 12 caracteres</label>
              <label id="error_existe" name="error_existe" class="hidden text-base font-normal text-red-500" >Ya existe un registro con este RFC</label>
            </div>
            <div class="col-span-6 sm:col-span-3">
              <label id="label_tipo_rfc" for="tipo_rfc" class="block text-sm font-medium text-gray-700">Tipo de contribuyente:</label>
              <input type="text" id="tipo_rfc" name="tipo_rfc" class="mt-1 w-full block bg-gray-100 shadow-sm sm:text-sm border-gray-300 rounded-md" disabled>
              
            </div>
            <div class="col-span-8">
              <label id="label_razon_social" for="razon_social" class="block text-sm font-medium text-gray-700">Razón social *</label>
              <input type="text" name="razon_social" id="razon_social" placeholder="Materiales para construcción S.A. de C.V." maxlength="70" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" >
              <label id="error_razon_social" name="error_razon_social" class="hidden text-base font-normal text-red-500" >Porfavor ingresar una razón social</label>
            </div>
            <div class="col-span-8 " id="div_representante_legal">
              <label id="label_representante_legal" for="representante_legal" class="block text-sm font-medium text-gray-700">Representante legal </label>
              <input type="text" name="representante_legal" id="representante_legal" placeholder="Nombre" maxlength="40" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" >
              <label id="error_representante_legal" name="error_representante_legal" class="hidden text-base font-normal text-red-500" >Porfavor ingresar un representante legal</label>
            </div>
            <div class="col-span-8">
                <label id="label_domicilio" for="domicilio" class="block text-sm font-medium text-gray-700">Domicilio *</label>
                <input type="text" name="domicilio" id="domicilio" placeholder="Conocido S/N" maxlength="70" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" >
                <label id="error_domicilio" name="error_domicilio" class="hidden text-base font-normal text-red-500" >Porfavor ingresar un domicilio</label>
              </div>
            <div class="col-span-8">
                <label id="label_telefon" for="telefono" class="block text-sm font-medium text-gray-700">Telefono </label>
                <input type="text" name="telefono" id="telefono" placeholder="9519999999" maxlength = "13" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');"  class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" >
                
              </div>
            <div class="col-span-8">
                <label id="label_corre" for="correo" class="block text-sm font-medium text-gray-700" >Correo </label>
                <input type="email" name="correo" id="correo" placeholder="usuario@ejemplo.com" maxlength="30" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" >
                <label id="aviso_correo" name="aviso_correo" class="hidden text-base font-normal text-red-500" >Por favor ingresa un correo válido</label>
              </div>
            <div class="col-span-8">
                <label id="label_numero_padron_contratista" for="numero_padron_contratista" class="block text-sm font-medium text-gray-700">Numero de padron *</label>
                <input type="number" name="numero_padron_contratista" id="numero_padron_contratista" placeholder="100" maxlength = "15" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" >
                <label id="error_numero_padron_contratista" name="error_numero_padron_contratista" class="hidden text-base font-normal text-red-500" >Porfavor ingresar un numero de padron</label>
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
        <button type="submit" id="guardar" name="guardar" class="bg-green-500 text-white active:bg-green-600 font-bold uppercase text-sm px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" >
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
    Swal.fire(
      '¡Eliminado!',
      'El contratista ha sido eliminado.',
      'success'
    )
  </script>
@endif

<script>
  $(".form-eliminar").submit(function(e){ //mensaje advertencia de eliminacion
    e.preventDefault();
    Swal.fire({
      customClass: {
  title: 'swal_title_modificado',
  cancelButton: 'swal_button_cancel_modificado'
},
  title: '¿Seguro que desea eliminar este contratista?',
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

  $('#rfc').on('keyup', function(){ //existe RFC
      rfc = $('#rfc').val();
      //console.log(rfc.length);
      if(rfc.length >= 12){
        var link = '{{ url("/contratistaRfc")}}/'+rfc;
        $.ajax({
              url: link,
              dataType:'json',
              type:'get',
              success: function(data){
                //console.log(data);
                if(data== 1){
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

   $("#modal-id input").keyup(function() {

    if($('#rfc').val().length <= 12){ //validacion de rfc y representante legal
        $("#tipo_rfc").empty();
        $('#tipo_rfc').val('Persona Moral');
        $('#div_representante_legal').removeClass('hidden');
        //$('#representante_legal').removeClass('hidden');
     }else{
        $("#tipo_rfc").empty();
        $('#tipo_rfc').val('Persona Física');
        $('#div_representante_legal').addClass('hidden');
       //$('#representante_legal').addClass('hidden');
     }

      var monto = $(this).val();
      
      if(monto != ''){
      $('#error_'+$(this).attr('id')).addClass('hidden');
      $("#label_"+$(this).attr('id')).removeClass('text-red-500');
      $("#label_"+$(this).attr('id')).addClass('text-gray-700');
      //$('#guardar').removeAttr("disabled");
      }
      else{
      //$("#guardar").attr("disabled", true);
      $('#error_'+$(this).attr('id')).removeClass('hidden');
      $("#label_"+$(this).attr('id')).addClass('text-red-500');
      $("#label_"+$(this).attr('id')).removeClass('text-gray-700');
      }

      if($(this).attr('id')=='correo' && $(this).val() != ''){
        correo= $(this).val();
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        //console.log(regex.test(correo));
        if(regex.test(correo)){
          //console.log('asdasd');
          $('#aviso_'+$(this).attr('id')).fadeOut();
        }else{
          //console.log('bbbb')
          $('#aviso_'+$(this).attr('id')).fadeIn();
        }
      }else{
        $('#aviso_'+$(this).attr('id')).fadeOut();
      }
    
    });

    $("input[name='telefono']").keyup(function() { //validacion de telefono
      if($(this).val()>10){
          telefono = $(this).val();
          telefono= telefono.slice(0,10);
          $(this).val(telefono.replace(/^(\d{3})(\d{3})(\d+)$/, "($1)$2-$3"));
        }
        else{
          $(this).val($(this).val().replace(/^(\d{3})(\d{3})(\d+)$/, "($1)$2-$3"));
        }
      });
});

  //validacion del formulario con el btn guardar
$().ready(function() {
  $("#formulario").validate({
    onfocusout: false,
    onclick: false,
		rules: {
			'rfc': { required: true, minlength: 12, maxlength: 13},
      razon_social: { required: true},
      
      domicilio: { required: true},
      
      
      numero_padron_contratista:{ required: true}
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
  
  $(document).ready(function() { //llamada al datatable
    
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