<?= $this->extend('layout/base_admin') ?>

<?= $this->section('content') ?>
<h2>Daftar Customer</h2>

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>ID</th>
            <th>Username</th>
            <th>Email</th>
            <th>No HP</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1; ?>
        <?php foreach ($customers as $cust): ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $cust['id'] ?></td>
                <td><?= $cust['username'] ?></td>
                <td><?= $cust['email'] ?></td>
                <td><?= $cust['no_hp'] ?></td>
                <td>
                    <a href="<?= base_url("admin/customer/edit/{$cust['id']}") ?>" class="btn btn-edit" title="Edit">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a href="<?= base_url("admin/customer/delete/{$cust['id']}") ?>" class="btn btn-delete" title="Hapus" onclick="confirmDelete(event, this)">
                        <i class="fas fa-trash-alt"></i>
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<!-- SweetAlert2 CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<style>
h2 {
    margin-bottom: 20px;
}

table {
    width: 100%;
    border-collapse: collapse;
    background-color: #b3e5fc;
}

th,
td {
    border: 2px solid #000;
    padding: 12px;
    text-align: center;
}

th {
    background-color: #b3e5fc;
    font-weight: bold;
}

.btn {
    padding: 6px 12px;
    border: none;
    border-radius: 4px;
    font-size: 0.9rem;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 32px;
    height: 32px;
}

.btn i {
    font-size: 14px;
}

.btn-edit {
    background-color: #fbc02d;
    color: #000;
}

.btn-delete {
    background-color: #d32f2f;
    color: #fff;
}

.btn-edit:hover {
    background-color: #fdd835;
}

.btn-delete:hover {
    background-color: #c62828;
}
</style>

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
            timer: 3000,
            timerProgressBar: true
        });
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: '<?= session()->getFlashdata('error') ?>',
            confirmButtonColor: '#1290c2',
            timerProgressBar: true
        });
    <?php endif; ?>
});

// Delete confirmation with SweetAlert
function confirmDelete(event, element) {
    event.preventDefault();
    const url = element.getAttribute('href');
    
    Swal.fire({
        title: 'Konfirmasi Hapus',
        text: 'Apakah Anda yakin ingin menghapus customer ini?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d32f2f',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, Hapus',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = url;
        }
    });
}
</script>

<?= $this->endSection() ?>