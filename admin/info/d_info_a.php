<fieldset>
	<legend>Pengumuman Admin</legend>

	<a href="?page=<?= base64_encode("info_a"); ?>&action=<?= base64_encode("t_info_a"); ?>" class="btn btn-success" style="margin-bottom: 20px;">
		<span class="glyphicon glyphicon-pencil"></span> Tulis Info
	</a>

			<?php
			$sql = mysqli_query($conn, "SELECT * FROM t_linfo_a ORDER BY id DESC");
			while ($data = mysqli_fetch_assoc($sql)){

			?>
	<div class="table-responsive">
		<table width="100%" class="table table-bordered table-hover">
			<tr class="info">
				<th colspan="2">
					<span style="font-size: 20px;"><b><?= $data['subjek']; ?></b></span><br>
					<span style="font-size: 12px;"><?= tanggal(date("D, j F Y H:i:s", strtotime($data['tanggal']) )); ?></span>
				</th>
			</tr>
			<tr class="warning">
				<td width="90%;"><?= $data['info']; ?></td>
				<td align="center">
					<a href="?page=<?= base64_encode("info_a"); ?>&action=<?= base64_encode("e_info_a"); ?>&id=<?= base64_encode($data['id']); ?>">
						<button class="btn btn-info btn-xs">
							<span class="glyphicon glyphicon-edit"></span>
						</button>
					</a>
					<a onclick="return confirm('Hapus Pengumuman ?')" href="?page=<?= base64_encode("info_a"); ?>&action=<?= base64_encode("h_info_a"); ?>&id=<?= base64_encode($data['id']); ?>">
						<button class="btn btn-danger btn-xs">
							<span class="glyphicon glyphicon-trash"></span>
						</button>
					</a>
				</td>
			</tr>
		</table>
	</div>

		<?php } ?> 

</fieldset>