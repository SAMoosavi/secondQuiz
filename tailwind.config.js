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
                    primary: "#6EE964",
                    "primary-focus": "#32b526",
                    "primary-content": "#ffffff",

                    secondary: "#6EE964",
                    "secondary-focus": "#32b526",
                    "secondary-content": "#000000",

                    accent: "#1c92f2",
                    "accent-focus": "#5bb3fb",
                    "accent-content": "#ffffff",

                    neutral: "#e3e3e3",
                    "neutral-focus": "#e6e6e6",
                    "neutral-content": "#000000",

                    "base-100": "#ffffff",
                    "base-200": "#BFBFBF",
                    "base-300": "#D9D9D9",
                    "base-content": "#000000",

                    info: "#33a3ff",
                    success: "#80F158",
                    warning: "#FFEF63",
                    error: "#FC4532",

                    "--rounded-box": "0rem",
                    "--rounded-btn": "0rem",
                    "--rounded-badge": "2rem",

                    "--animation-btn": "0.25s",
                    "--animation-input": "0.2s",

                    "--btn-text-case": "",
                    "--navbar-padding": "0.5rem",
                    "--border-btn": "1px",
                },
                dark: {
                    primary: "#31DB22",
                    "primary-focus": "#66fd58",
                    "primary-content": "#000000",

                    secondary: "#31DB22",
                    "secondary-focus": "#66fd58",
                    "secondary-content": "#fff",

                    accent: "#1c92f2",
                    "accent-focus": "#5bb3fb",
                    "accent-content": "#ffffff",

                    neutral: "#999",
                    "neutral-focus": "#bbb",
                    "neutral-content": "#ffffff",

                    "base-100": "#000000",
                    "base-200": "#111111",
                    "base-300": "#333333",
                    "base-content": "#ffffff",

                    info: "#1c92f2",
                    success: "#80F158",
                    warning: "#FFEF63",
                    error: "#FC4532",

                    "--rounded-box": "0rem",
                    "--rounded-btn": "0rem",
                    "--rounded-badge": "2rem",

                    "--animation-btn": "0.25s",
                    "--animation-input": "0.2s",

                    "--btn-text-case": "",
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
