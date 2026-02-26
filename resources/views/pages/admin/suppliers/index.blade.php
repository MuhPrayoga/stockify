@extends('layouts.dashboard')

@section('content')

<div class="max-w-7xl mx-auto">

    <!-- HEADER -->
    <div class="flex justify-between items-start mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">
                Supplier
            </h1>
            <p class="text-gray-500 mt-1">
                Kelola data supplier dan pemasok
            </p>
        </div>

        <a href="/admin/suppliers/create"
           class="flex items-center gap-2 bg-indigo-900 text-white px-6 py-3 rounded-xl shadow hover:bg-indigo-800 transition">
            <span class="text-xl">+</span>
            Tambah Supplier
        </a>
    </div>

    <!-- CARD GRID -->
    <div id="supplierContainer"
         class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    </div>

</div>

@vite('resources/js/dashboard/admin/suppliers/index.js')
@endsection