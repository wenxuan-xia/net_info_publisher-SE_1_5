//总目的：页面进入时启动，为了自动刷新，和其他bootstrap功能
var setInterval_int = 0;

//输入框监视
$(document).ready(
	//为搜索框做一个触发器，若有内容变更，则启动函数
	function() {
		$('#search').keyup(function(e){
			var q = document.getElementById("search_res").value = document.getElementById("search").value;
			var reg = /\D/;
			ss = q.match(reg)	//正则匹配
			if (ss != null) 
		        	search_name();//如果不是数字
		       	else 
		       		search_id();//如果是数字
		});
	}
);

//刷新监视
$(document).ready(
	function() {
		reflash_guard();
		setInterval_int = setInterval(reflash_guard,5000); //定期，5s刷新
	}
);

//查找log
$(document).ready(
	function() {
		load_search_log();//页面进入时，载入log
	}
);

function reflash_guard(){	//5s刷新的具体方法
	stock_id = document.getElementById("stock_id").value;
	stock_name = document.getElementById("stock_name").value;
	search_res = document.getElementById("search_res").value;
	display_mode = document.getElementById("display_mode").value;

	if (stock_id != "") {
		if (display_mode[0] != 'k') {	//如果displaymode = k线
			display_line(stock_id, stock_name, display_mode);	//显示K线
		} else {						//如果displaymode = 普通线
			display_candle(stock_id, stock_name, display_mode);	//显示普通线
		}
		if (setInterval_int == 0) {
			setInterval_int = setInterval(reflash_guard,5000);	//获取自动刷新进程的进程号
		}
	}
	if (search_res != "") {
		search_res_display(search_res);	//如果搜索不为空，则显示搜索
		clearInterval(setInterval_int); //取消自动更新
		setInterval_int = 0;			//进程号清空
	} else {
		search_res_display(stock_id);	//如果搜索为空，则说明stock_id可能不为空，做显示
	}
}


//
function search_res_display(search_res){
	stock = document.getElementById('search').value = search_res;
	if (stock == "") {
		stock = document.getElementById('stock_id').value;
	}
	var reg = /\D/;
	ss = stock.match(reg)
	if (ss != null) 
		search_name();
	else 
		search_id();
}

