<?php

namespace App\Http\Controllers;

use App\Models\SellerProfileUpdate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class SellerSettingsController extends Controller
{
    /**
     * Show the settings page.
     */
    public function index()
    {
        $user = Auth::user();
        $pendingUpdate = SellerProfileUpdate::where('user_id', $user->id)
            ->where('status', 'pending')
            ->first();

        return view('seller.settings', compact('user', 'pendingUpdate'));
    }

    /**
     * Update shop information (requires admin approval).
     */
    public function updateShop(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'shop_name' => 'required|string|max:255',
            'shop_description' => 'nullable|string|max:1000',
        ], [
            'shop_name.required' => 'Nama toko wajib diisi.',
            'shop_name.max' => 'Nama toko maksimal 255 karakter.',
            'shop_description.max' => 'Deskripsi toko maksimal 1000 karakter.',
        ]);

        // Check if there's already a pending update
        $existingPending = SellerProfileUpdate::where('user_id', $user->id)
            ->where('status', 'pending')
            ->first();

        if ($existingPending) {
            return back()->with('error', 'Anda masih memiliki permintaan perubahan yang menunggu persetujuan admin.');
        }

        // Check if there are actual changes
        if ($request->shop_name === $user->shop_name && $request->shop_description === $user->shop_description) {
            return back()->with('info', 'Tidak ada perubahan yang perlu disimpan.');
        }

        // Create pending update request
        SellerProfileUpdate::create([
            'user_id' => $user->id,
            'shop_name' => $request->shop_name,
            'shop_description' => $request->shop_description,
            'status' => 'pending',
        ]);

        return back()->with('status', 'Permintaan perubahan data toko telah dikirim dan menunggu persetujuan admin.');
    }

    /**
     * Update contact information (requires current password).
     */
    public function updateContact(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'pic_email' => 'required|email|max:255',
            'pic_phone' => ['required', 'string', 'regex:/^08[0-9]{8,11}$/'],
            'current_password_contact' => 'required|string',
        ], [
            'pic_email.required' => 'Email wajib diisi.',
            'pic_email.email' => 'Format email tidak valid.',
            'pic_phone.required' => 'Nomor telepon wajib diisi.',
            'pic_phone.regex' => 'Nomor telepon harus diawali 08 dan terdiri dari 10-13 digit.',
            'current_password_contact.required' => 'Password saat ini wajib diisi untuk mengubah data kontak.',
        ]);

        // Verify current password
        if (!Hash::check($request->current_password_contact, $user->password)) {
            throw ValidationException::withMessages([
                'current_password_contact' => ['Password yang Anda masukkan salah.'],
            ]);
        }

        // Update contact info
        $user->update([
            'pic_email' => $request->pic_email,
            'pic_phone' => $request->pic_phone,
        ]);

        return back()->with('status', 'Data kontak berhasil diperbarui.');
    }

    /**
     * Update password (requires current password).
     */
    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'current_password' => 'required|string',
            'password' => [
                'required',
                'confirmed',
                'min:8',
                'regex:/[a-z]/',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*#?&^]/',
            ],
        ], [
            'current_password.required' => 'Password saat ini wajib diisi.',
            'password.required' => 'Password baru wajib diisi.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.regex' => 'Password harus mengandung huruf kecil, huruf besar, angka, dan simbol.',
        ]);

        // Verify current password
        if (!Hash::check($request->current_password, $user->password)) {
            throw ValidationException::withMessages([
                'current_password' => ['Password saat ini yang Anda masukkan salah.'],
            ]);
        }

        // Update password
        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return back()->with('status', 'Password berhasil diperbarui.');
    }

    /**
     * Cancel pending update request.
     */
    public function cancelUpdate()
    {
        $user = Auth::user();

        $pendingUpdate = SellerProfileUpdate::where('user_id', $user->id)
            ->where('status', 'pending')
            ->first();

        if ($pendingUpdate) {
            $pendingUpdate->delete();
            return back()->with('status', 'Permintaan perubahan telah dibatalkan.');
        }

        return back()->with('error', 'Tidak ada permintaan perubahan yang dapat dibatalkan.');
    }
}
