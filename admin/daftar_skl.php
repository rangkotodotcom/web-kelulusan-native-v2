<fieldset>
	<legend>Daftar SKL Siswa</legend>

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
						<td colspan="4" align="center" style="padding: 10px;">Data tidak di temukan</td>
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
					<td align="center">
						<a href="print/cetak_skl_siswa.php?no_pes=<?= base64_encode($data['no_pes']); ?>" target="blank">
							<button class="btn btn-info btn-md">
								<span class="glyphicon glyphicon-print"></span>
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