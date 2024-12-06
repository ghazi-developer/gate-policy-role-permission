<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>Create Role</title>
</head>
<body>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Role') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="card shadow-sm">
                <div class="card-body">
                    <!-- Role Creation Form -->
                    <form action="{{ route('roles.index') }}" method="POST">
                        @csrf
                        
                        <!-- Role Name -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Role Name <span class="text-danger">*</span></label>
                            <input 
                                type="text" 
                                name="name" 
                                id="name" 
                                class="form-control @error('name') is-invalid @enderror" 
                                value="{{ old('name') }}" 
                                placeholder="Enter role name" 
                                required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- Permissions -->
                        <div class="mb-3">
                            <label for="permissions" class="form-label">Assign Permissions</label>
                            <div class="d-flex flex-wrap">
                                @forelse ($permissions as $permission)
                                    <div class="form-check me-3 mb-2">
                                        <input 
                                            type="checkbox" 
                                            name="permission[]" 
                                            id="permission-{{ $permission->id }}" 
                                            class="form-check-input" 
                                            value="{{ $permission->name }}" 
                                            {{ is_array(old('permission')) && in_array($permission->name, old('permission')) ? 'checked' : '' }}>
                                        <label for="permission-{{ $permission->id }}" class="form-check-label">
                                            {{ ucfirst($permission->name) }}
                                        </label>
                                    </div>
                                @empty
                                    <p class="text-muted">No permissions available.</p>
                                @endforelse
                            </div>
                        </div>
                        
                        <!-- Submit Button -->
                        <div>
                            <button type="submit" class="btn btn-primary">Create Role</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
</body>
</html>
