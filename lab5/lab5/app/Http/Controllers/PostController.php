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
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use App\Jobs\PruneOldPostsJob;

class PostController extends Controller
{
    function __construct()
    {
        $this->middleware('auth')->only('store','update','destory','pruneOldPosts','showUserPosts');
        // $this->middleware('auth')->except('index','show');
    }
    public function pruneOldPosts()
    {
        PruneOldPostsJob::dispatch();
        return to_route("posts.index");   
    }
    private function file_operations($request){

        if($request->hasFile('image')){
            $image = $request->file('image');
            $filepath=$image->store("/","posts_uploads" );
            return $filepath;
        }
        return null;
    }
    private function authorize_user($post){
        // if (! Gate::allows('post-onwer', $post)) {
        //     abort(401);
        // }
        if(!Gate::authorize('update', $post))
        {
                abort(401);
        }
    }
    public function index()
    {
        
        $posts = posts::paginate(10);
        // $posts = posts::all();
        // dd($posts);
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
        return view('create');

    }
    public function store(storeRequest $request){
        $creator = Auth::user();
         
        $validated = $request->validated();
        $validated['slug'] = Str::slug($validated['title']);

        unset($validated['slug']);
        
        $file_path = $this->file_operations($request);
        $Post = new posts();
        $Post->title = $validated['title'];
        $Post->body = $validated ['body'];
        $Post->image =  $file_path;
        if($creator){
            $Post->author =Auth::id();
        }
        $Post->save();
        $Post->attachTags(['tag1', 'tag2', 'tag3']);
        return redirect()->route("posts.index"); 
    }
        
    public function edit($id)
    {
        $post = posts::findOrFail($id);
        $authors= User::all();
        return view('edit',["post" => $post, "authors"=> $authors]);
    }
    function update(updateRequest $request, $id){
        // dd($request);
        $post = Posts::findOrFail($id);
        // $this->authorize_user($post); 
        // if(Auth::id() === $post->author){
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
        // }
        
        // return abort(401);
    
    }
    public function showUserPosts()
    {
        $id = Auth::id();
        $user = User::findOrFail($id);
        return view('profile', ["user" => $user]);
    }
    public function destroy($id)
    {    
        $post = posts::findOrFail($id);
        return view('destroy',["post" => $post]);

    }
    public function delete($id)
    {
        $post = posts::findOrFail($id);
        $this->authorize_user($post);
        // if(Auth::id() === $post->author){
            $post->delete();
            return to_route("posts.index");
        // }
        // return abort(401);
    }
}
