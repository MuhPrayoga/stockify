document.addEventListener("DOMContentLoaded", async () => {
    const csrf = document
        .querySelector('meta[name="csrf-token"]')
        ?.getAttribute("content");

    if (!csrf) {
        console.error("CSRF token tidak ditemukan!");
    }

    const userId = document.getElementById("userId").value;

    // 🔹 LOAD USER DETAIL
    const res = await fetch(`/users/${userId}`, {
        headers: {
            Accept: "application/json",
            "Content-Type": "application/json",
        },
        credentials: "same-origin",
    });

    const result = await res.json();
    console.log(result);

    if (!result.success || !result.data) {
        alert("Data user tidak ditemukan");
        return;
    }

    const u = result.data;

    document.getElementById("role").value = u.role;
    document.getElementById("is_active").value = u.is_active ? "1" : "0";

    // 🔹 UPDATE USER
    document
        .getElementById("editForm")
        .addEventListener("submit", async (e) => {
            e.preventDefault();

            const payload = {
                role: document.getElementById("role").value,
                is_active: document.getElementById("is_active").value === "1",
            };
            console.log(payload);

            const resUpdate = await fetch(`/users/${userId}`, {
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
                alert("User berhasil diperbarui");
                window.location.href = "/admin/users";
            } else {
                alert("Gagal update user");
            }
        });
});
