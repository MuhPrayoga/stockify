@extends('layouts.dashboard')

@section('content')

{{-- HEADER --}}
<div class="mb-10">
    <h1 class="text-3xl font-semibold text-gray-800">Dashboard</h1>
    <p class="text-gray-500 mt-1">Ringkasan aktivitas gudang hari ini</p>
</div>


{{-- SUMMARY CARDS --}}
<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-5 gap-6 mb-12">

    {{-- Total Produk --}}
    <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm hover:shadow-md transition">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-sm text-gray-500">Total Produk</p>
                <h2 class="text-3xl font-bold text-gray-800 mt-2" id="totalProducts">-</h2>
                <p class="text-xs text-gray-500 mt-1">Jumlah Produk Keseluruhan</p>
            </div>
            <div class="bg-blue-100 text-blue-600 p-3 rounded-xl">
                <i class="fas fa-box text-lg"></i>
            </div>
        </div>
    </div>

    {{-- Stock Masuk --}}
    <div class="bg-green-50 border border-green-100 rounded-2xl p-6 shadow-sm hover:shadow-md transition">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-sm text-green-700">Stock In Today</p>
                <h2 class="text-3xl font-bold text-gray-800 mt-2" id="stockIn">-</h2>
                <p class="text-xs text-gray-500 mt-1">Produk yang masuk hari ini</p>
            </div>
            <div class="bg-green-100 text-green-600 p-3 rounded-xl">
                <i class="fas fa-arrow-down text-lg"></i>
            </div>
        </div>
    </div>

    {{-- Stock Keluar --}}
    <div class="bg-yellow-50 border border-yellow-100 rounded-2xl p-6 shadow-sm hover:shadow-md transition">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-sm text-yellow-700">Stock Out Today</p>
                <h2 class="text-3xl font-bold text-gray-800 mt-2" id="stockOut">-</h2>
                <p class="text-xs text-gray-500 mt-1">Produk yang keluar hari ini</p>
            </div>
            <div class="bg-yellow-100 text-yellow-600 p-3 rounded-xl">
                <i class="fas fa-arrow-up text-lg"></i>
            </div>
        </div>
    </div>

    {{-- Stok Menipis --}}
    <div class="bg-red-50 border border-red-100 rounded-2xl p-6 shadow-sm hover:shadow-md transition">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-sm text-red-700">Stok Menipis</p>
                <h2 class="text-3xl font-bold text-gray-800 mt-2" id="lowStock">-</h2>
                <p class="text-xs text-gray-500 mt-1">Produk perlu restock</p>
            </div>
            <div class="bg-red-100 text-red-600 p-3 rounded-xl">
                <i class="fas fa-exclamation-triangle text-lg"></i>
            </div>
        </div>
    </div>

    {{-- Transaksi Ditunda --}}
    <div class="bg-indigo-50 border border-indigo-100 rounded-2xl p-6 shadow-sm hover:shadow-md transition">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-sm text-indigo-700">Transaksi Ditunda</p>
                <h2 class="text-3xl font-bold text-gray-800 mt-2" id="pendingTransactions">-</h2>
                <p class="text-xs text-gray-500 mt-1">Transaksi yang Masih Tertunda</p>
            </div>
            <div class="bg-indigo-100 text-indigo-600 p-3 rounded-xl">
                <i class="fas fa-clock text-lg"></i>
            </div>
        </div>
    </div>

</div>



{{-- CHART SECTION --}}
<div class="grid grid-cols-1 xl:grid-cols-2 gap-8 mb-12">

    {{-- Chart 1 --}}
    <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm">
        <div class="flex justify-between items-center mb-6">
            <h3 class="font-semibold text-gray-700">
                Arus Barang (Tahun Ini)
            </h3>
        </div>
        <canvas id="stockChart"></canvas>
    </div>

    {{-- Chart 2 --}}
    <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm">
        <div class="flex justify-between items-center mb-6">
            <h3 class="font-semibold text-gray-700">
                Stok per Kategori
            </h3>
        </div>
        <canvas id="categoryChart"></canvas>
    </div>

</div>






{{-- ACTIVITY LOG --}}
<div class="mb-6">
    <h2 class="text-2xl font-semibold text-gray-800">
        Activity Log
    </h2>
</div>

<div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">

    <div class="overflow-x-auto">
        <table class="min-w-full text-sm text-left">
            <thead class="bg-gray-50 text-gray-500 text-xs uppercase tracking-wider">
                <tr>
                    <th class="px-6 py-4 font-medium">Waktu</th>
                    <th class="px-6 py-4 font-medium">User</th>
                    <th class="px-6 py-4 font-medium">Action</th>
                    <th class="px-6 py-4 font-medium">Description</th>
                </tr>
            </thead>

            <tbody id="activityLogTable"
                class="divide-y divide-gray-100 text-gray-700">

                {{-- JS akan inject row di sini --}}
                {{-- Pastikan JS inject <tr class="hover:bg-gray-50 transition"> --}}
            </tbody>
        </table>
    </div>

    {{-- PAGINATION --}}
    <div class="flex items-center justify-between px-6 py-4 bg-gray-50 border-t border-gray-100">

        <button id="prevPage"
            class="px-4 py-2 bg-white border border-gray-200 hover:bg-gray-100 rounded-lg text-sm transition disabled:opacity-40 disabled:cursor-not-allowed">
            Prev
        </button>

        <span id="pageInfo" class="text-sm text-gray-500"></span>

        <button id="nextPage"
            class="px-4 py-2 bg-white border border-gray-200 hover:bg-gray-100 rounded-lg text-sm transition disabled:opacity-40 disabled:cursor-not-allowed">
            Next
        </button>

    </div>

</div>

{{-- JS --}}
@vite('resources/js/dashboard/admin.js')
@vite('resources/js/dashboard/activityLog.js')

@endsection