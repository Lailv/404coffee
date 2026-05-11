let ingredientCount = 1;

// =========================
// ADD INGREDIENT
// =========================
function addIngredient()
{
    ingredientCount++;

    let wrapper = document.getElementById(
        'ingredient-wrapper'
    );

    let html = `

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