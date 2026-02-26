@extends('layouts.manager.dashboard')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded-xl shadow">

    <h2 class="text-xl font-bold mb-6">Tambah Stock Opname</h2>

    <form id="opnameForm" class="space-y-5">

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- PRODUCT -->
        <div>
            <label class="block text-sm font-medium mb-1">Produk</label>
            <select id="product_id"
                class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500">
                <option value="">Pilih Produk</option>
            </select>
        </div>

        <!-- SYSTEM STOCK -->
        <div>
            <label class="block text-sm font-medium mb-1">Stok Sistem</label>
            <input type="number" id="system_stock" disabled
                class="w-full border rounded-lg px-3 py-2 bg-gray-100">
        </div>

        <!-- PHYSICAL STOCK -->
        <div>
            <label class="block text-sm font-medium mb-1">Stok Fisik</label>
            <input type="number" id="physical_stock" min="0"
                class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500"
                required>
        </div>

        <!-- NOTES -->
        <div>
            <label class="block text-sm font-medium mb-1">Catatan</label>
            <textarea id="notes"
                class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500"></textarea>
        </div>

        <button type="submit"
            class="w-full bg-indigo-600 text-white py-2 rounded-lg hover:bg-indigo-700 transition">
            Simpan Opname
        </button>

    </form>
</div>

@vite('resources/js/dashboard/manager/stocks/opname.js')
@endsection