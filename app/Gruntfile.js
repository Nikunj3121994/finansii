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
        /*==== BEGIN Production Tasks ==== */

        ngAnnotate: {
            options: {
                singleQuotes: true
            },
            main: {
                src: ['client/app/**/*.js']
            }
        },
        requirejs: {
            compile: {
                options: {
                    baseUrl: "client/app",
                    mainConfigFile: "client/app/main-production.js",
                    name: 'main-production',
                    out: "production/app.min.js"
                }
            }
        },
        ngtemplates: {
            app: {
                cwd: 'client',
                src: 'app/**/*.html',
                dest: 'client/app/templates.js',
                options: {
                    htmlmin: {collapseWhitespace: true, removeComments: true},
                    bootstrap: function (module, script) {
                        return 'define([], function() { return angular.module("app").run(["$templateCache", function($templateCache) { ' + script + ' }]) });';
                    }
                }
            }
        },
        bower_concat: {
            nonangular: {
                dest: 'production/nonangular_bower.js',
                include: [
                    'jquery',
                    'bootstrap',
                    'lodash',
                    'hammerjs'
                ]
            },
            angular: {
                dest: 'production/angular_bower.js',
                include: [
                    'angular',
                    'angular-ui-router',
                    'angular-ui-utils',
                    'angular-ui-select',
                    'angular-sanitize',
                    'angular-aria',
                    'angular-animate',
                    'angular-material',
                    'angular-loading-bar',
                    'angular-bootstrap',
                    'angular-translate',
                    'angular-bindonce'
                ]
            },
            css: {
                cssDest: 'production/style/css_bower.css',
                include: [
                    'angular-material',
                    'metro-ui-css',
                    'selectize',
                    'angular-ui-select',
                    'font-awesome'
                ]

            }
        },
        clean: {
            pre: ["production/*"],
            post: ["client/app/templates.js"]
        },
        copy: {
            target: {
                files: [
                    // includes files within path
                    {
                        expand: true,
                        flatten: true,
                        src: ['client/bower_components/font-awesome/fonts/*'],
                        dest: 'production/fonts/'
                    },
                    {
                        expand: true,
                        flatten: true,
                        src: ['client/bower_components/angular-material/themes/blue-theme.css'],
                        dest: 'production/style/'
                    },
                    {
                        expand: true,
                        flatten: true,
                        src: ['client/bower_components/bootstrap/fonts/*'],
                        dest: 'production/fonts/'
                    },
                    {expand: true, flatten: true, src: ['client/style/master.css'], dest: 'production/style/'},
                    {
                        expand: true,
                        flatten: true,
                        src: ['client/bower_components/requirejs/require.js'],
                        dest: 'production/'
                    }
                ]
            }
        },
        processhtml: {
            options: {
                data: {
                    version: new Date().getTime()
                }
            },
            production: {
                files: {
                    'production/index.html': ['client/index.html']
                }
            }
        },
        git_deploy:{
            production:{
                options: {
                    url: 'git@github.com:klimentLambevski/finansii-production.git'
                },
                src: 'production'
            }
        },
        /*==== END Production tasks ====*/


        /*==== BEGIN Server config ====*/
        express: {
            all: {
                options: {
                    port: 9001,
                    hostname: "0.0.0.0",
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
    grunt.registerTask('production', [
        'sass:dist',
        'clean:pre',
        'ngAnnotate',
        'ngtemplates',
        'requirejs',
        'bower_concat',
        'processhtml',
        'clean:post',
        'copy',
        'git_deploy'
    ]);
};