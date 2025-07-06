<!-- navbar_admin.php -->
<div class="navbar">
    <div class="navbar-icons">
        <div class="icon" onclick="openMessageModal()" title="Pesan">
            <i class="fa-solid fa-envelope"></i>
            <span class="notif">0</span>
        </div>
        <div class="icon" onclick="openUserModal()" title="Profil">
            <i class="fa-solid fa-user"></i>
        </div>
    </div>
</div>

<style>
.navbar {
    background: linear-gradient(135deg, #1e40af 0%, #1290c2 100%);
    min-height: 64px;
    display: flex;
    align-items: center;
    justify-content: flex-end;
    padding: 0 24px;
    color: #ffffff;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    position: sticky;
    z-index: 50;
    top: 0;
    flex-shrink: 0;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

.navbar-icons {
    display: flex;
    align-items: center;
    gap: 16px;
}

.navbar .icon {
    position: relative;
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.2s ease;
    background: rgba(255, 255, 255, 0.1);
}

.navbar .icon:hover {
    background: rgba(255, 255, 255, 0.2);
    transform: translateY(-1px);
}

.navbar .icon i {
    font-size: 18px;
    color: #ffffff;
}

.navbar .icon .notif {
    position: absolute;
    top: -4px;
    right: -4px;
    background: #ef4444;
    color: white;
    border-radius: 50%;
    font-size: 11px;
    font-weight: 600;
    padding: 2px 6px;
    min-width: 18px;
    height: 18px;
    display: flex;
    align-items: center;
    justify-content: center;
    border: 2px solid white;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}
</style>