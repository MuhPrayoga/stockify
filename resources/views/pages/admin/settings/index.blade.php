@extends('layouts.dashboard')

@section('content')

<div class="space-y-8 max-w-4xl">

    {{-- HEADER --}}
    <div>
        <h1 class="text-3xl font-bold text-gray-800">Pengaturan</h1>
        <p class="text-gray-500 mt-1">Konfigurasi umum aplikasi</p>
    </div>

    {{-- CARD --}}
    <div class="bg-white rounded-2xl shadow-sm border p-8">

        {{-- PREVIEW SECTION --}}
        <div class="flex items-center gap-6 mb-8">

            <div class="w-20 h-20 rounded-xl bg-blue-100 flex items-center justify-center overflow-hidden">
                <img id="logoPreview" class="h-16 hidden object-contain">
                <span id="logoFallback" class="text-blue-600 font-bold text-2xl">S</span>
            </div>

            <div>
                <h2 id="previewAppName" class="text-xl font-semibold text-gray-800">
                    Stockify
                </h2>
                <p id="previewDescription" class="text-gray-500 text-sm">
                    Aplikasi Manajemen Stok Barang
                </p>
            </div>

        </div>

        <hr class="mb-8">

        {{-- FORM --}}
        <form id="settingForm" class="space-y-6" enctype="multipart/form-data">

            {{-- Nama Aplikasi --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Nama Aplikasi
                </label>
                <input
                    id="app_name"
                    class="w-full border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 p-3 rounded-xl transition"
                    required>
            </div>

            {{-- Deskripsi --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Deskripsi
                </label>
                <textarea
                    id="description"
                    rows="3"
                    class="w-full border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 p-3 rounded-xl transition"></textarea>
            </div>

            {{-- Logo --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Logo Aplikasi
                </label>
                <input
                    id="logo"
                    type="file"
                    class="w-full border border-gray-300 p-2 rounded-xl file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-blue-600 file:text-white hover:file:bg-blue-700">
            </div>

            {{-- BUTTON --}}
            <div class="pt-4">
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl font-medium shadow-sm transition">
                    Simpan Pengaturan
                </button>
            </div>

        </form>
    </div>

</div>

@vite('resources/js/dashboard/admin/settings/setting.js')
@endsection