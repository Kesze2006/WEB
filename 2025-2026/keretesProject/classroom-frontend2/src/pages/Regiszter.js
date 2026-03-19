import "bootstrap/dist/css/bootstrap.min.css";
import "../css/regiszter.css";

export default function Regiszter() {
    return (
        <>
            <title>Tanterem – Bejelentkezés</title>
            <button id="backBtn" className="btn btn-outline-light back-btn">
                ← Vissza
            </button>
            <div className="background" />
            <div className="overlay" />
            <div className="container-fluid">
                <div className="row role-row">
                    <div id="tanar" className="col-12 col-lg-6 role kijeloles">
                        <span>Tanár</span>
                    </div>
                    <div id="diak" className="col-12 col-lg-6 role kijeloles">
                        <span>Diák</span>
                    </div>
                </div>
            </div>
            {/* LOGIN */}
            <div id="loginBox" className="login-box text-light p-4">
                <h4 className="text-center mb-3">Profil létrehozás</h4>
                <input className="form-control mb-2" placeholder="Felhasználónév" id="username" />
                <input className="form-control mb-2" type="password" placeholder="Jelszó" id="password" />
                <input className="form-control mb-3" type="email" placeholder="Email" id="email" />
                <button className="btn btn-outline-light w-100">Regisztráció</button>
            </div>
        </>
    );
}
