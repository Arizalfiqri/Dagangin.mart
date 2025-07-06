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

/* Header Section */
.page-header {
    background: linear-gradient(135deg, #1594ce 0%, #0675a9 100%);
    padding: 2rem 0;
    margin-bottom: 1.5rem;
}

.page-title {
    font-size: 2rem;
    font-weight: 700;
    color: #ffffff;
    margin-bottom: 0.25rem;
}

.page-subtitle {
    font-size: 1rem;
    color: rgba(255, 255, 255, 0.9);
    font-weight: 400;
}

/* Filter Bar */
.filter-bar {
    background: white;
    padding: 1rem;
    border-radius: 12px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    margin-bottom: 1.5rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 1rem;
    border: 1px solid #e2e8f0;
}

.filter-left {
    display: flex;
    align-items: center;
    gap: 1rem;
    flex-wrap: wrap;
}

.search-box {
    position: relative;
    min-width: 280px;
}

.search-input {
    border: 1px solid #d1d5db;
    border-radius: 8px;
    padding: 0.5rem 2.5rem 0.5rem 2rem;
    font-size: 0.9rem;
    width: 100%;
    background: #f9fafb;
    transition: border-color 0.2s ease;
}

.search-input:focus {
    outline: none;
    border-color: #1594ce;
    background: white;
}

.search-icon {
    position: absolute;
    left: 0.75rem;
    top: 50%;
    transform: translateY(-50%);
    color: #6b7280;
    font-size: 0.9rem;
    cursor: pointer;
}

.clear-search {
    position: absolute;
    right: 0.75rem;
    top: 50%;
    transform: translateY(-50%);
    color: #9ca3af;
    font-size: 0.9rem;
    cursor: pointer;
    background: none;
    border: none;
    display: none;
}

.clear-search:hover {
    color: #ef4444;
}

.filter-dropdown select {
    background: #f9fafb;
    border: 1px solid #d1d5db;
    border-radius: 8px;
    padding: 0.5rem 0.75rem;
    font-size: 0.9rem;
    color: #374151;
    cursor: pointer;
    transition: border-color 0.2s ease;
    min-width: 120px;
}

.filter-dropdown select:focus {
    outline: none;
    border-color: #1594ce;
}

.reset-filters {
    background: #ef4444;
    color: white;
    border: none;
    border-radius: 8px;
    padding: 0.5rem 1rem;
    font-size: 0.85rem;
    font-weight: 500;
    cursor: pointer;
    transition: background-color 0.2s ease;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.reset-filters:hover {
    background: #dc2626;
}

.results-info {
    font-size: 0.9rem;
    color: #6b7280;
    margin-bottom: 1rem;
}

/* Product Grid */
.products-container {
    display: grid;
    grid-template-columns: repeat(6, 1fr);
    gap: 1rem;
    margin-bottom: 2rem;
}

.product-card {
    background: white;
    border-radius: 12px;
    overflow: hidden;
    transition: box-shadow 0.2s ease;
    border: 1px solid #e5e7eb;
    position: relative;
    transition: all 0.3s ease;
    cursor: pointer;
}


.product-image-container {
    position: relative;
    background: #f3f4f6;
    aspect-ratio: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
}

.product-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.product-badge {
    position: absolute;
    top: 8px;
    left: 8px;
    color: white;
    padding: 0.25rem 0.5rem;
    border-radius: 6px;
    font-size: 0.7rem;
    font-weight: 600;
    text-transform: uppercase;
}

.product-badge.available {
    background: #10b981;
}

.product-badge.out-of-stock {
    background: #ef4444;
}

.product-info {
    padding: 1rem;
}

.product-category {
    font-size: 0.7rem;
    color: #1594ce;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.025em;
    margin-bottom: 0.25rem;
}

.product-name {
    font-size: 0.85rem;
    font-weight: 600;
    color: #1f2937;
    margin-bottom: 0.5rem;
    line-height: 1.3;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    min-height: 2.2rem;
}

.product-description {
    font-size: 0.75rem;
    color: #6b7280;
    margin-bottom: 0.75rem;
    line-height: 1.4;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    min-height: 2.1rem;
}

.product-stock {
    display: flex;
    align-items: center;
    gap: 0.25rem;
    margin-bottom: 0.75rem;
    font-size: 0.7rem;
    font-weight: 500;
}

.stock-indicator {
    width: 6px;
    height: 6px;
    border-radius: 50%;
}

.stock-indicator.available {
    background: #10b981;
}

.stock-indicator.low {
    background: #f59e0b;
}

.stock-indicator.out {
    background: #ef4444;
}

.stock-text {
    color: #6b7280;
}

.product-price {
    font-size: 1rem;
    font-weight: 700;
    color: #1594ce;
    margin-bottom: 0.75rem;
}

.product-actions {
    display: flex;
    gap: 0.5rem;
}

.btn {
    border: none;
    border-radius: 8px;
    padding: 0.5rem;
    font-size: 0.8rem;
    font-weight: 500;
    cursor: pointer;
    transition: background-color 0.2s ease;
    text-align: center;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.25rem;
}

.btn-primary {
    background: #1594ce;
    color: white;
    flex: 1;
}

.btn-primary:hover {
    background: #0675a9;
}

.btn-primary:disabled {
    background: #9ca3af;
    cursor: not-allowed;
}

.btn-outline {
    background: transparent;
    border: 1px solid #d1d5db;
    color: #6b7280;
    width: 36px;
    height: 36px;
}

.btn-outline:hover {
    background: #f3f4f6;
    border-color: #1594ce;
    color: #1594ce;
}

/* Empty State */
.empty-state {
    text-align: center;
    padding: 3rem 2rem;
    color: #6b7280;
    grid-column: 1 / -1;
}

.empty-state i {
    font-size: 3rem;
    margin-bottom: 1rem;
    color: #d1d5db;
}

.empty-state h3 {
    font-size: 1.25rem;
    margin-bottom: 0.5rem;
    color: #374151;
    font-weight: 600;
}

/* Enhanced Cart Counter Animation */
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
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    transition: all 0.2s cubic-bezier(0.68, -0.55, 0.265, 1.55);
    border: 2px solid #ffffff;
    box-shadow: 0 2px 8px rgba(255, 68, 68, 0.3);
    min-width: 20px;
}

.cart-count:empty {
    display: none;
}

/* Cart link hover effect */
.cart-link {
    position: relative;
    transition: transform 0.2s ease;
}

.cart-link:hover {
    transform: scale(1.1);
}

.cart-link:hover .cart-count {
    transform: scale(1.2);
    box-shadow: 0 4px 12px rgba(255, 68, 68, 0.4);
}

/* Button loading state improvements */
.btn-primary:disabled {
    background: #9ca3af !important;
    cursor: not-allowed;
    opacity: 0.7;
}

.btn-primary .fa-spinner {
    animation: spin 1s linear infinite;
}

@keyframes spin {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}

/* Smooth button transitions */
.btn-primary {
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.btn-primary::before {
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

.btn-primary:active::before {
    width: 200px;
    height: 200px;
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

.product-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
}

.product-card:hover .product-image {
    transform: scale(1.05);
    transition: transform 0.3s ease;
}

/* Wishlist heart animation */
.btn-outline .fa-heart {
    transition: all 0.3s ease;
}

.btn-outline:hover .fa-heart {
    transform: scale(1.2);
}

/* Loading spinner for wishlist */
.fa-spinner.fa-spin {
    color: #1594ce !important;
}

/* Responsive */
@media (max-width: 1200px) {
    .products-container {
        grid-template-columns: repeat(4, 1fr);
    }
}

@media (max-width: 768px) {

    .cart-count {
        width: 18px;
        height: 18px;
        font-size: 10px;
        top: -6px;
        right: -6px;
    }
    
    .custom-toast {
        right: 10px;
        left: 10px;
        max-width: none;
    }
    .page-title {
        font-size: 1.75rem;
    }

    .filter-bar {
        flex-direction: column;
        align-items: stretch;
        gap: 1rem;
    }

    .filter-left {
        flex-direction: column;
        gap: 0.75rem;
    }

    .search-box {
        min-width: auto;
        width: 100%;
    }

    .products-container {
        grid-template-columns: repeat(3, 1fr);
    }
}

@media (max-width: 480px) {
    .products-container {
        grid-template-columns: repeat(2, 1fr);
    }
    
    .filter-dropdown select {
        min-width: 100px;
        font-size: 0.8rem;
    }
}
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="page-header">
    <div class="container">
        <h1 class="page-title">Semua Produk</h1>
        <p class="page-subtitle">Temukan berbagai produk berkualitas dengan harga terbaik</p>
    </div>
</div>

<div class="container">
    <!-- Filter Bar -->
    <form method="GET" action="<?= base_url('/product') ?>" id="filterForm">
        <div class="filter-bar">
            <div class="filter-left">
                <div class="search-box">
                    <input type="text" name="search" class="search-input" 
                        placeholder="Cari produk..." value="<?= esc($search ?? '') ?>" id="searchInput">
                    <i class="fas fa-search search-icon" onclick="submitSearch()"></i>
                    <button type="button" class="clear-search" onclick="clearSearch()" id="clearBtn">
                        <i class="fas fa-times"></i>
                    </button>
                </div>

                <div class="filter-dropdown">
                    <select name="kategori" onchange="submitFilter()">
                        <option value="">Semua Kategori</option>
                        <?php foreach ($kategori as $kat): ?>
                            <option value="<?= $kat['id'] ?>"
                                    <?= $selected_kategori == $kat['id'] ? 'selected' : '' ?>>
                                <?= esc($kat['nama']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="filter-dropdown">
                    <select name="sort" onchange="submitFilter()">
                        <option value="">Urutkan</option>
                        <option value="newest" <?= $selected_sort == 'newest' ? 'selected' : '' ?>>Terbaru</option>
                        <option value="price_low" <?= $selected_sort == 'price_low' ? 'selected' : '' ?>>Harga Terendah</option>
                        <option value="price_high" <?= $selected_sort == 'price_high' ? 'selected' : '' ?>>Harga Tertinggi</option>
                        <option value="name_asc" <?= $selected_sort == 'name_asc' ? 'selected' : '' ?>>Nama A-Z</option>
                        <option value="name_desc" <?= $selected_sort == 'name_desc' ? 'selected' : '' ?>>Nama Z-A</option>
                    </select>
                </div>

                <button type="button" class="reset-filters" onclick="resetFilters()" id="resetBtn">
                    <i class="fas fa-undo"></i>
                    Reset
                </button>
            </div>
        </div>
    </form>

    <!-- Results Info -->
    <div class="results-info">
        Menampilkan <?= count($produk) ?> produk
        <?php if ($search): ?>
            untuk pencarian "<?= esc($search) ?>"
        <?php endif; ?>
        <?php if ($selected_kategori): ?>
            <?php 
            $kategori_name = '';
            foreach ($kategori as $kat) {
                if ($kat['id'] == $selected_kategori) {
                    $kategori_name = $kat['nama'];
                    break;
                }
            }
            ?>
            dalam kategori "<?= esc($kategori_name) ?>"
        <?php endif; ?>
    </div>

    <!-- Products Grid -->
    <div class="products-container" id="productsContainer">
        <?php if (empty($produk)): ?>
            <div class="empty-state">
                <i class="fas fa-box-open"></i>
                <h3>Tidak Ada Produk</h3>
                <p>Maaf, tidak ada produk yang sesuai dengan pencarian Anda.</p>
            </div>
        <?php else: ?>
            <?php foreach ($produk as $product): ?>
            <div class="product-card" onclick="goToProductDetail(<?= $product['id'] ?>)" style="cursor: pointer;">
                <div class="product-image-container">
                    <?php 
                    $stock_status = '';
                    if ($product['stok'] > 0) {
                        $stock_status = 'available';
                        $stock_text = 'Tersedia';
                    } else {
                        $stock_status = 'out-of-stock';
                        $stock_text = 'Habis';
                    }
                    ?>
                    <div class="product-badge <?= $stock_status ?>">
                        <?= $stock_text ?>
                    </div>
                    
                    <?php if ($product['foto'] && file_exists(ROOTPATH . 'public/uploads/produk/' . $product['foto'])): ?>
                        <img src="<?= base_url('uploads/produk/' . $product['foto']) ?>"
                            alt="<?= esc($product['nama']) ?>" class="product-image">
                    <?php else: ?>
                        <div style="width: 100%; height: 100%; background: #e5e7eb; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-image" style="font-size: 2rem; color: #9ca3af;"></i>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="product-info">
                    <div class="product-category"><?= esc($product['nama_kategori'] ?? 'Tanpa Kategori') ?></div>
                    <h3 class="product-name"><?= esc($product['nama']) ?></h3>
                    

                    <div class="product-stock">
                        <?php 
                        $indicator_class = 'available';
                        $stock_display = $product['stok'] . ' stok';
                        
                        if ($product['stok'] == 0) {
                            $indicator_class = 'out';
                            $stock_display = 'Habis';
                        } elseif ($product['stok'] <= 10) {
                            $indicator_class = 'low';
                            $stock_display = $product['stok'] . ' stok';
                        }
                        ?>
                        <div class="stock-indicator <?= $indicator_class ?>"></div>
                        <span class="stock-text"><?= $stock_display ?></span>
                    </div>

                    <div class="product-price">Rp <?= number_format($product['harga'], 0, ',', '.') ?></div>

                    <div class="product-actions">
                        <?php if ($product['stok'] > 0): ?>
                            <button class="btn btn-primary" onclick="addToCart(<?= $product['id'] ?>)">
                                <i class="fas fa-cart-plus"></i>
                                Keranjang
                            </button>
                        <?php else: ?>
                            <button class="btn btn-primary" disabled>
                                <i class="fas fa-times"></i>
                                Habis
                            </button>
                        <?php endif; ?>
                        <button class="btn btn-outline" onclick="toggleWishlist(<?= $product['id'] ?>)" title="Wishlist">
                            <i class="fas fa-heart"></i>
                        </button>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<script>
// Filter form submission
function submitFilter() {
    document.getElementById('filterForm').submit();
}

// Search functionality
function submitSearch() {
    document.getElementById('filterForm').submit();
}

// Clear search
function clearSearch() {
    const searchInput = document.getElementById('searchInput');
    searchInput.value = '';
    searchInput.focus();
    document.getElementById('filterForm').submit();
}

// Reset all filters
function resetFilters() {
    document.getElementById('searchInput').value = '';
    document.querySelector('select[name="kategori"]').value = '';
    document.querySelector('select[name="sort"]').value = '';
    document.getElementById('filterForm').submit();
}

// Search input handling
const searchInput = document.getElementById('searchInput');
const clearBtn = document.getElementById('clearBtn');

function toggleClearButton() {
    if (searchInput.value.length > 0) {
        clearBtn.style.display = 'block';
    } else {
        clearBtn.style.display = 'none';
    }
}

toggleClearButton();

searchInput.addEventListener('input', function() {
    toggleClearButton();
});

// Auto-search with delay
let searchTimeout;
searchInput.addEventListener('input', function(e) {
    clearTimeout(searchTimeout);
    searchTimeout = setTimeout(() => {
        document.getElementById('filterForm').submit();
    }, 800);
});

// Enter key submission
searchInput.addEventListener('keypress', function(e) {
    if (e.key === 'Enter') {
        e.preventDefault();
        clearTimeout(searchTimeout);
        document.getElementById('filterForm').submit();
    }
});

// Check active filters
function checkActiveFilters() {
    const hasSearch = document.getElementById('searchInput').value.length > 0;
    const hasCategory = document.querySelector('select[name="kategori"]').value !== '';
    const hasSort = document.querySelector('select[name="sort"]').value !== '';
    
    const resetBtn = document.getElementById('resetBtn');
    if (hasSearch || hasCategory || hasSort) {
        resetBtn.style.display = 'flex';
    } else {
        resetBtn.style.display = 'none';
    }
}


// Enhanced Cart Animation and Counter Update
let cartCount = 0;

// Initialize cart count on page load
document.addEventListener('DOMContentLoaded', function() {
    updateCartCount();
});

// Optimized cart counter update
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
        cartCount = data.count || 0;
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

function addToCart(produkId, jumlah = 1) {
    const button = event.target.closest('.btn-primary');
    const productCard = button.closest('.product-card');
    
    // Disable button temporarily
    button.disabled = true;
    const originalContent = button.innerHTML;
    button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menambah...';
    
    fetch('<?= base_url('keranjang/add') ?>', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `produk_id=${produkId}&jumlah=${jumlah}`
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            // Only create flying animation if successfully added to cart
            const productImage = productCard.querySelector('.product-image') || productCard.querySelector('.product-image-container');
            const flyingElement = createFlyingElement(productImage);
            startFlyingAnimation(flyingElement);
            
            // Update button state
            button.innerHTML = '<i class="fas fa-check"></i> Ditambah!';
            button.style.background = '#10b981';
            
            // Show success message (non-blocking)
            showToast('Produk berhasil ditambahkan ke keranjang!', 'success');
            
            // Update cart count after animation
            setTimeout(() => {
                updateCartCount();
            }, 800);
            
        } else if (data.status === 'error' && data.redirect) {
            // Handle login required - redirect to login page
            showToast('Silakan login terlebih dahulu', 'error');
            setTimeout(() => {
                window.location.href = data.redirect;
            }, 1500);
        } else {
            // Handle other errors
            showToast(data.message || 'Gagal menambahkan produk', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showToast('Terjadi kesalahan, coba lagi', 'error');
    })
    .finally(() => {
        // Reset button after delay
        setTimeout(() => {
            button.disabled = false;
            button.innerHTML = originalContent;
            button.style.background = '';
        }, 2000);
    });
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
    const cartIcon = document.querySelector('.cart-link') || document.querySelector('a[href*="keranjang"]');
    
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
        right: '150px',
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

// Enhanced wishlist toggle
function toggleWishlist(productId) {
    const button = event.target.closest('.btn-outline');
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

checkActiveFilters();

// Navigate to product detail
function goToProductDetail(productId) {
    // Encode ID dengan base64 URL-safe (ganti + dan / dengan - dan _, hapus =)
    const encodedId = btoa(productId).replace(/\+/g, '-').replace(/\//g, '_').replace(/=/g, '');
    window.location.href = '<?= base_url('product/') ?>' + encodedId;
}

// Prevent card click when clicking buttons
document.addEventListener('DOMContentLoaded', function() {
    // Stop propagation for action buttons
    document.querySelectorAll('.product-actions button').forEach(button => {
        button.addEventListener('click', function(e) {
            e.stopPropagation();
        });
    });
});
</script>
<?= $this->endSection() ?>