<?php

session_start();

include "../../conn.php";

if(isset($_POST['import'])){

	$drop = isset($_POST['drop']) ? $_POST['drop'] : 0 ;
	if($drop == 1 ){
		$truncate = "TRUNCATE TABLE t_ld_siswa";
		mysqli_query($conn, $truncate);
	}

	$nama_file_baru = 'data_siswa.xlsx';
	
	
	require_once 'PHPExcel/PHPExcel.php';
	
	$excelreader = new PHPExcel_Reader_Excel2007();
	$loadexcel = $excelreader->load('tmp/'.$nama_file_baru);
	$sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
	
	// Buat query Insert
	$query = "INSERT INTO t_ld_siswa VALUES";
	
	$numrow = 1;
	foreach($sheet as $row){
		
		$nama = strtoupper($row['A']); 
        $t_lahir = ucwords ($row['B']); 
        $tgl_lhr = ucwords ($row['C']);
        $n_ortu = ucwords ($row['D']); 
        $nis = $row['E']; 
        $nisn = $row['F']; 
        $no_pes = $row['G'];
        $foto = $row['H']; 
		
		
		if(empty($nama) && empty($t_lahir) && empty($tgl_lhr) && empty($n_ortu) && empty($nis) && empty($nisn) && empty($no_pes) && empty($foto))
            continue; 
                        
		
		if($numrow > 1){
			// Tambahkan value yang akan di insert ke variabel $query
			$query .= "('".$nama."','".$t_lahir."','".$tgl_lhr."','".$n_ortu."','".$nis."','".$nisn."','".$no_pes."','".$foto."'),";
		}
		
		$numrow++; // Tambah 1 setiap kali looping
	}
	
	$query = substr($query, 0, strlen($query) - 1).";";
	
	// Eksekusi $query
	$hasil = mysqli_query($conn, $query);

	if($hasil){
		mysqli_query($conn, "INSERT INTO t_history VALUES('', 'import data siswa', '$_SESSION[user]', NULL) ");

		echo "
				<script>
					alert('Data Berhasil Di import');
					window.location.href = '../../beranda.php?page=".base64_encode("d_siswa")."';
				</script>

			";
	}else{
		echo "
				<script>
					alert('Data Gagal Di import');
					window.location.href = '../../beranda.php?page=".base64_encode("d_siswa")."&action=".base64_encode("impor")."';
				</script>

			";
	}
}

				
?>
