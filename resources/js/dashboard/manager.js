document.addEventListener("DOMContentLoaded", async () => {
    const response = await fetch("/manager/dashboard/data");
    const result = await response.json();

    if (!result.success) return;

    const data = result.data;
    console.log(data);

    document.getElementById("lowStock").innerText = data.low_stock;
    document.getElementById("stockInToday").innerText = data.stock_in_today;
    document.getElementById("stockOutToday").innerText = data.stock_out_today;
    document.getElementById("pending").innerText = data.pending;

    const labels = data.chart.map((item) => item.date);
    const masukData = data.chart.map((item) => item.masuk);
    const keluarData = data.chart.map((item) => item.keluar);

    const ctx = document.getElementById("stockChart");

    new Chart(ctx, {
        type: "line",
        data: {
            labels: labels,
            datasets: [
                {
                    label: "Barang Masuk",
                    data: masukData,
                    borderColor: "#16a34a",
                    backgroundColor: "rgba(22,163,74,0.15)",
                    borderWidth: 2,
                    fill: true,
                    tension: 0.4,
                    pointRadius: 4,
                    pointHoverRadius: 6,
                    pointBackgroundColor: "#16a34a",
                },
                {
                    label: "Barang Keluar",
                    data: keluarData,
                    borderColor: "#2563eb",
                    backgroundColor: "rgba(37,99,235,0.15)",
                    borderWidth: 2,
                    fill: true,
                    tension: 0.4,
                    pointRadius: 4,
                    pointHoverRadius: 6,
                    pointBackgroundColor: "#2563eb",
                },
            ],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            interaction: {
                mode: "index",
                intersect: false,
            },
            plugins: {
                legend: {
                    position: "top",
                    labels: {
                        usePointStyle: true,
                        padding: 20,
                    },
                },
                tooltip: {
                    backgroundColor: "#111827",
                    titleColor: "#fff",
                    bodyColor: "#fff",
                    padding: 12,
                    cornerRadius: 8,
                    displayColors: true,
                },
            },
            scales: {
                x: {
                    grid: {
                        display: false,
                    },
                    ticks: {
                        color: "#6b7280",
                    },
                },
                y: {
                    beginAtZero: true,
                    grid: {
                        color: "rgba(0,0,0,0.05)",
                    },
                    ticks: {
                        stepSize: 1,
                        color: "#6b7280",
                    },
                },
            },
            elements: {
                line: {
                    borderJoinStyle: "round",
                },
            },
        },
    });
});
