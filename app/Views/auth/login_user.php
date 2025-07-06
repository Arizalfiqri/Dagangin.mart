<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login User</title>
    <link rel="shortcut icon" href="<?= base_url('image/logo_toko_online.png') ?>" type="image/x-icon">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
        height: 100vh;
    }

    .container {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .login-box {
        background-color: #044f56;
        padding: 40px;
        border-radius: 15px;
        width: 350px;
        color: #fff;
        text-align: center;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
    }

    .logo img {
        width: 60px;
        margin-bottom: 10px;
    }

    .login-box h2 {
        margin-bottom: 30px;
        color: #ddd;
    }

    .login-box input[type="text"],
    .login-box input[type="password"] {
        width: 100%;
        padding: 12px;
        margin-bottom: 15px;
        border: none;
        border-radius: 5px;
        box-sizing: border-box;
        font-size: 14px;
        transition: all 0.3s ease;
    }

    .login-box input:focus {
        outline: none;
        box-shadow: 0 0 5px rgba(255, 255, 255, 0.5);
    }

    .password-field {
        position: relative;
    }

    .password-field input {
        padding-right: 35px;
    }

    .password-field .toggle {
        position: absolute;
        right: 10px;
        top: 12px;
        cursor: pointer;
        font-size: 16px;
        color: #aaa;
    }

    .remember {
        display: flex;
        align-items: center;
        font-size: 14px;
        margin-bottom: 20px;
        color: #b5eaff;
        text-align: left;
    }

    .remember input {
        margin-right: 10px;
    }

    button {
        width: 100%;
        padding: 12px;
        border: none;
        background-color: #fff8dd;
        color: #006c91;
        font-weight: bold;
        border-radius: 5px;
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: 16px;
    }

    button:hover {
        background-color: #f0e8c8;
        transform: translateY(-2px);
    }

    button:disabled {
        opacity: 0.6;
        cursor: not-allowed;
        transform: none;
    }

    .register {
        margin-top: 15px;
        font-size: 14px;
        color: #b5eaff;
    }

    .register a {
        color: #ffffff;
        font-weight: bold;
        text-decoration: none;
    }

    .register a:hover {
        text-decoration: underline;
    }

    /* Responsive */
    @media (max-width: 400px) {
        .login-box {
            width: 300px;
            padding: 30px 20px;
        }
    }
    </style>
</head>

<body>
    <div class="container">
        <div class="login-box">
            <div class="logo">
                <img src="<?= base_url('image/logo_toko_online.png') ?>" alt="Logo Toko">
            </div>

            <h2>Login User</h2>
            <form method="post" action="<?= base_url('customer/login/process') ?>" id="loginForm">
                <input type="text" name="username" placeholder="Username" id="usernameInput" required />
                <div class="password-field">
                    <input type="password" name="password" placeholder="Password" id="passwordInput" required />
                    <span class="toggle" onclick="togglePassword()">
                        <i class="fa-solid fa-eye-slash" id="toggleIcon"></i>
                    </span>
                </div>
                <label class="remember">
                    <input type="checkbox" name="remember" />
                    Ingat saya
                </label>
                <button type="submit" id="loginBtn">LOGIN</button>
            </form>
            <p class="register">Belum punya akun? <a href="<?= base_url('register-customer') ?>">Daftar</a></p>
        </div>
    </div>

    <script>
    function togglePassword() {
        const passwordInput = document.getElementById("passwordInput");
        const toggleIcon = document.getElementById("toggleIcon");

        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            toggleIcon.classList.remove("fa-eye-slash");
            toggleIcon.classList.add("fa-eye");
        } else {
            passwordInput.type = "password";
            toggleIcon.classList.remove("fa-eye");
            toggleIcon.classList.add("fa-eye-slash");
        }
    }

    // Handle form submission dengan loading state
    document.getElementById('loginForm').addEventListener('submit', function(e) {
        const loginBtn = document.getElementById('loginBtn');
        loginBtn.textContent = 'Processing...';
        loginBtn.disabled = true;
    });

    // Display error message using SweetAlert2
    <?php if (session()->getFlashdata('error')): ?>
    Swal.fire({
        icon: 'error',
        title: 'Login Gagal',
        text: '<?= session()->getFlashdata('error') ?>',
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
        title: 'Berhasil!',
        text: '<?= session()->getFlashdata('success') ?>',
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
        title: 'Informasi',
        text: '<?= session()->getFlashdata('info') ?>',
        confirmButtonColor: '#006c91',
        customClass: {
            popup: 'animated fadeInDown'
        }
    });
    <?php endif; ?>
    </script>

</body>

</html>