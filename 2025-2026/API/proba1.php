<?php
include_once "../PHP/fugvenyek.php";
if (isset($_GET["path"])) {
    $apiPars = explode("/", $_GET["path"]);
    d($apiPars);
} else {
}
?>

<button onclick="f2()">Szöveg</button>
<div id="ide">
<?php phpinfo(32); ?>
</div>

<script>
    function f2(){
        fetch("/WEB/2025-2026/API/123/456/678")
        .then(x=>x.text())
        .then(y=>{
            console.log(y);
            m(y);
        })
    }

    function m(message){
        document.getElementById("ide").innerHTML=message;
    }
</script>