<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> -->

<?php 
get_header();
$obj = pods();

$interviewees = $obj -> field("interviewee_born");
usort($interviewees, function($a, $b) {
    return strcasecmp($a['post_title'], $b['post_title']); // comparison function to sort by post_title field
});
$google_map_link = $obj -> field("google_map_link");
?>

<div id="container" class="three-columns-sided">
  <main id="main" role="main" class="main">
    <div class="article-inner">
      <div class="entry-content" itemprop="articleBody">
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
    </div>
  
	</aside>
  </main>
</div>
<aside id="primary" class="widget-area sidey" role="complementary" itemscope="" itemtype="http://schema.org/WPSideBar">
	
	<section id="text-5" class="widget-container widget_text">			<div class="textwidget"></div>
		</section>
<?php get_footer();?>
