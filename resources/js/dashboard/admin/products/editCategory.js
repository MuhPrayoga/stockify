document.addEventListener("DOMContentLoaded", async () => {
    const csrf = document
        .querySelector('meta[name="csrf-token"]')
        ?.getAttribute("content");

    if (!csrf) {
        console.error("CSRF token tidak ditemukan!");
    }

    console.log("EDIT CATEGORY JS LOADED");

    const res = await fetch(`/categories/${CATEGORY_ID}`, {
        headers: {
            Accept: "application/json",
            "Content-Type": "application/json",
        },
        credentials: "same-origin",
    });

    const result = await res.json();

    // 🔥 INI KUNCINYA
    const c = result.data;

    if (!c) {
        alert("Data kategori tidak ditemukan");
        return;
    }

    // 🔥 ISI FORM
    document.getElementById("name").value = c.name ?? "";
    document.getElementById("description").value = c.description ?? "";

    // 🔥 SUBMIT UPDATE
    document
        .getElementById("editCategoryForm")
        .addEventListener("submit", async (e) => {
            e.preventDefault();

            const payload = {
                name: document.getElementById("name").value,
                description: document.getElementById("description").value,
            };

            const resUpdate = await fetch(`/categories/${CATEGORY_ID}`, {
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
                alert("Kategori berhasil diupdate");
                window.location.href = "/admin/products";
            } else {
                alert("Gagal update kategori");
            }
        });
});
