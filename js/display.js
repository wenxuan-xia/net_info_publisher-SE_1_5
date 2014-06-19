function display_line(stock_id, stock_name, method) {
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
    $.getJSON(data_url, function(data) {  //从外数据库获取信息，并在container中显示
      $('#container').highcharts('StockChart', {
        rangeSelector : {
          enabled: false
        },
        //取消选择框
        series : [{
          type : 'spline',
          name : stock_id + "---" + stock_name,
          data : data,
          animation : false
        }],
        //series:图上的点的冒泡内容
        xAxis: {
        type: 'datetime',
          min: 1182211200000, //待确定
          max: 1182211800000
       },
        //axis:规定坐标范围
        chart: {animation : false},
        //chart: 取消动画显示
        navigator: {enabled: false},
        //取消导航条
        scrollbar: {enabled: false},
        //取消水平拖动框
      });
    });
  }
}

function set_name(stock_id) {
  //异步获取股票名,和基本信息,并显示
  $.get(
    "index.php/api/code_get_name",
    {
      "stock_id" :stock_id
    },
    function(o) {
      document.getElementById("name").innerHTML = stock_id + "---" + o[0].stock_name;
      insert_search_log(stock_id, o[0].stock_name);
      str = "币种: " + o[0].currency + "    当前价格: " + o[0].price + "    成交量: " + o[0].volume + "  当前状态: ";
          if (o[0].state) {
            str = str + "正常";
          } else {
            str = str + "停牌";
          }
          document.getElementById("metadata").innerHTML = str;
    },
    "json"
  );
}