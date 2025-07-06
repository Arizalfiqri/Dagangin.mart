<?= $this->extend('layout/base_user') ?>

<?= $this->section('style') ?>
<style>
    .product-main-image {
        width: 100%;
        height: 400px;
        object-fit: cover;
        border-radius: 8px;
        border: 2px solid #e9ecef;
    }

    .product-thumbnail {
        width: 100%;
        height: 80px;
        object-fit: cover;
        border-radius: 6px;
        border: 2px solid #e9ecef;
        cursor: pointer;
        transition: border-color 0.3s ease;
    }

    .product-thumbnail:hover {
        border-color: #007bff;
    }

    .product-thumbnail.active {
        border-color: #007bff;
    }

    .quantity-btn {
        width: 40px;
        height: 40px;
        border: 1px solid #dee2e6;
        background: white;
        border-radius: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: background-color 0.3s ease;
    }

    .quantity-btn:hover {
        background-color: #f8f9fa;
    }

    .quantity-input {
        width: 70px;
        height: 40px;
        text-align: center;
        border: 1px solid #dee2e6;
        border-radius: 6px;
    }

    .quantity-input:focus {
        outline: none;
        border-color: #007bff;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }

    .action-btn {
        padding: 12px 24px;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s ease;
        border: none;
        position: relative;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    .action-btn::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        transform: translate(-50%, -50%);
        transition: width 0.6s, height 0.6s;
        pointer-events: none;
    }

    .action-btn:active::before {
        width: 200px;
        height: 200px;
    }

    .btn-add-cart {
        background-color: #1594ce;
        color: white;
    }

    .btn-add-cart:hover {
        background-color: #0675a9;
        color: white;
    }

    .btn-add-cart:disabled {
        background-color: #9ca3af !important;
        cursor: not-allowed;
        opacity: 0.7;
    }

    .btn-buy-now {
        background-color: #10b981;
        color: white;
    }

    .btn-buy-now:hover {
        background-color: #059669;
        color: white;
    }

    .btn-icon {
        width: 48px;
        height: 48px;
        border: 1px solid #dee2e6;
        background: white;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: background-color 0.3s ease;
    }

    .btn-icon:hover {
        background-color: #f8f9fa;
    }

    .price-display {
        font-size: 2rem;
        font-weight: bold;
        color: #1594ce;
    }

    .product-info-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 8px 0;
        border-bottom: 1px solid #f8f9fa;
    }

    .product-info-row:last-child {
        border-bottom: none;
    }

    .stock-available {
        color: #28a745;
    }

    .stock-unavailable {
        color: #dc3545;
    }

    .product-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        padding: 2rem;
        margin-bottom: 2rem;
    }

    /* Toast notification styles */
    .custom-toast {
        animation: slideInRight 0.3s ease;
    }

    @keyframes slideInRight {
        from {
            transform: translateX(100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }

    /* Button loading state */
    .btn-add-cart .fa-spinner {
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }

    @media (max-width: 768px) {
        .product-main-image {
            height: 300px;
        }
        
        .price-display {
            font-size: 1.5rem;
        }
        
        .action-btn {
            padding: 10px 16px;
            font-size: 14px;
        }

        .custom-toast {
            right: 10px;
            left: 10px;
            max-width: none;
        }
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-12 col-xl-10">
            <!-- Product Detail Section -->
            <div class="product-card">
                <div class="row">
                    <!-- Product Images -->
                    <div class="col-12 col-lg-6 mb-4 mb-lg-0">
                        <!-- Main Image -->
                        <div class="mb-3">
                            <img id="mainImage" 
                                src="<?= base_url('uploads/produk/' . $produk['foto']) ?>" 
                                alt="<?= esc($produk['nama']) ?>"
                                class="product-main-image">
                        </div>
                        
                        <!-- Thumbnail Images -->
                        <div class="row g-2">
                            <?php for($i = 1; $i <= 4; $i++): ?>
                            <div class="col-3">
                                <img src="<?= base_url('uploads/produk/' . $produk['foto']) ?>" 
                                    alt="<?= esc($produk['nama']) ?> - Gambar <?= $i ?>"
                                    class="product-thumbnail <?= $i === 1 ? 'active' : '' ?>"
                                    onclick="changeMainImage(this)">
                            </div>
                            <?php endfor; ?>
                        </div>
                    </div>
                    
                    <!-- Product Info -->
                    <div class="col-12 col-lg-6">
                        <h1 class="h2 fw-bold text-dark mb-4"><?= esc($produk['nama']) ?></h1>
                        
                        <!-- Product Description -->
                        <div class="mb-4">
                            <p class="text-muted lh-base"><?= esc($produk['detail']) ?></p>
                        </div>
                        
                        <!-- Price -->
                        <div class="mb-4">
                            <span class="price-display">Rp. <?= number_format($produk['harga'], 0, ',', '.') ?></span>
                        </div>
                        
                        <!-- Quantity Selector -->
                        <div class="mb-4">
                            <div class="d-flex align-items-center gap-3">
                                <button type="button" class="quantity-btn" onclick="decreaseQuantity()">
                                    <i class="fas fa-minus"></i>
                                </button>
                                
                                <input type="number" 
                                      id="quantity" 
                                      value="1" 
                                      min="1" 
                                      max="<?= $produk['stok'] ?>"
                                      class="quantity-input"
                                      onchange="validateQuantity()">
                                
                                <button type="button" class="quantity-btn" onclick="increaseQuantity()">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                            <small class="text-muted mt-1 d-block">Stok tersedia: <?= $produk['stok'] ?></small>
                        </div>
                        
                        <!-- Action Buttons -->
                        <div class="row g-2 mb-4">
                            <!-- Heart/Like Button -->
                            <div class="col-auto">
                                <button type="button" class="btn btn-icon" onclick="toggleWishlist(<?= $produk['id'] ?>)" title="Wishlist">
                                    <i class="fas fa-heart text-danger"></i>
                                </button>
                            </div>
                            
                            <!-- Bookmark Button -->
                            <div class="col-auto">
                                <button type="button" class="btn btn-icon">
                                    <i class="fas fa-bookmark text-muted"></i>
                                </button>
                            </div>
                            
                            <!-- Add to Cart Button -->
                            <div class="col">
                                <button id="addToCartBtn" type="button" class="btn btn-add-cart action-btn w-100" onclick="addToCart()">
                                    <i class="fas fa-cart-plus"></i>
                                    <span class="btn-text">Keranjang</span>
                                </button>
                            </div>
                            
                            <!-- Buy Now Button -->
                            <div class="col">
                                <button type="button" class="btn btn-buy-now action-btn w-100" onclick="buyNow()">
                                    <i class="fas fa-shopping-bag"></i>
                                    <span>Beli Sekarang</span>
                                </button>
                            </div>
                        </div>
                        
                        <!-- Product Info -->
                        <div class="border-top pt-3">
                            <div class="product-info-row">
                                <span class="text-muted">Kategori:</span>
                                <span class="fw-medium">
                                    <?= isset($kategori) ? esc($kategori['nama']) : 'Tidak ada kategori' ?>
                                </span>
                            </div>
                            <div class="product-info-row">
                                <span class="text-muted">Ketersediaan:</span>
                                <span class="fw-medium <?= $produk['ketersediaan_stok'] ? 'stock-available' : 'stock-unavailable' ?>">
                                    <?= $produk['ketersediaan_stok'] ? 'Tersedia' : 'Tidak Tersedia' ?>
                                </span>
                            </div>
                            <div class="product-info-row">
                                <span class="text-muted">Stok:</span>
                                <span class="fw-medium"><?= $produk['stok'] ?> unit</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recommended Products Section -->
            <?php if (!empty($rekomendasi)): ?>
            <div class="product-card">
                <h3 class="h4 fw-bold mb-4">Produk Rekomendasi</h3>
                <div class="row g-3">
                    <?php foreach($rekomendasi as $item): ?>
                    <div class="col-6 col-md-4 col-lg-3">
                        <div class="card h-100 border-0 shadow-sm">
                            <img src="<?= base_url('uploads/produk/' . $item['foto']) ?>" 
                                 class="card-img-top" 
                                 alt="<?= esc($item['nama']) ?>"
                                 style="height: 150px; object-fit: cover;">
                            <div class="card-body p-3">
                                <h6 class="card-title mb-2"><?= esc($item['nama']) ?></h6>
                                <p class="text-primary fw-bold mb-2">Rp. <?= number_format($item['harga'], 0, ',', '.') ?></p>
                                <a href="<?= base_url('product/' . base64_encode($item['id'])) ?>" 
                                   class="btn btn-outline-primary btn-sm w-100">
                                    Lihat Detail
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
// Image Gallery Functions
function changeMainImage(thumbnail) {
    document.getElementById('mainImage').src = thumbnail.src;
    
    // Remove active class from all thumbnails
    document.querySelectorAll('.product-thumbnail').forEach(thumb => {
        thumb.classList.remove('active');
    });
    
    // Add active class to clicked thumbnail
    thumbnail.classList.add('active');
}

// Quantity Functions
function increaseQuantity() {
    const quantityInput = document.getElementById('quantity');
    const currentValue = parseInt(quantityInput.value);
    const maxStock = parseInt(quantityInput.getAttribute('max'));
    
    if (currentValue < maxStock) {
        quantityInput.value = currentValue + 1;
    }
}

function decreaseQuantity() {
    const quantityInput = document.getElementById('quantity');
    const currentValue = parseInt(quantityInput.value);
    
    if (currentValue > 1) {
        quantityInput.value = currentValue - 1;
    }
}

function validateQuantity() {
    const quantityInput = document.getElementById('quantity');
    const currentValue = parseInt(quantityInput.value);
    const maxStock = parseInt(quantityInput.getAttribute('max'));
    
    if (currentValue < 1) {
        quantityInput.value = 1;
    } else if (currentValue > maxStock) {
        quantityInput.value = maxStock;
        showToast('Jumlah melebihi stok yang tersedia!', 'error');
    }
}

// Create flying element for animation
function createFlyingElement(sourceElement) {
    const rect = sourceElement.getBoundingClientRect();
    const flyingEl = document.createElement('div');
    
    // Copy image or create placeholder
    if (sourceElement.tagName === 'IMG') {
        flyingEl.innerHTML = `<img src="${sourceElement.src}" style="width: 100%; height: 100%; object-fit: cover; border-radius: 8px;">`;
    } else {
        flyingEl.innerHTML = '<i class="fas fa-shopping-bag" style="font-size: 30px; color: #1594ce;"></i>';
    }
    
    // Style the flying element
    Object.assign(flyingEl.style, {
        position: 'fixed',
        left: rect.left + 'px',
        top: rect.top + 'px',
        width: '50px',
        height: '50px',
        backgroundColor: 'white',
        border: '2px solid #1594ce',
        borderRadius: '12px',
        zIndex: '9999',
        pointerEvents: 'none',
        boxShadow: '0 4px 12px rgba(0,0,0,0.3)',
        display: 'flex',
        alignItems: 'center',
        justifyContent: 'center',
        transition: 'all 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94)',
        transform: 'scale(1)'
    });
    
    document.body.appendChild(flyingEl);
    return flyingEl;
}

// Start the flying animation
function startFlyingAnimation(flyingElement) {
    const cartIcon = document.querySelector('.cart-link') || document.querySelector('a[href*="keranjang"]') || document.querySelector('[id*="cart"]');
    
    if (!cartIcon) {
        // Remove element if cart not found
        setTimeout(() => flyingElement.remove(), 100);
        return;
    }
    
    const cartRect = cartIcon.getBoundingClientRect();
    
    // Animate to cart position
    setTimeout(() => {
        Object.assign(flyingElement.style, {
            left: (cartRect.left + cartRect.width/2 - 25) + 'px',
            top: (cartRect.top + cartRect.height/2 - 25) + 'px',
            transform: 'scale(0.3)',
            opacity: '0.8'
        });
    }, 10);
    
    // Remove element after animation
    setTimeout(() => {
        if (flyingElement.parentNode) {
            flyingElement.remove();
        }
    }, 900);
}

// Lightweight toast notification
function showToast(message, type = 'info') {
    // Remove existing toast
    const existingToast = document.querySelector('.custom-toast');
    if (existingToast) {
        existingToast.remove();
    }
    
    const toast = document.createElement('div');
    toast.className = 'custom-toast';
    toast.textContent = message;
    
    const colors = {
        success: '#10b981',
        error: '#ef4444',
        info: '#1594ce'
    };
    
    Object.assign(toast.style, {
        position: 'fixed',
        top: '40px',
        right: '20px',
        backgroundColor: colors[type] || colors.info,
        color: 'white',
        padding: '12px 20px',
        borderRadius: '8px',
        fontSize: '14px',
        fontWeight: '500',
        zIndex: '10000',
        boxShadow: '0 4px 12px rgba(0,0,0,0.15)',
        transform: 'translateX(100%)',
        transition: 'transform 0.3s ease',
        maxWidth: '300px',
        wordWrap: 'break-word'
    });
    
    document.body.appendChild(toast);
    
    // Slide in
    setTimeout(() => {
        toast.style.transform = 'translateX(0)';
    }, 10);
    
    // Auto remove
    setTimeout(() => {
        toast.style.transform = 'translateX(100%)';
        setTimeout(() => {
            if (toast.parentNode) {
                toast.remove();
            }
        }, 300);
    }, 3000);
}

// Update cart count
function updateCartCount() {
    const cartCountElement = document.getElementById('cart-count');
    if (!cartCountElement) return;
    
    fetch('<?= base_url('keranjang/count') ?>', {
        method: 'GET',
        headers: {
            'Cache-Control': 'no-cache'
        }
    })
    .then(response => response.json())
    .then(data => {
        const cartCount = data.count || 0;
        cartCountElement.textContent = cartCount;
        
        // Add bounce animation when count changes
        cartCountElement.style.transform = 'scale(1.3)';
        setTimeout(() => {
            cartCountElement.style.transform = 'scale(1)';
        }, 200);
    })
    .catch(error => {
        console.log('Cart count update failed:', error);
    });
}

// Enhanced Cart Functions
function addToCart() {
    const quantity = document.getElementById('quantity').value;
    const productId = <?= $produk['id'] ?>;
    
    // Get button and show loading state
    const btn = document.getElementById('addToCartBtn');
    const btnText = btn.querySelector('.btn-text');
    const btnIcon = btn.querySelector('i');
    
    btn.disabled = true;
    btnIcon.className = 'fas fa-spinner fa-spin';
    btnText.textContent = 'Menambah...';
    
    // AJAX call to add to cart
    fetch('<?= base_url('keranjang/add') ?>', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `produk_id=${productId}&jumlah=${quantity}`
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            // Create flying animation from main product image
            const productImage = document.getElementById('mainImage');
            const flyingElement = createFlyingElement(productImage);
            startFlyingAnimation(flyingElement);
            
            // Update button to success state
            btnIcon.className = 'fas fa-check';
            btnText.textContent = 'Ditambah!';
            btn.style.backgroundColor = '#10b981';
            
            // Show success message
            showToast(`${quantity} produk berhasil ditambahkan ke keranjang!`, 'success');
            
            // Update cart count after animation
            setTimeout(() => {
                updateCartCount();
            }, 800);
            
        } else if (data.status === 'error' && data.redirect) {
            // Handle login required
            showToast('Silakan login terlebih dahulu', 'error');
            setTimeout(() => {
                window.location.href = data.redirect;
            }, 1500);
        } else {
            // Handle other errors
            showToast(data.message || 'Gagal menambahkan produk ke keranjang', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showToast('Terjadi kesalahan saat menambahkan ke keranjang', 'error');
    })
    .finally(() => {
        // Reset button after delay
        setTimeout(() => {
            btn.disabled = false;
            btnIcon.className = 'fas fa-cart-plus';
            btnText.textContent = 'Keranjang';
            btn.style.backgroundColor = '';
        }, 2000);
    });
}

function buyNow() {
    const quantity = document.getElementById('quantity').value;
    const productId = <?= $produk['id'] ?>;
    
    // Redirect to checkout page with product data
    window.location.href = '<?= base_url('checkout') ?>?product_id=' + productId + '&quantity=' + quantity;
}

// Enhanced wishlist toggle
function toggleWishlist(productId) {
    const button = event.target.closest('.btn-icon');
    const icon = button.querySelector('i');
    
    // Add loading state
    const originalIcon = icon.className;
    icon.className = 'fas fa-spinner fa-spin';
    
    setTimeout(() => {
        if (icon.style.color === 'rgb(239, 68, 68)') {
            icon.style.color = '';
            icon.className = 'far fa-heart';
            button.title = 'Tambah ke Wishlist';
            showToast('Dihapus dari wishlist', 'info');
        } else {
            icon.style.color = '#ef4444';
            icon.className = 'fas fa-heart';
            button.title = 'Hapus dari Wishlist';
            showToast('Ditambahkan ke wishlist', 'success');
        }
    }, 500);
}

// Check stock availability on page load
document.addEventListener('DOMContentLoaded', function() {
    const stock = <?= $produk['stok'] ?>;
    const isAvailable = <?= $produk['ketersediaan_stok'] ? 'true' : 'false' ?>;
    
    if (!isAvailable || stock <= 0) {
        const addToCartBtn = document.getElementById('addToCartBtn');
        const quantityInput = document.getElementById('quantity');
        const quantityBtns = document.querySelectorAll('.quantity-btn');
        
        // Disable add to cart button
        addToCartBtn.disabled = true;
        addToCartBtn.querySelector('.btn-text').textContent = 'Stok Habis';
        addToCartBtn.querySelector('i').className = 'fas fa-times';
        addToCartBtn.classList.remove('btn-add-cart');
        addToCartBtn.classList.add('btn-secondary');
        addToCartBtn.style.cursor = 'not-allowed';
        
        // Disable quantity controls
        quantityInput.disabled = true;
        quantityBtns.forEach(btn => {
            btn.disabled = true;
            btn.style.cursor = 'not-allowed';
            btn.style.opacity = '0.5';
        });
    }
    
    // Initialize cart count
    updateCartCount();
});
</script>

<?= $this->endSection() ?>