<!--密码重置时的页面主体-->
<script src="/dist/js/inputCheck.js"></script>

<div class="col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4 main">
    <h2 class="text-center">密码重置</h2>
	<form class="form-horizontal" role="form" method="post" action="#" onsubmit="return validate_register_form(this)">
	  <div class="form-group">
		<label for="inputPassword" class="col-sm-3 control-label text-left">新密码</label>
		<div class="col-sm-9">
		  <input type="password" name="password" class="form-control" id="inputPassword" placeholder="Password">
		</div>
	  </div>
	  <div class="form-group">
		<label for="inputRePassword" class="col-sm-3 control-label text-left">新密码确认</label>
		<div class="col-sm-9">
		  <input type="password" name="repassword" class="form-control" id="inputRePassword" placeholder="Password">
		</div>
	  </div>
	  <input type="hidden" name="token" value="<?php echo $token;?>">
	  <div class="form-group">
		<div class="col-sm-offset-1 col-sm-11">
		  <button type="submit" id="submit" name="submit" value="ok" class="btn btn-primary btn-block btn-lg">确认</button>
		</div>
	  </div>
	</form>
<!--
	输出错误信息
-->
	<div class="text-center text-danger">
		<?php echo form_error('password'); ?>
		<?php echo form_error('repassword'); ?>
	</div>
</div>

