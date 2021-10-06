<?php
error_reporting(0);

function rupiah($angka){
	
	$hasil_rupiah = "Rp " . number_format($angka,2,',','.');
	return $hasil_rupiah;
 
}

function getConfig($key){
	
	$qsettings=mysqli_query("select config_value from config where config_key='$key'");
	$bsettings=mysqli_fetch_array($qsettings);
	return $bsettings[0];
}