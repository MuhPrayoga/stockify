document.addEventListener("DOMContentLoaded", async () => {
    const table = document.getElementById("attributeSummaryTable");

    if (!table) return;

    try {
        const res = await fetch("/product-attributes-summary", {
            headers: {
                Accept: "application/json",
                "X-Requested-With": "XMLHttpRequest",
            },
            credentials: "same-origin",
        });

        const data = await res.json();
        table.innerHTML = "";

        if (!data.length) {
            table.innerHTML = `
                <tr>
                    <td colspan="3" class="px-6 py-6 text-center text-gray-400">
                        Belum ada produk
                    </td>
                </tr>
            `;
            return;
        }

        data.forEach((product) => {
            table.innerHTML += `
                <tr class="hover:bg-gray-50 transition">

                    <td class="px-6 py-4 font-medium text-gray-800">
                        ${product.name}
                    </td>

                    <td class="px-6 py-4">
                        <span class="px-3 py-1 text-xs font-semibold rounded-full bg-indigo-100 text-indigo-600">
                            ${product.product_attributes_count}
                        </span>
                    </td>

                    <td class="px-6 py-4 text-right">
                        <a href="/manager/products/attributes/edit/${product.id}"
                           class="text-indigo-600 hover:text-indigo-800 text-sm font-medium transition">
                            Kelola
                        </a>
                    </td>

                </tr>
            `;
        });
    } catch (err) {
        console.error(err);

        table.innerHTML = `
            <tr>
                <td colspan="3" class="px-6 py-6 text-center text-red-500">
                    Gagal memuat ringkasan attribute
                </td>
            </tr>
        `;
    }
});
