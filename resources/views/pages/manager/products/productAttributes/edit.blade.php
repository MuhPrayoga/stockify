@extends('layouts.manager.dashboard')

@section('content')

<div class="bg-white border rounded-2xl shadow-sm p-6">



    <h2 class="text-lg font-semibold mb-6">
        Kelola Attribute Product
    </h2>

    <input type="hidden" id="productId" value="{{ $productId }}">

    <div class="overflow-x-auto">
        <table class="min-w-full text-sm text-left">
            <thead class="bg-gray-50 text-gray-500 uppercase text-xs">
                <tr>
                    <th class="px-6 py-4">Attribute</th>
                    <th class="px-6 py-4">Value</th>
                    <th class="px-6 py-4 text-right">Aksi</th>
                </tr>
            </thead>

            <tbody id="attributeTable"
                class="divide-y divide-gray-100 text-gray-700">
            </tbody>

        </table>
        <a href="/manager/products"
            class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-600 bg-gray-100 rounded-xl hover:bg-gray-200 transition">
                ← Kembali ke Products
        </a>
    </div>

</div>

@vite('resources/js/dashboard/manager/products/attribute.js')

@endsection