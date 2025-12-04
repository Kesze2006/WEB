function feladat1() {
    fetch("tancrend.txt")
        .then((res) => res.blob())
        .then((txt) => {
            const fajl = new FormData();
            fajl.append("file", txt, "tancrend.txt");

            return fetch("backEnd.php", {
                method: "POST",
                body: fajl,
            })
                .then((res) => res.json())
                .then((valasz) => {
                    valasz[0].forEach((elem) => {
                        let tancok = document.createElement("option");
                        tancok.innerHTML = elem;
                        let tancok2 = document.createElement("option");
                        tancok2.innerHTML = elem;
                        document.getElementById("tancok").appendChild(tancok);
                        document.getElementById("tancok2").appendChild(tancok2);
                    });
                    valasz[1].forEach((elem) => {
                        let lany = document.createElement("option");
                        lany.innerHTML = elem;
                        let lany2 = document.createElement("option");
                        lany2.innerHTML = elem;

                        document.getElementById("osszesTancos2").appendChild(lany);
                        document.getElementById("osszesTancos").appendChild(lany2);
                    });
                    valasz[2].forEach((elem) => {
                        let fiu = document.createElement("option");
                        fiu.innerHTML = elem;
                        let fiu2 = document.createElement("option");
                        fiu2.innerHTML = elem;
                        document.getElementById("osszesTancos2").appendChild(fiu);
                        document.getElementById("osszesTancos").appendChild(fiu2);
                    });
                });
        });
}

function feladat2() {
    fetch("backEnd.php", {
        method: "POST",
        body: JSON.stringify({
            feladat: "2",
        }),
    })
        .then((x) => x.json())
        .then((valasz) => {
            console.log("Az elsőtánc " + valasz.elsoTanc + " volt az utolsó pedig " + valasz.utolsoTanc + " volt.");
        });
}
function feladat3() {
    fetch("backEnd.php", {
        method: "POST",
        body: JSON.stringify({
            feladat: "3",
            tanc: document.getElementById("tancok").value,
        }),
    })
        .then((x) => x.json())
        .then((valasz) => {
            console.log(valasz);
        });
}
function feladat4() {
    fetch("backEnd.php", {
        method: "POST",
        body: JSON.stringify({
            feladat: "4",
            tancos: document.getElementById("osszesTancos2").value,
        }),
    })
        .then((x) => x.json())
        .then((valasz) => {
            console.log(valasz);
        });
}
function feladat5() {
    fetch("backEnd.php", {
        method: "POST",
        body: JSON.stringify({
            feladat: "5",
            tancos: document.getElementById("osszesTancos").value,
            tanc: document.getElementById("tancok2").value,
        }),
    })
        .then((x) => x.json())
        .then((valasz) => {
            console.log(valasz);
        });
}

function feladat6() {
    fetch("backEnd.php", {
        method: "POST",
        body: JSON.stringify({
            feladat: "6",
        }),
    })
        .then((x) => x.json())
        .then((valasz) => {
            console.log(valasz);
        });
}

function feladat7() {
    fetch("backEnd.php", {
        method: "POST",
        body: JSON.stringify({
            feladat: "7",
        }),
    })
        .then((x) => x.json())
        .then((valasz) => {
            console.log(valasz);
            //nincs kedvem szépen ki íratni az meg hogy egyből textként úgy adja vissza nem jut instant eszembe és nics kedvem most baszakodni vele
        });
}
