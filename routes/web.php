<?php

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
use App\Facades\Empresa;

//Ruta de inicio al ingresar a la pagina
Route::get('/', function () {
    return view('welcome');
});

//Rutas para login, registrer y recuperar contraseña
Auth::routes();

//Ruta de panel de control, se ingresa cuando ha sido logeado
Route::get('/home', 'HomeController@index');

//Rutas Inventario
Route::group(['middleware' => 'auth', 'prefix' => 'inventario'], function () {
	//Rutas cofiguracion
	Route::group(['prefix' => 'configuracion'], function () {
		Route::resource('Color', 'Inventario\ColorController', ['except'=>['create', 'show']]);
		Route::resource('marca', 'Inventario\MarkController', ['except'=>['create', 'show']]);
		Route::resource('unidad', 'Inventario\UnitMeasureController', ['except'=>['create', 'show']]);
		Route::resource('categoria', 'Inventario\ProductCategoryController', ['only'=>['store']]);
	});
	//Rutas producto
	Route::resource('producto','Inventario\ProductController', ['except' => ['edit', 'destroy']]);
	Route::group(['prefix' => 'producto'], function (){
		Route::post('cbMarca', 'Inventario\ProductController@comboBoxMarca');
		Route::post('cbUnidad', 'Inventario\ProductController@comboBoxUnidad');
		Route::post('cbCategoria', 'Inventario\ProductController@comboBoxCategoria');
		Route::post('cbColor', 'Inventario\ProductController@comboBoxColor');
		Route::put('updateColors/{id}', 'Inventario\ProductController@updateColors');
		Route::resource('imagen', 'Inventario\ProductImageController', ['except'=>['index', 'create', 'edit']]);
	});
	//Rutas Stock
	Route::resource('stock', 'Inventario\StockController', ['only'=>['store', 'update']]);
	//Rutas Envios
	Route::resource('enviosCompras', 'Inventario\EnvioCompraController');
	//Rutas Ingreso a Inventario
	Route::resource('ingreso', 'Inventario\IngresoController');
});

//Rutas Contabilidad
Route::group(['middleware' => 'auth', 'prefix' => 'contabilidad'], function () {
	//Precio
	Route::resource('precio', 'Contabilidad\PrecioProductoController', ['only' => ['store']]);
	Route::group(['prefix' => 'precios'], function (){
		Route::get('menor', 'Contabilidad\PrecioProductoController@precioPorMenor');
		Route::get('mayor', 'Contabilidad\PrecioProductoController@precioPorMayor');
	});
	//Configuracion
	Route::get('configuracion', function () {
		return view('contabilidad.configuracion.configuracion', ['empresa' => Empresa::get()]);
	});
	Route::group(['prefix' => 'configuracion'], function (){
		Route::resource('retencionIVA', 'Contabilidad\Configuracion\PorcentajeIVA', ['except'=>['create', 'show']]);
		Route::resource('retencionRenta', 'Contabilidad\Configuracion\PorcentajeRenta', ['except'=>['create', 'show']]);
		Route::resource('CtaXPagar', 'Contabilidad\Configuracion\CtaXPagar', ['except'=>['create', 'show', 'destroy']]);
		Route::resource('clsPagos', 'Contabilidad\Configuracion\clsPagosController', ['except' => ['create', 'show', 'destroy']]);
	});
	//Proveedores
	Route::resource('proveedores', 'Contabilidad\ProveedoresController', ['except'=>['create', 'show', 'destroy']]);
	Route::group(['prefix' => 'proveedores'], function (){
		Route::resource('producto', 'Contabilidad\ProductoProveedorControlller', ['only'=>['store', 'show', 'destroy']]);
		Route::resource('contacto', 'Contabilidad\ContactoProveedorController', ['only'=>['store', 'show', 'destroy']]);
	});
	//Compras
	Route::resource('compras', 'Contabilidad\ComprasController');
});

//Rutas de Configuracion General
Route::group(['middleware' => 'auth', 'prefix' => 'configuracion'], function (){
	Route::resource('sucursal', 'Configuracion\SucursalController', ['except'=>['create', 'show']]);
	Route::resource('empresa', 'EmpresaController', ['only'=>['update']]);
});
