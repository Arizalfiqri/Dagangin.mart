<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?= $title ?> | Dagangin.Mart</title>
    <link rel="shortcut icon" href="<?= base_url('image/logo_toko_online.png') ?>" type="image/x-icon">

    <!-- Chart JS -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />

    <!-- GFont DM Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap" rel="stylesheet">
    
    <style>
        * {
            box-sizing: border-box;
        }
        
        body {
            margin: 0;
            font-family: 'DM Sans', sans-serif;
            height: 100vh;
            overflow: hidden;
            background-color: #f8fafc;
        }

        .wrapper {
            display: flex;
            height: 100vh;
        }

        .main {
            flex: 1;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        .content {
            flex: 1;
            overflow-y: auto;
            padding: 30px;
            background-color: #f8fafc;
        }

        .content h2 {
            margin-bottom: 20px;
            color: #1e293b;
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            background-color: #ffffff;
            margin: 5% auto;
            padding: 0;
            border: none;
            border-radius: 12px;
            width: 90%;
            max-width: 500px;
            max-height: 80vh;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .modal-header {
            padding: 20px 24px 16px;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-header h3 {
            margin: 0;
            color: #1e293b;
            font-size: 18px;
            font-weight: 600;
        }

        .close {
            color: #64748b;
            font-size: 24px;
            font-weight: 400;
            cursor: pointer;
            border: none;
            background: none;
            padding: 0;
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .close:hover {
            color: #ef4444;
        }

        .modal-body {
            padding: 20px 24px;
            max-height: 60vh;
            overflow-y: auto;
        }

        .user-info {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .user-info-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 0;
            border-bottom: 1px solid #f1f5f9;
        }

        .user-info-item:last-child {
            border-bottom: none;
        }

        .user-info-item i {
            color: #64748b;
            width: 20px;
            text-align: center;
        }

        .user-info-item .label {
            font-weight: 500;
            color: #475569;
            min-width: 80px;
        }

        .user-info-item .value {
            color: #1e293b;
            flex: 1;
        }

        .logout-btn {
            background-color: #ef4444;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 500;
            margin-top: 16px;
            width: 100%;
            transition: background-color 0.2s;
        }

        .logout-btn:hover {
            background-color: #dc2626;
        }

        .message-list {
            max-height: 400px;
            overflow-y: auto;
        }

        .message-item {
            padding: 16px;
            border-bottom: 1px solid #f1f5f9;
            display: flex;
            align-items: flex-start;
            gap: 12px;
            transition: background-color 0.2s;
        }

        .message-item:hover {
            background-color: #f8fafc;
        }

        .message-item:last-child {
            border-bottom: none;
        }

        .message-icon {
            color: #3b82f6;
            margin-top: 2px;
            font-size: 16px;
        }

        .message-content {
            flex: 1;
        }

        .message-title {
            font-weight: 600;
            color: #1e293b;
            font-size: 14px;
            margin-bottom: 4px;
        }

        .message-text {
            color: #64748b;
            font-size: 13px;
            line-height: 1.4;
            margin-bottom: 8px;
        }

        .message-status {
            margin: 4px 0;
        }

        .status-badge {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .status-dikemas {
            background-color: #fef3c7;
            color: #d97706;
        }

        .status-pengiriman {
            background-color: #dbeafe;
            color: #2563eb;
        }

        .status-selesai {
            background-color: #d1fae5;
            color: #059669;
        }

        .status-retur {
            background-color: #fee2e2;
            color: #dc2626;
        }

        .status-default {
            background-color: #f3f4f6;
            color: #6b7280;
        }

        .no-messages {
            text-align: center;
            color: #64748b;
            padding: 40px 20px;
            font-style: italic;
        }

        .message-time {
            color: #94a3b8;
            font-size: 12px;
            margin-top: 4px;
        }

        .refresh-btn {
            background-color: #3b82f6;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 12px;
            margin-bottom: 16px;
            transition: background-color 0.2s;
        }

        .refresh-btn:hover {
            background-color: #2563eb;
        }

        .refresh-btn:disabled {
            background-color: #94a3b8;
            cursor: not-allowed;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <?= $this->include('template/sidebar_admin') ?>

        <div class="main">
            <?= $this->include('template/navbar_admin') ?>
            <div class="content">
                <?= $this->renderSection('content') ?>
            </div>
        </div>
    </div>

    <!-- User Modal -->
    <div id="userModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Profil Admin</h3>
                <button class="close" onclick="closeModal('userModal')">&times;</button>
            </div>
            <div class="modal-body">
                <div class="user-info">
                    <div class="user-info-item">
                        <i class="fas fa-user"></i>
                        <span class="label">Username:</span>
                        <span class="value" id="userUsername">admin</span>
                    </div>
                    <div class="user-info-item">
                        <i class="fas fa-id-card"></i>
                        <span class="label">Nama:</span>
                        <span class="value" id="userFullName">Administrator</span>
                    </div>
                    <div class="user-info-item">
                        <i class="fas fa-envelope"></i>
                        <span class="label">Email:</span>
                        <span class="value" id="userEmail">admin@dagangin.mart</span>
                    </div>
                    <div class="user-info-item">
                        <i class="fas fa-phone"></i>
                        <span class="label">No. HP:</span>
                        <span class="value" id="userPhone">081234567890</span>
                    </div>
                </div>
                <button class="logout-btn" onclick="logout()">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            </div>
        </div>
    </div>

    <!-- Messages Modal -->
    <div id="messageModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Pesanan Masuk</h3>
                <button class="close" onclick="closeModal('messageModal')">&times;</button>
            </div>
            <div class="modal-body">
                <button class="refresh-btn" onclick="refreshMessages()" id="refreshBtn">
                    <i class="fas fa-sync-alt"></i> Refresh
                </button>
                <div class="message-list" id="messageList">
                    <!-- Messages will be loaded here -->
                </div>
            </div>
        </div>
    </div>

    <script>
        // User data from PHP session
        const userData = {
            username: '<?= session()->get("username") ?? "admin" ?>',
            fullName: '<?= session()->get("nama_lengkap") ?? "Administrator" ?>',
            email: '<?= session()->get("email") ?? "admin@dagangin.mart" ?>',
            phone: '<?= session()->get("no_hp") ?? "081234567890" ?>'
        };

        // Messages data from database
        let messages = <?= json_encode($pesanan_baru ?? []) ?>;
        let lastMessageCount = messages.length;

        function openUserModal() {
            document.getElementById('userUsername').textContent = userData.username;
            document.getElementById('userFullName').textContent = userData.fullName;
            document.getElementById('userEmail').textContent = userData.email;
            document.getElementById('userPhone').textContent = userData.phone;
            document.getElementById('userModal').style.display = 'block';
        }

        function openMessageModal() {
            loadMessages();
            document.getElementById('messageModal').style.display = 'block';
        }

        function closeModal(modalId) {
            document.getElementById(modalId).style.display = 'none';
        }

        function loadMessages() {
            const messageList = document.getElementById('messageList');
            
            if (messages.length === 0) {
                messageList.innerHTML = '<div class="no-messages"><i class="fas fa-inbox"></i><br>Tidak ada pesanan baru</div>';
                return;
            }

            let html = '';
            
            messages.forEach(message => {
                const statusBadge = getStatusBadge(message.status);
                const timeAgo = getTimeAgo(message.tanggal);
                
                html += `
                    <div class="message-item">
                        <i class="fas fa-shopping-cart message-icon"></i>
                        <div class="message-content">
                            <div class="message-title">Pesanan #${message.order_id}</div>
                            <div class="message-text">Customer: ${message.customer_id}</div>
                            <div class="message-text">Total: Rp ${formatCurrency(message.total)}</div>
                            <div class="message-status">${statusBadge}</div>
                            <div class="message-time">${timeAgo}</div>
                        </div>
                    </div>
                `;
            });
            
            messageList.innerHTML = html;
        }

        function getStatusBadge(status) {
            const badges = {
                'Dikemas': '<span class="status-badge status-dikemas">Dikemas</span>',
                'Pengiriman': '<span class="status-badge status-pengiriman">Pengiriman</span>',
                'Selesai': '<span class="status-badge status-selesai">Selesai</span>',
                'Retur': '<span class="status-badge status-retur">Retur</span>'
            };
            return badges[status] || '<span class="status-badge status-default">' + status + '</span>';
        }

        function formatCurrency(amount) {
            return new Intl.NumberFormat('id-ID').format(amount);
        }

        function getTimeAgo(timestamp) {
            const now = new Date();
            const messageTime = new Date(timestamp);
            const diffInSeconds = Math.floor((now - messageTime) / 1000);
            
            if (diffInSeconds < 60) return diffInSeconds + ' detik yang lalu';
            if (diffInSeconds < 3600) return Math.floor(diffInSeconds / 60) + ' menit yang lalu';
            if (diffInSeconds < 86400) return Math.floor(diffInSeconds / 3600) + ' jam yang lalu';
            return Math.floor(diffInSeconds / 86400) + ' hari yang lalu';
        }

        function updateMessageCount() {
            const notifElement = document.querySelector('.notif');
            const count = messages.length;
            
            if (notifElement) {
                if (count > 0) {
                    notifElement.textContent = count > 99 ? '99+' : count.toString();
                    notifElement.style.display = 'block';
                } else {
                    notifElement.style.display = 'none';
                }
            }
        }

        function refreshMessages() {
            const refreshBtn = document.getElementById('refreshBtn');
            refreshBtn.disabled = true;
            refreshBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Loading...';
            
            fetch('<?= base_url("admin/get-new-orders") ?>')
                .then(response => response.json())
                .then(data => {
                    messages = data;
                    loadMessages();
                    updateMessageCount();
                    
                    // Show notification if new messages
                    if (data.length > lastMessageCount) {
                        showNotification('Ada pesanan baru masuk!');
                    }
                    lastMessageCount = data.length;
                })
                .catch(error => {
                    console.log('Error refreshing messages:', error);
                    showNotification('Gagal memuat pesanan baru', 'error');
                })
                .finally(() => {
                    refreshBtn.disabled = false;
                    refreshBtn.innerHTML = '<i class="fas fa-sync-alt"></i> Refresh';
                });
        }

        function showNotification(message, type = 'success') {
            // Simple notification - you can enhance this with toast libraries
            const notification = document.createElement('div');
            notification.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                padding: 12px 20px;
                background: ${type === 'error' ? '#ef4444' : '#10b981'};
                color: white;
                border-radius: 8px;
                z-index: 9999;
                font-size: 14px;
                box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            `;
            notification.textContent = message;
            document.body.appendChild(notification);
            
            setTimeout(() => {
                notification.remove();
            }, 3000);
        }

        function logout() {
            if (confirm('Apakah Anda yakin ingin keluar?')) {
                window.location.href = '<?= base_url("admin/logout") ?>';
            }
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            const userModal = document.getElementById('userModal');
            const messageModal = document.getElementById('messageModal');
            
            if (event.target === userModal) {
                userModal.style.display = 'none';
            }
            if (event.target === messageModal) {
                messageModal.style.display = 'none';
            }
        }

        // Auto-refresh messages every 60 seconds (tidak terlalu sering agar tidak berat)
        setInterval(function() {
            fetch('<?= base_url("admin/get-new-orders") ?>')
                .then(response => response.json())
                .then(data => {
                    const oldCount = messages.length;
                    messages = data;
                    updateMessageCount();
                    
                    // Show notification if new messages
                    if (data.length > oldCount) {
                        showNotification(`${data.length - oldCount} pesanan baru masuk!`);
                    }
                })
                .catch(error => console.log('Error auto-refreshing messages:', error));
        }, 60000); // 60 detik

        // Initialize message count on page load
        document.addEventListener('DOMContentLoaded', function() {
            updateMessageCount();
        });
    </script>

</body>

</html>