<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;



class RoleController extends Controller
{
    //  public function __construct()
    //  {
    //          $this->middleware(['permission:role list'])->only('index');
    //          $this->middleware(['permission:role create'])->only('store');
    //          $this->middleware(['permission:role edit'])->only('update');
    //          $this->middleware(['permission:role show'])->only('show');
    //          $this->middleware(['permission:role delete'])->only('destroy');
    //  }

    public function index($id=null)  
    {
        $roles = Role::with('permissions')->get();
        return response()->json($roles);
   }


   public function store(Request $request) 
   {
     
        $role =  Role::create(['name' => $request->name]);
        $role->syncPermissions($request->permissions);
        return response()->json($role);
   }

   public function show($id)  
   { 
        $role = Role::with('permissions')->find($id);
        return response()->json($role);
   }

   public function update(Request $request, $id)  
   { 
        $role = Role::find($id);
        $role->update(['name' => $request->name  ]);
        $role->syncPermissions($request->permissions);
        return response()->json($role);
   }


   public function destroy(Role $role)  
    {
        $role->delete();
        return response()->json('delete success');
   }


}