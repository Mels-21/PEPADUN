<!-- Header Action Card -->
<div class="card header-action-card">
    <div class="header-action-container">
        <!-- Left side: Search -->
        <div class="header-search-container">
            <form action="<?= base_url('users') ?>" method="GET" class="header-search-form">
                <div class="input-icon-wrapper header-search-input-wrapper">
                    <input type="text" id="search" name="search" class="form-control form-control-icon header-search-input" placeholder="Cari pengguna..." value="<?= isset($searchQuery) ? esc($searchQuery) : '' ?>" autocomplete="off" onkeypress="if(event.keyCode === 13) { this.form.submit(); return false; }">
                    <i class="bi bi-search header-search-icon"></i>
                </div>
            </form>
        </div>

        <!-- Right side: Actions -->
        <div class="header-actions-container">
            <?php if (!empty($searchQuery)): ?>
                <a href="<?= base_url('users') ?>" class="btn btn-secondary btn-reset">
                    Reset
                </a>
            <?php endif; ?>
            <!-- Right side: Actions -->
            <?php if (session()->get('role') === 'admin'): ?>
                <button type="button" class="btn btn-primary btn-add-data" onclick="openAddModal()">
                    <i class="bi bi-person-plus-fill"></i> Tambah Data
                </button>
            <?php endif; ?>
        </div>
    </div>
</div>

<div class="table-responsive">
    <table id="usersTable" class="table table-striped table-bordered custom-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Username</th>
                <th>Email</th>
                <th>Nama</th>
                <th>NIP</th>
                <th>Jabatan</th>
                <th>Substansi</th>
                <th>Image User</th>
                <th>Status User</th>
                <th>Telepon/WhatsApp</th>
                <th>No Dosir</th>
                <th>Tempat Lahir</th>
                <th>Tanggal Lahir</th>
                <th>Jenis Kelamin</th>
                <th>Pangkat</th>
                <th>Tipe Pegawai</th>
                <th>TMT Pangkat</th>
                <th>Eselon</th>
                <th>Kode Jabatan</th>
                <th>Kelas Jabatan</th>
                <th>Fungsi Jabatan</th>
                <th>Pendidikan</th>
                <th>Jurusan</th>
                <th>Tahun Lulus</th>
                <th>Nama Sekolah</th>
                <th>Agama</th>
                <th>TMT Jabatan</th>
                <th>Status Pegawai</th>
                <th>Kedudukan</th>
                <th>Tgl Pensiun</th>
                <th>Masa Kerja</th>
                <th>Status Nikah</th>
                <th>Lama Jabatan</th>
                <th>Belum Naik Pangkat</th>
                <th>Rumpun Pendidikan</th>
                <th>Kontrak Awal</th>
                <th>Kontrak Akhir</th>
                <th>Role Akses</th>
                <th class="table-action-th">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $rowIndex = 1; foreach ($users as $user): ?>
                <tr>
                    <td><?= $rowIndex++ ?></td>
                    <td><?= esc($user['username'] ?: '-') ?></td>
                    <td><?= esc($user['email'] ?: '-') ?></td>
                    <td><?= esc($user['nama'] ?: '-') ?></td>
                    <td><?= esc($user['nip'] ?: '-') ?></td>
                    <td><?= esc($user['jabatan_id'] ?: '-') ?></td>
                    <td><?= esc($user['substansi_id'] ?: '-') ?></td>
                    <td><?= esc($user['image_user'] ?: '-') ?></td>
                    <td><?= esc($user['status_user'] ?: '-') ?></td>
                    <td><?= esc($user['telp'] ?: '-') ?></td>
                    <td><?= esc($user['no_dosir'] ?: '-') ?></td>
                    <td><?= esc($user['tempat_lahir'] ?: '-') ?></td>
                    <td><?= esc($user['tanggal_lahir'] ?: '-') ?></td>
                    <td><?= esc($user['jenis_kelamin'] ?: '-') ?></td>
                    <td><?= esc($user['pangkat'] ?: '-') ?></td>
                    <td><?= esc($user['tipe_pegawai'] ?: '-') ?></td>
                    <td><?= esc($user['tmt_pangkat'] ?: '-') ?></td>
                    <td><?= esc($user['eselon'] ?: '-') ?></td>
                    <td><?= esc($user['kode_jabatan'] ?: '-') ?></td>
                    <td><?= esc($user['kelas_jabatan'] ?: '-') ?></td>
                    <td><?= esc($user['fungsi_jabatan'] ?: '-') ?></td>
                    <td><?= esc($user['pendidikan'] ?: '-') ?></td>
                    <td><?= esc($user['jurusan'] ?: '-') ?></td>
                    <td><?= esc($user['tahun_lulus'] ?: '-') ?></td>
                    <td><?= esc($user['nama_sekolah'] ?: '-') ?></td>
                    <td><?= esc($user['agama'] ?: '-') ?></td>
                    <td><?= esc($user['tmt_jabatan'] ?: '-') ?></td>
                    <td><?= esc($user['status_pegawai'] ?: '-') ?></td>
                    <td><?= esc($user['kedudukan'] ?: '-') ?></td>
                    <td><?= esc($user['tgl_pensiun'] ?: '-') ?></td>
                    <td><?= esc($user['masa_kerja'] ?: '-') ?></td>
                    <td><?= esc($user['status_nikah'] ?: '-') ?></td>
                    <td><?= esc($user['lama_jabatan'] ?: '-') ?></td>
                    <td><?= esc($user['belum_naikpangkat'] ?: '-') ?></td>
                    <td><?= esc($user['rumpun_pendidikan'] ?: '-') ?></td>
                    <td><?= esc($user['kontrak_awal'] ?: '-') ?></td>
                    <td><?= esc($user['kontrak_akhir'] ?: '-') ?></td>
                    <td><?= esc($user['role'] ?: '-') ?></td>
                    <td class="table-action-td">
                        <div class="action-buttons-wrapper">
                            <?php if (session()->get('role') === 'admin'): ?>
                                <button type="button" onclick='openEditModal(<?= htmlspecialchars(json_encode($user), ENT_QUOTES, "UTF-8") ?>)' title="Edit Karyawan" class="btn-icon-edit">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <a href="<?= base_url('users/delete/' . $user['id_user']) ?>" title="Hapus Karyawan" onclick="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?')" class="btn-icon-delete">
                                    <i class="bi bi-trash"></i>
                                </a>
                            <?php else: ?>
                                <span class="text-readonly">Hanya Lihat</span>
                            <?php endif; ?>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Add Modal -->
<div id="addModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Tambah Data Karyawan</h3>
            <button class="modal-close" type="button" onclick="closeAddModal()">&times;</button>
        </div>
        <form action="<?= base_url('users/store') ?>" method="POST" enctype="multipart/form-data">
            <?= csrf_field() ?>
            
            <div class="form-group form-group-password">
                <label for="add_password">Password <span class="form-label-required">*</span></label>
                <div class="password-input-wrapper">
                    <input type="password" id="add_password" name="password" class="form-control password-input" placeholder="Masukkan password (minimal 6 karakter)..." required>
                    <i class="bi bi-eye-slash password-toggle-icon" id="toggle_add_password" onclick="togglePassword('add_password', 'toggle_add_password')"></i>
                </div>
            </div>
            
            <div class="form-grid">
                <div class="form-group">
                    <label for="add_username">Username <span class="form-label-required">*</span></label>
                    <input type="text" id="add_username" name="username" class="form-control" autocomplete="off" required>
                </div>
                <div class="form-group">
                    <label for="add_email">Email <span class="form-label-required">*</span></label>
                    <input type="text" id="add_email" name="email" class="form-control" autocomplete="off" required>
                </div>
                <div class="form-group">
                    <label for="add_nama">Nama <span class="form-label-required">*</span></label>
                    <input type="text" id="add_nama" name="nama" class="form-control" autocomplete="off" required>
                </div>
                <div class="form-group">
                    <label for="add_nip">NIP</label>
                    <input type="text" id="add_nip" name="nip" class="form-control" autocomplete="off" >
                </div>
                <div class="form-group">
                    <label for="add_jabatan_id">Jabatan</label>
                    <input type="text" id="add_jabatan_id" name="jabatan_id" class="form-control" autocomplete="off" >
                </div>
                <div class="form-group">
                    <label for="add_substansi_id">Substansi</label>
                    <input type="text" id="add_substansi_id" name="substansi_id" class="form-control" autocomplete="off" >
                </div>
                <div class="form-group">
                    <label for="add_image_user">Image User <span class="form-hint">(Hanya foto)</span></label>
                    <input type="file" id="add_image_user" name="image_user" accept="image/png, image/jpeg, image/jpg, image/gif" class="form-control">
                </div>
                <div class="form-group">
                    <label for="add_status_user">Status User</label>
                    <select id="add_status_user" name="status_user" class="select-control">
                        <option value="" selected disabled>Pilih Status User</option>
                        <option value="Aktif">Aktif</option>
                        <option value="Tidak Aktif">Tidak Aktif</option>
                        <option value="Diblokir">Diblokir</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="add_telp">Telepon/WhatsApp</label>
                    <input type="text" id="add_telp" name="telp" class="form-control" autocomplete="off" >
                </div>
                <div class="form-group">
                    <label for="add_no_dosir">No Dosir</label>
                    <input type="text" id="add_no_dosir" name="no_dosir" class="form-control" autocomplete="off" >
                </div>
                <div class="form-group">
                    <label for="add_tempat_lahir">Tempat Lahir</label>
                    <input type="text" id="add_tempat_lahir" name="tempat_lahir" class="form-control" autocomplete="off" >
                </div>
                <div class="form-group">
                    <label for="add_tanggal_lahir">Tanggal Lahir</label>
                    <input type="date" id="add_tanggal_lahir" name="tanggal_lahir" class="form-control" autocomplete="off" >
                </div>
                <div class="form-group">
                    <label for="add_jenis_kelamin">Jenis Kelamin</label>
                    <select id="add_jenis_kelamin" name="jenis_kelamin" class="select-control">
                        <option value="" selected disabled>Pilih Jenis Kelamin</option>
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="add_pangkat">Pangkat</label>
                    <input type="text" id="add_pangkat" name="pangkat" class="form-control" autocomplete="off" >
                </div>
                <div class="form-group">
                    <label for="add_tipe_pegawai">Tipe Pegawai</label>
                    <input type="text" id="add_tipe_pegawai" name="tipe_pegawai" class="form-control" autocomplete="off" >
                </div>
                <div class="form-group">
                    <label for="add_tmt_pangkat">TMT Pangkat</label>
                    <input type="date" id="add_tmt_pangkat" name="tmt_pangkat" class="form-control" autocomplete="off" >
                </div>
                <div class="form-group">
                    <label for="add_eselon">Eselon</label>
                    <input type="text" id="add_eselon" name="eselon" class="form-control" autocomplete="off" >
                </div>
                <div class="form-group">
                    <label for="add_kode_jabatan">Kode Jabatan</label>
                    <input type="text" id="add_kode_jabatan" name="kode_jabatan" class="form-control" autocomplete="off" >
                </div>
                <div class="form-group">
                    <label for="add_kelas_jabatan">Kelas Jabatan</label>
                    <input type="text" id="add_kelas_jabatan" name="kelas_jabatan" class="form-control" autocomplete="off" >
                </div>
                <div class="form-group">
                    <label for="add_fungsi_jabatan">Fungsi Jabatan</label>
                    <input type="text" id="add_fungsi_jabatan" name="fungsi_jabatan" class="form-control" autocomplete="off" >
                </div>
                <div class="form-group">
                    <label for="add_pendidikan">Pendidikan</label>
                    <select id="add_pendidikan" name="pendidikan" class="select-control">
                        <option value="" selected disabled>Pilih Pendidikan</option>
                        <option value="SD">SD</option>
                        <option value="SMP">SMP</option>
                        <option value="SMA/SMK">SMA/SMK</option>
                        <option value="D3">D3</option>
                        <option value="D4">D4</option>
                        <option value="S1">S1</option>
                        <option value="S2">S2</option>
                        <option value="S3">S3</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="add_jurusan">Jurusan</label>
                    <input type="text" id="add_jurusan" name="jurusan" class="form-control" autocomplete="off" >
                </div>
                <div class="form-group">
                    <label for="add_tahun_lulus">Tahun Lulus</label>
                    <select id="add_tahun_lulus" name="tahun_lulus" class="select-control">
                        <option value="" selected disabled>Pilih Tahun</option>
                        <?php 
                        $currentYear = date('Y');
                        for($y = $currentYear; $y >= 1950; $y--) {
                            echo "<option value=\"$y\">$y</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="add_nama_sekolah">Nama Sekolah</label>
                    <input type="text" id="add_nama_sekolah" name="nama_sekolah" class="form-control" autocomplete="off" >
                </div>
                <div class="form-group">
                    <label for="add_agama">Agama</label>
                    <select id="add_agama" name="agama" class="select-control">
                        <option value="" selected disabled>Pilih Agama</option>
                        <option value="Islam">Islam</option>
                        <option value="Kristen Protestan">Kristen Protestan</option>
                        <option value="Katolik">Katolik</option>
                        <option value="Hindu">Hindu</option>
                        <option value="Buddha">Buddha</option>
                        <option value="Konghucu">Konghucu</option>
                        <option value="Lainnya">Lainnya</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="add_tmt_jabatan">TMT Jabatan</label>
                    <input type="date" id="add_tmt_jabatan" name="tmt_jabatan" class="form-control" autocomplete="off" >
                </div>
                <div class="form-group">
                    <label for="add_status_pegawai">Status Pegawai</label>
                    <input type="text" id="add_status_pegawai" name="status_pegawai" class="form-control" autocomplete="off" >
                </div>
                <div class="form-group">
                    <label for="add_kedudukan">Kedudukan</label>
                    <input type="text" id="add_kedudukan" name="kedudukan" class="form-control" autocomplete="off" >
                </div>
                <div class="form-group">
                    <label for="add_tgl_pensiun">Tgl Pensiun</label>
                    <input type="date" id="add_tgl_pensiun" name="tgl_pensiun" class="form-control" autocomplete="off" >
                </div>
                <div class="form-group">
                    <label for="add_masa_kerja">Masa Kerja</label>
                    <input type="text" id="add_masa_kerja" name="masa_kerja" class="form-control" autocomplete="off" >
                </div>
                <div class="form-group">
                    <label for="add_status_nikah">Status Nikah</label>
                    <select id="add_status_nikah" name="status_nikah" class="select-control">
                        <option value="" selected disabled>Pilih Status Nikah</option>
                        <option value="Belum Kawin">Belum Kawin</option>
                        <option value="Kawin">Kawin</option>
                        <option value="Cerai Hidup">Cerai Hidup</option>
                        <option value="Cerai Mati">Cerai Mati</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="add_lama_jabatan">Lama Jabatan</label>
                    <input type="text" id="add_lama_jabatan" name="lama_jabatan" class="form-control" autocomplete="off" >
                </div>
                <div class="form-group">
                    <label for="add_belum_naikpangkat">Belum Naik Pangkat</label>
                    <input type="text" id="add_belum_naikpangkat" name="belum_naikpangkat" class="form-control" autocomplete="off" >
                </div>
                <div class="form-group">
                    <label for="add_rumpun_pendidikan">Rumpun Pendidikan</label>
                    <input type="text" id="add_rumpun_pendidikan" name="rumpun_pendidikan" class="form-control" autocomplete="off" >
                </div>
                <div class="form-group">
                    <label for="add_kontrak_awal">Kontrak Awal</label>
                    <input type="date" id="add_kontrak_awal" name="kontrak_awal" class="form-control" autocomplete="off" >
                </div>
                <div class="form-group">
                    <label for="add_kontrak_akhir">Kontrak Akhir</label>
                    <input type="date" id="add_kontrak_akhir" name="kontrak_akhir" class="form-control" autocomplete="off" >
                </div>
                <div class="form-group">
                    <label for="add_role">Role Akses <span style="color: red;">*</span></label>
                    <select id="add_role" name="role" class="select-control" required>
                        <option value="karyawan">Karyawan</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>
            </div>
            
            <div class="modal-footer mt-4">
                <button type="button" class="btn btn-secondary" onclick="closeAddModal()">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>

<!-- Edit Modal -->
<div id="editModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Edit Data Karyawan</h3>
            <button class="modal-close" type="button" onclick="closeEditModal()">&times;</button>
        </div>
        <form id="editForm" action="" method="POST" enctype="multipart/form-data">
            <?= csrf_field() ?>
            
            <div class="form-group form-group-password">
                <label for="edit_password">Password <span class="form-hint">(Kosongkan jika tidak diubah)</span></label>
                <div class="password-input-wrapper">
                    <input type="password" id="edit_password" name="password" class="form-control password-input" placeholder="Masukkan password baru...">
                    <i class="bi bi-eye-slash password-toggle-icon" id="toggle_edit_password" onclick="togglePassword('edit_password', 'toggle_edit_password')"></i>
                </div>
            </div>
            
            <div class="form-grid">
                <div class="form-group">
                    <label for="edit_username">Username <span class="form-label-required">*</span></label>
                    <input type="text" id="edit_username" name="username" class="form-control" autocomplete="off" required>
                </div>
                <div class="form-group">
                    <label for="edit_email">Email <span class="form-label-required">*</span></label>
                    <input type="text" id="edit_email" name="email" class="form-control" autocomplete="off" required>
                </div>
                <div class="form-group">
                    <label for="edit_nama">Nama <span class="form-label-required">*</span></label>
                    <input type="text" id="edit_nama" name="nama" class="form-control" autocomplete="off" required>
                </div>
                <div class="form-group">
                    <label for="edit_nip">NIP</label>
                    <input type="text" id="edit_nip" name="nip" class="form-control" autocomplete="off" >
                </div>
                <div class="form-group">
                    <label for="edit_jabatan_id">Jabatan</label>
                    <input type="text" id="edit_jabatan_id" name="jabatan_id" class="form-control" autocomplete="off" >
                </div>
                <div class="form-group">
                    <label for="edit_substansi_id">Substansi</label>
                    <input type="text" id="edit_substansi_id" name="substansi_id" class="form-control" autocomplete="off" >
                </div>
                <div class="form-group">
                    <label for="edit_image_user">Image User <span class="form-hint">(Kosongkan jika tidak diubah)</span></label>
                    <input type="file" id="edit_image_user" name="image_user" accept="image/png, image/jpeg, image/jpg, image/gif" class="form-control">
                    <input type="hidden" id="edit_old_image_user" name="old_image_user">
                </div>
                <div class="form-group">
                    <label for="edit_status_user">Status User</label>
                    <select id="edit_status_user" name="status_user" class="select-control">
                        <option value="" selected disabled>Pilih Status User</option>
                        <option value="Aktif">Aktif</option>
                        <option value="Tidak Aktif">Tidak Aktif</option>
                        <option value="Diblokir">Diblokir</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="edit_telp">Telepon/WhatsApp</label>
                    <input type="text" id="edit_telp" name="telp" class="form-control" autocomplete="off" >
                </div>
                <div class="form-group">
                    <label for="edit_no_dosir">No Dosir</label>
                    <input type="text" id="edit_no_dosir" name="no_dosir" class="form-control" autocomplete="off" >
                </div>
                <div class="form-group">
                    <label for="edit_tempat_lahir">Tempat Lahir</label>
                    <input type="text" id="edit_tempat_lahir" name="tempat_lahir" class="form-control" autocomplete="off" >
                </div>
                <div class="form-group">
                    <label for="edit_tanggal_lahir">Tanggal Lahir</label>
                    <input type="date" id="edit_tanggal_lahir" name="tanggal_lahir" class="form-control" autocomplete="off" >
                </div>
                <div class="form-group">
                    <label for="edit_jenis_kelamin">Jenis Kelamin</label>
                    <select id="edit_jenis_kelamin" name="jenis_kelamin" class="select-control">
                        <option value="" selected disabled>Pilih Jenis Kelamin</option>
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="edit_pangkat">Pangkat</label>
                    <input type="text" id="edit_pangkat" name="pangkat" class="form-control" autocomplete="off" >
                </div>
                <div class="form-group">
                    <label for="edit_tipe_pegawai">Tipe Pegawai</label>
                    <input type="text" id="edit_tipe_pegawai" name="tipe_pegawai" class="form-control" autocomplete="off" >
                </div>
                <div class="form-group">
                    <label for="edit_tmt_pangkat">TMT Pangkat</label>
                    <input type="date" id="edit_tmt_pangkat" name="tmt_pangkat" class="form-control" autocomplete="off" >
                </div>
                <div class="form-group">
                    <label for="edit_eselon">Eselon</label>
                    <input type="text" id="edit_eselon" name="eselon" class="form-control" autocomplete="off" >
                </div>
                <div class="form-group">
                    <label for="edit_kode_jabatan">Kode Jabatan</label>
                    <input type="text" id="edit_kode_jabatan" name="kode_jabatan" class="form-control" autocomplete="off" >
                </div>
                <div class="form-group">
                    <label for="edit_kelas_jabatan">Kelas Jabatan</label>
                    <input type="text" id="edit_kelas_jabatan" name="kelas_jabatan" class="form-control" autocomplete="off" >
                </div>
                <div class="form-group">
                    <label for="edit_fungsi_jabatan">Fungsi Jabatan</label>
                    <input type="text" id="edit_fungsi_jabatan" name="fungsi_jabatan" class="form-control" autocomplete="off" >
                </div>
                <div class="form-group">
                    <label for="edit_pendidikan">Pendidikan</label>
                    <select id="edit_pendidikan" name="pendidikan" class="select-control">
                        <option value="" selected disabled>Pilih Pendidikan</option>
                        <option value="SD">SD</option>
                        <option value="SMP">SMP</option>
                        <option value="SMA/SMK">SMA/SMK</option>
                        <option value="D3">D3</option>
                        <option value="D4">D4</option>
                        <option value="S1">S1</option>
                        <option value="S2">S2</option>
                        <option value="S3">S3</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="edit_jurusan">Jurusan</label>
                    <input type="text" id="edit_jurusan" name="jurusan" class="form-control" autocomplete="off" >
                </div>
                <div class="form-group">
                    <label for="edit_tahun_lulus">Tahun Lulus</label>
                    <select id="edit_tahun_lulus" name="tahun_lulus" class="select-control">
                        <option value="" selected disabled>Pilih Tahun</option>
                        <?php 
                        for($y = $currentYear; $y >= 1950; $y--) {
                            echo "<option value=\"$y\">$y</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="edit_nama_sekolah">Nama Sekolah</label>
                    <input type="text" id="edit_nama_sekolah" name="nama_sekolah" class="form-control" autocomplete="off" >
                </div>
                <div class="form-group">
                    <label for="edit_agama">Agama</label>
                    <select id="edit_agama" name="agama" class="select-control">
                        <option value="" selected disabled>Pilih Agama</option>
                        <option value="Islam">Islam</option>
                        <option value="Kristen Protestan">Kristen Protestan</option>
                        <option value="Katolik">Katolik</option>
                        <option value="Hindu">Hindu</option>
                        <option value="Buddha">Buddha</option>
                        <option value="Konghucu">Konghucu</option>
                        <option value="Lainnya">Lainnya</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="edit_tmt_jabatan">TMT Jabatan</label>
                    <input type="date" id="edit_tmt_jabatan" name="tmt_jabatan" class="form-control" autocomplete="off" >
                </div>
                <div class="form-group">
                    <label for="edit_status_pegawai">Status Pegawai</label>
                    <input type="text" id="edit_status_pegawai" name="status_pegawai" class="form-control" autocomplete="off" >
                </div>
                <div class="form-group">
                    <label for="edit_kedudukan">Kedudukan</label>
                    <input type="text" id="edit_kedudukan" name="kedudukan" class="form-control" autocomplete="off" >
                </div>
                <div class="form-group">
                    <label for="edit_tgl_pensiun">Tgl Pensiun</label>
                    <input type="date" id="edit_tgl_pensiun" name="tgl_pensiun" class="form-control" autocomplete="off" >
                </div>
                <div class="form-group">
                    <label for="edit_masa_kerja">Masa Kerja</label>
                    <input type="text" id="edit_masa_kerja" name="masa_kerja" class="form-control" autocomplete="off" >
                </div>
                <div class="form-group">
                    <label for="edit_status_nikah">Status Nikah</label>
                    <select id="edit_status_nikah" name="status_nikah" class="select-control">
                        <option value="" selected disabled>Pilih Status Nikah</option>
                        <option value="Belum Kawin">Belum Kawin</option>
                        <option value="Kawin">Kawin</option>
                        <option value="Cerai Hidup">Cerai Hidup</option>
                        <option value="Cerai Mati">Cerai Mati</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="edit_lama_jabatan">Lama Jabatan</label>
                    <input type="text" id="edit_lama_jabatan" name="lama_jabatan" class="form-control" autocomplete="off" >
                </div>
                <div class="form-group">
                    <label for="edit_belum_naikpangkat">Belum Naik Pangkat</label>
                    <input type="text" id="edit_belum_naikpangkat" name="belum_naikpangkat" class="form-control" autocomplete="off" >
                </div>
                <div class="form-group">
                    <label for="edit_rumpun_pendidikan">Rumpun Pendidikan</label>
                    <input type="text" id="edit_rumpun_pendidikan" name="rumpun_pendidikan" class="form-control" autocomplete="off" >
                </div>
                <div class="form-group">
                    <label for="edit_kontrak_awal">Kontrak Awal</label>
                    <input type="date" id="edit_kontrak_awal" name="kontrak_awal" class="form-control" autocomplete="off" >
                </div>
                <div class="form-group">
                    <label for="edit_kontrak_akhir">Kontrak Akhir</label>
                    <input type="date" id="edit_kontrak_akhir" name="kontrak_akhir" class="form-control" autocomplete="off" >
                </div>
                <div class="form-group">
                    <label for="edit_role">Role Akses <span class="form-label-required">*</span></label>
                    <select id="edit_role" name="role" class="select-control" required>
                        <option value="karyawan">Karyawan</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>
            </div>
            
            <div class="modal-footer mt-4">
                <button type="button" class="btn btn-secondary" onclick="closeEditModal()">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>



<script>
    const URL_USER_UPDATE = '<?= base_url('users/update') ?>';
</script>
