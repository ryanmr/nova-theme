module.exports = function(grunt) {
  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),

    sass: {
      options: {
        includePaths: ['bower_components/foundation/scss']
      },
      dev: {
        options: {
          outputStyle: 'expanded',
          lineNumbers: true
        },
        files: {
          'css/app.css': 'scss/app.scss'
        }
      },
      production: {
        options: {
          outputStyle: 'compressed'
        },
        files: {
          'css/app.css': 'scss/app.scss'
        }
      }      
    },

    uglify: {
      dev: {
        options: {
          compress: false,
          beautify: true,
          mangle: false
        },
        files: {
          'js/foundation.js': [
            'bower_components/foundation/js/foundation.js', 
            'bower_components/foundation/js/foundation/foundation.topbar.js', 
            'js/jquery.cookie.js'
            ],
          'js/app.js': ['js/scripts.js']
        }
      },
      production: {
        options: {
          compress: true,
          beautify: false,
          mangle: false
        },
        files: {
          'js/foundation.js': [
            'bower_components/foundation/js/foundation.js', 
            'bower_components/foundation/js/foundation/foundation.topbar.js', 
            'js/jquery.cookie.js',
            'js/masonry.pkgd.min.js'
            ],
          'js/app.js': ['js/scripts.js']
        }
      }      
    },

    watch: {
      grunt: { files: ['Gruntfile.js'] },

      scripts: {
          files: ['js/scripts.js'],
          tasks: ['uglify']
      },

      sass: {
        files: 'scss/**/*.scss',
        tasks: ['sass:dev']
      }

    },


    rsync: {
        options: {
            src: "./",
            args: ["--verbose"],
            exclude: ['.git*', 'node_modules', '.sass-cache','.DS_Store'],
            recursive: true,
            syncDestIgnoreExcl: true
        },
        production: {
            options: {
                dest: "/srv/www/blog.ryanrampersad.com/public_html/wp-content/themes/nova/",
                host: "ryan@thenexus.tv"
            }
        }
    }


  });

  grunt.loadNpmTasks('grunt-sass');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-rsync');

  grunt.registerTask('production', ['sass:production', 'uglify:production']);
  
  grunt.registerTask('deploy', ['sass:production', 'uglify:production', 'rsync']);
  
  grunt.registerTask('build', ['sass:dev', 'uglify:dev']);
  grunt.registerTask('default', ['build','watch']);
}
