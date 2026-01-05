function faktorialis() {
    fetch("index.php/fakt/2")
        .then((x) => x.text())
        .then((valasz) => {
            console.log(valasz);
        });
}
function szorzas() {
    fetch("index.php/szorzat/2/2")
        .then((x) => x.text())
        .then((valasz) => {
            console.log(valasz);
        });
}
function haromszog() {
    fetch("index.php/haromszog/2/2/2")
        .then((x) => x.text())
        .then((valasz) => {
            console.log(valasz);
        });
}
function randomMax() {
    fetch("index.php/random/100")
        .then((x) => x.text())
        .then((valasz) => {
            console.log(valasz);
        });
}
function randomTolIg() {
    fetch("index.php/random/100/150")
        .then((x) => x.text())
        .then((valasz) => {
            console.log(valasz);
        });
}
function randomLepes() {
    fetch("index.php/random/100/150/2")
        .then((x) => x.text())
        .then((valasz) => {
            console.log(valasz);
        });
}
function lorem() {
    fetch("index.php/lorem/4")
        .then((x) => x.text())
        .then((valasz) => {
            console.log(valasz);
        });
}
