@extends('layouts.app')

@section('content')
    <div class="container">

        @if (session('info'))
            <div class="alert alert-info">
                {{ session('info') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-warning">
                @foreach ($errors->all() as $err)
                    {{ $err }}
                @endforeach
            </div>
        @endif

        <div class="card mb-4">
            <div class="card-body">
                <h3 class="card-title"> {{ $article->title }} </h3>
                <div class="text-muted">

                    <small>
                        <b class="text-success">User:</b> {{ $article->user->name }} -
                        <b>Category:</b> {{ $article->category->name }}.
                        {{ $article->created_at->diffForHumans() }}
                    </small>
                </div>
                <div class="mb-2"> {{ $article->body }} </div>
                @auth
                    @can('delete-article', $article)
                        <a href="{{ url("/articles/edit/$article->id") }}" class="mx-2 btn btn-secondary">Edit</a>
                        <a href="{{ url("/articles/delete/$article->id") }}" class="mx-2 btn btn-danger">Delete</a>
                    @endcan
                @endauth

            </div>

        </div>

        <hr>

        <ul class="list-group">
            <li class="list-group-item active">Comment</li>
            @foreach ($article->comments as $comment)
                <li class="list-group-item">
                    @can('delete-comment', $comment)
                        <a href="{{ url("/comments/delete/$comment->id") }}" class="btn-close float-end"></a>
                    @endcan
                    <b class="text-success">{{ $comment->user->name }} - </b>
                    {{ $comment->content }}
                </li>
            @endforeach
        </ul>

        @auth
            <form action="{{ url('/comments/add') }}" method="post">
                @csrf
                <input type="hidden" name="article_id" value="{{ $article->id }}">
                <textarea name="content" class="form-control my-2"></textarea>
                <button class="btn btn-secondary">Add comment</button>
            </form>
        @endauth
    </div>
@endsection
