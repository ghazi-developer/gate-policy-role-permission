<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Gate;

class RoleController extends Controller  
{

    // public static function middleware(): array
    // {
    //     return [
    //         new Middleware('permission:view roles',only:['index']),
    //         new Middleware('permission:edit roles',only:['edit']),
    //         new Middleware('permission:create roles',only:['create']),
    //         new Middleware('permission:delete roles',only:['destroy'])
    //     ];
    // }


    public function index()
{
        // The user has the 'isAdmins' role
        // if (Gate::allows('isZohair')) {
        //     // The user has the 'isAdmins' role
        //     $users = User::with('roles')->get();
        //     $roles = Role::all();
        
        //     return view('role.list', compact('users', 'roles'));
        // } else {
        //     // The user does not have the 'isAdmins' role
        //     return "access denied";
        // }
        
    // Eager load the roles along with users
   
}

    /**
     * Display a listing of roles.
   
    

 
     * Show the form for creating a new role.
     */
    public function create()
    {
        $permissions = Permission::orderBy('name')->get(); // Simplified query
        return view('role.create', compact('permissions')); // Used `compact` for simplicity
    }

    /**
     * Store a newly created role in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'name' => 'required|string|min:3|max:255|unique:roles,name',
            'permission' => 'nullable|array', // `nullable` in case no permissions are selected
            'permission.*' => 'exists:permissions,name', // Each permission must exist
        ]);

        // Create the role
        $role = Role::create(['name' => $validated['name']]);

        // Assign permissions to the role if provided
        if (!empty($validated['permission'])) {
            $role->syncPermissions($validated['permission']);
        }

        // Redirect with a success message
        return redirect()->route('roles.index')->with('message', 'Role created successfully!');
    }


    public function edit($id)
    {
        // Fetch the role by its ID
        $role = Role::findOrFail($id);
    
        // Pass the role to the view
        return view('role.edit', compact('role'));
    }
    


    public function update(Request $request,$id)
    {
        $validated = $request->validate([
            'name' => 'required|string|min:3|max:255|unique:roles,name',
            'permission' => 'nullable|array', // `nullable` in case no permissions are selected
            'permission.*' => 'exists:permissions,name', // Each permission must exist
        ]);

        Role::find($id)->update($validated);

        return redirect('/roles')->with('message','Roles Updated Succeefully');
    }


    public function destroy($id)
    {
        Role::destroy($id);
        return redirect('/roles');
    }
}
