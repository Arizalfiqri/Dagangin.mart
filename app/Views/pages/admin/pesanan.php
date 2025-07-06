<?= $this->extend('layout/base_admin') ?>

<?= $this->section('content') ?>
<h2>Daftar Pesanan</h2>

<?php foreach ($pesanan as $value): ?>
<div class="order-row">
    <div><?= esc($value['nama_customer']) ?></div>

    <!-- Dropdown Status -->
    <div class="status">
        <form action="<?= base_url('admin/pesanan/ubah/' . $value['order_id']) ?>" method="post">
            <select name="status" onchange="this.form.submit()">
                <option value="Dikemas" <?= $value['status'] === 'Dikemas' ? 'selected' : '' ?>>Dikemas</option>
                <option value="Pengiriman" <?= $value['status'] === 'Pengiriman' ? 'selected' : '' ?>>Pengiriman</option>
                <option value="Selesai" <?= $value['status'] === 'Selesai' ? 'selected' : '' ?>>Selesai</option>
                <option value="Retur" <?= $value['status'] === 'Retur' ? 'selected' : '' ?>>Retur</option>
            </select>
        </form>
    </div>

    <div>Rp. <?= number_format($value['total'], 0, ',', '.') ?></div>

    <div>
        <a href="<?= base_url('admin/pesanan/detail/' . $value['order_id']) ?>" class="info-btn" title="Detail">
            <i class="fa-solid fa-circle-info"></i>
        </a>
    </div>
</div>
<?php endforeach; ?>

<style>
h2 {
    margin-bottom: 30px;
}

table {
    width: 100%;
    border-spacing: 0 10px;
}

th {
    text-align: left;
    padding-bottom: 10px;
}

.order-row {
    background-color: #f2f2f2;
    border: 1px solid #333;
    padding: 20px;
    display: grid;
    grid-template-columns: 2fr 2fr 2fr 1fr;
    align-items: center;
    margin-bottom: 10px;
}

.status select {
    padding: 5px 10px;
    font-size: 14px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.status select:focus {
    outline: none;
    border-color: #007bff;
}

.order-row span {
    font-weight: bold;
}

.status {
    display: flex;
    align-items: center;
    gap: 8px;
}

.dropdown-icon {
    font-size: 14px;
}

.info-btn {
    background-color: white;
    border: 2px solid #007bff;
    color: #007bff;
    font-size: 20px;
    border-radius: 50%;
    text-decoration: none;
    width: 36px;
    height: 36px;
    display: flex;
    justify-content: center;
    align-items: center;
    cursor: pointer;
}

.info-btn:hover {
    background-color: #007bff;
    color: white;
}
</style>

<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
// Check for success/error messages from session
<?php if (session()->getFlashdata('success')): ?>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: '<?= session()->getFlashdata('success') ?>',
        confirmButtonColor: '#1290c2',
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

// Confirmation before status change
document.addEventListener('DOMContentLoaded', function() {
    const statusSelects = document.querySelectorAll('select[name="status"]');
    
    statusSelects.forEach(select => {
        select.addEventListener('change', function(e) {
            e.preventDefault();
            
            const form = this.closest('form');
            const newStatus = this.value;
            
            Swal.fire({
                title: 'Konfirmasi Perubahan',
                text: `Apakah Anda yakin ingin mengubah status menjadi "${newStatus}"?`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Ubah!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                } else {
                    // Reset select to original value if cancelled
                    this.selectedIndex = this.dataset.originalIndex || 0;
                }
            });
        });
        
        // Store original selected index
        select.dataset.originalIndex = select.selectedIndex;
    });
});
</script>
<?= $this->endSection() ?>