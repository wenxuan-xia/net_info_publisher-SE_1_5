<script src="/dist/js/inputCheck.js"></script>

<div class="col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4 main">
    <h2 class="text-center">充值</h2>
	<form class="form-horizontal" role="form" method="post" action="#" onsubmit="return validate_register_form(this)">
	  <div class="form-group">
		<label for="inputPhone" class="col-sm-3 control-label text-left">手机号</label>
		<div class="col-sm-9">
		  <input type="text" name="phone" class="form-control" id="inputPhone" placeholder="11位手机号">
		</div>
	  </div>
	  <div class="form-group">
		<div class="col-sm-offset-1 col-sm-11">
		  <button type="submit" id="submit" name="submit" value="ok" class="btn btn-primary btn-block btn-lg">确认</button>
		</div>
	  </div>
	</form>
</div>

