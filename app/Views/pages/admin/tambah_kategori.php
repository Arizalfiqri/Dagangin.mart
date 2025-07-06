<?= $this->extend('layout/base_admin') ?> 
<?= $this->section('content') ?>

<div class="produk-container">
    <h2>Tambah Kategori</h2>

    <!-- Alert Messages -->
    <?php if (session()->getFlashdata('errors')): ?>
        <div class="alert alert-error">
            <ul>
                <?php foreach (session()->getFlashdata('errors') as $error): ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-error">
            <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <div class="form-container">
        <form action="<?= base_url('admin/kategori/tambah') ?>" method="post" class="produk-form">
            <div class="form-group">
                <label for="nama">Nama Kategori <span class="required">*</span></label>
                <input type="text" id="nama" name="nama" required value="<?= old('nama') ?>" 
                       placeholder="Masukkan nama kategori" maxlength="100">
                <small class="form-hint">Maksimal 100 karakter</small>
            </div>

            <div class="form-actions">
                <a href="<?= base_url('admin/kategori') ?>" class="btn-cancel">Batal</a>
                <button type="submit" class="btn-submit">
                    <i class="fa fa-save"></i> Simpan Kategori
                </button>
            </div>
        </form>
    </div>
</div>

<style>
.produk-container {
    max-width: 600px;
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

.form-hint {
    color: #666;
    font-size: 12px;
    display: block;
    margin-top: 5px;
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

.alert {
    padding: 15px;
    margin-bottom: 20px;
    border-radius: 6px;
    font-size: 14px;
}

.alert-error {
    background-color: #fef2f2;
    color: #b91c1c;
    border-left: 4px solid #dc2626;
}

.alert-success {
    background-color: #f0f9f0;
    color: #166534;
    border-left: 4px solid #22c55e;
}

.alert ul {
    margin: 0;
    padding-left: 20px;
}

@media (max-width: 768px) {
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

<?= $this->endSection() ?>