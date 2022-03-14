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
                    primary: "#179644",
                    "primary-focus": "#1ee664",
                    "primary-content": "#ffffff",

                    secondary: "#8d18c3",
                    "secondary-focus": "#c357f4",
                    "secondary-content": "#ffffff",

                    accent: "#d99330",
                    "accent-focus": "#b57721",
                    "accent-content": "#ffffff",

                    neutral: "#b0b0b0",
                    "neutral-focus": "#e8e8e8",
                    "neutral-content": "#000",

                    "base-100": "#171212",
                    "base-200": "#110e0e",
                    "base-300": "#060404",
                    "base-content": "#ffffff",

                    info: "#05a3ff",
                    success: "#84ff00",
                    warning: "#f9e001",
                    error: "#fc0303",

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
