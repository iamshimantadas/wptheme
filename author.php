<?php
/**
 * Author Archive Template
 */

get_header();

// Get current author
$author = get_queried_object();

// Pagination
$paged = get_query_var('paged') ? get_query_var('paged') : 1;

// Custom query for author's posts
$args = array(
    'post_type'      => 'post',
    'post_status'    => 'publish',
    'author'         => $author->ID,
    'posts_per_page' => 12,
    'paged'          => $paged,
);

$author_posts = new WP_Query($args);
?>

<main id="primary" class="site-main">

    <div class="container">

        <!-- Author Information -->
        <div class="author-header">

            <div class="author-avatar">
                <?php echo get_avatar($author->ID, 120); ?>
            </div>

            <div class="author-info">

                <h1>
                    <?php echo esc_html($author->display_name); ?>
                </h1>

                <?php if (!empty($author->description)) : ?>
                    <div class="author-bio">
                        <?php echo wpautop(esc_html($author->description)); ?>
                    </div>
                <?php endif; ?>

                <p>
                    <?php
                    echo esc_html(
                        sprintf(
                            '%d Posts',
                            count_user_posts($author->ID, 'post')
                        )
                    );
                    ?>
                </p>

            </div>

        </div>


        <!-- Author Posts -->
        <div class="author-posts">

            <h2>
                Posts by <?php echo esc_html($author->display_name); ?>
            </h2>

            <?php if ($author_posts->have_posts()) : ?>

                <div class="row">

                    <?php while ($author_posts->have_posts()) : ?>
                        <?php $author_posts->the_post(); ?>

                        <div class="col-md-4">

                            <article id="post-<?php the_ID(); ?>" <?php post_class('author-post-card'); ?>>

                                <?php if (has_post_thumbnail()) : ?>
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail(
                                            'medium',
                                            array(
                                                'class' => 'img-fluid'
                                            )
                                        ); ?>
                                    </a>
                                <?php endif; ?>


                                <div class="post-content">

                                    <h3>
                                        <a href="<?php the_permalink(); ?>">
                                            <?php the_title(); ?>
                                        </a>
                                    </h3>

                                    <div class="post-meta">

                                        <span class="post-date">
                                            <?php echo get_the_date(); ?>
                                        </span>

                                    </div>

                                    <div class="post-excerpt">
                                        <?php the_excerpt(); ?>
                                    </div>

                                    <a href="<?php the_permalink(); ?>" class="read-more">
                                        Read More
                                    </a>

                                </div>

                            </article>

                        </div>

                    <?php endwhile; ?>

                </div>


                <!-- Pagination -->
                <div class="author-pagination">

                    <?php
                    echo paginate_links(
                        array(
                            'total'     => $author_posts->max_num_pages,
                            'current'   => $paged,
                            'prev_text' => '&laquo; Previous',
                            'next_text' => 'Next &raquo;',
                        )
                    );
                    ?>

                </div>


            <?php else : ?>

                <p>No posts found for this author.</p>

            <?php endif; ?>

        </div>

    </div>

</main>

<?php
wp_reset_postdata();

get_footer();
?>