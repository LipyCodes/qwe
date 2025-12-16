@extends('maindesign')

@section('index')

@if(session('cart_messages'))
  <div style="border: 1px solid blue; color:white;
  border-radius:4px; padding: 10px;
  background-color:green; margin-bottom: 10px;">
      {{ session('cart_messages') }}
  </div>
@endif

<div class="container">
  <div class="heading_container heading_center">
    <h2>Your Cart</h2>
  </div>

  @if($cartItems->isEmpty())
    <p>Your cart is empty.</p>
  @else
    <div class="row">
      @foreach($cartItems as $item)
        @php $product = $item->product; @endphp
        @if($product)
        <div class="col-sm-6 col-md-4 col-lg-3">
          <div class="box">
            <div class="img-box">
              <img src="{{ asset('products/'.$product->product_image) }}" alt="">
            </div>
            <div class="detail-box">
              <h6>{{ $product->product_title }}</h6>
              <h6>
                Price
                <span>₱{{ $product->product_price }}</span>
              </h6>
            </div>
            <div style="padding:10px; text-align:center;">
              <a href="{{ route('cart.remove', $item->id) }}" class="btn btn-danger btn-sm">
                Remove
              </a>
            </div>
          </div>
        </div>
        @endif
      @endforeach
    </div>
  @endif
</div>

@endsection


