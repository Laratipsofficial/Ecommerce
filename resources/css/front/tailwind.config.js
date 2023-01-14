const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
  content: [
    './resources/views/front/**/*.blade.php',
  ],

  theme: {
    extend: {
      fontFamily: {
        sans: ['Nunito', ...defaultTheme.fontFamily.sans],
      },

      colors: {
        theme: '#ff291b',
      }
    },
  },
};
