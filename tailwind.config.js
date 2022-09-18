/** @type {import('tailwindcss').Config} */
// const defaultTheme = require('tailwindcss/defaultTheme')
const colors = require('tailwindcss/colors');

module.exports = {
    darkMode: 'class',
    content: [
        "./resources/views/app/**/*.blade.php",
        "./resources/js/app/**/*.js",
        "./resources/js/app/**/*.vue",
    ],
    theme: {
        extend: {
            colors: {
                primary: colors.slate,
                'secondary': colors.slate[300],
                'secondary-dark': colors.slate[800],
            },
            screens: {
                'content': '976px'
            }
        },
    },
    plugins: [
        require('@tailwindcss/forms'),
    ],
}
