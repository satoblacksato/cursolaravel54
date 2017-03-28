<?php

namespace App\Http\Controllers\Cruds;

use App\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Facades\App\Facades\AlertManager;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

         $arrRoles=Role::orderBy('name','asc')->where('name','like',"%$request->scope%")->paginate(2);
        return  view('cruds.role.index')->with(['roles'=>$arrRoles,'scope'=>$request->scope]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cruds.role.create');
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
                'name'=> "required|min:3|max:50|string|unique:roles,name",
                'description'=>'required|min:3|max:50|string'
            ]);

        $objRole=new Role;
        $objRole->fill($request->all());
        $objRole->save();
        AlertManager::success('Registro guardado correctamente');
       return  redirect()->route('admin.role.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        return view('cruds.role.show',compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        return view('cruds.role.edit',compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
         $this->validate($request,[
                'name'=> "required|min:3|max:50|string|unique:categories,name,{$role->id},id",
                'description'=>'required|min:3|max:50|string'
            ]);
        $role->fill($request->all());
        $role->save();
        AlertManager::success('Registro actualizado correctamente');
        return  redirect()->route('admin.role.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
          $role->delete();
            AlertManager::success('Registro eliminado correctamente');
            return  redirect()->route('admin.role.index');
    }
}
