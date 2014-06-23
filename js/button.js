//对于普通用户才载入的JS,功能为改变下面线显示的6个button状态,其中3个废弃

$(document).ready(
	//初始化6个button的状态
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
	//点击按钮后触发，改变对应的状态
	document.getElementById('line_day').className = 'btn btn-mini btn-primary'; 
	document.getElementById('line_month').className = 'btn btn-mini btn-primary'; 
	document.getElementById('line_year').className = 'btn btn-mini btn-primary'; 
	document.getElementById('k_day').className = 'btn btn-mini btn-primary'; 
	document.getElementById('k_month').className = 'btn btn-mini btn-primary disabled'; 
	document.getElementById('k_year').className = 'btn btn-mini btn-primary disabled';

	if (state == "line_day") document.getElementById('line_day').className = 'btn btn-mini btn-primary disabled'; 
	if (state == "line_month") document.getElementById('line_month').className = 'btn btn-mini btn-primary disabled'; 
	if (state == "line_year") document.getElementById('line_year').className = 'btn btn-mini btn-primary disabled'; 
	if (state == "k_day") 	document.getElementById('k_day').className = 'btn btn-mini btn-primary disabled'; 
}

function change_mode(state) {
	//根据用户的点击，作出相应的显示响应
	document.getElementById('display_mode').value = state;
	modify_button_state(state);
	stock_id = document.getElementById('stock_id').value;
	stock_name = document.getElementById('stock_name').value;
	if (state == 'k_day') {	//是否是K线的判断
		display_candle(stock_id, stock_name, state);
	}  else {
		display_line(stock_id, stock_name, state)
	}
}