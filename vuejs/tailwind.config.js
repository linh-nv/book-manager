/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./index.html",
    "./src/**/*.{vue,js,ts,jsx,tsx}",
  ],
  theme: {
    extend: {
      colors: {
        primary: '#FF4500C7',
        secondary: '#F5F5F5',
        text_white: '#FAFAFA',
      },
    },
  },
  plugins: [],
}

