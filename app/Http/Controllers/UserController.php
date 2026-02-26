<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // ================= ADMIN ONLY =================

    // GET /api/users
    public function index()
    {
        $users = User::select('id', 'name', 'email', 'role', 'is_active', 'created_at')
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $users
        ]);
    }

    // GET /api/users/{id}
    public function show($id)
    {
        $user = User::select('id', 'name', 'email', 'role', 'is_active', 'created_at')
            ->findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $user
        ]);
    }

    // PUT /api/users/{id}
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|in:Admin,Manajer Gudang,Staff Gudang',
            'is_active' => 'sometimes|boolean'
        ]);

        $user->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'User updated successfully',
            'data' => $user
        ]);
    }

    // PUT /api/users/{id}/activate
    public function activate($id)
    {
        $user = User::findOrFail($id);

        $user->update([
            'is_active' => true
        ]);

        return response()->json([
            'success' => true,
            'message' => 'User activated'
        ]);
    }


    // PUT /api/users/{id}/deactivate
    public function deactivate($id)
    {
        $user = User::findOrFail($id);

        $user->update([
            'is_active' => false
        ]);

        return response()->json([
            'success' => true,
            'message' => 'User deactivated'
        ]);
    }
}
