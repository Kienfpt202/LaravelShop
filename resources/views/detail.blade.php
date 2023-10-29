@extends('layouts_user')
@section('content')
@csrf

<style>
    .red-text {
        color: red;
        font-size: 5em;
    }
</style>

<div class="container col-md-8 mt-3 mb-3">
    <div class="row">
        <div class="col">
            <img src="{{ asset($product->image) }}" width="350">
        </div>
        <div class="col">
            <table class="table table-bordered">
                <tr>
                    <th class="text-center red-text" colspan="2">{{ $product->name }}</th>
                </tr>
                <tr>
                    <th>Price</th>
                    <td>${{ $product->price }}</td>
                </tr>
                <tr>
                    <th>Category</th>
                    <td>{{ $product->category->name }}</td>
                </tr>
                <tr>
                    <th>Tag</th>
                    <td>
                        @foreach ($product->tags as $tag)
                        <span class="badge bg-primary">{{ $tag->name }}</span>
                        @endforeach
                    </td>
                </tr>
                <tr>
                    <th>Describe</th>
                    <td>{{ $product->description }}</td>
                </tr>
                <tr class="text-center">
                    <th colspan="2">
                        <form action="/shopping-cart" method="get">
                            @csrf
                            <input type="hidden" name="id" value="{{ $product->id }}">
                            <input type="number" name="quantity" min="1" max="{{ $product->id }}">
                            <p class="btn-holder"><a href="{{ route('add.to.cart', $product->id) }}" class="btn btn-outline-danger">Add to cart</a> </p>
                        </form>
                    </th>
                </tr>
            </table>
        </div>
    </div>
</div>
@endsection
