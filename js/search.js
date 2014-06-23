function search_id() {
	//function: 用stock_id 进行查找外数据库
	stock_id = document.getElementById('search').value;
	len = stock_id.length;
	if (stock_id.length != 0) {
		//如果有输入,访问获取数据
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
					//如果是单条记录，且输入=数据库
					my_id = o[0].stock_id;
					my_name = o[0].stock_name;
					document.getElementById("stock_id").value = stock_id;
					document.getElementById("stock_name").value = my_name;
					document.getElementById("search_res").value = "";
					document.getElementById("display_mode").value = "line_day";
					//更改页面的信息，以便刷新访问
					display_line(my_id, my_name, "line_day");
					//画图，默认为日曲线
					for(i=0; i<length; i++) {
						str = str + "<li><a href=\"javascript:display_line(";
						str = str + o[i].stock_id + ", 0, 'line_day'";
						str = str + ");\">"
						str = str + o[i].stock_id +"-" + o[i].stock_name + "</a></li>"
					}
					document.getElementById("result").innerHTML = str;
					//更改左侧搜索框内容

				} else if ((length != 0) && (len != 0)) {
					//如果长度不符合,判定为搜索
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
					//更改隐藏input，便于刷新访问
				} else {
					document.getElementById("result").innerHTML = "";
					//不符合搜索结果，清空搜索结果
				}
			},
			"json"
		);
	} else {
		document.getElementById("result").innerHTML = "";
		//没有输入，清空搜索结果
	}
}



function search_name() {
	//function: 用stock_name 进行查找外数据库
	stock_name = document.getElementById('search').value;
	var len = stock_name.length;
	if (stock_name.length != 0) {
		//如果有输入,访问获取数据
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
					//如果是单条记录，且输入=数据库
					my_id = o[0].stock_id;
					my_name = o[0].stock_name;
					document.getElementById("stock_id").value = my_id;
					document.getElementById("stock_name").value = stock_name;
					document.getElementById("search_res").value = "";
					document.getElementById("display_mode").value = "line_day";
					display_line(my_id, my_name, "line_day");
					//画图，默认为日曲线
					for(i=0; i<length; i++) {
						str = str + "<li><a href=\"javascript:display_line(";
						str = str + o[i].stock_id + ", 0, 'line_day'";
						str = str + ");\">"
						str = str + o[i].stock_id +"-" + o[i].stock_name + "</a></li>"
					}
					document.getElementById("result").innerHTML = str;
					//更改隐藏input，便于刷新访问
				} else if ((length != 0) && (len != 0)) {//如果长度不符合,判定为搜索
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
					//更改隐藏input，便于刷新访问
				} else {
					document.getElementById("result").innerHTML = "";
					//没有输入，清空搜索结果
				}
			},
			"json"
		);
	} else {
		document.getElementById("result").innerHTML = "";
		//没有输入，清空搜索结果
	}
}


