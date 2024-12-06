
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>Permission</title>
</head>
<body>
    
</body>
</html>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Permission/update') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('update.user',$user->id) }}" method="POST">
                        @csrf
                        {{-- @method('PUT') --}}
                        <div>
                           <label for="name">Name</label> 
                           <input type="text" name="name" class="form-control" value="{{ old('name'),$user->name }}">@error('name')
                               <div class="text-danger">{{ $message }}</div>
                           @enderror
                        </div>
                        <div>
                            <label for="email">Email</label> 
                            <input type="text" name="email" class="form-control" value="{{ old('email'),$user->email }}">@error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                         </div>
                         <div class="d-flex flex-wrap">
                            @forelse ($roles as $role)
                                <div class="form-check me-3 mb-2">
                                    <input 
                                        type="checkbox" 
                                        name="role[]" 
                                        id="role-{{ $role->id }}" 
                                        class="form-check-input" 
                                        value="{{ $role->name }}" 
                                        {{ is_array(old('role')) && in_array($role->name, old('role')) ? 'checked' : '' }}>
                                    <label for="role-{{ $role->id }}" class="form-check-label">
                                        {{ ucfirst($role->name) }}
                                    </label>
                                </div>
                            @empty
                                <p class="text-muted">No role available.</p>
                            @endforelse
                        </div>
                        <input type="submit" value="Update" class="btn btn-secondary mt-3">
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
