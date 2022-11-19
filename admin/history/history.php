<fieldset>
	<legend>History</legend>
	

	<div class="table-responsive">
	<table class="table table-bordered table-hover" width="100%">
		<thead>
			<tr class="info">
				<th>No</th>
				<th>Aktifitas</th>
				<th>Oleh</th>
				<th>Waktu</th>
				<th>Aksi</th>
			</tr>
		</thead>	

		<?php
			$i = 0;
	
			$sql = mysqli_query($conn, "SELECT * FROM t_history");

			$cek = mysqli_num_rows($sql);
			if($cek < 1){
				?>
					<tr>
						<td colspan="6" align="center" style="padding: 10px;">Tidak Ada History</td>
					</tr>
				<?php
			}else{
				while($data = mysqli_fetch_assoc($sql)){

					$i++;
			?>

			<tbody>
				<tr class="warning">
					<td align="center"><?= $i; ?></td>
					<td><?= ucwords($data['aktifitas']); ?></td>
					<td><?= $data['oleh']; ?></td>
					<td align="center">
						<?= tanggal(date("D, j F Y H:i:s", strtotime($data['tanggal']) )); ?>
					</td>
					<td align="center">
						<a onclick="return confirm('Yakin ingin menghapus history?')" href="?page=<?= base64_encode("history"); ?>&action=<?= base64_encode("hapus_h"); ?>&id=<?= base64_encode($data['id']); ?>">
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

	<form action="" method="post">
		<button name="kosong" onclick="return confirm('Kosongkan Tabel History?')" class="btn btn-warning btn-md">Kosongkan Tabel History</button>
	</form>

	<?php 

	if(isset($_POST['kosong'])){
		$history = mysqli_query($conn, "TRUNCATE TABLE t_history");

		if($history){
			echo "<script>
					alert('Tabel History Sudah kosong');
					window.location.href='?page=".base64_encode("history")."';
				</script>";
		}else{
			echo "<script>
					alert('Gagal Mengosongkan Tabel History');
					window.location.href='?page=".base64_encode("history")."';
				</script>";
		}
	}

	 ?>

</fieldset>