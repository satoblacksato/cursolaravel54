<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;
use App\Category;
use Storage;
use File;
use Facades\App\Facades\AlertManager;
use Yajra\Datatables\Facades\Datatables;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('articles.books.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('articles.books.create')->with(['categories'=>Category::pluck('name','id')->toArray()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $this->validate($request,[
                'title'=> "required|min:3|max:50|string",
                'description'=>'required|min:3|max:50|string',
                'category_id'=>'required|numeric',
                'private'=>'required|numeric|in:0,1',
                'image'=>'required|file'
            ]);

         $file=$request->file('image');
         $namefile=time().".".$file->getClientOriginalExtension();

         Storage::disk('books')->put($namefile, File::get($file));
         $objBook=new Book($request->all());
         $objBook->image=$namefile;
         $objBook->user_id=\Auth::user()->id;
         $objBook->save();

                AlertManager::success('Registro guardado correctamente');
       return  redirect()->route('articles.book.index');



    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        $book->category;
        $book->user;
        return response()->json($book);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
       return view('articles.books.edit')->with([
        'book'=>$book,
        'categories'=>Category::pluck('name','id')->toArray()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
         $this->validate($request,[
                'title'=> "required|min:3|max:50|string",
                'description'=>'required|min:3|max:50|string',
                'category_id'=>'required|numeric',
                'private'=>'required|numeric|in:0,1',
                'image'=>'file'
            ]);

         $file=$request->file('image');

        if($file!=null){
             $namefile=time().".".$file->getClientOriginalExtension();
              Storage::disk('books')->delete($book->image);
              Storage::disk('books')->put($namefile, File::get($file));

         $book->image=$namefile;
        }
                
        
         $book->title=$request->title;
         $book->description=$request->description;
         $book->category_id=$request->category_id;
         $book->private=$request->private;
      
         $book->user_id=\Auth::user()->id;
         $book->save();

                AlertManager::success('Registro actualizado correctamente');
       return  redirect()->route('articles.book.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {

        $book->delete();
           AlertManager::success('Registro elimminado correctamente');
       return  redirect()->route('articles.book.index');
    }


public function datatable(Request $request){
    if($request->ajax()){


      return  Datatables::of(
                    Book::where('user_id','=',\Auth::user()->id)
                            ->select('id','title','description')->get()
        )
           ->addColumn('actions', function ($query) {
                return  '<a href="/articles/book/'.$query->id.'/edit"  class="btn btn-primary btn-xs" >EDT</a>&nbsp;<a href="#"
                onclick="viewModal('.$query->id.')"   class="btn btn-warning btn-xs" >VER</a>
                   
                   <form action="/articles/book/'.$query->id.'" method="POST">
                        <input name="_token" type="hidden" value="'.csrf_token().'"/>
                        <input name="_method" type="hidden" value="DELETE"/>
                        <input type="submit" value="DEL" class="btn btn-danger btn-xs"/>
                   </form>

                ';
            })

       ->make(true);



    }else{
        return redirect()->route('articles.book.index');
    }
}
}
