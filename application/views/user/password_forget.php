<script src="/dist/js/inputCheck.js"></script>

<div class="col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4 main">
    <h2 class="text-center">密码找回</h2>
	<form class="form-horizontal" role="form" method="post" action="#" onsubmit="return validate_register_form(this)">
	  <div class="form-group">
		<label for="inputUserName" class="col-sm-3 control-label text-left">用户名</label>
		<div class="col-sm-9">
		  <input type="text" name="username" class="form-control" id="inputUserName" placeholder="User Name">
		</div>
	  </div>
	 <div class="form-group">
		<label for="inputEmail" class="col-sm-3 control-label text-left">注册邮箱</label>
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
</div>

