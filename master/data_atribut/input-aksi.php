  
<?php 

include "../koneksi.php";

$tampung=array();
for($i=1;$i<=4;$i++){
	$tampung[$i] = $_POST[$i];
}

$nama = $_POST['nama'];
$bencos = $_POST['bencos'];

$id_atribut=rand(1,100);
$cek_id= "SELECT * FROM nbc_atribut where id_atribut ='$id_atribut' ";
$cek_result = mysqli_query($connect,$cek_id);
$numrow = mysqli_num_rows($cek_result);

while($numrow > 0){
	$id_atribut=0;
	$id_atribut=rand(1,100);
	$cek_id= "SELECT * FROM nbc_atribut where id_atribut ='$id_atribut' ";
	$cek_result = mysqli_query($connect,$cek_id);
	$numrow = mysqli_num_rows($cek_result);
}

	$input_atribut = "INSERT INTO nbc_atribut VALUES('$id_atribut','$nama','$bencos','0') ";
	$atribut_result = $db->query($input_atribut);
	for($i=1;$i<=4;$i++){
		$b=$tampung[$i];
		$input_parameter = "INSERT INTO nbc_parameter VALUES(NULL,'$id_atribut','$i','$b') ";
		$param_result = $db->query($input_parameter);
	}
	$responden="SELECT * from nbc_responden";
	$responden_result= $db->query($responden);
	foreach ($responden_result as $row) {
		$a=$row['id_responden'];
		$query_mysql = "INSERT INTO nbc_data VALUES(NULL,'$a',$id_atribut,'1')";
		$result= $db->query($query_mysql);
	}
	$responden="SELECT * from nbc_responden_test";
	$responden_result= $db->query($responden);
	foreach ($responden_result as $row) {
		$a=$row['id_responden'];
		$query_mysql = "INSERT INTO nbc_data_test VALUES(NULL,'$a',$id_atribut,'1')";
		$result= $db->query($query_mysql);
	}
	

 header('Location: ../home.php');
 // delete

?>