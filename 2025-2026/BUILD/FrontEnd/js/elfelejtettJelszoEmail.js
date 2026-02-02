function kuld() {
    fetch("../backend/authentication/password_reset.php", {
        method: "POST",
        body: {
            email: email,
        },
    })
        .then((r) => r.json())
        .then((d) => {});
}
