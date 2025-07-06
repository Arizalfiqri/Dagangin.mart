<!-- Topbar -->
<div class="topbar">
    <div class="kontak">
        <p>dagangin@gmail.com</p>
    </div>
    <div class="btn-auth">
        <?php if (session()->get('customer_logged_in')): ?>
            <!-- Tampilkan tombol logout jika sudah login -->
            <a href="<?= base_url('customer/logout') ?>">
                <i class="fa-solid fa-arrow-right-from-bracket"></i>
                LOGOUT
            </a>
        <?php else: ?>
            <!-- Tampilkan tombol login dan daftar jika belum login -->
            <a href="<?= base_url('login-customer') ?>" class="btn-login">
                <i class="fa-solid fa-arrow-right-to-bracket"></i>
                LOGIN
            </a>
            <span class="separator">|</span>
            <a href="<?= base_url('register-customer') ?>" class="btn-register">
                <i class="fa-solid fa-user-plus"></i>
                DAFTAR
            </a>
        <?php endif; ?>
    </div>
</div>

<!-- Navbar -->
<nav>
    <div class="brand">
        <img src="<?= base_url('image/logo_toko_online.png') ?>" alt="logo">
        <a href="/">DAGANGIN.MART</a>
    </div>
    <div class="menu">
        <ul>
            <li><a href="/">HOME</a></li>
            <li><a href="/about">ABOUT US</a></li>
            <li><a href="/product">ALL PRODUCT</a></li>
        </ul>
    </div>
    <div class="lainnya">
        <?php if (session()->get('customer_logged_in')): ?>
            <a href="<?= base_url('keranjang') ?>" class="cart-link">
                <i class="fa-solid fa-cart-shopping"></i>
                <span class="cart-count" id="cart-count">0</span>
            </a>
        <?php else: ?>
            <a href="<?= base_url('login-customer') ?>">
                <i class="fa-solid fa-cart-shopping"></i>
            </a>
        <?php endif; ?>
        <a href="#"><i class="fa-solid fa-envelope"></i></a>
        <?php if (session()->get('customer_logged_in')): ?>
            <div class="dropdown">
                <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown" title="<?= session()->get('customer_username') ?>">
                    <i class="fa-solid fa-user"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="drop-item text-warning" href="<?= base_url('profile') ?>">
                        <i class="fa-solid fa-user-circle"></i> Profil Saya
                    </a></li>
                    <li><a class="drop-item text-warning" href="<?= base_url('orders') ?>">
                        <i class="fa-solid fa-shopping-bag"></i> Pesanan Saya
                    </a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="drop-item text-danger" href="#" onclick="showLogoutModal()">
                        <i class="fa-solid fa-sign-out-alt"></i> Logout
                    </a></li>
                </ul>
            </div>
        <?php else: ?>
            <a href="<?= base_url('login-customer') ?>">
                <i class="fa-solid fa-user"></i>
            </a>
        <?php endif; ?>
    </div>
</nav>

<style>
/* Topbar */
.topbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 8px 40px;
    background-color: #0675a9;
    font-family: Arial, sans-serif;
}

.topbar .kontak p {
    color: #ffffff;
    font-size: 13px;
    margin: 0;
}

.btn-auth {
    display: flex;
    align-items: center;
    gap: 8px;
}

.btn-auth a {
    font-size: 13px;
    text-decoration: none;
    color: #ffffff;
    transition: color 0.3s ease-in-out;
}

.btn-auth a:hover {
    color: #ff4b4b;
}

.btn-auth .separator {
    color: #ffffff;
    font-size: 13px;
}

/* Navbar */
nav {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 12px 40px;
    background-color: #1594ce;
    position: sticky;
    top: 0;
    z-index: 999;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
}

nav .brand {
    display: flex;
    align-items: center;
    gap: 10px;
}

nav .brand img {
    width: 45px;
    vertical-align: middle;
}

nav .brand a {
    color: #ffffff;
    text-decoration: none;
    font-weight: 700;
    font-size: 20px;
    line-height: 1;
}

nav .menu ul {
    display: flex;
    gap: 1.5rem;
    margin: 0;
    padding: 0;
}

nav .menu ul li {
    list-style: none;
}

nav .menu ul li a {
    color: #ffffff;
    text-decoration: none;
    font-size: 13px;
    font-weight: 600;
    padding: 6px 0;
    display: inline-block;
}

nav .menu ul li a:hover {
    text-decoration: underline;
}

nav .lainnya {
    display: flex;
    align-items: center;
    gap: 1.5rem;
}

nav .lainnya a {
    color: #ffffff;
    font-size: 18px;
    text-decoration: none;
    transition: color 0.2s;
}

nav .lainnya a:hover {
    color: #ffeb3b;
}

.cart-count.has-items {
    animation: cartBounce 0.5s ease-out;
}

.dropdown-menu {
    border: none;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
    border-radius: 8px;
    padding: 0.5rem 0;
    min-width: 180px;
}

.drop-item {
    padding: 0.5rem 1rem;
    color: #495057;
    transition: all 0.2s ease;
}


.drop-item i {
    margin-right: 0.5rem;
    width: 16px;
}

.dropdown-toggle::after {
    display: none;
}

@keyframes cartBounce {
    0% { transform: scale(1); }
    50% { transform: scale(1.3); }
    100% { transform: scale(1); }
}


/* Enhanced Cart Counter - Tambahkan ke navbar CSS */
.cart-count {
    position: absolute;
    top: -8px;
    right: -8px;
    background: linear-gradient(135deg, #ff4444, #ff6b6b);
    color: white;
    border-radius: 50%;
    width: 20px;
    height: 20px;
    font-size: 11px;
    display: none; /* Hidden by default */
    align-items: center;
    justify-content: center;
    font-weight: bold;
    transition: all 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
    border: 2px solid #ffffff;
    box-shadow: 0 2px 8px rgba(255, 68, 68, 0.3);
    min-width: 20px;
    opacity: 0; /* Start invisible */
}

.cart-count.loaded {
    opacity: 1;
}

.cart-count.has-items {
    display: flex !important;
}

/* Show cart count when it has value */
.cart-count:not(:empty) {
    display: flex;
}

/* Cart link enhancements */
.cart-link {
    position: relative;
    transition: transform 0.2s ease;
}

.cart-link:hover {
    transform: scale(1.05);
}

.cart-link:hover .cart-count {
    transform: scale(1.1);
    box-shadow: 0 4px 12px rgba(255, 68, 68, 0.4);
}


/* Responsive untuk topbar */
@media (max-width: 768px) {
    .topbar {
        padding: 8px 20px;
    }
    
    .btn-auth {
        gap: 5px;
    }
    
    .btn-auth a {
        font-size: 12px;
    }
    
    nav {
        padding: 12px 20px;
    }
}


</style>

<script>
// Set base URL for cart counter
const baseUrl = '<?= base_url() ?>';
</script>

<!-- Load cart counter script -->
<script src="<?= base_url('js/cart_counter.js') ?>"></script>