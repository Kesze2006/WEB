document.body.onload = init();

function init() {
    //console.log("start");
    sorBetolt();
}

function hozzaAd(sor) {
    return `
          <div class="container">
            <div class="row bg-light">
              <div class="col-9">${sor}</div>
              <div class="col-1"><button class="btn btn-sm onclick=">✔️</button></div>
              <div class="col-1"><button class="btn btn-sm onclick=">🗑️</button></div>
              <div class="col-1"><button class="btn btn-sm onclick=">✏️</button></div>
            </div>
          </div>
        `;
}

function sorBetolt() {
    fetch("todo")
        .then((x) => x.json())
        .then((adatok) => {
            adatok.forEach((todo) => {
                document.getElementById("lista").innerHTML += hozzaAd(todo.szoveg);
            });
        });
}

function hozzaAdGomb() {
    let szoveg = document.getElementById("szoveg").value;
    let json = {
        memebrid: "valami",
        feladat: szoveg,
    };

    fetch("todo/", {
        method: "POST",
        body: JSON.stringify(json),
    })
        .then((x) => x.json)
        .then((adatok) => {});
}
