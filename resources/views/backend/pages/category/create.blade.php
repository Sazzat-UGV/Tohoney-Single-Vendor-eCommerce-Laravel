@extends('backend.layout.master')

@section('title')
Category Create
@endsection


@push('admin_style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endpush
@section('admin_content')

<div class="row">
    <h1>Category Create Form</h1>
    <div class="col-12">
        <div class="d-flex justify-content-start">
            <a href="{{ route('category.index') }}" class="btn btn-primary">
                <i class="fa-solid fa-backward"></i>
                Back to Categories
            </a>
        </div>
    </div>
</div>

<div class="col-12 mt-5">
    <div class="card">
        <div class="card-body">
            <form action="{{ route('category.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="category_title" class="form-label">
                        Category Title
                    </label>
                    <input type="text" name="title" class="form-control @error('title')
                    is-invalid
                    @enderror" placeholder="enter category title" id="">
                    @error('title')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="mb-3 form-check form-switch">
                    <input type="checkbox" class="form-check-input" name="is_active" role="switch" id="activeStatus" checked>
                    <label for="activeStatus" class="form-check-label">
                        Active or Inactive
                    </label>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mt-5">
                    <button type="submit" class="btn btn-success">Store</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('admin_script')

@endpush


