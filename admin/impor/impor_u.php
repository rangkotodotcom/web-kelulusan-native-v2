<?php

session_start();

include "../../conn.php";

if(isset($_POST['import'])){ 

	$drop = isset($_POST['drop']) ? $_POST['drop'] : 0 ;
	if($drop == 1 ){
		$truncate = "DELETE FROM t_luser WHERE level = 'siswa' ";
		mysqli_query($conn, $truncate);
	}

	$nama_file_baru = 'user_siswa.xlsx';
	
	
	require_once 'PHPExcel/PHPExcel.php';
	
	$excelreader = new PHPExcel_Reader_Excel2007();
	$loadexcel = $excelreader->load('tmp/'.$nama_file_baru); 
	$sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
	
	// Buat query Insert
	$query = "INSERT INTO t_luser VALUES";


	function kodeAcak($panjang)
	{
	 $karakter = '';
	 $karakter .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
	 $karakter .= '1234567890';
	 
	 $string = '';
	 for ($i=0; $i < $panjang; $i++) { 
	  $pos = rand(0, strlen($karakter)-1);
	  $string .= $karakter{$pos};
	 }
	 return $string;
	}
	
	$numrow = 1;
	foreach($sheet as $row){
		
		$nama = ucwords($row['A']); 
        $user = $row['B']; 
        $pass = kodeAcak(8); 
        $status = 'non-aktif';
        $level = 'siswa';
        $ganti = 'belum';
		
		
		if(empty($nama) && empty($user))
            continue; 
                        
		
		if($numrow > 1){
			// Tambahkan value yang akan di insert ke variabel $query
			$query .= "('".$nama."','".$user."','".$pass."','".$status."','".$level."','".$ganti."'),";
		}
		
		$numrow++; // Tambah 1 setiap kali looping
	}
	
	$query = substr($query, 0, strlen($query) - 1).";";
	
	// Eksekusi $query
	$hasil = mysqli_query($conn, $query);

	if($hasil){
		mysqli_query($conn, "INSERT INTO t_history VALUES('', 'import user siswa', '$_SESSION[user]', NULL) ");

		echo "
				<script>
					alert('User Berhasil Di import');
					window.location.href = '../../beranda.php?page=".base64_encode("d_user")."';
				</script>

			";
	}else{
		echo "
				<script>
					alert('User Gagal Di import');
					window.location.href = '../../beranda.php?page=".base64_encode("d_user")."&action=".base64_encode("impor_u")."';
				</script>

			";
	}
}

				
?>
