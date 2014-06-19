var setInterval_int = 0;

//输入框监视
$(document).ready(
	function() {
		$('#search').keyup(function(e){
			var q = document.getElementById("search_res").value = document.getElementById("search").value;
			var reg = /\D/;
			ss = q.match(reg)
			if (ss != null) 
		        	search_name();
		       	else 
		       		search_id();
		});
	}
);

//刷新监视
$(document).ready(
	function() {
		reflash_guard();
		setInterval_int = setInterval(reflash_guard,5000);
	}
);

//查找log
$(document).ready(
	function() {
		load_search_log();
	}
);

function reflash_guard(){
	stock_id = document.getElementById("stock_id").value;
	stock_name = document.getElementById("stock_name").value;
	search_res = document.getElementById("search_res").value;
	display_mode = document.getElementById("display_mode").value;

	if (stock_id != "") {
		if (display_mode[0] != 'k') {
			display_line(stock_id, stock_name, display_mode);	
		} else {
			display_candle(stock_id, stock_name, display_mode);
		}
		if (setInterval_int == 0) {
			setInterval_int = setInterval(reflash_guard,5000);
		}
	}
	if (search_res != "") {
		search_res_display(search_res);
		clearInterval(setInterval_int);
		setInterval_int = 0;
	}
}


//
function search_res_display(search_res){
	stock = document.getElementById('search').value = search_res;
	var reg = /\D/;
	ss = stock.match(reg)
	if (ss != null) 
		search_name();
	else 
		search_id();
}

