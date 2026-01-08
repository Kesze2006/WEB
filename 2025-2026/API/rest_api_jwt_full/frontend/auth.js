function login() {
    fetch("http://localhost/WEB/2025-2026/API/rest_api_jwt_full/backend/api/login.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ username: u.value, password: p.value }),
    })
        .then((r) => r.json())
        .then((d) => {
            if (d.error) {
                alert("Szar vagy!");
            } else {
                localStorage.token = d.token;
                location = "dashboard.html";
            }
        });
}

function reg() {
    fetch("http://localhost/WEB/2025-2026/API/rest_api_jwt_full/backend/api/register.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ username: u.value, password: p.value }),
    })
        .then((r) => r.json())
        .then(() => (location = "index.html"));
}
