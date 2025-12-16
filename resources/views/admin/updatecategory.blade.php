@extends('admin.maindesign')

@section('dashboard')

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="block margin-bottom-sm">
                <div class="title"><strong>Update Category</strong></div>
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

                    <form action="{{ route('admin.postupdatecategory', $data->id) }}" method="POST">
                        @csrf
                        
                        <div class="form-group">
                            <label class="form-control-label">Category Name</label>
                            <input type="text" name="category_name" value="{{ $data->category_name }}" class="form-control" required>
                        </div>

                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-success">Update Category</button>
                            <a href="{{ route('admin.viewcategory') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection