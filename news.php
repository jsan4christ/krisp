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
	$conexion = new Conexion();

	$bioafrica = $_GET['bioafrica'];
	$list =$_GET['list'];
	$id = $_GET['id'];
			
	### START INDIVIDUAL NEWS WITH ID #########
	if ($id) {
		openKeywords($keywords);
		openDescription($topdescription);
		drawHeader($logopicture);
		
		$result4_pdo = $conexion->executeSQL('SELECT * FROM b_news where id='.$id.' ORDER BY date DESC');	
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
				$summary2 = $news["summary2"];
				$file = $news["file"];
				$bioafrica = $news["bioafricaSATuRN"];
				$keywords = $news["keywords"];
				$topdescription = $news["topdescription"];
				$pubid = $news["pubid"];

echo '<div class="row">
		<div class="col-md-9 col-xs-12"><h4><center>'.$title.'</center></h4>';
		
				echo '<div class="row">
					<div class="col-sm-offset-2 col-md-10">
					
						<p>'.$journal.'  - '.$date.'</p>
						<a href="https://twitter.com/share" class="twitter-share-button" data-via="drug_resistance" data-lang="en">Tweet</a>
						<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
						<div class="fb-share-button" data-href="http://www.bioafrica.net/news.php?id='.$id.'" data-width="50"></div>
						<div id="fb-root"></div>
						<script>
							(function(d, s, id) {
								var js, fjs = d.getElementsByTagName(s)[0];
								if (d.getElementById(id)) return;
								js = d.createElement(s); js.id = id;
								js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.0";
								fjs.parentNode.insertBefore(js, fjs);
							}(document, "script", "facebook-jssdk"));
						</script>
					</div>
					<div class="col-sm-offset-2 col-md-10">
						'.$summary.'
						<p>'.$summary2.'</p>
						<p><b>Links:</b></p><p><a href="'.$webpage.'">'.$webpage.'</a></p>';
			}
			openDocument('News: '.$title.'');
		}
		### PUBLICATIONS IF EXIST FOR THE NEWS PIECE
		if (!(is_null($pubid))){
			$result2_pdo = $conexion->executeSQL("SELECT * FROM b_publications WHERE id=".$pubid." ORDER BY date, id DESC");
			if ($result2_pdo->rowCount()){
				$result2 = $result2_pdo->fetchAll(PDO::FETCH_ASSOC);
				echo '<div class="row">';
				foreach ($result2 as $publication){
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
						<div class="col-md-12">
							Publication cited
						</div>
						<div class="col-md-3">
							<p><center><a href="publications.php?pubid='.$id.'"><img src="pdf.png" alt="" style="border: 0px solid ; width: 28px; height: 42px;"></center></a>
						</div> 
						<div class="col-md-9">
							<p>
								<a href="publications.php?pubid='.$id.'"><b>'.$title.'.</b></a>
								'.$authors.', <b>'.$journal.'</b>  ('.$date.'), '.$volume.':'.$pages.'.</a>
							</p>
						</div>';			
				}
				echo '</div>';
			}
		}
		
		echo '<div align="right"><a href="15minutes.php"><small>15 minutes, </small></a><a href="news.php"><small>All news</small></a>...</div>';
		### END INDIVIDUAL NEWS WITH ID #########
		
		echo '</div></div></div>';

		echo '<aside class="col-md-3 col-xs-12"><h5 class="heading"><center>Latest News</center></h5>';	
		### START OF NEWS LIST LIMIT 3 #########
		$result4_pdo = $conexion->executeSQL('SELECT * FROM b_news ORDER BY date DESC LIMIT 3');	
		echo '<div class="row">';
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
				echo '<div class="col-md-12">
					<a href="news.php?id='.$id.'"><br><b>'.$title.'</a></b>
					<h5>From '.$journal.', date: '.$date.' </h5>
				</div>';				
			}
		} else {
			echo '<div class="col-md-12">No news</div>';
		}	
		
		echo '<div align="right" class="col-md-12"><a href="15minutes.php"><small>15 minutes, </small></a><a href="news.php"><small>All news</small></a>...</div>';	
		### END  OF NEWS ######### 
		
		### START OF TWITTER ######### 
		echo'<div class="col-md-12">
			<p>
				<a class="twitter-timeline" width="300" data-dnt="true" href="https://twitter.com/drug_resistance" data-widget-id="287836532994342912">Tweets by @drug_resistance</a>
				<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?"http":"https";if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
			</p>';
		
		echo'<a href="https://twitter.com/drug_resistance" class="twitter-follow-button" data-show-count="true" data-lang="en">Follow @drug_resistance</a>
			<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>';
		echo '</div>';
		### END OF TWITTER ######### 
		
		echo'</div></aside></div>';
		
		### START OF ALL NEWS #########
	}else{
	
		openDocument('News: Articles, Media & TV Coverage on our work and its application in everyday life');
		openKeywords("news, press releases, printed, online, media coverage, newsletter, KRISP, South Africa, epidemiology, epigenetics, genomics, bioinformatics, twitter, coverage, training");
		openDescription("KRISP provides you with news articles, blogs and tweets on the key aspects of our bioinformatics, genomics, epigenomics, epidemiology and drug resistance work");
		drawHeader($logopicture);

		### START INTRODUCTION #########
		  			
		### START OF SPOTLIGHT #########

		echo '<div class="row">
     	<div class="col-md-12 col-xs-12"><h3><center>SPOTLIGHT</center></h3></div>';
     	
		$result25_pdo = $conexion->executeSQL("SELECT *  FROM b_news WHERE feature='Y' ORDER BY date DESC LIMIT 3");	
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
				echo '
					<div class="col-md-4 col-xs-12">
            			<p><center><a href="news.php?id='.$id.'"><img src="../imagesBIO/news'.$id.'feature.png"></a></p>
            			
            		</div>';
			}
		}
		echo '<div class="col-md-12 col-xs-12"><center><h6><b><a href="spotlight.php">PREVIOUS SPOTLIGHTS</a></b></h6></center><hr></div>
		</div>';	
		### END  OF SPOTLIGHT ######### 
		echo '<div class="row">';				
		### START  OF NEWS #########
		echo '<div class="col-md-12 col-xs-12"><h3><center>NEWS</center></h3></div>';
		
		$result4_pdo = $conexion->executeSQL('SELECT * FROM b_news ORDER BY date DESC');	
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
				echo '<div class="col-md-12">

					<div class="col-md-2 col-xs-12">
						<p><center><a href="news.php?id='.$id.'"><img src="../imagesBIO/'.$image.'" width=100" heigth="75"></a></center></p>
					</div>
					<div class="col-md-8 col-xs-12">
						<a href="news.php?id='.$id.'"><b>'.$title.'</a></b> - '.$date.'
						<p>'.$summary.'</p><br>
					</div>
				</div>';
			}
		} else {
			echo '<div class="col-md-12 col-xs-12"><center>No news</center></div>';	
		}
		echo '<div class="col-md-12 col-xs-12"><center><a href="news.php">MORE NEWS</a></center><hr></div>
				</div>';
		### END  OF ALL NEWS ######### 
		
		echo '<div class="row">
     	<div class="col-md-12 col-xs-12"><h3><center>MOST POPULAR</center></h3></div>';
     	
     	$result26_pdo = $conexion->executeSQL('SELECT * FROM b_news ORDER BY date DESC LIMIT 5');	
		if ($result26_pdo->rowCount()){
			$result26 = $result26_pdo->fetchAll(PDO::FETCH_ASSOC);
			$number = 1;
			foreach ($result26 as $news){
				$id = $news["id"];
				$title = $news["title"];
				$webpage = $news["webpage"];
				$journal = $news["journal"];
				$date = $news["date"];
				$image = $news["image"];
				$summary = $news["summary"];
				$file = $news["file"];
				echo '<div class="col-md-12 col-xs-12">
					<p><a href="news.php?id='.$id.'"><b><h10>'.$number.' &nbsp;&nbsp;&nbsp;'.$title.'</a></b></h10></center></p><br>
				</div>';
				++$number;
			}
		}
		
		echo '<hr></div>';
		
		### START OF BLOGS LIST LIMIT 3 #########
		echo '<div class="row">
     	<div class="col-md-12 col-xs-12"><h3><center>BLOG</center></h3></div>';
		  
		$result5_pdo = $conexion->executeSQL('SELECT * FROM b_blogs ORDER BY date DESC LIMIT 3');	
		if ($result5_pdo->rowCount()){
			$result5 = $result5_pdo->fetchAll(PDO::FETCH_ASSOC);
			foreach ($result5 as $blogs){
				$id = $blogs["id"];
				$authors = $blogs["authors"];
				$title = $blogs["title"];
				$image = $blogs["photo2"];
				$summary = $blogs["summary"];	
				$date = $blogs["date"];
				echo '
					<div class="col-md-4 col-xs-12">
						<center>
							<img src="../imagesBIO/'.$image.'" width="200" heigth="133">
							<p><h8>'.$authors.'</h8></p>
							<p><a href="blogs.php?id='.$id.'"><b><h9>'.$title.'</h9></b></a></p>
						</center>
					</div>';		
          
			}
		}
		echo '<div class="col-md-12 col-xs-12"><hr></div></div>';
		
		### END  OF BLOGS #########
	}
	drawFooter("2015"); 
	closeDocument();