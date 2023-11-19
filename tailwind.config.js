/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
        colors:{
            body: '#fffffe',
            text: '#272343',
            paragraph: '#2d334a',
            button: '#ffd803',
            //  button: '#ffa500',
            secondary: '#e3f6f5',
            tertiary: '#bae8e8'
        }
    },
  },
  plugins: [],
}

