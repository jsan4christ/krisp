<?php
#Set up headings
require_once("rv-settings.php");

#Database connection class
$conexion = new Conexion();
#$bioafric_name = $_GET['surname'];
#$list =$_GET['list'];
/*
if(isset($_GET['cat_name']) && !empty($_GET['cat_name'])){
    $cat = $_GET('cat_name');
} 
else {
    $cat = 'Blast';
}*/


#Set up web page
openDocument($title = 'Tools');
openKeywords($keywords = 'Tools, Bioinformatics');
openDescription($description = 'Tools and software installed on our servers');
drawHeader();

#$toolsSQL = "SELECT sv.svr_id, sv.svr_name, sv.svr_addr, sv.svr_ip, sv.instns_to_access, sv.instns_to_req_acc, isw.* FROM b_servers AS sv INNER JOIN b_sw_inst_locn AS ln ON sv.svr_id = ln.svr_id INNER JOIN (SELECT sw.sw_id, sw.sw_name, sw.date_of_instn, sw.sw_url, sw.sw_desc, b.cat_name, b.subcat_name FROM b_installed_sw AS sw INNER JOIN (SELECT c.cat_id, c.cat_name, s.subcat_id, s.subcat_name FROM b_sw_cats AS c INNER JOIN b_sw_cat_subcats AS a ON c.cat_id = a.cat_id INNER JOIN b_sw_subcats AS s ON a.subcat_id = s.subcat_id) AS b ON sw.cat_id = b.cat_id AND sw.subcat_id = b.subcat_id) AS isw ON ln.sw_id = isw.sw_id";
$toolsSQL = "SELECT sw.sw_id, sw.sw_name, cs.`cat_id`, ca.`cat_name`, cs.`subcat_id`, su.`subcat_name` 
FROM b_installed_sw sw INNER JOIN (`b_sw_cat` ca INNER JOIN `b_sw_cat_subcat` cs ON ca.cat_id = cs.cat_id 
INNER JOIN b_sw_subcat su ON su.subcat_id = cs.subcat_id) ON sw.cat_id = cs.cat_id AND sw.subcat_id = cs.subcat_id
WHERE  1
ORDER BY ca.`cat_name`, su.`subcat_name`";
$tools_pdo = $conexion->executeSQL($toolsSQL);

if ($tools_pdo->rowCount()){
    $tools = $tools_pdo->fetchAll(PDO::FETCH_ASSOC);
}   
// $json_response = json_encode($tools);
// # Return the response
//print_r($json_response);
//exit();


$sql = "SELECT sw.sw_id, sw.sw_name, cs.`cat_id`, ca.`cat_name`, cs.`subcat_id`, su.`subcat_name` 
FROM b_installed_sw sw INNER JOIN (`b_sw_cat` ca INNER JOIN `b_sw_cat_subcat` cs ON ca.cat_id = cs.cat_id 
INNER JOIN b_sw_subcat su ON su.subcat_id = cs.subcat_id) ON sw.cat_id = cs.cat_id AND sw.subcat_id = cs.subcat_id
WHERE  1
ORDER BY ca.`cat_name`, su.`subcat_name` LIMIT 9;";
$stmt = $conexion->executeSQL($sql);
if($stmt->rowCount()){
    $latest = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>


    <!--Begin tools modal-->
    <div class="modal" tabindex="100" id="tools-modal" role="dialog" aria-label="">
    <div class="modal-dialog" role="document">
           
                <div class="modal-header"> 
                    <h3><span  id="sw_name"></span><i class="text-muted pull-right"><small><span  id=""></span></small></i></h3>
                </div> 
                
                <div class="modal-body">
                    <h5 style="font-weight: bolder;text-decoration: underline;">Software Details</h5>
                        <div>
                            <p class="text-muted" id="sw_cat"></p>
                            <p id="sw_desc" style="font-size: 1em">Description</p>
                            <p id="sw_url"></p><br>
                     </div>
                     <div>
                    <h5 style="font-weight: bolder;text-decoration: underline;">Installation and Usage Details</h5>
                   
                        <h6 style="font-weight: bold; font-style: italic;">Server Details (Name, install location, date installed):</h6>
                            <div id="server"></div>

                       <h6 style="font-weight: bold; font-style: italic;"><br />KRISP Experts (Installers and/or Users):</h6> 
                            <div id="sw_expert"></div>

                        <h6 style="font-weight: bold; font-style: italic;">Software Commands:</h6>
                            <div id="cmds_names"></div>
                    </div>      
                </div> 
                <div class="modal-footer"> 
                    <button class="btn btn-primary" type="button" data-dismiss="modal">close</button> 
                </div>
            </div>
        </div>
        <!--End tools modal-->
<div class="container">
    
    <p>A wide range of standard life science applications (many optimized for the HPC environment) and databases are available. Additional applications or databases can be hosted on request. Arrangements can also be made to secure proprietary data.</p>
    <div class="row">
        <!--Begin search tools section-->
        <div class="col-sm-4">
            <div class="panel panel-default">
                <div class="panel-heading" >
                    Search installed software
                </div>
                <div class="panel-body" ng-controller="SearchToolsController as tools">
                    <div search-tools="">
                        <div class="bgcolor">
                            
                            <input type="text" name="txtSearchTool" id="txtSearchTool" class="form-control input-sm" style="padding-right: 20px;" aria-autocomplete="list" aria-expanded="false" aria-owns="typeahead-31-4319" placeholder="search installed tools"/>
                            <span class="searchclear glyphicon glyphicon-remove-circle text-muted" style="position: absolute; top: 65px; right: 16px; cursor: pointer" ></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--End search tools section-->
        <!--Begin latest software section-->
        <div class="col-sm-8">
            <div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-title">
                            Latest Installed Software
                        </div>
                    </div>
                    <div class="panel-body">
                        <?php
                        //Bootsrap columns must be a factor of 12 (1,2,3,4,6,12)
                        $numOfCols = 3;
                        $rowCount = 0;
                        $bootstrapColWidth = 12 / $numOfCols;
                        ?>
                        <div class="row">
                            <?php
                            ##loop through the latest software array and populate panel
                            foreach ($latest as $row){
                                $sw_id = $row["sw_id"];
                                $sw_name = $row["sw_name"];
                                $catname = $row["cat_name"];
                                $subcatname=$row["subcat_name"];
                                
                                ?>  
                                <div class="col-md-<?php echo $bootstrapColWidth; ?>">
                                    <div class="thumbnail" style="border: 0;">
                                        <a href="#tool-modal" data-toggle="modal" id="tool" data-target="#tools-modal" data-id="<?php echo $sw_id;?>" data-backdrop="true" data-keyboard="true"><i class="fa fa-book"></i> <?php echo $sw_name;?></a><br />
                                        <?php echo $catname."/".$subcatname;?>
                                    </div>
                                </div>
                                <?php
                                $rowCount++;
                                if($rowCount % $numOfCols == 0) echo '</div><div class="row">';
                                }?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--End latest software section-->
        <!--Begin browse software section-->
        <div class="panel panel-default" ng-controller="BrowsInstalledSWController as BrowseSoftwares">
            <div class="panel-heading">
                <div class="panel-title">
                    Browse installed software
                </div>
            </div>
            <div class="panel-body">
                <div browse-tools="" tools="softwareVM.rpms">
                    <div class="container"> 
                        <div class="row">
                            <ul class="nav nav-pills nav-stacked col-sm-3 hidden-xs"> <!---->
                                <!--Function to load menu items-->
                                <?php software_cat_menu($conexion);?>
                                <!--End cat menu items-->
                            </ul>
                            <div class="col-xs-12 col-sm-8"> <!---->
                                <div class="sec-content">
                                    <!--start load tools to browse-->
                                    <?php software_by_cat($cat, $conexion); ?>   
                                    <!--end load tools to browse-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
  
    <!--End browse software section-->    
    <?php
    #Draw foot and close page.
    drawFooter("2017"); 
    closeDocument();
    ?>

    