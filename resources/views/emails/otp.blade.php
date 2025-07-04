<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reset Password OTP</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }

        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            text-align: center;
            padding: 40px 20px;
        }

        .header h1 {
            margin: 0;
            font-size: 28px;
            font-weight: 300;
        }

        .header p {
            margin: 10px 0 0 0;
            opacity: 0.9;
        }

        .content {
            padding: 40px;
        }

        .otp-section {
            text-align: center;
            margin: 30px 0;
        }

        .otp-label {
            font-size: 16px;
            color: #666;
            margin-bottom: 15px;
            display: block;
        }

        .otp-code {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            font-size: 36px;
            font-weight: bold;
            padding: 20px 40px;
            border-radius: 10px;
            text-align: center;
            margin: 20px 0;
            letter-spacing: 8px;
            display: inline-block;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        }

        .warning {
            background-color: #fff3cd;
            border-left: 4px solid #ffc107;
            color: #856404;
            padding: 20px;
            border-radius: 5px;
            margin: 30px 0;
        }

        .warning-icon {
            font-size: 20px;
            margin-right: 10px;
        }

        .timer {
            text-align: center;
            background-color: #e8f4f8;
            padding: 15px;
            border-radius: 8px;
            margin: 20px 0;
            color: #0369a1;
            font-weight: 500;
        }

        .steps {
            background-color: #f8f9fa;
            padding: 25px;
            border-radius: 8px;
            margin: 25px 0;
        }

        .steps h3 {
            color: #333;
            margin-top: 0;
            font-size: 18px;
        }

        .steps ol {
            margin: 15px 0;
            padding-left: 20px;
        }

        .steps li {
            margin: 8px 0;
            color: #555;
        }

        .footer {
            background-color: #f8f9fa;
            padding: 30px;
            text-align: center;
            color: #666;
            font-size: 14px;
        }

        .footer p {
            margin: 5px 0;
        }

        .security-note {
            background-color: #e8f5e8;
            border: 1px solid #c3e6c3;
            color: #2d5a2d;
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
        }

        .btn {
            display: inline-block;
            padding: 12px 30px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            text-decoration: none;
            border-radius: 25px;
            font-weight: 500;
            margin: 15px 0;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <div class="header">
            <h1>🔐 Reset Kata Sandi</h1>
            <p>Verifikasi identitas Anda untuk melanjutkan</p>
        </div>

        <div class="content">
            <p>Halo,</p>

            <p>Kami menerima permintaan untuk mereset kata sandi akun Anda. Untuk keamanan, silakan gunakan kode OTP
                berikut:</p>

            <div class="otp-section">
                <span class="otp-label">Kode Verifikasi Anda:</span>
                <div class="otp-code">{{ $otp }}</div>
            </div>

            <div class="timer">
                ⏰ Kode ini akan kedaluwarsa dalam 5 menit
            </div>

            <div class="steps">
                <h3>Langkah selanjutnya:</h3>
                <ol>
                    <li>Kembali ke halaman reset password</li>
                    <li>Masukkan kode OTP di atas</li>
                    <li>Buat kata sandi baru yang kuat</li>
                    <li>Simpan dan login dengan kata sandi baru</li>
                </ol>
            </div>

            <div class="warning">
                <span class="warning-icon">⚠️</span>
                <strong>Penting untuk keamanan:</strong><br>
                • Jangan bagikan kode ini kepada siapa pun<br>
                • Pastikan Anda berada di website resmi kami<br>
                • Jika bukan Anda yang meminta reset, segera hubungi kami
            </div>

            <div class="security-note">
                <strong>💡 Tips Keamanan:</strong><br>
                Gunakan kata sandi yang kuat dengan kombinasi huruf besar, huruf kecil, angka, dan simbol.
            </div>

            <p>Jika Anda tidak meminta reset kata sandi, silakan abaikan email ini atau hubungi tim support kami.</p>

            <p>Terima kasih atas kepercayaan Anda,<br>
                <strong>Tim Support</strong>
            </p>
        </div>

        <div class="footer">
            <p>📧 Email ini dikirim secara otomatis</p>
            <p>Mohon tidak membalas email ini</p>
            <p>&copy; 2025 Your App Name. All rights reserved.</p>
        </div>
    </div>
</body>

</html>
