@extends('layouts.dashboard')

@section('content')

<div class="max-w-3xl mx-auto">

    <!-- HEADER -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">
            Edit Pengguna
        </h1>
        <p class="text-gray-500 mt-1">
            Ubah role dan status pengguna
        </p>
    </div>

    <!-- FORM CARD -->
    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-8">

        <form id="editForm" class="space-y-6">
            <input type="hidden" id="userId" value="{{ $id }}">

            <!-- NAME -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Nama
                </label>
                <input type="text"
                    id="name"
                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                    placeholder="Masukkan nama pengguna">
            </div>

            <!-- ROLE -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Role
                </label>
                <select id="role"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                    <option value="Admin">Admin</option>
                    <option value="Manajer Gudang">Manajer Gudang</option>
                    <option value="Staff Gudang">Staff Gudang</option>
                </select>
            </div>

            <!-- STATUS -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Status
                </label>
                <select id="is_active"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                    <option value="1">Aktif</option>
                    <option value="0">Nonaktif</option>
                </select>
            </div>

            <!-- ACTION BUTTONS -->
            <div class="flex justify-end gap-4 pt-4">

                <a href="/admin/users"
                   class="px-6 py-3 rounded-xl border border-gray-300 text-gray-600 hover:bg-gray-50 transition">
                    Batal
                </a>

                <button type="submit"
                    class="px-6 py-3 rounded-xl bg-indigo-900 text-white hover:bg-indigo-800 shadow transition">
                    Simpan Perubahan
                </button>

            </div>

        </form>

    </div>

</div>

@vite('resources/js/dashboard/admin/users/editUser.js')
@endsection