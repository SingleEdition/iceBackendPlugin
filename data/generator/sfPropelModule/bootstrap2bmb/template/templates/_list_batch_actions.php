<div class="form-inline">
  <?php if ($listActions = $this->configuration->getValue('list.batch_actions')): ?>
  [?php echo ice_cdn_image_tag('theme/arrow_ltr.png', 'backend'); ?]
  <select name="batch_action">
    <option value="">[?php echo __('Choose an action', array(), 'ice_backend_plugin') ?]</option>
    <?php foreach ((array) $listActions as $action => $params): ?>
      <?php echo $this->addCredentialCondition('<option value="'.$action.'">[?php echo __(\''.$params['label'].'\', array(), \'sf_admin\') ?]</option>', $params) ?>
    <?php endforeach; ?>
  </select>
  [?php $form = new BaseForm(); if ($form->isCSRFProtected()): ?]
    <input type="hidden" name="[?php echo $form->getCSRFFieldName() ?]" value="[?php echo $form->getCSRFToken() ?]" />
  [?php endif; ?]
  <input type="submit" class="btn btn-primary flat" value="[?php echo __('Perform Action', array(), 'ice_backend_plugin') ?]" />
  <?php else: ?>
    &nbsp;
  <?php endif; ?>
</div>
