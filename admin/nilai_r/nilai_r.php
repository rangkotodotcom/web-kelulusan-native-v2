<fieldset>
	<legend>Nilai Rata-Rata Rapor</legend>

	<a href="?page=<?= base64_encode("nilai_r"); ?>&action=<?= base64_encode("tambah_n_r"); ?>">
		<button class="btn btn-success">
			<span class="glyphicon glyphicon-plus"></span> Tambah
		</button>
	</a>
	<a href="?page=<?= base64_encode("nilai_r"); ?>&action=<?= base64_encode("impor_n_r"); ?>">
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
				<th>PAI</th>
				<th>PPKN</th>
				<th>IND</th>
				<th>MTK</th>
				<th>SEJIND</th>
				<th>ING</th>
				<th>SENBUD</th>
				<th>PJOK</th>
				<th>PKWU</th>
				<th>MAT/SEJ</th>
				<th>FIS/EKO</th>
				<th>KIM/SOS</th>
				<th>BIO/GEO</th>
				<th>LM</th>
				<th>Aksi</th>
				
			</tr>
		</thead>	

		<?php
			$i = 0;

			$pencarian = @$_POST['pencarian'];
			

			if(isset($_POST['cari'])){
				if($pencarian != ""){
					$sql = mysqli_query($conn, "SELECT * FROM t_n_rapor WHERE nama LIKE '%$pencarian%' ");
				}else{
					$sql = mysqli_query($conn, "SELECT * FROM t_n_rapor");
				}
			}else{	
				$sql = mysqli_query($conn, "SELECT * FROM t_n_rapor");
			}

			$cek = mysqli_num_rows($sql);
			if($cek < 1){
				?>
					<tr>
						<td colspan="18" align="center" style="padding: 10px;">Data tidak di temukan</td>
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
					<td><?= $data['pai']; ?></td>
					<td><?= $data['ppkn']; ?></td>
					<td><?= $data['ind']; ?></td>
					<td><?= $data['mtk']; ?></td>
					<td><?= $data['sejind']; ?></td>
					<td><?= $data['ing']; ?></td>
					<td><?= $data['senbud']; ?></td>
					<td><?= $data['pjok']; ?></td>
					<td><?= $data['pkwu']; ?></td>
					<td><?= $data['mat_sej']; ?></td>
					<td><?= $data['fis_eko']; ?></td>
					<td><?= $data['kim_sos']; ?></td>
					<td><?= $data['bio_geo']; ?></td>
					<td><?= $data['lm']; ?></td>
					<td align="center">
						<a href="?page=<?= base64_encode("nilai_r"); ?>&action=<?= base64_encode("edit_n_r"); ?>&nama=<?= base64_encode($data['nama']); ?>">
							<button class="btn btn-info btn-xs">
								<span class="glyphicon glyphicon-edit"></span>
							</button>
						</a>
						<a onclick="return confirm('Yakin ingin menghapus nilai?')" href="?page=<?= base64_encode("nilai_r"); ?>&action=<?= base64_encode("hapus_n_r"); ?>&nama=<?= base64_encode($data['nama']); ?>">
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