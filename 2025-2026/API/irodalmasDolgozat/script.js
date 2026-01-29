//Balázs Béla nem jó mert az adatbázisabn nem tartozik hosszá vers.

function init() {
    koltok();
    randomVersek();
    fejlecVers();
    setInterval(fejlecVers, 30000);
}

function koltok() {
    fetch("api/kolto")
        .then((x) => x.json())
        .then((valasz) => {
            valasz.forEach((e) => {
                let div = document.createElement("div");
                div.innerHTML = e.nev;
                div.addEventListener("click", () => koltoAdatok(e));
                div.classList.add("mb-2", "text-center", "border-black", "btn", "d-block", "kolto");
                koltokDiv.appendChild(div);
            });
        });
}

function randomVersek() {
    fetch("api/versek/4")
        .then((x) => x.json())
        .then((valasz) => {
            valasz.sok.forEach((e) => {
                let colDiv = document.createElement("div");
                colDiv.classList.add("col");

                let cardDiv = document.createElement("div");
                cardDiv.classList.add("card");
                colDiv.appendChild(cardDiv);

                let cardBodyDiv = document.createElement("div");
                cardBodyDiv.classList.add("card-body");
                cardDiv.appendChild(cardBodyDiv);

                let strong = document.createElement("strong");
                strong.innerHTML = e.kolto_nev + " - " + e.cim;
                cardBodyDiv.appendChild(strong);

                cardBodyDiv.appendChild(document.createElement("br"));

                let p = document.createElement("p");
                p.classList.add("mb-0");
                if (e.versszakok == null) {
                    p.innerHTML = "A vershez nem tartozik versszak!";
                } else {
                    let darab = e.versszakok.split("\n")[0];
                    if (darab.includes("/")) {
                        p.innerHTML = darab.split("/")[0];
                    } else {
                        p.innerHTML = darab;
                    }
                }
                cardBodyDiv.appendChild(p);

                randomVersekDiv.appendChild(colDiv);
            });
        });
}

function fejlecVers() {
    fetch("api/versek")
        .then((x) => x.json())
        .then((valasz) => {
            let h2 = document.createElement("h2");
            h2.classList.add("mb-2");
            h2.textContent = "Fél perces idézet";
            header.innerHTML = "";
            header.appendChild(h2);
            let div = document.createElement("div");
            let szoveg = "";
            if (valasz[0].versszakok == null) {
                szoveg = "A vershez nem tartozik versszak!";
            } else {
                let darab = valasz[0].versszakok.split("\n")[0];
                if (darab.includes("/")) {
                    szoveg = darab.split("/")[0];
                } else {
                    szoveg = darab;
                }
            }
            let idezet = document.createTextNode("„" + szoveg + "”");
            div.appendChild(idezet);
            div.appendChild(document.createElement("br"));

            let em = document.createElement("em");
            em.innerHTML = valasz[0].kolto_nev + " - " + valasz[0].cim + " - " + valasz[0].megjelenes_eve;
            div.appendChild(em);
            header.appendChild(div);
        });
}

function koltoAdatok(e) {
    adatok.innerHTML = "";

    let div = document.createElement("div");
    div.classList.add("mb-4");

    let h3Nev = document.createElement("h3");
    h3Nev.textContent = e.nev;
    div.appendChild(h3Nev);

    let hr1 = document.createElement("hr");
    div.appendChild(hr1);

    let p = document.createElement("p");

    let strongSzuletett = document.createElement("strong");
    strongSzuletett.textContent = "Született: ";
    p.appendChild(strongSzuletett);
    p.appendChild(document.createTextNode(e.szuletesi_datum));
    p.appendChild(document.createElement("br"));

    let strongSzuletesiHely = document.createElement("strong");
    strongSzuletesiHely.textContent = "Születési hely: ";
    p.appendChild(strongSzuletesiHely);
    p.appendChild(document.createTextNode(e.szuletesi_hely));
    p.appendChild(document.createElement("br"));

    let strongMeghalt = document.createElement("strong");
    strongMeghalt.textContent = "Meghalt: ";
    p.appendChild(strongMeghalt);
    p.appendChild(document.createTextNode(e.halalozi_datum));
    p.appendChild(document.createElement("br"));

    let strongHalalozas = document.createElement("strong");
    strongHalalozas.textContent = "Halálozási hely: ";
    p.appendChild(strongHalalozas);
    p.appendChild(document.createTextNode(e.halalozi_hely));
    p.appendChild(document.createElement("br"));

    div.appendChild(p);

    let h3Versei = document.createElement("h3");
    h3Versei.textContent = "Versei";
    div.appendChild(h3Versei);

    let hr2 = document.createElement("hr");
    div.appendChild(hr2);

    let ul = document.createElement("ul");
    ul.classList.add("list-group");

    for (let i = 0; i < e.versek_cime.split("\n").length; i++) {
        let li = document.createElement("li");
        li.classList.add("list-group-item");
        li.textContent = e.versek_cime.split("\n")[i];
        li.addEventListener("click", () => versAdatok(e.versek_id.split("\n")[i]));
        ul.appendChild(li);
    }

    div.appendChild(ul);
    adatok.appendChild(div);
}

function versAdatok(id) {
    fetch("api/versek/" + id)
        .then((x) => x.json())
        .then((valasz) => {
            console.log(valasz);
            versAdat.innerHTML = "";

            let div = document.createElement("div");

            let h3 = document.createElement("h3");
            h3.textContent = "Részlet a kiválasztott versből";
            div.appendChild(h3);

            let hr1 = document.createElement("hr");
            div.appendChild(hr1);

            let card = document.createElement("div");
            card.className = "card";
            div.appendChild(card);

            let cardBody = document.createElement("div");
            cardBody.className = "card-body";
            card.appendChild(cardBody);

            let h4 = document.createElement("h4");
            h4.textContent = valasz.egy[0].cim + " - " + valasz.egy[0].megjelenes_eve;
            cardBody.appendChild(h4);

            let p = document.createElement("p");
            p.className = "mb-0";
            let szoveg = "";
            if (valasz.egy[0].versszakok == null) {
                szoveg = "A vershez nem tartozik versszak!";
            } else {
                szoveg = valasz.egy[0].versszakok.replace("\n", " ");
            }
            p.innerHTML = szoveg;
            cardBody.appendChild(p);

            versAdat.appendChild(div);
        });
}
