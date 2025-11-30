<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - LapakMahasiswa</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f4f8;
            line-height: 1.6;
        }
        .email-wrapper {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
        }
        .header {
            background: linear-gradient(135deg, #24aceb 0%, #1a8bc7 100%);
            padding: 40px 30px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        .header::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 60%);
            animation: pulse 4s ease-in-out infinite;
        }
        .header-shapes {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
        }
        .shape {
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
        }
        .shape-1 {
            width: 100px;
            height: 100px;
            top: -30px;
            left: -30px;
        }
        .shape-2 {
            width: 60px;
            height: 60px;
            top: 20px;
            right: 40px;
        }
        .shape-3 {
            width: 80px;
            height: 80px;
            bottom: -20px;
            right: -20px;
        }
        .shape-4 {
            width: 40px;
            height: 40px;
            bottom: 30px;
            left: 50px;
        }
        .logo {
            position: relative;
            z-index: 1;
            display: inline-flex;
            align-items: center;
            gap: 12px;
            color: #ffffff;
            text-decoration: none;
            margin-bottom: 20px;
        }
        .logo-icon {
            width: 50px;
            height: 50px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
        }
        .logo-text {
            font-size: 24px;
            font-weight: 700;
            letter-spacing: -0.5px;
        }
        .header-title {
            position: relative;
            z-index: 1;
            color: #ffffff;
            font-size: 28px;
            font-weight: 700;
            margin-top: 10px;
        }
        .status-badge {
            display: inline-block;
            padding: 8px 24px;
            border-radius: 50px;
            font-size: 14px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-top: 15px;
            position: relative;
            z-index: 1;
        }
        .badge-pending {
            background: rgba(255, 193, 7, 0.2);
            color: #fff;
            border: 2px solid rgba(255, 193, 7, 0.5);
        }
        .badge-approved {
            background: rgba(40, 167, 69, 0.2);
            color: #fff;
            border: 2px solid rgba(40, 167, 69, 0.5);
        }
        .badge-rejected {
            background: rgba(220, 53, 69, 0.2);
            color: #fff;
            border: 2px solid rgba(220, 53, 69, 0.5);
        }
        .content {
            padding: 40px 30px;
        }
        .greeting {
            font-size: 20px;
            color: #1a1a2e;
            margin-bottom: 20px;
        }
        .message {
            color: #4a5568;
            font-size: 16px;
            margin-bottom: 20px;
        }
        .highlight-box {
            background: linear-gradient(135deg, #f8f9ff 0%, #e8f4fd 100%);
            border-left: 4px solid #24aceb;
            padding: 20px;
            border-radius: 0 12px 12px 0;
            margin: 25px 0;
        }
        .highlight-box h4 {
            color: #1a1a2e;
            font-size: 16px;
            margin-bottom: 10px;
        }
        .highlight-box p {
            color: #4a5568;
            font-size: 14px;
            margin: 0;
        }
        .shop-info {
            background: #f8fafc;
            border-radius: 12px;
            padding: 20px;
            margin: 25px 0;
        }
        .shop-info-item {
            display: flex;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid #e2e8f0;
        }
        .shop-info-item:last-child {
            border-bottom: none;
        }
        .shop-info-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #24aceb 0%, #1a8bc7 100%);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            color: #fff;
            font-size: 18px;
        }
        .shop-info-label {
            color: #718096;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .shop-info-value {
            color: #1a1a2e;
            font-size: 16px;
            font-weight: 600;
        }
        .cta-button {
            display: inline-block;
            background: linear-gradient(135deg, #24aceb 0%, #1a8bc7 100%);
            color: #ffffff !important;
            text-decoration: none;
            padding: 16px 40px;
            border-radius: 50px;
            font-size: 16px;
            font-weight: 600;
            text-align: center;
            margin: 20px 0;
            box-shadow: 0 4px 15px rgba(36, 172, 235, 0.4);
            transition: all 0.3s ease;
        }
        .cta-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(36, 172, 235, 0.5);
        }
        .cta-center {
            text-align: center;
        }
        .rejection-box {
            background: linear-gradient(135deg, #fff5f5 0%, #fed7d7 100%);
            border-left: 4px solid #dc3545;
            padding: 20px;
            border-radius: 0 12px 12px 0;
            margin: 25px 0;
        }
        .rejection-box h4 {
            color: #c53030;
            font-size: 16px;
            margin-bottom: 10px;
        }
        .rejection-box p {
            color: #742a2a;
            font-size: 14px;
            margin: 0;
        }
        .steps {
            margin: 25px 0;
        }
        .step {
            display: flex;
            align-items: flex-start;
            margin-bottom: 20px;
        }
        .step-number {
            width: 36px;
            height: 36px;
            background: linear-gradient(135deg, #24aceb 0%, #1a8bc7 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-weight: 700;
            font-size: 16px;
            margin-right: 15px;
            flex-shrink: 0;
        }
        .step-content h4 {
            color: #1a1a2e;
            font-size: 16px;
            margin-bottom: 5px;
        }
        .step-content p {
            color: #718096;
            font-size: 14px;
            margin: 0;
        }
        .divider {
            height: 1px;
            background: linear-gradient(90deg, transparent, #e2e8f0, transparent);
            margin: 30px 0;
        }
        .footer {
            background: #1a1a2e;
            padding: 30px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        .footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #24aceb, #1a8bc7, #24aceb);
        }
        .footer-shapes {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            opacity: 0.1;
        }
        .footer p {
            color: #a0aec0;
            font-size: 14px;
            margin-bottom: 10px;
            position: relative;
            z-index: 1;
        }
        .footer-links {
            margin-top: 15px;
            position: relative;
            z-index: 1;
        }
        .footer-links a {
            color: #24aceb;
            text-decoration: none;
            margin: 0 10px;
            font-size: 14px;
        }
        .footer-copyright {
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }
        .footer-copyright p {
            font-size: 12px;
            color: #718096;
        }
        @media only screen and (max-width: 600px) {
            .header {
                padding: 30px 20px;
            }
            .header-title {
                font-size: 22px;
            }
            .content {
                padding: 30px 20px;
            }
            .greeting {
                font-size: 18px;
            }
            .cta-button {
                display: block;
                padding: 14px 30px;
            }
        }
    </style>
</head>
<body>
    <div class="email-wrapper">
        <!-- Header -->
        <div class="header">
            <div class="header-shapes">
                <div class="shape shape-1"></div>
                <div class="shape shape-2"></div>
                <div class="shape shape-3"></div>
                <div class="shape shape-4"></div>
            </div>
            <div class="logo">
                <div class="logo-icon">🏪</div>
                <span class="logo-text">LapakMahasiswa</span>
            </div>
            <h1 class="header-title">@yield('header-title')</h1>
            @yield('status-badge')
        </div>

        <!-- Content -->
        <div class="content">
            @yield('content')
        </div>

        <!-- Footer -->
        <div class="footer">
            <div class="footer-shapes">
                <div class="shape shape-1"></div>
                <div class="shape shape-3"></div>
            </div>
            <p>Butuh bantuan? Hubungi kami</p>
            <div class="footer-links">
                <a href="mailto:support@lapakmahasiswa.com">support@lapakmahasiswa.com</a>
            </div>
            <div class="footer-copyright">
                <p>&copy; {{ date('Y') }} LapakMahasiswa. All rights reserved.</p>
                <p>Platform Jual Beli Terpercaya untuk Mahasiswa Indonesia</p>
            </div>
        </div>
    </div>
</body>
</html>
