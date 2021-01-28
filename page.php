
<?php get_header(); ?>

	<main role="main">
		<!-- section -->

            <!-- /section -->
            <?php if (is_cart() ) { ?>

                <section id="cart" class="empty">
                    <div class="lg:max-w-screen-lg xl:max-w-screen-xl mx-auto my-12">

                        <h1>Winkelwagen</h1>

                        <?php the_content(); ?>

                    </div>
                </section>

            <?php } else if(is_front_page()){ ?>



            <?php } else if(is_checkout()){ ?>

                <section id="checkout">
                    <div class="lg:max-w-screen-lg mx-auto my-12">

                        <?php the_content(); ?>

                    </div>
                </section>


            <?php } else if( is_account_page() ){ ?>
                
                <section id="account" class="empty">
                    <div class="lg:max-w-screen-lg xl:max-w-screen-xl mx-auto my-20">

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
                            <div class="w-full lg:max-w-screen-lg xl:max-w-screen-xl mx-auto my-20">
                                <?php the_content(); ?>
                            </div>
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
