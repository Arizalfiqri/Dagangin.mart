<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Status Verifikasi</title>
    <link rel="shortcut icon" href="<?= base_url('image/logo_toko_online.png') ?>" type="image/x-icon">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap"
        rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: "DM Sans", sans-serif;
            background: linear-gradient(135deg, #00b496 0%, #0d84bf 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            max-width: 500px;
        }

        .status-card {
            background: #044f56;
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
            width: 100%;
            max-width: 450px;
            overflow: hidden;
            position: relative;
        }

        .status-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #00b496, #0d84bf);
        }

        .card-header {
            text-align: center;
            padding: 40px 40px 20px;
            background: rgba(255, 255, 255, 0.05);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .logo {
            margin-bottom: 20px;
        }

        .logo img {
            width: 70px;
            height: 70px;
            object-fit: contain;
            filter: drop-shadow(0 4px 8px rgba(0, 0, 0, 0.2));
        }

        .card-title {
            color: #ffffff;
            font-size: 24px;
            font-weight: 600;
            margin: 0;
            letter-spacing: -0.5px;
        }

        .card-body {
            padding: 30px 40px 40px;
        }

        .info-group {
            margin-bottom: 25px;
        }

        .info-label {
            color: #b0d4d1;
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .info-value {
            color: #ffffff;
            font-size: 18px;
            font-weight: 600;
            margin: 0;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 20px;
            border-radius: 30px;
            font-size: 16px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border: 2px solid transparent;
            transition: all 0.3s ease;
        }

        .status-pending {
            background: linear-gradient(135deg, #ffeeba, #fff3cd);
            color: #856404;
            border-color: #ffd700;
        }

        .status-approved {
            background: linear-gradient(135deg, #d4edda, #c3e6cb);
            color: #155724;
            border-color: #28a745;
        }

        .status-rejected {
            background: linear-gradient(135deg, #f8d7da, #f5c6cb);
            color: #721c24;
            border-color: #dc3545;
        }

        .status-icon {
            font-size: 18px;
        }

        .action-section {
            margin-top: 35px;
            padding-top: 25px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            text-align: center;
        }

        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: linear-gradient(135deg, #fff8dd, #f8f5e0);
            color: #006c91;
            padding: 14px 28px;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 600;
            font-size: 16px;
            transition: all 0.3s ease;
            border: 2px solid transparent;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .btn-back:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
            border-color: #006c91;
        }

        .loading-animation {
            display: none;
            margin-top: 20px;
        }

        .loading-animation.show {
            display: block;
        }

        .loading-dots {
            display: flex;
            justify-content: center;
            gap: 8px;
            margin-top: 15px;
        }

        .loading-dot {
            width: 8px;
            height: 8px;
            background: #b0d4d1;
            border-radius: 50%;
            animation: loading 1.4s infinite ease-in-out both;
        }

        .loading-dot:nth-child(1) { animation-delay: -0.32s; }
        .loading-dot:nth-child(2) { animation-delay: -0.16s; }
        .loading-dot:nth-child(3) { animation-delay: 0s; }

        @keyframes loading {
            0%, 80%, 100% {
                transform: scale(0);
                opacity: 0.5;
            }
            40% {
                transform: scale(1);
                opacity: 1;
            }
        }

        .redirect-message {
            color: #b0d4d1;
            font-size: 14px;
            margin-top: 15px;
            font-style: italic;
        }

        /* Responsive Design */
        @media (max-width: 480px) {
            body {
                padding: 15px;
            }

            .card-header,
            .card-body {
                padding-left: 25px;
                padding-right: 25px;
            }

            .card-title {
                font-size: 20px;
            }

            .logo img {
                width: 60px;
                height: 60px;
            }

            .status-badge {
                font-size: 14px;
                padding: 10px 16px;
            }

            .btn-back {
                padding: 12px 24px;
                font-size: 15px;
            }
        }
    </style>
</head>
<body>
<div class="container">
    <div class="status-card">
        <div class="card-header">
            <div class="logo">
                <img src="<?= base_url('image/logo_toko_online.png') ?>" alt="Logo Toko">
            </div>
            <h1 class="card-title">Status Pendaftaran</h1>
        </div>
        
        <div class="card-body">
            <div class="info-group">
                <div class="info-label">Username</div>
                <p class="info-value"><?= esc($user['username']) ?></p>
            </div>

            <div class="info-group">
                <div class="info-label">Status Verifikasi</div>
                <?php if ($user['status'] === 'pending'): ?>
                    <div class="status-badge status-pending">
                        <i class="fas fa-clock status-icon"></i>
                        Menunggu Verifikasi
                    </div>
                <?php elseif ($user['status'] === 'approved'): ?>
                    <div class="status-badge status-approved">
                        <i class="fas fa-check-circle status-icon"></i>
                        Disetujui
                    </div>
                    <div class="loading-animation show">
                        <p class="redirect-message">Mengalihkan ke halaman login...</p>
                        <div class="loading-dots">
                            <div class="loading-dot"></div>
                            <div class="loading-dot"></div>
                            <div class="loading-dot"></div>
                        </div>
                    </div>
                    <script>
                        setTimeout(() => {
                            window.location.href = "<?= base_url('admin/login') ?>";
                        }, 3000);
                    </script>
                <?php elseif ($user['status'] === 'rejected'): ?>
                    <div class="status-badge status-rejected">
                        <i class="fas fa-times-circle status-icon"></i>
                        Ditolak
                    </div>
                    <div class="loading-animation show">
                        <p class="redirect-message">Mengalihkan ke halaman pendaftaran...</p>
                        <div class="loading-dots">
                            <div class="loading-dot"></div>
                            <div class="loading-dot"></div>
                            <div class="loading-dot"></div>
                        </div>
                    </div>
                    <script>
                        setTimeout(() => {
                            window.location.href = "<?= base_url('register-admin') ?>";
                        }, 3000);
                    </script>
                <?php endif; ?>
            </div>

            <div class="action-section">
                <a href="<?= base_url('register-admin') ?>" class="btn-back">
                    <i class="fas fa-arrow-left"></i>
                    Kembali
                </a>
            </div>
        </div>
    </div>
</div>
</body>
</html>