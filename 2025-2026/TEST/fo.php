<!doctype html>
<html lang="hu">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Tanterem – Főoldal</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="foOldal.css" />
    </head>

    <body>
        <div class="background"></div>
        <!-- Navbar -->
         
        <nav class="navbar px-3">
            <?php include_once __DIR__ . "/navbar.html"; ?>
        </nav>

        <!-- Sidebar -->
        <div id="sidebar">
            <hr />
            <a href="foOldal.html"><span>🏠︎</span><span class="sidebarSzoveg">Főoldal</span></a>

            <div data-role="tanar">
                <hr />
                <a href="#" onclick="loadTananyag('kurzusLetrehozas.html')"
                    ><span>✙</span><span class="sidebarSzoveg">Kurzus létrehozás</span></a
                >
            </div>

            <div data-role="diak">
                <hr />
                <a href="#" onclick="loadTananyag('kurzushozValoCsatlakozas.html')"
                    ><span>➢</span><span class="sidebarSzoveg">Csatlakozás kurzushoz</span></a
                >
            </div>

            <div data-role="diak">
                <hr />
                <a href="#"><span>🕮</span><span class="sidebarSzoveg">Tananyag</span></a>
            </div>
            <hr />

            <a href="#"><span>🗐</span><span class="sidebarSzoveg">Feladatok</span></a>

            <hr />
            <a href="#"><span>✉︎</span><span class="sidebarSzoveg">Üzenetek</span></a>
            <hr />

            <div class="mt-auto text-center">
                <hr />
                <div class="p-1">
                    <label class="switch">
                        <input id="themeToggle" type="checkbox" class="circle" />
                        <svg viewBox="0 0 384 512" class="moon svg">
                            <path
                                d="M223.5 32C100 32 0 132.3 0 256S100 480 223.5 480c60.6 0 115.5-24.2 155.8-63.4c5-4.9 6.3-12.5 3.1-18.7s-10.1-9.7-17-8.5c-9.8 1.7-19.8 2.6-30.1 2.6c-96.9 0-175.5-78.8-175.5-176c0-65.8 36-123.1 89.3-153.3c6.1-3.5 9.2-10.5 7.7-17.3s-7.3-11.9-14.3-12.5c-6.3-.5-12.6-.8-19-.8z"
                            />
                        </svg>
                        <div class="sun svg">
                            <span class="dot"></span>
                        </div>
                    </label>
                </div>
            </div>
        </div>

        <!-- Content 
        <div id="content">
            <div class="tartalmiResz p-4" id="contentInner">
                <div class="row g-4">
                    <div
                        style="text-decoration: none"
                        data-role="diak"
                        class="col-12 col-sm-6 col-lg-3"
                        onclick="loadTananyag('bevezetes.html')"
                    >
                        <div class="card h-100 shadow content-card" data-page="tananyag">
                            <div class="card-body">
                                <h5 class="card-title d-flex align-items-center justify-content-between">
                                    Programozás 13.C
                                    <img src="kepek/profilkKep.jpg" class="avatar d-flex" />
                                </h5>

                                <hr />
                                <p class="card-text">Dr. Deszka Dávid</p>
                            </div>
                        </div>
                    </div>

                    <div
                        style="text-decoration: none"
                        data-role="diak"
                        class="col-12 col-sm-6 col-lg-3"
                        onclick="loadTananyag('bevezetes.html')"
                    >
                        <div class="card h-100 shadow content-card" data-page="tananyag">
                            <div class="card-body">
                                <h5 class="card-title d-flex align-items-center justify-content-between">
                                    Programozás 13.C
                                    <img src="kepek/profilKep.jpg" class="avatar d-flex" />
                                </h5>

                                <hr />
                                <p class="card-text">Dr. Deszka Dávid</p>
                            </div>
                        </div>
                    </div>

                    <div
                        data-role="tanar"
                        class="col-12 col-sm-6 col-lg-3 tananyagHozzaadasGomb"
                        onclick="loadTananyag('kurzusLetrehozas.html')"
                    >
                        <div class="card h-100 shadow content-card" data-page="tananyag">
                            <div class="card-body">
                                <h5 class="card-title">Kurzus létrehozása</h5>
                                <hr />
                                <p class="card-text text-center">+</p>
                            </div>
                        </div>
                    </div>
                    
                    -->
        <!-- további kártyák változatlanul 
                </div>
            </div>
        </div>
        -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="foOldal.js"></script>
    </body>
</html>
