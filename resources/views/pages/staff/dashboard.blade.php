@extends('layouts.staff.dashboard')

@section('content')
<div class="space-y-6">

    <h1 class="text-2xl font-bold">Dashboard Staff Gudang</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        {{-- Barang Masuk Hari Ini --}}
<div class="bg-green-50 border border-green-100 rounded-2xl p-6 shadow-sm hover:shadow-md transition">
    <div class="flex justify-between items-start">
        <div>
            <p class="text-sm text-green-700">Barang Masuk Hari Ini</p>
            <h2 class="text-3xl font-bold text-gray-800 mt-2" id="todayIn">0</h2>
            <p class="text-xs text-gray-500 mt-1">Total barang yang diterima hari ini</p>
        </div>
        <div class="bg-green-100 text-green-600 p-3 rounded-xl">
            <i class="fas fa-arrow-down text-lg"></i>
        </div>
    </div>
</div>

{{-- Barang Keluar Hari Ini --}}
<div class="bg-yellow-50 border border-yellow-100 rounded-2xl p-6 shadow-sm hover:shadow-md transition">
    <div class="flex justify-between items-start">
        <div>
            <p class="text-sm text-yellow-700">Barang Keluar Hari Ini</p>
            <h2 class="text-3xl font-bold text-gray-800 mt-2" id="todayOut">0</h2>
            <p class="text-xs text-gray-500 mt-1">Total barang yang keluar hari ini</p>
        </div>
        <div class="bg-yellow-100 text-yellow-600 p-3 rounded-xl">
            <i class="fas fa-arrow-up text-lg"></i>
        </div>
    </div>
</div>

{{-- Pending Transactions --}}
<div class="bg-indigo-50 border border-indigo-100 rounded-2xl p-6 shadow-sm hover:shadow-md transition">
    <div class="flex justify-between items-start">
        <div>
            <p class="text-sm text-indigo-700">Pending Transactions</p>
            <h2 class="text-3xl font-bold text-gray-800 mt-2" id="pendingTasks">0</h2>
            <p class="text-xs text-gray-500 mt-1">Transaksi yang masih menunggu proses</p>
        </div>
        <div class="bg-indigo-100 text-indigo-600 p-3 rounded-xl">
            <i class="fas fa-clock text-lg"></i>
        </div>
    </div>
</div>


    </div>

    <div class="bg-white rounded-2xl shadow p-6 mt-8">
        <h3 class="text-lg font-semibold mb-4">Tugas Saya</h3>

        <div id="jobList" class="space-y-3">
            <!-- Jobs akan dirender di sini -->
        </div>
    </div>

</div>

@vite('resources/js/dashboard/staff.js')
@vite('resources/js/dashboard/staff/jobs/index.js')
@endsection