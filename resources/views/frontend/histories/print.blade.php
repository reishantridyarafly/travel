<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>E-Ticket Langkuy Project</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            padding: 20px;
        }

        .ticket {
            width: 80%;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .ticket-header {
            text-align: center;
            padding: 10px;
            border-radius: 10px 10px 0 0;
        }

        .ticket-content {
            padding: 20px;
        }

        .ticket-content h2 {
            color: #007BFF;
        }

        .ticket-content p {
            margin: 10px 0;
        }

        .ticket-footer {
            text-align: center;
            padding: 10px;
            border-radius: 0 0 10px 10px;
        }
    </style>
    <script>
        // Cetak halaman saat dimuat
        window.onload = function() {
            window.print();
        }
    </script>
</head>

<body>
    <div class="ticket">
        <div class="ticket-header">
            <h1>E-Ticket Langkuy Project</h1>
        </div>
        <div class="ticket-content">
            <h2>Kode Booking: {{ $booking->id }}</h2>
            <p>Nama: {{ $booking->user->name }}</p>
            <p>Paket: {{ $booking->package->name }}</p>
            <p>Tanggal Mulai: {{ date('d/m/Y', strtotime($booking->start_date)) }}</p>
            <p>Tanggal Selesai: {{ date('d/m/Y', strtotime($booking->end_date)) }}</p>
            <p>Tanggal Validasi: {{ date('d/m/Y', strtotime($booking->transactions->first()->updated_at)) }}</p>
            <p>Bank: {{ $booking->transactions->first()->name_bank }}</p>
            <p>Total: {{ number_format($booking->transactions->first()->total, 0, ',', '.') }}</p>
        </div>
        <div class="ticket-footer">
            <p>Terima Kasih Telah Menggunakan Layanan Kami</p>
        </div>
    </div>
</body>

</html>
