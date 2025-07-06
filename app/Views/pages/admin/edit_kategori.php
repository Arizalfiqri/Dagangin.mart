<?= $this->extend('layout/base_admin') ?>
<?= $this->section('content') ?>

<h2>Edit Kategori</h2>

<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
<?php endif; ?>
<?php if (session()->getFlashdata('errors')): ?>
    <div class="alert alert-danger">
        <ul>
            <?php foreach (session()->getFlashdata('errors') as $error): ?>
                <li><?= esc($error) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<form action="<?= base_url('admin/kategori/edit/' . $kategori['id']) ?>" method="post">
    <label for="nama">Nama Kategori</label><br>
    <input type="text" name="nama" id="nama" value="<?= esc($kategori['nama']) ?>" required><br><br>

    <button type="submit">Simpan Perubahan</button>
    <a href="<?= base_url('admin/kategori') ?>" class="btn-kembali">Kembali</a>
</form>

<form action="<?= base_url('admin/kategori/hapus/' . $kategori['id']) ?>" method="post" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">
    <button type="submit" style="background-color: crimson; color: white; margin-top: 20px;">Hapus Kategori</button>
</form>

<style>
form {
    margin-top: 20px;
}

input[type="text"] {
    padding: 10px;
    width: 300px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

button {
    padding: 10px 20px;
    background-color: #1290c2;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

button:hover {
    opacity: 0.9;
}

.btn-kembali {
    margin-left: 10px;
    color: #555;
    text-decoration: none;
}

.alert {
    padding: 10px;
    border-radius: 5px;
    margin-bottom: 10px;
    font-weight: bold;
}

.alert-danger {
    background-color: #f8d7da;
    color: #721c24;
}
</style>

<?= $this->endSection() ?>
