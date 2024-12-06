<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>Roles and Permissions</title>
</head>
<body>
<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Roles and Permissions') }}
            </h2>
            <a href="{{ route('roles.create') }}" class="btn btn-secondary">Create Roles</a>
        </div>
    </x-slot>

    <div class="py-12">
        <!-- Display Success Message -->
        @if (session()->has('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
        @endif

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Roles and Permissions Table -->
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Role Name</th>
                                <th>Permissions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($roles as $singleRole)
                            <tr>
                                <td>{{ $singleRole->id }}</td>
                                <td>{{ $singleRole->name }}</td>
                                @foreach ( $singleRole->permissions as $permission )
                                    <td>{{ $permission->name }}</td>
                                    
                                @endforeach
                                <td><a href="{{ route('edit.role', $singleRole->id) }}" class="btn btn-primary">Edit</a></td>
                                <td>
                                    <form action="{{ route('delete.roles',$singleRole->id) }}" method="POST">
                                        @csrf
                                        @method('delete')
                        
                                        <input type="submit" class="btn btn-danger" value="Delele">
                                    </form>
{{--                                    
                                        <ul>
                                            @foreach ($singleRole->permissions as $permission)
                                                
                                        <li>{{ $permission->name }}</li>
                                                
                                            @endforeach
                                        </ul>
                                         --}}
                                    {{-- @else --}}
                                        {{-- <span class="text-muted">No permissions assigned</span>
                                    @endif --}}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center text-muted">No roles found.</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
</body>
</html>
