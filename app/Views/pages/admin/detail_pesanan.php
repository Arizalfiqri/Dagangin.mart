<?= $this->extend('layout/base_admin') ?>
<?= $this->section('content') ?>

<div class="detail-container">
    <div class="header-section">
        <h2>Detail Pesanan #<?= $pesanan['order_id'] ?></h2>
        <a href="<?= base_url('admin/pesanan') ?>" class="back-btn">
            <i class="fa-solid fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="info-grid">
        <div class="info-card">
            <h3>Informasi Pesanan</h3>
            <div class="info-row">
                <span class="label">ID Pesanan:</span>
                <span class="value">#<?= $pesanan['order_id'] ?></span>
            </div>
            <div class="info-row">
                <span class="label">Tanggal:</span>
                <span class="value"><?= date('d/m/Y H:i', strtotime($pesanan['tanggal'])) ?></span>
            </div>
            <div class="info-row">
                <span class="label">Status:</span>
                <span class="status-badge status-<?= strtolower($pesanan['status']) ?>">
                    <?= $pesanan['status'] ?>
                </span>
            </div>
        </div>

        <div class="info-card">
            <h3>Informasi Customer</h3>
            <div class="info-row">
                <span class="label">Nama:</span>
                <span class="value"><?= esc($pesanan['nama_customer']) ?></span>
            </div>
            <div class="info-row">
                <span class="label">Total Pesanan:</span>
                <span class="value total-amount">Rp <?= number_format($pesanan['total'], 0, ',', '.') ?></span>
            </div>
            <div class="info-row">
                <span class="label">Alamat:</span>
                <span class="value"><?= esc($pesanan['alamat']) ?></span>
            </div>
            <div class="info-row">
                <span class="label">Email:</span>
                <span class="value"><?= esc($pesanan['email']) ?></span>
            </div>
            <div class="info-row">
                <span class="label">NO HP:</span>
                <span class="value"><?= esc($pesanan['no_hp']) ?></span>
            </div>

        </div>
    </div>

    <div class="detail-items">
        <h3>Detail Item Pesanan</h3>
        <div class="items-table">
            <div class="table-header">
                <div class="col-product">Produk</div>
                <div class="col-qty">Jumlah</div>
                <div class="col-price">Harga Satuan</div>
                <div class="col-subtotal">Subtotal</div>
            </div>
            
            <?php foreach ($order_details as $detail): ?>
            <div class="table-row">
                <div class="col-product">
                    <strong><?= esc($detail['nama_produk']) ?></strong>
                </div>
                <div class="col-qty"><?= $detail['jumlah'] ?></div>
                <div class="col-price">Rp <?= number_format($detail['harga_satuan'], 0, ',', '.') ?></div>
                <div class="col-subtotal">Rp <?= number_format($detail['harga_satuan'] * $detail['jumlah'], 0, ',', '.') ?></div>
            </div>
            <?php endforeach; ?>
            
            <div class="table-footer">
                <div class="total-row">
                    <span>Total Keseluruhan: </span>
                    <strong>Rp <?= number_format($pesanan['total'], 0, ',', '.') ?></strong>
                </div>
            </div>
        </div>
    </div>

    <div class="action-section">
        <form action="<?= base_url('admin/pesanan/ubah/' . $pesanan['order_id']) ?>" method="post" class="status-form">
            <label for="status">Ubah Status:</label>
            <select name="status" id="status" class="status-select">
                <option value="Dikemas" <?= $pesanan['status'] === 'Dikemas' ? 'selected' : '' ?>>Dikemas</option>
                <option value="Pengiriman" <?= $pesanan['status'] === 'Pengiriman' ? 'selected' : '' ?>>Pengiriman</option>
                <option value="Selesai" <?= $pesanan['status'] === 'Selesai' ? 'selected' : '' ?>>Selesai</option>
                <option value="Retur" <?= $pesanan['status'] === 'Retur' ? 'selected' : '' ?>>Retur</option>
            </select>
            <button type="submit" class="update-btn">Update Status</button>
        </form>
    </div>
</div>

<style>
.detail-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
}

.header-section {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 30px;
    padding-bottom: 15px;
    border-bottom: 2px solid #e9ecef;
}

.header-section h2 {
    margin: 0;
    color: #333;
    font-size: 28px;
}

.back-btn {
    background-color: #6c757d;
    color: white;
    padding: 10px 20px;
    border-radius: 8px;
    text-decoration: none;
    font-size: 14px;
    transition: background-color 0.3s;
}

.back-btn:hover {
    background-color: #5a6268;
    color: white;
}

.info-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 25px;
    margin-bottom: 30px;
}

.info-card {
    background: #f8f9fa;
    border: 1px solid #e9ecef;
    border-radius: 10px;
    padding: 25px;
}

.info-card h3 {
    margin: 0 0 20px 0;
    color: #495057;
    font-size: 18px;
    border-bottom: 2px solid #007bff;
    padding-bottom: 8px;
}

.info-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 12px;
    padding: 8px 0;
}

.info-row .label {
    font-weight: 600;
    color: #6c757d;
}

.info-row .value {
    color: #333;
    font-weight: 500;
}

.total-amount {
    font-size: 18px;
    font-weight: bold;
    color: #28a745;
}

.status-badge {
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: bold;
    text-transform: uppercase;
}

.status-dikemas { background-color: #ffc107; color: #212529; }
.status-pengiriman { background-color: #17a2b8; color: white; }
.status-selesai { background-color: #28a745; color: white; }
.status-retur { background-color: #dc3545; color: white; }

.detail-items {
    background: white;
    border: 1px solid #e9ecef;
    border-radius: 10px;
    padding: 25px;
    margin-bottom: 30px;
}

.detail-items h3 {
    margin: 0 0 20px 0;
    color: #495057;
    font-size: 20px;
    border-bottom: 2px solid #007bff;
    padding-bottom: 10px;
}

.items-table {
    width: 100%;
}

.table-header {
    display: grid;
    grid-template-columns: 2fr 1fr 1.5fr 1.5fr;
    gap: 15px;
    padding: 15px 20px;
    border-bottom: 2px solid #007bff;
    font-weight: bold;
    color: #495057;
    background-color: #f8f9fa;
    border-radius: 8px 8px 0 0;
}

.table-row {
    display: grid;
    grid-template-columns: 2fr 1fr 1.5fr 1.5fr;
    gap: 15px;
    padding: 15px 20px;
    border-bottom: 1px solid #e9ecef;
    align-items: center;
}

.table-row:nth-child(even) {
    background-color: #f8f9fa;
}

.col-product {
    text-align: left;
}

.col-product strong {
    color: #333;
    font-size: 16px;
}

.col-qty {
    text-align: center;
    font-weight: 600;
    color: #495057;
}

.col-price, .col-subtotal {
    text-align: right;
    font-weight: 500;
    color: #333;
}

.table-footer {
    margin-top: 20px;
    padding-top: 15px;
    border-top: 2px solid #007bff;
}

.total-row {
    display: flex;
    justify-content: flex-end;
    align-items: center;
    gap: 10px;
    font-size: 18px;
    color: #28a745;
}

.action-section {
    background: #f8f9fa;
    border: 1px solid #e9ecef;
    border-radius: 10px;
    padding: 25px;
}

.status-form {
    display: flex;
    align-items: center;
    gap: 15px;
}

.status-form label {
    font-weight: 600;
    color: #495057;
    font-size: 16px;
}

.status-select {
    padding: 10px 15px;
    border: 1px solid #ced4da;
    border-radius: 6px;
    font-size: 14px;
    min-width: 150px;
}

.status-select:focus {
    outline: none;
    border-color: #007bff;
    box-shadow: 0 0 0 2px rgba(0, 123, 255, 0.25);
}

.update-btn {
    background-color: #007bff;
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 6px;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    transition: background-color 0.3s;
}

.update-btn:hover {
    background-color: #0056b3;
}

@media (max-width: 768px) {
    .info-grid {
        grid-template-columns: 1fr;
    }
    
    .table-header, .table-row {
        grid-template-columns: 1fr;
        gap: 10px;
    }
    
    .status-form {
        flex-direction: column;
        align-items: flex-start;
    }
}
</style>

<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
// Check for success/error messages
<?php if (session()->getFlashdata('success')): ?>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: '<?= session()->getFlashdata('success') ?>',
        showConfirmButton: false,
        timer: 2000,
        timerProgressBar: true
    });
<?php endif; ?>

<?php if (session()->getFlashdata('error')): ?>
    Swal.fire({
        icon: 'error',
        title: 'Gagal!',
        text: '<?= session()->getFlashdata('error') ?>',
        showConfirmButton: true
    });
<?php endif; ?>

// Confirmation for status update
document.querySelector('.status-form').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const form = this;
    const newStatus = form.querySelector('select[name="status"]').value;
    
    Swal.fire({
        title: 'Update Status Pesanan',
        text: `Konfirmasi perubahan status menjadi "${newStatus}"?`,
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#007bff',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, Update!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
    });
});
</script>

<?= $this->endSection() ?>