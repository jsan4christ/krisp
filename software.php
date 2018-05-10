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



	$bioafric = $_GET['peopleid'];
	$list =$_GET['list'];

	if ($bioafric) {} else {
	
				openDocument('Bioinformatics Software Applications and Online Databases and Tools Developed by Members of the Wellcome Trust Africa Centre Genomics Programme, UKZN, South Africa');
				openKeywords("software, bioinformatics, rega, subtyping, south africa, open access, africa, wellcome trust, tulio de oliveira, members ");
				openDescription("Here we provide you with list of open access bioinformatics software applications that the Wellcome Trust Africa Centre Genomics Programme and collaborators.");
				drawHeader($logopicture);

	echo '      
		<table class="intro" width="1024">
        <tbody>
          <tr>
            <td>
            <h2>Bioinformatics Software Applications, Sequence Databases & Online Tools</h2>           
            <p>These are some of the bioinformatics software applications, online databases and and tools developed by our research group in South Africa. All of the tools are open-source and freely available online. Our Bioinformatics servers tools and databases are hosted in Linux servers a the <a href="http://www.mrc.ac.za">South African Medical Research Council</a>, Cape Town, South Africa.Please follow link below.
</p>
            </td>
          </tr>
        </tbody>
      </table>
            <table style="text-align: left; width: 1024px; height: 49px;" border="0" cellpadding="2" cellspacing="0">
        <tbody>
          <tr>
<td>
      
<center><br><a href="http://bioafrica2.mrc.ac.za/rega-genotype-alpha/aedesviruses/typingtool/"><img style="border: 0px solid" alt="" src="imagesBIO/featureaedisviruses.jpg"></a><br>
</center>
<p><a href="http://bioafrica2.mrc.ac.za/rega-genotype-alpha/aedesviruses/typingtool/">Dengue, Zika and Chikungunya viruses typing tool: A phylogenetic algorithm for accurate identification of Dengue, Zika and Chikungunya viruses species and genotypes.</a></p>

            </td>
          </tr>


        </tbody>
      </table><hr><br>
      ';
      
      						### START OF SPOTLIGHT #########

		echo '  <table class="main" width="1024">
          <tr>
			<td><h7><center>SPOTLIGHT</center></h7><br></td>
		  </tr></table>
		        <table class="tools" width="1024">

		  <tr><td>';     

$result25 = mysql_query("SELECT *  FROM b_software WHERE feature='Y' ORDER BY date DESC LIMIT 3",$db);	
		
	
			
		if ($software = mysql_fetch_array($result25)) {
		
			do {
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
			
		
		
			echo '
      	
            <td width="33%"><br><center><a href='.$webpage.'><img src="imagesBIO/software'.$id.'feature.png"></a><p>
            <h8>'.$name.'</h8>
         <br></td>

          
          ';			
          
			} while ($software = mysql_fetch_array($result25));

		
			} else {
	
				
			}	echo '</tr></tr></tbody></table><hr><br>';	
			
			
			### END  OF SPOTLIGHT ######### 
			


					### START  OF TYPING TOOLS ######### 

					echo '      
      <table class="main" width="1024">
          <tr>
			<td><h7><center>TYPING TOOLS</center></h7></td>
		  </tr></table>
		        <table class="main" width="1024">

		  <tr><td><br>';
		  
  
		$result4 = mysql_query("SELECT *  FROM b_software WHERE type='typing' ORDER BY date DESC",$db);	
		
		
		if ($software = mysql_fetch_array($result4)) {
				  
			do {
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

				echo '


          <tr>
			<td width="20%" align="right">
			<p>'.$date.'<br><h8>Version: '.$version.'</h8></p> 
			</td><td width="20%">
          <p><center><a href="'.$webpage.'"><img src="imagesBIO/'.$image.'"><br></a>
</td>
          
          <td width="60%">
          <p>
          <a href="'.$webpage.'"><b><h9>'.$name.'</a></h1></b>
          <p>'.$summary.'</p><br>
            </td></tr>
          
          ';				
			} while ($software = mysql_fetch_array($result4));

		
			} else {
	
	echo 'No news';		
				
			}	
				echo '</td></tr></tbody></table><hr><br>';	
				
	
			
			### END  OF ALL TYPING TOOLS ######### 
			
			### START  OF DATABSES ######### 

					echo '      
      <table class="main" width="1024">
          <tr>
			<td><h7><center>DATABASES</center></h7></td>
		  </tr></table>
		        <table class="main" width="1024">

		  <tr><td><br>';
		  
  
		$result4 = mysql_query("SELECT *  FROM b_software WHERE type='database' ORDER BY date DESC",$db);	
		
		
		if ($software = mysql_fetch_array($result4)) {
				  
			do {
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

				echo '


          <tr>
			<td width="20%" align="right">
			<p>'.$date.'<br><h8>Version: '.$version.'</h8></p> 
			</td><td width="20%">
          <p><center><a href="'.$webpage.'"><img src="imagesBIO/'.$image.'"><br></a>
</td>
          
          <td width="60%">
          <p>
          <a href="'.$webpage.'"><b><h9>'.$name.'</a></h1></b>
          <p>'.$summary.'</p><br>
            </td></tr>
          
          ';				
			} while ($software = mysql_fetch_array($result4));

		
			} else {
	
	echo 'No news';		
				
			}	
				echo '</td></tr></tbody></table><hr><br>';	
				
	
			
			### END  OF ALL TYPING DATABASES ######### 
    		
    		### START  OF ONLINE ######### 

					echo '      
      <table class="main" width="1024">
          <tr>
			<td><h7><center>ONLINE TOOLS <center></h7></td>
		  </tr></table>
		        <table class="main" width="1024">

		  <tr><td><br>';
		  
  
		$result4 = mysql_query("SELECT *  FROM b_software WHERE type='online' ORDER BY date DESC",$db);	
		
		
		if ($software = mysql_fetch_array($result4)) {
				  
			do {
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

				echo '


          <tr>
			<td width="20%" align="right">
			<p>'.$date.'<br><h8>Version: '.$version.'</h8></p> 
			</td><td width="20%">
          <p><center><a href="'.$webpage.'"><img src="imagesBIO/'.$image.'"><br></a>
</td>
          
          <td width="60%">
          <p>
          <a href="'.$webpage.'"><b><h9>'.$name.'</a></h1></b>
          <p>'.$summary.'</p><br>
            </td></tr>
          
          ';				
			} while ($software = mysql_fetch_array($result4));

		
			} else {
	
	echo 'No news';		
				
			}	
				echo '</td></tr></tbody></table><hr><br>';	
				
	
			
			### END  OF ALL  ONLINE ######### 
			
			### RESOURCES ######### 

					echo '      
      <table class="main" width="1024">
          <tr>
			<td><h7><center>SCIENTIFIC RESOURCES<center></h7></td>
		  </tr></table>
		        <table class="main" width="1024">

		  <tr><td><br>';
		  
  
		$result4 = mysql_query("SELECT *  FROM b_software WHERE type='resource' ORDER BY date DESC",$db);	
		
		
		if ($software = mysql_fetch_array($result4)) {
				  
			do {
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

				echo '


          <tr>
			<td width="20%" align="right">
			<p>'.$date.'<br><h8>Version: '.$version.'</h8></p> 
			</td><td width="20%">
          <p><center><a href="'.$webpage.'"><img src="imagesBIO/'.$image.'"><br></a>
</td>
          
          <td width="60%">
          <p>
          <a href="'.$webpage.'"><b><h9>'.$name.'</a></h1></b>
          <p>'.$summary.'</p><br>
            </td></tr>
          
          ';				
			} while ($software = mysql_fetch_array($result4));

		
			} else {
	
	echo 'No news';		
				
			}	
				echo '</td></tr></tbody></table><hr><br>';	
				
	
			
			### END OF RESOURCES ######### 

			### SOFTWARE DOWNLOAD ######### 

					echo '      
      <table class="main" width="1024">
          <tr>
			<td><h7><center>SOFTWARE DOWNLOAD<center></h7></td>
		  </tr></table>
		        <table class="main" width="1024">

		  <tr><td><br>';
		  
  
		$result4 = mysql_query("SELECT *  FROM b_software WHERE type='software' ORDER BY date DESC",$db);	
		
		
		if ($software = mysql_fetch_array($result4)) {
				  
			do {
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

				echo '


          <tr>
			<td width="20%" align="right">
			<p>'.$date.'<br><h8>Version: '.$version.'</h8></p> 
			</td><td width="20%">
          <p><center><a href="'.$webpage.'"><img src="imagesBIO/'.$image.'"><br></a>
</td>
          
          <td width="60%">
          <p>
          <a href="'.$webpage.'"><b><h9>'.$name.'</a></h1></b>
          <p>'.$summary.'</p><br>
            </td></tr>
          
          ';				
			} while ($software = mysql_fetch_array($result4));

		
			} else {
	
	echo 'No news';		
				
			}	
				echo '</td></tr></tbody></table><hr><br>';	
				
	
			
			### END  OF ALL SOFTWARE ######### 

			
			
echo '</td></tr></table>';
			}
      
      
	drawFooter("2011"); 
	closeDocument();
	
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
