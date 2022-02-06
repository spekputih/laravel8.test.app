<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Illuminate\Http\Request;
use App\Http\Requests\StorePost;
// use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class BlogController extends Controller
{
    public function __construct(){
        $this->middleware('auth')->only(['create', 'store', 'update', 'destroy']);
    }
    
    public function index()
    {
        return view('posts.index', [
            'posts' => BlogPost::latest()->with('user')->withCount('comment')->get(),
            'mostCommented' => BlogPost::mostCommented()->take(5)->get(),
            'mostActiveUser' => User::mostActiveUser()->take(5)->get()
        ]);
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

        $validated['user_id'] = $request->user()->id;

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
        return view('posts.show', ['post' => BlogPost::with('comment', 'user')->findOrFail($id)]);
    }

    public function edit($id)
    {
        
        $post = BlogPost::findOrFail($id);
        
        $this->authorize('update', $post);

        return view('posts.edit', ['post' => $post]);
    }

    public function update(StorePost $request, $id)
    {
        
        // find the existed post model in the database
        $post = BlogPost::findOrFail($id);

        // prevent access to unauthorize user to perform this function
        // if (Gate::denies('update-post', $post)) {
        //     abort(403);
        // }

        // helper function for Gate:
        $this->authorize('update', $post);

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

        // prevent unauthorize user to perform this action
        $this->authorize('delete', $post);

        // delete the post using delete() method
        $post->delete();

        // save message in the session
        session()->flash('status', 'The post was deleted!');

        // return to the index of the posts
        return redirect()->route('posts.index');

    }
}
