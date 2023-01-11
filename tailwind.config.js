const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        container: {
            center: true,
            padding: {
                DEFAULT: '0',
                sm: '2rem',
            }
        },
        extend: {
            fontFamily: {
                sans: ['Titillium Web', ...defaultTheme.fontFamily.sans],
                serif: ['Georgia', ...defaultTheme.fontFamily.serif]
            },
            colors: {
                logo: '#9d9d9c',
                darkblue: '#08274D'
            }
        },
    },

    plugins: [require('@tailwindcss/line-clamp'), require('@tailwindcss/forms'), require('@tailwindcss/typography'), require('tailwind-scrollbar'),],
};
