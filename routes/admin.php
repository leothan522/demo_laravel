<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['auth', 'user.status', 'isadmin'])->prefix('/admin')->group(function (){

    Route::get('/', 'Admin\DashboardController@index')->name('admin.dashboard');

    Route::middleware('user.permisos')->group(function (){

        //Usuarios
        Route::resource('/usuarios', 'Admin\UsersController');
        Route::get('/usuarios/rol/{role}', 'Admin\UsersController@role')->name('usuarios.role');

        //Clientes
        Route::resource('/clientes', 'Admin\ClientesController');

        //Categorias
        Route::resource('/categorias', 'Admin\CategoriasController');
        Route::get('/categorias/modulo/{modulo}', 'Admin\CategoriasController@modulo')->name('categorias.modulo');

        //Productos
        Route::resource('/productos', 'Admin\ProductosController');
        Route::post('/productos/{id}/galeria/add', 'Admin\ProductosController@galeriaAdd')->name('productos.galeria_add');
        Route::get('/productos/{id}/galeria/{gid}/delete', 'Admin\ProductosController@galeriaDelete')->name('productos.galeria_delete');
        Route::post('/productos/acciones/lote', 'Admin\ProductosController@accionesLote')->name('productos.acciones_lote');
        Route::post('/productos/acciones/filtrar', 'Admin\ProductosController@filtrar')->name('productos.filtrar');
        Route::get('/productos/ver/{estado}/productos', 'Admin\ProductosController@ver')->name('productos.ver');
        Route::post('/productos/{id}/precio/add', 'Admin\ProductosController@precioAdd')->name('productos.precio_add');
        Route::get('/productos/{id}/precio/{pid}/delete', 'Admin\ProductosController@precioDelete')->name('productos.precio_delete');

        //Pedidos
        Route::resource('/pedidos', 'Admin\PedidosController');
        Route::get('/pedidos/ver/{estado}/pedidos', 'Admin\PedidosController@ver')->name('pedidos.ver');
        Route::post('/pedidos/acciones/lote', 'Admin\PedidosController@accionesLote')->name('pedidos.acciones_lote');
        Route::post('/pedidos/acciones/filtrar', 'Admin\PedidosController@filtrar')->name('pedidos.filtrar');
        Route::get('/pedidos/generar/pdf/{id}', 'Admin\PedidosController@generarPDF')->name('pedidos.pdf');


        //Ajustes
        Route::get('/ajustes', 'Admin\AjustesController@index')->name('ajustes.index');
        Route::post('/ajustes', 'Admin\AjustesController@store')->name('ajustes.store');
        Route::post('/zonas', 'Admin\AjustesController@zonas')->name('ajustes.zonas');
        Route::put('/zonas/{id}/edit', 'Admin\AjustesController@zonasUpdate')->name('ajustes.zonas.update');
        Route::delete('/zonas/{id}/destroy', 'Admin\AjustesController@zonaDelete')->name('ajustes.zonas.delete');
        Route::post('/metodos', 'Admin\AjustesController@metodosPago')->name('ajustes.mpago');
        Route::put('/metodos/{id}/edit', 'Admin\AjustesController@metodosPagoUpdate')->name('ajustes.mpago.update');
        Route::delete('/metodos/{id}/destroy', 'Admin\AjustesController@metodosPagoDestroy')->name('ajustes.mpago.destroy');

        //Store Hours
        Route::get('/horarios', 'Admin\StoreHoursController@index')->name('horarios.index');
        Route::post('/horarios', 'Admin\StoreHoursController@store')->name('horarios.store');

        //Rutas AJAX
        Route::post('/ajax/metodos', 'Admin\AjustesController@ajaxMetodos')->name('ajax.mpago');



    });

});
