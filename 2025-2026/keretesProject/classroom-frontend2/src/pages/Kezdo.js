import "bootstrap/dist/css/bootstrap.min.css";
import "../css/kezdoLap.css";

export default function KezdoLap() {
    return (
        <div>
            <div className="background"></div>
            {/* NAVBAR */}
            <nav className="navbar navbar-expand-md fejlec navbar-dark py-4 fixed-top">
                <div className="container-fluid d-flex justify-content-between align-items-center">
                    <div>
                        <button
                            className="navbar-toggler d-md-none"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#mobileMenu"
                        >
                            <span className="navbar-toggler-icon"></span>
                        </button>

                        <div className="d-none d-md-flex">
                            <a href="#stats" className="nav-link quickLinks">
                                Statisztikák
                            </a>
                            <a href="#footer" className="nav-link quickLinks">
                                Elérhetőségek
                            </a>
                        </div>
                    </div>

                    <a className="navbar-brand position-absolute start-50 translate-middle-x">Tanterem</a>

                    <a href="#section1" className="btn btn-outline-light">
                        Belépés
                    </a>
                </div>

                <div className="collapse navbar-collapse d-md-none" id="mobileMenu">
                    <div className="d-flex flex-column p-2">
                        <a href="#stats" className="nav-link quickLinks">
                            Statisztikák
                        </a>
                        <a href="#footer" className="nav-link quickLinks">
                            Elérhetőségek
                        </a>
                    </div>
                </div>
            </nav>

            <main className="container-fluid mt-5 pt-5">
                {/* HERO */}
                <section className="text-center text-white">
                    <div className="container tartalom1 py-5">
                        <h1 className="display-4 fw-bold">Digitális Tanterem</h1>
                        <p className="lead mt-3">Modern oktatási platform tanároknak és diákoknak.</p>
                        <hr />
                    </div>
                </section>

                {/* FUNKCIÓK */}
                <section className="container my-5 text-center">
                    <h2 className="mb-4">Fő funkciók</h2>

                    <div className="row">
                        <div className="col-md-4 mb-4">
                            <div className="card h-100 shadow">
                                <div className="card-body">
                                    <h5>📚 Online tananyag</h5>
                                    <p>Digitális jegyzetek, videók egy helyen.</p>
                                </div>
                            </div>
                        </div>

                        <div className="col-md-4 mb-4">
                            <div className="card h-100 shadow">
                                <div className="card-body">
                                    <h5>📝 Feladatkezelés</h5>
                                    <p>Házi feladatok és határidők kezelése.</p>
                                </div>
                            </div>
                        </div>

                        <div className="col-md-4 mb-4">
                            <div className="card h-100 shadow">
                                <div className="card-body">
                                    <h5>💬 Kommunikáció</h5>
                                    <p>Chat és értesítések.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                {/* LOGIN */}
                <section className="container my-5">
                    <div className="row align-items-center">
                        <div className="col-md-6 mb-3">
                            <img src="/images/logo.png" className="img-fluid rounded shadow" alt="Oktatás" />
                        </div>

                        <div className="col-md-6 card shadow p-3" id="section1">
                            <h3 className="text-center mb-4">Bejelentkezés</h3>
                            <hr />

                            <input type="email" className="form-control mb-3" placeholder="Email" />

                            <input type="password" className="form-control mb-3" placeholder="Jelszó" />

                            <button className="btn btn-outline-dark w-100">Belépés</button>
                        </div>
                    </div>
                </section>
            </main>

            {/* STAT */}
            <section className="bg-light py-3 text-center" id="stats">
                <div className="container">
                    <div className="row">
                        <div className="col-md-4">
                            <h2></h2>
                            <p>Tanárok száma</p>
                        </div>

                        <div className="col-md-4">
                            <h2></h2>
                            <p>Diákok száma</p>
                        </div>

                        <div className="col-md-4">
                            <h2>0-24</h2>
                            <p>Elérhetőség</p>
                        </div>
                    </div>
                </div>
            </section>

            {/* FOOTER */}
            <footer className="bg-dark text-light py-3" id="footer">
                <div className="container text-center">
                    <p>© 2026 Tanterem</p>
                </div>
            </footer>
        </div>
    );
}
