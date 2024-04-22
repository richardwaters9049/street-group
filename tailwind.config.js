import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            backgroundColor: {
                primaryBlue: '#2147f4',
                darkGrey: 'rgb(31 41 55)'
            },
            animationDelay: {
                2000: '2000ms',
            },
            animationDuration: {
                2000: '2000ms',
            },
            animationIteration: {
                10: '10',
            },
            animationTiming: {
                cubic: 'cubic-bezier(0, 0, 0.2, 1)',
            },
        },
    },

    plugins: [
        require('tailwindcss-animation'),
        forms,
    ],

};
