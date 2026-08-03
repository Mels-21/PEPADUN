const addModal = document.getElementById('addModal');
const editModal = document.getElementById('editModal');
const editForm = document.getElementById('editForm');
const editName = document.getElementById('edit_name');
const editDesc = document.getElementById('edit_description');

function openAddModal() {
    addModal.classList.add('show');
}

function closeAddModal() {
    addModal.classList.remove('show');
}

function openEditModal(id, name, description) {
    if (typeof URL_CATEGORY_UPDATE !== 'undefined') {
        editForm.action = `${URL_CATEGORY_UPDATE}/${id}`;
    }
    editName.value = name;
    editDesc.value = description;
    editModal.classList.add('show');
}

function closeEditModal() {
    editModal.classList.remove('show');
}

// Close modal on click outside
window.onclick = function(event) {
    if (event.target === addModal) {
        closeAddModal();
    }
    if (event.target === editModal) {
        closeEditModal();
    }
}

// Live Search Debounce logic matching monitoring
let debounceTimer;
const searchInput = document.getElementById('search');

window.addEventListener('DOMContentLoaded', (event) => {
    // Restore focus if coming from a search reload
    if (sessionStorage.getItem('searchFocus') === '1' && searchInput) {
        searchInput.focus();
        const val = searchInput.value;
        searchInput.value = '';
        searchInput.value = val;
        sessionStorage.removeItem('searchFocus');
    } else if (searchInput && searchInput.value !== '') {
        searchInput.focus();
        const val = searchInput.value;
        searchInput.value = '';
        searchInput.value = val;
    }

    if (searchInput) {
        searchInput.addEventListener('input', function() {
            clearTimeout(debounceTimer);
            
            if (this.value === '') {
                sessionStorage.setItem('searchFocus', '1');
                this.form.submit();
                return;
            }
            
            debounceTimer = setTimeout(() => {
                sessionStorage.setItem('searchFocus', '1');
                this.form.submit();
            }, 600);
        });
        
        searchInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                sessionStorage.setItem('searchFocus', '1');
            }
        });
    }
});
