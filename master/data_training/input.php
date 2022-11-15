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
$ini = "";
$jml_atribut=0;
$count=1;
 
$sql = 'SELECT * FROM nbc_atribut';
$result = $db->query($sql);
$atribut=array();

$noatribut=array();
foreach ($result as $row) {
    $atribut[$row['id_atribut']]=$row['atribut'];

    $noatribut[$count]=$row['id_atribut'];
    $jml_atribut=$jml_atribut+1 ;
    $count=$count+1;
    }

$tsql = 'SELECT * FROM nbc_parameter ORDER BY id_atribut,id_parameter';
$result = $db->query($tsql);
$parameter=array();
$id_atribut=0;
foreach ($result as $row) {
    if($id_atribut!=$row['id_atribut']){
        $parameter[$row['id_atribut']]=array();
        $id_atribut=$row['id_atribut'];
    }
    $parameter[$row['id_atribut']][$row['nilai']]=$row['parameter'];
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
            <h3 class="page-header"><i class="fa fa-file-text-o"></i> INPUT DATA Training</h3>
            <section class="panel" style="padding-left: 400px;padding-top: 34px;">
              <div style="width: 60%; border-style: solid;padding: 40px; ">
  <form action="input-aksi.php" method="post" enctype="multipart/form-data">    
    <table>

      
      Nama <input type="text" name="nama" class="form-control"><br>
      <?php
      for ($i=1; $i<=$jml_atribut ; $i++) { 
      ?>
      <?php echo $atribut[$noatribut[$i]];
              $ini=$noatribut[$i];
        ?>
            <?php echo '<select class="form-control input-sm m-bot15" name="'.$ini.'">' ?>

             
              <?php
              if($ini==1){
              ?>
              <option value="0"><?php echo $parameter[$ini][0]?></option>
              <option value="1"><?php echo $parameter[$ini][1]?></option>
              <?php
              }else{ ?>
              <option value="1"><?php echo $parameter[$ini][1]?></option>
              <option value="2"><?php echo $parameter[$ini][2]?></option>
              <option value="3"><?php echo $parameter[$ini][3]?></option>
              <option value="4"><?php echo $parameter[$ini][4]?></option>
            <?php }?>
            </select>
       
           

      <?php
      }
      ?>
     
      <input style="margin-top: 20px;"class="btn btn-primary" type="submit" name="upload" value="Upload">


</div>
    </table>

  </form>
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

















