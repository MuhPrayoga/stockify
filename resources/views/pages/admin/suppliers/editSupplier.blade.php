@extends('layouts.dashboard')

@section('content')

<div class="max-w-3xl mx-auto">

    <!-- HEADER -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">
            Edit Supplier
        </h1>
        <p class="text-gray-500 mt-1">
            Perbarui informasi supplier
        </p>
    </div>

    <!-- FORM CARD -->
    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-8">

        <form id="editForm" class="space-y-6">

            <!-- NAMA -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Nama Supplier
                </label>
                <input id="name"
                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                       required>
            </div>

            <!-- ALAMAT -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Alamat
                </label>
                <input id="address"
                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:outline-none">
            </div>

            <!-- TELEPON -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Telepon
                </label>
                <input id="phone"
                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:outline-none">
            </div>

            <!-- EMAIL -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Email
                </label>
                <input id="email"
                       type="email"
                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:outline-none">
            </div>

            <!-- BUTTON -->
            <div class="flex justify-end gap-4 pt-4">

                <a href="/admin/suppliers"
                   class="px-6 py-3 rounded-xl border border-gray-300 text-gray-600 hover:bg-gray-50 transition">
                    Batal
                </a>

                <button type="submit"
                        class="px-6 py-3 rounded-xl bg-indigo-900 text-white hover:bg-indigo-800 shadow transition">
                    Update Supplier
                </button>

            </div>

        </form>

    </div>

</div>

<script>
    const SUPPLIER_ID = {{ $id }};
</script>

@vite('resources/js/dashboard/admin/suppliers/editSupplier.js')
@endsection