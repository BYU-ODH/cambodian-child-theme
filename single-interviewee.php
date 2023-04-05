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
        <?php if ($birth_year): ?>
            <?php if ($birth_month): ?>
                <?php if ($birth_date): ?>
                    <p><span class="bold-heading">Birthday:</span> <?php echo $birth_date . ' ' . $birth_month . ' ' . $birth_year; ?></p>
                <?php else: ?>
                    <p><span class="bold-heading">Birth month:</span> <?php echo $birth_month . ' ' . $birth_year; ?></p>
                <?php endif; ?>
            <?php else: ?>
                <p><span class="bold-heading">Birth year:</span> <?php echo $birth_year; ?></p>
            <?php endif; ?>
        <?php endif; ?>

        <?php if ($birth_location_province): ?>
            <p><span class="bold-heading">Birth province:</span> <a href="<?php echo $birth_location_province[0]['guid']; ?>"><?php echo $birth_location_province['post_title']; ?></a></p>
        <?php endif; ?>

        <?php if ($birth_location_village): ?>
            <p><span class="bold-heading">Birth village:</span> <a href="<?php echo $birth_location_village[0]['guid']; ?>"><?php echo $birth_location_village['post_title']; ?></a></p>
        <?php endif; ?>

        <?php if ($participated_in_interview): ?>
            <p><span class="bold-heading">Interview:</span>
            <?php foreach ($participated_in_interview as $interview): ?>
                <a href="<?php echo $interview['guid']; ?>">
                    <?php if ($interview_year): ?>
                        <?php if ($interview_month): ?>
                            <?php if ($interview_day): ?>
                                <?php echo $interview_day. ' ' . $interview_month. ' ' . $interview_year. ' Interview'; ?>
                            <?php else: ?>
                                <?php echo $interview_month. ' ' . $interview_year. ' Interview'; ?>
                            <?php endif; ?>
                        <?php else: ?>
                            <?php echo $interview_year. ' Interview'; ?>
                        <?php endif; ?>
                    <?php endif; ?>
                </a></p>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
    <div class="interviewee-image">
        <?php if ($picture): ?>
            <img src="<?php echo $picture; ?>" style="max-width: 320px;">
        <?php endif; ?>
    </div>
</div>

<?php get_footer();?>