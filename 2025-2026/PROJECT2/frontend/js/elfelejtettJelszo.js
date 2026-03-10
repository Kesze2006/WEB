function jelszoVissza() {
    let jelszo = "";
    if (ujJelszo.value == ujJelszoMegint.value) {
        jelszo = ujJelszo.value;
        const params = new URLSearchParams(window.location.search);
        const email = params.get("email");
        fetch("../src/jelszo_beallitas.php", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({
                jelszo: jelszo,
                email: email,
            }),
        })
            .then((r) => r.json())
            .then((d) => {
                console.log(d);
            });
    } else {
        alert("Hiba!");
    }
}
