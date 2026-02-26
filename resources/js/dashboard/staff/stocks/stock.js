document.addEventListener("DOMContentLoaded", () => {
    const token = localStorage.getItem("token");

    const modal = document.getElementById("transactionModal");
    const modalTitle = document.getElementById("modalTitle");
    const form = document.getElementById("transactionForm");
    const productSelect = document.getElementById("product_id");

    let currentType = null; // in / out

    /* =========================
       OPEN MODAL
    ========================== */

    document.getElementById("btnIncoming").addEventListener("click", () => {
        currentType = "in";
        modalTitle.textContent = "Tambah Barang Masuk";
        modal.classList.remove("hidden");
        modal.classList.add("flex");
    });

    document.getElementById("btnOutgoing").addEventListener("click", () => {
        currentType = "out";
        modalTitle.textContent = "Tambah Barang Keluar";
        modal.classList.remove("hidden");
        modal.classList.add("flex");
    });

    document.getElementById("closeModal").addEventListener("click", () => {
        modal.classList.add("hidden");
    });

    /* =========================
       LOAD PRODUCTS
    ========================== */

    async function loadProducts() {
        try {
            const res = await fetch("/products", {
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document
                        .querySelector('meta[name="csrf-token"]')
                        .getAttribute("content"),
                },
            });

            const result = await res.json();

            productSelect.innerHTML = "";

            result.data.forEach((product) => {
                const option = document.createElement("option");
                option.value = product.id;
                option.textContent = `${product.name} (Stok: ${product.stock})`;
                productSelect.appendChild(option);
            });
        } catch (err) {
            console.error("Load products error:", err);
        }
    }

    loadProducts();

    /* =========================
       SUBMIT FORM
    ========================== */

    form.addEventListener("submit", async (e) => {
        e.preventDefault();

        const product_id = document.getElementById("product_id").value;
        const quantity = document.getElementById("quantity").value;
        const notes = document.getElementById("notes").value;

        let endpoint = currentType === "in" ? "/stock/in" : "/stock/out";

        try {
            const res = await fetch(endpoint, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    Authorization: `Bearer ${token}`,
                    "X-CSRF-TOKEN": document
                        .querySelector('meta[name="csrf-token"]')
                        .getAttribute("content"),
                },
                body: JSON.stringify({
                    product_id,
                    quantity,
                    notes, // ✅ ditambahkan
                }),
            });

            const result = await res.json();

            if (!res.ok) throw new Error(result.message);

            alert(result.message);

            modal.classList.add("hidden");
            form.reset();

            if (typeof loadMyTransactions === "function") {
                loadMyTransactions();
            }
        } catch (err) {
            alert(err.message);
        }

        location.reload();
    });
});
