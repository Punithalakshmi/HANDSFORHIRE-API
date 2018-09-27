module.exports = function(grunt) {

  // Project configuration.
  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),
    uglify: {
      build: {
        src: [
              'assets/js/lib/jquery.min.js',
              'assets/js/lib/getBrowser.js',
              'assets/js/lib/appeared.js',
              'assets/js/lib/jquery.matchHeight-min.js',
              'assets/js/lib/jquery.parallax-1.1.3.js',
              'assets/js/lib/bootstrap.min.js',
              'assets/js/lib/jquery-ui.js',
              'assets/js/lib/slick.min.js',
              'assets/js/lib/smoothscroll.js',
              'assets/js/main.js'
          ],
        dest: 'assets/js/build/global.min.js'
      }
    },
    watch: {
      files:['js/*.js'],
      tasks:['uglify']
    }
  });

  // Load the plugin that provides the "uglify" task.
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-watch');

  // Default task(s).
  grunt.registerTask('default', ['uglify', 'watch']);

};