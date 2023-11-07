<?php 
get_header();

function english_translation() {
    
    $params = array(
        'orderby' => 't.post_title ASC',    
        'limit' => -1,
        'where' => 'translation_file.meta_value != ""'
    );
    
    $interviewee_params = array(
        'orderby' => 't.post_title ASC',    
        'limit' => -1,
    );

    $mypod = pods( 'interview' , $params);

    $cards = ''; // Initialize an empty string to store card HTML

    while ($mypod->fetch()) {
        $id = $mypod->field('id');
        $permalink = get_permalink($id);
        $interviewee = $mypod->field('interviewee');

        $picture = pods('interviewee', $interviewee['ID'])->field('picture');
        $picture_Id = !empty($picture['guid']) ? $picture['guid'] : 'http://cambodianoralhistoryproject.byu.edu/wp-content/uploads/2019/05/No-Image.png';
        $post_title = $interviewee['post_title']; 

        // Create the card HTML
        $card = '
            <div class="interviewee-card">
                <a class="link" href="' . $permalink . '">
                    <img src="' . $picture_Id . '" alt="' . $post_title . '">
                    <h2>' . $post_title . '</h2>
                </a>
            </div>
        ';

        $cards .= $card; // Append the card HTML to the cards string
    }

    return $cards; // Return the generated cards HTML
}
add_shortcode('english', 'english_translation');
?>

<div class="interviewee-cards-container">
    <?php echo do_shortcode('[english]'); ?>
</div>

<?php get_footer();?>
