@extends('backend.layout.master')

@section('title')
Product Update
@endsection


@push('admin_style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css" integrity="sha512-In/+MILhf6UMDJU4ZhDL0R0fEpsp4D3Le23m6+ujDWXwl3whwpucJG1PEmI3B07nyJx+875ccs+yX2CqQJUxUw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush
@section('admin_content')

<div class="row">
    <h1>Product Update Form</h1>
    <div class="col-12 mt-4">
        <div class="d-flex justify-content-start">
            <a href="{{ route('products.index') }}" class="btn btn-primary">
                <i class="fa-solid fa-backward"></i>
                Back to Products
            </a>
        </div>
    </div>
</div>

<div class="col-12 mt-5">
    <div class="card">
        <div class="card-body">
            <form action="{{ route('products.update',$product->slug) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
            <div class="row">
                <div class=" col-12 mb-3">
                    <label for="category_name" class="form-label">
                        Select Category
                    </label>
                    <select name="category_id" class="form-select" id="">
                        @foreach ($category as $category)
                        <option value="{{ $category->id }}" @if ($product->category_id==$category->id)
                            selected
                        @endif>{{ $category->title }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class=" col-12 mb-3">
                    <label for="product_name" class="form-label">
                        Product Name
                    </label>
                    <input type="text" value="{{ $product->name }}" name="name" class="form-control @error('name')
                    is-invalid
                    @enderror" placeholder="enter product name">
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class=" col-6 mb-3">
                    <label for="product_price" class="form-label">
                        Product Price
                    </label>
                    <input type="number" value="{{ $product->product_price }}" name="product_price" min="0" class="form-control @error('product_price')
                    is-invalid
                    @enderror" id="product_price">
                    @error('product_price')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class=" col-6 mb-3">
                    <label for="product_code" class="form-label">
                        Product Code
                    </label>
                    <input type="text" value="{{ $product->product_code }}" name="product_code" class="form-control @error('product_code')
                    is-invalid
                    @enderror" placeholder="enter a unique product code" >
                    @error('product_code')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class=" col-6 mb-3">
                    <label for="product_stock" class="form-label">
                        Initial Stock
                    </label>
                    <input type="number" value="{{ $product->product_stock }}" name="product_stock"  min="1" class="form-control @error('product_stock')
                    is-invalid
                    @enderror" id="product_stock">
                    @error('product_stock ')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class=" col-6 mb-3">
                    <label for="alert_quantity" class="form-label">
                        Alert Quantity
                    </label>
                    <input type="number" value="{{ $product->alert_quantity }}" name="alert_quantity"  min="1" class="form-control @error('alert_quantity')
                    is-invalid
                    @enderror" id="alert_quantity">
                    @error('alert_quantity ')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="col-12 mb-3">
                    <label for="short_description" class="form-label">
                        Short Description
                    </label>
                    <textarea name="short_description" id="" cols="30" rows="5" class="form-control @error('short_description')
                    is-invalid
                    @enderror">{{ $product->short_description }}</textarea>
                    @error('short_description')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="col-12 mb-3">
                    <label for="long_description" class="form-label">
                        Long Description
                    </label>
                    <textarea name="long_description" id="" cols="30" rows="5" class="form-control @error('long_description')
                    is-invalid
                    @enderror">{{ $product->long_description }}</textarea>
                    @error('long_description')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="col-12 mb-3">
                    <label for="additional_info" class="form-label">
                        Additional Info
                    </label>
                    <textarea name="additional_info" id="" cols="30" rows="5" class="form-control @error('additional_info')
                    is-invalid
                    @enderror">{{ $product->additional_info }}</textarea>
                    @error('additional_info')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="col-12 mb-3">
                    <label for="product_image" class="form-label">
                        Product Image
                    </label>
                    <input type="file" name="product_image" data-default-file="{{ asset('uploads/product_photo') }}/{{ $product->product_image}}" class=" dropify form-control @error('product_image')
                    is-invalid
                    @enderror">
                    @error('product_image')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="mb-3 form-check form-switch">
                    <input type="checkbox" class="form-check-input" name="is_active"  role="switch" id="activeStatus" @if ($product->is_active)
                    checked
                    @endif>
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
                    <button type="submit" class="btn btn-warning">Update</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('admin_script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js" integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
$('.dropify').dropify();
</script>
@endpush


