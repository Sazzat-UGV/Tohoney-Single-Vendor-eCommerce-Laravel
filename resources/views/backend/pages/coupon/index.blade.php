@extends('backend.layout.master')
@section('title')
Discount Coupon
@endsection
@push('admin_style')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
    .dataTables_length {
        padding: 20px 0;
    }
</style>
@endpush
@section('admin_content')
<div class="row">
    <h1>Coupon List Table</h1>
    <div class="col-12">
        <div class="d-flex justify-content-end">
            <a href="{{ route('coupon.create') }}" class="btn btn-primary">
                <i class="fas fa-plus-circle"></i>
                Add New Coupon
            </a>
        </div>
    </div>
    <div class="col-12">
        <div class="table-responsive my-2">
            <table id="example" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Last Modified</th>
                        <th>Coupon Name</th>
                        <th>Discount (%)</th>
                        <th>Purchase Amount</th>
                        <th>validiy_till</th>
                        <th>Options</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($coupons as $coupon)
                        <tr>
                            <th scope="row">{{ $coupons->firstItem() + $loop->index }}</th>
                            <td>{{ $coupon->updated_at->format('d M Y') }}</td>
                            <td>{{ $coupon->coupon_name }}</td>
                            <td>{{ $coupon->discount_amount }}</td>
                            <td>{{ $coupon->minimum_purchase_amount }}</td>
                            <td>{{ $coupon->validity_till }}</td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">setting</button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item"
                                                href="{{ route('coupon.edit', $coupon->id) }}"><i
                                                    class="fa-regular fa-pen-to-square"></i> Edit</a></li>
                                        <li>
                                            <form action="{{ route('coupon.destroy', $coupon->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')

                                                <button class="dropdown-item show_confirm" type="submit"><i
                                                        class="fa-solid fa-trash"></i> Delete</button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
@push('admin_script')
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

<script>
    $(document).ready(function() {
        $('#example').DataTable({
            pagingType: 'first_last_numbers',
        });
    });
</script>
@endpush
