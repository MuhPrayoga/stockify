@extends('layouts.staff.dashboard')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">

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

        <div class="flex gap-4">
            <button id="btnIncoming"
                class="flex items-center gap-2 px-5 py-2 rounded-xl border border-green-300 text-green-600 hover:bg-green-50 transition">
                ⬇ Barang Masuk
            </button>

            <button id="btnOutgoing"
                class="flex items-center gap-2 px-5 py-2 rounded-xl border border-orange-300 text-orange-500 hover:bg-orange-50 transition">
                ⬆ Barang Keluar
            </button>
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
</div>

<!-- Modal -->
<div id="transactionModal"
     class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50">

    <div class="bg-white rounded-2xl w-full max-w-md p-6 shadow-xl">
        <h2 id="modalTitle" class="text-xl font-semibold mb-4">
            Tambah Transaksi
        </h2>

        <form id="transactionForm" class="space-y-4">

            <div>
                <label class="block text-sm mb-1">Produk</label>
                <select id="product_id"
                        class="w-full border rounded-lg px-3 py-2">
                </select>
            </div>

            <div>
                <label class="block text-sm mb-1">Jumlah</label>
                <input type="number"
                       id="quantity"
                       min="1"
                       class="w-full border rounded-lg px-3 py-2"
                       required>
            </div>

            <div>
                <label class="block text-sm mb-1">Catatan</label>
                <textarea
                    id="notes"
                    rows="3"
                    class="w-full border rounded-lg px-3 py-2"
                    placeholder="Contoh: Barang dari supplier A / Rusak / Retur">
                </textarea>
            </div>

            <div class="flex justify-end gap-3 pt-3">
                <button type="button"
                        id="closeModal"
                        class="px-4 py-2 rounded-lg border">
                    Batal
                </button>

                <button type="submit"
                        class="px-4 py-2 rounded-lg bg-blue-600 text-white">
                    Submit
                </button>
            </div>
        </form>
    </div>
</div>

@vite('resources/js/dashboard/staff/stocks/index.js')
@vite('resources/js/dashboard/staff/stocks/stock.js')
@endsection