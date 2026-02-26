@extends('layouts.dashboard')

@section('content')

{{-- PAGE HEADER --}}
<div class="flex items-center justify-between mb-10">
    <div>
        <h1 class="text-3xl font-semibold text-gray-800">Produk</h1>
        <p class="text-gray-500 mt-1">Kelola data produk dan inventaris</p>
    </div>

    <a href="/admin/products/create"
       class="bg-slate-900 text-white px-5 py-3 rounded-xl text-sm font-medium hover:bg-slate-800 transition">
        + Tambah Produk
    </a>
</div>



{{-- ===================== PRODUCT SECTION ===================== --}}
<div class="bg-white border border-gray-200 rounded-2xl shadow-sm mb-14 overflow-hidden">

    <div class="px-6 py-5 border-b border-gray-100">
        <h2 class="text-lg font-semibold text-gray-700">Manajemen Produk</h2>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full text-sm text-left">
            <thead class="bg-gray-50 text-gray-500 uppercase text-xs tracking-wider">
                <tr>
                    <th class="px-6 py-4">Nama</th>
                    <th class="px-6 py-4">Kategori</th>
                    <th class="px-6 py-4">SKU</th>
                    <th class="px-6 py-4">Stok</th>
                    <th class="px-6 py-4">Min Stok</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-6 py-4 text-right">Aksi</th>
                </tr>
            </thead>

            <tbody id="productTable"
                class="divide-y divide-gray-100 text-gray-700">
            </tbody>
        </table>
    </div>
</div>




{{-- ===================== CATEGORY SECTION ===================== --}}
<div class="bg-white border border-gray-200 rounded-2xl shadow-sm mb-14 overflow-hidden">

    <div class="flex items-center justify-between px-6 py-5 border-b border-gray-100">
        <h2 class="text-lg font-semibold text-gray-700">Kategori Produk</h2>

        <a href="/admin/products/categories/create"
           class="bg-emerald-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-emerald-700 transition">
            + Tambah Kategori
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full text-sm text-left">
            <thead class="bg-gray-50 text-gray-500 uppercase text-xs tracking-wider">
                <tr>
                    <th class="px-6 py-4">Nama Kategori</th>
                    <th class="px-6 py-4 text-right">Aksi</th>
                </tr>
            </thead>

            <tbody id="categoryTable"
                class="divide-y divide-gray-100 text-gray-700">
            </tbody>
        </table>
    </div>
</div>




{{-- ===================== ATTRIBUTE SECTION ===================== --}}
<div class="bg-white border border-gray-200 rounded-2xl shadow-sm mb-10 overflow-hidden">

    <div class="flex items-center justify-between px-6 py-5 border-b border-gray-100">
        <h2 class="text-lg font-semibold text-gray-700">Atribut Produk</h2>

        <a href="/admin/products/attributes/create"
           class="bg-amber-500 text-white px-4 py-2 rounded-lg text-sm hover:bg-amber-600 transition">
            + Tambah Atribut
        </a>
    </div>

    <div>

        <table class="min-w-full text-sm text-left">
            <thead class="bg-gray-50 text-gray-500 uppercase text-xs tracking-wider">
                <tr>
                    <th class="px-6 py-4">Nama Atribut</th>
                    <th class="px-6 py-4">Input Nilai</th>
                    <th class="px-6 py-4 text-right">Aksi</th>
                </tr>
            </thead>

            <tbody id="attributeTable"
                class="divide-y divide-gray-100 text-gray-700">
            </tbody>
        </table>
    </div>
</div>



{{-- JS --}}
@vite('resources/js/dashboard/admin/products/index.js')
@vite('resources/js/dashboard/admin/products/categories.js')
@vite('resources/js/dashboard/admin/products/attributes.js')

@endsection