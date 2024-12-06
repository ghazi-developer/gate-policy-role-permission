<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Support\Facades\Redis;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Gate;

class ArticleController extends Controller //implements HasMiddleware
{
//     public static function middleware(): array
// {
//     return [
//         new Middleware('permission:update article',only:['index']),
//         new Middleware('permission:post article',only:['edit']),
//         new Middleware('permission:create article',only:['create']),
//         new Middleware('permission:delete article',only:['destroy'])
//     ];
// }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $articles = Article::all();
        return view('articles.list',['articles'=>$articles]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('articles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'title'=>'required',
            'description'=>'required',
            'author'=>'required'
        ]);

        Article::create([
            'title'=>$request->title,
            'description'=>$request->description,
            'author'=>$request->author
        ]);

        return redirect('/article')->with('message','Article Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $articles = Article::find($id);
        return view('articles.edit',['articles'=>$articles]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id) 
    {
        $validate = $request->validate([
            'title'=>'required',
            'description'=>'required',
            'author'=>'required'
        ]);

        Article::find($id)->update($validate);

        return redirect('/article')->with('message','Article updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Retrieve the article by ID
        $article = Article::findOrFail($id);
    
        // Authorize the action
        Gate::authorize('view', $article);
    
        // Delete the article
        $article->delete();
    
        // Redirect back with a success message
        return redirect('/article')->with('message', 'Article deleted successfully!');
    }
    
}
