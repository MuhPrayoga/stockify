document.addEventListener("DOMContentLoaded", async () => {
    const csrf = document
        .querySelector('meta[name="csrf-token"]')
        ?.getAttribute("content");

    if (!csrf) {
        console.error("CSRF token tidak ditemukan!");
    }

    // LOAD SETTING
    const res = await fetch("/app-settings", {
        headers: {
            Accept: "application/json",
            "Content-Type": "application/json",
        },
        credentials: "same-origin",
    });
    const result = await res.json();

    if (result.data) {
        // ====== PREVIEW FEATURE (TAMBAHAN, TIDAK MENGUBAH LOGIC LAMA) ======

        const appNameInput = document.getElementById("app_name");
        const descInput = document.getElementById("description");
        const logoInput = document.getElementById("logo");

        const previewName = document.getElementById("previewAppName");
        const previewDesc = document.getElementById("previewDescription");
        const logoFallback = document.getElementById("logoFallback");
        const logoPreview = document.getElementById("logoPreview");

        // Sinkronisasi saat pertama load data dari API
        if (result.data) {
            previewName.textContent = result.data.app_name || "Nama Aplikasi";

            previewDesc.textContent =
                result.data.description || "Deskripsi aplikasi";

            logoFallback.textContent =
                result.data.app_name?.charAt(0).toUpperCase() || "A";

            if (result.data.logo) {
                logoFallback.classList.add("hidden");
            }
        }

        // Live update nama
        appNameInput.addEventListener("input", () => {
            previewName.textContent = appNameInput.value || "Nama Aplikasi";

            logoFallback.textContent =
                appNameInput.value?.charAt(0).toUpperCase() || "A";
        });

        // Live update deskripsi
        descInput.addEventListener("input", () => {
            previewDesc.textContent = descInput.value || "Deskripsi aplikasi";
        });

        // Live preview logo saat pilih file
        logoInput.addEventListener("change", () => {
            if (logoInput.files[0]) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    logoPreview.src = e.target.result;
                    logoPreview.classList.remove("hidden");
                    logoFallback.classList.add("hidden");
                };
                reader.readAsDataURL(logoInput.files[0]);
            }
        });
    }

    // SUBMIT
    document
        .getElementById("settingForm")
        .addEventListener("submit", async (e) => {
            e.preventDefault();

            const formData = new FormData();
            formData.append("app_name", app_name.value);
            formData.append("description", description.value);

            if (logo.files[0]) {
                formData.append("logo", logo.files[0]);
            }

            const resSave = await fetch("/app-settings", {
                method: "POST",
                headers: {
                    Accept: "application/json",
                    "X-CSRF-TOKEN": csrf,
                },
                credentials: "same-origin",
                body: formData,
            });

            const saveResult = await resSave.json();
            console.log(saveResult);

            if (saveResult.success) {
                alert("Pengaturan berhasil disimpan");
                location.reload();
            } else {
                alert("Gagal menyimpan pengaturan");
            }
        });
});
