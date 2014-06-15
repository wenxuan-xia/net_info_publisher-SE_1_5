<script src="/dist/js/inputCheck.js"></script>

<div class="col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4 main">
    <h2 class="text-center">个人信息</h2>
	<form class="form-horizontal" role="form" method="post" action="#" onsubmit="return validate_register_form(this)">
	  <div class="form-group">
		<label for="inputPassword" class="col-sm-3 control-label text-left">密码</label>
		<div class="col-sm-9">
		  <input type="password" name="password" class="form-control" id="inputPassword" placeholder="Password">
		</div>
	  </div>
	  <div class="form-group">
		<label for="inputNewPassword" class="col-sm-3 control-label text-left">新密码</label>
		<div class="col-sm-9">
		  <input type="password" name="newpassword" class="form-control" id="inputNewPassword" placeholder="New Password">
		</div>
	  </div>
	  <div class="form-group">
		<label for="inputReNewPassword" class="col-sm-3 control-label text-left">新密码确认</label>
		<div class="col-sm-9">
		  <input type="password" name="renewpassword" class="form-control" id="inputReNewPassword"  placeholder="Repeat New Password">
		</div>
	  </div>
	 <div class="form-group">
		<label for="inputEmail" class="col-sm-3 control-label text-left">邮箱</label>
		<div class="col-sm-9">
		  <input type="email" name="email" class="form-control" id="inputEmail" value="<?php echo $email;?>" placeholder="Email">
		</div>
	  </div>
	  <div class="form-group">
		<label for="inputName" class="col-sm-3 control-label text-left">真实姓名</label>
		<div class="col-sm-9">
		  <input type="text" name="name" class="form-control" id="inputName"value="<?php echo $realname;?>"  placeholder="Name">
		</div>
	  </div>
	  <div class="form-group">
		<div class="col-sm-offset-1 col-sm-11">
		  <button type="submit" id="submit" name="submit" value="ok" class="btn btn-primary btn-block btn-lg">保存修改</button>
		</div>
	  </div>
	</form>
</div>

