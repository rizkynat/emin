/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    "./resources/views/vendor/pagination/*.blade.php",
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
        'gra':'#707275',
        'white':'#FFFFFF',
        'opacity':'#D5D6D7',
        'overview':'#3F83F8',
        'insert':'#FF5A1F',
        'warning':'#FE3E41',
        'success':'#3EC47A',
        'kuning':'#FDB21D',
        'pink':'#D61F69',
        'purple':'#7E3AF2',
        transparent: 'transparent'
      },
    },
    fontSize: {
      'small':'0.50rem',
      '06rem':'0.60rem',
      'middle':'0.75rem'
    },
    boxShadow: {
      outline: '0 0 0 3px rgba(154, 171, 137, 1)',
    }
  },
  plugins: [
    require('@tailwindcss/line-clamp'),
  ],
}
