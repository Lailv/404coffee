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
// OPEN MODAL
// =========================
function openAddMenuModal()
{
    document
        .getElementById('addMenuModal')
        .classList
        .add('active');
}


// =========================
// CLOSE MODAL
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
        const modal = document.getElementById(
            'addMenuModal'
        );

        if(e.target === modal){

            closeAddMenuModal();
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
    // OPEN MODAL
    document
        .getElementById('editMenuModal')
        .classList
        .add('active');

    // SET FORM ACTION
    document
        .getElementById('editMenuForm')
        .action = `/admin/recipes/${id}`;

    // FILL INPUTS
    document
        .getElementById('edit_name')
        .value = name;

    document
        .getElementById('edit_price')
        .value = price;

    document
        .getElementById('edit_category')
        .value = category;
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