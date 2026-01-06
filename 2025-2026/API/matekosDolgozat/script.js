function faktorialis() {
    fetch("index.php/fakt/" + document.getElementById("szamFakt").value)
        .then((x) => x.text())
        .then((valasz) => {
            document.getElementById("eredmenyFakt").classList.remove("d-none");
            document.getElementById("eredmenyFakt").innerHTML = "Eredmény: " + valasz;
        });
}
function szorzas() {
    fetch(
        "index.php/szorzat/" +
            document.getElementById("szamSzorzas1").value +
            "/" +
            document.getElementById("szamSzorzas2").value,
    )
        .then((x) => x.text())
        .then((valasz) => {
            document.getElementById("eredmenySzorzas").classList.remove("d-none");
            document.getElementById("eredmenySzorzas").innerHTML = "Eredmény: " + valasz;
        });
}
function haromszog() {
    fetch(
        "index.php/haromszog/" +
            document.getElementById("szamHarom1").value +
            "/" +
            document.getElementById("szamHarom2").value +
            "/" +
            document.getElementById("szamHarom3").value +
            "/",
    )
        .then((x) => x.text())
        .then((valasz) => {
            document.getElementById("eredmenyHarom").classList.remove("d-none");
            document.getElementById("eredmenyHarom").innerHTML = "Eredmény: " + valasz;
        });
}
function randomMax() {
    fetch("index.php/random/" + document.getElementById("szamRandMax").value)
        .then((x) => x.text())
        .then((valasz) => {
            document.getElementById("eredmenyRandMax").classList.remove("d-none");
            document.getElementById("eredmenyRandMax").innerHTML = "Eredmény: " + valasz;
        });
}
function randomTolIg() {
    fetch(
        "index.php/random/" +
            document.getElementById("szamRandomTol1").value +
            "/" +
            document.getElementById("szamRandomTol2").value,
    )
        .then((x) => x.text())
        .then((valasz) => {
            document.getElementById("eredmenyRandomTol").classList.remove("d-none");
            document.getElementById("eredmenyRandomTol").innerHTML = "Eredmény: " + valasz;
        });
}
function randomLepes() {
    fetch(
        "index.php/random/" +
            document.getElementById("szamRandomLepes1").value +
            "/" +
            document.getElementById("szamRandomLepes2").value +
            "/" +
            document.getElementById("szamRandomLepes3").value +
            "/",
    )
        .then((x) => x.text())
        .then((valasz) => {
            document.getElementById("eredmenyRandomLepes").classList.remove("d-none");
            document.getElementById("eredmenyRandomLepes").innerHTML = "Eredmény: " + valasz;
        });
}
function lorem() {
    fetch("index.php/lorem/" + document.getElementById("szamLabel").value)
        .then((x) => x.text())
        .then((valasz) => {
            document.getElementById("eredmenyLabel").classList.remove("d-none");
            document.getElementById("eredmenyLabel").innerHTML = "Eredmény: " + valasz;
        });
}
