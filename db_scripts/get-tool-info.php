<?php
require_once("../autoload.php");
$dbo = new Conexion();
$data = "";
if($_REQUEST['sw_id']) {
    $sw_id=$_REQUEST['sw_id'];
    #var_dump($sw_id);die;
    #$sql = "SELECT sw.sw_id, sw.sw_name, sw.date_of_instn, sw.sw_url,sw.sw_desc,b.cat_name,b.subcat_name FROM b_installed_sw AS sw  INNER JOIN (SELECT c.cat_id, c.cat_name, s.subcat_id, s.subcat_name FROM b_sw_cats AS c INNER JOIN b_sw_cat_subcats AS a ON c.cat_id = a.cat_id INNER JOIN b_sw_subcats AS s ON a.subcat_id = s.subcat_id) AS b ON sw.cat_id = b.cat_id AND sw.subcat_id = b.subcat_id WHERE sw_id=".$sw_id; 
    $sql= "SELECT *
    FROM `b_sw_inst_locn` as  lcn INNER JOIN (`b_installed_sw` as bis 
    INNER JOIN `b_sw_cats` as bsc ON bis.`cat_id` = bsc.`cat_id` 
    INNER JOIN `b_sw_subcats` as bss ON bis.`subcat_id` = bss.`subcat_id`) ON lcn.sw_id = bis.sw_id
    INNER JOIN b_servers as svr on lcn.svr_id = svr.svr_id
    WHERE  bis.sw_id=".$sw_id;
    
    $stmt = $dbo->executeSQL($sql);
    if($stmt->rowCount()){
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
echo json_encode($data);
?>