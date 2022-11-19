 <fieldset>
 	<legend>Bukti Administrasi</legend>
 	<style>
 		.bukti table tr img{
			transition: 2s;
		}
		.bukti table tr img:hover{
			transform: scale(4) translate(-50px);
			text-align: center;
		}
 	</style>

 	<div style="margin-bottom: 10px;" align="right">
		<form action="" method="post" class="form-inline">
		<div class="form-group">	
		<input type="text" name="pencarian" placeholder="masukan nama siswa" class="form-control" autocomplete="off" />
		</div>
		<button name="cari" class="btn btn-info">
			<span class="glyphicon glyphicon-search"></span>
		</button>
		</form>
		
	</div>

	<div class="bukti">
	<div class="table-responsive">
	<table width="100%" class="table table-bordered table-hover">

	<thead>
		<tr class="info">
			<th>No</th>
			<th>Nama</th>
			<th>Kartu Registrasi Administrasi</th>
			<th>Kartu Bebas Pustaka</th>
			<th>Aksi</th>
			
		</tr>
	</thead>	

		<?php
			$i = 0;

			$pencarian = @$_POST['pencarian'];

			if(isset($_POST['cari'])){
				if($pencarian != ""){
					$sql = mysqli_query($conn, "SELECT * FROM t_adm WHERE nama LIKE '%$pencarian%' ");
				}else{
					$sql = mysqli_query($conn, "SELECT * FROM t_adm ");
				}
			}else{	
				$sql = mysqli_query($conn, "SELECT * FROM t_adm ");
			}

			$cek = mysqli_num_rows($sql);
			if($cek < 1){
				?>
					<tr>
						<td colspan="5" align="center" style="padding: 10px;">Data tidak di temukan</td>
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
				<td align="center">
					<img src="img/adm/<?= $data['komite']; ?>" alt="bukti iuran komite" width="80px" />
				</td>
				<td align="center">
					<img src="img/adm/<?= $data['pustaka']; ?>" alt="bukti bebas pustaka" width="80px" />
				</td>
				<td align="center">
					<a onclick="return confirm('Yakin ingin menghapus Bukti Adm?')" href="?page=<?= base64_encode("b_adm"); ?>&action=<?= base64_encode("hapus_b"); ?>&nama=<?= base64_encode($data['nama']); ?>">
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