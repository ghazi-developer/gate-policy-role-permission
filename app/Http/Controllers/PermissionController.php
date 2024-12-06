<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Validator;
use function PHPUnit\Framework\returnSelf;
use Spatie\Permission\Commands\CreateRole;

use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;

class PermissionController extends Controller //implements HasMiddleware
{

    // public static function middleware(): array
    // {
    //     return [
    //         new Middleware('permission:view permission',only:['index']),
    //         new Middleware('permission:edit permission',only:['edit']),
    //         new Middleware('permission:create permission',only:['create']),
    //         new Middleware('permission:delete permission',only:['destroy'])
    //     ];
    // }
    public function index()

    {
        $permissions = Permission::all();
        return view('permission.list',['permissions'=>$permissions]);
    }

    public function create()
    {
        return view('permission.create');
    }

    public function store(Request $request)
    {
         $request->validate([
            'name'=>'required|unique:permissions'
        ]);

          
        Permission::create(['name'=>$request->name]);

        return redirect('/permission/added')->with('message','Permission Created Successfully');
        
        }



        public function delete($id)
        {
            Permission::destroy($id);
           return redirect('/permission/added');
        }
        
        public function update(Request $request,$id)
        {
           $validate= $request->validate([
                'name'=>'required'
            ]);

            Permission::find($id)->update($validate);

            return redirect('/permission/added')->with('message','Data updated Successsfuly');
        }

        public function edit($id)
        {
            $permission = Permission::find($id);
            // dd($permission);
        
            // Check if permission exists
            if (!$permission) {
                return redirect()->route('permit')->with('error', 'Permission not found.');
            }
        
            // Pass the permission object to the view
            return view('permission.edit', compact('permission'));
      
}
}

