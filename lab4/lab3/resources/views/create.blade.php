@extends('layouts.app')
@section('content')
    <div class="container mt-5">
        <h2>Create a New Post</h2>
        <form method="post" action="{{route('posts.store')}}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" name="title" id="title" placeholder="Enter post title">
                @error('title')
                    <small class='text-danger'>{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="body">Body</label>
                <textarea class="form-control" name="body" id="body" placeholder="Enter post content"></textarea>
                @error('body')
                <small class='text-danger'>{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" class="form-control" name="image" id="image">
                @error('image')
                    <small class='text-danger'>{{ $message }}</small>
                @enderror
            </div>
            <div>
                <button type="submit" class="btn btn-primary mt-3">Create Post</button>
            </div>
        </form>
    </div>
@endsection
