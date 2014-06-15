<script src="/dist/js/inputCheck.js"></script>

<div class="col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4 main">
    <h2 class="text-center">充值记录</h2>


	<div class="table-responsive">
	  <table class="table table-hover text-center">
		<thead>
          <tr class="text-center">
            <th class="text-center">#</th>
            <th class="text-center">充值金额（/天）</th>
			<th class="text-center">充值手机号</th>
            <th class="text-center">充值时间</th>
          </tr>
        </thead>
		<?php $serial = 0;?>
        <tbody>
          <?php foreach ($log as $item): ?>
			<tr>
				<td><?=($serial++)?></td>
				<td><?=$item->amount?></td>
				<td><?=$item->phone?></td>
				<td><?=$item->attime?></td>
			</tr>
		  <?php endforeach; ?>

        </tbody>
	  </table>
	</div>


</div>

