function display_candle(stock_id, stock_name, method) {
  if (stock_id != 0) {
    set_name(stock_id);
    document.getElementById('stock_id').value = stock_id;
    document.getElementById('stock_name').value = stock_name;
    document.getElementById('display_mode').value = method;
    var data_url = 'index.php/api/' + method;
    modify_button_state(method);
    $(function() {
  $.getJSON(data_url, function(data) {
    $('#container').highcharts('StockChart', {
      rangeSelector : {
        enabled: false
      },
      chart: {animation: false},
      navigator: {enabled: false},
      scrollbar: {enabled: false},
      series : [{
        type : 'candlestick',
        data : data,
        dataGrouping : {
        }
      }]
    });
  });
});
  }
}

