let idozito = setInterval(function () {
    let idoElem = document.getElementById("ido");
    let ido = parseInt(idoElem.innerHTML);

    if (ido > 0) {
        idoElem.innerHTML = ido - 1;
    } else {
        window.close();
    }
}, 1000);
