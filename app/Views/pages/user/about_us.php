<?= $this->extend('layout/base_user') ?>

<?= $this->section('style') ?>
<style>
    :root {
        --primary-color: #4a6bff;
        --secondary-color: #f8f9fa;
        --accent-color: #ff6b6b;
        --dark-color: #343a40;
        --light-color: #ffffff;
    }
    
    .about-hero {
        background: linear-gradient(135deg, var(--primary-color), #6c5ce7);
        color: white;
        padding: 5rem 0;
        margin-bottom: 3rem;
    }
    
    .team-section {
        padding: 4rem 0;
    }
    
    .team-member-card {
        border: none;
        border-radius: 10px;
        transition: all 0.3s ease;
        padding: 2rem 1rem;
        text-align: center;
        margin-bottom: 2rem;
        background-color: white;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    }
    
    .team-member-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.1);
    }
    
    .team-icon {
        width: 100px;
        height: 100px;
        margin: 0 auto 1.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, var(--primary-color), #6c5ce7);
        color: white;
        border-radius: 50%;
        font-size: 2.5rem;
    }
    
    .team-member-name {
        font-weight: 600;
        margin-bottom: 0.5rem;
        color: var(--dark-color);
    }
    
    .team-member-position {
        color: var(--primary-color);
        font-size: 0.9rem;
        margin-bottom: 1rem;
    }
    
    .role-badge {
        display: inline-block;
        padding: 0.25rem 0.75rem;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 600;
        margin: 0.25rem;
    }
    
    .badge-pm {
        background-color: #4a6bff20;
        color: var(--primary-color);
    }
    
    .badge-dev {
        background-color: #28a74520;
        color: #28a745;
    }
    
    .badge-design {
        background-color: #ffc10720;
        color: #ffc107;
    }
    
    .badge-analysis {
        background-color: #17a2b820;
        color: #17a2b8;
    }
    
    .badge-testing {
        background-color: #dc354520;
        color: #dc3545;
    }
    
    .badge-docs {
        background-color: #6f42c120;
        color: #6f42c1;
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- Hero Section -->
<section class="about-hero">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="display-4 fw-bold mb-4">Tentang Dagangin.Mart</h1>
                <p class="lead">Solusi belanja kebutuhan sehari-hari yang praktis, cepat, dan terpercaya untuk masyarakat modern.</p>
                <p>Dagangin.Mart hadir untuk memudahkan hidup Anda dengan menyediakan segala kebutuhan dalam genggaman.</p>
            </div>
            <div class="col-lg-6">
                <div class="team-icon">
                    <i class="fas fa-store-alt"></i>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Team Section -->
<section class="team-section">
    <div class="container">
        <h2 class="text-center fw-bold mb-5">Tim Kami</h2>
        <div class="row">
            <?php foreach ($team_members as $member): ?>
            <div class="col-md-4 col-lg-4">
                <div class="team-member-card">
                    <div class="team-icon">
                        <i class="fas <?= $member['icon'] ?>"></i>
                    </div>
                    <h3 class="team-member-name"><?= $member['name'] ?></h3>
                    <p class="team-member-position"><?= $member['position'] ?></p>
                    <div class="team-roles">
                        <?php if (in_array('pm', $member['roles'])): ?>
                            <span class="role-badge badge-pm">Project Manager</span>
                        <?php endif; ?>
                        <?php if (in_array('dev', $member['roles'])): ?>
                            <span class="role-badge badge-dev">Developer</span>
                        <?php endif; ?>
                        <?php if (in_array('design', $member['roles'])): ?>
                            <span class="role-badge badge-design">Designer</span>
                        <?php endif; ?>
                        <?php if (in_array('analysis', $member['roles'])): ?>
                            <span class="role-badge badge-analysis">Analyst</span>
                        <?php endif; ?>
                        <?php if (in_array('testing', $member['roles'])): ?>
                            <span class="role-badge badge-testing">Tester</span>
                        <?php endif; ?>
                        <?php if (in_array('docs', $member['roles'])): ?>
                            <span class="role-badge badge-docs">Dokumentasi</span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ... (section lainnya tetap sama) ... -->
<?= $this->endSection() ?>