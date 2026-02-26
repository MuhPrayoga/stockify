document.addEventListener("DOMContentLoaded", () => {
    let currentPage = 1;

    const formatDate = (dateString) => {
        const date = new Date(dateString);
        return date.toLocaleString("id-ID", {
            day: "2-digit",
            month: "short",
            year: "numeric",
            hour: "2-digit",
            minute: "2-digit",
        });
    };

    const getActionBadge = (action) => {
        const map = {
            CREATE: "bg-green-100 text-green-600",
            UPDATE: "bg-blue-100 text-blue-600",
            DELETE: "bg-red-100 text-red-600",
            LOGIN: "bg-purple-100 text-purple-600",
            LOGOUT: "bg-gray-100 text-gray-600",
        };

        const color = map[action] || "bg-amber-100 text-amber-600";

        return `
            <span class="px-3 py-1 text-xs rounded-full font-medium ${color}">
                ${action}
            </span>
        `;
    };

    const loadLogs = async (page = 1) => {
        try {
            const res = await fetch(`/activity-logs?page=${page}`, {
                headers: { Accept: "application/json" },
            });

            if (!res.ok) throw new Error("Network response was not ok");

            const result = await res.json();

            const { data, current_page, last_page } = result.data ?? result;

            const tbody = document.getElementById("activityLogTable");
            tbody.innerHTML = "";

            if (!data || data.length === 0) {
                tbody.innerHTML = `
                    <tr>
                        <td colspan="4" class="text-center py-8 text-gray-400">
                            Tidak ada activity log
                        </td>
                    </tr>
                `;
                return;
            }

            data.forEach((log) => {
                tbody.innerHTML += `
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                            ${formatDate(log.created_at)}
                        </td>
                        <td class="px-6 py-4 text-sm font-medium text-gray-800">
                            ${log.user ? log.user.name : "-"}
                        </td>
                        <td class="px-6 py-4">
                            ${getActionBadge(log.action)}
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600">
                            ${log.description ?? "-"}
                        </td>
                    </tr>
                `;
            });

            document.getElementById("pageInfo").innerText =
                `Page ${current_page} of ${last_page}`;

            document.getElementById("prevPage").disabled = current_page === 1;

            document.getElementById("nextPage").disabled =
                current_page === last_page;

            currentPage = current_page;
        } catch (err) {
            console.error(err);
            alert("Terjadi kesalahan saat memuat log");
        }
    };

    document.getElementById("prevPage").onclick = () =>
        loadLogs(currentPage - 1);

    document.getElementById("nextPage").onclick = () =>
        loadLogs(currentPage + 1);

    loadLogs();
});
