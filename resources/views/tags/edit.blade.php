<!-- resources/views/tags/edit.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>Edit Tag</h1>

    <form action="{{ route('tags.update', $tag->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $tag->name }}">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection
