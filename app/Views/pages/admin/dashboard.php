<?= $this->extend('layout/base_admin') ?>
<?= $this->section('content') ?>

<div class="dashboard-container">
    <h2 class="dashboard-title">Dashboard Admin</h2>
    
    <!-- Statistics Cards -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon">📦</div>
            <div class="stat-content">
                <h3><?= $totalProducts ?? 0 ?></h3>
                <p>Total Produk</p>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon">📋</div>
            <div class="stat-content">
                <h3><?= $totalCategories ?? 0 ?></h3>
                <p>Kategori</p>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon">👥</div>
            <div class="stat-content">
                <h3><?= $totalCustomers ?? 0 ?></h3>
                <p>Pelanggan</p>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon">🛒</div>
            <div class="stat-content">
                <h3><?= $totalOrders ?? 0 ?></h3>
                <p>Total Pesanan</p>
            </div>
        </div>
    </div>

    <!-- Charts Grid -->
    <div class="charts-grid">
        <!-- Products by Category Chart -->
        <div class="chart-container">
            <h3>Produk per Kategori</h3>
            <canvas id="categoryChart"></canvas>
        </div>

        <!-- Orders by Status Chart -->
        <div class="chart-container">
            <h3>Status Pesanan</h3>
            <canvas id="statusChart"></canvas>
        </div>

        <!-- Monthly Sales Chart -->
        <div class="chart-container full-width">
            <h3>Penjualan Bulanan (12 Bulan Terakhir)</h3>
            <canvas id="salesChart"></canvas>
        </div>

        <!-- Stock Status Chart -->
        <div class="chart-container">
            <h3>Status Stok Produk</h3>
            <canvas id="stockChart"></canvas>
        </div>
    </div>
</div>

<style>
.dashboard-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
}

.dashboard-title {
    color: #2c3e50;
    margin-bottom: 30px;
    font-size: 2.5rem;
    font-weight: 600;
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
    margin-bottom: 40px;
}

.stat-card {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 25px;
    border-radius: 15px;
    display: flex;
    align-items: center;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    transition: transform 0.3s ease;
}

.stat-card:hover {
    transform: translateY(-5px);
}

.stat-icon {
    font-size: 3rem;
    margin-right: 20px;
}

.stat-content h3 {
    font-size: 2.5rem;
    margin: 0;
    font-weight: 700;
}

.stat-content p {
    margin: 5px 0 0 0;
    opacity: 0.9;
    font-size: 1.1rem;
}

.charts-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
    gap: 30px;
}

.chart-container {
    background: white;
    padding: 25px;
    border-radius: 15px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    border: 1px solid #e0e6ed;
}

.chart-container.full-width {
    grid-column: 1 / -1;
}

.chart-container h3 {
    color: #2c3e50;
    margin-bottom: 20px;
    font-size: 1.4rem;
    font-weight: 600;
    text-align: center;
}

canvas {
    max-width: 100%;
    height: 300px !important;
}

@media (max-width: 768px) {
    .stats-grid {
        grid-template-columns: 1fr;
    }
    
    .charts-grid {
        grid-template-columns: 1fr;
    }
    
    .chart-container {
        min-width: unset;
    }
}
</style>

<script>
// Chart.js color schemes
const colors = {
    primary: ['#667eea', '#764ba2', '#f093fb', '#f5576c', '#4facfe', '#00f2fe'],
    success: '#10b981',
    warning: '#f59e0b',
    danger: '#ef4444',
    info: '#3b82f6'
};

// Products by Category Chart
const categoryData = <?= json_encode($productsByCategory ?? []) ?>;
const categoryLabels = categoryData.map(item => item.kategori);
const categoryValues = categoryData.map(item => item.jumlah_produk);

const categoryCtx = document.getElementById('categoryChart');
new Chart(categoryCtx, {
    type: 'doughnut',
    data: {
        labels: categoryLabels,
        datasets: [{
            data: categoryValues,
            backgroundColor: colors.primary,
            borderWidth: 2,
            borderColor: '#ffffff'
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'bottom',
                labels: {
                    padding: 20,
                    usePointStyle: true
                }
            }
        }
    }
});

// Orders by Status Chart
const statusData = <?= json_encode($ordersByStatus ?? []) ?>;
const statusLabels = statusData.map(item => {
    const statusMap = {
        'Dikemas': 'Dikemas',
        'Pengiriman': 'Pengiriman',
        'Selesai': 'Selesai',
        'Retur': 'Retur'
    };
    return statusMap[item.status] || item.status;
});
const statusValues = statusData.map(item => item.jumlah);
const statusColors = statusLabels.map(label => {
    switch(label) {
        case 'Dikemas': return colors.warning;
        case 'Pengiriman': return colors.info;
        case 'Selesai': return colors.success;
        case 'Retur': return colors.danger;
        default: return colors.primary[0];
    }
});

const statusCtx = document.getElementById('statusChart');
new Chart(statusCtx, {
    type: 'bar',
    data: {
        labels: statusLabels,
        datasets: [{
            label: 'Jumlah Pesanan',
            data: statusValues,
            backgroundColor: statusColors,
            borderRadius: 8,
            borderSkipped: false
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: false
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    stepSize: 1
                }
            }
        }
    }
});

// Monthly Sales Chart
const salesData = <?= json_encode($monthlySales ?? []) ?>;
const salesLabels = salesData.map(item => {
    const date = new Date(item.bulan + '-01');
    return date.toLocaleDateString('id-ID', { month: 'short', year: 'numeric' });
});
const salesOrderCount = salesData.map(item => item.jumlah_pesanan);
const salesTotalAmount = salesData.map(item => parseFloat(item.total_penjualan || 0));

const salesCtx = document.getElementById('salesChart');
new Chart(salesCtx, {
    type: 'line',
    data: {
        labels: salesLabels,
        datasets: [
            {
                label: 'Jumlah Pesanan',
                data: salesOrderCount,
                borderColor: colors.primary[0],
                backgroundColor: colors.primary[0] + '20',
                tension: 0.4,
                fill: true,
                yAxisID: 'y'
            },
            {
                label: 'Total Penjualan (Rp)',
                data: salesTotalAmount,
                borderColor: colors.primary[1],
                backgroundColor: colors.primary[1] + '20',
                tension: 0.4,
                fill: true,
                yAxisID: 'y1'
            }
        ]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        interaction: {
            mode: 'index',
            intersect: false,
        },
        plugins: {
            legend: {
                position: 'top'
            }
        },
        scales: {
            x: {
                display: true,
                title: {
                    display: true,
                    text: 'Bulan'
                }
            },
            y: {
                type: 'linear',
                display: true,
                position: 'left',
                title: {
                    display: true,
                    text: 'Jumlah Pesanan'
                }
            },
            y1: {
                type: 'linear',
                display: true,
                position: 'right',
                title: {
                    display: true,
                    text: 'Total Penjualan (Rp)'
                },
                grid: {
                    drawOnChartArea: false,
                },
            }
        }
    }
});

// Stock Status Chart
const stockData = <?= json_encode($stockStatus ?? []) ?>;
const stockLabels = stockData.map(item => item.status_stok);
const stockValues = stockData.map(item => item.jumlah_produk);
const stockColors = stockLabels.map(label => {
    switch(label) {
        case 'Habis': return colors.danger;
        case 'Stok Rendah': return colors.warning;
        case 'Stok Normal': return colors.info;
        case 'Stok Banyak': return colors.success;
        default: return colors.primary[0];
    }
});

const stockCtx = document.getElementById('stockChart');
new Chart(stockCtx, {
    type: 'pie',
    data: {
        labels: stockLabels,
        datasets: [{
            data: stockValues,
            backgroundColor: stockColors,
            borderWidth: 2,
            borderColor: '#ffffff'
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'bottom',
                labels: {
                    padding: 20,
                    usePointStyle: true
                }
            }
        }
    }
});
</script>

<?= $this->endSection() ?>