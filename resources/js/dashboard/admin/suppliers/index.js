document.addEventListener("DOMContentLoaded", async () => {
    const container = document.getElementById("supplierContainer");
    const csrf = document
        .querySelector('meta[name="csrf-token"]')
        ?.getAttribute("content");

    if (!csrf) {
        console.error("CSRF token tidak ditemukan!");
    }

    try {
        const response = await fetch("/suppliers", {
            headers: {
                Accept: "application/json",
                "Content-Type": "application/json",
            },
            credentials: "same-origin",
        });

        const result = await response.json();
        const suppliers = result.data;

        container.innerHTML = "";

        if (!suppliers.length) {
            container.innerHTML = `
                <div class="col-span-3 text-center text-gray-400 py-12">
                    Belum ada supplier
                </div>
            `;
            return;
        }

        suppliers.forEach((supplier) => {
            container.innerHTML += `
                <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm hover:shadow-md transition">

                    <div class="flex justify-between items-start mb-4">
                        <h3 class="text-lg font-semibold text-gray-800">
                            ${supplier.name}
                        </h3>

                        <span class="text-sm px-3 py-1 bg-gray-100 rounded-full text-gray-600">
                            ${supplier.products_count ?? 0} produk
                        </span>
                    </div>

                    <div class="space-y-2 text-gray-600 text-sm">
                        <div class="flex items-start gap-2">
                            <span>📍</span>
                            <span>${supplier.address ?? "-"}</span>
                        </div>

                        <div class="flex items-center gap-2">
                            <span>📞</span>
                            <span>${supplier.phone ?? "-"}</span>
                        </div>

                        <div class="flex items-center gap-2">
                            <span>✉️</span>
                            <span>${supplier.email ?? "-"}</span>
                        </div>
                    </div>

                    <div class="flex justify-end gap-3 mt-6">
                        <a href="/admin/suppliers/${supplier.id}/edit"
                           class="text-sm text-indigo-600 hover:underline">
                            Edit
                        </a>

                        <button data-id="${supplier.id}"
                            class="deleteBtn text-sm text-red-500 hover:underline">
                            Hapus
                        </button>
                    </div>

                </div>
            `;
        });

        /* ================= DELETE HANDLER ================= */

        container.addEventListener("click", async (e) => {
            if (!e.target.classList.contains("deleteBtn")) return;

            const id = e.target.dataset.id;

            if (!confirm("Yakin ingin menghapus supplier ini?")) return;

            await fetch(`/suppliers/${id}`, {
                method: "DELETE",
                headers: {
                    Accept: "application/json",
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": csrf,
                },
                credentials: "same-origin",
            });

            location.reload();
        });
    } catch (err) {
        console.error(err);
        alert("Gagal memuat data supplier");
    }
});
