import { BrowserRouter as Router, Routes, Route } from "react-router-dom";
import "./App.css";
import Kezdo from "./pages/Kezdo";
import Regiszter from "./pages/Regiszter";
import Proba from "./pages/Proba";

function App() {
    return (
        <Router>
            <Routes>
                <Route path="/" element={<Kezdo />} />
                <Route path="/register" element={<Regiszter />} />
                <Route path="/proba" element={<Proba />} />
            </Routes>
        </Router>
    );
}

export default App;
