@extends('layouts.app')

@section('content')
    <div class="container">

        @if ($errors->any())
            <div class="alert alert-warning">
                @foreach ($errors->all() as $err)
                    {{ $err }}
                @endforeach
            </div>
        @endif

        <form method="post">
            @csrf
            <div class="mb-2">
                <label>Title</label>
                <input type="text" name="title" class="form-control">
            </div>
            <div class="mb-2">
                <label>Body</label>
                <textarea name="body" class="form-control"></textarea>
            </div>
            <div class="mb-2">
                <select name="category_id" class="form-control">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"> {{  $category->name }} </option>
                    @endforeach
                </select>
            </div>

            <button class="btn btn-primary">Add Article</button>
        </form>
    </div>
@endsection
