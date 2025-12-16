@extends('admin.maindesign')

@section('add_product')

    @if(session('product_message'))
        <div style="border: 1px solid green; color:white; border-radius: 4px rounded; padding: 10
        px; background-color: green; margin-bottom: 10px;">
            {{session('product_message')}}
        </div>
    @endif
 <div class="container-fluid">
 <form action="{{route('admin.postaddproduct')}}" method="POST", enctype="multipart/form-data">
    @csrf
    <input type="text" name="product_title" placeholder="Enter Product Name!"> <br> <br>
    <textarea name="product_description">     
        Product Description! 
    </textarea> <br> <br>
     <input type="number" name="product_quantity" placeholder="Enter Product Quantity!"><br> <br>
     <input type="number" name="product_price" placeholder="Enter Product Prize!"><br> <br>
      <input type="file" name="product_image"><br> <br>
     
     <select name="product_category"> 
        <option>Select a Category</option>
     @foreach($categories as $category)
        <option value="{{$category->id}}">{{$category->category}}</option>
     <option>{{$category->category }}</option>
        @endforeach
     </select><br> <br>
    <input type="submit" name="submit" value="Add Product"> <br> <br>
</form>
 
 
</div>

@endsection