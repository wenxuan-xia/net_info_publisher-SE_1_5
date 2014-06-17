$(document).ready(
	function() {
		document.getElementById('line_day').className = 'btn btn-mini btn-primary disabled'; 
		document.getElementById('line_month').className = 'btn btn-mini btn-primary disabled'; 
		document.getElementById('line_year').className = 'btn btn-mini btn-primary disabled'; 
		document.getElementById('k_day').className = 'btn btn-mini btn-primary disabled'; 
		document.getElementById('k_month').className = 'btn btn-mini btn-primary disabled'; 
		document.getElementById('k_year').className = 'btn btn-mini btn-primary disabled'; 
	}
);


function modify_button_state(state = "line_day") {
	document.getElementById('line_day').className = 'btn btn-mini btn-primary'; 
	document.getElementById('line_month').className = 'btn btn-mini btn-primary'; 
	document.getElementById('line_year').className = 'btn btn-mini btn-primary'; 
	document.getElementById('k_day').className = 'btn btn-mini btn-primary disabled'; 
	document.getElementById('k_month').className = 'btn btn-mini btn-primary disabled'; 
	document.getElementById('k_year').className = 'btn btn-mini btn-primary disabled';

	if (state == "line_day") document.getElementById('line_day').className = 'btn btn-mini btn-primary disabled'; 
	if (state == "line_month") document.getElementById('line_month').className = 'btn btn-mini btn-primary disabled'; 
	if (state == "line_year") document.getElementById('line_year').className = 'btn btn-mini btn-primary disabled'; 
}

function change_mode(state = "line_day") {
	document.getElementById('display_mode').value = state;
	modify_button_state(state);
	stock_id = document.getElementById('stock_id');
	stock_name = document.getElementById('stock_name');
	display_line(stock_id, stock_name, state);
}