module.exports = {
    purge: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    darkMode: false, // or 'media' or 'class'
    theme: {
        extend: {
            spacing: {
                '68': '17rem',
            }
        },
    },
    variants: {
        extend: {},
    },
    plugins: [],
}
