/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./**/*.php", // All PHP files in your plugin or theme
    "./**/*.html", // HTML files (if any)
    "./**/*.js", // JS files in your project
    "./templates/**/*.php", // Template files (if any)
    "!./node_modules/**/*", // Exclude node_modules folder
  ],
  theme: {
    extend: {},
  },
  plugins: [],
};
