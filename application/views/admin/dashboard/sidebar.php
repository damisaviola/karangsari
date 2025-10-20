<div id="chatbox-sidebar" class="chatbox-sidebar shadow-lg d-flex flex-column">

    <!-- Contacts -->
    <div class="chatbox-contacts border-bottom p-2" style="max-height: 200px; overflow-y: auto;">
        <a href="#" class="contact-item d-flex align-items-center" data-contact="Alfy">
            <img src="<?= base_url('assets/dist/assets/compiled/jpg/1.jpg') ?>" class="rounded-circle me-2" width="40" height="40">
            <div class="flex-grow-1">
                <h6 class="mb-0">Alfy</h6>
                <small class="text-success">Online</small>
            </div>
        </a>
        <a href="#" class="contact-item d-flex align-items-center" data-contact="Alfy">
            <img src="<?= base_url('assets/dist/assets/compiled/jpg/1.jpg') ?>" class="rounded-circle me-2" width="40" height="40">
            <div class="flex-grow-1">
                <h6 class="mb-0">Alfy</h6>
                <small class="text-success">Online</small>
            </div>
        </a>
        <a href="#" class="contact-item d-flex align-items-center" data-contact="Alfy">
            <img src="<?= base_url('assets/dist/assets/compiled/jpg/1.jpg') ?>" class="rounded-circle me-2" width="40" height="40">
            <div class="flex-grow-1">
                <h6 class="mb-0">Alfy</h6>
                <small class="text-success">Online</small>
            </div>
        </a>
        <a href="#" class="contact-item d-flex align-items-center" data-contact="Alfy">
            <img src="<?= base_url('assets/dist/assets/compiled/jpg/1.jpg') ?>" class="rounded-circle me-2" width="40" height="40">
            <div class="flex-grow-1">
                <h6 class="mb-0">Alfy</h6>
                <small class="text-success">Online</small>
            </div>
        </a>
        <a href="#" class="contact-item d-flex align-items-center" data-contact="Alfy">
            <img src="<?= base_url('assets/dist/assets/compiled/jpg/1.jpg') ?>" class="rounded-circle me-2" width="40" height="40">
            <div class="flex-grow-1">
                <h6 class="mb-0">Alfy</h6>
                <small class="text-success">Online</small>
            </div>
        </a>
        <a href="#" class="contact-item d-flex align-items-center" data-contact="Samantha">
            <img src="<?= base_url('assets/dist/assets/compiled/jpg/2.jpg') ?>" class="rounded-circle me-2" width="40" height="40">
            <div class="flex-grow-1">
                <h6 class="mb-0">Samantha</h6>
                <small class="text-success">Online</small>
            </div>
        </a>
        <a href="#" class="contact-item d-flex align-items-center" data-contact="John">
            <img src="<?= base_url('assets/dist/assets/compiled/jpg/3.jpg') ?>" class="rounded-circle me-2" width="40" height="40">
            <div class="flex-grow-1">
                <h6 class="mb-0">John</h6>
                <small class="text-success">Online</small>
            </div>
        </a>
    </div>

    <!-- Chat Active -->
    <div class="chatbox-active flex-grow-1 d-flex flex-column">

        <!-- Header -->
        <div class="chatbox-header d-flex justify-content-between align-items-center px-3 py-2 border-bottom">
            <div class="d-flex align-items-center">
                <img id="chat-header-img" src="<?= base_url('assets/dist/assets/compiled/jpg/1.jpg') ?>" class="rounded-circle me-2" width="48" height="48">
                <div>
                    <h6 id="chat-header-name" class="mb-0 fw-bold">Alfy</h6>
                    <small class="text-success">● Online</small>
                </div>
            </div>
            <button class="btn btn-light btn-sm rounded-circle chat-close-icon">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>

        <!-- Body -->
        <div class="chatbox-body flex-grow-1 p-3" id="chat-body">
            <div class="chat-message from-them mb-2">Hi Alfy, how can I help you?</div>
            <div class="chat-message from-me mb-2">I'm looking for the best admin dashboard template</div>
        </div>

        <!-- Footer -->
        <div class="chatbox-footer d-flex align-items-center p-3 border-top bg-white">
            <button class="btn btn-light rounded-circle me-2"><i class="bi bi-emoji-smile"></i></button>
            <label for="chatFile" class="btn btn-light rounded-circle me-2 mb-0"><i class="bi bi-paperclip"></i></label>
            <input type="file" id="chatFile" class="d-none" multiple>
            <input type="text" class="form-control rounded-pill me-2" placeholder="Type a message...">
            <button class="btn btn-primary rounded-circle"><i class="bi bi-send-fill"></i></button>
        </div>
    </div>
</div>

<style>
.chatbox-sidebar {
    position: fixed;
    top: 0;
    right: -420px;
    width: 400px;
    height: 100%;
    background: #fff;
    border-left: 1px solid #e0e0e0;
    transition: right 0.3s ease;
    z-index: 1100;
    display: flex;
    flex-direction: column;
}

.chatbox-sidebar.show {
    right: 0;
}

.chatbox-contacts input { width: 100%; } 

.chatbox-sidebar.show { right: 0; }

#contacts-container::-webkit-scrollbar {
    width: 6px;
}
#contacts-container::-webkit-scrollbar-thumb {
    background-color: rgba(0,0,0,0.2);
    border-radius: 3px;
}

#chat-messages { overflow-y:auto; flex-grow:1; }

.chatbox-body {
    flex: 1;
    overflow-y: auto;
    background: #f7f7f7;
    padding: 15px;
    transition: opacity 0.3s ease;
    opacity: 1;
}

.chat-message {
    display: inline-block;
    padding: 10px 14px;
    border-radius: 20px;
    max-width: 80%;
    font-size: 0.9rem;
    line-height: 1.4;
    transition: transform 0.3s ease, opacity 0.3s ease;
}

.from-them {
    background: #e5e5ea;
    color: #333;
    border-bottom-left-radius: 4px;
    align-self: flex-start;
    margin-right: auto;
}

.from-me {
    background: #007bff;
    color: #fff;
    border-bottom-right-radius: 4px;
    align-self: flex-end;
    margin-left: auto;
}

.contact-item {
    cursor: pointer;
    padding: 5px 10px;
    border-radius: 10px;
    transition: background 0.2s;
}
.contact-item:hover {
    background: #f0f0f0;
}

.chatbox-body.fade-out {
    opacity: 0;
    transform: translateY(10px);
}

.chatbox-body.fade-in {
    opacity: 1;
    transform: translateY(0);
}
</style>

<div id="sidebar">
            <div class="sidebar-wrapper active">
    <div class="sidebar-header position-relative">
        <div class="d-flex justify-content-between align-items-center">
            <div class="logo">
            </div>
            <div class="sidebar-toggler  x">
                <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
            </div>
        </div>
    </div>
    <div class="sidebar-menu">
        <ul class="menu">
            <li class="sidebar-title">Menu</li>
            
            <li class="sidebar-item <?= ($this->uri->uri_string() == 'admin/dashboard') ? 'active' : '' ?>">
                <a href="<?= site_url('admin/dashboard') ?>" class="sidebar-link">
                    <i class="bi bi-grid-fill"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="sidebar-item <?= ($this->uri->uri_string() == 'admin/penghuni' || $this->uri->uri_string() == 'admin/penghuni/tambah_penghuni') ? 'active' : '' ?>">
                <a href="<?= site_url('admin/penghuni') ?>" class="sidebar-link">
                    <i class="bi bi bi-people-fill"></i>
                    <span>Penghuni</span>
                </a>
            </li>
            

            <li class="sidebar-item <?= ($this->uri->uri_string() == 'admin/pemesanan') ? 'active' : '' ?>">
                <a href="<?= base_url('admin/pemesanan') ?>" class="sidebar-link">
                    <i class="bi bi-calendar-check-fill"></i>
                    <span>Pemesanan</span>
                </a>
            </li>


            <li class="sidebar-item <?= ($this->uri->uri_string() == 'admin/pembayaran') ? 'active' : '' ?>">
                <a href="<?= base_url('admin/pembayaran') ?>" class="sidebar-link">
                    <i class="bi bi-calendar-check-fill"></i>
                    <span>Pembayaran</span>
                </a>
            </li>

            <li class="sidebar-item <?= ($this->uri->uri_string() == 'admin/pembayaran/bayar_admin') ? 'active' : '' ?>">
                <a href="<?= site_url('admin/pembayaran/bayar_admin') ?>" class="sidebar-link">
                    <i class="bi bi-list-check"></i>
                    <span>Pembayaran (Admin)</span>
                </a>
            </li>



            <li class="sidebar-item <?= ($this->uri->uri_string() == 'admin/kamar' || $this->uri->uri_string() == 'admin/kamar/tambah_kamar') ? 'active' : '' ?>">
                <a href="<?= site_url('admin/kamar') ?>" class="sidebar-link">
                    <i class="bi bi-house-door-fill"></i>
                    <span>Kamar</span>
                </a>
            </li>

             <li class="sidebar-item <?= ($this->uri->uri_string() == 'admin/fasil') ? 'active' : '' ?>">
                <a href="<?= base_url('admin/pemesanan') ?>" class="sidebar-link">
                    <i class="bi bi-calendar-check-fill"></i>
                    <span>Fasilitas</span>
                </a>
            </li>


             <li class="sidebar-item <?= ($this->uri->uri_string() == 'admin/keluhan') ? 'active' : '' ?>">
                <a href="<?= site_url('admin/keluhan') ?>" class="sidebar-link">
                    <i class="bi bi-chat-dots-fill"></i>
                    <span>Keluhan</span>
                </a>
            </li>

            <li class="sidebar-item <?= ($this->uri->uri_string() == 'admin/refund') ? 'active' : '' ?>">
    <a href="<?= site_url('admin/refund') ?>" class="sidebar-link">
        <i class="bi bi-arrow-repeat"></i>
        <span>Refund</span>
    </a>
</li>



            <?php
        $this->db->where('status', 'Diproses');
        $jumlah_keluhan = $this->db->count_all_results('keluhan');

        $this->db->where('status', 'Menunggu Verifikasi');
        $jumlah_pembayaran = $this->db->count_all_results('pembayaran');

        $total_notifikasi = $jumlah_keluhan + $jumlah_pembayaran;
        ?>

        <li class="sidebar-item <?= ($this->uri->uri_string() == 'admin/notifikasi') ? 'active' : '' ?>">
        <a href="<?= site_url('admin/notifikasi') ?>" class="sidebar-link">
            <div class="d-flex justify-content-between align-items-center w-100">
            <div class="d-flex align-items-center">
                <i class="bi bi-bell-fill"></i>
                <span>Notifikasi</span>
            </div>
            <?php if ($total_notifikasi > 0): ?>
                <span class="badge bg-danger rounded-pill px-2"><?= $total_notifikasi ?></span>
            <?php endif; ?>
            </div>
        </a>
        </li>



            <li class="sidebar-item <?= ($this->uri->uri_string() == 'admin/backup') ? 'active' : '' ?>">
                <a href="<?= site_url('admin/backup') ?>" class="sidebar-link">
                    <i class="bi bi-hdd-stack-fill"></i>
                    <span>Backup Data</span>
                </a>
            </li>


            <li class="sidebar-item <?= ($this->uri->uri_string() == 'admin/pengaturan') ? 'active' : '' ?>">
                    <a href="<?= site_url('admin/pengaturan') ?>" class="sidebar-link">
                        <i class="bi bi-gear-fill"></i>
                        <span>Pengaturan</span>
                    </a>
                </li>
                


           <li class="sidebar-item">
                <a href="#" class="sidebar-link" onclick="confirmLogout(event)">
                    <i class="bi bi-door-open-fill"></i>
                    <span>Logout</span>
                </a>
            </li>


         
    </div>
</div>





