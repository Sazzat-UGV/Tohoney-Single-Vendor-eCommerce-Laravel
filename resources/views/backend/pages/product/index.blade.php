@extends('backend.layout.master')
@section('title')
    Product Index
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
        <h1>Product List Table</h1>
        <div class="col-12">
            <div class="d-flex justify-content-end">
                <a href="{{ route('products.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus-circle"></i>
                    Add New Product
                </a>
            </div>
        </div>
        <div class="col-12">
            <div class="table-responsive my-2">
                <table id="example" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Last Modified</th>
                            <th>Category Name</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Stock/Alert</th>
                            <th>Rating</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <th scope="row">{{ $products->firstItem() + $loop->index }}</th>
                                <td><img src="{{ asset('uploads/product_photo') }}/{{ $product->product_image }}"
                                        alt="" class="img-fluid rounded w-20 h-20 "></td>
                                <td>{{ $product->updated_at->format('d M Y') }}</td>
                                <td>{{ $product->category->title }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->product_price }}</td>
                                <td><span
                                        class=" badge @if ($product->product_stock >= $product->alert_quantity) bg-success
                        @else
                            bg-danger @endif
                        ">{{ $product->product_stock }}</span>/
                                    <span class="badge bg-danger">
                                        {{ $product->alert_quantity }}
                                </td>
                                </span>
                                <td>{{ $product->product_rating }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">setting</button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item"
                                                    href="{{ route('products.edit', $product->slug) }}"><i
                                                        class="fa-regular fa-pen-to-square"></i> Edit</a></li>
                                            <li>
                                                <form action="{{ route('products.destroy', $product->slug) }}"
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
