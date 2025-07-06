<?= $this->extend('layout/base_admin') ?> 
<?= $this->section('content') ?>

<h2>Edit Produk</h2>

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
    <form action="<?= base_url('admin/produk/edit/' . $produk['id']) ?>" method="post" enctype="multipart/form-data" class="produk-form">
        <div class="form-group">
            <label for="nama">Nama Produk *</label>
            <input type="text" id="nama" name="nama" required value="<?= esc($produk['nama']) ?>">
        </div>

        <div class="form-group">
            <label for="kategori_id">Kategori *</label>
            <select id="kategori_id" name="kategori_id" required>
                <option value="">Pilih Kategori</option>
                <?php foreach ($kategori as $kat): ?>
                    <option value="<?= $kat['id'] ?>" <?= $produk['kategori_id'] == $kat['id'] ? 'selected' : '' ?>>
                        <?= esc($kat['nama']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="harga">Harga *</label>
            <input type="number" id="harga" name="harga" required min="0" step="1000" value="<?= esc($produk['harga']) ?>">
        </div>

        <div class="form-group">
            <label for="ketersediaan_stok">Status Stok *</label>
            <select id="ketersediaan_stok" name="ketersediaan_stok" required>
                <option value="">Pilih Status</option>
                <option value="tersedia" <?= $produk['ketersediaan_stok'] == 'tersedia' ? 'selected' : '' ?>>Tersedia</option>
                <option value="habis" <?= $produk['ketersediaan_stok'] == 'habis' ? 'selected' : '' ?>>Stok Habis</option>
            </select>
        </div>

        <div class="form-group">
            <label for="stok">Stok Produk *</label>
            <input type="number" id="stok" name="stok" required min="0" value="<?= esc($produk['stok'] ?? 0) ?>">
        </div>


        <div class="form-group">
            <label for="foto">Foto Produk</label>
            <?php if ($produk['foto']): ?>
                <div class="current-image">
                    <img src="<?= base_url('uploads/produk/' . $produk['foto']) ?>" alt="Current Image" style="max-width: 200px; margin-bottom: 10px;">
                    <p>Foto saat ini</p>
                </div>
            <?php endif; ?>
            <input type="file" id="foto" name="foto" accept="image/*">
            <small>Format: JPG, JPEG, PNG. Maksimal 2MB. Kosongkan jika tidak ingin mengubah foto.</small>
        </div>

        <div class="form-group">
            <label for="detail">Deskripsi</label>
            <textarea id="detail" name="detail" rows="4"><?= esc($produk['detail']) ?></textarea>
        </div>

        <div class="form-actions">
            <a href="<?= base_url('admin/produk') ?>" class="btn-cancel">Batal</a>
            <button type="submit" class="btn-submit">Update Produk</button>
        </div>
    </form>
</div>

<style>
.form-container {
    max-width: 600px;
    margin: 0 auto;
    background: white;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.produk-form {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.form-group {
    display: flex;
    flex-direction: column;
}

.form-group label {
    font-weight: bold;
    margin-bottom: 8px;
    color: #333;
}

.form-group input,
.form-group select,
.form-group textarea {
    padding: 12px;
    border: 1px solid #ddd;
    border-radius: 6px;
    font-size: 14px;
    transition: border-color 0.3s ease;
}

.form-group input:focus,
.form-group select:focus,
.form-group textarea:focus {
    outline: none;
    border-color: #1290c2;
    box-shadow: 0 0 0 3px rgba(18, 144, 194, 0.1);
}

.form-group small {
    margin-top: 5px;
    color: #666;
    font-size: 12px;
}

.current-image {
    margin-bottom: 10px;
}

.current-image img {
    border-radius: 6px;
    border: 1px solid #ddd;
}

.current-image p {
    margin: 5px 0;
    font-size: 12px;
    color: #666;
}

.form-actions {
    display: flex;
    gap: 15px;
    justify-content: flex-end;
    margin-top: 20px;
}

.btn-cancel {
    background-color: #6c757d;
    color: white;
    padding: 12px 24px;
    border: none;
    border-radius: 6px;
    text-decoration: none;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.btn-cancel:hover {
    background-color: #5a6268;
}

.btn-submit {
    background-color: #1290c2;
    color: white;
    padding: 12px 24px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    font-weight: bold;
    transition: background-color 0.3s ease;
}

.btn-submit:hover {
    background-color: #0b6e99;
}

.alert {
    padding: 12px;
    margin-bottom: 20px;
    border-radius: 4px;
}

.alert-error {
    background-color: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
}

.alert ul {
    margin: 0;
    padding-left: 20px;
}
</style>

<?= $this->endSection() ?>