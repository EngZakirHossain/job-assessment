@extends('layouts.masterLayout')
@section('pageTitle') Suppliers List @endsection
@push('styles')
<!-- Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

@endpush
@section('content')
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
        <button class="btn btn-primary btn-add" data-bs-toggle="modal" data-bs-target="#supplierModal">
            <i class="ri-add-line me-1"></i>Add Supplier
        </button>
        <a href="{{ route('suppliers.trash') }}" class="btn btn-warning">Trash</a>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <div class="table-box table-responsive">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>SN</th>
                                    <th>Company</th>
                                    <th>Country</th>
                                    <th>Code</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Added By</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($suppliers as $supplier)
                                <tr>
                                    <td>#SUP-{{ str_pad($supplier->id, 4, '0', STR_PAD_LEFT) }}</td>
                                    <td class="d-flex align-items-center">
                                        <span>{{ $supplier->company_name }}</span>
                                    </td>
                                    <td>{{ $supplier->country }}</td>
                                    <td>{{ $supplier->code }}</td>
                                    <td>{{ $supplier->email }}</td>
                                    <td>{{ $supplier->phone }}</td>
                                    <td>{{ $supplier->addedByUser?->name ?? 'N/A' }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-primary editSupplierBtn" data-id="{{ $supplier->id }}">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <button class="btn btn-sm btn-info viewSupplierBtn" data-id="{{ $supplier->id }}">
                                            <i class="bi bi-eye"></i>
                                        </button>

                                        <form action="{{ route('suppliers.destroy', $supplier) }}" method="POST" class="d-inline"
                                            onsubmit="return confirm('Move this supplier to trash?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="10" class="text-center text-muted">No suppliers found</td>
                                </tr>
                            @endforelse

                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-center mt-4">
                        {{ $suppliers->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="supplierModal" tabindex="-1" aria-labelledby="supplierModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="supplierModalLabel">Add Supplier</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form id="supplierForm">
                        @csrf
                        <input type="hidden" name="id" id="supplier_id">

                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label">Country *</label>
                                <input type="text" class="form-control" name="country" id="country" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Company/Factory Name *</label>
                                <input type="text" class="form-control" name="company_name" id="company_name" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Code *</label>
                                <input type="text" class="form-control" name="code" id="code" required>
                            </div>

                            <div class="col-md-4">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email" id="email">
                            </div>
                            <div class="col-md-4">
                                <label>Phone</label>
                                <input type="text" class="form-control" name="phone" id="phone">
                            </div>
                            <div class="col-md-4">
                                <label>Address</label>
                                <input type="text" class="form-control" name="address" id="address">
                            </div>

                            <div class="col-md-4">
                                <label>Representative Name</label>
                                <input type="text" class="form-control" name="rep_name" id="rep_name">
                            </div>
                            <div class="col-md-4">
                                <label>Representative Email</label>
                                <input type="email" class="form-control" name="rep_email" id="rep_email">
                            </div>
                            <div class="col-md-4">
                                <label>Representative Phone</label>
                                <input type="text" class="form-control" name="rep_phone" id="rep_phone">
                            </div>
                        </div>

                        <div class="mt-3" id="supplierFormAlert"></div>
                    </form>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="saveSupplierBtn">Save Supplier</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="viewSupplierModal" tabindex="-1" aria-labelledby="viewSupplierModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewSupplierModalLabel">Supplier Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="card border shadow-sm">
                <div class="card-body d-flex flex-column align-items-center text-center">
                    <!-- Optional avatar -->
                    <img src="{{asset('backend/assets')}}/images/avatar/dummy-avatar.jpg" alt="Supplier Avatar" class="rounded avatar-xl mb-4">

                    <h5 class="mb-1" id="view_company_name"></h5>
                    <p class="text-muted mb-3 fs-12">Supplier Code: <span class="fw-semibold" id="view_code"></span></p>
                    <span class="badge bg-primary-subtle text-primary" id="view_country"></span>

                    <ul class="list-group list-borderless w-100 my-4">
                    <li class="list-group-item d-flex justify-content-between">
                        <strong>Email:</strong> <span id="view_email"></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <strong>Phone:</strong> <span id="view_phone"></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <strong>Address:</strong> <span id="view_address"></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <strong>Representative Name:</strong> <span id="view_rep_name"></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <strong>Representative Email:</strong> <span id="view_rep_email"></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <strong>Representative Phone:</strong> <span id="view_rep_phone"></span>
                    </li>
                    </ul>

                    <!-- Optional extra info / action -->
                    <div class="w-100 p-4 rounded bg-info-subtle text-center">
                    <h6 class="fs-16 mb-2">Special Note</h6>
                    <p class="mb-0 fs-13"></p>
                    </div>
                </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
$(document).ready(function () {
    // Open Add Supplier Modal
    $("#addSupplierBtn").on("click", function() {
        $("#supplierModalLabel").text("Add Supplier");
        $("#saveSupplierBtn").text("Save Supplier");
        $("#supplierForm")[0].reset();
        $("#supplier_id").val("");
        $("#supplierFormAlert").html('');
        $("#supplierModal").modal("show");
    });

    // Open Edit Supplier Modal
    $(".editSupplierBtn").on("click", function() {
        let supplierId = $(this).data("id");

        $.ajax({
            url: "/suppliers/" + supplierId + "/json",
            method: "GET",
            success: function(supplier) {
                $("#supplierModalLabel").text("Edit Supplier");
                $("#saveSupplierBtn").text("Update Supplier");
                $("#supplier_id").val(supplier.id);
                $("#country").val(supplier.country);
                $("#company_name").val(supplier.company_name);
                $("#code").val(supplier.code);
                $("#email").val(supplier.email);
                $("#phone").val(supplier.phone);
                $("#address").val(supplier.address);
                $("#rep_name").val(supplier.rep_name);
                $("#rep_email").val(supplier.rep_email);
                $("#rep_phone").val(supplier.rep_phone);

                $("#supplierFormAlert").html('');
                $("#supplierModal").modal("show");
            },
            error: function() {
                alert("Failed to load supplier data.");
            }
        });
    });

    // Save / Update Supplier
    $("#saveSupplierBtn").on("click", function() {
        let supplierId = $("#supplier_id").val();
        let method = supplierId ? "PUT" : "POST";
        let url = supplierId ? "/suppliers/" + supplierId : "/suppliers";

        $.ajax({
            url: url,
            method: method,
            data: $("#supplierForm").serialize(),
            success: function() {
                $("#supplierModal").modal("hide");
                location.reload();
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    let alertHtml = '<div class="alert alert-danger"><ul>';
                    $.each(errors, function(key, value) {
                        alertHtml += '<li>' + value[0] + '</li>';
                    });
                    alertHtml += '</ul></div>';
                    $("#supplierFormAlert").html(alertHtml);
                } else {
                    alert("Something went wrong.");
                }
            }
        });
    });

    $(document).on("click", ".viewSupplierBtn", function() {
        let supplierId = $(this).data("id");

        $.ajax({
            url: "/suppliers/" + supplierId + "/json",
            method: "GET",
            success: function(supplier) {
                $("#view_company_name").text(supplier.company_name);
                $("#view_code").text(supplier.code);
                $("#view_country").text(supplier.country);
                $("#view_email").text(supplier.email || 'N/A');
                $("#view_phone").text(supplier.phone || 'N/A');
                $("#view_address").text(supplier.address || 'N/A');
                $("#view_rep_name").text(supplier.rep_name || 'N/A');
                $("#view_rep_email").text(supplier.rep_email || 'N/A');
                $("#view_rep_phone").text(supplier.rep_phone || 'N/A');

                $("#viewSupplierModal").modal("show");
            },
            error: function() {
                alert("Failed to load supplier details.");
            }
        });
    });

});
</script>
@endpush
