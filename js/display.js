function display_line(stock_id, stock_name, method) {
  if (stock_id != 0) {
    set_name(stock_id);
    document.getElementById('stock_id').value = stock_id;
    document.getElementById('stock_name').value = stock_name;
    document.getElementById('display_mode').value = method;
    var data_url = 'index.php/api/' + method;
    modify_button_state(method);
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

function set_name(stock_id) {
  $.get(
    "index.php/api/code_get_name",
    {
      "stock_id" :stock_id
    },
    function(o) {
      document.getElementById("name").innerHTML = stock_id + "---" + o[0].stock_name;
      insert_search_log(stock_id, o[0].stock_name);
    },
    "json"
  );
}