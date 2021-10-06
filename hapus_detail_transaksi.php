<?php
session_start();
include "./include/koneksi.php";

if(isset($_POST['id'])) $id = $_POST['id'];
if(isset($_POST['ids'])) $ids = $_POST['ids'];
if(isset($_POST['idl'])) $idl = $_POST['idl'];
if(isset($_POST['action'])) $action = $_POST['action'];
$admin_id = $_SESSION['id'];

if($action == "clearAll") {
    $query = "DELETE FROM detail_transaksi WHERE No_Order='".$id."' AND admin_id = '".$admin_id."' ";
    $deleteDetail = $conn->prepare($query);
    $deleteDetail->bind_param("ii", $id, $admin_id);
    $deleteDetail->execute();

    $query = "DELETE FROM harga WHERE no_order='".$id."' AND admin_id = '".$admin_id."' ";
    $deleteHarga = $conn->prepare($query);
    $deleteHarga->bind_param("ii", $id, $admin_id);
    $deleteHarga->execute();
} else {
    $query = "DELETE FROM detail_transaksi WHERE No_Order='".$id."' AND Id_Pakaian='".$ids."' AND Id_Laundry='".$idl."' AND admin_id = '".$admin_id."' ";
    $deleteDetail = $conn->prepare($query);
    $deleteDetail->bind_param("iiii", $id, $ids, $idl, $admin_id);
    $deleteDetail->execute();

    $Laundry_Satuan = array('3','4','5');
    if (in_array($idl, $Laundry_Satuan, TRUE)) {
        $query = "DELETE FROM harga WHERE no_order='".$id."' AND Id_Laundry='".$idl."' AND Id_Pakaian='".$ids."' AND admin_id = '".$admin_id."' ";
        $deleteHarga = $conn->prepare($query);
        $deleteHarga->execute();
    } else {
        $query = "DELETE FROM harga WHERE no_order='".$id."' AND Id_Laundry='".$idl."' AND admin_id = '".$admin_id."' ";
        $deleteHarga = $conn->prepare($query);
        $deleteHarga->execute();
    }
}

echo json_encode(['success' => 'Sukses']);

$conn->close();
?>