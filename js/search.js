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
				document.getElementById('name').innerHTML = my_id + ", " + my_name;
				document.getElementById('container').innerHTML = "线";
			} else {
				document.getElementById('name').innerHTML = "查询结果";
				for(i=0; i<length; i++) {
					// alert(o[i].stock_id);
					// alert(o[i].stock_name);
					str = str + "<a href=#>" + o[i].stock_id +"-" + o[i].stock_name + "</a><br/>"
				}
				document.getElementById("container").innerHTML = str;
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
	}
);



