@extends('layouts.app')
@section('content')
    @php
        use Carbon\Carbon;
    @endphp
    <div class="container mt-5">
        <h1>My Posts</h1>
        <div class="row">
            @foreach ($user->posts as $post)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="{{ asset('images/posts/' . $post->image) }}" class="card-img-top" alt="{{ $post->image }}">

                        <div class="card-body">
                            <h5 class="card-title">{{ $post->title }}</h5>
                            <p class="card-text">{{ $post->body }}</p>
                            <p class="card-text">{{ $post->created_at }}</p>
                            <p class="card-text">Tags:
                                @foreach ($post->tags as $tag)
                                    <span class="badge bg-primary">{{ $tag->name }}</span>
                                @endforeach
                            </p>
                            <a href="{{ route('posts.show', $post->id) }}" class="btn btn-success">View Post</a>
                        </div>
                    </div>
                </div>
            @endforeach
            
        </div>
    </div>
@endsection