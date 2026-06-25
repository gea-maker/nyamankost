{{-- resources/views/emails/otp.blade.php --}}
<div style="font-family: Arial, sans-serif; max-width: 480px; margin: auto;">
    <h2 style="color: #4338ca;">NyamanKost</h2>
    <p>Halo,</p>
    <p>Gunakan kode berikut untuk memverifikasi email Anda:</p>
    <div style="font-size: 32px; font-weight: bold; letter-spacing: 8px; background: #f3f4f6; padding: 16px; text-align: center; border-radius: 8px; margin: 16px 0;">
        {{ $otp }}
    </div>
    <p>Kode ini berlaku selama 5 menit. Jangan bagikan kode ini kepada siapa pun.</p>
    <p style="color: #6b7280; font-size: 12px;">Jika Anda tidak mendaftar di NyamanKost, abaikan email ini.</p>
</div>