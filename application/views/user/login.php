<script src="/dist/js/inputCheck.js"></script>

<div class="col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4 main">
    <h2 class="text-center">用户登陆</h2>
	<form class="form-horizontal" role="form" method="post" action="/index.php/login" onsubmit="return validate_form(this)">
	  <div class="form-group">
		<label for="inputUserName" class="col-sm-2 control-label text-left">用户名</label>
		<div class="col-sm-10">
		  <input type="text" name="username" class="form-control" id="inputUserName" placeholder="User Name">
		</div>
	  </div>
	  <div class="form-group">
		<label for="inputPassword" class="col-sm-2 control-label text-left">密码</label>
		<div class="col-sm-10">
		  <input type="password" name="password" class="form-control" id="inputPassword" placeholder="Password">
		</div>
	  </div>
	  <div class="form-group">
		<div class="col-sm-offset-1 col-sm-11">
		  <button type="submit" id="submit" name="submit" value="ok" class="btn btn-primary btn-block btn-lg">登陆</button>
		  <a href="/index.php/passwordforget" class="btn btn-warning btn-block " role="button">忘记密码</a>
		  <a href="/index.php/register" class="btn btn-info btn-block " role="button">新用户注册</a>
		</div>
	  </div>
	</form>
	<div class="text-center text-danger">
		<?php echo form_error('username'); ?>
		<?php echo form_error('password'); ?>
	</div>
</div>

