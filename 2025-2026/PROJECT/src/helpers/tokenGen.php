<?php
function tokenGen($hossz)
{
    return bin2hex(random_bytes($hossz["token_hossz"]));
}
?>
