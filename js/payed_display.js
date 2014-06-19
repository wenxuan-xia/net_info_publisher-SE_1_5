function display_candle(stock_id, stock_name, method) {
  if (stock_id != 0) {
    set_name(stock_id);
    document.getElementById('stock_id').value = stock_id;
    document.getElementById('stock_name').value = stock_name;
    document.getElementById('display_mode').value = method;
    //获取页面信息
    var data_url = 'index.php/api/' + method + "?stock_id =" + stock_id;
    //组成URL
    modify_button_state(method);
    //更改按钮显示
    $(function() {      //从外数据库获取信息，并在container中显示
    $.getJSON(data_url, function(data) {
      $('#container').highcharts('StockChart', {
        rangeSelector : {
          enabled: false
        },
        //取消选择框
        chart: {animation: false},//chart: 取消动画显示
        navigator: {enabled: false},//取消导航条
        scrollbar: {enabled: false},//取消水平拖动框
        series : [{
          type : 'candlestick',
          data : data,
          dataGrouping : {
          }
        }]
        //series:图上的点的冒泡内容
      });
    });
  });
  }
}

