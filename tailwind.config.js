module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    './src/**/*.{html,js}',
    './node_modules/tw-elements/dist/js/**/*.js'
  ],
  theme: {
    extend: {
      colors: {
        'primary': '#136094',
        'primary-hover': '#004f7b',
        'secondary': '#093569',
        'success': '#00B828',
        'success-hover': '#008F1F',
        'danger': '#F7483B',
        'danger-hover': '#F52314',
        'warning': '#F7B32B',
        'warning-hover': '#ECA009',
        'info': '#0081c7',
        'info-hover': '#006AA3',
        'menu-child-background': '#006AA3',
      },
      fontFamily: {
        sans: ['helvetica'],
      },
    },
  },
  plugins: [
    require('tw-elements/dist/plugin')
  ],
}
