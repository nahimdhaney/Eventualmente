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

Route::resource('/','EntradaController');

Route::get('/crearentrada', function () {
    return view('crearentrada');
});

Route::resource('/home','EntradaController');
Route::post('/registrarme','RegistroController@crear');
Route::resource('/categorias','CategoriaController');
Route::get('/verCategoria/{id}','CategoriaController@verCategoria');
Route::get('/gestionarEvento/{id}','EntradaController@gestionarEvento');
Route::post('pagar','EntradaController@pagar');
Route::get('pagar', function()
{
    return view('pagar');
});

//Route::get('/home', function () {
//    return view('home');
//});

// Route::get('/agregar/{titulo}/{desc}','NotaController@agregar');

//    public function verMisEventos()
//    public function verEvento($id)
//    public function verEventosRegistrados()


//Route::get('/miseventos', function () {
//    return view('miseventos');
//});

//Route::get('/crearevento', function () {
//    return view('crearevento');
//});

Route::resource('/crearevento', 'EventoController');
Route::get('/editarEvento/{id}','EventoController@editarEvento');
Route::get('/EliminarEvento/{id}','EventoController@eliminarEvento');

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::post('agregar','EventoController@crear');
Route::post('editar','EventoController@editar');
Route::post('eliminar','EntradaController@eliminar');
Route::get('agregar', function()
{
    return view('crearevento');
});

Auth::routes();
Route::resource('/home2', 'UsuarioController@indice');
Route::resource('/nuevoEvento', 'EventoController@create');
//Route::get('/categorias','CategoriaController');

Route::get('/miseventos','EventoController@verMisEventos');
Route::get('/editarEventos','EventoController@EditarMisEventos');

Route::get('/verEvento/{id}','EventoController@verEvento');

Route::get('/eventosregistrados','EventoController@verEventosRegistrados');

// Route::get('/home', 'HomeController@index')->name('home');