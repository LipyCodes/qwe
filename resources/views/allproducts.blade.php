@extends('maindesign')

@section('index')

    <div class="container">
      <div class="heading_container heading_center">
        <h2>
          Latest Products
        </h2>
      </div>
      
      <div class="row">
        @foreach($products as $product)
            <div class="col-sm-6 col-md-4 col-lg-3">
                <div class="box">
                    <a href="{{ route('product_details', $product->id) }}">
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
                    </a>
                    <div class="mt-2 text-center">
                        <a href="{{ route('add_to_cart', $product->id) }}" class="btn btn-sm btn-primary">
                            Add to Cart
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
      </div>
        

      
      <div class="btn-box d-flex justify-content-center mt-5 mb-4">
        <a href="{{ route('index') }}" class="btn btn-warning">
          Back to Home
        </a>
      </div>
    </div>
  
@endsection