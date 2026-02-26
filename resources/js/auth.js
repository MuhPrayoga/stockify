export function requireAuth(requiredRole = null) {
    const token = localStorage.getItem("token");
    const role = localStorage.getItem("role");

    if (!token || !role) {
        window.location.href = "/login";
        return;
    }

    if (requiredRole && role !== requiredRole) {
        alert("Anda tidak punya akses ke halaman ini");
        window.location.href = "/login";
    }
}
