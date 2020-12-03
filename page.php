
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

                    <h1><?php the_title(); ?></h1>

                    <?php if (have_posts()): while (have_posts()) : the_post(); ?>

                    <!-- article -->
                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                        <?php the_content(); ?>

                        <?php comments_template( '', true ); // Remove if you don't want comments ?>

                        <br class="clear">

                        <?php edit_post_link(); ?>

                    </article>
                    <!-- /article -->

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
