@extends('admin.maindesign')

@section('view_category')
@if(session('viewproduct_message'))

    <div style="margin-bottom: 10px; color: black; background-color: Yellow;">
    {{ session('deleteviewproduct_message') }}

    </div>
@endif


@if(session('deleteproduct_message'))

    <div style="margin-bottom: 10px; color: black; background-color: Yellow;">
    {{ session('deleteproduct_message') }}

    </div>
@endif
<table style="width: 100%; border-collapse: collapse; font-family: Arial, sans-serif;">
<thead>
    <tr style="background-color: #ffffffff;">
        <th style="padding: 12px; text-align: left; border-bottom: 1px solid #ddd;">Product Title</th>
        <th style="padding: 12px; text-align: left; border-bottom: 1px solid #ddd;">Product Description</th>
        <th style="padding: 12px; text-align: left; border-bottom: 1px solid #ddd;">Product Quantity</th>
        <th style="padding: 12px; text-align: left; border-bottom: 1px solid #ddd;">Product Price</th>
        <th style="padding: 12px; text-align: left; border-bottom: 1px solid #ddd;">Product Image</th>
        <th style="padding: 12px; text-align: left; border-bottom: 1px solid #ddd;">Product Category</th>
         <th style="padding: 12px; text-align: left; border-bottom: 1px solid #ddd;">Action</th>
    </tr>
</thead>
<tbody>
@foreach($products as $product)
<tr style="border-bottom: 1px solid #ddd;">
    <td style="padding: 12px;">{{$product->product_title }}</td>
    <td style="padding: 12px;">{{Str::limit($product->product_description,50,'...')}}</td>
    <td style="padding: 12px;">{{$product->product_quantity}}</td>
    <td style="padding: 12px;">{{$product->product_price}}</td>
    <td style="padding: 12px;">
        <img style=width:100px;  src="{{asset('products/'.$product->product_image)}}">
    </td>
    <td style="padding: 12px;">{{$product->product_category}}</td>
    <td style="padding: 12px;">
        <a href="{{route('admin.updateproduct',$product->id)}}"style="color: #74ff02ff;"> 
        Update</a>
        <a href="{{route('admin.deleteproduct',$product->id)}}" onclick="return confirm('Are You Sure?')">
        Delete</a>
</td>
</tr>
@endforeach

    {{$products->links()}}
</tbody>
</table>
@endsection
