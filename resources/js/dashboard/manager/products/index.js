document.addEventListener("DOMContentLoaded", async () => {
    const table = document.getElementById("productTable");
    const csrf = document
        .querySelector('meta[name="csrf-token"]')
        ?.getAttribute("content");

    if (!csrf) {
        console.error("CSRF token tidak ditemukan!");
    }

    try {
        const res = await fetch("/products", {
            headers: {
                Accept: "application/json",
                "Content-Type": "application/json",
            },
            credentials: "same-origin",
        });

        const result = await res.json();

        table.innerHTML = "";

        result.data.forEach((p) => {
            const isLow = p.stock <= p.minimum_stock;

            const status = isLow
                ? `<span class="px-3 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-600">
                        Menipis
                   </span>`
                : `<span class="px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-600">
                        Aman
                   </span>`;

            table.innerHTML += `
                <tr class="hover:bg-gray-50 transition">
                    
                    <td class="px-6 py-4 font-medium text-gray-800">
                        ${p.name}
                    </td>

                    <td class="px-6 py-4">
                        <span class="px-3 py-1 text-xs rounded-full bg-gray-100 text-gray-600">
                            ${p.category?.name ?? "-"}
                        </span>
                    </td>

                    <td class="px-6 py-4">
                        <span class="px-3 py-1 text-xs rounded-full bg-gray-100 text-gray-600">
                            ${p.sku}
                        </span>
                    </td>

                    <td class="px-6 py-4 font-semibold text-gray-800">
                        ${p.stock}
                    </td>

                    <td class="px-6 py-4 text-gray-500">
                        ${p.minimum_stock}
                    </td>

                    <td class="px-6 py-4">
                        ${status}
                    </td>
                    <td class="px-6 py-4 text-right space-x-3">
                        <a href="/manager/products/edit/${p.id}"
                           class="text-indigo-600 hover:text-indigo-800 text-sm font-medium transition">
                            Edit
                        </a>

                        <a href="/manager/products/attributes/edit/${p.id}"
                            class="text-blue-600 hover:text-blue-800 text-sm font-medium transition">
                             Attribute
                        </a>

                        <button data-id="${p.id}"
                           class="deleteBtn text-red-500 hover:text-red-700 text-sm font-medium transition">
                           Hapus
                        </button>
                    </td>
                </tr>
            `;
        });

        document.querySelectorAll(".deleteBtn").forEach((btn) => {
            btn.addEventListener("click", async () => {
                if (!confirm("Yakin hapus produk ini?")) return;

                await fetch(`/products/${btn.dataset.id}`, {
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
        alert("Gagal memuat produk");
        console.error(err);
    }
});
