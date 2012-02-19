[?php use_stylesheets_for_form($form) ?]
[?php use_javascripts_for_form($form) ?]

<a name="filters"></a>
<div class="sf_admin_filter">
  [?php if ($form->hasGlobalErrors()): ?]
  <div class="alert alert-block error">
    <p><strong>Oh snap! You got an error!</strong> Change this and that and <a href="#">try again</a>.</p>
    [?php echo $form->renderGlobalErrors() ?]
  </div>
  [?php endif; ?]

  <h2>Filters <small>for [?php echo <?php echo $this->getI18NString('list.title') ?> ?]</small></h2>
  <form action="[?php echo url_for('<?php echo $this->getUrlForAction('collection') ?>', array('action' => 'filter')) ?]" method="post" class="well">
    [?php $i = 0; ?]
    [?php foreach ($configuration->getFormFilterFields($form) as $name => $field): ?]
    [?php if (0 == $i++ % 3): ?]
    <fieldset>
    [?php endif; ?]
      <div class="control-group">
    [?php if ((isset($form[$name]) && $form[$name]->isHidden()) || (!isset($form[$name]) && $field->isReal())) continue ?]
      [?php include_partial('<?php echo $this->getModuleName() ?>/filters_field', array(
        'name'       => $name,
        'attributes' => $field->getConfig('attributes', array()),
        'label'      => $field->getConfig('label'),
        'help'       => $field->getConfig('help'),
        'form'       => $form,
        'field'      => $field,
        'class'      => 'sf_admin_form_row sf_admin_'.strtolower($field->getType()).' sf_admin_filter_field_'.$name,
      )) ?]
      </div>
    [?php if (0 == $i % 3): ?]
    </fieldset>
    [?php endif; ?]
    [?php endforeach; ?]
    <div class="form-actions">
      [?php echo $form->renderHiddenFields() ?]
      <button type="submit" class="btn btn-primary">[?php echo __('Filter', array(), 'ice_backend_plugin') ?]</button>
      [?php echo link_to(__('Reset', array(), 'ice_backend_plugin'), '<?php echo $this->getUrlForAction('collection') ?>', array('action' => 'filter'), array('query_string' => '_reset', 'method' => 'post', 'class' => 'btn')) ?]
    </div>
  </form>
</div>
