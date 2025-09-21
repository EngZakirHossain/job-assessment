<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSaleRequest;
use App\Models\Product;
use App\Models\Sale;
use App\Models\User;
use App\Services\SaleService;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    protected $saleService;

    public function __construct(SaleService $saleService)
    {
        $this->saleService = $saleService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Sale::with('customer', 'items.product', 'notes')->latest();

        if ($request->filled('customer_id')) {
            $query->where('user_id', $request->customer_id);
        }

        if ($request->filled('sale_date')) {
            $query->whereDate('sale_date', '>=', $request->sale_date);
        }

        if ($request->filled('product_name')) {
            $productName = $request->product_name;
            $query->whereHas('items.product', function ($q) use ($productName) {
                $q->where('name', 'like', "%{$productName}%");
            });
        }

        $sales = $query->paginate(10);
        $customers = User::all();

        $pageTotal = $sales->sum(function ($sale) {
            return $sale->grand_total;
        });

        return view('sales.index', compact('sales', 'customers', 'pageTotal'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customers = User::all();
        $products = Product::all();

        return view('sales.create', compact('customers', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSaleRequest $request)
    {
        $data = $request->all();

        $saleData = [
            'user_id' => $data['user_id'],
            'sale_date' => $data['sale_date'],
        ];
        $items = $data['items'];

        $sale = $this->saleService->createSale(saleData: $saleData, itemsData: $items);
        if (! empty($data['notes'])) {
            $sale->notes()->create([
                'content' => $data['notes'],
            ]);
        }

        return response()->json([
            'success' => true,
            'data' => $sale->load('notes'),
            'message' => 'Sale created successfully.',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Sale $sale)
    {
        $sale->load([
            'customer',
            'items.product',
            'notes',
        ]);

        return view('sales.show', compact('sale'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sale $sale)
    {
        $customers = User::all();
        $products = Product::all();
        $sale->load('items.product', 'notes');

        return view('sales.edit', compact('sale', 'customers', 'products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sale $sale)
    {
        $data = $request->validate([
            'customer_id' => 'required|exists:users,id',
            'date' => 'required|date',
            'notes' => 'nullable|string',
            'items' => 'required|array|min:1',
            'items.*.id' => 'nullable|exists:sale_items,id',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|numeric|min:1',
            'items.*.unit_price' => 'required|numeric|min:0',
            'items.*.discount' => 'nullable|numeric|min:0',
        ]);

        $saleData = [
            'user_id' => $data['customer_id'],
            'sale_date' => $data['date'],
        ];

        $items = $data['items'];

        $updatedSale = $this->saleService->updateSale(sale: $sale, saleData: $saleData, itemsData: $items);

        if (! empty($data['notes'])) {
            $note = $sale->notes()->first();
            if ($note) {
                $note->update([
                    'content' => $data['notes'],
                ]);
            } else {
                $sale->notes()->create([
                    'content' => $data['notes'],
                ]);
            }
        }

        return response()->json([
            'success' => true,
            'data' => $updatedSale->load('notes'),
            'message' => 'Sale updated successfully.',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sale $sale)
    {
        $sale->delete();

        return response()->json([
            'success' => true,
            'message' => 'Sale deleted (soft deleted)',
        ]);
    }

    public function getProductPrice($id)
    {
        $product = Product::findOrFail($id);

        return response()->json(['price' => $product->price]);
    }

    public function trash(Request $request)
    {
        $sales = Sale::onlyTrashed()->with('customer')->latest()->paginate(10);

        return view('sales.trash', compact('sales'));
    }

    public function restore($id)
    {
        $sale = Sale::onlyTrashed()->findOrFail($id);
        $sale->restore();
        $sale->items()->withTrashed()->restore();

        return response()->json(['success' => true, 'message' => 'Sale restored.']);
    }

    public function forceDelete($id)
    {
        $sale = Sale::onlyTrashed()->findOrFail($id);
        $sale->items()->withTrashed()->forceDelete();
        $sale->forceDelete();

        return response()->json(['success' => true, 'message' => 'Sale permanently deleted.']);
    }
}
