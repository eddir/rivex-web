$(function () {

  'use strict';

  $.get({
      url: window.location.href + '/ajax',
      timeout: 25000,
      dataType: 'json',
      success: function (statistics) {

          let online = new Morris.Line({
            element          : 'online-chart',
            resize           : true,
            data             : statistics.online,
            xkey             : 'd',
            ykeys            : ['v'],
            labels           : ['Players'],
            lineColors       : ['#2e7031'],
            lineWidth        : 2,
            hideHover        : 'auto',
            gridTextColor    : '#000',
            gridStrokeWidth  : 0.4,
            pointSize        : 4,
            pointStrokeColors: ['#efefef'],
            gridLineColor    : '#efefef',
            gridTextFamily   : 'Open Sans',
            gridTextSize     : 10,
            parseTime        : false,
          });

          let memory = new Morris.Line({
            element          : 'memory-chart',
            resize           : true,
            data             : statistics.memory,
            xkey             : 'd',
            ykeys            : ['v'],
            labels           : ['MB'],
            lineColors       : ['#ff6f00'],
            lineWidth        : 2,
            hideHover        : 'auto',
            gridTextColor    : '#000',
            gridStrokeWidth  : 0.4,
            pointSize        : 4,
            pointStrokeColors: ['#efefef'],
            gridLineColor    : '#efefef',
            gridTextFamily   : 'Open Sans',
            gridTextSize     : 10,
            parseTime        : false,
          });

          let ticks = new Morris.Line({
            element          : 'ticks-chart',
            resize           : true,
            data             : statistics.tick_usage,
            xkey             : 'd',
            ykeys            : ['v'],
            labels           : ['%'],
            lineColors       : ['#ff6f00'],
            lineWidth        : 2,
            hideHover        : 'auto',
            gridTextColor    : '#000',
            gridStrokeWidth  : 0.4,
            pointSize        : 4,
            pointStrokeColors: ['#efefef'],
            gridLineColor    : '#efefef',
            gridTextFamily   : 'Open Sans',
            gridTextSize     : 10,
            parseTime        : false,
          });


          let tps = new Morris.Line({
            element          : 'tps-chart',
            resize           : true,
            data             : statistics.tps,
            xkey             : 'd',
            ykeys            : ['v'],
            labels           : ['TPS'],
            lineColors       : ['#ff6f00'],
            lineWidth        : 2,
            hideHover        : 'auto',
            gridTextColor    : '#000',
            gridStrokeWidth  : 0.4,
            pointSize        : 4,
            pointStrokeColors: ['#efefef'],
            gridLineColor    : '#efefef',
            gridTextFamily   : 'Open Sans',
            gridTextSize     : 10,
            parseTime        : false
          });
		  
          let sales = new Morris.Line({
            element          : 'sales-chart',
            resize           : true,
            data             : statistics.orders,
            xkey             : 'd',
            ykeys            : ['v'],
            labels           : ['Sum'],
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
            parseTime        : false,
            hoverCallback    : function (index, options, content) {
                return (content + options.data[index].v);
            }
          });

          // Fix for charts under tabs
          $('.box ul.nav a').on('shown.bs.tab', function () {
            sales.redraw();
            tps.redraw();
            ticks.redraw();
            memory.redraw();
            online.redraw();
          });
      }
  });
});
