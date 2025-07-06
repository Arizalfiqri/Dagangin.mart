<?= $this->extend('layout/base_user') ?>

<?= $this->section('style') ?>
<style>
.profile-container {
    max-width: 1200px;
    margin: 2rem auto;
    padding: 0 1rem;
}

.profile-card {
    background: #ffffff;
    border-radius: 12px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    overflow: hidden;
    border: 1px solid #e8ecf0;
}

.profile-header {
    background: linear-gradient(135deg, #1594ce 0%, #0675a9 100%);
    color: white;
    padding: 2rem;
    text-align: center;
    position: relative;
}

.profile-header::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="20" cy="20" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="80" cy="40" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="40" cy="80" r="1" fill="rgba(255,255,255,0.1)"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
    opacity: 0.3;
}

.profile-header h2 {
    font-size: 1.8rem;
    font-weight: 600;
    margin: 0;
    position: relative;
    z-index: 1;
}

.profile-header p {
    opacity: 0.9;
    margin: 0.5rem 0 0 0;
    position: relative;
    z-index: 1;
}

.profile-content {
    display: flex;
    flex-wrap: wrap;
    min-height: 600px;
}

.sidebar {
    background: #f8f9fa;
    border-right: 1px solid #e8ecf0;
    padding: 2rem;
    flex: 0 0 280px;
}

.sidebar-menu {
    list-style: none;
    padding: 0;
    margin: 0;
}

.sidebar-menu li {
    margin-bottom: 0.5rem;
}

.sidebar-menu a {
    display: flex;
    align-items: center;
    padding: 0.75rem 1rem;
    color: #495057;
    text-decoration: none;
    border-radius: 8px;
    transition: all 0.2s ease;
    font-weight: 500;
}

.sidebar-menu a:hover {
    background: #e9ecef;
    color: #1594ce;
    transform: translateX(4px);
}

.sidebar-menu a.active {
    background: #1594ce;
    color: white;
}

.sidebar-menu i {
    margin-right: 0.75rem;
    width: 16px;
}

.main-content {
    flex: 1;
    padding: 2rem;
    background: white;
}

.tab-content {
    display: none;
}

.tab-content.active {
    display: block;
}

.form-section {
    margin-bottom: 2rem;
}

.section-title {
    color: #343a40;
    font-size: 1.2rem;
    font-weight: 600;
    margin-bottom: 1.5rem;
    padding-bottom: 0.5rem;
    border-bottom: 2px solid #e9ecef;
}

.form-group {
    margin-bottom: 1.5rem;
}

.form-label {
    display: block;
    margin-bottom: 0.5rem;
    color: #495057;
    font-weight: 500;
}

.form-control {
    width: 100%;
    padding: 0.75rem;
    border: 2px solid #e9ecef;
    border-radius: 8px;
    font-size: 0.95rem;
    transition: border-color 0.2s ease, box-shadow 0.2s ease;
}

.form-control:focus {
    outline: none;
    border-color: #1594ce;
    box-shadow: 0 0 0 3px rgba(21, 148, 206, 0.1);
}

.photo-upload {
    text-align: center;
    margin-bottom: 2rem;
}

.photo-preview {
    width: 150px;
    height: 150px;
    border-radius: 50%;
    border: 4px solid #e9ecef;
    object-fit: cover;
    margin: 0 auto 1rem;
    display: block;
    background: linear-gradient(135deg, #87ceeb 0%, #98fb98 100%);
}

.btn-upload {
    background: #1594ce;
    color: white;
    padding: 0.5rem 1.5rem;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    font-size: 0.9rem;
    transition: background 0.2s ease;
}

.btn-upload:hover {
    background: #0675a9;
}

.btn-primary {
    background: #1594ce;
    border: none;
    padding: 0.75rem 2rem;
    border-radius: 8px;
    font-weight: 500;
    transition: all 0.2s ease;
}

.btn-primary:hover {
    background: #0675a9;
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(21, 148, 206, 0.3);
}

.btn-danger {
    background: #dc3545;
    border: none;
    padding: 0.5rem 1.5rem;
    border-radius: 6px;
    color: white;
    text-decoration: none;
    display: inline-block;
    font-size: 0.9rem;
    transition: all 0.2s ease;
}

.btn-danger:hover {
    background: #c82333;
    color: white;
    transform: translateY(-1px);
}

.upload-info {
    font-size: 0.85rem;
    color: #6c757d;
    margin-top: 0.5rem;
}

.address-section {
    background: #f8f9fa;
    padding: 1.5rem;
    border-radius: 8px;
    margin-top: 1rem;
}

@media (max-width: 768px) {
    .profile-content {
        flex-direction: column;
    }
    
    .sidebar {
        flex: none;
        border-right: none;
        border-bottom: 1px solid #e8ecf0;
    }
    
    .main-content {
        padding: 1.5rem;
    }
    
    .profile-header {
        padding: 1.5rem;
    }
}
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="profile-container">
    <div class="profile-card">
        <div class="profile-header">
            <h2>Hello <?= esc(session()->get('customer_username')) ?>!</h2>
            <p>Kelola informasi profil Anda untuk mengontrol, melindungi dan mengamankan akun</p>
        </div>
        
        <div class="profile-content">
            <div class="sidebar">
                <ul class="sidebar-menu">
                    <li>
                        <a href="#biodata" class="menu-link active" data-tab="biodata">
                            <i class="fas fa-user"></i>
                            Biodata Diri
                        </a>
                    </li>
                    <li>
                        <a href="#alamat" class="menu-link" data-tab="alamat">
                            <i class="fas fa-map-marker-alt"></i>
                            Alamat
                        </a>
                    </li>
                    <li>
                        <a href="#" class="menu-link">
                            <i class="fas fa-list-alt"></i>
                            Daftar Transaksi
                        </a>
                    </li>
                    <li>
                        <a href="#" class="menu-link">
                            <i class="fas fa-heart"></i>
                            Yang Disukai
                        </a>
                    </li>
                    <li>
                        <a href="#" class="menu-link">
                            <i class="fas fa-save"></i>
                            Disimpan
                        </a>
                    </li>
                </ul>
            </div>
            
            <div class="main-content">
                <!-- Biodata Tab -->
                <div id="biodata" class="tab-content active">
                    <div class="form-section">
                        <h3 class="section-title">Ubah Biodata Diri</h3>
                        
                        <form action="<?= base_url('customer/update-profile') ?>" method="post" enctype="multipart/form-data">
                            <div class="photo-upload">
                                <?php 
                                $photoSrc = !empty($customer['foto_profil']) ? 
                                        base_url('uploads/profile/' . $customer['foto_profil']) : 
                                        base_url('image/avatar-profil.jpeg');
                                ?>
                                <img src="<?= $photoSrc ?>" alt="Profile Photo" class="photo-preview" id="photoPreview">
                                <div>
                                    <input type="file" name="photo" id="photoInput" accept="image/*" style="display: none;">
                                    <button type="button" class="btn-upload" onclick="document.getElementById('photoInput').click()">
                                        Pilih Foto
                                    </button>
                                    <div class="upload-info">
                                        Besar file: maksimum 10.000.000 bytes (10 Megabytes). Ekstensi file yang diperbolehkan: .JPG .JPEG .PNG
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Nama</label>
                                        <input type="text" name="nama" class="form-control" 
                                            value="<?= esc($customer['nama_lengkap'] ?? '') ?>" 
                                            placeholder="Masukkan nama lengkap">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Tanggal Lahir</label>
                                        <input type="date" name="tanggal_lahir" class="form-control" 
                                            value="<?= esc($customer['tanggal_lahir'] ?? '') ?>">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="form-label">Jenis Kelamin</label>
                                <select name="jenis_kelamin" class="form-control">
                                    <option value="">Pilih jenis kelamin</option>
                                    <option value="L" <?= ($customer['jenis_kelamin'] ?? '') == 'L' ? 'selected' : '' ?>>Laki-laki</option>
                                    <option value="P" <?= ($customer['jenis_kelamin'] ?? '') == 'P' ? 'selected' : '' ?>>Perempuan</option>
                                </select>
                            </div>
                            
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Simpan Perubahan
                            </button>
                        </form>
                    </div>

                    
                    <div class="form-section">
                        <h3 class="section-title">Ubah Kontak</h3>
                        <form action="<?= base_url('customer/update-contact') ?>" method="post">
                            <div class="form-group">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" 
                                    value="<?= esc($customer['email'] ?? '') ?>" 
                                    placeholder="Masukkan email">
                            </div>
                            
                            <div class="form-group">
                                <label class="form-label">Nomor HP</label>
                                <input type="tel" name="no_hp" class="form-control" 
                                    value="<?= esc($customer['no_hp'] ?? '') ?>" 
                                    placeholder="Masukkan nomor HP">
                            </div>
                            
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Simpan Kontak
                            </button>
                        </form>
                    </div>
                </div>
                
                <!-- Alamat Tab -->
                <div id="alamat" class="tab-content">
                    <div class="form-section">
                        <h3 class="section-title">Alamat Pengiriman</h3>
                        <div class="address-section">
                            <form action="<?= base_url('customer/update-address') ?>" method="post">
                                <div class="form-group">
                                    <label class="form-label">Alamat Lengkap</label>
                                    <textarea name="alamat" class="form-control" rows="3" 
                                            placeholder="Masukkan alamat lengkap"><?= esc($customer['alamat'] ?? '') ?></textarea>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Kota/Kabupaten</label>
                                            <input type="text" name="kota" class="form-control" 
                                                value="<?= esc($customer['kota'] ?? '') ?>" 
                                                placeholder="Masukkan kota">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Kode Pos</label>
                                            <input type="text" name="kode_pos" class="form-control" 
                                                value="<?= esc($customer['kode_pos'] ?? '') ?>" 
                                                placeholder="Masukkan kode pos">
                                        </div>
                                    </div>
                                </div>
                                
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Simpan Alamat
                                </button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Logout Modal -->
<div class="modal fade" id="logoutModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Konfirmasi Logout</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin keluar dari akun?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <a href="<?= base_url('customer/logout') ?>" class="btn btn-danger">Ya, Logout</a>
            </div>
        </div>
    </div>
</div>

<script>
// Tab switching functionality
document.querySelectorAll('.menu-link').forEach(link => {
    link.addEventListener('click', function(e) {
        e.preventDefault();
        
        const tabId = this.getAttribute('data-tab');
        if (!tabId) return;
        
        // Remove active class from all menu links
        document.querySelectorAll('.menu-link').forEach(l => l.classList.remove('active'));
        
        // Add active class to clicked link
        this.classList.add('active');
        
        // Hide all tab contents
        document.querySelectorAll('.tab-content').forEach(content => {
            content.classList.remove('active');
        });
        
        // Show selected tab content
        document.getElementById(tabId).classList.add('active');
    });
});

// Photo preview functionality
document.getElementById('photoInput').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('photoPreview').src = e.target.result;
        };
        reader.readAsDataURL(file);
    }
});

// Show logout modal
function showLogoutModal() {
    const logoutModal = new bootstrap.Modal(document.getElementById('logoutModal'));
    logoutModal.show();
}
</script>
<?= $this->endSection() ?>