import { useState } from "react";

export default function Teszt() {
    const [open, setOpen] = useState(false);

    return (
        <nav className="fixed top-0 w-full bg-gray-900 text-white py-4 z-50">
            <div className="flex items-center justify-between px-4 relative">
                
                {/* Bal oldal */}
                <div className="flex items-center">
                    
                    {/* Hamburger */}
                    <button
                        className="md:hidden text-2xl"
                        onClick={() => setOpen(!open)}
                    >
                        ☰
                    </button>

                    {/* Desktop menu */}
                    <div className="hidden md:flex gap-6 ml-4">
                        <a href="#stats" className="hover:text-gray-300">
                            Statisztikák
                        </a>
                        <a href="#footer" className="hover:text-gray-300">
                            Elérhetőségek
                        </a>
                    </div>
                </div>

                {/* Közép logo */}
                <div className="absolute left-1/2 transform -translate-x-1/2 font-bold text-lg">
                    Tanterem
                </div>

                {/* Jobb oldal */}
                <a
                    href="#section1"
                    className="border border-white px-4 py-2 rounded hover:bg-white hover:text-black transition"
                >
                    Belépés
                </a>
            </div>

            {/* Mobile menu */}
            {open && (
                <div className="md:hidden flex flex-col px-4 mt-4 space-y-2">
                    <a href="#stats" className="hover:text-gray-300">
                        Statisztikák
                    </a>
                    <a href="#footer" className="hover:text-gray-300">
                        Elérhetőségek
                    </a>
                </div>
            )}
        </nav>
    );
}