import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
    ],

    theme: {
        extend: {
            colors: {
                footblack: "#051e33",
            },
            keyframes: {
                marquee: {
                    "0%": { transform: "translateX(100%)" },
                    "100%": { transform: "translateX(-100%)" },
                },
                spin: {
                    "0%": { transform: "rotateY(0deg)" },
                    "100%": { transform: "rotateY(360deg)" },
                },
                spinXY: {
                    "0%": { transform: "rotateX(0deg) rotateY(0deg)" },
                    "100%": { transform: "rotateX(360deg) rotateY(360deg)" },
                },
            },
            animation: {
                marquee: "marquee 30s linear infinite",
                spin: "spin 4s linear infinite",
                spinXY: "spinXY 3s linear infinite",
            },

            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
            },
            backgroundImage: {
                "my-gradient":
                    "linear-gradient(102deg, rgba(3, 5, 29, 0.85) 2.11%, rgba(255, 0, 0, 0.85) 100%)",
                "my-gradient-10":
                    "linear-gradient(119deg, #c39eff 3.38%, #3c78eb 103.77%)",
                "my-gradient-20":
                    "linear-gradient(113.92deg, rgb(81, 91, 112) 5.63%, rgb(36, 32, 63) 136.53%)",
                hero1: "assets('/build/assets/hero1.jpg')",
            },
        },
    },

    plugins: [forms],
};
