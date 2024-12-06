<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;

class UserController extends Controller  //implements HasMiddleware
{
    // public static function middleware(): array
    // {
        // return [
            // new Middleware('permission:view users',only:['index']),
            // new Middleware('permission:edit users',only:['edit']),
        //     new Middleware('permission:create users',only:['create']),
        //     new Middleware('permission:delete users',only:['destroy'])
        //  ];
        
    // }
    public function index()
    {
        $users = User::all();
        return view('user.list',['users'=>$users]);
    }

    
    public function edit($id)
{
    // Fetch user by ID
    $users = User::find($id);

    // Check if the user exists
    if (!$users) {
        return redirect('/user')->with('error', 'User not found!');
    }

    // Fetch roles (assuming all roles are needed for assignment)
    $roles = Role::all();

    // Return the edit view with the user and roles data
    return view('user.edit', ['user' => $users, 'roles' => $roles]);
}

    public function update(Request $request ,$id)
    {
        
       $validated =  $request->validate([
            'name'=>'required',
            'email'=>'required'
        ]);
         $user = User::find($id)->update($validated);
        //  $user->save();

         

     

        return redirect('/user')->with('message','User updated successfully');
    }

}
