document.addEventListener("DOMContentLoaded", async () => {
    const table = document.getElementById("categoryTable");
    const csrf = document
        .querySelector('meta[name="csrf-token"]')
        ?.getAttribute("content");

    if (!csrf) {
        console.error("CSRF token tidak ditemukan!");
    }

    try {
        const res = await fetch("/categories", {
            headers: {
                Accept: "application/json",
                "Content-Type": "application/json",
            },
            credentials: "same-origin",
        });

        const result = await res.json();
        table.innerHTML = "";

        result.data.forEach((c) => {
            table.innerHTML += `
                <tr class="hover:bg-gray-50 transition">

                    <td class="px-6 py-4 font-medium text-gray-800">
                        ${c.name}
                    </td>

                    <td class="px-6 py-4 text-right space-x-3">
                        <a href="/admin/products/categories/edit/${c.id}"
                           class="text-indigo-600 hover:text-indigo-800 text-sm font-medium transition">
                            Edit
                        </a>

                        <button data-id="${c.id}"
                           class="deleteCategory text-red-500 hover:text-red-700 text-sm font-medium transition">
                           Hapus
                        </button>
                    </td>

                </tr>
            `;
        });

        document.querySelectorAll(".deleteCategory").forEach((btn) => {
            btn.addEventListener("click", async () => {
                if (!confirm("Yakin hapus kategori ini?")) return;

                await fetch(`/categories/${btn.dataset.id}`, {
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
        });
    } catch (err) {
        console.error(err);
        alert("Gagal memuat kategori");
    }
});
