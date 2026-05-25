let ingredientCount = 1;


// =========================
// ADD INGREDIENT
// =========================
function addIngredient()
{
    ingredientCount++;

    const wrapper = document.getElementById(
        'ingredient-wrapper'
    );

    const html = `

        <div class="ingredient-box">

            <div class="ingredient-title">

                Ingredient #${ingredientCount}

            </div>

            <div class="ingredient-grid">

                <!-- INGREDIENT -->
                <div>

                    <label>
                        Ingredient
                    </label>

                    <select
                        name="inventory_id[]"
                        required>

                        ${window.inventoryOptions}

                    </select>

                </div>

                <!-- QUANTITY -->
                <div>

                    <label>
                        Quantity
                    </label>

                    <input
                        type="number"
                        step="0.01"
                        name="quantity[]"
                        placeholder="Example: 18"
                        required>

                </div>

            </div>

            <!-- REMOVE BUTTON -->
            <button
                type="button"
                class="remove-btn"
                onclick="removeIngredient(this)">

                Remove

            </button>

        </div>

    `;

    wrapper.insertAdjacentHTML(
        'beforeend',
        html
    );
}


// =========================
// REMOVE INGREDIENT
// =========================
function removeIngredient(button)
{
    button
        .closest('.ingredient-box')
        .remove();
}


// =========================
// OPEN ADD MODAL
// =========================
function openAddMenuModal()
{
    document
        .getElementById('addMenuModal')
        .classList
        .add('active');
}


// =========================
// CLOSE ADD MODAL
// =========================
function closeAddMenuModal()
{
    document
        .getElementById('addMenuModal')
        .classList
        .remove('active');
}


// =========================
// CLOSE MODAL OUTSIDE CLICK
// =========================
window.addEventListener(

    'click',

    function(e)
    {
        const addModal = document.getElementById(
            'addMenuModal'
        );

        const editModal = document.getElementById(
            'editMenuModal'
        );

        // ADD MODAL
        if(e.target === addModal){

            closeAddMenuModal();
        }

        // EDIT MODAL
        if(e.target === editModal){

            closeEditMenuModal();
        }
    }
);


// =========================
// OPEN EDIT MODAL
// =========================
function openEditModal(
    id,
    name,
    price,
    category
)
{
    const modal = document.getElementById(
        'editMenuModal'
    );

    const form = document.getElementById(
        'editMenuForm'
    );

    // FORCE URL
    form.action =
        window.location.origin +
        '/admin/products/update/' +
        id;

    // OPEN
    modal.classList.add('active');

    // FILL
    document.getElementById(
        'edit_name'
    ).value = name;

    document.getElementById(
        'edit_price'
    ).value = price;

    document.getElementById(
        'edit_category'
    ).value = category;

    console.log(form.action);
}


// =========================
// CLOSE EDIT MODAL
// =========================
function closeEditMenuModal()
{
    document
        .getElementById('editMenuModal')
        .classList
        .remove('active');
}