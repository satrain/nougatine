module.exports = function (grunt) {
    // Project configuration
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),

        sass: {
            dist: {
                files: [{
                    expand: true,
                    cwd: 'src/scss',
                    src: ['theme.scss'],
                    dest: './assets/css/',
                    ext: '.css'
                }],
            },
        },

        uglify: {
            dist: {
                files: {
                    'assets/js/script.min.js': [
                        'src/js/slider.js',
                        'src/js/app.js',
                        'src/js/preloader-script.js',
                        'src/js/products-catalog.js',
                        'src/js/checkout.js',
                        'src/js/add_to_cart.js',
                        'src/js/faq.js',
                    ],
                },
            },
        },

        cssmin: {
            target: {
                files: [{
                    expand: true,
                    cwd: 'assets/css',
                    src: ['*.css', '!*.min.css'],
                    dest: 'assets/css',
                    ext: '.min.css',
                }],
            },
        },

        watch: {
            sass: {
                files: ['src/scss/**/*.scss'],
                tasks: ['sass', 'cssmin'],
            },
            js: {
                files: ['src/js/**/*.js'],
                tasks: ['uglify'],
            },
        },

    });

    // Load tasks
    grunt.loadNpmTasks('grunt-contrib-cssmin');
    grunt.loadNpmTasks('grunt-contrib-sass');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-watch');

    // Register tasks
    grunt.registerTask('default', ['sass', 'cssmin', 'uglify']);
};
