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
                    <form action="{{ route('permission.update', $permission->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div>
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name', $permission->name) }}">
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <input type="submit" value="Update" class="btn btn-secondary mt-3">
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
