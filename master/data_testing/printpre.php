<script src="../jquery.js"></script> 
    
    <script> 
    $(function(){
      $("#linkb").load("../linkb.html"); 
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
$layak = 0;
$tidaklayak = 0;
$nomor = 1;
$probtidaklayak= 0;
$problayak= 0;
$jml_atribut= 0;
$sum = 0;
$tambah= 0;

$isi=array();
include "../koneksi.php";
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

              <header class="panel-heading" align="center" style="margin-top: 13px;">
                TABEL DATA TESTING <br><br>
                    <a class="btn btn-primary" style="margin-right: 13px;" href="../testing.php">Kembali</a>
                 <a class="btn btn-primary" onclick="printContent('div1')" href="#">Print</a>
              </header>
              <div id="div1" style="height: 300px;" align="center">
              <table border="1px;" align="center" style="margin-top: 21px;">

                 
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
           </div>
           <script>
           
        
    </script>