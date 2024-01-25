<?php 
get_header();

$params = array(
    'orderby' => 'modified DESC',
    'limit' => 9,
    'where' => 'translation_file.meta_value != ""'
);

$mypod = pods( 'interview' , $params);
function english_translation() {
    global $mypod;
    $cards = ''; // Initialize an empty string to store card HTML
    while ($mypod->fetch()) {
        $intervieweepod = $mypod-> field('interviewee');
        $id = $intervieweepod["ID"] ?? NULL;    
        if (!is_null($id)) {
            $permalink = get_permalink($id);
            $picture = pods('interviewee', $id)->field('picture');
            $picture_Id = !empty($picture['guid']) ? $picture['guid'] : 'http://cambodianoralhistoryproject.byu.edu/wp-content/uploads/2019/05/No-Image.png';
            $post_title = $intervieweepod['post_title']; 
            
            // Create the card HTML
            $card = '
            <div class="interviewee-card">
            <a class="link" href="' . $permalink . '">
            <img src="' . $picture_Id . '" alt="' . $post_title . '">
            <h2 class="card_title">' . $post_title . '</h2>
            </a>
            </div>
            ';
            
            $cards .= $card; // Append the card HTML to the cards string
        }
        
    }
    
    return $cards; // Return the generated cards HTML
}
add_shortcode('english', 'english_translation');
?>
<div class="paginations">
    <?php echo $mypod->pagination( array( 'type' => 'paginate' ) );?>
</div>

<div class="interviewee-cards-container">
    <?php echo do_shortcode('[english]'); ?>
</div>

<div class="paginations">
    <?php echo $mypod->pagination( array( 'type' => 'paginate' ) ); ?>
</div>

<?php get_footer();?>
