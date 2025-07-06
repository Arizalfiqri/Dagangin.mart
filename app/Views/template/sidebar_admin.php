<!-- sidebar_admin.php -->
<div class="sidebar">
    <div class="logo">
        <img src="<?= base_url('image/logo_toko_online.png') ?>" alt="Logo">
        <h3>DAGANGIN.MART</h3>
    </div>
    <nav class="sidebar-nav">
        <ul>
            <li class="<?= (uri_string() == 'admin/dashboard' || uri_string() == 'admin') ? 'active' : '' ?>">
                <a href="/admin/dashboard">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="<?= (strpos(uri_string(), 'admin/customer') !== false) ? 'active' : '' ?>">
                <a href="/admin/customer">
                    <i class="fas fa-users"></i>
                    <span>Customer</span>
                </a>
            </li>
            <li class="<?= (strpos(uri_string(), 'admin/produk') !== false) ? 'active' : '' ?>">
                <a href="/admin/produk">
                    <i class="fas fa-box"></i>
                    <span>Produk</span>
                </a>
            </li>
            <li class="<?= (strpos(uri_string(), 'admin/kategori') !== false) ? 'active' : '' ?>">
                <a href="/admin/kategori">
                    <i class="fas fa-tags"></i>
                    <span>Kategori</span>
                </a>
            </li>
            <li class="<?= (strpos(uri_string(), 'admin/pesanan') !== false) ? 'active' : '' ?>">
                <a href="/admin/pesanan">
                    <i class="fas fa-shopping-cart"></i>
                    <span>Pesanan</span>
                </a>
            </li>
        </ul>
    </nav>
</div>

<style>
.sidebar {
    background: linear-gradient(180deg, #1e40af 0%, #1290c2 100%);
    width: 260px;
    color: #ffffff;
    display: flex;
    flex-direction: column;
    box-shadow: 4px 0 6px -1px rgba(0, 0, 0, 0.1);
    position: relative;
}

.sidebar::before {
    content: '';
    position: absolute;
    top: 0;
    right: 0;
    width: 1px;
    height: 100%;
    background: rgba(255, 255, 255, 0.1);
}

.sidebar .logo {
    text-align: center;
    padding: 24px 20px;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    margin-bottom: 8px;
}

.sidebar .logo img {
    width: 48px;
    height: 48px;
    object-fit: contain;
    margin-bottom: 8px;
}

.sidebar .logo h3 {
    margin: 0;
    font-size: 16px;
    font-weight: 700;
    letter-spacing: 0.5px;
    color: #ffffff;
}

.sidebar-nav {
    flex: 1;
    overflow-y: auto;
}

.sidebar ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.sidebar ul li {
    margin: 2px 12px;
    border-radius: 8px;
    overflow: hidden;
}

.sidebar ul li a {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px 16px;
    text-decoration: none;
    color: rgba(255, 255, 255, 0.8);
    transition: all 0.3s ease;
    border-radius: 8px;
    font-weight: 500;
    font-size: 14px;
}

.sidebar ul li a i {
    width: 20px;
    text-align: center;
    font-size: 16px;
    color: rgba(255, 255, 255, 0.7);
}

.sidebar ul li:hover a,
.sidebar ul li.active a {
    background: rgba(255, 255, 255, 0.15);
    color: #ffffff;
    transform: translateX(4px);
}

.sidebar ul li:hover a i,
.sidebar ul li.active a i {
    color: #ffffff;
}

.sidebar ul li.active a {
    background: rgba(255, 255, 255, 0.2);
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}
</style>