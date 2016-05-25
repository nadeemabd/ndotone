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
										'style.css': 'sass/style.scss'
								}
						}
				},

				autoprefixer: {
						options: {
								browsers: ['last 2 versions']
						},
						multiple_files: {
								expand: true,
								flatten: true,
								src: '*.css',
								dest: ''
						}
				},

				rtlcss: {
					myTask:{
						options: {
							// rtlcss options
							opts: {
								clean:false
							},
							// rtlcss plugins
							plugins:[],
						},
						expand : true,
						dest   : '',
						src    : 'style.css'
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
