@extends('layouts.masterLayout')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-3">
            <div class="card report-card">
                <div class="card-body">
                    <div class="row d-flex justify-content-center">
                        <div class="col">
                            <p class="text-dark mb-1 font-weight-semibold">Total Suppliers</p>
                            <h3 class="my-2">{{ $activeSuppliers }}</h3>
                        </div>
                    </div>
                </div><!--end card-body-->
            </div><!--end card-->
        </div> <!--end col-->
        <div class="col-md-6 col-lg-3">
            <div class="card report-card">
                <div class="card-body">
                    <div class="row d-flex justify-content-center">
                        <div class="col">
                            <p class="text-dark mb-1 font-weight-semibold">Deleted Suppliers</p>
                            <h3 class="my-2">{{ $deletedSuppliers }}</h3>
                        </div>
                    </div>
                </div><!--end card-body-->
            </div><!--end card-->
        </div> <!--end col-->
        <div class="col-md-6 col-lg-3">
            <div class="card report-card">
                <div class="card-body">
                    <div class="row d-flex justify-content-center">
                    <div class="col">
                        <p class="text-dark mb-1 font-weight-semibold">Total Fabrics</p>
                        <h3 class="my-2">{{ $activeFabrics }}</h3>
                    </div>
                </div>
                </div><!--end card-body-->
            </div><!--end card-->
        </div> <!--end col-->
        <div class="col-md-6 col-lg-3">
            <div class="card report-card">
                <div class="card-body">
                    <div class="row d-flex justify-content-center">
                        <div class="col">
                            <p class="text-dark mb-1 font-weight-semibold">Deleted Fabrics</p>
                            <h3 class="my-2">{{ $deletedFabrics }}</h3>
                        </div>
                    </div>
                </div><!--end card-body-->
            </div><!--end card-->
        </div> <!--end col-->
    </div><!--end row-->
    <div class="row">
    <div class="col-md-6">
        <h5>Suppliers</h5>
        <div id="supplier-chart"></div>
    </div>
    <div class="col-md-6">
        <h5>Fabrics</h5>
        <div id="fabric-chart"></div>
    </div>
</div>
@endsection
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Supplier Chart
        var supplierOptions = {
            chart: { type: 'donut', height: 250 },
            labels: ['Active', 'Deleted'],
            series: @json($supplierData),
            colors: ['#28a745', '#dc3545']
        };
        new ApexCharts(document.querySelector("#supplier-chart"), supplierOptions).render();

        // Fabric Chart
        var fabricOptions = {
            chart: { type: 'donut', height: 250 },
            labels: ['Active', 'Deleted'],
            series: @json($fabricData),
            colors: ['#007bff', '#ffc107']
        };
        new ApexCharts(document.querySelector("#fabric-chart"), fabricOptions).render();
    });
</script>

@endpush
