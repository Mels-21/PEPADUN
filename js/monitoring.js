document.addEventListener('DOMContentLoaded', function() {
    const tsConfig = {
        create: true,
        maxItems: 1,
        placeholder: "Pilih atau ketik nama PJ...",
        wrapperClass: "ts-wrapper custom-ts-wrapper",
        render: {
            option_create: function(data, escape) {
                return '<div class="create">Tambahkan <strong>' + escape(data.input) + '</strong>&hellip;</div>';
            },
            no_results: function(data, escape) {
                return '<div class="no-results" style="padding:10px 15px; color:#64748b;">Tidak ditemukan, ketik untuk menambahkan</div>';
            }
        }
    };
    
    let tsAddElement = document.getElementById("add_pj");
    let tsEditElement = document.getElementById("edit_pj");
    
    if (tsAddElement) new TomSelect("#add_pj", tsConfig);
    
    if (tsEditElement) {
        let tsEdit = new TomSelect("#edit_pj", tsConfig);
        window.tsEdit = tsEdit;
    }
});

const tambahModal = document.getElementById('tambahDataModal');
const editModal = document.getElementById('editDataModal');

function openEditModal(data) {
    if (typeof BASE_URL !== 'undefined') {
        document.getElementById('editForm').action = `${BASE_URL}monitoring/update/${data.id}/${data.year}/${data.triwulan}`;
    }
    document.getElementById('edit_custom_name').value = data.custom_name;
    document.getElementById('edit_status').value = data.status || 'pending';
    
    if(window.tsEdit) {
        if(data.pj && data.pj.trim() !== '') {
            window.tsEdit.addOption({value: data.pj, text: data.pj});
            window.tsEdit.setValue(data.pj);
        } else {
            window.tsEdit.clear();
        }
    }
    
    document.getElementById('edit_description').value = data.description || '';
    document.getElementById('edit_category').value = data.category_id || '';
    document.getElementById('edit_timeline').value = data.timeline || '';
    document.getElementById('edit_tautan').value = data.tautan || '';
    
    let triwulanRoman = data.triwulan == 1 ? 'I' : (data.triwulan == 2 ? 'II' : (data.triwulan == 3 ? 'III' : 'IV'));
    document.getElementById('editModalSubtitle').innerHTML = `Mengupdate data untuk <strong style="color: #0c3d79;">Triwulan ${triwulanRoman} Tahun ${data.year}</strong>`;
    
    if(editModal) editModal.classList.add('show');
}

function closeEditModal() {
    if(editModal) editModal.classList.remove('show');
}

function openTambahModal() {
    if(tambahModal) tambahModal.classList.add('show');
}

function closeTambahModal() {
    if(tambahModal) tambahModal.classList.remove('show');
}

// Close modal if clicked outside
window.addEventListener('click', function(event) {
    if (event.target === tambahModal) {
        closeTambahModal();
    }
    if (event.target === editModal) {
        closeEditModal();
    }
});

document.addEventListener('DOMContentLoaded', () => {
    let debounceTimer;

    // Use event delegation for input so it survives DOM replacement
    document.addEventListener('input', function(e) {
        if (e.target && e.target.id === 'search') {
            clearTimeout(debounceTimer);
            
            if (e.target.value === '') {
                submitFilters();
                return;
            }
            
            debounceTimer = setTimeout(() => {
                submitFilters();
            }, 600);
        }
    });

    // Handle pagination clicks and triwulan tabs and reset filter button via AJAX
    document.addEventListener('click', function(e) {
        const paginationLink = e.target.closest('.pagination-page-btn');
        const tabBtn = e.target.closest('.triwulan-tab-btn');
        const resetBtn = e.target.closest('.reset-filter-btn');

        if (paginationLink && paginationLink.tagName === 'A' && !paginationLink.hasAttribute('disabled')) {
            e.preventDefault();
            loadMonitoringData(paginationLink.href);
        } else if (tabBtn && tabBtn.tagName === 'A') {
            e.preventDefault();
            document.querySelectorAll('.triwulan-tab-btn').forEach(b => b.classList.remove('active'));
            tabBtn.classList.add('active');
            loadMonitoringData(tabBtn.href);
        } else if (resetBtn && resetBtn.tagName === 'A') {
            e.preventDefault();
            loadMonitoringData(resetBtn.href);
        }
    });

    // Handle perPageSelect changes via event delegation
    document.addEventListener('change', function(e) {
        if (e.target && e.target.id === 'perPageSelect') {
            const urlParams = new URLSearchParams(window.location.search);
            urlParams.set('per_page', e.target.value);
            urlParams.set('page', '1');
            const url = window.location.pathname + '?' + urlParams.toString();
            loadMonitoringData(url);
        }
    });

    // Handle back/forward buttons
    window.addEventListener('popstate', function() {
        loadMonitoringData(window.location.href, false);
    });
});

window.submitFilters = function() {
    const form = document.getElementById('filterForm');
    if (!form) return;
    const url = new URL(form.action);
    const formData = new FormData(form);
    for (const [key, value] of formData.entries()) {
        if (value) {
            url.searchParams.append(key, value);
        }
    }
    // Always reset to page 1 on filter
    url.searchParams.delete('page');
    
    loadMonitoringData(url.toString());
};

function loadMonitoringData(url, pushState = true) {
    const tbody = document.querySelector('.table-responsive tbody');
    if (tbody) tbody.style.opacity = '0.5';

    fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
    .then(response => response.text())
    .then(html => {
        const parser = new DOMParser();
        const doc = parser.parseFromString(html, 'text/html');
        
        // Extract and restore focus if the active element is inside the form
        const activeElementId = document.activeElement ? document.activeElement.id : null;
        const selectionStart = document.activeElement && document.activeElement.tagName === 'INPUT' ? document.activeElement.selectionStart : null;
        const selectionEnd = document.activeElement && document.activeElement.tagName === 'INPUT' ? document.activeElement.selectionEnd : null;

        // 1. Update Tabs
        const currentTabs = document.querySelector('.triwulan-tabs-container');
        const newTabs = doc.querySelector('.triwulan-tabs-container');
        if (currentTabs && newTabs) {
            currentTabs.innerHTML = newTabs.innerHTML;
        }

        // 2. Update Filter Form Area
        const currentFormContainer = document.querySelector('.card form').parentNode;
        const newFormContainer = doc.querySelector('.card form').parentNode;
        if (currentFormContainer && newFormContainer) {
            currentFormContainer.innerHTML = newFormContainer.innerHTML;
        }

        // 3. Update Table Body
        const newTbody = doc.querySelector('.table-responsive tbody');
        if (newTbody) tbody.innerHTML = newTbody.innerHTML;
        tbody.style.opacity = '1';

        // 4. Update Pagination
        const currentPagination = document.querySelector('.pagination-wrapper');
        const newPagination = doc.querySelector('.pagination-wrapper');
        
        if (currentPagination && newPagination) {
            currentPagination.innerHTML = newPagination.innerHTML;
        } else if (!currentPagination && newPagination) {
            document.querySelector('.table-responsive').insertAdjacentElement('afterend', newPagination);
        } else if (currentPagination && !newPagination) {
            currentPagination.remove();
        }

        // Restore focus
        if (activeElementId) {
            const el = document.getElementById(activeElementId);
            if (el) {
                el.focus();
                if (el.tagName === 'INPUT' && selectionStart !== null) {
                    el.setSelectionRange(selectionStart, selectionEnd);
                }
            }
        }

        // Update URL
        if (pushState) {
            window.history.pushState({path: url}, '', url);
        }
    })
    .catch(error => {
        console.error('Error fetching data:', error);
        if (tbody) tbody.style.opacity = '1';
    });
}

function openDeleteModal(masterId, year, triwulan) {
    const modal = document.getElementById('deleteModal');
    
    if (typeof BASE_URL !== 'undefined') {
        document.getElementById('btnDeleteLocal').href = BASE_URL + 'monitoring/delete/' + masterId + '/' + year + '/' + triwulan;
        document.getElementById('btnDeleteGlobal').href = BASE_URL + 'monitoring/delete_global/' + masterId + '/' + year + '/' + triwulan;
    }
    
    // Show modal with animation
    modal.style.display = 'flex';
    setTimeout(() => {
        modal.style.opacity = '1';
        modal.querySelector('.modal-content').style.transform = 'scale(1)';
    }, 10);
}

function closeDeleteModal() {
    const modal = document.getElementById('deleteModal');
    modal.style.opacity = '0';
    modal.querySelector('.modal-content').style.transform = 'scale(0.95)';
    setTimeout(() => {
        modal.style.display = 'none';
    }, 300);
}
