function insert_search_log(stock_id, stock_name) {
	uid = document.getElementById("user_id").value;
	$.get(
		"index.php/user/add_search_log",
		{
			"uid" : uid,
			"stock_id" : stock_id,
			"stock_name" : stock_name
		},
		"json"
	);
}


function load_search_log() {
	uid = document.getElementById("user_id").value;
	$.get(
		"index.php/user/load_search_logs",
		{
			"uid" : uid
		},
		function(o) {
			for (i=0; i<o.length; i++) {
				var ins_id = "log" + i;
				// alert(o[i].code + "  " + o[i].stock_name);
				document.getElementById(ins_id).innerHTML = o[i].code + "---" + o[i].stock_name;
				href = "javascript:display_line("+ o[i].code+", "+ "0"+", 'line_day');"
				document.getElementById(ins_id).href = href;
			}
		},
		"json"
	);
}


