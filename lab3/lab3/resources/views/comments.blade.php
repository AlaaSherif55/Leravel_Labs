@extends('layouts.app')
@section('body')
    <div class="container mt-5">
        <h2>Create a New Comment</h2>
        <form method="post" action="{{ route('comment.store') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="post" value="{{ $post->id }}">
            <div class="form-group">
                <label for="body">Description</label>
                <textarea class="form-control" name="description" id="body" placeholder="Enter post content"></textarea>
            </div>
            <div class="form-group">
                <label for="body">The User :</label>
                <select id="author" name="author"> 
                    @foreach ($authors as $author)
                         <option value="{{ $author['id'] }}">{{ $author['name'] }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Create Post</button>
        </form>
    </div>
@endsection