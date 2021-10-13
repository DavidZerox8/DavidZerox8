<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Post;
use App\Http\Requests\PostRequest;

//Importación para el manejo de imagenes
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Incio
        $posts = Post::latest()->get();
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Inicio
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        /*  Esta linea permite saber como se envian los datos
            dd($request->all());
        */
        
        //Guardado de datos
        $post = Post::create([
            
            'user_id' => auth()->user()->id
            
        ] + $request->all());
        
        //Configurar imagen
        if($request->file('file')){
            $post ->image = $request->file('file')->store('posts', 'public');
            $post->save();
        }
        
        //regresamos a la vista anterios
        return back()->with('status','Creado con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     
    public function show(Post $post)
    {
        //
    }
    */

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //Inicio
        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post)
    {
        //dd($request->all());
        //Inicio
        $post->update($request->all());
        
        if($request->file('file')){
            
            //Comando para eliminar la imagen anterior del post
            Storage::disk('public')->delete($post->image);
            
            $post ->image = $request->file('file')->store('posts', 'public');
            $post->save();
        }
        
        return back()->with('status', 'Actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //Inicio
        
        Storage::disk('public')->delete($post->image);
        $post->delete();
        
        return back()->with('status', 'Eliminado con éxito');
    }
}
