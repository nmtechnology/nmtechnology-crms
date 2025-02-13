import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
    './storage/framework/views/*.php',
    './resources/views/**/*.blade.php',
    './resources/js/**/*.vue',
  ],
  theme: {
    daisyui: {
      themes: [
        {
          mytheme: {
            "button": "#ffc104",
            "main-color": "#adff05",
            "accent": "#adff05",
            "neutral": "#fb923c",
            "base-100": "#1f2937",
            "info": "#7c3aed",
            "success": "#22c55e",
            "warning": "#f97316",
            "error": "#b91c1c",
          },
        },
      ],
    },
    fontFamily: {
      sans: ['roboto', ...defaultTheme.fontFamily.sans],
    },
  },
  plugins: [require('daisyui'), forms],
};