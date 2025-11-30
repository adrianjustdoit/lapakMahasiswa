<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\PasswordResetCodeMail;
use App\Models\PasswordResetCode;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset request view.
     */
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle an incoming password reset code request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        // Check if user exists
        $user = User::where('email', $request->email)
            ->orWhere('pic_email', $request->email)
            ->first();

        if (!$user) {
            throw ValidationException::withMessages([
                'email' => ['Email tidak ditemukan dalam sistem kami.'],
            ]);
        }

        // Delete any existing codes for this email
        PasswordResetCode::where('email', $request->email)->delete();

        // Generate 6-digit code
        $code = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        // Store the code with 15 minutes expiry
        PasswordResetCode::create([
            'email' => $request->email,
            'code' => $code,
            'expires_at' => now()->addMinutes(15),
        ]);

        // Send the code via email
        Mail::to($request->email)->send(new PasswordResetCodeMail($code, $request->email));

        // Redirect to verify code page
        return redirect()->route('password.verify-code', ['email' => $request->email])
            ->with('status', 'Kode verifikasi telah dikirim ke email Anda.');
    }

    /**
     * Display the code verification view.
     */
    public function showVerifyCode(Request $request): View
    {
        return view('auth.verify-reset-code', [
            'email' => $request->query('email')
        ]);
    }

    /**
     * Verify the reset code.
     */
    public function verifyCode(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => 'required|email',
            'code' => 'required|string|size:6',
        ]);

        $resetCode = PasswordResetCode::where('email', $request->email)
            ->where('code', $request->code)
            ->first();

        if (!$resetCode) {
            throw ValidationException::withMessages([
                'code' => ['Kode verifikasi tidak valid.'],
            ]);
        }

        if ($resetCode->isExpired()) {
            $resetCode->delete();
            throw ValidationException::withMessages([
                'code' => ['Kode verifikasi sudah kadaluarsa. Silakan minta kode baru.'],
            ]);
        }

        // Redirect to reset password page with verified token
        return redirect()->route('password.reset-form', [
            'email' => $request->email,
            'code' => $request->code
        ]);
    }

    /**
     * Resend the verification code.
     */
    public function resendCode(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        // Check if user exists
        $user = User::where('email', $request->email)
            ->orWhere('pic_email', $request->email)
            ->first();

        if (!$user) {
            throw ValidationException::withMessages([
                'email' => ['Email tidak ditemukan dalam sistem kami.'],
            ]);
        }

        // Delete any existing codes for this email
        PasswordResetCode::where('email', $request->email)->delete();

        // Generate new 6-digit code
        $code = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        // Store the code with 15 minutes expiry
        PasswordResetCode::create([
            'email' => $request->email,
            'code' => $code,
            'expires_at' => now()->addMinutes(15),
        ]);

        // Send the code via email
        Mail::to($request->email)->send(new PasswordResetCodeMail($code, $request->email));

        return back()->with('status', 'Kode verifikasi baru telah dikirim ke email Anda.');
    }
}
