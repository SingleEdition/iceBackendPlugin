<div class="pagination pagination-right">
  <ul>
    <li class="prev [?php echo ($pager->getPage() == 1) ? 'disabled' : null; ?]">
      <a href="[?php echo url_for('@<?php echo $this->getUrlForAction('list') ?>') ?]?page=1">
        [?php echo __('&larr;', array(), 'ice_backend_plugin') ?]
      </a>
    </li>
    <li class="[?php echo ($pager->getPage() == 1) ? 'disabled' : null; ?]">
      <a href="[?php echo url_for('@<?php echo $this->getUrlForAction('list') ?>') ?]?page=[?php echo $pager->getPreviousPage() ?]">
        [?php echo __('&laquo; Previous', array(), 'ice_backend_plugin') ?]
      </a>
    </li>

    [?php foreach ($pager->getLinks() as $page): ?]
      [?php if ($page == $pager->getPage()): ?]
        <li class="active"><a href="javascript:void(0);">[?php echo $page ?]</a></li>
      [?php else: ?]
        <li><a href="[?php echo url_for('@<?php echo $this->getUrlForAction('list') ?>') ?]?page=[?php echo $page ?]">[?php echo $page ?]</a></li>
      [?php endif; ?]
    [?php endforeach; ?]

    [?php if ($pager->getLastPage() > $page): ?]
      <li class="disabled"><a href="javascript:void(0);">…</a></li>
      <li>
        [?php echo link_to($pager->getLastPage(), '@<?php echo $this->getUrlForAction('list') ?>?page='. $pager->getLastPage()); ?]
      </li>
    [?php endif; ?]

    <li class="[?php echo ($pager->getPage() == $pager->getLastPage()) ? 'disabled' : null; ?]">
      <a href="[?php echo url_for('@<?php echo $this->getUrlForAction('list') ?>') ?]?page=[?php echo $pager->getNextPage() ?]">
        [?php echo __('Next &raquo;', array(), 'ice_backend_plugin') ?]
      </a>
    </li>
    <li class="next [?php echo ($pager->getPage() == $pager->getLastPage()) ? 'disabled' : null; ?]">
      <a href="[?php echo url_for('@<?php echo $this->getUrlForAction('list') ?>') ?]?page=[?php echo $pager->getLastPage() ?]">
        [?php echo __('&rarr;', array(), 'ice_backend_plugin') ?]
      </a>
    </li>
  </ul>
</div>
