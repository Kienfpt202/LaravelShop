<!-- resources/views/tags/create.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>Create Tag</h1>

    <form action="{{ route('tags.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
@endsection
