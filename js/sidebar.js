document.addEventListener('DOMContentLoaded', () => {
    // 1. Collapse / Expand Sidebar Toggle logic
    const toggleBtn = document.getElementById('sidebarToggle');
    if (toggleBtn) {
        const icon = toggleBtn.querySelector('i');
        
        // Restore collapsed state from localStorage
        if (localStorage.getItem('sidebar-collapsed') === 'true') {
            document.body.classList.add('sidebar-collapsed');
        }
        
        toggleBtn.addEventListener('click', () => {
            document.body.classList.toggle('sidebar-collapsed');
            const isCollapsed = document.body.classList.contains('sidebar-collapsed');
            localStorage.setItem('sidebar-collapsed', isCollapsed);
        });
    }

    // Expand sidebar when clicking on the brand logo while collapsed
    const brandLogo = document.getElementById('sidebarBrand');
    if (brandLogo) {
        brandLogo.addEventListener('click', (e) => {
            if (document.body.classList.contains('sidebar-collapsed')) {
                e.preventDefault();
                document.body.classList.remove('sidebar-collapsed');
                localStorage.setItem('sidebar-collapsed', 'false');
            }
        });
    }

    // 2. Monitoring Dropdown Year submenu Click-Toggle logic
    const monitoringLink = document.querySelector('.sidebar-link-monitoring');
    const submenu = document.querySelector('.sidebar-submenu');
    
    if (monitoringLink && submenu) {
        monitoringLink.addEventListener('click', (e) => {
            // If we are already on the monitoring page, toggle submenu without reloading
            if (window.location.pathname.includes('monitoring')) {
                e.preventDefault();
                submenu.classList.toggle('show');
                
                // Toggle chevron icon direction
                const chevron = monitoringLink.querySelector('.dropdown-chevron');
                if (chevron) {
                    chevron.classList.toggle('bi-chevron-down');
                    chevron.classList.toggle('bi-chevron-up');
                }
            }
        });
    }
});
