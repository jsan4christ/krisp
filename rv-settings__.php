<?php
/***********
See the NOTICE file distributed with this work for additional
information regarding copyright ownership.  Licensed under the Apache
License, Version 2.0 (the "License"); you may not use this file except
in compliance with the License. You may obtain a copy of the License
at http://www.apache.org/licenses/LICENSE-2.0 Unless required by
applicable law or agreed to in writing, software distributed under the
License is distributed on an "AS IS" BASIS, WITHOUT WARRANTIES OR
CONDITIONS OF ANY KIND, either express or implied. See the License for
the specific language governing permissions and limitations under the
License.
***************/
#Set up error reporting
ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);


require_once("autoload.php");
$leftIndent = 20;
$pageWidth = 1024;
$width = $pageWidth - $leftIndent;

$googleAnalyticsTrackerID = "UA-4841045-1";

//Get category to load

if(isset($_POST['cat_name']) && !empty($_POST['cat_name'])){
  $cat = $_POST['cat_name'];
 // var_dump($cat);die;
} 
else {
  $cat = 'Sequence Analysis';
}
/*if(isset($_GET['cat_name']) && !empty($_GET['cat_name'])){
    $cat = $_GET('cat_name');
    var_dump($cat);die;
} 
else {
    $cat = 'Sequence Analysis';
}
*/
function spacer($width = 1, $height = 1) {
  global $empty;
  
  return '<img src="'.$empty.'" alt="" width="'.$width.'" height="'.$height.'">';
}

##Site head and title  
function openDocument($title) {	
  // check whether we are using Windows versions of Internet
  // Explorer 5.5+
  $msie='/msie\s(5\.[5-9]|[6-9]\.[0-9]*).*(win)/i';
  $decentBrowser = ( 
  !isset($_SERVER['HTTP_USER_AGENT']) ||
  !preg_match($msie,$_SERVER['HTTP_USER_AGENT']) ||
  preg_match('/opera/i',$_SERVER['HTTP_USER_AGENT']));
  
  echo('<!DOCTYPE html>
  <html lang="en">
  <head>
		<title>KRISP '.$title.'</title>
		
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="bower_components/tether/dist/css/tether.min.css" rel="stylesheet">
    <link href="bower_components/jquery-typeahead/dist/jquery.typeahead.min.css" rel="stylesheet">
    <link href="css/bootstrap.css" rel="stylesheet">
    <!-- Custom styles for this template -->
		<link href="css/krisp.css" rel="stylesheet">
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet">
    <link href="css/font-awesome.css" rel="stylesheet">

    ');
  }
  
  ##Site key words
  function openKeywords($keywords){
    echo('<meta name="keywords" content="'.$keywords.'">');
  }
  
  ##Site description     
  function openDescription($description){
    echo('<meta name="description" content="'.$description.'">
  </head>
  <body>
    <?php include_once("analyticstracking.php") ?>
    <div class="container">');
    }
    
    #Facebook
    function facebook(){
      echo('<div id="fb-root"></div>
      <script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
        fjs.parentNode.insertBefore(js, fjs);
      }(document, "script", "facebook-jssdk"));</script>');
    }
    
    function sliding(){
      echo('');
    }
    function slidesimple() {
      echo('');
    }
    
    function slidingalto(){
      echo('');
    }
    
    function cat_menu($conexion){
      $sql = "SELECT DISTINCT cat_name FROM b_sw_cat";
      $stmt = $conexion->executeSQL($sql);
      if ($stmt->rowCount()){
        $cats = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach($cats as $cat_){
          echo '<li  class="" style=""> <a href="javascript:void(0);" class="tools-link cat_menu" cat="'.$cat_['cat_name'].'">'.$cat_['cat_name'].'</a> </li><!---->';
        }
      }
    }

    //Retrieve software by category
function cats($cat, $conexion){
  //var_dump($cat);die;
  $conexion = $conexion->conecta();
  #$sql = "SELECT sw.sw_id, sw.sw_name, sw.date_of_instn, sw.sw_url, sw.sw_desc, b.cat_name, b.subcat_name FROM b_installed_sw AS sw INNER JOIN (SELECT c.cat_id, c.cat_name, s.subcat_id, s.subcat_name FROM b_sw_cats AS c INNER JOIN b_sw_cat_subcats AS a ON c.cat_id = a.cat_id INNER JOIN b_sw_subcats AS s ON a.subcat_id = s.subcat_id) AS b ON sw.cat_id = b.cat_id AND sw.subcat_id = b.subcat_id WHERE cat_name = :cat_name"; 
  $sql = "SELECT sw.sw_id, sw.sw_name, cs.`cat_id`, ca.`cat_name`, cs.`subcat_id`, su.`subcat_name` 
  FROM b_installed_sw sw INNER JOIN (`b_sw_cat` ca INNER JOIN `b_sw_cat_subcat` cs ON ca.cat_id = cs.cat_id 
  INNER JOIN b_sw_subcat su ON su.subcat_id = cs.subcat_id) ON sw.cat_id = cs.cat_id AND sw.subcat_id = cs.subcat_id
  WHERE  cat_name = :cat_name
  ORDER BY ca.`cat_name`, su.`subcat_name`";
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
          echo'<div class="" style=""><h4 class="page-header clearfix">'.$subcat.'</h4> </div><!----><!---->';
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
  }

    function closeDocument() {
      //global $googleAnalyticsTrackerID;
      
      echo '</div>
      <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="bower_components/jquery/dist/jquery.min.js"></script>
        <script src="bower_components/tether/dist/js/tether.min.js"></script>
        <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="js/typeahead.js"></script>
        <script src="js/get-tool-info.js"></script>
        <script src="js/search-tool.js"></script>
        <!--Import required libraries-->
        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <script src="js/ie10-viewport-bug-workaround.js"></script>
        
          <!--[if lt IE 9]><script src="js/ie8-responsive-file-warning.js"></script><![endif]-->
          <script src="js/ie-emulation-modes-warning.js"></script>
          <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
          <!--[if lt IE 9]>	
            <script src="js/html5shiv.min.js"></script>
            <script src="js/respond.min.js"></script>
            
            <![endif]-->
            <script>
            $(document).ready(function () {
              /*$(".nav li").click(function(){
                $(".nav li").removeClass("active");
                $(this).addClass("active");
              });*/
              $(".cat_menu").click(function(e){
                e.preventDefault;
                var $this = $(this);
                /*alert($this.attr("cat"));/**/
                var cat_name=$this.attr("cat");
                /*alert(cat_name);*/
                $(".sec-content").load("db_scripts/load-tools.php",{cat_name:cat_name}, function(response, status, xhr){
                  if (status == "error") {
                    // alert(msg + xhr.status + " " + xhr.statusText);
                    console.log(msg + xhr.status + " " + xhr.statusText);
                  }
                  
                });
              })
            });
          </script>
            <script>	
              (function(i,s,o,g,r,a,m){i["GoogleAnalyticsObject"]=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
              })(window,document,"script","https://www.google-analytics.com/analytics.js","ga");
              
              ga("create", "UA-102620942-1", "auto");
              ga("send", "pageview");
            </script>
            <script>
            $(document).ready(function(){
              /*Hide the clear buttong on document load*/
              $(".searchclear").hide();
              /*Keep clear button hidden by defaul and only show when there is input to clear*/
              $("#txtSearchTool").keyup(function(){
                if ($(this).val()){
                  $(".searchclear").show();
                } else {
                  $(".searchclear").hide();
                }            
            });
              /*Clear search input*/
              $(".searchclear").click(function(){
                $("#txtSearchTool").val("");
                $(this).hide();
              });
          });
            </script>
          </body>
          </html> 
          ';
        }

        function esc_vals ($value){
          //escape get values to protect from xss
          return htmlspecialchars($value, ENT_QUOTES,'UTF-8');
        }
        
        function drawHeader($logopicture = NULL) {
          global $headingIndent;
          global $pageWidth;
          global $leftIndent;
          
          echo('
          <div class="row">
            <div class="col-md-3 col-xs-12"><img src="images/krisp_logo.png" width="100%" heigth="100%"></div>
            <div class="col-md-6 divhideresponsive"><img src="images/krisp_logo_name.png"></div>
          </div>
          <!-- Static navbar -->
          <nav class="navbar navbar-default">
            <div class="container-fluid">
              <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                </button>
              </div>
              <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                  <li class="active"><a href="index.php"><strong>HOME</strong></a></li>
                  <li><a href="blogs.php"><strong>BLOGS</strong></a></li>
                  <li><a href="news.php"><strong>NEWS</strong></a></li>
                  <li><a href="publications.php"><strong>PAPERS</strong></a></li>
                  <li><a href="projects.php"><strong>PROJECTS</strong></a></li>
                  <li><a href="http://www.krisp.org.za/news.php?id=192"><strong>SERVICES</strong></a></li>
                  <li><a href="talks.php"><strong>TALKS</strong></a></li>
                  <li><a href="people.php"><strong>TEAM</strong></a></li>
                  <li><a href="training.php"><strong>TRAINING</strong></a></li>
                  <li><a href="tools.php"><strong>TOOLS</strong></a></li>
                  <li><a href="toys.php"><strong>TOYS</strong></a></li>
                  <li><a href="videos.php"><strong>VIDEOS</strong></a></li>
                  <li><a href="search.php"><span class="glyphicon glyphicon-search" style="font-size:10px;"></span></a></li>
                </ul>
              </div><!--/.nav-collapse -->
            </div><!--/.container-fluid -->
          </nav>
          <!--<script src="js/vendor/jquery.min.js"></script>
          <script src="js/vendor/typeahead.js"></script>-->');}
        
        function drawHeader2($logopicture) {
          global $headingIndent;
          global $pageWidth;
          global $leftIndent;
          
          echo('
          <div class="row">
            <div class="col-md-3 col-xs-12"><img src="images/krisp_logo.png" width="100%" heigth="100%"></div>
            <div class="col-md-6 divhideresponsive"><img src="images/krisp_logo_name.png"></div>
            <div class="col-md-3 col-xs-12" style="margin-top: 15px;">
              <ul class="social-network social-circle">
                <li><a href="https://twitter.com/krisp_news" class="icoTwitter" title="Twitter"><i class="fa fa-twitter"></i></a></li>
                <li><a href="https://plus.google.com/+TuliodeOliveiraKRISP" class="icoGoogle" title="Google +"><i class="fa fa-google-plus"></i></a></li>
                <li><a href="https://www.youtube.com/user/bioafricaSATURN" class="icoYouTube" title="YouTube"><i class="fa fa-youtube"></i></a></li>
                <li><a href="#" class="icoFacebook" title="Facebook"><i class="fa fa-facebook"></i></a></li>
              </ul>
            </div>
          </div>
          ');
        }
        function drawHeaderART($logopicture) {
          global $headingIndent;
          global $pageWidth;
          global $leftIndent;
          
          echo('
          <!-- Static navbar -->
          <nav class="navbar navbar-default">
            <div class="container-fluid">
              <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                </button>
              </div>
              <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                  <li class="active"><a href="news.php"><strong>NEWS</strong></a></li>
                  <li><a href="people.php"><strong>TEAM</strong></a></li>
                  <li><a href="#"><strong>DNA TEST</strong></a></li>
                  <li><a href="#"><strong>SEQUENCING</strong></a></li>
                  <li><a href="training.php"><strong>TRAINING</strong></a></li>
                  <li><a href="projects.php"><strong>PROJECTS</strong></a></li>
                  <li><a href="#"><strong>PAPERS</strong></a></li>
                  <li><a href="#"><strong>TOYS</strong></a></li>
                  <li><a href="#"><strong>TOOLS</strong></a></li>
                  <li><a href="#"><strong>TALKS</strong></a></li>
                  <li><a href="#"><strong>BLOGS</strong></a></li>
                  <li><a href="#"><strong>VIDEOS</strong></a></li>
                  <li><a href="people.php?surname=de Oliveira"><strong>CONTACTS</strong></a></li>
                  <li><a href="#"><span class="glyphicon glyphicon-search" style="font-size:10px;"></span></a></li>
                </ul>
              </div><!--/.nav-collapse -->
            </div><!--/.container-fluid -->
          </nav>
          ');
        }
        function drawFooter($date) {
          echo('
          <footer role="contentinfo">
            <div class="footer">
              <center>KwaZulu-Natal Research Innovation and Sequencing Platform (KRISP), UKZN, Durban, South Africa. More info: <a href="http://krisp.org.za/people.php?surname=de%20Oliveira">Prof. Tulio de Oliveira</a> & <a href="http://krisp.org.za/people.php">KRISP team</a></center>
            </div>
            <div class="col-md-12 col-xs-12" style="margin-top: 15px;"><center>
              <ul class="social-network social-circle">
                <li><a href="https://twitter.com/krisp_news" class="icoTwitter" title="Twitter"><i class="fa fa-twitter"></i></a></li>
                <li><a href="https://plus.google.com/+TuliodeOliveiraKRISP" class="icoGoogle" title="Google +"><i class="fa fa-google-plus"></i></a></li>
                <li><a href="https://www.youtube.com/user/bioafricaSATURN" class="icoYouTube" title="YouTube"><i class="fa fa-youtube"></i></a></li>
                <li><a href="#" class="icoFacebook" title="Facebook"><i class="fa fa-facebook"></i></a></li>
              </ul></center>
            </div>
          </footer>');
        }
        
        function openBox($class="") {
          return '
          <table class="'.$class.'" width="1024" cellspacing="0" cellpadding="0">
            <tr>';
            }
            
            
            
            ##use this function to print out the values of arrays and variables during debugging.
            function debug_view ( $what ) {
              echo '<pre>';
                if ( is_array( $what ) )  {
                  print_r ( $what );
                } else {
                  var_dump ( $what );
                }
                echo '</pre>';
              }
              
              
              
              function photoGallery ($pict1,$pict2,$pict3,$pict4,$text1,$text2,$text3,$text4) {
                global $pageWidth;
                
                echo('
                <table class="picture" width="'.$pageWidth.'" align="center">
                  <tr><td class="picture">
                    <div class="gallerycontainer"><center>
                      <a class="thumbnail" href="#thumb">
                        <img src="i/'.$pict1.'_thumb.jpg" border="0" height="66" width="100"><span>
                          <img src="i/'.$pict1.'.gif"><br> '.$text1.'.</span></a>
                          
                          <a class="thumbnail" href="#thumb">
                            <img src="i/'.$pict2.'_thumb.jpg" border="0" height="66" width="100"><span>
                              <img src="i/'.$pict2.'.gif"><br> '.$text2.'.</span></a>
                              
                              <a class="thumbnail" href="#thumb">
                                <img src="i/'.$pict3.'_thumb.jpg" border="0" height="66" width="100"><span>
                                  <img src="i/'.$pict3.'.gif"><br> '.$text3.'.</span></a>
                                  
                                  <a class="thumbnail" href="#thumb">
                                    <img src="i/'.$pict4.'_thumb.jpg" border="0" height="66" width="100"><span>
                                      <img src="i/'.$pict4.'.gif"><br> '.$text4.'.</span></a>
                                    </div></span></center></td>
                                  </tr>
                                  <tr>
                                    <td class="picture"><br><br><br><br><br><br><center>
                                    </div>
                                    
                                  </div></td></tr></table>
                                  ');
                                  
                                }
                                
                                
                                ?>
                                
                                