<!-- Sidebar (Mockup Light Sidebar) -->
<aside class="sidebar">
    <div class="sidebar-header" style="position: relative;">
        <!-- Floating Sidebar Collapse Toggle Button -->
        <button id="sidebarToggle" class="sidebar-toggle-btn" title="Toggle Sidebar">
            <i class="bi bi-layout-sidebar"></i>
        </button>

        <div style="display: flex; flex-direction: column; align-items: stretch; width: 100%; max-width: 210px; margin: 0 auto; gap: 8px;">
            <div class="sidebar-brand-wrapper" id="sidebarBrand" style="justify-content: center; margin-bottom: 0;">
                <img src="<?= base_url('images/logo_pepadun.png') ?>" alt="Logo PEPADUN" style="width: 100%; height: auto; object-fit: contain;">
            </div>
            <span class="sidebar-badge" style="text-align: center; white-space: nowrap; padding: 0.4rem 0.6rem;">BBPOM di Bandar Lampung</span>
        </div>
    </div>

    <!-- Navigation Menu -->
    <ul class="sidebar-menu">
        <?php 
            $CI =& get_instance();
            $segment = $CI->uri->segment(1);
            
            // Dynamic years: fetch all distinct years from the database
            $yearQuery = $CI->db->select('year')->distinct()->get('monitoring')->result_array();
            $dbYears = array_column($yearQuery, 'year');
            
            // Ensure all years from 2025 to current year are present
            $currentYear = (int) date('Y');
            $startYear = 2025;
            $loopYears = [];
            for ($y = $currentYear; $y >= $startYear; $y--) {
                $loopYears[] = $y;
            }
            
            // Combine all DB years and loop years, and sort descending
            $years = array_unique(array_merge($dbYears, $loopYears));
            rsort($years);
            
            $selectedYear = (int) ($CI->input->get('year') !== NULL ? $CI->input->get('year') : date('Y'));
            $selectedTriwulan = (int) ($CI->input->get('triwulan') !== NULL ? $CI->input->get('triwulan') : ceil(date('m') / 3));
        ?>
        <li class="sidebar-item <?= ($segment === 'dashboard' || empty($segment)) ? 'active' : '' ?>">
            <a href="<?= base_url("dashboard?year={$selectedYear}&triwulan={$selectedTriwulan}") ?>" class="sidebar-link" data-title="Dashboard">
                <div class="sidebar-link-content">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </div>
            </a>
        </li>
        
        <li class="sidebar-item <?= ($segment === 'monitoring') ? 'active' : '' ?>">
            <a href="<?= base_url("monitoring?year={$selectedYear}&triwulan={$selectedTriwulan}") ?>" class="sidebar-link sidebar-link-monitoring" data-title="Monitoring">
                <div class="sidebar-link-content">
                    <i class="bi bi-clipboard-check"></i>
                    <span>Monitoring</span>
                </div>
                <i class="bi <?= ($segment === 'monitoring') ? 'bi-chevron-up' : 'bi-chevron-down' ?> dropdown-chevron" style="font-size: 0.8rem;"></i>
            </a>
            
            <!-- Dynamic years sub-menu dropdown (based on database records and current year) -->
            <ul class="sidebar-submenu <?= ($segment === 'monitoring') ? 'show' : '' ?>">
                <?php foreach ($years as $yr): ?>
                    <li class="sidebar-submenu-item <?= ($segment === 'monitoring' && $selectedYear === $yr) ? 'active' : '' ?>">
                        <a href="<?= base_url("monitoring?year={$yr}&triwulan={$selectedTriwulan}") ?>" class="sidebar-submenu-link">
                            <?= $yr ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </li>

            <li class="sidebar-item <?= ($segment === 'categories') ? 'active' : '' ?>">
                <a href="<?= base_url('categories') ?>" class="sidebar-link" data-title="Kategori">
                    <div class="sidebar-link-content">
                        <i class="bi bi-folder"></i>
                        <span>Kategori</span>
                    </div>
                </a>
            </li>
            
            <li class="sidebar-item <?= ($segment === 'users') ? 'active' : '' ?>">
                <a href="<?= base_url('users') ?>" class="sidebar-link" data-title="Pengguna">
                    <div class="sidebar-link-content">
                        <i class="bi bi-people"></i>
                        <span>Pengguna</span>
                    </div>
                </a>
            </li>
    </ul>

    <!-- Sidebar Footer -->
    <div class="sidebar-footer">
        <a href="<?= base_url('logout') ?>" class="btn-logout" data-title="Keluar">
            <i class="bi bi-box-arrow-right"></i>
            <span>Keluar</span>
        </a>
    </div>
</aside>


