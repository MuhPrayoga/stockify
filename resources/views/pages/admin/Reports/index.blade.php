@extends('layouts.dashboard')

@section('content')

<div class="max-w-7xl mx-auto">

    <!-- HEADER -->
    <div class="mb-10">
        <h1 class="text-3xl font-bold text-gray-800">
            Laporan
        </h1>
        <p class="text-gray-500 mt-1">
            Akses berbagai laporan stok dan transaksi
        </p>
    </div>

    <!-- ================= DOWNLOAD CARDS ================= -->
    <div >
        <!-- class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-12" -->

        <!-- STOK -->
        <!-- <div class="bg-white border border-gray-200 rounded-2xl p-6 flex justify-between items-center shadow-sm hover:shadow-md transition">
            <div class="flex items-center gap-4">
                <div class="text-3xl">📦</div>
                <div>
                    <h3 class="font-semibold text-gray-800">
                        Laporan Stok Barang
                    </h3>
                    <p class="text-sm text-gray-500">
                        Stok per kategori, per periode
                    </p>
                </div>
            </div>

            <button onclick="window.print()"
                class="px-4 py-2 rounded-xl border border-gray-300 text-gray-700 hover:bg-gray-50 transition flex items-center gap-2">
                ⬇ Unduh
            </button>
        </div> -->

        <!-- LOW STOCK -->
        <!-- <div class="bg-white border border-gray-200 rounded-2xl p-6 flex justify-between items-center shadow-sm hover:shadow-md transition">
            <div class="flex items-center gap-4">
                <div class="text-3xl">⚠️</div>
                <div>
                    <h3 class="font-semibold text-gray-800">
                        Laporan Stok Menipis
                    </h3>
                    <p class="text-sm text-gray-500">
                        Produk dengan stok di bawah minimum
                    </p>
                </div>
            </div>

            <button onclick="window.print()"
                class="px-4 py-2 rounded-xl border border-gray-300 text-gray-700 hover:bg-gray-50 transition flex items-center gap-2">
                ⬇ Unduh
            </button>
        </div> -->

        <!-- TRANSAKSI -->
        <!-- <div class="bg-white border border-gray-200 rounded-2xl p-6 flex justify-between items-center shadow-sm hover:shadow-md transition">
            <div class="flex items-center gap-4">
                <div class="text-3xl">📊</div>
                <div>
                    <h3 class="font-semibold text-gray-800">
                        Laporan Transaksi Stok
                    </h3>
                    <p class="text-sm text-gray-500">
                        Riwayat transaksi barang masuk & keluar
                    </p>
                </div>
            </div>

            <button onclick="window.print()"
                class="px-4 py-2 rounded-xl border border-gray-300 text-gray-700 hover:bg-gray-50 transition flex items-center gap-2">
                ⬇ Unduh
            </button>
        </div> -->

        <!-- AKTIVITAS -->
        <!-- <div class="bg-white border border-gray-200 rounded-2xl p-6 flex justify-between items-center shadow-sm hover:shadow-md transition">
            <div class="flex items-center gap-4">
                <div class="text-3xl">👤</div>
                <div>
                    <h3 class="font-semibold text-gray-800">
                        Laporan Aktivitas Pengguna
                    </h3>
                    <p class="text-sm text-gray-500">
                        Log aktivitas semua pengguna
                    </p>
                </div>
            </div>

            <button onclick="window.print()"
                class="px-4 py-2 rounded-xl border border-gray-300 text-gray-700 hover:bg-gray-50 transition flex items-center gap-2">
                ⬇ Unduh
            </button>
        </div> -->

    </div>

    <!-- ================= EXISTING TABLES ================= -->

    <h2 class="text-2xl font-bold mb-6">Laporan Stok Produk</h2>

    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden mb-12">
        <table class="min-w-full text-sm">
            <thead class="bg-gray-50 text-gray-600 uppercase text-xs">
                <tr>
                    <th class="px-6 py-3 text-left">Produk</th>
                    <th class="px-6 py-3 text-left">Kategori</th>
                    <th class="px-6 py-3 text-left">Stok</th>
                    <th class="px-6 py-3 text-left">Stok Minimum</th>
                    <th class="px-6 py-3 text-left">Status</th>
                </tr>
            </thead>
            <tbody id="stockTable" class="divide-y divide-gray-100"></tbody>
        </table>
    </div>

    <h2 class="text-2xl font-bold mb-6 text-red-600">Laporan Stok Menipis</h2>

    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden mb-12">
        <table class="min-w-full text-sm">
            <thead class="bg-gray-50 text-gray-600 uppercase text-xs">
                <tr>
                    <th class="px-6 py-3 text-left">Produk</th>
                    <th class="px-6 py-3 text-left">SKU</th>
                    <th class="px-6 py-3 text-left">Stok</th>
                    <th class="px-6 py-3 text-left">Stok Minimum</th>
                </tr>
            </thead>
            <tbody id="lowStockTable" class="divide-y divide-gray-100"></tbody>
        </table>
    </div>

    <h2 class="text-2xl font-bold mb-6">Laporan Transaksi Stok</h2>

    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden mb-12">
        <table class="min-w-full text-sm">
            <thead class="bg-gray-50 text-gray-600 uppercase text-xs">
                <tr>
                    <th class="px-6 py-3 text-left">Tanggal</th>
                    <th class="px-6 py-3 text-left">Produk</th>
                    <th class="px-6 py-3 text-left">Jenis</th>
                    <th class="px-6 py-3 text-left">Jumlah</th>
                    <th class="px-6 py-3 text-left">User</th>
                </tr>
            </thead>
            <tbody id="transactionTable" class="divide-y divide-gray-100"></tbody>
        </table>
    </div>

    <div>
        <h2 class="text-2xl font-bold mb-4 text-gray-800">Laporan Aktivitas Pengguna</h2>
        <div class="bg-white rounded-xl shadow-sm border p-6">
            <ul id="activityList" class="space-y-4"></ul>
        </div>
    </div>

</div>

@vite('resources/js/dashboard/admin/reports/activityLog.js')
@vite('resources/js/dashboard/admin/reports/stockReport.js')
@vite('resources/js/dashboard/admin/reports/lowStock.js')
@vite('resources/js/dashboard/admin/reports/transactionReport.js')

@endsection