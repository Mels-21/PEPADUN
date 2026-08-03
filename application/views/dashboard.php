<!-- Filters Row -->
<div class="filters-row">
    <div class="filter-date-info">
        <i class="bi bi-calendar3"></i> Hari ini: <?= date('d M Y') ?>
    </div>
    
    <div class="filter-form-wrapper">
        <form id="filterForm" action="<?= base_url('dashboard') ?>" method="GET" class="filter-form-inline">
            <input type="hidden" name="year" value="<?= $selectedYear ?>">
            <label class="filter-label">Triwulan Aktif:</label>
            <select name="triwulan" class="select-control triwulan-select" onchange="this.form.submit()">
                <option value="1" <?= $selectedTriwulan == 1 ? 'selected' : '' ?>>Triwulan I (01 Jan - 31 Mar <?= $selectedYear ?>)</option>
                <option value="2" <?= $selectedTriwulan == 2 ? 'selected' : '' ?>>Triwulan II (01 Apr - 30 Jun <?= $selectedYear ?>)</option>
                <option value="3" <?= $selectedTriwulan == 3 ? 'selected' : '' ?>>Triwulan III (01 Jul - 30 Sep <?= $selectedYear ?>)</option>
                <option value="4" <?= $selectedTriwulan == 4 ? 'selected' : '' ?>>Triwulan IV (01 Okt - 31 Des <?= $selectedYear ?>)</option>
            </select>
        </form>
    </div>

    <div class="last-update-info">
        <i class="bi bi-clock-history"></i> Terakhir diperbarui: 
        <?= !empty($lastUpdate) ? date('d M Y H:i', strtotime($lastUpdate)) . ' WIB' : 'Belum ada data' ?>
    </div>
</div>

<!-- Stats Grid -->
<div class="stats-grid">
    <!-- Card 1: Tingkat Kepatuhan -->
    <div class="card stat-card-inner">
        <div class="stat-card-header-alt">
            <div>
                <h4 class="stat-title">Tingkat Kepatuhan</h4>
                <h2 class="stat-value"><?= esc($tingkatKepatuhan ?? 0) ?>%</h2>
                <p class="stat-desc">Kepatuhan Informasi Publik</p>
            </div>
            <div class="stat-icon-wrapper icon-primary">
                <i class="bi bi-graph-up"></i>
            </div>
        </div>
        <div class="progress-bar-container">
            <div class="progress-bar-bg">
                <div class="progress-bar-fill progress-fill-primary" style="width: <?= esc($tingkatKepatuhan ?? 0) ?>%;"></div>
            </div>
        </div>
    </div>
    
    <!-- Card 2: Selesai / Update -->
    <div class="card stat-card-inner">
        <div class="stat-card-header-alt">
            <div>
                <h4 class="stat-title">Selesai / Update</h4>
                <h2 class="stat-value"><?= esc($statusCompleted ?? 0) ?></h2>
                <p class="stat-desc">Dari <?= esc($totalMonitoring ?? 0) ?> Item</p>
            </div>
            <div class="stat-icon-wrapper icon-success">
                <i class="bi bi-check-lg"></i>
            </div>
        </div>
        <div class="progress-bar-container">
            <?php $percentCompleted = $totalMonitoring > 0 ? round(($statusCompleted / $totalMonitoring) * 100) : 0; ?>
            <div class="progress-bar-bg">
                <div class="progress-bar-fill progress-fill-success" style="width: <?= $percentCompleted ?>%;"></div>
            </div>
        </div>
    </div>
    
    <!-- Card 3: Belum Update -->
    <div class="card stat-card-inner">
        <div class="stat-card-header-alt">
            <div>
                <h4 class="stat-title">Belum Update</h4>
                <h2 class="stat-value"><?= esc($statusPending ?? 0) ?></h2>
                <p class="stat-desc">Dari <?= esc($totalMonitoring ?? 0) ?> Item</p>
            </div>
            <div class="stat-icon-wrapper icon-danger">
                <i class="bi bi-exclamation-lg"></i>
            </div>
        </div>
        <div class="progress-bar-container">
            <?php $percentPending = $totalMonitoring > 0 ? round(($statusPending / $totalMonitoring) * 100) : 0; ?>
            <div class="progress-bar-bg">
                <div class="progress-bar-fill progress-fill-danger" style="width: <?= $percentPending ?>%;"></div>
            </div>
        </div>
    </div>

    <!-- Card 4: Total Item -->
    <div class="card stat-card-inner">
        <div class="stat-card-header-alt">
            <div>
                <h4 class="stat-title">Total Item</h4>
                <h2 class="stat-value"><?= esc($totalMonitoring ?? 0) ?></h2>
                <p class="stat-desc">Item Informasi</p>
            </div>
            <div class="stat-icon-wrapper icon-primary">
                <i class="bi bi-folder-fill"></i>
            </div>
        </div>
        <div class="progress-bar-container">
            <div class="progress-bar-bg"></div>
        </div>
    </div>
</div>

<!-- Chart Section -->
<div class="card chart-card">
    <div class="chart-header">
        <div class="chart-title-group">
            <i class="bi bi-bar-chart-fill chart-icon"></i>
            <h3 class="chart-title">Presentase Kepatuhan Per Kategori</h3>
        </div>
    </div>
    <div class="chart-canvas-wrapper">
        <canvas id="barChartCanvas"></canvas>
    </div>
</div>

<!-- Table Section -->
<div class="table-cards-grid">
    <!-- Item Belum Update Card -->
    <div class="card table-card">
        <div class="table-card-header">
            <div class="table-title-group title-group-danger">
                <div class="table-icon-circle icon-circle-danger">!</div>
                <h3 class="table-card-title">Item Belum Update</h3>
            </div>
            <a href="<?= base_url("monitoring?year={$selectedYear}&triwulan={$selectedTriwulan}&status=pending") ?>" class="btn btn-secondary btn-sm btn-view-all">
                Lihat Semua <i class="bi bi-arrow-right"></i>
            </a>
        </div>
        
        <div class="table-responsive custom-table-container">
            <table class="custom-table dashboard-table">
                <thead>
                    <tr>
                        <th class="th-item">Item Informasi</th>
                        <th class="th-category">Kategori</th>
                        <th class="th-desc">Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $hasPending = false;
                    if (isset($recentMonitoring) && !empty($recentMonitoring)): 
                        foreach ($recentMonitoring as $item): 
                            $hasPending = true;
                    ?>
                            <tr>
                                <td>
                                    <div class="item-info-group">
                                        <i class="bi bi-exclamation-triangle item-icon-danger"></i>
                                        <span class="item-title"><?= esc($item['title']) ?></span>
                                    </div>
                                </td>
                                <td><span class="item-text-muted"><?= esc($item['category_name'] ?: '-') ?></span></td>
                                <td><span class="item-text-muted"><?= esc($item['description'] ?: '-') ?></span></td>
                            </tr>
                    <?php 
                        endforeach;
                    endif; 
                    ?>
                    
                    <?php if (!$hasPending): ?>
                        <tr>
                            <td colspan="3" class="table-empty-cell">
                                Semua informasi pada Triwulan ini telah diperbarui!
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Item Sudah Diupdate Card -->
    <div class="card table-card">
        <div class="table-card-header">
            <div class="table-title-group title-group-success">
                <div class="table-icon-circle icon-circle-success"><i class="bi bi-check-lg"></i></div>
                <h3 class="table-card-title">Item Sudah Diupdate</h3>
            </div>
            <a href="<?= base_url("monitoring?year={$selectedYear}&triwulan={$selectedTriwulan}&status=completed") ?>" class="btn btn-secondary btn-sm btn-view-all">
                Lihat Semua <i class="bi bi-arrow-right"></i>
            </a>
        </div>
        
        <div class="table-responsive custom-table-container">
            <table class="custom-table dashboard-table">
                <thead>
                    <tr>
                        <th class="th-item">Item Informasi</th>
                        <th class="th-category">Kategori</th>
                        <th class="th-desc">Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $hasCompleted = false;
                    if (isset($recentCompleted) && !empty($recentCompleted)): 
                        foreach ($recentCompleted as $item): 
                            $hasCompleted = true;
                    ?>
                            <tr>
                                <td>
                                    <div class="item-info-group">
                                        <i class="bi bi-check-circle item-icon-success"></i>
                                        <span class="item-title"><?= esc($item['title']) ?></span>
                                    </div>
                                </td>
                                <td><span class="item-text-muted"><?= esc($item['category_name'] ?: '-') ?></span></td>
                                <td><span class="item-text-muted"><?= esc($item['description'] ?: '-') ?></span></td>
                            </tr>
                    <?php 
                        endforeach;
                    endif; 
                    ?>
                    
                    <?php if (!$hasCompleted): ?>
                        <tr>
                            <td colspan="3" class="table-empty-cell">
                                Belum ada informasi yang diperbarui pada Triwulan ini.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const CHART_DATA = <?= (isset($categoryChart) && !empty($categoryChart)) ? json_encode($categoryChart) : '[]' ?>;
</script>
