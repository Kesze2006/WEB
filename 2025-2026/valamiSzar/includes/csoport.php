<?php

$tartalom = szerkezet();

function cim($cim)
{
    return "<h2>$cim</h2>";
}

function szerkezet()
{
    return '
    <div class="container">
        <div class="row">' .
        cim("Csoportok") .
        '</div>
        <div class="row">
            <div class="col-6">
            ' .
        csoportForm() .
        '
            </div>
            <div class="col-6">
            ' .
        csoportLista() .
        '
            </div>
        </div>
    </div>
    ';
}

function csoportForm()
{
    return "form";
}

function csoportLista()
{
    return "lista";
}
?>
