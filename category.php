<?php get_header(); ?>

<main class="wrapper section-inner group" id="site-content">
    <h1><?php echo single_cat_title(); ?></h1>
    <div class="posts">
        <?php while (have_posts()) : the_post(); ?>
            <?php get_template_part('category-item', get_post_format()); ?>
        <?php endwhile; ?>
    </div>
    <?php get_template_part('pagination', get_post_format()); ?>
</main>

<?php get_footer(); ?>