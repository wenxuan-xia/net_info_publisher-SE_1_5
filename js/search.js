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
			for(i=0; i<15; i++) {
				alert(o[i].stock_id);
				alert(o[i].stock_name);
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



