@extends('maindesign')
<base href="/public">
@section('product_details')
@if(session('cart_messages'))
    <div style="border: 1px solid blue; color:white;
    border-radius:4px; padding: 10px;
    background-color:green; margin-bottom: 10px;">
        {{ session('cart_messages') }}
    </div>
@endif

<style>
    .product-dets .container {
        max-width: 700px;
        margin: 155px auto 100px auto;
        padding: 30px;
        text-align: center;
        border: 1px solid #ccc;
        border-radius: 10px;
        background-color: #f9f9f9;
    }
    .product-dets img {
        max-width: 100%;
        border-radius: 10px;
        object-fit: cover;
    }
    .product-dets .product-info {
        display: flex;
        gap: 18px;
        justify-content: center;
        flex-wrap: wrap;
        margin: 14px 0;
        font-weight: 600;
    }
    .product-dets .button-group {
        display: flex;
        justify-content: center;
        gap: 14px;
        flex-wrap: wrap;
        margin-top: 10px;
    }
    .product-dets .btn-ghost {
        padding: 10px 18px;
        border-radius: 6px;
        border: 1px solid #777;
        color: #333;
        text-decoration: none;
        background: transparent;
    }
    .product-dets .btn-primary {
        padding: 10px 18px;
        border-radius: 6px;
        border: none;
        color: #fff;
        background: #e91e63;
        text-decoration: none;
    }
</style>

<div class="product-dets">
    <div class="container">

        <img src="{{ asset('products/'.$product->product_image) }}" alt="{{ $product->product_title }}">

        <h1 class="mt-3">{{ $product->product_title }}</h1>

        <div class="description-box">
            <p>{{ $product->product_description }}</p>
        </div>

        <div class="product-info">
            <span>Price: ₱{{ $product->product_price }}</span>
            <span>Category: {{ $product->product_category }}</span>
            <span>Stock: {{ $product->product_quantity }}</span>
        </div>

        <div class="button-group">
            <a class="btn-ghost" href="{{ url()->previous() }}">Back</a>
            <a href="{{ route('add_to_cart', $product->id) }}" class="btn-primary">Add to Cart</a>
        </div>

    </div>
</div>

@endsection
