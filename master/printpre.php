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
$layak = 0;
$tidaklayak = 0;
$nomor = 1;
$probtidaklayak= 0;
$problayak= 0;
$jml_atribut= 0;
$sum = 0;
$tambah= 0;

$isi=array();
include "koneksi.php";
$count=1;


$sql = 'SELECT * FROM nbc_atribut';
$result = $db->query($sql);
//-- menyiapkan variable penampung berupa array
$atribut=array();
//-- melakukan iterasi pengisian array untuk tiap record data yang didapat
foreach ($result as $row) {
    $atribut[$row['id_atribut']]=$row['atribut'];
    $jml_atribut=$jml_atribut+1 ;
    $noatribut[$count]=$row['id_atribut'];
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
$sql = 'SELECT * FROM nbc_data_test a JOIN nbc_responden_test b USING(id_responden) ORDER BY b.id_responden';
$result = $db->query($sql);
//-- menyiapkan variable penampung berupa array
$data=array();
$responden=array();
$id_responden=0;
//-- melakukan iterasi pengisian array untuk tiap record data yang didapat
foreach ($result as $row) {
    if($id_responden!=$row['id_responden']){
        $responden[$row['id_responden']]=$row['responden'];
        $alamat[$row['id_responden']]=$row['alamat'];
        $data[$row['id_responden']]=array();
        $id_responden=$row['id_responden'];
    }
    $data[$row['id_responden']][$row['id_atribut']]=$row['id_parameter'];
}
//print_r($data);
//-- menampilkan data training dalam bentuk tabel

?>

    <!--header start-->
 <section id="container" class="">
    <header class="header dark-bg">
      <div class="toggle-nav">
        <div class="icon-reorder tooltips" data-original-title="Toggle Navigation" data-placement="bottom"><i class="icon_menu"></i></div>
      </div>
      <!--logo start-->
      <a href="index.html" class="logo">Naive Bayes &  <span class="lite"> SAW</span></a>
      <!--logo end-->
    </header>
    <!--header end-->
    <!--sidebar start-->
    <aside>
      <div id="sidebar" class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu">
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
                          <i class="icon_house_alt"></i>
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
            <h3 class="page-header"><i class="fa fa-file-text-o"></i>Print Preview</h3>
            <div  align="right" style="margin-bottom: 13px;"><a class="btn btn-primary" onclick="printContent('div1')" href="#">Print</a></div>
             
            <section class="panel"  id="div1" >
              <div>

    <table class="table table-striped" border="1px">

                 
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Responden</th>
                    <th>Alamat</th>
                    <?php 
                        //-- menampilkan header table
                        for($i=2;$i<=$jml_atribut;$i++){ 
                            echo "<th style='text-align:center'>{$atribut[$i]}</th>";
                        }
                        ?>
                        <th style="text-align:center"><?php echo $atribut[1];?></th>
                  </tr>
                </thead>
                   <tbody>

                        <?php

                        //-- menampilkan data secara literal
                        foreach($data as $id_responden=>$dt_atribut){
                            echo "<tr><td>$nomor</td>
                            <td>{$responden[$id_responden]}</td>
                            <td>{$alamat[$id_responden]}</td>";
                            for($i=2;$i<=$jml_atribut;$i++){ 
                                echo "<td>{$parameter[$noatribut[$i]][$dt_atribut[$noatribut[$i]]]}</td>";
                            }
                            echo "<td>{$parameter[1][$dt_atribut[1]]}</td>";
                        ?>  </tr> <?php
                            $nomor=$nomor+1;
                            }

                        ?>
                 </tbody>
              </table>
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