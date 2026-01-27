function jelszoVissza() {
    let jelszo = "";
    if (ujJelszo == ujJelszoMegint) {
        jelszo = ujJelszo;
    }
    fetch("../src/password_reset.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({
            email: email.value,
            jelszo: jelszo,
        }),
    })
        .then((r) => r.json())
        .then((d) => {
            if (d.success) {
            }
        });
}
