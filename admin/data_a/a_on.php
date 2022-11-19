<fieldset>
	<legend>Admin Yang Online</legend><br>
	<div class="table-responsive">
	<table width="100%" class="table table-bordered table-hover">

		<tr class="info">
			<th>No</th>
			<th>Nama</th>
			<th>Online</th>
			<th>Login</th>
			<th>Aksi</th>
		</tr>

		<?php

		$i = 0;

		$sql = mysqli_query($conn, "SELECT * FROM t_online WHERE level = 'admin' ");

		$cek = mysqli_num_rows($sql);

		if($cek < 1 ){
			?>
				<tr>
					<td colspan="5" align="center" style="padding: 10px;">Tidak Ada Admin Yang Online</td>
				</tr>
			<?php
		}else{
			while($data = mysqli_fetch_assoc($sql)){

				$i++;
		?>

			<?php

			if($data['nama'] != 'Jamilur Rusydi Al Miichtari'){

			 ?>
 
		<tr class="warning">
			<td align="center"><?= $i; ?></td>
			<td><?= $data['nama']; ?></td>
			<td align="center"><?= $data['online']; ?></td>
			<td><?= tanggal(date("d F Y H:i:s", strtotime($data['login']) )); ?></td>
			<td align="center">
				<a onclick="return confirm('Yakin ingin menghapus admin online?')" href="?page=<?= base64_encode("a_on"); ?>&action=<?= base64_encode("hapus_a_o"); ?>&nama=<?= base64_encode($data['nama']); ?>">
					<button class="btn btn-danger btn-xs">
						<span class="glyphicon glyphicon-trash"></span>
					</button>
				</a>
			</td>
		</tr>

			<?php } ?>

		<?php
		}
	}
	?>


	</table>
	</div>	
</fieldset>