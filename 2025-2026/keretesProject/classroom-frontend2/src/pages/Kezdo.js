import { useEffect, useState } from "react";
import "bootstrap/dist/css/bootstrap.min.css";

function Home() {
    const [teacherNumber, setTeacherNumber] = useState(0);
    const [studentNumber, setStudentNumber] = useState(0);

    // onload helyett
    useEffect(() => {
        leKer();
    }, []);

    const leKer = () => {
        // ide jön majd az API (Laravel)
        setTeacherNumber(12);
        setStudentNumber(120);
    };

    const login = () => {
        const email = document.getElementById("email").value;
        const password = document.getElementById("password").value;

        console.log(email, password);

        // később:
        // fetch("http://localhost:8000/api/login", ...)
    };

    return (
        <div>
            {/* NAVBAR */}
            <nav className="navbar navbar-dark bg-dark p-3">
                <span className="navbar-brand mx-auto">Tanterem</span>
            </nav>

            {/* HERO */}
            <section className="text-center text-white bg-dark py-5">
                <h1>Digitális Tanterem</h1>
                <p>Modern oktatási platform tanároknak és diákoknak.</p>
            </section>

            {/* FUNKCIÓK */}
            <section className="container my-5 text-center">
                <h2>Fő funkciók</h2>

                <div className="row mt-4">
                    <div className="col-md-4">
                        <div className="card p-3">
                            <h5>📚 Online tananyag</h5>
                        </div>
                    </div>

                    <div className="col-md-4">
                        <div className="card p-3">
                            <h5>📝 Feladatkezelés</h5>
                        </div>
                    </div>

                    <div className="col-md-4">
                        <div className="card p-3">
                            <h5>💬 Kommunikáció</h5>
                        </div>
                    </div>
                </div>
            </section>

            {/* LOGIN */}
            <section className="container my-5">
                <div className="card p-4">
                    <h3 className="text-center">Bejelentkezés</h3>

                    <input type="email" placeholder="Email" className="form-control my-2" id="email" />

                    <input type="password" placeholder="Jelszó" className="form-control my-2" id="password" />

                    <button className="btn btn-dark w-100" onClick={login}>
                        Belépés
                    </button>
                </div>
            </section>

            {/* STATS */}
            <section className="bg-light py-4 text-center">
                <h2>Tanárok: {teacherNumber}</h2>
                <h2>Diákok: {studentNumber}</h2>
            </section>

            {/* FOOTER */}
            <footer className="bg-dark text-white text-center p-3">© 2026 Tanterem</footer>
        </div>
    );
}

export default Home;
