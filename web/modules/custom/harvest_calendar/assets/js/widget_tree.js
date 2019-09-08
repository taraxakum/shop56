/**
 * @file
 * Harvest Calendar simple widget.
 */

(function ($, Drupal) {
  Drupal.behaviors.harvestCalendarElementTree = {
    attach: function (context, settings) {

      var collapse = function (items) {
        items.each(function (index, el) {
          $(el, context)
            .addClass('collapsible-processed collapsed')
            .hide();
        });
      }

      var getAim = function (item) {
        var aims = $(item, context)
          .closest('.item--container')
          .find('ul');

        return aims[0];
      }

      var toggleCollapsibleBlock = function (item) {
        var aim = getAim(item);

        if (aim) {
          $(aim, context).toggle(200, function () {
            $(item, context).toggleClass('opened');
          });
        }
      }

      var process = function (event) {
        var item = event.target;

        toggleCollapsibleBlock(item);
      }

      var addListeners = function (items) {
        items.each(function (index, el) {
          $(el, context).once().on('click', process);
        });
      }

      var init = function () {
        var element = $('.harvest_calendar_tree--element', context);
        var blocks = element.find('.item--block--collapsible');
        var switchers = element.find('.item--label');

        collapse(blocks);
        addListeners(switchers);

        element.addClass('processed');
      }

      var processLabel = function (label) {
        if (!$(label, context).hasClass('opened')) {
          toggleCollapsibleBlock(label);
        }
      }

      var processLabels = function (labels) {
        labels.map(processLabel);
      }

      var findParents = function (item) {
        return $(item, context)
          .parents('.item--container');
      }

      var getCollapsedBlocks = function (items, item) {
        var parents = findParents(item);
        if (parents) {
          items.push(...parents);
        }
      }

      var getChecked = function () {
        return $('.item--value input[type="checkbox"]:checked', context);
      }

      var getCheckedItems = function (checked) {
        var items = [];
        checked.once('harvestCalendarWidgetTree').each(function (index, item) {
          getCollapsedBlocks(items, item);
        });

        return $.unique(items);
      }

      var getLabelsToExpand = function (items) {
        return items.map(function (i) {
          return $(i).find('.item--label')[0];
        });
      }

      var expandChecked = function () {
        var checked = getChecked();
        var items = getCheckedItems(checked);
        var labels = getLabelsToExpand(items);

        processLabels(labels);
      }

      init();
      expandChecked();

    }
  };
})(jQuery, Drupal);
