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
            <h3 class="page-header"><i class="fa fa-file-text-o"></i> INPut data kriteria</h3>
            <section class="panel" style="padding-left: 400px;padding-top: 34px;">
              <div style="width: 60%; border-style: solid;padding: 40px; ">
  <form action="input-aksi.php" method="post" enctype="multipart/form-data">    
    <table>
      Nama
          <input type="text" class="form-control" name="nama"><br>
        Parameter1
          <input type="text" class="form-control" name="1"><br>
        Parameter2
          <input type="text" class="form-control" name="2"><br>
        Parameter3
          <input type="text" class="form-control" name="3"><br>
        Parameter4
          <input type="text" class="form-control" name="4"><br>
        Benefit / Cost
          <select name="bencos" class="form-control input-sm m-bot15">
            <option value="benefit">BENEFIT</option>
            <option value="cost">COST</option>
          </select>
        <input class="btn btn-primary" style="margin-top: 20px;" type="submit" name="upload" value="Upload"></td>         
       
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

















