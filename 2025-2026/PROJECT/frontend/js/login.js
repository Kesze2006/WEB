function login() {
    fetch("../backend/authentication/login.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({
            email: email.value,
            jelszo: password.value,
        }),
    })
        .then((r) => r.json())
        .then((d) => {
            if (d.success) {
                location = "kezdoLap.html";
            }
        });
}
