[?php use_stylesheets_for_form($form) ?]
[?php use_javascripts_for_form($form) ?]

<a name="filters"></a>
<div class="sf_admin_filter" style="height: auto;">
  [?php if ($form->hasGlobalErrors()): ?]
  <div class="alert alert-block error">
    <p><strong>Oh snap! You got an error!</strong> Change this and that and <a href="#">try again</a>.</p>
    [?php echo $form->renderGlobalErrors() ?]
  </div>
  [?php endif; ?]

  <h1>Filters </h1>

  <form action="[?php echo url_for('<?php echo $this->getUrlForAction('collection') ?>', array('action' => 'filter')) ?]" method="post" class="well well-reset-paggination">
    <div class="row">
      <div class="col-xs-6">

        [?php $i = 0; ?]
        [?php foreach ($configuration->getFormFilterFields($form) as $name => $field): ?]

        [?php if (0 == $i % 3 && 0 != $i): ?]

          </div> <!-- .span6 -->
        [?php endif; ?]

        [?php if (0 == $i % 6 && 0 != $i): ?]
        </div> <!-- .row-fluid -->
        <div class="row">
        [?php endif; ?]

        [?php if (0 == $i % 3 && 0 != $i): ?]
          <div class="col-xs-6">

        [?php endif; ?]

          <div class="form-group">
        [?php if ((isset($form[$name]) && $form[$name]->isHidden()) || (!isset($form[$name]) && $field->isReal())) continue ?]
          [?php include_partial('<?php echo $this->getModuleName() ?>/filters_field', array(
            'name'       => $name,
            'attributes' => $field->getConfig('attributes', array('class' => 'form-control')),
            'label'      => $field->getConfig('label'),
            'help'       => $field->getConfig('help'),
            'form'       => $form,
            'field'      => $field,
            'class'      => 'sf_admin_form_row sf_admin_'.strtolower($field->getType()).' sf_admin_filter_field_'.$name,
          )) ?]
          </div>

        [?php $i++; ?]
        [?php endforeach; ?]

      </div> <!-- .span6 -->
    </div> <!-- .row-fluid -->
    <div class="form-actions form-actions-fix-posiotion">
      [?php echo $form->renderHiddenFields() ?]
      <button type="submit" class="btn btn-primary flat">[?php echo __('Filter', array(), 'ice_backend_plugin') ?]</button>
      [?php echo link_to(__('Reset', array(), 'ice_backend_plugin'), '<?php echo $this->getUrlForAction('collection') ?>', array('action' => 'filter'), array('query_string' => '_reset', 'method' => 'post', 'class' => 'btn btn-default flat')) ?]
    </div>
  </form>
</div>
