function login() {
    fetch("http://localhost/WEB/2025-2026/API/rest_api_demo/backend/api/login.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ username: user.value, password: pass.value }),
    })
        .then((r) => r.json())
        .then((d) => {
            if (d.token) {
                localStorage.setItem("token", d.token);
                location.href = "dashboard.html";
            } else {
                alert("Hibás belépés");
            }
        });
}
