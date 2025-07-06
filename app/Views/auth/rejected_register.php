<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Verifikasi Ditolak</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'DM Sans', sans-serif;
            background: linear-gradient(to right, #00b496, #0d84bf);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .box {
            background: #044f56;
            color: #fff;
            padding: 40px;
            border-radius: 15px;
            text-align: center;
            max-width: 400px;
        }
        .box h2 {
            color: #ffdddd;
        }
        .box p {
            margin: 10px 0;
        }
        .error {
            background: #fee2e2;
            color: #991b1b;
            padding: 10px;
            border-radius: 8px;
            font-weight: bold;
        }
        .logo {
            margin-bottom: 20px;
        }
        .logo img {
            width: 60px;
        }
    </style>
</head>
<body>
    <div class="box">
        <div class="logo">
            <img src="<?= base_url('image/logo_toko_online.png') ?>" alt="Logo">
        </div>
        <h2>Verifikasi Ditolak</h2>
        <div class="error">Anda Telah menolak <strong><?= esc($user['username']) ?></strong> sebagai admin.</div>
    </div>
</body>
</html>
