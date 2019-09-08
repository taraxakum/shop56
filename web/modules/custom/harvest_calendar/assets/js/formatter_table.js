/**
 * @file
 * Harvest Calendar table formatter.
 */

(function ($, Drupal) {
  Drupal.behaviors.harvestCalendarFormatterTable = {
    attach: function (context, settings) {

      var processRows = function (rows, size) {
        rows.each(function (index, row) {
          $(row).innerHeight(size);
        });
      }

      var processTable = function (table) {
        var firstCeil = $(table).find('td.item')[0];
        var ceilWidth = $(firstCeil).innerWidth();
        var rows = $(table).find('tr.row');

        processRows(rows, ceilWidth);
      }

      var processTables = function (tables) {
        tables.each(function (index, table) {
          processTable(table);
        });
      }

      var $tables = $('.harvest-calendar--table');
      var handler = function () {
        processTables($tables);
      }

      handler();
      $(window).resize(handler);

    }
  };
})(jQuery, Drupal);
