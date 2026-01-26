const body = document.body;
const student = document.getElementById("student");
const teacher = document.getElementById("teacher");
const loginBox = document.getElementById("loginBox");
const backBtn = document.getElementById("backBtn");
const bg = document.querySelector(".background");

function selectRole(role) {
    body.classList.add(role + "-active");
    student.classList.remove("kijeloles");
    teacher.classList.remove("kijeloles");
    setTimeout(() => {
        document.getElementById(role).classList.add("text-fly-up");
        bg.classList.add("sharp");
    }, 1000);

    setTimeout(() => {
        loginBox.classList.add("show");
        backBtn.classList.add("show");
    }, 1600);
}

student.addEventListener("click", () => selectRole("student"));
teacher.addEventListener("click", () => selectRole("teacher"));

backBtn.addEventListener("click", () => {
    body.className = "";
    student.classList.remove("text-fly-up");
    teacher.classList.remove("text-fly-up");
    student.classList.add("kijeloles");
    teacher.classList.add("kijeloles");
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
                szerep: document.querySelector('input[name="szerep"]:checked').value,
            }),
        })
            .then((r) => r.json())
            .then((d) => {
                if (d.success) {
                    User.email = d.email;
                    localStorage.setItem("email", d.email);
                    location = "emailJelzo.html";
                }
            });
    } else {
        alert("Email!");
    }
}
