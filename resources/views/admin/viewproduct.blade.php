@extends('admin.maindesign')

@section('dashboard')

<div class="container-fluid">
    <div class="block margin-bottom-sm">
        <div class="title"><strong>All Products</strong></div>
        
        <div class="d-flex justify-content-end mb-3">
            <form action="{{ route('admin.viewproduct') }}" method="GET" class="d-flex">
                <input type="text" name="search" class="form-control mr-2" placeholder="Search Product">
                <button type="submit" class="btn btn-primary">Search</button>
            </form>
        </div>

        <div class="table-responsive"> 
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($product as $products)
                    <tr>
                        <td>{{ $products->product_title }}</td>
                        <td>{!! Str::limit($products->product_description, 50) !!}</td>
                        <td>{{ $products->category }}</td>
                        <td>₱{{ $products->product_price }}</td>
                        <td>{{ $products->product_quantity }}</td>
                        <td>
                            <img width="100" src="/products/{{ $products->product_image }}" alt="{{ $products->product_title }}" style="border-radius: 5px;">
                        </td>
                        <td>
                            <div class="d-flex">
                                <a href="{{ route('admin.updateproduct', $products->id) }}" class="btn btn-success btn-sm mr-2" style="color: white;">
                                    <i class="fa fa-edit"></i> Edit
                                </a>
                                <a href="{{ route('admin.deleteproduct', $products->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this product?');">
                                    <i class="fa fa-trash"></i> Delete
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center mt-3">
            {{ $product->onEachSide(1)->links() }}
        </div>
    </div>
</div>

@endsection