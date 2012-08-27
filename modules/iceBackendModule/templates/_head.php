<meta name="viewport" content="width=device-width, initial-scale=1.0">

<?php
  ice_combine_stylesheets(array(
    '/backend/css/h5bp.css', '/backend/css/bootstrap.css', '/backend/css/responsive.css',
    '/assets/css/jquery/bootstrap.css', '/assets/css/jquery/checkboxes.css',
    '/backend/css/default.css'
  ));

  if (SF_ENV === 'prod')
  {
    ice_include_stylesheets();
  }
?>

<script type="text/javascript" charset="utf-8" src="<?= ice_cdn_javascript_src('jquery.js', 'assets'); ?>"></script>
<script type="text/javascript" charset="utf-8" src="<?= ice_cdn_javascript_src('jquery/ui.js', 'assets'); ?>"></script>
<script type="text/javascript" charset="utf-8" src="<?= ice_cdn_javascript_src('jquery/wijmo.js', 'assets'); ?>"></script>
<script type="text/javascript" charset="utf-8" src="<?= ice_cdn_javascript_src('bootstrap/alerts.js', 'assets'); ?>"></script>
<script type="text/javascript" charset="utf-8" src="<?= ice_cdn_javascript_src('bootstrap/collapse.js', 'assets'); ?>"></script>
<script type="text/javascript" charset="utf-8" src="<?= ice_cdn_javascript_src('bootstrap/dropdown.js', 'assets'); ?>"></script>

<!-- The HTML5 shim, for IE6-8 support of HTML elements -->
<!--[if lt IE 9]>
  <script type="text/javascript" src="<?= ice_cdn_javascript_src('html5.js', 'assets'); ?>"></script>
<![endif]-->
