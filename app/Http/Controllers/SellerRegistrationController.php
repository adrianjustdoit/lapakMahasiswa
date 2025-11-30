<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SellerRegistrationController extends Controller
{
    public function create()
    {
        return view('seller.register');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'shop_name' => 'required|string|max:150',
            'shop_description' => 'nullable|string|max:500',
            'pic_name' => 'required|string|max:120',
            'pic_phone' => 'required|string|max:30',
            'pic_email' => 'required|email|max:150|unique:users,email',
            'pic_address' => 'required|string|max:500',
            'rt' => 'nullable|string|max:10',
            'rw' => 'nullable|string|max:10',
            'kelurahan' => 'nullable|string|max:120',
            'kecamatan' => 'nullable|string|max:120',
            'kota' => 'nullable|string|max:120',
            'provinsi' => 'nullable|string|max:120',
            'pic_id_number' => 'required|string|max:50',
            'pic_id_photo' => 'required|image|max:2048',
            'pic_photo' => 'required|image|max:2048',
        ]);

        // Store images
        $idPhotoPath = $request->file('pic_id_photo')->store('seller_ids', 'public');
        $picPhotoPath = $request->file('pic_photo')->store('seller_pic', 'public');

        $tempPassword = Str::random(12); // not yet communicated until approval

        $user = User::create([
            'name' => $data['pic_name'], // internal name uses PIC name
            'email' => $data['pic_email'],
            'password' => Hash::make($tempPassword),
            'shop_name' => $data['shop_name'],
            'shop_description' => $data['shop_description'] ?? null,
            'pic_name' => $data['pic_name'],
            'pic_phone' => $data['pic_phone'],
            'pic_email' => $data['pic_email'],
            'pic_address' => $data['pic_address'],
            'rt' => $data['rt'] ?? null,
            'rw' => $data['rw'] ?? null,
            'kelurahan' => $data['kelurahan'] ?? null,
            'kecamatan' => $data['kecamatan'] ?? null,
            'kota' => $data['kota'] ?? null,
            'provinsi' => $data['provinsi'] ?? null,
            'pic_id_number' => $data['pic_id_number'],
            'pic_id_photo_path' => $idPhotoPath,
            'pic_photo_path' => $picPhotoPath,
            'seller_status' => 'pending',
        ]);

        return redirect()->route('seller.register')->with('status', 'Registrasi berhasil dikirim. Menunggu verifikasi admin.');
    }
}
