@extends('layouts.app')

@section('content')
    <div class="container">
        {{ $articles->links() }}

        @if (session("info"))
            <div class="alert alert-info">
                {{ session("info") }}
            </div>
        @endif

        @foreach ($articles as $article)
            <div class="card mb-4">
                <div class="card-body">
                    <h3 class="card-title"> {{ $article->title }} </h3>
                    <div class="text-muted">
                        <small>
                            <b class="text-success">User:</b> {{ $article->user->name }} -
                            <b>Category:</b> {{ $article->category->name }},
                            <b>Comments:</b> {{ count($article->comments) }} -
                            {{ $article->created_at->diffForHumans() }}
                        </small>
                    </div>
                    <div class="mb-2"> {{ $article->body }} </div>
                    <a href="{{ url("/articles/detail/$article->id") }}" class="card-link">Detail</a>
                </div>

            </div>
        @endforeach
    </div>
@endsection
