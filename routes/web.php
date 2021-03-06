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



Route::post('/emailcontact','HomeController@sendEmailContact')->name('emailcontact');

Route::get('/sendmail',function(){

	Mail::send('emails.emailsuscripcion', ['user'=>'usuario parametro'], function ($message) {
	    $message->to(env('MAIL_ADMIN'));
	    $message->subject('test email');
	    $message->priority(4);
	    $message->attach('C:/laragon/www/cursolaravel/public/img/city.jpg');
	});
	return "ENVIO EXITOSO";

});

Route::get('/sendmark',function(){
	Mail::to(env('MAIL_ADMIN'))->send(new App\Mail\UserRegisterMark(App\User::find(3)));
});



Route::get('/','HomeController@welcome')->name('welcome');



Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('category-books/{slug}','HomeController@categoryBooks')->name('categorybook');
Route::get('category-books/{categoryslug}/{bookslug}','HomeController@categoryBooksDetail')->name('categorybookdetail');


Route::group(['middleware' => ['auth']],function(){
Route::post('suscription-category' , 'HomeController@suscriptionCategory');
});

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


Route::group(['middleware'=>['auth','check-admin']],function(){
		
		Route::group(['middleware'=>['check-day:6-0-1']],function(){
			Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
		});

			Route::group(['prefix'=>'admin' , 'as'=>'admin.'],function(){
				Route::resource('role','Cruds\RoleController');
				Route::resource('category','Cruds\CategoryController');
			});

});







Route::group(['prefix'=>'articles' , 'as'=>'articles.','middleware' => ['auth']],function(){

	Route::resource('book','BookController');
	Route::get('book-datatable','BookController@datatable');

	

});


Route::group(['middleware' => ['auth']],function(){

Route::post('report','HomeController@report');
});

Route::get('books/{file}', function ($file = null) { 
 	$url = storage_path() . "/app/public/books/{$file}"; 
 	if (file_exists($url)) {
 		return Response::download($url);
 	}
});



