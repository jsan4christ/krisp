<?php

#Set up headings
require_once("rv-settings.php");

#Composer name spaces for classes to use in this page
#use PHPMailer\PHPMailer\PHPMailer;
#use PHPMailer\PHPMailer\Exception;
use Classes\Conexion;
use Classes\Email;
use PHPMailer\PHPMailer\PHPMailer;

#Database connection class
$conexion = new Conexion();
$mailer = new PHPMailer(true);

#connect to the database
$dbo = $conexion->conecta(); 

#Cat query
$catSQL = "SELECT * FROM `b_sw_cat`";
$catStmt = $conexion->executeSQL($catSQL);
$cats = $catStmt->fetchAll(PDO::FETCH_ASSOC);

#subcats query
$subcatsSql = "SELECT * FROM `b_sw_subcat`";
$subcatStmt = $conexion->executeSQL($subcatsSql);
$subcats = $subcatStmt->fetchAll(PDO::FETCH_ASSOC);

#Servers query
$svrSQL = "SELECT svr_id, svr_name FROM `b_server`";
$svrStmt = $conexion->executeSQL($svrSQL);
$servers = $svrStmt->fetchAll(PDO::FETCH_ASSOC);

#Set up web page
openDocument($title = 'Request Software Installation');
openKeywords($keywords = 'Software, Tools, Bioinformatics');
openDescription($description = 'Request software installation');
drawHeader();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $fullName = $_POST['fullname'];
    $email =$_POST['email'];
    $swName = $_POST['swName'];
    $swUrl = $_POST['swUrl'];
    $swDesc = $_POST['swDesc'];
    $swCat = $_POST['category'];
    $swSubcat = $_POST['subcategory'];
    $swSvr = $_POST['svr'];
    $purpose = $_POST['purpose'];
    $moreInfo = $_POST['moreInfo'];
    $status = $_POST['status'];
    $sql = "INSERT INTO `b_requested_sw` ( `full_name`,`email`,  `sw_name`, `sw_url`, `sw_desc`, `cat_id`, `subcat_id`, `server`, `purpose`, `more_info`, `status`) 
    VALUES ( :fullName, :email,  :swName, :swUrl, :swDesc, :category, :subcategory, :svr, :purpose, :moreInfo, :req_status)";
    
    $stmt = $dbo->prepare($sql); //prepare statement
    //bind params
    $stmt->bindParam(':fullName', $fullName);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':swName', $swName);
    $stmt->bindParam(':swUrl', $swUrl);
    $stmt->bindParam(':swDesc', $swDesc);
    $stmt->bindParam(':category', $swCat);
    $stmt->bindParam(':subcategory', $swSubcat);
    $stmt->bindParam(':purpose', $purpose);
    $stmt->bindParam(':svr', $swSvr);
    $stmt->bindParam(':moreInfo', $moreInfo);
    $stmt->bindParam(':req_status', $status);

    #Commit data to database
    $stmt->execute();

    $message = "Dear {$fullName},
    Your request to install {$swName} has been submitted.
    
    We shall follow up with you via email in regard to the processing of your request.
    
    With kind regards.
    Admin";

    #Send out confirmation email
    $SendMail = new Email($mailer);
    $SendMail->EnviaEmail($email,'',$fullName, '', $message);

    }

?>
<div class="container">
    <p>Use the form below to request installation of software. Before filling in the form, use the search functionality on the tools page to ensure the software is not already installed.</p>
    <div class="row">
        <!--Begin browse software section-->
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panel-title">
                    Request Software Installation
                </div>
            </div>
            <div class="panel-body">
                <div browse-tools="" >
                    <div class="container"> 
                        <div class="row">
                            <div class="col-xs-12 col-sm-8"> <!---->
                                <div class="sec-content">
                                    <!--start load tools to browse-->
                                    <form action="<?php htmlentities($_SERVER['PHP_SELF']) ?>" method="POST">
                                            <div class="form-group">
                                                <label for="swName">Full Name</label>
                                                <input type="text" class="form-control" id="swName" aria-describedby="swNameHelp" placeholder="Please enter your full name here" name="fullname">
                                                <small id="emailHelp" class="form-text text-muted">Full name of software requester</small>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="email">Email Address</label>
                                                <input type="email" name="email" class="form-control" aria-describedby="emailHelp" placeholder="email@example.com">
                                                <small id="emailHelp">Please enter a valid email address so we can follow up on your request</small>
                                            </div>
   
                                            <div class="form-group">
                                                <label for="swName">Software Name</label>
                                                <input type="text" class="form-control" id="swName" aria-describedby="swNameHelp" placeholder="Enter Software Name" name="swName">
                                                <small id="swNameHelp" class="form-text text-muted">Name of software to install</small>
                                            </div>

                                            <div class="form-group">
                                                <label for="swDesc">Description</label>
                                                <input type="text" class="form-control" id="swDesc" name="swDesc" aria-describedby="descHelp" placeholder="Provide a description of the software requested">
                                            </div>

                                            <div class="form-group">
                                                <label for="swUrl">URL</label>
                                                <input type="url" class="form-control" id="swUrl" name="swUrl" placeholder="Software Url">
                                            </div>

                                            <div class="form-group">
                                                <label for="FormControlSelectCat">Category</label>
                                                <select class="form-control" name="category" id="categoryFormControlSelect">
                                                <?php foreach($cats as $cat): ?>
                                                    <option value="<?php echo $cat['cat_id']?>"><?php echo $cat['cat_name']; ?></option>
                                                <?php endforeach?>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="FormControlSubcat">Subcategory</label>
                                                <select class="form-control" name="subcategory" id="subcategoryFormControlSelect">
                                                <?php foreach($subcats as $sc):?>
                                                    <option value="<?php echo $sc['subcat_id']?>"><?php echo $sc['subcat_name'];?></option>
                                                <?php endforeach?>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="server">Server</label>
                                                <select class="form-control" name="svr" id="FormControlSelectServer">
                                                    <?php foreach($servers as $svr):?>
                                                        <option value="<?php echo $svr['svr_id']?>"><?php echo $svr['svr_name'];?></option>
                                                     <?php endforeach?>
                                                    </select>                                                
                                                    <small id="serverHelp" class="form-text text-muted">Name of server in which to install</small>
                                            </div>

                                             <div class="form-group">
                                                <label for="purpose">Purpose of software requested</label>
                                                <input type="text" name="purpose" id="purpose" class="form-control" placeholder="Purpose of request">
                                            </div>

                                            <div class="form-group">
                                                <label for="moreInfo">More Information</label>
                                                <input type="text" class="form-control" id="moreInfo" name="moreInfo" aria-describedby="moreInfoHelp" placeholder="Provide any additional information">
                                                <small id="moreInfoHelp" class="form-text text-muted">Provide any additional information to help us expedite your request e.g timelines</small>
                                            </div>

                                            <input type="hidden" name="status" value="New">
                                            
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                    </form>
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

    