function time(timestamp)
{
	var d=new Date(timestamp);
	var ret=new Array();
	var days=new Array(0,31,28,31,30,31,30,31,31,30,31,30,31);
	d.setSeconds(0);
	d.setMinutes(0);
	
	d.setHours(9);
	ret[0]=d.valueOf();
	
	d.setHours(15);
	ret[1]=d.valueOf();
	
	d.setHours(0);
	
	var day,month,year;
	year=d.getFullYear();
	month=d.getMonth();
	day=d.getDate();
	
	if (month!=1) lastmonth=month-1;else lastmonth=12;
	d.setMonth(lastmonth);
	var j;
	for (var i=day+1,j=2;i<=days[lastmonth];i++,j++)
	{
		d.setDate(i);
		ret[j]=d.valueOf();
	}
	d.setMonth(month);
	for (var i=1;i<=days[month];i++,j++)
	{
		d.setDate(i);
		ret[j]=d.valueOf();
	}
	d.setDate(1);
	d.setFullYear(year-1);
	for (var i=month+1;i<=12;i++,j++)
	{
		d.setMonth(i);
		ret[j]=d.valueOf();
	}
	d.setFullYear(year);
	for (var i=1;i<=month;i++,j++)
	{
		d.setMonth(i);
		ret[j]=d.valueOf();
	}
	return ret;
}


$(document).ready(
	function(){
		t = time(1182211200000);
		alert(t[0]);
	}
);