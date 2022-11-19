<fieldset>
	<legend><?= $_SESSION['nama']; ?></legend>

	<a href="?page=<?= base64_encode("pesan"); ?>&action=<?= base64_encode("b_pesan"); ?>" class="btn btn-success" style="margin-bottom: 20px;">
		<span class="glyphicon glyphicon-pencil"></span> Buat Chat 
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
		<thead style="color: black;">
			<tr class="info">
				<th>No</th>
				<th>Dari</th>
				<th>Aksi</th>
				
			</tr>
		</thead>	

		<?php
			$i = 0;

			$pencarian = @$_POST['pencarian'];
			

			if(isset($_POST['cari'])){
				if($pencarian != ""){
					$sql = mysqli_query($conn, "SELECT DISTINCT pengirim FROM t_pesan WHERE penerima = '$_SESSION[nama]' AND pengirim LIKE '%$pencarian%' ");
				}else{
					$sql = mysqli_query($conn, "SELECT DISTINCT pengirim FROM t_pesan WHERE penerima = '$_SESSION[nama]' ORDER BY id DESC ");
				}
			}else{	
				$sql = mysqli_query($conn, "SELECT DISTINCT pengirim FROM t_pesan WHERE penerima = '$_SESSION[nama]' ORDER BY id DESC ");
			}

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
							<a href="?page=<?= base64_encode("pesan"); ?>&action=<?= base64_encode("l_pesan"); ?>&pengirim=<?= base64_encode($data['pengirim']); ?>">
								<?= $data['pengirim']; ?>
							</a>
						</b>
					</td>
					<td align="center" width="10%">
						<a onclick="return confirm('Yakin ingin menghapus pesan ini?')" href="?page=<?= base64_encode("pesan"); ?>&action=<?= base64_encode("h_pesan"); ?>&pengirim=<?= base64_encode($data['pengirim']); ?>">
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