module.exports = function(grunt) {

    var banner = '/*! <%= pkg.name %> - <%= pkg.description %> - Version: <%= pkg.version %> */\n';
    // Configuration.
    grunt.initConfig({
        pkg : grunt.file.readJSON('package.json'),
        concat : {
            options: {
                banner: banner
            },
            dist: {
                src: 'src/<%= pkg.name %>.php',
                dest: 'dist/<%= pkg.name %>_v<%= pkg.version %>.php'
            }
        }
    });

    // Load plugins
    grunt.loadNpmTasks('grunt-contrib-concat');

    // Register tasks
    grunt.registerTask('default', ['concat']);
};
