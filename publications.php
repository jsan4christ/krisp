<?php

/* * *********
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
 * ************* */
    require_once("rv-settings.php");
    $conexion = new Conexion();

    $bioafric = 0;
    if (isset($_GET['pubid'])){
        $bioafric = $_GET['pubid'];
    }
    /* * *********
      $list =$_GET['list'];
     * ************* */

if ($bioafric) {
    $result1_pdo = $conexion->executeSQL("SELECT * FROM b_publications WHERE id='".$bioafric."' ORDER BY date ASC");
    if ($result1_pdo->rowCount()) {
        $result1 = $result1_pdo->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result1 as $bioafric) {
            $id = $bioafric["id"];
            $title = $bioafric["title"];
            $authors = $bioafric["authors"];
            $keywords = $bioafric["keywords"];
            $topdescription = $bioafric["topdescription"];
            $abstract = $bioafric["abstract"];
            $journal = $bioafric["journal"];
            $date = $bioafric["date"];
            $volume = $bioafric["volume"];
            $pages = $bioafric["pages"];
            $citations = $bioafric["citations"];
            $link = $bioafric["link"];
            $datafile = $bioafric["datafile"];
            $file = $bioafric["file"];
            $impact = $bioafric["impact"];
            $pubid = $bioafric["id"];

            $title = $title;
            $keywords = $keywords;
            openDocument("Paper - $title");
            openKeywords($keywords);
            openDescription($topdescription);
            drawHeader();
            //	draw_toolbar();
        }
        echo '<div class="row">
      		<div class="col-md-9 col-xs-12"><h5 class="heading"><center>Publication</center></h5>
                    <p>Title: <b>' . $title . '</b><br>
                    Authors: <b>' . $authors . '</b>.<br>
                    Journal: <b>' . $journal . '</b>,' . $volume . ':' . $pages . ' (' . $date . ')<br>';
        if ($impact) {
            echo '<br>Journal Impact Factor (I.F.): <b>' . $impact . '</b><br>';
        }
        if ($citations) {
            echo 'Number of citations (<small><a href="http://scholar.google.com/scholar?q=' . $title . '&hl=en&btnG=Search&as_sdt=1%2C5">Google Scholar</a>)</small>: <b>' . $citations . '</b> <r>';
        }

        echo '<p><a href="https://twitter.com/share" class="twitter-share-button" data-lang="en">Tweet</a>
				<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script></p>
				<h4>Abstract</h4>
				' . $abstract;
        if ($file) {
            echo '<h4 align="center">Download: <a href="../manuscripts/' . $file . '.pdf"> Full text paper <img style="border: 0px solid ; width: 28px; height: 42px;" alt="" src="pdf.png"></a></h4></p>
		<p>Citation:  ' . $authors . '. ' . $title . ' ' . $journal . ',' . $volume . ':' . $pages . ' (' . $date . ').</p>';
        }

        #### IF POWERPOINT EXIST

        $result3_pdo = $conexion->executeSQL("SELECT *  FROM b_resources_ppt WHERE pubid='".$pubid."' ORDER BY id ASC");
        if ($result3_pdo->rowCount()) {
            $number = $result3_pdo->rowCount();
            $result3 = $result3_pdo->fetchAll(PDO::FETCH_ASSOC);
            foreach ($result3 as $resources) {
                $pict = $resources["pict"];
                $summary = $resources["summary"];
                $pubid = $resources["pubid"];
                $feature = $resources["feature"];
                $pptfile = $resources["pptfile"];

                echo '<div class="col-md-12 col-xs-12">Summary PowerPoint Presentation</div>
                    <div class="col-md-12 col-xs-12"><p><center><a href="manuscripts/ppt/' . $pptfile . '"><img src="manuscripts/ppt/' . $pict . '"  alt="' . $authors . '. ' . $title . ' .' . $journal . ',' . $volume . ':' . $pages . ' (' . $date . ')"></p>
                    <p><h5>Download: Slide Presentation</h5></p></a></center>
                    <p><h4>' . $summary . '</h4></p>
                    </div>';
            }
        }

        #### IF VIDEO EXIST					

        $result6_pdo = $conexion->executeSQL("SELECT * FROM b_resources_video WHERE pubid='".$pubid."' ORDER BY id ASC");

       if ($result6_pdo->rowCount()) {
            $number = $result6_pdo->rowCount();
            $result6 = $result6_pdo->fetchAll(PDO::FETCH_ASSOC);
            foreach ($result6 as $video) {
                $pict = $video["pict"];
                $summary = $video["summary"];
                $pubid = $video["pubid"];
                $feature = $video["feature"];
                $file = $video["file"];
                $youtube = $video["youtube"];

                echo '<div class="col-md-12 col-xs-12">Video/Movie</div>
                    <div class="col-md-12 col-xs-12">
                        <div class="col-md-12 col-xs-12 embed-container">
                            <iframe src="http://www.youtube.com/embed/'.$youtube.'" frameborder="0" allowfullscreen></iframe>
                        </div>
                        <div class="col-md-12 col-xs-12">
                            <p><br><a href="http://www.youtube.com/embed/' . $youtube . '">View: Video at YouTube</p></a>
                            <p><h4>' . $summary . '</h4></p>
                            <p><h5><br>For more videos please visit <a href="http://www.youtube.com/user/bioafricaSATURN"> BioAfrica & SATuRN YouTube Channel</a></h5></p>
                        </div></div>';
            }
        }


        #### IF News EXIST					

        $result4_pdo = $conexion->executeSQL("SELECT * FROM b_news WHERE pubid=$pubid ORDER BY id ASC");
         if ($result4_pdo->rowCount()) {
            echo '      
                <div class="col-md-12 col-xs-12">Printed and Online Media Coverage</div>';
            $number = $result4_pdo->rowCount();
            $result4 = $result4_pdo->fetchAll(PDO::FETCH_ASSOC);
            foreach ($result4 as $news) {

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
                        <p><center><img src="imagesBIO/' . $image . '" width=100" heigth="75">
                        ' . $journal . '
                        </p></center>
                    </div>
                    <div class="col-md-10 col-xs-12">
                        <p><a href="news.php?id=' . $id . '"><b>' . $title . '</a></b>'
                        . $journal . '  - ' . $date . ' ' . $summary . '</p><br>
                    </div></div>';
            }
        }


        #### IF REPORT EXIST					

        $result5_pdo = $conexion->executeSQL("SELECT * FROM b_reports WHERE pubid=$pubid ORDER BY id DESC");
        if ($result5_pdo->rowCount()) {
            echo '<div class="col-md-12 col-xs-12">SATuRN/BioAfrica Reports on this Publication</div>';
            $result5 = $result5_pdo->fetchAll(PDO::FETCH_ASSOC);
            foreach ($result5 as $report) {
                $id = $report["id"];
                $title = $report["title"];
                $abstract = $report["abstract"];
                $summary = $report["summary"];
                $journal = $report["journal"];
                $date = $report["date"];
                $image = $report["image"];
                $authors = $report["authors"];
                $doi = $report["doi"];
                $bioafrica = $report["bioafricaSATuRN"];
                echo '<div class="col-md-12 col-xs-12">
                    <div class="col-md-2 col-xs-12">
                        <p><center><img src="imagesBIO/' . $image . '" width="100" height="75"></p>
                    </div>
                    <div class="col-md-10 col-xs-12">
                        <P><a href="report.php?id=' . $id . '"> <b>' . $title . '</b></a>
                        <H3>' . $doi . ', date: ' . $date . ' </h3><h1>' . $authors . '  </a></H1></P>
                    </div></div>';
            }
        }

        ### END INDIVIDUAL Publications WITH ID #########

        echo '</div>';
        

        ### START OF NEWS LIST LIMIT 3 #########
        echo '<aside class="col-md-3 col-xs-12"><h4><center>Latest Papers</center></h4>';	

        $result4_pdo = $conexion->executeSQL('SELECT * FROM b_publications ORDER BY date DESC, id DESC LIMIT 3');
        echo ' 	<div class="row">';
        if ($result4_pdo->rowCount()) {
            $result4 = $result4_pdo->fetchAll(PDO::FETCH_ASSOC);
            foreach ($result4 as $publications) {
                $id = $publications["id"];
                $title = $publications["title"];
                $authors = $publications["authors"];
                $journal = $publications["journal"];
                $date = $publications["date"];
                $volume = $publications["volume"];
                $pages = $publications["pages"];
                echo '<div class="col-md-12 col-xs-12">
                        <p><a href="publications.php?pubid=' . $id . '"><b>' . $title . '</a>
                		<b>' . $journal . ' (' . $date . ')</p>
                    </div>';
            }
        } else {

            echo '<div class="col-md-12 col-xs-12">No news</div>';
        }
        echo '<div class="col-md-12 col-xs-12"><p align="right"><small><a href="publications.php">All publications</a>...</small></p></div></div>';


        ### END  OF NEWS ######### 
        ### START OF TWITTER ######### 

        echo'<p>
<a class="twitter-timeline" data-dnt="true" href="https://twitter.com/drug_resistance" data-widget-id="287836532994342912">Tweets by @drug_resistance</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?"http":"https";if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
';

        echo'

<a href="https://twitter.com/drug_resistance" class="twitter-follow-button" data-show-count="true" data-lang="en">Follow @drug_resistance</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
';


### END OF TWITTER ######### 

        echo'</aside></div>';


    }

### START OF PUBLICATIONS.PHP #########
    } else {
        openDocument("Papers: Global Health, Epidemiology, Phylogenetics, Genomics, Bioinformatics, Epigenetics & more...");
        openKeywords("Publications, Bioinformatics, genomics, africa, bioafrica, drug resistance, peer-reviewed, HIV, TB, dastabases, pathogens, publications");
        openDescription("In this section of bioafrica we provide you with publications, manuscripts, papers, on bioinformatics, genomics and drug resistance. HIV, TB and other pathogens publications");

        drawHeader();


        ### START OF SPOTLIGHT #########

        echo '<div class="row">
     		<div class="col-md-12 col-xs-12">
                    <h3><center><p>PUBLICATIONS SPOTLIGHT</center></h3>
                </div>';

        $result25_pdo = $conexion->executeSQL("SELECT * FROM b_publications WHERE feature='Y' ORDER BY date DESC LIMIT 3");
        if ($result25_pdo->rowCount()) {
            $result25 = $result25_pdo->fetchAll(PDO::FETCH_ASSOC);
            foreach ($result25 as $publication) {
                $id = $publication["id"];
                $title = $publication["title"];
                $authors = $publication["authors"];
                $journal = $publication["journal"];
                $date = $publication["date"];
                $volume = $publication["volume"];
                $pages = $publication["pages"];
                $citations = $publication["citations"];
                $impact = $publication["impact"];
                echo '<div class="col-md-4 col-xs-12">
                    <center><a href="publications.php?pubid=' . $id . '">'
                        . '<img src="imagesBIO/pub' . $id . 'feature.png"></a><p>
                            <h8>' . $journal . '</h8>
                    </div>';
            }
        }
        
        echo '<div class="col-md-12 col-xs-12"><hr></div></div>';


        ### END  OF SPOTLIGHT ######### 


        $result2_pdo = $conexion->executeSQL("SELECT * FROM b_publications ORDER BY date DESC, id DESC");
        if ($result2_pdo->rowCount()) {
            $result2 = $result2_pdo->fetchAll(PDO::FETCH_ASSOC);
            $number = $result2_pdo->rowCount();

            $number_citations = get_Total();
            $citations_per_publications = $number_citations / $number;
            $number_Hscore = get_Hscore();
            $number_impact = get_IF();
            $average_impact = $number_impact / $number;

            $number_average_impact = number_format($average_impact, 2);
            $number_citations_per_publications = number_format($citations_per_publications, 2);
            echo '<div class="row">
                    <div class="col-md-12 col-xs-12"><h3><center>PUBLICATIONS</center></h3></div>';
            foreach ($result2 as $publication) {
                $id = $publication["id"];
                $title = $publication["title"];
                $authors = $publication["authors"];
                $journal = $publication["journal"];
                $date = $publication["date"];
                $volume = $publication["volume"];
                $pages = $publication["pages"];
                $citations = $publication["citations"];
                $impact = $publication["impact"];

                echo '<div class="col-md-12 col-xs-12">
                        <div class="col-md-10 col-xs-12">
                            <p><a href="publications.php?pubid=' . $id . '"><b>' . $title . '</b></a></p>
                            <p>' . $authors . ', <b>' . $journal . '</b>  (' . $date . '), ' . $volume . ':' . $pages . '</p><br>
                        </div>
                     </div>';
            }
        } else {

            echo '<div class="col-md-12 col-xs-12">No news</div>';
        }
        echo '<div class="col-md-12 col-xs-12"><hr></div></div>';





        ### PUBLICATIONS RANKED BY IMPACT FACTOR ######

        $result4_pdo = $conexion->executeSQL('SELECT * FROM b_publications ORDER BY impact DESC, date DESC LIMIT 20');
        echo '<div class="row">
                <div class="col-md-12 col-xs-12">
                    <h5 class="heading"><center>Ranked by Impact Factor (top 20)</center></h5>
                </div>';
        if ($result4_pdo->rowCount()) {
            $result4 = $result4_pdo->fetchAll(PDO::FETCH_ASSOC);
            foreach ($result4 as $publications) {
                $id = $publications["id"];
                $title = $publications["title"];
                $authors = $publications["authors"];
                $journal = $publications["journal"];
                $date = $publications["date"];
                $volume = $publications["volume"];
                $pages = $publications["pages"];
                $impact = $publications["impact"];

                echo '<div class="col-md-12 col-xs-12">
                    <p><a href="publications.php?pubid=' . $id . '"><b>' . $title . '</a></b>. ' . $journal . ' (' . $date . '), I.F.:' . $impact . '</p>
                </div>';
            }
        } else {
            echo '<div class="col-md-12 col-xs-12">No news</div>';
        }
        echo '<div class="col-md-12 col-xs-12"><hr></div></div>';

        #### PUBLICATIONS RANKED by citation


        $result4_pdo = $conexion->executeSQL('SELECT * FROM b_publications ORDER BY citations DESC LIMIT 20');
        echo '<div class="row">
                <div class="col-md-12 col-xs-12">
                    <h5 class="heading"><center>Ranked by Citation (top 20)</center></h5>
                </div>';
        if ($result4_pdo->rowCount()) {
            $result4 = $result4_pdo->fetchAll(PDO::FETCH_ASSOC);
            foreach ($result4 as $publications) {
                $id = $publications["id"];
                $title = $publications["title"];
                $authors = $publications["authors"];
                $journal = $publications["journal"];
                $date = $publications["date"];
                $volume = $publications["volume"];
                $pages = $publications["pages"];
                $citations = $publications["citations"];
                
                echo '<div class="col-md-12 col-xs-12">
                    <p><a href="publications.php?pubid=' . $id . '"><b>' . $title . '</a></b>. ' . $journal . ' (' . $date . '), Citations:' . $citations . '</p>
                </div>';
            }
        } else {
            echo '<div class="col-md-12 col-xs-12">No news</div>';
        }
         echo '<div class="col-md-12 col-xs-12"><hr></div></div>';

        ### END  OF NEWS ######### 

    }


    drawFooter("2013");

    closeDocument();

    // subroutines

    function get_Total() {
        global $conexion;
        $resource_pdo = $conexion->executeSQL("SELECT sum(citations) as citations FROM b_publications");
        $resource = $resource_pdo->fetchAll(PDO::FETCH_ASSOC);
        $number_citations = $resource[0]["citations"]; // only one cell in field
        return $number_citations;
    }

    function get_IF() {
        global $conexion;
        $resource_pdo = $conexion->executeSQL("SELECT sum(impact) as impact FROM b_publications");
        $resource = $resource_pdo->fetchAll(PDO::FETCH_ASSOC);
        $number_impact = $resource[0]["impact"]; // only one cell in field
        return $number_impact;
    }

    function get_HScore() {
        global $conexion;
        $resource_pdo = $conexion->executeSQL("SELECT citations FROM b_publications order by citations DESC");
        $number = $resource_pdo->rowCount();
        $resource = $resource_pdo->fetchAll(PDO::FETCH_ASSOC);
        $number_Hscore = ($number - ($number - $resource[0]["citations"]));
        // only one cell in field
        return $number_Hscore;
    }
    