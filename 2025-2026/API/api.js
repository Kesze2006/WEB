document.body.onload = init();

function init() {
    //console.log("start");
    sorBetolt();
}

function hozzaAd(sor, id) {
    return `
          <div class="container">
            <div class="row bg-light">
              <div class="col-9">${sor}</div>
              <div class="col-1"><button class="btn btn-success btn-sm" onclick="">✔️</button></div>
                    <div class="col-1"><button class="btn btn-danger btn-sm" onclick="torles(${id})">🗑️</button></div>
                    <div class="col-1"><button class="btn btn-secondary btn-sm" onclick="">✏️</button></div>
            </div>
          </div>
        `;
}

function sorBetolt() {
    fetch("todo")
        .then((x) => x.json())
        .then((adatok) => {
            adatok.forEach((todo) => {
                document.getElementById("lista").innerHTML += hozzaAd(todo.szoveg, todo.id);
            });
        });
}

function hozzaAdGomb() {
    let szoveg = document.getElementById("szoveg").value;
    let json = {
        memberid: "valami",
        feladat: szoveg,
    };

    fetch("todo/", {
        method: "POST",
        body: JSON.stringify(json),
    })
        .then((x) => x.json)
        .then((adatok) => {
            if ((adatok.statusz = "success")) {
                document.getElementById("lista").innerHTML = "";
                document.getElementById("szoveg").value = "";
                sorBetolt();
            }
        });
}

function torles(elem) {
    let json = {
        memberid: "valami",
        id: elem,
    };
    fetch("todo/" + elem, {
        method: "DELETE",
        body: JSON.stringify(json),
    })
        .then((x) => x.json)
        .then((adatok) => {
            if ((adatok.statusz = "success")) {
                document.getElementById("lista").innerHTML = "";
                sorBetolt();
            }
        });
}
