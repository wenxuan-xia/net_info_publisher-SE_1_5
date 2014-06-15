<script src="/dist/js/inputCheck.js"></script>

<div class="col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4 main">
    <h2 class="text-center">查询记录</h2>


	<div class="table-responsive">
	  <table class="table table-hover text-center">
		<thead>
          <tr class="text-center">
            <th class="text-center">#</th>
            <th class="text-center">股票代码</th>
			<th class="text-center">股票名称</th>
            <th class="text-center">查询时间</th>
          </tr>
        </thead>
		<?php $serial = 0;?>
        <tbody>
          <?php foreach ($log as $item): ?>
			<tr>
				<td><?=($serial++)?></td>
				<td><?=$item->code?></td>
				<td><?=$item->name?></td>
				<td><?=$item->attime?></td>
			</tr>
		  <?php endforeach; ?>

        </tbody>
	  </table>
	</div>


</div>

