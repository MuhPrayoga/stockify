document.addEventListener("DOMContentLoaded", async () => {
    const csrf = document
        .querySelector('meta[name="csrf-token"]')
        ?.getAttribute("content");

    if (!csrf) {
        console.error("CSRF token tidak ditemukan!");
    }

    const res = await fetch(`/attributes/${ATTRIBUTE_ID}`, {
        headers: {
            Accept: "application/json",
            "Content-Type": "application/json",
        },
        credentials: "same-origin",
    });

    const result = await res.json();
    const a = result.data;

    document.getElementById("name").value = a.name;
    document.getElementById("type").value = a.type;

    document
        .getElementById("editForm")
        .addEventListener("submit", async (e) => {
            e.preventDefault();

            const payload = {
                name: document.getElementById("name").value,
                type: document.getElementById("type").value,
            };

            const resUpdate = await fetch(`/attributes/${ATTRIBUTE_ID}`, {
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
                alert("Atribut berhasil diupdate");
                window.location.href = "/admin/products";
            } else {
                alert("Gagal update");
            }
        });
});
