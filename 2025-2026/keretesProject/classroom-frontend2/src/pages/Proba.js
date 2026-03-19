import { useState } from "react";

export default function Proba() {
    const [name, setName] = useState("");
    const [email, setEmail] = useState("");
    const [password, setPassword] = useState("");
    const [role, setRole] = useState("");
    const [message, setMessage] = useState("");

    const handleSubmit = async (e) => {
        e.preventDefault(); // ne töltse újra az oldalt

        try {
            const res = await fetch("http://localhost:8000/api/register", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({ name, email, password, role }),
            });

            const data = await res.json();

            if (data.user) {
                console.log(data);
                setMessage("Sikeres regisztráció!");
            } else {
                setMessage(data.error || "Hiba történt!");
            }
        } catch (err) {
            console.error(err);
            setMessage("Hálózati hiba!");
        }
    };

    return (
        <div>
            <h1>Az oldal neve</h1>
            <form onSubmit={handleSubmit}>
                <input type="text" placeholder="Név" value={name} onChange={(e) => setName(e.target.value)} required />
                <input
                    type="email"
                    placeholder="Email"
                    value={email}
                    onChange={(e) => setEmail(e.target.value)}
                    required
                />
                <input
                    type="password"
                    placeholder="Jelszó"
                    value={password}
                    onChange={(e) => setPassword(e.target.value)}
                    required
                />
                <select value={role} onChange={(e) => setRole(e.target.value)} required>
                    <option value="">Válassz szerepet</option>
                    <option value="diak">Diák</option>
                    <option value="tanar">Tanár</option>
                </select>
                <button type="submit">Regisztráció</button>
            </form>

            {message && <p>{message}</p>}
        </div>
    );
}
