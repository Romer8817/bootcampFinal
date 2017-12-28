<?php
/**
 * The home template file
 *
 * Default Homepage for the  site Or If the user has selected a static page for their homepage, this is what will appear.
 * Learn more: https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Envy Blog
 */

get_header();

$blog_layout = get_theme_mod( 'envy-blog_archive_page_layout', 'blog-layout-1' );
?>

    <div class="row">
        <div id="primary" class="content-area">
            <main id="main" class="site-main" role="main">
                <?php
                $argsQuery = array(
                    'post_type' => 'lead'
                );
            
                $leads = get_posts($argsQuery);
                echo "<div class='blog-layout blog-layout-1 masonry has-col-3' style='position: relative; height: 2160.53px;'>";
                foreach($leads as $lead){
                    ?>
                    <article class='col-3 child-element post type-post format-standard has-post-thumbnail hentry'>
                        <div class='post-wrap'>
                            <a href="<?php echo get_permalink($lead->ID);?>">
                            <div class='content-holder'>
                                <h2 class='entry-title'>
                                    <?php echo $lead->post_title; ?>
                                </h2>
                                <div class='entry-content'>
                                    <p><?php echo $lead->post_content; ?></p>
                                </div>
                            </div>
                            </a>
                        </div>
                    </article>
                    
                    <?php
                }
                echo "</div>";
                
                     ?>

            </main><!-- #main -->
        </div><!-- #primary -->

    </div><!-- .row -->

<?php get_footer();
