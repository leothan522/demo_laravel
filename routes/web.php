<?php

use Illuminate\Support\Facades\Auth;
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
    /* if (Auth::user()){
        return view('welcome');
    }else{
        return redirect()->route('login');
    } */
	return redirect()->route('admin.dashboard');
});

Route::middleware(['auth:sanctum', 'verified', 'user.status'])->get('/dashboard', function () {
    //return view('dashboard');
    return view('welcome');
})->name('welcome');

Route::get('/logout', function () {
    Auth::logout();
    return redirect()->route('login');
})->name('cerrar');

//**************************************** Ruta para  Usuarios Suspendidos
Route::get('/banned', function () {
    Auth::logout();
    return redirect()->route('login')->with('banned', 'Usuario Suspendido');
})->name('banned');


Route::get('/perfil', function () {
    return view('web.index');
})->name('perfil');


//*************************************************** Rutas App Android
Route::middleware('android')->prefix('/android')->group(function (){

    //Plantilla Ogani
    Route::get('/shop/grid/', 'Android\AppController@shopGrid')->name('android.shop_grid');
    Route::get('/shop/details/', 'Android\AppController@shopDetails')->name('android.shop_detail');
    Route::get('/shop/cart/', 'Android\AppController@shopCart')->name('android.shop_cart');
    Route::get('/shop/checkout/', 'Android\AppController@shopCheckout')->name('android.shop_checkout');
    Route::get('/shop/home/', 'Android\AppController@shopHome')->name('android.shop_Home');

    // Rutas APP
    Route::get('/quienes/somos/{id}', 'Android\AppController@quienesSomos')->name('android.quienes_somos');
    Route::get('/ruta/no/definida/{id?}', function () {
        return view('android.prueba');
        //return redirect()->route('android.categorias', Auth::user()->id);
    })->name('android.no_definida');

    //Facturacion y envio
    Route::get('/facturacion-envio/{id}', 'Android\FacturacionController@index')->name('android.facturacion.index');
    Route::post('/facturacion-envio/{id}', 'Android\FacturacionController@update')->name('android.facturacion.update');

    //store
    Route::get('/store/{id}', 'Android\StoreController@index')->name('android.store.index');
    Route::get('/detalles/{id}/{producto}', 'Android\StoreController@detalles')->name('android.detalles');
    Route::get('/favoritos/{id}', 'Android\StoreController@favoritos')->name('android.favoritos');
    Route::get('/carrito/{id}', 'Android\StoreController@carrito')->name('android.carrito');
    Route::post('/carrito/{id}', 'Android\StoreController@guardarPedido')->name('android.carrito.checkout');
    Route::get('/checkout/{id}', 'Android\StoreController@checkout')->name('android.checkout');
    Route::post('/checkout/{id}', 'Android\StoreController@checkoutStore')->name('android.checkout.store');

    //Categorias
    Route::get('/categorias/{id}/', 'Android\CategoriasController@index')->name('android.categorias');
    Route::get('/categorias/{id}/{categoria}', 'Android\CategoriasController@show')->name('android.categorias.show');


    //pedidos
    Route::get('/pedidos/{id}', 'Android\PedidosController@index')->name('android.pedidos');
    Route::get('/pedidos/{id}/{pedido}', 'Android\PedidosController@show')->name('android.pedidos.show');

    //Rutas AJAX
    Route::post('/ajax/favoritos', 'Android\StoreController@ajaxFavoritos')->name('ajax.favoritos');
    Route::post('/ajax/carrito', 'Android\StoreController@ajaxCarrito')->name('ajax.carrito');
    Route::post('/ajax/remover', 'Android\StoreController@ajaxRemover')->name('ajax.remover');


});


//*************************************************** Rutas para web Wordpress
Route::middleware(['auth', 'user.status'])->prefix('/wordpress')->group(function (){

	//Logout
    Route::get('/logout', function () {
        Auth::logout();
        return back();
    })->name('wordpress.logout');

	//store
    Route::get('/store', 'Web\StoreController@index')->name('wordpress.store.index');
    Route::get('/favoritos', 'Web\StoreController@favoritos')->name('wordpress.favoritos');
	Route::get('/categorias/', 'Web\StoreController@categorias')->name('wordpress.categorias');
    Route::get('/categorias/{categoria}', 'Web\StoreController@categoriasShow')->name('wordpress.categorias.show');
	Route::get('/cuenta', 'Web\StoreController@cuentaIndex')->name('wordpress.cuenta.index');
    Route::post('/cuenta', 'Web\StoreController@cuentaUpdate')->name('wordpress.cuenta.update');
	Route::get('/carrito', 'Web\StoreController@carrito')->name('wordpress.carrito');
	Route::get('/pedidos', 'Web\StoreController@pedidosIndex')->name('wordpress.pedidos');
	Route::get('/pedidos/{pedido}', 'Web\StoreController@pedidosShow')->name('wordpress.pedidos.show');

});

