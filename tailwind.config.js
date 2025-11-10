/** @type {import('tailwindcss').Config} */
export default {
  content: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.vue',
    './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
  ],
  theme: {
    extend: {
      colors: {
        'prothomalo-red': 'var(--color-danger)',
        'prothomalo-dark-gray': 'var(--color-text)',
        'prothomalo-muted': 'var(--color-muted)',
        'prothomalo-light-text': 'var(--color-muted)',
        'prothomalo-border': 'var(--color-border)',
        'primary': 'var(--color-primary)',
        'primary-hover': 'var(--color-primary-hover)',
        'surface': 'var(--color-surface)',
        'text': 'var(--color-text)',
        'muted': 'var(--color-muted)',
        'border': 'var(--color-border)',
        'danger': 'var(--color-danger)',
      },
      fontFamily: {
        sans: ['Inter', 'ui-sans-serif', 'system-ui', 'sans-serif'],
        serif: ['Cormorant', 'Georgia', 'serif'],
      },
    },
  },
  plugins: [],
};