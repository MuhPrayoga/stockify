@extends('layouts.dashboard')

@section('content')

<div class="max-w-7xl mx-auto">

    <!-- HEADER -->
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">
                Stok Barang
            </h1>
            <p class="text-gray-500 mt-1">
                Riwayat transaksi barang masuk dan keluar
            </p>
        </div>

    </div>

    <!-- FILTER & SEARCH -->
    <div class="flex justify-between items-center mb-6">

        <div class="flex bg-gray-100 p-1 rounded-xl w-fit">
            <button data-filter="all"
                class="filterBtn px-5 py-2 rounded-lg bg-white shadow text-sm font-medium">
                Semua
            </button>
            <button data-filter="Masuk"
                class="filterBtn px-5 py-2 rounded-lg text-sm text-gray-500">
                Masuk
            </button>
            <button data-filter="Keluar"
                class="filterBtn px-5 py-2 rounded-lg text-sm text-gray-500">
                Keluar
            </button>
        </div>

        <div class="relative">
            <input id="searchInput"
                class="pl-10 pr-4 py-2 border border-gray-300 rounded-xl w-72 focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                placeholder="Cari transaksi...">
            <span class="absolute left-3 top-2.5 text-gray-400">🔍</span>
        </div>

    </div>

    <!-- ================= TRANSAKSI TABLE ================= -->
    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden mb-12">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="bg-gray-50 text-gray-600 uppercase text-xs tracking-wider">
                    <tr>
                        <th class="px-6 py-3 text-left">Tanggal</th>
                        <th class="px-6 py-3 text-left">Tipe</th>
                        <th class="px-6 py-3 text-left">Produk</th>
                        <th class="px-6 py-3 text-left">SKU</th>
                        <th class="px-6 py-3 text-left">Jumlah</th>
                        <th class="px-6 py-3 text-left">Catatan</th>
                        <th class="px-6 py-3 text-left">Pengguna</th>
                        <th class="px-6 py-3 text-left">Status</th>
                    </tr>
                </thead>
                <tbody id="transactionTable"
                       class="divide-y divide-gray-100 text-gray-700">
                </tbody>
            </table>
        </div>
    </div>

    <!-- ================= STOCK OPNAME ================= -->
    <div>
        <div class="flex items-center justify-between px-6 py-5 border-b border-gray-100">
            
            <div>
                <h2 class="text-xl font-semibold text-gray-800">
                    Stock Opname
                </h2>
                <p class="text-sm text-gray-500 mt-1">
                    Perbandingan stok sistem dan stok fisik
                </p>
            </div>

            <a href="/admin/stocks/opname/create"
            class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-xl hover:bg-indigo-700 shadow-sm transition">
                <span class="text-base leading-none">+</span>
                Stock Opname
            </a>

        </div>

        <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden mb-12">
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead class="bg-gray-50 text-gray-600 uppercase text-xs tracking-wider">
                        <tr>
                            <th class="px-6 py-3 text-left">Produk</th>
                            <th class="px-6 py-3 text-left">Stok Sistem</th>
                            <th class="px-6 py-3 text-left">Stok Fisik</th>
                            <th class="px-6 py-3 text-left">Selisih</th>
                            <th class="px-6 py-3 text-left">Catatan</th>
                            <th class="px-6 py-3 text-left">Dicek Oleh</th>
                            <th class="px-6 py-3 text-left">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody id="opnameTable"
                           class="divide-y divide-gray-100 text-gray-700">
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Pending Stock -->
     {{-- PENDING APPROVAL SECTION --}}
    <div class="bg-white border border-yellow-200 rounded-2xl p-6 shadow-sm mb-10">

        <div class="flex justify-between items-center mb-6">
            <h3 class="font-semibold text-yellow-700 text-lg">
                Transaksi Menunggu Persetujuan
            </h3>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="bg-yellow-50 text-yellow-700 uppercase text-xs">
                    <tr>
                        <th class="px-6 py-3 text-left">Tanggal</th>
                        <th class="px-6 py-3 text-left">Produk</th>
                        <th class="px-6 py-3 text-left">Jenis</th>
                        <th class="px-6 py-3 text-left">Jumlah</th>
                        <th class="px-6 py-3 text-left">User</th>
                        <th class="px-6 py-3 text-left">Notes</th>
                        <th class="px-6 py-3 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody id="pendingStockTable" class="divide-y"></tbody>
            </table>
        </div>

    </div>
</div>

@vite('resources/js/dashboard/admin/stocks/index.js')
@vite('resources/js/dashboard/admin/stocks/stockApproval.js')
@endsection