import { Chart } from "chart.js";

document.addEventListener("DOMContentLoaded", async () => {
    try {
        const res = await fetch("/admin/dashboard/data", {
            headers: { Accept: "application/json" },
        });

        if (!res.ok) throw new Error("Failed load dashboard");

        const result = await res.json();
        const data = result.data ?? result;
        console.log(data);

        // SUMMARY
        document.getElementById("totalProducts").innerText =
            data.total_products ?? 0;

        document.getElementById("stockIn").innerText = data.total_stock_in ?? 0;

        document.getElementById("stockOut").innerText =
            data.total_stock_out ?? 0;

        document.getElementById("lowStock").innerText =
            data.low_stock_products ?? 0;

        document.getElementById("pendingTransactions").innerText =
            data.pending_transactions ?? 0;
    } catch (err) {
        console.error(err);
        alert("Gagal memuat dashboard");
    }

    // ================= STOCK CHART =================
    const loadStockChart = async () => {
        const res = await fetch("/charts/stock-transactions");
        const result = await res.json();

        const labels = result.data.map((d) => `Bulan ${d.month}`);
        const stockIn = result.data.map((d) => d.stock_in);
        const stockOut = result.data.map((d) => d.stock_out);

        new Chart(document.getElementById("stockChart"), {
            type: "line",
            data: {
                labels,
                datasets: [
                    { label: "Stock Masuk", data: stockIn },
                    { label: "Stock Keluar", data: stockOut },
                ],
            },
        });
    };

    // ================= CATEGORY CHART =================
    const loadCategoryChart = async () => {
        const res = await fetch("/charts/stock-by-category", {
            headers: {
                Accept: "application/json",
            },
            credentials: "same-origin",
        });

        if (!res.ok) {
            console.log("Status:", res.status);
            const text = await res.text();
            console.log("Response text:", text);
            return;
        }

        const result = await res.json();
        const data = result.data ?? result;

        new Chart(document.getElementById("categoryChart"), {
            type: "doughnut",
            data: {
                labels: data.map((d) => d.category),
                datasets: [
                    {
                        data: data.map((d) => d.total_stock),
                    },
                ],
            },
        });
    };

    // ================= LOW STOCK CHART =================
    // const loadLowStockChart = async () => {
    //     const res = await fetch("/charts/low-stock");
    //     const result = await res.json();

    //     new Chart(document.getElementById("lowStockChart"), {
    //         type: "bar",
    //         data: {
    //             labels: result.data.map((d) => d.name),
    //             datasets: [
    //                 {
    //                     label: "Stock",
    //                     data: result.data.map((d) => d.stock),
    //                 },
    //             ],
    //         },
    //     });
    // };

    loadStockChart();
    loadCategoryChart();
    // loadLowStockChart();
});
