<script src="/dist/js/inputCheck.js"></script>

<div class="col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4 main">
    <h2 class="text-center">用户注册</h2>
	<form class="form-horizontal" role="form" method="post" action="/index.php/register" onsubmit="return validate_register_form(this)">
	  <div class="form-group">
		<label for="inputUserName" class="col-sm-3 control-label text-left">用户名</label>
		<div class="col-sm-9">
		  <input type="text" name="username" class="form-control" id="inputUserName" placeholder="User Name">
		</div>
	  </div>
	  <div class="form-group">
		<label for="inputPassword" class="col-sm-3 control-label text-left">密码</label>
		<div class="col-sm-9">
		  <input type="password" name="password" class="form-control" id="inputPassword" placeholder="Password">
		</div>
	  </div>
	  <div class="form-group">
		<label for="inputRePassword" class="col-sm-3 control-label text-left">密码确认</label>
		<div class="col-sm-9">
		  <input type="password" name="repassword" class="form-control" id="inputRePassword" placeholder="Repeat Password">
		</div>
	  </div>
	 <div class="form-group">
		<label for="inputEmail" class="col-sm-3 control-label text-left">邮箱</label>
		<div class="col-sm-9">
		  <input type="email" name="email" class="form-control" id="inputEmail" placeholder="Email">
		</div>
	  </div>
	  <div class="form-group">
		<div class="col-sm-offset-1 col-sm-11">
		  <button type="submit" id="submit" name="submit" value="ok" class="btn btn-primary btn-block btn-lg">确认</button>
		</div>
	  </div>
	</form>
	<div class="text-center text-danger">
		<?php echo form_error('username'); ?>
		<?php echo form_error('password'); ?>
		<?php echo form_error('repassword'); ?>
		<?php echo form_error('email'); ?>
	</div>
</div>

