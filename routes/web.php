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
use App\Http\Controllers\IntegranteCabildoController;
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
Route::resource('integranteCabildo', IntegranteCabildoController::class)->names('integranteCabildo');
Route::resource('licitacionInvitacion', LicitacionInvitacionController::class)->names('licitacionInvitacion');
Route::resource('listaRaya', ListaRayaController::class)->names('listaRaya');
Route::resource('mids', MidsController::class)->names('mids');
Route::resource('municipio', MunicipioController::class)->except(['getMunicipio'])->names('municipio');
Route::resource('obraAdministracion', ObraAdministracionController::class)->names('obraAdministracion');
Route::resource('obraContrato', ObraContratoController::class)->names('obraContrato');
Route::resource('obra', ObraController::class)->except(['getObrasCliente','sendMessage','getProdim'])->names('obra');
Route::resource('obraModalidad', ObraModalidadEjecucionController::class)->except(['getObraExpediente'])->names('obraModalidad');
Route::resource('observacionesDesglose', ObservacionesDesgloseController::class)->names('observacionesDesglose');
Route::resource('parteSocial', ParteSocialTecnicaController::class)->names('parteSocial');
Route::resource('prodimCatalogo', ProdimCatalogoController::class)->names('prodimCatalogo');
Route::resource('prodimComprometido', ProdimComprometidoController::class)->names('prodimComprometido');
Route::resource('prodim', ProdimController::class)->except(['getDesgloseProdim'])->names('prodim');
Route::resource('proveedor', ProveedorController::class)->names('proveedor');
Route::resource('rft', RftController::class)->names('rft');
Route::resource('sisplade', SispladeController::class)->names('sisplade');