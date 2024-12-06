
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
            {{ __('Article') }}
        </h2>
        <div class="d-flex justify-end">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           <a href="{{ route('create.article') }}" class="btn btn-secondary">Create Article</a>
        </h2>
    </div>
    </x-slot>

    <div class="py-12">
        @if (session()->has('message'))
            <div class="alert alert-success">{{ session()->get('message') }}</div>
        @endif
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">      
                </div>
            </div>
            <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Title</th>
      <th scope="col">Description</th>
      <th scope="col">Author</th>
      
    </tr>
  </thead>
  <tbody>

    @foreach ($articles as $article)
    <tr>
        <td>{{ $article->id }}</td>
        <td>{{ $article->title}}</td>
        <td>{{ $article->description }}</td>
        <td>{{ $article->author }}</td>
        <td><a href="{{ route('edit.article', $article->id) }}" class="btn btn-primary">Edit</a></td>
        <th>
        <td>
            <form action="{{ route('article.delete',$article->id) }}" method="POST">
                @csrf
                @method('delete')

                <input type="submit" class="btn btn-danger" value="Delele">
            </form>
        </td> 
    </tr>
@endforeach
  </tbody>
</table>
        </div>
    </div>
</x-app-layout>
