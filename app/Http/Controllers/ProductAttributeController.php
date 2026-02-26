<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Attribute;
use App\Models\ProductAttribute;

class ProductAttributeController extends Controller
{
    // ===============================
    // LIST ALL PRODUCT ATTRIBUTES
    // ===============================
public function list()
{
    return response()->json(
        ProductAttribute::with(['product','attribute'])->get()
    );
}

public function summary()
{
    $products = \App\Models\Product::withCount('productAttributes')->get();

    return response()->json($products);
}

    // ===============================
    // EDIT PAGE
    // ===============================
    public function edit($productId)
    {
        $product = Product::findOrFail($productId);
        $attributes = Attribute::all();

        $productAttributes = ProductAttribute::where('product_id', $productId)
            ->get()
            ->keyBy('attribute_id');

        return view(
            'pages.manager.products.productAttributes.edit',
            compact('product', 'attributes', 'productAttributes')
        );
    }

    // ===============================
    // STORE / UPDATE
    // ===============================
    public function storeOrUpdate(Request $request, $productId)
{
    $request->validate([
        'attribute_id' => 'required|exists:attributes,id',
        'value' => 'nullable|string'
    ]);

    // Kalau value kosong → delete
    if (empty($request->value)) {

        \App\Models\ProductAttribute::where([
            'product_id' => $productId,
            'attribute_id' => $request->attribute_id
        ])->delete();

        return response()->json([
            'success' => true,
            'deleted' => true
        ]);
    }

    // Kalau ada value → update/create
    \App\Models\ProductAttribute::updateOrCreate(
        [
            'product_id' => $productId,
            'attribute_id' => $request->attribute_id
        ],
        [
            'value' => $request->value
        ]
    );

    return response()->json([
        'success' => true
    ]);
}

    public function getByProduct($productId)
    {
        $attributes = \App\Models\Attribute::all();

        $productAttributes = \App\Models\ProductAttribute::where('product_id', $productId)
            ->get()
            ->keyBy('attribute_id');

        $result = $attributes->map(function ($attr) use ($productAttributes) {

            return [
                'id' => $attr->id,
                'name' => $attr->name,
                'type' => $attr->type,
                'value' => $productAttributes[$attr->id]->value ?? null
            ];
        });

        return response()->json($result);
    }
}