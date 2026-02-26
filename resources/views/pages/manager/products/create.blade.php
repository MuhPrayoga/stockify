@extends('layouts.manager.dashboard')

@section('content')

<div class="mb-10">
    <h1 class="text-3xl font-semibold text-gray-800">Tambah Produk</h1>
    <p class="text-gray-500 mt-1">Tambahkan produk baru ke dalam sistem</p>
</div>

<div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-8 max-w-4xl">

    <form id="createForm" class="space-y-8">

        {{-- INFORMASI DASAR --}}
        <div>
            <h2 class="text-lg font-semibold text-gray-700 mb-6">
                Informasi Produk
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-2">
                        Nama Produk
                    </label>
                    <input id="name"
                        class="w-full rounded-xl border border-gray-300 px-4 py-3 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition"
                        placeholder="Contoh: Laptop Asus ROG"
                        required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-2">
                        SKU
                    </label>
                    <input id="sku"
                        class="w-full rounded-xl border border-gray-300 px-4 py-3 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition"
                        placeholder="Contoh: ROG-2024"
                        required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-2">
                        Category ID
                    </label>
                    <input id="category_id" type="number"
                        class="w-full rounded-xl border border-gray-300 px-4 py-3 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition"
                        placeholder="Contoh: 4"
                        required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-2">
                        Supplier ID
                    </label>
                    <input id="supplier_id" type="number"
                        class="w-full rounded-xl border border-gray-300 px-4 py-3 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition"
                        placeholder="Contoh: 3"
                        required>
                </div>

            </div>
        </div>


        {{-- HARGA & STOK --}}
        <div>
            <h2 class="text-lg font-semibold text-gray-700 mb-6">
                Harga & Stok
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-2">
                        Harga Beli
                    </label>
                    <input id="purchase_price" type="number"
                        class="w-full rounded-xl border border-gray-300 px-4 py-3 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition"
                        placeholder="Rp"
                        required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-2">
                        Harga Jual
                    </label>
                    <input id="selling_price" type="number"
                        class="w-full rounded-xl border border-gray-300 px-4 py-3 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition"
                        placeholder="Rp"
                        required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-2">
                        Stok Minimum
                    </label>
                    <input id="minimum_stock" type="number"
                        class="w-full rounded-xl border border-gray-300 px-4 py-3 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition"
                        placeholder="Contoh: 10"
                        required>
                </div>

            </div>
        </div>


        {{-- BUTTON --}}
        <div class="pt-6 border-t border-gray-100 flex justify-end space-x-4">

            <a href="/manager/products"
               class="px-6 py-3 rounded-xl bg-gray-100 hover:bg-gray-200 text-gray-600 transition">
                Batal
            </a>

            <button type="submit"
                class="px-6 py-3 rounded-xl bg-slate-900 hover:bg-slate-800 text-white font-medium transition">
                Simpan Produk
            </button>

        </div>

    </form>

</div>

@vite('resources/js/dashboard/manager/products/createProduct.js')

@endsection