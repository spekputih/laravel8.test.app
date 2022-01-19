<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Illuminate\Http\Request;
use App\Http\Requests\StorePost;

class BlogController extends Controller
{
    
    public function index()
    {
        $posts = BlogPost::all();
        return view('posts.index', ['posts' => $posts]);
    }

    
    public function create()
    {
        return view('posts.create');
    }

    // for StorePost class it can be found at
    // the StorePost class is created to handle complex validation action on the request object
    public function store(StorePost $request)
    {
        // validate the data received 
        $validated = $request->validated();
        // call BlogPost class to access its database
        $blog = new BlogPost();
        // insert the validated data to the blog instance 
        $blog->fill($validated);
        // the data then save to the database
        $blog->save();
        // redirect to create view
        return redirect()->route('posts.create')->with('status', 'The post has been created!');
        // dd($request);
    }

    
    public function show($id)
    {
        
        return view('posts.show', ['post' => BlogPost::findOrFail($id)]);
    }

    
    public function edit($id)
    {
        $data = BlogPost::findOrFail($id);
        return view('posts.edit', ['post' => $data]);
    }

    public function update(StorePost $request, $id)
    {
        // find the existed post model in the database
        $post = BlogPost::findOrFail($id);
        // validate the blogPost 
        $validated = $request->validated();
        // store the validated request
        $post->fill($validated);
        // save to database
        $post->save();

        // insert message to session to be displayed
        $request->session()->flash('status', 'Blog Post has been Updated!');

        return redirect()->route('posts.show', ['post' => $post->id]);

    }

    
    public function destroy($id)
    {
        // find the post using $id data using findOrFail method
        $post = BlogPost::findOrFail($id);
        // delete the post using delete() method
        $post->delete();
        // save message in the session
        session()->flash('status', 'The post was deleted!');
        // return to the index of the posts
        return redirect()->route('posts.index');
    }
}
