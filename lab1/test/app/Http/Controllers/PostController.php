<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    //

    private $posts = [
        ['id' => 1, 'title' => 'First Post', 'body' => 'This is the body of the first post.', 'image' => 'post.jpg'],
        ['id' => 2, 'title' => 'Second Post', 'body' => 'This is the body of the second post.', 'image' => 'post2.jpg'],
        ['id' => 3, 'title' => 'Third Post', 'body' => 'This is the body of the third post.', 'image' => 'post.jpg'],
        ['id' => 4, 'title' => 'Fourth Post', 'body' => 'This is the body of the fourth post.', 'image' => 'post2.jpg'],
    ];

    public function index()
    {
        return view('index', ["posts" => $this->posts]);
    }

    public function show($id)
    {
        $post = $this->findPost($id);
        if ($post) {
            return view('show', ["post" => $post]);
        }
        return abort(404);
    }

    public function create()
    {
        return view('create');
    }

    public function edit($id)
    {
        $post = $this->findPost($id);
        if ($post) {
            return view('edit', ["post" => $post]);
        }
        return abort(404);
    }

    public function destroy($id)
    {
        $post = $this->findPost($id);
        if ($post) {
            return view('destroy', ["post" => $post]);
        }
        return abort(404);
    }
    public function delete($id)
    {
        $postIndex = $this->findPost($id);
        
        if ($postIndex !== null) {
            return redirect()->route('posts.index')->with('success', 'Post deleted successfully');
        }
        
        return abort(404);
    }
    private function findPost($id)
    {
        foreach ($this->posts as $post) {
            if ($post['id'] == $id) {
                return $post;
            }
        }
        return null;
    }
}
