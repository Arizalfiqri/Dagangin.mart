<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register Admin</title>
    <link rel="shortcut icon" href="<?= base_url('image/logo_toko_online.png') ?>" type="image/x-icon">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
    <!-- SweetAlert2 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.10.5/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.10.5/sweetalert2.min.css">

    <!-- GFont DM Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap"
        rel="stylesheet">
    <style>
    body {
        margin: 0;
        font-family: "DM Sans", sans-serif;
        background: linear-gradient(to right, #00b496, #0d84bf);
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        padding: 20px 0;
    }

    .signup-container {
        background-color: #044f56;
        padding: 40px;
        border-radius: 15px;
        width: 800px;
        max-width: 90vw;
        color: #fff;
        box-sizing: border-box;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
    }

    .signup-container .logo {
        text-align: center;
        margin-bottom: 10px;
    }

    .signup-container .logo img {
        width: 60px;
    }

    .signup-container h2 {
        text-align: center;
        margin-bottom: 30px;
        color: #ddd;
    }

    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    .form-group {
        position: relative;
    }

    .form-group input {
        width: 100%;
        padding: 12px;
        border: none;
        border-radius: 6px;
        box-sizing: border-box;
        font-size: 14px;
        transition: all 0.3s ease;
    }

    .form-group input:focus {
        outline: none;
        box-shadow: 0 0 5px rgba(255, 255, 255, 0.5);
    }

    .form-group input.error {
        border: 2px solid #ff6b6b;
        background-color: #ffe6e6;
    }

    .form-group .toggle {
        position: absolute;
        top: 12px;
        right: 12px;
        cursor: pointer;
        color: #aaa;
    }

    .btn-submit {
        margin-top: 30px;
        width: 100%;
        padding: 14px;
        border: none;
        border-radius: 6px;
        background-color: #fff8dd;
        color: #006c91;
        font-weight: bold;
        cursor: pointer;
        font-size: 16px;
        transition: all 0.3s ease;
    }

    .btn-submit:hover {
        background-color: #f0e8c8;
        transform: translateY(-2px);
    }

    .btn-submit:disabled {
        opacity: 0.6;
        cursor: not-allowed;
        transform: none;
    }

    .bottom-text {
        text-align: center;
        margin-top: 20px;
        font-size: 14px;
        color: #b5eaff;
    }

    .bottom-text a {
        color: #fff;
        font-weight: bold;
        text-decoration: none;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .form-grid {
            grid-template-columns: 1fr;
        }
        
        .signup-container {
            padding: 30px 20px;
        }
    }

    /* Custom SweetAlert2 styling */
    .swal2-popup {
        font-family: "DM Sans", sans-serif;
    }
    </style>
</head>

<body>
    <div class="signup-container">
        <div class="logo">
            <img src="<?= base_url('image/logo_toko_online.png') ?>" alt="Logo Toko">
        </div>

        <h2>Register Admin</h2>
        <form method="post" action="<?= base_url('admin/register/store') ?>" id="registerForm">
            <div class="form-grid">
                <div class="form-group">
                    <input class="form-control" type="text" placeholder="Nama Lengkap" name="nama_lengkap" id="nama_lengkap" required />
                </div>
                <div class="form-group">
                    <input class="form-control" type="text" placeholder="Username" name="username" id="username" required />
                </div>
                <div class="form-group">
                    <input class="form-control" type="password" placeholder="Password" id="password1" name="password" required />
                    <span class="toggle" onclick="togglePassword('password1', 'icon1')">
                        <i class="fa-solid fa-eye-slash" id="icon1"></i>
                    </span>
                </div>
                <div class="form-group">
                    <input type="email" placeholder="E-Mail" name="email" id="email" class="form-control" required />
                </div>
                <div class="form-group">
                    <input class="form-control" type="password" placeholder="Ulangi Password" id="password2" name="repeat_password" required />
                    <span class="toggle" onclick="togglePassword('password2', 'icon2')">
                        <i class="fa-solid fa-eye-slash" id="icon2"></i>
                    </span>
                </div>
                <div class="form-group">
                    <input type="text" placeholder="No HP" name="no_hp" id="no_hp" class="form-control" required />
                </div>
            </div>
            <button type="submit" class="btn-submit" id="submitBtn">SIGNUP</button>
        </form>
        <p class="bottom-text">Sudah punya akun? <a href="<?= base_url('admin/login') ?>">Login</a></p>
    </div>

    <script>
    function togglePassword(fieldId, iconId) {
        const input = document.getElementById(fieldId);
        const icon = document.getElementById(iconId);
        if (input.type === "password") {
            input.type = "text";
            icon.classList.remove("fa-eye-slash");
            icon.classList.add("fa-eye");
        } else {
            input.type = "password";
            icon.classList.remove("fa-eye");
            icon.classList.add("fa-eye-slash");
        }
    }

    // Handle form submission dengan loading state
    document.getElementById('registerForm').addEventListener('submit', function(e) {
        const submitBtn = document.getElementById('submitBtn');
        submitBtn.textContent = 'Processing...';
        submitBtn.disabled = true;
    });

    // Display errors using SweetAlert2
    <?php if (session()->getFlashdata('errors')): ?>
        const errors = <?= json_encode(session()->getFlashdata('errors')) ?>;
        let errorMessage = '<div style="text-align: left;">';
        
        for (const field in errors) {
            errorMessage += `<p style="margin: 8px 0; color: #e74c3c;"><i class="fas fa-exclamation-circle" style="margin-right: 8px;"></i>${errors[field]}</p>`;
            
            // Highlight error fields
            const inputField = document.getElementById(field);
            if (inputField) {
                inputField.classList.add('error');
                inputField.addEventListener('input', function() {
                    this.classList.remove('error');
                });
            }
        }
        
        errorMessage += '</div>';
        
        Swal.fire({
            icon: 'error',
            title: 'Kesalahan Input',
            html: errorMessage,
            confirmButtonText: 'OK',
            confirmButtonColor: '#006c91',
            customClass: {
                popup: 'animated fadeInDown'
            }
        });
    <?php endif; ?>

    // Display success message
    <?php if (session()->getFlashdata('success')): ?>
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: '<?= session()->getFlashdata('success') ?>',
            confirmButtonText: 'OK',
            confirmButtonColor: '#00b496',
            customClass: {
                popup: 'animated fadeInDown'
            }
        });
    <?php endif; ?>

    // Display info message
    <?php if (session()->getFlashdata('info')): ?>
        Swal.fire({
            icon: 'info',
            title: 'Information',
            text: '<?= session()->getFlashdata('info') ?>',
            confirmButtonText: 'OK',
            confirmButtonColor: '#006c91',
            customClass: {
                popup: 'animated fadeInDown'
            }
        });
    <?php endif; ?>
    </script>
</body>

</html>