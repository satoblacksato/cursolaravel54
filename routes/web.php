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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');


//PRACTICA DE RUTAS
Route::get('/saludo',function(){
	return "Hola mundo";
});

Route::get('/mensaje/{nombre}/{apellido}/{id}',function($nombre,$apellido,$id){
	return "los datos ingresados $nombre $apellido $id";
});

Route::get('/potencia/{base}/{exponente?}',function($base,$exponente=2){
	return pow($base, $exponente);
});


Route::get('/numero/{id}/{id2}',function($id,$id2){
	return pow(3, $id);
})->where(['id'=>'[0-9]+','id2'=>'[5]+']);


Route::get('/slug/{accion}/{num}',function($accion,$num){
	switch ($accion) {
		case 'potencia':
			return pow(3, $num);
			break;
		
		case 'suma':
			return 4+$num;
			break;
	}
})->where(['num'=>'[0-9]+','accion'=>'potencia|suma']);



/*

Route::get('/datos/{id}',function($id){
	return "numero $id";
})->where(['id'=>'[0-9]+']);

Route::get('/datos/{id}',function($id){
	return "hola mundo";
})->where(['id'=>'hola']);

Route::get('/datos/{id}',function($id){
	return "hola tu parametro fue ".$id;
})->where(['id'=>'[-\w]+']);

*/


Route::get('/horario',function(){
	return date('Y-m-d H:i:s');
})->name('hora');



Route::group(['prefix'=>'filtros'],function(){
	Route::get('/datos/{id}',function($id){
		return "numero $id";
	})->where(['id'=>'[0-9]+']);

	Route::get('/datos/{id}',function($id){
		return "hola mundo";
	})->where(['id'=>'hola']);

	Route::get('/datos/{id}',function($id){
		return "hola tu parametro fue ".$id;
	})->where(['id'=>'[-\w]+']);
});



Route::get('/saludo', 'PruebaController@getSaludo')->name('saludo');
Route::get('/mayuscula/{palabra}', 'PruebaController@getUpper')->name('mayuscula');




/*
resource para todos los metodos
*/
//Route::resource('resource','ResourceController');


/*
resource exclusivo
*/
//Route::resource('resource','ResourceController',['only'=>'index']);


/*
Resource except
*/
//Route::resource('resource','ResourceController',['except'=>'index']);






Route::get('/vista-simple', 'PruebaController@getVista')->name('vistasimple');



/*
INICIO DEL PROYECTO
*/

Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

Route::group(['prefix'=>'admin' , 'as'=>'admin.','middleware' => ['auth']],function(){
	Route::resource('role','Cruds\RoleController');
	Route::resource('category','Cruds\CategoryController');
});