<?php
/**
 * @package WordPress
 * @subpackage Wheels
 *
 * Template Name: Books
 */
get_header();
$current_post = get_post();
?>
<?php get_template_part('templates/title'); ?>
<div class="<?php echo petal_class('main-wrapper') ?>">
    <div class="<?php echo petal_class('container') ?>">
        <div class="<?php echo petal_class('content-fullwidth') ?>">
                    <div class="bookshelf">
                        <?php
                        the_post();

                        the_content();
                        ?>

                        <?php
                        $args_loop = array( 'post_type' => 'book', 'posts_per_page' => -1 );
                        $loop_custom = new WP_Query( $args_loop );

                        if ( $loop_custom->have_posts() ) :
                            while ( $loop_custom->have_posts() ) : $loop_custom->the_post();
                                ?>
                                <figure>
                                    <div class="perspective">
                                        <div class="book open-details">
                                            <div class="cover">
                                                <div class="spine">
                                                    <?php
                                                    $book_side_image = stripcslashes( get_option( $post->ID . 'book_side_image', "" ) );
                                                    ?>
                                                    <img alt="<?php the_title_attribute(); ?>" src="<?php echo $book_side_image; ?>">
                                                </div>

                                                <div class="front">
                                                    <?php
                                                    $book_cover_image = stripcslashes( get_option( $post->ID . 'book_cover_image', "" ) );
                                                    ?>
                                                    <img alt="<?php the_title_attribute(); ?>" src="<?php echo $book_cover_image; ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="buttons">
                                        <a class="open-details" href="#"><?php echo __( 'Details', 'read' ); ?></a>

                                        <?php
                                        $book_buy_url = stripcslashes( get_option( $post->ID . 'book_buy_url', "" ) );

                                        if ( $book_buy_url != "" )
                                        {
                                            $book_buy_url_new_tab = get_option( $post->ID . 'book_buy_url_new_tab', true );

                                            if ( $book_buy_url_new_tab )
                                            {
                                                $book_buy_url_new_tab = 'target="_blank"';
                                            }
                                            else
                                            {
                                                $book_buy_url_new_tab =  "";
                                            }


                                            ?>
                                            <a <?php echo $book_buy_url_new_tab; ?> href="<?php echo $book_buy_url; ?>"><?php echo __( 'Download', 'read' ); ?></a>
                                            <?php
                                        }
                                        ?>
                                    </div>

                                    <figcaption>
                                        <?php
                                        $taxonomy = 'book_author';

                                        $terms_list = get_the_terms( get_the_ID(), $taxonomy );

                                        $book_author = "";


                                        if ( ! empty( $terms_list ) )
                                        {
                                            $out = array();

                                            foreach ( $terms_list as $term_list )
                                            {
                                                $out[] = $term_list->name;
                                            }

                                            $book_author = join( ', ', $out );
                                        }
                                        ?>
                                        <h2><?php the_title(); ?> <span><?php echo $book_author; ?></span></h2>
                                    </figcaption>

                                    <div class="details">
                                        <?php
                                        the_content();
                                        ?>

                                        <span class="close-details">X</span>
                                    </div>
                                </figure>
                                <?php
                            endwhile;
                        endif;
                        wp_reset_query();
                        ?>
                    </div>
        </div>
    </div>
    <div class="nav-links">
        <?php
        $next_post = get_previous_post(true,'','category');
        if (!empty($next_post)): ?>
            <a href="<?php echo get_permalink($next_post->ID); ?>">
                <div class="prev">
                    <h2><?php echo $next_post->post_parent != 0 ? "Previous article" : "Previous section" ?></h2>
                    <?php echo $next_post->post_title; ?>
                </div>
            </a>
        <?php endif; ?>
        <?php
        $next_post = get_next_post(true,'','category');
        if (!empty($next_post)): ?>
            <a href="<?php echo get_permalink($next_post->ID); ?>">
                <div class="next">
                    <h2><?php echo $next_post->post_parent !=0 ? "Next article" : "Next section" ?></h2>
                    <?php echo $next_post->post_title; ?>
                </div>
            </a>
        <?php endif; ?>
    </div>
</div>
<?php get_footer(); ?>
<script>
    window.$=jQuery;
    require('bookshelf');
</script>
