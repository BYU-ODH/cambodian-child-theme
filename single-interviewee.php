<?php
get_header();

$obj = pods(); // Pods for Interviewee

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
$link_to_box_folder = $interview_pod -> field("link_to_box_folder");
$video_link = $interview_pod -> field("video_link");
$audio_link = $interview_pod -> field("audio_link");
$transcript_file = $interview_pod -> field("transcript_file");
$translation_file = $interview_pod -> field("translation_file");
$story_included = $interview_pod -> field("story_included"); // $story_included[0]["post_title"] name $story_included[0]['guid'] permalink;
?>

<div class="individual-interviewee">
    <div class="interviewee-text">
        <?php if ($birth_year && $birth_month && $birth_date) {
            echo("<span class='bold-heading'>Birthday:</span>".$birth_date . ' ' . $birth_month . ' ' . $birth_year);
            } 
            else if ($birth_month && $birth_year) {
                echo("<p><span class='bold-heading'>Birth month:</span>".$birth_month . ' ' . $birth_year."</p>");
            }
            else if ($birth_year){
                echo("<p><span class='bold-heading'>Birth year:</span>".$birth_year."</p>");
            }
        ?>
        <!-- Birth Location -->
        <?php if ($birth_location_province) {
            echo("<span class='bold-heading'>Birth province:</span>");
            echo("<a href='$birth_location_province[guid]'>".$birth_location_province['post_title']."</a></p>");
        } ?>
        <!-- Birth location Village -->
        <?php if ($birth_location_village) {
            echo("<span class='bold-heading'>Birth village:</span>");
            echo("<a href='$birth_location_village[0][guid]'>".$birth_location_village['post_title']."</a></p>");
        }?>


        <!-- Audio info -->
        <?php if($audio_link) { 
            echo("<audio controls>");
            echo("<source href='$audio_link' type='audio/mpeg'>");
            echo("<source href='$audio_link' type='audio/x-m4a'>");
            echo("<source href='$audio_link' type='audio/aac'>");
            echo("</audio>");
        } 
        ?>

        <!-- Transcript AND translation files -->
        <div class="transcipt-translation">
            <?php 
            if($transcript_file) {
                
                echo("<a href='$transcript_file'><img src='https://cambodianoralhistoryproject.byu.edu/wp-content/uploads/2019/08/KhmerFile-1.png' style='max-width: 100px'/></a>");
            }

            if($translation_file) {
                echo("<a href='$translation_file'>img src='https://cambodianoralhistoryproject.byu.edu/wp-content/uploads/2019/07/EnglishFile-1.png' style='max-width: 100px'/></a>");
            
            }

            ?>
        </div>



        <h2>Interview(s)</h2>


        <!-- Interview Date -->
        <?php if ($participated_in_interview) {
            echo("<span class='bold-heading'>Date:</span>");
             foreach ($participated_in_interview as $interview) {
                if ($interview_year && $interview_month && $interview_day) {
                    echo($interview_day. ' ' . $interview_month. ' ' . $interview_year. ' Interview');
                }
                else if($interview_month && $interview_year ) {
                    echo ($interview_month. ' ' . $interview_year. ' Interview');
                }
                else if($interview_year){
                    echo ($interview_year. ' Interview');
                }

             }
        }?>

        <!-- Interviewer -->

       <?php 
       if($interviewer){
            echo("<p><span class='bold-heading'> Interviewer:</span></p>");
            echo($interviewer["post_title"]);
       }
       ?>

        <!-- Interview information -->
        <?php if($link_to_box_folder){
            
            echo("<p><a href='$link_to_box_folder'>Interview Documents</a></p>");
        }
        ?>
    </div>
    <div class="interviewee-image">
        <?php if ($picture) {
            echo("<img style='max-width: 320px' src='$picture[guid]'/>");
        }?>
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







<?php get_footer();?>