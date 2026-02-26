document.addEventListener("DOMContentLoaded", () => {
    const logoutBtn = document.getElementById("logoutButton");
    if (!logoutBtn) return;

    const csrf = document
        .querySelector('meta[name="csrf-token"]')
        ?.getAttribute("content");

    logoutBtn.addEventListener("click", async (e) => {
        e.preventDefault();

        const confirmLogout = confirm("Yakin ingin logout?");
        if (!confirmLogout) return;

        try {
            const res = await fetch("/logout", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": csrf,
                    Accept: "application/json",
                },
                credentials: "same-origin",
            });

            const result = await res.json();

            if (result.success) {
                window.location.href = "/login";
            } else {
                alert("Gagal logout");
            }
        } catch (err) {
            console.error("Logout error:", err);
            alert("Terjadi kesalahan saat logout");
        }
    });
});
