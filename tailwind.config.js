const defaultTheme = require("tailwindcss/defaultTheme");

module.exports = {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./vendor/laravel/jetstream/**/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./resources/js/**/*.vue",
    ],
    daisyui: {
        themes: [
            {
                light: {
                    primary: "#1fb10b",
                    "primary-focus": "#198a0a",
                    "primary-content": "#ffffff",

                    secondary: "#8146b9",
                    "secondary-focus": "#552d7b",
                    "secondary-content": "#ffffff",

                    accent: "#eeaf3a",
                    "accent-focus": "#e09915",
                    "accent-content": "#ffffff",

                    neutral: "#261230",
                    "neutral-focus": "#200f29",
                    "neutral-content": "#ffffff",

                    "base-100": "#faf7f5",
                    "base-200": "#efeae6",
                    "base-300": "#e7e2df",
                    "base-content": "#261230",

                    info: "#1c8bf2",
                    success: "#00940a",
                    warning: "#eeff00",
                    error: "#ff2424",

                    "--rounded-box": "1rem",
                    "--rounded-btn": "0.4rem",
                    "--rounded-badge": "2rem",

                    "--animation-btn": "0.3s",
                    "--animation-input": "0.3s",

                    "--btn-text-case": "uppercase",
                    "--navbar-padding": "0.5rem",
                    "--border-btn": "1px",
                },
                dark: {
                    primary: "#4fa300",
                    "primary-focus": "#367000",
                    "primary-content": "#ffffff",

                    secondary: "#6d3b9b",
                    "secondary-focus": "#532c77",
                    "secondary-content": "#ffffff",

                    accent: "#f28c18",
                    "accent-focus": "#c9710d",
                    "accent-content": "#131616",

                    neutral: "#1b1d1d",
                    "neutral-focus": "#131616",
                    "neutral-content": "#e6e6e6",

                    "base-100": "#1f1f1f",
                    "base-200": "#1b1d1d",
                    "base-300": "#131616",
                    "base-content": "#c2c2c2",

                    info: "#66c7ff",
                    success: "#84ff00",
                    warning: "#ffc800",
                    error: "#f90606",

                    "--rounded-box": "1rem",
                    "--rounded-btn": "0.4rem",
                    "--rounded-badge": "2rem",

                    "--animation-btn": "0.3s",
                    "--animation-input": "0.3s",

                    "--btn-text-case": "uppercase",
                    "--navbar-padding": "0.5rem",
                    "--border-btn": "1px",
                },
            },
        ],
    },
    theme: {
        extend: {
            fontFamily: {
                sans: ["Nunito", ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [
        require("@tailwindcss/forms"),
        require("@tailwindcss/typography"),
        require("daisyui"),
    ],
};
