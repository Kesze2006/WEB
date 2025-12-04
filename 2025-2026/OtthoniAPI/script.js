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
            document.getElementById("feladat2").innerHTML =
                "Az elsőtánc " + valasz.elsoTanc + " volt az utolsó pedig " + valasz.utolsoTanc + " volt.";
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
            document.getElementById("feladat3").innerHTML =
                valasz + " alkalommal táncoltak " + document.getElementById("tancok").value + "-t";
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
            document.getElementById("feladat4").innerHTML =
                document.getElementById("osszesTancos2").value + " az alábbi táncokat táncolta: " + valasz;
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
            if (valasz) {
                document.getElementById("feladat5").innerHTML =
                    "A " +
                    document.getElementById("tancok2").value +
                    " bemutatóján " +
                    document.getElementById("osszesTancos").value +
                    " párja " +
                    valasz +
                    " volt.";
            } else {
                document.getElementById("feladat5").innerHTML =
                    document.getElementById("osszesTancos").value +
                    " nem táncolt " +
                    document.getElementById("tancok2").value +
                    "-t.";
            }
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
            document.getElementById("feladat6").innerHTML =
                "A legtöbbet táncolt fiú(k): " + valasz[0] + " A legtöbbet táncolt lány(ok) pedig: " + valasz[1];
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
            let tabla = document.createElement("table");
            tabla.classList.add("table");
            tabla.classList.add("table-striped-columns");
            let trCim = document.createElement("tr");
            let thFiu = document.createElement("th");
            let thLany = document.createElement("th");
            tabla.appendChild(trCim);
            thFiu.innerHTML = "Fiúk";
            thLany.innerHTML = "Lányok";
            trCim.appendChild(thFiu);
            trCim.appendChild(thLany);
            for (let i = 0; i < Object.keys(valasz).length - 1; i++) {
                let tr = document.createElement("tr");
                let tdFiu = document.createElement("td");
                let tdLany = document.createElement("td");
                tdFiu.innerHTML = valasz[i].fiu;
                tdLany.innerHTML = valasz[i].lany;
                tr.appendChild(tdFiu);
                tr.appendChild(tdLany);
                tabla.appendChild(tr);
            }
            document.getElementById("feladat7").innerHTML = "";
            document.getElementById("feladat7").appendChild(tabla);
        });
}
