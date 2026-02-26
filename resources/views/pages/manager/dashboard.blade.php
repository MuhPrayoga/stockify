@extends('layouts.manager.dashboard')

@section('content')

{{-- HEADER --}}
<div class="mb-10">
    <h1 class="text-3xl font-semibold text-gray-800">Dashboard</h1>
    <p class="text-gray-500 mt-1">Ringkasan aktivitas gudang hari ini</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-12">

    {{-- Barang Masuk --}}
    <div class="bg-green-50 border border-green-100 rounded-2xl p-6 shadow-sm hover:shadow-md transition duration-300">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-sm text-green-700 font-medium">Barang Masuk Hari Ini</p>
                <h2 class="text-3xl font-bold text-gray-800 mt-2" id="stockInToday">-</h2>
                <p class="text-xs text-gray-500 mt-1">Total barang diterima hari ini</p>
            </div>
            <div class="bg-green-100 text-green-600 p-3 rounded-xl">
                <i class="fas fa-arrow-down text-lg"></i>
            </div>
        </div>
    </div>

    {{-- Barang Keluar --}}
    <div class="bg-yellow-50 border border-yellow-100 rounded-2xl p-6 shadow-sm hover:shadow-md transition duration-300">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-sm text-yellow-700 font-medium">Barang Keluar Hari Ini</p>
                <h2 class="text-3xl font-bold text-gray-800 mt-2" id="stockOutToday">-</h2>
                <p class="text-xs text-gray-500 mt-1">Total barang dikeluarkan hari ini</p>
            </div>
            <div class="bg-yellow-100 text-yellow-600 p-3 rounded-xl">
                <i class="fas fa-arrow-up text-lg"></i>
            </div>
        </div>
    </div>

    {{-- Stok Menipis --}}
    <div class="bg-red-50 border border-red-100 rounded-2xl p-6 shadow-sm hover:shadow-md transition duration-300">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-sm text-red-700 font-medium">Stok Menipis</p>
                <h2 class="text-3xl font-bold text-gray-800 mt-2" id="lowStock">-</h2>
                <p class="text-xs text-gray-500 mt-1">Produk perlu restock</p>
            </div>
            <div class="bg-red-100 text-red-600 p-3 rounded-xl">
                <i class="fas fa-exclamation-triangle text-lg"></i>
            </div>
        </div>
    </div>

    <div class="bg-red-50 border border-red-100 rounded-2xl p-6 shadow-sm hover:shadow-md transition duration-300">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-sm text-red-700 font-medium">Pending Approval</p>
                <h2 class="text-3xl font-bold text-gray-800 mt-2" id="pending">-</h2>
                <p class="text-xs text-gray-500 mt-1">Transaksi yang belum disetujui</p>
            </div>
            <div class="bg-red-100 text-red-600 p-3 rounded-xl">
                <i class="fas fa-exclamation-triangle text-lg"></i>
            </div>
        </div>
    </div>
</div>

<div class="bg-white p-6 rounded-xl shadow">
    <canvas id="stockChart" height="100"></canvas>
</div>

</div>

{{-- JS --}}
@vite('resources/js/dashboard/manager.js')

@endsection