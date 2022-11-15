
<?php 
include '../koneksi.php';
$id = $_GET['id'];
$delete_id= "DELETE FROM nbc_responden_test where id_responden ='$id' ";
$id_result = $db->query($delete_id);
$delete_data= "DELETE FROM nbc_data_test where id_responden ='$id' ";
$data_result = $db->query($delete_data);
header("location:../testing.php");
?>