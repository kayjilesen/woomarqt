
<?php get_header(); ?>

	<main role="main">
		<!-- section -->

            <!-- /section -->
            <?php if (is_cart() ) { ?>

                <section id="cart" class="empty">
                    <div class="max-w-screen-xl mx-auto">

                        <h1>Winkelwagen</h1>

                        <?php the_content(); ?>

                    </div>
                </section>


            <?php } else if( is_account_page() ){ ?>
                
                <section id="account" class="empty">
                    <div class="max-w-screen-xl mx-auto">

                        <h1>Mijn account</h1>

                        <?php the_content(); ?>

                    </div>
                </section>
                
            <?php } else { ?>
                <section>

                    <?php if (have_posts()): while (have_posts()) : the_post();

                    // Insert Template if has post has Parent page and Template exists
                    if($wp_query->post->post_parent !== 0 && file_exists(get_template_directory() . '/templates/' . get_post($wp_query->post->post_parent)->post_name . '.php')) {
                        include 'templates/' . get_post($wp_query->post->post_parent)->post_name . '.php';
                    } else {
                        ?>
                        <!-- article -->
                        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                            <?php the_content(); ?>

                        </article>
                        <!-- /article -->
                        <?php
                    }
                    ?>

                    <?php endwhile; ?>

                    <?php else: ?>

                    <!-- article -->
                    <article>

                        <h2><?php _e( 'Sorry, nothing to display.', 'html5blank' ); ?></h2>

                    </article>
                    <!-- /article -->

                    <?php endif; ?>

                    <?php } ?>

                    </section>
	</main>

<?php get_footer(); ?>
