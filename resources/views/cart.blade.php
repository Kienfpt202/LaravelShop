@extends('layouts_user')

@section('content')
    <table id="cart" class="table table-bordered">
        <thead>
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @php $total = 0 @endphp
            @if(session('cart'))
                @foreach(session('cart') as $id => $details)
                    @php
                        $subtotal = $details['price'] * $details['quantity'];
                        $total += $subtotal;
                    @endphp
                    <tr rowId="{{ $id }}">
                        <td data-th="Product">
                            <div class="row">
                                <div class="col-sm-3 hidden-xs"><img src="{{ $details['image'] }}" class="card-img-top"/></div>
                                <div class="col-sm-9">
                                    <h4 class="nomargin"><a href="{{ route('product.details', $id) }}">{{ $details['name'] }}</a></h4>
                                </div>
                            </div>
                        </td>
                        <td data-th="Price">${{ $details['price'] }}</td>
                        <td data-th="Subtotal" class="text-center"><p>{{ $details['quantity'] }}</p></td>
                        <td data-th="Subtotal" class="text-center">${{ $subtotal }}</td>
                        <td class="actions">
                            <form method="POST" action="{{ route('delete.cart.product', $id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?');">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
        <tfoot>
            <tr>
                <td colspan="5" class="text-right">
                    @csrf
                    <a href="{{ url('/') }}" class="btn btn-primary"><i class="fa fa-angle-left"></i> Continue Shopping</a>
                    <form action="{{ url('/vnpay_payment') }}" method="post">
                        @csrf
                    <input type="hidden" name="total" value="{{ $total }}">
                        <button type="submit" class="btn btn-danger">Checkout</button>
                    </form>
                </td>
            </tr>
        </tfoot>
    </table>
@endsection
