<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Spatie\Permission\Models\Role;

class UserController extends Controller implements HasMiddleware
{

    public static function middleware(): array
    {
        return [
            new Middleware('permission:user list', only: ['index']),
            new Middleware('permission:user create', only: ['store', 'update']),
            new Middleware('permission:user show', only: ['show']),
            new Middleware('permission:user delete', only: ['destroy']),
        ];
    }
 



    public function index($id = null)
    {
        $users = User::with(['roles', 'permissions'])->get();
        return response()->json($users);
    }


    public function store(Request $request)
    {
        $request->validate([
             'name' => 'required',
             'email' => 'required|email',
             'password' => 'required|min:6|max:14',
             'confirm_password' => 'required|same:password',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ]);
        $role = Role::whereIn('id', $request->role)->get();
        $user->syncRoles($role);
        return response()->json($user);
    }
    public function show($id)
    {

        $user = User::with('roles', 'permissions')->find($id);
        $permissions = $user->getAllPermissions()->pluck('name');
        return response()->json(['user' => $user, 'permissions' => $permissions]);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        if ($request->password !== null) {
            $user->password = bcrypt($request->password);
            $user->save();
        }
        $user->syncRoles($request->role);

        return response()->json($user);
    }


    public function destroy(Request $request, $id)
    {
        $user = User::find($id);
        $user->delete();
        return response()->json("delete Successfully");
    }
}
