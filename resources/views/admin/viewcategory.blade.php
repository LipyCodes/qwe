@extends('admin.maindesign')

@section('view_category')
@if(session('deletecategory_message'))

    <div style="margin-bottom: 10px; color: black; background-color: Yellow;">
    {{ session('deletecategory_message') }}

    </div>



@endif
<table style="width: 100%; border-collapse: collapse; font-family: Arial, sans-serif;">
<thead>
    <tr style="background-color: #ffffffff;">
        <th style="padding: 12px; text-align: left; border-bottom: 1px solid #ddd;">Category ID</th>
        <th style="padding: 12px; text-align: left; border-bottom: 1px solid #ddd;">Category Name</th>
         <th style="padding: 12px; text-align: left; border-bottom: 1px solid #ddd;">Action</th>
    </tr>
</thead>
<tbody>
@foreach($categories as $category)
<tr style="border-bottom: 1px solid #ddd;">
    <td style="padding: 12px;">{{$category->id}}</td>
    <td style="padding: 12px;">{{$category->category}}</td>
    <td style="padding: 12px;">
        <a href="{{ route('admin.categoryupdate', $category->id) }}"style="color: #74ff02ff;"> 
        Update</a>
        <a href="{{ route('admin.categorydelete', $category->id) }}" onclick="return confirm('Are You Sure You Want To Delete This Category?')">
        Delete</a>
</td>
</tr>
@endforeach
</tbody>
</table>
@endsection
