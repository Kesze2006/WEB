function leKer() {
    fetch("../src/db_stats_request.php", {
        method: "POST",
    })
        .then((r) => r.json())
        .then((d) => {
            if (d.success) {
                teacherNumber.innerHTML = d.tanarDb;
                studentNumber.innerHTML = d.diakDb;
            }
        });
}

let lekero = document.getElementById("lekeres");
lekero.addEventListener("click", function (e) {
    const targetId = this.getAttribute("href").substring(1);
    const targetEl = document.getElementById(targetId);

    if (targetEl) {
        // Rövid késleltetés, hogy a böngésző először odaugorjon
        setTimeout(() => {
            targetEl.classList.remove("highlight"); // reset
            void targetEl.offsetWidth; // trigger reflow
            targetEl.classList.add("highlight");
        }, 450);
    }
});

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
                localStorage.setItem("token", d.token);
                location = "foOldal.html";
            }
        });
}
