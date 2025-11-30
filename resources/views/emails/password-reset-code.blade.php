<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kode Reset Password</title>
</head>
<body style="margin: 0; padding: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f0f4f8;">
    <table role="presentation" style="width: 100%; border-collapse: collapse;">
        <tr>
            <td align="center" style="padding: 40px 0;">
                <table role="presentation" style="width: 100%; max-width: 600px; border-collapse: collapse; background-color: #ffffff; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                    
                    <!-- Header with decorative shapes -->
                    <tr>
                        <td style="background: linear-gradient(135deg, #24aceb 0%, #1a8bc7 100%); padding: 40px 40px 60px; position: relative; text-align: center;">
                            <!-- Decorative circles -->
                            <div style="position: absolute; top: -20px; right: -20px; width: 80px; height: 80px; background: rgba(255,255,255,0.1); border-radius: 50%;"></div>
                            <div style="position: absolute; bottom: -30px; left: 20px; width: 60px; height: 60px; background: rgba(255,255,255,0.1); border-radius: 50%;"></div>
                            
                            <!-- Logo -->
                            <table role="presentation" style="margin: 0 auto;">
                                <tr>
                                    <td style="background-color: rgba(255,255,255,0.2); padding: 12px; border-radius: 12px;">
                                        <img src="https://img.icons8.com/fluency/48/lock.png" alt="Lock" style="display: block; width: 32px; height: 32px;">
                                    </td>
                                </tr>
                            </table>
                            <h1 style="color: #ffffff; font-size: 24px; font-weight: 700; margin: 20px 0 0; letter-spacing: -0.5px;">Reset Password</h1>
                        </td>
                    </tr>

                    <!-- Content -->
                    <tr>
                        <td style="padding: 40px;">
                            <p style="color: #374151; font-size: 16px; line-height: 1.6; margin: 0 0 20px;">
                                Halo,
                            </p>
                            <p style="color: #374151; font-size: 16px; line-height: 1.6; margin: 0 0 30px;">
                                Kami menerima permintaan untuk mereset password akun Anda di <strong>LapakMahasiswa</strong>. Gunakan kode berikut untuk melanjutkan proses reset password:
                            </p>

                            <!-- OTP Code Box -->
                            <table role="presentation" style="width: 100%; margin: 30px 0;">
                                <tr>
                                    <td align="center">
                                        <div style="background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%); border: 2px dashed #24aceb; border-radius: 12px; padding: 30px 40px; display: inline-block;">
                                            <p style="color: #6b7280; font-size: 14px; margin: 0 0 10px; text-transform: uppercase; letter-spacing: 1px;">Kode Verifikasi</p>
                                            <p style="color: #24aceb; font-size: 42px; font-weight: 800; letter-spacing: 8px; margin: 0; font-family: 'Courier New', monospace;">{{ $code }}</p>
                                        </div>
                                    </td>
                                </tr>
                            </table>

                            <!-- Warning Box -->
                            <table role="presentation" style="width: 100%; margin: 30px 0;">
                                <tr>
                                    <td style="background-color: #fef3c7; border-left: 4px solid #f59e0b; padding: 16px; border-radius: 0 8px 8px 0;">
                                        <table role="presentation">
                                            <tr>
                                                <td style="vertical-align: top; padding-right: 12px;">
                                                    <img src="https://img.icons8.com/fluency/24/error--v1.png" alt="Warning" style="display: block;">
                                                </td>
                                                <td>
                                                    <p style="color: #92400e; font-size: 14px; margin: 0; line-height: 1.5;">
                                                        <strong>Penting:</strong> Kode ini hanya berlaku selama <strong>15 menit</strong>. Jangan bagikan kode ini kepada siapapun.
                                                    </p>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>

                            <p style="color: #6b7280; font-size: 14px; line-height: 1.6; margin: 20px 0 0;">
                                Jika Anda tidak meminta reset password, abaikan email ini. Akun Anda tetap aman.
                            </p>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="background-color: #f9fafb; padding: 30px 40px; border-top: 1px solid #e5e7eb;">
                            <table role="presentation" style="width: 100%;">
                                <tr>
                                    <td align="center">
                                        <p style="color: #9ca3af; font-size: 12px; margin: 0 0 10px;">
                                            Email ini dikirim secara otomatis, mohon tidak membalas email ini.
                                        </p>
                                        <p style="color: #9ca3af; font-size: 12px; margin: 0;">
                                            © {{ date('Y') }} LapakMahasiswa. All rights reserved.
                                        </p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</body>
</html>
