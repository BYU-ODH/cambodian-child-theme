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
            else {
                echo("<p><span class='bold-heading'>Birth year:</span>".$birth_year."</p>");
            }
        ?>
        <!-- Birth Location -->
        <?php if ($birth_location_province) {
            echo("<p><span class='bold-heading'>Birth province:</span>");
            echo("<a href='$birth_location_province[guid]'>".$birth_location_province['post_title']."</a></p>");
        } ?>
        <!-- Birth location Village -->
        <?php if ($birth_location_village) {
            echo("<p><span class='bold-heading'>Birth village:</span>");
            echo("<a href='$birth_location_village[0][guid]'>".$birth_location_village['post_title']."</a></p>");
        }?>

        <!-- Interview -->
        <?php if ($participated_in_interview) {
            echo("<p><span class='bold-heading'>Interview:</span>");
             foreach ($participated_in_interview as $interview) {
                echo("<a href='$interview[guid]'>");
                if ($interview_year && $interview_month && $interview_day) {
                    echo($interview_day. ' ' . $interview_month. ' ' . $interview_year. ' Interview');
                }
                else if($interview_month && $interview_year ) {
                    echo ($interview_month. ' ' . $interview_year. ' Interview');
                }
                else {
                    echo ($interview_year. ' Interview');
                }

             }
        }?>

    </div>
    <div class="interviewee-image">
        <?php if ($picture) {
            echo("<img style='max-width: 320px' src='$picture[guid]'/>");
        }?>
    </div>
</div>










<?php get_footer();?>