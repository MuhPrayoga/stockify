document.addEventListener("DOMContentLoaded", async () => {
    const res = await fetch("/staff/dashboard/data", {
        headers: { Accept: "application/json" },
        credentials: "same-origin",
    });

    const result = await res.json();
    console.log(result);

    document.getElementById("todayIn").textContent = result.data.today_in;
    document.getElementById("todayOut").textContent = result.data.today_out;
    document.getElementById("pendingTasks").textContent = result.data.pending;
});
