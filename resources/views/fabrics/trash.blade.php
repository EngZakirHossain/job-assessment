@extends('layouts.masterLayout')
@section('pageTitle') Trash - Sales @endsection

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Trashed Fabrics</h2>
        <a href="{{ route('fabrics.index') }}" class="btn btn-primary">Back to Fabrics</a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-dark text-center">
                <tr>
                    <th>Fabric No</th>
                    <th>Supplier</th>
                    <th>Composition</th>
                    <th>QTY</th>
                    <th>Deleted At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($fabrics as $fabric)
                <tr>
                    <td>{{ $fabric->fabric_no }}</td>
                    <td>{{ $fabric->supplier->company_name ?? '-' }}</td>
                    <td>{{ $fabric->composition }}</td>
                    <td>{{ $fabric->qty }}</td>
                    <td>{{ $fabric->deleted_at->format('d-m-Y H:i') }}</td>
                    <td class="text-center">
                        <form action="{{ route('fabrics.restore', $fabric->id) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-success">
                                <i class="bi bi-arrow-counterclockwise"></i> Restore
                            </button>
                        </form>

                        <form action="{{ route('fabrics.forceDelete', $fabric->id) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Permanently delete?')">
                                <i class="bi bi-trash"></i> Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center text-muted">No trashed fabrics found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center">
        {{ $fabrics->links() }}
    </div>
</div>
@endsection
@push('scripts')

</script>
@endpush

