/** @type {import('tailwindcss').Config} */
export default {
  darkMode: 'class',
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
  ],
  theme: {
    extend: {
      fontFamily: {
        sans: ['Inter', 'sans-serif'],
      },
      colors: {
        bg: '#0b1220',
        surface: '#0f172a',
        'surface-2': '#111827',
        card: '#0b1220',
        text: '#e5e7eb',
        muted: '#9ca3af',
        'light-text': '#a1a1aa',
        accent: '#34d399',
        primary: {
          DEFAULT: '#2fa4e7',
          '700': '#1d8ccd',
          '900': '#16679a',
        },
        danger: '#dc3545',
        border: 'rgba(148, 163, 184, 0.2)',
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