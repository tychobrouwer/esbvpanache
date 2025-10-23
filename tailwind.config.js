import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './app/Http/Controllers/**/*.php',
    ],

    theme: {
        extend: {
            colors: {
                panache: {
                    50: 'oklch(94.411% 0.04611 75.646)',
                    100: 'oklch(92.424% 0.06384 76.083)',
                    200: 'oklch(88.389% 0.09856 75.343)',
                    300: 'oklch(84.598% 0.1297 73.794)',
                    400: 'oklch(81.1% 0.15394 70.715)',
                    500: 'oklch(77.741% 0.17044 65.197)',
                    600: 'oklch(71.66% 0.16428 62.428)',
                    700: 'oklch(58.55% 0.13352 63.028)',
                    800: 'oklch(44.847% 0.10052 65.12)',
                    900: 'oklch(29.776% 0.06511 68.541)',
                    950: 'oklch(21.641% 0.04577 74.445)',
                },
            },
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms],
};
