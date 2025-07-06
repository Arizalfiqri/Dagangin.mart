<?= $this->extend('layout/base_admin') ?> 
<?= $this->section('content') ?>

<div class="produk-container">
    <h2>Tambah Produk</h2>

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

    <div class="form-container">
        <form action="<?= base_url('admin/produk/tambah') ?>" method="post" enctype="multipart/form-data" class="produk-form">
            <div class="form-grid">
                <div class="form-group">
                    <label for="nama">Nama Produk <span class="required">*</span></label>
                    <input type="text" id="nama" name="nama" required value="<?= old('nama') ?>" placeholder="Masukkan nama produk">
                </div>

                <div class="form-group">
                    <label for="kategori_id">Kategori <span class="required">*</span></label>
                    <select id="kategori_id" name="kategori_id" required>
                        <option value="">Pilih Kategori</option>
                        <?php foreach ($kategori as $kat): ?>
                            <option value="<?= $kat['id'] ?>" <?= old('kategori_id') == $kat['id'] ? 'selected' : '' ?>>
                                <?= esc($kat['nama']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="harga">Harga <span class="required">*</span></label>
                    <div class="input-with-symbol">
                        <span class="symbol">Rp</span>
                        <input type="number" id="harga" name="harga" required min="0" step="1000" 
                            value="<?= old('harga') ?>" placeholder="0">
                    </div>
                </div>

                <div class="form-group">
                    <label for="ketersediaan_stok">Status Stok <span class="required">*</span></label>
                    <select id="ketersediaan_stok" name="ketersediaan_stok" required>
                        <option value="">Pilih Status</option>
                        <option value="tersedia" <?= old('ketersediaan_stok') == 'tersedia' ? 'selected' : '' ?>>Tersedia</option>
                        <option value="habis" <?= old('ketersediaan_stok') == 'habis' ? 'selected' : '' ?>>Stok Habis</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="stok">Stok Produk *</label>
                    <input type="number" id="stok" name="stok" required min="0" value="<?= esc($produk['stok'] ?? 0) ?>">
                </div>
            </div>

            <div class="form-group">
                <label for="foto">Foto Produk</label>
                <div class="file-upload">
                    <label for="foto" class="file-upload-label">
                        <i class="fa fa-cloud-upload"></i>
                        <span id="file-name">Pilih file atau seret ke sini</span>
                    </label>
                    <input type="file" id="foto" name="foto" accept="image/*" onchange="displayFileName(this)">
                </div>
                <small class="file-hint">Format: JPG, JPEG, PNG. Maksimal 2MB</small>
            </div>

            <div class="form-group">
                <label for="detail">Deskripsi</label>
                <textarea id="detail" name="detail" rows="4" placeholder="Masukkan deskripsi produk"><?= old('detail') ?></textarea>
            </div>

            <div class="form-actions">
                <a href="<?= base_url('admin/produk') ?>" class="btn-cancel">Batal</a>
                <button type="submit" class="btn-submit">
                    <i class="fa fa-save"></i> Simpan Produk
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

.form-group input,
.form-group select,
.form-group textarea {
    padding: 12px 15px;
    border: 1px solid #ddd;
    border-radius: 6px;
    font-size: 14px;
    transition: all 0.3s ease;
    background-color: #f9f9f9;
}

.form-group input:focus,
.form-group select:focus,
.form-group textarea:focus {
    outline: none;
    border-color: #1290c2;
    box-shadow: 0 0 0 3px rgba(18, 144, 194, 0.1);
    background-color: #fff;
}

.form-group textarea {
    min-height: 100px;
    resize: vertical;
}

.required {
    color: #e74c3c;
}

.input-with-symbol {
    position: relative;
}

.input-with-symbol .symbol {
    position: absolute;
    left: 12px;
    top: 50%;
    transform: translateY(-50%);
    color: #555;
    font-weight: 500;
}

.input-with-symbol input {
    padding-left: 35px !important;
}

.file-upload {
    position: relative;
    margin-bottom: 5px;
}

.file-upload-label {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 30px;
    border: 2px dashed #ddd;
    border-radius: 6px;
    background-color: #f9f9f9;
    cursor: pointer;
    transition: all 0.3s ease;
    text-align: center;
    color: #555;
}

.file-upload-label:hover {
    border-color: #1290c2;
    background-color: #f0f9ff;
}

.file-upload-label i {
    font-size: 24px;
    margin-bottom: 10px;
    color: #1290c2;
}

.file-upload input[type="file"] {
    position: absolute;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    opacity: 0;
    cursor: pointer;
}

.file-hint {
    color: #666;
    font-size: 12px;
    display: block;
    margin-top: 5px;
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

.alert ul {
    margin: 0;
    padding-left: 20px;
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

<script>
function displayFileName(input) {
    const fileNameElement = document.getElementById('file-name');
    if (input.files.length > 0) {
        fileNameElement.textContent = input.files[0].name;
    } else {
        fileNameElement.textContent = 'Pilih file atau seret ke sini';
    }
}
</script>

<?= $this->endSection() ?>