<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSupplierRequest;
use App\Http\Requests\UpdateSupplierRequest;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{

    public function index(Request $request)
    {
        $filters = $request->only(['country', 'company_name', 'rep_name', 'from', 'to', 'q']);
        $query = Supplier::query();

        if ($request->filled('q')) {
            $query->where(function ($q) use ($request) {
                $q->where('company_name', 'like', '%'.$request->q.'%')
                    ->orWhere('rep_name', 'like', '%'.$request->q.'%')
                    ->orWhere('code', 'like', '%'.$request->q.'%');
            });
        }

        $suppliers = $query->filter($filters)->orderBy('company_name')->paginate(10)->withQueryString();

        return view('suppliers.index', compact('suppliers', 'filters'));
    }


    public function create()
    {
        return view('suppliers.create');
    }


    public function store(StoreSupplierRequest $request)
    {
        $data = $request->validated();
        $supplier = Supplier::create($data);

        return redirect()->route('suppliers.index')->with('success', 'Supplier created');
    }


    public function show(Supplier $supplier)
    {
        return view('suppliers.edit', compact('supplier'));
    }


    public function edit(Supplier $supplier)
    {
        return view('suppliers.edit', compact('supplier'));
    }


    public function update(UpdateSupplierRequest $request, Supplier $supplier)
    {
        $supplier->update($request->validated());

        return redirect()->route('suppliers.index')->with('success', 'Supplier updated');
    }


    public function destroy(Supplier $supplier)
    {
        $supplier->delete();

        return back()->with('success', 'Supplier moved to trash');
    }

    public function trash(Request $request)
    {
        $trashed = Supplier::onlyTrashed()->paginate(15);

        return view('suppliers.trash', compact('trashed'));
    }

    public function restore($id)
    {
        Supplier::onlyTrashed()->where('id', $id)->restore();

        return back()->with('success', 'Supplier restored');
    }

    public function forceDelete($id)
    {
        Supplier::onlyTrashed()->where('id', $id)->forceDelete();

        return back()->with('success', 'Supplier permanently deleted');
    }
}
