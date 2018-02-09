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

		openDocument('Search Engine');
		openKeywords("videos, youtube, krisp, KwaZulu-Natal Research Innovation and Sequencing Platform, UKZN, Durban, South Africa, saturn, bioafrica, media coverage, genomics, DNA sequencing, laboratory, africa, bioinformatics, work, tulio de oliveira");
		openDescription("YouTube videos on the key aspects of Krisp genomics, epidemiology, bioinformatics, molecular evolution and drug resistance work in Africa - KwaZulu-Natal Research Innovation and Sequencing Platform");
		
		drawHeader($logopicture);

		### START INTRODUCTION #########
		echo '<div class="row">
     	<div class="col-md-12 col-xs-12"><center><h4>KRISP GOOGLE SEARCH!</h4>
     <p>Custom google search KRISP website</a>.</p><p> All of our pages are indexed and you will find easy to search them using our custom query engine!</p><br>
     <script>
  (function() {
    var cx = "010275626311215289754:mscscz390tw";
    var gcse = document.createElement("script");
    gcse.type = "text/javascript";
    gcse.async = true;
    gcse.src = "https://cse.google.com/cse.js?cx=" + cx;
    var s = document.getElementsByTagName("script")[0];
    s.parentNode.insertBefore(gcse, s);
  })();
</script>
<gcse:search></gcse:search>
     	</div>';
		
		echo '<br><br><br><br><br><br><br></div>';
		### END  OF ALL NEWS ######### 
	drawFooter("2015"); 
	closeDocument();