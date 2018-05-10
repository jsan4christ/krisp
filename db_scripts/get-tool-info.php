<?php
require_once("../autoload.php");
$dbo = new Conexion();
$data = "";
if($_REQUEST['sw_id']) {
    //Cast to int to protect against cross site scripting
    $sw_id= (int)$_REQUEST['sw_id'];
    #var_dump($sw_id);die;
    #$sql = "SELECT sw.sw_id, sw.sw_name, sw.date_of_instn, sw.sw_url,sw.sw_desc,b.cat_name,b.subcat_name FROM b_installed_sw AS sw  INNER JOIN (SELECT c.cat_id, c.cat_name, s.subcat_id, s.subcat_name FROM b_sw_cats AS c INNER JOIN b_sw_cat_subcats AS a ON c.cat_id = a.cat_id INNER JOIN b_sw_subcats AS s ON a.subcat_id = s.subcat_id) AS b ON sw.cat_id = b.cat_id AND sw.subcat_id = b.subcat_id WHERE sw_id=".$sw_id; 
    $sql= "SELECT sw.*, cs.`cat_id`, ca.`cat_name`, cs.`subcat_id`, su.`subcat_name`, xp.type, pp.name, pp.email, sv.svr_name, sv.svr_addr, ln.install_locn, ln.install_date, cm.cmd_id, cm.cmd_name 
FROM (b_installed_sw sw 
INNER JOIN (`b_sw_cat` ca INNER JOIN `b_sw_cat_subcat` cs ON ca.cat_id = cs.cat_id 
            INNER JOIN b_sw_subcat su ON su.subcat_id = cs.subcat_id) 
            ON  sw.cat_id = ca.cat_id AND sw.subcat_id = su.subcat_id) 
            LEFT JOIN (b_sw_expert xp INNER JOIN b_people pp ON xp.id = pp.id) ON xp.sw_id = sw.sw_id 
            LEFT JOIN (`b_server` sv INNER JOIN `b_sw_inst_locn` ln ON sv.svr_id = ln.svr_id) ON sw.sw_id = ln.sw_id
            LEFT JOIN (`b_cmd` cm INNER JOIN `b_sw_cmd` sc ON cm.cmd_id = sc.cmd_id) ON sc.sw_id = sw.sw_id
WHERE  sw.sw_id='".$sw_id."'
ORDER BY cs.cat_id, su.subcat_id, sw.sw_id, cm.cmd_id";
    $stmt = $dbo->executeSQL($sql);
    //create variables and arrays to hold work with
    $dataReturn = array();
    $cmdName = "";
    $cmdId = "";
    $swName = "";
    $swId = "";
    $swUrl = "";
    $swDesc = "";
    $subcatId = "";
    $catId = "";
    $subcatId = "";
    $subcatName = "";
    $type = "";
    $name = "";
    $email = "";
    $svrName = "";
    $svrAddr="";
    $installLocn = "";
    $installDate = "";
    $serverName = array();
    $serverInfo = array();
    $comandName = array();
    $nameCheck = array();
    $emailCheck = array();

    //if the sql statement returned rows
    if($stmt->rowCount()){
        //Assigned the data returned to var data
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach($data as $d){
            if ($swName == $d["sw_name"]){
                if (!(in_array($d["cmd_name"], $comandName))){
                    $cmdName .= "<br>".$d["cmd_name"];
                    $comandName[] = $d["cmd_name"];
                }
                if (!(in_array($d["svr_name"], $serverName))){
                    $svrName .= $d["svr_name"]." [ ". $d["svr_addr"]." in ". $d["install_locn"] ." on ". $d["install_date"]."]<br />";
                    $serverName[] = $d["svr_name"];
                }
                if (!(in_array($d["name"], $nameCheck))){
                    $name .= $d["name"]." - ". $d["email"]." - ". $d["type"]."<br />";
                    $nameCheck[] = $d["name"];
                }
                $cmdId .= "<br>".$d["cmd_id"];
            }else{
                $swName = $d["sw_name"];
                $cmdName = $d["cmd_name"];
                $comandName[] = $d["cmd_name"];
                $cmdId = $d["cmd_id"];
                $swId = $d["sw_id"];
                $swUrl = $d["sw_url"];
                $swDesc = $d["sw_desc"];
                $subcatId = $d["subcat_id"];
                $catName = $d["cat_name"];
                $catId = $d["cat_id"];
                $subcatId = $d["subcat_id"];
                $subcatName = $d["subcat_name"];
                $name .= $d["name"]." - ". $d["email"]." - ". $d["type"]."<br>";
                $nameCheck[] = $d["name"];
                $emailCheck[] = $d["email"];
                $svrName .= $d["svr_name"]." [ ". $d["svr_addr"]." in ". $d["install_locn"] ." on ". $d["install_date"]."]<br />";
                $serverName[] = $d["svr_name"];
                $installLocn = $d["install_locn"];
                $installDate = $d["install_date"];
            }

        }
        $dataReturn = array(
            "sw_name"=>$swName,
            "cmd_name"=>$cmdName,
            "cmd_id"=>$cmdId,
            "sw_id"=>$swId,
            "sw_url"=>$swUrl,
            "sw_desc"=>$swDesc,
            "cat_name"=>$catName,
            "cat_id"=>$catId,
            "subcat_id"=>$subcatId,
            "subcat_name"=>$subcatName,
            "name"=>$name,
            "svr_name"=>$svrName,
            "install_locn"=>$installLocn
        );
    }
}
echo json_encode($dataReturn);
?>