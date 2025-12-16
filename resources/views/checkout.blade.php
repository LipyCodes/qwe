@extends('maindesign')

@section('index')

<div class="container" style="margin-top: 50px; margin-bottom: 50px;">
    <div class="heading_container heading_center">
        <h2>Checkout</h2>
    </div>

    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="box" style="padding: 20px;">
                
                <h4>Order Summary</h4>
                <ul class="list-group mb-3">
                    @php $total = 0; @endphp
                    @foreach($cartItems as $item)
                        @php 
                            $product = $item->product; 
                            $total += $product->product_price;
                        @endphp
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0">{{ $product->product_title }}</h6>
                            </div>
                            <span class="text-muted">₱{{ $product->product_price }}</span>
                        </li>
                    @endforeach
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Total (PHP)</span>
                        <strong>₱{{ $total }}</strong>
                    </li>
                </ul>

                <hr>

                <h4>Shipping Details</h4>
                <form action="{{ route('place.order') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Receiver Name</label>
                        <input type="text" name="name" class="form-control" value="{{ Auth::user()->name }}" required>
                    </div>

                    <div class="form-group">
                        <label>Shipping Address</label>
                        <textarea name="address" class="form-control" required></textarea>
                    </div>

                    <div class="form-group">
                        <label>Phone Number</label>
                        <input type="text" name="phone" class="form-control" required>
                    </div>

                    <div style="text-align: center; margin-top: 20px;">
                        <button type="submit" class="btn btn-success">Place Order</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

@endsection