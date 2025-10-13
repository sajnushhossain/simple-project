/** @type {import('tailwindcss').Config} */
export default {
  darkMode: 'class',
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
    "./resources/views/vendor/pagination/**/*.blade.php",
  ],
  theme: {
    extend: {
      fontFamily: {
        sans: ['Inter', 'sans-serif'],
      },
      colors: {
        bg: '#ffffff',
        surface: '#f8fafc',
        'surface-2': '#f1f5f9',
        card: '#ffffff',
        text: '#0f172a',
        muted: '#64748b',
        'light-text': '#94a3b8',
        accent: '#38bdf8',
        primary: {
          DEFAULT: '#0ea5e9',
          '700': '#0284c7',
          '900': '#075985',
        },
        danger: '#ef4444',
        border: 'rgba(14, 165, 233, 0.2)',
      },
      borderRadius: {
        DEFAULT: '12px',
      },
      boxShadow: {
        DEFAULT: '0 10px 30px rgba(2, 6, 23, 0.35)',
      },
      animation: {
        ticker: 'ticker 40s linear infinite',
      },
      keyframes: {
        ticker: {
          '0%': { transform: 'translateX(100%)' },
          '100%': { transform: 'translateX(-100%)' },
        }
      }
    },
  },
  plugins: [],
}