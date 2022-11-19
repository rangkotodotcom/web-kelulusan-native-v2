<fieldset>
	<legend>Kotak Saran</legend>
	<div class="table-responsive">
	<table class="table table-borderd table-hover" width="100%">
		<thead>
			<tr class="info">
				<th>No</th>
				<th>Nama</th>
				<th>Kritik</th>
				<th>Saran</th>
				<th>Di Kirim</th>
			</tr>
		</thead>

		<?php

		$i = 0;

		$sql = mysqli_query($conn, "SELECT * FROM t_saran");

		$cek = mysqli_num_rows($sql);

		if($cek < 1){
			?>

				<tr>
					<td colspan="5" align="center" style="padding: 10px;">Kotak Saran Kosong</td>
				</tr>
			<?php	
		}else{
			while($data = mysqli_fetch_assoc($sql)){

				$i++;

			?>
			
			<tbody>
				<tr class="warning">
					<td align="center"><?= $i; ?></td>
					<td><?= $data['nama']; ?></td>
					<td><?= $data['kritik']; ?></td>
					<td><?= $data['saran']; ?></td>
					<td><?= tanggal(date("D, j F Y H:i:s", strtotime($data['t_kirim']) )); ?></td>
				</tr>
			</tbody>

			<?php	

			}
		}

		 ?>
		
	</table>
	</div>
</fieldset>