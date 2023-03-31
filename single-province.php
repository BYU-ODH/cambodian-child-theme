<?php 
get_header();
$obj = pods();

$interviewees = $obj -> field("interviewee_born");
usort($interviewees, function($a, $b) {
    return strcasecmp($a['post_title'], $b['post_title']); // comparison function to sort by post_title field
});
$google_map_link = $obj -> field("google_map_link");
?>
<div class="article-inner">
  <div class="container-fluid">
    <div class="row">
        <div class="col-9">
        <h1 class="title"><?php the_title()?></h1>
            <?php if (!empty($interviewees)) {
              echo("<h3>List of Interviewees</h3>");
              echo("<ul>");
              foreach ($interviewees as $interview){
                echo "<li class='list'><a href='" . $interview['guid'] . "'>" . $interview['post_title'] . "</a></li>";

              }
              echo("</ul>");
            } ?>
        </div>
        <div class="col-3">
            <?php if ($google_map_link){
              echo($google_map_link);
            }
            ?>
        </div> 
    </div>
  </div>
</div>

<?php get_footer();?>
