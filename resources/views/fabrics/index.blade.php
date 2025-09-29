@extends('layouts.masterLayout')
@section('pageTitle') suppliers List @endsection

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0">Fabric List</h2>
        <a href="{{ route('fabrics.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Add Fabric
        </a>
    </div>

    <!-- Filters -->
    <form method="GET" class="row g-2 mb-4">
        <div class="col-md-3">
            <input type="text" name="company" class="form-control" placeholder="Company"
                   value="{{ request('company') }}">
        </div>
        <div class="col-md-2">
            <input type="text" name="fabric_no" class="form-control" placeholder="Fabric No"
                   value="{{ request('fabric_no') }}">
        </div>
        <div class="col-md-3">
            <input type="text" name="composition" class="form-control" placeholder="Composition"
                   value="{{ request('composition') }}">
        </div>
        <div class="col-md-2">
            <select name="production_type" class="form-select form-control">
                <option value="">Production Type</option>
                <option value="Sample Yardage" {{ request('production_type')=='Sample Yardage'?'selected':'' }}>Sample Yardage</option>
                <option value="SMS" {{ request('production_type')=='SMS'?'selected':'' }}>SMS</option>
                <option value="Bulk" {{ request('production_type')=='Bulk'?'selected':'' }}>Bulk</option>
            </select>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-dark w-100">
                <i class="bi bi-search"></i> Filter
            </button>
        </div>
    </form>

    <!-- Table -->
    <div class="table-responsive ">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-dark text-center">
                <tr>
                    <th>Fabric No</th>
                    <th>Supplier</th>
                    <th>Composition</th>
                    <th>GSM</th>
                    <th>QTY</th>
                    <th>Available Balance</th>
                    <th>Production Type</th>
                    <th>Image</th>
                    <th>Barcode</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($fabrics as $fabric)
                <tr>
                    <td>{{ $fabric->fabric_no }}</td>
                    <td>{{ $fabric->supplier->company_name ?? '-' }}</td>
                    <td>{{ $fabric->composition }}</td>
                    <td>{{ $fabric->gsm }}</td>
                    <td>{{ $fabric->qty }}</td>
                    <td class="fw-bold text-success">
                        {{ \App\Http\Controllers\FabricController::calculateFabricBalance($fabric->id) }}
                    </td>
                    <td>{{ $fabric->production_type }}</td>
                    <td>
                        @if($fabric->image_path)
                            <img src="{{ asset('storage/'.$fabric->image_path) }}" class="img-thumbnail" width="60">
                        @endif
                    </td>
                    <td class="text-center">
                        <a href="{{ route('fabrics.barcode',$fabric->id) }}" class="btn btn-sm btn-dark">
                            <i class="bi bi-upc-scan"></i> Barcode
                        </a>
                    </td>
                    <td class="text-center">
                        <a href="{{ route('fabrics.edit',$fabric->id) }}" class="btn btn-sm btn-warning">
                            <i class="bi bi-pencil-square">Edit</i>
                        </a>
                        <form action="{{ route('fabrics.destroy',$fabric->id) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger"
                                onclick="return confirm('Are you sure?')">
                                <i class="bi bi-trash">Trash</i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="10" class="text-center text-muted">No fabrics found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center">
        {{ $fabrics->links() }}
    </div>
</div>
@endsection
@push('scripts')

@endpush
