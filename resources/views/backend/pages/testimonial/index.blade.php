@extends("backend.layout.master")
@section('title')
Testimonial Index
@endsection


@push('admin_style')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
    .dataTables_length{
        padding: 20px 0;
    }
</style>
@endpush


@section('admin_content')
<div class="row">
    <h1>Testimonial List Table</h1>
    <div class="col-12">
        <div class="d-flex justify-content-end">
            <a href="{{ route('testimonial.create') }}" class="btn btn-primary">
            <i class="fas fa-plus-circle"></i>
            Add New Testimonial
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
                        <th>Client Image</th>
                        <th>Client Name</th>
                        <th>Client Designation</th>
                        <th>Options</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ( $testimonials as $testimonial)

                    <tr>
                        <th scope="row">{{ $testimonials->firstItem()+$loop->index }}</th>
                        <td>{{ $testimonial->updated_at->format('d M Y') }}</td>
                        <td><img src="{{ asset('uploads/testimonial') }}/{{ $testimonial->client_image }}" class="img-fluid rounded-circle" alt=""></td>
                        <td>{{ $testimonial->client_name }}</td>
                        <td>{{ $testimonial->client_designation }}</td>
                        <td><div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false">setting</button>
                            <ul class="dropdown-menu">
                               <li><a class="dropdown-item" href="{{ route('testimonial.edit',$testimonial->client_name_slug) }}"><i class="fa-regular fa-pen-to-square"></i> Edit</a></li>
                               <li>
                                <form action="{{ route('testimonial.destroy',$testimonial->client_name_slug) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="dropdown-item show_confirm" type="submit"><i class="fa-solid fa-trash"></i> Delete</button>
                                </li>
                              </ul>
                            </div></td>
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(document).ready(function () {
    $('#example').DataTable({
        pagingType: 'first_last_numbers',
    });
});
$('.show_confirm').click(function(event)
{
    let form $(this).closest('form');
    event.preventDefault();
    Swal.fire({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!'
}).then((result) => {
  if (result.isConfirmed) {
    form.submit();
    Swal.fire(
      'Deleted!',
      'Your file has been deleted.',
      'success'
    )
  }
})
})
</script>
@endpush
