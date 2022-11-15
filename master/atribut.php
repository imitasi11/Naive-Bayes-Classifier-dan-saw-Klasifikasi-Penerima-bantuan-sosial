<html>
<head>
 
<script src="jquery.js"></script> 
    
    <script> 
    $(function(){
      $("#linkb").load("linkb.html"); 
    });
    </script> 
   
<?php 
$jml_atribut=0;
$count =1;
$isi=array();
include "koneksi.php";


$sql = 'SELECT * FROM nbc_atribut ORDER BY id_atribut';
$result = $db->query($sql);
//-- menyiapkan variable penampung berupa array
$atribut=array();
$noatribut=array();
$bencost=array();
//-- melakukan iterasi pengisian array untuk tiap record data yang didapat
foreach ($result as $row) {
    $atribut[$row['id_atribut']]=$row['atribut'];
    $noatribut[$count]=$row['id_atribut'];
    $bencost[$row['id_atribut']]=$row['bencost'];
    $count=$count+1;
    $jml_atribut=$jml_atribut+1 ;
    }
//-- query untuk mendapatkan semua data atribut di tabel nbc_atribut

?>
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
          <div class="col-sm-12">
            <section class="panel">
              <header class="panel-heading">
                TABEL DATA Kriteria<br>
                <p align="right">
               <a class="btn btn-success" href="data_atribut/input.php">Tambah Data</a>
              </p>
              </header>
              
              <table class="table table-striped">
                 
                <thead>
                  <tr>
                    <th>id atribut</th>
                    <th>atribut</th>
                    <th>benefit/cost</th>
                    <th colspan="2" align="center" style="text-align:center">aksi</th>
                </tr>
                </thead>
                   <tbody>
                    <?php 
                for($i=2;$i<=$jml_atribut;$i++){ 
                ?>
                    <td><?php echo $noatribut[$i]?></td>
                    <td><?php echo $atribut[$noatribut[$i]]?></td>
                    <td><?php echo $bencost[$noatribut[$i]]?></td>
                    <td align="center" style="text-align:center"><a class="btn btn-primary" href="data_atribut/edit.php?id=<?php echo $noatribut[$i]; ?>">edit</a></td>
                    <td align="center" style="text-align:center"><a class="btn btn-danger" href="data_atribut/hapus.php?id=<?php echo $noatribut[$i]; ?>">                delete</a></td>
                </tr>
                <?php
                }
                ?>
                </tbody>
              </table>
            </section>
          </div>
        </div>
        <!-- page end-->
      </section>
    </section>
    <!--main content end-->
    <div class="text-right">
      <div class="credits">
          <!--
            All the links in the footer should remain intact.
            You can delete the links only if you purchased the pro version.
            Licensing information: https://bootstrapmade.com/license/
            Purchase the pro version form: https://bootstrapmade.com/buy/?theme=NiceAdmin
          -->
          Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
        </div>
    </div>
  </section>

</body>
</html>
