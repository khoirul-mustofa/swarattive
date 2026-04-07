<!DOCTYPE html>
<html>
<head>
    <title>Status Pesanan Swarattive</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f9f9f9; padding: 20px;">
    <div style="max-w: 600px; margin: auto; background-color: white; padding: 30px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
        <h2 style="color: #3d2b1f;">Halo, {{ $booking->client->name }}</h2>
        <p>Status pesanan Anda dengan kode <strong>{{ $booking->booking_code }}</strong> telah diperbarui.</p>
        
        <div style="background-color: #fdfaf8; padding: 15px; border-left: 4px solid #f0c27f; margin: 20px 0;">
            <p style="margin: 0;"><strong>Status Saat Ini:</strong> {{ strtoupper($booking->status) }}</p>
            <p style="margin: 0;"><strong>Status Pembayaran:</strong> {{ strtoupper($booking->payment_status) }}</p>
        </div>

        <p>Anda dapat melihat detail pesanan Anda pada tautan berikut:</p>
        <p><a href="{{ route('booking.status', $booking->booking_code) }}" style="display: inline-block; background-color: #3d2b1f; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;">Cek Status Pesanan</a></p>

        <p>Terima kasih telah mempercayakan momen berharga Anda kepada Swarattive Photography!</p>
        
        <hr style="border: 0; border-top: 1px solid #eee; margin: 30px 0;">
        <p style="font-size: 12px; color: #777;">Email ini dikirim secara otomatis oleh sistem, mohon tidak membalas email ini.</p>
    </div>
</body>
</html>
