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
		setInterval(reflash_guard,5000);
	}
);

function reflash_guard(){
	stock_id = document.getElementById("stock_id").value;
	stock_name = document.getElementById("stock_name").value;
	search_res = document.getElementById("search_res").value;
	display_mod = document.getElementById("display_mode").value;

	if (stock_id != "") {
		display_line(stock_id, stock_name);			
	}
	if (search_res != "") search_res_display(search_res);
}


//
function search_res_display(search_res){
	stock = document.getElementById('search').value = search_res;
	var reg = /\D/;
	ss = q.match(reg)
	if (ss != null) 
		search_name();
	else 
		search_id();
}