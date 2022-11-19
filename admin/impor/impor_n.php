<?php

session_start();

include "../../conn.php";

if(isset($_POST['import'])){

	$drop = isset($_POST['drop']) ? $_POST['drop'] : 0 ;
	if($drop == 1 ){
		$truncate = "TRUNCATE TABLE t_ln_siswa";
		mysqli_query($conn, $truncate);
	}

	$nama_file_baru = 'nilai_siswa.xlsx';
	
	
	require_once 'PHPExcel/PHPExcel.php';
	
	$excelreader = new PHPExcel_Reader_Excel2007();
	$loadexcel = $excelreader->load('tmp/'.$nama_file_baru); 
	$sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
	
	// Buat query Insert
	$query = "INSERT INTO t_ln_siswa VALUES";
	
	$numrow = 1;
	foreach($sheet as $row){
		
		$nama = strtoupper($row['A']); 
        $no_pes = $row['B']; 
        $bin = $row['C']; 
        $bing = $row['D']; 
        $mat = $row['E']; 
        $pil = $row['F'];
        $ket = $row['G'];
		
		
		if(empty($nama) && empty($no_pes) && empty($bin) && empty($bing) && empty($mat) && empty($pil) && empty($ket) )
            continue; 
                        
		
		if($numrow > 1){
			// Tambahkan value yang akan di insert ke variabel $query
			$query .= "('".$nama."','".$no_pes."','".$bin."','".$bing."','".$mat."','".$pil."','".$ket."'),";
		}
		
		$numrow++; // Tambah 1 setiap kali looping
	}
	
	$query = substr($query, 0, strlen($query) - 1).";";
	
	
	$hasil = mysqli_query($conn, $query);

	if($hasil){
		mysqli_query($conn, "INSERT INTO t_history VALUES('', 'import nilai siswa', '$_SESSION[user]', NULL) ");

		echo "
				<script>
					alert('Data Berhasil Di import');
					window.location.href = '../../beranda.php?page=".base64_encode("d_nilai")."';
				</script>

			";
	}else{
		echo "
				<script>
					alert('Data Gagal Di import');
					window.location.href = '../../beranda.php?page=".base64_encode("d_nilai")."&action=".base64_encode("impor_n")."';
				</script>

			";
	}
}

				
?>
