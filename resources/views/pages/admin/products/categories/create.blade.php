@extends('layouts.dashboard')

@section('content')

<div class="max-w-3xl mx-auto">

    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">
            Tambah Kategori Produk
        </h1>
        <p class="text-gray-500 mt-1">
            Buat kategori baru untuk mengelompokkan produk.
        </p>
    </div>

    <!-- Card -->
    <div class="bg-white shadow-sm rounded-xl border border-gray-200 p-8">

        <form id="createCategoryForm" class="space-y-6">

            <!-- Nama -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Nama Kategori
                </label>
                <input 
                    id="name"
                    type="text"
                    required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg 
                           focus:ring-2 focus:ring-green-500 focus:border-green-500 
                           outline-none transition"
                    placeholder="Contoh: Elektronik"
                >
            </div>

            <!-- Deskripsi -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Deskripsi
                </label>
                <textarea 
                    id="description"
                    rows="4"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg 
                           focus:ring-2 focus:ring-green-500 focus:border-green-500 
                           outline-none transition"
                    placeholder="Deskripsi kategori (opsional)"
                ></textarea>
            </div>

            <!-- Buttons -->
            <div class="flex justify-between items-center pt-4 border-t">

                <a href="/admin/products"
                   class="text-gray-500 hover:text-gray-700 text-sm font-medium">
                    ← Kembali
                </a>

                <button type="submit"
                        class="bg-green-600 hover:bg-green-700 
                               text-white px-6 py-2 rounded-lg 
                               font-semibold shadow-sm transition">
                    Simpan Kategori
                </button>

            </div>

        </form>

    </div>
</div>

@vite('resources/js/dashboard/admin/products/createCategory.js')
@endsection