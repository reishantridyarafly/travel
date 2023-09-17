<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terima Kasih atas Feedback Anda</title>
    <style>
        /* Gaya inline CSS untuk email */
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 30px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .header {
            text-align: center;
            background-color: #007BFF;
            padding: 20px 0;
        }

        .header h1 {
            color: #fff;
            font-size: 28px;
            margin-bottom: 10px;
        }

        .header p {
            color: #fff;
            font-size: 16px;
        }

        .content {
            padding: 20px 0;
            text-align: center;
        }

        .content p {
            font-size: 18px;
            color: #333;
            margin-bottom: 20px;
        }

        .button {
            display: inline-block;
            padding: 15px 30px;
            background-color: #007BFF;
            color: #fff;
            text-decoration: none;
            font-size: 16px;
            border-radius: 5px;
        }

        /* Resposive CSS */
        @media screen and (max-width: 600px) {
            .container {
                width: 90%;
                padding: 20px;
            }

            .header {
                padding: 15px 0;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Terima Kasih atas Feedback Anda!</h1>
            <p>Kami sangat menghargai tanggapan Anda. Mohon luangkan waktu sejenak untuk memberikan tanggapan singkat.
            </p>
        </div>
        <div class="content">
            <p>Klik tombol di bawah ini untuk memberikan tanggapan:</p>
            <a class="button" href="{{ route('histories') }}" style="color: white;">Kirim Tanggapan</a>
        </div>
    </div>
</body>

</html>
