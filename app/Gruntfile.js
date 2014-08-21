module.exports = function (grunt) {

    require("matchdep").filterDev("grunt-*").forEach(grunt.loadNpmTasks);

    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        files: {

        },
        htmlhint: {
            "dev": {
                "options": {
                    "tag-pair": true,
                    "tagname-lowercase": true,
                    "attr-lowercase": true,
                    "attr-value-double-quotes": true,
                    "spec-char-escape": true,
                    "id-unique": true,
                    "head-script-disabled": true,
                    "style-disabled": true
                },
                "src": ['<%= config.files.html %>']
            }
        },

        jshint: {
            options: {
                globals: {
                    jQuery: true,
                    angular: true
                }
            },
            dev: {
                options: {
                    curly: false,
                    undef: true,
                    reporter: 'checkstyle',
                    reporterOutput: 'jshint.xml'
                },
                files: {
                    src: ['client/app/**/*.js']
                }
            },
            dist: {
                options: {
                    curly: false,
                    undef: true,
                    reporter: 'checkstyle',
                    reporterOutput: 'jshint.xml'
                },
                files: {
                    src: ['client/app/**/*.js']
                }
            }
        },

        sass: {
            dev: {
                options: {
                    sourceMap: true,
                    sourceComments: 'map'
                },
                includePaths: ['client/style'],
                files: {
                    'client/style/master.css': ['client/style/*.scss']
                }
            },
            dist: {
                options: {
                    sourceMap: false,
                    outputStyle: 'compressed'
                },
                files: {
                    '.dist/style.css': 'client/style/master.scss'
                }
            }
        },

        concat: {
            dist: {
                src: ['client/app/**/*.js'],
                dest: '.dist/.temp/concat.js'
            }
        },
        uglify: {
            dist: {
                options: {
                    compress: true
                },
                files: {
                    '.dist/script.js': '<%= concat.dist.dest %>'
                }
            }
        },

        ngdocs: {
            all: ['client/app/**/*.js']
        },



        /*==== BEGIN Server config ====*/
        express: {
            all: {
                options: {
                    port: 9000,
                    hostname: "localhost",
                    bases: ['client/'],
                    livereload: true
                }
            }
        },
        watch: {
            options: {
                livereload: true
            },
            sass: {
                files: ['client/style/**/*.scss'],
                tasks: ['sass:dev']
            },
            html: {
                files: ['client/index.html']
            },
            app: {
                files: ['client/app/*']
            }
        },
        open: {
            all: {
                path: 'http://localhost:<%= express.all.options.port%>'
            }
        }
        // ==== END Server config

    });


    // ==== GRUNT registering tasks
    grunt.registerTask('dist', [
        'htmlhint',
        'concat',
        'uglify',
        'sass:dist'
    ]);
    grunt.registerTask('server', [
        'sass:dev',
        'express',
        'open',
        'watch'
    ]);
    grunt.registerTask('docs', [
        'ngdocs'
    ]);
};