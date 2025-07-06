<?= $this->extend('layout/base_admin') ?>

<?= $this->section('content') ?>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success">
        <?= session()->getFlashdata('success') ?>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger">
        <?= session()->getFlashdata('error') ?>
    </div>
<?php endif; ?>

<h2>Daftar Kategori</h2>

<a href="<?= base_url('admin/kategori/tambah') ?>" class="btn-tambah">+ Tambah</a>

<div class="kategori-wrapper">
    <?php foreach ($kategori as $kat): ?>
        <div class="kategori-card">
            <?= esc($kat['nama']) ?>
            <div class="icon-group">
                <a href="<?= base_url('admin/kategori/edit/' . $kat['id']) ?>" class="icon icon-info" title="Edit">
                    <i class="fa-solid fa-pen-to-square"></i>
                </a>

            </div>
        </div>
    <?php endforeach; ?>
</div>


<style>
h2 {
    margin-bottom: 20px;
}

.btn-tambah {
    background-color: #1290c2;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 25px;
    text-decoration: none;
    float: right;
    margin-top: -50px;
    cursor: pointer;
    transition: all 0.3s ease-in-out;
}

.btn-tambah:hover {
    background-color: #0b6e99;
}

.kategori-wrapper {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    margin-top: 60px;
}

.kategori-card {
    background: linear-gradient(to right, #26a69a, #0277bd);
    color: white;
    padding: 20px 30px;
    border-radius: 15px;
    width: 250px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-weight: bold;
    font-size: 1.1rem;
}

.icon-group {
    display: flex;
    gap: 10px;
}

.icon {
    font-size: 18px;
    cursor: pointer;
}

.icon-info {
    color: white;
}

.icon-trash {
    color: crimson;
}

.icon:hover {
    opacity: 0.8;
}
</style>
<?= $this->endSection() ?>