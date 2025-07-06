<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login Admin</title>
    <link rel="shortcut icon" href="<?= base_url('image/logo_toko_online.png') ?>" type="image/x-icon">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />

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
    }

    .register {
        margin-top: 15px;
        font-size: 14px;
    }

    .register a {
        color: #ffffff;
        font-weight: bold;
        text-decoration: none;
    }
    </style>
</head>

<body>
    <div class="container">
        <div class="login-box">
            <div class="logo">
                <img src="<?= base_url('image/logo_toko_online.png') ?>" alt="Logo Toko">
            </div>

            <h2>Login Admin</h2>
            <form method="post" action="<?= base_url('/admin/login/process') ?>">
                <input type="text" name="username" placeholder="Username" required />
                <div class="password-field">
                    <input type="password" name="password" placeholder="Password" id="passwordInput" required />
                    <span class="toggle" onclick="togglePassword()">
                        <i class="fa-solid fa-eye-slash" id="toggleIcon"></i>
                    </span>
                </div>
                <label class="remember">
                    <input type="checkbox" />
                    Remember me
                </label>
                <button type="submit">LOGIN</button>
            </form>
            <p class="register">Belum punya akun? <a href="<?= base_url('register-admin') ?>">Daftar</a></p>
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
    </script>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
    </script>

    <?php if (session()->getFlashdata('error')): ?>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Login Gagal',
            text: '<?= session()->getFlashdata('error') ?>',
            confirmButtonColor: '#3085d6'
        });
    </script>
    <?php endif; ?>

</body>

</html>