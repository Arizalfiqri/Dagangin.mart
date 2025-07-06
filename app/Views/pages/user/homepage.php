<?= $this->extend('layout/base_user') ?>

<?= $this->section('style') ?>
<style>
    /* Simple and clean styling */
    :root {
        --primary-blue: #007bb8;
        --filter-gray: #bfeaff;
        --border-radius: 5px;
    }

    body {
        background-color: #f8fafc;
        font-family: 'DM Sans', sans-serif;
    }

    /* Search Section */
    .search-section {
        background: white;
        padding: 1rem 0;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    .search-container {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        max-width: 1400px;
        margin: 0 auto;
        padding: 0 1rem;
        position: relative;
    }

    .search-input-wrapper {
        flex: 0 0 500px;
        position: relative;
    }

    .search-input {
        padding: 5px 14px 5px 40px;
        border: 1px solid #d1d5db;
        border-radius: 18px;
        font-size: 14px;
        outline: none;
        width: 100%;
    }

    .search-icon {
        position: absolute;
        right: 12px;
        top: 50%;
        transform: translateY(-50%);
        color: #6b7280;
        font-size: 14px;
        pointer-events: none;
        z-index: 2;
    }

    .search-input:focus {
        border-color: var(--primary-blue);
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    }

    /* Filter buttons container */
    .filter-buttons {
        display: flex;
        gap: 1rem;
        align-items: center;
    }

    .filter-select {
        padding: 5px 8px;
        border: 1px solid #d1d5db;
        border-radius: var(--border-radius);
        font-weight: 500;
        cursor: pointer;
        outline: none;
        appearance: none;
        background-position: right 10px center;
        background-repeat: no-repeat;
        background-size: 14px;
        padding-right: 32px;
        transition: all 0.2s ease;
        min-width: 100px;
        font-size: 14px;
    }

    .filter-select:hover {
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .kategori-btn {
        background-color: var(--primary-blue);
        color: white;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%23ffffff' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m6 8 4 4 4-4'/%3e%3c/svg%3e");
    }

    .filter-btn {
        background-color: var(--filter-gray);
        color: black;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%23000000' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m6 8 4 4 4-4'/%3e%3c/svg%3e");
    }

    /* Banner Section */
    .banner-section {
        margin-bottom: 2rem;
    }

    .carousel {
        border-radius: 0;
        overflow: hidden;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .carousel-inner img {
        height: 400px;
        object-fit: cover;
    }

    /* Product Grid */
    .products-section {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 1rem;
        margin-bottom: 3rem; /* Tambahkan margin bottom */
    }

    .products-grid {
        display: grid;
        grid-template-columns: repeat(6, 1fr);
        gap: 1.5rem; /* Perbesar gap */
    }

    .product-card {
        background: white;
        border-radius: var(--border-radius);
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        position: relative;
        height: 280px; /* Tinggi card diperbesar */
        display: flex;
        flex-direction: column;
    }

    .product-card:hover {
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    }

    .product-image {
        height: 160px; /* Perbesar tinggi gambar */
        background: linear-gradient(to bottom, #87ceeb 0%, #98fb98 100%);
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .product-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .no-image-placeholder {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        font-size: 18px;
        font-weight: 600;
    }

    .discount-badge {
        position: absolute;
        top: 10px;
        left: 10px;
        background: #dc2626;
        color: white;
        padding: 4px 8px;
        border-radius: 6px;
        font-size: 11px;
        font-weight: 600;
        z-index: 3;
    }

    .product-info {
        padding: 15px 12px;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
        justify-content: space-between;
    }

    .product-name {
        font-size: 14px;
        font-weight: 600;
        color: #374151;
        margin-bottom: 6px;
        line-height: 1.3;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .product-price {
        font-size: 15px;
        font-weight: 700;
        color: #dc2626;
        margin-top: auto;
    }

    .product-category {
        font-size: 10px;
        color: #9ca3af;
        background: #f3f4f6;
        padding: 2px 6px;
        border-radius: 12px;
        display: inline-block;
        margin-bottom: 6px;
    }

    .stock-badge {
        position: absolute;
        top: 10px;
        right: 10px;
        padding: 4px 8px;
        border-radius: 6px;
        font-size: 10px;
        font-weight: 600;
        z-index: 3;
    }

    .stock-available {
        background: #10b981;
        color: white;
    }

    .stock-low {
        background: #f59e0b;
        color: white;
    }

    .stock-empty {
        background: #ef4444;
        color: white;
    }

    /* Responsive */
    @media (max-width: 1024px) {
        .products-grid {
            grid-template-columns: repeat(4, 1fr);
        }

        .search-container {
            flex-direction: column;
            align-items: stretch;
        }

        .search-input-wrapper {
            flex: 1;
            width: 100%;
        }

        .filter-buttons {
            justify-content: center;
            margin-top: 1rem;
        }
    }

    @media (max-width: 768px) {
        .search-container {
            flex-direction: column;
            gap: 0.75rem;
        }

        .search-input-wrapper {
            width: 100%;
            flex: none;
        }

        .filter-buttons {
            width: 100%;
            justify-content: space-between;
        }

        .carousel-inner img {
            height: 280px;
        }

        .products-grid {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    @media (max-width: 480px) {
        .products-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .filter-buttons {
            flex-direction: column;
            gap: 0.5rem;
        }

        .filter-select {
            width: 100%;
        }
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- Search Section -->
<div class="search-section">
    <div class="search-container">
        <form method="GET" class="search-input-wrapper">
            <i class="fas fa-search search-icon"></i>
            <input type="text" class="search-input" name="search" value="<?= esc($search) ?>" placeholder="Apa yang lu cari gua ada">
            <input type="hidden" name="kategori" value="<?= esc($selected_kategori) ?>">
            <input type="hidden" name="sort" value="<?= esc($selected_sort) ?>">
        </form>

        <div class="filter-buttons">
            <form method="GET" id="kategori-form">
                <select class="filter-select kategori-btn" name="kategori" onchange="submitKategoriForm()">
                    <option value="">Semua Kategori</option>
                    <?php foreach ($kategori as $kat): ?>
                        <option value="<?= $kat['id'] ?>" <?= $selected_kategori == $kat['id'] ? 'selected' : '' ?>>
                            <?= esc($kat['nama']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <input type="hidden" name="search" value="<?= esc($search) ?>">
                <input type="hidden" name="sort" value="<?= esc($selected_sort) ?>">
            </form>

            <form method="GET" id="sort-form">
                <select class="filter-select filter-btn" name="sort" onchange="submitSortForm()">
                    <option value="">Urutkan</option>
                    <option value="price_low" <?= $selected_sort == 'price_low' ? 'selected' : '' ?>>Harga Terendah</option>
                    <option value="price_high" <?= $selected_sort == 'price_high' ? 'selected' : '' ?>>Harga Tertinggi</option>
                    <option value="name_asc" <?= $selected_sort == 'name_asc' ? 'selected' : '' ?>>Nama A-Z</option>
                    <option value="name_desc" <?= $selected_sort == 'name_desc' ? 'selected' : '' ?>>Nama Z-A</option>
                    <option value="newest" <?= $selected_sort == 'newest' ? 'selected' : '' ?>>Terbaru</option>
                </select>
                <input type="hidden" name="search" value="<?= esc($search) ?>">
                <input type="hidden" name="kategori" value="<?= esc($selected_kategori) ?>">
            </form>
        </div>
    </div>
</div>

<!-- Banner Section -->
<div class="banner-section">
    <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel" data-bs-interval="4000">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="<?= base_url('image/16.png') ?>" class="d-block w-100" alt="Promo Banner 1">
            </div>
            <div class="carousel-item">
                <img src="<?= base_url('image/17.png') ?>" class="d-block w-100" alt="Promo Banner 2">
            </div>
            <div class="carousel-item">
                <img src="<?= base_url('image/18.png') ?>" class="d-block w-100" alt="Promo Banner 3">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>

<!-- Products Section -->
<div class="products-section">
    <div class="products-grid">
        <?php if (!empty($produk)): ?>
            <?php foreach ($produk as $item): ?>
                <div class="product-card">
                    <div class="product-image">
                        <?php if (!empty($item['foto'])): ?>
                            <img src="<?= base_url('uploads/produk/' . $item['foto']) ?>" alt="<?= esc($item['nama']) ?>">
                        <?php else: ?>
                            <div class="no-image-placeholder">
                                <i class="fas fa-image"></i>
                            </div>
                        <?php endif; ?>
                        
                        <!-- Stock Badge -->
                        <?php 
                        $stockClass = 'stock-available';
                        $stockText = 'Tersedia';
                        if ($item['stok'] == 0) {
                            $stockClass = 'stock-empty';
                            $stockText = 'Habis';
                        } elseif ($item['stok'] <= 10) {
                            $stockClass = 'stock-low';
                            $stockText = 'Stok ' . $item['stok'];
                        }
                        ?>
                        <div class="stock-badge <?= $stockClass ?>">
                            <?= $stockText ?>
                        </div>
                    </div>

                    <div class="product-info">
                        <div class="product-category"><?= esc($item['nama_kategori']) ?></div>
                        <div class="product-name"><?= esc($item['nama']) ?></div>
                        
                        <div class="product-price">Rp <?= number_format($item['harga'], 0, ',', '.') ?></div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div style="grid-column: 1 / -1; text-align: center; padding: 2rem;">
                <p>Tidak ada produk yang ditemukan.</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<script>
function submitKategoriForm() {
    document.getElementById('kategori-form').submit();
}

function submitSortForm() {
    document.getElementById('sort-form').submit();
}

// Auto submit search form
document.querySelector('.search-input').addEventListener('keypress', function(e) {
    if (e.key === 'Enter') {
        this.closest('form').submit();
    }
});
</script>

<script>const baseUrl = '<?= base_url() ?>';</script>
<script src="<?= base_url('js/cart-counter.js') ?>"></script>
<?= $this->endSection() ?>