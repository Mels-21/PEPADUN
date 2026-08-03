<!-- Quarter Tabs System (Triwulan I - IV) protected by current year state -->
<div class="triwulan-tabs-container">
    <?php 
        $triwulanLabels = [
            1 => 'Triwulan I (Jan - Mar)',
            2 => 'Triwulan II (Apr - Jun)',
            3 => 'Triwulan III (Jul - Sep)',
            4 => 'Triwulan IV (Okt - Des)'
        ];
        for ($t = 1; $t <= 4; $t++): 
    ?>
        <a href="<?= base_url("monitoring?year={$selectedYear}&triwulan={$t}") ?>" 
           class="triwulan-tab-btn <?= ((int)$selectedTriwulan === $t) ? 'active' : '' ?>">
            <?= $triwulanLabels[$t] ?>
        </a>
    <?php endfor; ?>
</div>

<!-- Filtering and Search Bar matching Mockup exactly on a single line -->
<div class="card header-action-card">
    <form action="<?= base_url('monitoring') ?>" method="GET" id="filterForm" onsubmit="event.preventDefault(); submitFilters();">
        <!-- Preserve year and triwulan states -->
        <input type="hidden" name="year" value="<?= esc($selectedYear) ?>">
        <input type="hidden" name="triwulan" value="<?= esc($selectedTriwulan) ?>">
        
        <div class="header-filter-container">
            <!-- Left side: Filters -->
            <div class="filter-controls-group">
                <!-- Search input -->
                <div class="input-icon-wrapper search-input-wrapper">
                    <input type="text" id="search" name="search" class="form-control form-control-icon search-input-field" placeholder="Cari informasi..." value="<?= esc($searchQuery ?? '') ?>" autocomplete="off" onkeypress="if(event.keyCode === 13) { submitFilters(); return false; }">
                    <i class="bi bi-search search-icon-btn" id="searchIcon" onclick="submitFilters()"></i>
                </div>

                <!-- Category filter dropdown -->
                <select id="category" name="category" class="select-control filter-select" onchange="submitFilters()">
                    <option value="">Semua Kategori</option>
                    <?php foreach ($categories as $cat): 
                        if (strtolower(trim($cat['name'])) === 'tanpa kategori') continue;
                    ?>
                        <option value="<?= esc($cat['id']) ?>" <?= ($selectedCategory == $cat['id']) ? 'selected' : '' ?>>
                            <?= esc($cat['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <!-- Status filter dropdown -->
                <select id="status" name="status" class="select-control filter-select" onchange="submitFilters()">
                    <option value="">Semua Status</option>
                    <option value="pending" <?= ($selectedStatus == 'pending') ? 'selected' : '' ?>>Belum Update</option>
                    <option value="progress" <?= ($selectedStatus == 'progress') ? 'selected' : '' ?>>Dalam Proses</option>
                    <option value="completed" <?= ($selectedStatus == 'completed') ? 'selected' : '' ?>>Selesai (Completed)</option>
                </select>
                
                <!-- Action buttons for filtering -->
                <?php if (!empty($searchQuery) || !empty($selectedCategory) || !empty($selectedStatus)): ?>
                    <a href="<?= base_url("monitoring?year={$selectedYear}&triwulan={$selectedTriwulan}") ?>" class="btn btn-secondary reset-filter-btn">
                        Reset Filter
                    </a>
                <?php endif; ?>
            </div>

            <!-- Right side: Actions -->
            <div class="actions-controls-group">
                <?php if (session()->get('role') === 'admin'): ?>
                <button type="button" class="btn btn-primary btn-add-data" onclick="openTambahModal()">
                    <i class="bi bi-plus-lg"></i> Tambah
                </button>
                <?php endif; ?>
                <?php
                    $exportQuery = "year={$selectedYear}&triwulan={$selectedTriwulan}";
                    if (!empty($selectedCategory)) $exportQuery .= "&category=" . urlencode($selectedCategory);
                    if (!empty($selectedStatus)) $exportQuery .= "&status=" . urlencode($selectedStatus);
                    if (!empty($searchQuery)) $exportQuery .= "&search=" . urlencode($searchQuery);
                ?>
                
                <!-- Custom Export Dropdown -->
                <div class="export-dropdown-wrapper" onmouseover="this.querySelector('.export-menu-container').style.display='block'" onmouseout="this.querySelector('.export-menu-container').style.display='none'">
                    <button type="button" class="btn btn-secondary export-dropdown-btn">
                        <i class="bi bi-download"></i> Export <i class="bi bi-chevron-down export-dropdown-icon"></i>
                    </button>
                    <!-- padding-top is used to bridge the hover gap between button and menu -->
                    <div class="export-menu-container" style="display: none;">
                        <div class="export-menu-card">
                            <a href="<?= base_url('monitoring/export_excel?' . $exportQuery) ?>" id="exportExcelBtn" class="export-item">
                                <i class="bi bi-file-earmark-excel export-item-icon-excel"></i> Excel
                            </a>
                            <a href="<?= base_url('monitoring/export_pdf?' . $exportQuery) ?>" id="exportPdfBtn" target="_blank" class="export-item">
                                <i class="bi bi-file-earmark-pdf export-item-icon-pdf"></i> PDF
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- Table Panel -->
<div class="table-responsive">
    <table class="custom-table" style="min-width: 1000px;">
        <thead>
            <tr>
                <th style="width: 5%;">No.</th>
                <th style="width: 25%;">Nama Informasi</th>
                <th style="width: 12%;">Kategori</th>
                <th style="width: 12%;">PJ</th>
                <th style="width: 10%;">Timeline</th>
                <th style="width: 13%;">Status</th>
                <th style="width: 12%;">Keterangan</th>
                <th style="width: 6%; text-align: center;">Tautan</th>
                <th style="width: 8%; text-align: center;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($monitoringList)): ?>
                <tr>
                    <td colspan="9" class="table-empty-state">
                        Belum ada data monitoring keterbukaan informasi pada Triwulan ini.
                    </td>
                </tr>
            <?php else: ?>
                <?php foreach ($monitoringList as $index => $item): ?>
                    <tr>
                        <td><?= $index + 1 + (($currentPage - 1) * $perPage) ?></td>
                        <td class="cell-name"><?= esc($item['custom_name'] ?: $item['name']) ?></td>
                        <td><?= esc(empty($item['category_name']) || strtolower(trim($item['category_name'])) === 'tanpa kategori' || strtolower(trim($item['category_name'])) === 'lainnya' ? '-' : $item['category_name']) ?></td>
                        <td class="cell-pj"><?= esc($item['pj'] ?: '-') ?></td>
                        <td class="cell-timeline">
                            <?= esc($item['timeline'] ?: '-') ?>
                        </td>
                        <td>
                            <?php if ($item['status'] === 'completed'): ?>
                                <span class="badge badge-selesai">
                                    <i class="bi bi-check-circle-fill"></i> Selesai
                                </span>
                            <?php elseif ($item['status'] === 'progress'): ?>
                                <span class="badge badge-proses">
                                    <i class="bi bi-clock-fill"></i> Dalam Proses
                                </span>
                            <?php else: ?>
                                <span class="badge badge-belum-update">
                                    <i class="bi bi-exclamation-circle-fill"></i> Belum Update
                                </span>
                            <?php endif; ?>
                        </td>
                        <td class="cell-description"><?= esc($item['description'] ?: '-') ?></td>
                        <td class="cell-center">
                            <?php if (!empty($item['tautan'])): ?>
                                <a href="<?= esc($item['tautan']) ?>" target="_blank" class="btn-tertiary link-btn" title="<?= esc($item['tautan']) ?>">
                                    <i class="bi bi-link-45deg"></i>
                                </a>
                            <?php else: ?>
                                <span class="cell-link-empty">-</span>
                            <?php endif; ?>
                        </td>
                        <td class="cell-center" style="white-space: nowrap;">
                            <?php 
                                $canModify = false;
                                $canDelete = false;
                                if (session()->get('role') === 'admin') {
                                    $canModify = true;
                                    $canDelete = true;
                                } elseif (session()->get('role') === 'karyawan' && $item['pj'] === session()->get('nama')) {
                                    $canModify = true;
                                }
                            ?>
                            <div class="action-buttons-wrapper">
                                <?php if ($canModify): ?>
                                    <?php
                                    $modalData = [
                                        'id' => $item['id'],
                                        'year' => $selectedYear,
                                        'triwulan' => $selectedTriwulan,
                                        'custom_name' => $item['custom_name'] ?: $item['name'],
                                        'status' => $item['status'] ?: 'pending',
                                        'pj' => $item['pj'] ?: '',
                                        'description' => $item['description'] ?: '',
                                        'category_id' => $item['category_id'],
                                        'timeline' => $item['timeline'],
                                        'tautan' => $item['tautan'] ?: ''
                                    ];
                                    ?>
                                    <button type="button" onclick='openEditModal(<?= htmlspecialchars(json_encode($modalData), ENT_QUOTES, "UTF-8") ?>)' title="Update Status" class="btn-icon-edit">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                <?php endif; ?>
                                <?php if ($canDelete): ?>
                                    <button type="button" onclick="openDeleteModal(<?= $item['id'] ?>, <?= $selectedYear ?>, <?= $selectedTriwulan ?>)" title="Hapus Laporan" class="btn-icon-delete">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                <?php endif; ?>
                                <?php if (!$canModify && !$canDelete): ?>
                                    <span class="locked-icon" title="Terkunci: Akses ditolak">
                                        <i class="bi bi-lock-fill"></i>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>



<!-- Header Action Card -->
<?php if ($totalRows > 0): ?>
    <?php
        $startItem = (($currentPage - 1) * $perPage) + 1;
        $endItem = min($currentPage * $perPage, $totalRows);
        
        $build_page_url = function($p) use ($perPage) {
            $ci =& get_instance();
            $params = $ci->input->get();
            $params['page'] = $p;
            $params['per_page'] = $perPage;
            return base_url('monitoring') . '?' . http_build_query($params);
        };
    ?>
<div class="pagination-wrapper pagination-container">
    <div class="pagination-info">
        Menampilkan <?= $startItem ?> - <?= $endItem ?> dari <?= $totalRows ?> data
    </div>
    
    <div class="pagination-pages pagination-pages-group">
        <a href="<?= $build_page_url(1) ?>" class="pagination-page-btn" title="First Page" <?= $currentPage <= 1 ? 'style="pointer-events:none; opacity:0.5;"' : '' ?>>
            <i class="bi bi-chevron-double-left"></i>
        </a>
        <a href="<?= $build_page_url(max(1, $currentPage - 1)) ?>" class="pagination-page-btn" title="Previous Page" <?= $currentPage <= 1 ? 'style="pointer-events:none; opacity:0.5;"' : '' ?>>
            <i class="bi bi-chevron-left"></i>
        </a>
        
        <?php
            $startPage = max(1, $currentPage - 2);
            $endPage = min($totalPages, $currentPage + 2);
            
            if ($startPage > 1) {
                echo '<button class="pagination-page-btn d-none d-sm-inline-block pagination-ellipsis" disabled>...</button>';
            }
            
            for ($p = $startPage; $p <= $endPage; $p++) {
                $activeClass = $p === $currentPage ? 'active' : 'd-none d-sm-inline-block';
                echo '<a href="'.$build_page_url($p).'" class="pagination-page-btn '.$activeClass.' pagination-link">'.$p.'</a>';
            }
            
            if ($endPage < $totalPages) {
                echo '<button class="pagination-page-btn d-none d-sm-inline-block pagination-ellipsis" disabled>...</button>';
            }
        ?>
        
        <a href="<?= $build_page_url(min($totalPages, $currentPage + 1)) ?>" class="pagination-page-btn" title="Next Page" <?= $currentPage >= $totalPages ? 'style="pointer-events:none; opacity:0.5;"' : '' ?>>
            <i class="bi bi-chevron-right"></i>
        </a>
        <a href="<?= $build_page_url($totalPages) ?>" class="pagination-page-btn" title="Last Page" <?= $currentPage >= $totalPages ? 'style="pointer-events:none; opacity:0.5;"' : '' ?>>
            <i class="bi bi-chevron-double-right"></i>
        </a>
    </div>
    
    <div>
        <select class="select-control per-page-select" id="perPageSelect">
            <option value="10" <?= $perPage == 10 ? 'selected' : '' ?>>10 / halaman</option>
            <option value="25" <?= $perPage == 25 ? 'selected' : '' ?>>25 / halaman</option>
            <option value="50" <?= $perPage == 50 ? 'selected' : '' ?>>50 / halaman</option>
        </select>
    </div>
</div>
<?php endif; ?>

<!-- Modal Tambah Data Global -->
<div id="tambahDataModal" class="modal">
  <div class="modal-content modal-content-lg">
      <div class="modal-header">
        <h3 class="modal-title">Tambah Informasi</h3>
        <button type="button" class="modal-close" onclick="closeTambahModal()">&times;</button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url('monitoring/store_master') ?>" method="POST">
            <?= csrf_field() ?>
            <input type="hidden" name="year" value="<?= esc($selectedYear) ?>">
            <input type="hidden" name="triwulan" value="<?= esc($selectedTriwulan) ?>">

            <div class="form-group">
                <label for="add_name">Nama Informasi <span class="form-label-required">*</span></label>
                <input type="text" id="add_name" name="name" class="form-control" placeholder="Tulis nama informasi..." required autocomplete="off">
            </div>
            
            <div class="form-row-flex">
                <div class="form-group form-group-flex-1">
                    <label for="add_category">Kategori <span class="form-label-required">*</span></label>
                    <select id="add_category" name="category_id" class="select-control select-control-bg" required>
                        <option value="">Pilih Kategori</option>
                        <?php foreach ($categories as $cat): ?>
                            <?php if (strtolower(trim($cat['name'])) !== 'tanpa kategori'): ?>
                                <option value="<?= esc($cat['id']) ?>"><?= esc($cat['name']) ?></option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group form-group-flex-1">
                    <label for="add_timeline">Timeline <span class="form-label-required">*</span></label>
                    <select id="add_timeline" name="timeline" class="select-control select-control-bg" required>
                        <option value="">Pilih Timeline</option>
                        <option value="Realtime">Realtime</option>
                        <option value="Harian">Harian</option>
                        <option value="Mingguan">Mingguan</option>
                        <option value="Bulanan">Bulanan</option>
                        <option value="Triwulan">Triwulan</option>
                        <option value="Semester">Semester</option>
                        <option value="Tahunan">Tahunan</option>
                    </select>
                </div>
            </div>

            <div class="form-row-flex">
                <div class="form-group form-group-flex-1">
                    <label for="add_status">Status <span class="form-label-required">*</span></label>
                    <select id="add_status" name="status" class="select-control select-control-bg" required>
                        <option value="pending" selected>Belum Update</option>
                        <option value="progress">Dalam Proses</option>
                        <option value="completed">Selesai</option>
                    </select>
                </div>
                <div class="form-group form-group-flex-1">
                    <label for="add_pj">Penanggung Jawab (Opsional)</label>
                    <select id="add_pj" name="pj" placeholder="Pilih atau ketik nama PJ..." autocomplete="off">
                        <option value="">Pilih atau ketik nama PJ...</option>
                        <?php if(isset($users)): ?>
                            <?php foreach($users as $user): ?>
                                <option value="<?= esc($user['nama']) ?>"><?= esc($user['nama']) ?></option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>
            </div>
            
            <div class="form-group">
                <label for="add_tautan">Tautan / Link <span class="form-label-required">*</span></label>
                <input type="url" id="add_tautan" name="tautan" class="form-control" placeholder="Contoh: https://link-dokumen.com" required autocomplete="off">
            </div>

            <div class="form-group">
                <label for="add_description">Keterangan (Opsional)</label>
                <textarea id="add_description" name="description" class="textarea-control textarea-min-height" placeholder="Tuliskan keterangan..."></textarea>
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeTambahModal()">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
      </div>
  </div>
</div>

<!-- Modal Update Status Monitoring -->
<div id="editDataModal" class="modal">
  <div class="modal-content modal-content-lg">
      <div class="modal-header">
        <h3 class="modal-title">Update Data Monitoring</h3>
        <button type="button" class="modal-close" onclick="closeEditModal()">&times;</button>
      </div>
      <div class="modal-body">
        <p class="modal-subtitle" id="editModalSubtitle">
          Mengupdate data untuk Triwulan
        </p>
        
        <form id="editForm" action="" method="POST">
            <?= csrf_field() ?>
            <div class="form-group">
                <label for="edit_custom_name">Nama Informasi <span class="form-label-required">*</span></label>
                <input type="text" id="edit_custom_name" name="custom_name" class="form-control" required autocomplete="off">
            </div>
            
            <div class="form-row-flex">
                <div class="form-group form-group-flex-1">
                    <label for="edit_category">Kategori <span class="form-label-required">*</span></label>
                    <select id="edit_category" name="category_id" class="select-control select-control-bg" required>
                        <option value="">Pilih Kategori</option>
                        <?php foreach ($categories as $cat): ?>
                            <?php if (strtolower(trim($cat['name'])) !== 'tanpa kategori'): ?>
                                <option value="<?= esc($cat['id']) ?>"><?= esc($cat['name']) ?></option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group form-group-flex-1">
                    <label for="edit_timeline">Timeline <span class="form-label-required">*</span></label>
                    <select id="edit_timeline" name="timeline" class="select-control select-control-bg" required>
                        <option value="">Pilih Timeline</option>
                        <option value="Realtime">Realtime</option>
                        <option value="Harian">Harian</option>
                        <option value="Mingguan">Mingguan</option>
                        <option value="Bulanan">Bulanan</option>
                        <option value="Triwulan">Triwulan</option>
                        <option value="Semester">Semester</option>
                        <option value="Tahunan">Tahunan</option>
                    </select>
                </div>
            </div>

            <div class="form-row-flex">
                <div class="form-group form-group-flex-1">
                    <label for="edit_status">Status <span class="form-label-required">*</span></label>
                    <select id="edit_status" name="status" class="select-control select-control-bg" required>
                        <option value="pending">Belum Update</option>
                        <option value="progress">Dalam Proses</option>
                        <option value="completed">Selesai (Completed)</option>
                    </select>
                </div>
                <div class="form-group form-group-flex-1">
                    <label for="edit_pj">Penanggung Jawab (Opsional)</label>
                    <select id="edit_pj" name="pj" placeholder="Pilih atau ketik nama PJ..." autocomplete="off">
                        <option value="">Pilih atau ketik nama PJ...</option>
                        <?php if(isset($users)): ?>
                            <?php foreach($users as $user): ?>
                                <option value="<?= esc($user['nama']) ?>"><?= esc($user['nama']) ?></option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>
            </div>
            
            <div class="form-group">
                <label for="edit_tautan">Tautan / Link <span class="form-label-required">*</span></label>
                <input type="url" id="edit_tautan" name="tautan" class="form-control" placeholder="Contoh: https://link-dokumen.com" required autocomplete="off">
            </div>

            <div class="form-group">
                <label for="edit_description">Keterangan (Opsional)</label>
                <textarea id="edit_description" name="description" class="textarea-control textarea-min-height" placeholder="Tuliskan keterangan..."></textarea>
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeEditModal()">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
      </div>
  </div>
</div>

<script>
    const BASE_URL = '<?= base_url() ?>';
</script>

<!-- Delete Choice Modal -->
<div id="deleteModal" class="delete-modal-overlay" onclick="closeDeleteModal()" style="display: none;">
    <div class="delete-modal-content" onclick="event.stopPropagation()">
        <div class="delete-modal-header">
            <i class="bi bi-exclamation-triangle-fill delete-modal-icon"></i>
            <h3 class="delete-modal-title">Hapus Data Monitoring</h3>
        </div>
        
        <div class="delete-actions-group">
            <a id="btnDeleteLocal" href="#" class="btn-delete-action btn-warning-action">
                <i class="bi bi-calendar-x"></i> Hanya Hapus di Triwulan Ini
            </a>
            <a id="btnDeleteGlobal" href="#" class="btn-delete-action btn-danger-action" onclick="return confirm('PERINGATAN: Ini akan menghapus data selamanya dari Triwulan 1 sampai 4! Anda yakin?')">
                <i class="bi bi-trash-fill"></i> Hapus Seluruhnya
            </a>
        </div>
    </div>
</div>


