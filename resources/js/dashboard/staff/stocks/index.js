document.addEventListener("DOMContentLoaded", async () => {
    let allTransactions = [];
    let currentFilter = "all";

    const table = document.getElementById("transactionTable");
    const opnameTable = document.getElementById("opnameTable");
    const searchInput = document.getElementById("searchInput");

    /* ================= TRANSAKSI ================= */

    const renderTransactions = () => {
        table.innerHTML = "";

        let filtered = allTransactions.filter((t) => {
            const matchFilter =
                currentFilter === "all" || t.type === currentFilter;

            const matchSearch =
                t.product?.name
                    ?.toLowerCase()
                    .includes(searchInput.value.toLowerCase()) ||
                t.user?.name
                    ?.toLowerCase()
                    .includes(searchInput.value.toLowerCase());

            return matchFilter && matchSearch;
        });

        if (!filtered.length) {
            table.innerHTML = `
                <tr>
                    <td colspan="7" class="text-center py-8 text-gray-400">
                        Tidak ada data ditemukan
                    </td>
                </tr>
            `;
            return;
        }

        filtered.forEach((t) => {
            const isMasuk = t.type === "Masuk";

            const typeBadge = isMasuk
                ? `<span class="px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-600">⬇ Masuk</span>`
                : `<span class="px-3 py-1 text-xs font-semibold rounded-full bg-orange-100 text-orange-500">⬆ Keluar</span>`;

            const qtyColor = isMasuk ? "text-green-600" : "text-orange-500";

            const formattedDate = new Date(t.date).toLocaleString("id-ID", {
                day: "2-digit",
                month: "short",
                year: "numeric",
                hour: "2-digit",
                minute: "2-digit",
            });

            let statusBadge = "";

            if (t.status === "Pending") {
                statusBadge = `
        <span class="px-3 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-600">
            ⏳ Pending
        </span>`;
            } else if (t.status === "Diterima") {
                statusBadge = `
        <span class="px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-600">
            ⭕ Approved
        </span>`;
            } else if (t.status === "Ditolak") {
                statusBadge = `
        <span class="px-3 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-600">
            ❌ Rejected
        </span>`;
            } else if (t.status === "Dikeluarkan") {
                statusBadge = `
        <span class="px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-600">
            ➖ Released
        </span>`;
            } else if (t.status === "Selesai") {
                statusBadge = `
        <span class="px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-600">
            ✔ Completed
        </span>`;
            } else {
                statusBadge = `
        <span class="px-3 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-500">
            -
        </span>`;
            }

            table.innerHTML += `
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4">${formattedDate}</td>
                    <td class="px-6 py-4">${typeBadge}</td>
                    <td class="px-6 py-4 font-semibold">${t.product?.name ?? "-"}</td>
                    <td class="px-6 py-4 text-gray-500">${t.product?.sku ?? "-"}</td>
                    <td class="px-6 py-4 font-bold ${qtyColor}">
                        ${isMasuk ? "+" : "-"}${t.quantity}
                    </td>
                    <td class="px-6 py-4">${t.notes ?? "-"}</td>
                    <td class="px-6 py-4">${t.user?.name ?? "-"}</td>
                    <td class="px-6 py-4">${statusBadge}</td>
                </tr>
            `;
        });
    };

    const trxRes = await fetch("/stock-transactions", {
        headers: {
            Accept: "application/json",
            "Content-Type": "application/json",
        },
        credentials: "same-origin",
    });

    const trxResult = await trxRes.json();
    allTransactions = trxResult.data;
    console.log(trxResult);
    renderTransactions();

    document.querySelectorAll(".filterBtn").forEach((btn) => {
        btn.addEventListener("click", () => {
            document
                .querySelectorAll(".filterBtn")
                .forEach((b) => b.classList.remove("bg-white", "shadow"));

            btn.classList.add("bg-white", "shadow");
            currentFilter = btn.dataset.filter;
            renderTransactions();
        });
    });

    searchInput.addEventListener("input", renderTransactions);
});
