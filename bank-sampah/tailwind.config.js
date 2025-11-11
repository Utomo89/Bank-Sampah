import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'eco-green': {
                    50: '#f0f9f0',
                    100: '#e8f5e9',
                    200: '#c8e6c9',
                    300: '#a5d6a7',
                    400: '#81c784',
                    500: '#4caf50',
                    600: '#2e7d32',
                    700: '#1b5e20',
                    800: '#0d3c13',
                    900: '#052509',
                },
            },
        },
    },

    plugins: [forms],
};
