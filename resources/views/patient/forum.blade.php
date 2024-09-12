@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-2">
            <nav class="navbar navbar-light bg-light">
                <ul class="navbar-nav flex-column">
                    @foreach($sections as $section)
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('forum.index', ['category' => $section]) }}">{{ $section }}</a>
                    </li>
                    @endforeach
                </ul>
            </nav>
        </div>
        <div class="col-md-8">
            <div class="card mt-4">
                <div class="card-body">
                    <!-- Create Post Form -->
                    <form action="{{ route('forum.createPost') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="postContent">Create a Post</label>
                            <textarea class="form-control @error('postContent') is-invalid @enderror" id="postContent" name="postContent" rows="3" required>{{ old('postContent') }}</textarea>
                            @error('postContent')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="postImage">Upload an Image (optional)</label>
                            <input type="file" class="form-control-file @error('postImage') is-invalid @enderror" id="postImage" name="postImage">
                            @error('postImage')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="category">Select Category</label>
                            <select class="form-control" id="category" name="category">
                                @foreach($sections as $section)
                                <option value="{{ $section }}">{{ $section }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Post</button>
                    </form>
                </div>
            </div>
            @foreach($posts as $post)
            <div class="card mt-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">{{ $post->user->name }}</h5>
                            <p class="card-text">{{ $post->content }}</p>
                            @if($post->image)
                            <img src="{{ asset('storage/images/'.$post->image) }}" class="img-fluid" alt="PostImage">
                            @endif
                        </div>
                        <div>
                            @auth
                            @if($post->user_id === auth()->user()->id)
                            <!-- Delete Button -->
                            <form action="{{ route('forum.deletePost', $post->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                            @endif
                            @endauth
                        </div>
                    </div>
                    <div class="mt-4">
                        @foreach($post->comments as $comment)
                        <div class="card mb-2">
                            <div class="card-body">
                                <h6 class="card-title">{{ $comment->user->name }}</h6>
                                <p class="card-text">{{ $comment->content }}</p>
                                <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <form action="{{ route('forum.addComment', $post->id) }}" method="POST">
                        @csrf
                        <div class="form-group mt-3">
                            <input type="text" class="form-control @error('commentContent') is-invalid @enderror" name="commentContent" placeholder="Add a comment..." required>
                            @error('commentContent')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Add Comment</button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
