<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="post-header">
        <?php if (has_post_thumbnail()) : ?>
            <a href="<?php the_permalink(); ?>" rel="bookmark">
                <?php the_post_thumbnail('post-image'); ?>
            </a>
        <?php endif; ?>
    </div>

    <div class="post-content entry-content">
        <div class="post-meta">
            <span class="post-date"><a href="<?php the_permalink(); ?>"><?php the_time(get_option('date_format')); ?></a></span>
            <span class="date-sep"> / </span>
            <span class="post-author"><?php the_author_posts_link(); ?></span>

            <?php if (current_user_can('manage_options')) : ?>
                <span class="date-sep"> / </span>
                <?php edit_post_link(__('Edit', 'hemingway')); ?>
            <?php endif; ?>
        </div>

        <?php if ($title = get_the_title()) : ?>
            <a href="<?php the_permalink(); ?>" rel="bookmark">
                <h4 class="post-title">
                    <?php echo $title; ?>
                </h4>
            </a>
        <?php endif; ?>

        <a class="excerpt" href="<?php the_permalink(); ?>" rel="bookmark">
            <?php the_excerpt(); ?>
        </a>
    </div>
</article>