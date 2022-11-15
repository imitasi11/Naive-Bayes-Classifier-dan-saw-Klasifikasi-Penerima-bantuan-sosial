<!DOCTYPE html>
<html>
<head>
  <script type="text/javascript">
       function printContent(el){
    var restorepage = document.body.innerHTML;
    var printcontent = document.getElementById(el).innerHTML;
    document.body.innerHTML = printcontent;
    window.print();
    document.body.innerHTML = restorepage;
}
  </script>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
  <meta name="author" content="GeeksLabs">
  <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
  <link rel="shortcut icon" href="img/favicon.png">
  <title>Naive Bayes dan SAW Nurul Huda</title>
  <!-- Bootstrap CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <!-- bootstrap theme -->
  <link href="css/bootstrap-theme.css" rel="stylesheet">
  <!--external css-->
  <!-- font icon -->
  <link href="css/elegant-icons-style.css" rel="stylesheet" />
  <link href="css/font-awesome.min.css" rel="stylesheet" />
  <!-- Custom styles -->
  <link href="css/style.css" rel="stylesheet">
  <link href="css/style-responsive.css" rel="stylesheet" />
<?php 

$a=1;
$jml_atribut= 0;
$sum = 0;
$tambah= 0;
$count=1;
$count1=1;

$isi=array();
include "koneksi.php";

$sql = 'SELECT * FROM nbc_atribut ORDER BY id_atribut';
$result = $db->query($sql);
//-- menyiapkan variable penampung berupa array
$atribut=array();
$bencost=array();
$bobot=array();
//-- melakukan iterasi pengisian array untuk tiap record data yang didapat
foreach ($result as $row) {
    $atribut[$row['id_atribut']]=$row['atribut'];
    $noatribut[$count]=$row['id_atribut'];
    $bencost[$row['id_atribut']]=$row['bencost'];
    $bobot[$row['id_atribut']]=$row['bobot'];
    $count=$count+1;
    $jml_atribut=$jml_atribut+1 ;
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
$sql = 'SELECT * FROM nbc_data_test a JOIN nbc_responden_test b USING(id_responden) ORDER BY b.id_responden';
$result = $db->query($sql);
//-- menyiapkan variable penampung berupa array
$data=array();
$responden=array();
$noresponden=array();
$id_responden=0;
//-- melakukan iterasi pengisian array untuk tiap record data yang didapat
foreach ($result as $row) {
    if($id_responden!=$row['id_responden']){
        $responden[$row['id_responden']]=$row['responden'];
        $alamat[$row['id_responden']]=$row['alamat'];
        $data[$row['id_responden']]=array();
        $id_responden=$row['id_responden'];
        $noresponden[$count1]=$row['id_responden'];
        $count1=$count1+1;
    }
    $data[$row['id_responden']][$row['id_atribut']]=$row['id_parameter'];
}

    
   $tampung =array();
   $tampung=$data;
    $lilsave=array();
    $save=array();
    for($i=2;$i<=$jml_atribut;$i++){
    	for($j=1;$j<=count($tampung);$j++){
    	$lilsave[$j][$i]=$tampung[$noresponden[$j]][$noatribut[$i]];
    }
	}
	for($j=1;$j<=count($tampung);$j++){
		for($i=2;$i<=$jml_atribut;$i++){
			$x=$i-1;
    	$save[$x][$j]=$lilsave[$j][$i];
    }
    }	
	$lastsave=array();
  $lastsave1=array();
    for($j=1;$j<=count($tampung);$j++){
    for($i=2;$i<=$jml_atribut;$i++){
    	if($bencost[$noatribut[$i]]=="benefit"){
    		$x=$i-1;
    		$lastsave[$j][$i]=$lilsave[$j][$i]/max($save[$x]);
        $lastsave1[$j][$i]=$lastsave[$j][$i];
    	}else{
    		$x=$i-1;
    		$lastsave[$j][$i]=$lilsave[$j][$i]/max($save[$x]);
        $lastsave1[$j][$i]=$lastsave[$j][$i];
    	}
    }
    }  
    for($j=1;$j<=count($tampung);$j++){
    	for($i=2;$i<=$jml_atribut;$i++){
    		$lastsave[$j][$i]=$lastsave[$j][$i]*$bobot[$noatribut[$i]];
    	}
    }
	for($j=1;$j<=count($tampung);$j++){


		$saveagain[$j]=
	["id" => $noresponden[$j],
	"hasil"=> number_format(array_sum($lastsave[$j]), 2) ];
	}
	
  function disortseklur($nilai_a, $nilai_b) {
	if ($nilai_a["hasil"]==$nilai_b["hasil"]) return 0;
  	return ($nilai_a["hasil"]>$nilai_b["hasil"])?-1:1;
	}

	usort($saveagain, "disortseklur");
	
	?>
    <!--header start-->
 <section id="container" class="">
    <header class="header dark-bg">
      <div class="toggle-nav">
        <div class="icon-reorder tooltips" data-original-title="Toggle Navigation" data-placement="bottom"><i class="icon_menu"></i></div>
      </div>
      <!--logo start-->
      <a href="omah.php" class="logo">Klasifikasi Penerima BPNT  <span class="lite"></span></a>
      <!--logo end-->
    </header>
    <!--header end-->
    <!--sidebar start-->
    <aside>
      <div id="sidebar" class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu">
          <li class="">
            <a class="" href="omah.php">
                          <i class="icon_house_alt"></i>
                            <span>Home</span>
                      </a>
          </li>
          <li class="">
            <a class="" href="home.php">
                          <i class="icon_document_alt"></i>
                            <span>Data Training</span>
                      </a>
          </li>
          <li class="">
            <a class="" href="atribut.php">
                          <i class="icon_document_alt"></i>
                            <span>Data Atribut</span>
                      </a>
          </li>
          <li class="">
            <a class="" href="testing.php">
                          <i class="icon_document_alt"></i>
                            <span>Data Testing</span>
                      </a>
          </li>        
        </ul>
        <!-- sidebar menu end-->
      </div>
    </aside>
    <section id="main-content">
      <section class="wrapper">
        <!-- page start-->
        <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"><i class="fa fa-file-text-o"></i>Perangkingan dengan saw</h3>
            <div  align="right" style="margin-bottom: 13px;"><a class="btn btn-primary" onclick="printContent('div1')" href="#">Print</a></div>
             1)  Membuat matriks keputusan X <br>
            <table border="1">
              <th>idresponden</th>
            <?php
            for($i=2;$i<=$jml_atribut;$i++){ 
                            echo "<th style='text-align:center'>{$atribut[$noatribut[$i]]}</th>";
                        }
            
            for($j=1;$j<=count($tampung);$j++){
            
            
              ?><tr>
                <td><?php echo $noresponden[$j];?></td>
              <?php
              for($i=2;$i<=$jml_atribut;$i++){
                    $x=$i-1;
                    ?>
                    <td><?php echo $save[$x][$j];?></td>
                    <?php
                  }
                  ?>
                </tr>
                 <?php } ?><?php
            
            ?><br><br>
            </table><br><br>
            2) Selanjutnya membuat normalisasi matriks keputusan R dengan cara menghitung nilai rating kinerja ternormalisasi (r<sub>ij)</sub> dari alternatif (A<sub>i</sub>) pada kriteria (C<sub>j</sub>). <br>
            <table border="1">
              <th>idresponden</th>
            <?php
            for($i=2;$i<=$jml_atribut;$i++){ 
                            echo "<th style='text-align:center'>{$atribut[$noatribut[$i]]}</th>";
                        }
            
            for($j=1;$j<=count($tampung);$j++){
            
            
              ?><tr><td><?php echo $noresponden[$j];?></td>
              <?php
              for($i=2;$i<=$jml_atribut;$i++){
                    ?>
                    <td><?php echo $lastsave1[$j][$i];?></td>
                    <?php
                  }
                  ?>
                </tr>
                 <?php } ?><?php
            
            ?><br><br>
            </table><br><br>
             3)  Tahap selanjutnya adalah mencari nilai dari setiap alternatif, dimana nilai dari setiap kriteria (matriks ternormalisasi R) akan dikalikan dengan bobot kriteria (W) <br>
             <table border="1">
              <th>Responden</th>
            <?php
            for($i=2;$i<=$jml_atribut;$i++){ 
                            echo "<th style='text-align:center'>{$atribut[$noatribut[$i]]}</th>";
                        }
            
            for($j=1;$j<=count($tampung);$j++){
            
            
              ?><tr>
                <td><?php echo $responden[$noresponden[$j]];?></td>
              <?php
              for($i=2;$i<=$jml_atribut;$i++){
                    ?>
                    <td><?php echo $lastsave[$j][$i];?></td>
                    <?php
                  }
                  ?>
                </tr>
                 <?php } ?><?php
           
            ?><br><br>
            </table><br><br>
             4)  Hasil <br>

            <table border="1px">
      <tr>
        <th>Rank</th>
        <th>Responden</th>
        <th>Alamat</th>
        <th>Nilai</th>
      </tr>
  <?php
  $a=1;
  for($i=0;$i<count($tampung);$i++){
    
    //script dibawah ini berguna untuk menfilter data testing yang tidak layak
    //data klasifikasi layak yang akan ditamilkan 
    if($data[$saveagain[$i]['id']][1]==1){
    ?>
    <tr>
      <td><?php echo $a; if($a<count($tampung)){$a=$a+1;} ?></td>
        <td><?php echo $responden[$saveagain[$i]['id']]; ?></td>
        <td><?php echo $alamat[$saveagain[$i]['id']]; ?></td>
        
        <td><?php echo $saveagain[$i]['hasil']; ?></td>
        
    </tr> 

    
  <?php }} ?>
  </table>
             
            <section class="panel"  id="div1" >
              <div>

	
  <script src="js/jquery.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <!-- nicescroll -->
  <script src="js/jquery.scrollTo.min.js"></script>
  <script src="js/jquery.nicescroll.js" type="text/javascript"></script>
  <!--custome script for all page-->
  <script src="js/scripts.js"></script>

</section>
          </div>
        </div>
        <!-- page end-->
      </section>
    </section>
    <!--main content end-->
    
  </section>
  


</body>

</html>