<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PruebaController extends Controller
{
    public function getSaludo(){
    	return "Hola usuario, la hora es: ".date('H:i:s');
    }

    public function getUpper(Request $objRequest){
    	return strtoupper($objRequest->palabra);
    }

    public function getVista(){
    	//return view('practica.simple');

    /*	$array=[1,2,3,4,5,6,7,8,9,0];

    	return view('practica.parametros')
    	->with(['title'=>'Es un titulo','description'=>'La descripcion','array'=>$array,'flag'=>false]);*/

    	return view('practica.importaciones')->with(['title'=>'Trabajando con componentes']);

    	return view('practica.heredero');
    }
}
