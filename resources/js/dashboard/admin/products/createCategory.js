document
    .getElementById("createCategoryForm")
    .addEventListener("submit", async (e) => {
        e.preventDefault();

        const csrf = document
            .querySelector('meta[name="csrf-token"]')
            ?.getAttribute("content");

        if (!csrf) {
            console.error("CSRF token tidak ditemukan!");
        }

        const payload = {
            name: document.getElementById("name").value,
            description: document.getElementById("description").value,
        };

        const res = await fetch("/categories", {
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

        if (result.success) {
            alert("Kategori berhasil ditambahkan");
            window.location.href = "/admin/products";
        } else {
            alert("Gagal menambah kategori");
        }
    });
