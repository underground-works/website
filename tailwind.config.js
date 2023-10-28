/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/assets/scripts/**/*.js",
    "./resources/views/**/*.twig"
  ],
  theme: {
    extend: {},
  },
  plugins: [
    require('@tailwindcss/typography')
  ],
}

