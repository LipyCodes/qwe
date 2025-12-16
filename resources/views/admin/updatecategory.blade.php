@extends('admin.maindesign')

<base href= "/public">
@section('update_category')

    @if(session('update_category_message'))
        <div style="border: 1px solid green; color:white; border-radius: 4px rounded; padding: 10
        px; background-color: green; margin-bottom: 10px;">
            {{session('update_category_message')}}
        </div>
    @endif
 <div class="container-fluid">
 <form action="{{route('admin.postupdatecategory',$category->id)}}" method="POST">
    @csrf
    <input type="text" name="category" value="{{$category->category}}" required="">
    <input type="submit" name="submit" value="Update Category">
</form>
 
 
</div>

@endsection