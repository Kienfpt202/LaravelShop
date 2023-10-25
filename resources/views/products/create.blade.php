@extends('layouts.app')
@section('title', 'Products Create')
@section('content')
<form action="/products" method="post" enctype="multipart/form-data">
  @csrf
  <div class="mb-3">
    <label for="name" class="form-label">Name</label>
    <input type="text"
      class="form-control" name="name" id="name" aria-describedby="helpId" placeholder="">
  </div>
  <div class="mb-3">
    <label for="price" class="form-label">Price</label>
    <input type="text"
      class="form-control" name="price" id="price" aria-describedby="helpId" placeholder="">
  </div>
  <div class="mb-3">
    <label for="category_id" class="form-label">Category</label>
    <select class="form-select form-select-lg" name="category_id" id="category_id">
      @foreach ($categories as $category)
        <option value="{{ $category->id }}">{{ $category->name }}</option>
      @endforeach
    </select>
  </div>
  <div class="mb-3">
    <label for="tags" class="form-label">Tags</label>
    <div>
      @foreach ($tags as $tag)
        <div class="form-check">
          <input class="form-check-input" type="checkbox" name="tags[]" id="tag{{ $tag->id }}" value="{{ $tag->id }}">
          <label class="form-check-label" for="tag{{ $tag->id }}">{{ $tag->name }}</label>
        </div>
      @endforeach
    </div>
  </div>
  <div class="mb-3">
    <label for="description" class="form-label">Description</label>
    <textarea class="form-control" name="description" id="description" rows="3"></textarea>
  </div>
  <div class="mb-3">
    <label for="image" class="form-label">Image</label>
    <input type="file" class="form-control" name="image" id="image">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection
