function init() {
    fetch("../backend/authentication/auth.php")
        .then((r) => r.json())
        .then((d) => {
            if (d.success) {
                const userRole = d.szerep;
                nev.innerHTML = d.nev;
                email.innerHTML = d.email;
            }
        });
}
function applyRole(role) {
    document.querySelectorAll("[data-role]").forEach((el) => {
        const roles = el.dataset.role.split(" ");
        el.style.display = roles.includes(role) ? "" : "none";
    });
}

applyRole(userRole);

const btn = document.getElementById("hamburgerBtn");
const sidebar = document.getElementById("sidebar");
const content = document.getElementById("content");

btn.addEventListener("click", () => {
    sidebar.classList.toggle("expanded");
    content.classList.toggle("shifted");
});

const toggle = document.getElementById("themeToggle");

// Betöltéskor ellenőrizzük az elmentett módot
if (localStorage.getItem("theme") === "light") {
    document.body.classList.add("light");
    toggle.checked = true;
}

toggle.addEventListener("change", () => {
    document.body.classList.toggle("light");

    if (document.body.classList.contains("light")) {
        localStorage.setItem("theme", "light");
    } else {
        localStorage.setItem("theme", "dark");
    }
});

function loadTananyag(file) {
    fetch(`tananyagok/${file}`)
        .then((response) => {
            if (!response.ok) throw new Error("Nem található");
            return response.text();
        })
        .then((html) => {
            document.getElementById("contentInner").innerHTML = html;
            history.pushState({ file }, "", `?tananyag=${file}`);
        })
        .catch((err) => {
            document.getElementById("contentInner").innerHTML = "<p>❌ Hiba a tananyag betöltésekor.</p>";
        });
}

/* Vissza gomb kezelése */
window.addEventListener("popstate", (e) => {
    if (e.state?.file) {
        loadTananyag(e.state.file);
    }
});

/* Oldal betöltés URL-ből */
window.addEventListener("load", () => {
    const params = new URLSearchParams(window.location.search);
    const file = params.get("tananyag");
    if (file) loadTananyag(file);
});

function toggleLimitInput() {
    const checkbox = document.getElementById("limitCheck");
    const input = document.getElementById("limitInput");
    input.style.display = checkbox.checked ? "block" : "none";
}
function logout() {
    fetch("../backend/authentication/logout.php")
        .then((r) => r.json())
        .then((d) => {
            location = "../frontend/kezdoLap.html";
        });
}
