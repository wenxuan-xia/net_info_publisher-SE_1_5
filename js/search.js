function search_id() {
	stock_id = document.getElementById('search').value;
	$.get(
		"index.php/api/code_get_name",
		{
			"stock_id" : stock_id
		},
		function(o) {
			var key = o.free_time;
			var i;
			var str = "";
			length = o.length;
			if (length == 1 && o[0].stock_id==stock_id) {
				my_id = o[0].stock_id;
				my_name = o[0].stock_name;
				document.getElementById("stock_id").value = stock_id;
				document.getElementById("stock_name").value = my_name;
				document.getElementById("search_res").value = "";
				display_line(my_id, my_name, "day_line");
			} else {
				document.getElementById('name').innerHTML = "查询结果";
				for(i=0; i<length; i++) {
					str = str + "<a href=#>" + o[i].stock_id +"-" + o[i].stock_name + "</a><br/>"
				}
				document.getElementById("container").innerHTML = str;
				document.getElementById("search_res").value = stock_id;
				document.getElementById("stock_id").value = "";
				document.getElementById("stock_name").value = "";
			}
		},
		"json"
	);
}


function search_name() {
	stock_name = document.getElementById('search').value;
	$.get(
		"index.php/api/code_get_name_c",
		{
			"stock_name" : stock_name
		},
		function(o) {
			var key = o.free_time;
			var i;
			var str = "";
			length = o.length;
			if (length == 1 && o[0].stock_name==stock_name) {
				my_id = o[0].stock_id;
				my_name = o[0].stock_name;
				document.getElementById("stock_id").value = my_id;
				document.getElementById("stock_name").value = stock_name;
				document.getElementById("search_res").value = "";
				display_line(my_id, my_name, "day_line");
			} else {
				document.getElementById('name').innerHTML = "查询结果";
				for(i=0; i<length; i++) {
					str = str + "<a href=#>" + o[i].stock_id +"-" + o[i].stock_name + "</a><br/>"
				}
				document.getElementById("container").innerHTML = str;
				document.getElementById("search_res").value = stock_name;
				document.getElementById("stock_id").value = "";
				document.getElementById("stock_name").value = "";
			}
		},
		"json"
	);
}
