@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="card border-primary">
            <div class="card-header bg-primary text-white">
                {{ $post['title'] }}
            </div>
            <div class="card-body">
                <p class="card-text">{{ $post['body'] }}</p>
                <img src="{{ asset('images/posts/' . $post['image']) }}" alt="{{ $post['title'] }}" class="img-fluid">
            </div>
            <div class="card-footer">
                <a href="{{ route('posts.index') }}" class="btn btn-primary">Back to All Posts</a>

                @can('delete', $post)
                <a class="btn btn-danger" href="{{ route('posts.destroy', $post['id']) }}">
                    Delete Post
                </a>
                <a class="btn btn-danger" href="{{ route('posts.edit', $post['id']) }}">
                    Edit Post
                </a>
                @else    
                <p>You are not authorized</p>
                @endcan 

                
            </div>
        </div>

        <div class="mt-4">
            <h4>Comments</h4>
            @if($post->comments->count() > 0)
                <ul class="list-group">
                    @foreach($post->comments as $comment)
                        <li class="list-group-item">
                            <strong>{{ $comment->user->name }}</strong><br>
                            {{ $comment->description }}
                        </li>
                    @endforeach
                </ul>
            @else 
                <p>No comments yet.</p>
            @endif
        </div>
        <a class="btn btn-danger" href="{{ route('comment.show', $post['id']) }}">
            Add Comment
        </a>
    </div>
@endsection
