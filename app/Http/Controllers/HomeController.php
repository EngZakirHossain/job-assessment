<?php

namespace App\Http\Controllers;

use App\Models\Fabric;
use App\Models\Supplier;
use App\Models\FabricStock;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $activeSuppliers = Supplier::count();
        $deletedSuppliers = Supplier::onlyTrashed()->count();

        $activeFabrics = Fabric::count();
        $deletedFabrics = Fabric::onlyTrashed()->count();

        $supplierData = [$activeSuppliers, $deletedSuppliers];
        $fabricData = [$activeFabrics, $deletedFabrics];

        $totalIn  = FabricStock::where('type', 'in')->sum('qty');
        $totalOut = FabricStock::where('type', 'out')->sum('qty');
        $fabricBalance = $totalIn - $totalOut;

        return view('dashboard', compact(
            'activeSuppliers',
            'deletedSuppliers',
            'activeFabrics',
            'deletedFabrics',
            'supplierData',
            'fabricData',
            'fabricBalance'
        ));
    }
}
