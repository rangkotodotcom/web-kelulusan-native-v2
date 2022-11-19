<fieldset>
	<legend>User Yang Online</legend><br>
	<div class="table-responsive">
	<table width="100%" class="table table-bordered table-hover">

		<tr class="info">
			<th>No</th>
			<th>Nama</th>
			<th>Username</th>
			<th>Online</th>
			<th>Login</th>

			<?php 

			if($_SESSION['nama'] == 'Jamilur Rusydi Al Miichtari'){

			?>
			
			<th>Aksi</th>

			<?php } ?>

		</tr>

		<?php

		$i = 0;

		$sql = mysqli_query($conn, "SELECT * FROM t_online WHERE level = 'siswa' ");

		$cek = mysqli_num_rows($sql);

		if($cek < 1 ){
			?>

			<?php

			if($_SESSION['nama'] == 'Jamilur Rusydi Al Miichtari'){
			
			 ?>

			 	<tr>
					<td colspan="6" align="center" style="padding: 10px;">Tidak Ada User Yang Online</td>
				</tr>

			<?php }else{ ?>

				<tr>
					<td colspan="5" align="center" style="padding: 10px;">Tidak Ada User Yang Online</td>
				</tr>

			<?php } ?>

			<?php
		}else{
			while($data = mysqli_fetch_assoc($sql)){

				$i++;
		?>

		<tr class="warning">
			<td align="center"><?= $i; ?></td>
			<td><?= $data['nama']; ?></td>
			<td><?= $data['user']; ?></td>
			<td align="center"><?= $data['online']; ?></td>
			<td><?= $data['login']; ?></td>

			<?php 

			if($_SESSION['nama'] == 'Jamilur Rusydi Al Miichtari'){

			?>
			<td align="center">
				<a onclick="return confirm('Yakin ingin menghapus user online?')" href="?page=<?= base64_encode("u_on"); ?>&action=<?= base64_encode("hapus_u_o"); ?>&nama=<?= base64_encode($data['nama']); ?>">
					<button class="btn btn-danger btn-xs">
						<span class="glyphicon glyphicon-trash"></span>
					</button>
				</a>
			</td>

			<?php } ?>
			
		</tr>

		<?php
		}
	}
	?>


	</table>
	</div>	
</fieldset>