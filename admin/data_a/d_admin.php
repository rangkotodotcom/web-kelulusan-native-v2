<?php

if(isset($_SESSION["aktif_user_admin"])){
	if($_SESSION['aktif_user_admin'] + 5 * 60 < time()){
		
		mysqli_query($conn, "UPDATE t_luser SET status = 'aktif' WHERE nama = '$_SESSION[nama_admin]' ");
	}
}

?>

<fieldset>
	<legend>Data Admin</legend>
	<a href="?page=<?= base64_encode("d_admin"); ?>&action=<?= base64_encode("tambah_a"); ?>">
		<button style="margin-bottom: 20px;" class="btn btn-success">
			<span class="glyphicon glyphicon-plus"></span> Tambah
		</button>
	</a>

	<div class="table-responsive">
	<table class="table table-bordered table-hover" width="100%">
		<thead>
			<tr class="info">
				<th>No</th>
				<th>Nama</th>
				<th>Username</th>
				<th>Password</th>
				<th>Status</th>
				<th>Aksi</th>
			</tr>
		</thead>	

		<?php
			$i = 0;
	
			$sql = mysqli_query($conn, "SELECT * FROM t_luser WHERE level = 'admin' ");

			$cek = mysqli_num_rows($sql);
			if($cek < 1){
				?>
					<tr>
						<td colspan="6" align="center" style="padding: 10px;">Data tidak di temukan</td>
					</tr>
				<?php
			}else{
				while($data = mysqli_fetch_assoc($sql)){

					$i++;
			?>

				<?php

				if($data['nama'] != 'Admin'){

				 ?>

			<tbody>
				<tr class="warning">
					<td align="center"><?= $i; ?></td>
					<td><?= $data['nama']; ?></td>
					<td><?= $data['user']; ?></td>
					<td align="center">
						<form action="r_pass_a.php" method="post">
							<a onclick="return confirm('Yakin reset password?')" href="?page=<?= base64_encode("d_admin"); ?>&action=<?= base64_encode("r_pass_a"); ?>&nama=<?= base64_encode($data['nama']); ?>">
								<button name="reset" type="button" class="btn btn-warning btn-xs">
									<span class="glyphicon glyphicon-repeat"></span> Reset Password
								</button>
							</a>
						</form>
					</td>

					
					<td align="center">

						
						<?php

						if($data['status'] == 'aktif'){

						 ?>
						<form action="on_admin.php" method="post"> 
							<a href="?page=<?= base64_encode("d_admin"); ?>&action=<?= base64_encode("on_admin"); ?>&nama=<?= base64_encode($data['nama']); ?>">
								<button name="aktif" type="button" class="btn btn-info btn-xs">ON</button>
							</a>
						</form>	

						<?php }else{ ?>	
						<form action="off_admin.php" method="post">
							<a href="?page=<?= base64_encode("d_admin"); ?>&action=<?= base64_encode("off_admin"); ?>&nama=<?= base64_encode($data['nama']); ?>">
								<button name="non-aktif" type="button" class="btn btn-danger btn-xs">OFF</button>
							</a>
						</form>
							
						<?php } ?>

					</td>

					<td align="center">
						<a onclick="return confirm('Yakin ingin menghapus admin?')" href="?page=<?= base64_encode("d_admin"); ?>&action=<?= base64_encode("hapus_a"); ?>&nama=<?= base64_encode($data['nama']); ?>">
							<button class="btn btn-danger btn-xs">
								<span class="glyphicon glyphicon-trash"></span>
							</button>
						</a>
					</td>
				</tr>
			</tbody>

				<?php } ?>

			<?php
			}
		}
		?>

	</table>
	</div>

</fieldset>