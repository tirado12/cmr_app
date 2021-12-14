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
Route::resource('obraModalidad', ObraModalidadEjecucionController::class)->except(['getObraExpediente'])->names('obraModalidad');
Route::resource('observacionesDesglose', ObservacionesDesgloseController::class)->names('observacionesDesglose');
Route::resource('obrasFuentes', ObrasFuentesController::class)->names('obrasFuentes');
Route::resource('parteSocial', ParteSocialTecnicaController::class)->names('parteSocial');
Route::resource('prodimCatalogo', ProdimCatalogoController::class)->names('prodimCatalogo');
Route::resource('prodimComprometido', ProdimComprometidoController::class)->names('prodimComprometido');
Route::resource('prodim', ProdimController::class)->except(['getDesgloseProdim'])->names('prodim');
Route::resource('proveedor', ProveedorController::class)->names('proveedor');
Route::resource('rft', RftController::class)->names('rft');
Route::resource('anexos', AnexosFondoIIIController::class)->names('anexos');

//Rutas independientes para el sistema
Route::get('inicio', [GeneralController::class, 'inicio'])->name('inicio');
Route::get('cliente/ver/{id}', [ClienteController::class, 'ver'])->name('cliente.ver');
Route::get('cliente/ejercicio/{id},{anio}', [GeneralController::class, 'ejercicio'])->name('cliente.ejercicio');
Route::get('obra/ver/{id}', [ClienteController::class, 'ver'])->name('cliente.ver');

Route::resource('sisplade', SispladeController::class)->except(['selectSearch'])->names('sisplade');
Route::resource('perfil', PerfilController::class)->names('perfil');

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