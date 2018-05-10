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
	$bioafric_name = $_GET['category'];
	
	### START INDIVIDUAL NEWS WITH ID #########
	if ($id) {
		openKeywords($keywords);
		openDescription($topdescription);
		drawHeader($logopicture);
		echo '<div class="row">';
		$result4_pdo = $conexion->executeSQL('SELECT * FROM b_toys where id='.$id.' ORDER BY date DESC');	
		if ($result4_pdo->rowCount()){
			$result4 = $result4_pdo->fetchAll(PDO::FETCH_ASSOC);
			foreach ($result4 as $toys){
				$id = $toys["id"];
				$title = $toys["title"];
				$short = $toys["short"];
				$date = $toys["date"];
				$image = $toys["image"];
				$summary = $toys["summary"];
				$category = $toys["category"];
				$funder = $toys["funder"];
				$expertise = $toys["expertise"];
				$company = $toys["company"];
				$services = $toys["services"];
				$contact = $toys["contact"];	
			
				openDocument('Toys: '.$title.' - '.$short.'');
				echo '
					<div class="col-md-12 col-xs-12">
						<br><p><a href="index.php">Home</a> / <a href="toys.php">Toys</a> / <a href="toys.php?category='.$category.'">'.$category.'</a> / '.$short.'</p><br>
					</div>
					<div class="col-md-12 col-xs-12">
						<div class="col-md-10 col-xs-12">
							<h4>'.$title.'</h4>
						</div>
					</div>
					<div class="col-md-12 col-xs-12">
						<div class="col-md-2 col-xs-12">
							<p><b>KRISP services</b></p>
						</div>
						<div class="col-md-10 col-xs-12">
							<p>'.$services.'</p>
						</div>
					</div>
					<div class="col-md-12 col-xs-12">
						<div class="col-md-2 col-xs-12">
							<p><b>KRISP contact</b></p>
						</div>
						<div class="col-md-10 col-xs-12">	
							<p>'.$contact.'</p>
						</div>
					</div>
					<div class="col-md-12 col-xs-12">
						<div class="col-md-2 col-xs-12">	
							<p><b>Equipment summary</b></p>
						</div>
						<div class="col-md-10 col-xs-12">
							<p>'.$summary.'</p>
						</div>
					</div>
					<div class="col-md-12 col-xs-12">
						<div class="col-md-2 col-xs-12">	
							<p><b>Image</b></p>
						</div>
						<div class="col-md-10 col-xs-12">
							<p><img src="../imagesBIO/'.$image.'" align="left"></p>
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
							<p><b>Company</b></p>
						</div>
						<div class="col-md-10 col-xs-12">
							<p>'.$company.'</p>
						</div>
					</div>					
					<div class="col-md-12 col-xs-12">
						<div class="col-md-2 col-xs-12">	
							<p><b>Category</b></p>
						</div>
						<div class="col-md-10 col-xs-12">
							<p>'.$category.'</p>
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
	
	### START CATEGORY #########
	}	elseif ($bioafric_name) {
		openKeywords($keywords);
		openDescription($topdescription);
		drawHeader($logopicture);
		echo '<div class="row">';
				echo '<div class="row">';
		echo '
			<div class="col-md-12 col-xs-12">
				<center><h3>KRISP Toys: '.$bioafric_name.' available for collaborative research, training, diagnostics & services</h3></center>
			</div>
		';
		$result25_pdo = $conexion->executeSQL("SELECT * FROM b_toys WHERE category = '".$bioafric_name."' ORDER BY date DESC");	
		if ($result25_pdo->rowCount()){
			$result25 = $result25_pdo->fetchAll(PDO::FETCH_ASSOC);
			foreach ($result25 as $toys){
				$id = $toys["id"];
				$title = $toys["title"];
				$short = $toys["short"];
				$date = $toys["date"];
				$image = $toys["image"];
				$imagesmall = $toys["imagesmall"];
				$summary = $toys["summary"];
				$category = $toys["category"];
				$funder = $toys["funder"];
				$expertise = $toys["expertise"];
				$company = $toys["company"];
				$services = $toys["services"];
				$contact = $toys["contact"];	
												
			
				openDocument('Toys: '.$category.'');

		### START OF PROJECT 1 TO 6 #########
		

				echo '
					<div class="col-md-4 col-xs-12">
						<div class="col-md-11" style="min-height: 350px; margin: 10px; border: 1px solid #000;">
						<div class="col-md-12 col-xs-12" style="min-height: 30px;">
							<center><a href="toys.php?id='.$id.'"><b>'.$category.'</b></a></center>
						</div>
						<br />
					    <div class="col-md-12 col-xs-12" style="min-height: 200px;">
							<center><a href="toys.php?id='.$id.'"><img src="../imagesBIO/'.$imagesmall.'" align="center"></a></center>
						</div>
						<div class="col-md-12 col-xs-12" style="min-height: 30px;">
							<center><h6><a href="toys.php?id='.$id.'">'.$title.'</a></h6></center>
						</div>
						<br>
						<div class="col-md-12 col-xs-12" style="min-height: 90px;">
							<i>'.$services.'</i>
						</div>
						</div>
					</div>
				';			
          
			}
		}	
	
		echo '</div>';
	
		### END INDIVIDUAL NEWS WITH ID #########
		
		### START OF ALL NEWS #########
	} else {
		openDocument('Toys: DNA sequencers, PCR, qPCR, ddPCR, DNA/RNA extractors, Bioinformatics High-Processing Computer Servers');
		openKeywords("KRISP has access to cutting-edge molecular technologies such as next generation DNA sequencers, PCR, qPCR, ddPCR, DNA/RNA extractors, Bioinformatics High-Processing Computer Servers ");
		openDescription("Here we provide you with a list of our equipment that is available for collaborative research, training, diagnostics & sequencing services");
		drawHeader($logopicture);
		
		### START INTRODUCTION #########
		echo '<div class="row">';
		echo '
			<div class="col-md-12 col-xs-12">
				<center><h3>KRISP Toys: Equipment available for collaborative research, training, diagnostics & sequencing services</h3></center>
			</div>
		';
		### START OF PROJECT 1 TO 6 #########
		
		$result25_pdo = $conexion->executeSQL("SELECT * FROM b_toys ORDER BY category DESC, date DESC");	
		if ($result25_pdo->rowCount()){
			$result25 = $result25_pdo->fetchAll(PDO::FETCH_ASSOC);
			foreach ($result25 as $toys){
				$id = $toys["id"];
				$title = $toys["title"];
				$short = $toys["short"];
				$date = $toys["date"];
				$image = $toys["image"];
				$imagesmall = $toys["imagesmall"];
				$summary = $toys["summary"];
				$category = $toys["category"];
				$funder = $toys["funder"];
				$expertise = $toys["expertise"];
				$company = $toys["company"];
				$services = $toys["services"];
				$contact = $toys["contact"];	
												
				echo '
					<div class="col-md-4 col-xs-12">
						<div class="col-md-11" style="min-height: 350px; margin: 10px; border: 1px solid #000;">
						<div class="col-md-12 col-xs-12" style="min-height: 30px;">
							<center><a href="toys.php?id='.$id.'"><b>'.$category.'</b></a></center>
						</div>
						<br />
					    <div class="col-md-12 col-xs-12" style="min-height: 200px;">
							<center><a href="toys.php?id='.$id.'"><img src="../imagesBIO/'.$imagesmall.'" align="center"></a></center>
						</div>
						<div class="col-md-12 col-xs-12" style="min-height: 30px;">
							<center><h6><a href="toys.php?id='.$id.'">'.$title.'</a></h6></center>
						</div>
						<br>
						<div class="col-md-12 col-xs-12" style="min-height: 90px;">
							<i>'.$services.'</i>
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