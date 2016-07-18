module.exports = function (grunt) {

    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),

        /**
         * Sass
         **/
        sass: {
            dist: {
                options: {
                    style: 'expanded',
                    sourcemap: 'file'
                },
                files: {
                    'style.css': 'sass/style.scss',
                    'layouts/single-sidebar.css' : 'sass/layout/_single-sidebar.scss',
                    'layouts/no-sidebar.css' : 'sass/layout/_no-sidebar.scss'
                }
            }
        },

        autoprefixer: {
            options: {
                browsers: ['last 3 versions']
            },
            multiple_files: {
                expand: true,
                flatten: true,
                src: '*.css',
                dest: ''
            }
        },

        rtlcss: {
            myTask: {
                options: {
                    // rtlcss options
                    opts: {
                        clean: false,
                    },
                    // rtlcss plugins
                    plugins: [],
                },
                dest: 'rtl.css',
                src: 'style.css'
            }
        },

        /**
         * Watch
         **/
        watch: {
            css: {
                files: '**/*.scss',
                tasks: ['sass', 'autoprefixer', 'rtlcss']
            }
        }
    });

    grunt.loadNpmTasks('grunt-contrib-sass');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-autoprefixer');
    grunt.loadNpmTasks('grunt-rtlcss');
    grunt.registerTask('default', ['watch']);

};
