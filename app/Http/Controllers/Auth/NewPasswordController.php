<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\PasswordResetCode;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class NewPasswordController extends Controller
{
    /**
     * Display the password reset view.
     */
    public function create(Request $request, ?string $token = null): View
    {
        return view('auth.reset-password', [
            'email' => $request->query('email'),
            'code' => $request->query('code'),
            'token' => $token,
        ]);
    }

    /**
     * Handle an incoming new password request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        if ($request->filled('token')) {
            $request->validate([
                'token' => 'required',
                'email' => 'required|email',
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ]);

            $status = Password::reset(
                $request->only('email', 'password', 'password_confirmation', 'token'),
                function (User $user) use ($request) {
                    $user->forceFill([
                        'password' => Hash::make($request->password),
                        'remember_token' => Str::random(60),
                    ])->save();

                    event(new PasswordReset($user));
                }
            );

            if ($status === Password::PASSWORD_RESET) {
                return redirect()->route('login')->with('status', __($status));
            }

            throw ValidationException::withMessages([
                'email' => [__($status)],
            ]);
        }

        $request->validate([
            'email' => 'required|email',
            'code' => 'required|string|size:6',
            'password' => [
                'required',
                'confirmed',
                'min:8',
                'regex:/[a-z]/',      // must contain at least one lowercase letter
                'regex:/[A-Z]/',      // must contain at least one uppercase letter
                'regex:/[0-9]/',      // must contain at least one digit
                'regex:/[@$!%*#?&^]/', // must contain a special character
            ],
        ], [
            'password.min' => 'Password minimal 8 karakter.',
            'password.regex' => 'Password harus mengandung huruf kecil, huruf besar, angka, dan simbol.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        // Verify the code again
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

        // Find user by email (check both email and pic_email)
        $user = User::where('email', $request->email)
            ->orWhere('pic_email', $request->email)
            ->first();

        if (!$user) {
            throw ValidationException::withMessages([
                'email' => ['Email tidak ditemukan dalam sistem kami.'],
            ]);
        }

        // Update the password
        $user->forceFill([
            'password' => Hash::make($request->password),
            'remember_token' => Str::random(60),
        ])->save();

        // Delete the reset code
        $resetCode->delete();

        event(new PasswordReset($user));

        return redirect()->route('login')->with('status', 'Password berhasil direset. Silakan login dengan password baru.');
    }
}
