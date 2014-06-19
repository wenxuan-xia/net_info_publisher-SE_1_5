function search_id() {
	stock_id = document.getElementById('search').value;
	len = stock_id.length;
	if (stock_id.length != 0) {
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
					document.getElementById("display_mode").value = "line_day";
					display_line(my_id, my_name, "line_day");
				}
				if ((length != 0) && (len != 0)) {
					for(i=0; i<length; i++) {
						str = str + "<li><a href=\"javascript:display_line(";
						str = str + o[i].stock_id + ", 0, 'line_day'";
						str = str + ");\">"
						str = str + o[i].stock_id +"-" + o[i].stock_name + "</a></li>"
					}
					document.getElementById("result").innerHTML = str;
					document.getElementById("search_res").value = stock_id;
					document.getElementById("stock_id").value = "";
					document.getElementById("stock_name").value = "";
				} else {
					document.getElementById("result").innerHTML = "";
				}
			},
			"json"
		);
	} else {
		document.getElementById("result").innerHTML = "";
	}
}



function search_name() {
	stock_name = document.getElementById('search').value;
	var len = stock_name.length;
	if (stock_name.length != 0) {
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
					document.getElementById("display_mode").value = "line_day";
					display_line(my_id, my_name, "line_day");
				}
				if ((length != 0) && (len != 0)) {
					for(i=0; i<length; i++) {
						str = str + "<li><a href=#>" + o[i].stock_id +"-" + o[i].stock_name + "</a></li>"
					}
					document.getElementById("result").innerHTML = str;
					document.getElementById("search_res").value = stock_id;
					document.getElementById("stock_id").value = "";
					document.getElementById("stock_name").value = "";
				} else {
					document.getElementById("result").innerHTML = "";
				}
			},
			"json"
		);
	} else {
		document.getElementById("result").innerHTML = "";
	}
}


