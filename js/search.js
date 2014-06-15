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
			if (length == 1) {
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


$(document).ready(
	function() {
		$('#search').keyup(function(e){
			if(e.keyCode == 13) {
		        //alert('Enter key was pressed.');
		        search_id();
		    } else {
		    	//search_id();
		    }
		});

		stock_id = document.getElementById("stock_id").value;
		stock_name = document.getElementById("stock_name").value;
		search_res = document.getElementById("search_res").value;
		display_mod = document.getElementById("display_mode").value;

		if (stock_id != "") {
			display_line(stock_id, stock_name);
			// setInterval(display_line, 5000);
		}
		if (search_res != "") search_res_display(search_res);
	}
);




function search_res_display(search_res){
	document.getElementById('search').value = search_res;
	search_id();
}