<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice #{{ $booking->booking_code }}</title>
    <style>
        @page {
            margin: 0cm;
        }

        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            color: #2d3748;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #ffffff;
        }

        .header-bg {
            background-color: #3d2b1f;
            height: 130px;
            width: 100%;
            position: absolute;
            top: 0;
            left: 0;
            z-index: -1;
        }

        .container {
            padding: 40px 60px;
            position: relative;
        }

        .header {
            margin-bottom: 60px;
            color: white;
            display: table;
            width: 100%;
        }

        .header-left {
            display: table-cell;
            vertical-align: middle;
        }

        .header-right {
            display: table-cell;
            vertical-align: middle;
            text-align: right;
        }

        .logo {
            max-width: 180px;
            height: auto;
        }

        .company-name-large {
            font-size: 24px;
            font-weight: 700;
            letter-spacing: 1px;
            margin: 0;
        }

        .content-main {
            margin-top: 20px;
        }

        .invoice-banner {
            margin-bottom: 40px;
            border-bottom: 2px solid #e2e8f0;
            padding-bottom: 20px;
        }

        .invoice-banner h1 {
            font-size: 32px;
            font-weight: 800;
            margin: 0;
            color: #1a202c;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .info-section {
            width: 100%;
            display: table;
            margin-bottom: 40px;
        }

        .info-box {
            display: table-cell;
            width: 50%;
            vertical-align: top;
        }

        .info-label {
            font-size: 10px;
            font-weight: 700;
            color: #718096;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 8px;
        }

        .info-value {
            font-size: 14px;
            color: #1a202c;
        }

        .info-value strong {
            font-size: 16px;
            color: #000;
        }

        .table-container {
            margin-bottom: 40px;
        }

        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }

        .items-header th {
            background-color: #f7fafc;
            border-top: 1px solid #e2e8f0;
            border-bottom: 1px solid #e2e8f0;
            padding: 12px 15px;
            text-align: left;
            font-size: 11px;
            font-weight: 700;
            color: #4a5568;
            text-transform: uppercase;
        }

        .item-row td {
            padding: 20px 15px;
            border-bottom: 1px solid #edf2f7;
            vertical-align: top;
        }

        .item-desc {
            font-weight: 700;
            font-size: 15px;
            margin-bottom: 4px;
            color: #2d3748;
        }

        .item-sub {
            font-size: 12px;
            color: #718096;
        }

        .item-price {
            font-weight: 700;
            font-size: 15px;
            color: #2d3748;
            text-align: right;
        }

        .summary-section {
            width: 100%;
            display: table;
        }

        .summary-notes {
            display: table-cell;
            width: 60%;
            vertical-align: top;
            padding-right: 40px;
        }

        .summary-totals {
            display: table-cell;
            width: 40%;
            vertical-align: top;
        }

        .total-row {
            display: table;
            width: 100%;
            margin-bottom: 8px;
        }

        .total-label {
            display: table-cell;
            text-align: left;
            font-size: 13px;
            color: #718096;
        }

        .total-value {
            display: table-cell;
            text-align: right;
            font-size: 14px;
            font-weight: 600;
            color: #2d3748;
        }

        .grand-total-row {
            display: table;
            width: 100%;
            margin-top: 15px;
            padding-top: 15px;
            border-top: 2px solid #3d2b1f;
        }

        .grand-total-label {
            display: table-cell;
            text-align: left;
            font-size: 16px;
            font-weight: 800;
            color: #1a202c;
        }

        .grand-total-value {
            display: table-cell;
            text-align: right;
            font-size: 20px;
            font-weight: 800;
            color: #3d2b1f;
        }

        .status-stamp {
            display: inline-block;
            margin-top: 10px;
            padding: 8px 15px;
            border: 3px solid;
            border-radius: 8px;
            font-size: 18px;
            font-weight: 900;
            text-transform: uppercase;
            transform: rotate(-5deg);
            opacity: 0.8;
        }

        .stamp-paid {
            color: #38a169;
            border-color: #38a169;
        }

        .stamp-partial {
            color: #3182ce;
            border-color: #3182ce;
        }

        .stamp-unpaid {
            color: #e53e3e;
            border-color: #e53e3e;
        }

        .footer {
            position: absolute;
            bottom: 40px;
            left: 60px;
            right: 60px;
            text-align: center;
            border-top: 1px solid #e2e8f0;
            padding-top: 20px;
            font-size: 10px;
            color: #a0aec0;
        }
    </style>
</head>

<body>
    <div class="header-bg"></div>
    <div class="container">
        <div class="header">
            <div class="header-left">
                @if($logo)
                    <img src="{{ $logo }}" class="logo" alt="Logo">
                @else
                    <h2 class="company-name-large">{{ $siteName }}</h2>
                @endif
            </div>
            <div class="header-right">
                <p style="margin:0; font-weight: 600;">{{ $siteName }}</p>
                <p style="margin:0; font-size: 11px; opacity: 0.8;">{{ $contactEmail }}</p>
                <p style="margin:0; font-size: 11px; opacity: 0.8;">{{ $contactPhone }}</p>
                <p style="margin:0; font-size: 11px; opacity: 0.8;">{{ $contactAddress }}</p>
            </div>
        </div>

        <div class="content-main">
            <div class="invoice-banner">
                <h1>Invoice</h1>
                <p style="margin:5px 0 0 0; font-family: monospace; color: #718096;">Ref: #{{ $booking->booking_code }}
                </p>
            </div>

            <div class="info-section">
                <div class="info-box">
                    <div class="info-label">DITAGIHKAN KEPADA</div>
                    <div class="info-value">
                        <strong>{{ $booking->client->name }}</strong><br>
                        {{ $booking->client->email }}<br>
                        {{ $booking->client->phone }}<br>
                        {!! nl2br(e($booking->client->address)) !!}
                    </div>
                </div>
                <div class="info-box" style="text-align: right;">
                    <div class="info-label">DETAIL PEMBAYARAN</div>
                    <div class="info-value">
                        <span style="color: #718096;">Tanggal Terbit:</span> {{ now()->translatedFormat('d F Y') }}<br>
                        <span style="color: #718096;">Tanggal Sesi:</span>
                        {{ $booking->booking_date->translatedFormat('d F Y') }}<br>
                        <span style="color: #718096;">Waktu Sesi:</span>
                        {{ \Carbon\Carbon::parse($booking->booking_time)->format('H:i') }} WIB<br>
                    </div>
                </div>
            </div>

            <div class="table-container">
                <table>
                    <thead class="items-header">
                        <tr>
                            <th>Deskripsi Pesanan</th>
                            <th style="text-align: right; width: 120px;">Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="item-row">
                            <td>
                                <div class="item-desc">{{ $booking->service->name }}</div>
                                <div class="item-sub">
                                    {{ $booking->package ? $booking->package->name : 'Layanan Standar' }} •
                                    {{ ucfirst($booking->location_type) }}
                                    @if($booking->location_address)
                                        ({{ $booking->location_address }})
                                    @endif
                                </div>
                                @if($booking->notes)
                                    <div class="item-sub" style="margin-top: 8px; font-style: italic;">
                                        Catatan: {{ $booking->notes }}
                                    </div>
                                @endif
                                @if($booking->teamMember)
                                    <div class="item-sub" style="margin-top: 4px;">
                                        Professional: {{ $booking->teamMember->name }}
                                    </div>
                                @endif
                            </td>
                            <td class="item-price">
                                Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="summary-section">
                <div class="summary-notes">
                    @php
                        $statusClass = match ($booking->payment_status) {
                            'fully_paid' => 'stamp-paid',
                            'dp_paid' => 'stamp-partial',
                            'unpaid' => 'stamp-unpaid',
                            default => 'stamp-unpaid'
                        };
                        $statusLabel = match ($booking->payment_status) {
                            'fully_paid' => 'PAID',
                            'dp_paid' => 'PARTIAL',
                            'unpaid' => 'UNPAID',
                            default => 'PENDING'
                        };
                    @endphp
                    <div class="status-stamp {{ $statusClass }}">{{ $statusLabel }}</div>

                    <div style="margin-top: 30px; border: 1px dashed #e2e8f0; padding: 15px; border-radius: 8px;">
                        <div class="info-label">Metode Pembayaran</div>
                        <div class="item-sub" style="color: #4a5568;">
                            Transfer Bank via Midtrans Secure Payment.<br>
                            Silakan hubungi kami jika Anda memiliki kendala terkait pembayaran.
                        </div>
                    </div>
                </div>
                <div class="summary-totals">
                    <div class="total-row">
                        <div class="total-label">Subtotal Pesanan</div>
                        <div class="total-value">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</div>
                    </div>
                    <div class="total-row">
                        <div class="total-label">Biaya Layanan/Admin</div>
                        <div class="total-value">Rp {{ number_format($booking->admin_fee, 0, ',', '.') }}</div>
                    </div>
                    @php
                        // Total payment needed including admin fee
                        $totalToPay = $booking->total_price + $booking->admin_fee;
                        // Sum of payments already settled (including their fees if any, but our model stores them separately)
                        // Actually, Midtrans returns settlement for the whole gross_amount.
                        // Our Payment model records 'amount' as base and 'admin_fee' as fee.
                        $paidBase = $booking->payments()->where('status', 'settlement')->sum('amount');
                        $paidFee = $booking->payments()->where('status', 'settlement')->sum('admin_fee');
                        $totalPaid = $paidBase + $paidFee;
                        $remaining = $totalToPay - $totalPaid;
                    @endphp
                    <div class="total-row" style="margin-top: 10px; border-top: 1px dotted #e2e8f0; padding-top: 10px;">
                        <div class="total-label">Total Sudah Terbayar</div>
                        <div class="total-value" style="color: #38a169;">Rp {{ number_format($totalPaid, 0, ',', '.') }}</div>
                    </div>

                    <div class="grand-total-row">
                        <div class="grand-total-label">SISA TAGIHAN</div>
                        <div class="grand-total-value">Rp {{ number_format(max(0, $remaining), 0, ',', '.') }}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer">
            Copyright &copy; {{ date('Y') }} {{ $siteName }}. Semua hak dilindungi undang-undang.<br>
            Jl. Contoh Alamat No. 123, Jakarta Selatan, Indonesia.
        </div>
    </div>
</body>

</html>