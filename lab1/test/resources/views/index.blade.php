@extends('layouts.app')
@section('body')
    <div class="container mt-5">
        <h1>All Posts</h1>
        <div class="row">
            @foreach ($posts as $post)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="{{ asset('images/' . $post['image']) }}" class="card-img-top" alt="{{ $post['title'] }}">

                        <div class="card-body">
                            <h5 class="card-title">{{ $post['title'] }}</h5>
                            <p class="card-text">{{ $post['body'] }}</p>
                            <a href="{{ route('posts.show', $post['id']) }}" class="btn btn-success">View Post</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
