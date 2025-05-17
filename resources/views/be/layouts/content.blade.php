<div id="main-content" class="p-4" style="min-height: 100vh; background: linear-gradient(135deg,#f8fafc 60%,#e3e9f7 100%);">
    <div id="content-dashboard">
        <h2 class="mb-4 text-primary fw-bold"><i class="fas fa-home me-2"></i>Dashboard</h2>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card text-white border-0 shadow-lg" style="background: linear-gradient(135deg, #6a11cb, #2575fc); border-radius: 1rem;">
                    <div class="card-body text-center py-5">
                        <i class="fas fa-users fa-3x mb-3"></i>
                        <h5 class="card-title fw-semibold">Total Users</h5>
                        <p class="fs-1 fw-bold mb-0">120</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white border-0 shadow-lg" style="background: linear-gradient(135deg, #11998e, #38ef7d); border-radius: 1rem;">
                    <div class="card-body text-center py-5">
                        <i class="fas fa-box fa-3x mb-3"></i>
                        <h5 class="card-title fw-semibold">Produk</h5>
                        <p class="fs-1 fw-bold mb-0">350</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white border-0 shadow-lg" style="background: linear-gradient(135deg, #f7971e, #ffd200); border-radius: 1rem;">
                    <div class="card-body text-center py-5">
                        <i class="fas fa-file-invoice-dollar fa-3x mb-3"></i>
                        <h5 class="card-title fw-semibold">Pendapatan</h5>
                        <p class="fs-1 fw-bold mb-0">Rp 25jt</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="content-management-user" class="d-none">
        <h2 class="mb-4 text-info fw-bold"><i class="fas fa-users me-2"></i>Management User</h2>
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Berhasil!</strong> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="card border-0 shadow-lg" style="border-radius:1rem;">
            <div class="card-body bg-white" style="border-radius:1rem;">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <p class="mb-0 text-secondary">Kelola data user, tambah user baru, edit, atau nonaktifkan user.</p>
                    <button class="btn btn-primary rounded-pill shadow" id="btnShowAddUser"><i class="fas fa-user-plus me-1"></i>Tambah User</button>
                </div>
                <div id="addUserForm" class="mb-4" style="display:none;">
                    <form method="POST" action="{{ route('admin.users.store') }}" class="border p-3 rounded shadow-sm bg-light" id="formAddUser">
                        @csrf
                        <div class="row g-2 align-items-end">
                            <div class="col-md-3">
                                <label class="form-label">Nama</label>
                                <input type="text" name="name" class="form-control" placeholder="Nama" required>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" placeholder="Email" required>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">Jabatan</label>
                                <select name="jabatan" class="form-control" required>
                                    <option value="">Pilih Jabatan</option>
                                    <option value="admin">Admin</option>
                                    <option value="apoteker">Apoteker</option>
                                    <option value="kasir">Kasir</option>
                                    <option value="pemilik">Pemilik</option>
                                    <option value="kurir">Kurir</option>
                                    <option value="karyawan">Karyawan</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">Password</label>
                                <input type="password" name="password" id="addUserPassword" class="form-control" placeholder="Password" required minlength="8">
                                <small class="text-danger d-none" id="passwordWarning">Password minimal 8 karakter</small>
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-success btn-block w-100" id="btnAddUserSave" type="submit" disabled><i class="fas fa-save me-1"></i>Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle bg-white rounded shadow-sm">
                    <thead class="thead-light">
                        <tr>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users ?? [] as $user)
                        <tr id="user-row-{{ $user->id }}">
                            <form method="POST" action="{{ route('admin.users.update', $user->id) }}" class="edit-user-form">
                                @csrf
                                <td>
                                    <span class="user-name">{{ $user->name }}</span>
                                    <input type="text" name="name" class="form-control form-control-sm d-none" value="{{ $user->name }}" required>
                                </td>
                                <td>
                                    <span class="user-email">{{ $user->email }}</span>
                                    <input type="email" name="email" class="form-control form-control-sm d-none" value="{{ $user->email }}" required>
                                </td>
                                <td>
                                    <span class="user-role badge bg-secondary">{{ ucfirst($user->jabatan) }}</span>
                                    <select name="jabatan" class="form-control form-control-sm d-none">
                                        <option value="admin" @if($user->jabatan=='admin') selected @endif>Admin</option>
                                        <option value="apoteker" @if($user->jabatan=='apoteker') selected @endif>Apoteker</option>
                                        <option value="kasir" @if($user->jabatan=='kasir') selected @endif>Kasir</option>
                                        <option value="pemilik" @if($user->jabatan=='pemilik') selected @endif>Pemilik</option>
                                        <option value="kurir" @if($user->jabatan=='kurir') selected @endif>Kurir</option>
                                        <option value="karyawan" @if($user->jabatan=='karyawan') selected @endif>Karyawan</option>
                                    </select>
                                </td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <button type="button" class="btn btn-sm btn-warning rounded-circle btn-edit-user" title="Edit"><i class="fas fa-edit"></i></button>
                                        <button type="submit" class="btn btn-sm btn-success rounded-circle d-none btn-save-user" title="Simpan"><i class="fas fa-save"></i></button>
                                        <button type="button" class="btn btn-sm btn-secondary rounded-circle d-none btn-cancel-edit" title="Batal"><i class="fas fa-times"></i></button>
                                        <button type="button" class="btn btn-sm btn-danger rounded-circle btn-delete-user" data-username="{{ $user->name }}" data-userid="{{ $user->id }}" title="Hapus"><i class="fas fa-trash"></i></button>
                                    </div>
                                    <input type="password" name="password" class="form-control form-control-sm mt-1 d-none" placeholder="Password baru (opsional)">
                                    <small class="form-text text-muted d-none password-hint">Isi untuk mengganti password</small>
                                </td>
                            </form>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Management Pelanggan -->
    <div id="content-management-pelanggan" class="d-none">
        <h2 class="mb-4 text-info fw-bold"><i class="fas fa-user-friends me-2"></i>Management Pelanggan</h2>
        @if(session('success_pelanggan'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Berhasil!</strong> {{ session('success_pelanggan') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="card border-0 shadow-lg" style="border-radius:1rem;">
            <div class="card-body bg-white" style="border-radius:1rem;">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <p class="mb-0 text-secondary">Kelola data pelanggan, tambah pelanggan baru, edit, atau nonaktifkan pelanggan.</p>
                    <button class="btn btn-primary rounded-pill shadow" id="btnShowAddPelanggan"><i class="fas fa-user-plus me-1"></i>Tambah Pelanggan</button>
                </div>
                <div id="addPelangganForm" class="mb-4" style="display:none;">
                    <form method="POST" action="{{ route('pelanggan.store') }}" class="border p-3 rounded shadow-sm bg-light" id="formAddPelanggan">
                        @csrf
                        <div class="row g-2 align-items-end">
                            <div class="col-md-3">
                                <label class="form-label">Nama</label>
                                <input type="text" name="nama_pelanggan" class="form-control" placeholder="Nama" required>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" placeholder="Email" required>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Telepon</label>
                                <input type="text" name="no_telp" class="form-control" placeholder="Telepon">
                            </div>
                            <div class="col-md-3">
                                <button class="btn btn-success btn-block w-100" id="btnAddPelangganSave" type="submit"><i class="fas fa-save me-1"></i>Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle bg-white rounded shadow-sm">
                    <thead class="thead-light">
                        <tr>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>No. Telp</th>
                            <th>Alamat</th>
                            <th>Kota</th>
                            <th>Provinsi</th>
                            <th>Kode Pos</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pelanggan ?? [] as $p)
                        <tr id="pelanggan-row-{{ $p->id }}">
                            <form method="POST" action="{{ route('pelanggan.update', $p->id) }}" class="edit-pelanggan-form">
                                @csrf
                                <td>
                                    <span class="pelanggan-nama">{{ $p->nama_pelanggan }}</span>
                                    <input type="text" name="nama_pelanggan" class="form-control form-control-sm d-none" value="{{ $p->nama_pelanggan }}" required>
                                </td>
                                <td>
                                    <span class="pelanggan-email">{{ $p->email }}</span>
                                    <input type="email" name="email" class="form-control form-control-sm d-none" value="{{ $p->email }}" required>
                                </td>
                                <td>
                                    <span class="pelanggan-telepon">{{ $p->no_telp }}</span>
                                    <input type="text" name="no_telp" class="form-control form-control-sm d-none" value="{{ $p->no_telp }}">
                                </td>
                                <td>
                                    <span class="pelanggan-alamat">{{ $p->alamat1 }}</span>
                                    <input type="text" name="alamat1" class="form-control form-control-sm d-none" value="{{ $p->alamat1 }}">
                                </td>
                                <td>
                                    <span class="pelanggan-kota">{{ $p->kota1 }}</span>
                                    <input type="text" name="kota1" class="form-control form-control-sm d-none" value="{{ $p->kota1 }}">
                                </td>
                                <td>
                                    <span class="pelanggan-provinsi">{{ $p->propinsi1 }}</span>
                                    <input type="text" name="propinsi1" class="form-control form-control-sm d-none" value="{{ $p->propinsi1 }}">
                                </td>
                                <td>
                                    <span class="pelanggan-kodepos">{{ $p->kodepos1 }}</span>
                                    <input type="text" name="kodepos1" class="form-control form-control-sm d-none" value="{{ $p->kodepos1 }}">
                                </td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <button type="button" class="btn btn-sm btn-warning rounded-circle btn-edit-pelanggan" title="Edit"><i class="fas fa-edit"></i></button>
                                        <button type="submit" class="btn btn-sm btn-success rounded-circle d-none btn-save-pelanggan" title="Simpan"><i class="fas fa-save"></i></button>
                                        <button type="button" class="btn btn-sm btn-secondary rounded-circle d-none btn-cancel-edit-pelanggan" title="Batal"><i class="fas fa-times"></i></button>
                                        <button type="button" class="btn btn-sm btn-danger rounded-circle btn-delete-pelanggan" data-nama="{{ $p->nama_pelanggan }}" data-pelangganid="{{ $p->id }}" title="Hapus"><i class="fas fa-trash"></i></button>
                                    </div>
                                </td>
                            </form>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted">Belum ada data pelanggan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
    <div id="content-cek-produk" class="d-none">
        <h2 class="mb-4"><i class="fas fa-box"></i> Cek Produk</h2>
        <div class="card shadow border-0">
            <div class="card-body">
                <p>Lihat dan cek stok produk yang tersedia di apotek.</p>
                <table class="table table-striped bg-white">
                    <thead>
                        <tr>
                            <th>Nama Produk</th>
                            <th>Stok</th>
                            <th>Harga</th>
                            <th>Kategori</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Paracetamol</td>
                            <td>120</td>
                            <td>Rp 5.000</td>
                            <td>Obat Bebas</td>
                        </tr>
                        <tr>
                            <td>Amoxicillin</td>
                            <td>80</td>
                            <td>Rp 12.000</td>
                            <td>Antibiotik</td>
                        </tr>
                        <!-- ... -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Jenis Obat -->
    <div id="content-jenis-obat" class="d-none">
        <h2 class="mb-4"><i class="fas fa-tags"></i> Jenis Obat</h2>
        <div class="card shadow border-0">
            <div class="card-body">
                <form method="POST" action="{{ route('jenis-obat.store') }}" class="row g-2 mb-3" enctype="multipart/form-data">
                    @csrf
                    <div class="col-md-3">
                        <input type="text" name="jenis" class="form-control" placeholder="Jenis Obat" required>
                    </div>
                    <div class="col-md-5">
                        <input type="text" name="deskripsi_jenis" class="form-control" placeholder="Deskripsi (opsional)">
                    </div>
                    <div class="col-md-2">
                        <input type="file" name="image_url" class="form-control" accept="image/*">
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-success w-100" type="submit"><i class="fas fa-plus"></i> Tambah</button>
                    </div>
                </form>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped bg-white">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Jenis</th>
                                <th>Deskripsi</th>
                                <th>Gambar</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($jenis_obat ?? [] as $i => $jenis)
                            <tr>
                                <td>{{ $i+1 }}</td>
                                <td>
                                    <span class="jenis-text">{{ $jenis->jenis }}</span>
                                    <form method="POST" action="{{ route('jenis-obat.update', $jenis->id) }}" class="d-inline jenis-obat-edit-form" enctype="multipart/form-data">
                                        @csrf
                                        <input type="text" name="jenis" class="form-control form-control-sm d-none" value="{{ $jenis->jenis }}" required>
                                </td>
                                <td>
                                    <span class="deskripsi-text">{{ $jenis->deskripsi_jenis }}</span>
                                    <input type="text" name="deskripsi_jenis" class="form-control form-control-sm d-none" value="{{ $jenis->deskripsi_jenis }}">
                                </td>
                                <td class="text-center">
                                    @if($jenis->image_url)
                                        <img src="{{ asset('storage/'.$jenis->image_url) }}" alt="img" class="img-thumbnail jenis-img-thumb" style="width:48px; height:48px; cursor:pointer;" data-img="{{ asset('storage/'.$jenis->image_url) }}">
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                    <input type="file" name="image_url" class="form-control form-control-sm d-none" accept="image/*">
                                </td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-sm btn-warning btn-edit-jenis"><i class="fas fa-edit"></i></button>
                                    <button type="submit" class="btn btn-sm btn-success d-none btn-save-jenis"><i class="fas fa-save"></i></button>
                                    <button type="button" class="btn btn-sm btn-secondary d-none btn-cancel-jenis"><i class="fas fa-times"></i></button>
                                    </form>
                                    <form method="POST" action="{{ route('jenis-obat.delete', $jenis->id) }}" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-danger btn-delete-jenis" onclick="return confirm('Hapus jenis obat ini?')"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">Belum ada data jenis obat.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Tambah Produk -->
    <div id="content-tambah-produk" class="d-none">
        <h2 class="mb-4"><i class="fas fa-plus-circle"></i> Tambah Pembelian Produk/Obat</h2>
        <div class="card shadow border-0">
            <div class="card-body">
                <form id="formPembelian" method="POST" action="{{ route('pembelian.store') }}" class="row g-3">
                    @csrf
                    <div class="col-md-3">
                        <label>No Nota</label>
                        <input type="text" name="nonota" class="form-control" readonly 
                               value="{{ strtoupper(substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 3)) . rand(100000, 999999) }}">
                    </div>
                    <div class="col-md-3">
                        <label>Tanggal Pembelian</label>
                        <input type="date" name="tgl_pembelian" class="form-control" required>
                    </div>
                    <div class="col-md-3">
                        <label>Distributor</label>
                        <select name="id_distributor" class="form-control" required>
                            <option value="">Pilih Distributor</option>
                            @foreach($distributor ?? [] as $dist)
                                <option value="{{ $dist->id }}">{{ $dist->nama_distributor }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 d-flex align-items-end justify-content-end">
                        <button id="btnSimpanPembelian" class="btn btn-primary" type="submit" disabled>
                            <i class="fas fa-save"></i> Simpan Pembelian
                        </button>
                    </div>
                </form>
                <div class="row mt-4">
                    <div class="col-md-5">
                        <!-- Dynamic Form Detail Pembelian -->
                        <div id="detailPembelianForms"></div>
                        <button type="button" id="btnTambahDetail" class="btn btn-success w-100 mb-3">
                            <i class="fas fa-plus"></i> Tambah Produk
                        </button>
                    </div>
                    <div class="col-md-7">
                        <!-- Tabel Detail Pembelian -->
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped bg-white" id="tabelDetailPembelian">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Obat</th>
                                        <th>Jumlah</th>
                                        <th>Harga Beli</th>
                                        <th>Subtotal</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Data detail pembelian akan diisi JS -->
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="4" class="text-end">Total</th>
                                        <th id="totalBayar">Rp 0</th>
                                        <th></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- Hidden input untuk detail pembelian -->
                <input type="hidden" name="detail_pembelian_json" id="detailPembelianJson" form="formPembelian">
                <!-- Tabel pembelian yang sudah masuk -->
                <div class="table-responsive mt-4">
                    <table class="table table-bordered table-striped bg-white">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>No Nota</th>
                                <th>Tanggal</th>
                                <th>Total Bayar</th>
                                <th>Distributor</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $rowNum = 1; @endphp
                            @forelse($pembelian ?? \App\Models\Pembelian::with('distributor')->orderByDesc('id')->get() as $p)
                            <tr>
                                <td>{{ $rowNum++ }}</td>
                                <td>{{ $p->nonota }}</td>
                                <td>{{ $p->tgl_pembelian }}</td>
                                <td>Rp {{ number_format($p->total_bayar,0,',','.') }}</td>
                                <td>{{ $p->distributor->nama_distributor ?? '-' }}</td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-info btn-sm btn-detail-pembelian" data-id="{{ $p->id }}"><i class="fas fa-search"></i></button>
                                    <a href="{{ url('/pembelian/'.$p->id.'/edit') }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                    <form method="POST" action="{{ url('/pembelian/'.$p->id) }}" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Hapus pembelian ini?')"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">Belum ada data pembelian.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div id="content-apply-pembelian" class="d-none">
        <h2 class="mb-4"><i class="fas fa-shopping-cart"></i> Apply Pembelian</h2>
        <div class="card shadow border-0">
            <div class="card-body">
                <p>Ajukan pembelian produk ke distributor.</p>
                <form>
                    <div class="form-row">
                        <div class="form-group col-md-5">
                            <label>Nama Produk</label>
                            <input type="text" class="form-control" placeholder="Nama Produk">
                        </div>
                        <div class="form-group col-md-3">
                            <label>Jumlah</label>
                            <input type="number" class="form-control" placeholder="Jumlah">
                        </div>
                        <div class="form-group col-md-4">
                            <label>Distributor</label>
                            <select class="form-control">
                                <option>PT Sehat Selalu</option>
                                <option>PT Obat Jaya</option>
                            </select>
                        </div>
                    </div>
                    <button class="btn btn-primary mt-2"><i class="fas fa-paper-plane"></i> Ajukan Pembelian</button>
                </form>
            </div>
        </div>
    </div>
    <div id="content-distributor" class="d-none">
        <h2 class="mb-4"><i class="fas fa-truck"></i> Distributor</h2>
        <div class="card shadow border-0">
            <div class="card-body">
                <!-- Form tambah distributor -->
                <form method="POST" action="{{ route('distributor.store') }}" class="row g-2 mb-3">
                    @csrf
                    <div class="col-md-3">
                        <input type="text" name="nama_distributor" class="form-control" placeholder="Nama Distributor" required>
                    </div>
                    <div class="col-md-3">
                        <input type="text" name="telepon" class="form-control" placeholder="Telepon">
                    </div>
                    <div class="col-md-4">
                        <input type="text" name="alamat" class="form-control" placeholder="Alamat">
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-success w-100" type="submit"><i class="fas fa-plus"></i> Tambah</button>
                    </div>
                </form>
                <!-- Tabel data distributor -->
                <div class="table-responsive">
                    <table class="table table-bordered table-striped bg-white">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Distributor</th>
                                <th>Telepon</th>
                                <th>Alamat</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($distributor ?? [] as $i => $dist)
                            <tr>
                                <td>{{ $i+1 }}</td>
                                <td>
                                    <span class="dist-nama">{{ $dist->nama_distributor }}</span>
                                    <form method="POST" action="{{ route('distributor.update', $dist->id) }}" class="d-inline distributor-edit-form">
                                        @csrf
                                        <input type="text" name="nama_distributor" class="form-control form-control-sm d-none" value="{{ $dist->nama_distributor }}" required>
                                </td>
                                <td>
                                    <span class="dist-telp">{{ $dist->telepon }}</span>
                                    <input type="text" name="telepon" class="form-control form-control-sm d-none" value="{{ $dist->telepon }}">
                                </td>
                                <td>
                                    <span class="dist-alamat">{{ $dist->alamat }}</span>
                                    <input type="text" name="alamat" class="form-control form-control-sm d-none" value="{{ $dist->alamat }}">
                                </td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-sm btn-warning btn-edit-dist"><i class="fas fa-edit"></i></button>
                                    <button type="submit" class="btn btn-sm btn-success d-none btn-save-dist"><i class="fas fa-save"></i></button>
                                    <button type="button" class="btn btn-sm btn-secondary d-none btn-cancel-dist"><i class="fas fa-times"></i></button>
                                    </form>
                                    <form method="POST" action="{{ route('distributor.delete', $dist->id) }}" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-danger btn-delete-dist" onclick="return confirm('Hapus distributor ini?')"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">Belum ada data distributor.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div id="content-pengiriman" class="d-none">
        <h2 class="mb-4"><i class="fas fa-shipping-fast"></i> Pengiriman</h2>
        <div class="card shadow border-0">
            <div class="card-body">
                <p>Riwayat and status pengiriman produk dari distributor.</p>
                <table class="table table-bordered bg-white">
                    <thead>
                        <tr>
                            <th>No. Resi</th>
                            <th>Distributor</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>INV123456</td>
                            <td>PT Sehat Selalu</td>
                            <td><span class="badge badge-info">Dalam Pengiriman</span></td>
                            <td>2024-06-01</td>
                        </tr>
                        <tr>
                            <td>INV654321</td>
                            <td>PT Obat Jaya</td>
                            <td><span class="badge badge-success">Selesai</span></td>
                            <td>2024-05-28</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div id="content-status-order" class="d-none">
        <h2 class="mb-4"><i class="fas fa-tasks"></i> Status Order</h2>
        <div class="card shadow border-0">
            <div class="card-body">
                <p>Status order pembelian produk.</p>
                <ul class="list-group">
                    <li class="list-group-item">
                        <strong>Order #00123</strong> - <span class="badge badge-warning">Menunggu Pembayaran</span>
                        <span class="float-right text-muted">2024-06-01</span>
                    </li>
                    <li class="list-group-item">
                        <strong>Order #00122</strong> - <span class="badge badge-success">Selesai</span>
                        <span class="float-right text-muted">2024-05-30</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div id="content-laporan-keuangan" class="d-none">
        <h2 class="mb-4"><i class="fas fa-file-invoice-dollar"></i> Laporan Keuangan</h2>
        <div class="card shadow border-0">
            <div class="card-body">
                <p>Rekap pemasukan dan pengeluaran apotek.</p>
                <table class="table table-striped bg-white">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Keterangan</th>
                            <th>Pemasukan</th>
                            <th>Pengeluaran</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>2024-06-01</td>
                            <td>Penjualan Produk</td>
                            <td>Rp 2.000.000</td>
                            <td>-</td>
                        </tr>
                        <tr>
                            <td>2024-06-01</td>
                            <td>Pembelian Stok</td>
                            <td>-</td>
                            <td>Rp 1.000.000</td>
                        </tr>
                    </tbody>
                </table>
                <div class="mt-3">
                    <strong>Total Pemasukan:</strong> <span class="text-success">Rp 2.000.000</span><br>
                    <strong>Total Pengeluaran:</strong> <span class="text-danger">Rp 1.000.000</span>
                </div>
            </div>
        </div>
    </div>
    <!-- Tambah Obat -->
    <div id="content-tambah-obat" class="d-none">
        <h2 class="mb-4"><i class="fas fa-pills"></i> Data Obat</h2>
        <div class="card shadow border-0 mb-4">
            <div class="card-body">
                <!-- Form tambah/edit obat -->
                <form id="formObat" method="POST" action="{{ route('obat.store') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="edit_id" id="editObatId">
                    <div class="row g-2 align-items-end">
                        <div class="col-md-3">
                            <label>Nama Obat <span class="text-danger">*</span></label>
                            <input list="daftarNamaObat" name="nama_obat" id="inputNamaObat" class="form-control" required autocomplete="off">
                            <datalist id="daftarNamaObat">
                                @foreach(\App\Models\DetailPembelian::select('nama_obat')->distinct()->pluck('nama_obat') as $nama)
                                    <option value="{{ $nama }}">
                                @endforeach
                            </datalist>
                        </div>
                        <div class="col-md-2">
                            <label>Jenis Obat <span class="text-danger">*</span></label>
                            <select name="id_jenis_obat" id="inputJenisObat" class="form-control" required>
                                <option value="">Pilih Jenis</option>
                                @foreach(\App\Models\JenisObat::all() as $jenis)
                                    <option value="{{ $jenis->id }}">{{ $jenis->jenis }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label>Margin (%) <span class="text-danger">*</span></label>
                            <input type="number" name="margin" id="inputMargin" class="form-control" min="0" max="100" value="20" required>
                        </div>
                        <!-- Harga Beli dihapus dari form -->
                        <div class="col-md-1">
                            <label>Stok</label>
                            <input type="number" name="stok" id="inputStok" class="form-control" readonly required>
                        </div>
                    </div>
                    <div class="row g-2 mt-2">
                        <div class="col-md-8">
                            <label>Deskripsi</label>
                            <input type="text" name="deskripsi_obat" id="inputDeskripsiObat" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label>Foto Produk</label>
                            <div class="row">
                                <div class="col-md-4">
                                    <input type="file" name="foto1" class="form-control" accept="image/*">
                                </div>
                                <div class="col-md-4">
                                    <input type="file" name="foto2" class="form-control" accept="image/*">
                                </div>
                                <div class="col-md-4">
                                    <input type="file" name="foto3" class="form-control" accept="image/*">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12 text-end">
                            <button type="submit" class="btn btn-success" id="btnSimpanObat">
                                <i class="fas fa-save"></i> <span id="btnObatText">Simpan</span>
                            </button>
                            <button type="button" class="btn btn-secondary ms-2 d-none" id="btnBatalEditObat">Batal</button>
                        </div>
                    </div>
                    <input type="hidden" name="harga_jual" id="inputHargaJual">
                    <input type="hidden" id="inputHargaBeli">
                </form>
                <!-- Tabel realtime harga jual -->
                <div class="mt-4">
                    <h5>Harga Jual (Realtime)</h5>
                    <table class="table table-bordered table-striped bg-white mb-0">
                        <thead>
                            <tr>
                                <th>Margin (%)</th>
                                <th>Harga Beli</th>
                                <th>Harga Jual (Margin x Harga Beli)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td id="tabelMargin">-</td>
                                <td id="tabelHargaBeli">-</td>
                                <td id="tabelHargaJual">-</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- Tabel Data Obat dari Database -->
                <div class="mt-5">
                    <h5>Daftar Obat</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped bg-white" id="tabelDataObat">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Obat</th>
                                    <th>Jenis</th>
                                    <th>Stok</th>
                                    <th>Harga Jual</th>
                                    <th>Deskripsi</th>
                                    <th>Foto 1</th>
                                    <th>Foto 2</th>
                                    <th>Foto 3</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $no = 1; @endphp
                                @foreach(\App\Models\Obat::with('jenisObat')->orderByDesc('id')->take(100)->get() as $obat)
                                <tr data-obat='@json($obat)'>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $obat->nama_obat }}</td>
                                    <td>{{ $obat->jenisObat->jenis ?? '-' }}</td>
                                    <td>{{ $obat->stok }}</td>
                                    <td>Rp {{ number_format($obat->harga_jual,0,',','.') }}</td>
                                    <td>{{ $obat->deskripsi_obat }}</td>
                                    <td>
                                        @if($obat->foto1)
                                            <img src="{{ asset('storage/'.$obat->foto1) }}" alt="foto1" class="img-thumbnail img-obat-thumb" style="width:48px; height:48px; cursor:pointer;" data-img="{{ asset('storage/'.$obat->foto1) }}">
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($obat->foto2)
                                            <img src="{{ asset('storage/'.$obat->foto2) }}" alt="foto2" class="img-thumbnail img-obat-thumb" style="width:48px; height:48px; cursor:pointer;" data-img="{{ asset('storage/'.$obat->foto2) }}">
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($obat->foto3)
                                            <img src="{{ asset('storage/'.$obat->foto3) }}" alt="foto3" class="img-thumbnail img-obat-thumb" style="width:48px; height:48px; cursor:pointer;" data-img="{{ asset('storage/'.$obat->foto3) }}">
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-warning btn-sm btn-edit-obat" data-id="{{ $obat->id }}" title="Edit"><i class="fas fa-edit"></i></button>
                                        <form method="POST" action="{{ route('obat.delete', $obat->id) }}" style="display:inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Hapus obat ini?')"><i class="fas fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Show add user form
        document.getElementById('btnShowAddUser').onclick = function() {
            var form = document.getElementById('addUserForm');
            form.style.display = (form.style.display === 'none' || form.style.display === '') ? 'block' : 'none';
        };

        // Password validation for add user
        var addUserPassword = document.getElementById('addUserPassword');
        var btnAddUserSave = document.getElementById('btnAddUserSave');
        var passwordWarning = document.getElementById('passwordWarning');
        if (addUserPassword) {
            addUserPassword.addEventListener('input', function() {
                if (addUserPassword.value.length < 8) {
                    btnAddUserSave.disabled = true;
                    passwordWarning.classList.remove('d-none');
                } else {
                    btnAddUserSave.disabled = false;
                    passwordWarning.classList.add('d-none');
                }
            });
        }

        // Edit user row
        document.querySelectorAll('.btn-edit-user').forEach(function(btn) {
            btn.addEventListener('click', function() {
                var tr = btn.closest('tr');
                tr.querySelectorAll('span').forEach(function(span) { span.classList.add('d-none'); });
                tr.querySelectorAll('input, select').forEach(function(input) { input.classList.remove('d-none'); });
                tr.querySelector('.btn-edit-user').classList.add('d-none');
                tr.querySelector('.btn-save-user').classList.remove('d-none');
                tr.querySelector('.btn-cancel-edit').classList.remove('d-none');
                tr.querySelector('input[name="password"]').classList.remove('d-none');
                tr.querySelector('.password-hint').classList.remove('d-none');
            });
        });

        // Cancel edit
        document.querySelectorAll('.btn-cancel-edit').forEach(function(btn) {
            btn.addEventListener('click', function() {
                var tr = btn.closest('tr');
                tr.querySelectorAll('span').forEach(function(span) { span.classList.remove('d-none'); });
                tr.querySelectorAll('input, select').forEach(function(input) { input.classList.add('d-none'); });
                tr.querySelector('.btn-edit-user').classList.remove('d-none');
                tr.querySelector('.btn-save-user').classList.add('d-none');
                tr.querySelector('.btn-cancel-edit').classList.add('d-none');
                tr.querySelector('input[name="password"]').classList.add('d-none');
                tr.querySelector('.password-hint').classList.add('d-none');
            });
        });

        // Delete user confirmation
        document.querySelectorAll('.btn-delete-user').forEach(function(btn) {
            btn.addEventListener('click', function() {
                var username = btn.getAttribute('data-username');
                var userid = btn.getAttribute('data-userid');
                if (confirm('Yakin ingin menghapus user "' + username + '"?')) {
                    var form = document.createElement('form');
                    form.method = 'POST';
                    form.action = '/admin/users/' + userid + '/delete';
                    var csrf = document.createElement('input');
                    csrf.type = 'hidden';
                    csrf.name = '_token';
                    csrf.value = '{{ csrf_token() }}';
                    form.appendChild(csrf);
                    document.body.appendChild(form);
                    form.submit();
                }
            });
        });

        // Show alert for success (auto close after 2.5s)
        var alertSuccess = document.querySelector('.alert-success');
        if(alertSuccess){
            setTimeout(function(){
                $(alertSuccess).alert('close');
            }, 2500);
        }

        // Edit jenis obat
        document.querySelectorAll('.btn-edit-jenis').forEach(function(btn) {
            btn.addEventListener('click', function() {
                var tr = btn.closest('tr');
                tr.querySelectorAll('span').forEach(function(span) { span.classList.add('d-none'); });
                tr.querySelectorAll('input').forEach(function(input) { input.classList.remove('d-none'); });
                tr.querySelector('.btn-edit-jenis').classList.add('d-none');
                tr.querySelector('.btn-save-jenis').classList.remove('d-none');
                tr.querySelector('.btn-cancel-jenis').classList.remove('d-none');
            });
        });

        // Cancel edit jenis obat
        document.querySelectorAll('.btn-cancel-jenis').forEach(function(btn) {
            btn.addEventListener('click', function() {
                var tr = btn.closest('tr');
                tr.querySelectorAll('span').forEach(function(span) { span.classList.remove('d-none'); });
                tr.querySelectorAll('input').forEach(function(input) { input.classList.add('d-none'); });
                tr.querySelector('.btn-edit-jenis').classList.remove('d-none');
                tr.querySelector('.btn-save-jenis').classList.add('d-none');
                tr.querySelector('.btn-cancel-jenis').classList.add('d-none');
            });
        });

        // Preview gambar jenis obat (modal)
        document.querySelectorAll('.jenis-img-thumb').forEach(function(img) {
            img.addEventListener('click', function() {
                var src = img.getAttribute('data-img');
                var modalImg = document.getElementById('jenisObatImgPreview');
                modalImg.src = src;
                var modal = new bootstrap.Modal(document.getElementById('jenisObatImgModal'));
                modal.show();
            });
        });

        // Edit distributor
        document.querySelectorAll('.btn-edit-dist').forEach(function(btn) {
            btn.addEventListener('click', function() {
                var tr = btn.closest('tr');
                tr.querySelectorAll('span').forEach(function(span) { span.classList.add('d-none'); });
                tr.querySelectorAll('input').forEach(function(input) { input.classList.remove('d-none'); });
                tr.querySelector('.btn-edit-dist').classList.add('d-none');
                tr.querySelector('.btn-save-dist').classList.remove('d-none');
                tr.querySelector('.btn-cancel-dist').classList.remove('d-none');
            });
        });

        // Cancel edit distributor
        document.querySelectorAll('.btn-cancel-dist').forEach(function(btn) {
            btn.addEventListener('click', function() {
                var tr = btn.closest('tr');
                tr.querySelectorAll('span').forEach(function(span) { span.classList.remove('d-none'); });
                tr.querySelectorAll('input').forEach(function(input) { input.classList.add('d-none'); });
                tr.querySelector('.btn-edit-dist').classList.remove('d-none');
                tr.querySelector('.btn-save-dist').classList.add('d-none');
                tr.querySelector('.btn-cancel-dist').classList.add('d-none');
            });
        });

        // Dynamic detail pembelian logic
        let detailPembelian = [];
        let detailForms = [];
        const detailPembelianForms = document.getElementById('detailPembelianForms');
        const tabelDetail = document.getElementById('tabelDetailPembelian').querySelector('tbody');
        const totalBayarEl = document.getElementById('totalBayar');
        const btnSimpanPembelian = document.getElementById('btnSimpanPembelian');
        const detailPembelianJson = document.getElementById('detailPembelianJson');

        function createDetailForm(idx) {
            const wrapper = document.createElement('div');
            wrapper.className = 'card card-body shadow-sm mb-2 detail-form';
            wrapper.innerHTML = `
                <div class="row g-2 align-items-end">
                    <div class="col-12">
                        <label>Nama Obat</label>
                        <input type="text" name="nama_obat" class="form-control" required>
                    </div>
                    <div class="col-6">
                        <label>Jumlah Beli</label>
                        <input type="number" name="jumlah_beli" class="form-control" min="1" required>
                    </div>
                    <div class="col-6">
                        <label>Harga Beli</label>
                        <input type="number" name="harga_beli" class="form-control" min="0" required>
                    </div>
                    <div class="col-12 text-end">
                        <button type="button" class="btn btn-danger btn-sm btn-hapus-form" data-index="${idx}">
                            <i class="fas fa-trash"></i> Hapus
                        </button>
                    </div>
                </div>
            `;
            // Trigger update on input
            wrapper.querySelector('input[name="harga_beli"]').addEventListener('input', updateDetailPembelian);
            wrapper.querySelector('input[name="jumlah_beli"]').addEventListener('input', updateDetailPembelian);
            wrapper.querySelector('input[name="nama_obat"]').addEventListener('input', updateDetailPembelian);
            wrapper.querySelector('.btn-hapus-form').onclick = function() {
                detailForms.splice(idx, 1);
                renderDetailForms();
                updateDetailPembelian();
            };
            return wrapper;
        }

        function renderDetailForms() {
            detailPembelianForms.innerHTML = '';
            detailForms.forEach((form, idx) => {
                form.querySelector('.btn-hapus-form').dataset.index = idx;
                detailPembelianForms.appendChild(form);
            });
        }

        function updateDetailPembelian() {
            detailPembelian = [];
            detailForms.forEach(form => {
                const nama_obat = form.querySelector('input[name="nama_obat"]').value;
                const jumlah_beli = parseInt(form.querySelector('input[name="jumlah_beli"]').value) || 0;
                const harga_beli = parseInt(form.querySelector('input[name="harga_beli"]').value) || 0;
                const subtotal = jumlah_beli * harga_beli;
                if(nama_obat && jumlah_beli > 0 && harga_beli > 0) {
                    detailPembelian.push({nama_obat, jumlah_beli, harga_beli, subtotal});
                }
            });
            updateTabelDetail();
        }

        function updateTabelDetail() {
            tabelDetail.innerHTML = '';
            let total = 0;
            detailPembelian.forEach((item, idx) => {
                total += parseFloat(item.subtotal);
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${idx+1}</td>
                    <td>${item.nama_obat}</td>
                    <td>${item.jumlah_beli}</td>
                    <td>Rp ${parseInt(item.harga_beli).toLocaleString()}</td>
                    <td>Rp ${parseInt(item.subtotal).toLocaleString()}</td>
                    <td class="text-center">
                        <button type="button" class="btn btn-danger btn-sm btn-hapus-detail" data-index="${idx}">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                `;
                tabelDetail.appendChild(row);
            });
            totalBayarEl.textContent = 'Rp ' + total.toLocaleString();
            detailPembelianJson.value = JSON.stringify(detailPembelian);
            btnSimpanPembelian.disabled = detailPembelian.length === 0;
        }

        // Tambah form detail baru
        document.getElementById('btnTambahDetail').onclick = function(e) {
            e.preventDefault();
            detailForms.push(createDetailForm(detailForms.length));
            renderDetailForms();
        };

        // Hapus detail dari tabel (dan form)
        tabelDetail.addEventListener('click', function(e) {
            if(e.target.closest('.btn-hapus-detail')) {
                const idx = parseInt(e.target.closest('.btn-hapus-detail').dataset.index);
                detailForms.splice(idx, 1);
                renderDetailForms();
                updateDetailPembelian();
            }
        });

        // Saat submit pembelian, tambahkan total_bayar ke form
        document.getElementById('formPembelian').onsubmit = function() {
            updateDetailPembelian();
            if(detailPembelian.length === 0) {
                alert('Isi minimal satu detail pembelian!');
                return false;
            }
            let total = detailPembelian.reduce((a,b) => a + parseFloat(b.subtotal), 0);
            let inputTotal = document.createElement('input');
            inputTotal.type = 'hidden';
            inputTotal.name = 'total_bayar';
            inputTotal.value = total;
            this.appendChild(inputTotal);
            // Submit form standar agar data terkirim ke database
            return true;
        };

        // Tambahkan satu form detail default saat load
        if(detailForms.length === 0) {
            detailForms.push(createDetailForm(0));
            renderDetailForms();
        }

        // Handler tombol detail pembelian
        document.querySelectorAll('.btn-detail-pembelian').forEach(function(btn) {
            btn.addEventListener('click', function() {
                var pembelianId = btn.getAttribute('data-id');
                var modal = new bootstrap.Modal(document.getElementById('modalDetailPembelian'));
                var content = document.getElementById('detailPembelianContent');
                content.innerHTML = '<div class="text-center text-muted">Memuat data...</div>';
                fetch('/pembelian/' + pembelianId + '/detail')
                    .then(res => res.json())
                    .then(function(data) {
                        if (data && data.detail && data.detail.length > 0) {
                            let total = 0;
                            // Format tanggal agar tidak ada T00:00:00.000000Z
                            let tgl = data.pembelian.tgl_pembelian;
                            if (tgl && typeof tgl === 'string') {
                                // Ambil hanya bagian tanggal (YYYY-MM-DD)
                                tgl = tgl.split('T')[0];
                            }
                            let html = `
                                <div class="mb-2"><strong>No Nota:</strong> ${data.pembelian.nonota}</div>
                                <div class="mb-2"><strong>Tanggal:</strong> ${tgl}</div>
                                <div class="mb-2"><strong>Distributor:</strong> ${data.pembelian.distributor}</div>
                                <div class="mb-2"><strong>Total Bayar:</strong> Rp ${parseInt(data.pembelian.total_bayar).toLocaleString()}</div>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Obat</th>
                                                <th>Jumlah</th>
                                                <th>Harga Beli</th>
                                                <th>Subtotal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                            `;
                            data.detail.forEach(function(d, i) {
                                total += parseInt(d.subtotal);
                                html += `
                                    <tr>
                                        <td>${i+1}</td>
                                        <td>${d.nama_obat ?? '-'}</td>
                                        <td>${d.jumlah_beli}</td>
                                        <td>Rp ${parseInt(d.harga_beli).toLocaleString()}</td>
                                        <td>Rp ${parseInt(d.subtotal).toLocaleString()}</td>
                                    </tr>
                                `;
                            });
                            html += `
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th colspan="4" class="text-end">Total</th>
                                                <th>Rp ${total.toLocaleString()}</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            `;
                            content.innerHTML = html;
                        } else {
                            content.innerHTML = '<div class="text-center text-muted">Tidak ada detail pembelian.</div>';
                        }
                    })
                    .catch(function() {
                        content.innerHTML = '<div class="text-center text-danger">Gagal memuat data.</div>';
                    });
                modal.show();
            });
        });
    });
</script>
@push('js')
<script>
document.addEventListener('DOMContentLoaded', function() {
    let lastHargaBeli = 0;

    // Harga jual = harga_beli + (margin * harga_beli / 100)
    function calculateHargaJual(hargaBeli, margin) {
        margin = parseFloat(margin) || 0;
        hargaBeli = parseFloat(hargaBeli) || 0;
        // (Margin x Harga Beli / 100) + Harga Beli
        return Math.ceil(hargaBeli + (margin * hargaBeli / 100));
    }

    function updateHargaJualTable() {
        const margin = document.getElementById('inputMargin').value;
        const hargaBeli = lastHargaBeli;
        const hargaJual = calculateHargaJual(hargaBeli, margin);

        document.getElementById('tabelMargin').textContent = margin ? margin : '-';
        document.getElementById('tabelHargaBeli').textContent = hargaBeli ? 'Rp ' + parseInt(hargaBeli).toLocaleString() : '-';
        document.getElementById('tabelHargaJual').textContent = (hargaBeli && margin) ? 'Rp ' + hargaJual.toLocaleString() : '-';
        document.getElementById('inputHargaJual').value = hargaJual > hargaBeli ? hargaJual : (hargaBeli ? hargaBeli + 1 : '');
    }

    document.getElementById('inputNamaObat').addEventListener('input', function() {
        let nama = this.value.trim();
        if (!nama) {
            lastHargaBeli = 0;
            // document.getElementById('inputHargaBeli').value = '';
            document.getElementById('inputStok').value = '0';
            updateHargaJualTable();
            return;
        }
        fetch('/obat/harga-stok?nama_obat=' + encodeURIComponent(nama))
            .then(res => res.json())
            .then(function(data) {
                lastHargaBeli = data.harga_beli || 0;
                let stok = data.stok || 0;
                let jenis = data.id_jenis_obat || '';
                // document.getElementById('inputHargaBeli').value = lastHargaBeli;
                document.getElementById('inputStok').value = stok;
                if (jenis) document.getElementById('inputJenisObat').value = jenis;
                updateHargaJualTable();
            });
    });

    document.getElementById('inputMargin').addEventListener('input', function() {
        updateHargaJualTable();
    });

    // Saat edit obat
    document.querySelectorAll('.btn-edit-obat').forEach(function(btn) {
        btn.addEventListener('click', function() {
            let tr = btn.closest('tr');
            let data = tr.getAttribute('data-obat');
            if (!data) return;
            let obat = JSON.parse(data);

            document.getElementById('editObatId').value = obat.id;
            document.getElementById('inputNamaObat').value = obat.nama_obat;
            document.getElementById('inputJenisObat').value = obat.id_jenis_obat;
            document.getElementById('inputStok').value = obat.stok;
            document.getElementById('inputDeskripsiObat').value = obat.deskripsi_obat || '';
            // Ambil harga beli terbaru
            fetch('/obat/harga-stok?nama_obat=' + encodeURIComponent(obat.nama_obat))
                .then(res => res.json())
                .then(function(data) {
                    lastHargaBeli = data.harga_beli || 0;
                    // Hitung margin dari harga jual lama
                    if (data.harga_beli > 0) {
                        let margin = obat.harga_jual && data.harga_beli ? Math.round(((obat.harga_jual - data.harga_beli) / data.harga_beli) * 100) : 0;
                        document.getElementById('inputMargin').value = margin;
                    }
                    updateHargaJualTable();
                });
            document.getElementById('btnObatText').textContent = 'Update';
            document.getElementById('btnBatalEditObat').classList.remove('d-none');
        });
    });

    document.getElementById('btnBatalEditObat').onclick = function() {
        document.getElementById('editObatId').value = '';
        document.getElementById('formObat').reset();
        document.getElementById('formObat').action = "{{ route('obat.store') }}";
        document.getElementById('btnObatText').textContent = 'Simpan';
        lastHargaBeli = 0;
        updateHargaJualTable();
        this.classList.add('d-none');
    };

    // Saat submit form, jika edit_id terisi, ganti action ke update
    document.getElementById('formObat').addEventListener('submit', function(e) {
        var editId = document.getElementById('editObatId').value;
        if (editId) {
            this.action = "{{ url('/obat') }}/" + editId + "/update";
        } else {
            this.action = "{{ route('obat.store') }}";
        }
    });

    // Pop up gambar besar saat klik foto obat
    document.querySelectorAll('.img-obat-thumb').forEach(function(img) {
        img.addEventListener('click', function() {
            var src = img.getAttribute('data-img');
            var modalImg = document.getElementById('popupObatImgPreview');
            modalImg.src = src;
            var modal = new bootstrap.Modal(document.getElementById('popupObatImgModal'));
            modal.show();
        });
    });
});
</script>
@endpush

<!-- Modal Preview Gambar -->
<div class="modal fade" id="jenisObatImgModal" tabindex="-1" aria-labelledby="jenisObatImgModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-transparent border-0">
            <div class="modal-body text-center p-0">
                <img src="" id="jenisObatImgPreview" class="img-fluid rounded shadow" style="max-height:70vh;">
            </div>
        </div>
    </div>
</div>

<!-- Modal Detail Pembelian -->
<div class="modal fade" id="modalDetailPembelian" tabindex="-1" aria-labelledby="modalDetailPembelianLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Pembelian</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                <div id="detailPembelianContent">
                    <div class="text-center text-muted">Memuat data...</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Preview Gambar Obat (Popup Besar) -->
<div class="modal fade" id="popupObatImgModal" tabindex="-1" aria-labelledby="popupObatImgModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-transparent border-0">
            <div class="modal-body text-center p-0">
                <img src="" id="popupObatImgPreview" class="img-fluid rounded shadow" style="max-height:70vh;">
            </div>
        </div>
    </div>
</div>
