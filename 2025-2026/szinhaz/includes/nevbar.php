<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <?php foreach ($navbar as $elem) {
                    echo "<li class=\"nav-item\">
                        <a class=\"nav-link\" href=\"$elem[url]\">$elem[text]</a>
                        </li>";
                } ?>
            </ul>
        </div>
    </div>
</nav>
