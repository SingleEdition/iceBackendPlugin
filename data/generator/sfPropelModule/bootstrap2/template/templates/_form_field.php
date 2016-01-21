[?php if ($field->isPartial()): ?]
  [?php include_partial('<?php echo $this->getModuleName() ?>/'.$name, array('form' => $form, 'attributes' => $attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes)) ?]
[?php elseif ($field->isComponent()): ?]
  [?php include_component('<?php echo $this->getModuleName() ?>', $name, array('form' => $form, 'attributes' => $attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes)) ?]
[?php else: ?]
  <div class="clearfix [?php echo $class ?][?php $form[$name]->hasError() and print ' error' ?]">
    <div class="form-group">
    [?php
      $label = $form[$name]->renderLabel($label);

      if (strpos($label, 'Bg BG') !== false)
      {
        echo '<label style="padding-top: 0; margin-top: -8px; margin-right: -20px;">', ice_cdn_image_tag('theme/bulgaria.png', 'backend'), '</label>';
      }
      else if (strpos($label, 'En US') !== false)
      {
        echo '<label style="padding-top: 0; margin-top: -8px; margin-right: -20px;">', ice_cdn_image_tag('theme/england.png', 'backend'), '</label>';
      }
      else
      {
        echo $label;
      }
    ?]


      [?php echo $form[$name]->render($attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes) ?]


      [?php if ($help): ?]
        <span class="help-block">[?php echo __($help, array(), '<?php echo $this->getI18nCatalogue() ?>') ?]</span>
      [?php elseif ($help = $form[$name]->renderHelp()): ?]
        <span class="help-block">[?php echo $help ?]</span>
      [?php endif; ?]
    </div>

    [?php echo $form[$name]->renderError() ?]
  </div>
[?php endif; ?]
