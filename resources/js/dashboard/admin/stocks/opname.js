document.addEventListener("DOMContentLoaded", async () => {
    const csrf = document
        .querySelector('meta[name="csrf-token"]')
        ?.getAttribute("content");

    const productSelect = document.getElementById("product_id");
    const systemStockInput = document.getElementById("system_stock");
    const form = document.getElementById("opnameForm");

    // LOAD PRODUCTS
    const res = await fetch("/products", {
        headers: { Accept: "application/json" },
        credentials: "same-origin",
    });

    const result = await res.json();

    result.data.forEach((product) => {
        productSelect.innerHTML += `
            <option value="${product.id}" data-stock="${product.stock}">
                ${product.name}
            </option>
        `;
    });

    // AUTO FILL SYSTEM STOCK
    productSelect.addEventListener("change", () => {
        const selected = productSelect.options[productSelect.selectedIndex];
        const stock = selected.getAttribute("data-stock");
        systemStockInput.value = stock || 0;
    });

    // SUBMIT
    form.addEventListener("submit", async (e) => {
        e.preventDefault();

        const product_id = productSelect.value;
        const physical_stock = document.getElementById("physical_stock").value;
        const notes = document.getElementById("notes").value;

        const resSave = await fetch("/stock-opname", {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": csrf,
                Accept: "application/json",
                "Content-Type": "application/json",
            },
            credentials: "same-origin",
            body: JSON.stringify({
                product_id,
                physical_stock,
                notes,
            }),
        });

        const saveResult = await resSave.json();

        if (saveResult.success) {
            alert("Stock opname berhasil!");
            window.location.href = "/admin/stocks";
        } else {
            alert("Gagal menyimpan opname");
        }
    });
});
