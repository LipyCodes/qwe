@extends('admin.maindesign')

@section('dashboard') <div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="block margin-bottom-sm">
                <div class="title"><strong>Update Product</strong></div>
                <div class="block-body">
                    
                    @if(session('message'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('message') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul style="margin-bottom: 0;">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.postupdateproduct', $product->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="form-group">
                            <label class="form-control-label">Product Title</label>
                            <input type="text" name="title" value="{{ $product->product_title }}" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label class="form-control-label">Description</label>
                            <textarea name="description" class="form-control" rows="4" required>{{ $product->product_description }}</textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label">Price</label>
                                    <input type="number" name="price" value="{{ $product->product_price }}" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label">Quantity</label>
                                    <input type="number" name="quantity" value="{{ $product->product_quantity }}" class="form-control" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-control-label">Category</label>
                            <select name="category" class="form-control" required>
                                <option value="{{ $product->category }}" selected>{{ $product->category }}</option>
                                
                                @foreach($category as $cat)
                                    @if($cat->category_name != $product->category)
                                        <option value="{{ $cat->category_name }}">{{ $cat->category_name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-control-label">Current Image</label>
                            <br>
                            <img width="150" src="{{ asset('products/' . $product->product_image) }}" style="margin: 10px 0; border-radius: 5px;">
                        </div>

                        <div class="form-group">
                            <label class="form-control-label">Change Image (Optional)</label>
                            <input type="file" name="image" class="form-control-file">
                        </div>

                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-success">Update Product</button>
                            <a href="{{ route('admin.viewproduct') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection