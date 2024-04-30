<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\posts;
use App\Models\User;
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
        $posts = posts::paginate(1);
        return view('index', ["posts" => $posts]);
    }

    public function show($id)
    {
        $post = posts::findOrFail($id);
         return view('show', ["post" => $post]);

    }

    public function create()
    {
        $users = User::all();
        return view('create', ["authors"=>$users]);

    }
    public function store(){
        
        $request_parms = request();
        $file_path = $this->file_operations($request_parms);
        $request_parms = request()->all();
        $Post = new posts();
        $Post->title = $request_parms['title'];
        $Post->body = $request_parms['body'];
        $Post->image =  $file_path;
        $Post->author = $request_parms['author'];;
        $Post->save();
        return to_route("posts.index");      
    }
        
    public function edit($id)
    {
        $post = posts::findOrFail($id);
        $authors= User::all();
        return view('edit',["post" => $post, "authors"=> $authors]);
    }
    function update($id){
        $post = Posts::findOrFail($id);
    
        $request_params = request()->all();
        $file_path = $this->file_operations(request());
    
        if ($file_path) {
            $post->image = $file_path;
        }

        unset($request_params['image']);// remove the attribute 

        $post->update($request_params);
    
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
