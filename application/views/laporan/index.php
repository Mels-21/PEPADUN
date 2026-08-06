<!-- Filters Row -->
<div class="filters-row card" style="display: flex; justify-content: space-between; align-items: center; padding: 1.5rem; margin-bottom: 1.5rem; box-shadow: 0 4px 12px rgba(0,0,0,0.03); border: none; border-radius: 12px;">
    <div class="filter-form-wrapper">
        <form id="filterForm" action="<?= base_url('laporan') ?>" method="GET" class="filter-form-inline">
            <div style="display: flex; gap: 1.5rem; align-items: center;">
                <div style="display: flex; align-items: center; gap: 0.5rem;">
                    <label class="filter-label" style="margin-bottom: 0; font-size: 0.85rem; color: var(--text-dark); white-space: nowrap;">Pilih Tahun</label>
                    <select name="year" class="select-control triwulan-select" onchange="this.form.submit()" style="min-width: 120px;">
                        <?php 
                        $yearQuery = $this->db->select('year')->distinct()->get('monitoring')->result_array();
                        $dbYears = array_column($yearQuery, 'year');
                        
                        $currentYear = (int) date('Y');
                        $startYear = 2025;
                        $loopYears = [];
                        for ($y = $currentYear; $y >= $startYear; $y--) {
                            $loopYears[] = $y;
                        }
                        
                        $years = array_unique(array_merge($dbYears, $loopYears));
                        rsort($years);
                        
                        foreach($years as $y): ?>
                            <option value="<?= $y ?>" <?= $selectedYear == $y ? 'selected' : '' ?>><?= $y ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div style="display: flex; align-items: center; gap: 0.5rem;">
                    <label class="filter-label" style="margin-bottom: 0; font-size: 0.85rem; color: var(--text-dark); white-space: nowrap;">Pilih Triwulan</label>
                    <select name="triwulan" class="select-control triwulan-select" onchange="this.form.submit()" style="min-width: 250px;">
                        <option value="1" <?= $selectedTriwulan == 1 ? 'selected' : '' ?>>Triwulan I (01 Jan - 31 Mar <?= $selectedYear ?>)</option>
                        <option value="2" <?= $selectedTriwulan == 2 ? 'selected' : '' ?>>Triwulan II (01 Apr - 30 Jun <?= $selectedYear ?>)</option>
                        <option value="3" <?= $selectedTriwulan == 3 ? 'selected' : '' ?>>Triwulan III (01 Jul - 30 Sep <?= $selectedYear ?>)</option>
                        <option value="4" <?= $selectedTriwulan == 4 ? 'selected' : '' ?>>Triwulan IV (01 Okt - 31 Des <?= $selectedYear ?>)</option>
                    </select>
                </div>
            </div>
        </form>
    </div>

    <div class="filter-actions" style="display: flex; gap: 0.75rem;">
        <a href="<?= base_url("monitoring/export_excel?year={$selectedYear}&triwulan={$selectedTriwulan}") ?>" class="btn-export-custom btn-excel">
            <i class="bi bi-file-earmark-excel-fill"></i> Export Excel
        </a>
        <a href="<?= base_url("monitoring/export_pdf?year={$selectedYear}&triwulan={$selectedTriwulan}") ?>" target="_blank" class="btn-export-custom btn-pdf">
            <i class="bi bi-file-earmark-pdf-fill"></i> Export PDF
        </a>
    </div>
</div>

<!-- Charts Grid -->
<div class="stats-grid" style="grid-template-columns: repeat(2, 1fr); margin-bottom: 1.5rem;">
    <!-- Donut Chart Card -->
    <div class="card stat-card-inner">
        <div class="stat-card-header-alt" style="margin-bottom: 1.5rem;">
            <h4 class="stat-title" style="color: var(--primary); font-weight: 700; font-size: 1rem;">Ringkasan Kepatuhan</h4>
        </div>
        <div style="display: flex; align-items: center; justify-content: center; gap: 2rem;">
            <div style="position: relative; width: 160px; height: 160px;">
                <canvas id="kepatuhanChart"></canvas>
                <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); text-align: center;">
                    <h2 style="margin: 0; font-size: 1.8rem; font-weight: 700; color: var(--text-dark);"><?= esc($tingkatKepatuhan ?? 0) ?>%</h2>
                    <span style="font-size: 0.65rem; color: var(--text-muted);">Kepatuhan</span>
                </div>
            </div>
            
            <div style="display: flex; flex-direction: column; gap: 0.75rem;">
                <div style="display: flex; align-items: center; justify-content: space-between; width: 200px;">
                    <div style="display: flex; align-items: center; gap: 0.5rem;">
                        <div style="width: 10px; height: 10px; border-radius: 50%; background-color: var(--success);"></div>
                        <span style="font-size: 0.85rem; color: var(--text-dark);">Selesai / Update</span>
                    </div>
                    <span style="font-size: 0.85rem; font-weight: 600;"><b><?= $statusCompleted ?></b> (<?= $totalMonitoring > 0 ? round(($statusCompleted/$totalMonitoring)*100) : 0 ?>%)</span>
                </div>
                <div style="display: flex; align-items: center; justify-content: space-between; width: 200px;">
                    <div style="display: flex; align-items: center; gap: 0.5rem;">
                        <div style="width: 10px; height: 10px; border-radius: 50%; background-color: var(--warning);"></div>
                        <span style="font-size: 0.85rem; color: var(--text-dark);">Dalam Proses</span>
                    </div>
                    <span style="font-size: 0.85rem; font-weight: 600;"><b><?= $statusProgress ?></b> (<?= $totalMonitoring > 0 ? round(($statusProgress/$totalMonitoring)*100) : 0 ?>%)</span>
                </div>
                <div style="display: flex; align-items: center; justify-content: space-between; width: 200px;">
                    <div style="display: flex; align-items: center; gap: 0.5rem;">
                        <div style="width: 10px; height: 10px; border-radius: 50%; background-color: var(--danger);"></div>
                        <span style="font-size: 0.85rem; color: var(--text-dark);">Belum Update</span>
                    </div>
                    <span style="font-size: 0.85rem; font-weight: 600;"><b><?= $statusPending ?></b> (<?= $totalMonitoring > 0 ? round(($statusPending/$totalMonitoring)*100) : 0 ?>%)</span>
                </div>
                <div style="display: flex; align-items: center; justify-content: space-between; width: 180px; margin-top: 0.5rem; padding-top: 0.5rem; border-top: 1px dashed var(--neutral-light);">
                    <div style="display: flex; align-items: center; gap: 0.5rem;">
                        <span style="font-size: 0.85rem; font-weight: 600; color: var(--text-dark);">Total Item</span>
                    </div>
                    <span style="font-size: 0.85rem; font-weight: 600;"><b><?= $totalMonitoring ?></b> Item</span>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Line Chart Card -->
    <div class="card stat-card-inner">
        <div class="stat-card-header-alt" style="margin-bottom: 1.5rem;">
            <h4 class="stat-title" style="color: var(--primary); font-weight: 700; font-size: 1rem;">Tren Kepatuhan per Triwulan</h4>
        </div>
        <div class="chart-canvas-wrapper" style="height: 180px; padding: 0;">
            <canvas id="trendChart"></canvas>
        </div>
    </div>
</div>

<!-- Table Section 2 Columns -->
<div class="table-cards-grid">
    <!-- Item Belum Update Card -->
    <div class="card table-card" style="border-top: 4px solid var(--danger); background-color: #fef2f2;">
        <div class="table-card-header">
            <div class="table-title-group">
                <h3 class="table-card-title" style="color: #991b1b;">Item Belum Diupdate (<?= count($pendingItems) ?>)</h3>
            </div>
            <a href="<?= base_url("monitoring?year={$selectedYear}&triwulan={$selectedTriwulan}&status=pending") ?>" class="btn btn-sm btn-view-all" style="color: var(--primary); background: transparent; border: none; font-weight: 500;">
                Lihat Semua
            </a>
        </div>
        
        <div class="table-responsive custom-table-container">
            <table class="custom-table dashboard-table" style="background: transparent;">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Informasi / Laporan</th>
                        <th>Kategori</th>
                        <th>Penanggung Jawab</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $hasPending = false;
                    $no = 1;
                    if (isset($pendingItems) && !empty($pendingItems)): 
                        foreach (array_slice($pendingItems, 0, 5) as $item): 
                            $hasPending = true;
                    ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td>
                                    <span class="item-title" style="color: #475569; font-weight: 400;"><?= esc($item['title']) ?></span>
                                </td>
                                <td><span class="item-text-muted"><?= esc($item['category_name'] ?: '-') ?></span></td>
                                <td><span style="color: var(--text-dark); font-size: 0.85rem; font-weight: 500;"><?= !empty($item['pj']) ? esc($item['pj']) : '-' ?></span></td>
                            </tr>
                    <?php 
                        endforeach;
                    endif; 
                    ?>
                    
                    <?php if (!$hasPending): ?>
                        <tr>
                            <td colspan="4" class="table-empty-cell">
                                Semua informasi pada Triwulan ini telah diperbarui!
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <?php if($hasPending): ?>
        <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 1rem;">
            <span style="font-size: 0.8rem; color: var(--text-muted);">Menampilkan 1 - <?= min(count($pendingItems), 5) ?> dari <?= count($pendingItems) ?> item</span>
            <!-- pagination mock -->
            <div class="pagination-mock">
                <button class="btn btn-sm btn-outline-secondary" disabled>&lt;</button>
                <button class="btn btn-sm btn-primary">1</button>
                <button class="btn btn-sm btn-outline-secondary">&gt;</button>
            </div>
        </div>
        <?php endif; ?>
    </div>

    <!-- Item Sudah Diupdate Card -->
    <div class="card table-card" style="border-top: 4px solid var(--success); background-color: #f0fdf4;">
        <div class="table-card-header">
            <div class="table-title-group">
                <h3 class="table-card-title" style="color: #15803d;">Item Sudah Diupdate (<?= count($completedItems) ?>)</h3>
            </div>
            <a href="<?= base_url("monitoring?year={$selectedYear}&triwulan={$selectedTriwulan}&status=completed") ?>" class="btn btn-sm btn-view-all" style="color: var(--primary); background: transparent; border: none; font-weight: 500;">
                Lihat Semua
            </a>
        </div>
        
        <div class="table-responsive custom-table-container">
            <table class="custom-table dashboard-table" style="background: transparent;">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Informasi / Laporan</th>
                        <th>Kategori</th>
                        <th>Tanggal Update</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $hasCompleted = false;
                    $no = 1;
                    if (isset($completedItems) && !empty($completedItems)): 
                        foreach (array_slice($completedItems, 0, 5) as $item): 
                            $hasCompleted = true;
                    ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td>
                                    <span class="item-title" style="color: #475569; font-weight: 400;"><?= esc($item['title']) ?></span>
                                </td>
                                <td><span class="item-text-muted"><?= esc($item['category_name'] ?: '-') ?></span></td>
                                <td><span style="color: var(--success); font-size: 0.85rem; font-weight: 500;"><?= date('d M Y', strtotime($item['updated_at'])) ?></span></td>
                            </tr>
                    <?php 
                        endforeach;
                    endif; 
                    ?>
                    
                    <?php if (!$hasCompleted): ?>
                        <tr>
                            <td colspan="4" class="table-empty-cell">
                                Belum ada informasi yang diperbarui pada Triwulan ini.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <?php if($hasCompleted): ?>
        <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 1rem;">
            <span style="font-size: 0.8rem; color: var(--text-muted);">Menampilkan 1 - <?= min(count($completedItems), 5) ?> dari <?= count($completedItems) ?> item</span>
            <!-- pagination mock -->
            <div class="pagination-mock">
                <button class="btn btn-sm btn-outline-secondary" disabled>&lt;</button>
                <button class="btn btn-sm btn-primary">1</button>
                <button class="btn btn-sm btn-outline-secondary">&gt;</button>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>

<!-- Detail Monitoring Table -->
<div class="card table-card" style="margin-bottom: 2rem;">
    <div class="table-card-header">
        <h3 class="table-card-title" style="color: var(--primary);">Detail Monitoring</h3>
    </div>
    <div class="table-responsive custom-table-container">
        <table class="custom-table dashboard-table">
            <thead>
                <tr>
                    <th style="width: 50px;">No.</th>
                    <th>Nama Informasi / Laporan</th>
                    <th>Kategori</th>
                    <th>Status</th>
                    <th>Penanggung Jawab (PJ)</th>
                    <th>Tanggal Update</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                if (isset($allItems) && !empty($allItems)): 
                    $no = 1;
                    foreach (array_slice($allItems, 0, 10) as $item): 
                ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= esc($item['title']) ?></td>
                            <td><span class="item-text-muted"><?= esc($item['category_name'] ?: '-') ?></span></td>
                            <td>
                                <?php if($item['status'] == 'completed'): ?>
                                    <span class="badge" style="background-color: #dcfce7; color: #166534; padding: 0.35rem 0.65rem; border-radius: 4px; font-weight: 500; font-size: 0.75rem;">Selesai / Update</span>
                                <?php elseif($item['status'] == 'progress'): ?>
                                    <span class="badge" style="background-color: #fef9c3; color: #854d0e; padding: 0.35rem 0.65rem; border-radius: 4px; font-weight: 500; font-size: 0.75rem;">Dalam Proses</span>
                                <?php else: ?>
                                    <span class="badge" style="background-color: #ffedd5; color: #9a3412; padding: 0.35rem 0.65rem; border-radius: 4px; font-weight: 500; font-size: 0.75rem;">Belum Update</span>
                                <?php endif; ?>
                            </td>
                            <td><?= esc($item['pj'] ?: '-') ?></td>
                            <td><?= ($item['status'] == 'completed') ? date('d M Y', strtotime($item['updated_at'])) : '-' ?></td>
                            <td><span class="item-text-muted"><?= esc($item['description'] ?: '-') ?></span></td>
                        </tr>
                <?php 
                    endforeach;
                else: 
                ?>
                    <tr>
                        <td colspan="7" class="table-empty-cell">Belum ada data</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    
    <?php if(!empty($allItems)): ?>
    <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 1.5rem; padding-top: 1rem; border-top: 1px solid var(--neutral-light);">
        <span style="font-size: 0.8rem; color: var(--text-muted);">Menampilkan 1 - <?= min(count($allItems), 10) ?> dari <?= count($allItems) ?> item</span>
        <div class="pagination-mock">
            <button class="btn btn-sm btn-outline-secondary" disabled>&lt;</button>
            <button class="btn btn-sm btn-primary">1</button>
            <button class="btn btn-sm btn-outline-secondary">&gt;</button>
        </div>
    </div>
    <?php endif; ?>
</div>

<style>
.pagination-mock {
    display: flex;
    gap: 0.25rem;
}
.pagination-mock .btn {
    min-width: 32px;
    height: 32px;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 0;
}
</style>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const CHART_DATA = {
        completed: <?= $statusCompleted ?>,
        progress: <?= $statusProgress ?>,
        pending: <?= $statusPending ?>,
        trend: <?= json_encode($trendChart) ?>
    };
</script>
