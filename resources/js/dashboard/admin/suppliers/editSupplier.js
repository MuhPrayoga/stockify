document.addEventListener("DOMContentLoaded", async () => {
    const csrf = document
        .querySelector('meta[name="csrf-token"]')
        ?.getAttribute("content");

    if (!csrf) {
        console.error("CSRF token tidak ditemukan!");
    }

    // GET DETAIL
    const res = await fetch(`/suppliers/${SUPPLIER_ID}`, {
        headers: {
            Accept: "application/json",
            "Content-Type": "application/json",
        },
        credentials: "same-origin",
    });

    const result = await res.json();
    const s = result.data;

    document.getElementById("name").value = s.name ?? "";
    document.getElementById("address").value = s.address ?? "";
    document.getElementById("phone").value = s.phone ?? "";
    document.getElementById("email").value = s.email ?? "";

    // UPDATE
    document
        .getElementById("editForm")
        .addEventListener("submit", async (e) => {
            e.preventDefault();

            const payload = {
                name: document.getElementById("name").value,
                address: document.getElementById("address").value,
                phone: document.getElementById("phone").value,
                email: document.getElementById("email").value,
            };

            const resUpdate = await fetch(`/suppliers/${SUPPLIER_ID}`, {
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
                alert("Supplier berhasil diupdate");
                window.location.href = "/admin/suppliers";
            } else {
                alert("Gagal update supplier");
            }
        });
});
