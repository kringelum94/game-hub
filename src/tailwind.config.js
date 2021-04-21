module.exports = {
    future: {
        removeDeprecatedGapUtilities: true,
    },
    purge: [
        './app/**/*.php',
        './resources/**/*.php'
    ],
    theme: {
        textShadow: {
            'default': '0 2px 4px rgba(0,0,0,0.10)',
            'md': '0 4px 8px rgba(0,0,0,0.12), 0 2px 4px rgba(0,0,0,0.08)'
        },
        extend: {
            spacing: {
                '66': '16.5rem',
                '76': '19rem',
                '85': '21.25rem',
                '88': '22rem'
            },
            fontFamily: {
                'display': ['Bungee', 'Impact', 'sans-serif'],
            },
        },
    },
    variants: {
        opacity: ['responsive', 'hover', 'focus', 'active', 'group-hover'],
        translate: ['responsive', 'hover', 'focus', 'active', 'group-hover'],
        transitionProperty: ['responsive', 'hover', 'focus'],
        display: ['responsive', 'hover', 'focus', 'group-hover'],
    },
    plugins: [],
}
