document.addEventListener("DOMContentLoaded", async () => {
    const res = await fetch("/reports/activity-logs", {
        headers: {
            Accept: "application/json",
            "Content-Type": "application/json",
        },
        credentials: "same-origin",
    });

    const result = await res.json();
    const list = document.getElementById("activityList");

    console.log(result);
    list.innerHTML = "";
    result.data.data.forEach((a) => {
        const formattedDate = new Date(a.created_at).toLocaleString("id-ID", {
            day: "2-digit",
            month: "short",
            year: "numeric",
            hour: "2-digit",
            minute: "2-digit",
        });

        list.innerHTML += `
        <li class="flex items-start gap-4 p-4 rounded-lg bg-gray-50 hover:bg-gray-100 transition">

            <div class="w-10 h-10 flex items-center justify-center rounded-full bg-blue-100 text-blue-600 font-bold">
                ${a.user.name.charAt(0)}
            </div>

            <div class="flex-1">
            <div class="flex justify-between items-center">
                <h4 class="font-semibold text-gray-800">${a.action}</h4>
                <span class="text-xs text-gray-400">${formattedDate}</span>
            </div>

            <p class="text-sm text-gray-600 mt-1">${a.description}</p>
            <p class="text-xs text-gray-400 mt-1">oleh ${a.user.name}</p>
        </div>
        </li>`;
    });
});
