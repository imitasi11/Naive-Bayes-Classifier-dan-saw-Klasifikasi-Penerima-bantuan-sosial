<!DOCTYPE html>
<html lang="en">

<head>
 
<script src="jquery.js"></script> 
 <script> 
    $(function(){
      $("#linkb").load("linkb.html"); 
    });
    
    </script> 
<?php 
 

include "koneksi.php";

$layak = 0;
$tidaklayak = 0;

$probtidaklayak= 0;
$problayak= 0;
$jml_atribut= 0;
$sum = 0;
$tambah= 0;

$isi=array();
$count=1;


$sql = 'SELECT * FROM nbc_atribut ORDER BY id_atribut';
$result = $db->query($sql);
//-- menyiapkan variable penampung berupa array
$atribut=array();
$noatribut=array();
//-- melakukan iterasi pengisian array untuk tiap record data yang didapat
foreach ($result as $row) {
    $atribut[$row['id_atribut']]=$row['atribut'];
        $noatribut[$count]=$row['id_atribut'];
    $jml_atribut=$jml_atribut+1 ;
    $count=$count+1;
    }
?>

<?php
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
<?php

foreach($data as $id_responden=>$dt_atribut){
   

    if($dt_atribut[1]=='1'){
        $layak=$layak+1;
    }else{
        $tidaklayak=$tidaklayak+1;
    }
      $sum = $sum+1;

}
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


/////////////////////////


//$training=array('warga81',2,4,2,2,3,4,3,2);
$training=array('Lasmi',2,2,4,2,2,3,4,3);
////////////////////
$training1=array();
$training2=array();
for($i=1;$i<count($training);$i++){
    $training1[$i]=$isi[1][$i][$training[$i]];
    $training2[$i]=$isi[2][$i][$training[$i]];
}

//perkalian isi array, bandingkan, tulis hasil
$jumlaht1=$probtidaklayak;
$jumlaht2=$problayak;
$hasilt=0;

for($a=1; $a<=count($training1); $a++){
$lort=$tidaklayak;
if($training1[$a]==0){
    for($g=1;$g<=count($training1);$g++){
        if($training1[$g]!=0){
                $training1[$g]=(($training1[$g]*$lort)+1)/($lort+count($training1));
        }else{
            $training1[$a]=1/($lort+count($training1));
        }
                    
    }
  $training1[$a]=1/($lort+count($training1));
}
}

for($a=1; $a<=count($training2); $a++){
$lort=$layak;
if($training2[$a]==0){
    for($g=1;$g<=count($training2);$g++){
        if($training2[$g]!=0){
                $training2[$g]=(($training2[$g]*$lort)+1)/($lort+count($training2));
        }else{
            $training2[$a]=1/($lort+count($training2));
        }
                    
    }
  $training2[$a]=1/($lort+count($training2));
}
}
$class1=1;
$class2=1;
for($a=1; $a<=count($training1); $a++){
$class1=$class1*$training1[$a];
}
for($a=1; $a<=count($training2); $a++){
$class2=$class2*$training2[$a];
}
for($a=1; $a<=count($training1); $a++){
$jumlaht1=$jumlaht1*$training1[$a];
}
for($a=1; $a<=count($training2); $a++){
$jumlaht2=$jumlaht2*$training2[$a];
}
$jumlah=0;
$jumlah=$jumlaht2+$jumlaht1;

if($jumlaht2>=$jumlaht1){
    $hasilt=1;
    $tampung[1]=$hasilt;
}else{
    $hasilt=0;
    $tampung[1]=$hasilt;
}

$hitungpercent1=($jumlaht2/($jumlaht2+$jumlaht1))*100;
$hitungpercent1=number_format($hitungpercent1, 2);?>
<?php $hitungpercent2=($jumlaht1/($jumlaht2+$jumlaht1))*100;
$hitungpercent2=number_format($hitungpercent2, 2);?>
<?php $jumlahpersen=$hitungpercent2+$hitungpercent1;?>

</head>

<body>
       
  <!-- container section start -->
  <section id="container" class="">
    <div id="linkb"></div>
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper">
        <!-- page start-->
        <div class="row">
          <div align="jusify" valign="center" style="padding-left: 10px;">
            <b>Probabilitas Layak</b>
            <table class="table table-striped">
                 
                <thead>
                  <tr>
                    <?php 
                        //-- menampilkan header table
                        for($i=2;$i<=$jml_atribut;$i++){ 
                            echo "<th style='text-align:center'>{$atribut[$noatribut[$i]]}</th>";
                        }
                       
                        ?>
                  </tr>
                </thead>
                   <tbody>
                    <?php 
                    for($x=1;$x<=1;$x++){
                    for($z=1;$z<=4;$z++){
                        echo "<tr>";
                    for($y=2;$y<=$jml_atribut;$y++){
                      $y1=$y-1;
                    echo "<td style='text-align:center'>{$isi[$x][$y1][$z]}</td>";
                    }
                    echo " </tr>";
                    }
                    }
                    ?>

                 
                </tbody>
              </table>
              Probabilitas Tidak Layak
            <table class="table table-striped">
                 
                <thead>
                  <tr>
                    <?php 
                        //-- menampilkan header table
                        for($i=2;$i<=$jml_atribut;$i++){ 
                            echo "<th style='text-align:center'>{$atribut[$noatribut[$i]]}</th>";
                        }
                       
                        ?>
                  </tr>
                </thead>
                   <tbody>
                    <?php 
                    for($x=2;$x<=2;$x++){
                    for($z=1;$z<=4;$z++){
                        echo "<tr>";
                    for($y=2;$y<=$jml_atribut;$y++){
                      $y1=$y-1;
                    echo "<td style='text-align:center'>{$isi[$x][$y1][$z]}</td>";
                    }
                    echo " </tr>";
                    }
                    }
                    ?>

                 
                </tbody>
              </table>
                            <p>1) Menghitung probabilitas posterior class layak dan tidak layak </p>
              <p>a. (P | Ketentuan : Layak) = <?php echo $problayak;?></p>
              <p>b. (P | Ketentuan : Tidak Layak) = <?php echo $probtidaklayak;?></p>
              
              <p>2) Menghitung jumlah kasus dengan kelas yang sama  </p>
              <p>a. Kategori Layak</p>
            <table class="table table-striped">
                 
                <thead>
                  <tr>
                    <?php 
                        //-- menampilkan header table
                        for($i=2;$i<=$jml_atribut;$i++){ 
                            echo "<th style='text-align:center'>{$atribut[$noatribut[$i]]}</th>";
                        }
                       
                        ?>
                  </tr>
                </thead>
                   <tbody><tr>
                    <?php 
                   
                    for($i=2;$i<=$jml_atribut;$i++){ 
                        $x=$i-1;
                            echo "<td style='text-align:center'>{$training2[$x]}</td>";
                        }
                    
                    
                    ?>

                 </tr>
                </tbody>
              </table>

             <p>b. Kategori Tidak Layak</p>
            <table class="table table-striped">
                 
                <thead>
                  <tr>
                    <?php 
                        //-- menampilkan header table
                        for($i=2;$i<=$jml_atribut;$i++){ 
                            echo "<th style='text-align:center'>{$atribut[$noatribut[$i]]}</th>";
                        }
                       
                        ?>
                  </tr>
                </thead>
                   <tbody><tr>
                    <?php 
                   
                    for($i=2;$i<=$jml_atribut;$i++){ 
                        $x=$i-1;
                            echo "<td style='text-align:center'>{$training1[$x]}</td>";
                        }
                    
                    
                    ?>

                 </tr>
                </tbody>
              </table>
              <p>3)    Meghitung nilai akumulasi peluang dari setiap kelas dengan cara dikalikan</p>
              <p>a. P (X | Ketentuan = Layak) = <?php echo $class2;?></p>
              <p>b. P (X | Ketentuan = Tidak Layak) = <?php echo $class1;?></p>
              <p>4)  Menghitung nilai P(X|Ci) * P(Ci)</p>
              <p>a. Likelihood of layak = <?php echo $jumlaht2;?></p>
              <p>a. Likelihood of Tidak layak = <?php echo $jumlaht1;?></p>
              <p>5) Hitung class Layak dan Tidak Layak</p>
              <p>a. Probability of Layak = <?php echo $hitungpercent1;?>%</p>
              <p>b. Probability of Tidak Layak = <?php echo $hitungpercent2;?>%</p>
            
          </div>
        </div>
        <!-- page end-->
      </section>
    </section>
    <!--main content end-->
    <div class="text-right">

    </div>
  </section>
  


</body>

</html>
  

