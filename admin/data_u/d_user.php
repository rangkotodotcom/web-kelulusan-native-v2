<fieldset>
	<legend>Data User</legend>

	<a href="?page=<?= base64_encode("d_user"); ?>&action=<?= base64_encode("tambah_u"); ?>">
		<button class="btn btn-success">
			<span class="glyphicon glyphicon-plus"></span> Tambah
		</button>
	</a>
	<a href="?page=<?= base64_encode("d_user"); ?>&action=<?= base64_encode("impor_u"); ?>">
		<button class="btn btn-success">
			<span class="glyphicon glyphicon-import"></span> Import
		</button>
	</a>
	<a href="print/cetak_user.php" target="blank" class="btn btn-success">
	 <span class="glyphicon glyphicon-print"></span> Cetak
	</a>

	<div style="margin: 10px 0;" align="right" >
		<form action="" method="post" class="form-inline">
			<div class="form-group">	
				<input type="text" name="pencarian" placeholder="masukan nama siswa" class="form-control" autocomplete="off" />
			</div>
			<button name="cari" class="btn btn-info">
				<span class="glyphicon glyphicon-search"></span>
			</button>
		</form>
		
	</div>
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

			$pencarian = @$_POST['pencarian'];

			if(isset($_POST['cari'])){
				if($pencarian != ""){
					$sql = mysqli_query($conn, "SELECT * FROM t_luser WHERE level = 'siswa' AND nama LIKE '%$pencarian%' ");
				}else{
					$sql = mysqli_query($conn, "SELECT * FROM t_luser WHERE level = 'siswa' ");
				}
			}else{	
				$sql = mysqli_query($conn, "SELECT * FROM t_luser WHERE level = 'siswa' ");
			}

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

			<tbody>
				<tr class="warning">
					<td align="center"><?= $i; ?></td>
					<td><?= $data['nama']; ?></td>
					<td><?= $data['user']; ?></td>

					<?php 

					if($data['ganti'] == 'belum'){

					 ?>

					 <td><?= $data['pass']; ?></td>

					<?php }else{ ?>

					<td align="center">
						<form action="r_pass.php" method="post">
							<a onclick="return confirm('Yakin reset password?')" href="?page=<?= base64_encode("d_user"); ?>&action=<?= base64_encode("r_pass"); ?>&nama=<?= base64_encode($data['nama']); ?>">
								<button name="reset" type="button" class="btn btn-info btn-xs">
									<span class="glyphicon glyphicon-repeat"></span> Reset Password
								</button>
							</a>
						</form>
					</td>

					<?php } ?>

					<td align="center">

						<?php

						if($data['status'] == 'aktif'){

						 ?>

						<form action="a_status.php" method="post">
							<a href="?page=<?= base64_encode("d_user"); ?>&action=<?= base64_encode("a_status"); ?>&nama=<?= base64_encode($data['nama']); ?>">
								<button name="aktif" type="button" class="btn btn-info btn-xs">ON
								</button>
							</a>
						</form>	

						<?php }else{ ?>	
						
						<form action="n_status.php" method="post">
							<a href="?page=<?= base64_encode("d_user"); ?>&action=<?= base64_encode("n_status"); ?>&nama=<?= base64_encode($data['nama']); ?>">
								<button name="non-aktif" type="button" class="btn btn-danger btn-xs">OFF
								</button>
							</a>
						</form>
							
						<?php } ?>

					</td>
					<td align="center">
						<a onclick="return confirm('Yakin ingin menghapus user?')" href="?page=<?= base64_encode("d_user"); ?>&action=<?= base64_encode("hapus_u"); ?>&nama=<?= base64_encode($data['nama']); ?>">
							<button class="btn btn-danger btn-xs">
								<span class="glyphicon glyphicon-trash"></span>
							</button>
						</a>
					</td>
				</tr>
			</tbody>	

			<?php
			}
		}
		?>

	</table>
	</div>

</fieldset>