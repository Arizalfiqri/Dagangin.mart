<?= $this->extend('layout/base_admin') ?> 
<?= $this->section('content') ?>

<div class="page-header">
    <h2>Daftar Produk</h2>
    <p class="page-description">Kelola semua produk dalam sistem</p>
</div>

<div class="produk-container">
    <div class="produk-header">
        <form method="GET" class="search-form">
            <div class="search-box">
                <input type="text" name="search" placeholder="Cari produk..." value="<?= esc($search ?? '') ?>" />
                <button type="submit"><i class="fa fa-search"></i></button>
            </div>
            <input type="hidden" name="kategori" value="<?= esc($selected_kategori ?? '') ?>">
        </form>
        <a href="<?= base_url('admin/produk/tambah') ?>" class="btn-tambah">
            <i class="fa fa-plus"></i> Tambah Produk
        </a>
    </div>

    <div class="produk-body">
        <div class="produk-content">
            <?php if (empty($produk)): ?>
                <div class="no-data">
                    <i class="fa fa-box-open fa-3x"></i>
                    <h3>Belum Ada Produk</h3>
                    <p>Silakan tambahkan produk pertama Anda</p>
                    <a href="<?= base_url('admin/produk/tambah') ?>" class="btn-tambah-inline">Tambah Produk</a>
                </div>
            <?php else: ?>
                <div class="produk-grid">
                    <?php foreach ($produk as $item): ?>
                    <div class="produk-card">
                        <div class="produk-image">
                            <?php if ($item['foto']): ?>
                                <img src="<?= base_url('uploads/produk/' . $item['foto']) ?>" alt="<?= esc($item['nama']) ?>">
                            <?php else: ?>
                                <div class="no-image-placeholder">
                                    <i class="fa fa-image"></i>
                                    <span>No Image</span>
                                </div>
                            <?php endif; ?>
                            
                            <div class="produk-actions">
                                <a href="<?= base_url('admin/produk/edit/' . $item['id']) ?>" class="btn-edit" title="Edit Produk">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <button onclick="confirmDelete(<?= $item['id'] ?>, '<?= esc($item['nama']) ?>')" 
                                        class="btn-delete" 
                                        title="Hapus Produk">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </div>

                            <div class="status-badge">
                                <span class="status-stok <?= $item['stok'] > 0 ? 'tersedia' : 'habis' ?>">
                                    <?= $item['stok'] > 0 ? 'Tersedia' : 'Habis' ?>
                                </span>
                            </div>
                        </div>
                        
                        <div class="produk-info">
                            <h4 class="nama-produk" title="<?= esc($item['nama']) ?>">
                                <?= esc($item['nama']) ?>
                            </h4>
                            
                            <div class="produk-meta">
                                <span class="kategori">
                                    <i class="fa fa-tag"></i>
                                    <?= esc($item['nama_kategori'] ?? 'Tanpa Kategori') ?>
                                </span>
                                <span class="stok-info">
                                    <i class="fa fa-cubes"></i>
                                    Stok: <?= $item['stok'] ?>
                                </span>
                            </div>

                            <div class="harga-container">
                                <span class="harga">Rp <?= number_format($item['harga'], 0, ',', '.') ?></span>
                            </div>
                            
                            <?php if ($item['detail']): ?>
                                <p class="detail" title="<?= esc($item['detail']) ?>">
                                    <?= esc(substr($item['detail'], 0, 60)) ?><?= strlen($item['detail']) > 60 ? '...' : '' ?>
                                </p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>

        <div class="produk-sidebar">
            <div class="filter-card">
                <div class="filter-header">
                    <h4><i class="fa fa-filter"></i> Filter Produk</h4>
                </div>
                
                <form method="GET" class="filter-form">
                    <input type="hidden" name="search" value="<?= esc($search ?? '') ?>">
                    
                    <div class="filter-group">
                        <label>Kategori Produk:</label>
                        <select name="kategori" onchange="this.form.submit()">
                            <option value="">Semua Kategori</option>
                            <?php foreach ($kategori as $kat): ?>
                                <option value="<?= $kat['id'] ?>" <?= ($selected_kategori == $kat['id']) ? 'selected' : '' ?>>
                                    <?= esc($kat['nama']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div class="filter-actions">
                        <a href="<?= base_url('admin/produk') ?>" class="btn-reset">
                            <i class="fa fa-refresh"></i> Reset
                        </a>
                    </div>
                </form>
            </div>

            <div class="stats-card">
                <div class="stats-header">
                    <h4><i class="fa fa-chart-bar"></i> Statistik</h4>
                </div>
                <div class="stats-content">
                    <div class="stat-item">
                        <span class="stat-number"><?= count($produk) ?></span>
                        <span class="stat-label">Total Produk</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.page-header {
    margin-bottom: 30px;
    padding-bottom: 20px;
    border-bottom: 2px solid #e9ecef;
}

.page-header h2 {
    margin: 0 0 5px 0;
    color: #2c3e50;
    font-size: 28px;
    font-weight: 600;
}

.page-description {
    color: #6c757d;
    margin: 0;
    font-size: 14px;
}

.produk-container {
    width: 100%;
}

.produk-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 25px;
    gap: 20px;
    padding: 20px;
    background: white;
    border-radius: 10px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.search-form {
    flex: 1;
    max-width: 400px;
}

.search-box {
    display: flex;
    border: 2px solid #e9ecef;
    border-radius: 8px;
    overflow: hidden;
    transition: border-color 0.3s ease;
}

.search-box:focus-within {
    border-color: #1290c2;
}

.search-box input {
    flex: 1;
    border: none;
    padding: 12px 15px;
    font-size: 14px;
    outline: none;
    background: #f8f9fa;
}

.search-box input:focus {
    background: white;
}

.search-box button {
    background: #1290c2;
    border: none;
    padding: 0 18px;
    color: white;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.search-box button:hover {
    background-color: #0b6e99;
}

.btn-tambah {
    background: linear-gradient(135deg, #1290c2, #0b6e99);
    color: white;
    border: none;
    padding: 12px 24px;
    border-radius: 8px;
    font-weight: 600;
    text-decoration: none;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 2px 4px rgba(18, 144, 194, 0.3);
}

.btn-tambah:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(18, 144, 194, 0.4);
}

.btn-tambah i {
    margin-right: 8px;
}

.produk-body {
    display: flex;
    gap: 25px;
}

.produk-content {
    flex: 1;
}

.produk-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 20px;
}

.no-data {
    text-align: center;
    padding: 60px 20px;
    background: white;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

.no-data i {
    color: #dee2e6;
    margin-bottom: 20px;
}

.no-data h3 {
    margin: 10px 0;
    color: #6c757d;
}

.no-data p {
    color: #adb5bd;
    margin-bottom: 25px;
}

.btn-tambah-inline {
    background: #1290c2;
    color: white;
    padding: 10px 20px;
    border-radius: 6px;
    text-decoration: none;
    font-weight: 500;
    transition: background-color 0.3s ease;
}

.btn-tambah-inline:hover {
    background: #0b6e99;
}

.produk-card {
    background: white;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
    border: 1px solid #e9ecef;
}

.produk-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
}

.produk-image {
    position: relative;
    height: 180px;
    overflow: hidden;
    background: #f8f9fa;
}

.produk-card img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.produk-card:hover img {
    transform: scale(1.05);
}

.no-image-placeholder {
    width: 100%;
    height: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    background: #d5f1ff;
    color: #1290c2;
}

.no-image-placeholder i {
    font-size: 24px;
    margin-bottom: 8px;
}

.produk-actions {
    position: absolute;
    top: 12px;
    right: 12px;
    display: flex;
    gap: 8px;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.produk-card:hover .produk-actions {
    opacity: 1;
}

.btn-edit, .btn-delete {
    background: rgba(255, 255, 255, 0.9);
    color: #333;
    border: none;
    padding: 8px;
    border-radius: 6px;
    cursor: pointer;
    text-decoration: none;
    font-size: 14px;
    transition: all 0.3s ease;
    backdrop-filter: blur(10px);
}

.btn-edit:hover {
    background: #28a745;
    color: white;
}

.btn-delete:hover {
    background: #dc3545;
    color: white;
}

.status-badge {
    position: absolute;
    top: 12px;
    left: 12px;
}

.status-stok {
    font-size: 11px;
    padding: 6px 12px;
    border-radius: 20px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.status-stok.tersedia {
    background: linear-gradient(135deg, #28a745, #20c997);
    color: white;
}

.status-stok.habis {
    background: linear-gradient(135deg, #dc3545, #e74c3c);
    color: white;
}

.produk-info {
    padding: 20px;
}

.nama-produk {
    font-weight: 600;
    font-size: 16px;
    margin: 0 0 12px 0;
    color: #2c3e50;
    line-height: 1.3;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.produk-meta {
    display: flex;
    flex-direction: column;
    gap: 8px;
    margin-bottom: 15px;
}

.kategori, .stok-info {
    font-size: 12px;
    color: #6c757d;
    display: flex;
    align-items: center;
    gap: 6px;
}

.kategori i, .stok-info i {
    font-size: 11px;
    color: #1290c2;
}

.harga-container {
    margin: 15px 0;
}

.harga {
    color: #e74c3c;
    font-weight: 700;
    font-size: 18px;
    display: block;
}

.detail {
    font-size: 12px;
    color: #6c757d;
    line-height: 1.4;
    margin: 10px 0 0 0;
    overflow: hidden;
    text-overflow: ellipsis;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
}

.produk-sidebar {
    width: 280px;
    flex-shrink: 0;
}

.filter-card, .stats-card {
    background: white;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    margin-bottom: 20px;
    overflow: hidden;
}

.filter-header, .stats-header {
    background: #1290c2;
    color: white;
    padding: 15px 20px;
    font-weight: 600;
}

.filter-header h4, .stats-header h4 {
    margin: 0;
    font-size: 14px;
    display: flex;
    align-items: center;
    gap: 8px;
}

.filter-form {
    padding: 20px;
}

.filter-group {
    margin-bottom: 20px;
}

.filter-group label {
    display: block;
    margin-bottom: 8px;
    font-size: 13px;
    font-weight: 600;
    color: #2c3e50;
}

.filter-group select {
    width: 100%;
    padding: 10px 12px;
    border: 2px solid #e9ecef;
    border-radius: 6px;
    font-size: 13px;
    background: #f8f9fa;
    transition: all 0.3s ease;
}

.filter-group select:focus {
    border-color: #1290c2;
    background: white;
    outline: none;
}

.btn-reset {
    background: #f8f9fa;
    color: #1290c2;
    padding: 10px 16px;
    border-radius: 6px;
    text-decoration: none;
    font-size: 12px;
    font-weight: 600;
    border: 2px solid #e9ecef;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 6px;
}

.btn-reset:hover {
    background: #1290c2;
    color: white;
    border-color: #1290c2;
}

.stats-content {
    padding: 20px;
}

.stat-item {
    text-align: center;
}

.stat-number {
    display: block;
    font-size: 24px;
    font-weight: 700;
    color: #1290c2;
    margin-bottom: 5px;
}

.stat-label {
    font-size: 12px;
    color: #6c757d;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

/* Responsive Design */
@media (max-width: 1024px) {
    .produk-grid {
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    }
    
    .produk-sidebar {
        width: 250px;
    }
}

@media (max-width: 768px) {
    .produk-body {
        flex-direction: column;
    }
    
    .produk-sidebar {
        width: 100%;
    }
    
    .produk-grid {
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 15px;
    }
    
    .produk-header {
        flex-direction: column;
        align-items: stretch;
        gap: 15px;
    }
    
    .search-form {
        max-width: 100%;
    }
    
    .page-header h2 {
        font-size: 24px;
    }
}

@media (max-width: 480px) {
    .produk-grid {
        grid-template-columns: 1fr;
    }
    
    .produk-header {
        padding: 15px;
    }
    
    .produk-info {
        padding: 15px;
    }
}
</style>

<!-- SweetAlert2 CDN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.10.1/sweetalert2.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.10.1/sweetalert2.min.css">

<script>
// Tampilkan notifikasi jika ada
<?php if (session()->getFlashdata('success')): ?>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: '<?= session()->getFlashdata('success') ?>',
        confirmButtonColor: '#1290c2',
        timer: 3000,
        timerProgressBar: true
    });
<?php endif; ?>

<?php if (session()->getFlashdata('error')): ?>
    Swal.fire({
        icon: 'error',
        title: 'Gagal!',
        text: '<?= session()->getFlashdata('error') ?>',
        confirmButtonColor: '#1290c2',
        timer: 3000
    });
<?php endif; ?>

<?php if (session()->getFlashdata('errors')): ?>
    let errors = <?= json_encode(session()->getFlashdata('errors')) ?>;
    let errorText = Object.values(errors).join('\n');
    Swal.fire({
        icon: 'error',
        title: 'Validasi Gagal!',
        text: errorText,
        showConfirmButton: true
    });
<?php endif; ?>

// Fungsi konfirmasi hapus
function confirmDelete(id, nama) {
    Swal.fire({
        title: 'Hapus Produk?',
        text: `Apakah Anda yakin ingin menghapus produk "${nama}"? Data yang dihapus tidak dapat dikembalikan.`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = `<?= base_url('admin/produk/hapus/') ?>${id}`;
        }
    });
}
</script>

<?= $this->endSection() ?>