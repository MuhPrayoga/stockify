document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("createForm");
    const csrf = document
        .querySelector('meta[name="csrf-token"]')
        ?.getAttribute("content");

    if (!csrf) {
        console.error("CSRF token tidak ditemukan!");
    }

    form.addEventListener("submit", async (e) => {
        e.preventDefault();

        const payload = {
            name: document.getElementById("name").value,
            sku: document.getElementById("sku").value,
            category_id: Number(document.getElementById("category_id").value),
            supplier_id: Number(document.getElementById("supplier_id").value),
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

        try {
            const res = await fetch("/products", {
                method: "POST",
                headers: {
                    Accept: "application/json",
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": csrf,
                },
                credentials: "same-origin",
                body: JSON.stringify(payload),
            });

            const result = await res.json();

            if (!result.success) {
                console.error(result);
                alert("Gagal menambah produk");
                return;
            }

            alert("Produk berhasil ditambahkan");
            window.location.href = "/manager/products";
        } catch (err) {
            console.error(err);
            alert("Terjadi kesalahan");
        }
    });
});
