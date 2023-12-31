/** @type {import('tailwindcss').Config} */
export default {
  
  /*
    safelist: [
        {
            pattern: /./, // the "." means "everything"
        },

      ],
      */

    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./Modules/**/*.blade.php",
        "./app/Components/**/*.blade.php",
        "./app/**/*.php",
        "./Modules/**/*.php"
    ],
  theme: {
    extend: {},
  },
  plugins: [],
}

