@extends('backend.layout.master')

@section('title')
Coupon Create
@endsection


@push('admin_style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css" integrity="sha512-In/+MILhf6UMDJU4ZhDL0R0fEpsp4D3Le23m6+ujDWXwl3whwpucJG1PEmI3B07nyJx+875ccs+yX2CqQJUxUw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush
@section('admin_content')

<div class="row">
    <h1>Coupon Create Form</h1>
    <div class="col-12">
        <div class="d-flex justify-content-start">
            <a href="{{ route('coupon.index') }}" class="btn btn-primary">
                <i class="fa-solid fa-backward"></i>
                Back to Coupons
            </a>
        </div>
    </div>
</div>

<div class="col-12 mt-5">
    <div class="card">
        <div class="card-body">
            <form action="{{ route('coupon.store') }}" method="POST" >
                @csrf
                <div class="mb-3">
                    <label for="coupon_name" class="form-label">
                        Coupon Name
                    </label>
                    <input type="text" name="coupon_name" class="form-control @error('coupon_name')
                    is-invalid
                    @enderror" placeholder="enter coupon name" id="">
                    @error('coupon_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="discount_percentage" class="form-label">
                        Discount Percentage
                    </label>
                    <input type="text" name="discount_percentage" class="form-control @error('discount_percentage')
                    is-invalid
                    @enderror" placeholder="enter percentagae" id="">
                    @error('discount_percentage')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="perchase_amount" class="form-label">
                        Minimum Purchase Amount
                    </label>
                    <input type="text" name="perchase_amount" placeholder="enter purchase amount" class="form-control @error('perchase_amount')
                    is-invalid
                    @enderror"></input>
                    @error('perchase_amount')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="validity_till" class="form-label">
                        Expiry Date
                    </label>
                    <input type="date" name="validity_till" class="form-control @error('validity_till')
                    is-invalid
                    @enderror"></input>
                    @error('validity_till')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="mb-3 form-check form-switch">
                    <input type="checkbox" class="form-check-input" name="is_active" role="switch" id="activeStatus">
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js" integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
$('.dropify').dropify();
</script>
@endpush


