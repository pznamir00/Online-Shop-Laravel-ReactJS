@extends('layouts.app')

@section('title', '| Cart')

<link rel="stylesheet" type="text/css" href="{{ asset('css/pages/cart.css') }}"/>

@section('content')

    <table class="table table">
      <thead>
          <th></th>
          <th>Title</th>
          <th>Price</th>
          <th>Size</th>
          <th>Quantity</th>
          <th></th>
      <thead>
      @foreach($products as $key => $item)
        <tr>
          <td><img class="cart-image" src="{{ 'images/'.$item['product']->images[0]->url }}" alt="Cart Img"/></td>
          <td>{{$item['product']->title}}</td>
          <td>{{$item['product']->price}}</td>
          <td>{{$item['size']->value}}</td>
          <td><input class="form-control" type="number" data-sid="{{$item['size']->id}}" value="{{$item['qty']}}" max="{{$item['size']->quantity}}" min="1"/></td>
          <td><a href="/cart/delete/{{$key}}">Delete</a></td>
        </tr>
      @endforeach
    </table>

    <a href="{{route('order_form')}}" class="btn btn-primary">Order</a>

    <div id="root"></root>

    <a href="{{ route('order_form') }}" class="btn btn-primary">Order</a>
    <a href="/cart/clear" class="btn btn-danger float-right">Clear cart</a>

@endsection
