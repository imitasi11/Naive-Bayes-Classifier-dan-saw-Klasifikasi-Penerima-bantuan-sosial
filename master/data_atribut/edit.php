<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
  <meta name="author" content="GeeksLabs">
  <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
  <link rel="shortcut icon" href="img/favicon.png">
  <title>Naive Bayes dan SAW Nurul Huda</title>
  <!-- Bootstrap CSS -->
  <link href="../css/bootstrap.min.css" rel="stylesheet">
  <!-- bootstrap theme -->
  <link href="../css/bootstrap-theme.css" rel="stylesheet">
  <!--external css-->
  <!-- font icon -->
  <link href="../css/elegant-icons-style.css" rel="stylesheet" />
  <link href="../css/font-awesome.min.css" rel="stylesheet" />
  <!-- Custom styles -->
  <link href="../css/style.css" rel="stylesheet">
  <link href="../css/style-responsive.css" rel="stylesheet" />
<?php
include "../koneksi.php";
$jml_atribut=0;
$count =1;
$isi=array();
$id=$_GET['id'];
$sql = "SELECT * FROM nbc_atribut where id_atribut = '$id'";
$result = $db->query($sql);
//-- menyiapkan variable penampung berupa array
$atribut="";
$bencost="";
$noatribut=array();
foreach ($result as $row) {
    $atribut=$row['atribut'];
    $bencost=$row['bencost'];
    }
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
            <a class="" href="../home.php">
                          <i class="icon_document_alt"></i>
                            <span>Data Training</span>
                      </a>
          </li>
          <li class="">
            <a class="" href="../atribut.php">
                          <i class="icon_document_alt"></i>
                            <span>Data Atribut</span>
                      </a>
          </li>
          <li class="">
            <a class="" href="../testing.php">
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
            <h3 class="page-header"><i class="fa fa-file-text-o"></i> INPUT DATA Kriteria</h3>
            <section class="panel" style="padding-left: 400px;padding-top: 34px;">
              <div style="width: 60%; border-style: solid;padding: 40px; ">
  <form action="update.php" method="post" enctype="multipart/form-data">
  <table>
  Nama Atribut
      <input type="hidden" name="id" value="<?php echo $id ?>">
      <input type="text" class="form-control" name="nama" value="<?php echo $atribut ?>"><br>
  
  <?php
  $querydata_mysql = "SELECT * FROM nbc_parameter WHERE id_atribut='$id' order by nilai";
  $rslt = $db->query($querydata_mysql);
  foreach($rslt as $data){
  ?>
  Parameter<?php echo $data['nilai'];
    $ini = $data['nilai']; ?>


  
      <input type="text" class="form-control" name="<?php echo $ini ?>" value="<?php echo $data['parameter'] ?>"><br>
   
  <?php
  }?>
  Benefit / Cost
     <select class="form-control input-sm m-bot15" name="bencost">
      <option value="<?php echo $bencost ?>"selected><?php echo $bencost ?></option>
      <option value="benefit">BENEFIT</option>
      <option value="cost">COST</option>
     </select>
    
  <?php
  ?>
  <tr>
    <td><input style="margin-top: 30px;" type="submit" class="btn btn-primary" name="upload" value="Upload"></td>
  </tr>
  </table>
<script src="../js/jquery.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <!-- nicescroll -->
  <script src="../js/jquery.scrollTo.min.js"></script>
  <script src="../js/jquery.nicescroll.js" type="text/javascript"></script>
  <!--custome script for all page-->
  <script src="../js/scripts.js"></script>

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