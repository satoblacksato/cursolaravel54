<?php

namespace App\Http\Controllers\Cruds;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use Facades\App\Facades\AlertManager;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $arrCategories=Category::orderBy('name','asc')->where('name','like',"%$request->scope%")->paginate(2);
        return  view('cruds.category.index')->with(['categories'=>$arrCategories,'scope'=>$request->scope]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        return  view('cruds.category.create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {

       $objCategory=New Category();
       $objCategory->fill($request->all());
       $objCategory->save();
       AlertManager::success('Registro guardado correctamente');
       return  redirect()->route('admin.category.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view('cruds.category.show',compact(['category']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    public function edit(Category $category)
    {
       //return view('cruds.category.edit',compact(['category']));
       return view('cruds.category.edit')->with(['category'=>$category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
           $this->validate($request,[
                'name'=> "required|min:3|max:50|string|unique:categories,name,{$category->id},id,deleted_at,NULL",
                'description'=>'required|min:3|max:50|string'
            ]);
        $category->fill($request->all());
        $category->save();
        AlertManager::success('Registro actualizado correctamente');
        return  redirect()->route('admin.category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
            $category->delete();
            AlertManager::success('Registro eliminado correctamente');
            return  redirect()->route('admin.category.index');
    }
}
