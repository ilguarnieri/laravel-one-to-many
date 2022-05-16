<?php

namespace App\Http\Controllers\Admin;

use App\Post;
use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::with('category')->orderBy('created_at', 'desc')->get();

        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource. 
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderBy('name', 'asc')->get();

        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validazione dati
        $request->validate([
            'title' => 'required|string|max:150',
            'content' => 'required|string',
            'cover' => 'nullable|url',
            'category_id' => 'nullable|exists:categories,id',
            'published_at' => 'nullable|date|before_or_equal:today'
        ]);

        $data = $request->all();
        //creazione dello slug con la funzione statica nel Model
        $slug = Post::getUniqueSlug($data['title']);
        //aggiunta dello slug nel array data
        $data['slug'] = $slug;
        
        $newpost = new Post();
        //associazione dei dati in massa
        $newpost->fill($data);

        $newpost->save();
        return redirect()->route('admin.posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::orderBy('name', 'asc')->get();

        return view('admin.posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {

        $request->validate([
            'title' => 'required|string|max:150',
            'content' => 'required|string',
            'cover' => 'nullable|url',
            'category_id' => 'nullable|exists:categories,id',
            'published_at' => 'nullable|date|before_or_equal:today'
        ]);

        $data = $request->all();
        //controllo se il titolo del post è cambiato
        if($post->title != $data['title']){
            //creazione dello slug con la funzione statica nel Model
            $slug = Post::getUniqueSlug($data['title']);

            $data['slug'] = $slug;
        }

        $post->update($data);

        return redirect()->route('admin.posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('admin.posts.index');
    }
}
