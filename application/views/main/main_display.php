
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <ul id="sda" class="nav nav-sidebar">
            <li class="active"><a href="#">历史记录</a></li>
            <li><a href="" id="log0">Another nav item</a></li>
            <li><a href="" id="log1">Nav item again</a></li>
            <li><a href="" id="log2">One more nav</a></li>
            <li><a href="" id="log3">Another nav item</a></li>
            <li><a href="" id="log4">Another nav item</a></li>
          </ul>
          <ul class="nav nav-sidebar">
            <li class="active"><a href="">bookmark</a></li>
            <li><a href="" id="mark1">Nav item again</a></li>
            <li><a href="" id="mark2">One more nav</a></li>
            <li><a href="" id="mark3">Another nav item</a></li>
            <li><a href="" id="mark4">More navigation</a></li>
          </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h2 id="name" class="page-header">股票代号&股票名</h2>
          
          <div id="container" style="min-width:800px;height:400px"><!--植入stock--></div>
          <input id="stock_id" type="text"></input>
          <input id="stock_name" type="text"></input>
          <input id="search_res" type="text"></input>
          <input id="display_mode" type="text"> </input>
          <input id="user_id" type="text" value = "<?php echo $id;?>"> </input>
          

          <div class="sub-header" align="right">

            <button id='line_day' class='btn btn-mini btn-primary' type='button' onclick="javscript: change_mode('line_day');">日交易线</button>
            <button id='line_month' class='btn btn-mini btn-primary' type='button' onclick="javscript: change_mode('line_month');">月交易线</button>
            <button id='line_year' class='btn btn-mini btn-primary' type='button' onclick="javscript: change_mode('line_year');">年交易线</button>

            <button id='k_day' class='btn btn-mini btn-primary' type='button'>日K线</button>
            <button id='k_month' class='btn btn-mini btn-primary' type='button' visable>月K线</button>
            <button id='k_year' class='btn btn-mini btn-primary' type='button'>年K线</button>

          </div>
        </div>
      </div>
    </div>


