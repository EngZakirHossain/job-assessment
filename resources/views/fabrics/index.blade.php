@extends('layouts.masterLayout')
@section('pageTitle') Fabric List @endsection

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0">Fabric List</h2>
    </div>

    <!-- Filters -->
    <form method="GET" class="row g-2 mb-4">
        <div class="col-md-3">
            <input type="text" name="supplier" class="form-control" placeholder="Supplier"
                   value="{{ request('supplier') }}">
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
                <option value="Dyeing" {{ request('production_type')=='Dyeing'?'selected':'' }}>Dyeing</option>
                <option value="Knitting" {{ request('production_type')=='Knitting'?'selected':'' }}>Knitting</option>
                <option value="Weaving" {{ request('production_type')=='Weaving'?'selected':'' }}>Weaving</option>
            </select>
        </div>
        <div class="col-md-2 d-flex gap-2">
            <button class="btn btn-primary">Filter</button>
            <a href="{{ route('fabrics.index') }}" class="btn btn-secondary">Reset</a>
        </div>
    </form>

    <div class="mb-3">
        <a href="{{ route('fabrics.create') }}" class="btn btn-success">+ Add Fabric</a>
        <a href="{{ route('fabrics.trash') }}" class="btn btn-warning">Trash</a>
    </div>

    <!-- Table -->
    <div class="table-responsive ">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-dark text-center">
                <tr>
                    <th>#</th>
                    <th>Fabric No</th>
                    <th>Supplier</th>
                    <th>Composition</th>
                    <th>GSM</th>
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
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $fabric->fabric_no }}</td>
                    <td>{{ $fabric->supplier->company_name ?? '-' }}</td>
                    <td>{{ $fabric->composition }}</td>
                    <td>{{ $fabric->gsm }}</td>
                    <td class="fw-bold text-success">
                        {{ \App\Http\Controllers\FabricController::calculateFabricBalance($fabric->id) }}
                    </td>
                    <td>{{ $fabric->production_type }}</td>
                    <td>
                        @if($fabric->image_path && file_exists(storage_path('app/public/'.$fabric->image_path)))
                            <img src="{{ asset('storage/'.$fabric->image_path) }}" class="img-thumbnail mb-2" width="100">
                        @else
                            <img src="{{ asset('assets/images/default.jpg') }}" class="img-thumbnail mb-2" width="100">
                        @endif
                    </td>
                    <td class="text-center">
                        <a href="{{ route('fabrics.barcode',$fabric->id) }}" class="btn btn-sm btn-dark">
                            <i class="bi bi-upc-scan"></i> Barcode
                        </a>
                    </td>
                    <td class="text-center">
                        <a href="{{ route('fabrics.show',$fabric->id) }}" class="btn btn-sm btn-warning">
                            <i class="bi bi-pencil-square">Show</i>
                        </a>
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
