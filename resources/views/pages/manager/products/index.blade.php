@extends('layouts.manager.dashboard')

@section('content')

{{-- PAGE HEADER --}}
<div class="flex items-center justify-between mb-10">
    <div>
        <h1 class="text-3xl font-semibold text-gray-800">Produk</h1>
        <p class="text-gray-500 mt-1">Kelola data produk dan inventaris</p>
    </div>

    <a href="/manager/products/create"
       class="bg-slate-900 text-white px-5 py-3 rounded-xl text-sm font-medium hover:bg-slate-800 transition">
        + Tambah Produk
    </a>

</div>

{{-- ===================== PRODUCT SECTION ===================== --}}
<div class="bg-white border border-gray-200 rounded-2xl shadow-sm mb-14 overflow-hidden">

    <div class="px-6 py-5 border-b border-gray-100">
        <h2 class="text-lg font-semibold text-gray-700">Daftar Produk</h2>
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

<!-- Ringkasan Attribute -->

<div class="bg-white border rounded-2xl shadow-sm p-6 mt-10">

    <h2 class="text-lg font-semibold mb-6">
        Ringkasan Product Attributes
    </h2>

    <div class="overflow-x-auto">
        <table class="min-w-full text-sm text-left">
            <thead class="bg-gray-50 text-gray-500 uppercase text-xs">
                <tr>
                    <th class="px-6 py-4">Nama Produk</th>
                    <th class="px-6 py-4">Total Attribute</th>
                    <th class="px-6 py-4 text-right">Aksi</th>
                </tr>
            </thead>

            <tbody id="attributeSummaryTable"
                class="divide-y divide-gray-100 text-gray-700">
            </tbody>
        </table>
    </div>

</div>


{{-- JS --}}
@vite('resources/js/dashboard/manager/products/index.js')
@vite('resources/js/dashboard/manager/products/productAttribute.js')

@endsection