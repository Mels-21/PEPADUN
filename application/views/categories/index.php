<!-- Header Action Card -->
<div class="card header-action-card">
    <div class="header-action-container">
        <!-- Left side: Search Filter -->
        <form action="<?= base_url('categories') ?>" method="GET" class="header-search-form">
            <div class="input-icon-wrapper header-search-input-wrapper">
                <input type="text" id="search" name="search" class="form-control form-control-icon header-search-input" placeholder="Cari kategori..." value="<?= isset($searchQuery) ? esc($searchQuery) : '' ?>" autocomplete="off" onkeypress="if(event.keyCode === 13) { this.form.submit(); return false; }">
                <i class="bi bi-search header-search-icon"></i>
            </div>
        </form>

        <!-- Right side: Actions -->
        <div class="header-actions-container">
            <?php if (!empty($searchQuery)): ?>
                <a href="<?= base_url('categories') ?>" class="btn btn-secondary btn-reset">
                    Reset
                </a>
            <?php endif; ?>
            <?php if (session()->get('role') === 'admin'): ?>
                <button type="button" class="btn btn-primary btn-add-data" onclick="openAddModal()">
                    <i class="bi bi-plus-lg"></i> Tambah Kategori
                </button>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Table Container -->
<div class="table-responsive">
    <table class="custom-table">
        <thead>
            <tr>
                <th class="col-no">No.</th>
                <th class="col-name">Nama Kategori</th>
                <th class="col-desc">Deskripsi Kategori</th>
                <th class="col-action">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($categories)): ?>
                <tr>
                    <td colspan="4" class="table-empty-state">
                        <i class="bi bi-folder-x empty-state-icon"></i>
                        Belum ada kategori yang terdaftar.
                    </td>
                </tr>
            <?php else: ?>
                <?php foreach ($categories as $index => $cat): ?>
                    <tr>
                        <td class="cell-index"><?= $index + 1 ?></td>
                        <td class="cell-name"><?= esc($cat['name']) ?></td>
                        <td class="cell-desc"><?= esc($cat['description'] ?: '-') ?></td>
                        <td class="cell-action">
                            <div class="action-buttons-wrapper">
                                <?php if (session()->get('role') === 'admin'): ?>
                                    <button type="button" onclick="openEditModal(<?= esc($cat['id']) ?>, '<?= addslashes(esc($cat['name'])) ?>', '<?= addslashes(esc($cat['description'] ?: '')) ?>')" title="Edit Kategori" class="btn-icon-edit">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <a href="<?= base_url('categories/delete/' . $cat['id']) ?>" title="Hapus Kategori" onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini? Data monitoring terkait mungkin terdampak.')" class="btn-icon-delete">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                <?php else: ?>
                                    <span class="text-readonly">Hanya Lihat</span>
                                <?php endif; ?>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<!-- Add Modal -->
<div id="addModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Tambah Kategori Baru</h3>
            <button class="modal-close" onclick="closeAddModal()">&times;</button>
        </div>
        <form action="<?= base_url('categories/store') ?>" method="POST">
            <?= csrf_field() ?>
            <div class="form-group">
                <label for="add_name">Nama Kategori <span class="form-label-required">*</span></label>
                <input type="text" id="add_name" name="name" class="form-control" placeholder="Masukkan nama kategori (misal: Kepegawaian)..." required autocomplete="off">
            </div>
            <div class="form-group">
                <label for="add_description">Deskripsi (Opsional)</label>
                <textarea id="add_description" name="description" class="textarea-control" placeholder="Masukkan deskripsi singkat kategori kerja..."></textarea>
            </div>
            <div class="modal-footer">
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
            <h3>Edit Kategori</h3>
            <button class="modal-close" onclick="closeEditModal()">&times;</button>
        </div>
        <form id="editForm" action="" method="POST">
            <?= csrf_field() ?>
            <div class="form-group">
                <label for="edit_name">Nama Kategori <span class="form-label-required">*</span></label>
                <input type="text" id="edit_name" name="name" class="form-control" required autocomplete="off">
            </div>
            <div class="form-group">
                <label for="edit_description">Deskripsi (Opsional)</label>
                <textarea id="edit_description" name="description" class="textarea-control"></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeEditModal()">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>

<script>
    const URL_CATEGORY_UPDATE = '<?= base_url('categories/update') ?>';
</script>
