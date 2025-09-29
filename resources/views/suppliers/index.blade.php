@extends('layouts.masterLayout')
@section('pageTitle') suppliers List @endsection

@section('content')
<div class="container">
    <h3 class="mb-3">Suppliers</h3>

    <!-- Filters -->
    <form method="GET" class="row g-2 mb-3">
        <div class="col-md-2">
            <input type="text" name="company_name" value="{{ request('company_name') }}" class="form-control" placeholder="Company Name">
        </div>
        <div class="col-md-2">
            <input type="text" name="rep_name" value="{{ request('rep_name') }}" class="form-control" placeholder="Rep Name">
        </div>
        <div class="col-md-2">
            <input type="text" name="country" value="{{ request('country') }}" class="form-control" placeholder="Country">
        </div>
        <div class="col-md-2">
            <input type="date" name="from" value="{{ request('from') }}" class="form-control">
        </div>
        <div class="col-md-2">
            <input type="date" name="to" value="{{ request('to') }}" class="form-control">
        </div>
        <div class="col-md-2 d-flex gap-2">
            <button class="btn btn-primary">Filter</button>
            <a href="{{ route('suppliers.index') }}" class="btn btn-secondary">Reset</a>
        </div>
    </form>

    <div class="mb-3">
        <a href="{{ route('suppliers.create') }}" class="btn btn-success">+ Add Supplier</a>
        <a href="{{ route('suppliers.trash') }}" class="btn btn-warning">Trash</a>
    </div>

    <!-- Supplier Table -->
    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Company</th>
                    <th>Country</th>
                    <th>Code</th>
                    <th>Rep</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Added By</th>
                    <th>Added Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            @forelse($suppliers as $supplier)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $supplier->company_name }}</td>
                    <td>{{ $supplier->country }}</td>
                    <td>{{ $supplier->code }}</td>
                    <td>{{ $supplier->rep_name }}</td>
                    <td>{{ $supplier->email }}</td>
                    <td>{{ $supplier->phone }}</td>
                    <td>{{ $supplier->addedByUser?->name }}</td>
                    <td>{{ $supplier->added_date?->format('Y-m-d') }}</td>
                    <td>
                        <a href="{{ route('suppliers.edit', $supplier) }}" class="btn btn-sm btn-primary">Edit</a>
                        <form action="{{ route('suppliers.destroy', $supplier) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Move this supplier to trash?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger">Trash</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="10" class="text-center">No suppliers found</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>

    {{ $suppliers->links() }}
</div>
@endsection
@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(function() {

    $('.delete-sale').on('click', function() {
        if(!confirm('Are you sure you want to delete this sale?')) return;

        let saleId = $(this).data('id');
        let $row = $(this).closest('tr');

        $.ajax({
            url: `/suppliers/${saleId}`,
            type: 'DELETE',
            data: {_token: '{{ csrf_token() }}'},
            success: function(res){
                alert(res.message || 'Sale deleted successfully.');
                $row.remove();
            },
            error: function(xhr){
                let err = xhr.responseJSON;
                if(err && err.message) alert(err.message);
                else alert('An error occurred while deleting.');
            }
        });
    });

});
</script>
@endpush
