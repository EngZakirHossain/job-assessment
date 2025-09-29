@extends('layouts.masterLayout')
@section('pageTitle') Trash - Sales @endsection

@section('content')
<div class="container">
    <h3 class="mb-3">Trashed Suppliers</h3>

    <a href="{{ route('suppliers.index') }}" class="btn btn-secondary mb-3">← Back</a>

    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead>
                <tr>
                    <th>Company</th>
                    <th>Country</th>
                    <th>Code</th>
                    <th>Deleted At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            @forelse($trashed as $supplier)
                <tr>
                    <td>{{ $supplier->company_name }}</td>
                    <td>{{ $supplier->country }}</td>
                    <td>{{ $supplier->code }}</td>
                    <td>{{ $supplier->deleted_at->format('Y-m-d H:i') }}</td>
                    <td>
                        <form action="{{ route('suppliers.restore', $supplier->id) }}" method="POST" class="d-inline">
                            @csrf
                            <button class="btn btn-sm btn-success">Restore</button>
                        </form>
                        <form action="{{ route('suppliers.forceDelete', $supplier->id) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Permanently delete this supplier?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger">Delete Forever</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="text-center">No trashed suppliers</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>

    {{ $trashed->links() }}
</div>
@endsection
@push('scripts')

</script>
@endpush

