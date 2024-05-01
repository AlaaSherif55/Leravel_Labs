@extends('layouts.app')
@section('body')
    @php
        use Carbon\Carbon;
    @endphp
    <div class="container mt-5">
        <h1>All Posts</h1>
        <div class="row">
            <div>
              <a href="{{ route('posts.restore') }}" class="btn btn-success">Restore</a>
            </div>
            @foreach ($posts as $post)
                <div class="col-md-4 mb-4">
                    <div class="card">
                      <p>Slug: {{ $post->slug }}</p>
                        <img src="{{ asset('images/posts/' . $post['image']) }}" class="card-img-top" alt="{{ $post['image'] }}">

                        <div class="card-body">
                            <h5 class="card-title">{{ $post['title'] }}</h5>
                            <p class="card-text">{{ $post['body'] }}</p>
                            <p class="card-text">{{ $post['created_at'] }}</p>
                            <a href="{{ route('posts.show', $post['id']) }}" class="btn btn-success">View Post</a>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="container d-flex justify-content-center align-items-center">
        @if ($posts->previousPageUrl())
          <a href="{{ $posts->previousPageUrl() }}" class="btn btn-sm btn-light">Previous</a>
        @endif
      
        <ul class="pagination m-0">
          @php
            $startPage = max($posts->currentPage() - 2, 1);
            $endPage = min($posts->currentPage() + 2, $posts->lastPage());
           @endphp
      
          @if ($startPage > 1)
            <li class="page-item">
              <a href="{{ $posts->url(1) }}" class="page-link">1</a>
            </li>
            @if ($startPage > 2)
              <li class="page-item disabled">
                <span class="page-link">...</span>
              </li>
            @endif
          @endif
      
          @for ($i = $startPage; $i <= $endPage; $i++)
            <li class="page-item @if ($i == $posts->currentPage()) active @endif">
              <a href="{{ $posts->url($i) }}" class="page-link">{{ $i }}</a>
            </li>
          @endfor
      
          @if ($endPage < $posts->lastPage())
            @if ($endPage < $posts->lastPage() - 1)
              <li class="page-item disabled">
                <span class="page-link">...</span>
              </li>
            @endif
            <li class="page-item">
              <a href="{{ $posts->url($posts->lastPage()) }}" class="page-link">{{ $posts->lastPage() }}</a>
            </li>
          @endif
        </ul>
        @if ($posts->nextPageUrl())
          <a href="{{ $posts->nextPageUrl() }}" class="btn btn-sm btn-light">Next</a>
        @endif

        </div>
        </div>
    </div>
@endsection
