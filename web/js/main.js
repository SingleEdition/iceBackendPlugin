$(document).ready(function()
{
  $('#topbar').dropdown();
  $('div.dropdown').dropdown();
  $('.alert').alert('close');

  $('.sf_admin_filter').collapse({
    toggle: false
  });

  $('.sf_admin_filter').ready(function()
  {
    $('#btn-filters').show();
  });

  // Setting some global jQuery ajax options
  $.ajaxSetup(
  {
    timeout: 1800 * 1000
  });

  // Make link in table cells be clickable in the whole cell
  $("div.sf_admin_list td a.target").bigTarget(
  {
    hoverClass: 'over',
    clickZone : 'td:eq(0)'
  });

  $('.sf_admin_list input.sf_admin_batch_checkbox').change(function()
  {
    if ($(this).attr('checked'))
    {
      $(this).closest('tr').addClass('sf_admin_checked');
    }
    else
    {
      $(this).closest('tr').removeClass('sf_admin_checked');
    }
  });

  // This is a solution for the problem knowned as: "Flash of unstyled content"
  $('.hide-fouc').removeClass('hide-fouc');

  // Using anonymize.to for linking to other/external sites
  $('#contents a').filter(function()
  {
    if (this.hostname && this.hostname !== location.hostname)
    {
      $(this).attr('target', '_blank').bind('click keypress', function(event)
      {
        var code = (event.charCode || event.keyCode);
        if (!code || (code && code == 13))
        {
          this.href = 'http://anonym.to/?' + this.href;
        }
      });
    }
  });

  // Make table cells clickable if there is only one link inside (for usability)
  $('table.sf_admin_list td, table.sf_admin_list thead th').each(function()
  {
    var $a_tags = $(this).children('a');

    if ($a_tags.length == 1)
    {
      $(this).css('cursor', 'pointer').bind('click', function()
      {
        // Do nothing if the link is to self
        if ($a_tags.attr('href') == '#' || $a_tags.siblings().length != 0)
        {
          return;
        }

        if ($a_tags.attr('target') == '_blank')
        {
          window.open($a_tags.attr('href'));
          return false;
        }
        else
        {
          document.location.href = $a_tags.attr('href');
        }
      });
    }
  });

  $('input.yes_no').iphoneStyle(
  {
    checkedLabel: 'Yes',
    uncheckedLabel: 'No'
  });

  $('input.enabled_disabled').iphoneStyle(
  {
    checkedLabel: 'Enabled',
    uncheckedLabel: 'Disabled'
  });
});
