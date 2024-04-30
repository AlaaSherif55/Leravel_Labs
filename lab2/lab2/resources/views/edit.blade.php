@extends('layouts.app')

@section('body')
    <div class="container mt-5">
        <h2 class="mb-4">Edit Post</h2>
        <form method="post" action="{{route('posts.update',$post['id'])}}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" name="title" id="title" value="{{ $post['title'] }}">
            </div>
            <div class="form-group mt-3">
                <label for="body">Body</label>
                <textarea class="form-control" name="body" id="body" rows="6">{{ $post['body'] }}</textarea>
            </div>
            <div class="form-group mt-3">
                <label for="image">Image</label>
                <input type="file" class="form-control" name="image" id="image">
                @isset($post['image'])
                    <small>Current Image: {{ $post['image']  }}</small>
                @endisset
            </div>
            <div class="form-group">
                <label for="title">Post Creator</label>
                <select class='form-control' name='author' id='author'>
                    @foreach($authors as $author)
                        <option value="{{$author['id']}}"
                        @if($post['author'] == $author['id']) {
                            selected
                        }
                        @endif>
                            {{$author['name']}}
                        </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="mt-3 btn btn-primary">Update Post</button>
        </form>
    </div>
@endsection
