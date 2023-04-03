<?php
get_header();

$obj = pods();

$birth_year = $obj -> field("birth_year");
$birth_month = $obj -> field("birth_month");
$birth_date = $obj -> field("birth_date");


$birth_location_province = $obj -> field("birth_location_province");
$birth_location_village = $obj -> field("birth_location_village");
$participated_in_interview = $obj -> field("participated_in_interview");
// var_dump($participated_in_interview);
$picture = $obj -> field("picture");

 // We need to get this number dynamically
$interview_pod = pods('interview', $participated_in_interview[0]["ID"]);
$interview_month = $interview_pod -> field("interview_month");
$interview_year = $interview_pod -> field("interview_year");
$interview_day = $interview_pod -> field("interview_day");

echo($interview_month.$interview_day.$interview_year);
?>
<?php get_footer();?>