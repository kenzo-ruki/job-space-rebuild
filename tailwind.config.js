const defaultTheme = require('tailwindcss/defaultTheme')

module.exports = {
    theme: {
        extend: {
            borderRadius: {
              'xl': '0.75rem',
              '2xl': '1rem',
              '4xl': '2rem',
              '5xl': '3rem',
              '6xl': '4rem',
            },
            colors:{
                'main-red': '#ed186a',
                'main-blue': '#5548cd',
                'cerise-red': {
                    '50': '#fef1f7',
                    '100': '#fee5f2',
                    '200': '#ffcbe6',
                    '300': '#ffa0cf',
                    '400': '#ff65ae',
                    '500': '#fc388d',
                    '600': '#ed186a',
                    '700': '#ce084e',
                    '800': '#aa0a40',
                    '900': '#8e0d39',
                    '950': '#57001e',
                },
                'blue-violet': {
                    '50': '#eef2ff',
                    '100': '#e0e6ff',
                    '200': '#c7d1fe',
                    '300': '#a6b2fb',
                    '400': '#828af7',
                    '500': '#6464f0',
                    '600': '#5447e4',
                    '700': '#5548cd',
                    '800': '#3b31a2',
                    '900': '#342f80',
                    '950': '#1f1b4b',
                },                
            },
            fontFamily: {
                'avant-garde': ['ITC Avant Garde Std Md'],
                'avant-garde-demi': ['ITC Avant Garde Std Bk'],
                sans: [...defaultTheme.fontFamily.sans],
            },
        },
    },
    variants: {
        extend: {
            backgroundColor: ['active', 'visited'],
            margin: ['responsive', 'print'],
            padding: ['responsive', 'print'],
        }
    },
    content: [
        './app/**/*.php',
        './resources/**/*.html',
        './resources/**/*.js',
        './resources/**/*.jsx',
        './resources/**/*.ts',
        './resources/**/*.tsx',
        './resources/**/*.php',
        './resources/**/*.vue',
        './resources/**/*.twig',
        'node_modules/preline/dist/*.js',
    ],
    plugins: [
        require('@tailwindcss/forms'),
        require('@tailwindcss/typography'),
        require('preline/plugin'),
    ],
}
