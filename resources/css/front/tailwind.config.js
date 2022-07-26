const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
  content: [
    // './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
    // './storage/framework/views/*.php',
    './resources/views/front/**/*.blade.php',
    // './resources/js/**/*.vue',
    // './node_modules/tw-elements/dist/js/**/*.js',
  ],

  theme: {
    extend: {
      fontFamily: {
        sans: ['Nunito', ...defaultTheme.fontFamily.sans],
      },
    },
  },
};
