@extends('layouts.dashboard')

@section('content')

<div class="max-w-7xl mx-auto">

    <!-- HEADER -->
    <div class="flex justify-between items-start mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">
                Pengguna
            </h1>
            <p class="text-gray-500 mt-1">
                Kelola akun dan hak akses pengguna
            </p>
        </div>
    </div>

    <!-- TABLE -->
    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="bg-gray-50 text-gray-600 uppercase text-xs tracking-wider">
                    <tr>
                        <th class="px-6 py-4 text-left">Nama</th>
                        <th class="px-6 py-4 text-left">Email</th>
                        <th class="px-6 py-4 text-left">Role</th>
                        <th class="px-6 py-4 text-left">Status</th>
                        <th class="px-6 py-4 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody id="userTable"
                       class="divide-y divide-gray-100 text-gray-700">
                </tbody>
            </table>
        </div>
    </div>

</div>

@vite('resources/js/dashboard/admin/users/index.js')
@endsection