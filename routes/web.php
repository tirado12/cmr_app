<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\AnexosFondoIIIController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ComprometidoDesgloseController;
use App\Http\Controllers\ContratistaController;
use App\Http\Controllers\ContratoArrendamientoController;
use App\Http\Controllers\ContratoFacturasController;
use App\Http\Controllers\ConvenioModificatorio;
use App\Http\Controllers\DesglosePagosObraController;
use App\Http\Controllers\EstimacionController;
use App\Http\Controllers\FacturaController;
use App\Http\Controllers\FuenteClienteController;
use App\Http\Controllers\FuenteFinanciamientoController;
use App\Http\Controllers\GastosIndirectosController;
use App\Http\Controllers\GastosIndirectosFuentesController;
use App\Http\Controllers\IntegrantesCabildoController;
use App\Http\Controllers\LicitacionInvitacionController;
use App\Http\Controllers\ListaRayaController;
use App\Http\Controllers\MidsController;
use App\Http\Controllers\MunicipioController;
use App\Http\Controllers\ObraAdministracionController;
use App\Http\Controllers\ObraContratoController;
use App\Http\Controllers\ObraController;
use App\Http\Controllers\ObraModalidadEjecucionController;
use App\Http\Controllers\ObservacionesDesgloseController;
use App\Http\Controllers\ParteSocialTecnicaController;
use App\Http\Controllers\ProdimCatalogoController;
use App\Http\Controllers\ProdimComprometidoController;
use App\Http\Controllers\ProdimController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\RftController;
use App\Http\Controllers\SispladeController;
use App\Http\Controllers\Usuarios\PerfilController;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\ObrasFuentesController;
use App\Models\GastosIndirectosFuentes;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::resource('users', UsersController::class)->middleware(['auth'])->names('admin.users');
Route::resource('clientes', ClienteController::class)->middleware(['auth'])->except(['getCliente','getUsuario','getUsuarioToken'])->names('clientes');
Route::get('userCliente', [ClienteController::class, 'userCliente']);
Route::get('emailCliente', [ClienteController::class, 'emailCliente']);
Route::resource('comprometidoDesglose', ComprometidoDesgloseController::class)->names('comprometidoDesglose');
Route::resource('contratistas', ContratistaController::class)->middleware(['auth'])->names('contratistas');
Route::resource('contratoArrendamiento', ContratoArrendamientoController::class)->names('contratoArrendamiento');
Route::resource('contratoFacturas', ContratoFacturasController::class)->names('contratoFacturas');
Route::resource('convenioModificatorio', ConvenioModificatorio::class)->names('convenioModificatorio');
Route::resource('desglosePagosObras', DesglosePagosObraController::class)->names('desglosePagosObras');
Route::resource('estimacion', EstimacionController::class)->names('estimacion');
Route::resource('factura', FacturaController::class)->names('factura');
Route::resource('fuenteCliente', FuenteClienteController::class)->except(['getFuentesCliente'])->names('fuenteCliente');
Route::resource('fuenteFinanciamiento', FuenteFinanciamientoController::class)->names('fuenteFinanciamiento');
Route::resource('gastosIndirectos', GastosIndirectosController::class)->names('gastosIndirectos');
Route::resource('gastosIndirectosFuentes', GastosIndirectosFuentesController::class)->except(['getDesgloseGI'])->names('gastosIndirectosFuentes');
Route::resource('integrantes', IntegrantesCabildoController::class)->names('cabildo');
Route::resource('licitacionInvitacion', LicitacionInvitacionController::class)->names('licitacionInvitacion');
Route::resource('listaRaya', ListaRayaController::class)->names('listaRaya');
Route::resource('mids', MidsController::class)->names('mids');
Route::resource('municipio', MunicipioController::class)->middleware(['auth'])->except(['getMunicipio'])->names('municipio');
Route::resource('obraAdministracion', ObraAdministracionController::class)->names('obraAdministracion');
Route::resource('obraContrato', ObraContratoController::class)->names('obraContrato');
Route::resource('obra', ObraController::class)->except(['getObrasCliente','sendMessage','getProdim'])->names('obra');
Route::resource('obraModalidad', ObraModalidadEjecucionController::class)->except(['getObraExpediente'])->names('obraModalidad');
Route::resource('observacionesDesglose', ObservacionesDesgloseController::class)->names('observacionesDesglose');
Route::resource('obrasFuentes', ObrasFuentesController::class)->names('obrasFuentes');
Route::resource('parteSocial', ParteSocialTecnicaController::class)->names('parteSocial');
Route::resource('prodimCatalogo', ProdimCatalogoController::class)->names('prodimCatalogo');
Route::resource('prodimComprometido', ProdimComprometidoController::class)->names('prodimComprometido');
Route::resource('prodim', ProdimController::class)->except(['getDesgloseProdim'])->names('prodim');
Route::resource('proveedor', ProveedorController::class)->middleware(['auth'])->names('proveedor');
Route::resource('rft', RftController::class)->names('rft');
Route::resource('anexos', AnexosFondoIIIController::class)->names('anexos');

//Rutas independientes para el sistema
Route::get('inicio', [GeneralController::class, 'inicio'])->name('inicio');
Route::get('cliente/ver/{id}', [ClienteController::class, 'ver'])->name('cliente.ver');
Route::get('cliente/ejercicio/{id},{anio}', [GeneralController::class, 'ejercicio'])->name('cliente.ejercicio');
Route::get('obra/ver/{id}', [GeneralController::class, 'ver'])->name('obra.ver');
Route::get('obra/create/{id},{anio}', [GeneralController::class, 'create_obra'])->name('create_obra');
Route::post('obra/store_obra', [GeneralController::class, 'store_obra'])->name('store_obra');
Route::post('obra/update', [GeneralController::class, 'update_obra'])->name('update_obra');
Route::get('obra/edit/expediente/{id}', [GeneralController::class, 'edit_expediente'])->name('edit_expediente');
Route::post('obra/update/expediente', [GeneralController::class, 'update_expediente'])->name('update_expediente');
Route::post('obra/create/convenio', [GeneralController::class, 'store_convenio_modificatorio'])->name('create_convenio');
Route::post('obra/update/convenio', [GeneralController::class, 'update_convenio_modificatorio'])->name('update_convenio');
Route::post('obra/create/estimacion', [GeneralController::class, 'store_estimacion'])->name('create_estimacion');
Route::get('obra/show/pagos_obra/{id}', [GeneralController::class, 'show_pagos'])->name('show_pagos');
Route::post('obra/update/observaciones_pagos', [GeneralController::class, 'update_observaciones'])->name('update_observacion');
Route::post('obra/update/pagos_obra', [GeneralController::class, 'update_pagos'])->name('update_pagos');
Route::post('obra/update/estimacion', [GeneralController::class, 'update_estimacion'])->name('update_estimacion');
Route::post('obra/store/lista', [GeneralController::class, 'store_lista'])->name('store_lista');
Route::post('obra/update/lista', [GeneralController::class, 'update_lista'])->name('update_lista');
Route::post('obra/store/factura', [GeneralController::class, 'store_factura'])->name('store_factura');
Route::post('obra/update/factura', [GeneralController::class, 'update_factura'])->name('update_factura');
Route::post('obra/store/contrato', [GeneralController::class, 'store_contrato'])->name('store_contrato');
Route::get('obra/show/contrato/{id},{id_obra}', [GeneralController::class, 'show_contrato'])->name('show_contrato');
Route::post('obra/update/fuenteCliente', [GeneralController::class, 'update_fuente'])->name('update_fuente');
Route::post('obra/store/prodim', [GeneralController::class, 'store_prodim'])->name('store_prodim');
Route::post('obra/store/concepto', [GeneralController::class, 'store_concepto'])->name('store_concepto');
Route::post('obra/update/prodim', [GeneralController::class, 'update_prodim'])->name('update_prodim');
Route::post('obra/store/gi', [GeneralController::class, 'store_gi'])->name('store_gi');
Route::post('obra/update/sisplade', [GeneralController::class, 'update_sisplade'])->name('update_sisplade');
Route::post('obra/update/mids', [GeneralController::class, 'update_mids'])->name('update_mids');

Route::get('/imprimir/{id}', [GeneralController::class, 'imprimir'])->name('print');


Route::resource('sisplade', SispladeController::class)->except(['selectSearch'])->names('sisplade');
Route::resource('perfil', PerfilController::class)->middleware(['auth'])    ->names('perfil');

//========================== consultas ajax =====================================
//sisplade
Route::get('/obtClienteFuente/{ejercicio},{cliente}',[SispladeController::class,'obtenerFuenteCliente']);
Route::get('/existeEnSisplade/{cliente}',[SispladeController::class,'existeEjercicio']);
Route::get('/selectEjercicio/{cliente}',[SispladeController::class,'selectEjercicio']);
//fuentes cliente
Route::get('/ejercicioDisponible/{cliente},{ejercicio},{fuente}',[FuenteClienteController::class,'getEjercicioDisponible']); //existe
//contratista
Route::get('/contratistaRfc/{rfc},{municipio_id}',[ContratistaController::class,'existeRfc']);
//proveedor
Route::get('/proveedorRfc/{rfc},{municipio_id}',[ProveedorController::class,'existeRfcProveedor']);
//integrantes
Route::get('/ejerciciosIntegrantes/{municipio}',[IntegrantesCabildoController::class,'ejerciciosCabildo']); //integrantes cabildo
Route::get('/clienteEjercicio/{id_municipio}',[ClienteController::class,'clienteXejercicio']); //fuentes cliente, integrantes
//gastos indirectos
Route::get('/existeGastoFuente/{fuente_id},{gasto}',[GastosIndirectosFuentesController::class,'existeRegistro']); //ya existe registro
Route::get('/obtenerEjerciciosPorCliente/{municipio}',[GastosIndirectosFuentesController::class,'obtenerEjercicios']); //obtiene ejercicios disponibles por cliente
//prodim comprometido
Route::get('/ejerciciosclientesProdim/{cliente}',[ProdimComprometidoController::class,'ejerciciosClientesProdim']); //obtiene ejercicios - monto total disponibles por cliente en prodim
Route::get('/montoTotalCliente/{prodim}',[ProdimComprometidoController::class,'montoTotalCliente']); //obtiene suma del monto comprometido del prodim seleccionado

Route::get('/ejerciciosProdimComprometido/{cliente}',[ComprometidoDesgloseController::class,'ejerciciosProdimComprometido']); //obtiene ejercicios disponibles por cliente en prodim
//Prodimdf
Route::get('/getEjerciciosCliente/{cliente}',[ProdimController::class,'getEjerciciosCliente']); //obtiene ejercicios por cliente - prodimdf
//gastos indirectos fuentes
Route::get('/montoGastosComprometido/{gasto}',[GastosIndirectosFuentesController::class,'montoGastosComprometido']); //obtiene ejercicios por cliente - prodimdf