//目的，更新显示用户的查询记录

function insert_search_log(stock_id, stock_name) {	//当用户查询股票时，通过该方法对数据库进行更新操作
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


function load_search_log() {	//当用户进入页面时，由触发器调用该方法显示历史查询记录
	uid = document.getElementById("user_id").value;
	$.get(
		"index.php/user/load_search_logs",
		{
			"uid" : uid
		},
		function(o) {
			for (i=0; i<o.length; i++) {
				var ins_id = "log" + i;
				document.getElementById(ins_id).innerHTML = o[i].code + "---" + o[i].stock_name;
				href = "javascript:display_line("+ o[i].code+", "+ "0"+", 'line_day');"
				//拼接html代码
				document.getElementById(ins_id).href = href;
				//设置href javascript
			}
		},
		"json"
	);
}


