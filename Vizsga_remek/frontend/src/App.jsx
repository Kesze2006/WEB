import { BrowserRouter as Router, Routes, Route } from "react-router-dom";
import Teszt from "./pages/Teszt";

function App() {

  return (
    <Router>
            <Routes>
                <Route path="/" element={<Teszt />} />
            </Routes>
        </Router>
  )
}

export default App