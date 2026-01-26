const body = document.body;
const diak = document.getElementById("diak");
const tanar = document.getElementById("tanar");
const loginBox = document.getElementById("loginBox");
const backBtn = document.getElementById("backBtn");
const bg = document.querySelector(".background");
let szerep = "";
function selectRole(role) {
    body.classList.add(role + "-active");
    diak.classList.remove("kijeloles");
    tanar.classList.remove("kijeloles");
    setTimeout(() => {
        document.getElementById(role).classList.add("text-fly-up");
        bg.classList.add("sharp");
    }, 1000);

    setTimeout(() => {
        loginBox.classList.add("show");
        backBtn.classList.add("show");
    }, 1600);
    if (role == "tanar") {
        szerep = 2;
    } else if (role == "diak") {
        szerep = 1;
    }
}

diak.addEventListener("click", () => selectRole("diak"));
tanar.addEventListener("click", () => selectRole("tanar"));

backBtn.addEventListener("click", () => {
    body.className = "";
    diak.classList.remove("text-fly-up");
    tanar.classList.remove("text-fly-up");
    diak.classList.add("kijeloles");
    tanar.classList.add("kijeloles");
    loginBox.classList.remove("show");
    backBtn.classList.remove("show");
    bg.classList.remove("sharp");
});

function reg() {
    const minta = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (email.value.match(minta)) {
        fetch("../backend/authentication/register.php", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({
                felhasznalo: username.value,
                email: email.value,
                jelszo: password.value,
                szerep: szerep,
            }),
        })
            .then((r) => r.json())
            .then((d) => {
                if (d.success) {
                    User.email = d.email;
                    localStorage.setItem("email", d.email);
                    location = "sikeresReg.html";
                }
            });
    } else {
        alert("Email!");
    }
}
