document.addEventListener("DOMContentLoaded", async () => {
    const res = await fetch("/reports/low-stock", {
        headers: {
            Accept: "application/json",
            "Content-Type": "application/json",
        },
        credentials: "same-origin",
    });

    const result = await res.json();
    const table = document.getElementById("lowStockTable");

    table.innerHTML = "";
    result.data.forEach((p) => {
        table.innerHTML += `
            <tr class="border-t">
                <td class="px-4 py-2">${p.name}</td>
                <td class="px-4 py-2">${p.sku}</td>
                <td class="px-4 py-2 text-red-600 font-bold">${p.stock}</td>
                <td class="px-4 py-2">${p.minimum_stock}</td>
            </tr>
        `;
    });
});
