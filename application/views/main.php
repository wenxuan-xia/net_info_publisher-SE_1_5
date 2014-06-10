<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../assets/ico/favicon.ico">

    <script src="../../js/jquery-1.8.3.min.js" type="text/javascript"></script>
    <script src="../../js/search.js" type="text/javascript"></script>


    <title>Dashboard Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="../../dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../../css/dashboard.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" style="color:#ffffff;font-weight:900" href="#">股票交易-网上发布系统</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#" style="color:#FFFFFF">充值</a></li>
            <li><a href="#">个人信息修改</a></li>
            <li><a href="#">最近查看记录</a></li>
            <li><a href="#">退出登录</a></li>
          </ul>
          <div class="navbar-form navbar-right">
            <input id="search" type="text" class="form-control" placeholder="输入代码或名称...">
          </div>
        </div>
      </div>
    </div>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <ul id="sda" class="nav nav-sidebar">
            <li class="active"><a href="#">history search</a></li>
            ...
          </ul>
          <ul class="nav nav-sidebar">
            <li class="active"><a href="">bookmark</a></li>
            <li><a href="">Nav item again</a></li>
            <li><a href="">One more nav</a></li>
            <li><a href="">Another nav item</a></li>
            <li><a href="">More navigation</a></li>
          </ul>
          <ul class="nav nav-sidebar">
            <li class="active"><a href="">Nav item again</a></li>
            <li><a href="">One more nav</a></li>
            <li><a href="">Another nav item</a></li>
          </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h2 id="name" class="page-header">股票代号&股票名</h2>
          
          <div id="container" style="min-width:800px;height:400px"><!--植入stock--></div>

          

          <div class="sub-header" align="right">
            <button class="btn btn-mini btn-primary" type="button">日交易线</button>
            <button class="btn btn-mini btn-primary" type="button">月交易线</button>
            <button class="btn btn-mini btn-primary" type="button">年交易线</button>
            <button class="btn btn-mini btn-info disabled" type="button">日K线</button>
            <button class="btn btn-mini btn-info" type="button">月K线</button>
            <button class="btn btn-mini btn-info" type="button">年K线</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../../js/highstock.js"></script>
    <script scr="../../js/exporting.js"></script>
    <script src="../../dist/js/bootstrap.min.js"></script>
  </body>
</html>
