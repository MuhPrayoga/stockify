document.addEventListener("DOMContentLoaded", async () => {
    const jobList = document.getElementById("jobList");

    try {
        const dashboardRes = await fetch("/staff/dashboard/data", {
            headers: {
                Accept: "application/json",
            },
            credentials: "same-origin",
        });

        const dashboardResult = await dashboardRes.json();
        console.log(dashboardResult);

        if (dashboardResult.success) {
            renderJobs(dashboardResult.data.jobs);
        }
    } catch (err) {
        console.error("Error load dashboard:", err);
    }

    function renderJobs(jobs) {
        jobList.innerHTML = "";

        if (!jobs || !jobs.length) {
            jobList.innerHTML = `
                <div class="text-gray-400 text-sm">
                    Tidak ada tugas saat ini
                </div>
            `;
            return;
        }

        jobs.forEach((job) => {
            const isMasuk = job.type === "Masuk";

            const badge = isMasuk
                ? `<span class="text-green-600 text-xs font-semibold">⬇ Masuk</span>`
                : `<span class="text-orange-500 text-xs font-semibold">⬆ Keluar</span>`;

            jobList.innerHTML += `
                <div class="job-item flex justify-between items-center border rounded-xl p-4 hover:bg-gray-50 transition">
                    <div>
                        <div class="font-semibold">
                            ${job.product?.name ?? "-"}
                        </div>
                        <div class="text-sm text-gray-500">
                            ${badge} • Qty: ${job.quantity}
                        </div>
                    </div>

                    <button 
                        class="complete-btn px-4 py-2 bg-blue-600 text-white rounded-lg text-sm"
                        data-id="${job.id}">
                        Selesaikan
                    </button>
                </div>
            `;

            document.querySelectorAll(".complete-btn").forEach((btn) => {
                btn.addEventListener("click", function () {
                    completeJob(this.dataset.id);
                });
            });
        });
    }
});

async function completeJob(id) {
    const confirmAction = confirm("Yakin ingin menyelesaikan tugas ini?");
    if (!confirmAction) return;

    const token = localStorage.getItem("token");

    try {
        const res = await fetch(`/stock/${id}/complete`, {
            method: "POST",
            headers: {
                Authorization: `Bearer ${token}`,
                "X-CSRF-TOKEN": document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute("content"),
            },
        });

        const result = await res.json();

        if (!res.ok) throw new Error(result.message);

        alert("Tugas berhasil diselesaikan");

        location.reload();
    } catch (err) {
        alert(err.message);
    }
}
