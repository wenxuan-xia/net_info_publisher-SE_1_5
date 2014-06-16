
function display_line(stock_id = 0, stock_name = 0) {
  if (stock_id != 0) {
    $.getJSON('index.php/api/data_spline', function(data) {

      $('#container').highcharts('StockChart', {
        rangeSelector : {
          enabled: false
        },
        series : [{
          type : 'spline',
          name : stock_id + "---" + stock_name,
          data : data
        }],
        navigator: {enabled: false},
        scrollbar: {enabled: false},
      });
    });
  }
}
