<p>Ada permintaan pendaftaran admin baru dengan data berikut:</p>
<ul>
    <li>Nama: <?= esc($user['nama_lengkap']) ?></li>
    <li>Email: <?= esc($user['email']) ?></li>
    <li>Username: <?= esc($user['username']) ?></li>
    <li>No HP: <?= esc($user['no_hp']) ?></li>
</ul>

<p>Silakan pilih aksi:</p>
<a href="<?= base_url('verification/approve/' . $user['username']) ?>" style="background-color:green;padding:10px;color:white;text-decoration:none;">Verifikasi</a>
<a href="<?= base_url('verification/reject/' . $user['username']) ?>" style="background-color:red;padding:10px;color:white;text-decoration:none;">Tolak Verifikasi</a>
