<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fatura #{{ $order->order_number }}</title>
    <style>
        body { font-family: sans-serif; color: #16202A; padding: 40px; margin: 0; }
        .invoice-box { max-width: 800px; margin: auto; padding: 30px; border: 1px solid #eee; box-shadow: 0 0 10px rgba(0, 0, 0, 0.15); font-size: 14px; line-height: 24px; }
        .header { display: flex; justify-content: space-between; border-bottom: 2px solid #16202A; padding-bottom: 20px; margin-bottom: 20px; }
        .header h1 { margin: 0; font-size: 28px; }
        .details { display: flex; justify-content: space-between; margin-bottom: 40px; }
        .details div { width: 45%; }
        table { width: 100%; line-height: inherit; text-align: left; border-collapse: collapse; }
        table th, table td { padding: 12px; border-bottom: 1px solid #ddd; }
        table th { background: #f8f9fa; }
        .total-row { font-weight: bold; background: #f8f9fa; }
        .total-row td { border-bottom: none; }
        .footer { text-align: center; margin-top: 50px; font-size: 12px; color: #666; border-top: 1px solid #eee; padding-top: 20px; }
        @media print { .invoice-box { box-shadow: none; border: none; } .no-print { display: none; } }
        .print-btn { background: #16202A; color: white; border: none; padding: 10px 20px; cursor: pointer; border-radius: 6px; font-weight: bold; margin-bottom: 20px; }
    </style>
</head>
<body>
    <div class="invoice-box">
        <div class="no-print" style="text-align: right;">
            <button class="print-btn" onclick="window.print()">Yazdır / PDF Olarak Kaydet</button>
            <a href="{{ route('admin.orders.show', $order) }}" style="margin-left: 10px; color: #16202A;">Geri Dön</a>
        </div>
        <div class="header">
            <div>
                <h1>FATURA</h1>
                <strong>Ambalaj Satış Ltd. Şti.</strong><br>
                Kocaeli, Türkiye<br>
                info@ambalaj.test
            </div>
            <div style="text-align: right;">
                <p><strong>Fatura No:</strong> INV-{{ $order->order_number }}</p>
                <p><strong>Tarih:</strong> {{ $order->created_at->format('d.m.Y H:i') }}</p>
            </div>
        </div>

        <div class="details">
            <div>
                <strong>Müşteri Bilgileri:</strong><br>
                {{ $order->user->name }}<br>
                {{ $order->user->email }}<br>
                {{ $order->user->phone ?? 'Telefon belirtilmedi' }}
            </div>
            <div>
                <strong>Teslimat Adresi:</strong><br>
                @php $addr = $order->shipping_address; @endphp
                {{ $addr['title'] ?? '' }}<br>
                {{ $addr['address_line1'] ?? '' }}<br>
                {{ $addr['address_line2'] ?? '' }}<br>
                {{ $addr['district'] ?? '' }}, {{ $addr['city'] ?? '' }}
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Ürün</th>
                    <th>Adet</th>
                    <th>Birim Fiyat</th>
                    <th>Toplam</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->items as $item)
                <tr>
                    <td>{{ $item->product_name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ number_format($item->unit_price, 2, ',', '.') }} TL</td>
                    <td>{{ number_format($item->total_price, 2, ',', '.') }} TL</td>
                </tr>
                @endforeach
                <tr class="total-row">
                    <td colspan="3" style="text-align: right;">Ara Toplam:</td>
                    <td>{{ number_format($order->total_amount, 2, ',', '.') }} TL</td>
                </tr>
                <tr class="total-row">
                    <td colspan="3" style="text-align: right;">KDV (%20):</td>
                    <td>{{ number_format($order->total_amount * 0.20, 2, ',', '.') }} TL</td>
                </tr>
                <tr class="total-row">
                    <td colspan="3" style="text-align: right; font-size: 18px;">Genel Toplam:</td>
                    <td style="font-size: 18px;">{{ number_format($order->total_amount * 1.20, 2, ',', '.') }} TL</td>
                </tr>
            </tbody>
        </table>

        <div class="footer">
            Bu belge elektronik olarak oluşturulmuştur. Teslimat sırasında irsaliye yerine geçer.
        </div>
    </div>
</body>
</html>
