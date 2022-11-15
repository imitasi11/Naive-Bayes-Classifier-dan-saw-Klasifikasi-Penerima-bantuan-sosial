<?php
$layak = 0;
$tidaklayak = 0;

$probtidaklayak= 0;
$problayak= 0;
$jml_atribut= 0;
$sum = 0;
$tambah= 0;

$isi=array();
include "koneksi.php";


$sql = 'SELECT * FROM nbc_atribut';
$result = $db->query($sql);
//-- menyiapkan variable penampung berupa array
$atribut=array();
//-- melakukan iterasi pengisian array untuk tiap record data yang didapat
foreach ($result as $row) {
    $atribut[$row['id_atribut']]=$row['atribut'];
    $jml_atribut=$jml_atribut+1 ;
    }
?>

<?php
header("location:login.php");
//-- query untuk mendapatkan semua data atribut di tabel nbc_atribut
$sql = 'SELECT * FROM nbc_parameter ORDER BY id_atribut,id_parameter';
$result = $db->query($sql);
//-- menyiapkan variable penampung berupa array
$parameter=array();
$id_atribut=0;
//-- melakukan iterasi pengisian array untuk tiap record data yang didapat
foreach ($result as $row) {
    if($id_atribut!=$row['id_atribut']){
        $parameter[$row['id_atribut']]=array();
        $id_atribut=$row['id_atribut'];
    }
    $parameter[$row['id_atribut']][$row['nilai']]=$row['parameter'];
}

?>

<?php

//-- query untuk mendapatkan semua data training di tabel nbc_responden dan nbc_data
$sql = 'SELECT * FROM nbc_data a JOIN nbc_responden b USING(id_responden) ORDER BY b.id_responden';
$result = $db->query($sql);
//-- menyiapkan variable penampung berupa array
$data=array();
$responden=array();
$id_responden=0;
//-- melakukan iterasi pengisian array untuk tiap record data yang didapat
foreach ($result as $row) {
    if($id_responden!=$row['id_responden']){
        $responden[$row['id_responden']]=$row['responden'];
        $data[$row['id_responden']]=array();
        $id_responden=$row['id_responden'];
    }
    $data[$row['id_responden']][$row['id_atribut']]=$row['id_parameter'];
}
//print_r($data);
//-- menampilkan data training dalam bentuk tabel

?>
<table border='1'>
<caption>TABEL 1 : Data Training</caption>
<tr><th>Responden</th>
<?php 
//-- menampilkan header table
for($i=2;$i<=$jml_atribut;$i++){ 
    echo "<th>{$atribut[$i]}</th>";
}
?>
<th><?php echo $atribut[1];?></th></tr>
<?php

//-- menampilkan data secara literal
foreach($data as $id_responden=>$dt_atribut){
    echo "<tr><td>{$responden[$id_responden]}</td>";
    for($i=2;$i<=$jml_atribut;$i++){ 
        echo "<td>{$parameter[$i][$dt_atribut[$i]]}</td>";
    }
    echo "<td>{$parameter[1][$dt_atribut[1]]}</td></tr>";

    if($dt_atribut[1]=='1'){
        $layak=$layak+1;
    }else{
        $tidaklayak=$tidaklayak+1;
    }
      $sum = $sum+1;

}


?>
</table>
<?php

//class probabilities
$problayak=$layak/$sum;
$probtidaklayak=$tidaklayak/$sum;
//condition probabilities
foreach ($data as $value){
    for($i=2;$i<=$jml_atribut;$i++){
        //filter layak atau tidak
        $j=$i-1;
        if($value[1]==1){
            if($value[$i]==1){
                if(!isset($isi[2][$j][1])){
                    $isi[2][$j][1]=1;
                }else{
                    $isi[2][$j][1]++;
                }
            }
            if($value[$i]==2){
                if(!isset($isi[2][$j][2])){
                    $isi[2][$j][2]=1;
                }else{
                    $isi[2][$j][2]++;
                }
            }
            if($value[$i]==3){
               if(!isset($isi[2][$j][3])){
                    $isi[2][$j][3]=1;
                }else{
                    $isi[2][$j][3]++;
                }
            }
            if($value[$i]==4){
              if(!isset($isi[2][$j][4])){
                    $isi[2][$j][4]=1;
                }else{
                    $isi[2][$j][4]++;
                }
            }
        }else if($value[1]==0){
            if($value[$i]==1){
              if(!isset($isi[1][$j][1])){
                    $isi[1][$j][1]=1;
                }else{
                    $isi[1][$j][1]++;
                }
            }
            if($value[$i]==2){
               if(!isset($isi[1][$j][2])){
                    $isi[1][$j][2]=1;
                }else{
                    $isi[1][$j][2]++;
                }
            }
            if($value[$i]==3){
               if(!isset($isi[1][$j][3])){
                    $isi[1][$j][3]=1;
                }else{
                    $isi[1][$j][3]++;
                }
            }
            if($value[$i]==4){
               if(!isset($isi[1][$j][4])){
                    $isi[1][$j][4]=1;
                }else{
                    $isi[1][$j][4]++;
                }
            }
        }
    
    }
}



for($x=1;$x<=2;$x++){
    for($y=2;$y<=$jml_atribut;$y++){
        for($z=1;$z<=4;$z++){
            $y1=$y-1;
            if($x==1){
                $lort=$tidaklayak;
            }else{
                $lort=$layak;
            }
            if(!isset($isi[$x][$y1][$z])){

                $isi[$x][$y1][$z]=0;

            }else{
                $isi[$x][$y1][$z]=$isi[$x][$y1][$z]/$lort;
            }
            
        }
    }
}

for($x=1;$x<=2;$x++){
    for($y=2;$y<=$jml_atribut;$y++){
        for($z=1;$z<=4;$z++){
            $y1=$y-1;
            if($x==1){
                $lort=$tidaklayak;
            }else{
                $lort=$layak;
            }

            if($isi[$x][$y1][$z]==0){
                $isi[$x][$y1][$z]=1/($lort+4);

                for($g=1;$g<=4;$g++){
                    if($isi[$x][$y1][$g]!=$isi[$x][$y1][$z]){
                        if($isi[$x][$y1][$g]!=0){
                            $isi[$x][$y1][$g]=(($isi[$x][$y1][$g]*$lort)+1)/($lort+4);
                        }else{
                            $isi[$x][$y1][$g]=$isi[$x][$y1][$z]=1/($lort+4);
                        }
                    }
                    
                }
            }

            }
        }
    }
print_r($isi);

//tttttttrrrrrrraaaaaaaaaaaaainnnnnnnnnnnnnnnnnnnnnniiiiiiiiiiiiiiiiiiiiiiiiiing

$training=array('buyut',4,4,4,4,4,4,4,4);
for($i=1;$i<count($training);$i++){
    $training1[$i]=$isi[1][$i][$training[$i]];
    $training2[$i]=$isi[2][$i][$training[$i]];
}
//print_r($training1);
//perkalian isi array, bandingkan, tulis hasil
$jumlaht1=$probtidaklayak;
$jumlaht2=$problayak;
$hasilt=0;
for($a=1; $a<count($training1); $a++){
$jumlaht1=$jumlaht1*$training1[$a];
}
for($a=1; $a<count($training2); $a++){
$jumlaht2=$jumlaht2*$training2[$a];
}

$jumlah=$jumlaht2+$jumlaht1;
if($jumlaht1>=$jumlaht2){
    $hasilt=0;

}else{
    $hasilt=1;
}
$t1=0;
$t2=0;
$tt=0;
$t1=($jumlaht2/($jumlaht2+$jumlaht1))*100;
$t2=($jumlaht1/($jumlaht1+$jumlaht2))*100;
$tt=$t1+$t2;
?>
<br><br><br><?php

echo($tt);
?>
<br><br><br><?php
print_r($training1);
echo $probtidaklayak;
echo $sum;
?>
<br><?php echo $jumlah;
?><br><?php echo $hasilt;
?>