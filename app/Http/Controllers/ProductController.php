<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Services\ActivityLogService;

class ProductController extends Controller
{
    protected $activityLog;

    public function __construct(ActivityLogService $activityLog)
    {
        $this->activityLog = $activityLog;
    }

    // ================= READ =================
    public function index()
    {
        $products = Product::with(['category', 'supplier'])->get();

        return response()->json([
            'success' => true,
            'message' => 'Product list retrieved',
            'data' => $products
        ]);
    }

    // ================= CREATE =================
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'supplier_id' => 'required|exists:suppliers,id',
            'name' => 'required|string|max:255',
            'sku' => 'required|string|unique:products,sku',
            'purchase_price' => 'required|numeric|min:0',
            'selling_price' => 'required|numeric|min:0',
            'minimum_stock' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|string'
        ]);

        $product = Product::create($validated);

        // ACTIVITY LOG
        $this->activityLog->log(
            'CREATE_PRODUCT',
            'Menambahkan produk baru: ' . $product->name
        );

        return response()->json([
            'success' => true,
            'message' => 'Product created successfully',
            'data' => $product
        ], 201);
    }

    // ================= READ DETAIL =================
    public function show($id)
    {
        $product = Product::with(['category', 'supplier'])->findOrFail($id);

        return response()->json([
            'success' => true,
            'message' => 'Product detail retrieved',
            'data' => $product
        ]);
    }

    // ================= UPDATE =================
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'category_id' => 'sometimes|exists:categories,id',
            'supplier_id' => 'sometimes|exists:suppliers,id',
            'name' => 'sometimes|string|max:255',
            'sku' => 'sometimes|string|unique:products,sku,' . $product->id,
            'purchase_price' => 'sometimes|numeric|min:0',
            'selling_price' => 'sometimes|numeric|min:0',
            'minimum_stock' => 'sometimes|integer|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|string'
        ]);

        $product->update($validated);

        // ACTIVITY LOG
        $this->activityLog->log(
            'UPDATE_PRODUCT',
            'Memperbarui produk: ' . $product->name
        );

        return response()->json([
            'success' => true,
            'message' => 'Product updated successfully',
            'data' => $product
        ]);
    }

    // ================= DELETE =================
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $productName = $product->name;

        $product->delete();

        // ACTIVITY LOG
        $this->activityLog->log(
            'DELETE_PRODUCT',
            'Menghapus produk: ' . $productName
        );

        return response()->json([
            'success' => true,
            'message' => 'Product deleted successfully'
        ]);
    }
}
