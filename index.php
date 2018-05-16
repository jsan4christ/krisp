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

require_once("rv-settings.php");

use Classes\Conexion;

$conexion = new Conexion();

if(!$bioafrica = $_GET['bioafrica']){
  $bioafrica = '';
};
if(!$list =$_GET['list']){
  $list = "";
};


### START OF webpage #########
openDocument("Kwazulu-Natal Research Innovation and Sequencing Platform");
openKeywords("KRISP, Kwazulu-Natal Research and Innovation Sequencing Platform, KwaZulu-Natal, Durban, South Africa, Research, Innovation, DNA, sequencing, bioinformatics, genomics, epidemiology, HIV, Africa, AIDS, research, south Africa, Tulio de Oliveira, UKZN, TIA, SAMRC, MRC, next generation sequencing, Nelson Mandela, School, Medicine, NGS, illumina");
openDescription("The Technology Innovation Agency (TIA) and UKZN have signed an agreement for the establishment of KRISP - the KwaZulu-Natal Research and Innovation Sequencing Platform. KRISP, the result of hard work by, among others, Professor Tulio de Oliveira, Professor Deresh Ramjugernath and Professor Salim Abdool Karim, was previously known as the Genomics and Bioinformatics Centre at UKZN, Nelson R Mandela School of Medicine, Durban, South Africa");

##Draw site header
drawHeader($logopicture="");

### START OLD BIOAFRICA.HTML#########
##Start content home
echo '<div class="row divhideresponsive">
<div class="col-md-12 col-xs-12">
<center><br><a href="http://krisp.org.za/toys.php">
<img src="../imagesBIO/featuredToys2.png" alt="KRISP Toys: Equipment available for collaborative research, training, diagnostics & sequencing services. DNA sequencers, PCR, qPCR, ddPCR, DNA/RNA extractors, Bioinformatics High-Processing Computers (HPC)"></a><br>
</center>
<br /><br /><hr>
</div>
</div>';

### START OF SPOTLIGHT NEWS #########
$result25_pdo = $conexion->executeSQL("SELECT * FROM b_news WHERE feature='Y' ORDER BY date DESC LIMIT 3");
echo '<div class="row">	<div class="col-md-12 col-xs-12"><h3><center>SPOTLIGHT</center></h3></div>';     
if ($result25_pdo->rowCount()){
  $result25 = $result25_pdo->fetchAll(PDO::FETCH_ASSOC);
  foreach ($result25 as $news){
    $id = $news["id"];
    $title = $news["title"];
    $webpage = $news["webpage"];
    $journal = $news["journal"];
    $date = $news["date"];
    $image = $news["image"];
    $summary = $news["summary"];
    $file = $news["file"];
    echo '<div class="col-md-4 col-xs-12">
    <center><a href="news.php?id='.$id.'"><img src="../imagesBIO/news'.$id.'feature.png"></a><br>
    <p>'.$journal.'</div>';			
  }
}
echo '<div class="col-md-12 col-xs-12"><center><h6><b><a href="spotlight.php">PREVIOUS SPOTLIGHTS</a></b></h6></center><hr></div>
</div>';	


### END  OF SPOTLIGHT ######### 

### START  OF NEWS ######### 
echo '<div class="row">
<div class="col-md-12 col-xs-12"><h3><center>KRISP NEWS</center></h3></div>';

$result4_pdo = $conexion->executeSQL('SELECT * FROM b_news ORDER BY date DESC LIMIT 7');	

if ($result4_pdo->rowCount()){
  $result4 = $result4_pdo->fetchAll(PDO::FETCH_ASSOC);
  foreach ($result4 as $news){
    $id = $news["id"];
    $title = $news["title"];
    $webpage = $news["webpage"];
    $journal = $news["journal"];
    $date = $news["date"];
    $image = $news["image"];
    $summary = $news["summary"];
    $file = $news["file"];
    echo '
    <div class="col-md-2 col-xs-12"><center><img src="../imagesBIO/'.$image.'" width=100" heigth="75"></center></div>
    <div class="col-md-10 col-xs-12"><p><a href="news.php?id='.$id.'"><b><h9>'.$title.'</a></h1></b><p>'.$summary.'</p></div>';				
  }
  
  
} else {
  echo '<div class="col-md-12 col-xs-12"><center>No news</center></div>';
  
}	
echo '<div class="col-md-12 col-xs-12"><center><h6><b><a href="news.php">MORE NEWS</a></b></h6></center><hr></div>
</div>';



### END  OF ALL NEWS ######### 

#### Publications
$result3_pdo = $conexion->executeSQL("SELECT * FROM b_publications WHERE bioafricaSATURN=1 OR  bioafricaSATURN=3 OR  bioafricaSATURN=5 ORDER BY date DESC, id DESC LIMIT 7");	

echo '<div class="row">
<div class="col-md-12 col-xs-12"><h3><center>KRISP PAPERS</center></h3></div>';
if ($result3_pdo->rowCount()){
  $result3 = $result3_pdo->fetchAll(PDO::FETCH_ASSOC);
  foreach ($result3 as $publication){
    $id = $publication["id"];
    $title = $publication["title"];
    $authors = $publication["authors"];
    $journal = $publication["journal"];
    $date = $publication["date"];
    $volume = $publication["volume"];
    $pages = $publication["pages"];
    $citations = $publication["citations"];
    $impact = $publication["impact"];
    
    echo '<div class="col-md-1 col-xs-12"><p><center>';
    #### IF VIDEO EXIST
    $result6_pdo = $conexion->executeSQL("SELECT * FROM b_resources_video WHERE pubid=$id ORDER BY id ASC");	
    if ($result6_pdo->rowCount()){
      $result6 = $result6_pdo->fetchAll(PDO::FETCH_ASSOC);
      foreach ($result6 as $video){
        $videoid = $video["id"];
        echo '<a href="videos.php?id='.$videoid.'"><img src="../imagesBIO/youtube6.png" alt="" style="border: 0px solid"></a>'; 
      }
    }
    echo'
    </div>
    <div class="col-md-11 col-xs-12">
    <p><a href="publications.php?pubid='.$id.'"><b>'.$title.'.</b></a>
    <br>'.$authors.', <b>'.$journal.'</b>  ('.$date.'), '.$volume.':'.$pages.'.</a></p><br>
    </div>';
  }
  
} else { 
  echo '<div class="col-md-12 col-xs-12"><p><center>No publications</center></p></div>';		
  
}	  
echo '<div class="col-md-12 col-xs-12"><center><h6><b><a href="publications.php">MORE PUBLICATIONS</a></b></h6></center><hr></div>
</div>';

### END  OF PUBLICATIONS ######### 


### START  OF ALL VIDEOS ######## 


$result14_pdo = $conexion->executeSQL("SELECT * FROM b_resources_video ORDER BY date DESC, id DESC LIMIT 1");	

echo '<div class="row">
<div class="col-md-12 col-xs-12"><h3><center>KRISP VIDEOS</center></h3></div>';
if ($result14_pdo->rowCount()){
  $result14 = $result14_pdo->fetchAll(PDO::FETCH_ASSOC);
  foreach ($result14 as $video){
    $id = $video["id"];
    $image = $video["pict"];
    $title = $video["title"];
    $author = $video["author"];
    $date = $video["date"];
    $duration = $video["duration"];
    $summary = $video["summary"];
    $pubid = $video["pubid"];
    $feature = $video["feature"];
    $file = $video["file"];
    $youtube = $video["youtube"];
    echo '<div class="col-md-6 col-xs-12 embed-container">
    <p><center><iframe src="http://www.youtube.com/embed/'.$youtube.'" frameborder="0" allowfullscreen></iframe></center></p>
      
      <p>'.$title.'<br>
      By: '.$author.'</p></div>';				
    }
    
  } else {
    echo '<div class="col-md-12 col-xs-12"><p><center>No videos</center></p></div>';		
    
  }	
  echo '<div class="col-md-6 col-xs-12">';	
  
  
  $result4_pdo = $conexion->executeSQL('SELECT * FROM b_resources_video ORDER BY date DESC, id DESC LIMIT 3');	
  if ($result4_pdo->rowCount()){
    $result4 = $result4_pdo->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result4 as $video){
      $id = $video["id"];
      $image = $video["pict"];
      $title = $video["title"];
      $author = $video["author"];
      $date = $video["date"];
      $duration = $video["duration"];
      $summary = $video["summary"];
      $pubid = $video["pubid"];
      $feature = $video["feature"];
      $file = $video["file"];
      $youtube = $video["youtube"];
      
      echo '<div class="col-md-4 col-xs-12">
      <a href="videos.php?id='.$id.'"><img src="../imagesBIO/'.$image.'"></a><br>
      </div>
      <div class="col-md-8 col-xs-12">
      <p>&nbsp;<a href="videos.php?id='.$id.'">'.$title.'</a></p>
      </div>
      <div class="col-md-12 col-xs-12"><hr></div>';				
    }
    echo "</div>";
  } else {
    
    echo '<div class="col-md-12 col-xs-12"><p><center>No videos</center></p></div>';		
    
  }	
  echo '<div class="col-md-12 col-xs-12"><center><h6><b><a href="videos.php">More video</a></b></h6></center><hr></div>
  </div>';
  
  ### END  OF ALL VIDEOS ######## 
  
  ### START OF CONTRIBUTORS & POPULAR #########
  
  echo '<div class="row">
  <div class="col-md-12 col-xs-12"><h3><center>KRISP TEAM</center></h3></div>';
  $result25_pdo = $conexion->executeSQL("SELECT *  FROM b_people WHERE member='current' ORDER BY surname LIMIT 12");
  if ($result25_pdo->rowCount()){
    $result25 = $result25_pdo->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result25 as $people){
      $id = $people["id"];
      $name = $people["name"];
      $email = $people["email"];
      $telephone = $people["telephone"];
      $fax = $people["fax"];
      $summary = $people["summary"];
      $image = $people["image"];
      $summary2 = $people["summary2"];
      $surname = $people["surname"];
      $initials = $people["initials"];
      $photo2 = $people["photo2"];
      $member = $people["member"];
      
      echo '
      <div class="col-md-5 col-xs-12">
      <p><img src="../imagesBIO/'.$image.'"><a href="people.php?surname='.$surname.'">   <b><h9>'.$name.' '.$surname.'</h9></b></p></a>
      </div>';
    }
  }
  echo '<div class="col-md-12 col-xs-12"><center><h6><b><a href="people.php">CURRENT AND PREVIOUS MEMBERS</a></b></h6></center><hr></div>
  </div>';	
  
  
  ### END  OF CONTRIBUTORS######## 		
	
  
  
  ### START OF BLOGS LIST LIMIT 3 #########
  
  echo '<div class="row">
  <div class="col-md-12 col-xs-12"><h3><center>KRISP BLOGS</center></h3></div>';
  $result5_pdo = $conexion->executeSQL('SELECT *  FROM b_blogs  ORDER BY date DESC LIMIT 3');	
  if ($result5_pdo->rowCount()){
    $result5 = $result5_pdo->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result5 as $blogs){
      $id = $blogs["id"];
      $authors = $blogs["authors"];
      $title = $blogs["title"];
      $image = $blogs["image"];
      $imagefront = $blogs["imagefront"];
      $summary = $blogs["summary"];	
      $date = $blogs["date"];
      echo '<div class="col-md-4 col-xs-12"><br><center><img src="../imagesBIO/'.$imagefront.'"><p>
      <h8>'.$authors.'</h8></p>
      <p><a href="blogs.php?id='.$id.'"><b><h9>'.$title.'</a></b></h9></div>';			
    }
    
		
  }
  
  echo '<hr><div>';	
  
  
  ### END  OF BLOGS ######### 
  
  ### START OF ALL BLOGS#########
  echo'<div class="row">
  <div class="col-md-12 col-xs-12"><h3><center>KRISP TOOLS</center></h3></div>';
  echo '<div class="col-md-9 col-xs-12">';
  $result4_pdo = $conexion->executeSQL("SELECT * FROM b_software WHERE type='typing' ORDER BY date DESC LIMIT 6");	
  if ($result4_pdo->rowCount()){
    $result4 = $result4_pdo->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result4 as $software){
      $id = $software["id"];
      $name = $software["name"];
      $date = $software["date"];
      $webpage = $software["webpage"];
      $version = $software["version"];
      $description = $software["description"];
      $image = $software["image"];
      $pubid = $software["pubid"];
      $summary = $software["summary"];
      $type = $software["type"];
      $feature = $software["feature"];
      echo '<div class="col-md-2 col-xs-12">
      <p>'.$date.'<br><h8>Version: '.$version.'</h8></p> 
      </div>
      <div class="col-md-2 col-xs-12">
      <p><center><a href="'.$webpage.'"><img src="../imagesBIO/'.$image.'"><br></a>
      </div>
      <div class="col-md-8 col-xs-12">
      <p><a href="'.$webpage.'">'.$name.'</a></p>
      <p>'.$summary.'</p><br>
      </div>';				
    }
  }
  echo '</div>';
  echo '<div class="col-md-3 col-xs-12">';
  ### START OF TWITTER ######### 
  echo'<p> <a class="twitter-timeline" width="300" href="https://twitter.com/krisp_news" data-widget-id="480643707209646081">Tweets by @krisp_news</a>
  <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?"http":"https";if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>';
    echo'<a href="https://twitter.com/krisp_news" class="twitter-follow-button" data-show-count="false" data-lang="en">Follow @krisp_news</a>
    <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>';
    ### END OF TWITTER #########
		echo '</div></div>';			
		### END  OF BLOGS ########
    ##End content home
    
    ##Draw site footer    		
    drawFooter("2015"); 
    #End document
    closeDocument();