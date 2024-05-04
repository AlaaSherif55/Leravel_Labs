<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\posts;
use App\Models\User;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request_parms = request();
        $request_parms = request()->all();
        $Comment= new Comment();
        $Comment->description = $request_parms['description'];
        $Comment->user_id = $request_parms['author'];
        $Comment->post_id = $request_parms['post'];
        $Comment->save();
        $post = posts::findOrFail($request_parms['post']);
        return view('show', ["post" => $post]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = posts::findOrFail($id);
        $authors= User::all();
        return view('comments',["post" => $post,"authors"=>$authors]);  
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
