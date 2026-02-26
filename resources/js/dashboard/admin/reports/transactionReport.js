document.addEventListener("DOMContentLoaded", async () => {
    const res = await fetch("/reports/transactions", {
        headers: {
            Accept: "application/json",
            "Content-Type": "application/json",
        },
        credentials: "same-origin",
    });

    const result = await res.json();
    const table = document.getElementById("transactionTable");

    table.innerHTML = "";
    result.data.forEach((t) => {
        const formattedDate = new Date(t.date).toLocaleString("id-ID", {
            day: "2-digit",
            month: "short",
            year: "numeric",
            hour: "2-digit",
            minute: "2-digit",
        });
        table.innerHTML += `
        <tr class="border-t">
            <td class="px-4 py-2">${formattedDate}</td>
            <td class="px-4 py-2">${t.product.name}</td>
            <td class="px-4 py-2">${t.type}</td>
            <td class="px-4 py-2">${t.quantity}</td>
            <td class="px-4 py-2">${t.user.name}</td>
        </tr>`;
    });
});
