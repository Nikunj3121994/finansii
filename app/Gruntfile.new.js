module.exports = function(grunt) {

    //TODO da se sredit nekako grunt
    //require('load-grunt-config')(grunt);



    grunt.initConfig({
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
                files: ['client/style/*.scss'],
                tasks: ['sass']
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
    grunt.registerTask('server', [
        'express',
        'open',
        'watch'
    ]);
};