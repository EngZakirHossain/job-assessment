@extends('layouts.masterLayout')
@section('pageTitle') Home @endsection
@section('content')
<div class="row">
    <div class="col-xxl-8">
        <div class="row h-100">
            <div class="col-xl-4 col-sm-6">
                <div class="card card-h-100">
                    <div class="card-body d-flex align-items-center justify-content-around">
                        <div class="h-48px w-50px position-relative d-flex justify-content-center align-items-center text-primary fs-4 rounded-3 shadow-lg border">
                            <i class="bi bi-person-badge"></i>
                        </div>
                        <div>
                            <h3>{{ $activeSuppliers }} <i class="bi bi-graph-up-arrow text-success fw-normal fs-5"></i></h3>
                            <span class="fs-5">Total Supplier</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-sm-6">
                <div class="card card-h-100">
                    <div class="card-body d-flex align-items-center justify-content-around">
                        <div class="h-48px w-50px position-relative d-flex justify-content-center align-items-center text-primary fs-4 rounded-3 shadow-lg border">
                            <i class="bi bi-scissors"></i>
                        </div>
                        <div>
                            <h3>{{ $activeFabrics }} <i class="bi bi-graph-up-arrow text-success fw-normal fs-5"></i></h3>
                            <span class="fs-5">Total Fabrics</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-sm-6">
                <div class="card card-h-100">
                    <div class="card-body d-flex align-items-center justify-content-around">
                        <div class="h-48px w-48px position-relative d-flex justify-content-center align-items-center text-primary fs-4 rounded-3 shadow-lg border">
                            <i class="bi bi-graph-up-arrow"></i>
                        </div>
                        <div>
                            <h3>{{$fabricBalance}}</h3>
                            <span class="fs-5">Overall Balance</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
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
