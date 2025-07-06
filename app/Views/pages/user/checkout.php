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
    max-width: 1000px;
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

/* Checkout Layout */
.checkout-layout {
    display: grid;
    grid-template-columns: 1fr 400px;
    gap: 2rem;
    margin-bottom: 2rem;
}

/* Checkout Form */
.checkout-form {
    background: white;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    border: 1px solid #e5e7eb;
}

.form-header {
    padding: 1.5rem;
    background: #f9fafb;
    border-bottom: 1px solid #e5e7eb;
}

.form-title {
    font-size: 1.25rem;
    font-weight: 700;
    color: #1f2937;
    margin-bottom: 0.5rem;
}

.form-subtitle {
    color: #6b7280;
    font-size: 0.9rem;
}

.form-content {
    padding: 1.5rem;
}

.form-group {
    margin-bottom: 1.5rem;
}

.form-label {
    display: block;
    font-weight: 600;
    color: #374151;
    margin-bottom: 0.5rem;
    font-size: 0.95rem;
}

.form-input {
    width: 100%;
    padding: 0.75rem 1rem;
    border: 1px solid #d1d5db;
    border-radius: 8px;
    font-size: 0.95rem;
    transition: border-color 0.2s ease;
}

.form-input:focus {
    outline: none;
    border-color: #1594ce;
    box-shadow: 0 0 0 3px rgba(21, 148, 206, 0.1);
}

.form-input.error {
    border-color: #ef4444;
}

.error-message {
    color: #ef4444;
    font-size: 0.8rem;
    margin-top: 0.25rem;
}

/* Order Summary */
.order-summary {
    background: white;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    border: 1px solid #e5e7eb;
    position: sticky;
    top: 2rem;
    height: fit-content;
}

.summary-header {
    padding: 1.5rem;
    background: #f9fafb;
    border-bottom: 1px solid #e5e7eb;
    border-radius: 12px 12px 0 0;
}

.summary-title {
    font-size: 1.25rem;
    font-weight: 700;
    color: #1f2937;
}

.summary-content {
    padding: 1.5rem;
}

.order-items {
    margin-bottom: 1.5rem;
}

.order-item {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1rem 0;
    border-bottom: 1px solid #f3f4f6;
}

.order-item:last-child {
    border-bottom: none;
}

.item-image {
    width: 50px;
    height: 50px;
    border-radius: 8px;
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
    font-size: 0.9rem;
    color: #1f2937;
    margin-bottom: 0.25rem;
    line-height: 1.3;
}

.item-quantity {
    color: #6b7280;
    font-size: 0.8rem;
}

.item-price {
    font-weight: 600;
    color: #1594ce;
    font-size: 0.9rem;
    text-align: right;
    flex-shrink: 0;
}

.summary-divider {
    height: 1px;
    background: #e5e7eb;
    margin: 1.5rem 0;
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

.submit-btn {
    width: 100%;
    background: linear-gradient(135deg, #1594ce, #0675a9);
    color: white;
    border: none;
    padding: 1rem;
    border-radius: 8px;
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    margin-top: 1.5rem;
}

.submit-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(21, 148, 206, 0.3);
}

.submit-btn:disabled {
    background: #9ca3af;
    cursor: not-allowed;
    transform: none;
    box-shadow: none;
}

/* Loading State */
.loading {
    opacity: 0.6;
    pointer-events: none;
}

/* Responsive */
@media (max-width: 1024px) {
    .checkout-layout {
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }
    
    .order-summary {
        position: static;
    }
}

@media (max-width: 768px) {
    .page-title {
        font-size: 1.75rem;
    }
    
    .order-item {
        gap: 0.75rem;
    }
    
    .item-image {
        width: 45px;
        height: 45px;
    }
}

@media (max-width: 480px) {
    .container {
        padding: 0 0.5rem;
    }
    
    .checkout-form,
    .order-summary {
        border-radius: 8px;
    }
}
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="page-header">
    <div class="container">
        <h1 class="page-title">Checkout</h1>
        <p class="page-subtitle">Selesaikan pesanan Anda</p>
    </div>
</div>

<div class="container">
    <div class="checkout-layout">
        <!-- Checkout Form -->
        <div class="checkout-form">
            <div class="form-header">
                <h3 class="form-title">Alamat Pengiriman</h3>
                <p class="form-subtitle">Pastikan alamat pengiriman sudah benar</p>
            </div>
            
            <div class="form-content">
                <form id="checkout-form">
                    <div class="form-group">
                        <label for="nama" class="form-label">Nama Lengkap</label>
                        <input type="text" id="nama" name="nama" class="form-input" 
                               value="<?= $customer['username'] ?>" required>
                        <div class="error-message" id="nama-error"></div>
                    </div>
                    
                    <div class="form-group">
                        <label for="alamat" class="form-label">Alamat Lengkap</label>
                        <input type="text" id="alamat" name="alamat" class="form-input" 
                               placeholder="Masukkan alamat lengkap Anda" required>
                        <div class="error-message" id="alamat-error"></div>
                    </div>
                    
                    <div class="form-group">
                        <label for="no_hp" class="form-label">Nomor HP</label>
                        <input type="tel" id="no_hp" name="no_hp" class="form-input" 
                               value="<?= $customer['no_hp'] ?>" required>
                        <div class="error-message" id="no_hp-error"></div>
                    </div>
                    
                    <div class="form-group">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" name="email" class="form-input" 
                               value="<?= $customer['email'] ?>" required>
                        <div class="error-message" id="email-error"></div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Order Summary -->
        <div class="order-summary">
            <div class="summary-header">
                <h3 class="summary-title">Ringkasan Pesanan</h3>
            </div>
            
            <div class="summary-content">
                <div class="order-items">
                    <?php foreach ($keranjang as $item): ?>
                        <div class="order-item">
                            <img src="<?= base_url('uploads/produk/' . $item['foto']) ?>" 
                                 alt="<?= $item['nama'] ?>" class="item-image">
                            
                            <div class="item-details">
                                <div class="item-name"><?= $item['nama'] ?></div>
                                <div class="item-quantity"><?= $item['jumlah'] ?> x Rp <?= number_format($item['harga'], 0, ',', '.') ?></div>
                            </div>
                            
                            <div class="item-price">
                                Rp <?= number_format($item['harga'] * $item['jumlah'], 0, ',', '.') ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                
                <div class="summary-divider"></div>
                
                <div class="summary-row">
                    <span class="summary-label">Subtotal Produk</span>
                    <span class="summary-value">Rp <?= number_format($total_harga, 0, ',', '.') ?></span>
                </div>
                
                <div class="summary-row">
                    <span class="summary-label">Ongkos Kirim</span>
                    <span class="summary-value" style="color: #10b981;">GRATIS</span>
                </div>
                
                <div class="total-row">
                    <span class="total-label">Total Pembayaran</span>
                    <span class="total-amount">Rp <?= number_format($total_harga, 0, ',', '.') ?></span>
                </div>
                
                <button type="submit" class="submit-btn" id="submit-btn" form="checkout-form">
                    <i class="fas fa-shopping-bag"></i>
                    Buat Pesanan
                </button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('checkout-form');
    const submitBtn = document.getElementById('submit-btn');
    
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Clear previous errors
        clearErrors();
        
        // Show loading state
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memproses...';
        
        // Get form data
        const formData = new FormData(form);
        
        // Submit form
        fetch('<?= base_url('checkout/process') ?>', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                Swal.fire({
                    title: 'Pesanan Berhasil!',
                    text: `Pesanan dengan ID ${data.order_id} telah dibuat. Terima kasih!`,
                    icon: 'success',
                    confirmButtonColor: '#1594ce'
                }).then(() => {
                    window.location.href = '<?= base_url('/') ?>';
                });
            } else {
                if (data.errors) {
                    showErrors(data.errors);
                }
                Swal.fire({
                    title: 'Gagal!',
                    text: data.message || 'Terjadi kesalahan saat memproses pesanan',
                    icon: 'error',
                    confirmButtonColor: '#ef4444'
                });
            }
        })
        .catch(error => {
            console.error('Error:', error);
            Swal.fire({
                title: 'Terjadi Kesalahan!',
                text: 'Silakan coba lagi nanti',
                icon: 'error',
                confirmButtonColor: '#ef4444'
            });
        })
        .finally(() => {
            // Reset button state
            submitBtn.disabled = false;
            submitBtn.innerHTML = '<i class="fas fa-shopping-bag"></i> Buat Pesanan';
        });
    });
    
    function clearErrors() {
        const errorElements = document.querySelectorAll('.error-message');
        const inputElements = document.querySelectorAll('.form-input');
        
        errorElements.forEach(el => el.textContent = '');
        inputElements.forEach(el => el.classList.remove('error'));
    }
    
    function showErrors(errors) {
        Object.keys(errors).forEach(field => {
            const errorElement = document.getElementById(field + '-error');
            const inputElement = document.getElementById(field);
            
            if (errorElement && inputElement) {
                errorElement.textContent = errors[field];
                inputElement.classList.add('error');
            }
        });
    }
});
</script>
<?= $this->endSection() ?>