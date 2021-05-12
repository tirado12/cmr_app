<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ContratistaController;
use App\Http\Controllers\ContratoArrendamientoController;
use App\Http\Controllers\ContratoFacturasController;
use App\Http\Controllers\ConvenioModificatorioController;
use App\Http\Controllers\EstimacionController;
use App\Http\Controllers\FacturaController;
use App\Http\Controllers\FuenteClienteController;
use App\Http\Controllers\FuenteFinanciamientoController;
use App\Http\Controllers\IntegranteCabildoController;
use App\Http\Controllers\LicitacionInvitacionController;
use App\Http\Controllers\ListaRayaController;
use App\Http\Controllers\LocalidadController;
use App\Http\Controllers\MunicipioController;
use App\Http\Controllers\ObraAdministracionController;
use App\Http\Controllers\ObraContratoController;
use App\Http\Controllers\ObraController;
use App\Http\Controllers\ObraModalidadEjecucionController;
use App\Http\Controllers\ParteSocialTecnicaController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\Admin\UsersController;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard')->middleware(['auth']);
//->middleware(['auth'])
Route::get('/clientes', function(){
    return view('clientes.index');
});

Route::resource('users', UsersController::class)->names('admin.users')->middleware(['auth', 'can:dashboard']);
require __DIR__.'/auth.php';

Route::resource('clientes', ClienteController::class)->except(['getCliente']);
Route::resource('contratista', ContratistaController::class);
Route::resource('contratoArre', ContratoArrendamientoController::class);
Route::resource('contraroFa', ContratoFacturasController::class);
Route::resource('convenioMo', ConvenioModificatorioController::class);
Route::resource('estimacion', EstimacionController::class);
Route::resource('facturas', FacturaController::class);
Route::resource('fuenteCli', FuenteClienteController::class);
Route::resource('fuenteFinan', FuenteFinanciamientoController::class);
Route::resource('cabildo', IntegranteCabildoController::class);
Route::resource('invitacion', LicitacionInvitacionController::class);
Route::resource('listaRaya', ListaRayaController::class);
Route::resource('localidad', LocalidadController::class);
Route::resource('municipio', MunicipioController::class)->except(['getMunicipio']);
Route::resource('obraAdm', ObraAdministracionController::class);
Route::resource('obraContrato', ObraContratoController::class);
Route::resource('obra', ObraController::class);
Route::resource('obraModalidad', ObraModalidadEjecucionController::class);
Route::resource('parteSocial', ParteSocialTecnicaController::class);
Route::resource('proveedor', ProveedorController::class);


