const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
  content: [
    './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
    './storage/framework/views/*.php',
    './resources/views/**/*.blade.php',
    './resources/js/**/*.vue',
    './node_modules/tw-elements/dist/js/**/*.js',
  ],

  theme: {
    extend: {
      fontFamily: {
        sans: ['Nunito', ...defaultTheme.fontFamily.sans],
      },

      keyframes: {
        progress: {
          '0%': { width: '0%', marginLeft: '0%' },
          '20%': { marginLeft: '0%' },
          '100%': { width: '50%', marginLeft: '100%' },
        }
      },

      animation: {
        progress: 'progress 1s ease-in-out infinite',
      },
    },
  },

  plugins: [
    require('@tailwindcss/forms'),
    require('tw-elements/dist/plugin'),
  ],
};
