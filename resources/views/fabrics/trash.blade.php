@extends('layouts.masterLayout')
@section('pageTitle') Trash - Fabrics @endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <div class="table-box table-responsive">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>SN</th>
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
                                <td>#SUP-{{ str_pad($fabric->id, 4, '0', STR_PAD_LEFT) }}</td>
                                <td class="d-flex align-items-center">
                                    <span>{{ $fabric->supplier->company_name ?? '-' }}</span>
                                </td>
                                <td>{{ $fabric->composition }}</td>
                                <td>{{ $fabric->qty }}</td>
                                <td>{{ $fabric->deleted_at->format('Y-m-d H:i') }}</td>
                                <td>
                                    <form action="{{ route('fabrics.restore', $fabric->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button class="btn btn-sm btn-success"><i class="bi bi-arrow-counterclockwise"></i>  Restore</button>
                                    </form>
                                    <form action="{{ route('fabrics.forceDelete', $fabric->id) }}" method="POST" class="d-inline"
                                        onsubmit="return confirm('Permanently delete this supplier?')">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i> Delete Forever</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="text-center text-muted">No Fabrics Trash found</td>
                            </tr>
                        @endforelse

                        </tbody>
                    </table>
                </div>
                <div class="d-flex flex-wrap gap-3 align-items-center mt-5">
                    <div class="ms-auto lign-items-center">
                        {{ $fabrics->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')

</script>
@endpush

