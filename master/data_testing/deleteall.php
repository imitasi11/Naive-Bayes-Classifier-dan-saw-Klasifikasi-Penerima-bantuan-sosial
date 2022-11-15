
<?php 
include '../koneksi.php';
$id = $_GET['id'];
$delete_id= "DELETE FROM nbc_responden_test";
$id_result = $db->query($delete_id);
$delete_data= "DELETE FROM nbc_data_test";
$data_result = $db->query($delete_data);
header("location:../testing.php");
?>