import { useState, useEffect } from "react";
import "../css/regiszter.css";

export default function Register() {
    const [role, setRole] = useState(null);
    const [step, setStep] = useState(0); // animáció lépések
    const [name, setUsername] = useState("");
    const [password, setPassword] = useState("");
    const [email, setEmail] = useState("");

    // szerep kiválasztás (animáció időzítések)
    const selectRole = (selectedRole) => {
        setRole(selectedRole);
        setStep(1);

        setTimeout(() => setStep(2), 1000);
        setTimeout(() => setStep(3), 1600);
    };

    const handleBack = () => {
        setRole(null);
        setStep(0);
    };

    const handleRegister = () => {
        const minta = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if (minta.test(email)) {
            fetch("http://localhost:8000/api/register", {
                method: "POST",
                headers: { "Content-Type": "application/json", Accept: "application/json" },
                body: JSON.stringify({ name, email, password, role }),
            })
                .then((r) => r.json())
                .then((d) => console.log(d))
                .catch((err) => console.error(err));
        } else {
            alert("Hibás email!");
        }
    };

    return (
        <div className={role ? `${role}-active` : ""}>
            <button className={`btn btn-outline-light back-btn ${step >= 3 ? "show" : ""}`} onClick={handleBack}>
                ← Vissza
            </button>

            <div className={`background ${step >= 2 ? "sharp" : ""}`}></div>
            <div className="overlay"></div>

            <div className="container-fluid">
                <div className="row role-row">
                    <div
                        className={`col-12 col-lg-6 role ${
                            !role ? "kijeloles" : ""
                        } ${role === "diak" && step >= 2 ? "text-fly-up" : ""}`}
                        onClick={() => selectRole("diak")}
                    >
                        <span>Diák</span>
                    </div>

                    <div
                        className={`col-12 col-lg-6 role ${
                            !role ? "kijeloles" : ""
                        } ${role === "tanar" && step >= 2 ? "text-fly-up" : ""}`}
                        onClick={() => selectRole("tanar")}
                    >
                        <span>Tanár</span>
                    </div>
                </div>
            </div>

            {/* LOGIN BOX */}
            <div className={`login-box text-light p-4 ${step >= 3 ? "show" : ""}`}>
                <h4 className="text-center mb-3">Profil létrehozás</h4>

                <input
                    className="form-control mb-2"
                    placeholder="Felhasználónév"
                    value={name}
                    onChange={(e) => setUsername(e.target.value)}
                />

                <input
                    className="form-control mb-2"
                    type="password"
                    placeholder="Jelszó"
                    value={password}
                    onChange={(e) => setPassword(e.target.value)}
                />

                <input
                    className="form-control mb-3"
                    type="email"
                    placeholder="Email"
                    value={email}
                    onChange={(e) => setEmail(e.target.value)}
                />

                <button className="btn btn-outline-light w-100" onClick={handleRegister}>
                    Regisztráció
                </button>
            </div>
        </div>
    );
}
