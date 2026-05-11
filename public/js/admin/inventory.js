// ==========================================
// 404 Coffee Admin — Inventory JS
// ==========================================

function openAddModal() {
    const modal = document.getElementById('addModal');
    modal.classList.add('show'); // Gunakan class .show dari CSS

    // Trigger animasi ulang (reflow)
    const content = modal.querySelector('.modal-content');
    content.style.animation = 'none';
    content.offsetHeight; 
    content.style.animation = '';
}

function closeAddModal() {
    document.getElementById('addModal').classList.remove('show');
}

function closeEditModal() {
    document.getElementById('editModal').classList.remove('show');
}

function editIngredient(id, code, name, category, stock, unit, minStock) {
    // 1. OPEN MODAL
    const modal = document.getElementById('editModal');
    modal.classList.add('show'); // Gunakan class .show dari CSS

    // 2. TRIGGER ANIMASI
    const content = modal.querySelector('.modal-content');
    content.style.animation = 'none';
    content.offsetHeight; // reflow
    content.style.animation = '';

    // 3. SET FORM ACTION ROUTE
    // Pastikan route di Laravel (web.php) sesuai dengan path ini
    document.getElementById('editForm').action = '/admin/inventory/update/' + id;

    // 4. POPULATE VALUES
    document.getElementById('edit_code').value      = code;
    document.getElementById('edit_name').value      = name;
    document.getElementById('edit_category').value  = category;
    document.getElementById('edit_stock').value     = stock;
    document.getElementById('edit_unit').value      = unit;
    document.getElementById('edit_min_stock').value = minStock;
}

// Tutup modal kalau klik di luar area konten modal (backdrop)
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.modal').forEach(function (modal) {
        modal.addEventListener('click', function (e) {
            // Jika yang di-klik adalah background modalnya langsung
            if (e.target === modal) {
                modal.classList.remove('show');
            }
        });
    });
});