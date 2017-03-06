<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['welcome','categoryBooks']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }


    public function welcome(){
        $categories=\App\Category::all();
        return view('welcome',compact('categories'));
    }

    public function categoryBooks(Request $request){
        $objCategory=Category::findBySlugOrFail($request->slug);
        $privates=[];
        $publics=[];

            $scope=$request->scope;
            $books=$objCategory->books()->where('title','LIKE',"%$scope%")->get();
            
           if (Auth::guest()){
//                $arrayData['public']=$objCategory->books->where('private','=',false);
                $publics=$books->reject->private;
           }else{
            list($privates,$publics)=$books->partition('private');
           }

        return view('frontend.categorybooks',compact('objCategory','publics','privates','scope'));
    }
}
