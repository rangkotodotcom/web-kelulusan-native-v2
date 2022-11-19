<fieldset>
	<legend>Data Diri Siswa</legend>
	<style>
		.siswa table tr img{
			transition: 2s;
		}
		.siswa table tr img:hover{
			transform: scale(4) translate(-90px);
			text-align: center;
		}
	</style>

	<a href="?page=<?= base64_encode("d_siswa"); ?>&action=<?= base64_encode("tambah"); ?>">
		<button class="btn btn-success">
			<span class="glyphicon glyphicon-plus"></span> Tambah
		</button>
	</a>
	<a href="?page=<?= base64_encode("d_siswa"); ?>&action=<?= base64_encode("impor"); ?>">
		<button class="btn btn-success">
			<span class="glyphicon glyphicon-import"></span> Import
		</button>
	</a>
	<a href="?page=<?= base64_encode("d_siswa"); ?>&action=<?= base64_encode("u_foto"); ?>" class="btn btn-success">
		<span class="glyphicon glyphicon-upload"></span> Upload Foto
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
				<th>Tempat, Tanggal Lahir</th>
				<th>Nama Ortu</th>
				<th>NIS</th>
				<th>NISN</th>
				<th>No Pes</th>
				<th>Foto</th>
				<th>Aksi</th>
				
			</tr>
		</thead>	

		<?php
			$i = 0;

			$pencarian = @$_POST['pencarian'];
			

			if(isset($_POST['cari'])){
				if($pencarian != ""){
					$sql = mysqli_query($conn, "SELECT * FROM t_ld_siswa WHERE nama LIKE '%$pencarian%' ");
				}else{
					$sql = mysqli_query($conn, "SELECT * FROM t_ld_siswa");
				}
			}else{	
				$sql = mysqli_query($conn, "SELECT * FROM t_ld_siswa");
			}

			$cek = mysqli_num_rows($sql);
			if($cek < 1){
				?>
					<tr>
						<td colspan="9" align="center" style="padding: 10px;">Data tidak di temukan</td>
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
					<td><?= $data['t_lahir']; ?>, <?= $data['tgl_lhr'];  ?></td>
					<td><?= $data['n_ortu']; ?></td>
					<td><?= $data['nis']; ?></td>
					<td><?= $data['nisn']; ?></td>
					<td><?= $data['no_pes']; ?></td>
					<td align="center">
						<img src="img/siswa/<?= $data['foto']; ?>" alt="foto siswa" width="60px" />
					</td>
					<td align="center">
						<a href="?page=<?= base64_encode("d_siswa"); ?>&action=<?= base64_encode("edit"); ?>&nisn=<?= base64_encode($data['nisn']); ?>">
							<button class="btn btn-info btn-xs">
								<span class="glyphicon glyphicon-edit"></span>
							</button>
						</a>
						<a onclick="return confirm('Yakin ingin menghapus data?')" href="?page=<?= base64_encode("d_siswa"); ?>&action=<?= base64_encode("hapus"); ?>&nisn=<?= base64_encode($data['nisn']); ?>">
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