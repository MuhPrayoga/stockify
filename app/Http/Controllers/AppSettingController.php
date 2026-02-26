<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AppSetting;
use Illuminate\Support\Facades\Storage;

class AppSettingController extends Controller
{
    public function show()
    {
        $setting = AppSetting::first();

        return response()->json([
            'success' => true,
            'data' => $setting
        ]);
    }

    public function update(Request $request)
    {
        $setting = AppSetting::firstOrCreate(
            [],
            ['app_name' => 'Stokify']
        );

        $data = $request->validate([
            'app_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'logo' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('logo')) {
            if ($setting->logo) {
                Storage::delete($setting->logo);
            }

            $data['logo'] = $request->file('logo')
                ->store('app-logo');
        }

        $setting->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Pengaturan berhasil disimpan',
            'data' => $setting
        ]);
    }
}