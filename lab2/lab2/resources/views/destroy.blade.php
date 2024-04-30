@extends('layouts.app')

@section('body')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-danger text-white">
                        <h2 class="text-center">Delete Post</h2>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-danger" role="alert">
                            <p class="mb-0">Are you sure you want to delete this post?</p>
                        </div>
                        <h4 class="card-title">{{ $post['title'] }}</h4>
                        <p class="card-text">{{ $post['body'] }}</p>
                    </div>
                    <div class="card-footer d-flex justify-content-center">
                        <form action="{{ route('posts.delete',$post['id']) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger mr-3">Yes, Delete</button>
                        </form>
                        <a href="{{ url()->previous() }}" class="btn btn-secondary">No, Cancel</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection