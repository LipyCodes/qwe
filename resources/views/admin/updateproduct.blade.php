@extends('admin.maindesign')

@section('add_product')

    @if(session('product_message'))
        <div style="border: 1px solid green; color:white; border-radius: 4px rounded; padding: 10 px; background-color: green; margin-bottom: 10px;">
            {{ session('product_message') }}
        </div>
    @endif

    <div class="container-fluid" style="margin-left: 400px;">
        <form action="{{ route('admin.postupdateproduct', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf

            <input type="text" name="product_title" value="{{ $product->product_title }}">
            <br><br>

            <textarea name="product_description" style="height: 300px; width: 200px;">{{ $product->product_description }}</textarea>

            <input type="number" name="product_quantity" value="{{ $product->product_quantity }}">
            <br><br>

            <input type="number" name="product_price" value="{{ $product->product_price }}">
            <br><br>

            <img style="width: 100px;" src="{{ asset('products/' . $product->product_image) }}">
            <label>Change Product Image</label>
            <input type="file" name="product_image">
            <label>Add new image! </label>
            <br><br>

            <select name="product_category">
                <option value="{{ $product->product_category }}">
                    {{ $product->product_category }}
                </option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->category }}</option>
                @endforeach
            </select>
            <label>Select Category </label>
            <br><br>

            <input type="submit" name="submit" value="Update Product">
            <br><br>
        </form>
    </div>

@endsection
