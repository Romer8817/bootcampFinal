<?php get_header();?>

<?php

global $post;

setup_postdata( $post );

//INCLUDE THE CATEGORY and TAGS

?>

<h1><?php the_title();?></h1>

<p>
    <?php the_content();?>
</p>

<h2>Interested in:</h2>
<ul>
    <?php
        $data = wpas_get_view_data();
      
    ?>
    <?php echo apply_filters( 'car', $data['car']->post_content ); ?>
</ul>

<?php get_footer();?>