document.addEventListener("DOMContentLoaded", async () => {
    const productId = document.getElementById("productId").value;
    const table = document.getElementById("attributeTable");
    const csrf = document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content");

    try {
        const res = await fetch(`/products/${productId}/attributes`, {
            headers: {
                Accept: "application/json",
                "X-Requested-With": "XMLHttpRequest",
            },
            credentials: "same-origin",
        });

        const data = await res.json();
        table.innerHTML = "";

        data.forEach((attr) => {
            let inputField = `
                <input type="text"
                    value="${attr.value ?? ""}"
                    data-id="${attr.id}"
                    class="attributeInput border rounded-lg px-3 py-2 w-full">
            `;

            table.innerHTML += `
                <tr>
                    <td class="px-6 py-4 font-medium text-gray-800">
                        ${attr.name}
                    </td>

                    <td class="px-6 py-4">
                        ${inputField}
                    </td>

                    <td class="px-6 py-4 text-right">
                        <button data-id="${attr.id}"
                            class="saveBtn bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-indigo-700">
                            Simpan
                        </button>
                    </td>
                </tr>
            `;
        });

        document.querySelectorAll(".saveBtn").forEach((btn) => {
            btn.addEventListener("click", async () => {
                const attributeId = btn.dataset.id;
                const input = document.querySelector(
                    `.attributeInput[data-id="${attributeId}"]`,
                );
                const value = input.value;

                const response = await fetch(
                    `/products/${productId}/attributes`,
                    {
                        method: "POST",
                        headers: {
                            Accept: "application/json",
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": csrf,
                        },
                        credentials: "same-origin",
                        body: JSON.stringify({
                            attribute_id: Number(attributeId), // pastikan number
                            value: value,
                        }),
                    },
                );

                const result = await response.json();
                console.log("STATUS:", response.status);
                console.log("RESPONSE:", result);

                if (result.deleted) {
                    alert("Attribute berhasil dihapus");
                }
                if (result.success) {
                    alert("Attribute berhasil disimpan");
                } else {
                    alert("Gagal menyimpan");
                }
            });
        });
    } catch (err) {
        console.error(err);
        table.innerHTML = `
            <tr>
                <td colspan="3" class="text-center text-red-500 py-6">
                    Gagal memuat attribute
                </td>
            </tr>
        `;
    }
});
