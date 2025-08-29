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
                'compost': {
                    50: '#f0f9f0',
                    100: '#dcf2dc',
                    200: '#bce4bc',
                    300: '#8dd08d',
                    400: '#5bb55b',
                    500: '#4CAF50',
                    600: '#2E7D32',
                    700: '#1b5e20',
                    800: '#1b5e20',
                    900: '#1b5e20',
                }
            }
        },
    },

    plugins: [forms],
};
