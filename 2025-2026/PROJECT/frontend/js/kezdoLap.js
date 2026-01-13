let ido = 10;
const kijelzo = document.getElementById("visszaszamlalo");

const timer = setInterval(() => {
    kijelzo.textContent = ido;
    ido--;

    if (ido < 0) {
        clearInterval(timer);
        kijelzo.textContent = "Lejárt az időd!";
    }
}, 1000);
