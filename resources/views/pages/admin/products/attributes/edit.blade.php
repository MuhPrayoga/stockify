@extends('layouts.dashboard')

@section('content')

<div class="max-w-3xl mx-auto">

    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">
            Edit Atribut Produk
        </h1>
        <p class="text-gray-500 mt-1">
            Ubah informasi atribut yang sudah dibuat.
        </p>
    </div>

    <!-- Card -->
    <div class="bg-white shadow-sm rounded-xl border border-gray-200 p-8">

        <form id="editAttributeForm" class="space-y-6">

            <!-- Nama -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Nama Atribut
                </label>
                <input 
                    id="name"
                    type="text"
                    required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg 
                           focus:ring-2 focus:ring-blue-500 focus:border-blue-500 
                           outline-none transition"
                >
            </div>

            <!-- Type -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Tipe Atribut
                </label>

                <select 
                    id="type"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg 
                           focus:ring-2 focus:ring-blue-500 focus:border-blue-500 
                           outline-none transition bg-white"
                >
                    <option value="text">Text</option>
                    <option value="number">Number</option>
                    <option value="select">Select (Pilihan)</option>
                </select>

                <p class="text-xs text-gray-500 mt-2">
                    Perubahan tipe bisa mempengaruhi data variasi produk.
                </p>
            </div>

            <!-- Buttons -->
            <div class="flex justify-between items-center pt-4 border-t">

                <a href="/admin/products"
                   class="text-gray-500 hover:text-gray-700 text-sm font-medium">
                    ← Kembali
                </a>

                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 
                               text-white px-6 py-2 rounded-lg 
                               font-semibold shadow-sm transition">
                    Update Atribut
                </button>

            </div>

        </form>

    </div>
</div>

<script>
    const ATTRIBUTE_ID = {{ $id }};
</script>

@vite('resources/js/dashboard/admin/products/editAttribute.js')
@endsection