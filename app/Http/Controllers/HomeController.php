<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use  App\Book;
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
        $this->middleware('auth')->only(['index']);
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

    public function categoryBooksDetail(Request $request){
            $objBook=Book::findBySlugOrFail($request->bookslug);

           /*
            $objCategory=Category::findBySlugOrFail($request->categoryslug);
            $objBook=Book::where('category_id','=',$objCategory->id)->where('slug','=',$request->bookslug)->first();
            $this->notfound($objBook); 
            */
      return view('frontend.categorybooksdetail',compact('objBook'));       

    }
}
