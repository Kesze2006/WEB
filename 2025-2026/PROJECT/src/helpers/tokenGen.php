<?php function tokenGen($hossz = 32)
{
    return bin2hex(random_bytes($hossz));
}
?>
