<?= $this->extend('layout/base_user') ?>

<?= $this->section('style') ?>
<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
    background-color: #f8fafc;
    color: #1a1a1a;
    line-height: 1.5;
}

.container {
    max-width: 800px;
    margin: 0 auto;
    padding: 0 1rem;
}

.success-header {
    text-align: center;
    padding: 3rem 0;
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    color: white;
    margin-bottom: 2rem;
}

.success-icon {
    font-size: 4rem;
    margin-bottom: 1rem;
    color: #d1fae5;
}

.success-title {
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
}

.success-subtitle {
    font-size: 1.1rem;
    opacity: 0.9;
}

.order-card {
    background: white;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    border: 1px solid #e5e7eb;
    margin-bottom: 2rem;
}

.card-header {
    padding: 1.5rem;
    background: #f9fafb;
    border-bottom: 1px solid #e5e7eb;
    border-radius: 12px 12px 0 0;
}

.card-title {
    font-size: 1.25rem;
    font-weight: 700;
    color: #1f2937;
    margin-bottom: 0.5rem;
}

.order-id {
    font-size: 1.1rem;
    color: #1594ce;
    font-weight: 600;
}

.card-content {
    padding: 1.5rem;
}

.info-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1.5rem;
    margin-bottom: 2rem;
}

.info-item {
    padding: 1rem;
    background: #f8fafc;
    border-radius: 8px;
    border: 1px solid #e5e7eb;
}

.info-label {
    font-size: 0.875rem;
    color: #6b7280;
    font-weight: 500;
    margin-bottom: 0.25rem;
}

.info-value {
    font-size: 1rem;
    color: #1f2937;
    font-weight: 600;
}

.status-badge {
    display: inline-block;
    padding: 0.25rem 0.75rem;
    border-radius: 9999px;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
}

.status-dikemas {
    background: #fef3c7;
    color: #92400e;
}

.status-pending {
    background: #fde68a;
    color: #92400e;
}

.order-items {
    margin-top: 1.5rem;
}

.order-item {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1rem 0;
    border-bottom: 1px solid #f3f4f6;
}

.order-item:last-child {
    border-bottom: none;
}

.item-image {
    width: 60px;
    height: 60px;
    border-radius: 8px;
    object-fit: cover;
    background: #f3f4f6;
    flex-shrink: 0;
}

.item-details {
    flex: 1;
    min-width: 0;
}

.item-name {
    font-weight: 600;
    font-size: 1rem;
    color: #1f2937;
    margin-bottom: 0.25rem;
}

.item-category {
    color: #6b7280;
    font-size: 0.875rem;
    margin-bottom: 0.25rem;
}

.item-quantity {
    color: #6b7280;
    font-size: 0.875rem;
}

.item-price {
    text-align: right;
    flex-shrink: 0;
}

.item-unit-price {
    color: #6b7280;
    font-size: 0.875rem;
}

.item-total-price {
    font-weight: 600;
    color: #1594ce;
    font-size: 1rem;
}

.total-section {
    margin-top: 2rem;
    padding-top: 1.5rem;
    border-top: 2px solid #e5e7eb;
}

.total-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1rem 0;
    font-size: 1.5rem;
    font-weight: 800;
    color: #1594ce;
}

.action-buttons {
    display: flex;
    gap: 1rem;
    justify-content: center;
    margin-top: 2rem;
}

.btn {
    padding: 0.75rem 2rem;
    border-radius: 8px;
    font-size: 1rem;
    font-weight: 600;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
}

.btn-primary {
    background: linear-gradient(135deg, #1594ce, #0675a9);
    color: white;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(21, 148, 206, 0.3);
}

.btn-secondary {
    background: white;
    color: #374151;
    border: 1px solid #d1d5db;
}

.btn-secondary:hover {
    background: #f9fafb;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

@media (max-width: 768px) {
    .success-title {
        font-size: 1.75rem;
    }
    
    .info-grid {
        grid-template-columns: 1fr;
    }
    
    .action-buttons {
        flex-direction: column;
    }
    
    .order-item {
        gap: 0.75rem;
    }
    
    .item-image {
        width: 50px;
        height: 50px;
    }
}

@media (max-width: 480px) {
    .container {
        padding: 0 0.5rem;
    }
    
    .success-icon {
        font-size: 3rem;
    }
}
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="success-header">
    <div class="container">
        <div class="success-icon">
            <i class="fas fa-check-circle"></i>
        </div>
        <h1 class="success-title">Pesanan Berhasil!</h1>
        <p class="success-subtitle">Terima kasih atas pesanan Anda</p>
    </div>
</div>

<div class="container">
    <!-- Order Information -->
    <div class="order-card">
        <div class="card-header">
            <h3 class="card-title