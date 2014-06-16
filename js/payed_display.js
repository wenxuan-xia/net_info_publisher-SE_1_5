function display_line(stock_id = 0, stock_name = 0, method = 'line_day') {
  if (stock_id != 0) {
    document.getElementById('display_mode').value = method;
    var data_url = 'index.php/api/' + method;
    $.getJSON(data_url, function(data) {

      $('#container').highcharts('StockChart', {
        rangeSelector : {
          enabled: false
        },
        series : [{
          type : 'spline',
          name : stock_id + "---" + stock_name,
          data : data,
          animation : false
        }],
        xAxis: {

        type: 'datetime',
          min: 1182211200000, //待确定
          max: 1182211800000
       },
        chart: {animation : false},
        navigator: {enabled: false},
        scrollbar: {enabled: false},
      });
    });
  }
}

