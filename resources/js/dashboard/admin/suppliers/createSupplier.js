document.addEventListener("DOMContentLoaded", () => {
    const csrf = document
        .querySelector('meta[name="csrf-token"]')
        ?.getAttribute("content");

    if (!csrf) {
        console.error("CSRF token tidak ditemukan!");
    }

    document
        .getElementById("createForm")
        .addEventListener("submit", async (e) => {
            e.preventDefault();

            const payload = {
                name: document.getElementById("name").value,
                address: document.getElementById("address").value,
                phone: document.getElementById("phone").value,
                email: document.getElementById("email").value,
            };

            const res = await fetch("/suppliers", {
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
                alert("Supplier berhasil ditambahkan");
                window.location.href = "/admin/suppliers";
            } else {
                alert("Gagal menambah supplier");
            }
        });
});
