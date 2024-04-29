@extends('layouts.app')

@section('body')
    <div class="container mt-5">
        <div class="card border-primary">
            <div class="card-header bg-primary text-white">
                {{ $post['title'] }}
            </div>
            <div class="card-body">
                <p class="card-text">{{ $post['body'] }}</p>
                <img src="{{ asset('images/' . $post['image']) }}" alt="{{ $post['title'] }}" class="img-fluid">
            </div>
            <div class="card-footer">
                <a href="{{ route('posts.index') }}" class="btn btn-primary">Back to All Posts</a>
                <a class="btn btn-danger" href="{{ route('posts.destroy',$post['id']) }}">
                    Delete Post
                </a>
            </div>
        </div>
    </div>
@endsection