document.addEventListener("DOMContentLoaded", async () => {
    const table = document.getElementById("userTable");

    try {
        const res = await fetch("/users", {
            headers: {
                Accept: "application/json",
                "Content-Type": "application/json",
            },
            credentials: "same-origin",
        });

        const result = await res.json();
        table.innerHTML = "";
        console.log(result);

        result.data.forEach((u) => {
            /* ================= ROLE BADGE ================= */
            let roleBadge = "";
            switch (u.role) {
                case "Admin":
                    roleBadge = `
                        <span class="px-3 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-600">
                            🛡 Admin
                        </span>`;
                    break;

                case "Manajer Gudang":
                    roleBadge = `
                        <span class="px-3 py-1 text-xs font-semibold rounded-full bg-orange-100 text-orange-600">
                            📦 Manajer Gudang
                        </span>`;
                    break;

                case "Staff Gudang":
                    roleBadge = `
                        <span class="px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-600">
                            👷 Staff Gudang
                        </span>`;
                    break;

                default:
                    roleBadge = `
                        <span class="px-3 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-600">
                            ${u.role}
                        </span>`;
            }

            /* ================= STATUS BADGE ================= */
            const statusBadge = u.is_active
                ? `<span class="px-3 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-700">Aktif</span>`
                : `<span class="px-3 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-600">Nonaktif</span>`;

            table.innerHTML += `
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4 font-semibold text-gray-800">
                        ${u.name}
                    </td>

                    <td class="px-6 py-4 text-gray-600">
                        ${u.email}
                    </td>

                    <td class="px-6 py-4">
                        ${roleBadge}
                    </td>

                    <td class="px-6 py-4">
                        ${statusBadge}
                    </td>

                    <td class="px-6 py-4">
                        <a href="/admin/users/edit/${u.id}"
                           class="text-indigo-600 hover:underline text-sm">
                           Edit
                        </a>
                    </td>
                </tr>
            `;
        });
    } catch (err) {
        console.error(err);
        alert("Gagal memuat data user");
    }
});
