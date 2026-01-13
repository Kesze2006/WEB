function reg() {
    fetch("http://localhost/WEB/2025-2026/PROJECT/backend/authentication/register.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({
            felhasznalo: username.value,
            email: email.value,
            jelszo: password.value,
            szerep: document.querySelector('input[name="szerep"]:checked').value,
        }),
    })
        .then((r) => r.json())
        .then((d) => {
            console.log(d);
        });
}
