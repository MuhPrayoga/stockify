@extends('layouts.manager.dashboard')

@section('content')

<div class="mb-10">
    <h1 class="text-3xl font-semibold text-gray-800">Edit Produk</h1>
    <p class="text-gray-500 mt-1">Perbarui informasi produk</p>
</div>

<div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-8 max-w-4xl">

    <form id="editForm" class="space-y-8">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <div>
                <label class="block text-sm font-medium text-gray-600 mb-2">
                    Nama Produk
                </label>
                <input id="name"
                    class="w-full rounded-xl border border-gray-300 px-4 py-3 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-600 mb-2">
                    Category
                </label>
                <input id="category_id" type="number"
                    class="w-full rounded-xl border border-gray-300 px-4 py-3 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-600 mb-2">
                    SKU
                </label>
                <input id="sku"
                    class="w-full rounded-xl border border-gray-300 px-4 py-3 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition">
            </div>  

            <div>
                <label class="block text-sm font-medium text-gray-600 mb-2">
                    Harga Beli
                </label>
                <input id="purchase_price" type="number"
                    class="w-full rounded-xl border border-gray-300 px-4 py-3 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-600 mb-2">
                    Harga Jual
                </label>
                <input id="selling_price" type="number"
                    class="w-full rounded-xl border border-gray-300 px-4 py-3 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-600 mb-2">
                    Stok Minimum
                </label>
                <input id="minimum_stock" type="number"
                    class="w-full rounded-xl border border-gray-300 px-4 py-3 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition">
            </div>

        </div>

        <div class="pt-6 border-t border-gray-100 flex justify-end space-x-4">

            <a href="/manager/products"
               class="px-6 py-3 rounded-xl bg-gray-100 hover:bg-gray-200 text-gray-600 transition">
                Batal
            </a>

            <button
                class="px-6 py-3 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-medium transition">
                Simpan Perubahan
            </button>

        </div>

    </form>

</div>

<script>
    const PRODUCT_ID = {{ $id }};
</script>

@vite('resources/js/dashboard/manager/products/editProduct.js')

@endsection