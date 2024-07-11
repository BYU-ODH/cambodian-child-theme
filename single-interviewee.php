<?php
get_header();
$obj = pods(); // Pods for Interviewee

// $given_name_romanized = $obj -> field("")
$birth_year = $obj -> field("birth_year");
$birth_month = $obj -> field("birth_month");
$birth_date = $obj -> field("birth_date");
$birth_location_province = $obj -> field("birth_location_province");
$birth_location_village = $obj -> field("birth_location_village");
$participated_in_interview = $obj -> field("participated_in_interview");
$picture = $obj -> field("picture");

 // Interview Pods Relationship
$interview_pod = pods('interview', $participated_in_interview[0]["ID"]);
$interview_month = $interview_pod -> field("interview_month");
$interview_year = $interview_pod -> field("interview_year");
$interview_day = $interview_pod -> field("interview_day");
$interviewer = $interview_pod -> field("interviewer"); // echo($interviewer["post_title"]) Have to grab post_title
$ID_Interviewer = $interviewer['ID'];
$link_to_box_folder = $interview_pod -> field("link_to_box_folder");
$video_link = $interview_pod -> field("video_link");
$audio_link = $interview_pod -> field("audio_link");
$transcript_file = $interview_pod -> field("transcript_file");
$translation_file = $interview_pod -> field("translation_file");
$story_included = $interview_pod -> field("story_included"); // $story_included[0]["post_title"] name $story_included[0]['guid'] permalink;
?>

<!-- Title  -->



<div id="container" class="three-columns-sided">
    <main id="main" role="main" class="main">
        <article>
            <div class="article-inner"> 
                <h1 class="entry-title singular-title"><?php the_title(); ?></h1>
                <div class="entry-meta aftertitle-meta"></div>

                <div class="individual-interviewee">
                    <div class="interviewee-details">
                    <div class="interviewee-image">
                        <?php 
                        if (!empty($picture)) {
                            echo "<div class='picture'><img style='max-width: 250px; height: 250px;' src='{$picture['guid']}' /></div>";
                        }
                        ?>
                    </div>
                            <div class="birth-details">
                                <!-- Birth Details -->
                                <?php
                                if ($birth_year && $birth_month && $birth_date) {
                                    echo("<div class='birthday'><strong>Birthday: </strong>".$birth_date . ' ' . $birth_month . ' ' . $birth_year."</div>");
                                } else if ($birth_month && $birth_year) {
                                    echo("<div class='birth-month'>Birth month: ".$birth_month . ' ' . $birth_year."</div>");
                                } else if ($birth_year){
                                    echo("<div>Birth year: ".$birth_year."</div>");
                                }

                                if ($birth_location_province) {
                                    echo("<div><strong>Birth province: </strong>"."<a href='$birth_location_province[guid]'>".$birth_location_province['post_title']."</a></div>");
                                } ?>
                                <!-- Birth location Village -->
                                <?php
                                    if ($birth_location_village) {
                                        $village_permalink = get_permalink($birth_location_village['ID']);
                                        
                                        echo "<div><strong>Birth village: </strong><a href='$village_permalink'>" . $birth_location_village['post_title'] . "</a></div>";
                                    }
                                ?>
                            </div> 
                        
                        <div>        
                        
                        <!-- Interview Date -->
                            <?php 

                            if ($birth_location_village) {
                                $village_permalink = get_permalink($birth_location_village['ID']);
                                echo "<div><strong>Birth village: </strong><a href='$village_permalink'>" . $birth_location_village['post_title'] . "</a></div>";
                            }
                            ?>
                        </div>
                        <!-- Interviewee Image or Video -->
                      
                    </div>


                    <!-- Interviews Grid -->
                    <div class="interviews-grid">
                        <?php
                        if ($participated_in_interview) {
                            foreach ($participated_in_interview as $interview_data) {
                                $interview_pod = pods('interview', $interview_data["ID"]);
                                ?>
                                <div class="interview-item">
                                    <!-- Interview Information -->
                                    <div class="interview-info">
                                        <?php
                                        $interview_year = $interview_pod->field("interview_year");
                                        $interview_month = $interview_pod->field("interview_month");
                                        $interview_day = $interview_pod->field("interview_day");

                                        if ($interview_year && $interview_month && $interview_day) {
                                            echo '<span class="bold-heading">Date: </span>' . $interview_day . ' ' . $interview_month . ' ' . $interview_year . ' Interview';
                                        } else if ($interview_month && $interview_year) {
                                            echo $interview_month . ' ' . $interview_year . ' Interview';
                                        } else if ($interview_year) {
                                            echo $interview_year . ' Interview';
                                        }

                                        $interviewer = $interview_pod->field("interviewer");
                                        if ($interviewer) {
                                            $interviewer_link = get_permalink($interviewer['ID']);
                                            echo "<div><strong>Interviewer:</strong><a href='$interviewer_link'> " . $interviewer["post_title"] . "</a></div>";
                                        }

                                        $story_included = $interview_pod->field("story_included");
                                        if (isset($story_included) && is_array($story_included) && !empty($story_included)) {
                                            echo '<div class="interview-topics-section">Interview Topics:</div>';
                                            echo '<ul>';
                                            foreach ($story_included as $topic) {
                                                $topic_link = get_permalink($topic['ID']);
                                                $topic_title = $topic['post_title'];
                                                echo "<li><a href='$topic_link'>$topic_title</a></li>";
                                            }
                                            echo '</ul>';
                                        }
                                        ?>
                                    </div>
                                    <div class="video">
                                        <?php 
                                            if (!empty($video_link)) {
                                            echo "<div class='video'><iframe width='420' height='315' src='$video_link' frameborder='0' allowfullscreen></iframe></div>";
                                            } 
                                        ?>
                                     </div>
                                    <!-- Interview Media (Audio) -->
                                    <div class="interview-media">
                                        <?php
                                        $audio_link = $interview_pod->field("audio_link");
                                        if ($audio_link) {
                                            echo "<audio controls><source src='$audio_link' type='audio/mpeg'><source src='$audio_link' type='audio/x-m4a'><source src='$audio_link' type='audio/aac'></audio>";
                                        }
                                        ?>
                                    </div>

                                    <!-- Transcript and Translation Files -->
                                    <div class="transcript-translation">
                                        <?php
                                        $transcript_file = $interview_pod->field("transcript_file");
                                        $translation_file = $interview_pod->field("translation_file");
                                        if ($transcript_file) {
                                            echo "<a href='$transcript_file'><img src='https://cambodianoralhistoryproject.byu.edu/wp-content/uploads/2019/08/KhmerFile-1.png' style='max-width: 100px'/></a>";
                                        }
                                        if ($translation_file) {
                                            echo "<a href='$translation_file'><img src='https://cambodianoralhistoryproject.byu.edu/wp-content/uploads/2019/07/EnglishFile-1.png' style='max-width: 100px'/></a>";
                                        }
                                        ?>
                                    </div>

                                    <div class="all-interview-material">
                                        <?php
                                        if ($link_to_box_folder) {
                                            echo "<a href='$link_to_box_folder'>All interview material</a>";
                                        }
                                        ?>
                                    </div>                                
                                </div>
                                <?php
                            }
                        }
                        ?>
                    </div>
                </div>
                    <!-- Navigation -->

                <nav id="nav-below" class="navigation" role="navigation">
                    <div class="nav-previous">
                        <em>Previous Post</em>
                        <?php previous_post_link(); ?>   
                    </div>
                    <div class="nav-next">
                        <em>Next Post</em>
                        <?php next_post_link(); ?>
                    </div>
                </nav>
            </div>
        </article>

    </main>
    <aside id="primary" class="widget-area sidey" role="complementary" itemscope="" itemtype="http://schema.org/WPSideBar">
    
    <section id="text-5" class="widget-container widget_text">			<div class="textwidget"></div>
      </section>
    </aside>
</div>





<?php get_footer();?>