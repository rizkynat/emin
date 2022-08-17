/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      fontFamily: {
        'podkova': ['Podkova', 'serif'],
      }
    },
    colors:{
      'primary': {
        'normal':'#9AAB89',
        'hover':'#B5C7A3',
        'font':'#707275',
        'white':'#FFFFFF',
        'opacity':'#D5D6D7',
        transparent: 'transparent'
      },
    },
    fontSize: {
      'small':'0.50rem',
      'middle':'0.75rem'
    },
    boxShadow: {
      outline: '0 0 0 3px rgba(154, 171, 137, 1)',
    }
  },
  plugins: [],
}
