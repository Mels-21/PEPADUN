const addModal = document.getElementById('addModal');
const editModal = document.getElementById('editModal');
const editForm = document.getElementById('editForm');

function openAddModal() {
    if(addModal) {
        addModal.classList.add('show');
    } else {
        alert("Error: addModal element not found in HTML!");
    }
}

function closeAddModal() {
    if(addModal) addModal.classList.remove('show');
}

function openEditModal(userData) {
    console.log("Opening edit modal for:", userData);
    if(!editModal || !editForm) {
        alert("Error: editModal or editForm not found!");
        return;
    }
    
    if (typeof URL_USER_UPDATE !== 'undefined') {
        editForm.action = `${URL_USER_UPDATE}/${userData.id_user}`;
    }
    
    for (const key in userData) {
        const el = document.getElementById('edit_' + key);
        if (el && key !== 'password') {
            if (key === 'image_user') {
                const hiddenEl = document.getElementById('edit_old_image_user');
                if (hiddenEl) hiddenEl.value = userData[key] || '';
                continue;
            }

            let val = userData[key];
            
            // If it's a date input and the value looks like DD/MM/YYYY, convert it to YYYY-MM-DD
            if (el.type === 'date' && val && val.includes('/')) {
                let parts = val.split('/');
                if (parts.length === 3) {
                    val = `${parts[2]}-${parts[1]}-${parts[0]}`;
                }
            }
            
            el.value = val;
        }
    }
    
    const pwd = document.getElementById('edit_password');
    if(pwd) {
        pwd.value = '';
    }
    
    editModal.classList.add('show');
}

function closeEditModal() {
    if(editModal) editModal.classList.remove('show');
}

window.onclick = function(event) {
    if (event.target === addModal) {
        closeAddModal();
    }
    if (event.target === editModal) {
        closeEditModal();
    }
}

function togglePassword(inputId, iconId) {
    const input = document.getElementById(inputId);
    const icon = document.getElementById(iconId);
    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.remove('bi-eye-slash');
        icon.classList.add('bi-eye');
    } else {
        input.type = 'password';
        icon.classList.remove('bi-eye');
        icon.classList.add('bi-eye-slash');
    }
}

// Live Search Debounce logic
let debounceTimer;
const searchInput = document.getElementById('search');

window.addEventListener('DOMContentLoaded', (event) => {
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
