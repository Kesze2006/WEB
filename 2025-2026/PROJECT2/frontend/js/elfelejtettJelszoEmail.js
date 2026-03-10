function kuld() {
    fetch("../src/password_reset.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({
            email: email.value,
        }),
    })
        .then((r) => r.json())
        .then((d) => {});
}
