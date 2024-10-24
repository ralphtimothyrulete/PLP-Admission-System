/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      fontFamily: {
      'nunito': ['Nunito', 'sans-serif'],
      'poppins': ['Poppins', 'sans-serif']
      },
      colors:{
        'light-green': '#C1E899',
        'base-green': '#96C06A',
        'dark-green': '#659633',
      },
    },
  },
  plugins: [require('daisyui')],
}
