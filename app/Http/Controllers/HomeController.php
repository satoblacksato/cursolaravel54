<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use  App\Book;
use App\CategoryUser;
use Auth;
use Mail;
use DB;
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

    public function suscriptionCategory(Request $request){
        if($request->ajax()){
                
                $this->validate($request,[
                    'category'=>'required|numeric'
                ]);


                $objUser=Auth::user();
                $objCategoryUser=$objUser->user_categories()->where('category_id','=',$request->category)->first();
                if($objCategoryUser==null){
                    $objCategoryUser=new CategoryUser();
                    $objCategoryUser->user()->associate($objUser->id);
                    $objCategoryUser->category()->associate($request->category);
                    $objCategoryUser->save();

                    return response()->json(['status'=>'success','data'=>'suscripcion correcta!!','action'=>'remover'],200);
                }else{
                     $objCategoryUser->delete();
                     return response()->json(['status'=>'success','data'=>'el usuario quito la suscripcion correctamente','action'=>'add'],200);
                }              

        }else{
            abort(401);
        }
    }


    public function sendEmailContact(Request $request){
        $this->validate($request,[
                    'nombres'=>'required',
                    'email'=>"required|email",
                    "telefonos"=>"required|numeric",
                    "mensaje"=>"required"
                ]);


    Mail::send('emails.sendcontact', ['request'=>$request->all()], function ($message) {
        $message->to(env('MAIL_ADMIN'));
        $message->subject('Contacto');
        $message->priority(1);
    });
        return redirect()->route('welcome');
    }


    public function report(Request $request){
          if($request->ajax()){
                
                $this->validate($request,[
                    'desde'=>'required|date',
                    'hasta'=>'required|date'
                ]);


                /*
select `categories`.`name`, count(*) as total from `books` inner join `categories` on `categories`.`id` = `books`.`category_id` where `books`.`created_at` between' 2017-03-01 00:00:00' and '2017-03-29 23:59:59' and `books`.`deleted_at` is null group by `categories`.`name` 
                */

                $collection=Book::join('categories','categories.id','=','books.category_id')
                ->select('categories.name',DB::raw('count(*) as total'))
                ->whereBetween('books.created_at',[$request->desde.' 00:00:00', $request->hasta.' 23:59:59'])
                ->groupBy('categories.name')->get();


                $arrayTemp=[];

                foreach ($collection as $value) {
                    $arrayTemp[]=[$value->name,$value->total];
                }
               
                 return response()->json(['status'=>'success','data'=>$arrayTemp],200);
            }else{
                abort(401);
            }
    }
}
