[?php if ($value): ?]
  [?php echo ice_cdn_image_tag('theme/tick.png', 'backend', array('alt' => __('Checked', array(), 'ice_backend_plugin'), 'title' => __('Checked', array(), 'ice_backend_plugin'))) ?]
[?php else: ?]
  &nbsp;-&nbsp;
[?php endif; ?]
