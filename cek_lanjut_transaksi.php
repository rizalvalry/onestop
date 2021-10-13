<?php
	include "include/koneksi.php";
	$na=$_POST['id'];
	$admin_id=$_POST['adminId'];

	$cekpertama = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM detail_transaksi where admin_id = $admin_id AND No_Order = $na GROUP BY Id_Laundry")); 
	$cekkedua = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM harga where admin_id = $admin_id AND no_order = $na GROUP BY Id_Laundry"));
	if($cekpertama != $cekkedua || $cekpertama <= 0) { echo "false"; }
	else { 
        $sql = mysqli_query($conn, "select sum(Jumlah_pakaian) as jumlah FROM detail_transaksi where No_Order = $na AND admin_id = $admin_id");
        $total = mysqli_fetch_array($sql);

        $sql = mysqli_query($conn, "SELECT sum(total_harga) as total FROM harga where no_order = $na AND admin_id = $admin_id");
        $bayar = mysqli_fetch_array($sql);

        $arr = array(
            "jumlah" => $total['jumlah'],
            "total" => $bayar['total']
        );
        echo json_encode($arr);
    }
?>