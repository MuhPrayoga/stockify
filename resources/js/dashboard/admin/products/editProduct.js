document.addEventListener("DOMContentLoaded", async () => {
    const csrf = document
        .querySelector('meta[name="csrf-token"]')
        ?.getAttribute("content");

    if (!csrf) {
        console.error("CSRF token tidak ditemukan!");
    }
    // 🔥 FETCH DETAIL PRODUCT
    const res = await fetch(`/products/${PRODUCT_ID}`, {
        headers: {
            Accept: "application/json",
            "Content-Type": "application/json",
        },
        credentials: "same-origin",
    });

    const result = await res.json();
    const p = result.data; // ⬅️ INI PENTING

    // 🔥 ISI FORM
    document.getElementById("name").value = p.name ?? "";
    document.getElementById("category_id").value = p.category_id ?? "";
    document.getElementById("sku").value = p.sku ?? "";
    document.getElementById("purchase_price").value = p.purchase_price ?? "";
    document.getElementById("selling_price").value = p.selling_price ?? "";
    document.getElementById("minimum_stock").value = p.minimum_stock ?? "";

    // 🔥 SUBMIT UPDATE
    document
        .getElementById("editForm")
        .addEventListener("submit", async (e) => {
            e.preventDefault();

            const payload = {
                name: document.getElementById("name").value,
                category_id: Number(
                    document.getElementById("category_id").value,
                ),
                sku: document.getElementById("sku").value,
                purchase_price: Number(
                    document.getElementById("purchase_price").value,
                ),
                selling_price: Number(
                    document.getElementById("selling_price").value,
                ),
                minimum_stock: Number(
                    document.getElementById("minimum_stock").value,
                ),
            };

            const resUpdate = await fetch(`/products/${PRODUCT_ID}`, {
                method: "PUT",
                headers: {
                    Accept: "application/json",
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": csrf,
                },
                credentials: "same-origin",
                body: JSON.stringify(payload),
            });

            const updateResult = await resUpdate.json();

            if (updateResult.success) {
                alert("Produk berhasil diupdate");
                window.location.href = "/admin/products";
            } else {
                console.error(updateResult);
                alert("Gagal update produk");
            }
        });
});
