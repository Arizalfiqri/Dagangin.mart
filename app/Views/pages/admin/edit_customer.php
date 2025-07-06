<?= $this->extend('layout/base_admin') ?>
<?= $this->section('content') ?>

<div class="produk-container">
    <h2>Edit Customer</h2>

    <div class="form-container">
        <form method="post" action="<?= base_url('admin/customer/update/' . $customer['id']) ?>" class="produk-form" id="customerForm">
            <div class="form-grid">
                <div class="form-group">
                    <label for="username">Username <span class="required">*</span></label>
                    <input type="text" id="username" name="username" value="<?= esc($customer['username']) ?>" required placeholder="Masukkan username">
                </div>

                <div class="form-group">
                    <label for="email">Email <span class="required">*</span></label>
                    <input type="email" id="email" name="email" value="<?= esc($customer['email']) ?>" required placeholder="Masukkan email">
                </div>

                <div class="form-group">
                    <label for="no_hp">No HP <span class="required">*</span></label>
                    <input type="text" id="no_hp" name="no_hp" value="<?= esc($customer['no_hp']) ?>" required placeholder="Masukkan nomor HP">
                </div>
            </div>

            <div class="form-actions">
                <a href="<?= base_url('admin/customer') ?>" class="btn-cancel">Batal</a>
                <button type="submit" class="btn-submit">
                    <i class="fa fa-save"></i> Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

<style>
.produk-container {
    max-width: 900px;
    margin: 0 auto;
    padding: 20px;
}

.form-container {
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    padding: 30px;
    margin-top: 20px;
}

.produk-form {
    display: flex;
    flex-direction: column;
    gap: 25px;
}

.form-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 20px;
}

.form-group {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.form-group label {
    font-weight: 600;
    color: #333;
    font-size: 14px;
}

.form-group input {
    padding: 12px 15px;
    border: 1px solid #ddd;
    border-radius: 6px;
    font-size: 14px;
    transition: all 0.3s ease;
    background-color: #f9f9f9;
}

.form-group input:focus {
    outline: none;
    border-color: #1290c2;
    box-shadow: 0 0 0 3px rgba(18, 144, 194, 0.1);
    background-color: #fff;
}

.required {
    color: #e74c3c;
}

.form-actions {
    display: flex;
    justify-content: flex-end;
    gap: 15px;
    margin-top: 20px;
    padding-top: 20px;
    border-top: 1px solid #eee;
}

.btn-cancel {
    background-color: #f0f0f0;
    color: #555;
    padding: 12px 24px;
    border: none;
    border-radius: 6px;
    text-decoration: none;
    cursor: pointer;
    transition: all 0.3s ease;
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: 8px;
}

.btn-cancel:hover {
    background-color: #e0e0e0;
    color: #333;
}

.btn-submit {
    background-color: #1290c2;
    color: white;
    padding: 12px 24px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    font-weight: 500;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 8px;
}

.btn-submit:hover {
    background-color: #0b6e99;
    transform: translateY(-1px);
}

@media (max-width: 768px) {
    .form-grid {
        grid-template-columns: 1fr;
    }
    
    .form-actions {
        flex-direction: column;
    }
    
    .btn-cancel,
    .btn-submit {
        width: 100%;
        justify-content: center;
    }
}
</style>

<!-- SweetAlert2 CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
// Handle flash messages with SweetAlert
document.addEventListener('DOMContentLoaded', function() {
    <?php if (session()->getFlashdata('msg')): ?>
        Swal.fire({
            icon: 'success',
            title: 'Sukses',
            text: '<?= session()->getFlashdata('msg') ?>',
            confirmButtonColor: '#1290c2',
            timer: 3000
        });
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: '<?= session()->getFlashdata('error') ?>',
            confirmButtonColor: '#1290c2'
        });
    <?php endif; ?>

    <?php if (session()->getFlashdata('errors')): ?>
        Swal.fire({
            icon: 'error',
            title: 'Validasi Error',
            html: `<?php foreach (session()->getFlashdata('errors') as $error): ?>
                <p><?= esc($error) ?></p>
            <?php endforeach; ?>`,
            confirmButtonColor: '#1290c2'
        });
    <?php endif; ?>

    // Form submission confirmation
    document.getElementById('customerForm').addEventListener('submit', function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Konfirmasi',
            text: 'Apakah Anda yakin ingin menyimpan perubahan?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#1290c2',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, Simpan',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                this.submit();
            }
        });
    });
});
</script>

<?= $this->endSection() ?>