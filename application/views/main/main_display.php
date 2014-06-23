    
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          
              <input id="search" type="text" class="form-control" placeholder="输入代码或名称...">
           
          <ul id="result" class="nav nav-sidebar">
            
          </ul>
          <ul id="sda" class="nav nav-sidebar">
            <li class="active"><a>历史记录</a></li>
            <li><a href="" id="log0"></a></li>
            <li><a href="" id="log1"></a></li>
            <li><a href="" id="log2"></a></li>
            <li><a href="" id="log3"></a></li>
            <li><a href="" id="log4"></a></li>
            <li><a href="" id="log5"></a></li>
            <li><a href="" id="log6"></a></li>
            <li><a href="" id="log7"></a></li>
            <li><a href="" id="log8"></a></li>
            <li><a href="" id="log9"></a></li>
          </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          
          <h2 id="name" class="page-header">通知说明</h2>
          <div id="metadata"></div>
          <div id="container" style="min-width:800px;height:400px">
            请在左上角输入框，直接输入代号或名称进行使用
          </div>
          

          <input id="stock_id" type="hidden"></input>
          <input id="stock_name" type="hidden"></input>
          <input id="search_res" type="hidden"></input>
          <input id="display_mode" type="hidden"> </input>
          <input id="user_id" type="hidden" value = "<?php echo $id;?>"> </input>
          
          <div class="sub-header" align="right">

            <button id='line_day' class='btn btn-mini btn-primary' type='button' onclick="javscript: change_mode('line_day');">日交易线</button>
            <button id='line_month' class='btn btn-mini btn-primary' type='button' onclick="javscript: change_mode('line_month');">月交易线</button>
            <button id='line_year' class='btn btn-mini btn-primary' type='button' onclick="javscript: change_mode('line_year');">年交易线</button>

            <button id='k_day' class='btn btn-mini btn-primary' type='button' onclick="javscript: change_mode('k_day');">日K线</button>
            <button id='k_month' class='btn btn-mini btn-primary' type='button' onclick="javscript: change_mode('k_month');">月K线</button>
            <button id='k_year' class='btn btn-mini btn-primary' type='button' onclick="javscript: change_mode('k_year');">年K线</button>

          </div>
        </div>
      </div>
    </div>


