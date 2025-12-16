@extends('admin.maindesign')

@section('dashboard')

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            
            @if(session('message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('message') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <div class="block margin-bottom-sm">
                <div class="title"><strong>All Categories</strong></div>
                
                <div class="table-responsive"> 
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Category Name</th>
                                <th>Created At</th>
                                <th style="width: 200px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $category)
                            <tr>
                                <td>{{ $category->id }}</td>
                                <td>{{ $category->category_name }}</td>
                                <td>{{ $category->created_at ? $category->created_at->format('Y-m-d') : 'N/A' }}</td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('admin.categoryupdate', $category->id) }}" class="btn btn-success btn-sm mr-2" style="color: white;">
                                            <i class="fa fa-edit"></i> Edit
                                        </a>
                                        <a href="{{ route('admin.categorydelete', $category->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this category?');">
                                            <i class="fa fa-trash"></i> Delete
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection