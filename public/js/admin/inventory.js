function openAddModal() {

    const modal = document.getElementById('addModal');

    modal.classList.add('active');

}

function closeAddModal() {

    document.getElementById('addModal')
        .classList.remove('active');

}

function closeEditModal() {

    document.getElementById('editModal')
        .classList.remove('active');

}

function editIngredient(id, code, name, category, stock, unit, minStock) {

    const modal = document.getElementById('editModal');

    modal.classList.add('active');

    document.getElementById('editForm').action =
        '/admin/inventory/update/' + id;

    document.getElementById('edit_code').value = code;

    document.getElementById('edit_name').value = name;

    document.getElementById('edit_category').value = category;

    document.getElementById('edit_stock').value = stock;

    document.getElementById('edit_unit').value = unit;

    document.getElementById('edit_min_stock').value = minStock;

}