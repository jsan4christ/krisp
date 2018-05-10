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
	include("rv-settings.php");
	
	$db = mysql_connect("localhost", "eq9gvt3l_web", "torincaleb14");

	mysql_select_db("eq9gvt3l_bioafric",$db);

	$bioafrica = $_GET['bioafrica'];
	$list =$_GET['list'];
	$id = $_GET['id'];
	

			
### START INDIVIDUAL NEWS WITH ID #########
	if ($id) {
	
			$result4 = mysql_query('SELECT *  FROM b_news where id='.$id.' ORDER BY date DESC',$db);	
			

		  
		if ($news = mysql_fetch_array($result4)) {	 		

		  
			do {
				$id = $news["id"];
				$title = $news["title"];
				$webpage = $news["webpage"];
				$journal = $news["journal"];
				$date = $news["date"];
				$image = $news["image"];
				$summary = $news["summary"];
				$summary2 = $news["summary2"];
				$file = $news["file"];
				$bioafrica = $news["bioafricaSATuRN"];
				$keywords = $news["keywords"];
				$topdescription = $news["topdescription"];
				$pubid = $news["pubid"];
			
			
				openDocument('News: '.$title.'');
				openKeywords($keywords);
				openDescription($topdescription);
				drawHeader($logopicture);
			
		### START INTRODUCTION #########
		echo '      
      <table class="intro" width="1024">
          <tr>
			<td><h2>News:</h2>

Here we provide you with news articles, blogs and tweets on the key aspects of our genomics, epigenomics, bioinformatics and training work.

<p>In this new section of the krisp.org.za website, we disseminate printed and online media coverage of our work and its application in everyday life.
</p><br>
		  </td></tr></table>';
							echo '      
      <table class="main" width="1024">
          <tr>
			<td class="heading">News </td>
			<td class="heading2">Latest News</td>
		  </tr>
		  <tr><td>';
 		### END INTRODUCTION #########

			
			echo '

     	<table class="main" width="700">
          <tr>
			<td width="120">
          <p><center><img src="imagesBIO/'.$image.'" width=100" heigth="75"><h3>'.$journal.'</h3></center></td>
          
          <td>
          
          <a href="news.php?id='.$id.'"><br><b>'.$title.'</a></h1></b>
          <h3>'.$journal.'  - '.$date.'</h3>
          
          <a href="https://twitter.com/share" class="twitter-share-button" data-via="drug_resistance" data-lang="en">Tweet</a>

	<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>

<div class="fb-share-button" data-href="http://www.bioafrica.net/news.php?id='.$id.'" data-width="50"></div>

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, "script", "facebook-jssdk"));</script>

          </td></tr>
          
          <tr>	
            
            
            
            <td></td><td>
           '.$summary.'
            <p>'.$summary2.'</p>
            <p><b>Links:</b></p><p><a href="'.$webpage.'">'.$webpage.'</a></p>            
          
            </td></tr>
          
          ';				
			} while ($news = mysql_fetch_array($result4));

		
			} else {
	
				
			}				
			
			
			### PUBLICATIONS IF EXIST FOR THE NEWS PIECE
			
			
		 $result2 = mysql_query("SELECT *  FROM b_publications WHERE id=$pubid ORDER BY date DESC, id DESC",$db);	

		if ($publication = mysql_fetch_array($result2)) {	 		

			do {
				$id = $publication["id"];
				$title = $publication["title"];
				$authors = $publication["authors"];
				$journal = $publication["journal"];
				$date = $publication["date"];
				$volume = $publication["volume"];
				$pages = $publication["pages"];
				$citations = $publication["citations"];
				$impact = $publication["impact"];



				echo '
		<table class="main">
        <tbody>
          <tr>
			<td class="heading2">Publication cited</td>
		  </tr>
				<tr>	
            <td>
            
        <table class="main" width="700">
          <tr>
			<td width="120">
          
            <p><center><a href="publications.php?pubid='.$id.'"><img src="pdf.png" alt="" style="border: 0px solid ; width: 28px; height: 42px;"></center></a></td> 
          <td><p><a href="publications.php?pubid='.$id.'"><b>'.$title.'.</b></a>
			'.$authors.', <b>'.$journal.'</b>  ('.$date.'), '.$volume.':'.$pages.'.</a>
          </td></tr></tbody></table></td></tr>';				
			} while ($publication = mysql_fetch_array($result2));

		
			} else {
	
				
			}

			
			echo '<tr><td align="right"><a href="15minutes.php"><small>15 minutes, </small></a><a href="news.php"><small>All news</small></a>...</td></tr></tbody></table>';	

	### END INDIVIDUAL NEWS WITH ID #########
		
echo '</td><td> ';

			
	### START OF NEWS LIST LIMIT 3 #########

		$result4 = mysql_query('SELECT *  FROM b_news ORDER BY date DESC LIMIT 3',$db);	
		
		echo ' 	<table class="intro">';
		
		if ($news = mysql_fetch_array($result4)) {
		
		  
			do {
				$id = $news["id"];
				$title = $news["title"];
				$webpage = $news["webpage"];
				$journal = $news["journal"];
				$date = $news["date"];
				$image = $news["image"];
				$summary = $news["summary"];
				$file = $news["file"];

				echo '

     
          <tr>
          <td>          
          <a href="news.php?id='.$id.'"><br><b>'.$title.'</a></h1></b></h4>
          <h5><b>From '.$journal.', date: '.$date.' </h5>
            </td></tr>
          
          ';				
			} while ($news = mysql_fetch_array($result4));

		
			} else {
	
	echo 'No news';		
				
			}	
				echo '<tr><td align="right"><a href="15minutes.php"><small>15 minutes, </small></a><a href="news.php"><small>All news</small></a>...</td></tr></tbody></table>';	
			
			
			### END  OF NEWS ######### 

			### START OF TWITTER ######### 
			
echo'<p>
<a class="twitter-timeline" width="300" data-dnt="true" href="https://twitter.com/drug_resistance" data-widget-id="287836532994342912">Tweets by @drug_resistance</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?"http":"https";if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
';

echo'

<a href="https://twitter.com/drug_resistance" class="twitter-follow-button" data-show-count="true" data-lang="en">Follow @drug_resistance</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
';


### END OF TWITTER ######### 

echo'</td></tr></table>';
	
	
	### START OF ALL NEWS #########
	
			}	else {
	
	
	



				openDocument('News Section, printed & online media on HIV & TB drug resistance, treatment, community engagement and bioinformatics in Africa - SATuRN and BioAfrica ');
				openKeywords("news, press releases, printed, online, media coverage, bioafrica, saturn, africa, bioinformatics, work");
				openDescription("Here we provide you with news articles, blogs and tweets on the key aspects of our bioinformatics and drug resistance work");
				drawHeader($logopicture);
			
			
			
		
		### START INTRODUCTION #########
		echo '      
 <table class="main" width="1024">
          <tr>
			<td><h7><center><p>SPOTLIGHTS</p></center></h7><br></td>
		  </tr></table>';	
		  			
		  			
						### START OF SPOTLIGHT #########

		echo ' 
		        <table class="tools" width="1024">

		  <tr><td>';     

$result25 = mysql_query("SELECT *  FROM b_news WHERE feature='Y' ORDER BY date DESC LIMIT 3",$db);	
		
	
			
		if ($news = mysql_fetch_array($result25)) {
		
			
			do {
				$id = $news["id"];
				$title = $news["title"];
				$webpage = $news["webpage"];
				$journal = $news["journal"];
				$date = $news["date"];
				$image = $news["image"];
				$summary = $news["summary"];
				$file = $news["file"];

			
				echo '
      	
            <td width="33%"><center><a href="news.php?id='.$id.'"><img src="imagesBIO/news'.$id.'feature.png"></a><p>
            <h8>'.$date.'</h8>
         </td>

          
          ';			
          
			} while ($news = mysql_fetch_array($result25));

		
			} else {
	
				
			}	echo '</tr></tr></tbody></table><br>';	
			
			
			### END  OF SPOTLIGHT 4 - 6 ######### 
						
		echo ' 
		        <table class="tools" width="1024">

		  <tr><td>';     

$result25 = mysql_query("SELECT *  FROM b_news WHERE feature='Y' ORDER BY date DESC LIMIT 3 OFFSET 3",$db);	
		
	
			
		if ($news = mysql_fetch_array($result25)) {
		
			
			do {
				$id = $news["id"];
				$title = $news["title"];
				$webpage = $news["webpage"];
				$journal = $news["journal"];
				$date = $news["date"];
				$image = $news["image"];
				$summary = $news["summary"];
				$file = $news["file"];

			
				echo '
      	
            <td width="33%"><center><a href="news.php?id='.$id.'"><img src="imagesBIO/news'.$id.'feature.png"></a><p>
            <h8>'.$date.'</h8>
         <br></td>

          
          ';			
          
			} while ($news = mysql_fetch_array($result25));

		
			} else {
	
				
			}	echo '</tr></tr></tbody></table><br>';	
			
			
			### END  OF SPOTLIGHT ######### 
			
						### END  OF SPOTLIGHT 7 - 11 ######### 
						
		echo ' 
		        <table class="tools" width="1024">

		  <tr><td>';     

$result25 = mysql_query("SELECT *  FROM b_news WHERE feature='Y' ORDER BY date DESC LIMIT 3 OFFSET 6",$db);	
		
	
			
		if ($news = mysql_fetch_array($result25)) {
		
			
			do {
				$id = $news["id"];
				$title = $news["title"];
				$webpage = $news["webpage"];
				$journal = $news["journal"];
				$date = $news["date"];
				$image = $news["image"];
				$summary = $news["summary"];
				$file = $news["file"];

			
				echo '
      	
            <td width="33%"><center><a href="news.php?id='.$id.'"><img src="imagesBIO/news'.$id.'feature.png"></a><p>
            <h8>'.$date.'</h8>
         </td>

          
          ';			
          
			} while ($news = mysql_fetch_array($result25));

		
			} else {
	
				
			}	echo '</tr></tr></tbody></table><br>';	
			
			
			### END  OF SPOTLIGHT ######### 
									### END  OF SPOTLIGHT 7 - 11 ######### 
						
		echo ' 
		        <table class="tools" width="1024">

		  <tr><td>';     

$result25 = mysql_query("SELECT *  FROM b_news WHERE feature='Y' ORDER BY date DESC LIMIT 3 OFFSET 9",$db);	
		
	
			
		if ($news = mysql_fetch_array($result25)) {
		
			
			do {
				$id = $news["id"];
				$title = $news["title"];
				$webpage = $news["webpage"];
				$journal = $news["journal"];
				$date = $news["date"];
				$image = $news["image"];
				$summary = $news["summary"];
				$file = $news["file"];

			
				echo '
      	
            <td width="33%"><center><a href="news.php?id='.$id.'"><img src="imagesBIO/news'.$id.'feature.png"></a><p>
            <h8>'.$date.'</h8>
         </td>

          
          ';			
          
			} while ($news = mysql_fetch_array($result25));

		
			} else {
	
				
			}	echo '</tr></tr></tbody></table><br>';	
			
			
			### END  OF SPOTLIGHT ######### 
		
		
											### END  OF SPOTLIGHT 7 - 11 ######### 
						
		echo ' 
		        <table class="tools" width="1024">

		  <tr><td>';     

$result25 = mysql_query("SELECT *  FROM b_news WHERE feature='Y' ORDER BY date DESC LIMIT 3 OFFSET 12",$db);	
		
	
			
		if ($news = mysql_fetch_array($result25)) {
		
			
			do {
				$id = $news["id"];
				$title = $news["title"];
				$webpage = $news["webpage"];
				$journal = $news["journal"];
				$date = $news["date"];
				$image = $news["image"];
				$summary = $news["summary"];
				$file = $news["file"];

			
				echo '
      	
            <td width="33%"><center><a href="news.php?id='.$id.'"><img src="imagesBIO/news'.$id.'feature.png"></a><p>
            <h8>'.$date.'</h8>
         </td>

          
          ';			
          
			} while ($news = mysql_fetch_array($result25));

		
			} else {
	
				
			}	echo '</tr></tr></tbody></table><br>';	
			
			
			### END  OF SPOTLIGHT ######### 
			### END  OF SPOTLIGHT 16 - 18 ######### 
						
		echo ' 
		        <table class="tools" width="1024">

		  <tr><td>';     

$result25 = mysql_query("SELECT *  FROM b_news WHERE feature='Y' ORDER BY date DESC LIMIT 3 OFFSET 15",$db);	
		
	
			
		if ($news = mysql_fetch_array($result25)) {
		
			
			do {
				$id = $news["id"];
				$title = $news["title"];
				$webpage = $news["webpage"];
				$journal = $news["journal"];
				$date = $news["date"];
				$image = $news["image"];
				$summary = $news["summary"];
				$file = $news["file"];

			
				echo '
      	
            <td width="33%"><center><a href="news.php?id='.$id.'"><img src="imagesBIO/news'.$id.'feature.png"></a><p>
            <h8>'.$date.'</h8>
         </td>

          
          ';			
          
			} while ($news = mysql_fetch_array($result25));

		
			} else {
	
				
			}	echo '</tr></tr></tbody></table><br>';	
			
			
			### END  OF SPOTLIGHT ######### 
			
						### END  OF SPOTLIGHT 16 - 18 ######### 
						
		echo ' 
		        <table class="tools" width="1024">

		  <tr><td>';     

$result25 = mysql_query("SELECT *  FROM b_news WHERE feature='Y' ORDER BY date DESC LIMIT 3 OFFSET 18",$db);	
		
	
			
		if ($news = mysql_fetch_array($result25)) {
		
			
			do {
				$id = $news["id"];
				$title = $news["title"];
				$webpage = $news["webpage"];
				$journal = $news["journal"];
				$date = $news["date"];
				$image = $news["image"];
				$summary = $news["summary"];
				$file = $news["file"];

			
				echo '
      	
            <td width="33%"><center><a href="news.php?id='.$id.'"><img src="imagesBIO/news'.$id.'feature.png"></a><p>
            <h8>'.$date.'</h8>
         </td>

          
          ';			
          
			} while ($news = mysql_fetch_array($result25));

		
			} else {
	
				
			}	echo '</tr></tr></tbody></table><br>';	
			
			
			### END  OF SPOTLIGHT ######### 
		
					### END  OF SPOTLIGHT 16 - 18 ######### 
						
		echo ' 
		        <table class="tools" width="1024">

		  <tr><td>';     

$result25 = mysql_query("SELECT *  FROM b_news WHERE feature='Y' ORDER BY date DESC LIMIT 3 OFFSET 21",$db);	
		
	
			
		if ($news = mysql_fetch_array($result25)) {
		
			
			do {
				$id = $news["id"];
				$title = $news["title"];
				$webpage = $news["webpage"];
				$journal = $news["journal"];
				$date = $news["date"];
				$image = $news["image"];
				$summary = $news["summary"];
				$file = $news["file"];

			
				echo '
      	
            <td width="33%"><center><a href="news.php?id='.$id.'"><img src="imagesBIO/news'.$id.'feature.png"></a><p>
            <h8>'.$date.'</h8>
         </td>

          
          ';			
          
			} while ($news = mysql_fetch_array($result25));

		
			} else {
	
				
			}	echo '</tr></tr></tbody></table><br>';	
			
			
			### END  OF SPOTLIGHT ######### 
						### END  OF SPOTLIGHT 16 - 18 ######### 
						
		echo ' 
		        <table class="tools" width="1024">

		  <tr><td>';     

$result25 = mysql_query("SELECT *  FROM b_news WHERE feature='Y' ORDER BY date DESC LIMIT 3 OFFSET 24",$db);	
		
	
			
		if ($news = mysql_fetch_array($result25)) {
		
			
			do {
				$id = $news["id"];
				$title = $news["title"];
				$webpage = $news["webpage"];
				$journal = $news["journal"];
				$date = $news["date"];
				$image = $news["image"];
				$summary = $news["summary"];
				$file = $news["file"];

			
				echo '
      	
            <td width="33%"><center><a href="news.php?id='.$id.'"><img src="imagesBIO/news'.$id.'feature.png"></a><p>
            <h8>'.$date.'</h8>
         </td>

          
          ';			
          
			} while ($news = mysql_fetch_array($result25));

		
			} else {
	
				
			}	echo '</tr></tr></tbody></table><br>';	
			
			
			### END  OF SPOTLIGHT ######### 
			
echo '</td></tr></tbody></table><table class="main" width="1024"><tr><td><center><h6><b><a href="news.php">ALL NEWS</a></b></h6></center><hr><br></td></tr></tbody></table>';
			}
			
			
      
    drawFooter("2017"); 
	closeDocument();