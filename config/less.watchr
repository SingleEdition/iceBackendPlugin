# Run me with:
#
#   $ watchr plugins/iceBackendPlugin/config/less.watchr

load "#{File.dirname(__FILE__)}/../../iceLibsPlugin/lib/watchr.rb"

def watchr1
  web = Pathname.new("#{File.dirname(__FILE__)}/../web").realpath.to_s

  crawl(web + "/less", 1, false) { |file_path, depth|
    if File.split( file_path )[ 1 ] =~ Regexp.new('^(?!_).*\.less$', true)
      plessc file_path, file_path.gsub('less', 'css'), web
    end
  }
end

def watchr2
  web = Pathname.new("#{File.dirname(__FILE__)}/../web").realpath.to_s

  less = web + "/less/bootstrap/less/bootstrap.less"
  css  = web + "/css/bootstrap.css"
  plessc less, css, web

  less = web + "/less/bootstrap/less/responsive.less"
  css  = web + "/css/responsive.css"
  plessc less, css, web
end

# --------------------------------------------------
# On startup compiling
# --------------------------------------------------
watchr1()
watchr2()

# --------------------------------------------------
# Watchr Rules (put the more specific ones at the end of the list)
# --------------------------------------------------
watch ( "#{File.dirname(__FILE__)}/../web/less/.*\.less$" ) {
  watchr1
}

watch ( "#{File.dirname(__FILE__)}/../web/less/bootstrap/less/.*\.less$" ) {
  watchr2
}
