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

	$bioafric_name = $_GET['surname'];
	$list =$_GET['list'];

	if ($bioafric_name != "") {
		openDocument($title);
		openKeywords($keywords);
		openDescription($description);
		drawHeader($logopicture);
		echo '<div class="row">';
		$result1_pdo = $conexion->executeSQL("SELECT * FROM b_people WHERE surname = '".$bioafric_name."' ORDER BY surname");	
		if ($result1_pdo->rowCount()){
			$result1 = $result1_pdo->fetchAll(PDO::FETCH_ASSOC);
			foreach ($result1 as $bioafric){
				$id = $bioafric["id"];
				$name = $bioafric["name"];
				$email = $bioafric["email"];
				$telephone = $bioafric["telephone"];
				$fax = $bioafric["fax"];
				$summary = $bioafric["summary"];
				$image = $bioafric["image"];
				$summary2 = $bioafric["summary2"];
				$surname = $bioafric["surname"];
				$initials = $bioafric["initials"];
				$photo2 = $bioafric["photo2"];
				
				$title = $name." ".$surname;
				$keywords = $surname;
				$description = $summary;
				
				//	draw_toolbar();
				echo '
					<div class="col-md-5 col-xs-12">
						<p><center><img src="../imagesBIO/'.$photo2.'"></center></p>
						<p><center><h3>About '.$name.' '.$surname.'</h3></p>
            			<p>'.$email.' '.$telephone.'</center></p>
					</div>
					<div class="col-md-7 col-xs-12">
						'.$summary2.'
					</div>
				';
			}
				echo '<div class="col-md-12 col-xs-12"><hr></div>';	

			
			### START  OF ALL VIDEOS ########
			
			$result4_pdo = $conexion->executeSQL("SELECT * FROM b_resources_video WHERE ( author LIKE '%".$surname."%') ORDER BY date DESC, id DESC LIMIT 10");
			if ($result4_pdo->rowCount()){
				$result4 = $result4_pdo->fetchAll(PDO::FETCH_ASSOC);
				echo '<div class="row">   
					<div class="col-md-2 col-xs-12 divhideresponsive heading"></div>
					<div class="col-md-10 col-xs-12 heading"><p>Videos</p></div>';
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
					echo '<div class="col-md-12 col-xs-12">
						<div class="col-md-2 col-xs-12">
							<p><center><a href="videos.php?id='.$id.'"><img src="../imagesBIO/'.$image.'"></a></p></center>
						</div>
						<div class="col-md-10 col-xs-12">
							<p><a href="videos.php?id='.$id.'"><b>'.$title.'</a></b> - YouTube - '.$date.' </p><br>
						</div>
					</div>';
				}
				echo '</div>';
			}
			echo '<div class="col-md-12 col-xs-12"><hr></div>';	

			### END  OF ALL VIDEOS ########
			
			#### Publications
			echo '<div class="row">';
			$result3_pdo = $conexion->executeSQL("SELECT * FROM b_publications WHERE authors LIKE '%".$surname." ".$initials."%' ORDER BY date DESC, id DESC LIMIT 200");	
			if ($result3_pdo->rowCount()){
				$result3 = $result3_pdo->fetchAll(PDO::FETCH_ASSOC);
				echo '
					<div class="col-md-2 col-xs-12 divhideresponsive heading"></div>
					<div class="col-md-10 col-xs-12 heading"><p>Publications</p></div>';
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
					
					echo '<div class="col-md-2 col-xs-12"><p><center>';
                    #### IF VIDEO EXIST
					echo'</div>
					<div class="col-md-10 col-xs-12">
						<p><a href="publications.php?pubid='.$id.'"><b>'.$title.'.</b></a>
						<br>'.$authors.', <b>'.$journal.'</b>  ('.$date.'), '.$volume.':'.$pages.'.</a></p><br>
					</div>'; 
				}
			}
				echo '<div class="col-md-12 col-xs-12"><hr></div>';	

			
			### START OF blogs #########
			openDocument('Blogs from Bioafrica and SATuRN websites');
			echo '<div class="row">';
			$result4_pdo = $conexion->executeSQL("SELECT * FROM b_blogs WHERE ( authors LIKE '%".$surname."%') ORDER BY date DESC");
			if ($result4_pdo->rowCount()){
				echo '
					<div class="col-md-2 col-xs-12 divhideresponsive heading"></div>
					<div class="col-md-10 col-xs-12 heading"><p>Blogs</p></div>';
				$result4 = $result4_pdo->fetchAll(PDO::FETCH_ASSOC);
				foreach ($result4 as $blogs){
					$id = $blogs["id"];
					$title = $blogs["title"];
					$authors = $blogs["authors"];
					$webpage = $blogs["webpage"];
					$journal = $blogs["journal"];
					$date = $blogs["date"];
					$image = $blogs["image"];
					$summary = $blogs["summary"];
					$file = $blogs["file"];
					echo '<div class="col-md-12 col-xs-12">
						<div class="col-md-2 col-xs-12">
							<center><img src="../imagesBIO/'.$image.'"><p>'.$journal.'</p></center>
						</div>
						<div class="col-md-10 col-xs-12"  style="min-height:120px;">
							<p><a href="blogs.php?id='.$id.'"><b>'.$title.'</b></a> - by '.$authors.' - '.$date.'</p>
						</div>
					</div>';
				}
			}
							echo '<div class="col-md-12 col-xs-12"><hr></div>';	

			
			### END  OF blogs #########
			
			### START  OF NEWS #########
			openDocument('News Section from Bioafrica and SATuRN websites');
			echo '<div class="row">';
			$result4_pdo = $conexion->executeSQL("SELECT * FROM b_news  WHERE (summary2 LIKE '%".$surname."%') ORDER BY date DESC");	
			if ($result4_pdo->rowCount()){
				echo '
					<div class="col-md-2 col-xs-12 divhideresponsive heading"></div>
					<div class="col-md-10 col-xs-12 heading"><p>News</p></div>';
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
					echo '<div class="col-md-12 col-xs-12">
						<div class="col-md-2 col-xs-12">
							<center>
								<p><img src="../imagesBIO/'.$image.'"></p>
							</center>
						</div>
						<div class="col-md-10 col-xs-12"  style="min-height:120px;">
							<p><a href="news.php?id='.$id.'"><b>'.$title.'</b></a> - '.$journal.' - '.$date.'</p><br>
						</div>
					</div>';
				}
			}
			echo '</div>';
			### END  OF ALL NEWS #########
		}
		
		
		### START OF INDIVIDUAL PEOPLE.PHP #########
	} else {
		openDocument('Team: Faculty, Scientists, Students and Innovators');
		openKeywords("KRISP team, Faculty, Scientists, Students and Innovators, post-doctoral, researchers, KwaZulu-Natal research innovation and sequencing platform");
		openDescription("KRISP team Faculty, Scientists, Students and Innovators want to challenge the status quo and create a scientific environment in (South) Africa that drives innovations in global health and reverses the brain drain. The way we challenge the status quo is by attracting, training and retaining both top (South) African scientists that understand the problem from the ground level and the best international minds that are committed to our vision");\
		drawHeader($logopicture);
		
		### START INTRODUCTION #########
		
		echo '<div class="row">
     	<div class="col-md-12 col-xs-12"><center><h3>FACULTY, SCIENTISTS, STUDENTS & INNOVATORS</h3>
     		<p>
We challenge the status quo by attracting, training & retaining both top African scientists that understand the problem from the ground level & the best international minds.
			</p>
     	</div>';
     	echo '<div class="col-md-9 col-xs-12"><h3><center>Team</center></h3>';
     	
     	$result4_pdo = $conexion->executeSQL("SELECT * FROM b_people WHERE member='current' ORDER BY surname ASC");	
		if ($result4_pdo->rowCount()){
			$result4 = $result4_pdo->fetchAll(PDO::FETCH_ASSOC);
			echo '<div class="row">';
			foreach ($result4 as $people){
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
				echo '<div class="col-md-12 col-xs-12">
					<div class="col-md-2 col-xs-12">
						<p><img src="../imagesBIO/'.$image.'"></p>
					</div>
					<div class="col-md-10 col-xs-12">
						<p><a href="people.php?surname='.$surname.'"><b>'.$name.' '.$surname.'</b></a></p>
						<p>'.$summary.'</p><br>
					</div>
				</div>';
			}
		} else {
			echo '<div class="col-md-12 col-xs-12">No news</div>';
		}	
		echo '</div></div>';
		### END  OF  #########
		
		echo '</td><td>';
		### START OF DEPARTED LIST #########
		echo '<aside class="col-md-3 col-xs-12"><h3><center>Former Team Members</center></h3>';	

		$result4_pdo = $conexion->executeSQL("SELECT *  FROM b_people WHERE member='departed' ORDER BY surname");
		if ($result4_pdo->rowCount()){
			$result4 = $result4_pdo->fetchAll(PDO::FETCH_ASSOC);
			echo '<div class="row">';
			foreach ($result4 as $departed){
				$id = $departed["id"];
				$name = $departed["name"];
				$email = $departed["email"];
				$summary = $departed["summary"];
				$member = $departed["member"];
				$surname = $departed["surname"];
				echo '
					<div class="col-md-12 col-xs-12">
						<p><h9><b> '.$name.' '.$surname.'</b></h9> - '.$summary.'</p>
					</div>
				';				
			}
		} else {
			echo '<div class="col-md-12 col-xs-12">No news</div>';
		}
		echo '</div></aside></div>';
	}
	drawFooter("2015"); 
	closeDocument();
	
	// subroutines
	
	// subroutines
	function get_Total() {
		global $db;
		$resource = mysql_query("SELECT sum(citations) FROM b_publications",$db);
		$number_citations = mysql_result($resource, 0); // only one cell in field
		return $number_citations;
	}
	
	function get_IF() {
		global $db;
		$resource = mysql_query("SELECT sum(impact) FROM b_publications",$db);
		$number_impact = mysql_result($resource, 0); // only one cell in field
		return $number_impact;
	}
	
	function get_HScore() {
		global $db;
		$resource = mysql_query("SELECT citations FROM b_publications order by citations DESC",$db);
		$number=mysql_num_rows($resource); 
		$number_Hscore = mysql_result($resource, ($number -($number - $resource)));
		// only one cell in field
		return $number_Hscore;
	}
