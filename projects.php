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
		echo '<div class="row">';
		$result4_pdo = $conexion->executeSQL('SELECT * FROM b_projects where id='.$id.' ORDER BY date DESC');	
		if ($result4_pdo->rowCount()){
			$result4 = $result4_pdo->fetchAll(PDO::FETCH_ASSOC);
			foreach ($result4 as $project){
				$id = $project["id"];
				$title = $project["title"];
				$webpage = $project["webpage"];
				$short = $project["short"];
				$date = $project["date"];
				$image = $project["image"];
				$summary = $project["summary"];
				$people = $project["people"];
				$funder = $project["funder"];
				$expertise = $project["expertise"];
			
				openDocument('Project: '.$title.'');
				echo '
					<div class="col-md-12 col-xs-12">
						<br><p><a href="krispindex.php">Home</a> / <a href="researchdevelopment.php">Research & Development</a> / <a href="projects.php">Projects</a> / '.$short.'</p><br>
					</div>
					<div class="col-md-12 col-xs-12">
						<div class="col-md-2 col-xs-12">
							<img src="../imagesBIO/'.$image.'" align="right">
						</div>
						<div class="col-md-10 col-xs-12">
							<h4>'.$title.'</h4>
						</div>
					</div>
					<div class="col-md-12 col-xs-12">
						<div class="col-md-2 col-xs-12">
							<p><b>KRISP leader</b></p>
						</div>
						<div class="col-md-10 col-xs-12">
							<p>'.$people.'</p>
						</div>
					</div>
					<div class="col-md-12 col-xs-12">
						<div class="col-md-2 col-xs-12">
							<p><b>Short title</b></p>
						</div>
						<div class="col-md-10 col-xs-12">	
							<p>'.$short.'</p>
						</div>
					</div>
					<div class="col-md-12 col-xs-12">
						<div class="col-md-2 col-xs-12">
							<p><b>KRISP expertises</b></p>
						</div>
						<div class="col-md-10 col-xs-12">
							<p>'.$expertise.'</p>
						</div>
					</div>
					<div class="col-md-12 col-xs-12">
						<div class="col-md-2 col-xs-12">	
							<p><b>Project summary</b></p>
						</div>
						<div class="col-md-10 col-xs-12">
							<p>'.$summary.'</p>
						</div>
					</div>
					<div class="col-md-12 col-xs-12">
						<div class="col-md-2 col-xs-12">	
							<p><b>Webpage</b></p>
						</div>
						<div class="col-md-10 col-xs-12">
							<p>'.$webpage.'</p>
						</div>
					</div>
					<div class="col-md-12 col-xs-12">
						<div class="col-md-2 col-xs-12">	
							<p><b>Funder</b></p>
						</div>
						<div class="col-md-10 col-xs-12">
							<p>'.$funder.'</p>
						</div>
					</div>
				';
			
			}
		}
		
		### PUBLICATIONS IF EXIST FOR THE NEWS PROJECT
		
		$result2_pdo = $conexion->executeSQL('SELECT * FROM b_publications WHERE projectid='.$id.' ORDER BY date DESC');
		if ($result2_pdo->rowCount()){
			echo '
				<div class="col-md-12 col-xs-12">
					<center><h4>Publications</h4></center>
				</div>
			';
			$result2 = $result2_pdo->fetchAll(PDO::FETCH_ASSOC);
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
					<div class="col-offset-2 col-md-10 col-xs-12">
						<p><a href="publications.php?pubid='.$id.'"><b>'.$title.'.</b></a>
						'.$authors.', <b>'.$journal.'</b>  ('.$date.'), '.$volume.':'.$pages.'.</a>
					</div>
				';				
			}
		}
		
		echo '</div>';
		
		### END INDIVIDUAL NEWS WITH ID #########
		
		### START OF ALL NEWS #########
	} else {
		openDocument('Projects: Extending the frontiers of scientific research in fast advancing technologies in (South) Africa');
		openKeywords("KRISP uses expertise in fast advancing technologies such as genomics, epigenetics, bioinformatics and epidemiology in order to extend the frontiers of scientific research, drive innovation and solve some of the biggest global health problems, such as the HIV & TB epidemics and the increase of drug resistance");
		openDescription("Here we provide you with a list of our research projects in Global Health, Epidemiology, Genomics, Bioinformatics, Epigenetics & Fast Advancing Technologies, this section also summarizes KRISP team expertises and funding");
		drawHeader($logopicture);
		
		### START INTRODUCTION #########
		echo '<div class="row">';
		echo '
			<div class="col-md-12 col-xs-12">
				<center><h3>RESEARCH PROJECTS</h3></center>
			</div>
		';
		### START OF PROJECT 1 TO 6 #########
		
		$result25_pdo = $conexion->executeSQL("SELECT * FROM b_projects ORDER BY date DESC LIMIT 6");	
		if ($result25_pdo->rowCount()){
			$result25 = $result25_pdo->fetchAll(PDO::FETCH_ASSOC);
			foreach ($result25 as $project){
				$id = $project["id"];
				$title = $project["title"];
				$webpage = $project["webpage"];
				$short = $project["short"];
				$date = $project["date"];
				$image = $project["image"];
				$summary = $project["summary"];
				$people = $project["people"];
				echo '
					<div class="col-md-4 col-xs-12">
						<div class="col-md-11" style="min-height: 250px; margin: 10px; border: 1px solid #000;">
						<div class="col-md-12 col-xs-12" style="min-height: 100px;">
							<a href="projects.php?id='.$id.'"><b>'.$short.'</b></a> <img src="../imagesBIO/'.$image.'" align="right">
						</div>
						<br /><br />
						<div class="col-md-12 col-xs-12" style="min-height: 100px;">
							<center><h6><a href="projects.php?id='.$id.'">'.$title.'</a></h6></center>
						</div>
						<br><br>
						<div class="col-md-12 col-xs-12" style="min-height: 50px;">
							<i>'.$people.'</i>
						</div>
						</div>
					</div>
				';			
          
			}
		}
		echo '</div>';
	}
	drawFooter("2017"); 
	closeDocument();