<?php
use CodeIgniter\Router\RouteCollection;
/**
 * @var RouteCollection $routes
 */

// Public Routes (No Auth Required)
$routes->get('/', 'User::index');
$routes->get('/about', 'User::about');
$routes->get('/product', 'User::allProduct');
$routes->get('/product/(:alphanum)', 'User::detailProduct/$1');
// Customer Auth Routes
$routes->get('/login-customer', 'AuthCustomer::loginCustomer');
$routes->get('/register-customer', 'AuthCustomer::registerCustomer');
$routes->post('/customer/login/process', 'AuthCustomer::loginProcess');
$routes->post('/customer/register/store', 'AuthCustomer::registerStore');
$routes->get('/customer/logout', 'AuthCustomer::logout');

// Customer Profile Routes
$routes->get('profile', 'Customer::profile', ['filter' => 'customerAuth']);
$routes->post('customer/update-profile', 'Customer::updateProfile', ['filter' => 'customerAuth']);
$routes->post('customer/update-contact', 'Customer::updateContact', ['filter' => 'customerAuth']);
$routes->post('customer/update-address', 'Customer::updateAddress', ['filter' => 'customerAuth']);

// Admin Auth Routes (No Filter - Public Access)
$routes->get('/admin/login', 'AuthAdmin::login');
$routes->post('/admin/login/process', 'AuthAdmin::loginProcess');
$routes->get('/admin/logout', 'AuthAdmin::logout');

// Admin Registration Routes (No Filter - Public Access)
$routes->get('/register-admin', 'AdminRegister::index');
$routes->post('/admin/register/store', 'AdminRegister::store');
$routes->get('/admin/register/status', 'AdminRegister::status');

// Verification Routes (No Filter - Public Access)
$routes->get('verification/approve/(:segment)', 'Verification::approve/$1');
$routes->get('verification/reject/(:segment)', 'Verification::reject/$1');

// Keranjang Routes (Require Customer Login)
$routes->group('keranjang', function($routes) {
    $routes->get('/', 'Keranjang::index');
    $routes->post('add', 'Keranjang::add');
    $routes->post('update', 'Keranjang::update');
    $routes->post('remove', 'Keranjang::remove');
    $routes->get('count', 'Keranjang::getCount');
});


$routes->group('checkout', function($routes) {
    $routes->get('/', 'Checkout::index');
    $routes->post('process', 'Checkout::process');
});


// Role Admin Group (Protected Routes)
$routes->group('admin', function($routes) {
    // Dashboard
    $routes->get('dashboard', 'Admin::index');
    
    // AJAX Routes untuk modal pesanan
    $routes->get('get-new-orders', 'Admin::getNewOrders');
    
    // Produk Management
    $routes->group('produk', function($routes) {
        $routes->get('/', 'Admin::produk');
        $routes->get('tambah', 'Admin::tambahProduk');
        $routes->post('tambah', 'Admin::tambahProduk');
        $routes->get('edit/(:num)', 'Admin::editProduk/$1');
        $routes->post('edit/(:num)', 'Admin::editProduk/$1');
        $routes->get('hapus/(:num)', 'Admin::hapusProduk/$1');
    });
    
    // Kategori Management
    $routes->group('kategori', function($routes) {
        $routes->get('/', 'Admin::kategori');
        $routes->get('tambah', 'Admin::tambahKategori');
        $routes->post('tambah', 'Admin::tambahKategori');
        $routes->get('edit/(:num)', 'Admin::editKategori/$1');
        $routes->post('edit/(:num)', 'Admin::editKategori/$1');
        $routes->get('hapus/(:num)', 'Admin::hapusKategori/$1');
        $routes->post('hapus/(:num)', 'Admin::hapusKategori/$1');
    });
    
    // Customer Management
    $routes->group('customer', function($routes) {
        $routes->get('/', 'Admin::customer');
        $routes->get('edit/(:num)', 'Admin::editCustomer/$1');
        $routes->post('update/(:num)', 'Admin::updateCustomer/$1');
        $routes->get('delete/(:num)', 'Admin::deleteCustomer/$1');
    });
    
    // Pesanan Management
    $routes->group('pesanan', function($routes) {
        $routes->get('/', 'Admin::pesanan');
        $routes->post('ubah/(:segment)', 'Admin::ubahStatusPesanan/$1');
        $routes->get('hapus/(:segment)', 'Admin::hapusPesanan/$1');
        $routes->get('detail/(:segment)', 'Admin::detailPesanan/$1');
    });
});