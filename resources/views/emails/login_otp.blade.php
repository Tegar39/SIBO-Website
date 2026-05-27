<!DOCTYPE html>
<html>
<body style="font-family: Arial, sans-serif; color:#0f172a;">
    <h2>Kode OTP Login SIBO</h2>
    <p>Halo {{ $user->name }},</p>
    <p>Gunakan kode berikut untuk menyelesaikan proses login:</p>
    <p style="font-size:28px;font-weight:700;letter-spacing:8px;background:#ecfdf5;color:#047857;padding:16px 24px;display:inline-block;border-radius:12px;">{{ $code }}</p>
    <p>Kode berlaku selama 10 menit. Jangan bagikan kode ini kepada siapa pun.</p>
    <p>Jika kamu tidak mencoba login, segera hubungi admin SIBO.</p>
</body>
</html>
