<?php

session_start();

include "../../conn.php";

if(isset($_POST['import'])){

	$drop = isset($_POST['drop']) ? $_POST['drop'] : 0 ;
	if($drop == 1 ){
		$truncate = "TRUNCATE TABLE t_n_rapor";
		mysqli_query($conn, $truncate);
	}

	$nama_file_baru = 'nilai_rapor.xlsx';
	
	
	require_once 'PHPExcel/PHPExcel.php';
	
	$excelreader = new PHPExcel_Reader_Excel2007();
	$loadexcel = $excelreader->load('tmp/'.$nama_file_baru); 
	$sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
	
	// Buat query Insert
	$query = "INSERT INTO t_n_rapor VALUES";
	
	$numrow = 1;
	foreach($sheet as $row){
		
		$nama = strtoupper($row['A']); 
        $no_pes = $row['B']; 
        $pai = $row['C'];
		$ppkn = $row['D'];
		$ind = $row['E'];
		$mtk = $row['F'];
		$sejind = $row['G'];
		$ing = $row['H'];
		$senbud = $row['I'];
		$pjok = $row['J'];
		$pkwu = $row['K'];
		$mat_sej = $row['L'];
		$fis_eko = $row['M'];
		$kim_sos = $row['N'];
		$bio_geo = $row['O'];
		$lm = $row['P'];

		
		if(empty($nama) && empty($no_pes) && empty($pai) && empty($ppkn) && empty($ind) && empty($mtk) && empty($sejind) && empty($ing) && empty($senbud) && empty($pjok) && empty($pkwu) && empty($mat_sej) && empty($fis_eko) && empty($kim_sos) && empty($bio_geo) && empty($lm) )
            continue; 
                        
		
		if($numrow > 1){
			// Tambahkan value yang akan di insert ke variabel $query
			$query .= "('".$nama."','".$no_pes."','".$pai."','".$ppkn."','".$ind."','".$mtk."','".$sejind."','".$ing."','".$senbud."','".$pjok."','".$pkwu."','".$mat_sej."','".$fis_eko."','".$kim_sos."','".$bio_geo."','".$lm."'),";
		}
		
		$numrow++; // Tambah 1 setiap kali looping
	}
	
	$query = substr($query, 0, strlen($query) - 1).";";
	
	
	$hasil = mysqli_query($conn, $query);

	if($hasil){
		mysqli_query($conn, "INSERT INTO t_history VALUES('', 'import nilai rapor siswa', '$_SESSION[user]', NULL) ");

		echo "
				<script>
					alert('Data Berhasil Di import');
					window.location.href = '../../beranda.php?page=".base64_encode("nilai_r")."';
				</script>

			";
	}else{
		echo "
				<script>
					alert('Data Gagal Di import');
					window.location.href = '../../beranda.php?page=".base64_encode("nilai_r")."&action=".base64_encode("impor_n_r")."';
				</script>

			";
	}
}

				
?>
