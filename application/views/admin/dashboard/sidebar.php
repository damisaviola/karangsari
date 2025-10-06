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
            <div class="theme-toggle d-flex gap-2  align-items-center mt-2">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true"
                    role="img" class="iconify iconify--system-uicons" width="20" height="20"
                    preserveAspectRatio="xMidYMid meet" viewBox="0 0 21 21">
                    <g fill="none" fill-rule="evenodd" stroke="currentColor" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path
                            d="M10.5 14.5c2.219 0 4-1.763 4-3.982a4.003 4.003 0 0 0-4-4.018c-2.219 0-4 1.781-4 4c0 2.219 1.781 4 4 4zM4.136 4.136L5.55 5.55m9.9 9.9l1.414 1.414M1.5 10.5h2m14 0h2M4.135 16.863L5.55 15.45m9.899-9.9l1.414-1.415M10.5 19.5v-2m0-14v-2"
                            opacity=".3"></path>
                        <g transform="translate(-210 -1)">
                            <path d="M220.5 2.5v2m6.5.5l-1.5 1.5"></path>
                            <circle cx="220.5" cy="11.5" r="4"></circle>
                            <path d="m214 5l1.5 1.5m5 14v-2m6.5-.5l-1.5-1.5M214 18l1.5-1.5m-4-5h2m14 0h2"></path>
                        </g>
                    </g>
                </svg>
                <div class="form-check form-switch fs-6">
                    <input class="form-check-input  me-0" type="checkbox" id="toggle-dark" style="cursor: pointer">
                    <label class="form-check-label"></label>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true"
                    role="img" class="iconify iconify--mdi" width="20" height="20" preserveAspectRatio="xMidYMid meet"
                    viewBox="0 0 24 24">
                    <path fill="currentColor"
                        d="m17.75 4.09l-2.53 1.94l.91 3.06l-2.63-1.81l-2.63 1.81l.91-3.06l-2.53-1.94L12.44 4l1.06-3l1.06 3l3.19.09m3.5 6.91l-1.64 1.25l.59 1.98l-1.7-1.17l-1.7 1.17l.59-1.98L15.75 11l2.06-.05L18.5 9l.69 1.95l2.06.05m-2.28 4.95c.83-.08 1.72 1.1 1.19 1.85c-.32.45-.66.87-1.08 1.27C15.17 23 8.84 23 4.94 19.07c-3.91-3.9-3.91-10.24 0-14.14c.4-.4.82-.76 1.27-1.08c.75-.53 1.93.36 1.85 1.19c-.27 2.86.69 5.83 2.89 8.02a9.96 9.96 0 0 0 8.02 2.89m-1.64 2.02a12.08 12.08 0 0 1-7.8-3.47c-2.17-2.19-3.33-5-3.49-7.82c-2.81 3.14-2.7 7.96.31 10.98c3.02 3.01 7.84 3.12 10.98.31Z">
                    </path>
                </svg>
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

            <li class="sidebar-item <?= ($this->uri->uri_string() == 'admin/penghuni' || $this->uri->uri_string() == 'admin/kamar/tambah_kamarrr') ? 'active' : '' ?>">
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

            <li class="sidebar-item <?= ($this->uri->uri_string() == 'admin/notifikasi') ? 'active' : '' ?>">
                <a href="<?= site_url('admin/notifikasi') ?>" class="sidebar-link">
                    <i class="bi bi-bell-fill"></i>
                    <span>Notifikasi</span>
                </a>
            </li>


            <li class="sidebar-item <?= ($this->uri->uri_string() == 'admin/pengumuman') ? 'active' : '' ?>">
                <a href="<?= site_url('admin/pengumuman') ?>" class="sidebar-link">
                    <i class="bi bi-megaphone-fill"></i>
                    <span>Pengumuman</span>
                </a>
            </li>


            <li class="sidebar-item <?= ($this->uri->uri_string() == 'admin/backup') ? 'active' : '' ?>">
                <a href="<?= site_url('admin/backup') ?>" class="sidebar-link">
                    <i class="bi bi-hdd-stack-fill"></i>
                    <span>Backup Data</span>
                </a>
            </li>


            <li class="sidebar-item <?= ($this->uri->uri_string() == 'admin/inventory') ? 'active' : '' ?>">
                    <a href="<?= site_url('admin/inventory') ?>" class="sidebar-link">
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





