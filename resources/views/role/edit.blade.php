<form action="{{ route('role.update', $role->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div>
        <label for="name">Name</label>
        <input type="text" name="name" class="form-control" value="{{ old('name', $role->name) }}">
        @error('name')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <input type="submit" value="Update" class="btn btn-secondary mt-3">
</form>
