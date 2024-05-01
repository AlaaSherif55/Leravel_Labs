<?php

namespace App\Http\Controllers;

use App\Http\Requests\storeRequest;
use App\Http\Requests\updateRequest;
use Illuminate\Support\Str;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\posts;
use App\Models\User;
use COM;


class PostController extends Controller
{
    
    private function file_operations($request){

        if($request->hasFile('image')){
            $image = $request->file('image');
            $filepath=$image->store("/","posts_uploads" );
            return $filepath;
        }
        return null;
    }

    public function index()
    {
        
        $posts = posts::paginate(10);
        return view('index', ["posts" => $posts]);
    }

    public function show($id)
    {
        $post = posts::findOrFail($id);
        return view('show', ["post" => $post]);

    }

    public function restore()
    {
       posts::onlyTrashed()->restore();
       return to_route("posts.index");      
    }

    public function create()
    {
        $users = User::all();
        return view('create', ["authors"=>$users]);

    }
    public function store(storeRequest $request){
        
        $validated = $request->validated();
        $validated['slug'] = Str::slug($validated['title']);

        unset($validated['slug']);
        
        $file_path = $this->file_operations($request);
        $authorExists = User::where('id', $validated['author'])->exists();
        if (!$authorExists) {
            return redirect()->route('posts.create')->withErrors(['author_not_found' => 'Author not found.']);
        }
        $Post = new posts();
        $Post->title = $validated['title'];
        $Post->body = $validated ['body'];
        $Post->image =  $file_path;
        $Post->author = $validated ['author'];;
        $Post->save();
        return to_route("posts.index");      
    }
        
    public function edit($id)
    {
        $post = posts::findOrFail($id);
        $authors= User::all();
        return view('edit',["post" => $post, "authors"=> $authors]);
    }
    function update(updateRequest $request, $id){
         
        $post = Posts::findOrFail($id);
        $validated = $request->validated();
        // $request_params = request()->all();

        if (isset($validated['title'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }
        
        $file_path = $this->file_operations($request);
    
        if ($file_path) {
            $post->image = $file_path;
        }

        unset($validated['image']);// remove the attribute 

        $post->update($validated);
    
        return to_route("posts.show", $post);
    }

    public function destroy($id)
    {
        $post = posts::findOrFail($id);
        return view('destroy',["post" => $post]);
    }
    public function delete($id)
    {
        $post = posts::findOrFail($id);
        $post->delete();
        return to_route("posts.index");
    }
}
