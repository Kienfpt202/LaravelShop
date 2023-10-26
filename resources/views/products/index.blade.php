@extends('layouts.app')
@section('title', 'Products Index')
@section('content')
<div class="table-responsive">
  <table class="table table-primary">
      <thead>
          <tr>
              <th scope="col">Name</th>
              <th scope="col">Price</th>
              <th scope="col">Description</th>
              <th scope="col">Image</th>
              <th>Category</th>
              <th>Tags</th>
              <th>Action</th>
          </tr>
      </thead>
      <tbody>
          @foreach ($products as $product)
              <tr>
                  <td>
                      <a href="/products/{{$product->id}}">{{$product->name}}</a>
                  </td>
                  <td>{{ $product->price }}</td>
                  <td>{{ $product->description }}</td>
                  <td>
                    <img src="{{ asset($product->images) }}"  width="100">
                    </td>
                  <td>{{ $product->category->name }}</td>
                  <td>
                      @foreach ($product->tags as $tag)
                          <span class="badge bg-primary">{{ $tag->name }}</span>
                      @endforeach
                  </td>
                  <td>
                      <a href="/products/{{$product->id}}/edit">
                          <button type="button" class="btn btn-primary">Edit</button>
                      </a>
                      <form action="/products/{{$product->id}}" method="post">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?');">Delete</button>
                      </form>
                  </td>
              </tr>
          @endforeach
      </tbody>
  </table>
</div>
@endsection
