<fieldset>
	<legend>Data Nilai Siswa</legend>

	<a href="?page=<?= base64_encode("d_nilai"); ?>&action=<?= base64_encode("tambah_n"); ?>">
		<button class="btn btn-success">
			<span class="glyphicon glyphicon-plus"></span> Tambah
		</button>
	</a>
	<a href="?page=<?= base64_encode("d_nilai"); ?>&action=<?= base64_encode("impor_n"); ?>">
		<button class="btn btn-success">
			<span class="glyphicon glyphicon-import"></span> Import
		</button>
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

	<div class="siswa">
	<div class="table-responsive">
	<table class="table table-bordered table-hover" width="100%">
		<thead>
			<tr class="info">
				<th>No</th>
				<th>Nama</th>
				<th>No Peserta</th>
				<th>B. Indonesia</th>
				<th>B. Inggris</th>
				<th>Matematika</th>
				<th>Pilihan</th>
				<th>Ket</th>
				<th>Aksi</th>
				
			</tr>
		</thead>	

		<?php
			$i = 0;

			$pencarian = @$_POST['pencarian'];
			

			if(isset($_POST['cari'])){
				if($pencarian != ""){
					$sql = mysqli_query($conn, "SELECT * FROM t_ln_siswa WHERE nama LIKE '%$pencarian%' ");
				}else{
					$sql = mysqli_query($conn, "SELECT * FROM t_ln_siswa");
				}
			}else{	
				$sql = mysqli_query($conn, "SELECT * FROM t_ln_siswa");
			}

			$cek = mysqli_num_rows($sql);
			if($cek < 1){
				?>
					<tr>
						<td colspan="8" align="center" style="padding: 10px;">Data tidak di temukan</td>
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
					<td><?= $data['no_pes']; ?></td>
					<td><?= $data['bin']; ?></td>
					<td><?= $data['bing']; ?></td>
					<td><?= $data['mat']; ?></td>
					<td><?= $data['pil']; ?></td>
					<td><?= $data['ket']; ?></td>
					<td align="center">
						<a href="?page=<?= base64_encode("d_nilai"); ?>&action=<?= base64_encode("edit_n"); ?>&nama=<?= base64_encode($data['nama']); ?>">
							<button class="btn btn-info btn-xs">
								<span class="glyphicon glyphicon-edit"></span>
							</button>
						</a>
						<a onclick="return confirm('Yakin ingin menghapus nilai?')" href="?page=<?= base64_encode("d_nilai"); ?>&action=<?= base64_encode("hapus_n"); ?>&nama=<?= base64_encode($data['nama']); ?>">
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