@extends('layouts.masterLayout')
@section('pageTitle') Fabric List @endsection

@section('content')
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
    <a href="{{ route('fabrics.create') }}" class="btn btn-primary">+ Add Fabric</a>
    <a href="{{ route('fabrics.trash') }}" class="btn btn-warning">Trash</a>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <!-- fabrics Table -->
                <div class="table-box table-responsive">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th style="width: 40px;">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="selectAll">
                                    </div>
                                </th>
                                <th>Fabric Details</th>
                                <th>Production Type</th>
                                <th>Dyeing / Printing Method</th>
                                <th>Supplier</th>
                                <th>Available Balance</th>
                                <th>Barcode</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($fabrics as $fabric)
                            <tr>
                                <td>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox">
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="{{ $fabric->image_url }}" alt="Profile" class="avatar-md avatar-item me-1">
                                        <div>
                                            <h6 class="mb-0">{{$fabric->composition}}</h6>
                                            <small class="text-muted"><b>Fabric No: </b> {{$fabric->fabric_no}}</small><br>
                                            <small class="text-muted"><b>GSM: </b> {{$fabric->gsm}}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>{{$fabric->production_type}}</td>
                                <td>
                                    <span class="badge bg-primary bg-opacity-10 text-primary badge-subject">{{$fabric->dyeing_method}}</span>
                                    <span class="badge bg-info bg-opacity-10 text-info badge-subject">{{$fabric->printing_method}}</span>
                                </td>
                                <td>
                                    <div><i class="ri-building-line"></i> {{ $fabric->supplier->company_name ?? '-' }}</div>
                                    <div><i class="ri-mail-line me-1"></i> {{ $fabric->supplier->email ?? '-' }}</div>
                                    <div><i class="ri-phone-line me-1"></i> {{ $fabric->supplier->phone ?? '-' }}</div>
                                </td>
                                <td>
                                    <span class="badge bg-success-subtle text-success teacher-status">
                                        {{ \App\Http\Controllers\FabricController::calculateFabricBalance($fabric->id) }}
                                    </span>
                                </td>
                                <td>
                                    <img src="{{ $fabric->barcode_url }}"
                                         alt="barcode"
                                         class="avatar-xl me-1 barcode-open"
                                         data-barcode="{{ $fabric->barcode_url }}"
                                         style="cursor:pointer;">
                                </td>
                                <td>
                                    <button class="btn icon-btn-sm btn-light-primary action-btn viewFabricBtn"
                                            data-id="{{ $fabric->id }}"
                                            data-bs-toggle="tooltip" title="View Fabric">
                                        <i class="ri-eye-line"></i>
                                    </button>

                                    <a href="{{ route('fabrics.edit',$fabric->id) }}" class="btn icon-btn-sm btn-light-success action-btn">
                                          <i class="ri-edit-line"></i>
                                    </a>
                                    <form action="{{ route('fabrics.destroy',$fabric->id) }}" method="POST" class="d-inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn icon-btn-sm btn-light-danger action-btn"
                                            onclick="return confirm('Are you sure?')" data-bs-toggle="tooltip" title="Delete">
                                            <i class="ri-delete-bin-line"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="10" class="text-center text-muted">No fabrics found.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-center mt-4">
                    {{ $fabrics->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

<!-- View Fabric Modal -->
<div class="modal fade" id="viewFabricModal" tabindex="-1" aria-labelledby="viewFabricModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Fabric Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="fabricDetails" class="row">
                    <!-- Details loaded via JS -->
                    <div class="text-center py-5">
                        <div class="spinner-border text-primary" role="status"></div>
                        <p class="mt-2">Loading...</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Barcode Modal -->
<div class="modal fade" id="barcodeModal" tabindex="-1" aria-labelledby="barcodeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered text-center">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="barcodeModalLabel">Fabric Barcode</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img id="barcodePreview" src="" alt="Barcode" class="img-fluid mb-3">
                <button class="btn btn-dark" id="printBarcodeBtn">
                    <i class="bi bi-printer"></i> Print
                </button>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    // View Fabric Modal
    document.body.addEventListener('click', function (e) {
        const btn = e.target.closest('.viewFabricBtn');
        if (!btn) return;

        const fabricId = btn.dataset.id;
        const modalEl = document.getElementById('viewFabricModal');
        const fabricDetails = modalEl.querySelector('#fabricDetails');

        fabricDetails.innerHTML = `
            <div class="text-center py-5">
                <div class="spinner-border text-primary" role="status"></div>
                <p class="mt-2">Loading...</p>
            </div>
        `;

        const modal = new bootstrap.Modal(modalEl);
        modal.show();

        fetch(`/fabrics/${fabricId}/json`)
            .then(response => response.json())
            .then(fabric => {
                fabricDetails.innerHTML = `
                    <div class="col-md-4 text-center">
                        <img src="${fabric.image_url}" class="img-fluid rounded mb-3" alt="Fabric Image">
                        <h6><b>Fabric No:</b> ${fabric.fabric_no ?? '-'}</h6>
                        <h6><b>GSM:</b> ${fabric.gsm ?? '-'}</h6>
                        <h6><b>Production:</b> ${fabric.production_type ?? '-'}</h6>
                        <div class="mt-3">
                            <strong>Barcode:</strong><br>
                            <img src="${fabric.barcode_url}" class="img-fluid mt-2" alt="Barcode">
                        </div>
                    </div>
                    <div class="col-md-8">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><strong>Composition:</strong> ${fabric.composition ?? '-'}</li>
                            <li class="list-group-item"><strong>Dyeing Method:</strong> ${fabric.dyeing_method ?? '-'}</li>
                            <li class="list-group-item"><strong>Printing Method:</strong> ${fabric.printing_method ?? '-'}</li>
                            <li class="list-group-item"><strong>Supplier:</strong> ${fabric.supplier?.company_name ?? '-'}</li>
                            <li class="list-group-item"><strong>Email:</strong> ${fabric.supplier?.email ?? '-'}</li>
                            <li class="list-group-item"><strong>Phone:</strong> ${fabric.supplier?.phone ?? '-'}</li>
                        </ul>
                    </div>
                `;
            })
            .catch(() => {
                fabricDetails.innerHTML = `<p class="text-danger text-center">Failed to load fabric details.</p>`;
            });
    });

    // Barcode Modal
    const barcodeModalEl = document.getElementById('barcodeModal');
    const barcodeModal = new bootstrap.Modal(barcodeModalEl);
    const barcodePreview = document.getElementById('barcodePreview');
    const printBtn = document.getElementById('printBarcodeBtn');

    document.body.addEventListener('click', function(e) {
        const img = e.target.closest('.barcode-open');
        if (!img) return;

        const barcodeUrl = img.getAttribute('data-barcode');
        if (!barcodeUrl) return;

        barcodePreview.src = barcodeUrl;
        barcodeModal.show();
    });

    // Print barcode
    printBtn.addEventListener('click', function () {
        const printWindow = window.open('', '_blank');
        printWindow.document.write(`
            <html>
            <head><title>Print Barcode</title></head>
            <body style="text-align:center; margin:0; padding:20px;">
                <img src="${barcodePreview.src}" alt="Barcode" style="max-width:100%; height:auto;">
            </body>
            </html>
        `);
        printWindow.document.close();

        // Wait a bit and then call print
        printWindow.onload = function() {
            printWindow.focus();
            printWindow.print();
            printWindow.close();
        };
    });

});
</script>
@endpush
