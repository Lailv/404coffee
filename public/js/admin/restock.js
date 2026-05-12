// =========================
// MODAL
// =========================
const restockModal =
    document.getElementById(
        'restockModal'
    );

const supplierModal =
    document.getElementById(
        'supplierModal'
    );


// =========================
// OPEN RESTOCK
// =========================
const openRestockBtn =
    document.getElementById(
        'openRestockModal'
    );

if(openRestockBtn){

    openRestockBtn.onclick = () => {

        restockModal.classList.add(
            'active'
        );
    }
}


// =========================
// CLOSE RESTOCK
// =========================
const closeRestockBtn =
    document.getElementById(
        'closeRestockModal'
    );

if(closeRestockBtn){

    closeRestockBtn.onclick = () => {

        restockModal.classList.remove(
            'active'
        );
    }
}


// =========================
// OPEN SUPPLIER
// =========================
const openSupplierBtn =
    document.getElementById(
        'openSupplierModal'
    );

if(openSupplierBtn){

    openSupplierBtn.onclick = () => {

        supplierModal.classList.add(
            'active'
        );
    }
}


// =========================
// CLOSE SUPPLIER
// =========================
const closeSupplierBtn =
    document.getElementById(
        'closeSupplierModal'
    );

if(closeSupplierBtn){

    closeSupplierBtn.onclick = () => {

        supplierModal.classList.remove(
            'active'
        );
    }
}


// =========================
// CLOSE MODAL OUTSIDE CLICK
// =========================
window.onclick = (event) => {

    if(event.target == restockModal){

        restockModal.classList.remove(
            'active'
        );
    }

    if(event.target == supplierModal){

        supplierModal.classList.remove(
            'active'
        );
    }
}


// =========================
// AUTO TOTAL
// =========================
const qtyInput =
    document.getElementById(
        'qty'
    );

const priceInput =
    document.getElementById(
        'price'
    );

const totalInput =
    document.getElementById(
        'total'
    );


function calculateTotal(){

    const qty =
        qtyInput.value || 0;

    const price =
        priceInput.value || 0;

    const total =
        qty * price;

    totalInput.value =

        'Rp '

        +

        Number(total).toLocaleString(
            'id-ID'
        );
}


if(qtyInput && priceInput){

    qtyInput.addEventListener(

        'input',

        calculateTotal
    );

    priceInput.addEventListener(

        'input',

        calculateTotal
    );
}