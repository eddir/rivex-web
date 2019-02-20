$(function () {

  'use strict';

  $.get({
      url: '/admin/stat/ajax',
      timeout: 25000,
      dataType: 'json',
      success: function (statistics) {
          new Morris.Line({
            element          : 'sales-chart',
            resize           : true,
            data             : statistics.orders,
            xkey             : 'date',
            ykeys            : ['sum'],
            labels           : ['sum'],
            lineColors       : ['#efefef'],
            lineWidth        : 2,
            hideHover        : 'auto',
            gridTextColor    : '#fff',
            gridStrokeWidth  : 0.4,
            pointSize        : 4,
            pointStrokeColors: ['#efefef'],
            gridLineColor    : '#efefef',
            gridTextFamily   : 'Open Sans',
            gridTextSize     : 10,
            parseTime: false,
            hoverCallback: function (index, options, content) {
                return (content + options.data[index].sum);
            }
          });

          // Fix for charts under tabs
          $('.box ul.nav a').on('shown.bs.tab', function () {
            sales.redraw();
          });
      }
  });
});
