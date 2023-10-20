@extends('layouts.app')
@section('title', 'Books Create')
@section('content')
<form action="/books" method="post">
  @csrf
  <div class="mb-3">
    <label for="" class="form-label">Name</label>
    <input type="text"
      class="form-control" name="title" id="title" aria-describedby="helpId" placeholder="">
  </div>
  <div class="mb-3">
    <label for="" class="form-label">Price</label>
    <input type="text"
      class="form-control" name="author" id="author" aria-describedby="helpId" placeholder="">
  </div>
  <div class="mb-3">
    <label for="" class="form-label">Description</label>
    <textarea class="form-control" name="description" id="description" rows="3"></textarea>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection
