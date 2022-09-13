<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UsersController;
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
use App\Http\Controllers\GeneralController;

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

Route::resource('users', UsersController::class)->names('admin.users');
Route::resource('clientes', ClienteController::class)->except(['getCliente','getUsuario','getUsuarioToken'])->names('clientes');
Route::get('userCliente', [ClienteController::class, 'userCliente']);
Route::get('emailCliente', [ClienteController::class, 'emailCliente']);
Route::resource('comprometidoDesglose', ComprometidoDesgloseController::class)->names('comprometidoDesglose');
Route::resource('contratistas', ContratistaController::class)->names('contratistas');
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
Route::resource('municipio', MunicipioController::class)->except(['getMunicipio'])->names('municipio');
Route::resource('obraAdministracion', ObraAdministracionController::class)->names('obraAdministracion');
Route::resource('obraContrato', ObraContratoController::class)->names('obraContrato');
Route::resource('obra', ObraController::class)->except(['getObrasCliente','sendMessage','getProdim'])->names('obra');
Route::get('magic', [ObraController::class, 'magic']);
Route::resource('obraModalidad', ObraModalidadEjecucionController::class)->except(['getObraExpediente'])->names('obraModalidad');
Route::resource('observacionesDesglose', ObservacionesDesgloseController::class)->names('observacionesDesglose');
Route::resource('parteSocial', ParteSocialTecnicaController::class)->names('parteSocial');
Route::resource('prodimCatalogo', ProdimCatalogoController::class)->names('prodimCatalogo');
Route::resource('prodimComprometido', ProdimComprometidoController::class)->names('prodimComprometido');
Route::resource('prodim', ProdimController::class)->except(['getDesgloseProdim'])->names('prodim');
Route::resource('proveedor', ProveedorController::class)->names('proveedor');
Route::resource('rft', RftController::class)->names('rft');
Route::resource('sisplade', SispladeController::class)->names('sisplade');

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
Route::get('/autocomplete/{ejercicio},{cliente}',[SispladeController::class,'selectSearch']);
Route::get('/selectEjercicio/{cliente}',[SispladeController::class,'selectEjercicio']);
Route::get('/fuentesClientes/{ejercicio},{cliente},{fuente}',[SispladeController::class,'fuentesClientes']);
