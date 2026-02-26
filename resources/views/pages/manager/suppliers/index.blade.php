@extends('layouts.manager.dashboard')

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

    </div>

    <!-- CARD GRID -->
    <div id="supplierContainer"
         class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    </div>

</div>

@vite('resources/js/dashboard/admin/suppliers/index.js')
@endsection