<?php 


$akses = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM t_izin_login "));

 ?>

<fieldset>
	<legend>Akses Login Siswa</legend>
	<p align="center" style="font-size: 20px;">Sekarang<br>
		<div align="center">
			<?php

			if($akses['akses'] == 'buka'){

			 ?>
			<form action="buka.php" method="post"> 
				<a href="?page=<?= base64_encode("akses"); ?>&action=<?= base64_encode("buka"); ?>&id=<?= base64_encode($akses['id']); ?>">
					<button name="buka" type="button" class="btn btn-info btn-lg">
						<span class="glyphicon glyphicon-eye-open"></span> Di BUKA
					</button>
				</a>
			</form>	

			<?php }else{ ?>	
			<form action="tutup.php" method="post">
				<a href="?page=<?= base64_encode("akses"); ?>&action=<?= base64_encode("tutup"); ?>&id=<?= base64_encode($akses['id']); ?>">
					<button name="tutup" type="button" class="btn btn-danger btn-lg">
						<span class="glyphicon glyphicon-eye-close"></span> Di TUTUP
					</button>
				</a>
			</form>
				
			<?php } ?>
		</div>
	</p><br><br>
	<p align="center" style="font-size: 20px;">Halaman Awal Sekarang<br>
		<div align="center">
			<?php

			if($akses['awal'] == 'login'){

			 ?> 
				<button name="buka" type="button" class="btn btn-info btn-lg">
					<span class="glyphicon glyphicon-eye-open"></span> Login
				</button>
				<a href="?page=<?= base64_encode("akses"); ?>&action=<?= base64_encode("awal_timer"); ?>&id=<?= base64_encode($akses['id']); ?>">
					<button name="tutup" type="button" class="btn btn-danger btn-lg">
						<span class="glyphicon glyphicon-eye-close"></span> Waktu Mundur
					</button>
				</a>
				<a href="?page=<?= base64_encode("akses"); ?>&action=<?= base64_encode("awal_maintenance"); ?>&id=<?= base64_encode($akses['id']); ?>">
					<button name="tutup" type="button" class="btn btn-danger btn-lg">
						<span class="glyphicon glyphicon-eye-close"></span> Manintenance
					</button>
				</a>


			<?php }else if($akses['awal'] == 'timer'){ ?>	

				
				<a href="?page=<?= base64_encode("akses"); ?>&action=<?= base64_encode("awal_login"); ?>&id=<?= base64_encode($akses['id']); ?>">
					<button name="tutup" type="button" class="btn btn-danger btn-lg">
						<span class="glyphicon glyphicon-eye-close"></span> Login
					</button>
				</a>
				<button name="buka" type="button" class="btn btn-info btn-lg">
					<span class="glyphicon glyphicon-eye-open"></span> Waktu Mundur
				</button>
				<a href="?page=<?= base64_encode("akses"); ?>&action=<?= base64_encode("awal_maintenance"); ?>&id=<?= base64_encode($akses['id']); ?>">
					<button name="tutup" type="button" class="btn btn-danger btn-lg">
						<span class="glyphicon glyphicon-eye-close"></span> Manintenance
					</button>
				</a>
				
			<?php }else if($akses['awal'] == 'maintenance'){ ?>

				<a href="?page=<?= base64_encode("akses"); ?>&action=<?= base64_encode("awal_login"); ?>&id=<?= base64_encode($akses['id']); ?>">
					<button name="tutup" type="button" class="btn btn-danger btn-lg">
						<span class="glyphicon glyphicon-eye-close"></span> Login
					</button>
				</a>
				<a href="?page=<?= base64_encode("akses"); ?>&action=<?= base64_encode("awal_timer"); ?>&id=<?= base64_encode($akses['id']); ?>">
					<button name="tutup" type="button" class="btn btn-danger btn-lg">
						<span class="glyphicon glyphicon-eye-close"></span> Waktu Mundur
					</button>
				</a>
				<button name="buka" type="button" class="btn btn-info btn-lg">
					<span class="glyphicon glyphicon-eye-open"></span> Maintenance
				</button>

			<?php } ?>
		</div>
	</p>
</fieldset>