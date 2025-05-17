<div class="sidebar sidebar-style-2" data-background-color="dark2">
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <div class="user">
                <div class="avatar-sm float-left mr-2">
                    <img src="{{ asset('be/assets/img/profile.jpg') }}" alt="..." class="avatar-img rounded-circle">
                </div>
                <div class="info">
                    <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                        <span>
                            {{ Auth::user()->name }}
                            <span class="user-level">{{ ucfirst(Auth::user()->jabatan) }}</span>
                            <span class="caret"></span>
                        </span>
                    </a>
                    <div class="clearfix"></div>
                    <div class="collapse in" id="collapseExample">
                        <ul class="nav">
                            <li>
                                <a href="#profile">
                                    <span class="link-collapse">My Profile</span>
                                </a>
                            </li>
                            <li>
                                <a href="#edit">
                                    <span class="link-collapse">Edit Profile</span>
                                </a>
                            </li>
                            <li>
                                <a href="#settings">
                                    <span class="link-collapse">Settings</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <ul class="nav nav-primary flex-column" id="sidebarMenu">
                <li class="nav-item active">
                    <a href="#" class="sidebar-link" data-content="dashboard">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <!-- User menu with submenu -->
                <li class="nav-item">
                    <a href="#submenuUser" class="sidebar-link" data-toggle="collapse" aria-expanded="false">
                        <i class="fas fa-user"></i>
                        <p>User</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="submenuUser">
                        <ul class="nav flex-column ms-3">
                            <li class="nav-item">
                                <a href="#" class="sidebar-link" data-content="management-user">
                                    <i class="fas fa-users"></i>
                                    <span>Management User</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" data-target="content-management-pelanggan">
                                    <i class="fas fa-user-friends"></i>
                                    <span>User Pelanggan</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a href="#" class="sidebar-link" data-content="cek-produk">
                        <i class="fas fa-box"></i>
                        <p>Cek Produk</p>
                    </a>
                </li>
                <!-- Tambah Obat sebagai menu utama, bukan submenu -->
                <li class="nav-item">
                    <a href="#" class="sidebar-link" data-content="tambah-obat">
                        <i class="fas fa-pills"></i>
                        <p>Tambah Obat</p>
                    </a>
                </li>
                <!-- Menu Obat dengan submenu (tanpa tambah obat) -->
                <li class="nav-item">
                    <a href="#submenuObat" class="sidebar-link" data-toggle="collapse" aria-expanded="false">
                        <i class="fas fa-capsules"></i>
                        <p>Obat</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="submenuObat">
                        <ul class="nav flex-column ms-3">
                            <li class="nav-item">
                                <a href="#" class="sidebar-link" data-content="jenis-obat">
                                    <i class="fas fa-tags"></i>
                                    <span>Jenis Obat</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="sidebar-link" data-content="tambah-produk">
                                    <i class="fas fa-plus-circle"></i>
                                    <span>Tambah Produk</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="sidebar-link" data-content="distributor">
                                    <i class="fas fa-truck"></i>
                                    <span>Distributor</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a href="#" class="sidebar-link" data-content="apply-pembelian">
                        <i class="fas fa-shopping-cart"></i>
                        <p>Apply Pembelian</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="sidebar-link" data-content="pengiriman">
                        <i class="fas fa-shipping-fast"></i>
                        <p>Pengiriman</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="sidebar-link" data-content="status-order">
                        <i class="fas fa-tasks"></i>
                        <p>Status Order</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="sidebar-link" data-content="laporan-keuangan">
                        <i class="fas fa-file-invoice-dollar"></i>
                        <p>Laporan Keuangan</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
@push('js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.sidebar-link').forEach(function(link) {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                // Remove active from all nav-item
                document.querySelectorAll('.nav-item').forEach(function(item) {
                    item.classList.remove('active');
                });
                // Add active to clicked nav-item
                this.parentElement.classList.add('active');
                // Hide all content
                document.querySelectorAll('#main-content > div').forEach(function(content) {
                    content.classList.add('d-none');
                });
                // Show selected content
                var contentId = 'content-' + this.getAttribute('data-content');
                var contentDiv = document.getElementById(contentId);
                if(contentDiv) contentDiv.classList.remove('d-none');
                return false;
            });
        });
    });
</script>
@endpush