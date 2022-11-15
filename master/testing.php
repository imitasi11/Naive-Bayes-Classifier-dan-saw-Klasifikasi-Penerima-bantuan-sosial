<html>
<head>
	 
<script src="jquery.js"></script> 

    
    <script> 
    $(function(){
      $("#linkb").load("linkb.html"); 
    });
     function printContent(el){
    var restorepage = document.body.innerHTML;
    var printcontent = document.getElementById(el).innerHTML;
    document.body.innerHTML = printcontent;
    window.print();
    document.body.innerHTML = restorepage;
}
    </script> 

<?php 
include "koneksi.php";
$jml_atribut=0;
$count=1;
$ini="";
$isi=array();
$sql = 'SELECT * FROM nbc_atribut';
$result = $db->query($sql);
$atribut=array();
foreach ($result as $row) {
    $atribut[$row['id_atribut']]=$row['atribut'];
    $noatribut[$count]=$row['id_atribut'];
    $count=$count+1;
    $jml_atribut=$jml_atribut+1 ;
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
</head>
<body style="overflow-y : auto;">
	

  <!-- container section start -->
  <section id="container" class="">
    <div id="linkb"></div>
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper">
        <!-- page start-->
        <div class="row">
          <div class="col-sm-12">
          	<div class="tampildata"></div>
          </div></div>
          	<div class="row">
          <div class="col-sm-12">
            <section class="panel">
              <header class="panel-heading" align="center">
                Input Data
              </header>
              <table class="table table-striped">
                 		<form method="post" class="form-input" enctype="multipart/form-data">
                <thead>
                  <tr>
					<th>nama</th>
          <th>alamat</th>
						<?php 
						for($i=2;$i<=$jml_atribut;$i++){ 
 						   echo "<th>{$atribut[$noatribut[$i]]}</th>";
						}
						?>
					</tr>
                </thead>
                   <tbody>
                       <tr>
          		<td><input type="text" class="form-control" name="nama"></td>
              <td><input type="text" class="form-control" name="alamat"></td>
          		<?php
          		for($i=2;$i<=$jml_atribut;$i++){ 
          			?>
          		<td><?php $ini=$noatribut[$i];?>
          			<?php echo '<select class="form-control input-sm m-bot15" name="'.$ini.'">' ?>
          				<option value="1"><?php echo $parameter[$ini][1]?></option>
              			<option value="2"><?php echo $parameter[$ini][2]?></option>
              			<option value="3"><?php echo $parameter[$ini][3]?></option>
              			<option value="4"><?php echo $parameter[$ini][4]?></option>
              		</select>
          		</td>
          		<?php } ?>
			</tr>
			<tr>
				<td colspan="2"><button type="button" class="btn btn-success" id="simpan"> Simpan</button><a style="margin-left: 10px;" align="center" class="btn btn-primary" href="saw.php" class="SAW">RANK</a></td>
			</tr>
                  </tr>
                </tbody>
              </table>

            </section>
            
            <script type="text/javascript">
	$(document).ready(function(){
		$('.tampildata').load("data_testing/tampil.php");
		$("#simpan").click(function(){
			var data = $('.form-input').serialize();
			$.ajax({
				type: 'POST',
				url: "data_testing/aksi.php",
				data: data,
				success: function() {
					$('.tampildata').load("data_testing/tampil.php");
					document.getElementById("form-input").reset();
				}
			});
		});
	});
	</script>
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


