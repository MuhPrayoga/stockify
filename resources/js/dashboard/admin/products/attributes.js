document.addEventListener("DOMContentLoaded", async () => {
    const table = document.getElementById("attributeTable");
    const csrf = document
        .querySelector('meta[name="csrf-token"]')
        ?.getAttribute("content");

    if (!csrf) {
        console.error("CSRF token tidak ditemukan!");
    }

    try {
        const res = await fetch("/attributes", {
            headers: {
                Accept: "application/json",
                "Content-Type": "application/json",
            },
            credentials: "same-origin",
        });

        const result = await res.json();
        table.innerHTML = "";

        result.data.forEach((a) => {
            table.innerHTML += `
                <tr class="hover:bg-gray-50 transition">

                    <td class="px-6 py-4 font-medium text-gray-800">
                        ${a.name}
                    </td>

                    <td class="px-6 py-4">
                        <span class="px-3 py-1 text-xs rounded-full bg-amber-100 text-amber-600">
                            ${a.type}
                        </span>
                    </td>

                    <td class="px-6 py-4 text-right space-x-3">
                        <a href="/admin/products/attributes/edit/${a.id}"
                           class="text-indigo-600 hover:text-indigo-800 text-sm font-medium transition">
                            Edit
                        </a>

                        <button data-id="${a.id}"
                           class="deleteAttribute text-red-500 hover:text-red-700 text-sm font-medium transition">
                            Hapus
                        </button>
                    </td>

                </tr>
            `;
        });

        document.querySelectorAll(".deleteAttribute").forEach((btn) => {
            btn.addEventListener("click", async () => {
                if (!confirm("Yakin hapus atribut ini?")) return;

                await fetch(`/attributes/${btn.dataset.id}`, {
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
        alert("Gagal memuat atribut");
    }
});
