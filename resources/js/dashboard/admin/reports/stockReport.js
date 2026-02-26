document.addEventListener("DOMContentLoaded", async () => {
    const table = document.getElementById("stockTable");

    const res = await fetch("/reports/stock", {
        headers: {
            Accept: "application/json",
            "Content-Type": "application/json",
        },
        credentials: "same-origin",
    });

    const result = await res.json();
    table.innerHTML = "";

    result.data.forEach((p) => {
        const badge =
            p.status === "MENIPIS"
                ? `<span class="text-red-600 font-semibold">MENIPIS</span>`
                : `<span class="text-green-600 font-semibold">AMAN</span>`;

        table.innerHTML += `
            <tr class="border-t">
                <td class="px-4 py-2">${p.product_name}</td>
                <td class="px-4 py-2">${p.category}</td>
                <td class="px-4 py-2">${p.stock}</td>
                <td class="px-4 py-2">${p.minimum_stock}</td>
                <td class="px-4 py-2">${badge}</td>
            </tr>
        `;
    });
});
