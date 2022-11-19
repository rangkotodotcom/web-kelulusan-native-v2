<fieldset>
	<legend><?= $_SESSION['nama']; ?></legend>

	<a href="?page=<?= base64_encode("pesan_s"); ?>&action=<?= base64_encode("b_pesan_s"); ?>" class="btn btn-success" style="margin-bottom: 20px;">
		<span class="glyphicon glyphicon-pencil"></span> Buat Chat 
	</a>

	<div class="siswa">
	<div class="table-responsive">
	<table class="table table-bordered table-hover" width="100%">
		<thead style="color: black;">
			<tr class="info">
				<th>No</th>
				<th>Dari</th>
				<th>Aksi</th>
				
			</tr>
		</thead>	

		<?php
			$i = 0;			

			$sql = mysqli_query($conn, "SELECT DISTINCT pengirim FROM t_pesan WHERE penerima = '$_SESSION[nama]' ORDER BY id DESC ");

			$cek = mysqli_num_rows($sql);
			if($cek < 1){
				?>
					<tr>
						<td colspan="4" align="center" style="padding: 10px;">Tidak Ada Pesan</td>
					</tr>
				<?php
			}else{
				while($data = mysqli_fetch_assoc($sql)){

					$i++;
			?>

			<tbody>
				<tr class="warning">
					<td align="center" width="5%"><?= $i; ?></td>
					<td>
						<b>
							<a href="?page=<?= base64_encode("pesan_s"); ?>&action=<?= base64_encode("l_pesan_s"); ?>&pengirim=<?= base64_encode($data['pengirim']); ?>">
								<?= $data['pengirim']; ?>
							</a>
						</b>
					</td>
					<td align="center" width="10%">
						<a onclick="return confirm('Yakin ingin menghapus pesan ini?')" href="?page=<?= base64_encode("pesan_s"); ?>&action=<?= base64_encode("h_pesan_s"); ?>&pengirim=<?= base64_encode($data['pengirim']); ?>">
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
	</div>
</fieldset>