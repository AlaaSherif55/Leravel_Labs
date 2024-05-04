<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\storeRequest;
use App\Http\Requests\updateRequest;
use App\Http\Resources\PostResource;
use App\Models\posts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class PostController extends Controller
{

    function __construct()
    {
        $this->middleware('auth:sanctum')->except('show','index');
    }

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
        $posts = posts::all();
        // return PostResource::collection($posts);
        return $posts;
        
    }
 
    public function store(storeRequest $request)
    {

        $validated = $request->validated();

        unset($validated['slug']);
        if (!$validated) {
            return response()->json(
                [
                        'validation_errors' => $validated->errors(),
                        'message' =>'please review your post form data',
                        'typealert'=>'danger'
                ], 422
            );
         }
        $validated['slug'] = Str::slug($validated['title']);
        $file_path = $this->file_operations($request);
        $Post = new posts();
        $Post->title = $validated['title'];
        $Post->body = $validated ['body'];
        $Post->author = Auth::id();
        $Post->image = $file_path;
        $Post->save();
        $Post->attachTags(['tag1', 'tag2', 'tag3']);
        return new PostResource($Post);
  
   }

   public function show(posts $post)
   {
       //
    //    return $post;
       return new PostResource($post);
   }


   public function update(updateRequest $request, posts $post)
   {
       $validated = $request->validated();
      
       if (isset($validated['title'])) {
           $validated['slug'] = Str::slug($validated['title']);
       }
   
       // Validate the request data
       $validator = Validator::make($request->all(), $request->rules());
       
       // Check if validation fails
       if ($validator->fails()) {
           return response()->json(
               [
                   'validation_errors' => $validator->errors(),
                   'message' => 'Please review your post form data',
                   'typealert' => 'danger'
               ], 422
           );
       }
   
       $file_path = $this->file_operations($request);
          
       if ($file_path) {
           $post->image = $file_path;
       }
   
       unset($validated['image']); // Remove the 'image' attribute 
   
       $post->update($validated);
          
       return response()->json(new PostResource($post), 200);
   }

    public function destroy(posts $post)
    {
        $post->delete();
        return  response()->json('delete', 204);
    }
}
