<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFabricRequest;
use App\Http\Requests\UpdateFabricRequest;
use App\Models\Fabric;
use App\Models\FabricStock;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Milon\Barcode\DNS1D;

class FabricController extends Controller
{
    public function index(Request $request)
    {
        $query = Fabric::with('supplier');

        // Filters
        if ($request->filled('company')) {
            $query->whereHas('supplier', function ($q) use ($request) {
                $q->where('company_name', 'like', "%{$request->company}%");
            });
        }

        if ($request->filled('fabric_no')) {
            $query->where('fabric_no', 'like', "%{$request->fabric_no}%");
        }

        if ($request->filled('composition')) {
            $query->where('composition', 'like', "%{$request->composition}%");
        }

        if ($request->filled('production_type')) {
            $query->where('production_type', $request->production_type);
        }

        $fabrics = $query->paginate(10);

        return view('fabrics.index', compact('fabrics'));
    }

    public function create()
    {
        $suppliers = Supplier::all();

        return view('fabrics.create', compact('suppliers'));
    }

    public function store(StoreFabricRequest $request)
    {

        $data = $request->all();

        // Handle image upload
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('fabrics', 'public');
            $data['image_path'] = $path;
        }
        $data['barcode'] = uniqid('FAB'); // generate barcode
        $data['added_by'] = 1;
        $data['added_date'] = now();

        $fabric = Fabric::create($data);

        return redirect()->route('fabrics.index')->with('success', 'Fabric added successfully.');
    }

    public function edit(Fabric $fabric)
    {
        $suppliers = Supplier::all();

        return view('fabrics.edit', compact('fabric', 'suppliers'));
    }

    public function update(UpdateFabricRequest $request, Fabric $fabric)
    {

        $data = $request->all();

        if ($request->hasFile('image')) {
            // Delete old file
            if ($fabric->image_path) {
                Storage::disk('public')->delete($fabric->image_path);
            }

            $data['image_path'] = $request->file('image')->store('fabrics', 'public');
        }

        $data['updated_by'] = 1;
        $data['updated_date'] = now();

        $fabric->update($data);

        return redirect()->route('fabrics.index')->with('success', 'Fabric updated successfully.');
    }

    // Delete fabric
    public function destroy(Fabric $fabric)
    {
        if ($fabric->image) {
            Storage::disk('public')->delete($fabric->image);
        }
        $fabric->delete();

        return redirect()->route('fabrics.index')->with('success', 'Fabric deleted successfully.');
    }

    // Barcode view
    public function barcode($id)
    {
        $fabric = Fabric::findOrFail($id);

        $barcode = new DNS1D;
        $barcode->setStorPath(public_path('barcodes/'));
        $barcodeImage = $barcode->getBarcodePNG($fabric->barcode, 'C39');

        return view('fabrics.barcode', compact('fabric', 'barcodeImage'));
    }

    // Helper: calculate balance
    public static function calculateFabricBalance($fabricId)
    {
        $in = FabricStock::where('fabric_id', $fabricId)->where('type', 'in')->sum('qty');
        $out = FabricStock::where('fabric_id', $fabricId)->where('type', 'out')->sum('qty');

        return $in - $out;
    }

    public function trash()
    {
        $fabrics = Fabric::onlyTrashed()->with('supplier')->paginate(10);

        return view('fabrics.trash', compact('fabrics'));
    }

    // Restore a soft deleted fabric
    public function restore($id)
    {
        $fabric = Fabric::onlyTrashed()->findOrFail($id);
        $fabric->restore();

        return redirect()->route('fabrics.trash')->with('success', 'Fabric restored successfully.');
    }

    // Permanently delete a fabric
    public function forceDelete($id)
    {
        $fabric = Fabric::onlyTrashed()->findOrFail($id);

        // Delete image from storage
        if ($fabric->image_path) {
            Storage::disk('public')->delete($fabric->image_path);
        }

        $fabric->forceDelete();

        return redirect()->route('fabrics.trash')->with('success', 'Fabric permanently deleted.');
    }
}
