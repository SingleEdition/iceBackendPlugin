<footer>&nbsp;</footer>

<?php

ice_combine_javascripts(array(
  '/assets/js/jquery/counter.js', '/assets/js/jquery/targets.js',
  '/assets/js/jquery/checkboxes.js', '/backend/js/main.js'
));

if (SF_ENV === 'prod')
{
  ice_include_javascripts();
}


// Output the javascripts for the page
ice_echo_javascripts();

if (sfConfig::get('sf_environment') == 'prod')
{
  include_partial('iceBackendModule/woopra');
}
