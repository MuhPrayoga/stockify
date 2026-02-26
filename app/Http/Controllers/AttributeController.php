<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attribute;

class AttributeController extends Controller
{
    public function index()
    {
        return response()->json([
            'success' => true,
            'data' => Attribute::latest()->get()
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:100',
            'type' => 'required|string|max:50'
        ]);

        $attribute = Attribute::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Attribute created',
            'data' => $attribute
        ]);
    }

    public function show($id)
    {
        return response()->json([
            'success' => true,
            'data' => Attribute::findOrFail($id)
        ]);
    }

    public function update(Request $request, $id)
    {
        $attribute = Attribute::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|string|max:100',
            'type' => 'required|string|max:50'
        ]);

        $attribute->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Attribute updated',
            'data' => $attribute
        ]);
    }

    public function destroy($id)
    {
        Attribute::findOrFail($id)->delete();

        return response()->json([
            'success' => true,
            'message' => 'Attribute deleted'
        ]);
    }
}
