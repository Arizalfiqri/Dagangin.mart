<?= $this->extend('layout/base_user') ?>

<?= $this->section('style') ?>
<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
    background-color: #f8fafc;
    color: #1a1a1a;
    line-height: 1.5;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 1rem;
}

/* Header Section */
.page-header {
    background: linear-gradient(135deg, #1594ce 0%, #0675a9 100%);
    padding: 2rem 0;
    margin-bottom: 2rem;
}

.page-title {
    font-size: 2rem;
    font-weight: 700;
    color: #ffffff;
    margin-bottom: 0.5rem;
}

.page-subtitle {
    font-size: 1rem;
    color: rgba(255, 255, 255, 0.9);
    font-weight: 400;
}

/* Cart Layout */
.cart-layout {
    display: grid;
    grid-template-columns: 1fr 400px;
    gap: 2rem;
    margin-bottom: 2rem;
}

/* Cart Items Section */
.cart-items-section {
    background: white;
    border-radius: 16px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    border: 1px solid #e5e7eb;
}

.cart-header {
    padding: 1.5rem;
    border-bottom: 1px solid #e5e7eb;
    background: #f9fafb;
}

.select-all-container {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.select-all-container input[type="checkbox"] {
    width: 18px;
    height: 18px;
    accent-color: #1594ce;
    cursor: pointer;
}

.select-all-label {
    font-weight: 600;
    color: #374151;
    cursor: pointer;
    font-size: 0.95rem;
}

.cart-items {
    max-height: 70vh;
    overflow-y: auto;
}

.cart-item {
    display: flex;
    align-items: center;
    padding: 1.5rem;
    border-bottom: 1px solid #f3f4f6;
    gap: 1rem;
    transition: background-color 0.2s ease;
}

.cart-item:hover {
    background: #f9fafb;
}

.cart-item:last-child {
    border-bottom: none;
}

.item-checkbox {
    width: 18px;
    height: 18px;
    accent-color: #1594ce;
    cursor: pointer;
}

.item-image {
    width: 80px;
    height: 80px;
    border-radius: 12px;
    object-fit: cover;
    background: #f3f4f6;
    flex-shrink: 0;
}

.item-details {
    flex: 1;
    min-width: 0;
}

.item-name {
    font-weight: 600;
    font-size: 1rem;
    margin-bottom: 0.5rem;
    color: #1f2937;
    line-height: 1.4;
}

.item-category {
    font-size: 0.8rem;
    color: #1594ce;
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 0.025em;
    margin-bottom: 0.25rem;
}

.item-price {
    color: #6b7280;
    font-size: 0.9rem;
    font-weight: 500;
}

.quantity-controls {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    margin: 0 1rem;
    flex-shrink: 0;
}

.qty-btn {
    width: 36px;
    height: 36px;
    border: 1px solid #d1d5db;
    background: white;
    border-radius: 8px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 16px;
    color: #374151;
    font-weight: 600;
    transition: all 0.2s ease;
}

.qty-btn:hover {
    background: #f3f4f6;
    border-color: #1594ce;
    color: #1594ce;
}

.qty-btn:disabled {
    opacity: 0.5;
    cursor: not-allowed;
}

.qty-input {
    width: 60px;
    height: 36px;
    border: 1px solid #d1d5db;
    border-radius: 8px;
    text-align: center;
    font-size: 0.95rem;
    font-weight: 600;
    color: #374151;
}

.qty-input:focus {
    outline: none;
    border-color: #1594ce;
}

.item-total-price {
    min-width: 120px;
    text-align: right;
    flex-shrink: 0;
}

.item-total {
    font-weight: 700;
    color: #1594ce;
    font-size: 1.1rem;
    margin-bottom: 0.25rem;
}

.item-unit-price {
    font-size: 0.8rem;
    color: #6b7280;
}

.remove-btn {
    background: none;
    border: none;
    color: #ef4444;
    font-size: 1.1rem;
    cursor: pointer;
    padding: 0.5rem;
    border-radius: 8px;
    transition: background-color 0.2s ease;
    margin-left: 0.5rem;
    flex-shrink: 0;
}

.remove-btn:hover {
    background: #fef2f2;
}

/* Cart Summary */
.cart-summary {
    background: white;
    border-radius: 16px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    border: 1px solid #e5e7eb;
    position: sticky;
    top: 2rem;
    height: fit-content;
}

.summary-header {
    padding: 1.5rem;
    border-bottom: 1px solid #e5e7eb;
    background: #f9fafb;
    border-radius: 16px 16px 0 0;
}

.summary-title {
    font-size: 1.25rem;
    font-weight: 700;
    color: #1f2937;
}

.summary-content {
    padding: 1.5rem;
}

.summary-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1rem;
    font-size: 0.95rem;
}

.summary-row:last-child {
    margin-bottom: 0;
}

.summary-label {
    color: #6b7280;
    font-weight: 500;
}

.summary-value {
    font-weight: 600;
    color: #374151;
}

.summary-divider {
    height: 1px;
    background: #e5e7eb;
    margin: 1.5rem 0;
}

.total-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1rem 0;
    border-top: 2px solid #e5e7eb;
    margin-top: 1rem;
}

.total-label {
    font-size: 1.1rem;
    font-weight: 700;
    color: #1f2937;
}

.total-amount {
    font-size: 1.5rem;
    font-weight: 800;
    color: #1594ce;
}

.checkout-btn {
    width: 100%;
    background: linear-gradient(135deg, #1594ce, #0675a9);
    color: white;
    border: none;
    padding: 1rem;
    border-radius: 12px;
    font-size: 1rem;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.3s ease;
    margin-top: 1.5rem;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
}

.checkout-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(21, 148, 206, 0.3);
}

.checkout-btn:disabled {
    background: #9ca3af;
    cursor: not-allowed;
    transform: none;
    box-shadow: none;
}

/* Empty Cart */
.empty-cart {
    background: white;
    border-radius: 16px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    border: 1px solid #e5e7eb;
    text-align: center;
    padding: 4rem 2rem;
    grid-column: 1 / -1;
}

.empty-cart i {
    font-size: 4rem;
    margin-bottom: 1.5rem;
    color: #d1d5db;
}

.empty-cart h3 {
    font-size: 1.5rem;
    font-weight: 700;
    color: #374151;
    margin-bottom: 0.75rem;
}

.empty-cart p {
    color: #6b7280;
    font-size: 1rem;
    margin-bottom: 2rem;
}

.start-shopping-btn {
    background: linear-gradient(135deg, #1594ce, #0675a9);
    color: white;
    border: none;
    padding: 1rem 2rem;
    border-radius: 12px;
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    transition: all 0.3s ease;
}

.start-shopping-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(21, 148, 206, 0.3);
    color: white;
}

/* Loading State */
.loading {
    opacity: 0.6;
    pointer-events: none;
}

/* Responsive */
@media (max-width: 1024px) {
    .cart-layout {
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }
    
    .cart-summary {
        position: static;
    }
}

@media (max-width: 768px) {
    .page-title {
        font-size: 1.75rem;
    }
    
    .cart-item {
        flex-wrap: wrap;
        gap: 1rem;
    }
    
    .item-image {
        width: 70px;
        height: 70px;
    }
    
    .quantity-controls {
        margin: 0;
        order: 3;
        flex-basis: 100%;
        justify-content: center;
    }
    
    .item-total-price {
        order: 2;
        min-width: auto;
        text-align: left;
    }
}

@media (max-width: 480px) {
    .container {
        padding: 0 0.5rem;
    }
    
    .cart-items-section,
    .cart-summary {
        border-radius: 12px;
    }
}
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="page-header">
    <div class="container">
        <h1 class="page-title">Keranjang Belanja</h1>
        <p class="page-subtitle">Kelola produk yang akan Anda beli</p>
    </div>
</div>

<div class="container">
    <?php if (empty($keranjang)): ?>
        <div class="empty-cart">
            <i class="fas fa-shopping-cart"></i>
            <h3>Keranjang Anda Kosong</h3>
            <p>Belum ada produk yang ditambahkan ke keranjang. Mulai berbelanja sekarang!</p>
            <a href="<?= base_url('/') ?>" class="start-shopping-btn">
                <i class="fas fa-shopping-bag"></i>
                Mulai Belanja
            </a>
        </div>
    <?php else: ?>
        <div class="cart-layout">
            <!-- Cart Items Section -->
            <div class="cart-items-section">
                <div class="cart-header">
                    <div class="select-all-container">
                        <input type="checkbox" id="select-all" checked>
                        <label for="select-all" class="select-all-label">Pilih Semua Produk</label>
                    </div>
                </div>

                <div class="cart-items">
                    <?php foreach ($keranjang as $item): ?>
                        <div class="cart-item" data-id="<?= $item['id'] ?>" data-price="<?= $item['harga'] ?>">
                            <input type="checkbox" class="item-checkbox" checked data-price="<?= $item['harga'] * $item['jumlah'] ?>">
                            
                            <img src="<?= base_url('uploads/produk/' . $item['foto']) ?>" 
                                 alt="<?= $item['nama'] ?>" class="item-image">
                            
                            <div class="item-details">
                                <div class="item-category"><?= $item['nama_kategori'] ?? 'Produk' ?></div>
                                <div class="item-name"><?= $item['nama'] ?></div>
                                <div class="item-price">Rp <?= number_format($item['harga'], 0, ',', '.') ?> per item</div>
                            </div>
                            
                            <div class="quantity-controls">
                                <button class="qty-btn minus-btn" data-id="<?= $item['id'] ?>">-</button>
                                <input type="number" class="qty-input" value="<?= $item['jumlah'] ?>" 
                                       min="1" data-id="<?= $item['id'] ?>">
                                <button class="qty-btn plus-btn" data-id="<?= $item['id'] ?>">+</button>
                            </div>
                            
                            <div class="item-total-price">
                                <div class="item-total">Rp <?= number_format($item['harga'] * $item['jumlah'], 0, ',', '.') ?></div>
                                <div class="item-unit-price"><?= $item['jumlah'] ?> item</div>
                            </div>
                            
                            <button class="remove-btn" data-id="<?= $item['id'] ?>" title="Hapus dari keranjang">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Cart Summary -->
            <div class="cart-summary">
                <div class="summary-header">
                    <h3 class="summary-title">Ringkasan Pesanan</h3>
                </div>
                
                <div class="summary-content">
                    <div class="summary-row">
                        <span class="summary-label">Total Produk</span>
                        <span class="summary-value" id="selected-count"><?= count($keranjang) ?> item</span>
                    </div>
                    
                    <div class="summary-row">
                        <span class="summary-label">Subtotal</span>
                        <span class="summary-value" id="subtotal">Rp <?= number_format($total_harga, 0, ',', '.') ?></span>
                    </div>
                    
                    <div class="summary-row">
                        <span class="summary-label">Ongkos Kirim</span>
                        <span class="summary-value" style="color: #10b981;">GRATIS</span>
                    </div>
                    
                    <div class="summary-divider"></div>
                    
                    <div class="total-row">
                        <span class="total-label">Total Pembayaran</span>
                        <span class="total-amount" id="total-amount">Rp <?= number_format($total_harga, 0, ',', '.') ?></span>
                    </div>
                    
                    <button class="checkout-btn" id="checkout-btn">
                        <i class="fas fa-credit-card"></i>
                        Lanjut ke Pembayaran
                    </button>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
// Global variables
let cartData = <?= json_encode($keranjang ?? []) ?>;

// Initialize
document.addEventListener('DOMContentLoaded', function() {
    updateCartSummary();
    attachEventListeners();
});

function attachEventListeners() {
    // Quantity controls
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('plus-btn')) {
            const input = e.target.previousElementSibling;
            const newValue = parseInt(input.value) + 1;
            input.value = newValue;
            updateQuantity(input.dataset.id, newValue);
        }
        
        if (e.target.classList.contains('minus-btn')) {
            const input = e.target.nextElementSibling;
            const currentValue = parseInt(input.value);
            if (currentValue > 1) {
                const newValue = currentValue - 1;
                input.value = newValue;
                updateQuantity(input.dataset.id, newValue);
            }
        }
    });

    // Quantity input change
    document.addEventListener('change', function(e) {
        if (e.target.classList.contains('qty-input')) {
            const value = parseInt(e.target.value);
            if (value >= 1) {
                updateQuantity(e.target.dataset.id, value);
            } else {
                e.target.value = 1;
                updateQuantity(e.target.dataset.id, 1);
            }
        }
    });

    // Remove item
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-btn') || e.target.closest('.remove-btn')) {
            const btn = e.target.classList.contains('remove-btn') ? e.target : e.target.closest('.remove-btn');
            const id = btn.dataset.id;
            
            Swal.fire({
                title: 'Hapus Produk?',
                text: 'Produk akan dihapus dari keranjang belanja',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    removeItem(id);
                }
            });
        }
    });

    // Select all functionality
    document.getElementById('select-all')?.addEventListener('change', function() {
        const checkboxes = document.querySelectorAll('.item-checkbox');
        checkboxes.forEach(cb => {
            cb.checked = this.checked;
        });
        updateCartSummary();
    });

    // Individual checkbox change
    document.addEventListener('change', function(e) {
        if (e.target.classList.contains('item-checkbox')) {
            updateSelectAllState();
            updateCartSummary();
        }
    });

    // Checkout button
    document.getElementById('checkout-btn')?.addEventListener('click', function() {
        const selectedItems = getSelectedItems();
        if (selectedItems.length === 0) {
            Swal.fire({
                title: 'Tidak Ada Produk Dipilih',
                text: 'Silakan pilih produk yang ingin dibeli',
                icon: 'warning',
                confirmButtonColor: '#1594ce'
            });
            return;
        }
        
        // Redirect ke halaman checkout
        window.location.href = '<?= base_url('checkout') ?>';
    });
}

function updateQuantity(id, quantity) {
    const cartItem = document.querySelector(`[data-id="${id}"]`);
    if (cartItem) {
        cartItem.classList.add('loading');
    }
    
    fetch('<?= base_url('keranjang/update') ?>', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `id=${id}&jumlah=${quantity}`
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            // Update UI without full reload
            updateItemTotal(id, quantity);
            updateCartSummary();
            updateCartCount(); // Ini akan update counter di navbar
        } else {
            Swal.fire({
                title: 'Gagal Update',
                text: data.message,
                icon: 'error',
                confirmButtonColor: '#ef4444'
            });
        }
    })
    .catch(error => {
        console.error('Error:', error);
        Swal.fire({
            title: 'Terjadi Kesalahan',
            text: 'Silakan coba lagi',
            icon: 'error',
            confirmButtonColor: '#ef4444'
        });
    })
    .finally(() => {
        if (cartItem) {
            cartItem.classList.remove('loading');
        }
    });
}

function removeItem(id) {
    const cartItem = document.querySelector(`[data-id="${id}"]`);
    if (cartItem) {
        cartItem.classList.add('loading');
    }
    
    fetch('<?= base_url('keranjang/remove') ?>', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `id=${id}`
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            // Remove item from DOM with animation
            if (cartItem) {
                cartItem.style.transform = 'translateX(-100%)';
                cartItem.style.opacity = '0';
                setTimeout(() => {
                    cartItem.remove();
                    updateCartSummary();
                    updateCartCount(); // Ini akan update counter di navbar
                    
                    // Check if cart is empty
                    if (document.querySelectorAll('.cart-item').length === 0) {
                        location.reload();
                    }
                }, 300);
            }
            
            Swal.fire({
                title: 'Berhasil!',
                text: 'Produk telah dihapus dari keranjang',
                icon: 'success',
                timer: 2000,
                showConfirmButton: false
            });
        } else {
            Swal.fire({
                title: 'Gagal Hapus',
                text: data.message,
                icon: 'error',
                confirmButtonColor: '#ef4444'
            });
        }
    })

    .catch(error => {
        console.error('Error:', error);
        Swal.fire({
            title: 'Terjadi Kesalahan',
            text: 'Silakan coba lagi',
            icon: 'error',
            confirmButtonColor: '#ef4444'
        });
    })
    .finally(() => {
        if (cartItem) {
            cartItem.classList.remove('loading');
        }
    });
}

function updateItemTotal(id, quantity) {
    const cartItem = document.querySelector(`[data-id="${id}"]`);
    if (!cartItem) return;
    
    const price = parseInt(cartItem.dataset.price);
    const total = price * quantity;
    
    // Update item total display
    const totalElement = cartItem.querySelector('.item-total');
    const unitElement = cartItem.querySelector('.item-unit-price');
    
    if (totalElement) {
        totalElement.textContent = `Rp ${total.toLocaleString('id-ID')}`;
    }
    
    if (unitElement) {
        unitElement.textContent = `${quantity} item`;
    }
    
    // Update checkbox price data
    const checkbox = cartItem.querySelector('.item-checkbox');
    if (checkbox) {
        checkbox.dataset.price = total;
    }
}

function getSelectedItems() {
    const selectedCheckboxes = document.querySelectorAll('.item-checkbox:checked');
    return Array.from(selectedCheckboxes);
}

function updateCartSummary() {
    const selectedItems = getSelectedItems();
    let totalPrice = 0;
    let totalCount = 0;
    
    selectedItems.forEach(checkbox => {
        const price = parseInt(checkbox.dataset.price) || 0;
        totalPrice += price;
        totalCount += 1;
    });
    
    // Update summary display
    const selectedCountEl = document.getElementById('selected-count');
    const subtotalEl = document.getElementById('subtotal');
    const totalAmountEl = document.getElementById('total-amount');
    const checkoutBtn = document.getElementById('checkout-btn');
    
    if (selectedCountEl) {
        selectedCountEl.textContent = `${totalCount} item`;
    }
    
    if (subtotalEl) {
        subtotalEl.textContent = `Rp ${totalPrice.toLocaleString('id-ID')}`;
    }
    
    if (totalAmountEl) {
        totalAmountEl.textContent = `Rp ${totalPrice.toLocaleString('id-ID')}`;
    }
    
    if (checkoutBtn) {
        checkoutBtn.disabled = totalCount === 0;
        if (totalCount === 0) {
            checkoutBtn.innerHTML = '<i class="fas fa-shopping-cart"></i> Pilih Produk';
        } else {
            checkoutBtn.innerHTML = `<i class="fas fa-credit-card"></i> Lanjut ke Pembayaran (${totalCount})`;
        }
    }
}

function updateSelectAllState() {
    const allCheckboxes = document.querySelectorAll('.item-checkbox');
    const checkedCheckboxes = document.querySelectorAll('.item-checkbox:checked');
    const selectAllCheckbox = document.getElementById('select-all');
    
    if (selectAllCheckbox) {
        if (checkedCheckboxes.length === 0) {
            selectAllCheckbox.checked = false;
            selectAllCheckbox.indeterminate = false;
        } else if (checkedCheckboxes.length === allCheckboxes.length) {
            selectAllCheckbox.checked = true;
            selectAllCheckbox.indeterminate = false;
        } else {
            selectAllCheckbox.checked = false;
            selectAllCheckbox.indeterminate = true;
        }
    }
}

function updateCartCount() {
    fetch('<?= base_url('keranjang/count') ?>')
    .then(response => response.json())
    .then(data => {
        const cartCountEl = document.getElementById('cart-count');
        if (cartCountEl) {
            const count = data.count || 0;
            cartCountEl.textContent = count;
            cartCountEl.classList.add('loaded');
            
            // Show/hide counter based on count  
            if (count > 0) {
                cartCountEl.style.display = 'flex';
                cartCountEl.classList.add('has-items');
            } else {
                cartCountEl.style.display = 'none';
                cartCountEl.classList.remove('has-items');
            }
        }
        
        // Update global cart counter jika ada
        if (typeof window.updateCartCounter === 'function') {
            window.updateCartCounter();
        }
    })
    .catch(error => {
        console.error('Error updating cart count:', error);
        const cartCountEl = document.getElementById('cart-count');
        if (cartCountEl) {
            cartCountEl.style.display = 'none';
        }
    });
}
</script>
<?= $this->endSection() ?>