document.addEventListener("DOMContentLoaded", async () => {
    const csrf = document
        .querySelector('meta[name="csrf-token"]')
        ?.getAttribute("content");

    if (!csrf) {
        console.error("CSRF token tidak ditemukan!");
    }

    const table = document.getElementById("pendingStockTable");
    if (!table) return;

    try {
        const res = await fetch("/stock-transactions", {
            headers: {
                Accept: "application/json",
                "Content-Type": "application/json",
            },
            credentials: "same-origin",
        });

        const result = await res.json();

        if (!result.success) return;

        // FILTER STATUS PENDING
        const pendingData = result.data.filter((t) => t.status === "Pending");

        table.innerHTML = "";

        if (pendingData.length === 0) {
            table.innerHTML = `
                <tr>
                    <td colspan="6" class="text-center py-6 text-gray-400">
                        Tidak ada transaksi pending
                    </td>
                </tr>
            `;
            return;
        }

        pendingData.forEach((t) => {
            table.innerHTML += `
                <tr class="border-t">
                    <td class="px-6 py-3">
                        ${new Date(t.date).toLocaleDateString()}
                    </td>

                    <td class="px-6 py-3 font-medium">
                        ${t.product?.name ?? "-"}
                    </td>

                    <td class="px-6 py-3">
                        <span class="px-2 py-1 text-xs rounded-full 
                            ${
                                t.type === "Masuk"
                                    ? "bg-green-100 text-green-600"
                                    : "bg-red-100 text-red-600"
                            }">
                            ${t.type}
                        </span>
                    </td>

                    <td class="px-6 py-3 font-semibold">
                        ${t.quantity}
                    </td>

                    <td class="px-6 py-3">
                        ${t.user?.name ?? "-"}
                    </td>
                    
                    <td class="px-6 py-3 font-semibold">
                        ${t.notes}
                    </td>

                    <td class="px-6 py-3 space-x-2">

                        <button 
                            onclick="approveStock(${t.id})"
                            class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded-lg text-xs">
                            Approve
                        </button>

                        <button 
                            onclick="rejectStock(${t.id})"
                            class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded-lg text-xs">
                            Reject
                        </button>

                    </td>
                </tr>
            `;
        });
    } catch (err) {
        console.error("Error loading pending stock:", err);
    }
});

window.approveStock = async function (id) {
    if (!confirm("Approve transaksi ini?")) return;
    const csrf = document
        .querySelector('meta[name="csrf-token"]')
        ?.getAttribute("content");

    if (!csrf) {
        console.error("CSRF token tidak ditemukan!");
    }

    try {
        const res = await fetch(`/stock/${id}/approve`, {
            method: "POST",
            headers: {
                Accept: "application/json",
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": csrf,
            },
            credentials: "same-origin",
        });

        if (!res.ok) {
            alert("Gagal approve!");
            return;
        }

        alert("Berhasil approve!");
        location.reload();
    } catch (error) {
        console.error(error);
        alert("Terjadi kesalahan!");
    }
};

window.rejectStock = async function (id) {
    if (!confirm("Reject transaksi ini?")) return;
    const csrf = document
        .querySelector('meta[name="csrf-token"]')
        ?.getAttribute("content");

    if (!csrf) {
        console.error("CSRF token tidak ditemukan!");
    }

    try {
        const res = await fetch(`/stock/${id}/reject`, {
            method: "POST",
            headers: {
                Accept: "application/json",
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": csrf,
            },
            credentials: "same-origin",
        });

        if (!res.ok) {
            alert("Gagal reject!");
            return;
        }

        alert("Berhasil reject!");
        location.reload();
    } catch (error) {
        console.error(error);
        alert("Terjadi kesalahan!");
    }
};
