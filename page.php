<?php get_header(); ?>

<div class="container">
    <div class="row">

        <?php if ( have_posts() ) : ?>

            <?php while ( have_posts() ) : the_post(); ?>

                <div class="col-12">

                    <h2>
                        <a href="<?php the_permalink(); ?>">
                            <?php the_title(); ?>
                        </a>
                    </h2>

                    <div class="entry-content">
                        <?php the_content(); ?>
                    </div>

                </div>

            <?php endwhile; ?>

        <?php else : ?>

            <p><?php esc_html_e( 'No content found.', 'textdomain' ); ?></p>

        <?php endif; ?>

    </div>
</div>

<?php get_footer(); ?>