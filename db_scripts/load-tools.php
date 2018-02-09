<?php
//var_dump($cat);die;
require_once("../autoload.php");
$cat = $_POST["cat_name"];
$conexion = new Conexion();
$conexion = $conexion->conecta();
$sql = "SELECT * FROM `b_sw_inst_locn` as  lcn INNER JOIN (`b_installed_sw` as bis INNER JOIN `b_sw_cats` as bsc ON bis.`cat_id` = bsc.`cat_id` INNER JOIN `b_sw_subcats` as bss ON bis.`subcat_id` = bss.`subcat_id`) ON lcn.sw_id = bis.sw_id INNER JOIN b_servers as svr on lcn.svr_id = svr.svr_id WHERE cat_name = :cat_name ORDER BY bsc.`cat_name`, bss.`subcat_name`, bis.sw_name ASC";
//"SELECT sw.sw_id, sw.sw_name, sw.date_of_instn, sw.sw_url, sw.sw_desc, b.cat_name, b.subcat_name FROM b_installed_sw AS sw INNER JOIN (SELECT c.cat_id, c.cat_name, s.subcat_id, s.subcat_name FROM b_sw_cats AS c INNER JOIN b_sw_cat_subcats AS a ON c.cat_id = a.cat_id INNER JOIN b_sw_subcats AS s ON a.subcat_id = s.subcat_id) AS b ON sw.cat_id = b.cat_id AND sw.subcat_id = b.subcat_id WHERE cat_name = :cat_name"; 
//echo $sql; 
$stmt = $conexion->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
$stmt->execute(array(':cat_name' => $cat));
$results = $stmt->fetchAll();

$cat="";
$subcat = "";
$numOfCols = 3;
$rowCount = 0;
$bootstrapColWidth = 12 / $numOfCols;
$closeDiv = false;
foreach($results as $row){
    if ($row["cat_name"] != $cat){
        if ($closeDiv == true){
            echo "</div>";
        }
        $cat = $row["cat_name"];
        echo '<h3 class="page-header" style="color: black">'.$cat.'</h3><!----> <!---->';
        #echo "<h2>".$cat."</h2>";
    }
    if ($row["subcat_name"] != $subcat){
        if ($closeDiv == true){
            echo "</div>";
        }
        $subcat = $row["subcat_name"];
        echo'<div class="" style=""><h4 class="page-header clearfix">'.$subcat.'</h4> <!----><!---->';
        #echo "<h3>".$subcat."</h3>";
        echo '<div class="row">';
        $closeDiv = true;

    }
    //Bootsrap columns (must be a factor of 12 (1,2,3,4,6,12)
   

    echo '<div class="col-md-'.$bootstrapColWidth.'">
        <div class="thumbnail" style="border: 0;">
            <a href="#tool-modal" data-toggle="modal" id="tool" data-target="#tools-modal" data-id='.$row["sw_id"].' data-backdrop="true" data-keyboard="true"><i class="fa fa-book"></i> '.$row["sw_name"].'</a>
        </div>
    </div>';
}